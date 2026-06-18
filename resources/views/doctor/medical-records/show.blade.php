<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center w-full">
            <span>Medical Record Details</span>
            <a href="{{ route('doctor.medical-records.pdf', $medicalRecord->id) }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-900 focus:outline-none focus:border-green-900 focus:ring ring-green-300 disabled:opacity-25 transition ease-in-out duration-150">
                Download PDF
            </a>
        </div>
    </x-slot>

    <div class="bg-white rounded-lg shadow overflow-hidden mb-6">
        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50 flex justify-between items-center">
            <h3 class="text-lg font-medium text-gray-900">Record #{{ $medicalRecord->medical_record_number }}</h3>
            <span class="text-sm text-gray-500">Patient: {{ $medicalRecord->patient->full_name }} (NIK: {{ $medicalRecord->patient->nik }})</span>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <p class="text-sm text-gray-500 font-medium">Examination Date</p>
                    <p class="text-base text-gray-900">{{ \Carbon\Carbon::parse($medicalRecord->examination_date)->format('l, d F Y') }}</p>
                </div>
            </div>

            <!-- Decrypted Data Presentation -->
            <div class="space-y-6">
                <div class="bg-blue-50 p-4 rounded-md border border-blue-100">
                    <p class="text-sm font-semibold text-blue-800 uppercase tracking-wide mb-1">Complaint</p>
                    <p class="text-gray-800">{{ $medicalRecord->complaint ?? '-' }}</p>
                </div>

                <div class="bg-blue-50 p-4 rounded-md border border-blue-100">
                    <p class="text-sm font-semibold text-blue-800 uppercase tracking-wide mb-1">Medical History</p>
                    <p class="text-gray-800">{{ $medicalRecord->medical_history ?? '-' }}</p>
                </div>

                <div class="bg-emerald-50 p-4 rounded-md border border-emerald-100">
                    <p class="text-sm font-semibold text-emerald-800 uppercase tracking-wide mb-1">Diagnosis</p>
                    <p class="text-gray-800">{{ $medicalRecord->diagnosis ?? '-' }}</p>
                </div>

                <div class="bg-emerald-50 p-4 rounded-md border border-emerald-100">
                    <p class="text-sm font-semibold text-emerald-800 uppercase tracking-wide mb-1">Treatment</p>
                    <p class="text-gray-800">{{ $medicalRecord->treatment ?? '-' }}</p>
                </div>

                <div class="bg-amber-50 p-4 rounded-md border border-amber-100">
                    <p class="text-sm font-semibold text-amber-800 uppercase tracking-wide mb-1">Prescription</p>
                    <p class="text-gray-800">{{ $medicalRecord->prescription ?? '-' }}</p>
                </div>

                <div class="bg-gray-50 p-4 rounded-md border border-gray-200">
                    <p class="text-sm font-semibold text-gray-700 uppercase tracking-wide mb-1">Doctor Notes</p>
                    <p class="text-gray-800">{{ $medicalRecord->doctor_notes ?? '-' }}</p>
                </div>
            </div>
            
            <div class="mt-6 text-right">
                <p class="text-xs text-green-600 font-semibold italic">Successfully decrypted via ChaCha20.</p>
            </div>
        </div>
    </div>
    
    <div class="mb-4">
        <a href="{{ route('doctor.medical-records.index') }}" class="text-blue-600 hover:text-blue-800 font-medium text-sm">
            &larr; Back to Medical Records
        </a>
    </div>
</x-app-layout>
