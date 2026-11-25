<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Appointment extends Model
{
    public const STATUSES = [
        'scheduled',
        'completed',
        'cancelled',
    ];

    public const TYPES = [
        'Consultation',
        'Site inspection',
        'Mediation / Hearing',
        'Follow-up',
    ];

    protected $fillable = [
        'report_id',
        'created_by',
        'title',
        'appointment_type',
        'scheduled_at',
        'duration_minutes',
        'location',
        'assignee',
        'participants',
        'notes',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'scheduled_at' => 'datetime',
            'duration_minutes' => 'integer',
        ];
    }

    public function report(): BelongsTo
    {
        return $this->belongsTo(Report::class);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
