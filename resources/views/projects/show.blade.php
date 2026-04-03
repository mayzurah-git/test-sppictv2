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

            @if($project->urusetia_remarks)
                <div class="mb-6 bg-yellow-50 border-l-4 border-yellow-400 p-4 shadow-sm rounded-r-lg">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <!-- Ikon Info -->
                            <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-bold text-yellow-800 uppercase tracking-wider">
                                Ulasan Urus Setia
                            </h3>
                            <div class="mt-2 text-sm text-yellow-700 whitespace-pre-wrap font-medium">
                                {{ $project->urusetia_remarks }}
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Borang Kemaskini Ulasan Sahaja (Urus Setia) --}}
            @if(Auth::user()->role->role_name === 'Urus Setia')
            <div class="bg-white shadow-sm sm:rounded-lg p-6 border-t-4 border-indigo-500">
                <h3 class="text-lg font-semibold mb-4 text-indigo-800">Kemaskini Ulasan (Urus Setia Sahaja)</h3>
                <form action="{{ route('projects.remarks.update', $project->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <textarea name="urusetia_remarks" rows="4" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200" placeholder="Masukkan ulasan di sini...">{{ old('urusetia_remarks', $project->urusetia_remarks) }}</textarea>
                    <div class="mt-3 flex justify-end">
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded text-sm font-bold shadow transition">
                            Simpan Ulasan Sahaja
                        </button>
                    </div>
                </form>
            </div>
            @endif

            {{-- Card 4: Sejarah Ulasan --}}
            @if(Auth::user()->isUrusetia())
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-6 flex items-center text-gray-800">
                    <svg class="w-5 h-5 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Sejarah Ulasan & Maklum Balas
                </h3>
                
                <div class="flow-root">
                    <ul role="list" class="-mb-8">
                        @forelse($remarksHistory as $log)
                            @php
                                // Memastikan data ditukar kepada array jika ia disimpan sebagai string JSON
                                $newVals = is_array($log->new_values) ? $log->new_values : json_decode($log->new_values, true);
                            @endphp
                            @if(isset($newVals['urusetia_remarks']) || isset($newVals['application_status']))
                            <li>
                                <div class="relative pb-8">
                                    @if (!$loop->last)
                                        <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
                                    @endif
                                    <div class="relative flex space-x-3">
                                        <div>
                                            <span class="h-8 w-8 rounded-full bg-indigo-100 flex items-center justify-center ring-8 ring-white text-indigo-600 font-bold text-xs uppercase">
                                                {{ substr($log->user->name ?? 'U', 0, 1) }}
                                            </span>
                                        </div>
                                        <div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
                                            <div>
                                                <p class="text-sm text-gray-500">
                                                    <span class="font-medium text-gray-900">{{ $log->user->name ?? 'Urus Setia' }}</span> 
                                                    mengemaskini maklum balas
                                                </p>
                                                @if(isset($newVals['urusetia_remarks']))
                                                    <div class="mt-2 text-sm text-gray-600 bg-gray-50 p-3 rounded-lg border border-gray-100 italic">
                                                        "{!! nl2br(e($newVals['urusetia_remarks'])) !!}"
                                                    </div>
                                                @endif
                                                @if(isset($newVals['application_status']))
                                                    <p class="mt-1 text-xs text-gray-500">
                                                        Status pada waktu ini: <span class="font-bold text-indigo-600">{{ $newVals['application_status'] }}</span>
                                                    </p>
                                                @endif
                                            </div>
                                            <div class="whitespace-nowrap text-right text-xs text-gray-400">
                                                {{ $log->created_at->format('d/m/Y H:i') }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            @endif
                        @empty
                            <li class="text-sm text-gray-500 italic text-center py-4">Tiada sejarah ulasan direkodkan.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
            @endif

            {{-- Back Button --}}
            <div class="text-center">
                <a href="{{ route('projects.index') }}" class="inline-block bg-gray-200 hover:bg-gray-300 text-gray-800 px-6 py-2 rounded font-medium">
                    &larr; Kembali ke Senarai Projek
                </a>
            </div>
        </div>
    </div>
</x-app-layout>