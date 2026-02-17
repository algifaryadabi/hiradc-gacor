<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review Dokumen (Unit Pengelola) - HIRADC</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        /* Base styles from Approver View */
        :root {
            --primary: #c41e3a;
            --primary-light: #fff1f2;
            --secondary: #64748b;
            --bg-body: #f1f5f9;
            --surface: #ffffff;
            --text-main: #1e293b;
            --text-sub: #64748b;
            --border: #e2e8f0;
            --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            outline: none;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg-body);
            color: var(--text-main);
            padding-bottom: 120px;
        }

        .container {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar - Twin Design */
        .sidebar {
            width: 280px;
            background: #5b6fd8;
            border-right: 1px solid rgba(255, 255, 255, 0.1);
            position: fixed;
            height: 100vh;
            display: flex;
            flex-direction: column;
            z-index: 9999; /* Highest priority to cover artifacts */
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.1);
        }

        /* ... existing sidebar styles ... */

        /* Defensive CSS: Hide potential legacy action bars */
        .action-bar { display: none !important; }

        /* View Only Message - Floating Bottom */
        .view-only-message {
            position: fixed;
            bottom: 40px; /* Raised to be cleaner */
            left: 304px; /* 280px Sidebar + 24px Margin */
            right: 24px; /* 24px Margin Right */
            display: flex;
            align-items: center;
            gap: 16px;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(8px);
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 20px 32px;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1);
            z-index: 10000; /* Above sidebar */
            width: auto;
            box-sizing: border-box;
        }

        .logo-section {
            padding: 2rem 1.5rem;
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
            display: flex;
            align-items: center;
            justify-content: center;
            background: white;
            border-radius: 50%;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
        }

        .logo-circle:hover {
            transform: scale(1.05);
        }

        .logo-circle img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }

        .logo-text {
            font-size: 1.125rem;
            font-weight: 700;
            color: white;
            margin-bottom: 0.25rem;
            letter-spacing: -0.02em;
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
            padding: 1.5rem 0;
            overflow-y: auto;
        }

        .nav-item {
            padding: 1rem 1.5rem;
            margin: 0.25rem 1rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            cursor: pointer;
            transition: all 0.2s;
            color: rgba(255, 255, 255, 0.85);
            font-size: 0.9375rem;
            font-weight: 500;
            text-decoration: none;
            border-radius: 0.75rem;
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
        }

        .nav-item i {
            width: 20px;
            text-align: center;
            font-size: 1.125rem;
        }
        /* User Info */
        .user-info {
            padding: 1.5rem;
            border-top: 1px solid rgba(255, 255, 255, 0.15);
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
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #5b6fd8;
            font-weight: 700;
            font-size: 1.125rem;
            flex-shrink: 0;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .user-details {
            flex: 1;
            min-width: 0;
        }

        .user-name {
            font-weight: 600;
            font-size: 0.9375rem;
            color: white;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .user-role {
            font-size: 0.75rem;
            color: rgba(255, 255, 255, 0.85);
            font-weight: 500;
        }

        .logout-btn {
            width: 100%;
            padding: 0.75rem 1rem;
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
            gap: 0.5rem;
            text-decoration: none;
        }

        .logout-btn:hover {
            background: rgba(255, 255, 255, 0.25);
            transform: translateY(-2px);
        }

        /* Main Content */
        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: 280px !important;
            width: calc(100% - 280px) !important;
            padding: 40px;
            padding-bottom: 150px;
            position: relative;
            z-index: 1;
        }

        .content-wrapper {
            max-width: 1200px;
            margin: 0 auto;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 32px;
        }

        .header-title h1 {
            font-size: 28px;
            font-weight: 800;
            color: var(--text-main);
            letter-spacing: -0.03em;
            margin-bottom: 8px;
        }

        .header-title p {
            font-size: 14px;
            color: var(--text-sub);
            font-weight: 500;
        }

        .btn-back {
            padding: 10px 20px;
            border-radius: 100px;
            background: white;
            border: 1px solid var(--border);
            color: var(--text-main);
            font-weight: 600;
            font-size: 14px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        }

        .btn-back:hover {
            background: var(--bg-body);
            border-color: var(--text-sub);
            transform: translateX(-4px);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        /* Document Card - Enhanced */
        .doc-card {
            background: white;
            border-radius: 16px;
            border: 1px solid var(--border);
            box-shadow: var(--shadow-md);
            overflow: hidden;
            margin-bottom: 32px;
        }

        .doc-header {
            background: linear-gradient(to bottom, #f8fafc 0%, #f1f5f9 100%);
            padding: 24px 32px;
            border-bottom: 1px solid var(--border);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .doc-title-label {
            font-size: 11px;
            color: var(--text-sub);
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            margin-bottom: 6px;
        }

        .doc-title-value {
            font-size: 22px;
            font-weight: 800;
            color: var(--text-main);
            line-height: 1.3;
        }

        .card-header-slim {
            padding: 20px 28px;
            border-bottom: 1px solid var(--border);
            background: linear-gradient(to right, #fafafa 0%, #ffffff 100%);
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .card-header-slim i {
            color: var(--primary);
            font-size: 18px;
        }

        .card-header-slim h2 {
            font-size: 16px;
            font-weight: 700;
            color: var(--text-main);
            letter-spacing: -0.01em;
        }

        .doc-body {
            padding: 28px 32px;
        }

        /* PROFESSIONAL ENTERPRISE HIRADC TABLE from Approver View */
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
            border-radius: 12px;
            margin-bottom: 40px;
            position: relative;
            /* Smooth scrolling */
            scroll-behavior: smooth;
            -webkit-overflow-scrolling: touch;
        }

        /* Excel-Style Table (Reference Design) */
        .excel-table {
            width: max-content;
            min-width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            font-family: 'Inter', 'Segoe UI', sans-serif;
            font-size: 11px;
            color: #1e293b;
            table-layout: auto;
        }

        .excel-table thead {
            position: sticky;
            top: 0;
            z-index: 50;
        }

        .excel-table thead th {
            background: linear-gradient(to bottom, #1e293b 0%, #0f172a 100%);
            color: white;
            padding: 10px;
            border-right: 1px solid #334155;
            border-bottom: 1px solid #334155;
            text-align: center;
            vertical-align: middle;
            font-weight: 700;
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 0.02em;
            line-height: 1.3;
            white-space: nowrap;
        }

        .excel-table thead tr:first-child th {
            background: linear-gradient(to bottom, #0f172a 0%, #020617 100%);
            font-size: 10px;
            border-bottom: 1px solid #334155;
        }

        .excel-table thead tr:first-child th:first-child {
            position: sticky;
            left: 0;
            z-index: 52;
            border-right: 2px solid #475569;
        }

        .excel-table tbody td {
            padding: 10px;
            border-right: 1px solid var(--border-color);
            border-bottom: 1px solid var(--border-color);
            background: white;
            vertical-align: top;
            font-size: 11px;
            font-weight: 500;
            color: var(--text-main);
            line-height: 1.5;
        }

        .excel-table tbody tr:hover td {
            background: linear-gradient(to right, #fef2f3 0%, #ffffff 100%);
        }

        .excel-table tbody td:first-child {
            position: sticky;
            left: 0;
            background: #f8fafc;
            z-index: 40;
            border-right: 2px solid #94a3b8;
            text-align: center;
            vertical-align: top;
            padding-top: 15px;
            font-weight: 700;
            color: #64748b;
        }

        .excel-table tbody td:first-child:hover {
            background: #f1f5f9;
        }

        .section-border-right {
            border-right: 3px solid #94a3b8 !important;
        }

        .cell-text,
        .cell-input {
            width: 100%;
            padding: 12px 14px;
            font-family: inherit;
            font-size: 13px;
            line-height: 1.5;
            color: #334155;
            background: transparent;
            min-height: 50px;
        }

        .section-border-right {
            border-right: 3px solid #94a3b8 !important;
        }

        .risk-col {
            width: 50px;
            text-align: center;
            background: #fff;
            vertical-align: top;
            padding: 5px !important;
        }

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

        .cell-checkbox-group {
            padding: 12px;
            display: flex;
            flex-direction: column;
            gap: 8px;
            min-width: 250px;
        }

        .cell-checkbox-item {
            display: flex;
            gap: 10px;
            font-size: 13px;
            align-items: flex-start;
            line-height: 1.4;
            color: #334155;
        }

        /* Wizard */
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

        .step-item.completed .step-circle {
            background: var(--primary);
            border-color: var(--primary);
            color: white;
        }

        /* Footer (Unit Pengelola Specific) */
        .review-footer {
            position: fixed;
            bottom: 0;
            left: 250px;
            right: 0;
            background: white;
            padding: 20px 48px;
            border-top: 1px solid var(--border);
            box-shadow: 0 -4px 20px rgba(0, 0, 0, 0.05);
            z-index: 100;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .notes-area {
            flex: 1;
        }

        .notes-input {
            width: 100%;
            height: 80px;
            padding: 12px;
            border-radius: 8px;
            border: 1px solid var(--border);
            font-family: inherit;
            font-size: 14px;
            resize: none;
            background: #f8fafc;
        }

        .action-btns {
            display: flex;
            gap: 12px;
            justify-content: flex-end;
        }

        .btn {
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .btn-approve {
            background: #16a34a;
            color: white;
        }

        .btn-revise {
            background: #dc2626;
            color: white;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            border-radius: 6px;
            border: 1px solid #cbd5e1;
            font-size: 14px;
        }

        .alert {
            padding: 10px 15px;
            border-radius: 6px;
            margin-bottom: 10px;
            font-size: 14px;
        }

        .alert-info {
            background: #e0f2fe;
            color: #0369a1;
            border: 1px solid #bae6fd;
        }

        .alert-warning {
            background: #fefce8;
            color: #854d0e;
            border: 1px solid #fef9c3;
        }

        .alert-success {
            background: #dcfce7;
            color: #166534;
            border: 1px solid #bbf7d0;
        }

        /* Wizard Steps - Modern Design */
        .wizard-container {
            background: white;
            border-radius: 16px;
            border: 1px solid var(--border);
            padding: 32px;
            margin-bottom: 32px;
            box-shadow: var(--shadow-sm);
        }

        .wizard-steps {
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: relative;
            max-width: 800px;
            margin: 0 auto;
        }

        .wizard-steps::before {
            content: '';
            position: absolute;
            top: 24px;
            left: 0;
            right: 0;
            height: 3px;
            background: #e2e8f0;
            z-index: 0;
        }

        .step-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 12px;
            position: relative;
            z-index: 1;
            flex: 1;
        }

        .step-circle {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: white;
            border: 3px solid #e2e8f0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 16px;
            color: #94a3b8;
            transition: all 0.3s;
        }

        .step-item.completed .step-circle {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            border-color: #10b981;
            color: white;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
        }

        .step-item.active .step-circle {
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            border-color: #3b82f6;
            color: white;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
            animation: pulse 2s infinite;
        }


        @keyframes pulse {
            0%, 100% { box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3); }
            50% { box-shadow: 0 4px 20px rgba(59, 130, 246, 0.5); }
        }

        /* TABS STYLES */
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
            text-decoration: none; /* Reset anchor styles if button is a */
        }

        .tab-btn:hover {
            color: var(--primary);
            background: rgba(196, 30, 58, 0.05);
            transform: none; /* Reset generic btn hover */
        }

        .tab-btn.active {
            color: var(--primary);
            background: white;
            border: 1px solid #e2e8f0;
            border-bottom-color: transparent;
            margin-bottom: -3px; /* Cover the bottom border */
            z-index: 2;
            box-shadow: 0 -4px 6px -1px rgba(0,0,0,0.05);
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
            background: #fff1f2;
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
            from { opacity: 0; transform: translateY(5px); }
            to { opacity: 1; transform: translateY(0); }
        }


        .step-label {
            font-size: 13px;
            font-weight: 600;
            color: #64748b;
            text-align: center;
        }

        .step-item.completed .step-label,
        .step-item.active .step-label {
            color: var(--text-main);
        }

        /* Passport Card - Modern Document Info */
        .passport-card {
            background: white;
            border-radius: 16px;
            padding: 24px 32px;
            border: 1px solid var(--border);
            box-shadow: var(--shadow-md);
            margin-bottom: 32px;
            display: grid;
            grid-template-columns: auto 1fr auto;
            align-items: center;
            gap: 32px;
        }

        .pp-profile-group {
            display: flex;
            gap: 16px;
            align-items: center;
        }

        .pp-avatar-box {
            width: 56px;
            height: 56px;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            color: var(--primary);
            font-size: 20px;
            border: 2px solid var(--border);
        }

        .pp-info h2 {
            font-size: 18px;
            font-weight: 700;
            color: var(--text-main);
            margin-bottom: 4px;
        }

        .pp-info p {
            font-size: 13px;
            color: var(--text-sub);
            font-weight: 500;
        }

        .pp-meta-group {
            display: flex;
            gap: 40px;
            border-left: 1px solid var(--border);
            border-right: 1px solid var(--border);
            padding: 0 40px;
        }

        .pp-stat-block {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .pp-stat-label {
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--text-sub);
            font-weight: 600;
        }

        .pp-stat-value {
            font-size: 15px;
            font-weight: 700;
            color: var(--text-main);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .pp-status-badge {
            padding: 8px 20px;
            border-radius: 100px;
            font-size: 13px;
            font-weight: 700;
            letter-spacing: 0.03em;
            text-transform: uppercase;
        }

        .status-pending { background: #fffbeb; color: #d97706; border: 1px solid #fbbf24; }
        .status-approved { background: #ecfdf5; color: #059669; border: 1px solid #10b981; }
        .status-revision { background: #fef2f2; color: #dc2626; border: 1px solid #ef4444; }

        /* Modern Action Buttons */
        .btn {
            padding: 10px 20px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            border: none;
            transition: all 0.2s;
            text-decoration: none;
        }

        .btn:hover {
            transform: translateY(-2px);
        }

        .btn-approve {
            background: linear-gradient(135deg, #16a34a 0%, #15803d 100%);
            color: white;
            box-shadow: 0 4px 12px rgba(22, 163, 74, 0.3);
        }

        .btn-approve:hover {
            box-shadow: 0 6px 16px rgba(22, 163, 74, 0.4);
        }

        .btn-revise {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: white;
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
        }

        .btn-revise:hover {
            box-shadow: 0 6px 16px rgba(239, 68, 68, 0.4);
        }

        /* Timeline Modern */
        .timeline-card {
            background: white;
            border-radius: 16px;
            border: 1px solid var(--border);
            padding: 30px;
            margin-top: 40px;
            margin-bottom: 120px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        }

        .timeline-header {
            font-size: 18px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .timeline-container {
            position: relative;
            padding-left: 10px;
        }

        /* Vertical Line */
        .timeline-container::before {
            content: '';
            position: absolute;
            left: 24px; /* Align with icon center */
            top: 10px;
            bottom: 20px;
            width: 2px;
            background: #e2e8f0;
            z-index: 0;
        }

        .timeline-item {
            position: relative;
            margin-bottom: 30px;
            display: flex;
            gap: 20px;
            z-index: 1;
        }

        .tm-icon {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: #f1f5f9;
            border: 2px solid white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            box-shadow: 0 0 0 4px #f8fafc;
            color: #64748b;
            flex-shrink: 0;
            position: relative;
            left: -2px; /* Fine tune alignment */
        }

        /* Color Variants */
        .timeline-item.tm-green .tm-icon { background: #dcfce7; color: #166534; box-shadow: 0 0 0 4px #f0fdf4; }
        .timeline-item.tm-red .tm-icon { background: #fee2e2; color: #991b1b; box-shadow: 0 0 0 4px #fef2f2; }
        .timeline-item.tm-blue .tm-icon { background: #dbeafe; color: #1e40af; box-shadow: 0 0 0 4px #eff6ff; }
        .timeline-item.tm-purple .tm-icon { background: #f3e8ff; color: #6b21a8; box-shadow: 0 0 0 4px #faf5ff; }

        .tm-content {
            background: #f8fafc;
            padding: 15px 20px;
            border-radius: 12px;
            flex: 1;
            border: 1px solid #f1f5f9;
        }

        .tm-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 5px;
            flex-wrap: wrap;
            gap: 10px;
        }

        .tm-user {
            font-weight: 700;
            color: #334155;
            font-size: 14px;
        }

        .tm-badge {
            font-size: 10px;
            text-transform: uppercase;
            padding: 2px 8px;
            border-radius: 99px;
            background: #e2e8f0;
            color: #64748b;
            font-weight: 600;
        }

        .tm-date {
            font-size: 12px;
            color: #94a3b8;
        }

        .tm-status {
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 8px;
            color: #475569;
        }
        .timeline-item.tm-green .tm-status { color: #166534; }
        .timeline-item.tm-red .tm-status { color: #991b1b; }
        .timeline-item.tm-teal { border-left-color: #14b8a6; background: #f0fdfa; }
        .timeline-item.tm-teal .tm-status { color: #0d9488; }
        .timeline-item.tm-indigo { border-left-color: #6366f1; background: #eef2ff; }
        .timeline-item.tm-indigo .tm-status { color: #4338ca; }

        .tm-comment {
            font-size: 13px;
            color: #64748b;
            font-style: italic;
            background: white;
            padding: 10px;
            border-radius: 8px;
            border-left: 3px solid #cbd5e1;
        }
        .timeline-item.tm-red .tm-comment { border-left-color: #f87171; }
        .timeline-item.tm-green .tm-comment { border-left-color: #4ade80; }

        /* Modal */
        #editModal .modal-content {
            margin: 2vh auto;
            max-height: 96vh;
            width: 90%;
            max-width: min(900px, 90vw);
        }

        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: 280px !important;
            width: calc(100% - 280px) !important;
            padding: 40px;
            padding-bottom: 150px;
            max-width: 10000px; /* Reset header override */
            position: relative;
            z-index: 1;
        }

        .content-wrapper {
            max-width: 1200px;
            margin: 0 auto;
            width: 100%;
        }


    </style>
</head>

<body>
    @php
        $user = Auth::user();
        $isHead = $user->isUnitPengelola();
        // Parallel Workflow Logic: Determine Context based on User Unit
        if ($user->id_unit == 55) { // Security
            $currentStatus = $document->status_security;
            $currentReviewerId = $document->security_reviewer_id;
            $currentApproverId = $document->security_verificator_id;
        } elseif ($user->id_unit == 56) { // SHE
            $currentStatus = $document->status_she;
            $currentReviewerId = $document->she_reviewer_id;
            $currentApproverId = $document->she_verificator_id;
        } else {
            // Fallback
            $currentStatus = $document->level2_status;
            $currentReviewerId = $document->level2_reviewer_id;
            $currentApproverId = $document->level2_approver_id;
        }

        // Global Status fallback if unit status is empty (e.g. before disposition)
        if (empty($currentStatus) && $document->current_level == 2) {
             // If Head, they need to see it as pending to dispose
             // If Staff, they might not see it yet unless in Pool
             $currentStatus = 'pending_head'; 
        }

        $status = $currentStatus;

        // Reviewer Logic - PERBAIKAN: SEMUA staff reviewer harus bisa edit
        // Tidak peduli apakah sudah ada currentReviewerId atau belum
        // Cukup cek: apakah user ini adalah staff reviewer (is_reviewer = 1) dari unit yang sama?
        $isReviewer = $user->is_reviewer == 1 || 
                      ($currentReviewerId == $user->id_user) ||
                      (in_array($user->role_jabatan, [5, 6]) && in_array($user->id_unit, [55, 56]));

        // Determine if we should show the Reviewer View (Priority over Head View)
        // Allow if assigned_review OR pending_head (Self-Disposition)
        $showAsReviewer = ($isReviewer && in_array($status, ['assigned_review', 'pending_head']));

        // Approver Logic (Relaxed for Unit Pengelola)
        // UPDATED: Check is_verifier flag OR Role 4 (Manager)
        $isStaffApprover = (($user->role_jabatan == 4) || $user->is_verifier) && 
                           in_array($user->id_unit, [55, 56]);

        $isApprover = ($currentApproverId == $user->id_user) || 
                      ($isStaffApprover && ($status == 'assigned_approval' || $status == 'process_verification'));
        
        // --- KEY FIX: ROBUST HEAD DETECTION ---
        // Force isHead = true if the user is explicitly the Level 2 Approver for this document.
        // This handles cases where Role 4 (Manager) is not caught by isUnitPengelola() (which might expect Role 3).
        if (!$isHead && $document->current_level == 2 && $document->level2_approver_id == $user->id_user) {
            $isHead = true;
        }

        // Determine if this Unit Pengelola's track is active
        $isSheUnit = ($user->id_unit == 56);
        $isSecurityUnit = ($user->id_unit == 55);

        // Check if MY track is in a state that allows editing
        $myTrackIsActive = false;

        if ($isSheUnit) {
            // SHE track is active if status_she is NOT revision/approved/published
            $myTrackIsActive = !in_array($document->status_she, ['revision', 'approved', 'published', 'level3_approved', 'none']);
        } elseif ($isSecurityUnit) {
            // Security track is active if status_security is NOT revision/approved/published
            $myTrackIsActive = !in_array($document->status_security, ['revision', 'approved', 'published', 'level3_approved', 'none']);
        }

        // Edit Logic (UPDATED - LEBIH PERMISIF):
        // - Kepala Unit Pengelola can edit if MY track is active EXCEPT when final/approved
        // - Staff reviewers HARUS BISA EDIT jika:
        //   1. Mereka adalah reviewer (is_reviewer = 1 atau role 4/5/6)
        //   2. Track mereka aktif (myTrackIsActive = true)
        //   3. Status BUKAN approved/published (sudah final)
        $isPendingDisposition = ($isHead && $status == 'pending_head');
        $isFinalDecision = ($isHead && in_array($status, ['staff_verified', 'returned_to_head']));
        $isApprovedOrPublished = in_array($status, ['approved', 'published', 'level3_approved']);
        
        // FIX: Logic BARU untuk Staff Reviewer - LEBIH PERMISIF
        // HAPUS pembatasan status 'assigned_review' - staff reviewer harus bisa edit kapan saja
        // selama track mereka aktif dan belum approved/published
        $staffReviewerCanEdit = $isReviewer && $myTrackIsActive && !$isApprovedOrPublished;
        
        $canEdit = ($isHead && $myTrackIsActive && !$isPendingDisposition && !$isFinalDecision && !$isApprovedOrPublished) ||
            $staffReviewerCanEdit ||
            ($isApprover && $status == 'assigned_approval');

        // NEW: Strict Filtering for Details based on Assigned Categories
        $filteredDetails = $document->details;
        if (!empty($user->assigned_categories)) {
            $userCats = $user->assigned_categories;
            // Decode if string (defensive)
            if (is_string($userCats)) {
                $userCats = json_decode($userCats, true);
            }
            if (is_array($userCats) && count($userCats) > 0) {
                 // Filter details collection: items must match user categories
                 $filteredDetails = $document->details->filter(function($detail) use ($userCats) {
                     return in_array($detail->kategori, $userCats);
                 });
            }
        }
    @endphp

    <div class="container">
        <div class="alert alert-info">
            DEBUG INFO:<br>
            User ID: {{ $user->id_user }} <br>
            Role: {{ $user->role_jabatan }} <br>
            Is Reviewer Flag: {{ $user->is_reviewer }} <br>
            Is Reviewer Calculated: {{ $isReviewer ? 'YES' : 'NO' }} <br>
            Status: {{ $status }} <br>
            My Track Is Active: {{ $myTrackIsActive ? 'YES' : 'NO' }} <br>
            Is Approved/Published: {{ $isApprovedOrPublished ? 'YES' : 'NO' }} <br>
            ShowAsReviewer: {{ $showAsReviewer ? 'YES' : 'NO' }} <br>
            Staff Reviewer Can Edit: {{ isset($staffReviewerCanEdit) && $staffReviewerCanEdit ? 'YES' : 'NO' }} <br>
            Can Edit: {{ $canEdit ? 'YES' : 'NO' }} <br>
            Current Reviewer ID: {{ $currentReviewerId }} <br>
            Status SHE: {{ $document->status_she ?? 'null' }} <br>
            Status Security: {{ $document->status_security ?? 'null' }} <br>
        </div>
        <!-- Sidebar Inclusion -->
        @include('partials.sidebar')

        <main class="main-content">
            <div class="content-wrapper">
            <div class="page-header">
                <div class="header-title">
                    <h1>Review Dokumen (Unit Pengelola)</h1>
                    <p>
                        @if($isHead) Mode Kepala Unit Pengelola
                        @elseif($isReviewer) Mode Staff Reviewer
                        @elseif($isApprover) Mode Staff Verifikator
                        @else Mode View Only
                        @endif
                    </p>
                </div>
                <!-- Logic for Back button differs slightly per role, defaulting to dashboard -->
                <div style="display:flex; gap:10px;">
                    <a href="{{ route('unit_pengelola.dashboard') }}" class="btn-back"><i class="fas fa-arrow-left"></i>
                        Kembali</a>
                </div>
            </div>

            <!-- Doc Card -->
            <div class="doc-card">
                <div class="doc-header" style="justify-content: flex-start; gap: 30px;">
                    <div>
                        <div class="doc-title-label">Judul Form</div>
                        <div class="doc-title-value">{{ $document->judul_dokumen ?? $document->kolom2_kegiatan }}</div>
                    </div>
                </div>
            </div>

            <!-- Wizard -->
            <div class="wizard-container">
                <div class="wizard-steps">
                    <div class="step-item completed">
                        <div class="step-circle"><i class="fas fa-file-signature"></i></div>
                        <div class="step-label">Draft</div>
                    </div>
                    <div class="step-item completed">
                        <div class="step-circle">1</div>
                        <div class="step-label">Kepala Unit</div>
                    </div>
                    <div class="step-item active">
                        <div class="step-circle">2</div>
                        <div class="step-label">Unit Pengelola</div>
                    </div>
                    <div class="step-item">
                        <div class="step-circle">3</div>
                        <div class="step-label">Kepala Dept.</div>
                    </div>
                    <div class="step-item">
                        <div class="step-circle"><i class="fas fa-check"></i></div>
                        <div class="step-label">Selesai</div>
                    </div>
                </div>
            </div>

            <!-- TABLE (New Structure) -->
            @php
                // Fetch Programs for Tabs (Loop Logic)
                $hasPrograms = false;
                $programCount = 0;
                
                foreach($filteredDetails ?? $document->details as $detail) {
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

            <div class="page-tabs">
                <button type="button" class="tab-btn active" onclick="openTab(event, 'tab-hiradc')">
                    <i class="fas fa-table"></i> HIRADC
                </button>
                <button type="button" class="tab-btn" onclick="openTab(event, 'tab-programs')">
                    <i class="fas fa-tasks"></i> Program Kerja
                    <span class="badge-counter">{{ $programCount }}</span>
                </button>
            </div>

            <div id="tab-hiradc" class="tab-content active">
                @if(Auth::user()->id_unit == 56 && isset($isHead) && $isHead)
                    <!-- Sub-tabs for SHE Unit -->
                    <!-- Calculate Counts for Visibility -->
                    @php
                        $countK3 = $document->details->where('kategori', 'K3')->count();
                        $countKO = $document->details->where('kategori', 'KO')->count();
                        $countLing = $document->details->where('kategori', 'Lingkungan')->count();
                    @endphp

                    <div class="sub-tabs" style="display:flex; gap:10px; margin-bottom:20px; border-bottom:1px solid #e2e8f0; padding-bottom:10px;">
                        <button type="button" class="sub-tab-btn active" onclick="filterSheCategory('all', this)" style="padding:8px 16px; border-radius:8px; border:none; background:#e2e8f0; cursor:pointer; font-weight:600;">
                            All Categories
                        </button>
                        
                        @if($countK3 > 0)
                        <button type="button" class="sub-tab-btn" onclick="filterSheCategory('K3', this)" style="padding:8px 16px; border-radius:8px; border:none; background:white; cursor:pointer; border:1px solid #e2e8f0;">
                            K3 
                            @if($document->status_k3 == 'verified') <i class="fas fa-check-circle" style="color:green;"></i> 
                            @elseif($document->status_k3 == 'revision') <i class="fas fa-exclamation-circle" style="color:red;"></i> @endif
                        </button>
                        @endif

                        @if($countKO > 0)
                        <button type="button" class="sub-tab-btn" onclick="filterSheCategory('KO', this)" style="padding:8px 16px; border-radius:8px; border:none; background:white; cursor:pointer; border:1px solid #e2e8f0;">
                            KO 
                            @if($document->status_ko == 'verified') <i class="fas fa-check-circle" style="color:green;"></i> 
                            @elseif($document->status_ko == 'revision') <i class="fas fa-exclamation-circle" style="color:red;"></i> @endif
                        </button>
                        @endif

                        @if($countLing > 0)
                        <button type="button" class="sub-tab-btn" onclick="filterSheCategory('Lingkungan', this)" style="padding:8px 16px; border-radius:8px; border:none; background:white; cursor:pointer; border:1px solid #e2e8f0;">
                            Lingkungan 
                            @if($document->status_lingkungan == 'verified') <i class="fas fa-check-circle" style="color:green;"></i> 
                            @elseif($document->status_lingkungan == 'revision') <i class="fas fa-exclamation-circle" style="color:red;"></i> @endif
                        </button>
                        @endif
                    </div>
                @endif
                <div style="display:flex; justify-content:flex-end; gap:10px; margin-bottom:15px;">
                    <a href="{{ route('documents.export.detail.pdf', $document->id) }}" class="btn" style="background-color:#dc2626; color:white; padding: 8px 16px; border-radius: 8px; text-decoration: none;">
                        <i class="fas fa-file-pdf"></i> Export PDF
                    </a>
                    <a href="{{ route('documents.export.detail.excel', $document->id) }}" class="btn" style="background-color:#107c41; color:white; padding: 8px 16px; border-radius: 8px; text-decoration: none;">
                        <i class="fas fa-file-excel"></i> Export Excel
                    </a>
                </div>
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
                                <th style="width: 90px;" class="section-border-right">Kondisi<br><small>(Kol 5)</small>
                                </th>

                                <!-- BAGIAN 2 (Kolom 6-9) -->
                                <th style="width: 150px;">Potensi Bahaya<br><small>(Kol 6)</small></th>
                                <th style="width: 150px;">Aspek Lingkungan<br><small>(Kol 7)</small></th>
                                <th style="width: 150px;">Ancaman Keamanan<br><small>(Kol 8)</small></th>

                                <th style="width: 150px;">RISIKO (K3/KO)<br><small>(Kol 9)</small></th>
                                <th style="width: 150px;">DAMPAK (Lingk)<br><small>(Kol 9)</small></th>
                                <th style="width: 150px;" class="section-border-right">CELAH (Keamanan)<br><small>(Kol
                                        9)</small></th>

                                <!-- BAGIAN 3 (Kolom 10-14) -->
                                <th style="width: 250px;">Hirarki Pengendalian<br><small>(Kol 10)</small></th>
                                <th style="width: 250px;">Pengendalian Existing<br><small>(Kol 11)</small></th>
                                <th style="width: 50px;">L<br><small>(Kol 12)</small></th>
                                <th style="width: 50px;">S<br><small>(Kol 13)</small></th>
                                <th style="width: 80px;" class="section-border-right">Level<br><small>(Kol 14)</small>
                                </th>

                                <!-- BAGIAN 4 (Kolom 15-17) -->
                                <th style="width: 200px;">Regulasi<br><small>(Kol 15)</small></th>
                                <th style="width: 80px;">Aspek Penting<br><small>(Kol 16)</small></th>
                                <th style="width: 200px;" class="section-border-right">Peluang & Risiko<br><small>(Kol
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
                            @forelse($filteredDetails ?? $document->details as $index => $item)
                                @php
                                    $skip = false;

                                    // ONLY apply filtering logic if document is in revision mode
                                    // For normal viewing (draft, pending, approved, published), show ALL details
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
                                    // If not in revision mode, show everything ($skip remains false)
                                @endphp
                                @if($skip) @continue @endif

                                <tr data-category="{{ $item->kategori }}">
                                    <td style="text-align:center; padding-top:20px; font-size:14px; color:#1e293b;">
                                        {{ $index + 1 }}
                                        @if($canEdit)
                                            <div style="margin-top:5px;">
                                                <button type="button" class="action-btn-icon" 
                                                    style="background:none; border:none; color:#f59e0b; cursor:pointer;"
                                                    onclick="editItem({{ $item->id }})" title="Edit Item">
                                                    <i class="fas fa-pencil-alt"></i>
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
                                                @php $bahayaDetails = $item->kolom6_bahaya['details'] ?? []; @endphp
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
                                                    $details7 = $col7['details'] ?? ((is_array($col7) && !array_key_exists('details', $col7)) ? $col7 : []);
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
                                                    $details8 = $col8['details'] ?? ((is_array($col8) && !array_key_exists('details', $col8)) ? $col8 : []);
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
                                            <div class="cell-text">{{ $item->kolom9_risiko_k3ko ?? $item->kolom9_risiko }}</div>
                                        @else
                                            <div style="color:#94a3b8; text-align:center;">-</div>
                                        @endif
                                    </td>

                                    <!-- Kolom 9b: DAMPAK (Lingkungan) -->
                                    <td>
                                        @if($item->kategori == 'Lingkungan')
                                            <div class="cell-text">{{ $item->kolom9_dampak_lingkungan ?? $item->kolom9_risiko }}
                                            </div>
                                        @else
                                            <div style="color:#94a3b8; text-align:center;">-</div>
                                        @endif
                                    </td>

                                    <!-- Kolom 9c: CELAH (Keamanan) -->
                                    <td class="section-border-right">
                                        @if($item->kategori == 'Keamanan')
                                            <div class="cell-text">{{ $item->kolom9_celah_keamanan ?? $item->kolom9_risiko }}
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
                                        <div style="font-weight:800; font-size:16px;">{{ $item->kolom12_kemungkinan }}</div>
                                    </td>
                                    <td class="risk-col" style="vertical-align:middle; text-align:center;">
                                        <div style="font-weight:800; font-size:16px;">{{ $item->kolom13_konsekuensi }}</div>
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
                                    <td colspan="22" style="text-align:center; padding:20px;">Tidak ada data detail.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
            </div>

            <!-- COMPLIANCE CHECKLIST -->
            <!-- Logic: Show if Head (Level 2) OR Reviewer/Approver active -->
            @php
                // Show compliance checklist
                $user = Auth::user();
                $isSheUnit = ($user->id_unit == 56);
                $isSecurityUnit = ($user->id_unit == 55);
                
                // PERBAIKAN LOGIC:
                // 1. Staff Reviewer (Stage 1): Checklist TIDAK MUNCUL.
                // 2. Staff Reviewer (Stage 2 - dari Verifikator): Checklist MUNCUL.
                // 3. Kepala Unit (Disposition): Checklist TIDAK MUNCUL.
                // 4. Kepala Unit (Final Approval): Checklist MUNCUL.
                // 5. Staff Verifikator: Checklist SELALU MUNCUL.

                $showChecklist = false;

                if ($isSheUnit || $isSecurityUnit) {
                    if ($isApprover && in_array($status, ['assigned_approval', 'process_verification'])) {
                        // Verifikator selalu melihat/mengisi checklist (Hanya saat status benar)
                        $showChecklist = true;
                    } elseif ($isReviewer) {
                        // Reviewer hanya melihat jika Dokumen sudah kembali dari Verifikator (Stage 2)
                        // Cek status:
                        // Security: 'staff_verified'
                        // SHE: 'awaiting_final_review' pada salah satu kategori (K3/KO/Lingkungan)
                        
                        if ($isSecurityUnit && $document->status_security == 'staff_verified') {
                            $showChecklist = true;
                        } elseif ($isSheUnit) {
                            // Cek jika ada yang 'awaiting_final_review' ATAU sudah 'verified' (artinya sudah lewat verifikator)
                            // Jika murni 'assigned_review' (dari Head), maka Stage 1 -> Hide
                            
                            $k3Ready = in_array($document->status_k3, ['awaiting_final_review', 'verified']);
                            $koReady = in_array($document->status_ko, ['awaiting_final_review', 'verified']);
                            $lingkunganReady = in_array($document->status_lingkungan, ['awaiting_final_review', 'verified']);
                            
                            if ($k3Ready || $koReady || $lingkunganReady) {
                                $showChecklist = true;
                            }
                        }
                    } elseif ($isHead) {
                        // Kepala Unit: Hide jika status 'pending_head' (belum didisposisi)
                        // Show jika sedang proses approval ('process_approval', 'staff_verified', etc.)
                        
                        // FIX: Logic BARU berdasarkan Permintaan User:
                        // "tabel kesesuaian akan muncul setelah menerima dokumen review terakhir dari Reviewer"
                        // Artinya saat status sudah 'process_approval' (siap setujui) atau sudah 'approved'.
                        // Saat status 'assigned_approval' (Verifikator) atau 'staff_verified' (Reviewer Stage 2), Head TIDAK MELIHAT checklist.
                        
                        $visibleToHead = ['process_approval', 'approved', 'published', 'level3_approved', 'pending_level3_ready'];

                        if (in_array($status, $visibleToHead)) {
                             $showChecklist = true;
                        }
                    }
                }
            @endphp

            @if($showChecklist)
                <div id="compliance-checklist-container" class="doc-card" style="margin-top: 30px; display: none;"> <!-- Hidden by default, shown by JS -->
                    <div class="card-header-slim" style="display:flex; justify-content:space-between; align-items:center;">
                        <div style="display:flex; align-items:center; gap:12px;">
                            <i class="fas fa-clipboard-check"></i>
                            <h2>Tabel Kesesuaian (Compliance Checklist)</h2>
                        </div>
                        {{-- Compliance checklist should always be disabled for Kepala Unit Pengelola --}}
                        {{-- Only staff can edit via toggle button --}}

                    </div>
                    <div class="doc-body">
                        <div style="overflow-x: auto;">
                            <!-- Simple Table Structure, Logic Handled by JS below -->
                            <table style="width: 100%; border-collapse: collapse; font-size: 13px;">
                                <thead style="background: #1e293b; color: white;">
                                    <tr>
                                        <th style="padding:12px;">No</th>
                                        <th style="padding:12px;">Kriteria</th>
                                        <th style="padding:12px;">Kesesuaian</th>
                                        <th style="padding:12px;">Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $criteriaList = [
                                            ['key' => 'format', 'label' => 'Standar Format'],
                                            ['key' => 'numbering', 'label' => 'Penomoran Dokumen'],
                                            ['key' => 'revision', 'label' => 'Kemutakhiran Nomor Revisi'],
                                            ['key' => 'approval', 'label' => 'Approval Dokumen'],
                                            ['key' => 'identification_coverage', 'label' => 'Ident. mencakup semua proses'],
                                            ['key' => 'condition_coverage', 'label' => 'Ident. mencakup semua kondisi (R/NR/E)'],
                                            ['key' => 'mitigation', 'label' => 'Kesesuaian Program Mitigasi']
                                        ];
                                        $existing = [];
                                        if ($user->id_unit == 56) { // SHE
                                            $existing = $document->compliance_checklist_she ?? [];
                                        } elseif ($user->id_unit == 55) { // Security
                                            $existing = $document->compliance_checklist_security ?? [];
                                        } else {
                                            $existing = $document->compliance_checklist_she ?? $document->compliance_checklist_security ?? $document->compliance_checklist ?? [];
                                        }
                                    @endphp
                                    @foreach($criteriaList as $idx => $c)
                                        @php
                                            $s = $existing[$c['key']]['status'] ?? '';
                                            $n = $existing[$c['key']]['note'] ?? '';
                                            
                                            // Default: ALWAYS DISABLED initially
                                            // Staff will enable it via JS Toggle Button
                                            $disabled = 'disabled';  
                                            $noteDisabled = 'disabled';
                                            $noteStyle = 'background:#f1f5f9;cursor:not-allowed;'; 
                                            
                                            // Logic: 
                                            // 1. Head of Unit Pengelola: Can edit except when pending/final.
                                            // 2. Staff (Reviewer/Approver): Can edit when assigned.
                                            // PING-PONG: Reviewer (Stage 1 & 2) and Verifier can both edit checklist?
                                            // User said:
                                            // - Reviewer Task 1: Review Konten (Checklist Read-only?) -> User said "review teknis (isi checklist...) di staff verifikator". So Reviewer 1 maybe no checklist?
                                            // - Verifier: "isi checklist & edit konten".
                                            // - Reviewer Task 2: "memverifikasi hasil review... edit tabel hiradc dan tabel checklist".
                                            
                                            // So: 
                                            // Reviewer Stage 1: Checklist Read-Only (or Editable)? Let's allow Editable to be safe, or Read-Only if strictly following "Verifier fills it".
                                            // Verifier: Editable.
                                            // Reviewer Stage 2: Editable.
                                            
                                            $isPendingDisposition = ($isHead && $status == 'pending_head');
                                            $isFinalDecision = ($isHead && in_array($status, ['staff_verified', 'returned_to_head']));
                                            $isApprovedOrPublished = in_array($status, ['approved', 'published', 'level3_approved']);
                                            
                                            $headCanEdit = ($isHead && $myTrackIsActive && !$isPendingDisposition && !$isFinalDecision && !$isApprovedOrPublished);
                                            
                                            // Staff Logic
                                            // Reviewer can edit if 'assigned_review' (Stage 1 or 2)
                                            // Verifier can edit if 'assigned_approval'
                                            // PING-PONG FIX:
                                            // Reviewer Stage 2 (dapat balikan Verifikator):
                                            // - Security: status 'staff_verified'
                                            // - SHE: status 'assigned_review' TAPI salah satu kategori 'awaiting_final_review'
                                            
                                            $isSheStage2 = false;
                                            if ($isSheUnit && $isReviewer) {
                                                $isSheStage2 = in_array($document->status_k3, ['awaiting_final_review', 'verified']) ||
                                                               in_array($document->status_ko, ['awaiting_final_review', 'verified']) ||
                                                               in_array($document->status_lingkungan, ['awaiting_final_review', 'verified']);
                                            }

                                            $staffCanEdit = ($isApprover && in_array($status, ['assigned_approval', 'process_verification'])) || 
                                                            ($isReviewer && ($status == 'staff_verified' || $isSheStage2));

                                            if ($headCanEdit || $staffCanEdit) {
                                                $disabled = '';
                                                // If already filled NOK/Tdk Penting, enable note
                                                if ($s == 'NOK' || $s == 'Tdk Penting') {
                                                    $noteDisabled = '';
                                                    $noteStyle = 'background:white;cursor:text;';
                                                }
                                            }
                                        @endphp
                                        <tr style="border-bottom:1px solid #e2e8f0;">
                                            <td style="padding:12px; text-align:center;">{{ $idx + 1 }}</td>
                                            <td style="padding:12px;">{{ $c['label'] }}</td>
                                            <td style="padding:12px;">
                                                <select name="compliance_checklist[{{ $c['key'] }}][status]"
                                                    id="status_{{ $c['key'] }}" class="compliance-status form-control" {{ $disabled }}
                                                    onchange="toggleNoteField('{{ $c['key'] }}')">
                                                    <option value="">-- Pilih --</option>
                                                    <option value="OK" {{ $s == 'OK' ? 'selected' : '' }}>OK</option>
                                                    <option value="NOK" {{ $s == 'NOK' ? 'selected' : '' }}>NOK</option>
                                                    <option value="Tdk Penting" {{ $s == 'Tdk Penting' ? 'selected' : '' }}>Tdk
                                                        Penting</option>
                                                </select>
                                            </td>
                                            <td style="padding:12px;">
                                                <input type="text" name="compliance_checklist[{{ $c['key'] }}][note]"
                                                    id="note_{{ $c['key'] }}" value="{{ $n }}"
                                                    class="compliance-note form-control" {{ $noteDisabled }} style="{{ $noteStyle }}">
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif

            <!-- PUK SECTION (Injected in Tab 2) -->
            </div> <!-- End Tab HIRADC -->

            <div id="tab-programs" class="tab-content">
                @foreach($filteredDetails ?? $document->details as $detailIndex => $detail)
                    @php
                        $puk = $detail->pukProgram;
                        $pmk = $detail->pmkProgram;
                    @endphp

                    @if($puk)
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
                        <div class="doc-card" style="margin-top: 32px; border-left: 5px solid #3b82f6;">
                            <div class="card-header-slim" style="display: flex; justify-content: space-between; align-items: center;">
                                <div style="display: flex; align-items: center; gap: 12px;">
                                    <i class="fas fa-tasks"></i>
                                    <h2>Review Program Unit Kerja (PUK) #{{ $detailIndex + 1 }}</h2>
                                </div>
                                <!-- Download Buttons for PUK -->
                                <div style="display: flex; gap: 8px;">
                                    <a href="{{ route('documents.export.puk.pdf', $document->id) }}" 
                                       class="btn btn-sm" 
                                       style="background-color: #dc2626; color: white; padding: 6px 12px; border-radius: 6px; text-decoration: none; font-size: 13px; display: inline-flex; align-items: center; gap: 6px;">
                                        <i class="fas fa-file-pdf"></i> Download PDF
                                    </a>
                                    <a href="{{ route('documents.export.puk.excel', $document->id) }}" 
                                       class="btn btn-sm" 
                                       style="background-color: #107c41; color: white; padding: 6px 12px; border-radius: 6px; text-decoration: none; font-size: 13px; display: inline-flex; align-items: center; gap: 6px;">
                                        <i class="fas fa-file-excel"></i> Download Excel
                                    </a>
                                </div>
                            </div>
                            <div style="padding: 24px;">
                                <!-- Informasi Program -->
                                <div style="background: #f8fafc; padding: 20px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #e2e8f0;">
                                    <div style="display: grid; grid-template-columns: 200px 1fr; gap: 12px; font-size: 14px;">
                                        <div style="font-weight: 600; color: #475569;">Judul Program</div>
                                        <div style="color: #0f172a;">: {{ $puk->judul }}</div>
                                        <div style="font-weight: 600; color: #475569;">Tujuan</div>
                                        <div style="color: #0f172a;">: {{ $puk->tujuan }}</div>
                                        <div style="font-weight: 600; color: #475569;">Sasaran</div>
                                        <div style="color: #0f172a;">: {{ $puk->sasaran }}</div>
                                        <div style="font-weight: 600; color: #475569;">Penanggung Jawab</div>
                                        <div style="color: #0f172a;">: {{ $puk->penanggung_jawab }}</div>

                                        @if($puk->uraian_revisi)
                                        <div style="font-weight: 600; color: #475569;">Uraian Revisi</div>
                                        <div style="color: #0f172a;">: {{ $puk->uraian_revisi }}</div>
                                        @endif
                                    </div>
                                </div>

                                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
                                    <h4 style="font-size:15px; font-weight:700; color:#0f172a; margin: 0;">Detail Program Kerja:</h4>
                                    @php
                                        // PERBAIKAN: Program Kerja HANYA bisa diedit oleh Submitter (Level 1).
                                        // Di tahap Unit Pengelola (Level 2), sifatnya View Only.
                                        $canEditPuk = false; 
                                    @endphp
                                    @if($canEditPuk)
                                    <button type="button" onclick="toggleEditModePuk({{ $detailIndex }})" id="btnEditPuk-{{ $detailIndex }}" class="btn btn-sm" style="background:#3b82f6; color:white; padding:6px 12px; border-radius:6px; font-size: 13px; border:none; cursor: pointer;">
                                        <i class="fas fa-edit me-1"></i> Edit
                                    </button>
                                    @endif
                                </div>

                                <!-- Wrapper dengan scroll horizontal -->
                                <div style="overflow-x: auto; -webkit-overflow-scrolling: touch; margin-bottom: 1rem; border: 1px solid #e2e8f0; border-radius: 6px;">
                                    <form id="pukEditForm-{{ $detailIndex }}">
                                    <!-- Min-width table -->
                                    <table class="table table-bordered" style="width:100%; min-width: 1200px; font-size:13px; border-collapse: collapse;">
                                        <thead>
                                            <tr style="background: #1e293b; color: white;">
                                                <th rowspan="2" style="border: 1px solid #cbd5e1; padding: 12px; text-align: center; width: 50px;">NO</th>
                                                <th rowspan="2" style="border: 1px solid #cbd5e1; padding: 12px; text-align: left; min-width: 250px;">URAIAN KEGIATAN</th>
                                                <th rowspan="2" style="border: 1px solid #cbd5e1; padding: 12px; text-align: left; min-width: 150px;">KOORD.</th>
                                                <th rowspan="2" style="border: 1px solid #cbd5e1; padding: 12px; text-align: left; min-width: 150px;">PELAKSANA</th>
                                                <th colspan="12" style="border: 1px solid #cbd5e1; padding: 12px; text-align: center;">TARGET (%)</th>
                                            </tr>
                                            <tr style="background: #334155; color: white;">
                                                @for($m=1; $m<=12; $m++)
                                                    <!-- Perbesar lebar kolom target -->
                                                    <th style="border: 1px solid #cbd5e1; padding: 8px; text-align: center; width: 50px; min-width: 50px;">{{ $m }}</th>
                                                @endfor
                                            </tr>
                                        </thead>
                                        <tbody id="pukTableBody-{{ $detailIndex }}">
                                            @foreach($puk->program_kerja as $index => $item)
                                            <tr style="background: {{ $index % 2 == 0 ? '#ffffff' : '#f9fafb' }};">
                                                <td style="border: 1px solid #cbd5e1; padding: 10px; text-align: center; font-weight: 600;">{{ $index + 1 }}</td>
                                                <td style="border: 1px solid #cbd5e1; padding: 10px;">
                                                    <span class="view-mode">{{ $item['uraian'] ?? '-' }}</span>
                                                    <textarea class="edit-mode form-control" style="display:none; width:100%; min-height:60px; padding:8px;" name="program_kerja[{{ $index }}][uraian]">{{ $item['uraian'] ?? '' }}</textarea>
                                                </td>
                                                <td style="border: 1px solid #cbd5e1; padding: 10px;">
                                                    <span class="view-mode">{{ $item['koordinator'] ?? '-' }}</span>
                                                    <select class="edit-mode form-control" style="display:none; width:100%; padding:6px;" name="program_kerja[{{ $index }}][koordinator]">
                                                        <option value="">-- Pilih --</option>
                                                        @foreach($band3Users as $u)
                                                            <option value="{{ $u->nama_user }}" {{ ($item['koordinator'] ?? '') == $u->nama_user ? 'selected' : '' }}>{{ $u->nama_user }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td style="border: 1px solid #cbd5e1; padding: 10px;">
                                                    <span class="view-mode">{{ $item['pelaksana'] ?? '-' }}</span>
                                                    <select class="edit-mode form-control" style="display:none; width:100%; padding:6px;" name="program_kerja[{{ $index }}][pelaksana]">
                                                        <option value="">-- Pilih --</option>
                                                        @foreach($band4Users as $u)
                                                            <option value="{{ $u->nama_user }}" {{ ($item['pelaksana'] ?? '') == $u->nama_user ? 'selected' : '' }}>{{ $u->nama_user }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                @php $targets = $item['target'] ?? []; @endphp
                                                @for($m=0; $m<12; $m++)
                                                    <td style="border: 1px solid #cbd5e1; padding: 6px; text-align: center; font-size: 12px;">
                                                        <span class="view-mode">{{ isset($targets[$m]) && $targets[$m] !== '' ? $targets[$m] : '-' }}</span>
                                                        <input type="number" class="edit-mode form-control" style="display:none; width:100%; padding:4px; text-align:center;" name="program_kerja[{{ $index }}][target][]" value="{{ $targets[$m] ?? '' }}" min="0" max="100">
                                                    </td>
                                                @endfor
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div id="pukEditActions-{{ $detailIndex }}" style="display:none; margin-top:15px; text-align:right;">
                                        <button type="button" onclick="cancelEditPuk({{ $detailIndex }})" class="btn" style="background:#e2e8f0; margin-right:8px; padding:8px 16px; border:none; border-radius:6px;">Batal</button>
                                        <button type="button" onclick="savePukChanges({{ $detailIndex }}, {{ $puk->id }})" class="btn" style="background:#10b981; color:white; padding:8px 16px; border:none; border-radius:6px;">Simpan PUK</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if($pmk)
                        <div class="doc-card" style="margin-top: 32px; border-left: 5px solid #c026d3;">
                            <div class="card-header-slim" style="display: flex; justify-content: space-between; align-items: center;">
                                <div style="display: flex; align-items: center; gap: 12px;">
                                    <i class="fas fa-project-diagram"></i>
                                    <h2>Review Program Manajemen Korporat (PMK) #{{ $detailIndex + 1 }}</h2>
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
                                <div style="background: #faf5ff; padding: 20px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #e9d5ff;">
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
                                        @endif
                                    </div>
                                </div>

                                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
                                    <h4 style="font-size:15px; font-weight:700; color:#0f172a; margin: 0;">Detail Program Kerja:</h4>
                                    @php
                                        // PERBAIKAN: Program Kerja HANYA bisa diedit oleh Submitter (Level 1).
                                        // Di tahap Unit Pengelola (Level 2), sifatnya View Only.
                                        $canEditPmk = false; 
                                    @endphp
                                    @if($canEditPmk)
                                    <button type="button" onclick="toggleEditModePmk({{ $detailIndex }})" id="btnEditPmk-{{ $detailIndex }}" class="btn btn-sm" style="background:#c026d3; color:white; padding:6px 12px; border-radius:6px; font-size: 13px; border:none; cursor: pointer;">
                                        <i class="fas fa-edit me-1"></i> Edit
                                    </button>
                                    @endif
                                </div>

                                <!-- Wrapper dengan scroll horizontal -->
                                <div style="overflow-x: auto; -webkit-overflow-scrolling: touch; margin-bottom: 1rem; border: 1px solid #e2e8f0; border-radius: 6px;">
                                    <form id="pmkEditForm-{{ $detailIndex }}">
                                    <!-- Min-width table -->
                                    <table class="table table-bordered" style="width:100%; min-width: 1200px; font-size:13px; border-collapse: collapse;">
                                        <thead>
                                            <tr style="background: #1e293b; color: white;">
                                                <th rowspan="2" style="border: 1px solid #cbd5e1; padding: 12px; text-align: center; width: 50px;">NO</th>
                                                <th rowspan="2" style="border: 1px solid #cbd5e1; padding: 12px; text-align: left; min-width: 200px;">URAIAN KEGIATAN</th>
                                                <th rowspan="2" style="border: 1px solid #cbd5e1; padding: 12px; text-align: left; width: 120px;">PIC</th>
                                                <th colspan="12" style="border: 1px solid #cbd5e1; padding: 12px; text-align: center;">TARGET (%)</th>
                                                <th rowspan="2" style="border: 1px solid #cbd5e1; padding: 12px; text-align: left; width: 120px;">ANGGARAN</th>
                                            </tr>
                                            <tr style="background: #334155; color: white;">
                                                @for($m=1; $m<=12; $m++)
                                                    <th style="border: 1px solid #cbd5e1; padding: 8px; text-align: center; width: 50px; min-width: 50px;">{{ $m }}</th>
                                                @endfor
                                            </tr>
                                        </thead>
                                        <tbody id="pmkTableBody-{{ $detailIndex }}">
                                            @foreach($pmk->program_kerja as $index => $item)
                                            <tr style="background: {{ $index % 2 == 0 ? '#ffffff' : '#faf9fb' }};">
                                                <td style="border: 1px solid #cbd5e1; padding: 10px; text-align: center; font-weight: 600;">{{ $index + 1 }}</td>
                                                <td style="border: 1px solid #cbd5e1; padding: 10px;">
                                                    <span class="view-mode">{{ $item['uraian'] ?? '-' }}</span>
                                                    <textarea class="edit-mode form-control" style="display:none; width:100%; min-height:60px; padding:8px;" name="program_kerja[{{ $index }}][uraian]">{{ $item['uraian'] ?? '' }}</textarea>
                                                </td>
                                                <td style="border: 1px solid #cbd5e1; padding: 10px;">
                                                    <span class="view-mode">{{ (!empty($item['koordinator']) && $item['koordinator'] !== '-') ? $item['koordinator'] : ($item['pelaksana'] ?? $item['pic'] ?? '-') }}</span>
                                                    <select class="edit-mode form-control" style="display:none; width:100%; padding:6px;" name="program_kerja[{{ $index }}][koordinator]">
                                                        <option value="">-- Pilih PIC --</option>
                                                        @foreach($pmkPicUsers as $u)
                                                            <option value="{{ $u->nama_user }}" {{ ($item['koordinator'] ?? $item['pic'] ?? $item['pelaksana'] ?? '') == $u->nama_user ? 'selected' : '' }}>{{ $u->nama_user }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                @php $targets = $item['target'] ?? []; @endphp
                                                @for($m=0; $m<12; $m++)
                                                    <td style="border: 1px solid #cbd5e1; padding: 6px; text-align: center; font-size: 12px;">
                                                        <span class="view-mode">{{ isset($targets[$m]) && $targets[$m] !== '' ? $targets[$m] : '-' }}</span>
                                                        <input type="number" class="edit-mode form-control" style="display:none; width:100%; padding:4px; text-align:center;" name="program_kerja[{{ $index }}][target][]" value="{{ $targets[$m] ?? '' }}" min="0" max="100">
                                                    </td>
                                                @endfor
                                                <td style="border: 1px solid #cbd5e1; padding: 10px;">
                                                    <span class="view-mode">{{ isset($item['anggaran']) ? 'Rp ' . number_format($item['anggaran'], 0, ',', '.') : '-' }}</span>
                                                    <input type="number" class="edit-mode form-control" style="display:none; width:100%; padding:6px;" name="program_kerja[{{ $index }}][anggaran]" value="{{ $item['anggaran'] ?? '' }}">
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div id="pmkEditActions-{{ $detailIndex }}" style="display:none; margin-top:15px; text-align:right;">
                                        <button type="button" onclick="cancelEditPmk({{ $detailIndex }})" class="btn" style="background:#e2e8f0; margin-right:8px; padding:8px 16px; border:none; border-radius:6px;">Batal</button>
                                        <button type="button" onclick="savePmkChanges({{ $detailIndex }}, {{ $pmk->id }})" class="btn" style="background:#c026d3; color:white; padding:8px 16px; border:none; border-radius:6px;">Simpan PMK</button>
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
                    const programKerja = [];
                    const rows = document.querySelectorAll(`#pukTableBody-${index} tr`);
                    rows.forEach((row, idx) => {
                        const uraian = row.querySelector(`[name="program_kerja[${idx}][uraian]"]`).value;
                        const koord = row.querySelector(`[name="program_kerja[${idx}][koordinator]"]`).value;
                        const pelaksana = row.querySelector(`[name="program_kerja[${idx}][pelaksana]"]`).value;
                        const targets = [];
                        row.querySelectorAll(`[name="program_kerja[${idx}][target][]"]`).forEach(input => targets.push(input.value));
                        programKerja.push({uraian, koordinator: koord, pelaksana, target: targets});
                    });
                    Swal.fire({title: 'Menyimpan...', didOpen: () => Swal.showLoading()});
                    fetch(`/unit-pengelola/puk/${pukId}/update-program-kerja`, {
                        method: 'PUT',
                        headers: {'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                        body: JSON.stringify({ program_kerja: programKerja })
                    }).then(res => res.json()).then(data => {
                        if (data.success) Swal.fire('Berhasil!', data.message, 'success').then(() => location.reload());
                        else Swal.fire('Gagal!', data.message, 'error');
                    }).catch(err => Swal.fire('Error', 'Terjadi kesalahan', 'error'));
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
                    const programKerja = [];
                    const rows = document.querySelectorAll(`#pmkTableBody-${index} tr`);
                    rows.forEach((row, idx) => {
                        const uraian = row.querySelector(`[name="program_kerja[${idx}][uraian]"]`).value;
                        const koord = row.querySelector(`[name="program_kerja[${idx}][koordinator]"]`).value;
                        const anggaran = row.querySelector(`[name="program_kerja[${idx}][anggaran]"]`).value;
                        const targets = [];
                        row.querySelectorAll(`[name="program_kerja[${idx}][target][]"]`).forEach(input => targets.push(input.value));
                        programKerja.push({uraian, koordinator: koord, target: targets, anggaran: anggaran ? parseInt(anggaran) : null});
                    });
                    Swal.fire({title: 'Menyimpan...', didOpen: () => Swal.showLoading()});
                    fetch(`/unit-pengelola/pmk/${pmkId}/update-program-kerja`, {
                        method: 'PUT',
                        headers: {'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                        body: JSON.stringify({ program_kerja: programKerja })
                    }).then(res => res.json()).then(data => {
                        if (data.success) Swal.fire('Berhasil!', data.message, 'success').then(() => location.reload());
                        else Swal.fire('Gagal!', data.message, 'error');
                    }).catch(err => Swal.fire('Error', 'Terjadi kesalahan', 'error'));
                }
                </script>
            </div> <!-- End Tab Programs -->

            <!-- TIMELINE -->
            <div class="timeline-card">
                <div class="timeline-header">
                    <i class="fas fa-history" style="color:var(--primary);"></i> 
                    <span>Riwayat Proses</span>
                </div>
                
                <div class="timeline-container">
                @php
                    // Show ALL approval history without filtering duplicates
                    // User requested to show complete history
                    $uniqueHistory = $document->approvals;
                @endphp
                @foreach($uniqueHistory as $hist)
                    @php
                        // Strictly hide logs from the other department unit
                        $isParallelHidden = false;
                        $histUnit = optional($hist->approver)->id_unit;
                        $histLevel = $hist->level ?? 0;
                        $histAction = strtolower($hist->action ?? '');
                        
                        // Allow Level 1 and created/submitted for all
                        $isSharedAction = ($histLevel == 1) || in_array($histAction, ['created', 'submitted']);
                        
                        // For all other actions, filter by unit
                        if (!$isSharedAction) {
                            if ($user->id_unit == 56) { // I am SHE
                                if ($histUnit == 55) $isParallelHidden = true; // Hide Security
                            } elseif ($user->id_unit == 55) { // I am Security
                                if ($histUnit == 56) $isParallelHidden = true; // Hide SHE
                            }
                        }
                        
                        if ($isParallelHidden) continue;
                    @endphp
                    @php
                        $action = strtolower($hist->action);
                        $colorClass = 'tm-blue';
                        $icon = 'fa-info-circle';
                        $label = ucfirst($hist->action);

                        if ($action == 'published') {
                            $colorClass = 'tm-green';
                            $icon = 'fa-globe';
                        } elseif ($action == 'approved') {
                            $colorClass = 'tm-green';
                            $icon = 'fa-check-circle';
                        } elseif ($action == 'verified') {
                            $colorClass = 'tm-teal'; // Distinct color
                            $icon = 'fa-check-double';
                        } elseif ($action == 'reviewed') {
                            $colorClass = 'tm-indigo'; // Distinct color
                            $icon = 'fa-glasses';
                        } elseif (in_array($action, ['revision', 'revise', 'returned'])) {
                            $colorClass = 'tm-red';
                            $icon = 'fa-undo';
                        } elseif ($action == 'disposition') {
                            $colorClass = 'tm-purple';
                            $icon = 'fa-share';
                        }
                    @endphp
                    <div class="timeline-item {{ $colorClass }}">
                        <div class="tm-icon">
                            <i class="fas {{ $icon }}"></i>
                        </div>
                        <div class="tm-content">
                            <div class="tm-header">
                                <span class="tm-user">{{ $hist->approver->nama_user ?? 'System' }}</span>
                                <span class="tm-badge" style="background: #f1f5f9; color: #64748b;">{{ $hist->approver->unit->nama_unit ?? '-' }}</span>
                                <span class="tm-badge">{{ $hist->level }}</span>
                                <span class="tm-date">{{ $hist->created_at->format('d M Y, H:i') }} WIB</span>
                            </div>
                            <div class="tm-status">{{ $label }}</div>
                            @if($hist->catatan)
                                <div class="tm-comment">
                                    <i class="fas fa-quote-left"></i> {{ $hist->catatan }}
                                </div> 
                            @endif
                        </div>
                    </div>
                @endforeach
                </div>
            </div>

            <!-- Global Toast/Alert Helper -->
            @if(session('success'))
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: "{{ session('success') }}",
                            timer: 3000,
                            showConfirmButton: false
                        });
                    });
                </script>
            @endif
            @if(session('error'))
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: "{{ session('error') }}",
                        });
                    });
                </script>
            @endif




        </main>

        <!-- FOOTER ACTIONS -->
        <div class="review-footer">
            {{-- DEBUG --}}
            {{-- @php dd('Status:', $status, 'Unit:', $user->id_unit, 'SHE Status:', $document->status_she, 'Sec Status:', $document->status_security); @endphp --}}
            
            {{-- 1. KEPALA UNIT PENGELOLA --}}
            {{-- 1. KEPALA UNIT PENGELOLA --}}
            {{-- Exception: If Manager is acting as Reviewer, skip Head view --}}
            @if($isHead && $document->current_level == 2 && !$showAsReviewer)
                {{-- STRICT: Only show Action Buttons if "Ready for Final Decision" --}}
                @if(in_array($status, ['returned_to_head', 'staff_verified', 'process_approval']))
                    <!-- Final Approval by Head -->
                    <form id="headApproveForm" method="POST" action="{{ route('unit_pengelola.approve', $document->id) }}"
                        style="width:100%; display:flex; flex-direction:column; gap:15px;">
                        @csrf
                        <div class="notes-area">
                             <textarea name="catatan" class="notes-input" placeholder="Tambahkan komentar/catatan (Opsional untuk Approve, Wajib untuk Revisi)..."></textarea>
                        </div>
                        <div class="action-btns" style="display:flex; justify-content: flex-end; gap:15px;">
                            <button type="button" class="btn btn-revise" onclick="submitHeadAction('revise')">Revisi</button>
                            <button type="button" class="btn btn-approve" onclick="submitHeadAction('approve')">Approve</button>
                        </div>
                    </form>
                @elseif($status == 'approved')
                    <div class="alert alert-success" style="width:100%; margin:0; text-align:center;">
                        <i class="fas fa-check-circle"></i> Dokumen ini telah Anda setujui.
                    </div>
                @else
                    <div class="alert alert-info" style="width:100%; margin:0; text-align:center;">
                        <i class="fas fa-clock"></i> Menunggu pemeriksaan oleh Reviewer/Verifikator Staff.
                    </div>
                @endif

                </form>

                {{-- 2. STAFF REVIEWER --}}
            @elseif($isReviewer && in_array($status, ['assigned_review', 'pending_head', 'staff_verified']))
                {{-- PING-PONG LOGIC:
                     Stage 1: 'assigned_review' (Init by Head) -> Send to Verifier
                     Stage 2: 'staff_verified' (Returned by Verifier) -> Send to Head
                     Note: 'process_verification' might be seen if partial categories done? No, Reviewer actions based on specific status.
                --}}
                
                <form id="staffActionForm" method="POST" action="{{ route('unit_pengelola.submit_review', $document->id) }}"
                    style="width:100%; display:flex; gap:15px;">
                    @csrf
                    <!-- Compliance Data Injected via JS -->
                    <input type="hidden" name="compliance_checklist" id="compliance_checklist_input">
                    
                     {{-- STAGE LOGIC: Check Status --}}
                     @php
                         // Default to Stage 1
                         $btnLabel = "Kirim ke Staff Verifikator";
                         $btnColor = "btn-primary";
                         $placeholder = "Catatan Review Tahap 1...";
                         
                         // If Returned from Verifier (Stage 2)
                         // Check specific categories if using SHE unit
                         $isStage2 = false;
                         if ($isSheUnit) {
                             // If ANY category is 'verified' or 'awaiting_final_review', we treat as Stage 2 potential?
                             // Actually, Controller `verifyUnit` sets 'awaiting_final_review' (or 'verified' in previous attempt, let's check controller).
                             // I used 'awaiting_final_review' in verifyUnit.
                             // So if status is 'awaiting_final_review', it's Stage 2.
                             
                             // However, $status variable here is $status_she which is 'assigned_review' after verifyUnit.
                             // So we need to check sub-statuses.
                             $hasReturn = ($document->status_k3 == 'awaiting_final_review' || 
                                           $document->status_ko == 'awaiting_final_review' || 
                                           $document->status_lingkungan == 'awaiting_final_review');
                                           
                             if ($hasReturn) {
                                  $isStage2 = true;
                             }
                         } elseif ($isSecurityUnit) {
                             if ($document->status_security == 'staff_verified') {
                                  $isStage2 = true;
                             }
                         } else {
                             // Fallback
                             if ($status == 'staff_verified') $isStage2 = true;
                         }

                         if ($isStage2) {
                             $btnLabel = "Final Review & Kirim ke Kepala Unit";
                             $btnColor = "btn-approve"; // Green/Dark
                             $placeholder = "Catatan Final Review...";
                         }
                     @endphp

                    <div class="notes-area">
                        <textarea name="catatan" class="notes-input" placeholder="{{ $placeholder }}"></textarea>
                    </div>
                    <div class="action-btns">
                        <button type="button" class="btn {{ $btnColor }}" onclick="submitStaffAction('{{ $isStage2 ? 'head' : 'verifier' }}')">
                            {{ $btnLabel }}
                        </button>
                    </div>
                </form>

                {{-- 3. STAFF VERIFIKATOR --}}
            @elseif($isApprover && in_array($status, ['assigned_approval', 'process_verification']))
                <form id="staffActionForm" method="POST" action="{{ route('unit_pengelola.verify', $document->id) }}"
                    style="width:100%; display:flex; gap:15px;">
                    @csrf
                    <!-- Inject Compliance Data (Required for submitStaffAction) -->
                    <input type="hidden" name="compliance_checklist" id="compliance_checklist_input">
                    <div class="notes-area">
                        <textarea name="catatan" class="notes-input" placeholder="Catatan Verifikasi..."></textarea>
                    </div>
                    <div class="action-btns">
                        {{-- Verificator always sends back to Reviewer --}}
                        <button type="button" class="btn btn-warning" onclick="submitStaffAction('reviewer')">
                            <i class="fas fa-undo"></i> Kirim ke Staff Reviewer
                        </button>
                    </div>
                </form>
            @else
                <div class="view-only-message">
                    <div class="view-only-icon">
                        <i class="fas fa-eye"></i>
                    </div>
                    <div class="view-only-text">
                        <strong>Mode View Only</strong>
                        <p>Anda tidak memiliki akses untuk mengedit dokumen ini</p>
                    </div>
                </div>
            @endif
            </div><!-- /content-wrapper -->
        </main>
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

    <!-- SCRIPTS -->
    <script>
        // --- 1. Edit Modal Logic ---
        function openEditModal(item) {
            const id = item.id;
            document.getElementById('edit_id').value = id;
            document.getElementById('editModal').style.display = 'flex';

            // Fetch Form
            fetch(`/approver/documents/get-item-html/${id}`)
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById('modal-form-body').innerHTML = data.html;
                        // Re-initialize any listeners if needed
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
            const formData = new FormData(form);
            const payload = {};

            // Parse edit_item[ID][field] -> field
            for (let [key, value] of formData.entries()) {
                if (key.includes('[') && key.includes(']')) {
                    const parts = key.split('][');
                    if (parts.length > 1) {
                        let fieldName = parts[1].replace(']', '');
                        if (fieldName.includes('[]')) {
                            fieldName = fieldName.replace('[]', '');
                            if (!payload[fieldName]) payload[fieldName] = [];
                            payload[fieldName].push(value);
                        } else {
                            payload[fieldName] = value;
                        }
                    }
                }
            }
            payload['_token'] = "{{ csrf_token() }}";

            fetch(`/approver/documents/update-detail/${id}`, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': "{{ csrf_token() }}" },
                body: JSON.stringify(payload)
            })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire('Sukses', 'Data berhasil diupdate', 'success').then(() => location.reload());
                    } else {
                        Swal.fire('Error', data.message, 'error');
                    }
                })
                .catch(err => Swal.fire('Error', err.message, 'error'));
        }

        // --- 2. Unit Pengelola Actions ---
        function submitHeadAction(type) {
            // Inject Compliance Data
            const checklistJson = collectComplianceData();
            
            // Create Hidden Input if it doesn't exist
            const form = document.getElementById('headApproveForm');
            let input = form.querySelector('input[name="compliance_checklist"]');
            if (!input) {
                input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'compliance_checklist';
                form.appendChild(input);
            }
            input.value = checklistJson;

            const noteInput = form.querySelector('textarea[name="catatan"]');
            const noteValue = noteInput ? noteInput.value.trim() : '';

            // Inject SHE Statuses for Validation
            const sheStatuses = {
                'K3': '{{ $document->status_k3 }}',
                'KO': '{{ $document->status_ko }}',
                'Lingkungan': '{{ $document->status_lingkungan }}',
                'isSHE': {{ Auth::user()->id_unit == 56 ? 'true' : 'false' }}
            };
            
            // Get Active Categories from DOM
            const params = new URLSearchParams();
            // We need to know which categories are actually present in the document.
            // We can infer this from the rendered table rows data-category
            const rows = document.querySelectorAll('tr[data-category]');
            const presentCats = new Set();
            rows.forEach(r => presentCats.add(r.getAttribute('data-category')));

            if (type === 'approve') {
                if (sheStatuses.isSHE) {
                    // Consolidated Validation
                    const pending = [];
                    if (presentCats.has('K3') && sheStatuses.K3 !== 'verified') pending.push('K3');
                    if (presentCats.has('KO') && sheStatuses.KO !== 'verified') pending.push('Keamanan Operasional');
                    if (presentCats.has('Lingkungan') && sheStatuses.Lingkungan !== 'verified') pending.push('Lingkungan');
                    
                    if (pending.length > 0) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Belum Siap Approve',
                            html: `Kategori berikut belum diverifikasi oleh staff:<br><b>${pending.join(', ')}</b><br><br>Silakan tunggu verifikasi selesai.`,
                            confirmButtonColor: '#dc2626'
                        });
                        return;
                    }
                }
            }

            if (type === 'revise') {
                if (noteValue.length < 5) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Catatan Wajib',
                        text: 'Mohon isi catatan revisi minimal 5 karakter pada kolom komentar dibawah.',
                        confirmButtonColor: '#3b82f6'
                    });
                    return;
                }

                form.action = "{{ route('unit_pengelola.revise', $document->id) }}";
                
                Swal.fire({
                    title: 'Kirim Revisi?',
                    text: 'Dokumen akan dikembalikan ke staff.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Revisi',
                    cancelButtonText: 'Batal',
                    confirmButtonColor: '#dc2626'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            } else {
                // Approve - REQUIRE COMMENT
                if (noteValue.length < 5) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Komentar Wajib Diisi',
                        text: 'Mohon isi komentar minimal 5 karakter sebelum melakukan approve.',
                        confirmButtonColor: '#f59e0b'
                    });
                    return;
                }
                
                Swal.fire({
                    title: 'Approve Dokumen?',
                    text: "Dokumen akan dipublikasikan/diteruskan.",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Approve',
                    cancelButtonText: 'Batal',
                    confirmButtonColor: '#16a34a'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            }
        }

        // collectComplianceData moved to bottom with new logic

        function submitStaffAction(target = 'default') {
            // Validation: Ensure all Compliance Checklist items are filled
            // ONLY if target is 'head' or 'reviewer' (meaning Verification is done)
            // If target is 'verifier', Reviewer might not fill it? 
            // WAIT: Reviewer DOES NOT fill checklist. Verifier fills it.
            // So Validation only needed for Verifier (target='reviewer') 
            // OR Reviewer (Stage 2 -> target='head') if they edit it?
            
            // Actually, Verifier fills it. So validation needed when Verifier submits.
            // When Reviewer submits to Verifier (Stage 1), checklist is empty/disabled.
            
            if (target === 'reviewer' || target === 'head') {
                 const selects = document.querySelectorAll('select[name^="compliance_checklist"]');
                 let allFilled = true;
                 
                 selects.forEach(select => {
                     if (select.value === "") {
                         allFilled = false;
                         select.style.border = "1px solid red";
                     } else {
                         select.style.border = ""; 
                     }
                 });
    
                 if (!allFilled) {
                     Swal.fire({
                         icon: 'warning',
                         title: 'Checklist Belum Lengkap',
                         text: 'Mohon lengkapi semua poin pada Tabel Kesesuaian (Compliance Checklist) sebelum melanjutkan.',
                         confirmButtonColor: '#f59e0b'
                     });
                     document.querySelector('.doc-card').scrollIntoView({ behavior: 'smooth' });
                     return;
                 }
            }

            // Inject Compliance Data
            const checklistJson = collectComplianceData();
            document.getElementById('compliance_checklist_input').value = checklistJson;

            const form = document.getElementById('staffActionForm');
            
            let title = 'Submit?';
            let text = 'Pastikan data sudah benar.';
            
            if (target === 'verifier') {
                title = 'Kirim ke Verifikator?';
                text = 'Dokumen akan diteruskan ke Staff Verifikator untuk pengecekan checklist.';
            } else if (target === 'reviewer') {
                title = 'Kirim ke Reviewer?';
                text = 'Berhasil dikirim ke Staff Reviewer.'; // Using phrasing from user request
            } else if (target === 'head') {
                title = 'Kirim ke Kepala Unit?';
                text = 'Review selesai. Dokumen akan diteruskan ke Kepala Unit untuk keputusan akhir.';
            }

            Swal.fire({
                title: title,
                text: text,
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya, Kirim',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        }

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
                badge.textContent = level;
            }
        }

        @php
            // Calculate Global Edit Permission for JS Logic
            $isPendingDisposition = ($isHead && $status == 'pending_head');
            $isFinalDecision = ($isHead && in_array($status, ['staff_verified', 'returned_to_head']));
            $isApprovedOrPublished = in_array($status, ['approved', 'published', 'level3_approved']);
            
            $headCanEditCompliance = ($isHead && $myTrackIsActive && !$isPendingDisposition && !$isFinalDecision && !$isApprovedOrPublished);
            // PING-PONG FIX FOR JS LOGIC AS WELL
            $isSheStage2JS = false;
            // PHP context available here
            if ($isSheUnit && $isReviewer) {
                 $isSheStage2JS = in_array($document->status_k3, ['awaiting_final_review', 'verified']) ||
                                  in_array($document->status_ko, ['awaiting_final_review', 'verified']) ||
                                  in_array($document->status_lingkungan, ['awaiting_final_review', 'verified']);
            }

            $staffCanEditCompliance = ($isApprover && in_array($status, ['assigned_approval', 'process_verification'])) || 
                                      ($isReviewer && ($status == 'staff_verified' || $isSheStage2JS));
            
            $globalComplianceEdit = ($headCanEditCompliance || $staffCanEditCompliance);
        @endphp

        let isComplianceEditing = {{ $globalComplianceEdit ? 'true' : 'false' }};

        function toggleComplianceEdit() {
            isComplianceEditing = !isComplianceEditing;
            
            const dropDowns = document.querySelectorAll('.compliance-status');
            dropDowns.forEach(el => {
                // Toggle Dropdown
                if (isComplianceEditing) el.removeAttribute('disabled');
                else el.setAttribute('disabled', 'disabled');

                // Trigger Note Field Update based on current value
                const id = el.id;
                if(id && id.startsWith('status_')) {
                    const key = id.replace('status_', '');
                    toggleNoteField(key);
                }
            });

            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: isComplianceEditing ? 'info' : 'warning',
                title: isComplianceEditing ? 'Mode Edit Aktif' : 'Mode Edit Non-Aktif',
                showConfirmButton: false,
                timer: 1500
            });
        }

        function toggleNoteField(key) {
            const statusSelect = document.getElementById('status_' + key);
            const noteInput = document.getElementById('note_' + key);
            
            if (!statusSelect || !noteInput) return;

            // 1. If Global Edit Mode is OFF -> ALWAYS DISABLE
            if (!isComplianceEditing) {
                noteInput.setAttribute('disabled', 'disabled');
                noteInput.style.background = '#f1f5f9';
                noteInput.style.cursor = 'not-allowed';
                return;
            }

            // 2. If Global Edit Mode is ON -> Check Dropdown Value
            const val = statusSelect.value;
            if (val === 'NOK' || val === 'Tdk Penting') {
                noteInput.removeAttribute('disabled');
                noteInput.style.background = 'white';
                noteInput.style.cursor = 'text';
            } else {
                noteInput.setAttribute('disabled', 'disabled');
                noteInput.style.background = '#f1f5f9';
                noteInput.style.cursor = 'not-allowed';
                noteInput.value = ''; // Auto clear when OK/Empty
            }
        }
    </script>


    <style>
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-label {
            display: block;
            font-weight: 600;
            margin-bottom: 8px;
            color: #374151;
            font-size: 14px;
        }
        
        .form-input, .form-textarea, .form-select {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            font-size: 14px;
            font-family: inherit;
        }
        
        .form-input:focus, .form-textarea:focus, .form-select:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }
        
        .form-textarea {
            min-height: 100px;
            resize: vertical;
        }
    </style>



    <!-- Professional Edit Modal (Based on Approver View) -->
    <div id="editUnitModal" class="modal" style="display: none; position: fixed; z-index: 9999; left: 0; top: 0; width: 100%; height: 100%; overflow: auto; background-color: rgba(0,0,0,0.5);">
        <div class="modal-content" style="background-color: #fefefe; margin: 5vh auto; padding: 0; border: 1px solid #888; width: 80%; max-width: 900px; border-radius: 12px; position: relative;">
            <div class="modal-header" style="padding: 20px 30px; border-bottom: 1px solid #e2e8f0; display: flex; justify-content: space-between; align-items: center;">
                <h2 style="margin: 0; font-size: 18px; color: #1e293b;">Edit Detail Item</h2>
                <span class="close" onclick="closeModal()" style="color: #aaa; float: right; font-size: 28px; font-weight: bold; cursor: pointer;">&times;</span>
            </div>
            <form id="editUnitForm">
            <div class="modal-body" id="editUnitModalBody" style="padding: 30px; max-height: 70vh; overflow-y: auto;">
                <div style="text-align: center; padding: 40px;">
                    <i class="fas fa-spinner fa-spin" style="font-size: 30px; color: #c41e3a;"></i>
                    <p style="margin-top: 15px; color: #64748b;">Memuat data...</p>
                </div>
            </div>
            <div class="modal-footer" style="padding: 20px 30px; border-top: 1px solid #e2e8f0; text-align: right; background: #f8fafc; border-bottom-left-radius: 12px; border-bottom-right-radius: 12px;">
                <button type="button" onclick="closeModal()" style="padding: 10px 20px; background: white; border: 1px solid #cbd5e1; border-radius: 6px; cursor: pointer; font-weight: 600; color: #475569; margin-right: 10px;">Batal</button>
                <button type="button" onclick="saveItem()" style="padding: 10px 20px; background: #16a34a; border: none; border-radius: 6px; cursor: pointer; font-weight: 600; color: white;">
                    <i class="fas fa-save" style="margin-right: 8px;"></i> Simpan Perubahan
                </button>
            </div>
            </form>
        </div>
    </div>

    <script>
        function editItem(id) {
            console.log('Opening Edit Modal for Item:', id);
            const modal = document.getElementById('editUnitModal');
            const modalBody = document.getElementById('editUnitModalBody');
            
            if (!modal || !modalBody) {
                console.error('Modal elements not found!', modal, modalBody);
                alert('Error: Modal element not found in DOM');
                return;
            }

            modal.style.display = "block";
            modalBody.innerHTML = `
                <div style="text-align: center; padding: 40px;">
                    <i class="fas fa-spinner fa-spin" style="font-size: 30px; color: #c41e3a;"></i>
                    <p style="margin-top: 15px; color: #64748b;">Memuat data... (ID: ${id})</p>
                </div>
            `;

            const url = `/unit-pengelola/documents/get-item-html/${id}`;
            console.log('Fetching:', url);

            fetch(url)
                .then(response => {
                    console.log('Response Status:', response.status);
                    if (!response.ok) {
                        return response.text().then(text => {
                            throw new Error(`Server Error: ${response.status} - ${text.substring(0, 100)}...`);
                        });
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Data Received:', data);
                    if (data.success) {
                        modalBody.innerHTML = data.html;
                        
                        // Re-initialize scripts if needed (e.g. auto-grow)
                        // Note: inline onchange functions work globally, so no re-init needed for them.
                    } else {
                        modalBody.innerHTML = `<div class="alert alert-warning">${data.message}</div>`;
                        Swal.fire('Gagal Memuat', data.message, 'warning');
                    }
                })
                .catch(error => {
                    console.error('Fetch Error:', error);
                    modalBody.innerHTML = `<div class="alert alert-danger" style="color:red; text-align:center;">
                        <strong>Terjadi Kesalahan!</strong><br>
                        ${error.message}
                    </div>`;
                    Swal.fire({
                        icon: 'error',
                        title: 'Error Loading Form',
                        text: error.message,
                        footer: 'Silakan Refresh (Ctrl+F5) atau Hubungi Admin'
                    });
                });
        }

        function closeModal() {
            const modal = document.getElementById('editUnitModal');
            if(modal) modal.style.display = "none";
        }

        window.onclick = function(event) {
            const modal = document.getElementById('editUnitModal');
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }

        function saveItem() {
            const form = document.getElementById('editUnitForm');
            if(!form) return;
            
            const formData = new FormData(form);
            const payload = {};
            let itemId = null;

            for (const [key, value] of formData.entries()) {
                const match = key.match(/edit_item\[(\d+)\]\[(.*?)\]/);
                if (match) {
                    if (!itemId) itemId = match[1];
                    const fieldName = match[2];
                    
                    if (fieldName.endsWith('[]')) {
                        const realName = fieldName.slice(0, -2);
                        if (!payload[realName]) payload[realName] = [];
                        payload[realName].push(value);
                    } else {
                        payload[fieldName] = value;
                    }
                }
            }

            if (!itemId) {
                // Try alternate parsing if prefix is missing
                 for (const [key, value] of formData.entries()) {
                     if(!key.includes('[')) payload[key] = value;
                 }
                 // If ID still missing, maybe grab from button attr?
                 // Let's assume fetch url ID matches.
                 // We need to pass the ID to the save function from the onclick logic
                 // But let's trust the form for now.
            }

            // Fallback: If we can't get ID from form names, drag it from the form action or data attribute?
            // Since we don't have that easily, let's ensure we used the right ID. 
            // In getEditItemHtml, we set prefix edit_item.
            
            if (!itemId) {
                // Try getting it from the `editItem` call context? No.
                // Hack: Grab it from the first hidden input ID?
                // The form usually has <input type="hidden" name="detail_id" value="..."> if standard.
                // But HIRADC component relies on prefix names structure.
                // Let's look for a key like edit_item[123]...
                const keys = Array.from(formData.keys()); 
                const firstKey = keys.find(k => k.startsWith('edit_item['));
                if(firstKey) {
                    const m = firstKey.match(/edit_item\[(\d+)\]/);
                    if(m) itemId = m[1];
                }
            }

            if (!itemId) {
                Swal.fire('Error', 'ID Item tidak ditemukan', 'error');
                return;
            }

            fetch(`/unit-pengelola/documents/update-detail/${itemId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify(payload)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Data berhasil diperbarui',
                        timer: 1500,
                        showConfirmButton: false
                    }).then(() => {
                        location.reload();
                    });
                    closeModal();
                } else {
                    Swal.fire('Gagal', data.message || 'Gagal menyimpan perubahan', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire('Error', 'Terjadi kesalahan sistem', 'error');
            });
        }

        // TAB FUNCTION
        function openTab(evt, tabName) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tab-content");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
                tabcontent[i].classList.remove("active");
            }
            tablinks = document.getElementsByClassName("tab-btn");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            document.getElementById(tabName).style.display = "block";
            document.getElementById(tabName).classList.add("active");
            evt.currentTarget.className += " active";
        }
        // Initialize SweetAlert for Session Messages
        document.addEventListener('DOMContentLoaded', function() {
            @if ($errors->any())
                Swal.fire({
                    icon: 'error',
                    title: 'Validasi Gagal',
                    html: `{!! implode('<br>', $errors->all()) !!}`,
                    confirmButtonColor: '#dc2626'
                });
            @endif

            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: "{{ session('success') }}",
                    confirmButtonColor: '#16a34a',
                    timer: 2000,
                    showConfirmButton: false
                });
            @endif

            @if (session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Terjadi Kesalahan',
                    text: "{{ session('error') }}",
                    confirmButtonColor: '#dc2626'
                });
            @endif
        });

        // --- COMPLIANCE CHECKLIST LOGIC ---
        
        // Initialize Data from Server
        let checklistData = { K3: {}, KO: {}, Lingkungan: {}, Keamanan: {} };
        const serverData = @json($document->compliance_checklist_she ?? []);
        
        // Category Statuses for Visibility Check
        const categoryStatuses = {
            'K3': '{{ $document->status_k3 }}',
            'KO': '{{ $document->status_ko }}',
            'Lingkungan': '{{ $document->status_lingkungan }}',
            'Keamanan': '{{ $document->status_security }}'
        };
        const userRole = {
            isHead: {{ isset($isHead) && $isHead ? 'true' : 'false' }},
            isReviewer: {{ isset($isReviewer) && $isReviewer ? 'true' : 'false' }},
            isVerifier: {{ isset($isApprover) && $isApprover ? 'true' : 'false' }}
        };

        // Migration: If server data matches the new structure (has keys K3/KO...), use it.
        // If it's flat (legacy), map it to all active categories to preserve data.
        if (serverData && (serverData.K3 || serverData.KO || serverData.Lingkungan || serverData.Keamanan)) {
            checklistData = { ...checklistData, ...serverData };
        } else if (serverData && Object.keys(serverData).length > 0) {
            // Legacy Flat Data - Distribute to Categories that exist in this document
            // We can infer categories from DOM or just assign to all
            checklistData.K3 = JSON.parse(JSON.stringify(serverData));
            checklistData.KO = JSON.parse(JSON.stringify(serverData));
            checklistData.Lingkungan = JSON.parse(JSON.stringify(serverData));
            checklistData.Keamanan = JSON.parse(JSON.stringify(serverData));
        }

        let currentActiveCategory = 'all';

        function filterSheCategory(cat, btn) {
            // 1. Save current form state to memory before switching
            if (currentActiveCategory !== 'all') {
                saveChecklistToMemory(currentActiveCategory);
            }

            // 2. Update Tab Buttons
            document.querySelectorAll('.sub-tab-btn').forEach(b => {
                b.style.background = 'white';
                b.style.fontWeight = 'normal';
                b.classList.remove('active');
            });
            if(btn) {
                btn.style.background = '#e2e8f0';
                btn.style.fontWeight = '600';
                btn.classList.add('active');
            }

            // 3. Filter Table Rows
            const rows = document.querySelectorAll('tr[data-category]');
            rows.forEach(row => {
                if (cat === 'all') {
                    row.style.display = 'table-row';
                } else {
                    const rowCat = row.getAttribute('data-category');
                    if (rowCat === cat) {
                        row.style.display = 'table-row';
                    } else {
                        row.style.display = 'none';
                    }
                }
            });

            // 4. Handle Compliance Checklist Visibility & Data
            const checklistContainer = document.getElementById('compliance-checklist-container');
            if (checklistContainer) {
                if (cat === 'all') {
                     checklistContainer.style.display = 'none';
                } else {
                     // Check Visibility based on Role and Status
                     let shouldShow = false;
                     const status = categoryStatuses[cat];

                     if (userRole.isHead) {
                         // Head: Only show if Verified (Staff Done)
                         // OR if it's already approved/published
                         if (status === 'verified' || status === 'process_approval' || status === 'approved' || status === 'published') {
                             shouldShow = true;
                         }
                     } else if (userRole.isVerifier) {
                         // Verifier: Show if active (assigned/process)
                         if (status === 'assigned_approval' || status === 'process_verification') {
                             shouldShow = true;
                         }
                     } else if (userRole.isReviewer) {
                         // Reviewer: Show if Stage 2 (returned)
                         if (status === 'awaiting_final_review' || status === 'verified') {
                             shouldShow = true;
                         }
                     }

                     if (shouldShow) {
                         checklistContainer.style.display = 'block';
                         populateChecklistForm(cat);
                     } else {
                         checklistContainer.style.display = 'none';
                     }
                }
            }
            
            currentActiveCategory = cat;
        }
        
        function populateChecklistForm(cat) {
            // Clear or Set values based on checklistData[cat]
            const data = checklistData[cat] || {};
            
            // Iterate all checklist rows (assumes specific IDs or predictable names)
            // The select names are compliance_checklist[KEY][status]
            // We need to iterate the DOM elements
            document.querySelectorAll('select[name^="compliance_checklist"]').forEach(select => {
                // Extract Key
                const name = select.getAttribute('name');
                const match = name.match(/\[(.*?)\]\[status\]/);
                if (match) {
                    const key = match[1];
                    const val = (data[key] && data[key].status) ? data[key].status : '';
                    select.value = val;
                    
                    // Trigger change to update UI (colors, notes enablement)
                    toggleNoteField(key); 
                }
            });

            document.querySelectorAll('input[name^="compliance_checklist"]').forEach(input => {
                const name = input.getAttribute('name');
                const match = name.match(/\[(.*?)\]\[note\]/);
                if (match) {
                    const key = match[1];
                    const val = (data[key] && data[key].note) ? data[key].note : '';
                    input.value = val;
                }
            });
        }

        function saveChecklistToMemory(cat) {
            if (!checklistData[cat]) checklistData[cat] = {};
            
            document.querySelectorAll('select[name^="compliance_checklist"]').forEach(select => {
                const name = select.getAttribute('name');
                const match = name.match(/\[(.*?)\]\[status\]/);
                if (match) {
                    const key = match[1];
                    if (!checklistData[cat][key]) checklistData[cat][key] = {};
                    checklistData[cat][key]['status'] = select.value;
                }
            });

            document.querySelectorAll('input[name^="compliance_checklist"]').forEach(input => {
                const name = input.getAttribute('name');
                const match = name.match(/\[(.*?)\]\[note\]/);
                if (match) {
                    const key = match[1];
                    if (!checklistData[cat][key]) checklistData[cat][key] = {};
                    checklistData[cat][key]['note'] = input.value;
                }
            });
        }
        
        // Override collectComplianceData to return the FULL structure
        function collectComplianceData() {
            // Ensure current active tab is saved
            if (currentActiveCategory !== 'all') {
                saveChecklistToMemory(currentActiveCategory);
            }
            return JSON.stringify(checklistData);
        }

        // Initialize: If we start on 'all', hide checklist. 
        // If we start on specific cat (not implemented yet), show it.
        // Default is 'all', so checklist is hidden by default (style="display:none" added in PHP).
    </script>
</body>

</html>