<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('reports', function (Blueprint $table) {
            $table->string('assigned_to')->nullable()->after('status');
            $table->string('blotter_entry_code')->nullable()->after('assigned_to');
            $table->string('blotter_recorded_by')->nullable()->after('blotter_entry_code');
            $table->timestamp('blotter_recorded_at')->nullable()->after('blotter_recorded_by');
            $table->text('resident_message')->nullable()->after('blotter_recorded_at');
            $table->text('secretary_notes')->nullable()->after('resident_message');
            $table->json('status_history')->nullable()->after('secretary_notes');
            $table->json('internal_notes')->nullable()->after('status_history');
        });
    }

    public function down(): void
    {
        Schema::table('reports', function (Blueprint $table) {
            $table->dropColumn([
                'assigned_to',
                'blotter_entry_code',
                'blotter_recorded_by',
                'blotter_recorded_at',
                'resident_message',
                'secretary_notes',
                'status_history',
                'internal_notes',
            ]);
        });
    }
};
