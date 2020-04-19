<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modules', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('route');
            $table->string('icon')->nullable();
            $table->string('class')->nullable();
            $table->boolean('enabled')->default(true);
            $table->boolean('abstract')->default(false)->nullable();
            $table->unsignedBigInteger('module_id')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::table('modules', function (Blueprint $table) {
            $table->foreign('module_id')->references('id')->on('modules');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('modules');
    }
}
