<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | HIRADC System - PT Semen Padang</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* ========================================
           DESIGN SYSTEM - CSS CUSTOM PROPERTIES
           ======================================== */
        :root {
            /* Brand Colors - PT Semen Padang */
            --primary: #c41e3a;
            --primary-dark: #9a1829;
            --primary-light: #e63950;
            --primary-50: #fef2f3;
            --primary-100: #fce7e9;
            --primary-200: #f9d0d4;
            --primary-600: #c41e3a;

            /* Neutral Palette */
            --gray-50: #fafafa;
            --gray-100: #f5f5f5;
            --gray-200: #e5e5e5;
            --gray-300: #d4d4d4;
            --gray-400: #a3a3a3;
            --gray-500: #737373;
            --gray-600: #525252;
            --gray-700: #404040;
            --gray-800: #262626;
            --gray-900: #171717;

            /* Semantic Colors */
            --success: #10b981;
            --success-light: #d1fae5;
            --warning: #f59e0b;
            --warning-light: #fef3c7;
            --error: #ef4444;
            --error-light: #fee2e2;
            --info: #3b82f6;
            --info-light: #dbeafe;

            /* Surface & Background - Enhanced */
            --bg-body: #f1f5f9;
            --surface: #ffffff;
            --surface-hover: #f9fafb;
            --surface-elevated: #ffffff;
            --border: #e2e8f0;
            --border-light: #f1f5f9;

            /* Text Colors */
            --text-primary: #111827;
            --text-secondary: #6b7280;
            --text-tertiary: #9ca3af;
            --text-inverse: #ffffff;

            /* Shadows - Enhanced */
            --shadow-xs: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-sm: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px -1px rgba(0, 0, 0, 0.1);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -4px rgba(0, 0, 0, 0.1);
            --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1);
            --shadow-colored: 0 10px 25px -5px rgba(196, 30, 58, 0.15);

            /* Spacing Scale */
            --space-1: 0.25rem;
            --space-2: 0.5rem;
            --space-3: 0.75rem;
            --space-4: 1rem;
            --space-5: 1.25rem;
            --space-6: 1.5rem;
            --space-8: 2rem;
            --space-10: 2.5rem;
            --space-12: 3rem;
            --space-16: 4rem;

            /* Border Radius */
            --radius-sm: 0.375rem;
            --radius-md: 0.5rem;
            --radius-lg: 0.75rem;
            --radius-xl: 1rem;
            --radius-2xl: 1.5rem;
            --radius-full: 9999px;

            /* Typography */
            --font-sans: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            --font-weight-normal: 400;
            --font-weight-medium: 500;
            --font-weight-semibold: 600;
            --font-weight-bold: 700;
            --font-weight-extrabold: 800;

            /* Transitions */
            --transition-fast: 150ms cubic-bezier(0.4, 0, 0.2, 1);
            --transition-base: 200ms cubic-bezier(0.4, 0, 0.2, 1);
            --transition-slow: 300ms cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* ========================================
           BASE STYLES
           ======================================== */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: var(--font-sans);
            background: var(--bg-body);
            background-image:
                radial-gradient(at 0% 0%, rgba(196, 30, 58, 0.05) 0px, transparent 50%),
                radial-gradient(at 100% 100%, rgba(59, 130, 246, 0.05) 0px, transparent 50%);
            background-attachment: fixed;
            color: var(--text-primary);
            line-height: 1.6;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            min-height: 100vh;
        }

        .container {
            display: flex;
            min-height: 100vh;
        }

        /* ========================================
           SIDEBAR - Enhanced Design
           ======================================== */
        .sidebar {
            width: 280px;
            background: #5b6fd8;
            border-right: 1px solid rgba(255, 255, 255, 0.1);
            position: fixed;
            height: 100vh;
            display: flex;
            flex-direction: column;
            z-index: 100;
            box-shadow: var(--shadow-md);
        }

        .logo-section {
            padding: var(--space-8) var(--space-6);
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
            background: linear-gradient(90deg, transparent 0%, rgba(255, 255, 255, 0.3) 50%, transparent 100%);
        }

        .logo-circle {
            width: 90px;
            height: 90px;
            margin: 0 auto var(--space-5);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all var(--transition-base);
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
            font-weight: var(--font-weight-bold);
            color: white;
            margin-bottom: var(--space-1);
            letter-spacing: -0.02em;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.15);
        }

        .logo-subtext {
            font-size: 0.75rem;
            color: rgba(255, 255, 255, 0.9);
            font-weight: var(--font-weight-semibold);
            text-transform: uppercase;
            letter-spacing: 0.1em;
        }

        .nav-menu {
            flex: 1;
            padding: var(--space-6) 0;
            overflow-y: auto;
            scrollbar-width: thin;
            scrollbar-color: var(--gray-300) transparent;
        }

        .nav-menu::-webkit-scrollbar {
            width: 6px;
        }

        .nav-menu::-webkit-scrollbar-track {
            background: transparent;
        }

        .nav-menu::-webkit-scrollbar-thumb {
            background: var(--gray-300);
            border-radius: var(--radius-full);
        }

        .nav-item {
            padding: var(--space-4) var(--space-6);
            margin: var(--space-1) var(--space-4);
            display: flex;
            align-items: center;
            gap: var(--space-3);
            cursor: pointer;
            transition: all var(--transition-base);
            color: rgba(255, 255, 255, 0.85);
            font-size: 0.9375rem;
            font-weight: var(--font-weight-medium);
            text-decoration: none;
            position: relative;
            border-radius: var(--radius-lg);
        }

        .nav-item:hover {
            background: rgba(255, 255, 255, 0.15);
            color: white;
            transform: translateX(4px);
        }

        .nav-item.active {
            background: rgba(255, 255, 255, 0.25);
            color: white;
            font-weight: var(--font-weight-semibold);
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
            border-radius: 0 var(--radius-md) var(--radius-md) 0;
        }

        .nav-item i {
            width: 20px;
            text-align: center;
            font-size: 1.125rem;
            transition: transform var(--transition-base);
        }

        .nav-item:hover i {
            transform: scale(1.1);
        }

        .user-info-bottom {
            padding: var(--space-6);
            border-top: 1px solid rgba(255, 255, 255, 0.15);
            background: transparent;
            position: relative;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: var(--space-3);
            margin-bottom: var(--space-4);
            position: relative;
            z-index: 1;
        }

        .user-avatar {
            width: 48px;
            height: 48px;
            background: var(--surface);
            border-radius: var(--radius-full);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #667eea;
            font-weight: var(--font-weight-bold);
            font-size: 1.125rem;
            flex-shrink: 0;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            border: 2px solid rgba(255, 255, 255, 0.2);
        }

        .user-details {
            flex: 1;
            min-width: 0;
        }

        .user-name {
            font-weight: var(--font-weight-semibold);
            font-size: 0.9375rem;
            color: white;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            margin-bottom: 2px;
        }

        .user-role {
            font-size: 0.75rem;
            color: rgba(255, 255, 255, 0.85);
            font-weight: var(--font-weight-medium);
        }

        .logout-btn {
            width: 100%;
            padding: var(--space-3) var(--space-4);
            background: rgba(255, 255, 255, 0.15);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.25);
            border-radius: var(--radius-lg);
            font-size: 0.875rem;
            font-weight: var(--font-weight-semibold);
            cursor: pointer;
            transition: all var(--transition-base);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: var(--space-2);
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

        /* ========================================
           MAIN CONTENT AREA
           ======================================== */
        .main-content {
            flex: 1;
            margin-left: 280px;
            padding: 0;
            background: var(--bg-body);
        }

        .header {
            background: linear-gradient(135deg, #ffffff 0%, #fef2f3 100%);
            padding: var(--space-8) var(--space-10);
            border-bottom: 1px solid var(--border);
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: var(--shadow-sm);
            position: sticky;
            top: 0;
            z-index: 50;
            backdrop-filter: blur(8px);
            position: relative;
        }

        .header::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: linear-gradient(90deg, transparent 0%, var(--primary) 50%, transparent 100%);
            opacity: 0.3;
        }

        .header h1 {
            font-size: 1.875rem;
            font-weight: var(--font-weight-bold);
            color: var(--text-primary);
            letter-spacing: -0.02em;
        }

        .content-area {
            padding: var(--space-10);
            max-width: 1600px;
            margin: 0 auto;
        }

        /* ========================================
           BREADCRUMB - Refined
           ======================================== */
        .breadcrumb {
            display: flex;
            align-items: center;
            gap: var(--space-2);
            margin-bottom: var(--space-8);
            font-size: 0.875rem;
            color: var(--text-secondary);
        }

        .breadcrumb-item {
            cursor: pointer;
            transition: color var(--transition-fast);
            font-weight: var(--font-weight-medium);
        }

        .breadcrumb-item:hover {
            color: var(--primary);
        }

        .breadcrumb-item.active {
            font-weight: var(--font-weight-semibold);
            color: var(--text-primary);
            cursor: default;
        }

        .breadcrumb-separator {
            color: var(--gray-300);
            font-size: 0.75rem;
        }


        /* ========================================
           RESPONSIVE GRID
           ======================================== */
        .cards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: var(--space-6);
        }

        /* ========================================
           DRILL CARDS - Premium Design
           ======================================== */
        .drill-card {
            background: linear-gradient(135deg, #ffffff 0%, #fef2f3 100%);
            padding: var(--space-8);
            border-radius: var(--radius-xl);
            box-shadow: var(--shadow-sm);
            cursor: pointer;
            transition: all var(--transition-slow);
            text-align: left;
            border: 1px solid var(--border);
            display: flex;
            flex-direction: column;
            justify-content: center;
            min-height: 160px;
            position: relative;
            overflow: hidden;
        }

        .drill-card::after {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 120px;
            height: 120px;
            background: radial-gradient(circle, var(--primary-50) 0%, transparent 70%);
            opacity: 0;
            transition: opacity var(--transition-slow);
            pointer-events: none;
        }

        .drill-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-colored);
            border-color: var(--primary-100);
            background: linear-gradient(135deg, #ffffff 0%, #fce7e9 100%);
        }

        .drill-card:hover::after {
            opacity: 1;
        }

        .drill-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 5px;
            height: 100%;
            background: linear-gradient(180deg, var(--primary) 0%, var(--primary-light) 100%);
            opacity: 0;
            transition: opacity var(--transition-base);
        }

        .drill-card:hover::before {
            opacity: 1;
        }

        .drill-card-icon {
            width: 56px;
            height: 56px;
            background: linear-gradient(135deg, var(--primary-50) 0%, var(--primary-100) 100%);
            border-radius: var(--radius-xl);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            font-size: 1.5rem;
            margin-bottom: var(--space-5);
            box-shadow: var(--shadow-sm);
            transition: all var(--transition-base);
        }

        .drill-card:hover .drill-card-icon {
            transform: scale(1.1) rotate(5deg);
            box-shadow: var(--shadow-md);
        }

        .drill-card h3 {
            font-size: 1.125rem;
            color: var(--text-primary);
            font-weight: var(--font-weight-bold);
            margin-bottom: var(--space-2);
            letter-spacing: -0.01em;
            line-height: 1.4;
        }

        .drill-card p {
            font-size: 0.875rem;
            color: var(--text-secondary);
            font-weight: var(--font-weight-medium);
            line-height: 1.5;
        }

        /* ========================================
           EMPTY STATE - Elegant
           ======================================== */
        .empty-state {
            text-align: center;
            padding: var(--space-16) var(--space-8);
            color: var(--text-tertiary);
            background: var(--surface);
            border-radius: var(--radius-xl);
            border: 2px dashed var(--border);
        }

        .empty-state i {
            font-size: 3rem;
            margin-bottom: var(--space-4);
            color: var(--gray-300);
        }

        .empty-state h3 {
            font-size: 1.125rem;
            font-weight: var(--font-weight-semibold);
            color: var(--text-secondary);
            margin-bottom: var(--space-2);
        }

        .empty-state p {
            font-size: 0.875rem;
            color: var(--text-tertiary);
        }

        /* ========================================
           TABLE SECTION - Modern & Clean
           ======================================== */
        .table-section {
            background: var(--surface);
            border-radius: var(--radius-xl);
            box-shadow: var(--shadow-sm);
            overflow: hidden;
            border: 1px solid var(--border);
            animation: fadeIn 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .table-header {
            padding: var(--space-6) var(--space-8);
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid var(--border);
            background: linear-gradient(to bottom, var(--surface) 0%, var(--gray-50) 100%);
        }

        .table-header h2 {
            font-size: 1.25rem;
            font-weight: var(--font-weight-bold);
            color: var(--text-primary);
            letter-spacing: -0.01em;
        }

        .custom-table {
            width: 100%;
            border-collapse: collapse;
        }

        .custom-table thead {
            background: var(--gray-50);
            border-bottom: 2px solid var(--border);
        }

        .custom-table th {
            padding: var(--space-4) var(--space-6);
            text-align: left;
            font-size: 0.75rem;
            font-weight: var(--font-weight-bold);
            text-transform: uppercase;
            color: var(--text-secondary);
            letter-spacing: 0.05em;
        }

        .custom-table tbody tr {
            border-bottom: 1px solid var(--border-light);
            transition: all var(--transition-fast);
        }

        .custom-table tbody tr:hover {
            background: var(--surface-hover);
        }

        .custom-table tbody tr:last-child {
            border-bottom: none;
        }

        .custom-table td {
            padding: var(--space-5) var(--space-6);
            font-size: 0.9375rem;
            color: var(--text-primary);
            vertical-align: middle;
            font-weight: var(--font-weight-medium);
        }

        .status-pill {
            padding: var(--space-1) var(--space-3);
            border-radius: var(--radius-full);
            font-size: 0.75rem;
            font-weight: var(--font-weight-semibold);
            text-transform: uppercase;
            display: inline-flex;
            align-items: center;
            gap: var(--space-1);
            letter-spacing: 0.025em;
        }

        .status-pill.approved {
            background-color: #e8f5e9;
            color: #2e7d32;
        }

        .btn-action {
            padding: 6px 14px;
            background: #c41e3a;
            color: white;
            border-radius: 6px;
            text-decoration: none;
            font-size: 12px;
            font-weight: 500;
            transition: background 0.2s;
            cursor: pointer;
        }

        .btn-action:hover {
            background: #a01830;
        }

        /* Modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 9999;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
            font-family: 'Inter', sans-serif;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 0;
            border: 1px solid #888;
            width: 600px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
            position: relative;
            animation: slideDown 0.3s ease-out;
        }

        @keyframes slideDown {
            from {
                transform: translateY(-50px);
                opacity: 0;
                transform: translateY(0);
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .modal-header {
            padding: 20px 30px;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-header h2 {
            font-size: 18px;
            font-weight: 700;
            color: #333;
            margin: 0;
        }

        .close-btn {
            color: #aaa;
            font-size: 24px;
            font-weight: bold;
            cursor: pointer;
        }

        .close-btn:hover {
            color: #c41e3a;
        }

        .modal-body {
            padding: 30px;
        }

        .section-title {
            font-size: 14px;
            font-weight: 700;
            color: #c41e3a;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .section-title.green {
            color: #2e7d32;
        }

        .info-row {
            display: flex;
            margin-bottom: 15px;
            align-items: flex-start;
        }

        .info-label {
            width: 140px;
            font-size: 14px;
            color: #888;
            font-weight: 500;
        }

        .info-value {
            flex: 1;
            font-size: 14px;
            color: #333;
            font-weight: 600;
        }

        /* Accordion Style */
        .accordion-container {
            max-width: 100%;
        }

        .accordion-item {
            background: white;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            margin-bottom: 10px;
            overflow: hidden;
            transition: all 0.3s;
        }

        .accordion-item:hover {
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .accordion-header {
            padding: 15px 20px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: #fff;
            transition: background 0.2s;
        }

        .accordion-header:hover {
            background: #f8f9fa;
        }

        .accordion-header.active {
            background: #f0f7ff;
            border-bottom: 1px solid #e0e0e0;
        }

        .dept-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .dept-icon {
            width: 36px;
            height: 36px;
            background: #e3f2fd;
            color: #1565c0;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
        }

        .dept-name {
            font-weight: 600;
            color: #333;
            font-size: 15px;
        }

        .accordion-icon {
            color: #999;
            transition: transform 0.3s;
        }

        .accordion-header.active .accordion-icon {
            transform: rotate(180deg);
            color: #1565c0;
        }

        .accordion-body {
            display: none;
            background: #fafafa;
            border-top: 1px solid #f0f0f0;
        }

        .accordion-body.show {
            display: block;
            animation: slideDown 0.3s ease-out;
        }

        .unit-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .unit-item {
            padding: 12px 20px 12px 60px;
            border-bottom: 1px solid #eee;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 14px;
            color: #555;
            transition: all 0.2s;
        }

        .unit-item:last-child {
            border-bottom: none;
        }

        .unit-item:hover {
            background: #fff;
            color: #c41e3a;
            padding-left: 65px;
        }

        .unit-item i {
            opacity: 0;
            transition: opacity 0.2s;
        }

        .unit-item:hover i {
            opacity: 1;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Sidebar -->
        @include('user.partials.sidebar')

        <!-- Main Content -->
        <main class="main-content">
            <div class="header">
                <h1>Dashboard Utama</h1>
            </div>
            <div class="content-area">
                <!-- Breadcrumb & Actions -->
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                    <div class="breadcrumb" id="breadcrumb" style="margin-bottom: 0;">
                        <span class="breadcrumb-item active" onclick="resetView()">Home</span>
                    </div>

                </div>
                <!-- Dynamic Content Container -->
                <div id="dynamicContent">
                    <!-- Javascript will render content here -->
                </div>
            </div>
        </main>
    </div>
    <!-- DETAIL MODAL -->
    <div id="detailModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Detail Form</h2><span class="close-btn" onclick="closeModal()">&times;
                </span>
            </div>
            <div class="modal-body">
                <!-- Data populated by JS -->
                <div class="section-title"><i class="fas fa-file-alt"></i>Informasi Form </div>
                <div class="info-row">
                    <div class="info-label">Judul Form:</div>
                    <div class="info-value" id="m_title"></div>
                </div>
                <!-- Add other fields as needed -->
                <div class="info-row">
                    <div class="info-label">Status:</div>
                    <div class="info-value"><span class="status-pill approved" id="m_status"></span></div>
                </div>
                <div class="info-row">
                    <div class="info-label">Unit Kerja:</div>
                    <div class="info-value" id="m_unit"></div>
                </div>
                <div class="info-row">
                    <div class="info-label">Penulis:</div>
                    <div class="info-value" id="m_author"></div>
                </div>
                <hr style="border: 0; border-top: 1px solid #eee; margin: 25px 0;">
                <div class="section-title green"><i class="fas fa-check-circle"></i>Informasi Persetujuan
                </div>
                <div class="info-row">
                    <div class="info-label">Tanggal Publish:</div>
                    <div class="info-value" id="m_date"></div>
                </div>
                <div class="info-row">
                    <div class="info-label">Disetujui Oleh:</div>
                    <div class="info-value" id="m_approver"></div>
                </div>
            </div>
        </div>
    </div>
    <script> // Data from Server
        const departments =
            @json($departemens)
            ;
        const units =
            @json($units)
            ;
        const documents =
            @json($documents)
            ;

        // State
        let currentLevel = 'dept'; // dept, unit, docs
        let selectedDept = null;
        let selectedUnit = null;

        document.addEventListener('DOMContentLoaded', () => {
            renderDepartments();
        });

        // ================= RENDER FUNCTIONS =================

        // Level 1: Departments (Accordion List)
        function renderDepartments() {
            currentLevel = 'dept';
            selectedDept = null;
            selectedUnit = null;
            updateBreadcrumb();

            const container = document.getElementById('dynamicContent');

            if (departments.length === 0) {
                container.innerHTML = `<div class="empty-state"><i class="fas fa-building"></i><p>Tidak ada departemen ditemukan.</p></div>`;
                return;
            }

            let html = '<div class="accordion-container">';

            // 1. Regular Departments (Excluding ID 0 and ID 93)
            const regularDepts = departments.filter(d => d.id_dept != 0 && d.id_dept != 93);

            regularDepts.forEach(dept => {
                // Pre-calculate units for this dept to check if empty
                const deptUnits = units.filter(u => u.id_dept == dept.id_dept);
                const unitCount = deptUnits.length;

                html += `
                    <div class="accordion-item">
                        <div class="accordion-header" onclick="toggleDepartment(${dept.id_dept})">
                            <div class="dept-info">
                                <div class="dept-icon"><i class="fas fa-building"></i></div>
                                <div class="dept-name">${dept.nama_dept}</div>
                            </div>
                            <div class="accordion-icon"><i class="fas fa-chevron-down"></i></div>
                        </div>
                        <div class="accordion-body" id="dept-${dept.id_dept}">
                            <ul class="unit-list">
                `;

                if (unitCount > 0) {
                    deptUnits.forEach(unit => {
                        html += `
                            <li class="unit-item" onclick="selectUnit(${unit.id_unit}, '${unit.nama_unit.replace(/'/g, "\\'")}', ${dept.id_dept})">
                                <span>${unit.nama_unit}</span>
                                <i class="fas fa-arrow-right"></i>
                            </li>
                        `;
                    });
                } else {
                    html += `<li class="unit-item" style="color: #999; cursor: default;">Tidak ada Unit Kerja</li>`;
                }

                html += `
                            </ul>
                        </div>
                    </div>
                `;
            });

            // 2. Unassigned Units
            const unassignedDept = departments.find(d => d.id_dept == 0);
            if (unassignedDept) {
                // Filter out ID 0
                const directUnits = units.filter(u => u.id_dept == 0 && u.id_unit != 0);
                if (directUnits.length > 0) {

                    directUnits.forEach(unit => {
                        html += `
                            <div class="accordion-item" onclick="selectUnit(${unit.id_unit}, '${unit.nama_unit.replace(/'/g, "\\'")}', 0)" style="cursor:pointer;">
                                <div class="accordion-header">
                                    <div class="dept-info">
                                        <div class="dept-icon" style="background:#fce4ec; color:#c2185b;"><i class="fas fa-layer-group"></i></div>
                                        <div class="dept-name">${unit.nama_unit}</div>
                                    </div>
                                    <div class="accordion-icon"><i class="fas fa-arrow-right"></i></div>
                                </div>
                            </div>
                        `;
                    });
                }
            }

            html += '</div>';
            container.innerHTML = html;
        }

        function toggleDepartment(id) {
            const body = document.getElementById(`dept-${id}`);
            if (!body) return;
            const header = body.previousElementSibling;

            // Toggle Logic
            const isShown = body.classList.contains('show');

            if (!isShown) {
                // Close others
                document.querySelectorAll('.accordion-body').forEach(el => el.classList.remove('show'));
                document.querySelectorAll('.accordion-header').forEach(el => el.classList.remove('active'));

                body.classList.add('show');
                header.classList.add('active');
            } else {
                body.classList.remove('show');
                header.classList.remove('active');
            }
        }

        // Helper to simulate selecting a department (for breadcrumb)
        function selectDepartment(id, name) {
            renderDepartments();
            // Expand the department
            setTimeout(() => {
                const body = document.getElementById(`dept-${id}`);
                if (body) {
                    body.classList.add('show');
                    body.previousElementSibling.classList.add('active');
                    // Scroll to it
                    body.parentElement.scrollIntoView({ behavior: 'smooth' });
                }
            }, 50);
        }

        // Level 3: Documents (Drill down from Accordion Unit click)
        function selectUnit(id, name, deptId) {
            renderUnitDocs(id, name, deptId, 'ALL');
        }

        function renderUnitDocs(id, name, deptId, filterCategory = 'ALL') {
            const container = document.getElementById('dynamicContent');
            const rawDocs = documents.filter(doc => doc.unit_id == id);

            // SPLIT MULTI-CATEGORY DOCS
            let unitDocs = [];
            if (Array.isArray(rawDocs)) {
                rawDocs.forEach(doc => {
                    if (doc.category && doc.category.includes(',')) {
                        const cats = doc.category.split(',').map(c => c.trim());
                        cats.forEach(c => {
                            unitDocs.push({ ...doc, category: c });
                        });
                    } else {
                        unitDocs.push(doc);
                    }
                });
            }

            // FILTER
            if (filterCategory !== 'ALL') {
                unitDocs = unitDocs.filter(doc => doc.category === filterCategory);
            }

            // Categories available for filter
            const categories = ['SHE', 'Security'];

            let html = `
                 <div class="table-section">
                     <div class="table-header" style="flex-wrap: wrap; gap: 10px;">
                         <div>
                             <h2 style="margin-bottom:5px;">Dokumen Terpublikasi - ${name}</h2>
                             <div style="font-size:12px; color:#666;">Menampilkan kategori: <b>${filterCategory}</b></div>
                         </div>
                         <div style="display:flex; gap:10px; align-items:center;">
                             <select onchange="renderUnitDocs(${id}, '${name.replace(/'/g, "\\'")}', ${deptId}, this.value)" style="padding:6px 12px; border-radius:6px; border:1px solid #ddd; font-size:13px; color:#333; cursor:pointer;">
                                 <option value="ALL" ${filterCategory === 'ALL' ? 'selected' : ''}>Semua Kategori</option>
                                 ${categories.map(c => `<option value="${c}" ${filterCategory === c ? 'selected' : ''}>${c}</option>`).join('')}
                             </select>
                             <button class="btn-action" style="background:#666;" onclick="selectDepartment(${deptId})"><i class="fas fa-arrow-left"></i> Kembali</button>
                         </div>
                     </div>
             `;

            if (unitDocs.length === 0) {
                html += `
                     <div style="text-align: center; padding: 40px; color: #999;">
                         <i class="fas fa-filter" style="font-size:30px; margin-bottom:10px;"></i>
                         <p>Tidak ada dokumen terpublikasi untuk kategori <b>${filterCategory}</b>.</p>
                     </div>`;
            } else {
                html += `
                     <table class="custom-table">
                         <thead>
                             <tr>
                                 <th>Judul Form</th>
                                 <th>Unit Pengelola</th>
                                 <th>Penulis</th>
                                 <th>Tanggal Publish</th>
                                 <th>Status</th>
                                 <th>Aksi</th>
                             </tr>
                         </thead>
                         <tbody>
                 `;

                unitDocs.forEach(doc => {
                    // Category Badge Color
                    let catColor = '#e0e0e0';
                    let catText = '#333';
                    if (doc.category == 'SHE') { catColor = '#dcfce7'; catText = '#166534'; }
                    else if (doc.category == 'Security') { catColor = '#e0f2fe'; catText = '#075985'; }

                    html += `
                         <tr>
                             <td>${doc.title}</td>
                             <td><span class="status-pill" style="background:${catColor}; color:${catText};">${doc.category || '-'}</span></td>
                             <td>${doc.author}</td>
                             <td>${doc.date}</td>
                             <td><span class="status-pill approved">DISETUJUI</span></td>
                             <td>
                                 <a href="#" class="btn-action" onclick="openDetail(${doc.id})">
                                     <i class="fas fa-eye"></i> Detail
                                 </a>
                                 <a href="/documents/${doc.id}/published?filter=${doc.category}" class="btn-action" style="background: #2563eb; margin-left: 5px;">
                                     <i class="fas fa-external-link-alt"></i> Buka
                                 </a>
                             </td>
                         </tr>
                     `;
                });

                html += `</tbody></table>`;
            }

            html += `</div>`;
            container.innerHTML = html;

            // Find dept name if not already selected
            const dept = departments.find(d => d.id_dept == deptId);
            selectedDept = { id: deptId, name: dept ? dept.nama_dept : '-' };

            selectedUnit = { id, name };
            currentLevel = 'docs';
            updateBreadcrumb();
        }

        // ================= HELPERS =================

        function updateBreadcrumb() {
            const bc = document.getElementById('breadcrumb');
            let html = `<span class="breadcrumb-item" onclick="renderDepartments()">Home</span>`;

            if (currentLevel === 'unit' || currentLevel === 'docs') {
                // In accordion view, 'unit' level is visually same as home but expanded. 
                // But strictly speaking we just have Home > [optional Dept] > [Unit]
                // Since we use drill down for Docs, we can show Dept.

                if (selectedDept) {
                    html += `
                        <span class="breadcrumb-separator"><i class="fas fa-chevron-right"></i></span>
                        <span class="breadcrumb-item" onclick="selectDepartment(${selectedDept.id}, '${selectedDept.name.replace(/'/g, "\\'")}')">
                            ${selectedDept.name}
                        </span>
                    `;
                }
            }

            if (currentLevel === 'docs' && selectedUnit) {
                html += `
                    <span class="breadcrumb-separator"><i class="fas fa-chevron-right"></i></span>
                    <span class="breadcrumb-item active">${selectedUnit.name}</span>
                `;
            }

            bc.innerHTML = html;
        }

        function resetView() {
            renderDepartments();
        }

        // ================= MODAL =================
        const modal = document.getElementById('detailModal');

        function openDetail(id) {
            const doc = documents.find(d => d.id == id);
            if (doc) showDetail(doc);
        }

        function showDetail(doc) {
            document.getElementById('m_title').innerText = doc.title;
            document.getElementById('m_status').innerText = "DISETUJUI";
            document.getElementById('m_unit').innerText = selectedUnit ? selectedUnit.name : '-';
            document.getElementById('m_author').innerText = doc.author;
            document.getElementById('m_date').innerText = doc.date;
            document.getElementById('m_approver').innerText = doc.approver || '-';

            modal.style.display = 'block';
        }

        function closeModal() {
            modal.style.display = 'none';
        }

        window.onclick = function (event) {
            if (event.target == modal) {
                closeModal();
            }
        }

    </script>
</body>

</html>