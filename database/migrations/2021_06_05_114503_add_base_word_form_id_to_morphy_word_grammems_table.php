<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBaseWordFormIdToMorphyWordGrammemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('morphy_word_grammems', function (Blueprint $table) {
            $table->unsignedBigInteger('base_word_form_id')->after('id')->comment('Базовая форма слова');

            $table->foreign('base_word_form_id')->references('id')->on('morphy_word_forms')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('morphy_word_grammems', function (Blueprint $table) {
            $table->dropColumn('base_word_form_id');
        });
    }
}
