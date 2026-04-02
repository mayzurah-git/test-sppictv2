<!DOCTYPE html>
<html>
<head>
    <title>Permohonan Projek Baharu</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6;">
    <h2>Permohonan Projek Baharu Diterima</h2>
    <p>Salam Sejahtera,</p>
    
    <p>Satu permohonan projek baharu telah dihantar dan kini menunggu semakan pihak Urus Setia.</p>
    
    <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
        <tr>
            <td style="width: 150px; font-weight: bold;">Tajuk Projek:</td>
            <td>{{ $project->project_title }}</td>
        </tr>
        <tr>
            <td style="font-weight: bold;">Kod Projek:</td>
            <td>{{ $project->project_code }}</td>
        </tr>
        <tr>
            <td style="font-weight: bold;">Agensi:</td>
            <td>{{ $project->agency->agency_name }}</td>
        </tr>
        <tr>
            <td style="font-weight: bold;">Nama Pemohon:</td>
            <td>{{ $project->creator->name ?? '-' }}</td>
        </tr>
        <tr>
            <td style="font-weight: bold;">Tarikh Hantar:</td>
            <td>{{ now()->format('d/m/Y H:i') }}</td>
        </tr>
    </table>

    <p>Sila log masuk ke sistem SPPICT untuk tindakan selanjutnya.</p>
    
    <p>Terima Kasih.</p>
</body>
</html>