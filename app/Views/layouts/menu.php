<div class="container-fluid navbar-custom">

    <div class="d-flex justify-content-between align-items-center flex-wrap">

        <!-- KIRI (LOGO + MENU) -->
        <div class="d-flex align-items-center flex-wrap">

            <!-- LOGO -->
            <span class="logo-text me-3">
                SFACARD <i class="bi bi-yelp"></i>
            </span>

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
                        <h4><i class="bi bi-bar-chart-line"></i> History Pengaduan</h4>
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
                        <a href="<?= base_url('/backup') ?>" class="btn btn-success">Backup Database</a>
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
                 width="50" height="50" 
                 class="user-img">

        </div>

    </div>

</div>