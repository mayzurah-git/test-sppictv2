<!DOCTYPE html>
<html>
<head>
    <title> Status Permohonan Projek</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6;">
    <h2>Maklum Balas Permohonan Projek: Perlu Pembetulan</h2>
    <p>Salam Sejahtera,</p>
    
    <p>Permohonan projek anda telah disemak oleh Urus Setia dan dikembalikan untuk pembetulan. Berikut adalah butiran permohonan dan ulasan daripada Urus Setia.</p>
    
    <table style="width: 100%; border-collapse: collapse; margin: 20px 0;">
        <tr style="background-color: #f2f2f2;">
            <td style="padding: 8px; border: 1px solid #ddd; width: 150px; font-weight: bold;">Tajuk Projek</td>
            <td style="padding: 8px; border: 1px solid #ddd;">{{ $project->project_title }}</td>
        </tr>
        <tr>
            <td style="padding: 8px; border: 1px solid #ddd; font-weight: bold;">Kod Projek</td>
            <td style="padding: 8px; border: 1px solid #ddd;">{{ $project->project_code }}</td>
        </tr>
        <tr style="background-color: #f2f2f2;">
            <td style="padding: 8px; border: 1px solid #ddd; font-weight: bold;">Tarikh Maklum Balas</td>
            <td style="padding: 8px; border: 1px solid #ddd;">{{ now()->format('d/m/Y H:i') }}</td>
        </tr>
    </table>

    <div style="border: 1px solid #f0ad4e; background-color: #fcf8e3; padding: 15px; border-radius: 4px;">
        <h4 style="margin-top: 0; color: #8a6d3b;">Ulasan Urus Setia:</h4>
        <p style="white-space: pre-wrap;">{{ $project->urusetia_remarks }}</p>
    </div>

    <p style="margin-top: 20px;">Sila log masuk ke sistem SPPICT untuk membuat kemaskini dan menghantar semula permohonan anda.</p>
    
    <p>Terima Kasih,<br>Urus Setia<br>SPPICT</p>
</body>
</html>