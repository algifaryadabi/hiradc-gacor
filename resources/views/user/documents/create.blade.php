<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Form HIRADC | HIRADC System - PT Semen Padang</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #c41e3a;
            --primary-hover: #a01729;
            --primary-dark: #9a1829;
            --bg-color: #f1f5f9;
            --sidebar-width: 280px;
            --sidebar-bg: #5b6fd8;
            --card-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px -1px rgba(0, 0, 0, 0.1);
            --shadow-colored: 0 10px 25px -5px rgba(196, 30, 58, 0.15);
            --border-radius: 16px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: var(--bg-color);
            background-image:
                radial-gradient(at 0% 0%, rgba(196, 30, 58, 0.05) 0px, transparent 50%),
                radial-gradient(at 100% 100%, rgba(59, 130, 246, 0.05) 0px, transparent 50%);
            background-attachment: fixed;
            color: #0f172a;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            min-height: 100vh;
        }

        .container {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar - Consistent with other pages */
        .sidebar {
            width: 280px;
            background: var(--sidebar-bg);
            border-right: 1px solid rgba(255, 255, 255, 0.1);
            position: fixed;
            height: 100vh;
            display: flex;
            flex-direction: column;
            z-index: 50;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.1);
        }

        .logo-section {
            padding: 32px 24px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.15);
            text-align: center;
            background: transparent;
            position: relative;
        }

        .logo-section::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent 0%, rgba(255, 255, 255, 0.2) 50%, transparent 100%);
        }

        .logo-circle {
            width: 90px;
            height: 90px;
            margin: 0 auto 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
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
            font-size: 18px;
            font-weight: 700;
            color: white;
            margin-bottom: 4px;
            letter-spacing: -0.02em;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.15);
        }

        .logo-subtext {
            font-size: 12px;
            color: rgba(255, 255, 255, 0.9);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.1em;
        }

        .nav-menu {
            flex: 1;
            padding: 24px 0;
            overflow-y: auto;
            scrollbar-width: thin;
            scrollbar-color: rgba(255, 255, 255, 0.3) transparent;
        }

        .nav-menu::-webkit-scrollbar {
            width: 6px;
        }

        .nav-menu::-webkit-scrollbar-track {
            background: transparent;
        }

        .nav-menu::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.3);
            border-radius: 9999px;
        }

        .nav-item {
            padding: 16px 24px;
            margin: 4px 16px;
            display: flex;
            align-items: center;
            gap: 12px;
            cursor: pointer;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            color: rgba(255, 255, 255, 0.85);
            font-size: 15px;
            font-weight: 500;
            text-decoration: none;
            position: relative;
            border-radius: 12px;
        }

        .nav-item:hover {
            background: rgba(255, 255, 255, 0.15);
            color: white;
            transform: translateX(4px);
        }

        .nav-item.active {
            background: rgba(255, 255, 255, 0.25);
            color: white;
            font-weight: 600;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
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
            border-radius: 0 8px 8px 0;
        }

        .nav-item i {
            width: 20px;
            text-align: center;
            font-size: 18px;
            transition: transform 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .nav-item:hover i {
            transform: scale(1.1);
        }

        .badge {
            position: absolute;
            right: 20px;
            background: #c41e3a;
            color: white;
            font-size: 10px;
            padding: 4px 8px;
            border-radius: 10px;
            font-weight: 600;
        }

        .user-info-bottom {
            padding: 24px;
            border-top: 1px solid rgba(255, 255, 255, 0.15);
            background: transparent;
            position: relative;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 16px;
            position: relative;
            z-index: 1;
        }

        .user-avatar {
            width: 48px;
            height: 48px;
            background: white;
            border-radius: 9999px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #5b6fd8;
            font-weight: 700;
            font-size: 18px;
            flex-shrink: 0;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            border: 2px solid rgba(255, 255, 255, 0.2);
        }

        .user-details {
            flex: 1;
            min-width: 0;
        }

        .user-name {
            font-weight: 600;
            font-size: 15px;
            color: white;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            margin-bottom: 2px;
        }

        .user-role {
            font-size: 12px;
            color: rgba(255, 255, 255, 0.85);
            font-weight: 500;
        }

        .logout-btn {
            width: 100%;
            padding: 12px 16px;
            background: rgba(255, 255, 255, 0.15);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.25);
            border-radius: 12px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            text-decoration: none;
            position: relative;
            z-index: 1;
            backdrop-filter: blur(10px);
        }

        .logout-btn:hover {
            background: rgba(255, 255, 255, 0.25);
            border-color: rgba(255, 255, 255, 0.4);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: 280px;
        }

        .header {
            background: linear-gradient(135deg, #ffffff 0%, #fef2f3 100%);
            padding: 32px 40px;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 40;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px -1px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        .header::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: linear-gradient(90deg, transparent 0%, var(--primary-color) 50%, transparent 100%);
            opacity: 0.3;
        }

        .header h1 {
            font-size: 28px;
            font-weight: 700;
            color: #0f172a;
            letter-spacing: -0.02em;
        }

        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
            font-weight: 600;
            color: #64748b;
            text-decoration: none;
            transition: all 0.2s;
            padding: 8px 16px;
            border-radius: 10px;
        }

        .btn-back:hover {
            color: var(--primary-color);
            background: rgba(196, 30, 58, 0.05);
        }

        .content-area {
            padding: 40px;
            max-width: 1200px;
            margin: 0 auto;
        }

        /* Document Form Cards */
        .doc-card {
            background: linear-gradient(135deg, #ffffff 0%, #fef2f3 100%);
            border-radius: var(--border-radius);
            box-shadow: var(--card-shadow);
            margin-bottom: 30px;
            overflow: hidden;
            border: 1px solid #e2e8f0;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .doc-card:hover {
            box-shadow: var(--shadow-colored);
        }

        .card-header {
            padding: 24px 30px;
            background: linear-gradient(to right, #fff1f2, #fff);
            border-bottom: 1px solid #fce7f3;
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .header-icon {
            width: 48px;
            height: 48px;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            color: white;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            box-shadow: 0 4px 12px rgba(196, 30, 58, 0.3);
        }

        .header-title h2 {
            font-size: 17px;
            font-weight: 700;
            color: #0f172a;
            letter-spacing: -0.01em;
        }

        .header-title p {
            font-size: 13px;
            color: #64748b;
            margin-top: 4px;
            font-weight: 500;
        }

        .card-body {
            padding: 32px;
        }

        /* Grid Layouts */
        .form-grid-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 24px;
        }

        .form-grid-1 {
            display: grid;
            grid-template-columns: 1fr;
            gap: 24px;
        }

        /* Hide scrollbar for Chrome, Safari and Opera */
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        /* Hide scrollbar for IE, Edge and Firefox */
        .no-scrollbar {
            -ms-overflow-style: none;
            /* IE and Edge */
            scrollbar-width: none;
            /* Firefox */
        }

        /* Hide Number Input Spinners */
        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type=number] {
            -moz-appearance: textfield;
        }

        /* Custom Scrollbar for Program Kerja Table */
        .program-kerja-scroll::-webkit-scrollbar {
            height: 10px;
        }

        .program-kerja-scroll::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 10px;
        }

        .program-kerja-scroll::-webkit-scrollbar-thumb {
            background: #5c7cfa;
            border-radius: 10px;
        }

        .program-kerja-scroll::-webkit-scrollbar-thumb:hover {
            background: #4c6ef5;
        }

        /* Form Controls - Modern Design */
        .form-group {
            margin-bottom: 24px;
        }

        .form-label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: #0f172a;
            margin-bottom: 10px;
            letter-spacing: -0.01em;
        }

        .required {
            color: var(--primary-color);
            margin-left: 3px;
            font-weight: 700;
        }

        .form-control {
            width: 100%;
            padding: 14px 16px;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            font-size: 14px;
            font-family: 'Plus Jakarta Sans', sans-serif;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            background: white;
            color: #0f172a;
            font-weight: 500;
        }

        .form-control:hover {
            border-color: #cbd5e1;
        }

        .form-control:disabled,
        .form-control:read-only {
            background: #f8fafc;
            color: #64748b;
            cursor: not-allowed;
            border-color: #e2e8f0;
        }

        /* Select elements should have pointer cursor when enabled */
        select.form-control:not(:disabled) {
            cursor: pointer;
            background: white;
            color: #0f172a;
        }

        select.form-control:disabled {
            cursor: not-allowed;
            background: #f8fafc;
            color: #64748b;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary-color);
            background: white;
            box-shadow: 0 0 0 3px rgba(196, 30, 58, 0.1);
        }

        .form-control::placeholder {
            color: #94a3b8;
            font-weight: 400;
        }

        textarea.form-control {
            min-height: 120px;
            resize: vertical;
            line-height: 1.6;
        }

        select.form-control {
            appearance: none;
            cursor: pointer;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%2364748b'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 14px center;
            background-size: 18px;
            padding-right: 44px;
        }

        small {
            display: block;
            margin-top: 8px;
            color: #64748b;
            font-size: 13px;
            font-weight: 500;
        }

        /* Toggle Group */
        .toggle-group {
            display: flex;
            gap: 12px;
            padding: 6px;
            background: #f1f5f9;
            border-radius: 12px;
            width: fit-content;
        }

        .toggle-btn {
            padding: 12px 24px;
            border: none;
            border-radius: 10px;
            background: transparent;
            color: #64748b;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.2s;
        }

        .toggle-btn.active {
            background: white;
            color: var(--primary-color);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }

        /* Checkbox Groups */
        .checkbox-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 16px;
        }

        .checkbox-card {
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 16px;
            transition: all 0.2s;
            cursor: pointer;
            display: flex;
            align-items: start;
            gap: 12px;
            background: white;
        }

        .checkbox-card:hover {
            border-color: var(--primary-color);
            background: #fef2f3;
            box-shadow: 0 2px 8px rgba(196, 30, 58, 0.1);
        }

        .checkbox-card input[type="checkbox"] {
            margin-top: 2px;
            accent-color: var(--primary-color);
            width: 18px;
            height: 18px;
            flex-shrink: 0;
            cursor: pointer;
        }

        .checkbox-card label {
            cursor: pointer;
            font-size: 14px;
            font-weight: 500;
            color: #0f172a;
            line-height: 1.5;
        }

        /* Risk Matrix */
        .risk-result-box {
            background: linear-gradient(135deg, #1e293b 0%, #334155 100%);
            color: white;
            padding: 28px;
            border-radius: 16px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.2);
        }

        .risk-score {
            font-size: 48px;
            font-weight: 800;
            line-height: 1;
            margin-bottom: 12px;
            letter-spacing: -0.02em;
        }

        .risk-level {
            display: inline-block;
            padding: 8px 20px;
            border-radius: 24px;
            background: rgba(255, 255, 255, 0.2);
            font-size: 13px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            backdrop-filter: blur(10px);
        }

        /* Action Bar */
        .action-bar {
            position: sticky;
            bottom: 24px;
            background: white;
            padding: 24px 32px;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
            margin-top: 48px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border: 1px solid #e2e8f0;
            z-index: 30;
        }

        .action-info {
            display: flex;
            align-items: center;
            gap: 12px;
            color: #0f172a;
            font-weight: 500;
            font-size: 14px;
        }

        .action-info i {
            font-size: 20px;
        }

        .action-buttons {
            display: flex;
            gap: 12px;
        }

        .btn {
            padding: 14px 28px;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            letter-spacing: -0.01em;
        }

        .btn-secondary {
            background: #f1f5f9;
            color: #475569;
            border: 1px solid #e2e8f0;
        }

        .btn-secondary:hover {
            background: #e2e8f0;
            color: #0f172a;
            border-color: #cbd5e1;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            color: white;
            box-shadow: 0 4px 12px rgba(196, 30, 58, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(196, 30, 58, 0.4);
        }

        .hidden {
            display: none;
        }

        .mt-4 {
            margin-top: 1.5rem;
        }

        /* Section Headers */
        h3 {
            font-size: 15px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            font-weight: 700;
            color: #475569;
            margin-bottom: 20px;
            border-bottom: 2px solid #e2e8f0;
            padding-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        h3 i {
            font-size: 16px;
        }

        /* Alert Messages */
        .alert {
            padding: 16px 20px;
            border-radius: 12px;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 500;
            font-size: 14px;
        }

        .alert-success {
            background: #ecfdf5;
            border: 1px solid #10b981;
            color: #065f46;
        }

        .alert-error {
            background: #fef2f2;
            border: 1px solid #ef4444;
            color: #991b1b;
        }
    </style>
</head>

<body>
    <!-- Form Type Selection Modal -->
    <div id="formTypeModal"
        style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(15, 23, 42, 0.75); z-index: 9999; align-items: center; justify-content: center; backdrop-filter: blur(8px); animation: fadeIn 0.3s ease-out;">
        <div
            style="background: white; border-radius: 28px; padding: 48px; max-width: 750px; width: 95%; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25); position: relative; animation: modalSlideIn 0.4s cubic-bezier(0.16, 1, 0.3, 1);">

            <!-- Close Button -->
            <button onclick="window.location.href='{{ route('documents.index') }}'" type="button"
                title="Tutup / Kembali"
                style="position: absolute; top: 24px; right: 24px; width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 50%; color: #64748b; font-size: 16px; cursor: pointer; transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);">
                <i class="fas fa-times"></i>
            </button>
            <style>
                button[title="Tutup / Kembali"]:hover {
                    background: #fee2e2 !important;
                    border-color: #fecaca !important;
                    color: #ef4444 !important;
                    transform: rotate(90deg) scale(1.1);
                }

                .form-type-card:hover {
                    transform: translateY(-8px);
                    box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
                    border-color: var(--primary-light) !important;
                }

                .form-type-card:hover .card-icon {
                    transform: scale(1.1) rotate(-5deg);
                }

                .form-type-card:hover .action-text {
                    color: var(--primary);
                    gap: 10px;
                }
            </style>

            <div style="text-align: center; margin-bottom: 40px;">
                <div
                    style="width: 72px; height: 72px; background: linear-gradient(135deg, #3b82f6, #2563eb); border-radius: 20px; margin: 0 auto 24px; display: flex; align-items: center; justify-content: center; box-shadow: 0 10px 20px rgba(37, 99, 235, 0.2); transform: rotate(-5deg);">
                    <i class="fas fa-layer-group" style="font-size: 32px; color: white;"></i>
                </div>
                <h2
                    style="font-size: 26px; font-weight: 800; color: #0f172a; margin-bottom: 12px; letter-spacing: -0.025em;">
                    Pilih Kategori Dokumen</h2>
                <p style="color: #64748b; font-size: 15px; max-width: 400px; margin: 0 auto; line-height: 1.6;">
                    Silakan pilih kategori dokumen HIRADC yang ingin Anda buat untuk memulai.
                </p>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px;">
                <!-- K3/KO/Lingkungan Option -->
                <div onclick="selectFormType('SHE')" class="form-type-card"
                    style="border: 2px solid #e2e8f0; border-radius: 24px; padding: 32px; cursor: pointer; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); text-align: left; background: white; position: relative; overflow: hidden;">

                    <div class="card-icon"
                        style="width: 56px; height: 56px; background: linear-gradient(135deg, #10b981, #059669); border-radius: 16px; margin-bottom: 24px; display: flex; align-items: center; justify-content: center; box-shadow: 0 8px 16px rgba(16, 185, 129, 0.2); transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);">
                        <i class="fas fa-leaf" style="font-size: 24px; color: white;"></i>
                    </div>

                    <h3 style="font-size: 18px; font-weight: 700; color: #0f172a; margin-bottom: 8px;">K3, KO &
                        Lingkungan</h3>
                    <p style="font-size: 13px; color: #64748b; line-height: 1.6; margin-bottom: 24px; height: 42px;">
                        Dokumen terkait Keselamatan, Kesehatan Kerja, dan Lingkungan.
                    </p>

                    <div class="action-text"
                        style="display: inline-flex; align-items: center; gap: 6px; color: #059669; font-size: 13px; font-weight: 700; transition: all 0.3s;">
                        Mulai Buat <i class="fas fa-arrow-right"></i>
                    </div>
                </div>

                <!-- Pengamanan Option -->
                <div onclick="selectFormType('Security')" class="form-type-card"
                    style="border: 2px solid #e2e8f0; border-radius: 24px; padding: 32px; cursor: pointer; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); text-align: left; background: white; position: relative; overflow: hidden;">

                    <div class="card-icon"
                        style="width: 56px; height: 56px; background: linear-gradient(135deg, #f97316, #ea580c); border-radius: 16px; margin-bottom: 24px; display: flex; align-items: center; justify-content: center; box-shadow: 0 8px 16px rgba(234, 88, 12, 0.2); transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);">
                        <i class="fas fa-shield-alt" style="font-size: 24px; color: white;"></i>
                    </div>

                    <h3 style="font-size: 18px; font-weight: 700; color: #0f172a; margin-bottom: 8px;">Pengamanan</h3>
                    <p style="font-size: 13px; color: #64748b; line-height: 1.6; margin-bottom: 24px; height: 42px;">
                        Dokumen terkait sistem dan operasional pengamanan perusahaan.
                    </p>

                    <div class="action-text"
                        style="display: inline-flex; align-items: center; gap: 6px; color: #ea580c; font-size: 13px; font-weight: 700; transition: all 0.3s;">
                        Mulai Buat <i class="fas fa-arrow-right"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        @keyframes modalSlideIn {
            from {
                opacity: 0;
                transform: translateY(-20px) scale(0.95);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .form-type-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.1);
        }

        .form-type-card:hover:first-of-type {
            border-color: #10b981;
            background: #ecfdf5;
        }

        .form-type-card:hover:last-of-type {
            border-color: #ef4444;
            background: #fef2f2;
        }
    </style>

    <div class="container">
        <!-- Sidebar -->
        <!-- Sidebar -->
        @include('partials.sidebar')

        <!-- Main Content -->
        <main class="main-content">
            <div class="header">
                <div style="display: flex; align-items: center; gap: 20px;">
                    <a href="{{ route('documents.index') }}" class="btn-back"><i class="fas fa-arrow-left"></i>
                        Kembali</a>
                    <div style="height: 24px; width: 1px; background: #e5e7eb;"></div>
                    <h1 id="formTitle">Buat Form Baru</h1>
                </div>
            </div>

            <div class="content-area">
                <form id="hiradcForm" action="{{ route('documents.store') }}" method="POST">
                    @csrf
                    <!-- Hidden Metadata -->
                    <input type="hidden" id="auto_probis_value"
                        value="{{ isset($user->seksi->probis) ? $user->seksi->probis->nama_probis : (isset($user->unit->probis) ? $user->unit->probis->nama_probis : '') }}">
                    <input type="hidden" id="form_type" name="form_type" value="">
                    <input type="hidden" id="judul_dokumen" name="judul_dokumen" value="">

                    <!-- Messages -->
                    @if(session('success'))
                        <div
                            style="background:#ecfdf5; border:1px solid #10b981; color:#065f46; padding:15px; border-radius:8px; margin-bottom:20px;">
                            <i class="fas fa-check-circle"></i> {{ session('success') }}
                        </div>
                    @endif
                    @if($errors->any())
                        <div
                            style="background:#fef2f2; border:1px solid #ef4444; color:#991b1b; padding:15px; border-radius:8px; margin-bottom:20px;">
                            <ul>@foreach($errors->all() as $error) <li>{{ $error }}</li> @endforeach</ul>
                        </div>
                    @endif

                    <div id="items-container">
                        <!-- Items will be injected here by JS -->
                    </div>


                    <div style="text-align: center; margin-bottom: 40px;">
                        <button type="button" class="btn btn-secondary" onclick="addItem()"
                            style="border: 2px dashed #cbd5e1; background: white; width: 100%; justify-content: center; padding: 20px;">
                            <i class="fas fa-plus-circle" style="font-size: 18px; color: var(--primary-color);"></i>
                            Tambah Kegiatan / Aktivitas Lain
                        </button>
                    </div>

                    <!-- Action Bar (Static Position) -->
                    <div class="action-bar">
                        <div class="action-info">
                            <i class="fas fa-check-circle" style="color: #10b981;"></i>
                            <span>Pastikan semua data sudah terisi dengan benar.</span>
                        </div>
                        <div class="action-buttons">
                            <a href="{{ route('documents.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times"></i> Batal
                            </a>
                            <input type="hidden" name="action" id="action_input" value="draft">

                            <!-- Save Draft Button -->
                            <button type="button" class="btn btn-secondary" onclick="validateAndSubmit('draft')"
                                style="border: 2px solid #cbd5e1; background: #f8fafc; color: #475569;">
                                <i class="fas fa-save"></i> Simpan Draft
                            </button>

                            <!-- Submit Button -->
                            <button type="button" id="btnSubmit" class="btn btn-primary"
                                onclick="validateAndSubmit('submit')">
                                <i class="fas fa-paper-plane"></i> Kirim ke Atasan
                            </button>
                        </div>
                    </div>



                </form>
            </div>
        </main>
    </div>

    <!-- ITEM TEMPLATE (Hidden) -->
    <template id="item-template">
        @include('user.documents.partials.item-form-template', ['index' => '{index}'])
    </template>

    <!-- PUK/PMK Form Template -->
    <template id="program-form-template">
        @include('user.documents.partials.program-form-template')
    </template>

    <script>
        let itemIndex = 0;
        const autoProbis = document.getElementById('auto_probis_value').value;

        // Static Options Data
        const userUnitId = {{ Auth::user()->id_unit }};

        // Complete Categories Data
        const allCategories = {
            'K3': { label: 'K3', conditions: ['Rutin', 'Non-Rutin', 'Emergency'] },
            'KO': { label: 'KO', conditions: ['Rutin', 'Non-Rutin', 'Emergency'] },
            'Lingkungan': { label: 'Lingkungan', conditions: ['Normal', 'Abnormal', 'Emergency'] },
            'Keamanan': { label: 'Keamanan', conditions: ['Emergency'] }
        };

        // Filter Categories based on User Unit (Cross-Audit Rule)
        let categories = {};

        if (userUnitId == 55) {
            // Unit Security (55) -> Only Keamanan
            categories = {
                'Keamanan': allCategories['Keamanan']
            };
        } else if (userUnitId == 56) {
            // Unit SHE (56) -> Only K3, KO, Lingkungan
            categories = {
                'K3': allCategories['K3'],
                'KO': allCategories['KO'],
                'Lingkungan': allCategories['Lingkungan']
            };
        } else {
            // Normal Users -> All Categories
            categories = allCategories;
        }



        function addItem() {
            // Collapse all existing first
            document.querySelectorAll('.doc-item').forEach(el => collapseItem(el));

            const template = document.getElementById('item-template').innerHTML;
            const container = document.getElementById('items-container');

            // Use simple index for name attributes
            let html = template.replace(/{index}/g, itemIndex);

            const div = document.createElement('div');
            div.innerHTML = html;
            const itemNode = div.firstElementChild;

            // Auto fill probis
            const probisInput = itemNode.querySelector('.probis-input');
            if (probisInput) probisInput.value = autoProbis;

            container.appendChild(itemNode);

            // Filter categories in the newly added item
            const categorySelect = itemNode.querySelector('select[onchange*="updateConditions"]');
            if (categorySelect && selectedFormType) {
                filterCategorySelect(categorySelect);
            }

            // Scroll to new item top
            itemNode.scrollIntoView({ behavior: 'smooth', block: 'start' });

            itemIndex++;
            updateItemNumbers();
        }

        function removeItem(btn) {
            Swal.fire({
                title: 'Hapus Item?',
                text: "Data item ini akan dihapus.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    btn.closest('.doc-item').remove();
                    updateItemNumbers();
                }
            });
        }

        function toggleCollapse(header) {
            const item = header.closest('.doc-item');
            const content = item.querySelector('.collapsible-content');
            const icon = item.querySelector('.btn-collapse i');
            const summary = item.querySelector('.item-summary');

            if (content.style.display === 'none') {
                // EXPAND
                content.style.display = 'block';
                icon.classList.remove('fa-chevron-down');
                icon.classList.add('fa-chevron-up');
                summary.style.display = 'none';
                item.classList.remove('collapsed');
            } else {
                // COLLAPSE
                content.style.display = 'none';
                icon.classList.remove('fa-chevron-up');
                icon.classList.add('fa-chevron-down');
                summary.style.display = 'inline';
                item.classList.add('collapsed');
            }
        }

        function collapseItem(item) {
            const content = item.querySelector('.collapsible-content');
            const icon = item.querySelector('.btn-collapse i');
            const summary = item.querySelector('.item-summary');

            if (content && icon && summary) {
                content.style.display = 'none';
                icon.classList.remove('fa-chevron-up');
                icon.classList.add('fa-chevron-down');
                summary.style.display = 'inline';
                item.classList.add('collapsed');
            }
        }

        /**
         * Handle Scope Category Change
         * Shows/hides appropriate input based on selected category
         */
        function handleScopeCategory(selectElement) {
            const formGroup = selectElement.closest('.form-grid-2');
            const scopeContainer = formGroup.querySelector('.scope-value-container');
            const scopeLabel = formGroup.querySelector('.scope-value-label');
            const scopeDropdown = formGroup.querySelector('.scope-value-dropdown');
            const scopeText = formGroup.querySelector('.scope-value-text');

            const category = selectElement.value;

            if (!category) {
                scopeContainer.style.display = 'none';
                scopeDropdown.style.display = 'none';
                scopeText.style.display = 'none';
                return;
            }

            // Show container
            scopeContainer.style.display = 'block';

            // Reset both inputs
            scopeDropdown.style.display = 'none';
            scopeText.style.display = 'none';
            scopeDropdown.removeAttribute('name');
            scopeText.removeAttribute('name');

            if (category === 'proses_bisnis') {
                scopeLabel.innerHTML = 'Nama Proses Bisnis <span class="required">*</span>';
                scopeDropdown.style.display = 'block';
                scopeDropdown.setAttribute('name', scopeDropdown.getAttribute('name').replace('scope_value_text', 'scope_value'));

                // Fetch business processes
                fetchBusinessProcesses(scopeDropdown);
            }
            else if (category === 'kegiatan') {
                scopeLabel.innerHTML = 'Nama Kegiatan <span class="required">*</span>';
                scopeText.style.display = 'block';
                scopeText.setAttribute('name', scopeText.getAttribute('name').replace('scope_value_text', 'scope_value'));
                scopeText.setAttribute('placeholder', 'Masukkan nama kegiatan...');
                scopeText.setAttribute('required', 'required');
                scopeDropdown.removeAttribute('required');
            }
            else if (category === 'aset') {
                scopeLabel.innerHTML = 'Nama Aset <span class="required">*</span>';
                scopeText.style.display = 'block';
                scopeText.setAttribute('name', scopeText.getAttribute('name').replace('scope_value_text', 'scope_value'));
                scopeText.setAttribute('placeholder', 'Masukkan nama aset...');
                scopeText.setAttribute('required', 'required');
                scopeDropdown.removeAttribute('required');
            }
        }

        /**
         * Fetch Business Processes from API
         */
        async function fetchBusinessProcesses(selectElement) {
            selectElement.innerHTML = '<option value="">Memuat...</option>';

            try {
                const response = await fetch('/api/business-processes', {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    credentials: 'same-origin'
                });

                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }

                const processes = await response.json();

                selectElement.innerHTML = '<option value="">-- Pilih Proses Bisnis --</option>';
                processes.forEach(process => {
                    const option = document.createElement('option');
                    option.value = process.name;
                    option.textContent = process.name;
                    selectElement.appendChild(option);
                });

                selectElement.setAttribute('required', 'required');
                scopeText.removeAttribute('required');

            } catch (error) {
                console.error('Failed to fetch business processes:', error);
                selectElement.innerHTML = '<option value="">Error loading data</option>';
            }
        }

        function updateSummary(input) {
            const item = input.closest('.doc-item');
            const summary = item.querySelector('.item-summary');
            if (input.value) {
                const limit = 40;
                let txt = input.value;
                if (txt.length > limit) txt = txt.substring(0, limit) + '...';
                summary.textContent = `(${txt})`;
            } else {
                summary.textContent = '(Klik untuk expand)';
            }
        }

        function updateItemNumbers() {
            const items = document.querySelectorAll('.doc-item');
            items.forEach((item, idx) => {
                // Update Badge Number
                const numBadge = item.querySelector('.item-number');
                if (numBadge) numBadge.textContent = '#' + (idx + 1);
            });
            updateRemoveButtons();
        }

        function updateRemoveButtons() {
            const buttons = document.querySelectorAll('.btn-remove-item');
            if (buttons.length === 1) {
                buttons[0].style.display = 'none';
            } else {
                buttons.forEach(b => b.style.display = 'block');
            }
        }

        function updateConditions(select) {
            const item = select.closest('.doc-item');
            const condSelect = item.querySelector('.condition-select');
            const cat = select.value;
            const hazardSection = item.querySelector('.hazard-section');
            const hazardOptions = item.querySelector('.hazard-options');

            // Toggle BAGIAN 2 Visibility
            const bagian2Container = item.querySelector('.bagian-2-container');
            if (bagian2Container) {
                if (cat) {
                    bagian2Container.style.display = 'block';
                } else {
                    bagian2Container.style.display = 'none';
                }
            }

            // Get all conditional field sections using CORRECT classes
            const k3KoField = item.querySelector('.k3-ko-field'); // Column 6
            const lingkunganField = item.querySelector('.lingkungan-field'); // Column 7
            const keamananField = item.querySelector('.keamanan-field'); // Column 8
            const lingkunganOnlyField = item.querySelector('.lingkungan-only-field'); // Column 16

            // Get kolom 9 variants
            const kolom9K3KO = item.querySelector('.kolom9-k3ko-field');
            const kolom9Lingkungan = item.querySelector('.kolom9-lingkungan-field');
            const kolom9Keamanan = item.querySelector('.kolom9-keamanan-field');

            condSelect.innerHTML = '<option value="">-- Pilih --</option>';

            // 1. Reset/Hide All Categories First
            if (k3KoField) k3KoField.style.display = 'none';
            if (lingkunganField) lingkunganField.style.display = 'none';
            if (keamananField) keamananField.style.display = 'none';
            if (lingkunganOnlyField) lingkunganOnlyField.style.display = 'none';

            // 2. Hide All Kolom 9 Variants & Reset Required
            if (kolom9K3KO) {
                kolom9K3KO.style.display = 'none';
                kolom9K3KO.querySelector('textarea')?.removeAttribute('required');
            }
            if (kolom9Lingkungan) {
                kolom9Lingkungan.style.display = 'none';
                kolom9Lingkungan.querySelector('textarea')?.removeAttribute('required');
            }
            if (kolom9Keamanan) {
                kolom9Keamanan.style.display = 'none';
                kolom9Keamanan.querySelector('textarea')?.removeAttribute('required');
            }

            // 3. Populate Conditions Dropdown
            if (categories[cat]) {
                condSelect.disabled = false; // Enable the dropdown
                categories[cat].conditions.forEach(c => {
                    const opt = document.createElement('option');
                    opt.value = c;
                    opt.textContent = c;
                    condSelect.appendChild(opt);
                });

                // 4. Show Specific Fields Based on Category
                if (cat === 'K3' || cat === 'KO') {
                    // Show Kolom 6 & 9a
                    if (k3KoField) {
                        k3KoField.style.display = 'block';
                        k3KoField.querySelectorAll('input').forEach(i => i.disabled = false);
                    }

                    if (kolom9K3KO) {
                        kolom9K3KO.style.display = 'block';
                        kolom9K3KO.querySelector('textarea')?.setAttribute('required', 'required');
                    }

                    // Disable others to prevent submission
                    if (lingkunganField) lingkunganField.querySelectorAll('input').forEach(i => i.disabled = true);
                    if (keamananField) keamananField.querySelectorAll('input').forEach(i => i.disabled = true);

                } else if (cat === 'Lingkungan') {
                    // Show Kolom 7, 16 & 9b
                    if (lingkunganField) {
                        lingkunganField.style.display = 'block';
                        lingkunganField.querySelectorAll('input').forEach(i => i.disabled = false);
                    }
                    if (lingkunganOnlyField) lingkunganOnlyField.style.display = 'block';

                    if (kolom9Lingkungan) {
                        kolom9Lingkungan.style.display = 'block';
                        kolom9Lingkungan.querySelector('textarea')?.setAttribute('required', 'required');
                    }

                    // Disable others
                    if (k3KoField) k3KoField.querySelectorAll('input').forEach(i => i.disabled = true);
                    if (keamananField) keamananField.querySelectorAll('input').forEach(i => i.disabled = true);

                } else if (cat === 'Keamanan') {
                    // Show Kolom 8 & 9c
                    if (keamananField) {
                        keamananField.style.display = 'block';
                        keamananField.querySelectorAll('input').forEach(i => i.disabled = false);
                    }

                    if (kolom9Keamanan) {
                        kolom9Keamanan.style.display = 'block';
                        kolom9Keamanan.querySelector('textarea')?.setAttribute('required', 'required');
                    }

                    // Disable others
                    if (k3KoField) k3KoField.querySelectorAll('input').forEach(i => i.disabled = true);
                    if (lingkunganField) lingkunganField.querySelectorAll('input').forEach(i => i.disabled = true);
                }
            } else {
                condSelect.disabled = true; // Keep disabled if no category selected
            }
        }



        function calculateItemRisk(el) {
            const item = el.closest('.doc-item');
            const likelihood = parseInt(item.querySelector('.likelihood-select').value) || 0;
            const severity = parseInt(item.querySelector('.severity-select').value) || 0;

            const score = likelihood * severity;
            const scoreEl = item.querySelector('.display-score');
            const levelEl = item.querySelector('.display-level');
            const inputScore = item.querySelector('.input-score');
            const inputLevel = item.querySelector('.input-level');
            const riskBox = item.querySelector('.risk-result-box');

            scoreEl.textContent = score || '-';
            inputScore.value = score;

            let level = 'Rendah';
            let bg = '#e2e8f0'; // Default gray
            let textColor = '#64748b';

            if (score > 0) {
                textColor = '#fff';
                if (score >= 20) {
                    level = 'Sangat Tinggi';
                    bg = '#7f1d1d'; // Dark red for very high
                }
                else if (score >= 10) {
                    level = 'Tinggi';
                    bg = '#dc2626'; // Red
                }
                else if (score >= 5) {
                    level = 'Sedang';
                    bg = '#f59e0b'; // Orange
                }
                else {
                    level = 'Rendah';
                    bg = '#10b981'; // Green
                }
            }

            levelEl.textContent = (score > 0) ? level : 'PENDING';
            inputLevel.value = level;
            riskBox.style.background = bg;
            riskBox.style.color = textColor;

            // Show/Hide BAGIAN 5 based on risk level


            // Trigger auto-tolerance calculation
            calculateAutoTolerance(item, score, level);
        }

        // calculateItemResidual Removed


        // validateForm Removed


        // ==================== PUK/PMK Functions ====================

        function calculateAutoTolerance(item, riskScore, riskLevel) {
            const toleranceDisplay = item.querySelector('.tolerance-display');
            const toleranceIcon = item.querySelector('.tolerance-icon');
            const toleranceValue = item.querySelector('.tolerance-value');
            const toleranceReason = item.querySelector('.tolerance-reason');
            const toleranceInput = item.querySelector('.tolerance-input');
            const kolom19Section = item.querySelector('.kolom19-section');
            const programSection = item.querySelector('.program-section');

            if (!toleranceDisplay) return;

            let tolerance = 'Ya';
            let icon = 'fa-check-circle';
            let iconColor = '#10b981';
            let bgcolor = '#ecfdf5';
            let borderColor = '#6ee7b7';
            let valueText = 'Ya - Dapat Ditoleransi';
            let reasonText = '';

            // Check if there are existing controls (Kolom 11)
            const existingControls = item.querySelector('.kolom11-hidden-input')?.value;
            const hasControls = existingControls && existingControls.trim() !== '';

            // PMK Logic: Allowed for Tinggi (Score >= 10) and Sangat Tinggi
            const pmkOption = item.querySelector('.option-pmk');
            const pukOption = item.querySelector('option[value="PUK"]');
            const typeSelect = item.querySelector('.program-type-select');

            if (pmkOption && pukOption) {
                if (riskScore >= 20) {
                    // Risk >= 20: SANGAT TINGGI -> FORCE PMK ONLY
                    pukOption.disabled = true;
                    pukOption.style.display = 'none'; // Sembunyikan opsi PUK

                    pmkOption.disabled = false;
                    pmkOption.textContent = 'PMK - Program Manajemen Korporat (Wajib untuk Risiko Sangat Tinggi)';

                    // Force select PMK if not selected
                    if (typeSelect.value !== 'PMK') {
                        pmkOption.selected = true;
                        typeSelect.value = 'PMK'; // Ensure value is set
                        typeSelect.dispatchEvent(new Event('change', { bubbles: true }));
                    }

                } else if (riskScore >= 10) {
                    // Risk 10-19: TINGGI -> ALLOW BOTH, SUGGEST PMK
                    pukOption.disabled = false;
                    pukOption.style.display = 'block';

                    pmkOption.disabled = false;
                    pmkOption.textContent = 'PMK - Program Manajemen Korporat (Disarankan untuk Risiko Tinggi)';

                    // Default behavior (optional): Don't force change if user already selected something valid
                    // But if empty, maybe default to PMK? Keeping it neutral or strictly suggestive.

                } else {
                    // Risk < 10: STANDARD -> PMK DISABLED (Usually)
                    pmkOption.disabled = true;
                    if (pmkOption.selected) {
                        pmkOption.selected = false;
                        typeSelect.value = ''; // Reset if it was PMK
                    }

                    pmkOption.textContent = 'PMK - Program Manajemen Korporat (Hanya untuk Risiko Tinggi/Sangat Tinggi)';

                    pukOption.disabled = false;
                    pukOption.style.display = 'block';

                    // If we forced reset above, or it's empty, default to PUK?
                    // Let's leave it to user to pick PUK, but since PMK is disabled, they only have 1 choice.
                    // Better UX: Auto-select PUK if PMK is disabled and nothing selected
                    if (typeSelect.value !== 'PUK') {
                        pukOption.selected = true;
                        typeSelect.value = 'PUK';
                        typeSelect.dispatchEvent(new Event('change', { bubbles: true }));
                    }
                }
            }

            // Auto-tolerance logic (Updated for new scale)
            if (riskScore >= 10) {
                // Tinggi & Sangat Tinggi (10+): Auto "Tidak" - always need program
                // User can choose PUK or PMK (handled above)
                tolerance = 'Tidak';
                icon = 'fa-exclamation-triangle';
                iconColor = '#dc2626';
                bgcolor = '#fef2f2';
                borderColor = '#fca5a5';
                valueText = 'Tidak - Perlu Program Pengendalian (Pilih PUK/PMK)';
                reasonText = 'Risiko Tinggi/Sangat Tinggi: Wajib membuat Program Pengendalian';
            } else if (riskScore >= 5) {
                // Sedang (5-9): Depends on existing controls
                if (!hasControls) {
                    // No controls? Need PUK
                    tolerance = 'Tidak';
                    icon = 'fa-exclamation-circle';
                    iconColor = '#f59e0b';
                    bgcolor = '#fffbeb';
                    borderColor = '#fcd34d';
                    valueText = 'Tidak - Perlu Program Pengendalian';
                    reasonText = 'Risiko Sedang tanpa pengendalian: Program PUK diperlukan';
                } else {
                    // Has controls? No PUK needed
                    tolerance = 'Ya';
                    icon = 'fa-check-circle';
                    iconColor = '#10b981';
                    bgcolor = '#ecfdf5';
                    borderColor = '#6ee7b7';
                    valueText = 'Ya - Dapat Ditoleransi (Cukup Pengendalian Kolom 10)';
                    reasonText = 'Risiko Sedang dengan pengendalian (Kolom 10) sudah cukup. Tidak perlu PUK.';
                }
            } else if (riskScore > 0) {
                // Rendah (1-4): Auto "Ya"
                valueText = 'Ya - Dapat Ditoleransi';
                reasonText = 'Risiko Rendah: Tidak perlu pengendalian tambahan';
            } else {
                // No risk calculated yet
                icon = 'fa-spinner';
                valueText = 'Menunggu Penilaian Risiko';
                reasonText = 'Hitung risiko di Kolom 12-14 untuk menentukan toleransi';
                bgcolor = 'white';
                borderColor = '#cbd5e1';
                iconColor = '#94a3b8';
            }

            // Update display
            toleranceIcon.innerHTML = `<i class="fas ${icon}" style="color: ${iconColor};"></i>`;
            toleranceValue.textContent = valueText;
            toleranceReason.textContent = reasonText;
            toleranceDisplay.style.background = bgcolor;
            toleranceDisplay.style.borderColor = borderColor;
            toleranceInput.value = tolerance;

            // Show/hide Kolom 19 and Program section
            // Show/hide Kolom 19 and Program section
            // Logic: Show ONLY if Tolerance is "Tidak" (High Risk OR Medium Risk without Controls)
            const riskAfterControlSection = item.querySelector('.risk-after-control-section');

            if (tolerance === 'Tidak') {
                kolom19Section.style.display = 'block';
                programSection.style.display = 'block';
                if (riskAfterControlSection) riskAfterControlSection.style.display = 'block';

                // Ensure required attributes if validatable? 
                // For now, no strict required on hidden fields as standard HTML behavior.

            } else {
                kolom19Section.style.display = 'none';
                programSection.style.display = 'none';
                if (riskAfterControlSection) {
                    riskAfterControlSection.style.display = 'none';

                    // Reset values when hidden
                    const lSelect = riskAfterControlSection.querySelector('.likelihood-select-after');
                    const sSelect = riskAfterControlSection.querySelector('.severity-select-after');
                    if (lSelect) lSelect.value = '';
                    if (sSelect) sSelect.value = '';

                    // Trigger calc to reset score/level
                    if (lSelect) calculateRiskAfterControl(lSelect);
                }

                // Clear inputs if hiding to prevent submitting hidden data
                const programTypeSelect = item.querySelector('.program-type-select');
                if (programTypeSelect) programTypeSelect.value = '';

                const programContainer = item.querySelector('.program-form-container');
                if (programContainer) {
                    programContainer.style.display = 'none';
                    programContainer.innerHTML = '';
                }
            }
        }

        function calculateRiskAfterControl(el) {
            const item = el.closest('.doc-item');
            const section = item.querySelector('.risk-after-control-section');
            if (!section) return;

            const likelihood = parseInt(section.querySelector('.likelihood-select-after').value) || 0;
            const severity = parseInt(section.querySelector('.severity-select-after').value) || 0;

            const score = likelihood * severity;
            const scoreEl = section.querySelector('.risk-score-after');
            const levelEl = section.querySelector('.risk-level-after');
            const inputScore = section.querySelector('.input-score-after');
            const inputLevel = section.querySelector('.input-level-after');
            const riskBox = section.querySelector('.risk-result-box-after');

            scoreEl.textContent = score || '-';
            inputScore.value = score > 0 ? score : ''; // Empty if 0 to allow DB default or NULL? Or just 0. Let's keep empty string for "unset" visual. 
            // Wait, DB columns are likely nullable or integers. 
            // If hidden, we want them treated as NULL or "-" (which is 0 or null).
            // User request: "jika tdapat ditoleransi itu nilainya '-'" -> implies NULL or displayed as -.

            let level = '-';
            let bg = '#e2e8f0';
            let textColor = '#64748b';

            if (score > 0) {
                textColor = '#fff';
                if (score >= 20) {
                    level = 'Sangat Tinggi';
                    bg = '#7f1d1d';
                }
                else if (score >= 10) {
                    level = 'Tinggi';
                    bg = '#dc2626';
                }
                else if (score >= 5) {
                    level = 'Sedang';
                    bg = '#f59e0b';
                }
                else {
                    level = 'Rendah';
                    bg = '#10b981';
                }
            }

            levelEl.textContent = (score > 0) ? level : 'PENDING';
            // If hidden (likelihood=0), level should be empty string or '-'?
            if (score === 0) levelEl.textContent = '-';

            inputLevel.value = (score > 0) ? level : '';
            riskBox.style.background = (score > 0) ? bg : '#e2e8f0';
            riskBox.style.color = (score > 0) ? textColor : '#64748b';
        }

        // Handle Kolom 19 input changes - auto-fill program title
        document.addEventListener('input', function (e) {
            if (e.target.classList.contains('kolom19-input')) {
                const item = e.target.closest('.doc-item');
                const programJudul = item.querySelector('.program-judul');
                if (programJudul) {
                    programJudul.value = e.target.value;
                }
            }
        });

        // Toggle Headers based on Program Type
        function toggleProgramHeaders(item) {
            const isPMK = item.querySelector('.program-type-select')?.value === 'PMK';
            const table = item.querySelector('.program-kerja-table');
            if (!table) return;

            const colKoordinator = table.querySelector('.col-koordinator');
            const colPelaksana = table.querySelector('.col-pelaksana');
            const colAnggaran = table.querySelector('.col-anggaran');

            if (isPMK) {
                // PMK: Rename Koord -> PIC, Hide Pelaksana, Show Anggaran
                if (colKoordinator) {
                    colKoordinator.textContent = 'PIC'; // Rename header
                    colKoordinator.style.minWidth = '180px';
                }
                if (colPelaksana) colPelaksana.style.display = 'none';

                if (colAnggaran) colAnggaran.style.display = 'table-cell';
            } else {
                // PUK: Name Koord -> Koordinator, Show Pelaksana, Hide Anggaran
                if (colKoordinator) {
                    colKoordinator.textContent = 'Koordinator'; // Reset header
                    colKoordinator.style.minWidth = '140px';
                }
                if (colPelaksana) colPelaksana.style.display = 'table-cell';

                if (colAnggaran) colAnggaran.style.display = 'none';
            }
        }

        // Logic check: Is PMK selected?
        function isPmkSelected(btn) {
            // Check if btn itself is the Select (when triggered by change event) or a child
            let item;
            if (btn.classList.contains('doc-item')) {
                item = btn;
            } else {
                item = btn.closest('.doc-item');
            }
            const type = item.querySelector('.program-type-select');
            return type && type.value === 'PMK';
        }

        // Handle Program Type Selection
        document.addEventListener('change', function (e) {
            if (e.target.classList.contains('program-type-select')) {
                const item = e.target.closest('.doc-item');
                const programType = e.target.value;
                const container = item.querySelector('.program-form-container');
                const kolom19Value = item.querySelector('.kolom19-input').value;

                // Get item index from data-index attribute
                const itemIndex = item.getAttribute('data-index');

                if (!programType) {
                    container.style.display = 'none';
                    container.innerHTML = '';
                    return;
                }

                // Clone template
                const template = document.getElementById('program-form-template').innerHTML;
                const processedHtml = template.replace(/{index}/g, itemIndex);

                container.innerHTML = processedHtml;
                container.style.display = 'block';

                // Update headers immediately AFTER injecting HTML
                toggleProgramHeaders(item);

                // Set title
                const title = container.querySelector('.program-form-title');
                title.textContent = `Form ${programType} - ${programType === 'PUK' ? 'Program Unit Kerja' : 'Program Manajemen Korporat'}`;

                // Set judul from Kolom 19
                const judulInput = container.querySelector('.program-judul');
                judulInput.value = kolom19Value;

                // Auto-fill Penanggung Jawab
                const pjInput = container.querySelector('.program-pj');
                const userUnitName = document.getElementById('user_unit_name').value;
                if (pjInput) pjInput.value = userUnitName;

                // Set type label in uraian revisi
                const typeLabel = container.querySelector('.program-type-label');
                typeLabel.textContent = programType === 'PMK' ? '(Harus diisi untuk PMK)' : '(Opsional)';

                // Add first row to program kerja
                setTimeout(() => {
                    const addBtn = container.querySelector('button[onclick*="addProgramKerjaRow"]');
                    if (addBtn) addProgramKerjaRow(addBtn);
                }, 100);
            }
        });

        // Add Program Kerja Row
        function addProgramKerjaRow(btn) {
            const table = btn.previousElementSibling.querySelector('.program-kerja-tbody');
            // Use unique timestamp for ID to prevent collisions
            const uniqueId = Date.now();
            const rowCount = table.querySelectorAll('tr').length + 1;

            const item = btn.closest('.doc-item');
            const itemIndex = item.getAttribute('data-index');
            const isPMK = isPmkSelected(btn);

            // Ensure headers are correct state before adding row
            toggleProgramHeaders(item);

            // Get Users passed from controller
            const band3Users = @json($band3Users ?? []); // Roles 4-5 for Koordinator
            const band4Users = @json($band4Users ?? []); // Role 6 for Pelaksana
            const pmkPicUsers = @json($pmkPicUsers ?? []); // Managers (Role 3)

            // Generate Options for Band 3 (Koordinator)
            let band3Options = '<option value="" disabled selected>-- Pilih Koordinator --</option>';
            band3Users.sort((a, b) => (a.nama_user || '').localeCompare(b.nama_user || ''));
            band3Users.forEach(u => {
                band3Options += `<option value="${u.nama_user}">${u.nama_user}</option>`;
            });

            // Generate Options for Band 4 (Pelaksana)
            let band4Options = '<option value="" disabled selected>-- Pilih Pelaksana --</option>';
            band4Users.sort((a, b) => (a.nama_user || '').localeCompare(b.nama_user || ''));
            band4Users.forEach(u => {
                band4Options += `<option value="${u.nama_user}">${u.nama_user}</option>`;
            });

            // Generate Options for PMK PIC (Manager)
            let pmkPicOptions = '<option value="" disabled selected>-- Pilih PIC (Manager) --</option>';
            pmkPicUsers.sort((a, b) => (a.nama_user || '').localeCompare(b.nama_user || ''));
            pmkPicUsers.forEach(u => {
                pmkPicOptions += `<option value="${u.nama_user}">${u.nama_user}</option>`;
            });

            const row = document.createElement('tr');

            if (isPMK) {
                // PMK Table: No | Uraian | PIC (Manager) | Target (12) | Anggaran
                // Note: Only generate ONE user column
                row.innerHTML = `
                    <td style="text-align: center; border: 1px solid #d1d5db; vertical-align: middle;">${rowCount}</td>
                    
                    <td style="border: 1px solid #d1d5db; padding: 0;">
                        <textarea class="form-control" name="items[${itemIndex}][program_kerja][${uniqueId}][uraian]" 
                               placeholder="Uraian kegiatan..." required 
                               style="border: none; width: 100%; min-width: 150px; resize: vertical; padding: 6px;" rows="3"></textarea>
                    </td>
                    
                    <!-- Reuse the Koordinator column for PIC -->
                    <td style="border: 1px solid #d1d5db; padding: 4px; min-width: 160px; vertical-align: middle;">
                        <!-- Hidden values for compatibility -->
                        <input type="hidden" name="items[${itemIndex}][program_kerja][${uniqueId}][pelaksana]" value="-">
                        
                        <!-- Map PIC dropdown to 'koordinator' field to reuse logic, or keep consistent keys -->
                        <select class="form-select" name="items[${itemIndex}][program_kerja][${uniqueId}][koordinator]" required 
                                style="width: 100%; padding: 6px; font-size: 12px; border: 1px solid #cbd5e1; border-radius: 4px;">
                            ${pmkPicOptions}
                        </select>
                    </td>

                    <!-- Pelaksana Column is HIDDEN via header logic, so strictly we should not render the TD or render a hidden one? 
                         If html structure, we usually omit TD if header is hidden via separate mechanism? 
                         Actually, standard table behavior: if header is hidden (display:none), the cells in body should also be hidden or omitted?
                         Wait, if I just omit the TD, but the header is hidden, columns shift.
                         If I use Display: None on the Header, I must use Display: None on the TD as well, or omit it if colspan structure matches?
                         Let's assume simply omitting TD works if header is toggle via display:none. 
                         Wait, a Missing TD will cause Target columns to shift left under the hidden header?
                         No, display:none removes it from flow. So 2nd header is gone.
                         So 3rd header becomes 2nd.
                         So Body must have matching number of TDs.
                         
                         Headers Visible: [No] [Uraian] [PIC] [Target...] [Anggaran]
                         Headers Hidden:  [Pelaksana]
                         Body must contain TDs aligning to [No] [Uraian] [PIC] [Target...] [Anggaran].
                         So I should NOT render the Pelaksana TD at all.
                    -->

                    ${Array.from({ length: 12 }, (_, i) => `
                        <td style="border: 1px solid #d1d5db; padding: 2px; width: 40px; min-width: 40px;">
                            <input type="number" class="form-control" name="items[${itemIndex}][program_kerja][${uniqueId}][target][${i}]" 
                                   min="0" placeholder="-" 
                                   style="border: none; width: 100%; height: 100%; text-align: center; padding: 0; font-size: 11px;">
                        </td>
                    `).join('')}
                    
                    <td style="border: 1px solid #d1d5db; padding: 0;">
                        <input type="number" class="form-control" name="items[${itemIndex}][program_kerja][${uniqueId}][anggaran]" 
                               placeholder="Rp 0" min="0"
                               style="border: none; width: 100%; min-width: 120px; padding: 6px; font-size: 12px;">
                    </td>
                    
                    <td style="text-align: center; border: 1px solid #d1d5db; vertical-align: middle; padding: 4px;">
                        <button type="button" onclick="this.closest('tr').remove(); renumberProgramKerja(this)" 
                                style="background: #ef4444; color: white; border: none; border-radius: 4px; padding: 4px 8px; cursor: pointer;">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                `;
            } else {
                // PUK Table: No | Uraian | Koordinator | Pelaksana | Target | (No Anggaran)
                row.innerHTML = `
                    <td style="text-align: center; border: 1px solid #d1d5db; vertical-align: middle;">${rowCount}</td>
                    
                    <td style="border: 1px solid #d1d5db; padding: 0;">
                        <textarea class="form-control" name="items[${itemIndex}][program_kerja][${rowCount - 1}][uraian]" 
                               placeholder="Uraian kegiatan..." required 
                               style="border: none; width: 100%; min-width: 150px; resize: vertical; padding: 6px;" rows="3"></textarea>
                    </td>
                    
                    <td style="border: 1px solid #d1d5db; padding: 0;">
                        <select class="form-select" name="items[${itemIndex}][program_kerja][${rowCount - 1}][koordinator]" required 
                                style="border: none; width: 100%; min-width: 140px; padding: 6px; cursor: pointer; font-size: 12px;">
                            ${band3Options}
                        </select>
                    </td>
                    
                    <td style="border: 1px solid #d1d5db; padding: 0;">
                        <select class="form-select" name="items[${itemIndex}][program_kerja][${rowCount - 1}][pelaksana]" required 
                                style="border: none; width: 100%; min-width: 140px; padding: 6px; cursor: pointer; font-size: 12px;">
                            ${band4Options}
                        </select>
                    </td>

                    ${Array.from({ length: 12 }, (_, i) => `
                        <td style="border: 1px solid #d1d5db; padding: 2px; width: 40px; min-width: 40px;">
                            <input type="number" class="form-control" name="items[${itemIndex}][program_kerja][${rowCount - 1}][target][${i}]" 
                                   min="0" placeholder="-" 
                                   style="border: none; width: 100%; height: 100%; text-align: center; padding: 0; font-size: 11px;">
                        </td>
                    `).join('')}
                    
                    <td style="text-align: center; border: 1px solid #d1d5db; vertical-align: middle; padding: 4px;">
                        <button type="button" onclick="this.closest('tr').remove(); renumberProgramKerja(this)" 
                                style="background: #ef4444; color: white; border: none; border-radius: 4px; padding: 4px 8px; cursor: pointer;">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                `;
            }

            table.appendChild(row);
        }

        // Renumber program kerja rows
        function renumberProgramKerja(btn) {
            const table = btn.closest('table').querySelector('tbody');
            const rows = table.querySelectorAll('tr');
            rows.forEach((row, idx) => {
                row.querySelector('td:first-child').textContent = idx + 1;
            });
        }

        // ==================== Form Type Selection ====================

        let selectedFormType = '';

        // Show modal on page load
        window.addEventListener('load', function () {
            const modal = document.getElementById('formTypeModal');
            modal.style.display = 'flex';
        });

        // Handle form type selection
        function selectFormType(type) {
            selectedFormType = type;

            // Store in hidden input
            document.getElementById('form_type').value = type;

            // Update form title & hidden input
            const formTitle = document.getElementById('formTitle');
            const judulInput = document.getElementById('judul_dokumen');

            if (type === 'SHE') {
                const title = 'Identifikasi dan Penetapan Mitigasi Risiko K3, KO, Aspek Lingkungan';
                formTitle.textContent = title;
                if (judulInput) judulInput.value = title;
            } else if (type === 'Security') {
                const title = 'Identifikasi dan Penetapan Mitigasi Risiko Pengamanan';
                formTitle.textContent = title;
                if (judulInput) judulInput.value = title;
            }

            // Hide modal with animation
            const modal = document.getElementById('formTypeModal');
            modal.style.opacity = '0';
            setTimeout(() => {
                modal.style.display = 'none';
                modal.style.opacity = '1';

                // Add first item after modal is hidden
                addItem();
            }, 300);
        }

        // Filter categories based on form type
        function filterAllCategories() {
            // Filter in template
            updateCategoryOptionsInTemplate();

            // Filter in existing items
            document.querySelectorAll('.doc-item').forEach(item => {
                const categorySelect = item.querySelector('.category-select');
                if (categorySelect) {
                    filterCategorySelect(categorySelect);
                }
            });
        }

        function filterCategorySelect(select) {
            if (!selectedFormType) return;

            const allOptions = [
                { value: 'K3', text: 'K3 (Keselamatan Kerja)', type: 'SHE' },
                { value: 'KO', text: 'KO (Kesehatan Operasional)', type: 'SHE' },
                { value: 'Lingkungan', text: 'Lingkungan', type: 'SHE' },
                { value: 'Keamanan', text: 'Keamanan', type: 'Security' }
            ];

            // Clear current options except placeholder
            select.innerHTML = '<option value="">-- Pilih Kategori --</option>';

            // Add filtered options
            allOptions.forEach(opt => {
                if (opt.type === selectedFormType) {
                    const option = document.createElement('option');
                    option.value = opt.value;
                    option.textContent = opt.text;
                    select.appendChild(option);
                }
            });
        }

        function updateCategoryOptionsInTemplate() {
            // This will be applied when new items are added
            // We'll intercept in addItem function
        }

        // Init
        document.addEventListener('DOMContentLoaded', () => {
            // Don't add item yet - wait for form type selection
            // addItem() will be called after form type is selected
        });
    </script>

    <style>
        /* Action Bar - Static Style */
        .action-bar {
            margin-top: 20px;
            background: #ffffff;
            padding: 20px 30px;
            border-radius: 12px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        }

        .action-info {
            font-size: 14px;
            color: #475569;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .action-buttons {
            display: flex;
            gap: 15px;
            /* Space between buttons */
            flex-shrink: 0;
            /* Prevent shrinking */
        }

        .btn:disabled {
            opacity: 0.7;
            cursor: not-allowed;
            pointer-events: none;
        }

        /* Ensure content isn't hidden behind bar */
        .content-area {
            padding-bottom: 100px;
        }
    </style>

    <script>
        // ... (Existing functions: addItem, removeItem, etc - keeping logic) ...

        // Form Validation and Submission
        function validateAndSubmit(actionType) {
            // Set Action Input
            const actionInput = document.getElementById('action_input');
            if (actionInput) actionInput.value = actionType;
            const isDraft = actionType === 'draft';

            try {
                let isValid = true;
                let errorMsg = '';

                // Check Document Title
                const titleInput = document.querySelector('input[name="judul_dokumen"]');
                if (!titleInput || !titleInput.value.trim()) {
                    isValid = false;
                    errorMsg = 'Judul Form wajib diisi.';
                }

                // 1. Check if at least one item exists
                const items = document.querySelectorAll('.doc-item');
                if (isValid && items.length === 0) {
                    isValid = false;
                    errorMsg = 'Minimal harus ada 1 kegiatan.';
                }

                // 2. Item Validation
                if (isValid) {
                    items.forEach((item, idx) => {
                        const kegiatanInput = item.querySelector('.item-kegiatan-input');
                        const kegiatan = kegiatanInput?.value || 'Item #' + (idx + 1);

                        // Rule: Draft ONLY requires "Kegiatan". Submit requires "Kegiatan" too.
                        if (isValid && (!kegiatanInput || !kegiatanInput.value.trim())) {
                            isValid = false;
                            errorMsg = `Kegiatan belum diisi pada Item #${idx + 1}`;
                            const content = item.querySelector('.collapsible-content');
                            if (content && content.style.display === 'none') {
                                toggleCollapse(item.querySelector('.card-header'));
                            }
                            item.scrollIntoView({ behavior: 'smooth', block: 'center' });
                        }

                        // STRICT Checks (Only if NOT Draft)
                        if (isValid && !isDraft) {
                            const scoreInput = item.querySelector('.input-score');
                            const resScoreInput = item.querySelector('.input-res-score');
                            const s = scoreInput ? scoreInput.value : 0;
                            const residualS = resScoreInput ? resScoreInput.value : 0;
                            const kondisi = item.querySelector('.condition-select')?.value;

                            // Validate Conditions
                            if (!kondisi) {
                                isValid = false;
                                errorMsg = `Kondisi (Rutin/Non-Rutin/dll) belum dipilih untuk: ${kegiatan}`;
                                const content = item.querySelector('.collapsible-content');
                                if (content && content.style.display === 'none') {
                                    toggleCollapse(item.querySelector('.card-header'));
                                }
                                item.scrollIntoView({ behavior: 'smooth', block: 'center' });
                            }

                            // Validate Initial Risk
                            if (isValid && (!s || s == 0)) {
                                isValid = false;
                                errorMsg = `Penilaian risiko awal belum lengkap untuk: ${kegiatan}`;
                                const box = item.querySelector('.risk-result-box');
                                if (box) {
                                    box.style.border = '2px solid #ef4444';
                                    setTimeout(() => box.style.border = '', 3000);
                                }
                            }

                            // Validate Residual Risk - REMOVED

                        }
                    });

                    // Target percentage validation removed (no max limit)

                }

                if (!isValid) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Validasi Gagal',
                        text: errorMsg,
                        confirmButtonColor: '#c41e3a'
                    });
                    return false;
                }

                // Show Loading
                const btn = document.getElementById('btnSubmit');
                const originalText = btn ? btn.innerHTML : 'Submit';
                if (btn) {
                    btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Mengirim...';
                    btn.disabled = true;
                }

                // Submit
                const form = document.getElementById('hiradcForm');
                if (isDraft) {
                    // Bypass HTML5 validation for draft
                    form.noValidate = true;
                    form.submit();
                } else {
                    form.noValidate = false;
                    if (form.reportValidity()) {
                        form.submit();
                    } else {
                        if (btn) {
                            btn.innerHTML = originalText;
                            btn.disabled = false;
                        }
                    }
                }

            } catch (e) {
                console.error(e);
                Swal.fire('System Error', e.message, 'error');
                const btn = document.getElementById('btnSubmit');
                if (btn) btn.disabled = false;
            }
        }

        // NEW: Toggle follow-up fields based on tolerance selection (columns 19-22)
        function toggleFollowUpFields(select) {
            const item = select.closest('.doc-item');
            const followUpSection = item.querySelector('.follow-up-section');
            const tolerance = select.value;

            if (tolerance === 'Tidak') {
                // Show columns 19-22
                followUpSection.style.display = 'block';
                // Make follow-up fields required
                followUpSection.querySelectorAll('.follow-up-field').forEach(field => {
                    if (field.tagName === 'TEXTAREA') {
                        field.setAttribute('required', 'required');
                    }
                });
            } else {
                // Hide columns 19-22
                followUpSection.style.display = 'none';
                // Remove required from follow-up fields and clear values
                followUpSection.querySelectorAll('.follow-up-field').forEach(field => {
                    field.removeAttribute('required');
                    field.value = '';
                });
                // Clear hidden inputs
                item.querySelector('.input-followup-score').value = '';
                item.querySelector('.input-followup-level').value = '';
            }
        }

        // NEW: Calculate Follow-up Risk (columns 20-22)
        function calculateFollowUpRisk(el) {
            const item = el.closest('.doc-item');
            const likelihood = parseInt(item.querySelector('[name*="kolom20_kemungkinan_lanjut"]').value) || 0;
            const severity = parseInt(item.querySelector('[name*="kolom21_konsekuensi_lanjut"]').value) || 0;

            const score = likelihood * severity;
            const scoreEl = item.querySelector('.followup-score');
            const levelEl = item.querySelector('.followup-level');
            const followupBox = item.querySelector('.followup-box');

            scoreEl.textContent = score || '-';
            item.querySelector('.input-followup-score').value = score;

            let level = '-';
            let bg = '#e2e8f0';
            let textColor = '#64748b';

            if (score > 0) {
                textColor = '#fff';
                if (score >= 15) { level = 'Tinggi'; bg = '#dc2626'; }
                else if (score >= 8) { level = 'Sedang'; bg = '#f59e0b'; }
                else { level = 'Rendah'; bg = '#166534'; }
            }

            levelEl.textContent = (score > 0) ? level : 'PENDING';
            item.querySelector('.input-followup-level').value = level;
            if (followupBox) {
                followupBox.style.background = bg;
                followupBox.style.color = textColor;
            }
        }



        // NEW: Update Kolom 11 when hierarchy checkboxes are chang           ed
        /**
         * Parse textarea content into hierarchy sections
         * Returns array of {hierarchy: string, content: string}
         */
        function parseHierarchySections(text) {
            const sections = [];
            const hierarchies = ['Eliminasi', 'Substitusi', 'Rekayasa Teknik', 'Pengendalian Administratif', 'APD'];

            hierarchies.forEach(hierarchy => {
                // Find pattern: "N. Hierarchy:" followed by content until next numbered item or end
                const escapedHierarchy = hierarchy.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
                const regex = new RegExp(`\\d+\\.\\s*${escapedHierarchy}:\\s*\\n([\\s\\S]*?)(?=\\n\\d+\\.|$)`, 'i');
                const match = text.match(regex);

                if (match) {
                    sections.push({
                        hierarchy: hierarchy,
                        content: match[1].trimEnd()
                    });
                }
            });

            return sections;
        }

        /**
         * Update Kolom 11 with dynamic hierarchy sections
         * Creates protected labels and editable textareas for each hierarchy
         */
        function updateKolom11(checkbox) {
            const item = checkbox.closest('.doc-item');
            const container = item.querySelector('.kolom11-dynamic-container');
            const hiddenInput = item.querySelector('.kolom11-hidden-input');
            const checkboxes = item.querySelectorAll('.hierarchy-checkboxes input[type="checkbox"]');

            if (!container) return;

            // Store existing content before clearing
            const existingData = {};
            container.querySelectorAll('.hierarchy-textarea').forEach(textarea => {
                const hierarchy = textarea.dataset.hierarchy;
                if (hierarchy && textarea.value.trim()) {
                    existingData[hierarchy] = textarea.value.trim();
                }
            });

            // Get currently checked values in order
            const checkedValues = Array.from(checkboxes)
                .filter(cb => cb.checked)
                .map(cb => cb.value);

            // Clear container
            container.innerHTML = '';

            // If no checkboxes checked, show empty state
            if (checkedValues.length === 0) {
                container.innerHTML = `
                    <div class="empty-state" style="padding: 40px; text-align: center; color: #94a3b8;">
                        <i class="fas fa-hand-pointer" style="font-size: 32px; margin-bottom: 12px; display: block;"></i>
                        <p style="margin: 0;">Pilih hierarki pengendalian di atas untuk mulai mengisi</p>
                    </div>
                `;
                hiddenInput.value = '';

                // IMPORTANT: Trigger calc to update Tolerance (e.g. set to "Tidak" if Medium Risk)
                // We must call this even (and especially) when unchecked.
                calculateItemRisk(checkbox);
                return;
            }

            // Create section for each checked hierarchy
            checkedValues.forEach((value, index) => {
                const section = document.createElement('div');
                section.className = 'hierarchy-section';
                section.style.marginBottom = index < checkedValues.length - 1 ? '20px' : '0';

                // Protected header (cannot be edited)
                const header = document.createElement('div');
                header.className = 'hierarchy-header';
                header.style.cssText = `
                    font-size: 14px;
                    font-weight: 600;
                    color: #1e293b;
                    margin-bottom: 8px;
                    padding: 10px 14px;
                    background: white;
                    border-left: 4px solid #3b82f6;
                    border-radius: 6px;
                    box-shadow: 0 1px 2px rgba(0,0,0,0.05);
                `;
                header.innerHTML = `<i class="fas fa-shield-alt" style="color: #3b82f6; margin-right: 8px;"></i>${index + 1}. ${value}:`;

                // Editable textarea
                const textarea = document.createElement('textarea');
                textarea.className = 'form-control hierarchy-textarea';
                textarea.dataset.hierarchy = value;
                textarea.rows = 3;
                textarea.placeholder = `Tambahkan penjelasan detail untuk ${value}...`;
                textarea.style.cssText = `
                    border: 1px solid #e2e8f0;
                    border-radius: 6px;
                    padding: 12px;
                    font-size: 14px;
                    line-height: 1.6;
                    resize: vertical;
                    transition: all 0.2s ease;
                `;

                // Restore existing content if available
                if (existingData[value]) {
                    textarea.value = existingData[value];
                }

                // Focus/blur effects
                textarea.addEventListener('focus', function () {
                    this.style.borderColor = '#3b82f6';
                    this.style.boxShadow = '0 0 0 3px rgba(59, 130, 246, 0.1)';
                });
                textarea.addEventListener('blur', function () {
                    this.style.borderColor = '#e2e8f0';
                    this.style.boxShadow = 'none';
                });

                // Update hidden input on change
                textarea.addEventListener('input', function () {
                    updateHiddenInput(item);
                });

                section.appendChild(header);
                section.appendChild(textarea);
                container.appendChild(section);
            });

            // Initial update of hidden input
            updateHiddenInput(item);

            // Trigger Risk Calculation to update Tolerance in Real-Time
            calculateItemRisk(checkbox);
        }

        /**
         * Update hidden input with combined data from all hierarchy textareas
         */
        function updateHiddenInput(item) {
            const textareas = item.querySelectorAll('.hierarchy-textarea');
            const hiddenInput = item.querySelector('.kolom11-hidden-input');

            if (!hiddenInput) return;

            let combinedText = '';
            textareas.forEach((textarea, index) => {
                const hierarchy = textarea.dataset.hierarchy;
                const content = textarea.value.trim();

                if (index > 0) combinedText += '\n\n';
                combinedText += `${index + 1}. ${hierarchy}:`;

                if (content) {
                    combinedText += `\n   ${content}`;
                }
            });

            hiddenInput.value = combinedText;
        }

        // CORRECTION: Override addProgramKerjaRow to ensure unique input names
        // (Deleted duplicate functions)

        // Target percentages have no maximum limit - users can enter any value per month
        function validateTargetPercentages(input) {
            // No validation - any value is allowed (can exceed 100% per month)
        }

        // UI REFINEMENT + PMK BUDGET COLUMN
        function addProgramKerjaRow(btn) {
            // Ensure headers are correct state before adding row
            const item = btn.closest('.doc-item');
            toggleProgramHeaders(item);

            const table = btn.previousElementSibling.querySelector('.program-kerja-tbody');
            const rowCount = table.querySelectorAll('tr').length + 1;
            const itemIndex = item.getAttribute('data-index');
            const isPMK = isPmkSelected(btn);

            // Get Users passed from controller
            const pukKoordinatorUsers = @json($pukKoordinatorUsers ?? []); // Koordinator = Role 3
            const pukPelaksanaUsers = @json($pukPelaksanaUsers ?? []); // Pelaksana = Role 4
            const pmkPicUsers = @json($pmkPicUsers ?? []); // Managers (Role 3)

            // Generate Options for PUK Koordinator (Role 4)
            let pukKoordinatorOptions = '<option value="" disabled selected>-- Pilih Koordinator --</option>';
            pukKoordinatorUsers.sort((a, b) => (a.nama_user || '').localeCompare(b.nama_user || ''));
            pukKoordinatorUsers.forEach(u => {
                pukKoordinatorOptions += `<option value="${u.nama_user}">${u.nama_user}</option>`;
            });

            // Generate Options for PUK Pelaksana (Role 3)
            let pukPelaksanaOptions = '<option value="" disabled selected>-- Pilih Pelaksana --</option>';
            pukPelaksanaUsers.sort((a, b) => (a.nama_user || '').localeCompare(b.nama_user || ''));
            pukPelaksanaUsers.forEach(u => {
                pukPelaksanaOptions += `<option value="${u.nama_user}">${u.nama_user}</option>`;
            });

            // Generate Options for PMK PIC (Manager)
            let pmkPicOptions = '<option value="" disabled selected>-- Pilih PIC (Manager) --</option>';
            pmkPicUsers.sort((a, b) => (a.nama_user || '').localeCompare(b.nama_user || ''));
            pmkPicUsers.forEach(u => {
                pmkPicOptions += `<option value="${u.nama_user}">${u.nama_user}</option>`;
            });

            const row = document.createElement('tr');

            if (isPMK) {
                // PMK Table: No | Uraian | PIC | Target (12) | Anggaran
                row.innerHTML = `
                    <td style="text-align: center; border: 1px solid #e2e8f0; vertical-align: middle; background-color: #f8fafc; font-weight: 500; color: #64748b; padding: 4px;">${rowCount}</td>
                    
                    <td style="border: 1px solid #e2e8f0; padding: 0;">
                        <textarea class="form-control" name="items[${itemIndex}][program_kerja][${rowCount - 1}][uraian]" 
                               placeholder="Uraian kegiatan..." required 
                               style="border: none; width: 100%; min-width: 150px; resize: vertical; padding: 6px; border-radius: 0; box-shadow: none; font-size: 12px;" rows="3"></textarea>
                    </td>
                    
                    <td style="border: 1px solid #e2e8f0; padding: 4px; min-width: 160px; vertical-align: middle;">
                        <input type="hidden" name="items[${itemIndex}][program_kerja][${rowCount - 1}][koordinator]" value="-">
                        <select class="form-select" name="items[${itemIndex}][program_kerja][${rowCount - 1}][pelaksana]" required 
                                style="width: 100%; padding: 6px; font-size: 12px; border: 1px solid #cbd5e1; border-radius: 4px;">
                            ${pmkPicOptions}
                        </select>
                    </td>

                    ${Array.from({ length: 12 }, (_, i) => `
                        <td style="border: 1px solid #e2e8f0; padding: 0; width: 40px; min-width: 40px;">
                            <input type="number" class="form-control target-input" name="items[${itemIndex}][program_kerja][${rowCount - 1}][target][${i}]" 
                                   min="0" placeholder="-"
                                   style="border: none; width: 100%; height: 100%; text-align: center; padding: 0; font-size: 11px; font-weight: 600; color: #3b82f6; background: transparent; border-radius: 0; box-sizing: border-box;">
                        </td>
                    `).join('')}
                    
                    <td style="border: 1px solid #e2e8f0; padding: 0;">
                        <input type="number" class="form-control" name="items[${itemIndex}][program_kerja][${rowCount - 1}][anggaran]" 
                               placeholder="Rp 0" min="0"
                               style="border: none; width: 100%; min-width: 120px; padding: 6px; border-radius: 0; font-size: 12px;">
                    </td>
                    
                    <td style="text-align: center; border: 1px solid #e2e8f0; vertical-align: middle; background-color: #f8fafc; padding: 4px;">
                        <button type="button" onclick="this.closest('tr').remove(); renumberProgramKerja(this)" 
                                class="delete-btn-hover"
                                title="Hapus Baris"
                                style="background: transparent; color: #ef4444; border: 1px solid #e2e8f0; border-radius: 6px; padding: 4px 8px; cursor: pointer; transition: all 0.2s;">
                            <i class="fas fa-trash-alt" style="font-size: 12px;"></i>
                        </button>
                    </td>
                `;
            } else {
                // PUK Table: No | Uraian | Koordinator (Role 4) | Pelaksana (Role 3) | Target (12)
                row.innerHTML = `
                    <td style="text-align: center; border: 1px solid #e2e8f0; vertical-align: middle; background-color: #f8fafc; font-weight: 500; color: #64748b; padding: 4px;">${rowCount}</td>
                    
                    <td style="border: 1px solid #e2e8f0; padding: 0;">
                        <textarea class="form-control" name="items[${itemIndex}][program_kerja][${rowCount - 1}][uraian]" 
                               placeholder="Uraian kegiatan..." required 
                               style="border: none; width: 100%; min-width: 150px; resize: vertical; padding: 6px; border-radius: 0; box-shadow: none; font-size: 12px;" rows="3"></textarea>
                    </td>
                    
                    <td style="border: 1px solid #e2e8f0; padding: 0;">
                        <select class="form-select" name="items[${itemIndex}][program_kerja][${rowCount - 1}][koordinator]" required 
                                style="border: none; width: 100%; min-width: 140px; padding: 6px; border-radius: 0; box-shadow: none; cursor: pointer; font-size: 12px;">
                            ${pukKoordinatorOptions}
                        </select>
                    </td>
                    
                    <td style="border: 1px solid #e2e8f0; padding: 0;">
                        <select class="form-select" name="items[${itemIndex}][program_kerja][${rowCount - 1}][pelaksana]" required 
                                style="border: none; width: 100%; min-width: 140px; padding: 6px; border-radius: 0; box-shadow: none; cursor: pointer; font-size: 12px;">
                            ${pukPelaksanaOptions}
                        </select>
                    </td>

                    ${Array.from({ length: 12 }, (_, i) => `
                        <td style="border: 1px solid #e2e8f0; padding: 0; width: 40px; min-width: 40px;">
                            <input type="number" class="form-control target-input" name="items[${itemIndex}][program_kerja][${rowCount - 1}][target][${i}]" 
                                   min="0" placeholder="-"
                                   style="border: none; width: 100%; height: 100%; text-align: center; padding: 0; font-size: 11px; font-weight: 600; color: #3b82f6; background: transparent; border-radius: 0; box-sizing: border-box;">
                        </td>
                    `).join('')}
                    
                    <td style="text-align: center; border: 1px solid #e2e8f0; vertical-align: middle; background-color: #f8fafc; padding: 4px;">
                        <button type="button" onclick="this.closest('tr').remove(); renumberProgramKerja(this)" 
                                class="delete-btn-hover"
                                title="Hapus Baris"
                                style="background: transparent; color: #ef4444; border: 1px solid #e2e8f0; border-radius: 6px; padding: 4px 8px; cursor: pointer; transition: all 0.2s;">
                            <i class="fas fa-trash-alt" style="font-size: 12px;"></i>
                        </button>
                    </td>
                `;
            }

            // Add hover effect via JS
            const delBtn = row.querySelector('button');
            delBtn.addEventListener('mouseenter', () => { delBtn.style.background = '#fee2e2'; delBtn.style.borderColor = '#ef4444'; });
            delBtn.addEventListener('mouseleave', () => { delBtn.style.background = 'transparent'; delBtn.style.borderColor = '#e2e8f0'; });

            table.appendChild(row);
        }
    </script>



    </form>
    </div> <!-- End Content-Area -->
    </main>
    </div> <!-- End Container -->
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Activity Heartbeat -->
    <script>
        function sendHeartbeat() {
            fetch('{{ route("activity.heartbeat") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    action: 'create',
                    doc_id: null
                })
            }).catch(e => console.error('Heartbeat failed', e));
        }

        // Send immediately on load, then every 15s
        document.addEventListener('DOMContentLoaded', () => {
            sendHeartbeat();
            setInterval(sendHeartbeat, 15000);
        });
    </script>
</body>

</html>