<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review Form - HIRADC</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

            /* Surface & Background */
            --bg-body: #f1f5f9;
            --surface: #ffffff;
            --surface-hover: #f9fafb;
            --border: #e2e8f0;
            --border-light: #f1f5f9;
            --border-radius: 16px;

            /* Spacing */
            --space-4: 1rem;
            --space-6: 1.5rem;
            --space-8: 2rem;
            --space-10: 2.5rem;

            --radius-lg: 0.75rem;
            --radius-xl: 1rem;
            --radius-full: 9999px;

            --sidebar-bg: #5b6fd8;

            /* Legacy Variables Support */
            --header-bg: #1e293b;
            --header-text: #ffffff;
            --border-color: #cbd5e1;
            --row-hover: #f1f5f9;
            --risk-section-bg: #ffffff;
            --input-bg: #f8fafc;
        }

        /* Base Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            outline: none;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg-body);
            background-image:
                radial-gradient(at 0% 0%, rgba(196, 30, 58, 0.05) 0px, transparent 50%),
                radial-gradient(at 100% 100%, rgba(59, 130, 246, 0.05) 0px, transparent 50%);
            background-attachment: fixed;
            color: var(--gray-900);
            padding-bottom: 120px;
        }

        .container {
            display: flex;
            min-height: 100vh;
        }

        /* Essential Sidebar Styles for Partial (Blue Theme) */
        .sidebar {
            width: 280px;
            background: #5b6fd8;
            border-right: 1px solid rgba(255, 255, 255, 0.1);
            position: fixed;
            height: 100vh;
            display: flex;
            flex-direction: column;
            z-index: 100;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        .logo-section {
            padding: var(--space-8) var(--space-6);
            border-bottom: 1px solid rgba(255, 255, 255, 0.15);
            text-align: center;
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
            margin: 0 auto 1.25rem;
            background: transparent;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s;
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
            color: white;
            margin-bottom: 0.25rem;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.15);
        }

        .logo-subtext {
            font-size: 0.75rem;
            color: rgba(255, 255, 255, 0.9);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.1em;
        }

        .nav-menu {
            flex: 1;
            padding: var(--space-6) 0;
            overflow-y: auto;
        }

        .nav-item {
            padding: 1rem 1.5rem;
            margin: 0.25rem 1rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            color: rgba(255, 255, 255, 0.85);
            font-weight: 500;
            text-decoration: none;
            border-radius: 0.75rem;
            transition: all 0.2s;
            font-size: 0.9375rem;
            position: relative;
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
            border-left: none;
            /* Override existing */
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
            border-radius: 0 4px 4px 0;
        }

        .badge {
            background: #ef4444;
            color: white;
            font-size: 0.65rem;
            padding: 2px 8px;
            border-radius: 99px;
            font-weight: 700;
            margin-left: auto;
            right: auto;
            /* Reset */
            position: relative;
            /* Reset */
        }

        .user-info-bottom {
            padding: 1.5rem;
            border-top: 1px solid rgba(255, 255, 255, 0.15);
            background: transparent;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 1rem;
        }

        .user-avatar {
            width: 48px;
            height: 48px;
            background: var(--surface);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #667eea;
            font-weight: 700;
            font-size: 1.125rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            border: 2px solid rgba(255, 255, 255, 0.2);
            flex-shrink: 0;
        }

        .user-name {
            font-weight: 600;
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
            margin-top: 0;
        }

        .logout-btn {
            width: 100%;
            padding: 0.75rem;
            background: rgba(255, 255, 255, 0.15);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.25);
            border-radius: 0.75rem;
            font-size: 0.875rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            text-decoration: none;
            backdrop-filter: blur(10px);
        }

        .logout-btn:hover {
            background: rgba(255, 255, 255, 0.25);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        .main-content {
            flex: 1;
            margin-left: 280px;
            padding: 32px 48px;
            max-width: 1400px;
        }

        /* Laptop Optimization (max-width: 1440px) */
        @media (max-width: 1440px) {
            .sidebar {
                width: 220px;
            }

            .main-content {
                margin-left: 220px;
                padding: 24px 32px;
            }

            /* Compact Sidebar Elements */
            .logo-section {
                padding: 20px 15px;
            }

            .logo-circle {
                width: 55px;
                height: 55px;
                margin-bottom: 10px;
            }

            .logo-text {
                font-size: 16px;
                margin-bottom: 2px;
            }

            .logo-subtext {
                font-size: 11px;
            }

            .nav-item {
                padding: 10px 18px;
                font-size: 13px;
                gap: 10px;
            }

            .user-info-bottom {
                padding: 15px;
            }

            /* Compact Content Elements */
            .page-header {
                margin-bottom: 20px;
            }

            .header-title h1 {
                font-size: 20px;
            }

            .doc-card {
                margin-bottom: 20px;
            }

            .doc-header {
                padding: 15px 24px;
            }

            .doc-title-value {
                font-size: 16px;
            }

            /* Compact Table */
            .excel-table th,
            .excel-table td {
                padding: 6px 8px;
            }

            .excel-table {
                font-size: 12px;
            }

            .cell-textarea,
            .cell-input {
                padding: 6px 8px;
                min-height: 70px;
                font-size: 12px;
            }

            /* Compact Footer */
            .review-footer {
                left: 240px;
                padding: 10px 20px;
                bottom: 15px;
            }

            .notes-input {
                padding: 8px 12px;
                font-size: 13px;
            }

            .action-btns .btn {
                padding: 8px 16px;
                font-size: 13px;
            }
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 32px;
        }

        .header-title h1 {
            font-size: 24px;
            font-weight: 800;
            color: var(--text-main);
            letter-spacing: -0.03em;
            margin-bottom: 4px;
        }

        .header-title p {
            font-size: 14px;
            color: var(--text-sub);
        }

        .btn-back {
            padding: 8px 16px;
            border-radius: 6px;
            background: white;
            border: 1px solid var(--border);
            color: var(--text-main);
            font-weight: 600;
            font-size: 13px;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s;
        }

        .btn-back:hover {
            background: var(--bg-body);
            border-color: var(--text-sub);
        }

        /* Cards */
        .doc-card {
            background: white;
            border-radius: 16px;
            border: 1px solid var(--border);
            box-shadow: var(--shadow-sm);
            overflow: hidden;
            margin-bottom: 24px;
        }

        .doc-header {
            background: #f8fafc;
            padding: 20px 32px;
            border-bottom: 1px solid var(--border);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .doc-title-label {
            font-size: 12px;
            color: var(--text-sub);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 4px;
        }

        .doc-title-value {
            font-size: 20px;
            font-weight: 800;
            color: var(--text-main);
        }

        .doc-meta-badge {
            background: var(--primary-light);
            color: var(--primary);
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
        }

        .card-header-slim {
            padding: 16px 24px;
            border-bottom: 1px solid var(--border);
            background: #f8fafc;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .card-header-slim i {
            color: var(--primary);
        }

        .card-header-slim h2 {
            font-size: 15px;
            font-weight: 700;
            color: var(--text-main);
        }

        /* PROFESSIONAL ENTERPRISE HIRADC TABLE */
        :root {
            --header-bg: #1e293b;
            --header-text: #ffffff;
            --border-color: #cbd5e1;
            --row-hover: #f1f5f9;
            --risk-section-bg: #ffffff;
            --input-bg: #f8fafc;
        }

        .hiradc-wrapper {
            overflow-x: auto;
            overflow-y: auto;
            max-height: calc(100vh - 250px);
            width: 100%;
            background: white;
            border: 1px solid var(--border-color);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            margin-bottom: 100px;
            position: relative;
        }

        .excel-table {
            width: max-content;
            min-width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            font-family: 'Inter', 'Segoe UI', sans-serif;
            font-size: 13px;
            color: #1e293b;
            table-layout: auto;
        }

        /* --- HEADERS --- */
        .excel-table thead {
            position: sticky;
            top: 0;
            z-index: 50;
        }

        .excel-table thead th {
            background: var(--header-bg);
            color: var(--header-text);
            padding: 10px 12px;
            border-right: 1px solid #334155;
            border-bottom: 1px solid #334155;
            text-align: center;
            vertical-align: middle;
            font-weight: 600;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.03em;
            white-space: nowrap;
        }

        .excel-table thead tr:first-child th {
            background: #0f172a;
            /* Darker Top Header */
            font-size: 13px;
            border-bottom: 1px solid #334155;
        }

        /* Sticky First Column Header */
        .excel-table thead tr:first-child th:first-child {
            position: sticky;
            left: 0;
            z-index: 52;
            border-right: 2px solid #475569;
        }

        /* --- BODY --- */
        .excel-table tbody td {
            border-right: 1px solid var(--border-color);
            border-bottom: 1px solid var(--border-color);
            background: white;
            vertical-align: top;
            padding: 0;
            transition: background 0.1s;
        }

        /* Sticky First Column Body */
        .excel-table tbody td:first-child {
            position: sticky;
            left: 0;
            background: #f8fafc;
            z-index: 40;
            border-right: 2px solid #94a3b8;
            /* Stronger separation */
            text-align: center;
            vertical-align: top;
            padding-top: 15px;
            font-weight: 700;
            color: #64748b;
        }

        .excel-table tbody td:first-child:hover {
            background: #f1f5f9;
        }

        /* --- INPUT STYLING --- */
        /* Inputs fill the cell but look cleaner */
        .cell-textarea,
        .cell-input,
        .cell-select {
            width: 100%;
            min-width: 220px;
            height: 100%;
            min-height: 100px;
            border: none;
            padding: 12px 14px;
            /* Comfortable padding */
            font-family: inherit;
            font-size: 13px;
            line-height: 1.5;
            color: #334155;
            background: transparent;
            resize: none;
            outline: none;
        }

        .cell-textarea:focus,
        .cell-input:focus,
        .cell-select:focus {
            background: #fce7f3;
            /* Very subtle highlight on focus */
            box-shadow: inset 0 0 0 2px #db2777;
            /* Pink/Red focus ring for visibility */
            color: #be185d;
        }

        /* --- SECTIONS & GROUPS --- */
        /* Alternate Section Backgrounds for readability */
        .group-risk {
            background-color: #fdf2f8 !important;
        }

        /* Pinkish tint for Risk */
        .group-control {
            background-color: #f0f9ff !important;
        }

        /* Blue tint for Control */

        /* Thick Borders between Groups */
        .excel-table th.section-border-right,
        .excel-table td.section-border-right {
            border-right: 3px solid #94a3b8 !important;
            /* Visible Separation */
        }

        /* --- RISK COLUMNS (L, S, R) --- */
        .risk-col {
            width: 50px;
            text-align: center;
            background: #fff;
            vertical-align: top;
            padding: 5px !important;
        }

        .risk-select {
            width: 100%;
            padding: 8px 2px;
            border: 1px solid #e2e8f0;
            border-radius: 4px;
            text-align: center;
            font-weight: 700;
            color: #334155;
            cursor: pointer;
            background-color: #fff;
            appearance: none;
            font-size: 14px;
        }

        .risk-select:focus {
            border-color: #db2777;
            box-shadow: 0 0 0 2px rgba(219, 39, 119, 0.2);
        }

        /* --- WIDGETS --- */
        .cell-checkbox-group {
            padding: 12px;
            display: flex;
            flex-direction: column;
            gap: 8px;
            min-width: 280px;
        }

        .cell-checkbox-item {
            display: flex;
            gap: 10px;
            font-size: 13px;
            align-items: flex-start;
            line-height: 1.4;
            color: #334155;
        }

        .cell-checkbox-item input {
            margin-top: 3px;
            accent-color: #db2777;
        }

        /* Footer */
        .review-footer {
            position: fixed;
            bottom: 20px;
            left: 270px;
            right: 20px;
            width: auto;
            max-width: calc(100vw - 290px);
            background: #1e293b;
            color: white;
            padding: 15px 25px;
            border-radius: 12px;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.2);
            z-index: 1000;
            display: flex;
            gap: 16px;
            align-items: center;
        }

        .notes-section {
            flex: 1;
            min-width: 0;
        }

        .notes-input {
            background: #334155;
            border: 1px solid #475569;
            color: white;
            width: 100%;
            padding: 10px 15px;
            border-radius: 6px;
        }

        .notes-input::placeholder {
            color: #94a3b8;
        }

        .action-btns .btn {
            padding: 10px 20px;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            font-weight: 600;
        }

        .btn-revise {
            background: #ef4444;
            color: white;
            margin-right: 10px;
        }

        .btn-approve {
            background: #22c55e;
            color: white;
        }

        /* Risk Badge */
        .risk-score-box {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100px;
        }

        .risk-val {
            font-size: 18px;
            font-weight: 800;
            color: #1e293b;
        }

        .risk-badge {
            font-size: 11px;
            padding: 2px 8px;
            border-radius: 10px;
            margin-top: 4px;
            font-weight: 700;
            color: white;
        }

        .bg-low {
            background: #16a34a;
        }

        .bg-med {
            background: #ca8a04;
        }

        .bg-high {
            background: #dc2626;
        }

        /* ===== RESPONSIVE IMPROVEMENTS ===== */
        /* Ensure layout stability during zoom and device resize */

        /* Large screens (1600px and below) */
        @media (max-width: 1600px) {
            .hiradc-wrapper {
                max-height: calc(100vh - 300px);
            }

            .excel-table {
                font-size: 12px;
            }

            .cell-textarea,
            .cell-input {
                min-width: 180px;
                font-size: 12px;
                padding: 10px 12px;
            }

            .review-footer {
                padding: 12px 20px;
                left: 280px;
                right: 20px;
            }
        }

        /* Medium screens (1366px and below) */
        @media (max-width: 1366px) {
            .main-content {
                padding: 24px 32px;
            }

            .excel-table {
                font-size: 11px;
            }

            .cell-textarea,
            .cell-input {
                min-width: 160px;
                min-height: 80px;
            }

            .review-footer {
                padding: 10px 16px;
                left: 280px;
                right: 16px;
            }

            .notes-input {
                font-size: 13px;
            }
        }

        /* Small screens (1024px and below) */
        @media (max-width: 1024px) {
            .sidebar {
                width: 220px;
            }

            .main-content {
                margin-left: 220px;
                padding: 20px 24px;
            }

            .review-footer {
                left: 240px;
                right: 16px;
                width: auto;
                flex-direction: column;
                gap: 12px;
                align-items: stretch;
            }

            .notes-section {
                width: 100%;
            }

            .action-btns {
                width: 100%;
                display: flex;
                justify-content: flex-end;
                gap: 10px;
            }
        }

        /* Zoom stability - prevent text scaling issues */
        @media (min-resolution: 1.25dppx) {
            body {
                -webkit-text-size-adjust: 100%;
                text-size-adjust: 100%;
            }

            .excel-table {
                transform-origin: top left;
            }
        }

        /* Prevent layout shift during zoom */
        * {
            box-sizing: border-box;
            min-width: 0;
            min-height: 0;
        }

        /* Ensure modal is always centered and responsive */
        #editModal .modal-content {
            margin: 2vh auto;
            max-height: 96vh;
            width: 90%;
            max-width: min(900px, 90vw);
        }

        /* Ensure wrapper doesn't overflow */
        .hiradc-wrapper {
            position: relative;
            width: 100%;
            max-width: 100%;
        }

        /* Ensure footer adapts to viewport */
        @media (max-width: 768px) {
            .review-footer {
                left: 20px;
                right: 20px;
                width: calc(100% - 40px);
                bottom: 10px;
            }

            .sidebar {
                width: 200px;
            }

            .main-content {
                margin-left: 200px;
                padding: 16px;
            }
        }

        /* === TIMELINE / HISTORY CARD === */
        .timeline-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            padding: 24px;
            margin-bottom: 30px;
            border: 1px solid #e2e8f0;
        }

        .timeline-header {
            font-size: 16px;
            font-weight: 700;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            color: #1e293b;
        }

        .timeline-header i {
            color: var(--primary-color);
        }

        .timeline-item {
            position: relative;
            padding-left: 32px;
            margin-bottom: 24px;
            border-left: 2px solid #e2e8f0;
        }

        .timeline-item:last-child {
            margin-bottom: 0;
            border-left-color: transparent;
        }

        .timeline-dot {
            position: absolute;
            left: -6px;
            top: 2px;
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: #94a3b8;
            border: 2px solid white;
        }

        .timeline-active .timeline-dot {
            background: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(196, 30, 58, 0.2);
            width: 12px;
            height: 12px;
            left: -7px;
        }

        .timeline-created .timeline-dot {
            background: #3b82f6;
        }

        .timeline-approved .timeline-dot {
            background: #22c55e;
        }

        .timeline-revised .timeline-dot {
            background: #f59e0b;
        }

        .timeline-published .timeline-dot {
            background: #8b5cf6;
        }

        .timeline-meta {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 6px;
        }

        .timeline-action {
            font-size: 14px;
            font-weight: 600;
            color: #1e293b;
        }

        .timeline-badge {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .badge-created {
            background: #dbeafe;
            color: #1e40af;
        }

        .badge-approved {
            background: #d1fae5;
            color: #065f46;
        }

        .badge-revised {
            background: #fef3c7;
            color: #92400e;
        }

        .badge-published {
            background: #ede9fe;
            color: #5b21b6;
        }

        .timeline-user {
            font-size: 13px;
            color: #64748b;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .timeline-user i {
            font-size: 12px;
        }

        .timeline-date {
            font-size: 12px;
            color: #94a3b8;
            margin-top: 4px;
        }

        .timeline-comment {
            font-size: 13px;
            color: #475569;
            margin-top: 8px;
            background: #f8fafc;
            padding: 10px 12px;
            border-radius: 6px;
            border-left: 3px solid #cbd5e1;
            font-style: italic;
        }

        .timeline-empty {
            text-align: center;
            padding: 40px;
            color: #94a3b8;
            font-size: 14px;
        }

        /* === WIZARD / PROGRESS BAR === */
        .wizard-container {
            background: white;
            border-radius: 12px;
            padding: 30px;
            border: 1px solid #e2e8f0;
            margin-bottom: 30px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        .wizard-steps {
            display: flex;
            justify-content: space-between;
            position: relative;
        }

        .wizard-steps::before {
            content: '';
            position: absolute;
            top: 18px;
            left: 0;
            right: 0;
            height: 3px;
            background: #e2e8f0;
            z-index: 1;
            border-radius: 10px;
        }

        .step-item {
            position: relative;
            z-index: 2;
            text-align: center;
            flex: 1;
        }

        .step-circle {
            width: 40px;
            height: 40px;
            background: white;
            border: 3px solid #cbd5e1;
            border-radius: 50%;
            margin: 0 auto 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #cbd5e1;
            font-weight: 700;
            font-size: 14px;
            transition: all 0.3s;
        }

        .step-label {
            font-size: 13px;
            color: #64748b;
            font-weight: 600;
            margin-top: 8px;
        }

        /* Active State */
        .step-item.active .step-circle {
            border-color: var(--primary);
            background: #fff1f2;
            color: var(--primary);
            box-shadow: 0 0 0 4px rgba(196, 30, 58, 0.1);
        }

        .step-item.active .step-label {
            color: var(--primary);
            font-weight: 700;
        }

        /* Completed State */
        .step-item.completed .step-circle {
            background: var(--primary);
            border-color: var(--primary);
            color: white;
        }

        .step-item.completed .step-label {
            color: var(--primary);
        }

        /* CUSTOM TABS styling */
        .page-tabs {
            display: flex;
            gap: 10px;
            margin-bottom: 24px;
            border-bottom: 2px solid #e2e8f0;
            padding-bottom: 1px;
        }

        .tab-btn {
            background: transparent;
            border: none;
            padding: 12px 24px;
            font-family: inherit;
            font-size: 15px;
            font-weight: 600;
            color: #64748b;
            cursor: pointer;
            position: relative;
            transition: all 0.2s;
            border-radius: 8px 8px 0 0;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .tab-btn:hover {
            color: var(--primary);
            background: rgba(196, 30, 58, 0.05);
        }

        .tab-btn.active {
            color: var(--primary);
            background: white;
            border: 1px solid #e2e8f0;
            border-bottom-color: transparent;
            margin-bottom: -3px;
            /* Cover the bottom border */
            z-index: 2;
            box-shadow: 0 -4px 6px -1px rgba(0, 0, 0, 0.05);
        }

        .tab-btn.active::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            right: 0;
            height: 4px;
            background: white;
        }

        .tab-btn .badge-counter {
            background: #e2e8f0;
            color: #475569;
            font-size: 11px;
            padding: 2px 8px;
            border-radius: 99px;
            transition: all 0.2s;
        }

        .tab-btn.active .badge-counter {
            background: var(--primary-light);
            color: var(--primary);
        }

        .tab-content {
            display: none;
            animation: fadeIn 0.3s ease-in-out;
        }

        .tab-content.active {
            display: block;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(5px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Sidebar -->
        @include('partials.sidebar')

        <!-- Main Content -->
        <main class="main-content">
            <div class="page-header">
                <div class="header-title">
                    <h1>Review & Edit Form</h1>
                    <p>Periksa, edit jika perlu, dan setujui atau minta revisi.</p>
                </div>
                <a href="{{ route('approver.check_documents') }}" class="btn-back"><i class="fas fa-arrow-left"></i>
                    Kembali</a>
            </div>

            <!-- Header Card (Summary) -->
            <div class="doc-card">
                <div class="doc-header" style="justify-content: flex-start; gap: 30px; align-items: center;">
                    <div>
                        <div class="doc-title-label">Judul Form</div>
                        <div class="doc-title-value">{{ $document->judul_dokumen ?? $document->kolom2_kegiatan }}</div>
                    </div>

                    <div>
                        <div class="doc-title-label">Unit / Seksi</div>
                        <div class="doc-title-value" style="font-size:16px;">{{ $document->unit->nama_unit ?? '-' }} /
                            {{ $document->seksi->nama_seksi ?? '-' }}
                        </div>
                    </div>


                </div>
            </div>

            <!-- Progress Wizard -->
            <div class="wizard-container">
                <div class="wizard-steps">
                    <div class="step-item {{ $document->current_level >= 1 ? 'completed' : 'active' }}">
                        <div class="step-circle"><i class="fas fa-file-signature"></i></div>
                        <div class="step-label">Draft & Submit</div>
                    </div>
                    <div
                        class="step-item {{ $document->current_level > 1 ? 'completed' : ($document->current_level == 1 ? 'active' : '') }}">
                        <div class="step-circle">1</div>
                        <div class="step-label">Kepala Unit</div>
                    </div>
                    <div
                        class="step-item {{ $document->current_level > 2 ? 'completed' : ($document->current_level == 2 ? 'active' : '') }}">
                        <div class="step-circle">2</div>
                        <div class="step-label">Unit Pengelola</div>
                    </div>
                    <div
                        class="step-item {{ ($document->status == 'approved' || $document->status == 'published') ? 'completed' : ($document->current_level == 3 ? 'active' : '') }}">
                        <div class="step-circle">3</div>
                        <div class="step-label">Kepala Dept.</div>
                    </div>
                    <div
                        class="step-item {{ ($document->status == 'approved' || $document->status == 'published') ? 'completed active' : '' }}">
                        <div class="step-circle"><i class="fas fa-check"></i></div>
                        <div class="step-label">Selesai</div>
                    </div>
                </div>
                @if($document->status == 'revision')
                    <div
                        style="background: #fff7ed; color: #c2410c; padding: 15px; border-radius: 8px; margin-top: 25px; font-size: 14px; border:1px solid #fdba74; display: flex; align-items: start; gap: 12px;">
                        <i class="fas fa-exclamation-triangle" style="margin-top: 2px;"></i>
                        <div>
                            <strong>Form Perlu Revisi</strong>
                            <p style="margin-top: 4px; opacity: 0.9;">Form ini dikembalikan dengan catatan tertentu.
                                Silakan cek bagian "Riwayat Approval" di bawah untuk detail.</p>
                        </div>
                    </div>
                @endif
            </div>

            @php
                // Fetch Programs for Tabs (Loop Logic)
                $programs = [];
                $hasPrograms = false;
                $programCount = 0;
                
                foreach($document->details as $detail) {
                    if($detail->pukProgram) {
                        $hasPrograms = true;
                        $programCount++;
                    }
                    if($detail->pmkProgram) {
                        $hasPrograms = true;
                        $programCount++;
                    }
                }
            @endphp

            <!-- TABS LOGIC & NAVIGATION -->
            <div class="page-tabs">
                <button type="button" class="tab-btn active" onclick="openTab(event, 'tab-hiradc')">
                    <i class="fas fa-table"></i> HIRADC
                </button>
                @if($hasPrograms)
                    <button type="button" class="tab-btn" onclick="openTab(event, 'tab-programs')">
                        <i class="fas fa-tasks"></i> Program Kerja
                        <span class="badge-counter">{{ $programCount }}</span>
                    </button>
                @endif
            </div>

            <!-- TAB 1: HIRADC CONTENT -->
            <div id="tab-hiradc" class="tab-content active">
                <div style="display:flex; justify-content:flex-end; gap:10px; margin-bottom:15px;">
                    <a href="{{ route('documents.export.detail.pdf', $document->id) }}" target="_blank"
                        style="padding: 8px 16px; background: #c41e3a; color: white; border-radius: 8px; text-decoration: none; font-size: 13px; font-weight: 600; display: flex; align-items: center; box-shadow: 0 2px 4px rgba(196, 30, 58, 0.2); transition: all 0.2s;"
                        onmouseover="this.style.background='#9a1829'; this.style.transform='translateY(-1px)'"
                        onmouseout="this.style.background='#c41e3a'; this.style.transform='none'">
                        <i class="fas fa-file-pdf" style="margin-right: 6px;"></i> PDF
                    </a>
                    <a href="{{ route('documents.export.detail.excel', $document->id) }}" target="_blank"
                        style="padding: 8px 16px; background: #10b981; color: white; border-radius: 8px; text-decoration: none; font-size: 13px; font-weight: 600; display: flex; align-items: center; box-shadow: 0 2px 4px rgba(16, 185, 129, 0.2); transition: all 0.2s;"
                        onmouseover="this.style.background='#059669'; this.style.transform='translateY(-1px)'"
                        onmouseout="this.style.background='#10b981'; this.style.transform='none'">
                        <i class="fas fa-file-excel" style="margin-right: 6px;"></i> Excel
                    </a>
                </div>

                <form id="reviewForm" method="POST" action="">
                    @csrf
                    <input type="hidden" name="action" id="action_input">
                    <input type="hidden" name="catatan" id="catatan_input_form">
                    <input type="hidden" name="kategori" value="{{ $document->kategori }}">

                    <div class="hiradc-wrapper">
                        <table class="excel-table">
                            <thead>
                                <!-- Header Row 1: Main Sections (BAGIAN 1-5) -->
                                <tr>
                                    <th rowspan="2" style="width: 40px;">No</th>
                                    <th colspan="4" class="section-border-right">BAGIAN 1: Identifikasi Aktivitas</th>
                                    <th colspan="6" class="section-border-right">BAGIAN 2: Identifikasi</th>
                                    <th colspan="5" class="section-border-right">BAGIAN 3: Pengendalian & Penilaian Awal
                                    </th>
                                    <th colspan="3" class="section-border-right">BAGIAN 4: Legalitas & Signifikansi</th>
                                    <th colspan="5">BAGIAN 5: Mitigasi Lanjutan</th>
                                </tr>
                                <!-- Header Row 2: Column Details -->
                                <tr>
                                    <!-- BAGIAN 1 (Kolom 2-5) -->
                                    <th style="width: 300px;">PROSES BISNIS /<br>KEGIATAN / ASET<br><small>(Kol 2)</small></th>
                                    <th style="width: 120px;">Lokasi<br><small>(Kol 3)</small></th>
                                    <th style="width: 80px;">Kategori<br><small>(Kol 4)</small></th>
                                    <th style="width: 90px;" class="section-border-right">Kondisi<br><small>(Kol
                                            5)</small>
                                    </th>

                                    <!-- BAGIAN 2 (Kolom 6-9) -->
                                    <th style="width: 150px;">Potensi Bahaya<br><small>(Kol 6)</small></th>
                                    <th style="width: 150px;">Aspek Lingkungan<br><small>(Kol 7)</small></th>
                                    <th style="width: 150px;">Ancaman Keamanan<br><small>(Kol 8)</small></th>

                                    <th style="width: 150px;">RISIKO (K3/KO)<br><small>(Kol 9)</small></th>
                                    <th style="width: 150px;">DAMPAK (Lingk)<br><small>(Kol 9)</small></th>
                                    <th style="width: 150px;" class="section-border-right">CELAH
                                        (Keamanan)<br><small>(Kol
                                            9)</small></th>

                                    <!-- BAGIAN 3 (Kolom 10-14) -->
                                    <th style="width: 250px;">Hirarki Pengendalian<br><small>(Kol 10)</small></th>
                                    <th style="width: 250px;">Pengendalian Existing<br><small>(Kol 11)</small></th>
                                    <th style="width: 50px;">L<br><small>(Kol 12)</small></th>
                                    <th style="width: 50px;">S<br><small>(Kol 13)</small></th>
                                    <th style="width: 80px;" class="section-border-right">Level<br><small>(Kol
                                            14)</small>
                                    </th>

                                    <!-- BAGIAN 4 (Kolom 15-17) -->
                                    <th style="width: 200px;">Regulasi<br><small>(Kol 15)</small></th>
                                    <th style="width: 80px;">Aspek Penting<br><small>(Kol 16)</small></th>
                                    <th style="width: 200px;" class="section-border-right">Peluang &
                                        Risiko<br><small>(Kol
                                            17)</small></th>

                                    <!-- BAGIAN 5 (Kolom 18-22) -->
                                    <th style="width: 100px;">Toleransi<br><small>(Kol 18)</small></th>
                                    <th style="width: 200px;">Pengendalian Lanjut<br><small>(Kol 19)</small></th>
                                    <th style="width: 50px;">L<br><small>(Kol 20)</small></th>
                                    <th style="width: 50px;">S<br><small>(Kol 21)</small></th>
                                    <th style="width: 80px;">Level<br><small>(Kol 22)</small></th>

                                </tr>
                            </thead>
                            <tbody>
                                @forelse($document->details as $index => $item)
                                    @php
                                        $skip = false;

                                        // ONLY apply filtering logic if document is in revision mode
                                        if ($document->status == 'revision') {
                                            // Check which categories are locked (approved/published)
                                            $isSheLocked = ($document->status_she == 'approved' || $document->status_she == 'published');
                                            $isSecLocked = ($document->status_security == 'approved' || $document->status_security == 'published');

                                            // Check which categories are in revision
                                            $isSheRevision = ($document->status_she == 'revision');
                                            $isSecRevision = ($document->status_security == 'revision');

                                            // Priority 1: If a specific track is in revision, ONLY show that track
                                            if ($isSheRevision && !$isSecRevision) {
                                                // SHE is revising, Security is NOT revising
                                                // Show ONLY SHE categories (K3, KO, Lingkungan)
                                                if (!in_array($item->kategori, ['K3', 'KO', 'Lingkungan'])) {
                                                    $skip = true;
                                                }
                                            } elseif ($isSecRevision && !$isSheRevision) {
                                                // Security is revising, SHE is NOT revising
                                                // Show ONLY Security category (Keamanan)
                                                if ($item->kategori != 'Keamanan') {
                                                    $skip = true;
                                                }
                                            } elseif ($isSheRevision && $isSecRevision) {
                                                // Both are revising - show all items
                                                // No filtering needed
                                            } else {
                                                // Neither is revising - check for locked status
                                                if ($item->kategori == 'Keamanan' && $isSecLocked) {
                                                    $skip = true;
                                                }
                                                if (in_array($item->kategori, ['K3', 'KO', 'Lingkungan']) && $isSheLocked) {
                                                    $skip = true;
                                                }
                                            }
                                        }
                                        // If not in revision mode, show everything
                                    @endphp
                                    @if($skip) @continue @endif

                                    <tr>
                                        <td style="text-align:center; padding-top:20px; font-size:14px; color:#1e293b;">
                                            {{ $index + 1 }}
                                            @if($document->canBeApprovedBy(Auth::user()))
                                                <div style="margin-top:5px;">
                                                    <button type="button" class="btn-sm"
                                                        style="background:none; border:none; color:#f59e0b; cursor:pointer;"
                                                        onclick="openEditModal({{ json_encode($item) }})">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                </div>
                                            @endif
                                        </td>
                                        <!-- BAGIAN 1: Identifikasi Aktivitas -->
                                        <!-- Kolom 2: Proses Bisnis / Kegiatan -->
                                        <td>
                                            <div class="cell-text"><strong>{{ $item->kolom2_proses }}</strong></div>
                                            @if($item->kolom2_kegiatan)
                                                <div class="cell-text" style="margin-top:4px; color:#64748b;">kegiatan/aset : {{ $item->kolom2_kegiatan }}</div>
                                            @endif
                                        </td>
                                        <!-- Kolom 3: Lokasi -->
                                        <td>
                                            <div class="cell-text">{{ $item->kolom3_lokasi }}</div>
                                        </td>
                                        <!-- Kolom 4: Kategori -->
                                        <td>
                                            <div class="cell-input"
                                                style="display:flex; align-items:center; justify-content:center;">
                                                <span class="doc-meta-badge" style="background:#e0e7ff; color:#3730a3;">
                                                    {{ $item->kategori }}
                                                </span>
                                            </div>
                                        </td>
                                        <!-- Kolom 5: Kondisi -->
                                        <td class="section-border-right">
                                            <div class="cell-input"
                                                style="display:flex; align-items:center; justify-content:center;">
                                                <span class="doc-meta-badge" style="background:#f1f5f9; color:#475569;">
                                                    {{ $item->kolom5_kondisi }}
                                                </span>
                                            </div>
                                        </td>

                                        <!-- BAGIAN 2: Identifikasi -->

                                        <!-- Kolom 6: Potensi Bahaya (K3/KO Only) -->
                                        <td>
                                            @if($item->kategori == 'K3' || $item->kategori == 'KO')
                                                <div class="cell-checkbox-group">
                                                    @php
                                                        $bahaya = $item->kolom6_bahaya;
                                                        if (is_string($bahaya))
                                                            $bahayaDetails = [$bahaya]; // Fallback for bad data
                                                        else
                                                            $bahayaDetails = $bahaya['details'] ?? [];
                                                        if (!is_array($bahayaDetails))
                                                            $bahayaDetails = [$bahayaDetails]; // Ensure array
                                                    @endphp
                                                    @foreach($bahayaDetails as $detail)
                                                        <div class="cell-checkbox-item">
                                                            <i class="fas fa-exclamation-triangle"
                                                                style="color:#ef4444; font-size:10px; margin-top:3px;"></i>
                                                            <span>{{ $detail }}</span>
                                                        </div>
                                                    @endforeach
                                                    @if(!empty($item->kolom6_bahaya['manual']))
                                                        <div
                                                            style="font-size:13px; margin-top:8px; padding:6px; background:#fef2f2; border:1px dashed #f87171; border-radius:4px; color:#991b1b;">
                                                            <strong>Lainnya:</strong> {{ $item->kolom6_bahaya['manual'] }}
                                                        </div>
                                                    @endif
                                                </div>
                                            @else
                                                <div style="color:#94a3b8; text-align:center;">-</div>
                                            @endif
                                        </td>

                                        <!-- Kolom 7: Aspek Lingkungan (Lingkungan Only) -->
                                        <td>
                                            @if($item->kategori == 'Lingkungan')
                                                <div class="cell-checkbox-group">
                                                    @php
                                                        $col7 = $item->kolom7_aspek_lingkungan ?? [];
                                                        // Handle if entire column is string (unlikely for col7 but safe)
                                                        if (is_string($col7))
                                                            $details7 = [$col7];
                                                        else
                                                            $details7 = $col7['details'] ?? ((is_array($col7) && !array_key_exists('details', $col7)) ? $col7 : []);
                                                        if (!is_array($details7))
                                                            $details7 = [$details7]; // Ensure array
                                                        $manual7 = $col7['manual'] ?? '';
                                                    @endphp
                                                    @foreach($details7 as $aspek)
                                                        <div class="cell-checkbox-item">
                                                            <i class="fas fa-leaf"
                                                                style="color:#22c55e; font-size:10px; margin-top:3px;"></i>
                                                            <span>{{ $aspek }}</span>
                                                        </div>
                                                    @endforeach
                                                    @if(!empty($manual7))
                                                        <div
                                                            style="font-size:13px; margin-top:8px; padding:6px; background:#f0fdf4; border:1px dashed #22c55e; border-radius:4px; color:#15803d;">
                                                            <strong>Lainnya:</strong> {{ $manual7 }}
                                                        </div>
                                                    @endif
                                                </div>
                                            @else
                                                <div style="color:#94a3b8; text-align:center;">-</div>
                                            @endif
                                        </td>

                                        <!-- Kolom 8: Ancaman Keamanan (Keamanan Only) -->
                                        <td>
                                            @if($item->kategori == 'Keamanan')
                                                <div class="cell-checkbox-group">
                                                    @php
                                                        $col8 = $item->kolom8_ancaman ?? [];
                                                        if (is_string($col8))
                                                            $details8 = [$col8];
                                                        else
                                                            $details8 = $col8['details'] ?? ((is_array($col8) && !array_key_exists('details', $col8)) ? $col8 : []);
                                                        if (!is_array($details8))
                                                            $details8 = [$details8]; // Ensure array
                                                        $manual8 = $col8['manual'] ?? '';
                                                    @endphp
                                                    @foreach($details8 as $threat)
                                                        <div class="cell-checkbox-item">
                                                            <i class="fas fa-shield-alt"
                                                                style="color:#dc2626; font-size:10px; margin-top:3px;"></i>
                                                            <span>{{ $threat }}</span>
                                                        </div>
                                                    @endforeach
                                                    @if(!empty($manual8))
                                                        <div
                                                            style="font-size:13px; margin-top:8px; padding:6px; background:#fef2f2; border:1px dashed #f87171; border-radius:4px; color:#991b1b;">
                                                            <strong>Lainnya:</strong> {{ $manual8 }}
                                                        </div>
                                                    @endif
                                                </div>
                                            @else
                                                <div style="color:#94a3b8; text-align:center;">-</div>
                                            @endif
                                        </td>

                                        <!-- Kolom 9a: RISIKO (K3/KO) -->
                                        <td>
                                            @if($item->kategori == 'K3' || $item->kategori == 'KO')
                                                <div class="cell-text">{{ $item->kolom9_risiko_k3ko ?? $item->kolom9_risiko }}
                                                </div>
                                            @else
                                                <div style="color:#94a3b8; text-align:center;">-</div>
                                            @endif
                                        </td>

                                        <!-- Kolom 9b: DAMPAK (Lingkungan) -->
                                        <td>
                                            @if($item->kategori == 'Lingkungan')
                                                <div class="cell-text">
                                                    {{ $item->kolom9_dampak_lingkungan ?? $item->kolom9_risiko }}
                                                </div>
                                            @else
                                                <div style="color:#94a3b8; text-align:center;">-</div>
                                            @endif
                                        </td>

                                        <!-- Kolom 9c: CELAH (Keamanan) -->
                                        <td class="section-border-right">
                                            @if($item->kategori == 'Keamanan')
                                                <div class="cell-text">
                                                    {{ $item->kolom9_celah_keamanan ?? $item->kolom9_risiko }}
                                                </div>
                                            @else
                                                <div style="color:#94a3b8; text-align:center;">-</div>
                                            @endif
                                        </td>

                                        <!-- BAGIAN 3: Pengendalian & Penilaian -->
                                        <!-- Kolom 10: Hirarki Pengendalian -->
                                        <td>
                                            <div class="cell-checkbox-group">
                                                @php $hs = $item->kolom10_pengendalian['hierarchy'] ?? []; @endphp
                                                @foreach($hs as $h)
                                                    <div class="cell-checkbox-item">
                                                        <i class="fas fa-check-square" style="color:#10b981;"></i>
                                                        <span style="font-weight:600;">{{ $h }}</span>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </td>
                                        <!-- Kolom 11: Pengendalian Existing -->
                                        <td>
                                            <div class="cell-text">{{ $item->kolom11_existing }}</div>
                                        </td>
                                        <!-- Kolom 12-14: Penilaian Risiko Awal -->
                                        <td class="risk-col" style="vertical-align:middle; text-align:center;">
                                            <div style="font-weight:800; font-size:16px;">{{ $item->kolom12_kemungkinan }}
                                            </div>
                                        </td>
                                        <td class="risk-col" style="vertical-align:middle; text-align:center;">
                                            <div style="font-weight:800; font-size:16px;">{{ $item->kolom13_konsekuensi }}
                                            </div>
                                        </td>
                                        <td class="risk-col section-border-right" style="vertical-align:middle;">
                                            <div class="risk-score-box">
                                                <div class="risk-val">{{ $item->kolom14_score }}</div>
                                                <div
                                                    class="risk-badge {{ $item->kolom14_score >= 15 ? 'bg-high' : ($item->kolom14_score >= 8 ? 'bg-med' : 'bg-low') }}">
                                                    {{ $item->kolom14_score >= 15 ? 'TINGGI' : ($item->kolom14_score >= 8 ? 'SEDANG' : 'RENDAH') }}
                                                </div>
                                            </div>
                                        </td>

                                        <!-- BAGIAN 4: Legalitas & Signifikansi -->
                                        <!-- Kolom 15: Regulasi -->
                                        <td>
                                            <div class="cell-text">{{ $item->kolom15_regulasi }}</div>
                                        </td>
                                        <!-- Kolom 16: Aspek Lingkungan Penting (Only for Lingkungan) -->
                                        <td style="text-align:center; vertical-align:middle;">
                                            @if($item->kategori == 'Lingkungan' && $item->kolom16_aspek)
                                                <div class="doc-meta-badge"
                                                    style="{{ $item->kolom16_aspek == 'P' ? 'background:#dbeafe; color:#1e40af;' : 'background:#f1f5f9; color:#64748b;' }}">
                                                    {{ $item->kolom16_aspek }}
                                                </div>
                                            @else
                                                <div style="color:#94a3b8;">-</div>
                                            @endif
                                        </td>
                                        <!-- Kolom 17: Peluang & Risiko -->
                                        <td class="section-border-right">
                                            <div class="risk-section">
                                                @if($item->kolom17_risiko)
                                                    <div class="risk-label">RISIKO (-):</div>
                                                    <div class="risk-text">{{ $item->kolom17_risiko }}</div>
                                                @endif
                                                @if($item->kolom17_peluang)
                                                    <div class="risk-label"
                                                        style="border-top:1px solid #e2e8f0; margin-top:6px; padding-top:6px;">
                                                        PELUANG (+):</div>
                                                    <div class="risk-text">{{ $item->kolom17_peluang }}</div>
                                                @endif
                                            </div>
                                        </td>

                                        <!-- BAGIAN 5: Mitigasi Lanjutan & Risiko Sisa -->
                                        <!-- Kolom 18: Toleransi -->
                                        <td style="text-align:center; vertical-align:middle;">
                                            <div class="doc-meta-badge"
                                                style="{{ $item->kolom18_toleransi == 'Ya' ? 'background:#dcfce7; color:#166534;' : 'background:#fee2e2; color:#991b1b;' }}">
                                                {{ $item->kolom18_toleransi == 'Ya' ? 'Ya' : 'Tidak' }}
                                            </div>
                                        </td>
                                        <!-- Kolom 19-22: Follow-up Risk (Only if Tolerance = Tidak) -->
                                        @if($item->kolom18_toleransi == 'Tidak')
                                            <!-- Kolom 19: Pengendalian Lanjut -->
                                            <td>
                                                <div class="cell-text">{{ $item->kolom19_pengendalian_lanjut }}</div>
                                            </td>
                                            <!-- Kolom 20-22: Penilaian Risiko Lanjut -->
                                            <td class="risk-col" style="vertical-align:middle; text-align:center;">
                                                <div style="font-weight:800; font-size:16px;">
                                                    {{ $item->kolom20_kemungkinan_lanjut }}
                                                </div>
                                            </td>
                                            <td class="risk-col" style="vertical-align:middle; text-align:center;">
                                                <div style="font-weight:800; font-size:16px;">
                                                    {{ $item->kolom21_konsekuensi_lanjut }}
                                                </div>
                                            </td>
                                            <td class="risk-col" style="vertical-align:middle;">
                                                <div class="risk-score-box">
                                                    <div class="risk-val">{{ $item->kolom22_tingkat_risiko_lanjut }}</div>
                                                    @if($item->kolom22_tingkat_risiko_lanjut)
                                                        <div
                                                            class="risk-badge {{ $item->kolom22_tingkat_risiko_lanjut >= 15 ? 'bg-high' : ($item->kolom22_tingkat_risiko_lanjut >= 8 ? 'bg-med' : 'bg-low') }}">
                                                            {{ $item->kolom22_level_lanjut }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </td>
                                        @else
                                            <!-- Empty cells when tolerance = Ya -->
                                            <td>
                                                <div style="color:#94a3b8; text-align:center;">-</div>
                                            </td>
                                            <td>
                                                <div style="color:#94a3b8; text-align:center;">-</div>
                                            </td>
                                            <td>
                                                <div style="color:#94a3b8; text-align:center;">-</div>
                                            </td>
                                            <td>
                                                <div style="color:#94a3b8; text-align:center;">-</div>
                                            </td>
                                        @endif


                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="24" style="text-align: center; padding: 20px;">Belum ada data detail.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        </table>
                    </div>

                </form>
            </div> <!-- End Tab HIRADC -->

            @php
                // $puk and $pmk are already fetched above
                $user = auth()->user();
            @endphp

            <!-- TAB 2: PROGRAM KERJA CONTENT -->
            <div id="tab-programs" class="tab-content" style="padding-top: 10px;">

                @foreach($document->details as $detailIndex => $detail)
                    @php
                        $puk = $detail->pukProgram;
                        $pmk = $detail->pmkProgram;
                    @endphp

                    @if($puk)
                        <div class="doc-card" style="margin-top: 32px; border-left: 5px solid #dc2626;">
                            <div class="card-header-slim"
                                style="display: flex; justify-content: space-between; align-items: center;">
                                <div style="display: flex; align-items: center; gap: 12px; color: #dc2626;">
                                    <i class="fas fa-tasks"></i>
                                    <h2 style="color: #dc2626;">Review Program Unit Kerja (PUK) #{{ $detailIndex + 1 }}</h2>
                                </div>
                                <!-- Download Buttons for PUK -->
                                <div style="display: flex; gap: 8px;">
                                    <a href="{{ route('documents.export.puk.pdf', $document->id) }}" class="btn btn-sm"
                                        style="background-color: #dc2626; color: white; padding: 6px 12px; border-radius: 6px; text-decoration: none; font-size: 13px; display: inline-flex; align-items: center; gap: 6px;">
                                        <i class="fas fa-file-pdf"></i> Download PDF
                                    </a>
                                    <a href="{{ route('documents.export.puk.excel', $document->id) }}" class="btn btn-sm"
                                        style="background-color: #107c41; color: white; padding: 6px 12px; border-radius: 6px; text-decoration: none; font-size: 13px; display: inline-flex; align-items: center; gap: 6px;">
                                        <i class="fas fa-file-excel"></i> Download Excel
                                    </a>
                                </div>
                            </div>
                            <div style="padding: 24px;">
                                <!-- Informasi Program -->
                                <div
                                    style="background: #f8fafc; padding: 20px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #e2e8f0;">
                                    <div style="display: grid; grid-template-columns: 200px 1fr; gap: 12px; font-size: 14px;">
                                        <div style="font-weight: 600; color: #475569;">Judul Program</div>
                                        <div style="color: #0f172a;">: {{ $puk->judul }}</div>

                                        <div style="font-weight: 600; color: #475569;">Tujuan</div>
                                        <div style="color: #0f172a;">: {{ $puk->tujuan }}</div>

                                        <div style="font-weight: 600; color: #475569;">Sasaran</div>
                                        <div style="color: #0f172a;">: {{ $puk->sasaran }}</div>

                                        @if($puk->uraian_revisi)
                                            <div style="font-weight: 600; color: #475569;">Uraian Revisi</div>
                                            <div style="color: #0f172a;">: {{ $puk->uraian_revisi }}</div>
                                        @else
                                            @php
                                                // Fallback: Check approvals table for 'resubmitted' or 'puk_resubmit' action
                                                $lastRevision = $document->approvals->filter(function ($approval) {
                                                    return in_array($approval->action, ['resubmitted', 'puk_resubmit']);
                                                })->last();
                                            @endphp
                                            @if($lastRevision && $lastRevision->catatan)
                                                <div style="font-weight: 600; color: #475569;">Uraian Revisi</div>
                                                <div style="color: #0f172a;">: {{ $lastRevision->catatan }}</div>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                                <style>
                                    /* Hide Number Input Spinners */
                                    input[type=number]::-webkit-inner-spin-button,
                                    input[type=number]::-webkit-outer-spin-button {
                                        -webkit-appearance: none;
                                        margin: 0;
                                    }

                                    input[type=number] {
                                        -moz-appearance: textfield;
                                    }
                                </style>
                                <div
                                    style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
                                    <h4 style="font-size:15px; font-weight:700; color:#0f172a; margin: 0;">Detail Program Kerja:
                                    </h4>

                                    @php
                                        $canEditPuk = false;
                                        if ($user->isKepalaUnit() && $user->id_unit == $document->id_unit) {
                                            $hasApproved = $document->approvals()->where('approver_id', $user->id)->where('level', 1)->where('action', 'approved')->exists();
                                            $canEditPuk = !$hasApproved;
                                        }
                                    @endphp

                                    @if($canEditPuk)
                                        <button type="button" onclick="toggleEditModePuk({{ $detailIndex }})" id="btnEditPuk-{{ $detailIndex }}" class="btn btn-sm"
                                            style="background:#3b82f6; color:white; padding:6px 12px; border-radius:6px; font-size: 13px; border:none; cursor: pointer;">
                                            <i class="fas fa-edit me-1"></i> Edit
                                        </button>
                                    @endif
                                </div>

                                <!-- Wrapper dengan scroll horizontal -->
                                <div
                                    style="overflow-x: auto; -webkit-overflow-scrolling: touch; margin-bottom: 1rem; border: 1px solid #e2e8f0; border-radius: 6px;">
                                    <form id="pukEditForm-{{ $detailIndex }}">
                                        <!-- Set min-width pada table agar memaksa scroll jika layar sempit -->
                                        <table class="table table-bordered"
                                            style="width:100%; min-width: 1200px; font-size:13px; border-collapse: collapse;">
                                            <thead>
                                                <tr style="background: #1e293b; color: white;">
                                                    <th rowspan="2"
                                                        style="border: 1px solid #cbd5e1; padding: 12px; text-align: center; width: 50px;">
                                                        NO</th>
                                                    <th rowspan="2"
                                                        style="border: 1px solid #cbd5e1; padding: 12px; text-align: left; min-width: 250px;">
                                                        URAIAN KEGIATAN</th>
                                                    <th rowspan="2"
                                                        style="border: 1px solid #cbd5e1; padding: 12px; text-align: left; min-width: 150px;">
                                                        KOORD.</th>
                                                    <th rowspan="2"
                                                        style="border: 1px solid #cbd5e1; padding: 12px; text-align: left; min-width: 150px;">
                                                        PELAKSANA</th>
                                                    <th colspan="12"
                                                        style="border: 1px solid #cbd5e1; padding: 12px; text-align: center;">
                                                        TARGET (%)</th>
                                                </tr>
                                                <tr style="background: #334155; color: white;">
                                                    @for($m = 1; $m <= 12; $m++)
                                                        <!-- Perbesar lebar kolom target -->
                                                        <th
                                                            style="border: 1px solid #cbd5e1; padding: 8px; text-align: center; width: 50px; min-width: 50px;">
                                                            {{ $m }}
                                                        </th>
                                                    @endfor
                                                </tr>
                                            </thead>
                                            <tbody id="pukTableBody-{{ $detailIndex }}">
                                                @foreach($puk->program_kerja as $idx => $item)
                                                    <tr style="background: {{ $idx % 2 == 0 ? '#ffffff' : '#f9fafb' }};">
                                                        <td
                                                            style="border: 1px solid #cbd5e1; padding: 10px; text-align: center; font-weight: 600;">
                                                            {{ $idx + 1 }}
                                                        </td>
                                                        <!-- Uraian -->
                                                        <td style="border: 1px solid #cbd5e1; padding: 10px;">
                                                            <span class="view-mode">{{ $item['uraian'] ?? '-' }}</span>
                                                            <textarea class="edit-mode form-control"
                                                                style="display:none; width:100%; min-height:60px; padding:8px; border:1px solid #cbd5e1; border-radius:4px;"
                                                                name="program_kerja[{{ $idx }}][uraian]">{{ $item['uraian'] ?? '' }}</textarea>
                                                        </td>
                                                        <!-- Koord -->
                                                        <td style="border: 1px solid #cbd5e1; padding: 10px;">
                                                            <span class="view-mode">{{ $item['koordinator'] ?? '-' }}</span>
                                                            <select class="edit-mode form-control"
                                                                style="display:none; width:100%; padding:6px; border:1px solid #cbd5e1; border-radius:4px;"
                                                                name="program_kerja[{{ $idx }}][koordinator]">
                                                                <option value="">-- Pilih --</option>
                                                                @foreach($band3Users as $u)
                                                                    <option value="{{ $u->nama_user }}" {{ ($item['koordinator'] ?? '') == $u->nama_user ? 'selected' : '' }}>{{ $u->nama_user }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <!-- Pelaksana -->
                                                        <td style="border: 1px solid #cbd5e1; padding: 10px;">
                                                            <span class="view-mode">{{ $item['pelaksana'] ?? '-' }}</span>
                                                            <select class="edit-mode form-control"
                                                                style="display:none; width:100%; padding:6px; border:1px solid #cbd5e1; border-radius:4px;"
                                                                name="program_kerja[{{ $idx }}][pelaksana]">
                                                                <option value="">-- Pilih --</option>
                                                                @foreach($band4Users as $u)
                                                                    <option value="{{ $u->nama_user }}" {{ ($item['pelaksana'] ?? '') == $u->nama_user ? 'selected' : '' }}>{{ $u->nama_user }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <!-- Targets -->
                                                        @php $targets = $item['target'] ?? []; @endphp
                                                        @for($m = 0; $m < 12; $m++)
                                                            <td
                                                                style="border: 1px solid #cbd5e1; padding: 6px; text-align: center; font-size: 12px;">
                                                                <span
                                                                    class="view-mode">{{ isset($targets[$m]) && $targets[$m] !== '' ? $targets[$m] : '-' }}</span>
                                                                <input type="number" class="edit-mode form-control"
                                                                    style="display:none; width:100%; padding:4px; text-align:center; border:1px solid #cbd5e1; border-radius:4px;"
                                                                    name="program_kerja[{{ $idx }}][target][]"
                                                                    value="{{ $targets[$m] ?? '' }}" min="0" max="100">
                                                            </td>
                                                        @endfor
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>

                                        <div id="pukEditActions-{{ $detailIndex }}" style="display:none; margin-top:15px; text-align:right;">
                                            <button type="button" onclick="cancelEditPuk({{ $detailIndex }})" class="btn"
                                                style="background:#e2e8f0; color:#475569; padding:8px 16px; border-radius:6px; border:none; margin-right:8px; cursor:pointer;">
                                                <i class="fas fa-times me-1"></i> Batal
                                            </button>
                                            <button type="button" onclick="savePukChanges({{ $detailIndex }}, {{ $puk->id }})" class="btn"
                                                style="background:#10b981; color:white; padding:8px 16px; border-radius:6px; border:none; cursor:pointer;">
                                                <i class="fas fa-save me-1"></i> Simpan PUK
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if($pmk)
                        <div class="doc-card" style="margin-top: 32px; border-left: 5px solid #dc2626;">
                            <div class="card-header-slim"
                                style="display: flex; justify-content: space-between; align-items: center;">
                                <div style="display: flex; align-items: center; gap: 12px; color: #dc2626;">
                                    <i class="fas fa-project-diagram"></i>
                                    <h2 style="color: #dc2626;">Review Program Manajemen Korporat (PMK) #{{ $detailIndex + 1 }}</h2>
                                </div>
                                <!-- Download Buttons for PMK -->
                                <div style="display: flex; gap: 8px;">
                                    <a href="{{ route('documents.export.pmk.pdf', $document->id) }}" class="btn btn-sm"
                                        style="background-color: #dc2626; color: white; padding: 6px 12px; border-radius: 6px; text-decoration: none; font-size: 13px; display: inline-flex; align-items: center; gap: 6px;">
                                        <i class="fas fa-file-pdf"></i> Download PDF
                                    </a>
                                    <a href="{{ route('documents.export.pmk.excel', $document->id) }}" class="btn btn-sm"
                                        style="background-color: #107c41; color: white; padding: 6px 12px; border-radius: 6px; text-decoration: none; font-size: 13px; display: inline-flex; align-items: center; gap: 6px;">
                                        <i class="fas fa-file-excel"></i> Download Excel
                                    </a>
                                </div>
                            </div>
                            <div style="padding: 24px;">
                                <!-- Informasi Program -->
                                <div
                                    style="background: #faf5ff; padding: 20px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #e9d5ff;">
                                    <div style="display: grid; grid-template-columns: 200px 1fr; gap: 12px; font-size: 14px;">
                                        <div style="font-weight: 600; color: #475569;">Judul Program</div>
                                        <div style="color: #0f172a;">: {{ $pmk->judul }}</div>

                                        <div style="font-weight: 600; color: #475569;">Tujuan</div>
                                        <div style="color: #0f172a;">: {{ $pmk->tujuan }}</div>

                                        <div style="font-weight: 600; color: #475569;">Sasaran</div>
                                        <div style="color: #0f172a;">: {{ $pmk->sasaran }}</div>

                                        <div style="font-weight: 600; color: #475569;">Penanggung Jawab</div>
                                        <div style="color: #0f172a;">: {{ $pmk->penanggung_jawab }}</div>

                                        @if($pmk->uraian_revisi)
                                            <div style="font-weight: 600; color: #475569;">Uraian Revisi</div>
                                            <div style="color: #0f172a;">: {{ $pmk->uraian_revisi }}</div>
                                        @else
                                            @php
                                                // Fallback: Check approvals table for 'resubmitted' or 'pmk_resubmit' action
                                                $lastRevision = $document->approvals->filter(function ($approval) {
                                                    return in_array($approval->action, ['resubmitted', 'pmk_resubmit']);
                                                })->last();
                                            @endphp
                                            @if($lastRevision && $lastRevision->catatan)
                                                <div style="font-weight: 600; color: #475569;">Uraian Revisi</div>
                                                <div style="color: #0f172a;">: {{ $lastRevision->catatan }}</div>
                                            @endif
                                        @endif
                                    </div>
                                </div>

                                <div
                                    style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
                                    <h4 style="font-size:15px; font-weight:700; color:#0f172a; margin: 0;">Detail Program Kerja:
                                    </h4>

                                    @php
                                        $canEditPmk = false;
                                        if ($user->isKepalaUnit() && $user->id_unit == $document->id_unit) {
                                            $hasApproved = $document->approvals()->where('approver_id', $user->id)->where('level', 1)->where('action', 'approved')->exists();
                                            $canEditPmk = !$hasApproved;
                                        }
                                    @endphp

                                    @if($canEditPmk)
                                        <button type="button" onclick="toggleEditModePmk({{ $detailIndex }})" id="btnEditPmk-{{ $detailIndex }}" class="btn btn-sm"
                                            style="background:#c026d3; color:white; padding:6px 12px; border-radius:6px; font-size: 13px; border:none; cursor: pointer;">
                                            <i class="fas fa-edit me-1"></i> Edit
                                        </button>
                                    @endif
                                </div>

                                <div style="overflow-x: auto;">
                                    <form id="pmkEditForm-{{ $detailIndex }}">
                                        <table class="table table-bordered"
                                            style="width:100%; font-size:13px; border-collapse: collapse;">
                                            <thead>
                                                <tr style="background: #1e293b; color: white;">
                                                    <th rowspan="2"
                                                        style="border: 1px solid #cbd5e1; padding: 12px; text-align: center; width: 50px;">
                                                        NO</th>
                                                    <th rowspan="2"
                                                        style="border: 1px solid #cbd5e1; padding: 12px; text-align: left; min-width: 200px;">
                                                        URAIAN KEGIATAN</th>
                                                    <th rowspan="2"
                                                        style="border: 1px solid #cbd5e1; padding: 12px; text-align: left; width: 120px;">
                                                        PIC</th>
                                                    <th colspan="12"
                                                        style="border: 1px solid #cbd5e1; padding: 12px; text-align: center;">
                                                        TARGET (%)</th>
                                                    <th rowspan="2"
                                                        style="border: 1px solid #cbd5e1; padding: 12px; text-align: left; width: 120px;">
                                                        ANGGARAN</th>
                                                </tr>
                                                <tr style="background: #334155; color: white;">
                                                    @for($m = 1; $m <= 12; $m++)
                                                        <th
                                                            style="border: 1px solid #cbd5e1; padding: 8px; text-align: center; width: 40px;">
                                                            {{ $m }}
                                                        </th>
                                                    @endfor
                                                </tr>
                                            </thead>
                                            <tbody id="pmkTableBody-{{ $detailIndex }}">
                                                @foreach($pmk->program_kerja as $idx => $item)
                                                    <tr style="background: {{ $idx % 2 == 0 ? '#ffffff' : '#faf9fb' }};">
                                                        <td
                                                            style="border: 1px solid #cbd5e1; padding: 10px; text-align: center; font-weight: 600;">
                                                            {{ $idx + 1 }}
                                                        </td>
                                                        <!-- Uraian -->
                                                        <td style="border: 1px solid #cbd5e1; padding: 10px;">
                                                            <span class="view-mode">{{ $item['uraian'] ?? '-' }}</span>
                                                            <textarea class="edit-mode form-control"
                                                                style="display:none; width:100%; min-height:60px; padding:8px; border:1px solid #cbd5e1; border-radius:4px;"
                                                                name="program_kerja[{{ $idx }}][uraian]">{{ $item['uraian'] ?? '' }}</textarea>
                                                        </td>
                                                        <!-- PIC/Koord -->
                                                        <td style="border: 1px solid #cbd5e1; padding: 10px;">
                                                            <span
                                                                class="view-mode">{{ (!empty($item['koordinator']) && $item['koordinator'] !== '-') ? $item['koordinator'] : ($item['pelaksana'] ?? $item['pic'] ?? '-') }}</span>
                                                            <select class="edit-mode form-control"
                                                                style="display:none; width:100%; padding:6px; border:1px solid #cbd5e1; border-radius:4px;"
                                                                name="program_kerja[{{ $idx }}][koordinator]">
                                                                <option value="">-- Pilih PIC --</option>
                                                                @foreach($pmkPicUsers as $u)
                                                                    <option value="{{ $u->nama_user }}" {{ ($item['koordinator'] ?? $item['pic'] ?? $item['pelaksana'] ?? '') == $u->nama_user ? 'selected' : '' }}>{{ $u->nama_user }}</option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <!-- Targets -->
                                                        @php $targets = $item['target'] ?? []; @endphp
                                                        @for($m = 0; $m < 12; $m++)
                                                            <td
                                                                style="border: 1px solid #cbd5e1; padding: 6px; text-align: center; font-size: 12px;">
                                                                <span
                                                                    class="view-mode">{{ isset($targets[$m]) && $targets[$m] !== '' ? $targets[$m] : '-' }}</span>
                                                                <input type="number" class="edit-mode form-control"
                                                                    style="display:none; width:100%; padding:4px; text-align:center; border:1px solid #cbd5e1; border-radius:4px;"
                                                                    name="program_kerja[{{ $idx }}][target][]"
                                                                    value="{{ $targets[$m] ?? '' }}" min="0" max="100">
                                                            </td>
                                                        @endfor
                                                        <!-- Anggaran -->
                                                        <td style="border: 1px solid #cbd5e1; padding: 10px;">
                                                            <span
                                                                class="view-mode">{{ isset($item['anggaran']) ? 'Rp ' . number_format($item['anggaran'], 0, ',', '.') : '-' }}</span>
                                                            <input type="number" class="edit-mode form-control"
                                                                style="display:none; width:100%; padding:6px; border:1px solid #cbd5e1; border-radius:4px;"
                                                                name="program_kerja[{{ $idx }}][anggaran]"
                                                                value="{{ $item['anggaran'] ?? '' }}">
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>

                                        <div id="pmkEditActions-{{ $detailIndex }}" style="display:none; margin-top:15px; text-align:right;">
                                            <button type="button" onclick="cancelEditPmk({{ $detailIndex }})" class="btn"
                                                style="background:#e2e8f0; color:#475569; padding:8px 16px; border-radius:6px; border:none; margin-right:8px; cursor:pointer;">
                                                <i class="fas fa-times me-1"></i> Batal
                                            </button>
                                            <button type="button" onclick="savePmkChanges({{ $detailIndex }}, {{ $pmk->id }})" class="btn"
                                                style="background:#c026d3; color:white; padding:8px 16px; border-radius:6px; border:none; cursor:pointer;">
                                                <i class="fas fa-save me-1"></i> Simpan PMK
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach

                <script>
                    function toggleEditModePuk(index) {
                        document.querySelectorAll(`#pukTableBody-${index} .view-mode`).forEach(el => el.style.display = 'none');
                        document.querySelectorAll(`#pukTableBody-${index} .edit-mode`).forEach(el => el.style.display = 'block');
                        document.getElementById(`btnEditPuk-${index}`).style.display = 'none';
                        document.getElementById(`pukEditActions-${index}`).style.display = 'block';
                    }

                    function cancelEditPuk(index) {
                        document.querySelectorAll(`#pukTableBody-${index} .view-mode`).forEach(el => el.style.display = 'inline'); 
                        document.querySelectorAll(`#pukTableBody-${index} .edit-mode`).forEach(el => el.style.display = 'none');
                        document.getElementById(`btnEditPuk-${index}`).style.display = 'inline-block';
                        document.getElementById(`pukEditActions-${index}`).style.display = 'none';
                        document.getElementById(`pukEditForm-${index}`).reset();
                    }

                    function savePukChanges(index, pukId) {
                        const form = document.getElementById(`pukEditForm-${index}`);
                        
                        const programKerja = [];
                        const rows = document.querySelectorAll(`#pukTableBody-${index} tr`);
                        rows.forEach((row, idx) => {
                            const uraian = row.querySelector(`[name="program_kerja[${idx}][uraian]"]`).value;
                            const koord = row.querySelector(`[name="program_kerja[${idx}][koordinator]"]`).value;
                            const pelaksana = row.querySelector(`[name="program_kerja[${idx}][pelaksana]"]`).value;

                            const targets = [];
                            const targetInputs = row.querySelectorAll(`[name="program_kerja[${idx}][target][]"]`);
                            targetInputs.forEach(input => targets.push(input.value));

                            programKerja.push({
                                uraian: uraian,
                                koordinator: koord,
                                pelaksana: pelaksana,
                                target: targets
                            });
                        });

                        Swal.fire({
                            title: 'Menyimpan...',
                            text: 'Mohon tunggu',
                            allowOutsideClick: false,
                            didOpen: () => Swal.showLoading()
                        });

                        fetch(`/approver/puk/${pukId}/update-program-kerja`, {
                            method: 'PUT',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({ program_kerja: programKerja })
                        })
                            .then(res => res.json())
                            .then(data => {
                                if (data.success) {
                                    Swal.fire('Berhasil!', data.message, 'success').then(() => location.reload());
                                } else {
                                    Swal.fire('Gagal!', data.message, 'error');
                                }
                            })
                            .catch(err => {
                                Swal.fire('Error!', 'Terjadi kesalahan sistem', 'error');
                                console.error(err);
                            });
                    }

                    function toggleEditModePmk(index) {
                        document.querySelectorAll(`#pmkTableBody-${index} .view-mode`).forEach(el => el.style.display = 'none');
                        document.querySelectorAll(`#pmkTableBody-${index} .edit-mode`).forEach(el => el.style.display = 'block');
                        document.getElementById(`btnEditPmk-${index}`).style.display = 'none';
                        document.getElementById(`pmkEditActions-${index}`).style.display = 'block';
                    }

                    function cancelEditPmk(index) {
                        document.querySelectorAll(`#pmkTableBody-${index} .view-mode`).forEach(el => el.style.display = 'inline');
                        document.querySelectorAll(`#pmkTableBody-${index} .edit-mode`).forEach(el => el.style.display = 'none');
                        document.getElementById(`btnEditPmk-${index}`).style.display = 'inline-block';
                        document.getElementById(`pmkEditActions-${index}`).style.display = 'none';
                        document.getElementById(`pmkEditForm-${index}`).reset();
                    }

                    function savePmkChanges(index, pmkId) {
                        const form = document.getElementById(`pmkEditForm-${index}`);

                        const programKerja = [];
                        const rows = document.querySelectorAll(`#pmkTableBody-${index} tr`);
                        rows.forEach((row, idx) => {
                            const uraian = row.querySelector(`[name="program_kerja[${idx}][uraian]"]`).value;
                            const koord = row.querySelector(`[name="program_kerja[${idx}][koordinator]"]`).value;
                            const anggaran = row.querySelector(`[name="program_kerja[${idx}][anggaran]"]`).value;

                            const targets = [];
                            const targetInputs = row.querySelectorAll(`[name="program_kerja[${idx}][target][]"]`);
                            targetInputs.forEach(input => targets.push(input.value));

                            programKerja.push({
                                uraian: uraian,
                                koordinator: koord,
                                target: targets,
                                anggaran: anggaran ? parseInt(anggaran) : null
                            });
                        });

                        Swal.fire({
                            title: 'Menyimpan...',
                            text: 'Mohon tunggu',
                            allowOutsideClick: false,
                            didOpen: () => Swal.showLoading()
                        });

                        fetch(`/approver/pmk/${pmkId}/update-program-kerja`, {
                            method: 'PUT',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({ program_kerja: programKerja })
                        })
                            .then(res => res.json())
                            .then(data => {
                                if (data.success) {
                                    Swal.fire('Berhasil!', data.message, 'success').then(() => location.reload());
                                } else {
                                    Swal.fire('Gagal!', data.message, 'error');
                                }
                            })
                            .catch(err => {
                                Swal.fire('Error!', 'Terjadi kesalahan sistem', 'error');
                                console.error(err);
                            });
                    }
                </script>
            </div>

            <!-- Tab Switching Script -->
            <script>
                function openTab(evt, tabName) {
                    var i, tabcontent, tablinks;

                    // Hide all tab content
                    tabcontent = document.getElementsByClassName("tab-content");
                    for (i = 0; i < tabcontent.length; i++) {
                        tabcontent[i].classList.remove("active");
                        tabcontent[i].style.display = "none";
                    }

                    // Remove active class from buttons
                    tablinks = document.getElementsByClassName("tab-btn");
                    for (i = 0; i < tablinks.length; i++) {
                        tablinks[i].classList.remove("active");
                    }

                    // Show current tab and activate button
                    var currentTab = document.getElementById(tabName);
                    if (currentTab) {
                        currentTab.style.display = "block";
                        // Small timeout to allow display block to apply before adding class for animation
                        setTimeout(() => currentTab.classList.add("active"), 10);
                    }

                    if (evt && evt.currentTarget) {
                        evt.currentTarget.classList.add("active");
                    }
                }
            </script>

            <!-- Riwayat Approval & Status Form -->
            <div class="timeline-card">
                <div class="timeline-header">
                    <i class="fas fa-history"></i>
                    Riwayat Approval & Status Form
                </div>

                @php
                    $allHistory = collect();

                    // 1. Created
                    $allHistory->push([
                        'type' => 'created',
                        'action' => 'Form Dibuat',
                        'user' => $document->user->nama_user ?? $document->user->username,
                        'date' => $document->created_at,
                        'comment' => null
                    ]);

                    // 2. Approvals - Filter duplicates
                    $uniqueApprovals = $document->approvals->unique(function ($approval) {
                        return $approval->level . '-' . $approval->action . '-' . $approval->id_approver . '-' . $approval->created_at->format('Y-m-d H:i:s');
                    });

                    foreach ($uniqueApprovals as $approval) {
                        $levelName = match ($approval->level) {
                            1 => 'Kepala Unit Kerja',
                            2 => 'Unit Pengelola',
                            3 => 'Kepala Departemen',
                            default => 'Level ' . $approval->level
                        };

                        $actionText = match ($approval->action) {
                            'approved' => "Disetujui oleh $levelName",
                            'revised' => "Dikembalikan untuk Revisi oleh $levelName",
                            'resubmitted' => "Sudah Direvisi (Perbaikan Selesai)",
                            default => $approval->action
                        };

                        $type = match ($approval->action) {
                            'approved' => 'approved',
                            'revised' => 'revised',
                            'resubmitted' => 'submitted', // Or 'info'
                            default => 'info'
                        };

                        $allHistory->push([
                            'type' => $type,
                            'action' => $actionText,
                            'user' => $approval->approver->nama_user ?? $approval->approver->username,
                            'date' => $approval->created_at,
                            'comment' => $approval->catatan
                        ]);
                    }

                    // 3. Published
                    if ($document->status == 'approved' && $document->published_at) {
                        $allHistory->push([
                            'type' => 'published',
                            'action' => 'Form Dipublikasi',
                            'user' => 'System',
                            'date' => $document->published_at,
                            'comment' => null
                        ]);
                    }

                    // Sort by date
                    $allHistory = $allHistory->sortBy('date');
                @endphp

                @if($allHistory->count() > 0)
                    @foreach($allHistory as $index => $history)
                        <div class="timeline-item timeline-{{ $history['type'] }} {{ $loop->last ? 'timeline-active' : '' }}">
                            <div class="timeline-dot"></div>
                            <div class="timeline-meta">
                                <span class="timeline-action">{{ $history['action'] }}</span>
                                <span class="timeline-badge badge-{{ $history['type'] }}">
                                    {{ strtoupper($history['type']) }}
                                </span>
                            </div>
                            <div class="timeline-user">
                                <i class="fas fa-user"></i>
                                {{ $history['user'] }}
                            </div>
                            <div class="timeline-date">
                                <i class="fas fa-clock"></i>
                                {{ $history['date']->format('d M Y, H:i') }} WIB
                                ({{ $history['date']->diffForHumans() }})
                            </div>
                            @if($history['comment'])
                                <div class="timeline-comment">
                                    <i class="fas fa-comment-dots"></i> "{{ $history['comment'] }}"
                                </div>
                            @endif
                        </div>
                    @endforeach
                @else
                    <div class="timeline-empty">
                        <i class="fas fa-inbox" style="font-size: 32px; margin-bottom: 10px; display: block;"></i>
                        Belum ada riwayat approval
                    </div>
                @endif
            </div>
        </main>

        <!-- Footer -->
        <div class="review-footer">
            <div style="flex:1; margin-right:20px;">
                @php
                    $latestNote = $document->approvals()
                        ->where('catatan', '!=', '')
                        ->whereNotNull('catatan')
                        ->latest()
                        ->value('catatan');

                    // Check if PUK exists and is pending for Kepala Unit
                    $puk = $document->pukProgram;
                    // Logic: Kepala Unit can revise PUK if it's draft or pending_kepala_unit
                    // Assuming Auth logic is handled by $document->canBeApprovedBy or we check role explicitly if needed.
                    // Ideally we should use the same logic as before.
                    $canRevisePuk = $puk && in_array($puk->status, ['draft', 'pending_kepala_unit']) && Auth::user()->hasRole('kepala_unit');
                @endphp
                <input type="text" class="notes-input" id="notes" placeholder="Catatan Review (Wajib jika Revisi)..."
                    value="{{ $latestNote ?? '' }}" @if(!$document->canBeApprovedBy(Auth::user())) readonly disabled
                    style="opacity: 0.6; cursor: not-allowed;" @endif>
            </div>
            <div class="action-btns">
                @if($document->canBeApprovedBy(Auth::user()))
                    @if(isset($canRevisePuk) && $canRevisePuk)
                        <button type="button" class="btn"
                            style="background: linear-gradient(135deg, #db2777 0%, #be185d 100%); color: white; margin-right: 10px;"
                            onclick="confirmPukRevision()">
                            <i class="fas fa-file-contract"></i> Revisi PUK
                        </button>
                    @endif

                    <!-- (Global Edit Removed) -->
                    <button type="button" class="btn btn-revise" onclick="confirmAction('revise')">
                        <i class="fas fa-undo"></i> Revisi
                    </button>
                    <button type="button" class="btn btn-approve" onclick="confirmAction('approve')">
                        <i class="fas fa-check"></i> Approve
                    </button>
                @else
                    <span style="opacity:0.7; font-weight:600; color:#fff;">View Only Mode</span>
                @endif
            </div>
        </div>
    </div>

    <!-- EDIT ITEM MODAL -->
    <div id="editModal" class="modal-overlay"
        style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.5); z-index:9999; justify-content:center; align-items:center;">
        <div class="modal-content"
            style="background:white; padding:20px; width:80%; max-width:900px; max-height:90vh; overflow-y:auto; border-radius:8px; box-shadow:0 4px 6px rgba(0,0,0,0.1);">
            <div
                style="display:flex; justify-content:space-between; margin-bottom:20px; border-bottom:1px solid #eee; padding-bottom:10px;">
                <h3 style="margin:0;">Edit Detail Item</h3>
                <button onclick="closeEditModal()"
                    style="background:none; border:none; font-size:24px; cursor:pointer;">&times;</button>
            </div>

            <form id="editItemForm">
                <input type="hidden" id="edit_id">
                <div id="modal-form-body">
                    <div style="text-align:center; padding:50px;">
                        <i class="fas fa-spinner fa-spin" style="font-size:30px; color:#ccc;"></i>
                        <p>Memuat Form...</p>
                    </div>
                </div>

                <div style="margin-top:20px; text-align:right;">
                    <button type="button" onclick="closeEditModal()" class="btn"
                        style="margin-right:10px; padding:10px 20px; background:#e2e8f0; border:none; border-radius:4px; cursor:pointer;">Batal</button>
                    <button type="button" onclick="saveEditItem()" class="btn"
                        style="background:#0f172a; color:#fff; padding:10px 20px; border:none; border-radius:4px; cursor:pointer;">Simpan
                        Perubahan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const routeApprove = "{{ route('approver.approve', $document->id) }}";
        const routeRevise = "{{ route('approver.revise', $document->id) }}";

        function confirmPukRevision() {
            const notes = document.getElementById('notes').value.trim();

            if (notes.length < 5) {
                Swal.fire({ icon: 'warning', title: 'Catatan Wajib', text: 'Untuk revisi PUK, wajib memberikan catatan saran.' });
                return;
            }

            Swal.fire({
                title: 'Revisi PUK?',
                text: 'Program Unit Kerja akan dikembalikan ke User untuk revisi.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Revisi PUK',
                confirmButtonColor: '#be185d'
            }).then((res) => {
                if (res.isConfirmed) {
                    // Create hidden form to submit
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = "{{ route('puk.request_revision', $document->pukProgram->id ?? 0) }}";

                    const csrf = document.createElement('input');
                    csrf.type = 'hidden';
                    csrf.name = '_token';
                    csrf.value = "{{ csrf_token() }}";
                    form.appendChild(csrf);

                    const noteInput = document.createElement('input');
                    noteInput.type = 'hidden';
                    noteInput.name = 'catatan';
                    noteInput.value = notes;
                    form.appendChild(noteInput);

                    document.body.appendChild(form);
                    form.submit();
                }
            });
        }

        // Auto-Grow Textareas
        document.querySelectorAll('.auto-grow').forEach(el => {
            el.style.height = 'auto'; // Reset 
            el.style.height = Math.max(el.scrollHeight, 100) + 'px';
            el.addEventListener('input', function () {
                this.style.height = 'auto';
                this.style.height = (this.scrollHeight) + 'px';
            });
        });
        // Trigger once on load
        window.addEventListener('load', () => {
            document.querySelectorAll('.auto-grow').forEach(el => {
                el.style.height = 'auto';
                el.style.height = (el.scrollHeight) + 'px';
            });
        });

        function openEditModal(item) {
            const id = item.id;
            document.getElementById('edit_id').value = id;
            document.getElementById('editModal').style.display = 'flex';

            // Show Spinner
            document.getElementById('modal-form-body').innerHTML = `
                 <div style="text-align:center; padding:50px;">
                    <i class="fas fa-spinner fa-spin" style="font-size:30px; color:#ccc;"></i>
                    <p>Memuat Form...</p>
                 </div>
            `;

            // Fetch Form HTML
            fetch(`/approver/documents/get-item-html/${id}`)
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById('modal-form-body').innerHTML = data.html;
                    } else {
                        document.getElementById('modal-form-body').innerHTML = '<p class="text-danger">Gagal memuat form.</p>';
                    }
                });
        }

        function closeEditModal() {
            document.getElementById('editModal').style.display = 'none';
        }

        function saveEditItem() {
            const id = document.getElementById('edit_id').value;
            const form = document.getElementById('editItemForm');

            // Collect Form Data Manually to handle naming structure edit_item[ID][field] -> map to simple params for Controller?
            // OR Controller should accept the exact naming.
            // My Controller updateDetail expects: category, kolom2_kegiatan, etc.
            // But the partial uses names like edit_item[123][kolom2_kegiatan].
            // I should use FormData and parse it or standard serialize.

            // Use FormData API
            const formData = new FormData(form);
            const payload = {};

            // Regex parse: "edit_item[102][kolom2_kegiatan]" or "edit_item[102][kolom6_bahaya][]"
            for (let [key, value] of formData.entries()) {
                // Match pattern: prefix[index][fieldName]([])?
                // We just want to capture the fieldName inside the second bracket pair.
                // Regex: /\[\d+\]\[([^\]]+)\]/ matches [123][fieldName]
                const match = key.match(/\[\d+\]\[([^\]]+)\]/);

                if (match && match[1]) {
                    const fieldName = match[1];
                    const isArray = key.endsWith('[]');

                    if (isArray) {
                        if (!payload[fieldName]) payload[fieldName] = [];
                        payload[fieldName].push(value);
                    } else {
                        payload[fieldName] = value;
                    }
                }
            }

            // Add other missing fields manually if needed, or rely on above parser.
            // Also need Token
            payload['_token'] = "{{ csrf_token() }}";

            // If manual hazards were merged, check controller handling.
            // Controller updateDetail expects: kolom6_bahaya which is ARRAY.
            // My partial sends array checks.

            fetch(`/approver/documents/update-detail/${id}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                body: JSON.stringify(payload)
            })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        closeEditModal(); // Close modal first
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: 'Perubahan berhasil disimpan.',
                            timer: 1500,
                            showConfirmButton: false
                        }).then(() => {
                            location.reload();
                        });
                    } else {
                        Swal.fire('Error', data.message, 'error');
                    }
                })
                .catch(err => {
                    Swal.fire('Error', 'Terjadi kesalahan sistem', 'error');
                });
        }

        // --- Helper JS for Injected Form ---
        // --- Helper JS for Injected Form (adapted for Modal) ---
        const categories = {
            'K3': { label: 'K3', conditions: ['Rutin', 'Non-Rutin', 'Emergency'] },
            'KO': { label: 'KO', conditions: ['Rutin', 'Non-Rutin', 'Emergency'] },
            'Lingkungan': { label: 'Lingkungan', conditions: ['Normal', 'Abnormal', 'Emergency'] },
            'Keamanan': { label: 'Keamanan', conditions: ['Emergency'] }
        };

        function updateConditions(select) {
            const form = select.closest('form');
            const condSelect = form.querySelector('.condition-select');
            const cat = select.value;

            // Get all conditional field sections
            const k3KoField = form.querySelector('.k3-ko-field');
            const lingkunganField = form.querySelector('.lingkungan-field');
            const keamananField = form.querySelector('.keamanan-field');
            const lingkunganOnlyField = form.querySelector('.lingkungan-only-field');

            // Columns 9 variants
            const kolom9K3KO = form.querySelector('.kolom9-k3ko-field');
            const kolom9Lingkungan = form.querySelector('.kolom9-lingkungan-field');
            const kolom9Keamanan = form.querySelector('.kolom9-keamanan-field');

            // 1. Reset Conditions Options
            condSelect.innerHTML = '<option value="">-- Pilih --</option>';
            if (categories[cat]) {
                categories[cat].conditions.forEach(c => {
                    const opt = document.createElement('option');
                    opt.value = c;
                    opt.textContent = c;
                    condSelect.appendChild(opt);
                });
            }

            // 2. Hide All
            if (k3KoField) k3KoField.style.display = 'none';
            if (lingkunganField) lingkunganField.style.display = 'none';
            if (keamananField) keamananField.style.display = 'none';
            if (lingkunganOnlyField) lingkunganOnlyField.style.display = 'none';

            if (kolom9K3KO) kolom9K3KO.style.display = 'none';
            if (kolom9Lingkungan) kolom9Lingkungan.style.display = 'none';
            if (kolom9Keamanan) kolom9Keamanan.style.display = 'none';

            // 3. Show Specific
            if (cat === 'K3' || cat === 'KO') {
                if (k3KoField) k3KoField.style.display = 'block';
                if (kolom9K3KO) kolom9K3KO.style.display = 'block';
            } else if (cat === 'Lingkungan') {
                if (lingkunganField) lingkunganField.style.display = 'block';
                if (lingkunganOnlyField) lingkunganOnlyField.style.display = 'block';
                if (kolom9Lingkungan) kolom9Lingkungan.style.display = 'block';
            } else if (cat === 'Keamanan') {
                if (keamananField) keamananField.style.display = 'block';
                if (kolom9Keamanan) kolom9Keamanan.style.display = 'block';
            }
        }

        function calculateSimpleRisk(select, isResidual = false) {
            const container = select.closest('.risk-container'); // Need to add this class to container
            if (!container) return;

            const likelihood = parseInt(container.querySelector(isResidual ? '.res-likelihood' : '.likelihood').value) || 0;
            const severity = parseInt(container.querySelector(isResidual ? '.res-severity' : '.severity').value) || 0;

            const score = likelihood * severity;

            const scoreEl = container.querySelector('.display-score');
            const levelEl = container.querySelector('.display-level'); // if exists
            const inputScore = container.querySelector(isResidual ? '.input-res-score' : '.input-score');

            if (scoreEl) scoreEl.textContent = score || '-';
            if (inputScore) inputScore.value = score;

            // Level Logic
            let level = 'LOW';
            let bg = '#10b981';
            if (score >= 15) { level = 'HIGH'; bg = '#dc2626'; }
            else if (score >= 8) { level = 'MED'; bg = '#f59e0b'; }

            // Update Badge background
            const badge = container.querySelector('.risk-badge-box');
            if (badge) {
                badge.style.background = bg;
                badge.textContent = level; // Optional
            }

            // If Main Risk, toggle FollowUp
            if (!isResidual) {
                // Logic to toggle followup specific elements if needed
            }
        }

        function calculateFollowUpRisk(select) {
            const container = select.closest('.followup-container');
            if (!container) return;

            const l = parseInt(container.querySelector('.followup-l').value) || 0;
            const s = parseInt(container.querySelector('.followup-s').value) || 0;
            const score = l * s;

            const scoreEl = container.querySelector('.followup-score-display');
            const inputScore = container.querySelector('.input-followup-score');

            if (scoreEl) scoreEl.textContent = score;
            if (inputScore) inputScore.value = score;
        }

        function toggleFollowUpFields(select) {
            const val = select.value;
            const form = select.closest('form');
            const section = form.querySelector('.follow-up-section');
            if (section) {
                section.style.display = (val === 'Tidak') ? 'block' : 'none';
            }
        }


        function confirmAction(type) {
            const notes = document.getElementById('notes').value.trim();
            if (type === 'revise' && notes.length < 5) {
                Swal.fire({ icon: 'warning', title: 'Catatan Wajib', text: 'Untuk revisi, wajib memberikan catatan saran.' });
                return;
            }

            // Validation for Approve: Notes Required
            if (type === 'approve' && notes === '') {
                Swal.fire({ icon: 'warning', title: 'Catatan Wajib', text: 'Isikan catatan terlebih dahulu.' });
                return;
            }

            Swal.fire({
                title: type === 'approve' ? 'Setujui Form?' : 'Kembalikan Revisi?',
                text: type === 'approve' ? 'Form akan dilanjutkan ke Approval berikutnya.' : 'Form akan dikembalikan ke pembuat.',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya, Lanjutkan',
                confirmButtonColor: type === 'approve' ? '#0f172a' : '#ef4444'
            }).then((res) => {
                if (res.isConfirmed) {
                    document.getElementById('catatan_input_form').value = notes;
                    document.getElementById('reviewForm').action = type === 'approve' ? routeApprove : routeRevise;
                    document.getElementById('action_input').value = type;
                    document.getElementById('reviewForm').submit();
                }
            });
        }
    </script>

    <!-- Flash Messages -->
    @if(session('success'))
        <script>Swal.fire({ icon: 'success', title: 'Berhasil', text: "{{ session('success') }}", timer: 2000 });</script>
    @endif
    @if($errors->any())
        <script>Swal.fire({ icon: 'error', title: 'Error', html: `<ul>@foreach($errors->all() as $e)<li>{{$e}}</li>@endforeach</ul>` });</script>
    @endif

    <script>
        // Realtime Tracking Polling
        const docId = "{{ $document->id }}";
        const statusRoute = "{{ route('approver.get_status', $document->id) }}";

        setInterval(() => {
            fetch(statusRoute)
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        updateWizard(data.current_level, data.status);
                    }
                })
                .catch(err => console.error('Polling error:', err));
        }, 5000); // Poll every 5 seconds

        function updateWizard(level, status) {
            const steps = document.querySelectorAll('.step-item');
            const isFinished = (status === 'approved' || status === 'published');

            // Reset all
            steps.forEach(s => s.classList.remove('active', 'completed'));

            // Step 1: Draft (Index 0)
            if (level >= 1) steps[0].classList.add('completed');
            else steps[0].classList.add('active');

            // Step 2: Kepala Unit (Index 1)
            if (level > 1) steps[1].classList.add('completed');
            else if (level == 1) steps[1].classList.add('active');

            // Step 3: Unit Pengelola (Index 2)
            if (level > 2) steps[2].classList.add('completed');
            else if (level == 2) steps[2].classList.add('active');

            // Step 4: Kepala Dept (Index 3)
            if (isFinished) steps[3].classList.add('completed');
            else if (level == 3) steps[3].classList.add('active');

            // Step 5: Selesai (Index 4)
            if (isFinished) steps[4].classList.add('completed', 'active');
        }
    </script>
    @include('partials.alerts')
</body>

</html>