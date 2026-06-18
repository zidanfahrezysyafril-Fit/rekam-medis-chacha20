<x-app-layout>
    <x-slot name="header">
        Admin Dashboard
    </x-slot>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow p-6 border-t-4 border-blue-500">
            <div class="text-sm text-gray-500 font-medium uppercase tracking-wide">Total Users</div>
            <div class="text-3xl font-bold text-gray-900 mt-2">{{ $stats['users'] }}</div>
        </div>
        <div class="bg-white rounded-lg shadow p-6 border-t-4 border-emerald-500">
            <div class="text-sm text-gray-500 font-medium uppercase tracking-wide">Total Doctors</div>
            <div class="text-3xl font-bold text-gray-900 mt-2">{{ $stats['doctors'] }}</div>
        </div>
        <div class="bg-white rounded-lg shadow p-6 border-t-4 border-violet-500">
            <div class="text-sm text-gray-500 font-medium uppercase tracking-wide">Total Patients</div>
            <div class="text-3xl font-bold text-gray-900 mt-2">{{ $stats['patients'] }}</div>
        </div>
        <div class="bg-white rounded-lg shadow p-6 border-t-4 border-amber-500">
            <div class="text-sm text-gray-500 font-medium uppercase tracking-wide">Medical Records</div>
            <div class="text-3xl font-bold text-gray-900 mt-2">{{ $stats['medical_records'] }}</div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-900">Recent Activities</h3>
        </div>
        <div class="divide-y divide-gray-200">
            @forelse($recentActivities as $log)
                <div class="p-6 flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-900">{{ $log->user->name ?? 'System' }}</p>
                        <p class="text-sm text-gray-500">{{ $log->activity }}</p>
                    </div>
                    <div class="text-sm text-gray-500">
                        {{ $log->created_at->diffForHumans() }}
                    </div>
                </div>
            @empty
                <div class="p-6 text-center text-gray-500 text-sm">
                    No recent activities found.
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>
