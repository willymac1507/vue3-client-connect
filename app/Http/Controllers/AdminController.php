<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AdminController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Dashboard', [
            'can' => [
                'admin' => Auth::user()->can('admin', User::class)
            ]
        ]);
    }
}
