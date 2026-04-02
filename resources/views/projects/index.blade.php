<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-4 gap-4">
                <h2 class="text-xl font-semibold text-gray-800">Senarai Projek ICT</h2>
                <a href="{{ route('projects.create') }}" class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-sm">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Daftar Projek
                </a>
            </div>

            <!-- Search Form -->
            <div class="mb-4 bg-white p-4 rounded-lg shadow-sm">
                <form action="{{ route('projects.index') }}" method="GET" class="flex flex-col md:flex-row gap-4 items-end">
                    
                    {{-- Dropdown Tahun --}}
                    <div class="w-full md:w-1/5">
                        <label for="year" class="block text-sm font-medium text-gray-700 mb-1">Tahun</label>
                        <select name="year" id="year" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <option value="">-- Semua Tahun --</option>
                            @foreach($years as $y)
                                <option value="{{ $y }}" {{ request('year') == $y ? 'selected' : '' }}>{{ $y }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Dropdown Status --}}
                    <div class="w-full md:w-1/5">
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                        <select name="status" id="status" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <option value="">-- Sila Pilih --</option>
                            <option value="Draf" {{ request('status') == 'Draf' ? 'selected' : '' }}>Draf</option>
                            <option value="Hantar - Tunggu Semakan Urus Setia" {{ request('status') == 'Hantar - Tunggu Semakan Urus Setia' ? 'selected' : '' }}>Hantar - Tunggu Semakan Urus Setia</option>
                            <option value="Lengkap" {{ request('status') == 'Lengkap' ? 'selected' : '' }}>Lengkap</option>
                            <option value="Tidak Lengkap" {{ request('status') == 'Tidak Lengkap' ? 'selected' : '' }}>Tidak Lengkap</option>

                        </select>
                    </div>

                    {{-- Input Nama Projek --}}
                    <div class="w-full md:flex-1">
                        <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Nama Projek</label>
                        <input type="text" name="search" id="search" placeholder="Cari nama projek..." 
                               class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" 
                               value="{{ request('search') }}">
                    </div>

                    {{-- Butang Cari & Reset --}}
                    <div class="w-full md:w-auto flex gap-2">
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                            Cari
                        </button>
                        <a href="{{ route('projects.index') }}" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-300 text-center flex items-center justify-center">
                            Reset
                        </a>
                    </div>
                </form>
            </div>

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

            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <table class="min-w-full border">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border px-4 py-2">Kod Projek</th>
                            <th class="border px-4 py-2">Nama Projek</th>
                            <th class="border px-4 py-2">Agensi</th>
                            <th class="border px-4 py-2">Anggaran (RM)</th>
                            <th class="border px-4 py-2">Status</th>
                            <th class="border px-4 py-2 text-center">Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($projects as $project)
                        <tr>
                            <td class="border px-4 py-2">{{ $project->project_code }}</td>
                            <td class="border px-4 py-2">{{ $project->project_title }}</td>
                            <td class="border px-4 py-2">{{ $project->agency->agency_name ?? '-' }}</td>
                            <td class="border px-4 py-2">
                                {{ number_format($project->estimated_department_cost, 2) }}
                            </td>
                            <td class="border px-4 py-2">{{ $project->application_status }}</td>
                            <td class="border px-4 py-2 text-center">
                                @php
                                    $isPenggunaBiasa = auth()->user()->role->role_name === 'Pengguna Biasa';
                                    $isEditableStatus = in_array($project->application_status, ['Draf', 'Tidak Lengkap']);
                                    $canEdit = !$isPenggunaBiasa || $isEditableStatus;
                                @endphp
                                <div class="flex justify-center items-center space-x-2">
                                    {{-- Butang Lihat --}}
                                    <a href="{{ route('projects.show', $project->id) }}" title="Lihat"
                                    class="text-blue-500 hover:text-blue-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    </a>

                                    {{-- Butang Cetak --}}
                                    <a href="{{ route('projects.print', $project->id) }}" target="_blank" title="Cetak"
                                    class="text-green-500 hover:text-green-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0l.229 2.523a1.125 1.125 0 01-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0021 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 00-1.913-.247M6.34 18H5.25A2.25 2.25 0 013 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 001.913-.247m10.5 0a48.536 48.536 0 00-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5zm-3 0h.008v.008H15V10.5z" />
                                        </svg>
                                    </a>

                                    {{-- Butang Tindakan Urus Setia --}}
                                    @if(auth()->user()->role->role_name === 'Urus Setia' && in_array($project->application_status, ['Hantar - Tunggu Semakan Urus Setia', 'Lengkap', 'Tidak Lengkap']))
                                    <a href="{{ route('projects.status.edit', $project->id) }}" title="Tindakan Urus Setia"
                                    class="text-purple-500 hover:text-purple-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.125 2.25h-4.5c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125v-9M10.125 2.25h.375a9 9 0 019 9v.375M10.125 2.25A3.375 3.375 0 0113.5 5.625v1.5c0 .621.504 1.125 1.125 1.125h1.5a3.375 3.375 0 013.375 3.375M9 15l2.25 2.25L15 12" />
                                        </svg>
                                    </a>
                                    @endif

                                    {{-- Butang Edit & Padam --}}
                                    @if($canEdit)
                                    <a href="{{ route('projects.edit', $project->id) }}" title="Kemaskini"
                                    class="text-yellow-500 hover:text-yellow-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                        </svg>
                                    </a>

                                    <form action="{{ route('projects.destroy', $project->id) }}" method="POST" onsubmit="return confirm('Adakah anda pasti ingin memadam projek ini? Tindakan ini tidak boleh diundur.');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" title="Padam" class="text-red-500 hover:text-red-700">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                            </svg>
                                        </button>
                                    </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="border px-4 py-2 text-center text-gray-500">Tiada projek ditemui.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="mt-4">
                    {{ $projects->appends(request()->query())->links() }}
                </div>
            </div>

        </div>
    </div>
</x-app-layout>