<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use SoftDeletes;

    /**
     * Get the Flow that owns the Task
     */
    public function flow()
    {
        return $this->belongsTo(Flow::class);
    }
}
