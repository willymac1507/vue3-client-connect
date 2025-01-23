<?php

namespace App\Http\Controllers;

use DateInterval;
use Inertia\Inertia;

class AdminController extends Controller
{
    public function index()
    {
        $startDate = fake()->dateTimeThisYear('+2 months');
        $endDate = $startDate->add(new DateInterval('PT1H'));
        return Inertia::render('Admin/Dashboard', ['startDate' => $startDate, 'endDate' => $endDate]);
    }
}
