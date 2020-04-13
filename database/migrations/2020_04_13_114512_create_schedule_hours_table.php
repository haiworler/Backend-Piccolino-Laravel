<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScheduleHoursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedule_hours', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('hour_id');
            $table->unsignedBigInteger('people_id')->nullable();
            $table->unsignedBigInteger('subject_id')->nullable();
            $table->unsignedBigInteger('schedule_day_id');
            $table->unsignedBigInteger('headquarter_id');

            $table->boolean('enabled')->default(true);
           // $table->softDeletes();
            $table->timestamps();
        });
        Schema::table('schedule_hours', function (Blueprint $table) {
            $table->foreign('hour_id')->references('id')->on('hours');
            $table->foreign('people_id')->references('id')->on('people');
            $table->foreign('subject_id')->references('id')->on('subjects');
            $table->foreign('schedule_day_id')->references('id')->on('schedule_days');
            $table->foreign('headquarter_id')->references('id')->on('headquarters');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedule_hours');
    }
}
