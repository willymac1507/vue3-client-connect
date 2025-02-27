<?php

namespace App\Traits;

use App\Models\Organisation;
use Illuminate\Database\Eloquent\Collection;
use LaravelIdea\Helper\App\Models\_IH_Organisation_C;

trait Organisations
{
    public function getAllOrganisations(): Collection|array|_IH_Organisation_C
    {
        return Organisation::orderBy('name')->get();
    }
}
