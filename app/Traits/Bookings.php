<?php

namespace App\Traits;

use App\Models\Booking;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use LaravelIdea\Helper\App\Models\_IH_Booking_C;

trait Bookings
{
    public function getAllBookings($messages): Collection|array|_IH_Booking_C
    {
        return Booking::with('client:id,firstname,surname', $messages ? 'messages' : '')->where('student_id', Auth::id())->get();
    }

    public function getThisBooking(Booking $booking)
    {
        return Booking::with(['client:id,firstname,surname', 'messages'])->findOrFail($booking->id);
    }

    public function getAllBookingsForStudent(User $user): Collection|array|_IH_Booking_C
    {
        return Booking::with('client:id,firstname,surname')
            ->where('student_id', $user->id)
            ->where('start', '>', now())
            ->orderBy('start', 'asc')
            ->get();
    }

    public function getAllBookingsForClient(User $user): array|Collection|_IH_Booking_C
    {
        return Booking::with('student:id,firstname,surname,organisation_id', 'student.organisation:id,name,town')
            ->where('client_id', $user->id)
            ->orderBy('start', 'asc')
            ->get();
    }
}
