<?php

namespace App\Traits;

use App\Models\Message;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use LaravelIdea\Helper\App\Models\_IH_Message_C;

trait Messages
{

    public function getAllMessages(): _IH_Message_C|\Illuminate\Contracts\Pagination\LengthAwarePaginator|LengthAwarePaginator|array
    {
        return Message::with(['sender:id,firstname,surname', 'booking'])
            ->when(Request::input('search'), function ($query, $search) {
                $query->whereRelation('sender', 'surname', 'like', "%{$search}%");
            })
            ->where('recipient_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);
    }

    public function getUnreadMessages(): _IH_Message_C|\Illuminate\Contracts\Pagination\LengthAwarePaginator|LengthAwarePaginator|array
    {
        return Message::query()
            ->with(['sender:id,firstname,surname', 'booking'])
            ->when(Request::input('search'), function ($query, $search) {
                $query->whereRelation('sender', 'surname', 'like', "%{$search}%");
            })
            ->where('recipient_id', Auth::id())
            ->where('isRead', false)
            ->orderBy('created_at', 'desc')
            ->paginate(10);
    }

    public function getFlaggedMessages(): _IH_Message_C|\Illuminate\Contracts\Pagination\LengthAwarePaginator|LengthAwarePaginator|array
    {
        return Message::query()
            ->with(['sender:id,firstname,surname', 'booking'])
            ->when(Request::input('search'), function ($query, $search) {
                $query->whereRelation('sender', 'surname', 'like', "%{$search}%");
            })
            ->where('recipient_id', Auth::id())
            ->where('flagged', true)
            ->orderBy('created_at', 'desc')
            ->paginate(10);
    }

    public function getSentMessages(): _IH_Message_C|\Illuminate\Contracts\Pagination\LengthAwarePaginator|LengthAwarePaginator|array
    {
        return Message::with(['recipient:id,firstname,surname', 'booking'])
            ->when(Request::input('search'), function ($query, $search) {
                $query->whereRelation('recipient', 'surname', 'like', "%{$search}%");
            })
            ->where('sender_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);
    }
}
