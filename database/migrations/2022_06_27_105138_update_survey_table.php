<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateSurveyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::table('surveys', function (Blueprint $table) {
      $table->dropForeign(['user_id']);
      $table->foreign('user_id')->references('id')->on('game_users') ->onUpdate('cascade')->onDelete('cascade');
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
