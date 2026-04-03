<?php

namespace App\Http\Controllers;

use App\Models\Meeting;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Redirect users to their respective dashboards based on role.
     */
    public function index()
    {
        $user = auth()->user();

        if ($user->role->role_name === 'Superadmin') {
            return redirect()->route('superadmin.audit.index');
        }

        if ($user->role->role_name === 'Urus Setia') {
            return redirect()->route('dashboard.urusetia');
        }

        // For 'Pengguna Biasa', redirect to their project list
        if ($user->role->role_name === 'Pengguna Biasa') {
            return redirect()->route('dashboard.pengguna');
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
        if (auth()->user()->role->role_name !== 'Urus Setia') {
            abort(403, 'ANDA TIDAK DIBENARKAN MENGAKSES HALAMAN INI.');
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
        $user = auth()->user();

        // This check is good practice, even with middleware.
        if (!$user->isPengguna()) {
            abort(403, 'ANDA TIDAK DIBENARKAN MENGAKSES HALAMAN INI.');
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
