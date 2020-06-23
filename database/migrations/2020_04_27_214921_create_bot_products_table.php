<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBotProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bot_products', function (Blueprint $table) {
            $table->id();
            $table->string('ean');
            $table->string('pzn');
            $table->string('regulated_name');
            $table->string('display_name');
            $table->string('company');
            $table->string('ingredients');
            $table->string('source');
            $table->string('product_url');
            $table->string('productType');
            $table->timestamp('creation_date')->nullable();
            $table->string('img_url');
            $table->string('allergen_notes');
            $table->string('md5');
            $table->string('nutriScore');
            $table->string('enthaelt');
            $table->string('picturePathLocal');
            $table->timestamp('transfer')->nullable();
            $table->string('status');
            /*
             * It is not common to create manuel timetamps in laravel. For created you should use $table->timestamps(), that will create one for updated_at and created_at. These Timestamps are
             * automatical handled by the module. You don't have to do anything.
             *
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
        Schema::dropIfExists('bot_products');
    }
}
