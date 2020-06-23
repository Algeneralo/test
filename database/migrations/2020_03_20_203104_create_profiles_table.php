<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_profiles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('scannelid');
            $table->string('firstname');
            $table->string('lastname');
            $table->enum('gender', ['male', 'female', 'other']);
            $table->string('date_of_birth');
            $table->string('phone')->nullable();
            $table->double('height', 8, 2)->nullable();
            $table->double('bodyweight', 8, 2)->nullable();
            $table->boolean('allergic')->default(false);
            $table->boolean('incompatibilities')->default(false);
            $table->boolean('main')->default(false);
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('app_users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiles');
    }
}
