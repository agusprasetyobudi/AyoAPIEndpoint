<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TeamPerson extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable = [
        'team_id',
        'person_name',
        'tinggi',
        'berat',
        'posisi',
        'nomor_punggung',
    ];

    public function teams()
    {
        return $this->hasOne(Team::class,'id','team_id');
    }
}
