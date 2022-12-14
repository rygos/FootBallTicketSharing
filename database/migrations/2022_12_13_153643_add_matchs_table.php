<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matchs', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('league_id');
            $table->integer('match_id');
            $table->dateTime('match_time');
            $table->integer('team1_id');
            $table->string('team1_name');
            $table->integer('team2_id');
            $table->string('team2_name');
            $table->string('group_name');
            $table->dateTime('last_update');
            $table->integer('is_finished');
            $table->integer('result_end_t1')->nullable();
            $table->integer('result_end_t2')->nullable();
            $table->integer('result_half_t1')->nullable();
            $table->integer('result_half_t2')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('matchs');
    }
};
