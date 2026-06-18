@if(Auth::user()->role === 'admin')
    <a href="{{ route('admin.dashboard') }}" class="group flex items-center px-2 py-2 text-sm font-medium rounded-md {{ request()->routeIs('admin.dashboard') ? 'bg-blue-800 text-white' : 'text-blue-100 hover:bg-blue-700 hover:text-white' }}">
        Dashboard
    </a>
    <a href="{{ route('admin.users.index') }}" class="group flex items-center px-2 py-2 text-sm font-medium rounded-md {{ request()->routeIs('admin.users.*') ? 'bg-blue-800 text-white' : 'text-blue-100 hover:bg-blue-700 hover:text-white' }}">
        Manage Users
    </a>
    <a href="{{ route('admin.patients.index') }}" class="group flex items-center px-2 py-2 text-sm font-medium rounded-md {{ request()->routeIs('admin.patients.*') ? 'bg-blue-800 text-white' : 'text-blue-100 hover:bg-blue-700 hover:text-white' }}">
        Manage Patients
    </a>
    <a href="{{ route('admin.doctors.index') }}" class="group flex items-center px-2 py-2 text-sm font-medium rounded-md {{ request()->routeIs('admin.doctors.*') ? 'bg-blue-800 text-white' : 'text-blue-100 hover:bg-blue-700 hover:text-white' }}">
        Manage Doctors
    </a>
    <a href="{{ route('admin.activity-logs.index') }}" class="group flex items-center px-2 py-2 text-sm font-medium rounded-md {{ request()->routeIs('admin.activity-logs.*') ? 'bg-blue-800 text-white' : 'text-blue-100 hover:bg-blue-700 hover:text-white' }}">
        Activity Logs
    </a>
    <a href="{{ route('admin.encryption-demo.index') }}" class="group flex items-center px-2 py-2 text-sm font-medium rounded-md {{ request()->routeIs('admin.encryption-demo.*') ? 'bg-blue-800 text-white' : 'text-blue-100 hover:bg-blue-700 hover:text-white' }}">
        Encryption Demo
    </a>
@elseif(Auth::user()->role === 'doctor')
    <a href="{{ route('doctor.dashboard') }}" class="group flex items-center px-2 py-2 text-sm font-medium rounded-md {{ request()->routeIs('doctor.dashboard') ? 'bg-blue-800 text-white' : 'text-blue-100 hover:bg-blue-700 hover:text-white' }}">
        Dashboard
    </a>
    <a href="{{ route('doctor.patients.index') }}" class="group flex items-center px-2 py-2 text-sm font-medium rounded-md {{ request()->routeIs('doctor.patients.*') ? 'bg-blue-800 text-white' : 'text-blue-100 hover:bg-blue-700 hover:text-white' }}">
        Patient List
    </a>
    <a href="{{ route('doctor.medical-records.index') }}" class="group flex items-center px-2 py-2 text-sm font-medium rounded-md {{ request()->routeIs('doctor.medical-records.*') ? 'bg-blue-800 text-white' : 'text-blue-100 hover:bg-blue-700 hover:text-white' }}">
        Medical Records
    </a>
@elseif(Auth::user()->role === 'patient')
    <a href="{{ route('patient.dashboard') }}" class="group flex items-center px-2 py-2 text-sm font-medium rounded-md {{ request()->routeIs('patient.dashboard') ? 'bg-blue-800 text-white' : 'text-blue-100 hover:bg-blue-700 hover:text-white' }}">
        Dashboard
    </a>
    <a href="{{ route('patient.medical-records.index') }}" class="group flex items-center px-2 py-2 text-sm font-medium rounded-md {{ request()->routeIs('patient.medical-records.*') ? 'bg-blue-800 text-white' : 'text-blue-100 hover:bg-blue-700 hover:text-white' }}">
        My Medical Records
    </a>
@endif
