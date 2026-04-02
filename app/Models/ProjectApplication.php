<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectApplication extends Model
{
    // Membenarkan data disimpan ke dalam kolom ini
    protected $fillable = [
        'user_id', 
        'title', 
        'description', 
        'estimated_cost', 
        'proposal_file', 
        'presentation_file', 
        'status'
    ];
}