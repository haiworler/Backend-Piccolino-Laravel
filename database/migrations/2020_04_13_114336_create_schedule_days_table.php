<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScheduleDaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedule_days', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->unsignedBigInteger('group_id');
            $table->unsignedBigInteger('day_id');
            $table->boolean('enabled')->default(true);
            //$table->softDeletes();
            $table->timestamps();
        });
        Schema::table('schedule_days', function (Blueprint $table) {
            $table->foreign('group_id')->references('id')->on('groups');
            $table->foreign('day_id')->references('id')->on('days');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedule_days');
    }
}
