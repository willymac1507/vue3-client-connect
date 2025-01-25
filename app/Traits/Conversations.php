<?php

namespace App\Traits;

use App\Models\Conversation;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

trait Conversations
{
    public function getAllConversations(): Collection
    {
        return Conversation::with('messages', 'messages.sender', 'messages.recipient')->get();
    }

    public function getUnreadConversations(): Collection
    {
        return Conversation::with('messages', 'messages.sender', 'messages.recipient')
            ->whereRelation('messages.recipient', 'id', Auth::id())
            ->get();
    }
}
