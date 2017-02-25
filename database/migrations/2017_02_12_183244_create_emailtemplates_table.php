<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmailtemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emailtemplates', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug')->unique();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('emailtemplate_locale', function(Blueprint $table) {
            $table->integer('emailtemplate_id')->unsigned();
            $table->integer('locale_id')->unsigned();
            $table->string('subject')->nullable();
            $table->string('body');
            $table->string('bodyhtml');
            $table->foreign('emailtemplate_id')->references('id')->on('emailtemplates')->onDelete('cascade');
            $table->foreign('locale_id')->references('id')->on('locales')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfdExists('emailtemplate_locale');
        Schema::dropIfdExists('emailtemplates');
    }
}
