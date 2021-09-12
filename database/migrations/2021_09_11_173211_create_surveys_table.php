<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSurveysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surveys', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id',40);
            $table->string('gender');
            $table->string('age');
            $table->string('education');
            $table->string('proficiency');
            $table->string('behaviour');
            $table->string('averageNewsCheck');
            $table->timestamps();
             $table->foreign('user_id')->references('id')->on('users') ->onUpdate('cascade')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('surveys');
    }
}
