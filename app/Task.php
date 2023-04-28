<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'name',
        'priority',
    ];

    public function save(array $options = [])
    {
        if (!$this->exists) {
            // Set priority to the lowest available if it hasn't been set yet
            if (is_null($this->priority)) {
                $this->priority = Task::count() + 1;
            }

            // Check if there's already a task with this priority
            $existingTask = Task::where('priority', $this->priority)->first();
            if ($existingTask) {
                // Shift all tasks with priority >= $this->priority down by 1
                Task::where('priority', '>=', $this->priority)
                    ->where('id', '!=', $this->id)
                    ->update(['priority' => DB::raw('priority + 1')]);
            }
        }

        parent::save($options);
    }
}
