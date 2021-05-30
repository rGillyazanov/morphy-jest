<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMorphyWordformJestsSostavTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('morphy_wordform_jests_sostav', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('wordform_id')->nullable(false)->comment('ID словоформы');
            $table->unsignedBigInteger('jest_id')->nullable(false)->comment('ID жеста');
            $table->smallInteger('order')->nullable(false)->comment('Позиция жеста в очереди');

            $table->foreign('wordform_id')->references('id')->on('morphy_word_grammems')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('jest_id')->references('id_jest')->on('srd_surd_jest')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('morphy_wordform_jests_sostav');
    }
}
