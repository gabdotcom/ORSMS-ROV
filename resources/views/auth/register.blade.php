<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Register - DEPED Region V Recruitment</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css'])
        @endif
    </head>
    <body class="font-sans bg-canvas">
        <div class="flex min-h-screen">
            <!-- Left Panel - Branding -->
            <div class="hidden md:flex w-[45%] p-xxl flex-col justify-center bg-gradient-to-br from-primary via-primary-active to-[#003366]">
                <div class="max-w-[400px]">
                    <div class="flex items-center gap-sm mb-xl">
                        <svg class="w-12 h-12" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2">
                            <path d="M12 2L2 7l10 5 10-5-10-5z"></path>
                            <path d="M2 17l10 5 10-5"></path>
                            <path d="M2 12l10 5 10-5"></path>
                        </svg>
                        <span class="font-semibold text-xl text-white">DEPED Region V</span>
                    </div>
                    <h1 class="text-display-md text-white mb-base leading-tight">Start Your Career Journey</h1>
                    <p class="text-body-sm text-white/85 leading-relaxed mb-xl">Create your account to begin applying for positions in the Department of Education Region V.</p>
                    <div class="flex flex-col gap-base">
                        <div class="flex items-center gap-[10px] text-body-sm text-white">
                            <svg class="w-[18px] h-[18px] shrink-0 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"></polyline></svg>
                            <span>Apply to multiple positions</span>
                        </div>
                        <div class="flex items-center gap-[10px] text-body-sm text-white">
                            <svg class="w-[18px] h-[18px] shrink-0 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"></polyline></svg>
                            <span>Manage your profile and documents</span>
                        </div>
                        <div class="flex items-center gap-[10px] text-body-sm text-white">
                            <svg class="w-[18px] h-[18px] shrink-0 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"></polyline></svg>
                            <span>Receive real-time status updates</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Panel - Form -->
            <div class="flex-1 flex items-center justify-center p-lg">
                <div class="bg-surface-card border border-hairline-strong rounded-lg p-10 w-full max-w-[560px] shadow-soft">
                    <a href="{{ route('welcome') }}" class="inline-flex items-center gap-[6px] text-body no-underline text-body-sm mb-xl hover:text-primary">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
                        Back to Home
                    </a>
                    <h2 class="text-2xl font-semibold text-ink mb-xs">Create Account</h2>
                    <p class="text-body-sm text-body mb-6">Fill in your details to register</p>

                    @if ($errors->any())
                        <div class="text-semantic-error-strong text-caption mb-base p-3 rounded-md bg-red-50 border border-red-200">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="grid grid-cols-2 gap-base">
                            <div class="mb-md">
                                <label class="block text-body-sm font-medium text-ink mb-[6px]" for="first_name">First Name</label>
                                <input type="text" id="first_name" name="first_name" class="w-full h-[44px] px-base text-[15px] border border-hairline-strong rounded-md bg-surface-card text-ink placeholder:text-muted focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent @error('first_name') !border-semantic-error-strong @enderror" value="{{ old('first_name') }}" required>
                            </div>
                            <div class="mb-md">
                                <label class="block text-body-sm font-medium text-ink mb-[6px]" for="middle_name">Middle Name <span class="font-normal text-muted text-[12px]">(optional)</span></label>
                                <input type="text" id="middle_name" name="middle_name" class="w-full h-[44px] px-base text-[15px] border border-hairline-strong rounded-md bg-surface-card text-ink placeholder:text-muted focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent" value="{{ old('middle_name') }}">
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-base">
                            <div class="mb-md">
                                <label class="block text-body-sm font-medium text-ink mb-[6px]" for="last_name">Last Name</label>
                                <input type="text" id="last_name" name="last_name" class="w-full h-[44px] px-base text-[15px] border border-hairline-strong rounded-md bg-surface-card text-ink placeholder:text-muted focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent @error('last_name') !border-semantic-error-strong @enderror" value="{{ old('last_name') }}" required>
                            </div>
                            <div class="mb-md">
                                <label class="block text-body-sm font-medium text-ink mb-[6px]" for="extension_name">Extension <span class="font-normal text-muted text-[12px]">(optional)</span></label>
                                <input type="text" id="extension_name" name="extension_name" class="w-full h-[44px] px-base text-[15px] border border-hairline-strong rounded-md bg-surface-card text-ink placeholder:text-muted focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent" value="{{ old('extension_name') }}">
                            </div>
                        </div>
                        <div class="mb-md">
                            <label class="block text-body-sm font-medium text-ink mb-[6px]" for="email">Email Address</label>
                            <input type="email" id="email" name="email" class="w-full h-[44px] px-base text-[15px] border border-hairline-strong rounded-md bg-surface-card text-ink placeholder:text-muted focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent @error('email') !border-semantic-error-strong @enderror" value="{{ old('email') }}" required>
                        </div>
                        <div class="grid grid-cols-2 gap-base">
                            <div class="mb-md">
                                <label class="block text-body-sm font-medium text-ink mb-[6px]" for="password">Password</label>
                                <input type="password" id="password" name="password" class="w-full h-[44px] px-base text-[15px] border border-hairline-strong rounded-md bg-surface-card text-ink placeholder:text-muted focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent @error('password') !border-semantic-error-strong @enderror" required>
                                <p class="text-[12px] text-muted mt-[4px]">Minimum 8 characters</p>
                            </div>
                            <div class="mb-md">
                                <label class="block text-body-sm font-medium text-ink mb-[6px]" for="password_confirmation">Confirm Password</label>
                                <input type="password" id="password_confirmation" name="password_confirmation" class="w-full h-[44px] px-base text-[15px] border border-hairline-strong rounded-md bg-surface-card text-ink placeholder:text-muted focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent @error('password_confirmation') !border-semantic-error-strong @enderror" required>
                            </div>
                        </div>
                        <button type="submit" class="w-full h-[44px] bg-primary text-on-primary text-button rounded-md cursor-pointer hover:bg-primary-active mt-xs">Create Account</button>
                    </form>
                    <div class="text-center mt-lg text-body-sm text-body">
                        Already have an account? <a href="{{ route('login') }}" class="text-primary no-underline font-medium hover:underline">Sign in</a>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
