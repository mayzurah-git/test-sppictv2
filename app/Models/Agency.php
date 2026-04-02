<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Agency extends Model
{
    protected $fillable = [
        'agency_name',
        'agency_code',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    
}
