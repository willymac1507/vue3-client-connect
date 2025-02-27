<?php // routes/breadcrumbs.php

use App\Models\Organisation;
use App\Models\User;
use Diglactic\Breadcrumbs\Exceptions\DuplicateBreadcrumbException;

try {
    Breadcrumbs::for('home', function ($trail) {
        $trail->push('Home', route('dashboard'));
    });
} catch (DuplicateBreadcrumbException $e) {

}

// Home > Organisation
try {
    Breadcrumbs::for('organisation.show', function ($trail, Organisation $organisation) {
        $trail->parent('home');
        $trail->push('Organisation', route('organisation.show', $organisation));
    });
} catch (DuplicateBreadcrumbException $e) {

}

// Home > Organisation > Student
try {
    Breadcrumbs::for('user.show', function ($trail, User $user) {
        $trail->parent('organisation.show', $user->organisation);
        $trail->push('Student', route('user.show', $user));
    });
} catch (DuplicateBreadcrumbException $e) {

}
