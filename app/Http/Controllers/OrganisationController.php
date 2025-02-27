<?php /** @noinspection PhpUndefinedMethodInspection */

namespace App\Http\Controllers;

use App\Models\Organisation;
use App\Models\User;
use App\Rules\ValidPostcode;
use App\Traits\Users;
use Diglactic\Breadcrumbs\Exceptions\InvalidBreadcrumbException;
use Diglactic\Breadcrumbs\Exceptions\UnnamedRouteException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class OrganisationController extends Controller
{
    use Users;

    public function index()
    {
        $response = Gate::inspect('viewAny', Organisation::class);

        if ($response->allowed()) {
            return Inertia::render('Organisations/Index', [
                'organisations' => Organisation::orderBy('name', 'asc')
                    ->paginate(10)
            ]);
        } else {
            return back();
        }
    }

    /**
     * @throws InvalidBreadcrumbException
     * @throws UnnamedRouteException
     */
    public function show(Request $request, Organisation $organisation)
    {
        $response = Gate::inspect('view', $organisation);

        if ($response->allowed()) {
            $users = $this->getUsersForOrg($organisation->id);
            return Inertia::render('Organisations/Show', ['organisation' => $organisation, 'students' => $users]);
        } else {
            return back()->with('error', 'You are not authorised to view that page.');
        }
    }

    public function edit(Organisation $organisation)
    {
        $response = Gate::inspect('update', $organisation);

        if ($response->allowed()) {
            $users = $this->getUsersForOrg($organisation->id);
            return Inertia::render('Organisations/Edit', ['organisation' => $organisation, 'students' => $users]);
        } else {
            return back()->with('error', 'You are not authorised to edit that organisation.');
        }
    }

    public function update(Organisation $organisation, Request $request)
    {
        $attributes = $this->validateForm($request);
        if (!$attributes['lat'] || !$attributes['lng']) {
            $latLong = $this->getLatLong($attributes['postcode']);
            $attributes['lat'] = $latLong[0];
            $attributes['lng'] = $latLong[1];
        }
        $organisation->fill($attributes)->save();
        return Redirect::route('organisation.show', $organisation)->with('success', 'The organisation has been updated.');
    }

    private function validateForm($data)
    {
        return $data->validate([
            'name' => 'required',
            'contactFirstName' => 'required',
            'contactLastName' => 'required',
            'email' => 'required',
            'telephone' => 'required',
            'address1' => 'required',
            'address2' => 'nullable',
            'town' => 'required',
            'postcode' => ['required', new ValidPostcode],
            'country' => 'required',
            'lat' => 'nullable',
            'lng' => 'nullable'
        ]);
    }

    private function getLatLong($postcode)
    {
        $postcodeData = Http::get('https://api.postcodes.io/postcodes/' . $postcode);
        return [$postcodeData->json('result.latitude'), $postcodeData->json('result.longitude')];
    }

    public function destroy(Request $request)
    {
        $affectedUsers = User::whereIn('organisation_id', $request->organisations)->get();
        foreach ($affectedUsers as $affectedUser) {
            $affectedUser->organisation_id = null;
            $affectedUser->save();
            $affectedUser->roles()->detach(3);
        }
        Organisation::destroy($request->organisations);
        return to_route('organisations')->withSuccess('The organisations have been deleted.');
    }

    public function store(Request $request)
    {
        $response = Gate::inspect('create', Organisation::class);

        if ($response->allowed()) {
            $attributes = $this->validateForm($request);
            $latLong = $this->getLatLong($attributes['postcode']);
            $attributes['lat'] = $latLong[0];
            $attributes['lng'] = $latLong[1];
            $org = Organisation::create($attributes);
            if (User::firstWhere([
                'firstname' => $attributes['contactFirstName'],
                'surname' => $attributes['contactLastName'],
                'email' => $attributes['email'],
            ])) {
                return to_route('organisations')->with('error', 'That user already exists. Please carry out a user transfer before adding this user as admin.');
            }
            $admin = User::create([
                'firstname' => $attributes['contactFirstName'],
                'surname' => $attributes['contactLastName'],
                'email' => $attributes['email'],
                'password' => fake()->password,
                'organisation_id' => $org->id,
            ]);
            $admin->roles()->attach([2, 4]);
            return Redirect::route('organisations')->with('success', 'A new organisation has been created.');
        }
        return to_route('organisations')->with('error', 'You are not authorised to create organisations.');
    }

    public function create()
    {
        $response = Gate::inspect('create', Organisation::class);

        if ($response->allowed()) {
            return Inertia::render('Organisations/Create');
        }
        return back()->with('error', 'You are not authorised to create organisations.');
    }
}
