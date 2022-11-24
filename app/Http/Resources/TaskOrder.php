<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskOrder extends JsonResource
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
            'type' => 'taskOrders',
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
