<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ScheduleMatchLog extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable = [
        'match_id',
        'person_id',
        'time_goal' ,
    ];

    public function person()
    {
        return $this->hasOne(TeamPerson::class,'id','person_id');
    }
}
