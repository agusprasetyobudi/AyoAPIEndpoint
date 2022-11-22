<?php

namespace App\Http\Resources\API\MatchScheduleLog;

use Illuminate\Http\Resources\Json\JsonResource;

class MatchScheduleLogResource extends JsonResource
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
            'person_team'   => $this->person->person_name,
            'team'          => $this->person->teams->name,
            'goal'          => $this->time_goal
        ];
    }
}
