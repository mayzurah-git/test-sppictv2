<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Permohonan - {{ $project->project_code }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @media print {
            .no-print { display: none; }
            body { -webkit-print-color-adjust: exact; }
        }
    </style>
</head>
<body class="bg-white text-gray-900 p-8">
    <div class="max-w-4xl mx-auto">
        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold uppercase">Permohonan Projek ICT</h1>
            <p class="text-sm text-gray-600">{{ $project->agency->agency_name }}</p>
        </div>

        <!-- Maklumat Asas -->
        <div class="mb-8">
            <h2 class="text-lg font-bold border-b-2 border-gray-800 mb-4 uppercase">Maklumat Asas Projek</h2>
            <table class="w-full text-sm text-left">
                <tr>
                    <td class="py-2 font-semibold w-1/3">Kod Projek</td>
                    <td class="py-2">: {{ $project->project_code }}</td>
                </tr>
                <tr>
                    <td class="py-2 font-semibold">Nama Projek</td>
                    <td class="py-2">: {{ $project->project_title }}</td>
                </tr>
                <tr>
                    <td class="py-2 font-semibold">Anggaran Kos (RM)</td>
                    <td class="py-2">: {{ number_format($project->estimated_department_cost, 2) }}</td>
                </tr>
                <tr>
                    <td class="py-2 font-semibold">Objektif</td>
                    <td class="py-2 prose max-w-none">{!! $project->objective !!}</td>
                </tr>
                <tr>
                    <td class="py-2 font-semibold">Skop</td>
                    <td class="py-2 prose max-w-none">{!! $project->scope !!}</td>
                </tr>
                <tr>
                    <td class="py-2 font-semibold">Tempoh Pelaksanaan</td>
                    <td class="py-2">: {{ $project->implementation_period }}</td>
                </tr>
                <tr>
                    <td class="py-2 font-semibold">Sumber Peruntukan</td>
                    <td class="py-2">: {{ $project->funding_source }}</td>
                </tr>
            </table>
        </div>

        <!-- Perincian -->
        <div class="mb-8">
            <h2 class="text-lg font-bold border-b-2 border-gray-800 mb-4 uppercase">Perincian Projek</h2>
            <table class="w-full text-sm border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="border border-gray-300 px-2 py-1">Kategori</th>
                        <th class="border border-gray-300 px-2 py-1">Spesifikasi</th>
                        <th class="border border-gray-300 px-2 py-1 text-center">Unit</th>
                        <th class="border border-gray-300 px-2 py-1 text-right">Kos Seunit (RM)</th>
                        <th class="border border-gray-300 px-2 py-1 text-right">Jumlah (RM)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($project->details as $detail)
                    <tr>
                        <td class="border border-gray-300 px-2 py-1">{{ $detail->project_category }}</td>
                        <td class="border border-gray-300 px-2 py-1 prose max-w-none">{!! $detail->technical_specification !!}</td>
                        <td class="border border-gray-300 px-2 py-1 text-center">{{ $detail->quantity }}</td>
                        <td class="border border-gray-300 px-2 py-1 text-right">{{ number_format($detail->unit_cost, 2) }}</td>
                        <td class="border border-gray-300 px-2 py-1 text-right">{{ number_format($detail->total_cost, 2) }}</td>
                    </tr>
                    @endforeach
                    <tr class="font-bold bg-gray-50">
                        <td colspan="4" class="border border-gray-300 px-2 py-1 text-right">JUMLAH KESELURUHAN</td>
                        <td class="border border-gray-300 px-2 py-1 text-right">{{ number_format($project->details->sum('total_cost'), 2) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Pegawai -->
        <div class="mb-8">
            <h2 class="text-lg font-bold border-b-2 border-gray-800 mb-4 uppercase">Maklumat Pegawai</h2>
            <table class="w-full text-sm text-left">
                <tr>
                    <td class="py-2 font-semibold w-1/3">Nama Pegawai</td>
                    <td class="py-2">: {{ $project->officer_name ?? '-' }}</td>
                </tr>
                <tr>
                    <td class="py-2 font-semibold">Jawatan</td>
                    <td class="py-2">: {{ $project->officer_position ?? '-' }}</td>
                </tr>
                <tr>
                    <td class="py-2 font-semibold">Emel</td>
                    <td class="py-2">: {{ $project->officer_email ?? '-' }}</td>
                </tr>
                <tr>
                    <td class="py-2 font-semibold">No. Telefon</td>
                    <td class="py-2">: {{ $project->officer_phone ?? '-' }}</td>
                </tr>
            </table>
        </div>

        <script>
            window.onload = function() { window.print(); }
        </script>
    </div>
</body>
</html>
