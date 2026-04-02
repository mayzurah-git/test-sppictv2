<x-app-layout>
    {{-- Trix Editor Resources --}}
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
    <script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>
    <style>
        .trix-content ul,
        .trix-content ol {
            padding-left: 1.5rem;
        }
        .trix-content h1 {
            font-size: 1.25rem;
            font-weight: 600;
        }
        .trix-button--icon-attach {
            display: none !important;
        }
    </style>

    <script>
        document.addEventListener("trix-file-accept", function(event) {
            event.preventDefault();
        });
    </script>

    @php
        $isPenggunaBiasa = auth()->user()->role->role_name === 'Pengguna Biasa';
        $editable = !$isPenggunaBiasa || in_array($project->application_status, ['Draf', 'Tidak Lengkap']);
    @endphp
    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <h2 class="text-xl font-semibold">Permohonan Projek: <span class="font-normal">{{ $project->project_title }}</span></h2>
            <x-project-breadcrumbs currentStep="Perincian Projek" :project="$project" />

            @if($project->application_status === 'Tidak Lengkap' && $project->urusetia_remarks)
                <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4" role="alert">
                    <p class="font-bold">Ulasan Urus Setia (Sila buat pembetulan):</p>
                    <div class="prose prose-sm max-w-none mt-1">{!! nl2br(e($project->urusetia_remarks)) !!}</div>
                </div>
            @endif

            {{-- Header --}}
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-center">
                    <div>
                        <p class="text-sm text-gray-500">Anggaran Jabatan</p>
                        <p class="text-lg font-bold">RM {{ number_format($project->estimated_department_cost, 2) }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Jumlah Telah Diperinci</p>
                        <p class="text-lg font-bold">RM {{ number_format($project->details->sum('total_cost'), 2) }}</p>
                    </div>
                    <div>
                        @php
                            $balance = $project->estimated_department_cost - $project->details->sum('total_cost');
                        @endphp
                        <p class="text-sm text-gray-500">Baki Peruntukan</p>
                        <p class="text-lg font-bold {{ $balance < 0 ? 'text-red-600' : 'text-green-600' }}">RM {{ number_format($balance, 2) }}</p>
                    </div>
                </div>
            </div>
            {{-- Borang Tambah Perincian --}}
            @if($editable)
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4 border-b pb-2">Tambah Perincian Kos</h3>
                
                @if(session('success'))
                    <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif

                <form action="{{ route('projects.details.store', $project->id) }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Kategori Projek --}}
                        <div class="md:col-span-2">
                            <label for="project_category" class="block font-medium text-sm text-gray-700">Kategori Projek</label>
                            <select name="project_category" id="project_category" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                                <option value="">-- Sila Pilih --</option>
                                <option value="Projek Baharu">Projek Baharu</option>
                                <option value="Peningkatan Sistem">Peningkatan Sistem</option>
                                <option value="Peluasan Sistem / Projek">Peluasan Sistem / Projek</option>
                                <option value="Penambahbaikan Peralatan">Penambahbaikan Peralatan</option>
                                <option value="Penyelenggaraan">Penyelenggaraan</option>
                                <option value="Khidmat Perunding ICT">Khidmat Perunding ICT</option>
                            </select>
                        </div>

                        {{-- Spesifikasi Teknikal --}}
                        <div class="md:col-span-2">
                            <label for="technical_specification" class="block font-medium text-sm text-gray-700">Spesifikasi Teknikal</label>
                            <input id="technical_specification" type="hidden" name="technical_specification" value="{{ old('technical_specification') }}">
                            <trix-editor input="technical_specification" class="trix-content mt-1 block w-full border-gray-300 rounded-md shadow-sm min-h-[150px]"></trix-editor>
                        </div>

                        {{-- Kuantiti --}}
                        <div>
                            <label for="quantity" class="block font-medium text-sm text-gray-700">Jumlah Unit</label>
                            <input type="number" name="quantity" id="quantity" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                        </div>

                        {{-- Kos Seunit --}}
                        <div>
                            <label for="unit_cost" class="block font-medium text-sm text-gray-700">Anggaran Kos Seunit (RM)</label>
                            <input type="number" step="0.01" name="unit_cost" id="unit_cost" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                        </div>
                    </div>

                    <div class="mt-6 text-right">
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700">
                            Tambah Perincian
                        </button>
                    </div>
                </form>
            </div>
            @endif

            {{-- Senarai Perincian Sedia Ada --}}
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">Senarai Perincian Kos Sedia Ada</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full border text-sm">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="border px-4 py-2 text-left">Kategori</th>
                                <th class="border px-4 py-2 text-left">Spesifikasi</th>
                                <th class="border px-4 py-2 text-center">Unit</th>
                                <th class="border px-4 py-2 text-right">Kos Seunit (RM)</th>
                                <th class="border px-4 py-2 text-right">Jumlah (RM)</th>
                                <th class="border px-4 py-2 text-center">Tindakan</th>
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
                                <td class="border px-4 py-2 text-center">
                                    <div class="flex justify-center items-center space-x-2">
                                        @if($editable)
                                        <a href="{{ route('projects.details.edit', [$project->id, $detail->id]) }}" class="text-yellow-500 hover:text-yellow-700" title="Kemaskini">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" /><path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" /></svg>
                                        </a>
                                        <form action="{{ route('projects.details.destroy', [$project->id, $detail->id]) }}" method="POST" onsubmit="return confirm('Padam butiran ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-700" title="Padam">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm4 0a1 1 0 012 0v6a1 1 0 11-2 0V8z" clip-rule="evenodd" /></svg>
                                            </button>
                                        </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="border px-4 py-2 text-center text-gray-500">Tiada perincian kos direkodkan.</td>
                            </tr>
                            @endforelse
                        </tbody>
                        @if($project->details->isNotEmpty())
                        <tfoot class="font-bold bg-gray-50">
                            <tr>
                                <td colspan="5" class="border px-4 py-2 text-right">Jumlah Keseluruhan:</td>
                                <td class="border px-4 py-2 text-right">RM {{ number_format($project->details->sum('total_cost'), 2) }}</td>
                            </tr>
                        </tfoot>
                        @endif
                    </table>
                </div>
            </div>

            {{-- Navigation Buttons --}}
            @if($editable)
            <div class="flex justify-between items-center">
                <a href="{{ route('projects.edit', $project->id) }}" class="inline-block bg-gray-200 hover:bg-gray-300 text-gray-800 px-6 py-2 rounded font-medium">
                    &larr; Kembali ke Maklumat Asas
                </a>
                <a href="{{ route('projects.documents.create', $project->id) }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded font-medium">
                    Seterusnya: Dokumen Sokongan &rarr;
                </a>
            </div>
            @endif
        </div>
    </div>
@if(session('error_budget'))
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'error',
                title: 'Bajet Melebihi Had!',
                text: "{{ session('error_budget') }}",
                confirmButtonText: 'OK',
                confirmButtonColor: '#dc2626', // Warna Merah
            });
        });
    </script>
@endif

{{-- Anda masih boleh mengekalkan kod ini untuk ralat validasi yang lain --}}
@if ($errors->any() && !session('error_budget'))
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const errors = @json($errors->all());
            let errorHtml = '<ul style="text-align: left; margin-left: 20px; list-style-type: disc;">';
            errors.forEach(function(error) {
                errorHtml += '<li>' + error + '</li>';
            });
            errorHtml += '</ul>';

            Swal.fire({
                icon: 'error',
                title: 'Ralat Validasi!',
                html: errorHtml,
                confirmButtonText: 'Tutup',
            });
        });
    </script>
@endif
</x-app-layout>