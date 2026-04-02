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

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <h2 class="text-xl font-semibold mb-4">Permohonan Projek: <span class="font-normal">{{ $project->project_title }}</span></h2>
            <x-project-breadcrumbs currentStep="Perincian Projek" :project="$project" />

            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold">Kemaskini Perincian Kos</h3>
                <hr class="my-4">

                <form action="{{ route('projects.details.update', [$project->id, $detail->id]) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Kategori Projek --}}
                        <div class="md:col-span-2">
                            <label for="project_category" class="block font-medium text-sm text-gray-700">Kategori Projek</label>
                            <select name="project_category" id="project_category" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                                <option value="">-- Sila Pilih --</option>
                                @php
                                    $categories = ['Projek Baharu', 'Peningkatan Sistem', 'Peluasan Sistem / Projek', 'Penambahbaikan Peralatan', 'Penyelenggaraan', 'Khidmat Perunding ICT'];
                                @endphp
                                @foreach($categories as $category)
                                    <option value="{{ $category }}" {{ old('project_category', $detail->project_category) == $category ? 'selected' : '' }}>
                                        {{ $category }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Spesifikasi Teknikal --}}
                        <div class="md:col-span-2">
                            <label for="technical_specification" class="block font-medium text-sm text-gray-700">Spesifikasi Teknikal</label>
                            <input id="technical_specification" type="hidden" name="technical_specification" value="{{ old('technical_specification', $detail->technical_specification) }}">
                            <trix-editor input="technical_specification" class="trix-content mt-1 block w-full border-gray-300 rounded-md shadow-sm min-h-[150px]"></trix-editor>
                        </div>

                        {{-- Kuantiti --}}
                        <div>
                            <label for="quantity" class="block font-medium text-sm text-gray-700">Jumlah Unit</label>
                            <input type="number" name="quantity" id="quantity" value="{{ old('quantity', $detail->quantity) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                        </div>

                        {{-- Kos Seunit --}}
                        <div>
                            <label for="unit_cost" class="block font-medium text-sm text-gray-700">Anggaran Kos Seunit (RM)</label>
                            <input type="number" step="0.01" name="unit_cost" id="unit_cost" value="{{ old('unit_cost', $detail->unit_cost) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                        </div>
                    </div>

                    <div class="mt-6 flex justify-between">
                        <a href="{{ route('projects.details.create', $project->id) }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-800 uppercase tracking-widest hover:bg-gray-300">
                            Batal
                        </a>
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700">
                            Kemaskini Perincian
                        </button>
                    </div>
                </form>
            </div>
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
