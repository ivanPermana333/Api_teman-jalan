<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('teman_id')->unsigned();
            $table->date('date');
            $table->string('available')->default('false');
            $table->string('reason');
            $table->timestamps();

            $table->foreign('teman_id')->references('id')->on('temans');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {   
      Schema::table('schedules', function(Blueprint $table){
            $table->dropForeign('schedules_teman_id_foreign');
        });
        Schema::dropIfExists('schedules');
    }
}
