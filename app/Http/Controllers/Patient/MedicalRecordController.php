<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MedicalRecordController extends Controller
{
    public function index()
    {
        $patient = \App\Models\Patient::where('nik', auth()->user()->email)->orWhere('full_name', auth()->user()->name)->first();
        $records = [];
        if ($patient) {
            $records = \App\Models\MedicalRecord::where('patient_id', $patient->id)->with('doctor')->latest()->paginate(10);
        }
        return view('patient.medical-records.index', compact('records'));
    }

    public function show(\App\Models\MedicalRecord $medicalRecord)
    {
        $patient = \App\Models\Patient::where('nik', auth()->user()->email)->orWhere('full_name', auth()->user()->name)->first();
        if (!$patient || $medicalRecord->patient_id !== $patient->id) {
            abort(403);
        }

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

        return view('patient.medical-records.show', compact('medicalRecord'));
    }

    public function exportPdf(\App\Models\MedicalRecord $medicalRecord)
    {
        $patient = \App\Models\Patient::where('nik', auth()->user()->email)->orWhere('full_name', auth()->user()->name)->first();
        if (!$patient || $medicalRecord->patient_id !== $patient->id) {
            abort(403);
        }

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

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('pdf.medical-record', compact('medicalRecord'));
        return $pdf->download('medical-record-'.$medicalRecord->medical_record_number.'.pdf');
    }
}
