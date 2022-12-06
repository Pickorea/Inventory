<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShareStockTakesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('share_stock_takes', function (Blueprint $table) {
            $table->id();
            // $table->integer('status_id')->unsigned();
            $table->integer('asset_id')->unsigned();
            $table->integer('stock_take_id')->unsigned();
            $table->integer('quantity');
            $table->integer('defects')->comments('number of items defects'); 
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
        Schema::dropIfExists('share_stock_takes');
    }
}
