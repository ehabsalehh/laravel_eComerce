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
            $table->float("original_price");
            $table->float("selling_price");
            $table->string('photo');
            $table->integer('quantity');
            $table->integer('tax');
            $table->enum('popular',['popular','unpopular'])->default('unpopular');
            $table->enum('status',['active','inactive'])->default('inactive');
            $table->foreignId('category_id')->constrained('categories');
            $table->mediumText("meta_title")->nullable();
            $table->mediumText("meta_description")->nullable();
            $table->mediumText("meta_keywords")->nullable();
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
