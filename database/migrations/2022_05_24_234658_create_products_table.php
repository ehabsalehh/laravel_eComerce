<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->string("name");
            $table->string("slug")->unique();
            $table->mediumText("small_description")->nullable();
            $table->longText("description")->nullable();
            $table->float("price");
            $table->string('size')->default('M')->nullable();
            $table->string('color')->nullable();
            $table->integer('tax');
            $table->enum('status',['active','inactive'])->default('inactive');
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('child_category_id')->nullable();
            $table->unsignedBigInteger('supplier_id')->nullable();
            $table->unsignedBigInteger('brand_id')->nullable();
            $table->unsignedBigInteger('discount_id')->nullable();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('SET NULL');
            $table->foreign('child_category_id')->references('id')->on('categories')->onDelete('SET NULL');
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('SET NULL');
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('SET NULL');
            $table->foreign('discount_id')->references('id')->on('discounts')->onDelete('SET NULL');
            $table->softDeletes();
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
};
