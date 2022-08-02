<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCurrancyIdToStaticBankTable extends Migration
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
            $table->foreignId('currancy_id');
            $table->foreign('currancy_id')->on('currancies')->references('id');
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
            $table->dropForeign('currancy_id');
        });
    }
}
