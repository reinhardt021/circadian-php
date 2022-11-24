<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Task extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     *
     * @return array
     */
    public function toArray($request)
    {
        return [
            'type' => 'tasks',
            'id' => $this->id,
            'attributes' => [
                'title' => $this->title,
                'hours' => $this->hours,
                'minutes' => $this->minutes,
                'seconds' => $this->seconds,
            ],
            'relationships' => [
                'flow' => [
                    'data' => [
                        'type' => 'flows',
                        'id' => $this->flow_id,
                    ],
                ],
            ],
        ];
    }
}
