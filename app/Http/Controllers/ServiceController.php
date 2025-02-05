<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Inertia\Inertia;

class ServiceController extends Controller
{
    public function edit()
    {
        return Inertia::render('Services/Edit', ['services' => Service::get()]);
    }
}
