<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>SFACARD</title>

    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/bootstrap-icons-1.13.1/bootstrap-icons.css') ?>" rel="stylesheet">

    <style>
        body {
            display: flex;
            min-height: 100vh;
            background: #f5f6fa;
        }

        /* SIDEBAR */
        .sidebar {
            width: 230px;
            background: #ffffff;
            padding: 20px;
            border-right: 1px solid #eee;
        }

        .sidebar .nav-link {
            color: #555;
            border-radius: 8px;
            margin-bottom: 5px;
        }

        .sidebar .nav-link:hover {
            background: #f1f1f1;
        }

        .sidebar .active {
            background: #6a5af9;
            color: white !important;
        }

        /* CONTENT */
        .content {
            flex: 1;
            padding: 20px;
        }

        .logo {
            font-weight: bold;
            font-size: 18px;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">

    <div class="logo">
        <i class="bi bi-box"></i> SFACARD
    </div>

    <ul class="nav flex-column">

        <li class="nav-item">
            <a class="nav-link active" href="<?= base_url('/') ?>">
                <i class="bi bi-house"></i> Dashboard
            </a>
        </li>

        <?php if (session()->get('role') == 'admin'): ?>
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('users') ?>">
                <i class="bi bi-people"></i> Users
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('pengaduan') ?>">
                <i class="bi bi-clipboard"></i> Aspirasi
            </a>
        </li>
        <?php endif; ?>

        <?php if (session()->get('role') != 'admin'): ?>
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('pengaduan') ?>">
                <i class="bi bi-chat-left-text"></i> Pengaduan
            </a>
        </li>
        <?php endif; ?>

        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('pengaduan/history') ?>">
                <i class="bi bi-clock-history"></i> History
            </a>
        </li>

        <?php $idu = session('id_user'); ?>
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('users/edit/' . $idu) ?>">
                <i class="bi bi-gear"></i> Setting
            </a>
        </li>

        <li class="nav-item mt-3">
            <a class="nav-link text-danger" href="<?= site_url('/logout') ?>">
                <i class="bi bi-box-arrow-right"></i> Logout
            </a>
        </li>

    </ul>

    <!-- USER -->
    <div class="mt-4 text-center">
        <img src="<?= base_url('uploads/users/' . session()->get('foto')) ?>"
             class="rounded-circle mb-2"
             width="60">
        <div><b><?= session('nama') ?></b></div>
        <small><?= session('role') ?></small>
    </div>

</div>

<!-- CONTENT -->
<div class="content">
    <?= $this->renderSection('content') ?>
</div>

</body>
</html>