<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
use LaravelIdea\Helper\App\Models\_IH_User_C;

trait Users
{
    public function getUsersForOrg($organisation): \Illuminate\Contracts\Pagination\LengthAwarePaginator|array|_IH_User_C|LengthAwarePaginator
    {
        return User::where('organisation_id', $organisation)
            ->with('roles')
            ->orderBy('surname')
            ->paginate(5)->all();
    }
}
