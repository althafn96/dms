<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddVehicleColumnToCourierDriversTable extends Migration
{
    public function up()
    {
        Schema::table('courier_drivers', function (Blueprint $table) {
            $table->string('vehicle')->nullable();
        });
    }

    public function down()
    {
        Schema::table('courier_drivers', function (Blueprint $table) {
            $table->dropColumn('vehicle');
        });
    }
}
