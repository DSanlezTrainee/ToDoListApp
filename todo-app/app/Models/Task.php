<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'title',
        'description',
        'is_completed',
        'due_date',
        'priority',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
