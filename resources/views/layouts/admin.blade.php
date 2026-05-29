<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <title>@yield('title', 'Admin - DEPED Region V Recruitment')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css'])
    @stack('styles')
</head>
<body class="font-sans bg-canvas text-ink">
    <aside class="fixed inset-y-0 left-0 w-[240px] max-md:w-16 bg-surface-card border-r border-hairline px-base py-xl flex flex-col z-[100] transition-all duration-200">
        <div class="flex items-center gap-[10px] mb-xl px-2">
            <svg viewBox="0 0 24 24" fill="none" stroke="#0057B8" stroke-width="2" class="w-8 h-8 shrink-0">
                <path d="M12 2L2 7l10 5 10-5-10-5z"></path>
                <path d="M2 17l10 5 10-5"></path>
                <path d="M2 12l10 5 10-5"></path>
            </svg>
            <span class="font-semibold text-base max-md:hidden">DEPED<span class="text-primary">ROV</span></span>
        </div>
        <nav class="flex-1">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-[10px] px-3 py-[10px] text-body rounded-md text-sm font-medium mb-1 no-underline hover:bg-surface-strong hover:text-ink transition-colors {{ Route::is('admin.dashboard') ? 'bg-primary text-white hover:bg-primary hover:text-white' : '' }}">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="shrink-0"><rect x="3" y="3" width="7" height="9"></rect><rect x="14" y="3" width="7" height="5"></rect><rect x="14" y="12" width="7" height="9"></rect><rect x="3" y="16" width="7" height="5"></rect></svg>
                <span class="max-md:hidden">Dashboard</span>
            </a>
            <a href="{{ route('admin.users') }}" class="flex items-center gap-[10px] px-3 py-[10px] text-body rounded-md text-sm font-medium mb-1 no-underline hover:bg-surface-strong hover:text-ink transition-colors {{ Route::is('admin.users') ? 'bg-primary text-white hover:bg-primary hover:text-white' : '' }}">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="shrink-0"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                <span class="max-md:hidden">Users</span>
            </a>
        </nav>
        <div class="mt-auto">
            <div class="flex items-center gap-3 p-3 bg-surface-strong rounded-md max-md:hidden">
                <div class="w-9 h-9 bg-primary rounded-full flex items-center justify-center text-white font-semibold text-sm shrink-0">{{ strtoupper(substr(auth()->user()->first_name, 0, 1)) }}{{ strtoupper(substr(auth()->user()->last_name, 0, 1)) }}</div>
                <div class="min-w-0">
                    <div class="font-medium text-sm truncate">{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</div>
                    <div class="text-xs text-body">Admin</div>
                </div>
            </div>
            <button type="button" class="text-body text-sm block w-full text-left mt-4 px-3 py-2 cursor-pointer border-none bg-transparent hover:text-semantic-error-strong transition-colors max-md:hidden" onclick="showLogoutConfirm()">Sign Out</button>
        </div>
    </aside>

    <main class="ml-[240px] max-md:ml-16 p-xl max-md:p-base min-h-screen">
        @yield('content')
    </main>

    <div class="confirm-overlay fixed inset-0 bg-black/50 hidden items-center justify-center z-[1000]" id="logoutConfirm">
        <div class="bg-white rounded-lg p-lg max-w-[400px] text-center shadow-lg">
            <h3 class="text-lg font-semibold mb-2">Sign Out</h3>
            <p class="text-sm text-body mb-lg">Are you sure you want to sign out?</p>
            <div class="flex gap-3 justify-center">
                <button type="button" class="px-6 py-[10px] rounded-md text-sm font-medium cursor-pointer border-none bg-surface-strong text-ink" onclick="hideLogoutConfirm()">Cancel</button>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="px-6 py-[10px] rounded-md text-sm font-medium cursor-pointer border-none bg-semantic-error-strong text-white">Sign Out</button>
                </form>
            </div>
        </div>
    </div>

        <div id="toast"></div>
    <style>
        #toast{position:fixed;bottom:24px;right:24px;background:#171717;color:#fff;padding:12px 20px;border-radius:8px;font-size:14px;z-index:9999;opacity:0;transform:translateY(10px);transition:opacity .2s,transform .2s;pointer-events:none;max-width:400px}
        #toast.show{opacity:1;transform:translateY(0)}
        #toast.error{background:#dc2626}
    </style>
    <script>
        function showToast(msg,err){const t=document.getElementById('toast');t.textContent=msg;t.className=err?'toast error':'toast';void t.offsetWidth;t.classList.add('show');clearTimeout(t._timeout);t._timeout=setTimeout(()=>t.classList.remove('show'),3000)}
    </script>
    @stack('scripts')

    <script>
        function showLogoutConfirm() {
            document.getElementById('logoutConfirm').classList.add('flex');
            document.getElementById('logoutConfirm').classList.remove('hidden');
        }
        function hideLogoutConfirm() {
            document.getElementById('logoutConfirm').classList.remove('flex');
            document.getElementById('logoutConfirm').classList.add('hidden');
        }
        document.addEventListener('DOMContentLoaded', function() {
            const el = document.getElementById('logoutConfirm');
            if (el) {
                el.addEventListener('click', function(e) {
                    if (e.target === this) hideLogoutConfirm();
                });
            }
        });
    </script>
</body>
</html>
