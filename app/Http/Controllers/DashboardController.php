<?php

namespace App\Http\Controllers;

use App\Models\Meeting;
use App\Models\Project;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Redirect users to their respective dashboards based on role.
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->hasRole(User::ROLE_SUPER_ADMIN)) {
            return redirect()->route('superadmin.audit.index');
        }

        if ($user->hasRole(User::ROLE_URUS_SETIA)) {
            return redirect()->route('dashboard');
        }

        // For 'Pengguna Biasa', redirect to their project list
        if ($user->hasRole(User::ROLE_PENGGUNA)) {
            return redirect()->route('dashboard');
        }

        if ($user->hasRole(User::ROLE_PENGURUSAN)) {
            return redirect()->route('dashboard');
        }

        // Fallback for other roles or if a default dashboard view exists
        return view('dashboard');
    }

    /**
     * Display the dashboard for the 'Urus Setia' role.
     */
    public function urusetiaDashboard()
    {
        // This check is good practice, even with middleware, for direct method calls.
        if (! Auth::user()->hasRole('Urus Setia')) {

            abort(403);

        }
        // Get statistics using a single query for efficiency
        $stats = Project::select('application_status', DB::raw('count(*) as total'))
                        ->whereIn('application_status', [
                            'Hantar - Tunggu Semakan Urus Setia',
                            'Lengkap',
                            'Tidak Lengkap'
                        ])
                        ->groupBy('application_status')
                        ->get()
                        ->keyBy('application_status');

        $countBaru = $stats->get('Hantar - Tunggu Semakan Urus Setia')->total ?? 0;
        $countLengkap = $stats->get('Lengkap')->total ?? 0;
        $countTidakLengkap = $stats->get('Tidak Lengkap')->total ?? 0;

        // Get the total number of all projects
        $totalProjects = Project::count();

        // Get active meetings
        $activeMeetings = Meeting::where('status', 'Aktif')->orderBy('date', 'asc')->get();

        return view('dashboard.urusetia', compact('countBaru', 'countLengkap', 'countTidakLengkap', 'totalProjects', 'activeMeetings'));
    }

    /**
     * Display the dashboard for the 'Pengguna Biasa' role.
     */
    public function penggunaDashboard()
    {
        $user = Auth::user();

        // This check is good practice, even with middleware.
        if (! Auth::user()->hasRole('Pengguna')) {

            abort(403);

        }

        // 1. Get Active Meetings
        $activeMeetings = Meeting::where('status', 'Aktif')->orderBy('date', 'asc')->get();

        // 2. Get User's Projects (latest 5)
        $projects = Project::where('agency_id', $user->agency_id)
                            ->latest()
                            ->paginate(5);

        return view('dashboard.pengguna', compact('activeMeetings', 'projects'));
    }
}
