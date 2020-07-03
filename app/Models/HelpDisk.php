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
        {
            $pattern = '/(<img\s?)(src=")([^"]*)(")([^>]*)(>)/';
            $result = "";
            preg_match_all($pattern, $data->details, $matches);
            if (isset($matches[0])) {
                for ($i = 0; $i < count($matches[0]); $i++) {
                    $split = preg_split($pattern, $data->details, -1, PREG_SPLIT_NO_EMPTY);
                    $result .= $split[0] . '<a class="image-link" data-lightbox="image-1" href="' . $matches[3][$i] . '">' . $matches[0][$i] . '</a>' . $split[1];
                }
            }
            if ($result != "")
                $data->details = $result;
            view()->share("helpDiskData", $data);
        }
    }
}
