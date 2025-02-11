<?php // routes/breadcrumbs.php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.
use App\Models\Organisation;
use App\Models\User;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.

// Home
Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Home', route('dashboard'));
});

// Home > Organisation
Breadcrumbs::for('organisation.show', function (BreadcrumbTrail $trail, Organisation $organisation) {
    $trail->parent('home');
    $trail->push('Organisation', route('organisation.show', $organisation));
});

// Home > Organisation > Student
Breadcrumbs::for('user.show', function (BreadcrumbTrail $trail, User $user) {
    $trail->parent('organisation.show', $user->organisation);
    $trail->push('Student', route('user.show', $user));
});
