<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManualOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manual_orders', function (Blueprint $table) {
            $table->id();

            $table->string('code_order');

            $table->string('name');

            $table->string('address');

            $table->string('contact');

            $table->unsignedBigInteger('order_source_id');
            $table->foreign('order_source_id')->references('id')
                ->on('order_sources')->onDelete('cascade');


            $table->unsignedBigInteger('payment_method_id');
            $table->foreign('payment_method_id')->references('id')
                ->on('payment_methods')->onDelete('cascade');

            
            $table->unsignedBigInteger('shipping_method_id');
            $table->foreign('shipping_method_id')->references('id')
                ->on('shipping_methods')->onDelete('cascade');

            $table->enum('shipping_fee',['Paid Off','COD']);

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')
                ->on('users')->onDelete('cascade');

            $table->string('receipt_number')->nullable();
            
            $table->text('note')->nullable();

            $table->enum('status',['No Items Yet','On Progress','Ready To Ship','Done']);

            $table->date('date_create');

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
        Schema::dropIfExists('manual_orders');
    }
}
