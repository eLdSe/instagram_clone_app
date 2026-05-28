<x-app-layout>
<form action="/{{ $user->username }}/update" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PATCH')

    <div class="ep-root">

        {{-- ── Avatar Hero ─────────────────────────── --}}
        <div class="ep-hero">

            {{-- Градиентный accent stripe --}}
            <div class="ep-hero-stripe"></div>

            <div class="ep-avatar-stage">
                <div class="ep-avatar-glow"></div>
                <button type="button" id="avatar_trigger" class="ep-avatar-btn" title="{{ __('Change photo') }}">
                    <img id="avatar_preview" src="{{ $user->avatarUrl() }}" alt="{{ $user->username }}" class="ep-avatar-img">
                    <span class="ep-avatar-overlay">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/>
                            <circle cx="12" cy="13" r="4"/>
                        </svg>
                        <span class="ep-overlay-text">{{ __('Change') }}</span>
                    </span>
                </button>
                <input class="hidden" name="image" id="file_input" type="file" accept="image/*">
            </div>

            <div class="ep-hero-meta">
                <p class="ep-hero-username">{{ $user->username }}</p>
                <p class="ep-hero-name">{{ $user->name }}</p>
                <button type="button" id="avatar_text_btn" class="ep-hero-change">
                    {{ __('Change profile photo') }}
                </button>
            </div>

            @error('image')
                <span class="ep-error mt-2">{{ $message }}</span>
            @enderror

            {{-- Divider --}}
            <div class="ep-hero-divider"></div>

            {{-- Stats --}}
            <div class="ep-stats">
                <div class="ep-stat">
                    <span class="ep-stat-val">{{ $user->posts_count ?? $user->posts()->count() }}</span>
                    <span class="ep-stat-key">{{ __('Posts') }}</span>
                </div>
                <div class="ep-stat-sep"></div>
                <div class="ep-stat">
                    <span class="ep-stat-val">{{ $user->followers_count ?? $user->followers()->count() }}</span>
                    <span class="ep-stat-key">{{ __('Followers') }}</span>
                </div>
                <div class="ep-stat-sep"></div>
                <div class="ep-stat">
                    <span class="ep-stat-val">{{ $user->following_count ?? $user->following()->count() }}</span>
                    <span class="ep-stat-key">{{ __('Following') }}</span>
                </div>
            </div>

            {{-- Divider --}}
            <div class="ep-hero-divider"></div>

            {{-- Tips --}}
            <div class="ep-tips">
                <p class="ep-tips-title">{{ __('Profile tips') }}</p>
                <ul class="ep-tips-list">
                    <li class="ep-tip {{ $user->avatarUrl() ? 'ep-tip--done' : '' }}">
                        <span class="ep-tip-dot"></span>
                        {{ __('Add a profile photo') }}
                    </li>
                    <li class="ep-tip {{ $user->bio ? 'ep-tip--done' : '' }}">
                        <span class="ep-tip-dot"></span>
                        {{ __('Write a bio') }}
                    </li>
                    <li class="ep-tip {{ $user->name ? 'ep-tip--done' : '' }}">
                        <span class="ep-tip-dot"></span>
                        {{ __('Add your name') }}
                    </li>
                </ul>
            </div>

        </div>

        {{-- ── Profile Card ─────────────────────────── --}}
        <div class="ep-card ep-card--anim" style="--d:0ms">
            <div class="ep-card-label">{{ __('Profile') }}</div>

            <div class="ep-fields-grid">
                {{-- Username --}}
                <div class="ep-field">
                    <input type="text" name="username" id="ep_username" value="{{ $user->username }}" class="ep-input" placeholder=" ">
                    <label for="ep_username" class="ep-label">{{ __('Username') }}</label>
                    <div class="ep-line"></div>
                </div>
                @error('username') <span class="ep-error" style="grid-column:1/-1">{{ $message }}</span> @enderror

                {{-- Bio spans full width --}}
                <div class="ep-field" style="grid-column:1/-1">
                    <textarea name="bio" id="ep_bio" rows="3" maxlength="150" class="ep-input ep-textarea" placeholder=" ">{{ $user->bio }}</textarea>
                    <label for="ep_bio" class="ep-label">{{ __('Bio') }}</label>
                    <div class="ep-line"></div>
                    <span class="ep-bio-count"><span id="bio-count">0</span>/150</span>
                </div>
            </div>

            {{-- Private --}}
            <label class="ep-toggle-row">
                <div class="ep-toggle-info">
                    <span class="ep-toggle-title">{{ __('Private Account') }}</span>
                    <span class="ep-toggle-sub">{{ __('Only followers can see your posts') }}</span>
                </div>
                <div class="ep-switch">
                    <input type="checkbox" name="private_account" id="ep_private" class="ep-switch-input" {{ $user->private_account ? 'checked' : '' }}>
                    <span class="ep-switch-track">
                        <span class="ep-switch-thumb"></span>
                    </span>
                </div>
            </label>

            {{-- Language hidden --}}
            <div class="hidden">
                <select id="lang" name="lang">
                    <option value="ar" {{ app()->getLocale() == 'ar' ? 'selected' : '' }}>العربية</option>
                    <option value="en" {{ app()->getLocale() == 'en' ? 'selected' : '' }}>English</option>
                </select>
            </div>

            <div class="ep-card-footer">
                <button type="submit" class="ep-save-btn">{{ __('Save changes') }}</button>
            </div>
        </div>

        {{-- ── Personal Info Card ───────────────────── --}}
        <div class="ep-card ep-card--anim" style="--d:80ms">
            <div class="ep-card-label">{{ __('Personal Information') }}</div>

            <div class="ep-fields-grid">
                {{-- Name --}}
                <div class="ep-field">
                    <input type="text" name="name" id="ep_name" value="{{ $user->name }}" class="ep-input" placeholder=" ">
                    <label for="ep_name" class="ep-label">{{ __('Name') }}</label>
                    <div class="ep-line"></div>
                </div>
                @error('name') <span class="ep-error" style="grid-column:1/-1">{{ $message }}</span> @enderror

                {{-- Email --}}
                <div class="ep-field">
                    <input type="email" name="email" id="ep_email" value="{{ $user->email }}" autocomplete="email" class="ep-input" placeholder=" ">
                    <label for="ep_email" class="ep-label">{{ __('Email address') }}</label>
                    <div class="ep-line"></div>
                </div>
                @error('email') <span class="ep-error" style="grid-column:1/-1">{{ $message }}</span> @enderror

                {{-- Password --}}
                <div class="ep-field ep-field--pw">
                    <input type="password" name="password" id="ep_password" autocomplete="new-password" class="ep-input" placeholder=" ">
                    <label for="ep_password" class="ep-label">{{ __('New password') }}</label>
                    <div class="ep-line"></div>
                    <button type="button" class="ep-eye" data-target="ep_password" onclick="togglePw(this)">
                        <svg class="ep-eye-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>
                        </svg>
                    </button>
                </div>
                @error('password') <span class="ep-error" style="grid-column:1/-1">{{ $message }}</span> @enderror

                {{-- Password Confirm --}}
                <div class="ep-field ep-field--pw">
                    <input type="password" name="password_confirmation" id="ep_pw_confirm" autocomplete="new-password" class="ep-input" placeholder=" ">
                    <label for="ep_pw_confirm" class="ep-label">{{ __('Confirm password') }}</label>
                    <div class="ep-line"></div>
                    <button type="button" class="ep-eye" data-target="ep_pw_confirm" onclick="togglePw(this)">
                        <svg class="ep-eye-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>
                        </svg>
                    </button>
                </div>
            </div>

            <div class="ep-card-footer">
                <button type="submit" class="ep-save-btn">{{ __('Save changes') }}</button>
            </div>
        </div>

    </div>
