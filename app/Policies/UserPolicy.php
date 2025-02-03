<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function superAdmin(User $user): bool
    {
        return $user->hasRole('superUser');
    }

    public function admin(User $user): bool
    {
        return $user->hasRole('admin');
    }

    public function student(User $user): bool
    {
        return $user->hasRole('student');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function edit(User $user, User $model): bool
    {
        return $user->organisation_id === $model->organisation_id;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, User $model): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, User $model): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, User $model): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, User $model): bool
    {
        return false;
    }
}
