<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center w-full">
            <span>All Medical Records</span>
            <a href="{{ route('doctor.medical-records.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                + New Record
            </a>
        </div>
    </x-slot>

    @if(session('success'))
        <div class="bg-green-50 border-l-4 border-green-400 p-4 mb-8">
            <div class="flex">
                <div class="ml-3">
                    <p class="text-sm text-green-700">
                        {{ session('success') }}
                    </p>
                </div>
            </div>
        </div>
    @endif

    <div class="bg-white rounded-lg shadow overflow-hidden">
        @php
            $doctor = \App\Models\Doctor::where('doctor_name', auth()->user()->name)->first();
            $records = $doctor ? \App\Models\MedicalRecord::where('doctor_id', $doctor->id)->with('patient')->latest()->paginate(10) : collect([]);
        @endphp

        @if(count($records) > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Record Number</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Patient</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($records as $record)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $record->medical_record_number }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ \Carbon\Carbon::parse($record->examination_date)->format('d M Y') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $record->patient->full_name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <a href="{{ route('doctor.medical-records.show', $record->id) }}" class="text-blue-600 hover:text-blue-900 mr-3">View</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @if(method_exists($records, 'hasPages') && $records->hasPages())
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $records->links() }}
                </div>
            @endif
        @else
            <div class="p-6 text-center text-gray-500">
                You have not created any medical records yet.
            </div>
        @endif
    </div>
</x-app-layout>
