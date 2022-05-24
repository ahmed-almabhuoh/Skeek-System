<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUnderlineTypeToSheeksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sheeks', function (Blueprint $table) {
            //
            $table->enum('underline_type', ['1', '2', '3'])->default('1')->after('type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sheeks', function (Blueprint $table) {
            //
            $table->dropColumn('underline_type');
        });
    }
}
