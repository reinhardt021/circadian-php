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
                // todo: include only if loaded on the model
                'taskOrders' => [
                    'data' => TaskOrder::collection($this->whenLoaded('taskOrders')),
//                    'data' => [
//                        [
//                            'type' => 'taskOrder',
//                            'id' => 99,
//                            'attributes' => [
//                                'position' => 1,
//                                'task_id' => 15,
//                            ],
//                        ],
//                    ],
                ],
                // todo: include only if loaded on the model
//                'tasks' => [
//                    'data' => [
//                        'type' => 'task',
//                        'id' => 11,
//                    ],
//                ],
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
