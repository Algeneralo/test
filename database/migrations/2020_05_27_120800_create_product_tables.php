<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {

            $table->id('product_id');

            $table->set('type', ['food','cosmetics','cleanser','drugs','feed'])->nullable();
            $table->enum('status', ['active','inactive','err','blocked','update', 'creating']);

            $table->double('netcontentVal', 16,2)->nullable();
            $table->string('netcontentUnit', 3)->nullable();
            $table->double('grossweightVal', 16,2)->nullable();
            $table->string('grossweightUnit', 3)->nullable();
            $table->double('netweightVal', 16,2)->nullable();
            $table->string('netweightUnit', 3)->nullable();

            $table->string('product_name')->nullable();
            $table->string('product_url')->nullable();
            $table->string('regulated_name')->nullable();
            $table->string('ingredienz_text_orig')->nullable();
            $table->string('src_type')->nullable();

            $table->unsignedBigInteger('shop_id')->nullable();
            $table->string('pzn')->nullable();
            $table->unsignedBigInteger('bot_id')->nullable();
            $table->string('bot_scan_source')->nullable();
            $table->boolean('isscata')->default(false);
            $table->unsignedBigInteger('admin_id')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('shop_id')->references('shop_id')->on('shops');
        });

        Schema::create('product_eans', function (Blueprint $table) {
            $table->id('ean_id');
            $table->string('ean');
            $table->unsignedBigInteger('product_id')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('product_id')->references('product_id')->on('products');
        });

        Schema::create('product_images', function (Blueprint $table) {
            $table->unsignedBigInteger('product_id');
            $table->enum('type', ['ean', 'ingredients_1', 'ingredients_2', 'ingredients_3', 'nutrients_1', 'nutrients_2', 'nutrients_3', 'product', 'photo', 'company', 'qualitySealer_1', 'qualitySealer_2']);
            $table->string('extension');
            $table->boolean('checked')->default(false);
            $table->boolean('hidden')->default(false);
            $table->integer('pro')->nullable();
            $table->string('original_url')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->primary(['product_id', 'type']);
            $table->foreign('product_id')->references('product_id')->on('products');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_tables');
    }
}
