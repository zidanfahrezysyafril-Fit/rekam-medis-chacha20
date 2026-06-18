<x-app-layout>
    <x-slot name="header">
        Patient Dashboard
    </x-slot>

    @if(!$patient)
        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-8">
            <div class="flex">
                <div class="flex-shrink-0">
                    <!-- Icon -->
                    <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-yellow-700">
                        Your profile is not yet fully linked to a patient record in the system. Please ensure your email matches your NIK or your name matches the full name in the clinic's database.
                    </p>
                </div>
            </div>
        </div>
    @else
        <div class="bg-white rounded-lg shadow overflow-hidden mb-8">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900">Personal Information</h3>
            </div>
            <div class="px-6 py-4">
                <dl class="grid grid-cols-1 sm:grid-cols-2 gap-x-4 gap-y-6">
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">Full name</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $patient->full_name }}</dd>
                    </div>
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">NIK</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $patient->nik }}</dd>
                    </div>
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">Date of Birth</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $patient->date_of_birth }}</dd>
                    </div>
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">Blood Type</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $patient->blood_type ?? '-' }}</dd>
                    </div>
                </dl>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                <h3 class="text-lg font-medium text-gray-900">Recent Medical Records</h3>
                <a href="{{ route('patient.medical-records.index') }}" class="text-sm text-blue-600 hover:text-blue-500">View all</a>
            </div>
            <div class="divide-y divide-gray-200">
                @forelse($myRecords as $record)
                    <div class="p-6 flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-900">Record #{{ $record->medical_record_number }}</p>
                            <p class="text-sm text-gray-500">Dr. {{ $record->doctor->doctor_name }}</p>
                        </div>
                        <div class="flex items-center">
                            <span class="text-sm text-gray-500 mr-4">{{ \Carbon\Carbon::parse($record->examination_date)->format('d M Y') }}</span>
                            <a href="{{ route('patient.medical-records.show', $record->id) }}" class="text-blue-600 hover:text-blue-900 text-sm font-medium">View Details</a>
                        </div>
                    </div>
                @empty
                    <div class="p-6 text-center text-gray-500 text-sm">
                        No medical records found.
                    </div>
                @endforelse
            </div>
        </div>
    @endif
</x-app-layout>
