<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-4">

    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card shadow border-0 rounded-4">

                <!-- HEADER (GRADIENT) -->
                <div class="card-header text-white rounded-top-4"
                     style="background: linear-gradient(135deg,#6a5af9,#3b82f6);">
                    <h5 class="mb-0">
                        <i class="bi bi-pencil-square"></i> Edit User
                    </h5>
                </div>

                <div class="card-body">

                    <form action="<?= base_url('users/update/' . $user['id_user']) ?>" method="post" enctype="multipart/form-data">

                        <!-- NAMA -->
                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" name="nama" value="<?= $user['nama'] ?>" class="form-control" required>
                        </div>

                        <!-- USERNAME -->
                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" name="username" value="<?= $user['username'] ?>" class="form-control" required>
                        </div>

                        <!-- PASSWORD -->
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control">
                            <small class="text-muted">Kosongkan jika tidak diubah</small>
                        </div>

                        <!-- FOTO -->
                        <div class="mb-3">
                            <label class="form-label">Foto Profil</label>
                            <input type="file" name="foto" class="form-control">

                            <div class="mt-2">
                                <small>Foto sekarang:</small><br>

                                <?php if (!empty($user['foto'])): ?>
                                    <img src="<?= base_url('uploads/users/' . $user['foto']) ?>" 
                                         width="80" 
                                         class="rounded-circle border shadow-sm">
                                <?php else: ?>
                                    <span class="text-muted">-</span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- BUTTON -->
                        <div class="d-flex justify-content-between">
                            <a href="<?= base_url('users') ?>" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-left"></i> Kembali
                            </a>

                            <button type="submit" class="btn text-white"
                                style="background: linear-gradient(135deg,#6a5af9,#3b82f6); border:none;">
                                <i class="bi bi-save"></i> Update
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>

</div>

<?= $this->endSection() ?>