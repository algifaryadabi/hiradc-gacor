<div class="logo-section">
    <div class="logo-circle">
        <img src="{{ asset('images/logo-semen-padang.png') }}" alt="SP">
    </div>
    <div class="logo-text">PT Semen Padang</div>
    <div class="logo-subtext">Admin System</div>
</div>

<nav class="nav-menu">
    <a href="{{ route('admin.dashboard') }}"
        class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
        <i class="fas fa-th-large"></i>
        <span>Dashboard</span>
    </a>
    <a href="{{ route('admin.users') }}" class="nav-item {{ request()->routeIs('admin.users') ? 'active' : '' }}">
        <i class="fas fa-users"></i>
        <span>Manajemen User</span>
    </a>
    <a href="{{ route('admin.master_data') }}"
        class="nav-item {{ request()->routeIs('admin.master_data') ? 'active' : '' }}">
        <i class="fas fa-database"></i>
        <span>Master Data</span>
    </a>
</nav>

<div class="user-info">
    <div class="user-profile">
        <div class="user-avatar">
            {{ strtoupper(substr(Auth::user()->nama_user ?? Auth::user()->username, 0, 2)) }}
        </div>
        <div class="user-details">
            <div class="user-name">{{ Auth::user()->nama_user ?? Auth::user()->username }}</div>
            <div class="user-role">{{ Auth::user()->role_jabatan_name }}</div>
        </div>
    </div>
    <a href="{{ route('logout') }}" class="logout-btn"
        onclick="event.preventDefault(); document.getElementById('logout-admin').submit();">
        <i class="fas fa-sign-out-alt"></i> Keluar
    </a>
    <form id="logout-admin" action="{{ route('logout') }}" method="POST" style="display:none;">@csrf</form>
</div>