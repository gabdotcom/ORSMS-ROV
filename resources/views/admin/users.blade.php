@extends('layouts.admin')
@section('title', 'User Management - DEPED Region V Recruitment')
@push('styles')
<style>
.badge { display: inline-block; padding: 4px 10px; font-size: 11px; font-weight: 600; border-radius: 9999px; text-transform: uppercase; letter-spacing: 0.5px; }
.pagination { display: flex; justify-content: center; gap: 4px; margin-top: 20px; }
.pagination a, .pagination span { padding: 6px 12px; border: 1px solid var(--color-hairline-strong); border-radius: var(--rounded-md); text-decoration: none; font-size: 13px; color: var(--color-body); }
.pagination a:hover { background: var(--color-surface-strong); }
.pagination .active { background: var(--color-primary); color: white; border-color: var(--color-primary); }
</style>
@endpush
@section('content')
<div class="mb-lg">
    <h1 class="text-2xl font-semibold mb-1">User Management</h1>
    <p class="text-sm text-body">Manage system users, roles, and account status</p>
</div>

@if(session('success'))<script>showToast('{{ session('success') }}')</script>@endif

@if(session('error'))<script>showToast('{{ session('error') }}',true)</script>@endif

<form method="GET" action="{{ route('admin.users') }}" class="flex gap-3 mb-5 flex-wrap items-center">
    <input type="text" name="search" class="px-4 py-[10px] border border-hairline-strong rounded-md text-sm bg-surface-card h-10" style="min-width:280px;" placeholder="Search by name or email..." value="{{ request('search') }}">
    <select name="role" class="px-3 py-2 border border-hairline-strong rounded-md text-sm bg-surface-card h-10" onchange="this.form.submit()">
        <option value="">All Roles</option>
        <option value="applicant" {{ request('role') === 'applicant' ? 'selected' : '' }}>Applicant</option>
        <option value="hr" {{ request('role') === 'hr' ? 'selected' : '' }}>HR</option>
        <option value="board" {{ request('role') === 'board' ? 'selected' : '' }}>Board</option>
        <option value="admin" {{ request('role') === 'admin' ? 'selected' : '' }}>Admin</option>
    </select>
    <select name="status" class="px-3 py-2 border border-hairline-strong rounded-md text-sm bg-surface-card h-10" onchange="this.form.submit()">
        <option value="">All Status</option>
        <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active</option>
        <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
        <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
        <option value="suspended" {{ request('status') === 'suspended' ? 'selected' : '' }}>Suspended</option>
    </select>
    @if (request()->anyFilled(['search', 'role', 'status']))
        <a href="{{ route('admin.users') }}" class="px-[10px] py-1 text-xs font-medium border border-hairline-strong rounded-md cursor-pointer h-[30px] inline-flex items-center bg-surface-card text-ink no-underline hover:bg-surface-strong">Clear</a>
    @endif
</form>

<div class="bg-surface-card border border-hairline rounded-lg p-lg">
    <table class="w-full border-collapse">
        <thead>
            <tr>
                <th class="text-left px-3 py-3 text-xs font-semibold text-muted uppercase tracking-[0.5px] border-b border-hairline">Name</th>
                <th class="text-left px-3 py-3 text-xs font-semibold text-muted uppercase tracking-[0.5px] border-b border-hairline">Email</th>
                <th class="text-left px-3 py-3 text-xs font-semibold text-muted uppercase tracking-[0.5px] border-b border-hairline">Role</th>
                <th class="text-left px-3 py-3 text-xs font-semibold text-muted uppercase tracking-[0.5px] border-b border-hairline">Status</th>
                <th class="text-left px-3 py-3 text-xs font-semibold text-muted uppercase tracking-[0.5px] border-b border-hairline">Registered</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($users as $user)
                <tr class="hover:bg-canvas-soft transition-colors">
                    <td class="px-3 py-3 text-sm border-b border-hairline">
                        <div class="font-medium">{{ $user->first_name }} {{ $user->last_name }}</div>
                        @if ($user->extension_name)
                            <div class="text-xs text-muted">{{ $user->extension_name }}</div>
                        @endif
                    </td>
                    <td class="px-3 py-3 text-sm border-b border-hairline">{{ $user->email }}</td>
                    <td class="px-3 py-3 text-sm border-b border-hairline">
                        <form method="POST" action="{{ route('admin.users.update-role', $user) }}" class="flex items-center gap-[6px]">
                            @csrf
                            <select name="role" class="px-2 py-1 text-xs border border-hairline-strong rounded-md h-[30px] cursor-pointer bg-white" onchange="this.form.submit()">
                                <option value="applicant" {{ $user->role === 'applicant' ? 'selected' : '' }}>Applicant</option>
                                <option value="hr" {{ $user->role === 'hr' ? 'selected' : '' }}>HR</option>
                                <option value="board" {{ $user->role === 'board' ? 'selected' : '' }}>Board</option>
                                <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                            </select>
                        </form>
                    </td>
                    <td class="px-3 py-3 text-sm border-b border-hairline">
                        <span class="inline-block px-[10px] py-1 text-[11px] font-semibold rounded-pill uppercase tracking-[0.5px]" style="background:var(--color-status-{{ $user->status }}-bg);color:var(--color-status-{{ $user->status }}-text)">{{ ucfirst($user->status) }}</span>
                        <div class="flex gap-1 mt-1 flex-wrap">
                            @if ($user->status !== 'active')
                                <form method="POST" action="{{ route('admin.users.update-status', $user) }}" class="inline">
                                    @csrf
                                    <input type="hidden" name="status" value="active">
                                    <button type="submit" class="bg-[#dcfce7] text-[#166534] text-xs px-[10px] py-1 border-none rounded-md cursor-pointer">Activate</button>
                                </form>
                            @endif
                            @if ($user->status !== 'inactive' && $user->status !== 'suspended')
                                <form method="POST" action="{{ route('admin.users.update-status', $user) }}" class="inline">
                                    @csrf
                                    <input type="hidden" name="status" value="inactive">
                                    <button type="submit" class="bg-surface-card text-ink text-xs px-[10px] py-1 border border-hairline-strong rounded-md cursor-pointer">Deactivate</button>
                                </form>
                            @endif
                            @if ($user->status !== 'suspended')
                                <form method="POST" action="{{ route('admin.users.update-status', $user) }}" class="inline">
                                    @csrf
                                    <input type="hidden" name="status" value="suspended">
                                    <button type="submit" class="bg-[#fee2e2] text-[#dc2626] text-xs px-[10px] py-1 border-none rounded-md cursor-pointer">Suspend</button>
                                </form>
                            @endif
                        </div>
                    </td>
                    <td class="px-3 py-3 text-sm border-b border-hairline text-[13px] text-body">{{ $user->created_at->format('M d, Y') }}</td>
                </tr>
            @empty
                <tr><td colspan="5" class="text-center text-muted py-12 text-sm">No users found</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

@if ($users->hasPages())
    <div class="pagination">{{ $users->links() }}</div>
@endif
@endsection