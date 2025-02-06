<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ServiceController extends Controller
{
    public function edit()
    {
        return Inertia::render('Services/Edit', ['services' => Service::get()]);
    }

    public function update(Request $request)
    {
        $user = User::find($request->user_id);
        $servicesSelected = array_column($request->services, 'id');
        foreach ($servicesSelected as $service) {
            $user->services()->sync($servicesSelected);
        }
        return redirect('/')->with('success', 'Your services have been updated.');

    }
}
