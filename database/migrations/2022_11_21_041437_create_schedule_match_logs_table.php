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
        Schema::create('schedule_match_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('match_id');
            $table->foreignId('person_id');
            $table->time('time_goal');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('match_id')->references('id')->on('schedule_matches')->onDelete('cascade');
            $table->foreign('person_id')->references('id')->on('team_people');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedule_match_logs');
    }
};
