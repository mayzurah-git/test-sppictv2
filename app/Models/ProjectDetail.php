<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectDetail extends Model
{
        protected $fillable = [
            'project_id',
            'project_category',
            'technical_specification',
            'quantity',
            'unit_cost',
            'total_cost',
        ];

        public function project()
        {
            return $this->belongsTo(Project::class);
        }
}
