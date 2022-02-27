<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWordsAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('words_answers', function (Blueprint $table) {
             $table->increments('id');
            $table->unsignedInteger('word_id');
            $table->string('user_id',40);
            $table->integer('annotaion');
            $table->boolean('answer');
            $table->timestamps();
             $table->foreign('word_id')->references('id')->on('words') ->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('words_answers');
    }
}
