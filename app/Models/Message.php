<?php

namespace App\Models;

use Database\Factories\MessageFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Message extends Model
{
    /** @use HasFactory<MessageFactory> */
    use HasFactory;

    public function conversation(): BelongsTo
    {
        return $this->belongsTo(Conversation::class);
    }

    public function sender(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'sender_id');
    }

    public function recipient(): HasOne
    {
        return $this->HasOne(User::class, 'id', 'recipient_id');
    }
}
