<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserLoginsTable extends Migration
{

    public function up()
    {
        Schema::create('user_logins', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->string('email');
            $table->string('password');
            $table->integer('status')->default('1');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('user_logins');
    }
}
