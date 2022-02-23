<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public string $uuid;
    public string $first_name;
    public string $last_name;
    public string $email;
    public string $avatar;
    public string $address;
    public string $phone_number;
    public bool $is_marketing;
    public string $updated_at;
    public string $created_at;
    public string $unique_id;
    public object $token;

    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array|Arrayable|\JsonSerializable
     */
    public function toArray($request): array|\JsonSerializable|Arrayable
    {
        return [
            'uuid'          => $this->uuid,
            'first_name'    => $this->first_name,
            'last_name'     => $this->last_name,
            'email'         => $this->email,
            'avatar'        => $this->avatar,
            'address'       => $this->address,
            'phone_number'  => $this->phone_number,
            'is_marketing'  => $this->is_marketing,
            'updated_at'    => $this->updated_at,
            'created_at'    => $this->created_at,
            'token'         => $this->token->unique_id // @phpstan-ignore-line
        ];
    }
}
