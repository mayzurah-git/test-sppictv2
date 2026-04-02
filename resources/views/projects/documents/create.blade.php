@php
    function formatBytes($bytes, $precision = 2) {
        if ($bytes <= 0) return '0 B';
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        $pow = floor(log($bytes, 1024));
        return round($bytes / (1024 ** $pow), $precision) . ' ' . $units[$pow];
    }
    $isPenggunaBiasa = auth()->user()->role->role_name === 'Pengguna Biasa';
    $editable = !$isPenggunaBiasa || in_array($project->application_status, ['Draf', 'Tidak Lengkap']);
@endphp
<x-app-layout>
    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <h2 class="text-xl font-semibold mb-4">Permohonan Projek: <span class="font-normal">{{ $project->project_title }}</span></h2>
            <x-project-breadcrumbs currentStep="Muat Naik Dokumen" :project="$project" />

            @if($project->application_status === 'Tidak Lengkap' && $project->urusetia_remarks)
                <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 my-4" role="alert">
                    <p class="font-bold">Ulasan Urus Setia (Sila buat pembetulan):</p>
                    <div class="prose prose-sm max-w-none mt-1">{!! nl2br(e($project->urusetia_remarks)) !!}</div>
                </div>
            @endif

            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                <div class="mb-6 p-4 bg-yellow-50 border border-yellow-200 rounded">
                    <p class="text-sm text-yellow-800">
                        Sila muat naik dokumen yang diperlukan untuk melengkapkan permohonan projek <strong>{{ $project->project_title }}</strong>.
                    </p>
                </div>

                {{-- success message replaced by SweetAlert below --}}
                @if (session('success'))
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berjaya',
                                text: {!! json_encode(session('success')) !!},
                                timer: 3000,
                                showConfirmButton: false
                            });
                        });
                    </script>
                @endif

                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if($editable)
                <form method="POST" action="{{ route('projects.documents.store', $project->id) }}" enctype="multipart/form-data">
                    @csrf

                    {{-- Kertas Cadangan --}}
                    <div class="mb-6">
                        <label class="block font-medium mb-1">
                            Kertas Cadangan (Proposal) <span class="text-red-500">*</span>
                        </label>
                        @if($project->proposal_file && Storage::disk('public')->exists($project->proposal_file))
                            <div class="mb-2 flex items-center justify-between text-sm bg-green-50 p-2 rounded border border-green-200">
                                <div class="flex items-center text-green-700">
                                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.052-.143z" clip-rule="evenodd" /></svg>
                                    <span>Fail telah dimuat naik.</span>
                                    <a href="{{ asset('storage/' . $project->proposal_file) }}" target="_blank" class="underline ml-2 font-semibold">Lihat Fail</a>
                                    <span class="text-gray-500 ml-2">({{ formatBytes(Storage::disk('public')->exists($project->proposal_file) ? Storage::disk('public')->size($project->proposal_file) : 0) }})</span>
                                </div>
                                <a href="#" onclick="event.preventDefault(); if(confirm('Anda pasti ingin memadam fail ini?')) { document.getElementById('delete-proposal-form').submit(); }" class="text-red-500 hover:text-red-700 font-semibold text-xs uppercase tracking-wider">Padam</a>
                            </div>
                        @endif
                        <p class="text-xs text-gray-500 mb-2">Format: PDF. Maksimum: 10MB</p>
                        <input type="file" name="proposal_file" accept=".pdf" class="w-full border rounded px-3 py-2 bg-gray-50">
                    </div>

                    {{-- Slide Pembentangan --}}
                    <div class="mb-6">
                        <label class="block font-medium mb-1">
                            Slide Pembentangan
                        </label>
                        @if($project->presentation_file && Storage::disk('public')->exists($project->presentation_file))
                            <div class="mb-2 flex items-center justify-between text-sm bg-green-50 p-2 rounded border border-green-200">
                                <div class="flex items-center text-green-700">
                                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.052-.143z" clip-rule="evenodd" /></svg>
                                    <span>Fail telah dimuat naik.</span>
                                    <a href="{{ asset('storage/' . $project->presentation_file) }}" target="_blank" class="underline ml-2 font-semibold">Lihat Fail</a>
                                    <span class="text-gray-500 ml-2">({{ formatBytes(Storage::disk('public')->exists($project->presentation_file) ? Storage::disk('public')->size($project->presentation_file) : 0) }})</span>
                                </div>
                                <a href="#" onclick="event.preventDefault(); if(confirm('Anda pasti ingin memadam fail ini?')) { document.getElementById('delete-presentation-form').submit(); }" class="text-red-500 hover:text-red-700 font-semibold text-xs uppercase tracking-wider">Padam</a>
                            </div>
                        @endif
                        <p class="text-xs text-gray-500 mb-2">Format: PDF. Maksimum: 10MB</p>
                        <input type="file" name="presentation_file" accept=".pdf" class="w-full border rounded px-3 py-2 bg-gray-50">
                    </div>

                    @if($editable)
                    <div class="flex justify-between items-center mt-8 border-t pt-4">
                        <a href="{{ route('projects.details.create', $project->id) }}" class="text-gray-600 hover:text-gray-800">
                            &larr; Kembali ke Perincian
                        </a>
                        <div class="flex space-x-2">
                            <button type="submit" name="action" value="save" class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-2 rounded font-bold shadow">
                                Simpan
                            </button>
                            <a href="{{ route('projects.officer.create', $project->id) }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded font-medium">
                                Seterusnya &rarr;
                            </a>
                        </div>
                    </div>
                    @endif

                </form>
                @endif
                <!-- Borang Tersembunyi untuk Pemadaman -->
                @if($project->proposal_file && Storage::disk('public')->exists($project->proposal_file))
                <form id="delete-proposal-form" action="{{ route('projects.documents.destroy', ['project' => $project->id, 'type' => 'proposal']) }}" method="POST" style="display: none;">
                    @csrf
                    @method('DELETE')
                </form>
                @endif
                @if($project->presentation_file && Storage::disk('public')->exists($project->presentation_file))
                <form id="delete-presentation-form" action="{{ route('projects.documents.destroy', ['project' => $project->id, 'type' => 'presentation']) }}" method="POST" style="display: none;">
                    @csrf
                    @method('DELETE')
                </form>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>