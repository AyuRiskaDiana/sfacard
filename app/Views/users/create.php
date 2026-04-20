<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Tambah User</title>

    <!-- Bootstrap Lokal -->
    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/bootstrap-icons-1.13.1/bootstrap-icons.css') ?>" rel="stylesheet">
</head>

<body style="background: linear-gradient(135deg,#eef2ff,#f8f9ff); min-height:100vh;">

<div class="container mt-5">

    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card shadow border-0 rounded-4">

                <!-- HEADER -->
                <div class="card-header text-white rounded-top-4"
                     style="background: linear-gradient(135deg,#6a5af9,#3b82f6);">
                    <h5 class="mb-0">
                        <i class="bi bi-person-plus-fill"></i> Tambah User
                    </h5>
                </div>

                <div class="card-body">

                    <!-- ALERT -->
                    <?php if (session()->getFlashdata('error')): ?>
                        <div class="alert alert-danger shadow-sm">
                            <i class="bi bi-exclamation-circle"></i>
                            <?= session()->getFlashdata('error') ?>
                        </div>
                    <?php endif; ?>

                    <form action="<?= base_url('users/store') ?>" method="post" enctype="multipart/form-data">

                        <!-- NAMA -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nama Lengkap</label>
                            <input type="text" name="nama" class="form-control shadow-sm" required>
                        </div>

                        <!-- USERNAME -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Username</label>
                            <input type="text" name="username" class="form-control shadow-sm" required>
                        </div>

                        <!-- PASSWORD -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Password</label>
                            <input type="password" name="password" class="form-control shadow-sm" required>
                        </div>

                        <!-- ROLE -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Role</label>
                            <select name="role" class="form-select shadow-sm" required>

                                <option value="">-- Pilih Role --</option>

                                <option value="admin"
                                    <?= session()->get('role') != 'admin' ? 'disabled' : '' ?>>
                                    Admin
                                </option>

                                <option value="guru">Guru</option>
                                <option value="siswa">Siswa</option>

                            </select>
                        </div>

                        <!-- FOTO -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Foto Profil</label>
                            <input type="file" name="foto" class="form-control shadow-sm" accept="image/*">
                            <small class="text-muted">Kosongkan jika tidak upload foto</small>
                        </div>

                        <!-- BUTTON -->
                        <div class="d-flex justify-content-between">

                            <a href="<?= base_url('login') ?>" 
                               class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-left"></i> Kembali
                            </a>

                            <button type="submit" 
                                    class="btn text-white"
                                    style="background: linear-gradient(135deg,#6a5af9,#3b82f6);">
                                <i class="bi bi-save-fill"></i> Simpan
                            </button>

                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>

</div>

<script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
</body>
</html>