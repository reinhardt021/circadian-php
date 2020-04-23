<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TaskOrder extends Model
{
    /**
     * Get the Flow that owns the TaskOrder
     */
    public function flow(): BelongsTo
    {
        return $this->belongsTo(Flow::class, 'flow_id', 'id');
    }

    /**
     * Get the Task that owns the TaskOrder
     */
    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class, 'task_id', 'id');
    }
}
