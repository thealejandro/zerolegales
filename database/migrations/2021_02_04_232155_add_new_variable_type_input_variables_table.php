<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewVariableTypeInputVariablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('input_variables', function (Blueprint $table) {
            $table->bigInteger('variable_type')->unsigned()->nullable();
            $table->foreign('variable_type')->references('id')->on('input_variable_types')->onDelete('cascade')->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('input_variables', function (Blueprint $table) {
             $table->dropForeign('input_variables_variable_type_foreign');
            $table->dropColumn('variable_type');
        });
    }
}
