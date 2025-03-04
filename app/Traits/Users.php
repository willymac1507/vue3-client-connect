<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
use LaravelIdea\Helper\App\Models\_IH_User_C;

trait Users
{
    public function getUsersForOrg($organisation): \Illuminate\Contracts\Pagination\LengthAwarePaginator|array|_IH_User_C|LengthAwarePaginator
    {
        return User::query()
            ->with('roles')
            ->where('organisation_id', $organisation)
            ->orderBy('surname')
            ->paginate(5)
            ->through(fn($user) => [
                'id' => $user->id,
                'full_name' => $user->full_name,
                'roles' => $user->roles->pluck('role')
            ]);
    }
}