</form>

<style>
/* ═══════════════════════════════════════════════════
   Edit Profile — Scoped Styles
   Prefix: ep-  (не конфликтует с глобальным CSS)
   ═══════════════════════════════════════════════════ */

/* ── Root layout — two-column full-width ── */
.ep-root {
    display: grid;
    grid-template-columns: 240px 1fr;
    gap: 16px;
    padding: 32px 24px 64px;
    max-width: 1100px;
    margin: 0 auto;
    align-items: start;
}

/* ── Hero (avatar section) ── */
.ep-hero {
    grid-column: 1;
    grid-row: 1 / span 3;
    position: sticky;
    top: 80px;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 16px;
    padding: 36px 20px 28px;
    background: var(--surface-1);
    border: 1px solid var(--border);
    border-radius: 24px;
    animation: epFadeUp 0.45s ease both;
}

@media (max-width: 700px) {
    .ep-root {
        grid-template-columns: 1fr;
        padding: 16px 12px 64px;
    }
    .ep-hero {
        grid-column: 1;
        grid-row: auto;
        position: static;
    }
    .ep-card {
        grid-column: 1;
    }
}

.ep-avatar-stage {
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
}

/* Градиентное свечение под аватаром */
.ep-avatar-glow {
    position: absolute;
    width: 110px;
    height: 110px;
    border-radius: 50%;
    background: var(--ig-grad);
    filter: blur(20px);
    opacity: 0.45;
    transform: scale(0.9) translateY(8px);
    transition: opacity 0.3s ease, transform 0.3s ease;
    pointer-events: none;
}

