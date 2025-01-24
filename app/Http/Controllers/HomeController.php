<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        return Inertia::render('User/Dashboard', [
            'bookings' => Booking::with('client')->where('student_id', Auth::id())->get()
        ]);
    }
}
