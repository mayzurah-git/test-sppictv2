<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            {{-- 1. Widget Mesyuarat Aktif --}}
            @if(isset($activeMeetings) && $activeMeetings->count() > 0)
            <div>
                <div class="bg-white shadow-sm sm:rounded-lg border-l-4 border-blue-500">
                    <div class="p-6">
                        <h3 class="text-lg font-medium leading-6 text-gray-900 mb-4">
                            Makluman Mesyuarat Aktif
                        </h3>
                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                            @foreach($activeMeetings as $meeting)
                                <div class="relative flex flex-col bg-blue-50 border border-blue-200 rounded-lg p-4">
                                    <div class="flex-1">
                                        <h4 class="text-md font-bold text-blue-800">{{ $meeting->title }}</h4>
                                        <p class="text-xs text-blue-600 font-semibold uppercase tracking-wide mb-2">
                                            Bil. {{ $meeting->meeting_number }} / {{ $meeting->year }}
                                        </p>
                                        <div class="text-sm text-gray-700 space-y-1">
                                            <p><span class="font-medium">Tarikh Mesyuarat:</span> {{ $meeting->date->format('d/m/Y') }}</p>
                                            <div class="mt-2 p-2 bg-yellow-100 border border-yellow-300 rounded-md">
                                                <p class="font-semibold text-yellow-800">Tarikh Tutup Kemaskini Status KemajuanProjek:</p>
                                                <p class="text-md font-bold text-red-600">{{ $meeting->project_update_deadline->format('d F Y') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <p class="mt-4 text-xs text-gray-500">* Sila pastikan maklumat projek anda dikemaskini sebelum tarikh tutup yang dinyatakan.</p>
                    </div>
                </div>
            </div>
            @endif

            {{-- 2. Senarai Permohonan Projek --}}
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-medium leading-6 text-gray-900">
                            Permohonan Projek Terkini
                        </h3>
                        <a href="{{ route('projects.index') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-800">
                            Lihat Semua &rarr;
                        </a>
                    </div>
                    
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kod Projek</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Projek</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status Permohonan</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Tindakan</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($projects as $project)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $project->project_code }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ Str::limit($project->project_title, 50) }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $project->application_status }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                        <a href="{{ route('projects.show', $project->id) }}" class="text-indigo-600 hover:text-indigo-900">Lihat</a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500">Tiada permohonan projek ditemui.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    @if($projects->hasPages())
                        <div class="mt-4">
                            {{ $projects->links() }}
                        </div>
                    @endif
                </div>
            </div>

            {{-- 3. Arkib & Minit Mesyuarat Mengikut Kategori --}}
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex flex-col md:flex-row md:items-center justify-between mb-6">
                        <h3 class="text-lg font-medium leading-6 text-gray-900 mb-4 md:mb-0">
                            Arkib & Minit Mesyuarat
                        </h3>
                        
                        <form method="GET" action="{{ url()->current() }}" class="flex w-full md:w-auto gap-2">
                            <select name="filter_year" onchange="this.form.submit()" 
                                class="w-full md:w-48 pl-3 pr-10 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500 text-sm">
                                <option value="">-- Semua Tahun --</option>
                                @php
                                    $availableYears = \App\Models\Meeting::distinct()->orderBy('year', 'desc')->pluck('year');
                                @endphp
                                @foreach($availableYears as $year)
                                    <option value="{{ $year }}" {{ request('filter_year') == $year ? 'selected' : '' }}>
                                        Tahun {{ $year }}
                                    </option>
                                @endforeach
                            </select>
                            @if(request('filter_year'))
                                <a href="{{ url()->current() }}" class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    Reset
                                </a>
                            @endif
                        </form>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        @foreach(['PRA-JTICTNS', 'JTICTNS', 'JPICTNS'] as $category)
                            <div class="border rounded-lg overflow-hidden">
                                <div class="bg-gray-50 px-4 py-2 border-b">
                                    <h4 class="font-bold text-sm text-gray-700">{{ $category }}</h4>
                                </div>
                                <div class="p-4">
                                    @php
                                        // Nota: Sebaiknya grouping ini dilakukan di Controller
                                        $mQuery = \App\Models\Meeting::where('title', $category);
                                        
                                        if ($year = request('filter_year')) {
                                            $mQuery->where('year', $year);
                                            $limit = 50; // Paparkan lebih banyak jika filter tahun dipilih
                                        } else {
                                            $limit = 5;
                                        }
                                        
                                        $categoryMeetings = $mQuery->orderBy('date', 'desc')->take($limit)->get();
                                    @endphp

                                    @if($categoryMeetings->count() > 0)
                                        <ul class="space-y-3">
                                            @foreach($categoryMeetings as $m)
                                                <li class="text-sm border-b pb-2 last:border-0">
                                                    <div class="flex justify-between items-start">
                                                        <div>
                                                            <span class="block font-medium text-gray-900">Bil. {{ $m->meeting_number }}/{{ $m->year }}</span>
                                                            <span class="text-xs text-gray-500">{{ $m->date->format('d/m/Y') }}</span>
                                                        </div>
                                                        @if($m->minutes_file)
                                                            <a href="{{ asset('storage/' . $m->minutes_file) }}" target="_blank" class="text-blue-600 hover:text-blue-800 text-xs font-bold flex items-center">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                                                </svg>
                                                                Minit
                                                            </a>
                                                        @endif
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <p class="text-xs text-gray-400">Tiada rekod mesyuarat.</p>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
