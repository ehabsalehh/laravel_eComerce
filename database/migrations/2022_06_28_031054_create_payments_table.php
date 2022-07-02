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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->float('amount');
            $table->enum('method',['cod','paypal'])->default('cod');
            $table->enum('status',['paid','unpaid'])->default('unpaid');
            $table->unsignedBigInteger('order_id')->nullable();
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->unsignedBigInteger('employee_id')->nullable();
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('SET NULL');            
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('SET NULL');            
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
        Schema::dropIfExists('payments');
    }
};
