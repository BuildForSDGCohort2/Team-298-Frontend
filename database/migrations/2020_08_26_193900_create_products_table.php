<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->float('price');
            $table->string('discount');
            $table->enum('discount_type', ['price', 'percentage']);
            $table->string('sku')->nullable();
            $table->jsonb('collection_id')->nullable();
            $table->longText('description');
            $table->integer('category_id');
            $table->string('status');
            $table->string('seo_title')->nullable();
            $table->longText('seo_description')->nullable();
            $table->string('social_title')->nullable();
            $table->longText('social_description')->nullable();
            $table->jsonb('sizes')->nullable();
            $table->jsonb('materials')->nullable();
            $table->jsonb('colors')->nullable();
            $table->bigInteger('user_id')->unsigned()->index()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('products');
    }
}
