<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ScheduleMatch extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable = [
        'match_date',
        'match_time',
        'home_team_id',
        'away_team_id',
        'location',
    ];
}
