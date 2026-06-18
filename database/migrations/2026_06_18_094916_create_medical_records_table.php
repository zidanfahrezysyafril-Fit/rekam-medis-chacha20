<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('medical_records', function (Blueprint $table) {
            $table->id();
            $table->string('medical_record_number')->unique();
            $table->foreignId('patient_id')->constrained()->cascadeOnDelete();
            $table->foreignId('doctor_id')->constrained()->cascadeOnDelete();
            $table->date('examination_date');
            $table->text('complaint')->nullable(); // encrypted
            $table->text('medical_history')->nullable(); // encrypted
            $table->text('diagnosis')->nullable(); // encrypted
            $table->text('treatment')->nullable(); // encrypted
            $table->text('prescription')->nullable(); // encrypted
            $table->text('doctor_notes')->nullable(); // encrypted
            $table->text('nonce')->nullable(); // JSON containing nonces for encrypted fields
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medical_records');
    }
};
