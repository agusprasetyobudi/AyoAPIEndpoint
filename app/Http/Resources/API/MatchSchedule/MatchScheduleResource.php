<?php

namespace App\Http\Resources\API\MatchSchedule;

use Illuminate\Http\Resources\Json\JsonResource;

class MatchScheduleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'match_date' => $this->match_date,
            'match_time' => $this->match_time,
            'location'  => $this->location,
            'team_home' => $this->HomeTeam->name,
            'away_home' => $this->AwayTeam->name
        ];
    }
}
