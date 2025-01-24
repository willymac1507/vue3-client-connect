<?php

namespace App\Traits;

use App\Models\Conversation;
use Illuminate\Database\Eloquent\Collection;

trait Messages
{
    public function getAllMessages(): Collection
    {
        return Conversation::with('messages', 'messages.sender', 'messages.recipient')->get();
    }
}