.ep-avatar-btn:hover ~ .ep-avatar-glow,
.ep-avatar-stage:hover .ep-avatar-glow {
    opacity: 0.65;
    transform: scale(1.05) translateY(10px);
}

/* Кнопка-аватар */
.ep-avatar-btn {
    position: relative;
    width: 96px;
    height: 96px;
    border-radius: 50%;
    border: none;
    padding: 0;
    cursor: pointer;
    background: none;
    outline: none;
    /* градиентное кольцо */
    box-shadow: 0 0 0 3px var(--surface-1), 0 0 0 5.5px transparent;
    background-image: var(--ig-grad);
    background-origin: border-box;
    /* используем outline + pseudo-ring через padding */
}

/* Настоящее кольцо — обёртка с паддингом 3px */
.ep-avatar-btn::before {
    content: '';
    position: absolute;
    inset: -3px;
    border-radius: 50%;
    background: var(--ig-grad);
    z-index: 0;
}

.ep-avatar-img {
    position: relative;
    z-index: 1;
    width: 90px;
    height: 90px;
    border-radius: 50%;
    object-fit: cover;
    display: block;
    border: 3px solid var(--surface-1);
    margin: 3px;
    transition: filter 0.25s ease, transform 0.25s ease;
}

.ep-avatar-btn:hover .ep-avatar-img {
    filter: brightness(0.55);
    transform: scale(1.02);
}

/* Overlay с иконкой */
.ep-avatar-overlay {
    position: absolute;
    inset: 0;
    z-index: 2;
    border-radius: 50%;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 3px;
    color: #fff;
    opacity: 0;
    transition: opacity 0.25s ease;
    pointer-events: none;
}

.ep-avatar-btn:hover .ep-avatar-overlay { opacity: 1; }

.ep-overlay-text {
    font-size: 10px;
    font-weight: 700;
    letter-spacing: 0.04em;
    text-transform: uppercase;
}

.ep-hero-meta {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 4px;
}

.ep-hero-username {
    font-size: 16px;
    font-weight: 700;
    color: var(--text-primary);
    margin: 0;
}

.ep-hero-change {
    font-size: 13px;
    font-weight: 600;
    background: none;
    border: none;
    cursor: pointer;
    padding: 0;
    color: var(--accent);
    transition: opacity 0.15s ease;
}

.ep-hero-change:hover { opacity: 0.75; }

/* ── Card — right column ── */
.ep-card {
    grid-column: 2;
    background: var(--surface-1);
    border: 1px solid var(--border);
    border-radius: 24px;
    overflow: hidden;
    padding: 0 0 4px;
}

.ep-card--anim {
    animation: epFadeUp 0.45s ease both;
    animation-delay: var(--d, 0ms);
}

.ep-card-label {
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    color: var(--text-muted);
    padding: 20px 24px 4px;
}

.ep-card-footer {
    padding: 8px 24px 20px;
    display: flex;
    justify-content: flex-end;
}

/* ── Floating label fields ── */
.ep-field {
    position: relative;
    padding: 24px 24px 0;
    margin-bottom: 4px;
}

.ep-field--pw { padding-right: 52px; }

.ep-input {
    width: 100%;
    background: transparent;
    border: none;
    outline: none;
    font-size: 14px;
    font-family: inherit;
    color: var(--text-primary);
    padding: 18px 0 6px;
    line-height: 1.4;
    transition: color 0.2s ease;
}

.ep-textarea {
    resize: none;
    display: block;
    line-height: 1.5;
}

