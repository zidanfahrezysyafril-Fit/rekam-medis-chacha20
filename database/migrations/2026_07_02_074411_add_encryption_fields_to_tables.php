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
        Schema::table('users', function (Blueprint $table) {
            $table->string('email_hash')->nullable()->unique()->after('email');
            $table->dropUnique(['email']);
            $table->text('email')->change();
            $table->json('nonce')->nullable()->after('remember_token');
        });

        Schema::table('patients', function (Blueprint $table) {
            $table->text('address')->change();
            $table->text('phone_number')->change();
            $table->text('blood_type')->nullable()->change();
            $table->text('date_of_birth')->change();
            $table->json('nonce')->nullable()->after('blood_type');
        });

        Schema::table('doctors', function (Blueprint $table) {
            // Drop unique constraint on sip_number if it exists
            $table->dropUnique(['sip_number']);
            $table->text('doctor_name')->change();
            $table->text('sip_number')->change();
            $table->text('specialization')->change();
            $table->text('phone_number')->change();
            $table->json('nonce')->nullable()->after('phone_number');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['email_hash', 'nonce']);
            $table->string('email')->change();
        });

        Schema::table('patients', function (Blueprint $table) {
            $table->dropColumn('nonce');
            $table->string('phone_number')->change();
            $table->string('blood_type', 5)->nullable()->change();
            $table->date('date_of_birth')->change();
        });

        Schema::table('doctors', function (Blueprint $table) {
            $table->dropColumn('nonce');
            $table->string('doctor_name')->change();
            $table->string('sip_number')->unique()->change();
            $table->string('specialization')->change();
            $table->string('phone_number')->change();
        });
    }
};
