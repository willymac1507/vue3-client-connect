<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Traits\Messages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;

class MessageController extends Controller
{
    use Messages;

    public function index()
    {
        return Inertia::render('Messages/Unread', [
            'messages' => $this->getUnreadMessages()
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
}
