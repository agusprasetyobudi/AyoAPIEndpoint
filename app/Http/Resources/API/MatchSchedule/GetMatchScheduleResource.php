<?php

namespace App\Http\Resources\API\MatchSchedule;

use Illuminate\Http\Resources\Json\JsonResource;
use PhpParser\Node\Expr\Match_;

class GetMatchScheduleResource extends JsonResource
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
            'message' => $this->message??'Get Match All',
            'data' => MatchScheduleResource::collection($this)
        ];
    }
}
