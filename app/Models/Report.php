<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Report extends Model
{
    /**
     * Ordered report lifecycle statuses.
     *
     * @var list<string>
     */
    public const STATUSES = [
        'submitted',
        'received',
        'referred',
        'ongoing',
        'resolved',
        'closed',
    ];

    /**
     * Active report statuses before resolution.
     *
     * @var list<string>
     */
    public const ACTIVE_STATUSES = [
        'submitted',
        'received',
        'referred',
        'ongoing',
    ];

    protected $fillable = [
        'user_id',
        'type',
        'category',
        'occurred_at',
        'location',
        'description',
        'attachment_path',
        'status',
        'assigned_to',
        'blotter_entry_code',
        'blotter_recorded_by',
        'blotter_recorded_at',
        'resident_message',
        'secretary_notes',
        'status_history',
        'internal_notes',
    ];

    protected function casts(): array
    {
        return [
            'occurred_at' => 'datetime',
            'blotter_recorded_at' => 'datetime',
            'status_history' => 'array',
            'internal_notes' => 'array',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }

    public function referenceCode(): string
    {
        return 'CR-'.str_pad((string) $this->id, 4, '0', STR_PAD_LEFT);
    }

    public function blotterEntryCode(): string
    {
        if (filled($this->blotter_entry_code)) {
            return (string) $this->blotter_entry_code;
        }

        return 'BR-'.$this->created_at->format('Y').'-'.str_pad((string) $this->id, 3, '0', STR_PAD_LEFT);
    }

    public function submissionTypeLabel(): string
    {
        return $this->type === 'blotter' ? 'Blotter Report' : 'Maintenance Report';
    }
}
