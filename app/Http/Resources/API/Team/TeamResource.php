<?php

namespace App\Http\Resources\API\Team;

use App\Http\Resources\API\TeamPerson\AllTeamPersonResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class TeamResource extends JsonResource
{
    public $message;

    public function __construct($message=null,$resource)
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
            'message' => $this->message??'Team Has Create',
            'data' => [
                'id'=> $this->id,
                'logo'=>Storage::url($this->logo),
                'name' => $this->name,
                'year_founded' => $this->year_founded,
                'address' => $this->address,
                'city' => $this->city,
                'team' => AllTeamPersonResource::collection($this->person)
            ]
        ];
    }
}