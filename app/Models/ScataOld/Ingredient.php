<?php

namespace App\Models\ScataOld;

use App\Models\Scannel\Profile;
use App\Models\Scannel\AppUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Ingredient extends Model
{

    protected $connection = "scata";

    protected $table = "ingredients";

    protected $fillable = [
        'name',
        'slug'
    ];

    protected $casts = [
        'name' => 'array'
    ];


}
