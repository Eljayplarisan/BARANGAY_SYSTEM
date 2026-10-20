<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ $type === 'blotter' ? 'Blotter Report' : 'Submit a Complaint / Concern' }} | Barangay Ward II</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
        <style>
            :root {
                color-scheme: light;
                font-family: 'Plus Jakarta Sans', 'Segoe UI', sans-serif;
                color: #123d70;
                background: #edf7ff;
            }

            * { box-sizing: border-box; }
            body { min-height: 100vh; margin: 0; padding: 7px; background: #e8f5ff; }
            button, input, select, textarea, a { font: inherit; }
            a { color: inherit; text-decoration: none; }

            .app-shell {
                min-height: calc(100vh - 14px);
                overflow: hidden;
                border: 1px solid #8bc8f3;
                border-radius: 12px;
                background: #fafdff;
                box-shadow: 0 10px 28px rgba(21, 89, 144, 0.12);
            }

            .topbar {
                min-height: 68px;
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 20px;
                padding: 10px 28px;
                background: linear-gradient(110deg, #1375cf, #07519a 68%, #064987);
                color: #fff;
            }

            .brand { display: flex; flex-direction: column; align-items: flex-start; gap: 3px; min-width: 0; }
            .brand-mark {
                font-size: 1.05rem;
                font-weight: 800;
                letter-spacing: 0.035em;
                line-height: 1.2;
                display: block;
            }
            .brand-subtitle { display: block; margin-top: 3px; color: #e4f2ff; font-size: 0.75rem; }
            .user-menu { display: flex; align-items: center; gap: 10px; color: #fff; font-size: 0.82rem; font-weight: 600; }
            .user-avatar { width: 34px; height: 34px; display: grid; place-items: center; overflow: hidden; border-radius: 50%; background: #f5fbff; color: #0755a1; }
            .user-avatar img { width: 100%; height: 100%; object-fit: cover; }
            .user-avatar svg { width: 21px; height: 21px; }

            .dashboard-layout { min-height: calc(100vh - 84px); display: grid; grid-template-columns: 250px minmax(0, 1fr); }
            .sidebar {
                padding: 24px 14px;
                border-right: 1px solid #b9ddf8;
                background: radial-gradient(ellipse at bottom left, rgba(174, 222, 255, 0.38), transparent 55%), #f6fbff;
            }
            .side-nav { display: grid; gap: 7px; }
            .nav-item {
                min-height: 44px;
                display: flex;
                align-items: center;
                gap: 15px;
                padding: 0 14px;
                border-radius: 9px;
                color: #184d84;
                font-size: 0.88rem;
                font-weight: 500;
                transition: background 0.15s ease;
            }
            .nav-item svg {
                width: 20px;
                height: 20px;
                flex: 0 0 20px;
                fill: none;
                stroke: currentColor;
                stroke-width: 1.9;
                stroke-linecap: round;
                stroke-linejoin: round;
            }
            .nav-item.active { background: #d5ebff; color: #064d93; font-weight: 800; }
            .nav-item:not(.active):hover { background: #e7f4ff; }
            .nav-item.disabled { color: #6282a2; cursor: not-allowed; }
            .logout-form { margin-top: 2px; }
            .logout-form button { width: 100%; border: 0; background: transparent; text-align: left; cursor: pointer; }

            .workspace {
                min-width: 0;
                padding: clamp(22px, 3vw, 40px);
                background: radial-gradient(ellipse at 15% 100%, rgba(197, 231, 255, 0.38), transparent 55%), linear-gradient(145deg, #fcfeff, #f4faff);
            }
            .form-card {
                max-width: 1040px;
                margin: 0 auto;
                padding: 18px;
                border: 1px solid #c6e2fa;
                border-radius: 12px;
                background: rgba(255, 255, 255, 0.6);
            }
            .page-heading { display: flex; align-items: flex-start; gap: 14px; margin-bottom: 18px; }
            .heading-icon { width: 32px; height: 32px; flex: 0 0 32px; color: #0758a6; }
            .page-heading h1 { margin: 0; color: #093f7a; font-size: 1.2rem; line-height: 1.3; font-weight: 800; }
            .page-heading p { margin: 3px 0 0; color: #35669b; font-size: 0.8rem; }
            .form-alert {
                margin-bottom: 14px;
                padding: 10px 12px;
                border: 1px solid #f0c5c5;
                border-radius: 7px;
                background: #fff3f3;
                color: #8b2525;
                font-size: 0.8rem;
            }
            .form-alert ul { margin: 0; padding-left: 18px; }
            .report-form { display: grid; gap: 14px; }
            .field-grid { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 16px 20px; }
            .field label { display: block; margin-bottom: 6px; color: #164c83; font-size: 0.76rem; font-weight: 600; }
            .required { color: #ed3657; }
            .field input, .field select, .field textarea {
                width: 100%;
                border: 1px solid #c9ddf2;
                border-radius: 8px;
                outline: none;
                background: rgba(255, 255, 255, 0.82);
                color: #194b7b;
                font-size: 0.78rem;
            }
            .field input, .field select { height: 38px; padding: 0 10px; }
            .field textarea { min-height: 72px; padding: 9px 10px; resize: vertical; line-height: 1.45; }
            .field input::placeholder, .field textarea::placeholder { color: #8ba9ca; }
            .field input:focus, .field select:focus, .field textarea:focus {
                border-color: #3986c7;
                box-shadow: 0 0 0 3px rgba(57, 134, 199, 0.12);
            }
            .full-width { grid-column: 1 / -1; }
            .field-hint { display: flex; justify-content: flex-end; margin-top: 3px; color: #6485a9; font-size: 0.68rem; }
            .upload-box {
                min-height: 64px;
                display: grid;
                place-items: center;
                padding: 8px;
                border: 1px dashed #83bcf0;
                border-radius: 8px;
                background: rgba(247, 252, 255, 0.85);
                color: #5681b1;
                text-align: center;
                font-size: 0.72rem;
                cursor: pointer;
            }
            .upload-box svg { width: 22px; height: 22px; margin-bottom: 2px; color: #0758a6; }
            .upload-box input { width: 100%; height: auto; border: 0; padding: 5px; font-size: 0.7rem; }
            .file-hint { margin-top: 3px; color: #6485a9; font-size: 0.68rem; }
            .form-actions { display: flex; justify-content: flex-end; gap: 10px; margin-top: 0; }
            .form-actions a, .form-actions button {
                min-width: 112px;
                min-height: 40px;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                padding: 0 16px;
                border-radius: 8px;
                font-size: 0.78rem;
                font-weight: 700;
                cursor: pointer;
            }
            .cancel-button { border: 1px solid #78b6ee; background: #fff; color: #16568f; }
            .submit-button { border: 1px solid #0864ad; background: linear-gradient(100deg, #0a70c5, #07559e); color: #fff; }

            @media (max-width: 760px) {
                body { padding: 0; }
                .app-shell { min-height: 100vh; border-radius: 0; }
                .dashboard-layout { min-height: calc(100vh - 68px); grid-template-columns: 1fr; }
                .sidebar { padding: 10px 12px; border-right: 0; border-bottom: 1px solid #b9ddf8; }
                .side-nav { grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 5px; }
                .nav-item { min-height: 42px; justify-content: center; gap: 7px; padding: 0 6px; font-size: 0.76rem; }
                .nav-item svg { width: 18px; height: 18px; flex-basis: 18px; }
                .logout-form { margin: 0; }
                .logout-form button { justify-content: center; }
                .workspace { padding: 18px 14px; }
            }

            @media (max-width: 540px) {
                .topbar { min-height: 62px; padding: 9px 14px; }
                .brand-mark { font-size: 0.82rem; }
                .brand-subtitle { font-size: 0.62rem; }
                .user-menu { gap: 6px; font-size: 0.72rem; }
                .user-avatar { width: 30px; height: 30px; }
                .side-nav { grid-template-columns: repeat(2, minmax(0, 1fr)); }
                .form-card { padding: 14px; }
                .field-grid { grid-template-columns: 1fr; gap: 12px; }
                .full-width { grid-column: auto; }
            }
        </style>
    </head>
    <body>
        <div class="app-shell">
            <header class="topbar">
                <a class="brand" href="{{ route('resident.dashboard') }}">
                    <span class="brand-mark">BARANGAY WARD II</span>
                    <span class="brand-subtitle">Blotter and Monitoring System</span>
                </a>
                <div class="user-menu">
                    <span class="user-avatar" aria-hidden="true">
                        @if (auth()->user()->profile_photo_path)
                            <img src="{{ asset('storage/'.auth()->user()->profile_photo_path) }}" alt="">
                        @else
                            <svg viewBox="0 0 24 24" fill="currentColor"><circle cx="12" cy="8" r="4"></circle><path d="M4 21v-2a8 8 0 0 1 16 0v2z"></path></svg>
                        @endif
                    </span>
                    <a href="{{ route('resident.profile.edit') }}">{{ auth()->user()->name }}</a>
                    <span aria-hidden="true">⌄</span>
                </div>
            </header>

            <div class="dashboard-layout">
                <aside class="sidebar">
                    <nav class="side-nav" aria-label="Resident navigation">
                        <a class="nav-item {{ request()->routeIs('resident.dashboard') ? 'active' : '' }}" href="{{ route('resident.dashboard') }}" @if (request()->routeIs('resident.dashboard')) aria-current="page" @endif>
                            <svg viewBox="0 0 24 24" aria-hidden="true"><path d="m3 11 9-8 9 8"></path><path d="M5 10v10h5v-6h4v6h5V10"></path></svg>
                            Dashboard
                        </a>
                        <a class="nav-item {{ request()->routeIs('resident.reports.create') ? 'active' : '' }}" href="{{ route('resident.reports.create') }}" @if (request()->routeIs('resident.reports.create')) aria-current="page" @endif>
                            <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M14 3H6a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><path d="M14 3v6h6M8 14h8M8 18h5"></path><path d="m7.5 9.5-1 2.5 2.5-1 6-6-1.5-1.5z"></path></svg>
                            Report
                        </a>
                        <a class="nav-item {{ request()->routeIs('resident.reports.index') ? 'active' : '' }}" href="{{ route('resident.reports.index') }}" @if (request()->routeIs('resident.reports.index')) aria-current="page" @endif>
                            <svg viewBox="0 0 24 24" aria-hidden="true"><rect x="5" y="4" width="14" height="17" rx="2"></rect><path d="M9 4V2h6v2M8 9h8M8 13h8M8 17h5"></path></svg>
                            My Reports
                        </a>
                        <span class="nav-item disabled" aria-disabled="true">
                            <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M18 8a6 6 0 0 0-12 0c0 7-3 7-3 9h18c0-2-3-2-3-9M10 21h4"></path></svg>
                            Notifications
                        </span>
                        <a class="nav-item" href="{{ route('resident.profile.edit') }}">
                            <svg viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="8" r="4"></circle><path d="M4 21v-2a8 8 0 0 1 16 0v2z"></path></svg>
                            Profile
                        </a>
                        <form class="logout-form" method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="nav-item" type="submit">
                                <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M10 17l5-5-5-5M15 12H3"></path><path d="M12 3h6a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-6"></path></svg>
                                Log Out
                            </button>
                        </form>
                    </nav>
                </aside>

                <main class="workspace">
                    <section class="form-card">
                        <div class="page-heading">
                            <svg class="heading-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M14 3H6a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><path d="M14 3v6h6M8 13h8M8 17h8"></path></svg>
                            <div>
                                <h1>{{ $type === 'blotter' ? 'Submit a Blotter Report' : 'Submit a Complaint / Concern' }}</h1>
                                <p>Provide the details of your {{ $type === 'blotter' ? 'report' : 'complaint or concern' }}.</p>
                            </div>
                        </div>

                        @if ($errors->any())
                            <div class="form-alert" role="alert">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form class="report-form" method="POST" action="{{ route('resident.reports.store') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="type" value="{{ $type }}">
                            <div class="field-grid">
                                <div class="field">
                                    <label for="category">Category <span class="required">*</span></label>
                                    <select id="category" name="category" required>
                                        <option value="">Select category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category }}" @selected(old('category') === $category)>{{ $category }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="field">
                                    <label for="occurred_at">Date and Time <span class="required">*</span></label>
                                    <input id="occurred_at" name="occurred_at" type="datetime-local" value="{{ old('occurred_at') }}" required>
                                </div>

                                <div class="field full-width">
                                    <label for="location">Location <span class="required">*</span></label>
                                    <input id="location" name="location" type="text" value="{{ old('location') }}" placeholder="e.g. Purok, Sitio, Street" maxlength="255" required>
                                </div>

                                <div class="field full-width">
                                    <label for="description">Description <span class="required">*</span></label>
                                    <textarea id="description" name="description" maxlength="500" placeholder="Describe what happened or explain your concern..." required>{{ old('description') }}</textarea>
                                    <span class="field-hint"><span id="description-count">0</span>/500</span>
                                </div>

                                <div class="field full-width">
                                    <label for="attachment">Attach Photo / Document (optional)</label>
                                    <label class="upload-box" for="attachment">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 16V4m0 0L8 8m4-4 4 4"></path><path d="M20 16v3a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2v-3"></path></svg>
                                        <span id="file-label">Click to upload or drag and drop (Images, PDF, etc.)</span>
                                        <input id="attachment" name="attachment" type="file" accept=".jpg,.jpeg,.png,.pdf">
                                    </label>
                                    <span class="file-hint">Accepted: JPG, PNG, or PDF. Maximum size: 10 MB.</span>
                                </div>
                            </div>

                            <div class="form-actions">
                                <a class="cancel-button" href="{{ route('resident.dashboard') }}">Cancel</a>
                                <button class="submit-button" type="submit">Submit Report</button>
                            </div>
                        </form>
                    </section>
                </main>
            </div>
        </div>
        <script>
            const description = document.getElementById('description');
            const descriptionCount = document.getElementById('description-count');
            const attachment = document.getElementById('attachment');
            const fileLabel = document.getElementById('file-label');

            description.addEventListener('input', () => {
                descriptionCount.textContent = String(description.value.length);
            });
            descriptionCount.textContent = String(description.value.length);

            attachment.addEventListener('change', () => {
                fileLabel.textContent = attachment.files.length
                    ? attachment.files[0].name
                    : 'Click to upload or drag and drop (Images, PDF, etc.)';
            });
        </script>
    </body>
</html>
