<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdatePagineLangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("ALTER TABLE pagine MODIFY lang VARCHAR(2) NOT NULL DEFAULT 'it'");
        Schema::table('pagine', function (Blueprint $table) {
            $table->string('lang',2)->default('it')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pagine', function (Blueprint $table) {
            $table->enum('lang',['it','en'])->change();
        });
    }
}
