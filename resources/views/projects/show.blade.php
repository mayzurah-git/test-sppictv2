<x-app-layout>
    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Card 1: Maklumat Utama Projek --}}
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-between items-start">
                    <div>
                        <h2 class="text-xl font-bold mb-1">{{ $project->project_title }}</h2>
                        <p class="text-sm text-gray-500">{{ $project->project_code }}</p>
                    </div>
                    <div class="text-right flex-shrink-0 ml-4">
                        <p class="text-sm font-medium text-gray-500">Status Permohonan</p>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                            {{ $project->application_status }}
                        </span>
                        <p class="text-sm font-medium text-gray-500 mt-2">Status Projek</p>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            {{ $project->status }}
                        </span>
                    </div>
                </div>

                <hr class="my-4">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4 text-sm">
                    <p><strong>Agensi:</strong><br> {{ $project->agency->agency_name }}</p>
                    <p><strong>Pemohon:</strong><br> {{ $project->creator->name ?? '-' }}</p>
                    <p><strong>Anggaran Harga Jabatan:</strong><br> RM {{ number_format($project->estimated_department_cost, 2) }}</p>
                    <p><strong>Jangkaan Tempoh Pelaksanaan:</strong><br> {{ $project->implementation_period }}</p>
                    <p><strong>Sumber Peruntukan:</strong><br> {{ $project->funding_source }}</p>
                    <p><strong>Rujukan Kelulusan Jabatan:</strong><br> {{ $project->approval_reference }}</p>
                    
                    <div class="md:col-span-2">
                        <strong>Objektif Projek:</strong>
                        <div class="mt-1 text-gray-700 prose max-w-none">{!! $project->objective !!}</div>
                    </div>
                    <div class="md:col-span-2">
                        <strong>Skop Projek:</strong>
                        <div class="mt-1 text-gray-700 prose max-w-none">{!! $project->scope !!}</div>
                    </div>
                </div>
            </div>

            {{-- Ulasan Urus Setia (jika ada) --}}
            @if($project->application_status === 'Tidak Lengkap' && $project->urusetia_remarks)
            <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4" role="alert">
                <p class="font-bold">Ulasan Urus Setia</p>
                <p>{!! nl2br(e($project->urusetia_remarks)) !!}</p>
            </div>
            @endif

            {{-- Card 2: Perincian Kos --}}
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">Perincian Kos Projek</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full border text-sm">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="border px-4 py-2 text-left">Kategori</th>
                                <th class="border px-4 py-2 text-left">Spesifikasi</th>
                                <th class="border px-4 py-2 text-center">Unit</th>
                                <th class="border px-4 py-2 text-right">Kos Seunit (RM)</th>
                                <th class="border px-4 py-2 text-right">Jumlah (RM)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($project->details as $detail)
                            <tr>
                                <td class="border px-4 py-2">{{ $detail->project_category }}</td>
                                <td class="border px-4 py-2 prose max-w-none">{!! $detail->technical_specification !!}</td>
                                <td class="border px-4 py-2 text-center">{{ $detail->quantity }}</td>
                                <td class="border px-4 py-2 text-right">{{ number_format($detail->unit_cost, 2) }}</td>
                                <td class="border px-4 py-2 text-right">{{ number_format($detail->total_cost, 2) }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="border px-4 py-2 text-center text-gray-500">Tiada perincian kos direkodkan.</td>
                            </tr>
                            @endforelse
                        </tbody>
                        @if($project->details->isNotEmpty())
                        <tfoot class="font-bold bg-gray-50">
                            <tr>
                                <td colspan="4" class="border px-4 py-2 text-right">Jumlah Keseluruhan:</td>
                                <td class="border px-4 py-2 text-right">RM {{ number_format($project->details->sum('total_cost'), 2) }}</td>
                            </tr>
                            @php
                                $balance = $project->estimated_department_cost - $project->details->sum('total_cost');
                            @endphp
                            <tr>
                                <td colspan="4" class="border px-4 py-2 text-right">Baki dari Anggaran Jabatan:</td>
                                <td class="border px-4 py-2 text-right {{ $balance < 0 ? 'text-red-600' : 'text-green-600' }}">
                                    RM {{ number_format($balance, 2) }}
                                </td>
                            </tr>
                        </tfoot>
                        @endif
                    </table>
                </div>
            </div>

            {{-- Card 3: Dokumen & Pegawai --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Dokumen --}}
                <div class="bg-white shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold mb-4">Dokumen Sokongan</h3>
                    <ul class="space-y-2 text-sm">
                        <li>
                            <strong>Kertas Cadangan:</strong>
                            @if($project->proposal_file)
                                <a href="{{ asset('storage/' . $project->proposal_file) }}" target="_blank" class="text-blue-600 hover:underline ml-2">
                                    Muat Turun / Lihat
                                </a>
                            @else
                                <span class="text-gray-500 ml-2">Tiada</span>
                            @endif
                        </li>
                        <li>
                            <strong>Slaid Pembentangan:</strong>
                             @if($project->presentation_file)
                                <a href="{{ asset('storage/' . $project->presentation_file) }}" target="_blank" class="text-blue-600 hover:underline ml-2">
                                    Muat Turun / Lihat
                                </a>
                            @else
                                <span class="text-gray-500 ml-2">Tiada</span>
                            @endif
                        </li>
                    </ul>
                </div>

                {{-- Pegawai --}}
                <div class="bg-white shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold mb-4">Pegawai untuk Dihubungi</h3>
                    @if($project->officer_name)
                        <div class="space-y-2 text-sm">
                            <p><strong>Nama:</strong> {{ $project->officer_name }}</p>
                            <p><strong>Jawatan:</strong> {{ $project->officer_position }}</p>
                            <p><strong>Emel:</strong> {{ $project->officer_email }}</p>
                            <p><strong>Telefon:</strong> {{ $project->officer_phone }}</p>
                        </div>
                    @else
                        <p class="text-sm text-gray-500">Maklumat pegawai belum dilengkapkan.</p>
                    @endif
                </div>
            </div>

            {{-- Back Button --}}
            <div class="text-center">
                <a href="{{ route('projects.index') }}" class="inline-block bg-gray-200 hover:bg-gray-300 text-gray-800 px-6 py-2 rounded font-medium">
                    &larr; Kembali ke Senarai Projek
                </a>
            </div>
        </div>
    </div>
</x-app-layout>