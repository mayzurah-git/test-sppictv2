<?php

namespace App\Http\Controllers;

use App\Mail\ProjectReturnedNotification;
use App\Mail\ProjectCompletedNotification;
use App\Models\ProjectDetail;
use App\Models\Project;
use App\Models\Agency;
use App\Models\AuditLog;
use App\Models\Position;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Mail\ProjectSubmittedNotification;


class ProjectController extends Controller
{
    public function create()
    {
        $agencies = Agency::all();
        return view('projects.create', compact('agencies'));
    }

    public function storeStep1(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'agency_id' => 'required|exists:agencies,id',
            'project_title' => 'required|string|max:255',
            'estimated_department_cost' => 'required|numeric',
            'objective' => 'required|string',
            'scope' => 'required|string',
            'implementation_period' => 'required|string',
            'funding_source' => 'required|string',
            'approval_reference' => 'required|string',
        ], [
            'agency_id.required' => 'Sila pilih Jabatan / Agensi.',
            'project_title.required' => 'Nama Projek wajib diisi.',
            'estimated_department_cost.required' => 'Anggaran Harga Jabatan wajib diisi.',
            'estimated_department_cost.numeric' => 'Anggaran Harga Jabatan mestilah nombor.',
            'objective.required' => 'Objektif Projek wajib diisi.',
            'scope.required' => 'Skop Projek wajib diisi.',
            'implementation_period.required' => 'Tempoh Pelaksanaan wajib diisi.',
            'funding_source.required' => 'Sumber Peruntukan wajib diisi.',
            'approval_reference.required' => 'Rujukan Kelulusan wajib diisi.',
        ]);

        // Untuk keselamatan, paksa 'Pengguna Biasa' menggunakan agensi mereka sendiri
        $agencyId = $user->role->role_name === 'Pengguna Biasa' ? $user->agency_id : $request->agency_id;

        $year = date('Y');

        $agency = Agency::findOrFail($agencyId);

        $count = Project::where('agency_id', $agency->id)
            ->whereYear('created_at', $year)
            ->count() + 1;

        $runningNumber = str_pad($count, 3, '0', STR_PAD_LEFT);

        $projectCode = $agency->agency_code . '/' . $year . '/' . $runningNumber;

        $project = Project::create([
            'project_code' => $projectCode,
            'agency_id' => $agencyId,
            'project_title' => $request->project_title,
            'estimated_department_cost' => $request->estimated_department_cost,
            'objective' => $request->objective,
            'scope' => $request->scope,
            'implementation_period' => $request->implementation_period,
            'funding_source' => $request->funding_source,
            'approval_reference' => $request->approval_reference,
            'application_status' => 'Draf',
            'status' => 'Perancangan',
            'created_by' => $user->id,
        ]);

        AuditLog::create([
            'user_id' => $user->id,
            'event' => 'created',
            'auditable_type' => Project::class,
            'auditable_id' => $project->id,
            'new_values' => $project->toArray(),
            'url' => request()->fullUrl(),
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);

        return redirect()->route('projects.details.create', $project->id)
        ->with('success', 'Fasa 1 berjaya disimpan. Sila lengkapkan Perincian Projek.');
    }

    /**
     * Ensure a project may still be changed by the current user.
     *
     * Once a project has been submitted to Urus Setia or marked ``Lengkap`` it
     * is considered final and Pengguna Biasa should not be able to alter it.
     * This check is applied across all modification endpoints.
     */
    protected function assertProjectEditable(Project $project)
    {
        // Pengguna Biasa hanya boleh edit projek berstatus 'Draf' atau 'Tidak Lengkap'.
        $user = Auth::user();
        if ($user->role->role_name === 'Pengguna Biasa') {
            // Hanya pencipta asal sahaja boleh mengedit
            if ($project->created_by !== $user->id) {
                abort(403, 'ANDA TIDAK DIBENARKAN MENGEMASKINI PROJEK INI (Hanya pencipta sahaja).');
            }
            // Pengguna Biasa hanya boleh edit projek berstatus 'Draf' atau 'Tidak Lengkap'.
            if (!in_array($project->application_status, ['Draf', 'Tidak Lengkap'])) {
                abort(403, 'Permohonan projek tidak lagi boleh dikemaskini pada status ini.');
            }
        }
    }

    public function edit(Project $project)
    {
        // Pastikan pengguna mempunyai kebenaran untuk edit
        $user = Auth::user();
        if ($user->role->role_name === 'Pengguna Biasa' && $project->created_by !== $user->id) {
            abort(403, 'ANDA TIDAK DIBENARKAN MENGEMASKINI PROJEK INI (Hanya pencipta sahaja).');
        }

        $this->assertProjectEditable($project);

        $agencies = Agency::all();
        return view('projects.edit', compact('project', 'agencies'));
    }

    public function update(Request $request, Project $project)
    {
        // Pastikan pengguna mempunyai kebenaran untuk update
        $user = Auth::user();
        if ($user->role->role_name === 'Pengguna Biasa' && $project->created_by !== $user->id) {
            abort(403, 'ANDA TIDAK DIBENARKAN MENGEMASKINI PROJEK INI (Hanya pencipta sahaja).');
        }

        $request->validate([
            'project_title' => 'required|string|max:255',
            'estimated_department_cost' => 'required|numeric',
            'objective' => 'required|string',
            'scope' => 'required|string',
            'implementation_period' => 'required|string',
            'funding_source' => 'required|string',
            'approval_reference' => 'required|string',
        ], [
            'project_title.required' => 'Nama Projek wajib diisi.',
            'estimated_department_cost.required' => 'Anggaran Harga Jabatan wajib diisi.',
            'estimated_department_cost.numeric' => 'Anggaran Harga Jabatan mestilah nombor.',
            'objective.required' => 'Objektif Projek wajib diisi.',
            'scope.required' => 'Skop Projek wajib diisi.',
            'implementation_period.required' => 'Tempoh Pelaksanaan wajib diisi.',
            'funding_source.required' => 'Sumber Peruntukan wajib diisi.',
            'approval_reference.required' => 'Rujukan Kelulusan wajib diisi.',
        ]);

        $project->update([
            'project_title' => $request->project_title,
            'estimated_department_cost' => $request->estimated_department_cost,
            'objective' => $request->objective,
            'scope' => $request->scope,
            'implementation_period' => $request->implementation_period,
            'funding_source' => $request->funding_source,
            'approval_reference' => $request->approval_reference,
        ]);

        // Rekod Log Audit
        if ($project->wasChanged()) {
            $changes = $project->getChanges();
            $old_values = [];
            // Dapatkan nilai lama hanya untuk atribut yang berubah
            foreach (array_keys($changes) as $attribute) {
                $old_values[$attribute] = $project->getOriginal($attribute);
            }

            AuditLog::create([
                'user_id' => $user->id,
                'event' => 'updated',
                'auditable_type' => Project::class,
                'auditable_id' => $project->id,
                'old_values' => $old_values,
                'new_values' => $changes,
                'url' => request()->fullUrl(),
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent(),
            ]);
        }

        return redirect()->route('projects.edit', $project->id)
                         ->with('success', 'Maklumat Telah Dikemaskini');
    }
    public function updateStatus(Request $request, Project $project)
    {
        // Hanya Urus Setia boleh kemaskini status
        if (Auth::user()->role->role_name !== 'Urus Setia') { // TODO: Guna Policy
            abort(403, 'ANDA TIDAK DIBENARKAN MENGAKSES HALAMAN INI');
        }

        $rules = [
            'application_status' => 'required|string|in:Lengkap,Tidak Lengkap',
            'urusetia_remarks' => 'nullable|string|max:5000',
        ];

        // Ulasan adalah wajib jika status 'Tidak Lengkap'
        if ($request->application_status === 'Tidak Lengkap') {
            $rules['urusetia_remarks'] = 'required|string|max:5000';
        }

        $validatedData = $request->validate($rules, [
            'urusetia_remarks.required' => 'Ulasan perlu diisi jika status adalah "Tidak Lengkap".'
        ]);

        $project->update($validatedData);

        if ($project->wasChanged()) {
            $changes = $project->getChanges();
            unset($changes['updated_at']);
            $old_values = [];
            foreach (array_keys($changes) as $attribute) {
                $old_values[$attribute] = $project->getOriginal($attribute);
            }
            if (!empty($changes)) {
                AuditLog::create([
                    'user_id' => Auth::id(),
                    'event' => 'status_updated',
                    'auditable_type' => Project::class,
                    'auditable_id' => $project->id,
                    'old_values' => $old_values,
                    'new_values' => $changes,
                    'url' => request()->fullUrl(),
                    'ip_address' => request()->ip(),
                    'user_agent' => request()->userAgent(),
                ]);
            }

            $emailNotificationMsg = '';
            // Hantar notifikasi emel jika status berubah
            if (array_key_exists('application_status', $changes)) {
                // Semak sama ada creator wujud dan ada emel, atau fallback ke emel pegawai
                $recipientEmail = $project->creator ? $project->creator->email : $project->officer_email;

                if ($recipientEmail) {
                    if ($project->application_status === 'Tidak Lengkap') {
                        Mail::to($recipientEmail)->send(new ProjectReturnedNotification($project));
                    } elseif ($project->application_status === 'Lengkap') {
                        Mail::to($recipientEmail)->send(new ProjectCompletedNotification($project));
                    }
                    $emailNotificationMsg = ' dan notifikasi emel telah dihantar kepada pemohon.';
                } else {
                    $emailNotificationMsg = '. Namun, notifikasi emel GAGAL dihantar kerana tiada alamat emel pemohon/pegawai.';
                }
            }
        }

        return back()->with('success', 'Status projek berjaya dikemaskini' . ($emailNotificationMsg ?? ''));
    }

    public function updateRemarks(Request $request, Project $project)
    {
        // Hanya Urus Setia boleh kemaskini ulasan
        if (Auth::user()->role->role_name !== 'Urus Setia') {
            abort(403, 'ANDA TIDAK DIBENARKAN MENGAKSES HALAMAN INI');
        }

        $request->validate([
            'urusetia_remarks' => 'nullable|string|max:5000',
        ]);

        $project->update([
            'urusetia_remarks' => $request->urusetia_remarks
        ]);

        if ($project->wasChanged()) {
            $changes = $project->getChanges();
            unset($changes['updated_at']);
            
            $old_values = [];
            foreach (array_keys($changes) as $attribute) {
                $old_values[$attribute] = $project->getOriginal($attribute);
            }

            AuditLog::create([
                'user_id' => Auth::id(),
                'event' => 'remarks_updated',
                'auditable_type' => Project::class,
                'auditable_id' => $project->id,
                'old_values' => $old_values,
                'new_values' => $changes,
                'url' => request()->fullUrl(),
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent(),
            ]);
        }

        return back()->with('success', 'Ulasan Urus Setia berjaya dikemaskini tanpa menukar status.');
    }

    public function createStatusUpdate(Project $project)
    {
        // Double-check authorization even with middleware
        if (Auth::user()->role->role_name !== 'Urus Setia') {
            abort(403, 'ANDA TIDAK DIBENARKAN MENGAKSES HALAMAN INI.');
        }

        // Ensure action is only possible on relevant statuses
        if (!in_array($project->application_status, ['Hantar - Tunggu Semakan Urus Setia', 'Tidak Lengkap', 'Lengkap'])) {
            return redirect()->route('projects.index')->with('error', 'Tindakan tidak dibenarkan untuk status projek ini.');
        }

        return view('projects.status.edit', compact('project'));
    }


    public function index(Request $request)
    {
        $user = Auth::user();
        $search = $request->input('search');
        $year = $request->input('year');
        $status = $request->input('status');

        // Mulakan query dengan eager loading dan susunan terbaharu
        $query = Project::with('agency')->latest();

        // Jika pengguna biasa, hadkan kepada projek di bawah agensi mereka sahaja
        if ($user->role->role_name === 'Pengguna Biasa') {
            $query->where('agency_id', $user->agency_id);
        }

        // Filter 1: Tahun
        if ($year) {
            $query->whereYear('created_at', $year);
        }

        // Filter 2: Status Permohonan
        if ($status) {
            $query->where('application_status', $status);
        }

        // Filter 3: Nama Projek
        if ($search) {
            $query->where('project_title', 'like', "%{$search}%");
        }

        $projects = $query->paginate(10);

        // Dapatkan senarai tahun yang ada dalam database untuk dropdown
        $yearsQuery = Project::selectRaw('YEAR(created_at) as year')->distinct()->orderBy('year', 'desc');
        if ($user->role->role_name === 'Pengguna Biasa') {
            $yearsQuery->where('agency_id', $user->agency_id);
        }
        $years = $yearsQuery->pluck('year');

        return view('projects.index', compact('projects', 'years'));
    }
    

    public function show(Project $project)
    {
        $user = Auth::user();

        if ($user->role->role_name === 'Pengguna Biasa' 
            && $project->agency_id !== $user->agency_id) {
            abort(403, 'ANDA TIDAK DIBENARKAN MENGAKSES HALAMAN INI');
        }

        $remarksHistory = collect();

        // Hanya ambil sejarah jika pengguna adalah Urus Setia
        if ($user->isUrusetia()) {
            $remarksHistory = AuditLog::where('auditable_type', Project::class)
                ->where('auditable_id', $project->id)
                ->whereIn('event', ['status_updated', 'remarks_updated'])
                ->with('user')
                ->latest()
                ->get();
        }

        return view('projects.show', compact('project', 'remarksHistory'));
    }

    public function print(Project $project)
    {
        $user = Auth::user();

        if ($user->role->role_name === 'Pengguna Biasa' 
            && $project->agency_id !== $user->agency_id) {
            abort(403, 'ANDA TIDAK DIBENARKAN MENGAKSES HALAMAN INI');
        }

        return view('projects.print', compact('project'));
    }

    public function createDetail(Project $project)
{
    $this->assertProjectEditable($project);
    return view('projects.details.create', compact('project'));
}

    public function storeDetail(Request $request, Project $project)
    {
        $this->assertProjectEditable($project);

        $request->validate([
            'project_category' => 'required|in:Projek Baharu,Peningkatan Sistem,Peluasan Sistem / Projek,Penambahbaikan Peralatan,Penyelenggaraan,Khidmat Perunding ICT',
            'technical_specification' => 'required|string',
            'quantity' => 'required|integer|min:1',
            'unit_cost' => 'required|numeric|min:0',
        ], [
            'project_category.required' => 'Kategori Projek wajib dipilih.',
            'technical_specification.required' => 'Spesifikasi Teknikal wajib diisi.',
            'quantity.required' => 'Jumlah Unit diperlukan wajib diisi.',
            'unit_cost.required' => 'Anggaran Kos Seunit wajib diisi.',
        ]);
        
        $total = $request->quantity * $request->unit_cost;
        
        // Semakan Bajet: Pastikan jumlah kos tidak melebihi Anggaran Harga Jabatan
        $currentTotal = $project->details()->sum('total_cost');
        if (($currentTotal + $total) > $project->estimated_department_cost) {
            $errorMessage = 'Jumlah kos perincian melebihi Anggaran Harga Jabatan (RM ' . number_format($project->estimated_department_cost, 2) . '). Baki peruntukan yang tinggal: RM ' . number_format($project->estimated_department_cost - $currentTotal, 2);
            return back()->withInput()->with('error_budget', $errorMessage);
        }

        $detail = $project->details()->create([
            'project_category' => $request->project_category,
            'technical_specification' => $request->technical_specification,
            'quantity' => $request->quantity,
            'unit_cost' => $request->unit_cost,
            'total_cost' => $total,
        ]);

        AuditLog::create([
            'user_id' => Auth::id(),
            'event' => 'created',
            'auditable_type' => ProjectDetail::class,
            'auditable_id' => $detail->id,
            'new_values' => $detail->toArray(),
            'url' => request()->fullUrl(),
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);

        return back()->with('success', 'Perincian berjaya ditambah.');
    }

    public function destroyDetail(Project $project, ProjectDetail $detail)
    {
        $this->assertProjectEditable($project);

        // Pastikan detail yang ingin dipadam adalah milik projek yang betul
        if ($detail->project_id !== $project->id) {
            abort(404);
        }

        AuditLog::create([
            'user_id' => Auth::id(),
            'event' => 'deleted',
            'auditable_type' => ProjectDetail::class,
            'auditable_id' => $detail->id,
            'old_values' => $detail->toArray(),
            'url' => request()->fullUrl(),
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);

        $detail->delete();

        return back()->with('success', 'Butiran perincian berjaya dipadam.');
    }

    public function editDetail(Project $project, ProjectDetail $detail)
    {
        $this->assertProjectEditable($project);
        return view('projects.details.edit', compact('project', 'detail'));
    }

    public function updateDetail(Request $request, Project $project, ProjectDetail $detail)
    {
        $this->assertProjectEditable($project);

        $validated = $request->validate([
            'project_category' => 'required|in:Projek Baharu,Peningkatan Sistem,Peluasan Sistem / Projek,Penambahbaikan Peralatan,Penyelenggaraan,Khidmat Perunding ICT',
            'technical_specification' => 'required|string',
            'quantity' => 'required|integer|min:1',
            'unit_cost' => 'required|numeric|min:0',
        ]);

        $validated['total_cost'] = $validated['quantity'] * $validated['unit_cost'];

        // Semakan Bajet: Kira jumlah kos perincian LAIN + kos baharu ini
        $otherDetailsTotal = $project->details()->where('id', '!=', $detail->id)->sum('total_cost');
        if (($otherDetailsTotal + $validated['total_cost']) > $project->estimated_department_cost) {
            $errorMessage = 'Jumlah kos perincian yang dikemaskini melebihi Anggaran Harga Jabatan (RM ' . number_format($project->estimated_department_cost, 2) . '). Baki peruntukan yang tinggal: RM ' . number_format($project->estimated_department_cost - $otherDetailsTotal, 2);
            return back()->withInput()->with('error_budget', $errorMessage);
        }

        $detail->update($validated);

        if ($detail->wasChanged()) {
            $changes = $detail->getChanges();
            $old_values = [];
            foreach (array_keys($changes) as $attribute) {
                $old_values[$attribute] = $detail->getOriginal($attribute);
            }

            AuditLog::create([
                'user_id' => Auth::id(),
                'event' => 'updated',
                'auditable_type' => ProjectDetail::class,
                'auditable_id' => $detail->id,
                'old_values' => $old_values,
                'new_values' => $changes,
                'url' => request()->fullUrl(),
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent(),
            ]);
        }
        return redirect()->route('projects.details.create', $project->id)
                         ->with('success', 'Butiran perincian berjaya dikemaskini.');
    }

    public function createDocument(Project $project)
    {
        $this->assertProjectEditable($project);
        return view('projects.documents.create', compact('project'));
    }

    public function storeDocument(Request $request, Project $project)
    {
        $this->assertProjectEditable($project);
        // Ubah suai validasi: Jika fail sudah ada, tidak wajib muat naik semula
        $rules = [
            'presentation_file' => 'nullable|file|mimes:pdf|max:10240',
        ];

        if (!$project->proposal_file) {
            $rules['proposal_file'] = 'required|file|mimes:pdf|max:10240';
        } else {
            $rules['proposal_file'] = 'nullable|file|mimes:pdf|max:10240';
        }

        $request->validate($rules);

        if ($request->hasFile('proposal_file')) {
            if ($project->proposal_file) Storage::disk('public')->delete($project->proposal_file);
            $path = $request->file('proposal_file')->store('documents/' . $project->id, 'public');
            $project->proposal_file = $path;
        }

        if ($request->hasFile('presentation_file')) {
            if ($project->presentation_file) Storage::disk('public')->delete($project->presentation_file);
            $path = $request->file('presentation_file')->store('documents/' . $project->id, 'public');
            $project->presentation_file = $path;
        }

        $project->save();

        if ($request->input('action') === 'save') {
            return back()->with('success', 'Dokumen berjaya disimpan.');
        }

        return redirect()->route('projects.officer.create', $project->id)->with('success', 'Dokumen berjaya dimuat naik. Sila lengkapkan maklumat pegawai.');
    }

    public function destroyDocument(Project $project, $type)
    {
        $this->assertProjectEditable($project);
        if (!in_array($type, ['proposal', 'presentation'])) {
            abort(404);
        }

        $column = $type . '_file';

        if ($project->$column) {
            // delete physical file if it exists
            Storage::disk('public')->delete($project->$column);

            // make sure we clear the attribute on the model and persist it
            // use assignment/save instead of update() because proposal_file and
            // presentation_file are not in the fillable array and would be
            // ignored by mass assignment.
            $project->$column = null;
            $project->save();
        }

        return back()->with('success', 'Dokumen berjaya dipadam. Sila muat naik fail baru.');
    }

    public function createOfficer(Project $project)
    {
        $this->assertProjectEditable($project);

        $user = Auth::user();
        if ($user->role->role_name === 'Pengguna Biasa' && $project->created_by !== $user->id) {
            abort(403, 'Hanya pengguna yang mencipta projek ini boleh mengisi maklumat pegawai.');
        }

        $positions = Position::orderBy('position_name', 'asc')->get();
        return view('projects.officer.create', compact('project', 'positions'));
    }

    public function storeOfficer(Request $request, Project $project)
    {
        $this->assertProjectEditable($project);
        // Semakan kebenaran: Hanya pengguna yang mencipta projek boleh menyimpan maklumat ini.
        $user = Auth::user();
        if ($user->role->role_name === 'Pengguna Biasa' && $project->created_by !== $user->id) {
            abort(403, 'Anda tidak dibenarkan untuk menyimpan maklumat pegawai bagi projek ini.');
        }

        $validatedData = $request->validate([
            'officer_name' => 'required|string|max:255',
            'officer_position' => 'required|string|max:255',
            'officer_email' => 'required|email|max:255',
            'officer_phone' => 'required|string|max:20',
            'action' => 'required|in:save,submit',
        ]);

        $updateData = [
            'officer_name' => $validatedData['officer_name'],
            'officer_position' => $validatedData['officer_position'],
            'officer_email' => $validatedData['officer_email'],
            'officer_phone' => $validatedData['officer_phone'],
        ];

        // Hanya tukar status apabila pengguna klik 'Hantar Permohonan'.
        // sebelumnya status mungkin 'Perancangan' atau lain‑lain; selepas hantar
        // ia patut menjadi 'Tunggu Semakan Urus Setia'.
        if ($request->action === 'submit') {
            $updateData['application_status'] = 'Hantar - Tunggu Semakan Urus Setia';
            $updateData['urusetia_remarks'] = null; // Kosongkan ulasan apabila hantar semula
        }

        $project->update($updateData);

        if ($project->wasChanged()) {
            $changes = $project->getChanges();
            $old_values = [];
            foreach (array_keys($changes) as $attribute) {
                $old_values[$attribute] = $project->getOriginal($attribute);
            }

            AuditLog::create([
                'user_id' => Auth::id(),
                'event' => 'officer_updated',
                'auditable_type' => Project::class,
                'auditable_id' => $project->id,
                'old_values' => $old_values,
                'new_values' => $changes,
                'url' => request()->fullUrl(),
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent(),
            ]);
        }

        if ($request->action === 'save') {
            return back()->with('success', 'Maklumat pegawai berjaya disimpan.');
        }

        // ----- begin guardrail checks that were previously in submitProject -----
        // these must all pass before we send the notification e‑mail
        if ($project->details()->count() == 0) {
            return back()->with('error', 'Perincian projek belum lengkap.')->withInput();
        }

        // at least one of the two document types must exist
        if (!$project->proposal_file && !$project->presentation_file) {
            return back()->with('error', 'Sila muat naik sekurang-kurangnya satu dokumen.')->withInput();
        }

        // officer info is already being validated above, so no extra check here

        $jumlahPerincian = $project->details()->sum('total_cost');
        $anggaranJabatan = $project->estimated_department_cost;

        if ($jumlahPerincian != $anggaranJabatan) {
            return back()->with('error', 'Jumlah perincian projek tidak sama dengan Anggaran Harga Jabatan.')->withInput();
        }
        // ----- end guardrail checks -----

        // Hantar notifikasi emel kepada Urus Setia
        Mail::to(config('mail.urus_setia'))->send(new ProjectSubmittedNotification($project));

        // Laluan untuk 'submit'
        return redirect()->route('projects.index')->with('success', 'Permohonan projek berjaya dihantar sepenuhnya.');
    }

        
    public function destroy(Project $project)
    {
        $this->assertProjectEditable($project);
        // Semakan kebenaran (Authorization)
        $user = Auth::user();
        if ($user->role->role_name === 'Pengguna Biasa' && $project->created_by !== $user->id) {
            abort(403, 'ANDA TIDAK DIBENARKAN MEMADAM PROJEK INI.');
        }

        AuditLog::create([
            'user_id' => $user->id,
            'event' => 'deleted',
            'auditable_type' => Project::class,
            'auditable_id' => $project->id,
            'old_values' => $project->toArray(),
            'url' => request()->fullUrl(),
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);

        // Padam fail fizikal jika wujud
        if ($project->proposal_file) Storage::disk('public')->delete($project->proposal_file);
        if ($project->presentation_file) Storage::disk('public')->delete($project->presentation_file);

        // Padam rekod perincian dan projek
        $project->details()->delete();
        $project->delete();

        return back()->with('success', 'Projek berjaya dipadam sepenuhnya.');
    }

        // NOTE: old submitPage/submitProject methods were removed because
        // the officer form is now responsible for dispatching the request and
        // performing all the validation checks.  The route definitions have
        // also been cleaned up so there is no stray '/projects/projects/...'
        // endpoint.
    }