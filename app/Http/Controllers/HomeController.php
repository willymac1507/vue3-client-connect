<?php

namespace App\Http\Controllers;

use App\Traits\Bookings;
use Inertia\Inertia;

class HomeController extends Controller
{
    use Bookings;

    public function index()
    {
        return Inertia::render('Users/Dashboard', [
            'bookings' => $this->getAllBookings(true)
        ]);
    }
}
