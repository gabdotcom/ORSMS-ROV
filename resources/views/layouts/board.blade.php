<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Board - DEPED Region V Recruitment')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css'])
    @stack('styles')
</head>
<body class="font-sans bg-canvas text-ink flex items-center justify-center min-h-screen">
    @yield('content')

    <button type="button" class="fixed top-5 right-5 text-body text-sm px-5 py-[10px] cursor-pointer border border-hairline rounded-md bg-white hover:text-semantic-error-strong transition-colors" onclick="showLogoutConfirm()">Sign Out</button>

    <div class="confirm-overlay fixed inset-0 bg-black/50 hidden items-center justify-center z-[1000]" id="logoutConfirm">
        <div class="bg-white rounded-md p-lg max-w-[400px] text-center">
            <h3 class="text-lg font-semibold mb-2">Sign Out</h3>
            <p class="text-sm text-body mb-lg">Are you sure you want to sign out?</p>
            <div class="flex gap-3 justify-center">
                <button type="button" class="px-6 py-[10px] rounded-md text-sm font-medium cursor-pointer border-none bg-[#f0f0f3] text-ink" onclick="hideLogoutConfirm()">Cancel</button>
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
