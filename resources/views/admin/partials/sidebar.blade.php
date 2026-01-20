<div class="logo-section">
    <img src="{{ asset('images/logo-semen-padang.png') }}" alt="Logo">
    <div style="font-weight: 700; color: #c41e3a;">PT Semen Padang</div>
    <div style="font-size: 12px; color: #888;">Admin System</div>
</div>
<nav class="nav-menu">
    <a href="{{ route('admin.dashboard') }}" class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
        <i class="fas fa-th-large"></i> Dashboard
    </a>
    <a href="{{ route('admin.users') }}" class="nav-item {{ request()->routeIs('admin.users*') ? 'active' : '' }}">
        <i class="fas fa-users"></i> Manajemen User
    </a>
    <a href="{{ route('admin.master_data') }}" class="nav-item {{ request()->routeIs('admin.master_data*') ? 'active' : '' }}">
        <i class="fas fa-database"></i> Master Data
    </a>
</nav>
<div class="user-section">
    <div style="font-weight: 600; font-size: 14px;">{{ Auth::user()->nama_user ?? Auth::user()->username }}</div>
    <div style="font-size: 12px; opacity: 0.8;">{{ Auth::user()->role_jabatan_name }}</div>
    <a href="{{ route('logout') }}" class="logout-btn"
        onclick="event.preventDefault(); document.getElementById('logout-admin').submit();">Keluar</a>
    <form id="logout-admin" action="{{ route('logout') }}" method="POST" style="display:none;">@csrf</form>
</div>
