<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\Bookings;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Exceptions\InvalidBreadcrumbException;
use Diglactic\Breadcrumbs\Exceptions\UnnamedRouteException;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    use Bookings;

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
                    ->orderBy('surname', 'asc')
                    ->paginate(10)
                    ->withQueryString(),
                'filters' => Request::only(['search']),
            ]);
        } else {
            return back()->with('error', 'You are not authorised to view that page.');
        }
    }

    /**
     * @throws UnnamedRouteException
     * @throws InvalidBreadcrumbException
     */
    public function show(User $user)
    {
        $response = Gate::inspect('view', $user);

        if ($response->allowed()) {
            return Inertia::render('Users/Show', ['user' => $user, 'roles' => $user->roles, 'organisation' => $user->organisation, 'bookingsAsClient' => $this->getAllBookingsForClient($user), 'bookingsAsStudent' => $this->getAllBookingsForStudent($user), 'breadcrumbs' => Breadcrumbs::generate('user.show', $user)]);
        } else {
            return back()->with('error', 'You are not authorised to view that page.');
        }
    }

    public function create()
    {
        return Inertia::render('Users/Create');
    }
}
