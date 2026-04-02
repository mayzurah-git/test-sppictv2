@props(['currentStep', 'project' => null])

@php
// Define the steps of the process
$steps = [
    'Maklumat Asas' => [
        'route' => isset($project) ? route('projects.edit', $project->id) : route('projects.create'),
        'enabled' => true
    ],
    'Perincian Projek' => [
        'route' => isset($project) ? route('projects.details.create', $project->id) : '#',
        'enabled' => isset($project)
    ],
    'Muat Naik Dokumen' => [
        'route' => isset($project) ? route('projects.documents.create', $project->id) : '#',
        'enabled' => isset($project)
    ],
    'Maklumat Pegawai' => [
        'route' => isset($project) ? route('projects.officer.create', $project->id) : '#',
        'enabled' => isset($project)
    ],
];
@endphp

<nav aria-label="Breadcrumb" class="mb-6">
    <ol role="list" class="flex items-center space-x-2 md:space-x-4 text-sm">
        @foreach ($steps as $name => $details)
            <li>
                <div class="flex items-center">
                    @if (!$loop->first)
                        <!-- Separator -->
                        <svg class="h-5 w-5 flex-shrink-0 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" />
                        </svg>
                    @endif
                    
                    @if ($name === $currentStep)
                        {{-- Current Page: Highlighted --}}
                        <span class="ml-2 md:ml-4 text-sm font-medium text-blue-600">
                            {{ $name }}
                        </span>
                    @elseif ($details['enabled'])
                        {{-- Enabled Link --}}
                        <a href="{{ $details['route'] }}" class="ml-2 md:ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">
                            {{ $name }}
                        </a>
                    @else
                        {{-- Disabled Link --}}
                        <span class="ml-2 md:ml-4 text-sm font-medium text-gray-400 cursor-not-allowed">
                            {{ $name }}
                        </span>
                    @endif
                </div>
            </li>
        @endforeach
    </ol>
</nav>