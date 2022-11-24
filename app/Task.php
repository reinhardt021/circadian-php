<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use SoftDeletes;

    /**
     * Get the Flow that owns the Task
     */
    public function flow(): BelongsTo
    {
        return $this->belongsTo(Flow::class);
    }

    /**
     * Get the TaskOrder associated to the Task
     */
    public function taskOrder(): HasOne
    {
        return $this->hasOne(TaskOrder::class, 'task_id', 'id');
    }
}
