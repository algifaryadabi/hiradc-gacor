<aside class="sidebar">
    <div class="logo-section">
        <div class="logo-circle">
            <img src="{{ asset('images/logo-semen-padang.png') }}" alt="SP">
        </div>
        <div class="logo-text">PT Semen Padang</div>
        <div class="logo-subtext">HIRADC System</div>
    </div>

    <nav class="nav-menu">
        <a href="{{ route('unit_pengelola.dashboard') }}"
            class="nav-item {{ request()->routeIs('unit_pengelola.dashboard') ? 'active' : '' }}">
            <i class="fas fa-th-large"></i>
            <span>Dashboard</span>
        </a>
        
        {{-- Show Form Saya & Buat Form Baru for staff with create access --}}
        @if(Auth::user()->can_create_documents == 1)
            <a href="{{ route('documents.index') }}"
                class="nav-item {{ request()->routeIs('documents.index') || request()->routeIs('documents.show') ? 'active' : '' }}">
                <i class="fas fa-folder-open"></i>
                <span>Form Saya</span>
            </a>
            <a href="{{ route('documents.create') }}"
                class="nav-item {{ request()->routeIs('documents.create') ? 'active' : '' }}">
                <i class="fas fa-plus-circle"></i>
                <span>Buat Form Baru</span>
            </a>
        @endif
        
        {{-- Review Dokumen: Only for Reviewer/Verifikator/Head --}}
        @if(Auth::user()->is_reviewer || Auth::user()->is_verifier || Auth::user()->isUnitPengelola())
            <a href="{{ route('unit_pengelola.documents.index') }}"
                class="nav-item {{ request()->routeIs('unit_pengelola.documents.*') ? 'active' : '' }}">
                <i class="fas fa-file-alt"></i>
                <span>Review Dokumen</span>
            </a>
        @endif
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
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fas fa-sign-out-alt"></i>
            Keluar
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
</aside>