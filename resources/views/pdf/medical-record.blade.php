<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Medical Record #{{ $medicalRecord->medical_record_number }}</title>
    <style>
        body { font-family: sans-serif; line-height: 1.5; color: #333; }
        .header { text-align: center; border-bottom: 2px solid #2563eb; padding-bottom: 10px; margin-bottom: 20px; }
        .header h1 { margin: 0; color: #1e3a8a; }
        .details-table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        .details-table th, .details-table td { padding: 8px; border: 1px solid #ddd; text-align: left; }
        .details-table th { background-color: #f3f4f6; width: 30%; }
        .section-title { font-size: 1.2rem; font-weight: bold; color: #1e40af; border-bottom: 1px solid #bfdbfe; margin-top: 20px; padding-bottom: 5px; }
        .content { background-color: #f8fafc; padding: 10px; border: 1px solid #e2e8f0; border-radius: 4px; min-height: 50px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Clinic Name / EMR System</h1>
        <p>Medical Record Document</p>
    </div>

    <table class="details-table">
        <tr>
            <th>Record Number</th>
            <td>{{ $medicalRecord->medical_record_number }}</td>
        </tr>
        <tr>
            <th>Examination Date</th>
            <td>{{ \Carbon\Carbon::parse($medicalRecord->examination_date)->format('d F Y') }}</td>
        </tr>
        <tr>
            <th>Patient Name</th>
            <td>{{ $medicalRecord->patient->full_name }} (NIK: {{ $medicalRecord->patient->nik }})</td>
        </tr>
        <tr>
            <th>Doctor</th>
            <td>Dr. {{ $medicalRecord->doctor->doctor_name }} ({{ $medicalRecord->doctor->specialization }})</td>
        </tr>
    </table>

    <div class="section-title">Complaint</div>
    <div class="content">{{ $medicalRecord->complaint ?? '-' }}</div>

    <div class="section-title">Medical History</div>
    <div class="content">{{ $medicalRecord->medical_history ?? '-' }}</div>

    <div class="section-title">Diagnosis</div>
    <div class="content">{{ $medicalRecord->diagnosis ?? '-' }}</div>

    <div class="section-title">Treatment</div>
    <div class="content">{{ $medicalRecord->treatment ?? '-' }}</div>

    <div class="section-title">Prescription</div>
    <div class="content">{{ $medicalRecord->prescription ?? '-' }}</div>

    <div class="section-title">Doctor Notes</div>
    <div class="content">{{ $medicalRecord->doctor_notes ?? '-' }}</div>
</body>
</html>
