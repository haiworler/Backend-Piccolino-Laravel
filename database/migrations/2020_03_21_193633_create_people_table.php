<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('imagen')->nullable();
            $table->string('names')->nullable();
            $table->string('surnames');
            $table->unsignedBigInteger('type_document_id');
            $table->string('document_number')->unique();
            $table->date('birth_date');
            $table->unsignedBigInteger('birth_town_id');
            $table->unsignedBigInteger('gender_id');
            $table->string('phone')->nullable();
            $table->string('cell')->nullable();
            $table->string('email')->nullable();
            $table->string('address_residence')->nullable();
            $table->unsignedBigInteger('neighborhood_id');
            $table->unsignedBigInteger('occupation_id');
            $table->string('rh')->nullable();
            $table->string('eps')->nullable();
            $table->text('observations')->nullable();
            $table->string('stratum')->nullable();
            $table->string('level_sisben')->nullable();
            $table->unsignedBigInteger('type_people_id');
            $table->text('history')->nullable(); // Describe como conocio a piccolino
            $table->date('arrival_date')->nullable();
            $table->string('promotion')->nullable();
            $table->date('date_role_change')->nullable();
            $table->boolean('enabled')->default(true);
            $table->softDeletes();
            $table->timestamps();
            $table->unsignedBigInteger('user_created_at')->nullable();
            $table->unsignedBigInteger('user_updated_at')->nullable();
        });

        Schema::table('people', function (Blueprint $table) {
            $table->foreign('type_document_id')->references('id')->on('type_documents');
            $table->foreign('birth_town_id')->references('id')->on('towns');
            $table->foreign('gender_id')->references('id')->on('genders');
            $table->foreign('neighborhood_id')->references('id')->on('neighborhoods');
            $table->foreign('occupation_id')->references('id')->on('occupations');
            $table->foreign('type_people_id')->references('id')->on('type_people');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('people');
    }
}
