<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HelpDisk extends Model
{
    protected $fillable = ["details", "page_id"];

    public function page()
    {
        return $this->belongsTo(Page::class);
    }

    /**
     * Check if current view/request has a help disk
     *
     * @param $name
     */
    public static function checkIfExists($name)
    {
        $data = self::query()->whereHas("page", function ($query) use ($name) {
            $query->where("name", $name);
        })->first();
        if ($data)
            view()->share("helpDiskData", $data);
    }
}
