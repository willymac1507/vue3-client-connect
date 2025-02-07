<?php

namespace App\Http\Controllers;

use App\Models\Organisation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
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
}
