<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCountryIdToStaticBankTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('static_bank', function (Blueprint $table) {
            //
            $table->foreignId('country_id');
            $table->foreign('country_id')->on('static_countries')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('static_bank', function (Blueprint $table) {
            //
            $table->dropForeign('country_id');
        });
    }
}
