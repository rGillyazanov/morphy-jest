<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateForeignKeyWordGrammemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('word_grammems', function (Blueprint $table) {
            $table->foreign('word_id')->references('id')->on('words')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('part_of_speech_id')->references('id')->on('morphy_parts_of_speech')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('gender_id')->references('id')->on('morphy_grammema_gender')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('number_id')->references('id')->on('morphy_grammema_number')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('case_id')->references('id')->on('morphy_grammema_case')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('time_id')->references('id')->on('morphy_grammema_time')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('face_id')->references('id')->on('morphy_grammema_face')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('enthusiasm_id')->references('id')->on('morphy_grammema_enthusiasm')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('view_id')->references('id')->on('morphy_grammema_view')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('transitivity_id')->references('id')->on('morphy_grammema_transitivity')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('pledge_id')->references('id')->on('morphy_grammema_pledge')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('other_id')->references('id')->on('morphy_grammema_other')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('semantic_feature_id')->references('id')->on('morphy_grammema_semantic_features')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('word_grammems', function (Blueprint $table) {
            $table->dropForeign('word_id');
            $table->dropForeign('part_of_speech_id');
            $table->dropForeign('gender_id');
            $table->dropForeign('number_id');
            $table->dropForeign('case_id');
            $table->dropForeign('time_id');
            $table->dropForeign('face_id');
            $table->dropForeign('enthusiasm_id');
            $table->dropForeign('view_id');
            $table->dropForeign('transitivity_id');
            $table->dropForeign('pledge_id');
            $table->dropForeign('other_id');
            $table->dropForeign('semantic_feature_id');
        });
    }
}
