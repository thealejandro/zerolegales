<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePriceMatricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('price_matrices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('subscription_id')->unsigned()->nullable();
            $table->foreign('subscription_id')->references('id')->on('subscription_types')->onDelete('cascade')->onUpdate('no action');
            $table->bigInteger('document_id')->unsigned()->nullable();
            $table->foreign('document_id')->references('id')->on('legal_document_templates')->onDelete('cascade')->onUpdate('no action');
            $table->string('payment_type')->nullable();
            $table->decimal('price', 8, 2)->nullable();
            $table->bigInteger('created_by')->unsigned()->nullable();
            $table->foreign('created_by')->references('id')->on('admins')->onDelete('cascade')->onUpdate('no action');
            $table->bigInteger('updated_by')->unsigned()->nullable();
            $table->foreign('updated_by')->references('id')->on('admins')->onDelete('cascade')->onUpdate('no action');
            $table->bigInteger('deleted_by')->unsigned()->nullable();
            $table->foreign('deleted_by')->references('id')->on('admins')->onDelete('cascade')->onUpdate('no action');
            $table->softDeletes();
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
        Schema::dropIfExists('price_matrices');
    }
}
