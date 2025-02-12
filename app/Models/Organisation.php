<?php

namespace App\Models;

use Database\Factories\OrganisationFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Organisation extends Model
{
    /** @use HasFactory<OrganisationFactory> */
    use HasFactory;
    use SoftDeletes;

    public $guarded = false;

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
