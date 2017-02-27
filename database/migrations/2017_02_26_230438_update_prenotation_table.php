<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdatePrenotationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('prenotazioni', function (Blueprint $table) {
            $table->timestamp('data_conferma_disp')->nullable();
            $table->timestamp('data_conferma_prenotazione')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('prenotazioni', function (Blueprint $table) {
            $table->dropColumn('data_conferma_disp');
            $table->dropColumn('data_conferma_prenotazione');
        });
    }
}
