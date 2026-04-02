<x-app-layout>
    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <h2 class="text-xl font-semibold mb-4">
                Tindakan Urus Setia: <span class="font-normal">{{ $project->project_title }}</span>
            </h2>

            <div class="space-y-6">
                @if (session('success'))
                    <div class="p-4 bg-green-100 border border-green-200 text-green-700 rounded" role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="bg-white shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold mb-4 border-b pb-2">Kemaskini Status Permohonan</h3>
                    @if ($errors->any())
                        <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                            <ul class="list-disc pl-5">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('projects.updateStatus', $project->id) }}" method="POST" id="status-form">
                        @csrf
                        @method('PATCH')

                        <div class="mb-4">
                            <label for="application_status" class="block font-medium text-sm text-gray-700">Status Permohonan</label>
                            <select name="application_status" id="application_status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option value="">-- Sila Pilih --</option>
                                <option value="Lengkap" @if(old('application_status', $project->application_status) == 'Lengkap') selected @endif>Lengkap</option>
                                <option value="Tidak Lengkap" @if(old('application_status', $project->application_status) == 'Tidak Lengkap') selected @endif>Tidak Lengkap</option>
                            </select>
                        </div>

                        <div id="remarks-section" class="mb-4">
                            <label for="urusetia_remarks" class="block font-medium text-sm text-gray-700">Ulasan</label>
                            <textarea name="urusetia_remarks" id="urusetia_remarks" rows="5" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{ old('urusetia_remarks', $project->urusetia_remarks) }}</textarea>
                        </div>

                        <div class="flex justify-between items-center mt-8 border-t pt-6">
                            <a href="{{ route('projects.index') }}" class="text-gray-600 hover:text-gray-800">
                                &larr; Kembali ke Senarai Projek
                            </a>
                            <button type="submit" class="inline-flex items-center px-6 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-white uppercase tracking-widest hover:bg-blue-700">
                                Kemaskini Status
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>