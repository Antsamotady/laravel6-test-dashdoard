<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'name',
        'priority',
        'project_id'
    ];

    public function save(array $options = [])
    {
        if (!$this->exists) {
            if (is_null($this->priority)) {
                $this->priority = Task::count() + 1;
            }

            $existingTask = Task::where('priority', $this->priority)->first();
            if ($existingTask) {
                Task::where('priority', '>=', $this->priority)
                    ->where('id', '!=', $this->id)
                    ->update(['priority' => DB::raw('priority + 1')]);
            }
        }

        parent::save($options);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
