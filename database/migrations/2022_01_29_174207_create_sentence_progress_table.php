<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSentenceProgressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sentence_progress', function (Blueprint $table) {
           $table->increments('id');
            $table->string('user_id',40);
            $table->unsignedInteger('sentence_id');
            $table->foreign('user_id')->references('id')->on('game_users') ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('sentence_id')->references('id')->on('game_sentences') ->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sentence_progress');
    }
}
