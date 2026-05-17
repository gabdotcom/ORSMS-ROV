<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Login - DEPED Region V Recruitment</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
        <style>
            :root {
                --color-primary: #0057B8;
                --color-primary-hover: #004494;
                --color-ink: #171717;
                --color-body: #60646c;
                --color-muted: #999999;
                --color-hairline: #f0f0f3;
                --color-hairline-strong: #dcdee0;
                --color-canvas: #ffffff;
                --color-surface-card: #ffffff;
                --color-on-primary: #ffffff;
                --font-sans: 'Inter', -apple-system, system-ui, sans-serif;
                --rounded-md: 8px;
                --rounded-lg: 12px;
            }
            * { margin: 0; padding: 0; box-sizing: border-box; }
            body { font-family: var(--font-sans); background: var(--color-canvas); }
            .container { display: flex; min-height: 100vh; }
            .left-panel {
                display: none;
                background: linear-gradient(135deg, #0057B8 0%, #004494 40%, #003366 100%);
                width: 45%;
                padding: 48px;
                flex-direction: column;
                justify-content: center;
            }
            .right-panel {
                flex: 1;
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 24px;
            }
            @media (min-width: 768px) {
                .left-panel { display: flex; }
            }
            .left-content { max-width: 400px; }
            .left-logo { display: flex; align-items: center; gap: 12px; margin-bottom: 32px; }
            .left-logo svg { width: 48px; height: 48px; }
            .left-logo-text { font-weight: 600; font-size: 20px; color: #ffffff; }
            .left-title { font-size: 28px; font-weight: 600; color: #ffffff; margin-bottom: 16px; line-height: 1.2; }
            .left-desc { font-size: 15px; color: rgba(255,255,255,0.85); line-height: 1.6; margin-bottom: 32px; }
            .left-features { display: flex; flex-direction: column; gap: 16px; }
            .left-feature { display: flex; align-items: center; gap: 10px; font-size: 14px; color: #ffffff; }
            .left-feature svg { width: 18px; height: 18px; flex-shrink: 0; color: #ffffff; }
            .form-card {
                background: var(--color-surface-card);
                border: 1px solid var(--color-hairline-strong);
                border-radius: var(--rounded-lg);
                padding: 40px;
                width: 100%;
                max-width: 500px;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.04);
            }
            .back-link { display: inline-flex; align-items: center; gap: 6px; color: var(--color-body); text-decoration: none; font-size: 14px; margin-bottom: 20px; }
            .back-link:hover { color: var(--color-primary); }
            .form-title { font-size: 24px; font-weight: 600; color: var(--color-ink); margin-bottom: 8px; }
            .form-subtitle { font-size: 14px; color: var(--color-body); margin-bottom: 28px; }
            .form-group { margin-bottom: 20px; }
            .form-label { display: block; font-size: 14px; font-weight: 500; color: var(--color-ink); margin-bottom: 6px; }
            .form-input {
                width: 100%;
                height: 44px;
                padding: 0 16px;
                font-size: 15px;
                border: 1px solid var(--color-hairline-strong);
                border-radius: var(--rounded-md);
                background: var(--color-surface-card);
                color: var(--color-ink);
                transition: border-color 0.15s;
            }
            .form-input:focus { outline: none; border-color: var(--color-primary); border-width: 2px; padding: 0 15px; }
            .form-input::placeholder { color: var(--color-muted); }
            .form-checkbox { display: flex; align-items: center; gap: 8px; margin-bottom: 24px; }
            .form-checkbox input { width: 16px; height: 16px; accent-color: var(--color-primary); }
            .form-checkbox label { font-size: 14px; color: var(--color-body); cursor: pointer; }
            .btn-primary {
                width: 100%;
                height: 44px;
                background: var(--color-primary);
                color: var(--color-on-primary);
                font-size: 15px;
                font-weight: 500;
                border: none;
                border-radius: var(--rounded-md);
                cursor: pointer;
                transition: background 0.15s;
            }
            .btn-primary:hover { background: var(--color-primary-hover); }
            .form-footer { text-align: center; margin-top: 24px; font-size: 14px; color: var(--color-body); }
            .form-footer a { color: var(--color-primary); text-decoration: none; font-weight: 500; }
            .form-footer a:hover { text-decoration: underline; }
            .error-message { color: #dc2626; font-size: 13px; margin-bottom: 16px; padding: 12px; background: #fef2f2; border-radius: var(--rounded-md); border: 1px solid #fecaca; }
            .input-error { border-color: #dc2626 !important; }
        </style>
    </head>
    <body>
        <div class="container">
            <!-- Left Panel - Branding -->
            <div class="left-panel">
                <div class="left-content">
                    <div class="left-logo">
                        <svg viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2">
                            <path d="M12 2L2 7l10 5 10-5-10-5z"></path>
                            <path d="M2 17l10 5 10-5"></path>
                            <path d="M2 12l10 5 10-5"></path>
                        </svg>
                        <span class="left-logo-text">DEPED Region V</span>
                    </div>
                    <h1 class="left-title">Online Recruitment & Selection Management System</h1>
                    <p class="left-desc">Streamline your application process with our secure, efficient, and transparent recruitment platform.</p>
                    <div class="left-features">
                        <div class="left-feature">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"></polyline></svg>
                            <span>Track your application status online</span>
                        </div>
                        <div class="left-feature">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"></polyline></svg>
                            <span>Upload documents securely</span>
                        </div>
                        <div class="left-feature">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"></polyline></svg>
                            <span>Instant notifications on updates</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Panel - Form -->
            <div class="right-panel">
                <div class="form-card">
                    <a href="{{ route('welcome') }}" class="back-link">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
                        Back to Home
                    </a>
                    <h2 class="form-title">Welcome back</h2>
                    <p class="form-subtitle">Enter your credentials to access your account</p>

                    @if ($errors->any())
                        <div class="error-message">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group">
                            <label class="form-label" for="email">Email Address</label>
                            <input type="email" id="email" name="email" class="form-input @error('email') input-error @enderror" value="{{ old('email') }}"required>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="password">Password</label>
                            <input type="password" id="password" name="password" class="form-input @error('password') input-error @enderror"required>
                        </div>
                        <div class="form-checkbox">
                            <input type="checkbox" id="remember" name="remember">
                            <label for="remember">Remember me</label>
                        </div>
                        <button type="submit" class="btn-primary">Sign In</button>
                    </form>
                    <div class="form-footer">
                        Don't have an account? <a href="{{ route('register') }}">Register here</a>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>