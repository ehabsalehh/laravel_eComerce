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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->unique();
            $table->enum('status',['new','process','delivered','cancel'])->default('new');
            $table->decimal('sub_total')->nullable();
            $table->decimal('total_discount')->nullable();
            $table->decimal('total');
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->unsignedBigInteger('shipping_id')->nullable();
            $table->unsignedBigInteger('employee_id')->nullable();
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('SET NULL');            
            $table->foreign('shipping_id')->references('id')->on('shippings')->onDelete('SET NULL');
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('SET NULL');
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
        Schema::dropIfExists('orders');
    }
};
