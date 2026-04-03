<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Project extends Model
{
        protected $fillable = [
        'project_code',
        'agency_id',
        'project_title',
        'estimated_department_cost',
        'objective',
        'scope',
        'implementation_period',
        'funding_source',
        'approval_reference',
        'application_status',
        'status',
        'created_by',
        'officer_name',
        'officer_position',
        'officer_email',
        'officer_phone',
        // document paths
        'proposal_file',
        'presentation_file',
        'urusetia_remarks'
    ];

    // Relationship ke Agency
    public function agency()
    {
        return $this->belongsTo(Agency::class);
    }

    // Relationship ke User (Pencipta Projek)
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function details()
    {
        return $this->hasMany(ProjectDetail::class);
    }

    public function meeting()
    {
        return $this->belongsTo(Meeting::class);
    }
}