<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\Bookings;
use App\Traits\Organisations;
use Diglactic\Breadcrumbs\Exceptions\InvalidBreadcrumbException;
use Diglactic\Breadcrumbs\Exceptions\UnnamedRouteException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request as RequestFacade;
use Inertia\Inertia;

class UserController extends Controller
{
    use Bookings, Organisations;

    public function index(User $user)
    {
        $response = Gate::inspect('viewAny', User::class);

        if ($response->allowed()) {
            return Inertia::render('Users/Index', [
                'users' => User::query()
                    ->when(RequestFacade::input('search'), function ($query, $search) {
                        $query->where('name', 'like', "%{$search}%");
                    })
                    ->with(['organisation', 'roles'])
                    ->orderBy('surname', 'asc')
                    ->paginate(10)
                    ->withQueryString(),
                'filters' => RequestFacade::only(['search']),
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
            return Inertia::render('Users/Show', ['user' => $user, 'roles' => $user->roles, 'organisation' => $user->organisation, 'bookingsAsClient' => $this->getAllBookingsForClient($user), 'bookingsAsStudent' => $this->getAllBookingsForStudent($user)]);
        } else {
            return back()->with('error', 'You are not authorised to view that page.');
        }
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'firstname' => 'required',
            'surname' => 'required',
            'email' => 'required',
            'mobile' => 'required',
            'organisation_id' => 'required',
            'profilePicture' => 'nullable|image|max:2048',
        ]);
        $path = $request->file('profilePicture')->store('profilePictures', 'public');
        unset($attributes['profilePicture']);
        $attributes['profile_picture_path'] = '/' . $path;
        $attributes['password'] = Hash::make(fake()->password);
        $user = User::create($attributes);
        return to_route('users')->with('success', 'A new user has been created.');
    }

    public function create()
    {
        return Inertia::render('Users/Create', ['organisations' => $this->getAllOrganisations()->map(fn($org) => [
            'id' => $org->id,
            'name' => $org->name,
        ])]);
    }
}
