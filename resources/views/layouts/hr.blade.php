<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <title>@yield('title', 'HR - DEPED Region V Recruitment')</title>
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
            <a href="{{ route('hr.dashboard') }}" class="flex items-center gap-[10px] px-3 py-[10px] text-body rounded-md text-sm font-medium mb-1 no-underline hover:bg-surface-strong hover:text-ink transition-colors {{ Route::is('hr.dashboard') ? 'bg-primary text-white hover:bg-primary hover:text-white' : '' }}">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="shrink-0"><rect x="3" y="3" width="7" height="9"></rect><rect x="14" y="3" width="7" height="5"></rect><rect x="14" y="12" width="7" height="9"></rect><rect x="3" y="16" width="7" height="5"></rect></svg>
                <span class="max-md:hidden">Dashboard</span>
            </a>
            <a href="{{ route('hr.job-postings') }}" class="flex items-center gap-[10px] px-3 py-[10px] text-body rounded-md text-sm font-medium mb-1 no-underline hover:bg-surface-strong hover:text-ink transition-colors {{ Route::is('hr.job-postings') ? 'bg-primary text-white hover:bg-primary hover:text-white' : '' }}">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="shrink-0"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path></svg>
                <span class="max-md:hidden">Job Postings</span>
            </a>
            <a href="{{ route('hr.applications') }}" class="flex items-center gap-[10px] px-3 py-[10px] text-body rounded-md text-sm font-medium mb-1 no-underline hover:bg-surface-strong hover:text-ink transition-colors {{ Route::is('hr.applications*') ? 'bg-primary text-white hover:bg-primary hover:text-white' : '' }}">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="shrink-0"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line></svg>
                <span class="max-md:hidden">Applications</span>
            </a>
            <div class="text-[11px] font-semibold text-muted uppercase tracking-[0.5px] mx-3 my-5 max-md:hidden">Reports</div>
            <a href="{{ route('hr.ier') }}" class="flex items-center gap-[10px] px-3 py-[10px] text-body rounded-md text-sm font-medium mb-1 no-underline hover:bg-surface-strong hover:text-ink transition-colors {{ Route::is('hr.ier') ? 'bg-primary text-white hover:bg-primary hover:text-white' : '' }}">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="shrink-0"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line></svg>
                <span class="max-md:hidden">IER</span>
            </a>
            <div class="text-[11px] font-semibold text-muted uppercase tracking-[0.5px] mx-3 my-5 max-md:hidden">System</div>
            <a href="#" class="flex items-center gap-[10px] px-3 py-[10px] text-body rounded-md text-sm font-medium mb-1 no-underline hover:bg-surface-strong hover:text-ink transition-colors">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="shrink-0"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 2.83-2.83l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>
                <span class="max-md:hidden">Settings</span>
            </a>
        </nav>
        <div class="mt-auto">
            <div class="flex items-center gap-3 p-3 bg-surface-strong rounded-md max-md:hidden">
                <div class="w-9 h-9 bg-primary rounded-full flex items-center justify-center text-white font-semibold text-sm shrink-0">{{ strtoupper(substr(auth()->user()->first_name, 0, 1)) }}{{ strtoupper(substr(auth()->user()->last_name, 0, 1)) }}</div>
                <div class="min-w-0">
                    <div class="font-medium text-sm truncate">{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</div>
                    <div class="text-xs text-body">HR</div>
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
