<!DOCTYPE html>
<html>
<head>
    <title>Status Permohonan Projek</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6;">
    <h2>Maklum Balas Permohonan Projek: Permohonan Lengkap</h2>
    <p>Salam Sejahtera,</p>
    
    <p>Sukacita dimaklumkan bahawa permohonan projek anda telah disemak oleh Urus Setia dan didapati <strong>LENGKAP</strong>.</p>
    
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

    <p>Permohonan ini akan dibawa untuk pembentangan dalam Mesyuarat Jawatankuasa Teknikal ICT (JTKICT) yang akan datang.</p>
    
    <p>Terima Kasih,<br>Urus Setia<br>SPPICT</p>
</body>
</html>