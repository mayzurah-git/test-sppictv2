<x-app-layout>
@php
    $isPenggunaBiasa = auth()->user()->role->role_name === 'Pengguna Biasa';
    $editable = !$isPenggunaBiasa || in_array($project->application_status, ['Draf', 'Tidak Lengkap']);
@endphp
    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <h2 class="text-xl font-semibold mb-4">Permohonan Projek: <span class="font-normal">{{ $project->project_title }}</span></h2>
            <x-project-breadcrumbs currentStep="Maklumat Pegawai" :project="$project" />

            @if($project->application_status === 'Tidak Lengkap' && $project->urusetia_remarks)
                <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 my-4" role="alert">
                    <p class="font-bold">Ulasan Urus Setia (Sila buat pembetulan):</p>
                    <div class="prose prose-sm max-w-none mt-1">{!! nl2br(e($project->urusetia_remarks)) !!}</div>
                </div>
            @endif
            
            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                <div class="mb-6 p-4 bg-blue-50 border border-blue-200 rounded">
                    <p class="text-sm text-blue-800">
                        Sila lengkapkan maklumat pegawai yang bertanggungjawab untuk projek ini.
                    </p>
                </div>

                <!-- Butang untuk auto-fill -->
                <div class="mb-4 text-right">
                    <button type="button" id="autofill-btn" class="text-sm font-medium text-blue-600 hover:underline focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline-block mr-1 -mt-px" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                        </svg>
                        Guna maklumat profil saya
                    </button>
                </div>

                @if($editable)
                <form method="POST" action="{{ route('projects.officer.store', $project->id) }}">
                    @csrf

                    @if(session('success'))
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

                    @if(session('error'))
                        <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                            {{ session('error') }}
                        </div>
                    @endif
                    @if($errors->any())
                        <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                            <ul class="list-disc pl-5">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label class="block font-medium mb-1">Nama Pegawai</label>
                            <input type="text" name="officer_name" value="{{ old('officer_name', $project->officer_name) }}" class="w-full border rounded px-3 py-2" required>
                        </div>

                        <div>
                            <label class="block font-medium mb-1">Jawatan</label>
                            <select name="officer_position" class="w-full border rounded px-3 py-2" required>
                                <option value="">-- Sila Pilih Jawatan --</option>
                                @foreach($positions as $position)
                                    <option value="{{ $position->position_name }}" {{ old('officer_position', $project->officer_position) == $position->position_name ? 'selected' : '' }}>
                                        {{ $position->position_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block font-medium mb-1">Emel Rasmi</label>
                            <input type="email" name="officer_email" value="{{ old('officer_email', $project->officer_email) }}" class="w-full border rounded px-3 py-2" required>
                        </div>

                        <div>
                            <label class="block font-medium mb-1">No. Telefon Pejabat / Bimbit</label>
                            <input type="text" name="officer_phone" value="{{ old('officer_phone', $project->officer_phone) }}" class="w-full border rounded px-3 py-2" required>
                        </div>
                    </div>

                    <div class="flex justify-between items-center mt-8 border-t pt-6">
                        <a href="{{ route('projects.documents.create', $project->id) }}" class="text-gray-600 hover:text-gray-800">
                            &larr; Kembali ke Dokumen
                        </a>
                        <div class="flex items-center space-x-4">
                            <button type="submit" name="action" value="save" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded font-bold shadow">
                                Simpan
                            </button>
                            <button id="submit-button" type="submit" name="action" value="submit" class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded font-bold shadow">
                                @if($project->application_status === 'Tidak Lengkap')
                                    Hantar Semula Permohonan
                                @else
                                    Hantar Permohonan
                                @endif
                            </button>
                        </div>
                    </div>
                </form>
                @endif
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const submitButton = document.getElementById('submit-button');
            const form = submitButton.closest('form');
            const requiredInputs = [
                document.querySelector('input[name="officer_name"]'),
                document.querySelector('select[name="officer_position"]'),
                document.querySelector('input[name="officer_email"]'),
                document.querySelector('input[name="officer_phone"]')
            ];

            function toggleSubmitButton() {
                const allFilled = requiredInputs.every(input => input.value.trim() !== '');
                submitButton.style.display = allFilled ? 'inline-flex' : 'none';
            }

            // Tambah event listener pada setiap input untuk menyemak setiap kali ada perubahan
            requiredInputs.forEach(input => {
                input.addEventListener('input', toggleSubmitButton);
            });

            // Fungsi auto-fill
            document.getElementById('autofill-btn').addEventListener('click', function() {
                const user = @json(auth()->user());
                document.querySelector('input[name="officer_name"]').value = user.name || '';
                document.querySelector('input[name="officer_email"]').value = user.email || '';
                document.querySelector('select[name="officer_position"]').value = user.position || ''; // Sila ubah suai jika perlu
                document.querySelector('input[name="officer_phone"]').value = user.phone || ''; // Sila ubah suai jika perlu
                
                // Panggil fungsi semakan selepas auto-fill
                toggleSubmitButton();
            });

            // Confirm dialog when pressing final submit
            submitButton.addEventListener('click', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Pengesahan',
                    text: 'Anda pasti ingin menghantar permohonan ini kepada Urus Setia? Setelah dihantar, status akan berubah dan tidak boleh diubah lagi.',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, hantar',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // ensure the clicked button's value is included
                        if (typeof form.requestSubmit === 'function') {
                            form.requestSubmit(submitButton);
                        } else {
                            // fallback: add hidden input
                            var hidden = document.createElement('input');
                            hidden.type = 'hidden';
                            hidden.name = submitButton.name;
                            hidden.value = submitButton.value;
                            form.appendChild(hidden);
                            form.submit();
                        }
                    }
                });
            });

            // Semakan awal semasa halaman dimuatkan
            toggleSubmitButton();
        });
    </script>
</x-app-layout>