<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermissionGroups extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permission_groups', function (Blueprint $table) {
            $table->id('permission_group_id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('permission_group_permissions', function (Blueprint $table) {
            $table->unsignedBigInteger('permission_group_id');
            $table->unsignedBigInteger('permission_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permission_groups');
        Schema::dropIfExists('permission_group_permissions');
    }
}
