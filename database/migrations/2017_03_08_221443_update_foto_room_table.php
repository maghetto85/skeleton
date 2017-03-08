<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateFotoRoomTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('camere_foto', function (Blueprint $table) {
            $table->dropPrimary();
            $table->dropColumn('idfoto');
        });

        Schema::table('camere_foto', function (Blueprint $table) {
            $table->increments('id')->first();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('camere_foto', function (Blueprint $table) {
            $table->removeColumn('id');
        });
        Schema::table('camere_foto', function (Blueprint $table) {
            $table->primary(['idcamera','idfoto']);
        });

    }
}
