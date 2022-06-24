<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateGameUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    Schema::table('game_users', function (Blueprint $table) {
    $table->decimal('global_skill',$precision = 8, $scale = 2)->nullable();
    $table->integer('global_XP')->nullable();
    $table->dropColumn('user_id');
    $table->dropColumn('achievements');
    $table->dropColumn('level');
    $table->dropColumn('local_rank');
    $table->dropColumn('money');
    $table->dropColumn('slant');
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
