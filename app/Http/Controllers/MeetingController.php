<?php

namespace App\Http\Controllers;

use App\Models\Meeting;
use App\Models\AuditLog;
use App\Models\User;
use App\Mail\NewMeetingNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;

class MeetingController extends Controller
{
    public function index()
    {
        // Pastikan hanya Urus Setia boleh akses (atau gunakan Middleware)
        if (!auth()->user()->isUrusetia()) {
            abort(403);
        }

        $meetings = Meeting::latest('date')->paginate(10);
        return view('meetings.index', compact('meetings'));
    }

    public function create()
    {
        if (!auth()->user()->isUrusetia()) {
            abort(403);
        }
        return view('meetings.create');
    }

    public function store(Request $request)
    {
        if (!auth()->user()->isUrusetia()) {
            abort(403);
        }

        $validated = $request->validate([
            'title' => 'required|in:PRA-JTICTNS,JTICTNS,JPICTNS',
            'meeting_number' => 'required|in:1,2,3,4,5,6',
            'year' => 'required|digits:4|integer',
            'date' => 'required|date',
            'time' => 'required',
            'venue' => 'required|string|max:255',
            'status' => 'required|in:Aktif,Tidak Aktif',
            'project_update_deadline' => 'required|date',
            'minutes_file' => 'nullable|file|mimes:pdf,doc,docx|max:10240',
            'agenda' => 'required|string',
        ]);

        // Logik: Hanya satu mesyuarat aktif mengikut kategori
        if ($validated['status'] === 'Aktif') {
            Meeting::where('title', $validated['title'])
                ->where('status', 'Aktif')
                ->update(['status' => 'Tidak Aktif']);
        }

        if ($request->hasFile('minutes_file')) {
            $validated['minutes_file'] = $request->file('minutes_file')->store('meetings', 'public');
        }

        $meeting = Meeting::create($validated);

        AuditLog::create([
            'user_id' => auth()->id(),
            'event' => 'created',
            'auditable_type' => Meeting::class,
            'auditable_id' => $meeting->id,
            'new_values' => $meeting->toArray(),
            'url' => request()->fullUrl(),
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);

        // Logik hantar emel jika checkbox ditanda
        if ($request->has('send_notification')) {
            $emails = User::whereHas('role', function($query) {
                $query->whereIn('role_name', ['Pengguna Biasa', 'Pengurusan']);
            })->pluck('email');

            if ($emails->isNotEmpty()) {
                Mail::bcc($emails)->send(new NewMeetingNotification($meeting));
            }
        }

        return redirect()->route('meetings.index')->with('success', 'Mesyuarat berjaya didaftarkan.');
    }

    public function edit(Meeting $meeting)
    {
        if (!auth()->user()->isUrusetia()) {
            abort(403);
        }
        return view('meetings.edit', compact('meeting'));
    }

    public function update(Request $request, Meeting $meeting)
    {
        if (!auth()->user()->isUrusetia()) {
            abort(403);
        }

        $validated = $request->validate([
            'title' => 'required|in:PRA-JTICTNS,JTICTNS,JPICTNS',
            'meeting_number' => 'required|in:1,2,3,4,5,6',
            'year' => 'required|digits:4|integer',
            'date' => 'required|date',
            'time' => 'required',
            'venue' => 'required|string|max:255',
            'status' => 'required|in:Aktif,Tidak Aktif',
            'project_update_deadline' => 'required|date',
            'minutes_file' => 'nullable|file|mimes:pdf,doc,docx|max:10240',
            'agenda' => 'required|string',
        ]);

        // Logik: Hanya satu mesyuarat aktif mengikut kategori
        if ($validated['status'] === 'Aktif') {
            Meeting::where('title', $validated['title'])
                ->where('id', '!=', $meeting->id) // Kecualikan mesyuarat semasa
                ->where('status', 'Aktif')
                ->update(['status' => 'Tidak Aktif']);
        }

        if ($request->hasFile('minutes_file')) {
            if ($meeting->minutes_file) {
                Storage::disk('public')->delete($meeting->minutes_file);
            }
            $validated['minutes_file'] = $request->file('minutes_file')->store('meetings', 'public');
        }

        $meeting->fill($validated);

        if ($meeting->isDirty()) {
            $changes = $meeting->getChanges();
            $old_values = [];
            foreach (array_keys($changes) as $attribute) {
                $old_values[$attribute] = $meeting->getOriginal($attribute);
            }
            
            $meeting->save();

            AuditLog::create([
                'user_id' => auth()->id(),
                'event' => 'updated',
                'auditable_type' => Meeting::class,
                'auditable_id' => $meeting->id,
                'old_values' => $old_values,
                'new_values' => $changes,
                'url' => request()->fullUrl(),
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent(),
            ]);
        }

        if ($request->has('send_notification')) {
            $emails = User::whereHas('role', function($query) {
                $query->whereIn('role_name', ['Pengguna Biasa', 'Pengurusan']);
            })->pluck('email');

            if ($emails->isNotEmpty()) {
                Mail::bcc($emails)->send(new NewMeetingNotification($meeting));
            }
        }

        return redirect()->route('meetings.index')->with('success', 'Maklumat mesyuarat berjaya dikemaskini.');
    }

    public function destroy(Meeting $meeting)
    {
        if (!auth()->user()->isUrusetia()) {
            abort(403);
        }

        if ($meeting->minutes_file) {
            Storage::disk('public')->delete($meeting->minutes_file);
        }

        $meeting->delete();

        return redirect()->route('meetings.index')->with('success', 'Mesyuarat berjaya dipadam.');
    }
}
