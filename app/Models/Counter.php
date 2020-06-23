<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Counter extends Model
{

    protected $table = 'counter';

    protected $fillable = [
        'name',
        'value'
    ];

    public static function getCounter($name)
    {

        return Counter::where('name', $name)->first();

    }

    public function incrementCounter() {

        $this->value = $this->value + 1;
        $this->save();

        return $this->value;

    }

}
