<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLawyersDirectoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lawyers_directories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('lawyer_name')->nullable();
            $table->string('lawyer_address')->nullable();
            $table->string('zone')->nullable();
            $table->string('township')->nullable();
            $table->string('department')->nullable(); //or state
            $table->string('phone')->nullable();
            $table->string('email')->unique();
            $table->boolean('is_active')->default(true);
            $table->bigInteger('created_by')->unsigned()->nullable();
            $table->foreign('created_by')->references('id')->on('admins')->onDelete('cascade')->onUpdate('no action');
            $table->bigInteger('updated_by')->unsigned()->nullable();
            $table->foreign('updated_by')->references('id')->on('admins')->onDelete('cascade')->onUpdate('no action');
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
        Schema::dropIfExists('lawyers_directories');
    }
}
