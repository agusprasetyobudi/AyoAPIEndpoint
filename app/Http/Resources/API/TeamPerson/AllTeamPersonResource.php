<?php

namespace App\Http\Resources\API\TeamPerson;

use Illuminate\Http\Resources\Json\JsonResource;

class AllTeamPersonResource extends JsonResource
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
            'nama'=>$this->person_name,
            'tinggi'=>$this->tinggi,
            'berat'=>$this->berat,
            'posisi'=>$this->posisi,
            'nomor_punggung'=>$this->nomor_punggung,
        ];
    }
}
