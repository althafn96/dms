<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusColumnToCourierDriversTable extends Migration
{
    public function up()
    {
        Schema::table('courier_drivers', function (Blueprint $table) {
            $table->integer('status')->default('1');
            $table->integer('is_deleted')->default('0');
        });
    }

    public function down()
    {
        Schema::table('courier_drivers', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->dropColumn('is_deleted');
        });
    }
}
