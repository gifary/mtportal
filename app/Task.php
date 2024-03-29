<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'title', 'description', 'status', 'start_date', 'task_type','user_id',
        'due_date', 'priority','assigned_to','parent_task_id','ticket_id'
    ];

    protected $with=['assignedto'];

    public function assignedto()
    {
        return $this->belongsTo(User::class,'assigned_to','id');
    }

    public function attachment()
    {
        return $this->hasMany(TuskAttachment::class,'task_id','id');
    }
}
