<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourierDriversTable extends Migration
{
    public function up()
    {
        Schema::create('courier_drivers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('courier_id')->nullable();
            $table->bigInteger('user_id')->nullable();
            $table->string('vehicle_num')->nullable();
            $table->string('nic')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('courier_drivers');
    }
}
