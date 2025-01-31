<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Traits\Bookings;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;

class BookingController extends Controller
{
    use Bookings;

    public function index()
    {
        return Inertia::render('Bookings/index', [
            'bookings' => $this->getAllBookings()
        ]);
    }

    public function show(Booking $booking)
    {
        $response = Gate::inspect('view', $booking);
        if ($response->allowed()) {
            return Inertia::render('Bookings/showBooking', [
                'booking' => $this->getThisBooking($booking)
            ]);
        } else {
            dd('Not allowed');
        }
    }
}
