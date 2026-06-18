<x-app-layout>
    <x-slot name="header">
        Patient List
    </x-slot>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-900">All Registered Patients</h3>
        </div>
        
        @php
            $patients = \App\Models\Patient::latest()->paginate(10);
        @endphp

        @if(count($patients) > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIK</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Full Name</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date of Birth</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Gender</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Blood Type</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($patients as $patient)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $patient->nik }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $patient->full_name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $patient->date_of_birth }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $patient->gender }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $patient->blood_type ?? '-' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @if($patients->hasPages())
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $patients->links() }}
                </div>
            @endif
        @else
            <div class="p-6 text-center text-gray-500">
                No patients registered in the system yet.
            </div>
        @endif
    </div>
</x-app-layout>
