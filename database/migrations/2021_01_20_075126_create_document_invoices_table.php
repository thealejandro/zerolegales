<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('document_invoices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('no action');
            $table->bigInteger('document_id')->unsigned()->nullable();
            $table->foreign('document_id')->references('id')->on('legal_document_templates')->onDelete('cascade')->onUpdate('no action');
            $table->bigInteger('legalization_id')->unsigned()->nullable();
            $table->foreign('legalization_id')->references('id')->on('legalization_details')->onDelete('cascade')->onUpdate('no action');
            $table->integer('document_template_id')->nullable();
            $table->string('transaction_uuid')->nullable();
            $table->bigInteger('price_matrix_id')->unsigned()->nullable();
            $table->foreign('price_matrix_id')->references('id')->on('price_matrices')->onDelete('cascade')->onUpdate('no action');
            $table->decimal('document_price', 8, 2)->nullable();
            $table->decimal('legalization_price', 8, 2)->nullable();
            $table->decimal('amount', 8, 2)->nullable();
            $table->boolean('is_pay')->default(0);
            $table->string('transaction_id')->nullable();
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
        Schema::dropIfExists('document_invoices');
    }
}
