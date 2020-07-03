<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSplitPageSeedToPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table("pages")->insert([
            [
                "name" => "ingredients_split_food",
                "displayed_name" => "(Ingredienz) Lebensmittel Splitten",
            ],
            [
                "name" => "ingredients_split_cosmetics",
                "displayed_name" => "(Ingredienz) Kosmetika Splitten",
            ],
            [
                "name" => "ingredients_split_feed",
                "displayed_name" => "(Ingredienz) Futtermittel Splitten",
            ],
            [
                "name" => "ingredients_split_cleanser",
                "displayed_name" => "(Ingredienz) Reinigungsmittel Splitten",
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
