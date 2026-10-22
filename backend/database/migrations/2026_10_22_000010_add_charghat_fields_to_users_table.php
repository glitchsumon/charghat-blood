<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone')->nullable()->after('name');
            $table->date('date_of_birth')->nullable()->after('email');
            $table->foreignId('blood_group_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('upazila_id')->nullable()->constrained()->nullOnDelete();
            $table->string('preferred_language', 5)->default('en');
            $table->string('role')->default('user');
            $table->boolean('is_active')->default(true);
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropConstrainedForeignId('blood_group_id');
            $table->dropConstrainedForeignId('upazila_id');
            $table->dropColumn(['phone', 'date_of_birth', 'preferred_language', 'role', 'is_active']);
        });
    }
};
