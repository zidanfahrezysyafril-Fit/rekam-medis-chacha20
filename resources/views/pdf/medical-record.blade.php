<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Rekam Medis #{{ $medicalRecord->medical_record_number }}</title>
    <style>
        body { font-family: sans-serif; line-height: 1.5; color: #333; }
        .header { text-align: center; border-bottom: 2px solid #2563eb; padding-bottom: 10px; margin-bottom: 20px; }
        .header h1 { margin: 0; color: #1e3a8a; }
        .details-table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        .details-table th, .details-table td { padding: 8px; border: 1px solid #ddd; text-align: left; }
        .details-table th { background-color: #f3f4f6; width: 30%; }
        .section-title { font-size: 1.2rem; font-weight: bold; color: #1e40af; border-bottom: 1px solid #bfdbfe; margin-top: 20px; padding-bottom: 5px; }
        .content { background-color: #f8fafc; padding: 10px; border: 1px solid #e2e8f0; border-radius: 4px; min-height: 50px; }
        .footer { margin-top: 50px; text-align: right; font-size: 0.9em; }
        .signature { margin-top: 60px; border-top: 1px solid #333; display: inline-block; padding-top: 5px; min-width: 200px; text-align: center; }
    </style>
</head>
<body>
    <div class="header">
        <h1>MedSecure - Rekam Medis Digital</h1>
        <p>Dokumen Riwayat Pemeriksaan Medis Pasien</p>
    </div>

    <table class="details-table">
        <tr>
            <th>No. Rekam Medis</th>
            <td><strong>{{ $medicalRecord->medical_record_number }}</strong></td>
        </tr>
        <tr>
            <th>Tanggal Pemeriksaan</th>
            <td>{{ \Carbon\Carbon::parse($medicalRecord->examination_date)->format('d F Y') }}</td>
        </tr>
        <tr>
            <th>Nama Pasien</th>
            <td>{{ $medicalRecord->patient->full_name }} (NIK: {{ $medicalRecord->patient->nik }})</td>
        </tr>
        <tr>
            <th>Dokter Pemeriksa</th>
            <td>{{ $medicalRecord->doctor->doctor_name }} ({{ $medicalRecord->doctor->specialization }})</td>
        </tr>
    </table>

    <div class="section-title">Keluhan Utama</div>
    <div class="content">{{ $medicalRecord->complaint ?? '-' }}</div>

    <div class="section-title">Riwayat Penyakit</div>
    <div class="content">{{ $medicalRecord->medical_history ?? '-' }}</div>

    <div class="section-title">Diagnosis</div>
    <div class="content">{{ $medicalRecord->diagnosis ?? '-' }}</div>

    <div class="section-title">Tindakan Medis</div>
    <div class="content">{{ $medicalRecord->treatment ?? '-' }}</div>

    <div class="section-title">Resep Obat</div>
    <div class="content">{{ $medicalRecord->prescription ?? '-' }}</div>

    <div class="section-title">Catatan Dokter</div>
    <div class="content">{{ $medicalRecord->doctor_notes ?? '-' }}</div>

    <div class="footer">
        <p>Dokumen ini dicetak dari sistem MedSecure pada {{ now()->format('d M Y H:i') }}</p>
        <p>Ditandatangani secara digital oleh,</p>
        <div class="signature">
            {{ $medicalRecord->doctor->doctor_name }}
        </div>
    </div>
</body>
</html>
