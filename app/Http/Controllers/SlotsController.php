<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class SlotsController extends Controller
{
    public function edit()
    {
        return Inertia::render('Calendars/Partials/PatternSetupForm');
    }
}
