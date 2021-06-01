<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddWordIdToMorphyWordformJestsSostavTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('morphy_wordform_jests_sostav', function (Blueprint $table) {
            $table->unsignedBigInteger('word_id')->nullable(false)->after('id')->comment('ID Слова');

            $table->foreign('word_id')->references('id_word')->on('srd_surd_words')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('morphy_wordform_jests_sostav', function (Blueprint $table) {
            $table->dropColumn('word_id');
        });
    }
}
