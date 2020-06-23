<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNutrientTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nutrient_groups', function (Blueprint $table) {
            $table->id('group_id');
            $table->unsignedBigInteger('product_id');
            $table->enum('preparationstate', ['PREPARED','UNPREPARED']);
            $table->double('servingsizeVal', 16,2);
            $table->string('servingsizeUnit', 3);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('product_id')->references('product_id')->on('products');

        });

        Schema::create('group_nutrients', function (Blueprint $table) {
            $table->unsignedBigInteger('group_id');
            $table->string('nutrient', 7);
            $table->enum('precision', ['APPROXIMATELY','EXACT','LESS_THAN','']);
            $table->double('val', 16,2);
            $table->string('unit', 3);
            $table->timestamps();
            $table->softDeletes();

            $table->primary(['group_id', 'nutrient']);
            $table->foreign('group_id')->references('group_id')->on('nutrient_groups');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nutrient_groups');
        Schema::dropIfExists('group_nutrients');
    }
}
