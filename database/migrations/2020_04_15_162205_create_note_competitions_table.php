<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNoteCompetitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('note_competitions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('note');
            $table->text('observations')->nullable();
            $table->unsignedBigInteger('note_id');
            $table->string('competencie_name');
            $table->boolean('enabled')->default(true);
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::table('note_competitions', function (Blueprint $table) {
            $table->foreign('note_id')->references('id')->on('notes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('note_competitions');
    }
}
