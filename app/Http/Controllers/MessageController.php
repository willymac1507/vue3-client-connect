<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Traits\Contacts;
use App\Traits\Messages;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class MessageController extends Controller
{
    use Messages, Contacts;

    /**
     * @return Response
     */
    public function index()
    {
        return Inertia::render('Messages/Messages', [
            'messages' => $this->getAllMessages(),
            'status' => 'all'
        ]);
    }

    /**
     * @return Response
     */
    public function unread()
    {
        return Inertia::render('Messages/Messages', [
            'messages' => $this->getUnreadMessages(),
            'status' => 'unread'
        ]);
    }

    public function flagged()
    {
        return Inertia::render('Messages/Messages', [
            'messages' => $this->getFlaggedMessages(),
            'status' => 'flagged'
        ]);
    }

    /**
     * @return Response
     */
    public function sent()
    {
        return Inertia::render('Messages/Messages', [
            'messages' => $this->getSentMessages(),
            'status' => 'sent'
        ]);
    }

    /**
     * @param Request $request
     * @param Message $message
     * @return RedirectResponse|Response
     */
    public function show(Request $request, Message $message)
    {
        $response = Gate::inspect('view', $message);

        if ($response->allowed()) {
            return Inertia::render('Messages/ShowMessage', ['message' => $message]);
        } else {
            return back();
        }
    }

    public function toggleFlag(Message $message)
    {
        $response = Gate::inspect('update', $message);

        if ($response->allowed()) {
            $message->flagged = !$message->flagged;
            $message->save();
            return Redirect::route('flaggedMessages');
        } else {
            return back();
        }

    }

    /**
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'sender_id' => 'required',
            'recipient_id' => 'required',
            'body' => 'required',
            'subject' => 'required'
        ]);

        Message::create($attributes);
        return Redirect::route('sentMessages')->with('success', 'Your message has been sent.');
    }

    /**
     * @return Response
     */
    public function create()
    {
        return Inertia::render('Messages/Create', ['contacts' => $this->getLinkedContacts(Auth::user())->map(fn($user) => [
            'id' => $user->id,
            'name' => $user->name,
            'organisation' => $user->organisation_id ??= 0
        ]),
            'sender_id' => Auth::id()]);
    }

    /**
     * @param Message $message
     * @return Application|RedirectResponse|Redirector
     */
    public function toggleRead(Message $message)
    {
        $message->isRead = !$message->isRead;
        $message->save();
        return redirect('/messages/unread');
    }


}
