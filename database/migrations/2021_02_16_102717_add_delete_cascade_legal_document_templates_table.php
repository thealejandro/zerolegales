<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDeleteCascadeLegalDocumentTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('legal_document_templates', function (Blueprint $table) {
            $table->dropForeign('legal_document_templates_category_id_foreign');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade')->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('legal_document_templates', function (Blueprint $table) {
            $table->dropForeign('legal_document_templates_category_id_foreign');
            //$table->bigInteger('category_id')->unsigned()->nullable();
            $table->foreign('category_id')->references('id')->on('categories');
        });
    }
}
