<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PenesuaianTableTemans extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('temans', function (Blueprint $table) {
          $table->string("roles");
          $table->string("token")->nullable();
          $table->enum("status", ["ACTIVE", "INACTIVE"])->default("ACTIVE");
          
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('temans', function (Blueprint $table) {
            $table->dropColumn("roles");
            $table->dropColumn("token");
            $table->dropColumn("status");
        });
    }
}
