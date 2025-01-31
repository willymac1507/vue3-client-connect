<?php

namespace App\Traits;

use App\Models\Booking;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use LaravelIdea\Helper\App\Models\_IH_Booking_C;

trait Bookings
{
    public function getAllBookings(): Collection|array|_IH_Booking_C
    {
        return Booking::with('client')->where('student_id', Auth::id())->get();
    }

    public function getThisBooking(Booking $booking)
    {
        return Booking::with(['client', 'student', 'messages'])->findOrFail($booking->id);
    }
}
