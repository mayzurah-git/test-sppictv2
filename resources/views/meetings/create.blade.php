<x-app-layout>
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.0/dist/trix.css">
    <script type="text/javascript" src="https://unpkg.com/trix@2.0.0/dist/trix.umd.min.js"></script>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <h2 class="text-xl font-bold mb-6 text-gray-800">Daftar Mesyuarat</h2>

                @if($errors->any())
                    <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                        <ul class="list-disc pl-5">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('meetings.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <!-- Nama Mesyuarat -->
                        <div>
                            <label class="block font-medium text-sm text-gray-700 mb-1">Nama Mesyuarat</label>
                            <select name="title" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200" required>
                                <option value="">--Sila Pilih--</option>
                                <option value="PRA-JTICTNS">PRA-JTICTNS</option>
                                <option value="JTICTNS">JTICTNS</option>
                                <option value="JPICTNS">JPICTNS</option>
                            </select>
                        </div>

                        <!-- Bilangan & Tahun -->
                        <div class="flex gap-4">
                            <div class="w-1/2">
                                <label class="block font-medium text-sm text-gray-700 mb-1">Bilangan</label>
                                <select name="meeting_number" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200" required>
                                    @foreach([1,2,3,4,5,6] as $num)
                                        <option value="{{ $num }}">{{ $num }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="w-1/2">
                                <label class="block font-medium text-sm text-gray-700 mb-1">Tahun</label>
                                <input type="number" name="year" value="{{ date('Y') }}" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200" required>
                            </div>
                        </div>

                        <!-- Tarikh & Masa -->
                        <div>
                            <label class="block font-medium text-sm text-gray-700 mb-1">Tarikh Mesyuarat</label>
                            <input type="date" name="date" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200" required>
                        </div>

                        <div>
                            <label class="block font-medium text-sm text-gray-700 mb-1">Masa</label>
                            <input type="time" name="time" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200" required>
                        </div>

                        <!-- Tempat -->
                        <div class="md:col-span-2">
                            <label class="block font-medium text-sm text-gray-700 mb-1">Tempat</label>
                            <input type="text" name="venue" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200" required>
                        </div>

                        <!-- Status -->
                        <div>
                            <label class="block font-medium text-sm text-gray-700 mb-2">Status Mesyuarat</label>
                            <div class="flex items-center space-x-4">
                                <label class="inline-flex items-center">
                                    <input type="radio" name="status" value="Aktif" class="form-radio text-indigo-600" required>
                                    <span class="ml-2">Aktif</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="radio" name="status" value="Tidak Aktif" class="form-radio text-indigo-600" checked>
                                    <span class="ml-2">Tidak Aktif</span>
                                </label>
                            </div>
                            <p class="text-xs text-gray-500 mt-1">* Hanya satu mesyuarat boleh aktif mengikut kategori.</p>
                        </div>

                        <!-- Tarikh Tutup Kemaskini -->
                        <div>
                            <label class="block font-medium text-sm text-gray-700 mb-1">Tarikh Tutup Kemaskini Status Kemajuan Projek</label>
                            <input type="date" name="project_update_deadline" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200" required>
                        </div>

                        <!-- Minit Mesyuarat Lepas -->
                        <div class="md:col-span-2">
                            <label class="block font-medium text-sm text-gray-700 mb-1">Minit Mesyuarat Lepas (PDF/Word)</label>
                            <input type="file" name="minutes_file" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        </div>

                        <!-- Agenda (Rich Text) -->
                        <div class="md:col-span-2">
                            <label class="block font-medium text-sm text-gray-700 mb-1">Agenda</label>
                            <input id="agenda" type="hidden" name="agenda">
                            <trix-editor input="agenda" class="trix-content border-gray-300 rounded-md min-h-[150px]"></trix-editor>
                        </div>

                        <!-- Makluman Emel -->
                        <div class="md:col-span-2 mt-2">
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="send_notification" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" value="1">
                                <span class="ml-2 text-gray-700 font-medium">Klik Untuk Hantar Makluman kepada Ahli Mesyuarat</span>
                            </label>
                        </div>
                    </div>

                    <div class="flex justify-end space-x-2">
                        <a href="{{ route('meetings.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300">Batal</a>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>