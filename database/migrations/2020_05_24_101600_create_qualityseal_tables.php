<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQualitysealTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quality_seals', function (Blueprint $table) {
            $table->id('id');
            $table->string('name')->unique();
            $table->string('logo')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('hasQualitySeals', function (Blueprint $table) {
            $table->unsignedBigInteger('quality_seal_id');
            $table->morphs('hasQualitySeal');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quality_seals');
        Schema::dropIfExists('hasQualitySeals');
    }
}
