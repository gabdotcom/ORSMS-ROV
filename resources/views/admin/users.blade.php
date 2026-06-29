@extends('layouts.admin')
@section('title', 'User Management - DEPED Region V Recruitment')
@push('styles')
<style>
.badge { display: inline-block; padding: 4px 10px; font-size: 11px; font-weight: 600; border-radius: 9999px; text-transform: uppercase; letter-spacing: 0.5px; }
.pagination { display: flex; justify-content: center; gap: 4px; margin-top: 20px; }
.pagination a, .pagination span { padding: 6px 12px; border: 1px solid var(--color-hairline-strong); border-radius: var(--rounded-md); text-decoration: none; font-size: 13px; color: var(--color-body); }
.pagination a:hover { background: var(--color-surface-strong); }
.pagination .active { background: var(--color-primary); color: white; border-color: var(--color-primary); }
.modal-overlay { display: none; position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.5); z-index: 2000; padding: 20px; overflow-y: auto; cursor: pointer; }
.modal-overlay.show { display: flex; align-items: center; justify-content: center; }
.modal-content { background: white; border-radius: var(--rounded-lg); max-width: 520px; width: 100%; margin: auto; max-height: calc(100vh - 40px); overflow-y: auto; cursor: default; }
.modal-header { padding: 20px 24px; border-bottom: 1px solid var(--color-hairline); display: flex; justify-content: space-between; align-items: center; position: sticky; top: 0; background: white; z-index: 1; border-radius: var(--rounded-lg) var(--rounded-lg) 0 0; }
.modal-title { font-size: 18px; font-weight: 600; }
.modal-close { background: none; border: none; font-size: 28px; cursor: pointer; color: var(--color-body); line-height: 1; padding: 0; }
.modal-close:hover { color: var(--color-ink); }
.modal-body { padding: 24px; }
.modal-section { margin-bottom: 20px; }
.modal-section:last-child { margin-bottom: 0; }
.modal-section h3 { font-size: 13px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; color: var(--color-muted); margin-bottom: 12px; }
.detail-row { display: flex; justify-content: space-between; padding: 8px 0; border-bottom: 1px solid var(--color-hairline); font-size: 14px; }
.detail-row:last-child { border-bottom: none; }
.detail-label { color: var(--color-body); }
.detail-value { font-weight: 500; text-align: right; }
.pw-reset-card { background: var(--color-canvas-soft); border: 1px solid var(--color-hairline-strong); border-radius: var(--rounded-md); padding: 16px; }
.pw-reset-card h4 { font-size: 14px; font-weight: 600; margin-bottom: 12px; }
.form-group { margin-bottom: 12px; }
.form-group label { display: block; font-size: 13px; font-weight: 500; margin-bottom: 4px; }
.form-group input { width: 100%; padding: 8px 12px; border: 1px solid var(--color-hairline-strong); border-radius: var(--rounded-md); font-size: 14px; font-family: inherit; box-sizing: border-box; }
.form-group input:focus { outline: none; border-color: var(--color-primary); ring: 2px solid var(--color-primary); }
.pw-match-hint { font-size: 12px; margin-top: 2px; }
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
                <th class="text-left px-3 py-3 text-xs font-semibold text-muted uppercase tracking-[0.5px] border-b border-hairline">Actions</th>
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
                    <td class="px-3 py-3 text-sm border-b border-hairline">
                        <button type="button" onclick="openUserModal({{ $user->id }})" class="bg-surface-card text-ink text-xs font-medium px-[10px] py-1 border border-hairline-strong rounded-md cursor-pointer h-[30px] inline-flex items-center hover:bg-surface-strong transition-colors">View</button>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="text-center text-muted py-12 text-sm">No users found</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

@if ($users->hasPages())
    <div class="pagination">{{ $users->links() }}</div>
@endif

<!-- User Detail Modal -->
<div class="modal-overlay" id="userModal">
    <div class="modal-content" onclick="event.stopPropagation()">
        <div class="modal-header">
            <h2 class="modal-title" id="modalTitle">User Details</h2>
            <button class="modal-close" onclick="closeUserModal()">&times;</button>
        </div>
        <div class="modal-body" id="modalBody">
            <div class="modal-section">
                <h3>Account Information</h3>
                <div id="modalAccountInfo">
                    <div class="detail-row"><span class="detail-label">Name</span><span class="detail-value" id="mdName">—</span></div>
                    <div class="detail-row"><span class="detail-label">Email</span><span class="detail-value" id="mdEmail">—</span></div>
                    <div class="detail-row"><span class="detail-label">Role</span><span class="detail-value" id="mdRole">—</span></div>
                    <div class="detail-row"><span class="detail-label">Status</span><span class="detail-value" id="mdStatus">—</span></div>
                </div>
            </div>
            <div class="modal-section">
                <h3>Activity</h3>
                <div id="modalActivity">
                    <div class="detail-row"><span class="detail-label">Registered</span><span class="detail-value" id="mdCreated">—</span></div>
                    <div class="detail-row"><span class="detail-label">Last Updated</span><span class="detail-value" id="mdUpdated">—</span></div>
                    <div class="detail-row"><span class="detail-label">Applications</span><span class="detail-value" id="mdApps">—</span></div>
                </div>
            </div>
            <div class="modal-section">
                <h3>Reset Password</h3>
                <div class="pw-reset-card">
                    <h4>Set New Password</h4>
                    <form id="pwResetForm" method="POST" onsubmit="return submitPasswordReset(event)">
                        @csrf
                        <input type="hidden" id="pwUserId" name="user_id" value="">
                        <div class="form-group">
                            <label for="pwNew">New Password</label>
                            <input type="password" id="pwNew" name="password" minlength="8" required placeholder="Minimum 8 characters">
                        </div>
                        <div class="form-group">
                            <label for="pwConfirm">Confirm Password</label>
                            <input type="password" id="pwConfirm" name="password_confirmation" minlength="8" required placeholder="Re-enter new password">
                            <div class="pw-match-hint" id="pwMatchHint"></div>
                        </div>
                        <div class="mt-3">
                            <button type="submit" class="bg-primary text-white text-sm font-medium px-[18px] py-[10px] border-none rounded-md cursor-pointer h-10 hover:bg-primary-active transition-colors disabled:opacity-60 disabled:cursor-not-allowed" id="pwResetBtn" disabled>Reset Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
