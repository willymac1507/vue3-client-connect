<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class SuperController extends Controller
{
    public function index()
    {
        return Inertia::render('SuperAdmin/Dashboard');
    }
}
