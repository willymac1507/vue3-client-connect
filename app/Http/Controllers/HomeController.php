<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        return Inertia::render('Dashboard', [
            'can' => [
                'superAdmin' => Auth::user()->can('superAdmin', User::class)
            ]
        ]);
    }
}
