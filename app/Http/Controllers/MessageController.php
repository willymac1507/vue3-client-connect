<?php

namespace App\Http\Controllers;

use App\Traits\Messages;
use Inertia\Inertia;

class MessageController extends Controller
{
    use Messages;

    public function index()
    {
        return Inertia::render('Messages', [
            'messages' => $this->getAllMessages()
        ]);
    }
}
