<?php

namespace App\Http\Resources\API\Auth;

use Illuminate\Http\Resources\Json\JsonResource;

use function PHPSTORM_META\map;

class LoginResource extends JsonResource
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
            'error'=> false,
            'message' => 'You authenticate',
            'token' => $this->createToken(env('APP_NAME','Laravel'))->accessToken,
            'data' => [
                'name' => $this->name,
                'email' => $this->email
            ]
        ];
    }
}
