<?php

namespace App\Models\ScataOld;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{

    protected $connection = "scata";

    protected $table = "product_pics";

    public $timestamps = false;

    protected $appends = [
        'url'
    ];

    protected $hidden = [
        'id',
        'product',
        'time',
        'prio',
        'pic'
    ];

    protected $fillable = [
        'ocr'
    ];

    public function getUrlAttribute() {

        return 'https://scata-app.cdemo.me/api/pics/scata/' . $this->pic;

    }

}
