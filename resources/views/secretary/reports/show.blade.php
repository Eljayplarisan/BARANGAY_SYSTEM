@extends('secretary.layout')

@section('title', $report->referenceCode().' · Report Review')

@push('styles')
    .back-bar {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        margin-bottom: 12px;
        font-size: 0.82rem;
        font-weight: 700;
        color: #1a6bc0;
    }

    .back-bar:hover {
        text-decoration: underline;
    }

    .summary-banner {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: space-between;
        gap: 14px;
        margin-bottom: 16px;
        padding: 16px 20px;
        border: 1px solid #cce2f8;
        border-radius: 12px;
        background: #e8f3fe;
    }

    .summary-meta-grid {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 14px 28px;
    }

    .summary-item-label {
        display: block;
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: #5d748c;
    }

    .summary-item-value {
        display: block;
        margin-top: 2px;
        font-size: 0.88rem;
        font-weight: 800;
        color: #0f2942;
    }

    .timeline-card {
        margin-bottom: 16px;
    }

    .timeline-strip {
        display: grid;
        grid-template-columns: repeat(6, minmax(0, 1fr));
        gap: 12px;
    }

    .timeline-col-bar {
        height: 4px;
        border-radius: 999px;
        background: #e7eff7;
        margin-bottom: 8px;
    }

    .timeline-col.reached .timeline-col-bar {
        background: #1660ad;
    }

    .timeline-col-label {
        font-size: 0.78rem;
        font-weight: 700;
        color: #8296aa;
    }

    .timeline-col.reached .timeline-col-label {
        color: #0d5aa7;
    }

    .timeline-col-date {
        margin-top: 3px;
        font-size: 0.72rem;
        color: #7c92a8;
    }

    .review-grid {
        display: grid;
        grid-template-columns: minmax(0, 1.48fr) minmax(0, 1fr);
        gap: 16px;
        align-items: start;
    }

    .review-col {
        display: grid;
        gap: 16px;
    }

    .readonly-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 16px 20px;
        padding-top: 14px;
        border-top: 1px solid #edf3f8;
        margin-bottom: 16px;
    }

    .ro-label {
        display: block;
        font-size: 0.74rem;
        color: #6c8299;
        margin-bottom: 4px;
    }

    .ro-value {
        font-size: 0.86rem;
        font-weight: 700;
        color: #0f2942;
        line-height: 1.4;
    }

    .ro-description {
        margin: 0 0 16px;
        font-size: 0.86rem;
        color: #213c57;
        line-height: 1.55;
    }

    .attachment-bar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        padding: 11px 14px;
        border: 1px solid #e4edf6;
        border-radius: 9px;
        background: #f5f9fd;
        font-size: 0.8rem;
    }

    .attachment-bar-label {
        color: #647b93;
    }

    .attachment-bar-value {
        font-weight: 700;
        color: #0f2942;
    }

    .notes-list {
        display: grid;
        gap: 10px;
        padding-top: 14px;
        border-top: 1px solid #edf3f8;
        margin-bottom: 14px;
    }

    .note-entry {
        font-size: 0.82rem;
        line-height: 1.5;
        color: #294661;
    }

    .note-entry strong {
        color: #0f2942;
    }

    .note-empty {
        padding-top: 14px;
        border-top: 1px solid #edf3f8;
        margin-bottom: 14px;
        font-size: 0.8rem;
        color: #7c92a8;
    }

    .note-actions {
        display: flex;
        justify-content: flex-end;
        margin-top: 10px;
    }

    .publish-form {
        display: grid;
        gap: 14px;
        padding-top: 14px;
        border-top: 1px solid #edf3f8;
    }

    .field-help {
        margin: 0;
        font-size: 0.74rem;
        color: #6c8299;
        line-height: 1.45;
    }

    .preview-box {
        display: none;
        padding: 14px;
        border: 1px solid #bcd9f6;
        border-radius: 10px;
        background: #f1f8ff;
    }

    .preview-box.is-visible {
        display: block;
    }

    .preview-box-title {
        margin: 0 0 8px;
        font-size: 0.78rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: #0d5aa7;
    }

    .preview-box-row {
        margin: 0 0 6px;
        font-size: 0.82rem;
        color: #0f2942;
    }

    .preview-box-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-top: 12px;
    }

    .linked-actions-list {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        gap: 10px;
        padding-top: 14px;
        border-top: 1px solid #edf3f8;
        margin-bottom: 12px;
    }

    .linked-btn {
        display: inline-flex;
        align-items: center;
        gap: 9px;
        min-height: 38px;
        padding: 0 14px;
        border: 1px solid #d4e3f2;
        border-radius: 8px;
        background: #ffffff;
        color: #0d5aa7;
        font-size: 0.82rem;
        font-weight: 700;
    }

    .linked-btn:hover {
        background: #f2f8ff;
        border-color: #9ec3e6;
    }

    .linked-btn svg {
        width: 16px;
        height: 16px;
        fill: none;
        stroke: currentColor;
        stroke-width: 1.9;
        stroke-linecap: round;
        stroke-linejoin: round;
    }

    .receipt-callout {
        display: flex;
        align-items: flex-start;
        gap: 11px;
        padding: 15px 16px;
        border: 1px solid #cce2f8;
        border-radius: 12px;
        background: #e8f3fe;
    }

    .receipt-callout svg {
        width: 19px;
        height: 19px;
        flex: 0 0 19px;
        margin-top: 1px;
        color: #1660ad;
    }

    .receipt-title {
        margin: 0 0 4px;
        font-size: 0.84rem;
        font-weight: 800;
        color: #0f2942;
    }

    .receipt-copy {
        margin: 0;
        font-size: 0.78rem;
        line-height: 1.5;
        color: #466584;
    }

    .quick-receive-form {
        margin-top: 10px;
    }

    @media (max-width: 960px) {
        .review-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 640px) {
        .timeline-strip {
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 14px 12px;
        }

        .readonly-grid {
            grid-template-columns: 1fr;
        }

        .attachment-bar {
            flex-direction: column;
            align-items: flex-start;
        }
    }
