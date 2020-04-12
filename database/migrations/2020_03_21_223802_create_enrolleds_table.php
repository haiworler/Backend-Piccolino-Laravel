<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnrolledsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enrolleds', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('people_id');
            $table->string('code')->nullable();
            $table->unsignedBigInteger('headquarter_id');
            $table->decimal('cost',30,2);
            $table->unsignedBigInteger('semester_id');
            $table->text('observations')->nullable();
            $table->unsignedBigInteger('grade_id');
            $table->boolean('enabled')->default(true);
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::table('enrolleds', function (Blueprint $table) {
            $table->foreign('people_id')->references('id')->on('people');
            $table->foreign('headquarter_id')->references('id')->on('headquarters');
          //  $table->foreign('cost_enrolled_id')->references('id')->on('cost_enrolleds');
            $table->foreign('semester_id')->references('id')->on('semesters');
            $table->foreign('grade_id')->references('id')->on('grades');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('enrolleds');
    }
}
