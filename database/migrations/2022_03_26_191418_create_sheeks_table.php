<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSheeksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sheeks', function (Blueprint $table) {
            $table->id();
            $table->string('beneficiary_name');
            $table->double('amount')->unsigned();
            $table->string('currancy');
            $table->string('desc')->nullable();
            $table->enum('type', ['paid', 'recived']);
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
        Schema::dropIfExists('sheeks');
    }
}
