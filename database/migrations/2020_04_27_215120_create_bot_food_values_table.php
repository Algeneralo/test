<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBotFoodValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bot_food_values', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('unit');
            $table->string('value');
            $table->string('measurement_precision');
            $table->string('ean');
            $table->string('source');
            /*
             * It is not common to create manuel timetamps in laravel. For created you should use $table->timestamps(), that will create one for updated_at and created_at. These Timestamps are
             * automatical handled by the module. You don't have to do anything.
             */
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bot_food_values');
    }
}
