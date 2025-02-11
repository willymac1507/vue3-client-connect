<?php

namespace App\Http\Controllers;

use App\Models\Organisation;
use App\Rules\ValidPostcode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class OrganisationController extends Controller
{
    public function index()
    {
        $response = Gate::inspect('viewAny', Organisation::class);

        if ($response->allowed()) {
            return Inertia::render('Organisations/Index', ['organisations' => Organisation::all()]);
        } else {
            return back();
        }
    }

    public function show(Request $request, Organisation $organisation)
    {
        $response = Gate::inspect('view', $organisation);

        if ($response->allowed()) {
            return Inertia::render('Organisations/Show', ['organisation' => $organisation, 'students' => $organisation->users]);
        } else {
            return back()->with('error', 'You are not authorised to view that page.');
        }
    }

    public function store(Request $request)
    {
        $response = Gate::inspect('create', Organisation::class);

        if ($response->allowed()) {
            $attributes = $request->validate([
                'name' => 'required',
                'contact' => 'required',
                'email' => 'required',
                'telephone' => 'required',
                'address1' => 'required',
                'address2' => 'nullable',
                'town' => 'required',
                'postcode' => ['required', new ValidPostcode],
                'country' => 'required'
            ]);
            $postcodeData = Http::get('https://api.postcodes.io/postcodes/' . $attributes['postcode']);
            $attributes['lat'] = $postcodeData->json('result.latitude');
            $attributes['lng'] = $postcodeData->json('result.longitude');
            Organisation::create($attributes);
            return Redirect::route('organisations')->with('success', 'A new organisation has been created.');
        }
        return back()->with('error', 'You are not authorised to create organisations.');
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
