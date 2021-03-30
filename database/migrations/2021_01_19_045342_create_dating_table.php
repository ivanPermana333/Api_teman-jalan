<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dating', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned();
            $table->integer('teman_id')->unsigned();
            $table->string('teamReq');
            $table->string('teamAcc')->nullable();
            $table->date('date');
            $table->enum('status', ["WAITING", "ACCEPT"])->default("WAITING");
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('dating');
        // Schema::table('dating', function(Blueprint $table){
        //     $table->dropForeign('dating_user_id_foreign');
        //     $table->dropForeign('dating_teman_id_foreign');
        // });
    }
}
