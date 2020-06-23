<?php

namespace App\Models\Scata;

use App\Models\Scata\Products\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Shop extends Model
{

    use SoftDeletes;

    protected $table = 'shops';
    protected $primaryKey = 'shop_id';

    protected $fillable = [
        'name',
        'street',
        'zipcode',
        'city',
        'country',
        'active'
    ];

    // Products

    public function products() {

        return $this->hasMany(Product::class, 'shop_id', 'shop_id');

    }

}
