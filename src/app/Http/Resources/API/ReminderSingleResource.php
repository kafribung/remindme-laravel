<?php

namespace App\Http\Resources\API;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReminderSingleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'remind_at' => $this->epochToDate($this->remind_at),
            'event_at' => $this->epochToDate($this->event_at),
            'user' => $this->user->name,
            'sent_email' => $this->sent_email,
        ];
    }
}
