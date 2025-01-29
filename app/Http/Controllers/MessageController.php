<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Traits\Contacts;
use App\Traits\Messages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;

class MessageController extends Controller
{
    use Messages, Contacts;

    public function index()
    {
        return Inertia::render('Messages/Messages', [
            'messages' => $this->getAllMessages(),
            'status' => 'all'
        ]);
    }

    public function unread()
    {
        return Inertia::render('Messages/Messages', [
            'messages' => $this->getUnreadMessages(),
            'status' => 'unread'
        ]);
    }

    public function sent()
    {
        return Inertia::render('Messages/Messages', [
            'messages' => $this->getSentMessages(),
            'status' => 'sent'
        ]);
    }

    public function show(Request $request, Message $message)
    {
        $response = Gate::inspect('view', $message);

        if ($response->allowed()) {
            return Inertia::render('Messages/ShowMessage', ['message' => $message]);
        } else {
            return to_route('messages');
        }
    }

    public function create()
    {
        return Inertia::render('Messages/Create', ['contacts' => $this->getLinkedContacts(Auth::user())->map(fn($user) => [
            'id' => $user->id,
            'name' => $user->name,
            'organisation' => $user->organisation_id ??= 0
        ])]);
    }
}
