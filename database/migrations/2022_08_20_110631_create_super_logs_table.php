<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuperLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('super_logs', function (Blueprint $table) {
            $table->id();
            $table->string('ip', 20);
            $table->string('action', 100);
            $table->string('device')->nullable();
            $table->string('os', 20)->nullable();
            $table->string('browser', 20)->nullable();
            $table->boolean('isDesktop');
            $table->boolean('isTablet');
            $table->boolean('isPhone');
            $table->boolean('isRobot');
            $table->string('browser_version')->nullable();
            $table->string('platform_version')->nullable();

            // User Foreign ID
            $table->foreignId('super_id');
            $table->foreign('super_id')->on('supers')->references('id');
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
        Schema::dropIfExists('super_logs');
    }
}
