<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\OtpController;
use App\Http\Controllers\Auth\RegisteredUserController;


Route::get('/', function () {
    return view('welcome');
});
Route::middleware('guest')->group(function () {
    Route::get('/verify-otp', [OtpController::class, 'show'])->name('otp.verify');
    Route::post('/verify-otp', [OtpController::class, 'verify'])->name('otp.verify.submit');
    Route::post('/resend-otp', [OtpController::class, 'resend'])->name('otp.resend');
});

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('register', [RegisteredUserController::class, 'store']);
});
Route::get('/dashboard', \App\Http\Controllers\DashboardController::class)->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Admin Routes
    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
        Route::resource('users', \App\Http\Controllers\Admin\UserController::class);
        Route::resource('doctors', \App\Http\Controllers\Admin\DoctorController::class);
        Route::resource('patients', \App\Http\Controllers\Admin\PatientController::class);
        Route::get('activity-logs', [\App\Http\Controllers\Admin\ActivityLogController::class, 'index'])->name('activity-logs.index');
        Route::get('encryption-demo', [\App\Http\Controllers\Admin\EncryptionDemoController::class, 'index'])->name('encryption-demo.index');
        Route::post('encryption-demo', [\App\Http\Controllers\Admin\EncryptionDemoController::class, 'process'])->name('encryption-demo.process');
    });

    // Doctor Routes
    Route::middleware('role:doctor')->prefix('doctor')->name('doctor.')->group(function () {
        Route::get('/dashboard', [\App\Http\Controllers\Doctor\DashboardController::class, 'index'])->name('dashboard');
        Route::put('/dashboard/profile', [\App\Http\Controllers\Doctor\DashboardController::class, 'updateProfile'])->name('profile.update');
        Route::get('patients', [\App\Http\Controllers\Doctor\PatientController::class, 'index'])->name('patients.index');
        Route::resource('medical-records', \App\Http\Controllers\Doctor\MedicalRecordController::class);
        Route::get('medical-records/{medical_record}/pdf', [\App\Http\Controllers\Doctor\MedicalRecordController::class, 'exportPdf'])->name('medical-records.pdf');
    });

    // Patient Routes
    Route::middleware('role:patient')->prefix('patient')->name('patient.')->group(function () {
        Route::get('/dashboard', [\App\Http\Controllers\Patient\DashboardController::class, 'index'])->name('dashboard');
        Route::post('/dashboard/profile', [\App\Http\Controllers\Patient\DashboardController::class, 'storeProfile'])->name('profile.store');
        Route::put('/dashboard/profile', [\App\Http\Controllers\Patient\DashboardController::class, 'updateProfile'])->name('profile.update');
        Route::get('medical-records', [\App\Http\Controllers\Patient\MedicalRecordController::class, 'index'])->name('medical-records.index');
        Route::get('medical-records/{medical_record}', [\App\Http\Controllers\Patient\MedicalRecordController::class, 'show'])->name('medical-records.show');
        Route::get('medical-records/{medical_record}/pdf', [\App\Http\Controllers\Patient\MedicalRecordController::class, 'exportPdf'])->name('medical-records.pdf');
    });
});

require __DIR__.'/auth.php';
