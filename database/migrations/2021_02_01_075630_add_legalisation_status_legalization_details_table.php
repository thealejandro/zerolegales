<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLegalisationStatusLegalizationDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('legalization_details', function (Blueprint $table) {
            $table->bigInteger('legalisation_status')->unsigned()->nullable();
            $table->foreign('legalisation_status')->references('id')->on('user_legalisations')->onDelete('cascade')->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('legalization_details', function (Blueprint $table) {
            $table->dropForeign('user_legalisations_legalisation_status_foreign');
            $table->dropColumn('legalisation_status');
        });
    }
}
