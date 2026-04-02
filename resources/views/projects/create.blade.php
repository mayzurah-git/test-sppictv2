<x-app-layout>
    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <h2 class="text-xl font-semibold mb-4">
                Permohonan Projek Baru
            </h2>
            
            <x-project-breadcrumbs currentStep="Maklumat Asas" />

            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                @include('projects._form')
            </div>
        </div>
    </div>
</x-app-layout>