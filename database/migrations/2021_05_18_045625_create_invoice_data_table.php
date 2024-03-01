<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_data', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->tinyInteger('invoice')->nullable()->comment('0:NIT 1:C/F');
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('no action');
            $table->string('document_transaction')->references('transaction_uuid')->on('document_invoices')->nullable()->onDelete('cascade')->onUpdate('no action');
            $table->string('subscription_transaction')->references('transaction_uuid')->on('invoices')->nullable()->onDelete('cascade')->onUpdate('no action');
            $table->string('nit')->nullable();
            $table->string('customer_name')->nullable();
            $table->string('customer_address')->nullable();
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
        Schema::dropIfExists('invoice_data');
    }
}
