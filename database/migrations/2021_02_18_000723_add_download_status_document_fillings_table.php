<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDownloadStatusDocumentFillingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('document_fillings', function (Blueprint $table) {
            $table->bigInteger('download_status')->unsigned()->nullable();
            $table->foreign('download_status')->references('id')->on('download_statuses')->onDelete('cascade')->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('document_fillings', function (Blueprint $table) {
            $table->dropForeign('download_statuses_download_status_foreign');
            $table->dropColumn('download_status');
        });
    }
}
