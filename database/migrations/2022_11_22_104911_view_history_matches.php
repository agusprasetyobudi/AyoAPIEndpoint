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
        DB::statement("
        CREATE or REPLACE VIEW view_history_matches as
        SELECT
        t.id as team_id,
        t.name ,
        t.city ,
        tp.id as person_id,
        tp.person_name ,
        tp.posisi ,
        tp.nomor_punggung ,
        logs.id as goal_id,
        logs.time_goal,
        sm.id as schedule_id,
        sm.location  as match_location,
        sm.match_date,
        sm.match_time

        FROM schedule_match_logs logs
        inner join team_people tp on
        logs.person_id = tp.id
        inner join teams t on tp.team_id = t.id
        inner join schedule_matches sm ON logs.match_id = sm.id
        where logs.deleted_at is null;
        ");
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
};
