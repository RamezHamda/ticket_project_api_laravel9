<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TicketResource extends JsonResource
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
            'id' => $this->id,
            'user' => $this->user->name,
            'catalog' => $this->catalog->name,
            'title' => $this->title,
            'description' => $this->desc,
            'status' => $this->status(),
            'priority' => $this->priority(),
            'attachment' => $this->attachment,
            // 'threads' => $this->threads,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
