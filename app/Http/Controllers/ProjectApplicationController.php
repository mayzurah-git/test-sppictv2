<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProjectApplication;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProjectApplicationController extends Controller
{
    // Memaparkan borang pendaftaran (Rujukan: Mula -> Login -> Dashboard -> Daftar)
    public function create()
    {
        return view('projects.create');
    }

    // Menyimpan data permohonan (Rujukan: Anggaran Harga, Maklumat Projek, Muat Naik Fail)
    public function store(Request $request)
    {
        // 1. Validasi Data
        $request->validate([
            'title' => 'required|string|max:255',
            'estimated_cost' => 'required|numeric',
            'proposal_file' => 'required|mimes:pdf|max:5120', // Had 5MB
            'presentation_file' => 'nullable|mimes:pdf,pptx|max:5120',
        ]);

        // 2. Urus Muat Naik Fail (Rujukan Carta Alir: Kotak 49)
        $proposalPath = $request->file('proposal_file')->store('proposals', 'public');
        
        $presentationPath = null;
        if ($request->hasFile('presentation_file')) {
            $presentationPath = $request->file('presentation_file')->store('presentations', 'public');
        }

        // 3. Simpan ke Pangkalan Data (Status automatik 'Draf')
        ProjectApplication::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description ?? '-', // Maklumat Perincian
            'estimated_cost' => $request->estimated_cost,
            'proposal_file' => $proposalPath,
            'presentation_file' => $presentationPath,
            'status' => 'Draf', // Rujukan Carta Alir: Kotak 45
        ]);

        return redirect()->route('dashboard')->with('success', 'Permohonan berjaya didaftarkan sebagai Draf.');
    }
}