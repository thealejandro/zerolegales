<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUserAddFilenameTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('dpi_file_name')->nullable()->after('dpi_file');
            $table->string('passport_file_name')->nullable()->after('passport_file');
            $table->string('rtu_file_name')->nullable()->after('rtu');
            $table->string('appointment_file_name')->nullable()->after('appointment');
            $table->string('company_trade_patent_file_name')->nullable()->after('company_trade_patent');
            $table->string('society_trade_patent_file_name')->nullable()->after('society_trade_patent');
         });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
