<style>
    /* Unified Sidebar Styles - White Background, Red Theme */
    .sidebar {
        width: 280px;
        background: #ffffff;
        border-right: 2px solid #f0f0f0;
        position: fixed;
        height: 100vh;
        display: flex;
        flex-direction: column;
        z-index: 100;
        box-shadow: 2px 0 10px rgba(0, 0, 0, 0.05);
    }

    .logo-section {
        padding: 2rem 1.5rem;
        border-bottom: 2px solid #f0f0f0;
        text-align: center;
        background: #ffffff;
        position: relative;
    }

    .logo-section::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 2px;
        background: linear-gradient(90deg, transparent 0%, #c41e3a 50%, transparent 100%);
        opacity: 0.3;
    }

    .logo-circle {
        width: 90px;
        height: 90px;
        margin: 0 auto 1.25rem;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s;
    }

    .logo-circle:hover {
        transform: scale(1.05);
    }

    .logo-circle img {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
        filter: drop-shadow(0 2px 8px rgba(0, 0, 0, 0.15));
    }

    .logo-text {
        font-size: 1.125rem;
        font-weight: 700;
        color: #c41e3a;
        margin-bottom: 0.25rem;
        letter-spacing: -0.02em;
    }

    .logo-subtext {
        font-size: 0.75rem;
        color: #666;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.1em;
    }

    .nav-menu {
        flex: 1;
        padding: 1.5rem 0;
        overflow-y: auto;
        scrollbar-width: thin;
        scrollbar-color: #c41e3a #f0f0f0;
    }

    .nav-menu::-webkit-scrollbar {
        width: 6px;
    }

    .nav-menu::-webkit-scrollbar-track {
        background: #f0f0f0;
    }

    .nav-menu::-webkit-scrollbar-thumb {
        background: #c41e3a;
        border-radius: 9999px;
    }

    .nav-item {
        padding: 1rem 1.5rem;
        margin: 0.25rem 1rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        cursor: pointer;
        transition: all 0.2s;
        color: #c41e3a;
        font-size: 0.9375rem;
        font-weight: 500;
        text-decoration: none;
        position: relative;
        border-radius: 0.75rem;
    }

    .nav-item:hover {
        background: #f3f4f6;
        transform: translateX(4px);
    }

    .nav-item.active {
        background: #c41e3a;
        color: white;
        font-weight: 600;
        box-shadow: 0 2px 8px rgba(196, 30, 58, 0.3);
    }

    .nav-item.active::before {
        content: '';
        position: absolute;
        left: 0;
        top: 50%;
        transform: translateY(-50%);
        width: 4px;
        height: 60%;
        background: white;
        border-radius: 0 0.5rem 0.5rem 0;
    }

    .nav-item i {
        width: 20px;
        text-align: center;
        font-size: 1.125rem;
        transition: transform 0.2s;
    }

    .nav-item:hover i {
        transform: scale(1.1);
    }

    .nav-item .badge {
        margin-left: auto;
        background: #c41e3a;
        color: white;
        padding: 0.125rem 0.5rem;
        border-radius: 9999px;
        font-size: 0.75rem;
        font-weight: 600;
        min-width: 20px;
        text-align: center;
    }

    .nav-item.active .badge {
        background: white;
        color: #c41e3a;
    }

    .user-info,
    .user-info-bottom {
        padding: 1.5rem;
        border-top: 2px solid #f0f0f0;
        background: #ffffff;
        position: relative;
    }

    .user-info::before,
    .user-info-bottom::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 2px;
        background: linear-gradient(90deg, transparent 0%, #c41e3a 50%, transparent 100%);
        opacity: 0.3;
    }

    .user-profile {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        margin-bottom: 1rem;
        position: relative;
        z-index: 1;
    }

    .user-avatar {
        width: 48px;
        height: 48px;
        background: linear-gradient(135deg, #c41e3a 0%, #e63950 100%);
        border-radius: 9999px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 700;
        font-size: 1.125rem;
        flex-shrink: 0;
        box-shadow: 0 4px 12px rgba(196, 30, 58, 0.2);
        border: 2px solid #fff;
    }

    .user-details {
        flex: 1;
        min-width: 0;
    }

    .user-name {
        font-weight: 600;
        font-size: 0.9375rem;
        color: #c41e3a;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        margin-bottom: 2px;
    }

    .user-role {
        font-size: 0.75rem;
        color: #c41e3a;
        font-weight: 600;
    }

    .logout-btn {
        width: 100%;
        padding: 0.75rem 1rem;
        background: #fff;
        color: #c41e3a;
        border: 2px solid #c41e3a;
        border-radius: 0.75rem;
        font-size: 0.875rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        text-decoration: none;
        position: relative;
        z-index: 1;
    }

    .logout-btn:hover {
        background: #c41e3a;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(196, 30, 58, 0.3);
    }
</style>

<aside class="sidebar">
    <div class="logo-section">
        <div class="logo-circle">
            <img src="{{ asset('images/logo-semen-padang.png') }}" alt="SP">
        </div>
        <div class="logo-text">PT Semen Padang</div>
        <div class="logo-subtext">HIRADC System</div>
    </div>

    <nav class="nav-menu">
        {{-- Admin Menu --}}
        @if(Auth::user()->isAdmin())
            <a href="{{ route('admin.dashboard') }}"
                class="nav-item {{ request()->routeIs('admin.dashboard') || request()->routeIs('user.dashboard') ? 'active' : '' }}">
                <i class="fas fa-th-large"></i>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('admin.users') }}" class="nav-item {{ request()->routeIs('admin.users*') ? 'active' : '' }}">
                <i class="fas fa-users-cog"></i>
                <span>Manajemen User</span>
            </a>
            <a href="{{ route('admin.master_data') }}"
                class="nav-item {{ request()->routeIs('admin.master_data') || request()->routeIs('admin.direktorat*') || request()->routeIs('admin.departemen*') || request()->routeIs('admin.unit*') || request()->routeIs('admin.seksi*') || request()->routeIs('admin.probis*') ? 'active' : '' }}">
                <i class="fas fa-database"></i>
                <span>Master Data</span>
            </a>
        @endif

        {{-- Direksi Menu --}}
        @if(Auth::user()->isDirektur() && !Auth::user()->isAdmin())
            <a href="{{ route('direksi.dashboard') }}"
                class="nav-item {{ request()->routeIs('direksi.dashboard') ? 'active' : '' }}">
                <i class="fas fa-th-large"></i>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('direksi.check_documents') }}"
                class="nav-item {{ request()->routeIs('direksi.check_documents') || request()->routeIs('direksi.review') ? 'active' : '' }}">
                <i class="fas fa-file-contract"></i>
                <span>Cek Dokumen</span>
                @if(isset($pendingCount) && $pendingCount > 0)
                    <span class="badge">{{ $pendingCount }}</span>
                @endif
            </a>
        @endif

        {{-- Staff Unit Pengelola (Reviewer/Verifier Only - Not Kepala) --}}
        @if((Auth::user()->is_reviewer || Auth::user()->is_verifier) && !Auth::user()->isUnitPengelola() && !Auth::user()->isAdmin())
            <a href="{{ route('unit_pengelola.dashboard') }}"
                class="nav-item {{ request()->routeIs('unit_pengelola.dashboard') ? 'active' : '' }}">
                <i class="fas fa-th-large"></i>
                <span>Dashboard</span>
            </a>

            {{-- Form Saya & Buat Form Baru if they have create access --}}
            @if(Auth::user()->can_create_documents == 1)
                <a href="{{ route('documents.index') }}"
                    class="nav-item {{ request()->routeIs('documents.index') || request()->routeIs('documents.show') ? 'active' : '' }}">
                    <i class="fas fa-folder-open"></i>
                    <span>Form Saya</span>
                    @if(isset($revisionCount) && $revisionCount > 0)
                        <span class="badge">{{ $revisionCount }}</span>
                    @endif
                </a>
                <a href="{{ route('documents.create') }}"
                    class="nav-item {{ request()->routeIs('documents.create') ? 'active' : '' }}">
                    <i class="fas fa-plus-circle"></i>
                    <span>Buat Form Baru</span>
                </a>
            @endif

            {{-- Review Dokumen for Staff Reviewer/Verifier --}}
            <a href="{{ route('unit_pengelola.documents.index') }}"
                class="nav-item {{ request()->routeIs('unit_pengelola.documents.*') ? 'active' : '' }}">
                <i class="fas fa-file-alt"></i>
                <span>Review Dokumen</span>
            </a>
        @endif

        {{-- Kepala Departemen Menu --}}
        @if(Auth::user()->isKepalaDepartemen() && !Auth::user()->isAdmin())
            <a href="{{ route('kepala_departemen.dashboard') }}"
                class="nav-item {{ request()->routeIs('kepala_departemen.dashboard') ? 'active' : '' }}">
                <i class="fas fa-th-large"></i>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('kepala_departemen.check_documents') }}"
                class="nav-item {{ request()->routeIs('kepala_departemen.check_documents') || request()->routeIs('kepala_departemen.review') ? 'active' : '' }}">
                <i class="fas fa-file-contract"></i>
                <span>Cek Dokumen</span>
                @if(isset($pendingCount) && $pendingCount > 0)
                    <span class="badge">{{ $pendingCount }}</span>
                @endif
            </a>
        @endif

        {{-- Unit Pengelola Menu --}}
        @if(Auth::user()->isUnitPengelola() && !Auth::user()->isAdmin())
            <a href="{{ route('unit_pengelola.dashboard') }}"
                class="nav-item {{ request()->routeIs('unit_pengelola.dashboard') ? 'active' : '' }}">
                <i class="fas fa-th-large"></i>
                <span>Dashboard</span>
            </a>

            {{-- Form Saya & Buat Form Baru for staff with create access --}}
            @if(Auth::user()->can_create_documents == 1)
                <a href="{{ route('documents.index') }}"
                    class="nav-item {{ request()->routeIs('documents.index') || request()->routeIs('documents.show') ? 'active' : '' }}">
                    <i class="fas fa-folder-open"></i>
                    <span>Form Saya</span>
                    @if(isset($revisionCount) && $revisionCount > 0)
                        <span class="badge">{{ $revisionCount }}</span>
                    @endif
                </a>
                <a href="{{ route('documents.create') }}"
                    class="nav-item {{ request()->routeIs('documents.create') ? 'active' : '' }}">
                    <i class="fas fa-plus-circle"></i>
                    <span>Buat Form Baru</span>
                </a>
            @endif

            {{-- Review Dokumen: For Kepala Unit Pengelola --}}
            <a href="{{ route('unit_pengelola.documents.index') }}"
                class="nav-item {{ request()->routeIs('unit_pengelola.documents.*') ? 'active' : '' }}">
                <i class="fas fa-file-alt"></i>
                <span>Review Dokumen</span>
            </a>
        @endif

        {{-- Kepala Unit (Approver) Menu --}}
        @if(Auth::user()->isKepalaUnit() && !Auth::user()->isUnitPengelola() && !Auth::user()->isAdmin())
            <a href="{{ route('approver.dashboard') }}"
                class="nav-item {{ request()->routeIs('approver.dashboard') ? 'active' : '' }}">
                <i class="fas fa-th-large"></i>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('approver.check_documents') }}"
                class="nav-item {{ request()->routeIs('approver.check_documents') || request()->routeIs('approver.review') ? 'active' : '' }}">
                <i class="fas fa-file-contract"></i>
                <span>Cek Form</span>
                @if(isset($pendingCount) && $pendingCount > 0)
                    <span class="badge">{{ $pendingCount }}</span>
                @endif
            </a>
        @endif

        {{-- Regular User Menu (Not Admin, Not Kepala, Not Unit Pengelola, Not Reviewer/Verifier) --}}
        @if(!Auth::user()->isAdmin() && !Auth::user()->isKepalaUnit() && !Auth::user()->isKepalaDepartemen() && !Auth::user()->isDirektur() && !Auth::user()->isUnitPengelola() && !Auth::user()->is_reviewer && !Auth::user()->is_verifier)
            <a href="{{ route('user.dashboard') }}"
                class="nav-item {{ request()->routeIs('user.dashboard') || request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="fas fa-th-large"></i>
                <span>Dashboard</span>
            </a>

            @if(Auth::user()->can_create_documents == 1)
                <a href="{{ route('documents.index') }}"
                    class="nav-item {{ request()->routeIs('documents.index') ? 'active' : '' }}">
                    <i class="fas fa-folder-open"></i>
                    <span>Form Saya</span>
                    @if(isset($revisionCount) && $revisionCount > 0)
                        <span class="badge">{{ $revisionCount }}</span>
                    @endif
                </a>
                <a href="{{ route('documents.create') }}"
                    class="nav-item {{ request()->routeIs('documents.create') ? 'active' : '' }}">
                    <i class="fas fa-plus-circle"></i>
                    <span>Buat Form Baru</span>
                </a>
            @endif
        @endif
    </nav>

    <div class="user-info-bottom">
        <div class="user-profile">
            <div class="user-avatar">
                {{ strtoupper(substr(Auth::user()->nama_user ?? Auth::user()->username, 0, 2)) }}
            </div>
            <div class="user-details">
                <div class="user-name">{{ Auth::user()->nama_user ?? Auth::user()->username }}</div>
                <div class="user-role">{{ Auth::user()->role_jabatan_name }}</div>
                @if(Auth::user()->unit_or_dept_name)
                    <div class="user-role" style="font-weight: normal; opacity: 0.8; color: #666;">
                        {{ Auth::user()->unit_or_dept_name }}
                    </div>
                @endif
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