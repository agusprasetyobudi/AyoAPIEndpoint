<?php

namespace App\Http\Resources\API\MatchSchedule;

use Illuminate\Http\Resources\Json\JsonResource;

class FindOrUpdateMatchScheduleResource extends JsonResource
{
    public $message;
    public function __construct($message,$resource)
    {
        parent::__construct($resource);
        $this->message = $message;
    }
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
            'error'=>false,
            'message' => $this->message??'Schedule Match Has Update',
            'data' => [
                'match_date' => $this->match_date.' '.$this->match_time,
                'location'  => $this->location,
                'team_home' => $this->HomeTeam->name,
                'away_home' => $this->AwayTeam->name
            ]
        ];
    }
}
