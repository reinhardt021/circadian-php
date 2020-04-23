<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskOrder extends Model
{
    /**
     * Get the Flow that owns the TaskOrder
     */
    public function flow()
    {
        return $this->belongsTo(Flow::class, 'flow_id', 'id');
    }

    /**
     * Get the Task that owns the TaskOrder
     */
    public function task()
    {
        return $this->belongsTo(Task::class, 'task_id', 'id');
    }
}
