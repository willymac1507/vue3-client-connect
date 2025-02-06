<?php

namespace App\Http\Controllers;

use App\Models\Organisation;
use Inertia\Inertia;

class SearchController extends Controller
{
    public function search()
    {
        return Inertia::render('Search/Search', [
            'organisations' => Organisation::all()
        ]);
    }
}
