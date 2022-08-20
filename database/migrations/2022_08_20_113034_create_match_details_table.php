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
        Schema::create('match_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('game_id');
            $table->string('season');
            $table->string('date');
            $table->string('time');
            $table->text('first_team_logo');
            $table->text('first_team_score');
            $table->text('second_team_logo');
            $table->text('second_team_score');
            $table->string('stage');
            $table->foreign('game_id')->references('id')->on('games')->onDelete('CASCADE')->onUpdate('CASCADE');
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
        Schema::dropIfExists('match_details');
    }
};
