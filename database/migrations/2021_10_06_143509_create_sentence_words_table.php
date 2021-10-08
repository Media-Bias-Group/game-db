<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSentenceWordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sentence_words', function (Blueprint $table) {
           $table->increments('id');
            $table->integer('sentence_id');
            $table->unsignedInteger('word_id');
            $table->foreign('word_id')->references('id')->on('words') ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('sentence_id')->references('id')->on('sentences') ->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('sentence_words');
    }
}
