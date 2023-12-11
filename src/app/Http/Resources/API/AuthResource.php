<?php

namespace App\Http\Resources\API;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'ok' => true,
            'data' => [
                'user' => [
                    'id' => $this->id,
                    'email' => $this->email,
                    'name' => $this->name,
                ],
                'access_token' => $this->access_token,
                'refresh_token' => $this->refresh_token,
            ],
        ];
    }
}
