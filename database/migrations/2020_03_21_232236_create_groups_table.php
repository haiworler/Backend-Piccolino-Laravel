<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->unsignedBigInteger('headquarter_id');
            $table->unsignedBigInteger('semester_id');
            $table->unsignedBigInteger('people_id')->nullable();//Persona Responsable
            $table->boolean('enabled')->default(true);
            $table->timestamps();
        });
        
        Schema::table('groups', function (Blueprint $table) {
            $table->foreign('people_id')->references('id')->on('people');
            $table->foreign('headquarter_id')->references('id')->on('headquarters');
            $table->foreign('semester_id')->references('id')->on('semesters');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('groups');
    }
}
