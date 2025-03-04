<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\Bookings;
use App\Traits\Organisations;
use Diglactic\Breadcrumbs\Exceptions\InvalidBreadcrumbException;
use Diglactic\Breadcrumbs\Exceptions\UnnamedRouteException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
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

    public function edit(User $user)
    {
        return Inertia::render('Users/Edit', ['user' => $user, 'roles' => $user->roles->map(fn($role) => [
            'id' => $role->id,
            'label' => $role->role
        ])]);
    }

    public function update(Request $request, User $user)
    {
        $data = $this->validateAndPrepare($request);
        $attributes = $data[0];
        $roles = $data[1];
        $user->fill($attributes)->save();
        $user->roles()->sync($roles);
        return to_route('user.show', $user->id)->with('success', 'The user has been updated.');
    }

    private function validateAndPrepare($request)
    {
        $orgs = $this->setOrganisationsArray($request->user());

        $attributes = $request->validate([
            'firstname' => 'required',
            'surname' => 'required',
            'email' => 'required',
            'mobile' => 'required',
            'roles' => 'required|array|min:1|max:4',
            'organisation_id' => ['required', 'in:' . implode(',', $orgs)],
            'profilePicture' => 'nullable|image:allow_svg|max:2048',
            'profile_picture_path' => 'nullable'
        ]);
        $roles = array_column($attributes['roles'], 'id');
        unset($attributes['roles']);
        if ($request->hasFile('profilePicture')) {
            $path = $request->file('profilePicture')->store('profilePictures', 'public');
            unset($attributes['profilePicture']);
            $attributes['profile_picture_path'] = '/' . $path;
        }
        return [$attributes, $roles];
    }

    private function setOrganisationsArray($user)
    {
        $orgs = [];
        if ($user->can('createAny', User::class)) {
            foreach ($this->getAllOrganisations() as $org) {
                $orgs[] = $org['id'];
            }
        } else {
            $orgs = [$user->organisation_id];
        }
        return $orgs;
    }

    public function store(Request $request)
    {
        $attributes = $this->validateAndPrepare($request)[0];
        $roles = $this->validateAndPrepare($request)[1];
        $attributes['password'] = Hash::make(fake()->password);
        $user = User::create($attributes);
        $user->roles()->sync($roles);
        return to_route('organisation.show', $attributes['organisation_id'])->with('success', 'A new user has been created.');
    }

    public function create(Request $request)
    {
        $user = auth()->user();
        if ($user->hasRole('superUser')) {
            $organisation_id = RequestFacade::input('organisation') ?? null;
            $organisations = $this->getAllOrganisations()->map(fn($org) => [
                'id' => $org->id,
                'name' => $org->name,
            ]);
        } else {
            $organisation_id = $user->organisation_id;
            $organisations = [$this->getAdminOrganisation($user->organisation_id)];
        }
        return Inertia::render('Users/Create', ['organisations' => $organisations, 'organisation_id' => $organisation_id]);
    }

}
