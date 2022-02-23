<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
//    public ?string $uuid = null;
//    public ?string $first_name = null;
//    public ?string $last_name = null;
//    public ?string $email = null;
//    public ?string $avatar = null;
//    public ?string $address = null;
//    public ?string $phone_number = null;
//    public ?bool $is_marketing = null;
//    public ?string $updated_at = null;
//    public ?string $created_at = null;
//    public ?string $unique_id = null;
//    public ?object $token = null;

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
            'token'         => $this->tokens->unique_id // @phpstan-ignore-line
        ];
    }
}