let currentUserId = null;

function openUserModal(userId) {
    currentUserId = userId;
    document.getElementById('userModal').classList.add('show');
    document.getElementById('pwUserId').value = userId;
    resetPasswordForm();

    fetch('/admin/users/' + userId)
        .then(r => r.json())
        .then(user => {
            document.getElementById('mdName').textContent = [user.first_name, user.middle_name, user.last_name, user.extension_name].filter(Boolean).join(' ') || '—';
            document.getElementById('mdEmail').textContent = user.email;
            document.getElementById('mdRole').textContent = user.role.charAt(0).toUpperCase() + user.role.slice(1);
            document.getElementById('mdStatus').innerHTML = '<span class="badge" style="background:var(--color-status-' + user.status + '-bg);color:var(--color-status-' + user.status + '-text)">' + user.status.charAt(0).toUpperCase() + user.status.slice(1) + '</span>';
            document.getElementById('mdCreated').textContent = user.created_at;
            document.getElementById('mdUpdated').textContent = user.updated_at;
            document.getElementById('mdApps').textContent = user.applications_count + ' submitted';
        })
        .catch(() => {
            document.getElementById('mdName').textContent = 'Error loading user';
        });
}

function closeUserModal() {
    document.getElementById('userModal').classList.remove('show');
    currentUserId = null;
}

document.getElementById('userModal')?.addEventListener('click', function(e) {
    if (e.target === this) closeUserModal();
});

function resetPasswordForm() {
    document.getElementById('pwNew').value = '';
    document.getElementById('pwConfirm').value = '';
    document.getElementById('pwMatchHint').textContent = '';
    document.getElementById('pwResetBtn').disabled = true;
}

function checkPasswordMatch() {
    const pw = document.getElementById('pwNew').value;
    const confirm = document.getElementById('pwConfirm').value;
    const hint = document.getElementById('pwMatchHint');
    const btn = document.getElementById('pwResetBtn');

    if (!pw || !confirm) {
        hint.textContent = '';
        btn.disabled = true;
        return;
    }
    if (pw !== confirm) {
        hint.textContent = 'Passwords do not match';
        hint.style.color = '#dc2626';
        btn.disabled = true;
        return;
    }
    if (pw.length < 8) {
        hint.textContent = 'Minimum 8 characters';
        hint.style.color = '#dc2626';
        btn.disabled = true;
        return;
    }
    hint.textContent = 'Passwords match';
    hint.style.color = '#16a34a';
    btn.disabled = false;
}

document.getElementById('pwNew').addEventListener('input', checkPasswordMatch);
document.getElementById('pwConfirm').addEventListener('input', checkPasswordMatch);

function submitPasswordReset(e) {
    e.preventDefault();
    const btn = document.getElementById('pwResetBtn');
    btn.disabled = true;
    btn.textContent = 'Resetting...';

    const form = document.getElementById('pwResetForm');
    const formData = new FormData();
    formData.append('password', document.getElementById('pwNew').value);
    formData.append('password_confirmation', document.getElementById('pwConfirm').value);
    formData.append('_token', document.querySelector('meta[name="csrf-token"]')?.content || '');

    fetch('/admin/users/' + currentUserId + '/reset-password', {
        method: 'POST',
        body: formData,
        headers: { 'Accept': 'application/json' }
    })
    .then(r => r.json().then(data => ({ status: r.ok, data })))
    .then(({ status, data }) => {
        if (status) {
            showToast(data.message || 'Password reset successfully.');
            closeUserModal();
        } else {
            const msg = data.errors ? Object.values(data.errors).flat().join(', ') : (data.message || 'Failed to reset password');
            showToast(msg, true);
            btn.disabled = false;
            btn.textContent = 'Reset Password';
        }
    })
    .catch(err => {
        showToast('Network error: ' + err.message, true);
        btn.disabled = false;
        btn.textContent = 'Reset Password';
    });
}
</script>
@endpush
@endsection