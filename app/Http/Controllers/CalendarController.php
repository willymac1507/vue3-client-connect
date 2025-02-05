<?php

namespace App\Http\Controllers;

use App\Models\Calendar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class CalendarController extends Controller
{
    public function store(Calendar $calendar, Request $request)
    {
        $attributes = $request->validate([
            'monStart' => 'nullable',
            'monEnd' => 'required_if:monStart, !null',
            'tueStart' => 'nullable',
            'tueEnd' => 'required_if:tueStart, !null',
            'wedStart' => 'nullable',
            'wedEnd' => 'required_if:wedStart, !null',
            'thuStart' => 'nullable',
            'thuEnd' => 'required_if:thuStart, !null',
            'friStart' => 'nullable',
            'friEnd' => 'required_if:friStart, !null',
            'satStart' => 'nullable',
            'satEnd' => 'required_if:satStart, !null',
            'sunStart' => 'nullable',
            'sunEnd' => 'required_if:sunStart, !null',
        ]);
        $attributes['user_id'] = Auth::id();
        $calendar->update($attributes);
        return redirect('/')->with('success', 'Your availability has been updated.');


    }

    public function create()
    {
        return Inertia::render('Calendars/Partials/CalendarSetupForm');
    }

    public function show()
    {
        return Inertia::render('Calendars/Partials/CalendarSetupForm', [
            'calendar' => Calendar::firstOrCreate(['user_id' => Auth::id()])
        ]);
    }
}
