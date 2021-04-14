<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('list_stocks', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('phone_type_id');
            $table->foreign('phone_type_id')->references('id')
                ->on('phone_types')->onDelete('cascade');

            $table->unsignedBigInteger('case_type_id');
            $table->foreign('case_type_id')->references('id')
                ->on('case_types')->onDelete('cascade');

            $table->integer('stock');

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
        Schema::dropIfExists('list_stocks');
    }
}
