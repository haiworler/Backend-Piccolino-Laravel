<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAcademicInformationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('academic_information', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('people_id')->nullable();
            $table->unsignedBigInteger('training_type_id')->nullable();
            $table->string('institution_name')->nullable();
            $table->string('name')->nullable();
            $table->date('date')->nullable();
            $table->text('observations')->nullable();
            $table->string('route')->nullable();
            $table->boolean('enabled')->default(true);
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::table('academic_information', function (Blueprint $table) {
            $table->foreign('people_id')->references('id')->on('people');
            $table->foreign('training_type_id')->references('id')->on('training_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('academic_information');
    }
}
