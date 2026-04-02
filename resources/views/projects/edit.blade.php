<x-app-layout>
    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <h2 class="text-xl font-semibold mb-4">
                Permohonan Projek: <span class="font-normal">{{ $project->project_title }}</span>
            </h2>
            <x-project-breadcrumbs currentStep="Maklumat Asas" :project="$project" />
            <div class="space-y-6">
                @if (session('success'))
                    <div class="p-4 bg-green-100 border border-green-200 text-green-700 rounded" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="bg-white shadow-sm sm:rounded-lg p-6">
                    @include('projects._form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>