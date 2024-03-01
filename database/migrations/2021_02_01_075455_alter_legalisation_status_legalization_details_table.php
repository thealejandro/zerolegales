<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterLegalisationStatusLegalizationDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('legalization_details', function (Blueprint $table) {
            $table->dropColumn('legalisation_status');
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
            $table->string('legalisation_status')->nullable();        
        });
    }
}
