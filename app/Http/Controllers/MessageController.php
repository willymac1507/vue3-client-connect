<?php

namespace App\Http\Controllers;

use App\Traits\Conversations;
use Inertia\Inertia;

class MessageController extends Controller
{
    use Conversations;

    public function index()
    {
        return Inertia::render('Conversations', [
            'conversations' => $this->getUnreadConversations()
        ]);
    }
}
