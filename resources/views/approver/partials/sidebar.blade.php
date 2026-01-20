<aside class="sidebar">
    <div class="logo-section">
        <div class="logo-circle">
            <img src="{{ asset('images/logo-semen-padang.png') }}" alt="SP">
        </div>
        <div class="logo-text">PT Semen Padang</div>
        <div class="logo-subtext">HIRADC System (Approver)</div>
    </div>

    <nav class="nav-menu">
        <a href="{{ route('approver.dashboard') }}" class="nav-item {{ Request::routeIs('approver.dashboard') ? 'active' : '' }}">
            <i class="fas fa-th-large"></i>
            <span>Dashboard</span>
        </a>
        <a href="{{ route('approver.check_documents') }}" class="nav-item {{ Request::routeIs('approver.check_documents') || Request::routeIs('approver.review') ? 'active' : '' }}">
            <i class="fas fa-file-contract"></i>
            <span>Cek Form</span>
            @if(isset($pendingCount) && $pendingCount > 0)
                <span class="badge">{{ $pendingCount }}</span>
            @endif
        </a>
    </nav>

    <div class="user-info-bottom">
        <div class="user-profile">
            <div class="user-avatar">
                {{ strtoupper(substr(Auth::user()->nama_user ?? Auth::user()->username, 0, 2)) }}
            </div>
            <div class="user-details">
                <div class="user-name">{{ Auth::user()->nama_user ?? Auth::user()->username }}</div>
                <div class="user-role">{{ Auth::user()->role_jabatan_name }}</div>
                <div class="user-role" style="font-weight: normal; opacity: 0.8;">
                    {{ Auth::user()->unit_or_dept_name }}
                </div>
            </div>
        </div>
        <a href="{{ route('logout') }}" class="logout-btn"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fas fa-sign-out-alt"></i>
            Keluar
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
</aside>
