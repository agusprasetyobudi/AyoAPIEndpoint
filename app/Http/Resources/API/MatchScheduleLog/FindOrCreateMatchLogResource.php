<?php

namespace App\Http\Resources\API\MatchScheduleLog;

use Illuminate\Http\Resources\Json\JsonResource;

class FindOrCreateMatchLogResource extends JsonResource
{
    public $message;
    public function __construct($message, $resource)
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
            'error' => false,
            'message' => $this->message??'Find Result Match',
            'data' => new MatchScheduleLogResource($this)
        ];
    }
}
