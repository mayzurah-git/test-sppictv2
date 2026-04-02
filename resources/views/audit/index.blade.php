<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Log Audit Sistem</h2>

            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <div class="overflow-x-auto">
                    <table class="min-w-full border text-sm">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="border px-4 py-2 text-left">Tarikh & Masa</th>
                                <th class="border px-4 py-2 text-left">Pengguna</th>
                                <th class="border px-4 py-2 text-left">Aktiviti</th>
                                <th class="border px-4 py-2 text-left">Rekod Terlibat</th>
                                <th class="border px-4 py-2 text-center">Perincian</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($logs as $log)
                            <tr class="hover:bg-gray-50">
                                <td class="border px-4 py-2 whitespace-nowrap">{{ $log->created_at->format('d/m/Y H:i:s') }}</td>
                                <td class="border px-4 py-2">{{ $log->user->name ?? 'Sistem / Pengguna Dipadam' }}</td>
                                <td class="border px-4 py-2">
                                    <span class="font-semibold uppercase">{{ $log->event }}</span>
                                </td>
                                <td class="border px-4 py-2">
                                    @if ($log->auditable)
                                        {{ class_basename($log->auditable_type) }}
                                        @if ($log->auditable_type === 'App\Models\Project')
                                            - <a href="{{ route('projects.show', $log->auditable_id) }}" class="text-blue-600 hover:underline" target="_blank">{{ $log->auditable->project_code }}</a>
                                        @else
                                            (ID: {{ $log->auditable_id }})
                                        @endif
                                    @else
                                        Rekod telah dipadam
                                    @endif
                                </td>
                                <td class="border px-4 py-2 text-center">
                                    @if($log->old_values || $log->new_values)
                                        <button 
                                            type="button" 
                                            class="text-blue-600 hover:underline text-xs"
                                            onclick="showChanges({{ json_encode($log) }})">
                                            Lihat
                                        </button>
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="border px-4 py-2 text-center text-gray-500">Tiada rekod audit ditemui.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="mt-4">
                    {{ $logs->links() }}
                </div>
            </div>
        </div>
    </div>

    <!-- Modal untuk memaparkan perubahan -->
    <div id="changesModal" class="fixed z-10 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Perincian Perubahan</h3>
                    <div class="mt-4 text-xs grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <h4 class="font-bold mb-2 text-red-700">Nilai Lama</h4>
                            <pre id="oldValues" class="bg-red-50 p-3 rounded-md text-red-900 overflow-auto max-h-96"></pre>
                        </div>
                        <div>
                            <h4 class="font-bold mb-2 text-green-700">Nilai Baru</h4>
                            <pre id="newValues" class="bg-green-50 p-3 rounded-md text-green-900 overflow-auto max-h-96"></pre>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse"><button type="button" onclick="document.getElementById('changesModal').classList.add('hidden')" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none sm:mt-0 sm:w-auto sm:text-sm">Tutup</button></div>
            </div>
        </div>
    </div>

    <script>
        function showChanges(log) {
            document.getElementById('oldValues').textContent = JSON.stringify(log.old_values, null, 2) || 'Tiada';
            document.getElementById('newValues').textContent = JSON.stringify(log.new_values, null, 2) || 'Tiada';
            document.getElementById('changesModal').classList.remove('hidden');
        }
    </script>
</x-app-layout>