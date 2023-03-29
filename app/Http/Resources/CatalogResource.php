<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class CatalogResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $child = $this->child;
        return [
            'name' => $this->name,
            'user' => $this->user->name,
            'children' => $this->child()->count() > 0 ? $this->child : [],
            'short_code' => $this->short_code,
            'status' => $this->status(),
            'response_time' => $this->response_time,
            'normal' => $this->normal,
            'moderated' => $this->moderated,
            'critical' => $this->critical,
            "created" =>  Carbon::parse($this->created_at)->format('d-m-Y'), // h:i A
        ];
    }
}