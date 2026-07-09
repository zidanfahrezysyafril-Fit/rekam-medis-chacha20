<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\MedicalRecord;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class MedicalRecordController extends Controller
{
    public function index(Request $request)
    {
        $doctor = \App\Models\Doctor::where('doctor_name', auth()->user()->name)->first();
        $query = MedicalRecord::with('patient');

        if ($doctor) {
            $query->where('doctor_id', $doctor->id);
        }

        if ($request->has('search')) {
            $search = $request->input('search');
            $searchHash = hash_hmac('sha256', $search, config('app.key'));
            $query->whereHas('patient', function($q) use ($search, $searchHash) {
                $q->where('full_name', 'like', "%{$search}%")
                  ->orWhere('nik_hash', $searchHash);
            })->orWhere('medical_record_number', 'like', "%{$search}%");
        }

        $records = $query->latest()->paginate(10);
        return view('doctor.medical-records.index', compact('records'));
    }

    public function create()
    {
        return view('doctor.medical-records.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'examination_date' => 'required|date',
            'complaint' => 'nullable|string',
            'medical_history' => 'nullable|string',
            'diagnosis' => 'nullable|string',
            'treatment' => 'nullable|string',
            'prescription' => 'nullable|string',
            'doctor_notes' => 'nullable|string',
        ]);

        $encryptionService = app(\App\Services\EncryptionService::class);
        $fieldsToEncrypt = ['complaint', 'medical_history', 'diagnosis', 'treatment', 'prescription', 'doctor_notes'];
        $encryptedData = [];
        $nonces = [];

        foreach ($fieldsToEncrypt as $field) {
            if (!empty($validated[$field])) {
                $enc = $encryptionService->encrypt($validated[$field]);
                $encryptedData[$field] = $enc['ciphertext'];
                $nonces[$field] = $enc['nonce'];
            } else {
                $encryptedData[$field] = null;
            }
        }

        $doctor = \App\Models\Doctor::where('doctor_name', auth()->user()->name)->first();

        MedicalRecord::create([
            'medical_record_number' => 'MR-' . time(),
            'patient_id' => $validated['patient_id'],
            'doctor_id' => $doctor->id ?? 1,
            'examination_date' => $validated['examination_date'],
            'complaint' => $encryptedData['complaint'],
            'medical_history' => $encryptedData['medical_history'],
            'diagnosis' => $encryptedData['diagnosis'],
            'treatment' => $encryptedData['treatment'],
            'prescription' => $encryptedData['prescription'],
            'doctor_notes' => $encryptedData['doctor_notes'],
            'nonce' => json_encode($nonces),
        ]);

        \App\Services\ActivityLogger::log('Membuat rekam medis baru untuk pasien ID ' . $validated['patient_id']);

        return redirect()->route('doctor.medical-records.index')->with('success', 'Rekam Medis Berhasil Dibuat dan Dienkripsi.');
    }

    public function show(MedicalRecord $medicalRecord)
    {
        $encryptionService = app(\App\Services\EncryptionService::class);
        $fieldsToDecrypt = ['complaint', 'medical_history', 'diagnosis', 'treatment', 'prescription', 'doctor_notes'];
        
        $nonces = json_decode($medicalRecord->nonce, true);
        
        foreach ($fieldsToDecrypt as $field) {
            if (!empty($medicalRecord->{$field}) && isset($nonces[$field])) {
                try {
                    $medicalRecord->{$field} = $encryptionService->decrypt($medicalRecord->{$field}, $nonces[$field]);
                } catch (\Exception $e) {
                    $medicalRecord->{$field} = 'ERROR: Gagal mendekripsi data.';
                }
            }
        }

        return view('doctor.medical-records.show', compact('medicalRecord'));
    }

    public function edit(MedicalRecord $medicalRecord)
    {
        // Decrypt the record so it can be edited
        $encryptionService = app(\App\Services\EncryptionService::class);
        $fieldsToDecrypt = ['complaint', 'medical_history', 'diagnosis', 'treatment', 'prescription', 'doctor_notes'];
        
        $nonces = json_decode($medicalRecord->nonce, true);
        
        foreach ($fieldsToDecrypt as $field) {
            if (!empty($medicalRecord->{$field}) && isset($nonces[$field])) {
                try {
                    $medicalRecord->{$field} = $encryptionService->decrypt($medicalRecord->{$field}, $nonces[$field]);
                } catch (\Exception $e) {
                    $medicalRecord->{$field} = ''; // If fails, empty it to prevent errors in form
                }
            }
        }

        return view('doctor.medical-records.edit', compact('medicalRecord'));
    }

    public function update(Request $request, MedicalRecord $medicalRecord)
    {
        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'examination_date' => 'required|date',
            'complaint' => 'nullable|string',
            'medical_history' => 'nullable|string',
            'diagnosis' => 'nullable|string',
            'treatment' => 'nullable|string',
            'prescription' => 'nullable|string',
            'doctor_notes' => 'nullable|string',
        ]);

        $encryptionService = app(\App\Services\EncryptionService::class);
        $fieldsToEncrypt = ['complaint', 'medical_history', 'diagnosis', 'treatment', 'prescription', 'doctor_notes'];
        
        // Retrieve old nonces
        $nonces = json_decode($medicalRecord->nonce, true) ?: [];
        $encryptedData = [];

        foreach ($fieldsToEncrypt as $field) {
            if (!empty($validated[$field])) {
                // Re-encrypt updated fields with new nonces for maximum security
                $enc = $encryptionService->encrypt($validated[$field]);
                $encryptedData[$field] = $enc['ciphertext'];
                $nonces[$field] = $enc['nonce'];
            } else {
                $encryptedData[$field] = null;
                unset($nonces[$field]); // Remove nonce if field is now empty
            }
        }

        $medicalRecord->update([
            'patient_id' => $validated['patient_id'],
            'examination_date' => $validated['examination_date'],
            'complaint' => $encryptedData['complaint'],
            'medical_history' => $encryptedData['medical_history'],
            'diagnosis' => $encryptedData['diagnosis'],
            'treatment' => $encryptedData['treatment'],
            'prescription' => $encryptedData['prescription'],
            'doctor_notes' => $encryptedData['doctor_notes'],
            'nonce' => json_encode($nonces),
        ]);

        \App\Services\ActivityLogger::log('Memperbarui rekam medis ' . $medicalRecord->medical_record_number);

        return redirect()->route('doctor.medical-records.index')->with('success', 'Rekam Medis Berhasil Diperbarui.');
    }

    public function exportPdf(MedicalRecord $medicalRecord)
    {
        // First, decrypt the data
        $encryptionService = app(\App\Services\EncryptionService::class);
        $fieldsToDecrypt = ['complaint', 'medical_history', 'diagnosis', 'treatment', 'prescription', 'doctor_notes'];
        $nonces = json_decode($medicalRecord->nonce, true);
        
        foreach ($fieldsToDecrypt as $field) {
            if (!empty($medicalRecord->{$field}) && isset($nonces[$field])) {
                try {
                    $medicalRecord->{$field} = $encryptionService->decrypt($medicalRecord->{$field}, $nonces[$field]);
                } catch (\Exception $e) {
                    $medicalRecord->{$field} = 'ERROR: Decryption failed.';
                }
            }
        }

        $pdf = Pdf::loadView('pdf.medical-record', compact('medicalRecord'));
        
        \App\Services\ActivityLogger::log('Mengekspor rekam medis ke PDF: ' . $medicalRecord->medical_record_number);

        return $pdf->download('Rekam_Medis_' . $medicalRecord->medical_record_number . '.pdf');
    }
}
