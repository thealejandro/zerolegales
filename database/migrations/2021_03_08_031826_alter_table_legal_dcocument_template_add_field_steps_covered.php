<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableLegalDcocumentTemplateAddFieldStepsCovered extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('legal_document_templates', function (Blueprint $table) {
            $table->string('step1')->nullable()->comment('1: filled; 0: not filled')->default('0');
            $table->string('step2')->nullable()->comment('1: filled; 0: not filled')->default('0');
            $table->string('step3')->nullable()->comment('1: filled; 0: not filled')->default('0');
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
            $table->dropColumn(['step1', 'step2', 'step3']);
        });
    }
}
