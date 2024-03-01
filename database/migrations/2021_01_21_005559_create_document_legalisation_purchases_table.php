<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentLegalisationPurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('document_legalisation_purchases', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('invoice_id')->unsigned()->nullable();
            $table->foreign('invoice_id')->references('id')->on('document_invoices')->onDelete('cascade')->onUpdate('no action');
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('no action');
            $table->bigInteger('legalization_id')->unsigned()->nullable();
            $table->foreign('legalization_id')->references('id')->on('legalization_details')->onDelete('cascade')->onUpdate('no action');
            $table->integer('document_template_id')->nullable();
            $table->bigInteger('document_id')->unsigned()->nullable();
            $table->foreign('document_id')->references('id')->on('legal_document_templates')->onDelete('cascade')->onUpdate('no action');
            $table->decimal('document_price', 8, 2)->nullable();
            $table->decimal('legalization_price', 8, 2)->nullable();
            $table->decimal('amount', 8, 2)->nullable();
            $table->string('document_filling_type')->nullable();
            $table->bigInteger('created_by')->unsigned()->nullable();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('no action');
            $table->bigInteger('updated_by')->unsigned()->nullable();
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('no action');
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
        Schema::dropIfExists('document_legalisation_purchases');
    }
}
