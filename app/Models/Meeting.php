<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Meeting extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'meeting_number',
        'year',
        'date',
        'time',
        'venue',
        'status',
        'project_update_deadline',
        'minutes_file',
        'agenda',
    ];

    protected $casts = [
        'date' => 'date',
        'project_update_deadline' => 'date',
    ];

    public function projects()
    {
        return $this->hasMany(Project::class);
    }
}
