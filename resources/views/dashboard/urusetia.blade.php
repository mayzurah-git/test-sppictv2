<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Urus Setia') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Stat Cards --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

                <!-- Stat Card: Permohonan Baru -->
                <a href="{{ route('projects.index', ['status' => 'Hantar - Tunggu Semakan Urus Setia']) }}" class="block p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 transition-colors">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-blue-500 rounded-md p-3">
                            <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m.75 12l3 3m0 0l3-3m-3 3v-6m-1.5-9H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500 truncate">Permohonan Baru</p>
                            <p class="text-3xl font-bold text-gray-900">{{ $countBaru }}</p>
                        </div>
                    </div>
                </a>

                <!-- Stat Card: Lengkap -->
                <a href="{{ route('projects.index', ['status' => 'Lengkap']) }}" class="block p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 transition-colors">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-green-500 rounded-md p-3">
                            <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500 truncate">Lengkap</p>
                            <p class="text-3xl font-bold text-gray-900">{{ $countLengkap }}</p>
                        </div>
                    </div>
                </a>

                <!-- Stat Card: Tidak Lengkap -->
                <a href="{{ route('projects.index', ['status' => 'Tidak Lengkap']) }}" class="block p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 transition-colors">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-yellow-500 rounded-md p-3">
                            <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m0-10.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.75c0 5.592 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.57-.598-3.75h-.152c-3.196 0-6.1-1.249-8.25-3.286zm0 13.036h.008v.008H12v-.008z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500 truncate">Tidak Lengkap</p>
                            <p class="text-3xl font-bold text-gray-900">{{ $countTidakLengkap }}</p>
                        </div>
                    </div>
                </a>

                <!-- Stat Card: Jumlah Projek -->
                <a href="{{ route('projects.index') }}" class="block p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 transition-colors">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-gray-500 rounded-md p-3">
                            <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.75V12A2.25 2.25 0 014.5 9.75h15A2.25 2.25 0 0121.75 12v.75m-8.69-6.44l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500 truncate">Jumlah Keseluruhan Projek</p>
                            <p class="text-3xl font-bold text-gray-900">{{ $totalProjects }}</p>
                        </div>
                    </div>
                </a>

            </div>

            {{-- Widget Mesyuarat Aktif --}}
            <div class="mt-8 bg-white shadow-sm sm:rounded-lg border-l-4 border-green-500">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-medium leading-6 text-gray-900">
                            Mesyuarat Sedang Aktif
                        </h3>
                    </div>

                    @if(isset($activeMeetings) && $activeMeetings->count() > 0)
                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
                            @foreach($activeMeetings as $meeting)
                                <div class="relative flex flex-col bg-green-50 border border-green-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                                    <div class="flex-1">
                                        <h4 class="text-md font-bold text-green-800">{{ $meeting->title }}</h4>
                                        <p class="text-xs text-green-600 font-semibold uppercase tracking-wide mb-2">
                                            Bil. {{ $meeting->meeting_number }} / {{ $meeting->year }}
                                        </p>
                                        <div class="text-sm text-gray-700 space-y-1">
                                            <p><span class="font-medium">Tarikh:</span> {{ $meeting->date->format('d/m/Y') }}</p>
                                            <p><span class="font-medium">Masa:</span> {{ \Carbon\Carbon::parse($meeting->time)->format('h:i A') }}</p>
                                            <p><span class="font-medium">Tempat:</span> {{ $meeting->venue }}</p>
                                        </div>
                                    </div>
                                    <div class="mt-4 pt-3 border-t border-green-200">
                                        <a href="{{ route('meetings.edit', $meeting->id) }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-900 flex items-center">
                                            Urus Mesyuarat <span class="ml-1">&rarr;</span>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-sm text-gray-500">Tiada mesyuarat yang berstatus Aktif pada masa ini.</p>
                    @endif
                </div>
            </div>

            {{-- Arkib & Minit Mesyuarat --}}
            <div class="mt-8 bg-white shadow-sm sm:rounded-lg">
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
                                        $mQuery = \App\Models\Meeting::where('title', $category);
                                        
                                        if ($year = request('filter_year')) {
                                            $mQuery->where('year', $year);
                                            $limit = 50;
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

            {{-- Quick Links --}}
            <div class="mt-8 bg-white shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">
                        Pautan Pantas
                    </h3>
                    <div class="mt-4 grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <a href="{{ route('projects.index') }}" class="flex items-center p-4 bg-gray-50 rounded-lg hover:bg-gray-100">
                            <div class="flex-shrink-0">
                                <svg class="h-6 w-6 text-gray-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 12h16.5m-16.5 3.75h16.5M3.75 19.5h16.5M5.625 4.5h12.75a1.875 1.875 0 010 3.75H5.625a1.875 1.875 0 010-3.75z" /></svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-900">Lihat Semua Projek</p>
                                <p class="text-sm text-gray-500">Paparkan senarai penuh permohonan projek.</p>
                            </div>
                        </a>
                        <a href="{{ route('projects.create') }}" class="flex items-center p-4 bg-gray-50 rounded-lg hover:bg-gray-100">
                            <div class="flex-shrink-0">
                                <svg class="h-6 w-6 text-gray-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-900">Daftar Projek Baru</p>
                                <p class="text-sm text-gray-500">Mulakan permohonan projek baru.</p>
                            </div>
                        </a>
                        <!-- Pautan Pengurusan Mesyuarat -->
                        <a href="{{ route('meetings.index') }}" class="flex items-center p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                            <div class="flex-shrink-0">
                                <svg class="h-6 w-6 text-gray-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" /></svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-900">Pengurusan Mesyuarat</p>
                                <p class="text-sm text-gray-500">Urus jadual, agenda dan minit mesyuarat.</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
