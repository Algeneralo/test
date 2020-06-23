<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIngredientTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingredients', function (Blueprint $table) {
            $table->id('id');
            $table->string('slug');
            $table->set('type', ['food','cosmetics','cleanser','drugs','feed'])->nullable();
            $table->string('description', 999)->nullable();
            $table->text('name')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('hasIngredients', function (Blueprint $table) {
            $table->unsignedBigInteger('ingredient_id');
            $table->morphs('hasingredient');
        });

        Schema::create('hasAliases', function (Blueprint $table) {
            $table->unsignedBigInteger('ingredient_id');
            $table->morphs('hasAliase');
        });

        Schema::create('hasIngredientGroups', function (Blueprint $table) {
            $table->unsignedBigInteger('ingredient_group_id');
            $table->morphs('hasIngredientGroup');
        });

        Schema::create('ingredient_groups', function (Blueprint $table) {
            $table->id('id');
            $table->text('slug');
            $table->text('name');
            $table->unsignedBigInteger('parentid')->nullable();
            $table->set('type', ['food','cosmetics','cleanser','drugs','feed'])->nullable();
            $table->string('description', 999)->nullable();
            $table->timestamps();
        });

        Schema::create('autocorrection_ignore_ingredient', function (Blueprint $table) {
            $table->id('id');
            $table->text('slug');
            $table->timestamps();
        });
        Schema::create('autocorrection_editfromto_ingredient', function (Blueprint $table) {
            $table->id('id');
            $table->text('from');
            $table->text('to');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ingredients');
        Schema::dropIfExists('hasIngredients');
        Schema::dropIfExists('hasAliases');
        Schema::dropIfExists('hasIngredientGroups');
        Schema::dropIfExists('ingredient_groups');
    }
}