@endpush

@section('content')
    <a class="back-bar" href="{{ route('secretary.reports.incoming') }}">&larr; Back to Incoming Reports</a>

    <section class="summary-banner" aria-label="Report summary">
        <div class="summary-meta-grid">
            <div>
                <span class="summary-item-label">Report Reference</span>
                <span class="summary-item-value">{{ $report->referenceCode() }} &middot; {{ $report->category }}</span>
            </div>
            <div>
                <span class="summary-item-label">Resident</span>
                <span class="summary-item-value">R-{{ str_pad((string) ($report->user?->id ?? 0), 3, '0', STR_PAD_LEFT) }} &middot; {{ $report->user?->name ?? 'Resident' }}</span>
            </div>
            <div>
                <span class="summary-item-label">Assigned Official</span>
                <span class="summary-item-value">{{ $report->assigned_to ?: 'Unassigned' }}</span>
            </div>
            <div>
                <span class="summary-item-label">Formal Entry</span>
                <span class="summary-item-value">{{ $formalCode }}</span>
            </div>
        </div>
        <span class="status-pill status-{{ strtolower($report->status) }}">{{ ucfirst($report->status) }}</span>
    </section>

    <section class="card timeline-card" aria-label="Resident-visible timeline">
        <div class="card-header">
            <h1 class="card-title">Resident-visible timeline</h1>
            <span class="card-meta">Same status history in resident tracking</span>
        </div>

        <div class="timeline-strip">
            @foreach ($timeline as $step)
                <div class="timeline-col {{ $step['reached'] ? 'reached' : '' }}">
                    <div class="timeline-col-bar" aria-hidden="true"></div>
                    <div class="timeline-col-label">{{ $step['label'] }}</div>
                    <div class="timeline-col-date">{{ $step['date'] }}</div>
                </div>
            @endforeach
        </div>
    </section>

    <div class="review-grid">
        <div class="review-col">
            <article class="card">
                <div class="card-header">
                    <h2 class="card-title">Original report</h2>
                    <span class="card-meta">Resident-submitted &middot; read only</span>
                </div>

                <div class="readonly-grid">
                    <div>
                        <span class="ro-label">Submission type</span>
                        <span class="ro-value">{{ $report->submissionTypeLabel() }}</span>
                    </div>
                    <div>
                        <span class="ro-label">Category / type of incident</span>
                        <span class="ro-value">{{ $report->category }}</span>
                    </div>
                    <div>
                        <span class="ro-label">Date/time of incident</span>
                        <span class="ro-value">{{ $report->occurred_at ? $report->occurred_at->format('M j, Y · g:i A') : 'Not provided' }}</span>
                    </div>
                    <div>
                        <span class="ro-label">Location</span>
                        <span class="ro-value">{{ $report->location }}</span>
                    </div>
                    <div>
                        <span class="ro-label">Resident contact</span>
                        <span class="ro-value">{{ $report->user?->phone ?: ($report->user?->email ?? 'Not provided') }}</span>
                    </div>
                    <div>
                        <span class="ro-label">Resident address</span>
                        <span class="ro-value">{{ $report->user?->address ?: 'Not provided' }}</span>
                    </div>
                </div>

                <span class="ro-label">Description</span>
                <p class="ro-description">{{ $report->description }}</p>

                <div class="attachment-bar">
                    <span class="attachment-bar-label">Photo / document attachment &middot; Optional</span>
                    @if ($report->attachment_path)
                        <a class="action-link" href="{{ route('secretary.reports.attachment', $report) }}" target="_blank" rel="noopener">View attachment &rarr;</a>
                    @else
                        <span class="attachment-bar-value">None provided</span>
                    @endif
                </div>
            </article>

            <article class="card">
                <div class="card-header">
                    <h2 class="card-title">Internal secretary notes</h2>
                    <span class="card-meta">Staff only &middot; not in resident tracking</span>
                </div>

                @if (count($internalNotes) > 0)
                    <div class="notes-list">
                        @foreach ($internalNotes as $entry)
                            <div class="note-entry">
                                <strong>{{ \Carbon\Carbon::parse($entry['created_at'])->format('M j') }} &middot; {{ $entry['author'] }}</strong>
                                &mdash; {{ $entry['note'] }}
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="note-empty">No internal staff notes added yet.</div>
                @endif

                <form method="POST" action="{{ route('secretary.reports.notes.store', $report) }}">
                    @csrf
                    <div class="form-field">
                        <label for="internal-note">Add internal note</label>
                        <textarea id="internal-note" class="form-control" name="note" maxlength="1000" placeholder="Enter a note for authorized staff only..." required>{{ old('note') }}</textarea>
                    </div>
                    <div class="note-actions">
                        <button class="btn-secondary" type="submit">Save internal note</button>
                    </div>
                </form>
            </article>
        </div>

        <div class="review-col">
            <article class="card">
                <div class="card-header">
                    <h2 class="card-title">Publish a resident update</h2>
                    <span class="card-meta" id="publish-mode-label">Draft</span>
                </div>

                <form id="publish-update-form" class="publish-form" method="POST" action="{{ route('secretary.reports.status', $report) }}">
                    @csrf
                    @method('PATCH')

                    <div class="form-field">
                        <label for="status">Status</label>
                        <select id="status" class="form-control" name="status" required>
                            @foreach ($statuses as $statusOption)
                                <option value="{{ $statusOption }}" @selected(old('status', $report->status) === $statusOption)>
                                    {{ ucfirst($statusOption) }}
                                </option>
                            @endforeach
                        </select>
                        <p class="field-help">Change to Resolved only when work is complete.</p>
                    </div>

                    <div class="form-field">
                        <label for="assigned_to">Assigned official / team (optional)</label>
                        <input id="assigned_to" class="form-control" type="text" name="assigned_to" value="{{ old('assigned_to', $report->assigned_to) }}" placeholder="e.g. Councilor Elena Reyes or Maintenance team" maxlength="255">
                    </div>

                    <div class="form-field">
                        <label for="resident_message">Resident-visible message</label>
                        <textarea id="resident_message" class="form-control" name="resident_message" maxlength="1000" placeholder="e.g. A consultation is scheduled for tomorrow at 9:00 AM at the barangay hall.">{{ old('resident_message', $report->resident_message) }}</textarea>
                        <p class="field-help">This message will appear on {{ $report->referenceCode() }} in the resident's tracking timeline. Internal notes stay private.</p>
                    </div>

                    <div id="preview-box" class="preview-box" aria-live="polite">
                        <p class="preview-box-title">Preview resident-visible update</p>
                        <p class="preview-box-row"><strong>New status:</strong> <span id="preview-status"></span></p>
                        <p class="preview-box-row"><strong>Message:</strong> <span id="preview-message"></span></p>
                        <div class="preview-box-actions">
                            <button class="btn-primary" type="submit">Confirm &amp; publish update</button>
                            <button class="btn-secondary" type="button" id="cancel-preview-btn">Edit draft</button>
                        </div>
                    </div>

                    <div id="preview-trigger-wrap">
                        <button class="btn-primary" type="button" id="preview-update-btn">Preview update</button>
                    </div>
                </form>
            </article>

            <article class="card">
                <div class="card-header">
                    <h2 class="card-title">Linked actions</h2>
                </div>

                <div class="linked-actions-list">
                    <a class="linked-btn" href="{{ route('secretary.cases.index') }}">
                        <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"></path></svg>
                        <span>Open Case Management</span>
                    </a>
                    <a class="linked-btn" href="{{ route('secretary.appointments.index', ['report' => $report->id]) }}">
                        <svg viewBox="0 0 24 24" aria-hidden="true"><rect x="3" y="4" width="18" height="18" rx="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                        <span>{{ $report->appointments->isNotEmpty() ? 'View appointment' : 'Schedule appointment' }}</span>
                    </a>
                </div>

                <p class="field-help">Referral is optional. Assignment, schedules and the formal entry stay linked to {{ $report->referenceCode() }}.</p>
            </article>

            <aside class="receipt-callout" role="note">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="12" y1="16" x2="12" y2="12"></line>
                    <line x1="12" y1="8" x2="12.01" y2="8"></line>
                </svg>
                <div>
                    @if ($report->status === 'submitted')
                        <p class="receipt-title">Awaiting receipt</p>
                        <p class="receipt-copy">Verify the resident's original details, then mark this report as Received to confirm receipt on the resident timeline.</p>
                        <form class="quick-receive-form" method="POST" action="{{ route('secretary.reports.status', $report) }}">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="status" value="received">
                            <button class="btn-primary" type="submit">Mark as Received</button>
                        </form>
                    @else
                        <p class="receipt-title">Already received on {{ $receivedAt }}</p>
                        <p class="receipt-copy">The receive action is only available for Submitted reports. See the <a class="action-link" href="{{ route('secretary.reports.incoming') }}">intake queue</a> for new submissions.</p>
                    @endif
                </div>
            </aside>
        </div>
    </div>

    <script>
        const previewBtn = document.getElementById('preview-update-btn');
        const cancelPreviewBtn = document.getElementById('cancel-preview-btn');
        const previewTriggerWrap = document.getElementById('preview-trigger-wrap');
        const previewBox = document.getElementById('preview-box');
        const statusSelect = document.getElementById('status');
        const messageInput = document.getElementById('resident_message');
        const previewStatus = document.getElementById('preview-status');
        const previewMessage = document.getElementById('preview-message');
        const publishModeLabel = document.getElementById('publish-mode-label');

        if (previewBtn && previewBox) {
            previewBtn.addEventListener('click', () => {
                const selectedOption = statusSelect.options[statusSelect.selectedIndex];
                previewStatus.textContent = selectedOption ? selectedOption.textContent.trim() : statusSelect.value;
                previewMessage.textContent = messageInput.value.trim() || 'No extra message (status update only).';
                previewBox.classList.add('is-visible');
                previewTriggerWrap.style.display = 'none';
                if (publishModeLabel) publishModeLabel.textContent = 'Ready to publish';
            });
        }

        if (cancelPreviewBtn && previewBox) {
            cancelPreviewBtn.addEventListener('click', () => {
                previewBox.classList.remove('is-visible');
                previewTriggerWrap.style.display = '';
                if (publishModeLabel) publishModeLabel.textContent = 'Draft';
            });
        }
    </script>
@endsection
