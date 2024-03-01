<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('surname')->nullable()->after('last_name');
            $table->string('second_surname')->nullable()->after('surname');
            $table->string('married_surname')->nullable()->after('second_surname');
            $table->dateTime('date_of_birth')->nullable()->after('married_surname');
            $table->integer('age')->nullable()->after('date_of_birth');
            $table->string('nationality')->nullable()->after('age');
            $table->string('dpi_number')->nullable()->after('nationality');
            $table->text('dpi_file')->nullable()->after('dpi_number');
            $table->string('passport_number')->nullable()->after('email');
            $table->text('passport_file')->nullable()->after('passport_number');
            $table->string('profession')->nullable()->after('email_verified_at');
            $table->string('direction')->nullable()->after('password');
            $table->integer('image_type')->nullable()->after('user_image');
            $table->text('rtu')->nullable()->after('image_type');
            $table->text('appointment')->nullable()->after('rtu');
            $table->text('company_trade_patent')->nullable()->after('appointment');
            $table->text('society_trade_patent')->nullable()->after('company_trade_patent');
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
