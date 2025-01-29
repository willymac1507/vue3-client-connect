<?php

namespace App\Traits;

use App\Models\Organisation;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use LaravelIdea\Helper\App\Models\_IH_User_C;

trait Contacts
{
    public function getLinkedContacts(User $user): Collection|array|_IH_User_C
    {
        $clientContacts = $user->clientContacts;
        $orgContacts = Organisation::find($user->organisation_id)->users()->whereNot('id', $user->id)->get();
        return $orgContacts->merge($clientContacts);
    }
}
