<x-app-layout>
    <x-slot name="header">
        Create New Medical Record
    </x-slot>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="p-6">
            <form action="{{ route('doctor.medical-records.store') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="patient_id" class="block text-sm font-medium text-gray-700">Patient</label>
                        <select id="patient_id" name="patient_id" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md" required>
                            @foreach(\App\Models\Patient::all() as $patient)
                                <option value="{{ $patient->id }}">{{ $patient->full_name }} ({{ $patient->nik }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="examination_date" class="block text-sm font-medium text-gray-700">Examination Date</label>
                        <input type="date" name="examination_date" id="examination_date" value="{{ date('Y-m-d') }}" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                    </div>
                    
                    <div class="md:col-span-2">
                        <label for="complaint" class="block text-sm font-medium text-gray-700">Complaint <span class="text-xs text-green-600">(Will be encrypted)</span></label>
                        <textarea id="complaint" name="complaint" rows="3" class="mt-1 shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md"></textarea>
                    </div>

                    <div class="md:col-span-2">
                        <label for="medical_history" class="block text-sm font-medium text-gray-700">Medical History <span class="text-xs text-green-600">(Will be encrypted)</span></label>
                        <textarea id="medical_history" name="medical_history" rows="3" class="mt-1 shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md"></textarea>
                    </div>

                    <div class="md:col-span-2">
                        <label for="diagnosis" class="block text-sm font-medium text-gray-700">Diagnosis <span class="text-xs text-green-600">(Will be encrypted)</span></label>
                        <textarea id="diagnosis" name="diagnosis" rows="3" class="mt-1 shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md"></textarea>
                    </div>

                    <div class="md:col-span-2">
                        <label for="treatment" class="block text-sm font-medium text-gray-700">Treatment <span class="text-xs text-green-600">(Will be encrypted)</span></label>
                        <textarea id="treatment" name="treatment" rows="3" class="mt-1 shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md"></textarea>
                    </div>

                    <div class="md:col-span-2">
                        <label for="prescription" class="block text-sm font-medium text-gray-700">Prescription <span class="text-xs text-green-600">(Will be encrypted)</span></label>
                        <textarea id="prescription" name="prescription" rows="3" class="mt-1 shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md"></textarea>
                    </div>

                    <div class="md:col-span-2">
                        <label for="doctor_notes" class="block text-sm font-medium text-gray-700">Doctor Notes <span class="text-xs text-green-600">(Will be encrypted)</span></label>
                        <textarea id="doctor_notes" name="doctor_notes" rows="3" class="mt-1 shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md"></textarea>
                    </div>
                </div>

                <div class="mt-6 flex justify-end">
                    <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Securely Save Record
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
