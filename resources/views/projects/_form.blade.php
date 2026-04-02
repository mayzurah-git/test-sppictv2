{{-- Paparan Validation Error --}}
@if ($errors->any())
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
                title: 'Ralat!',
                html: errorHtml,
                confirmButtonText: 'Tutup',
                confirmButtonColor: '#2563eb',
                
            });
        });
    </script>
@endif

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

<form method="POST" action="{{ isset($project) ? route('projects.update', $project->id) : route('projects.storeStep1') }}">
    @csrf
    @if(isset($project))
        @method('PATCH')
    @endif

    {{-- Jabatan / Agensi --}}
    <div class="mb-4">
        <label class="block font-medium mb-1">
            Jabatan / Agensi
        </label>
        @if(auth()->user()->isPengguna())
            <input type="hidden" name="agency_id" value="{{ auth()->user()->agency_id }}">
            <input type="text"
                   value="{{ auth()->user()->agency->agency_name }}"
                   class="w-full border rounded px-3 py-2 bg-gray-100"
                   disabled>
        @else
            <select name="agency_id"
                    class="w-full border rounded px-3 py-2" {{ isset($project) ? 'disabled' : '' }}>
                <option value="">-- Sila Pilih --</option>
                @foreach($agencies as $agency)
                    <option value="{{ $agency->id }}"
                        {{ old('agency_id', $project->agency_id ?? '') == $agency->id ? 'selected' : '' }}>
                        {{ $agency->agency_name }}
                    </option>
                @endforeach
            </select>
            @if(isset($project))
                <p class="text-sm text-gray-500 mt-1">Agensi tidak boleh diubah selepas projek dicipta.</p>
            @endif
        @endif
    </div>

    {{-- Nama Projek --}}
    <div class="mb-4">
        <label class="block font-medium mb-1">
            Nama Projek
        </label>
        <input type="text"
               name="project_title"
               value="{{ old('project_title', $project->project_title ?? '') }}"
               class="w-full border rounded px-3 py-2">
    </div>

    {{-- Anggaran Harga --}}
    <div class="mb-4">
        <label class="block font-medium mb-1">
            Anggaran Harga Jabatan (RM)
        </label>
        <input type="number"
               step="0.01"
               name="estimated_department_cost"
               value="{{ old('estimated_department_cost', $project->estimated_department_cost ?? '') }}"
               class="w-full border rounded px-3 py-2">
    </div>

    {{-- Objektif --}}
    <div class="mb-4">
        <label class="block font-medium mb-1">
            Objektif Projek
        </label>
        <input id="objective" type="hidden" name="objective" value="{{ old('objective', $project->objective ?? '') }}">
        <trix-editor input="objective" class="trix-content w-full border rounded px-3 py-2 min-h-[150px]"></trix-editor>
    </div>

    {{-- Skop --}}
    <div class="mb-4">
        <label class="block font-medium mb-1">
            Skop Projek
        </label>
        <input id="scope" type="hidden" name="scope" value="{{ old('scope', $project->scope ?? '') }}">
        <trix-editor input="scope" class="trix-content w-full border rounded px-3 py-2 min-h-[150px]"></trix-editor>
    </div>

    {{-- Tempoh Pelaksanaan --}}
    <div class="mb-4">
        <label class="block font-medium mb-1">
            Jangkaan Tempoh Pelaksanaan
        </label>
        <input type="text"
               name="implementation_period"
               placeholder="Contoh: 6 bulan"
               value="{{ old('implementation_period', $project->implementation_period ?? '') }}"
               class="w-full border rounded px-3 py-2">
    </div>

    {{-- Sumber Peruntukan --}}
    <div class="mb-4">
        <label class="block font-medium mb-1">
            Sumber Peruntukan
        </label>
        <input type="text"
               name="funding_source"
               value="{{ old('funding_source', $project->funding_source ?? '') }}"
               class="w-full border rounded px-3 py-2">
    </div>

    {{-- Rujukan Kelulusan --}}
    <div class="mb-6">
        <label class="block font-medium mb-1">
            Rujukan Kelulusan Jabatan
        </label>
        <input type="text"
            name="approval_reference"
            value="{{ old('approval_reference', $project->approval_reference ?? '') }}"
            class="w-full border rounded px-3 py-2">
            {{--class="w-full border rounded px-4 py-2 rounded ml-4">--}}
    </div>

    {{-- Butang --}}
    <div class="flex items-center justify-between">
        <div>
            <a href="{{ route('projects.index') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-800 px-4 py-2 rounded border">
                Batal
            </a>
        </div>
        <div class="flex items-center space-x-4">
            <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                {{ isset($project) ? 'Kemaskini' : 'Simpan' }}
            </button>

            @if(isset($project))
                <a href="{{ route('projects.details.create', $project->id) }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
                    Perincian Projek
                </a>
            @endif
        </div>
    </div>
</form>