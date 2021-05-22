<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJestWordformsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('morphy_jest_wordforms', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('jest_id')->nullable(false)->comment('ID жеста');
            $table->unsignedBigInteger('wordform_id')->nullable(false)->comment('ID словоформы');

            $table->foreign('jest_id')->references('id_jest')->on('srd_surd_jest')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('wordform_id')->references('id')->on('morphy_word_grammems')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('morphy_jest_wordforms');
    }
}
