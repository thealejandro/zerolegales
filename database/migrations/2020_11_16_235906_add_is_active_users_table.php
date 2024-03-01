<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsActiveUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('is_active')->default(true)->after('remember_token');
            $table->boolean('terms_conditions')->nullable()->after('is_active');
            $table->bigInteger('created_by')->unsigned()->nullable()->after('terms_conditions');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('no action');
            $table->bigInteger('updated_by')->unsigned()->nullable()->after('created_by');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('is_active');
            $table->dropColumn('terms_conditions');
            $table->dropForeign('users_created_by_foreign');
            $table->dropColumn('created_by');
            $table->dropForeign('users_updated_by_foreign');
            $table->dropColumn('updated_by');
        });
    }
}
