<?php

namespace App\Http\Resources\API\TeamPerson;

use Illuminate\Http\Resources\Json\JsonResource;

class TeamPersonResource extends JsonResource
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
        return [
            'error'=>false,
            'message' => $this->message??'Team Person Has Added',
            'data' => [
                'nama'=>$this->person_name,
                'tinggi'=>$this->tinggi,
                'berat'=>$this->berat,
                'posisi'=>$this->posisi,
                'nomor_punggung'=>$this->nomor_punggung,
                'team' => $this->teams->name
            ]
        ];
    }
}
