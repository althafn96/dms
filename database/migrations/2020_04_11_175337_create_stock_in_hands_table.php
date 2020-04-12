<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockInHandsTable extends Migration
{
    public function up()
    {
        Schema::create('stock_in_hands', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('product_id');
            $table->string('stock_qty');
            $table->bigInteger('added_user_id');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('stock_in_hands');
    }
}
