<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-4">

    <div class="card shadow border-0 rounded-4">

        <!-- HEADER -->
        <div class="card-header text-white rounded-top-4"
             style="background: linear-gradient(135deg,#6a5af9,#3b82f6);">
            <h5 class="mb-0">
                <i class="bi bi-clipboard-data"></i> Status Laporan Aspirasi
            </h5>
        </div>

        <div class="card-body">

            <!-- ALERT -->
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success shadow-sm">
                    <i class="bi bi-check-circle"></i>
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>

            <!-- TABLE -->
            <div class="table-responsive">
                <table class="table table-hover align-middle text-center mb-0">

                    <thead style="background:#eef2ff;">
                        <tr>
                            <th>Nama</th>
                            <th>Tanggal</th>
                            <th>Judul</th>
                            <th>Lokasi</th>
                            <th>Kategori</th>
                            <th>Foto</th>
                            <th>Status</th>
                            <th>Feedback</th>

                            <?php if (session()->get('role') == 'admin') : ?>
                                <th>Aksi</th>
                            <?php endif; ?>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($pengaduan as $p): ?>
                            <tr>

                                <td class="fw-semibold"><?= $p['nama'] ?? '-' ?></td>
                                <td><?= $p['tanggal'] ?></td>
                                <td><?= $p['judul'] ?></td>
                                <td><?= $p['lokasi'] ?></td>

                                <td>
                                    <span class="badge bg-light text-dark border">
                                        <?= $p['kategori'] ?? '-' ?>
                                    </span>
                                </td>

                                <!-- FOTO -->
                                <td>
                                    <?php if (!empty($p['foto'])): ?>
                                        <img src="<?= base_url('uploads/' . $p['foto']) ?>" 
                                             width="60" height="60"
                                             class="rounded shadow-sm">
                                    <?php else: ?>
                                        <span class="text-muted">-</span>
                                    <?php endif; ?>
                                </td>

                                <!-- STATUS -->
                                <td>
                                    <span class="badge 
                                        <?= $p['status'] == 'selesai' ? 'bg-success' : 
                                            ($p['status'] == 'diproses' ? 'bg-warning text-dark' : 'bg-secondary') ?>">
                                        <?= ucfirst($p['status']) ?>
                                    </span>
                                </td>

                                <!-- FEEDBACK -->
                                <td>
                                    <?= $p['isi_feedback'] ?? '<span class="text-muted">Belum ada</span>' ?>
                                </td>

                                <!-- AKSI -->
                                <?php if (session()->get('role') == 'admin'): ?>
                                <td>
                                    <div class="d-flex justify-content-center gap-2">

                                        <!-- EDIT -->
                                        <a href="<?= base_url('pengaduan/edit/' . $p['id_pengaduan']) ?>" 
                                           class="btn btn-warning text-white px-3"
                                           title="Edit">
                                            <i class="bi bi-pencil-fill"></i>
                                        </a>

                                        <!-- HAPUS -->
                                        <a href="<?= base_url('pengaduan/delete/' . $p['id_pengaduan']) ?>" 
                                           class="btn btn-danger px-3"
                                           onclick="return confirm('Yakin hapus data?')"
                                           title="Hapus">
                                            <i class="bi bi-trash-fill"></i>
                                        </a>

                                        <!-- FEEDBACK -->
                                        <a href="<?= base_url('pengaduan/feedback/' . $p['id_pengaduan']) ?>" 
                                           class="btn text-white px-3"
                                           style="background: linear-gradient(135deg,#6a5af9,#3b82f6);">
                                            <i class="bi bi-chat-dots-fill"></i>
                                        </a>

                                    </div>
                                </td>
                                <?php endif; ?>

                            </tr>
                        <?php endforeach; ?>
                    </tbody>

                </table>
            </div>

        </div>
    </div>

</div>

<!-- BUTTON BACK -->
<div class="container mt-3">
    <a href="<?= base_url('dashboard') ?>" 
       class="btn text-white"
       style="background: linear-gradient(135deg,#6a5af9,#3b82f6);">
        <i class="bi bi-arrow-left"></i> Kembali ke Dashboard
    </a>
</div>

<?= $this->endSection() ?>