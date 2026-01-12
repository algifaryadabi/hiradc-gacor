<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Master - Admin HIRADC</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: #f4f6f9;
            margin: 0;
            display: flex;
        }

        .sidebar {
            width: 250px;
            background: white;
            height: 100vh;
            position: fixed;
            border-right: 1px solid #e0e0e0;
            display: flex;
            flex-direction: column;
        }

        .logo-section {
            padding: 25px;
            text-align: center;
            border-bottom: 1px solid #eee;
        }

        .logo-section img {
            width: 50px;
            margin-bottom: 10px;
        }

        .nav-menu {
            padding: 20px 0;
            flex: 1;
        }

        .nav-item {
            display: flex;
            align-items: center;
            padding: 12px 25px;
            color: #555;
            text-decoration: none;
            font-weight: 500;
            transition: 0.3s;
        }

        .nav-item i {
            width: 25px;
            text-align: center;
            margin-right: 10px;
        }

        .nav-item:hover,
        .nav-item.active {
            background: #fee2e2;
            color: #c41e3a;
            border-left: 4px solid #c41e3a;
        }

        .main-content {
            margin-left: 250px;
            flex: 1;
            padding: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            flex-direction: column;
        }

        .placeholder-icon {
            font-size: 64px;
            color: #ddd;
            margin-bottom: 20px;
        }

        h1 {
            color: #888;
            font-weight: 500;
            margin: 0;
        }
    </style>
</head>

<body>

    <aside class="sidebar">
        <div class="logo-section">
            <img src="{{ asset('images/logo-semen-padang.png') }}" alt="Logo">
            <div style="font-weight: 700; color: #c41e3a;">PT Semen Padang</div>
            <div style="font-size: 12px; color: #888;">Admin System</div>
        </div>
        <nav class="nav-menu">
            <a href="{{ route('admin.dashboard') }}" class="nav-item">
                <i class="fas fa-th-large"></i> Dashboard
            </a>
            <a href="{{ route('admin.users') }}" class="nav-item">
                <i class="fas fa-users"></i> Manajemen User
            </a>
            <a href="{{ route('admin.master') }}" class="nav-item active">
                <i class="fas fa-database"></i> Data Master
            </a>
        </nav>
    </aside>

    <main class="main-content">
        <i class="fas fa-database placeholder-icon"></i>
        <h1>Halaman Data Master (Coming Soon)</h1>
    </main>

</body>

</html>