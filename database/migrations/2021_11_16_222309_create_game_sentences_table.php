<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGameSentencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('game_sentences', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sentence',500);
            $table->string('link')->nullable();
            $table->string('outlet');
            $table->string('topic');
            $table->string('type');
            $table->string('SentenceBias');
            $table->integer('SentenceCount')->nullable();
            $table->string('SentenceStatus');
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
        Schema::dropIfExists('game_sentences');
    }
}
