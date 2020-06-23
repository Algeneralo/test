<?php

namespace App\Models\ScataOld;

use Illuminate\Database\Eloquent\Model;

class ProductName extends Model
{

    protected $connection = "scata";

    protected $table = "product_names";

    protected $hidden = [
        'product'
    ];

}
