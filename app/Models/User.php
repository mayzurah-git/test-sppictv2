<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Agency;
use App\Models\Role;


class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
        protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
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

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function agency()
    {
        return $this->belongsTo(Agency::class);
    }

public function isSuperadmin()
{
    return $this->role->role_name === 'Superadmin';
}

public function isUrusetia()
{
    return $this->role->role_name === 'Urus Setia';
}

public function isPengguna()
{
    return $this->role->role_name === 'Pengguna Biasa';
}

public function isPengurusan()
{
    return $this->role->role_name === 'Pengurusan';
}

public function projects()
{
    return $this->hasMany(Project::class, 'created_by');
}


}
