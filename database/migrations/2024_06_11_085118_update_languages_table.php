<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('languages_ingredient', function (Blueprint $table) {
            $table->string('title');
        });
        Schema::table('languages_tag', function (Blueprint $table) {
            $table->string('title');
        });
        Schema::table('languages_category', function (Blueprint $table) {
            $table->string('title');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('language_ingredient,language_tag,language_category', function (Blueprint $table) {
            
        });
    }
}
