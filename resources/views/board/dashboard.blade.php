<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Board Dashboard - DEPED Region V Recruitment</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
        <style>
            :root {
                --color-primary: #0057B8;
                --color-ink: #171717;
                --color-body: #60646c;
                --color-muted: #999999;
                --color-hairline: #f0f0f3;
                --color-canvas: #fafafa;
                --color-surface-card: #ffffff;
                --font-sans: 'Inter', -apple-system, system-ui, sans-serif;
                --rounded-md: 8px;
            }
            * { margin: 0; padding: 0; box-sizing: border-box; }
            body { font-family: var(--font-sans); background: var(--color-canvas); color: var(--color-ink); display: flex; align-items: center; justify-content: center; min-height: 100vh; }
            .logout-btn { position: fixed; top: 20px; right: 20px; color: var(--color-body); text-decoration: none; font-size: 14px; padding: 10px 20px; cursor: pointer; border: 1px solid var(--color-hairline); border-radius: var(--rounded-md); background: white; }
            .logout-btn:hover { color: #dc2626; }
            .confirm-overlay {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(0,0,0,0.5);
                align-items: center;
                justify-content: center;
                z-index: 1000;
            }
            .confirm-overlay.show { display: flex; }
            .confirm-box { background: white; border-radius: var(--rounded-md); padding: 24px; max-width: 400px; text-align: center; }
            .confirm-title { font-size: 18px; font-weight: 600; margin-bottom: 8px; }
            .confirm-message { font-size: 14px; color: var(--color-body); margin-bottom: 24px; }
            .confirm-buttons { display: flex; gap: 12px; justify-content: center; }
            .confirm-btn { padding: 10px 24px; border-radius: var(--rounded-md); font-size: 14px; font-weight: 500; cursor: pointer; border: none; }
            .confirm-btn-cancel { background: #f0f0f3; color: var(--color-ink); }
            .confirm-btn-logout { background: #dc2626; color: white; }
        </style>
    </head>
    <body>
        <h1>{{ auth()->user()->first_name }} {{ auth()->user()->last_name }} - {{ ucfirst(auth()->user()->role) }}</h1>
        <button type="button" class="logout-btn" onclick="showLogoutConfirm()">Sign Out</button>

        <div class="confirm-overlay" id="logoutConfirm">
            <div class="confirm-box">
                <h3 class="confirm-title">Sign Out</h3>
                <p class="confirm-message">Are you sure you want to sign out?</p>
                <div class="confirm-buttons">
                    <button type="button" class="confirm-btn confirm-btn-cancel" onclick="hideLogoutConfirm()">Cancel</button>
                    <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                        @csrf
                        <button type="submit" class="confirm-btn confirm-btn-logout">Sign Out</button>
                    </form>
                </div>
            </div>
        </div>

        <script>
            function showLogoutConfirm() { document.getElementById('logoutConfirm').classList.add('show'); }
            function hideLogoutConfirm() { document.getElementById('logoutConfirm').classList.remove('show'); }
        </script>
    </body>
</html>