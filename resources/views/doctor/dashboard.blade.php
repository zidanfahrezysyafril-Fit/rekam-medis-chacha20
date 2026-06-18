<x-app-layout>
    <x-slot name="header">
        Doctor Dashboard
    </x-slot>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow p-6 border-t-4 border-blue-500">
            <div class="text-sm text-gray-500 font-medium uppercase tracking-wide">Total Patients in System</div>
            <div class="text-3xl font-bold text-gray-900 mt-2">{{ $stats['total_patients'] }}</div>
        </div>
        <div class="bg-white rounded-lg shadow p-6 border-t-4 border-emerald-500">
            <div class="text-sm text-gray-500 font-medium uppercase tracking-wide">My Medical Records</div>
            <div class="text-3xl font-bold text-gray-900 mt-2">{{ $stats['my_records'] }}</div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-900">Quick Actions</h3>
        </div>
        <div class="p-6">
            <a href="{{ route('doctor.medical-records.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                + Create New Medical Record
            </a>
            <a href="{{ route('doctor.patients.index') }}" class="ml-4 inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:ring ring-blue-200 active:text-gray-800 active:bg-gray-50 disabled:opacity-25 transition ease-in-out duration-150">
                View All Patients
            </a>
        </div>
    </div>
</x-app-layout>
