<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateAdminTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id('admin_id');
            $table->string('firstname', 100);
            $table->string('lastname', 100);
            $table->string('company')->nullable();
            $table->string('phone_private',25)->nullable();
            $table->string('phone_mobile',25)->nullable();
            $table->string('sip',25)->nullable();
            $table->string('email')->unique();
            $table->string('password')->mullable();
            $table->char('lang', 2);
            $table->boolean('status')->default(false);
            $table->integer('group_id')->unsigned()->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('admin_groups', function (Blueprint $table) {
            $table->id('group_id');
            $table->string('name', 100);
            $table->integer('supervisor_id')->unsigned()->nullable();
            $table->string('logo')->nullable();
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
        Schema::dropIfExists('admins');
        Schema::dropIfExists('admin_groups');
    }
}
