<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWordGrammemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('word_grammems', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('word_id')->default(null)->comment('ID Слова');
            $table->unsignedBigInteger('part_of_speech_id')->default(null)->comment('Часть речи');
            $table->unsignedBigInteger('gender_id')->default(null)->comment('Род');
            $table->unsignedBigInteger('number_id')->default(null)->comment('Число');
            $table->unsignedBigInteger('case_id')->default(null)->comment('Падеж');
            $table->unsignedBigInteger('time_id')->default(null)->comment('Время');
            $table->unsignedBigInteger('face_id')->default(null)->comment('Лицо');
            $table->unsignedBigInteger('enthusiasm_id')->default(null)->comment('Одушевленность');
            $table->unsignedBigInteger('view_id')->default(null)->comment('Вид');
            $table->unsignedBigInteger('transitivity_id')->default(null)->comment('Переходность');
            $table->unsignedBigInteger('pledge_id')->default(null)->comment('Залог');
            $table->unsignedBigInteger('other_id')->default(null)->comment('Другое');
            $table->unsignedBigInteger('semantic_feature_id')->default(null)->comment('Семантический признак');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('word_grammems');
    }
}
