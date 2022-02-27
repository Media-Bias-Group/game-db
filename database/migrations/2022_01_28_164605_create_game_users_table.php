<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGameUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('game_users', function (Blueprint $table) {
            $table->string('id',40);
            $table->primary('id');
            $table->string('user_id',255)->nullable();
            $table->text('achievements')->nullable();
            $table->integer('level')->nullable();
            $table->integer('local_rank')->nullable();
            $table->integer('money')->nullable();
            $table->text('slant')->nullable();
            $table->boolean('game_finished');
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
        Schema::dropIfExists('game_users');
    }
}
