<?php

namespace App\Models\Scata;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class QualitySeal extends Model
{

    use SoftDeletes;

    protected $table = 'quality_seals';

    protected $fillable = [
        'name',
        'logo',
        'description'
    ];

    protected $appends = [
        'logoUrl'
    ];

    public function getLogoUrlAttribute() {

        if($this->logo) {

            return url(Storage::disk('qualityseals')->url($this->logo)) . '?updated=' . Carbon::parse($this->updated_at)->format('YmdHis');

        }

        return false;

    }

}
