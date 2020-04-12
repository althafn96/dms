<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsAvailableColumnToProductsTable extends Migration
{
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->integer('is_available')->default('1')->comment('1. in stock, 2. reached minimum qty, 0. out of stock');
            $table->string('min_qty')->nullable();
        });
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('is_available');
            $table->dropColumn('min_qty');
        });
    }
}
