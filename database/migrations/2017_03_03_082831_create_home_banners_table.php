<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHomeBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('homebanner', function (Blueprint $table) {
            $table->increments('id')->first();
            $table->string('lang',2)->default('it')->after('id');
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
        Schema::table('homebanner', function (Blueprint $table) {
            $table->dropColumn('id','lang');
            $table->dropTimestamps();
        });
    }
}
