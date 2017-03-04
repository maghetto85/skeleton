<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateFotoHomeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fotohome', function (Blueprint $table) {
            $table->increments('id')->change();
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
        Schema::table('fotohome', function (Blueprint $table) {
            $table->dropColumn('lang');
            $table->dropTimestamps();
        });
    }
}
