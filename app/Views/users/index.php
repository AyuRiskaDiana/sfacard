<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-4">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold">
            <i class="bi bi-people-fill text-primary"></i> Data Users
        </h4>

        <?php if(session()->get('role') == 'admin'): ?>
            <a href="<?= base_url('users/create') ?>" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Tambah User
            </a>
        <?php endif; ?>
    </div>

    <!-- ALERT -->
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success shadow-sm">
            <i class="bi bi-check-circle"></i>
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <!-- CARD TABLE -->
    <div class="card shadow border-0 rounded-4">
        <div class="card-body p-0">

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0 text-center">

                    <thead class="table-primary">
                        <tr>
                            <th width="50">No</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Role</th>
                            <th>Foto</th>

                            <?php if (session()->get('role') == 'admin') : ?>
                                <th width="180">Aksi</th>
                            <?php endif; ?>
                        </tr>
                    </thead>

                    <tbody>
                    <?php if (!empty($users)): ?>
                        <?php $no = 1; foreach ($users as $u): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td class="fw-semibold"><?= $u['nama'] ?></td>
                                <td><?= $u['username'] ?></td>

                                <td>
                                    <span class="badge bg-<?= $u['role'] == 'admin' ? 'danger' : ($u['role'] == 'guru' ? 'warning text-dark' : 'success') ?>">
                                        <?= ucfirst($u['role']) ?>
                                    </span>
                                </td>

                                <td>
                                    <?php if (!empty($u['foto'])): ?>
                                        <img src="<?= base_url('uploads/users/' . $u['foto']) ?>" 
                                             width="50" height="50"
                                             class="rounded-circle border">
                                    <?php else: ?>
                                        <span class="text-muted">-</span>
                                    <?php endif; ?>
                                </td>

                                <?php if (session()->get('role') == 'admin') : ?>
                                <td>
                                   <a href="<?= base_url('users/edit/' . $u['id_user']) ?>" 
   class="btn btn-warning me-1">
    <i class="bi bi-pencil"></i> 
</a>

<a href="<?= base_url('users/delete/' . $u['id_user']) ?>" 
   class="btn btn-danger"
   onclick="return confirm('Hapus user ini?')">
    <i class="bi bi-trash"></i> 
</a>
                                </td>
                                <?php endif; ?>

                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-muted p-3">
                                <i class="bi bi-info-circle"></i> Belum ada data user
                            </td>
                        </tr>
                    <?php endif; ?>
                    </tbody>

                </table>
            </div>

        </div>
    </div>

</div>

<?= $this->endSection() ?>