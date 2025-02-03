<?php

namespace App\Models;

use Database\Factories\SlotFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Slot extends Model
{
    /** @use HasFactory<SlotFactory> */
    use HasFactory;

    public function student(): HasMany
    {
        return $this->hasMany(User::class, 'student_id');
    }

    public function booking(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    public function organisation(): BelongsTo
    {
        return $this->belongsTo(Organisation::class);
    }

}
