<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Flow extends Model
{
    use SoftDeletes;

    /**
     * The Users that belong to the Flow
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * Get the Tasks for the Flow
     */
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    /**
     * Get the TaskOrders for the Flow
     */
    public function taskOrders()
    {
        return $this->hasMany(TaskOrder::class);
    }
}
