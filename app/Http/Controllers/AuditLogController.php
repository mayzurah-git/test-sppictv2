<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;
use Illuminate\Http\Request;

class AuditLogController extends Controller
{
    public function index()
    {
        // Ambil log dengan eager loading, susunan terbaharu, dan paginasi
        $logs = AuditLog::with(['user', 'auditable'])
                        ->latest()
                        ->paginate(25);

        return view('audit.index', compact('logs'));
    }
}
