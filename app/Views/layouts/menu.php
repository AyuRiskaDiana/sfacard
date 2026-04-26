<div class="container-fluid navbar-custom">

    <div class="d-flex justify-content-between align-items-center flex-wrap">

        <!-- KIRI (LOGO + MENU) -->
        <div class="d-flex align-items-center flex-wrap">

            <!-- LOGO + NAMA APLIKASI -->
            <div class="d-flex align-items-center me-4">

                <a href="<?= base_url('/') ?>" class="me-2">
                    <img src="<?= base_url('assets/img/S.png?v=' . time()) ?>" 
                         alt="Logo SFACARD" 
                         height="55">
                </a>

                <div>
                    <h5 class="mb-0 fw-bold text-white">
                        SIPENTRA
                    </h5>
                    <small class="text-light">
                        Sistem Pengaduan Aspirasi
                    </small>
                </div>

            </div>

            <!-- MENU -->
            <ul class="nav">

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
                        <i class="bi bi-clipboard-data"></i> Aspirasi
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
                    <a class="nav-link" href="<?= base_url('pengaduan/history/') ?>">
                        <i class="bi bi-bar-chart-line"></i> History Pengaduan
                    </a>
                </li>

                <?php $idu = session('id_user'); ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('users/edit/' . $idu) ?>">
                        <i class="bi bi-gear"></i> Setting
                    </a>
                </li>

                <?php if (session()->get('role') == 'admin') : ?>
                    <li class="nav-item">
                        <a href="<?= base_url('/backup') ?>" class="btn btn-success ms-2">
                            Backup Database
                        </a>
                    </li>
                <?php endif; ?>

                <li class="nav-item">
                    <a class="nav-link text-warning" href="<?= site_url('/logout') ?>">
                        <i class="bi bi-box-arrow-right"></i> Logout
                    </a>
                </li>

            </ul>
        </div>

        <!-- KANAN (USER INFO) -->
        <div class="d-flex align-items-center user-box mt-2 mt-md-0">

            <div class="me-2 text-end">
                <small>Masuk sebagai</small><br>
                <b><?= session('nama'); ?></b><br>
                <small>(<?= session('role'); ?>)</small>
            </div>

            <img src="<?= base_url('uploads/users/' . session()->get('foto')) ?>" 
                 width="50" 
                 height="50" 
                 class="user-img">

        </div>

    </div>

</div>