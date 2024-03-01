<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropColumnsLegalizationDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('legalization_details', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->dropColumn('card_no');
            $table->dropColumn('expiry_date');
            $table->dropColumn('cvv');
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
            $table->string('name')->nullable();
            $table->string('card_no')->nullable();
            $table->string('expiry_date')->nullable();
            $table->string('cvv')->nullable();
        });
    }
}
