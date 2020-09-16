<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('institution_name')->nullable();
            $table->string('name')->nullable();
            $table->date('expedition_date')->nullable();
            $table->unsignedBigInteger('people_id')->nullable();
            $table->unsignedBigInteger('category_document_id')->nullable();
            $table->string('route')->nullable();
           // $table->unsignedBigInteger('grade_id')->nullable();
            $table->text('observations')->nullable();
            $table->boolean('enabled')->default(true);
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::table('documents', function (Blueprint $table) {
            $table->foreign('people_id')->references('id')->on('people');
            $table->foreign('category_document_id')->references('id')->on('category_documents');
          //  $table->foreign('grade_id')->references('id')->on('grades');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('documents');
    }
}
