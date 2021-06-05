<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddWordIdToMorphyJestWordformsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('morphy_jest_wordforms', function (Blueprint $table) {
            $table->unsignedBigInteger('word_id')->after('jest_id')->comment('ID слова');

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
        Schema::table('morphy_jest_wordforms', function (Blueprint $table) {
            $table->dropColumn('word_id');
        });
    }
}
