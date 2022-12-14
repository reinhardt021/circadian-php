<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Flow extends JsonResource
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
            'type' => 'flows', //todo: make these constants somewhere plural classname w/o namespace
            'id' => $this->id,
            'attributes' => [
                'title' => $this->title,
            ],
            'relationships' => [
                'taskOrders' => [
                    'data' => TaskOrder::collection($this->whenLoaded('taskOrders')),
                ],
                'tasks' => [
                    'data' => Task::collection($this->whenLoaded('tasks')),
                ],
            ],
            // todo: included goes at the level above this I think
//            'included' => [
//                [
//                    'type' => 'task',
//                    'id' => '11',
//                    'attributes' => [
//                        'title' => 'task 01'
//                    ],
//                ],
//            ],
        ];
    }
}
