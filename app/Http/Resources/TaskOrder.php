<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TaskOrder extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'type' => 'tasks',
            'id' => $this->id,
            'attributes' => [
                'position' => $this->position,
            ],
            'relationships' => [
                'flow' => [
                    'data' => [
                        'type' => 'flows',
                        'id' => $this->flow_id,
                    ],
                ],
                'task' => [
                    'data' => [
                        'type' => 'tasks',
                        'id' => $this->task_id,
                    ],
                ],
            ],
        ];
    }
}
