<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManualOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manual_order_items', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('manual_order_id');
            $table->foreign('manual_order_id')->references('id')
                ->on('manual_orders')->onDelete('cascade');

            $table->unsignedBigInteger('list_stock_id');
            $table->foreign('list_stock_id')->references('id')
                ->on('list_stocks')->onDelete('cascade')->nullable();

            $table->enum('status',[
                // '',
                'Pre-Order',
                'Ready To Print',
                'Ready To Ship'
            ]);
                
            $table->integer('amount');

            $table->string('image')->nullable();
            
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
        Schema::dropIfExists('manual_order_items');
    }
}
