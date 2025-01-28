<?php

namespace App\Traits;

use App\Models\Message;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use LaravelIdea\Helper\App\Models\_IH_Message_C;

trait Messages
{
    public function getAllMessages(): _IH_Message_C|\Illuminate\Contracts\Pagination\LengthAwarePaginator|LengthAwarePaginator|array
    {
        return Message::with('sender:id,name')
            ->where('recipient_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);
    }

    public function getUnreadMessages(): _IH_Message_C|\Illuminate\Contracts\Pagination\LengthAwarePaginator|LengthAwarePaginator|array
    {
        return Message::with('sender:id,name')
            ->where('recipient_id', Auth::id())
            ->where('isRead', false)
            ->orderBy('created_at', 'desc')
            ->paginate(10);
    }

    public function getSentMessages(): _IH_Message_C|\Illuminate\Contracts\Pagination\LengthAwarePaginator|LengthAwarePaginator|array
    {
        return Message::with('recipient:id,name')
            ->where('sender_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);
    }
}
