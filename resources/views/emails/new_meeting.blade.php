<!DOCTYPE html>
<html>
<head>
    <title>Makluman Mesyuarat</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <h2>Makluman Mesyuarat Baru</h2>
    <p>Assalamualaikum dan Salam Sejahtera,</p>
    
    <p>Tuan/Puan, dimaklumkan bahawa satu mesyuarat telah didaftarkan dalam sistem SPPICT seperti ketetapan berikut:</p>
    
    <table style="width: 100%; border-collapse: collapse; margin: 20px 0;">
        <tr style="background-color: #f2f2f2;">
            <td style="padding: 10px; border: 1px solid #ddd; font-weight: bold; width: 200px;">Mesyuarat</td>
            <td style="padding: 10px; border: 1px solid #ddd;">{{ $meeting->title }} Bil. {{ $meeting->meeting_number }} / {{ $meeting->year }}</td>
        </tr>
        <tr>
            <td style="padding: 10px; border: 1px solid #ddd; font-weight: bold;">Tarikh</td>
            <td style="padding: 10px; border: 1px solid #ddd;">{{ \Carbon\Carbon::parse($meeting->date)->format('d/m/Y') }}</td>
        </tr>
        <tr style="background-color: #f2f2f2;">
            <td style="padding: 10px; border: 1px solid #ddd; font-weight: bold;">Masa / Tempat</td>
            <td style="padding: 10px; border: 1px solid #ddd;">{{ $meeting->time }} / {{ $meeting->venue }}</td>
        </tr>
        <tr>
            <td style="padding: 10px; border: 1px solid #ddd; font-weight: bold; color: #d9534f;">Tarikh Tutup Kemaskini Status Kemajuan Projek</td>
            <td style="padding: 10px; border: 1px solid #ddd; color: #d9534f; font-weight: bold;">{{ \Carbon\Carbon::parse($meeting->project_update_deadline)->format('d F Y') }}</td>
        </tr>
    </table>

    <div style="background-color: #fff3cd; border: 1px solid #ffeeba; padding: 15px; border-radius: 5px;">
        <strong>Agenda:</strong><br>
        {!! $meeting->agenda !!}
    </div>

    <p>Sila pastikan status kemajuan projek agensi tuan/puan telah dikemaskini sebelum tarikh tutup yang dinyatakan.</p>
    
    <p>Sekian, terima kasih.<br><strong>Urus Setia SPPICT</strong></p>
</body>
</html>
