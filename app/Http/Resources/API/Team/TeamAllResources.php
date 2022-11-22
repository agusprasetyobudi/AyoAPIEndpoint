<?php

namespace App\Http\Resources\API\Team;

use App\Http\Resources\API\TeamPerson\AllTeamPersonResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class TeamAllResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'=> $this->id,
            'logo'=>Storage::url($this->logo),
            'name' => $this->name,
            'year_founded' => $this->year_founded,
            'address' => $this->address,
            'city' => $this->city,
            'team_person' => AllTeamPersonResource::collection($this->person)
        ];
    }
}
