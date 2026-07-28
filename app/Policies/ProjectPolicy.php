<?php

namespace App\Policies;

use App\Models\Project;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ProjectPolicy
{
    
    public function before(User $user, string $ability)
    {
        if ($user->hasRole(User::ROLE_SUPER_ADMIN)) {
            return true;
        }

        return null;
    }
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole([
            User::ROLE_SUPER_ADMIN,
            User::ROLE_URUS_SETIA,
            User::ROLE_PENGURUSAN,
            User::ROLE_PENGGUNA,
        ]);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Project $project): bool
    {
        if (
            $user->hasRole(User::ROLE_SUPER_ADMIN) ||
            $user->hasRole(User::ROLE_URUS_SETIA) ||
            $user->hasRole(User::ROLE_PENGURUSAN)
        ) {
            return true;
        }

        if ($user->hasRole(User::ROLE_PENGGUNA)) {
            return $project->agency_id == $user->agency_id;
        }

        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasRole(User::ROLE_PENGGUNA);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Project $project): bool
    {
        if ($user->hasRole(User::ROLE_SUPER_ADMIN)) {
            return true;
        }

        if ($user->hasRole(User::ROLE_URUS_SETIA)) {
            return true;
        }

        if ($user->hasRole(User::ROLE_PENGGUNA)) {

            return
            $project->created_by === $user->id
            &&
            in_array(
                $project->application_status,
                ['Draf','Tidak Lengkap']
            );
        }

        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Project $project): bool
    {
        if ($user->hasRole(User::ROLE_SUPER_ADMIN)) {
            return true;
        }

        if ($user->hasRole(User::ROLE_PENGGUNA)) {

            return
                $project->created_by == $user->id
                &&
                $project->application_status == 'Draf';
        }

        return false;
    }

    public function updateStatus(User $user, Project $project): bool
    {
        return $user->hasRole(User::ROLE_URUS_SETIA)
         &&
        in_array(
            $project->application_status,
            [
                'Hantar - Tunggu Semakan Urus Setia',
                'Tidak Lengkap',
                'Lengkap',
            ]
        );
    }

    public function updateRemarks(User $user, Project $project): bool
    {
        return $user->hasRole(User::ROLE_URUS_SETIA);
    }

    public function print(User $user, Project $project): bool
    {
        return $this->view($user, $project);
    }
    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Project $project): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Project $project): bool
    {
        return false;
    }
}
