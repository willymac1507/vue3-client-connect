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

    /**
     * @param User $user
     * @return bool
     */
    public function admin(User $user): bool
    {
        return $user->hasRole('admin');
    }

    /**
     * @param User $user
     * @return bool
     */
    public function student(User $user): bool
    {
        return $user->hasRole('student');
    }

    /**
     * Determine whether the user can search for a booking
     * @param User $user
     * @return bool
     */
    public function search(User $user): bool
    {
        return $user->hasRole('client');
    }

    /**
     * Determine whether the user can view all user models.
     * @param User $user
     * @return bool
     */
    public function viewAny(User $user): bool
    {
        return $user->hasRole('superUser');
    }

    /**
     * Determine whether the user can view the user model.
     * @param User $user
     * @param User $model
     * @return bool
     */
    public function view(User $user, User $model): bool
    {
        return ($user->organisation_id === $model->organisation_id && $user->hasRole('admin')) || $user->hasRole('superUser');
    }

    /**
     * Determine whether the user can edit the user model.
     * @param User $user
     * @param User $model
     * @return bool
     */
    public function edit(User $user, User $model): bool
    {
        return ($user->organisation_id === $model->organisation_id && $user->hasRole('admin')) || $user->hasRole('superUser');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, User $model): bool
    {
        return ($user->organisation_id === $model->organisation_id && $user->hasRole('admin')) || $user->hasRole('superUser');
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
