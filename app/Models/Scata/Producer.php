<?php

namespace App\Models\Scata;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Producer extends Model
{

    use SoftDeletes;

    protected $table = 'producers';

    protected $fillable = [
        'gln',
        'provides_data',
        'provides_data_vip',
        'name',
        'street',
        'zipcode',
        'city',
        'phone',
        'fax',
        'email',
        'website'
    ];

}
