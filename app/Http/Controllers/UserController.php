<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index(User $user)
    {
        $response = Gate::inspect('viewAny', User::class);

        if ($response->allowed()) {
            return Inertia::render('Users/Index', [
                'users' => User::query()
                    ->when(Request::input('search'), function ($query, $search) {
                        $query->where('name', 'like', "%{$search}%");
                    })
                    ->with(['organisation', 'roles'])
                    ->paginate(10)
                    ->withQueryString(),
                'filters' => Request::only(['search']),
            ]);
        } else {
            return back()->with('error', 'You are not authorised to view that page.');
        }
    }

    public function show(User $user)
    {
        $response = Gate::inspect('view', $user);

        if ($response->allowed()) {
            return Inertia::render('Users/Show', ['user' => $user]);
        } else {
            return back()->with('error', 'You are not authorised to view that page.');
        }
    }
}
