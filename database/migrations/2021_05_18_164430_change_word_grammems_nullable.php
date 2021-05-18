<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeWordGrammemsNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('word_grammems', function (Blueprint $table) {
            $table->unsignedBigInteger('word_id')->nullable()->change();
            $table->unsignedBigInteger('part_of_speech_id')->nullable()->change();
            $table->unsignedBigInteger('gender_id')->nullable()->change();
            $table->unsignedBigInteger('number_id')->nullable()->change();
            $table->unsignedBigInteger('case_id')->nullable()->change();
            $table->unsignedBigInteger('time_id')->nullable()->change();
            $table->unsignedBigInteger('face_id')->nullable()->change();
            $table->unsignedBigInteger('enthusiasm_id')->nullable()->change();
            $table->unsignedBigInteger('view_id')->nullable()->change();
            $table->unsignedBigInteger('transitivity_id')->nullable()->change();
            $table->unsignedBigInteger('pledge_id')->nullable()->change();
            $table->unsignedBigInteger('other_id')->nullable()->change();
            $table->unsignedBigInteger('semantic_feature_id')->nullable()->change();
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
