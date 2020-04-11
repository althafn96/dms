<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourierDriversTempTable extends Migration
{

    public function up()
    {
        Schema::create('courier_drivers_temp', function (Blueprint $table) {
            $table->id();
            $table->string('driver_name')->nullable();
            $table->string('vehicle')->nullable();
            $table->string('vehicle_num')->nullable();
            $table->string('nic')->nullable();
            $table->bigInteger('added_user_id')->nullable();
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('courier_drivers_temp');
    }
}
