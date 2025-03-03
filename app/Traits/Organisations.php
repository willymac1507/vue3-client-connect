<?php

namespace App\Traits;

use App\Models\Organisation;
use Illuminate\Database\Eloquent\Collection;
use LaravelIdea\Helper\App\Models\_IH_Organisation_C;

trait Organisations
{
    /**
     * @return Collection|array|_IH_Organisation_C
     */
    public function getAllOrganisations(): Collection|array|_IH_Organisation_C
    {
        return Organisation::orderBy('name')->get();
    }

    /**
     * @param $id
     * @return \Illuminate\Support\Collection
     */
    public function getAdminOrganisation($id): \Illuminate\Support\Collection
    {
        return collect(Organisation::findOrFail($id))->only(['id', 'name']);
    }
}
