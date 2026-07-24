<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Spatie\Permission\Traits\HasRoles;

use App\Models\Agency;
use App\Models\Project;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    public const ROLE_SUPER_ADMIN = 'Super Admin';
    public const ROLE_URUS_SETIA = 'Urus Setia';
    public const ROLE_PENGURUSAN = 'Pengurusan';
    public const ROLE_PENGGUNA = 'Pengguna';

    protected $fillable = [
        'name',
        'email',
        'password',
        'agency_id',
        ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
    return [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        ];
    }

    public function agency()
    {
        return $this->belongsTo(Agency::class);
    }

    public function projects()
    {
        return $this->hasMany(Project::class, 'created_by');
    }

    public function isSuperAdmin(): bool
    {
        return $this->hasRole(self::ROLE_SUPER_ADMIN);
    }

    public function isUrusSetia(): bool
    {
        return $this->hasRole(self::ROLE_URUS_SETIA);
    }

    public function isPengurusan(): bool
    {
        return $this->hasRole(self::ROLE_PENGURUSAN);
    }

    public function isPengguna(): bool
    {
        return $this->hasRole(self::ROLE_PENGGUNA);
    }

    public function canManageUsers(): bool
    {
        return $this->can('user.view');
    }

    public function canManageProjects(): bool
    {
        return $this->can('project.view');
    }

    public function canManageMeetings(): bool
    {
        return $this->can('meeting.view');
    }
}