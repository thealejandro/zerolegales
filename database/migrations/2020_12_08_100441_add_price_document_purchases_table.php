<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPriceDocumentPurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('document_purchases', function (Blueprint $table) {
            $table->decimal('document_price', 8, 2)->nullable()->after('document_id');
            $table->decimal('total_price', 8, 2)->nullable()->after('document_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('document_purchases', function (Blueprint $table) {
            $table->dropColumn('document_price');
            $table->dropColumn('total_price');
        });
    }
}
