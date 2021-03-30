<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTemansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temans', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('umur');
            $table->string('username');
          $table->string('picture');
          $table->string('address');
          $table->string('location');
          $table->string('open');
          $table->string('close');
          $table->integer('price');
          $table->string('email');
          $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
          $table->rememberToken();
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
        Schema::dropIfExists('temans');
    }
}
