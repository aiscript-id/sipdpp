<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSurveyToUserSurveyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('survey_users', function (Blueprint $table) {
            $table->integer('survey_id')->unsigned()->nullable()->after('event_survey_id');
            $table->integer('event_id')->unsigned()->nullable()->after('survey_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('survey_users', function (Blueprint $table) {
            $table->dropColumn('survey_id');
            $table->dropColumn('event_id');
        });
    }
}
