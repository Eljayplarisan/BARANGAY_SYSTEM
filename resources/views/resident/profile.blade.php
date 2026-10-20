<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Profile | Barangay Ward II</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
        <style>
            * { box-sizing: border-box; }
            body { min-height: 100vh; margin: 0; padding: 7px; background: #e8f5ff; color: #123d70; font-family: 'Plus Jakarta Sans', 'Segoe UI', sans-serif; }
            a, button, input { font: inherit; }
            a { color: inherit; text-decoration: none; }
            .app-shell { min-height: calc(100vh - 14px); overflow: hidden; border: 1px solid #8bc8f3; border-radius: 12px; background: #fafdff; }
            .topbar { min-height: 68px; display: flex; align-items: center; justify-content: space-between; gap: 20px; padding: 10px 28px; background: linear-gradient(110deg, #1375cf, #07519a 68%, #064987); color: #fff; }
            .brand { display: flex; flex-direction: column; align-items: flex-start; gap: 3px; }
            .brand-mark { display: block; font-size: 1.05rem; font-weight: 800; letter-spacing: 0.035em; }
            .brand-subtitle { display: block; margin-top: 3px; color: #e4f2ff; font-size: 0.75rem; }
            .user-menu { display: flex; align-items: center; gap: 9px; color: white; font-size: 0.82rem; }
            .user-avatar { width: 34px; height: 34px; display: grid; place-items: center; overflow: hidden; border-radius: 50%; background: white; color: #0755a1; }
            .user-avatar img { width: 100%; height: 100%; object-fit: cover; }
            .user-avatar svg { width: 21px; height: 21px; }
            .layout { min-height: calc(100vh - 84px); display: grid; grid-template-columns: 220px minmax(0, 1fr); }
            .sidebar { padding: 24px 12px; border-right: 1px solid #b9ddf8; background: #f6fbff; }
            .side-nav { display: grid; gap: 7px; }
            .nav-item { min-height: 42px; display: flex; align-items: center; gap: 13px; padding: 0 12px; border-radius: 9px; color: #184d84; font-size: 0.82rem; }
            .nav-item svg { width: 19px; height: 19px; flex: 0 0 19px; fill: none; stroke: currentColor; stroke-width: 1.9; stroke-linecap: round; stroke-linejoin: round; }
            .nav-item.active { background: #d5ebff; color: #064d93; font-weight: 800; }
            .logout-form { margin-top: 2px; }
            .logout-form button { width: 100%; border: 0; background: none; text-align: left; cursor: pointer; }
            .workspace { padding: clamp(22px, 4vw, 48px); background: linear-gradient(145deg, #fcfeff, #f4faff); }
            .page-heading { margin-bottom: 20px; }
            h1 { margin: 0; color: #093f7a; font-size: 1.45rem; }
            .page-heading p { margin: 5px 0 0; color: #527698; font-size: 0.86rem; }
            .profile-card { max-width: 680px; padding: 24px; border: 1px solid #c6e2fa; border-radius: 12px; background: rgba(255,255,255,.7); }
            .message { margin-bottom: 16px; padding: 11px 13px; border: 1px solid #b8dfc2; border-radius: 7px; background: #effaf1; color: #24613a; font-size: 0.82rem; }
            .error { margin-top: 6px; color: #a32626; font-size: 0.76rem; }
            .photo-picker { display: flex; align-items: center; gap: 20px; margin-bottom: 22px; }
            .photo-preview { width: 100px; height: 100px; display: grid; flex: 0 0 100px; place-items: center; overflow: hidden; border: 2px solid #c2e1fa; border-radius: 50%; background: #e9f5ff; color: #2472b5; }
            .photo-preview img { width: 100%; height: 100%; object-fit: cover; }
            .photo-preview svg { width: 45px; height: 45px; }
            .field label { display: block; margin-bottom: 7px; color: #345c80; font-size: 0.82rem; font-weight: 700; }
            .field input[type="text"] { width: 100%; height: 44px; padding: 0 12px; border: 1px solid #d7e1eb; border-radius: 7px; font: inherit; }
            .field input[type="file"] { max-width: 100%; color: #527698; font-size: 0.78rem; }
            .hint { margin-top: 7px; color: #6c849d; font-size: 0.75rem; }
            .actions { display: flex; justify-content: flex-end; margin-top: 24px; }
            .save-button { min-height: 42px; padding: 0 20px; border: 0; border-radius: 7px; background: linear-gradient(180deg, #1877d1, #0756a8); color: #fff; font-weight: 800; cursor: pointer; }
            @media (max-width: 700px) {
                body { padding: 0; }
                .app-shell { min-height: 100vh; border-radius: 0; }
                .layout { min-height: calc(100vh - 68px); grid-template-columns: 1fr; }
                .sidebar { padding: 9px 10px; border-right: 0; border-bottom: 1px solid #b9ddf8; }
                .side-nav { grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 4px; }
                .nav-item { min-height: 39px; justify-content: center; gap: 6px; padding: 0 5px; font-size: 0.72rem; }
                .logout-form { margin: 0; }
                .logout-form button { justify-content: center; }
            }
            @media (max-width: 520px) {
                .topbar { min-height: 62px; padding: 8px 12px; }
                .brand-mark { font-size: 0.8rem; }
                .brand-subtitle { font-size: 0.6rem; }
                .side-nav { grid-template-columns: repeat(2, minmax(0, 1fr)); }
                .workspace { padding: 20px 14px; }
                .profile-card { padding: 18px; }
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
                <a class="user-menu" href="{{ route('resident.profile.edit') }}">
                    <span class="user-avatar">
                        @if ($user->profile_photo_path)
                            <img src="{{ asset('storage/'.$user->profile_photo_path) }}" alt="">
                        @else
                            <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><circle cx="12" cy="8" r="4"></circle><path d="M4 21v-2a8 8 0 0 1 16 0v2z"></path></svg>
                        @endif
                    </span>
                    <span>{{ $user->name }}</span>
                    <span aria-hidden="true">⌄</span>
                </a>
            </header>
            <div class="layout">
                <aside class="sidebar">
                    <nav class="side-nav" aria-label="Resident navigation">
                        <a class="nav-item" href="{{ route('resident.dashboard') }}"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="m3 11 9-8 9 8"></path><path d="M5 10v10h5v-6h4v6h5V10"></path></svg>Dashboard</a>
                        <a class="nav-item" href="{{ route('resident.reports.create') }}"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M14 3H6a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><path d="M14 3v6h6M8 14h8M8 18h5"></path></svg>Report</a>
                        <a class="nav-item" href="{{ route('resident.reports.index') }}"><svg viewBox="0 0 24 24" aria-hidden="true"><rect x="5" y="4" width="14" height="17" rx="2"></rect><path d="M9 4V2h6v2M8 9h8M8 13h8M8 17h5"></path></svg>My Reports</a>
                        <span class="nav-item" aria-disabled="true"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M18 8a6 6 0 0 0-12 0c0 7-3 7-3 9h18c0-2-3-2-3-9M10 21h4"></path></svg>Notifications</span>
                        <a class="nav-item active" href="{{ route('resident.profile.edit') }}" aria-current="page"><svg viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="8" r="4"></circle><path d="M4 21v-2a8 8 0 0 1 16 0v2z"></path></svg>Profile</a>
                        <form class="logout-form" method="POST" action="{{ route('logout') }}">@csrf<button class="nav-item" type="submit"><svg viewBox="0 0 24 24" aria-hidden="true"><path d="M10 17l5-5-5-5M15 12H3"></path><path d="M12 3h6a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-6"></path></svg>Log Out</button></form>
                    </nav>
                </aside>
                <main class="workspace">
                    <div class="page-heading">
                        <h1>Profile</h1>
                        <p>Update your resident profile and picture.</p>
                    </div>
                    <section class="profile-card">
                        @if (session('status'))
                            <div class="message" role="status">{{ session('status') }}</div>
                        @endif
                        @if ($errors->any())
                            <div class="message" role="alert" style="border-color:#f0c5c5;background:#fff3f3;color:#8b2525">{{ $errors->first() }}</div>
                        @endif
                        <form method="POST" action="{{ route('resident.profile.update') }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="photo-picker">
                                <span class="photo-preview" id="photo-preview">
                                    @if ($user->profile_photo_path)
                                        <img src="{{ asset('storage/'.$user->profile_photo_path) }}" alt="Current profile picture">
                                    @else
                                        <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><circle cx="12" cy="8" r="4"></circle><path d="M4 21v-2a8 8 0 0 1 16 0v2z"></path></svg>
                                    @endif
                                </span>
                                <div class="field">
                                    <label for="profile_photo">Profile Picture</label>
                                    <input id="profile_photo" name="profile_photo" type="file" accept="image/jpeg,image/png,image/webp">
                                    <div class="hint">JPG, PNG, or WebP. Maximum size: 5 MB.</div>
                                    @error('profile_photo')<div class="error">{{ $message }}</div>@enderror
                                </div>
                            </div>
                            <div class="field">
                                <label for="name">Full Name</label>
                                <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" maxlength="255" required>
                                @error('name')<div class="error">{{ $message }}</div>@enderror
                            </div>
                            <div class="actions">
                                <button class="save-button" type="submit">Save Profile</button>
                            </div>
                        </form>
                    </section>
                </main>
            </div>
        </div>
        <script>
            document.getElementById('profile_photo').addEventListener('change', (event) => {
                const file = event.target.files[0];
                if (!file) return;

                const preview = document.getElementById('photo-preview');
                const image = document.createElement('img');
                image.alt = 'Profile picture preview';
                image.src = URL.createObjectURL(file);
                preview.replaceChildren(image);
            });
        </script>
    </body>
</html>