/* Floating label */
.ep-label {
    position: absolute;
    left: 24px;
    top: 50%;
    transform: translateY(-50%);
    font-size: 14px;
    font-weight: 500;
    color: var(--text-muted);
    pointer-events: none;
    transition: top 0.2s ease, font-size 0.2s ease, color 0.2s ease, font-weight 0.2s ease;
    transform-origin: left top;
}

/* Textarea — лейбл сверху */
.ep-textarea ~ .ep-label {
    top: 28px;
    transform: none;
}

/* Когда инпут в фокусе или не пустой */
.ep-input:focus ~ .ep-label,
.ep-input:not(:placeholder-shown) ~ .ep-label {
    top: 22px;
    font-size: 11px;
    font-weight: 700;
    color: var(--ig-pink);
    transform: none;
}

.ep-textarea:focus ~ .ep-label,
.ep-textarea:not(:placeholder-shown) ~ .ep-label {
    top: 8px;
    font-size: 11px;
    font-weight: 700;
    color: var(--ig-pink);
}

/* Нижняя линия */
.ep-line {
    height: 1px;
    background: var(--border);
    transition: background 0.2s ease, height 0.2s ease;
    margin: 0 0 0 0;
}

.ep-input:focus ~ .ep-line {
    height: 2px;
    background: linear-gradient(90deg, var(--ig-pink), var(--ig-purple));
}

/* Bio counter */
.ep-bio-count {
    position: absolute;
    right: 24px;
    bottom: 8px;
    font-size: 11px;
    color: var(--text-muted);
    font-variant-numeric: tabular-nums;
    pointer-events: none;
}

/* Eye button */
.ep-eye {
    position: absolute;
    right: 24px;
    top: 50%;
    transform: translateY(-2px);
    background: none;
    border: none;
    cursor: pointer;
    color: var(--text-muted);
    padding: 4px;
    display: flex;
    align-items: center;
    transition: color 0.15s ease;
}
.ep-eye:hover { color: var(--text-secondary); }

/* ── Toggle switch ── */
.ep-toggle-row {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 14px 24px;
    cursor: pointer;
    gap: 16px;
    border-top: 1px solid var(--border-subtle);
    margin-top: 8px;
}

.ep-toggle-info {
    display: flex;
    flex-direction: column;
    gap: 2px;
}

.ep-toggle-title {
    font-size: 14px;
    font-weight: 600;
    color: var(--text-primary);
}

.ep-toggle-sub {
    font-size: 12px;
    color: var(--text-muted);
}

.ep-switch { position: relative; flex-shrink: 0; }
.ep-switch-input { position: absolute; opacity: 0; width: 0; height: 0; }

.ep-switch-track {
    display: block;
    width: 44px;
    height: 26px;
    border-radius: 99px;
    background: var(--surface-3);
    border: 1.5px solid var(--border);
    transition: background 0.2s ease, border-color 0.2s ease;
    position: relative;
    cursor: pointer;
}

.ep-switch-thumb {
    position: absolute;
    top: 3px;
    left: 3px;
    width: 18px;
    height: 18px;
    border-radius: 50%;
    background: var(--text-muted);
    transition: transform 0.2s cubic-bezier(.34,1.56,.64,1), background 0.2s ease;
}

.ep-switch-input:checked + .ep-switch-track {
    background: var(--ig-pink);
    border-color: var(--ig-pink);
}
.ep-switch-input:checked + .ep-switch-track .ep-switch-thumb {
    transform: translateX(18px);
    background: #fff;
}

/* ── Save button ── */
.ep-save-btn {
    padding: 9px 28px;
    background: var(--ig-grad-btn);
    background-size: 200% 200%;
    animation: gradShift 4s ease infinite;
    color: #fff;
    font-size: 13px;
    font-weight: 700;
    border: none;
    border-radius: 12px;
    cursor: pointer;
    letter-spacing: 0.02em;
    transition: opacity 0.15s ease, transform 0.15s ease, box-shadow 0.15s ease;
}

.ep-save-btn:hover {
    opacity: 0.92;
    transform: translateY(-1px);
    box-shadow: 0 6px 24px rgba(238, 42, 123, 0.35);
}

.ep-save-btn:active { transform: scale(0.97); }

/* ── Error ── */
.ep-error {
    display: block;
    font-size: 12px;
    color: #f55;
    padding: 4px 24px 0;
}

