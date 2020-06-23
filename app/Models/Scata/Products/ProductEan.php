<?php

namespace App\Models\Scata\Products;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductEan extends Model
{

    use SoftDeletes;

    protected $table = 'product_eans';
    protected $primaryKey = 'ean_id';

    protected $fillable = [
        'ean'
    ];

    public function product() {

        return $this->hasOne(Product::class, 'product_id', 'product_id');

    }

}
