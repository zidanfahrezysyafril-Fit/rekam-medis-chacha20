<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MedicalRecordController extends Controller
{
    public function create()
    {
        return view('doctor.medical-records.create');
    }

    public function store(\Illuminate\Http\Request $request)
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
        $nonce = null;

        $fieldsToEncrypt = ['complaint', 'medical_history', 'diagnosis', 'treatment', 'prescription', 'doctor_notes'];
        $encryptedData = [];

        // Encrypt fields, combine them first or encrypt individually?
        // Since we only have one nonce column in the db schema, we either need to:
        // 1. JSON encode the fields, encrypt the JSON, and store it in one column.
        // 2. Or, share the same nonce for all fields. (Not ideal for stream ciphers, but since they are stored in the same row, it might be acceptable for a demo, or we can just JSON encode).
        // Let's JSON encode all encrypted fields and put it in 'complaint' or just use one nonce to encrypt each string? 
        // Wait, using the SAME key and SAME nonce to encrypt DIFFERENT messages is a catastrophic failure for ChaCha20 (two-time pad).
        // So we must use a different nonce for each, OR just JSON encode all fields into a single string, encrypt it, and store in one column. 
        // But the schema has individual columns. 
        // A better approach for the individual columns: concatenate the column name to the data? No, still two-time pad.
        // Let's modify the approach: we will generate ONE nonce for the entire record. We will serialize the sensitive array to JSON, encrypt it, and save the ciphertext in 'complaint' (or a new 'encrypted_data' column). 
        // Actually, since the prompt specifies: "Encrypt the following fields: complaint... Store encrypted ciphertext in the database. Store nonce separately."
        // We can just base64_encode the encrypted strings and store them in the columns. But wait, if we use the SAME nonce for multiple fields, we compromise the stream cipher.
        // To avoid this while adhering to the prompt, we can derive a unique sub-nonce for each field from the primary record nonce, or simply generate a 24-byte nonce, and for each field, modify the last byte. 
        // Let's just generate a nonce per record and encrypt a JSON payload, but store it in 'medical_history' or just encrypt each field with a newly generated nonce and append the nonce to the field? The prompt says "Store nonce separately" - implying a single nonce column.
        // Let's json_encode the fields, encrypt that json, and save it in a designated column, OR just use the same nonce for the demo (not cryptographically secure but fits the simple schema).
        // Let's encrypt the JSON of all sensitive fields and store it in a single column `encrypted_data`, but the schema has individual columns.
        // I will just use the same nonce for all fields for the sake of the prompt's simplicity, but log a warning in comments.
        // Wait! `sodium_crypto_aead_xchacha20poly1305_ietf_encrypt` could be used with Additional Authenticated Data (AAD) to differentiate fields. But we are using stream_xor.
        // I'll encrypt each field with a different nonce and store the nonces as a JSON object in the `nonce` column. That's secure and fulfills the requirement.

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

        \App\Models\MedicalRecord::create([
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

        \App\Services\ActivityLogger::log('Created medical record for patient ID ' . $validated['patient_id']);

        return redirect()->route('doctor.medical-records.index')->with('success', 'Medical Record Created Successfully.');
    }

    public function show(\App\Models\MedicalRecord $medicalRecord)
    {
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

        return view('doctor.medical-records.show', compact('medicalRecord'));
    }
}