/* ── Animation ── */
@keyframes epFadeUp {
    from { opacity: 0; transform: translateY(16px); }
    to   { opacity: 1; transform: translateY(0); }
}

/* ── Light mode adjustments ── */
[data-theme="light"] .ep-avatar-glow { opacity: 0.3; }
[data-theme="light"] .ep-switch-track { background: #e0e0e0; }
[data-theme="light"] .ep-save-btn { box-shadow: 0 2px 12px rgba(238,42,123,0.2); }

/* ── Hero stripe ── */
.ep-hero-stripe {
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 4px;
    background: var(--ig-grad);
    border-radius: 24px 24px 0 0;
}

/* ── Hero name subtitle ── */
.ep-hero-name {
    font-size: 13px;
    color: var(--text-muted);
    margin: 0;
}

/* ── Divider ── */
.ep-hero-divider {
    width: 100%;
    height: 1px;
    background: var(--border-subtle);
}

/* ── Stats ── */
.ep-stats {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0;
    width: 100%;
}

.ep-stat {
    flex: 1;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 2px;
    padding: 8px 0;
}

.ep-stat-val {
    font-size: 18px;
    font-weight: 700;
    color: var(--text-primary);
    line-height: 1;
}

.ep-stat-key {
    font-size: 11px;
    color: var(--text-muted);
    font-weight: 500;
    letter-spacing: 0.02em;
}

.ep-stat-sep {
    width: 1px;
    height: 32px;
    background: var(--border);
    flex-shrink: 0;
}

/* ── Tips ── */
.ep-tips {
    width: 100%;
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.ep-tips-title {
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    color: var(--text-muted);
    margin: 0;
}

.ep-tips-list {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.ep-tip {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 13px;
    color: var(--text-secondary);
    transition: color 0.2s ease;
}

.ep-tip-dot {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    border: 2px solid var(--text-muted);
    flex-shrink: 0;
    transition: background 0.2s ease, border-color 0.2s ease;
}

.ep-tip--done {
    color: var(--text-muted);
    text-decoration: line-through;
    text-decoration-color: var(--ig-pink);
}

.ep-tip--done .ep-tip-dot {
    background: var(--ig-pink);
    border-color: var(--ig-pink);
}

/* ── 2-col fields grid ── */
.ep-fields-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 0 16px;
    padding: 0 8px;
}

@media (max-width: 700px) {
    .ep-fields-grid {
        grid-template-columns: 1fr;
    }
}

</style>

<script>
    // ── Avatar preview ──────────────────────────────────────
    const fileInput = document.getElementById('file_input');
    const preview   = document.getElementById('avatar_preview');

    document.getElementById('avatar_trigger').addEventListener('click', () => fileInput.click());
    document.getElementById('avatar_text_btn').addEventListener('click', () => fileInput.click());

    fileInput.addEventListener('change', function () {
        const file = this.files[0];
        if (!file) return;
        if (!file.type.startsWith('image/')) { alert('{{ __("Please select an image file.") }}'); return; }
        if (file.size > 5 * 1024 * 1024)    { alert('{{ __("Image must be less than 5 MB.") }}'); return; }

        const reader = new FileReader();
        reader.onload = (e) => {
            preview.style.opacity = '0';
            preview.src = e.target.result;
            preview.onload = () => {
                preview.style.transition = 'opacity 0.3s ease';
                preview.style.opacity = '1';
            };
        };
        reader.readAsDataURL(file);
    });

    // ── Bio counter ─────────────────────────────────────────
    const bioArea  = document.getElementById('ep_bio');
    const bioCount = document.getElementById('bio-count');
    const updateCount = () => bioCount.textContent = bioArea.value.length;
    updateCount();
    bioArea.addEventListener('input', updateCount);

    // ── Password toggle ─────────────────────────────────────
    const eyeOpen = `<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>`;
    const eyeOff  = `<path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94"/><path d="M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19"/><line x1="1" y1="1" x2="23" y2="23"/>`;

    function togglePw(btn) {
        const input = document.getElementById(btn.dataset.target);
        const show  = input.type === 'password';
        input.type  = show ? 'text' : 'password';
        btn.querySelector('.ep-eye-icon').innerHTML = show ? eyeOff : eyeOpen;
    }
</script>
</x-app-layout>