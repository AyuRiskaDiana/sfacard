<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-4">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="fw-bold">
            <i class="bi bi-clipboard-data text-primary"></i> Laporan Aspirasi
        </h4>

        <div class="d-flex gap-2">
            <?php if (!empty($pengaduan)): ?>
                <a href="<?= base_url('pengaduan/print?' . http_build_query(array_filter(service('request')->getGet()))) ?>"
                    target="_blank"
                    class="btn btn-success">
                    <i class="bi bi-printer"></i> Print
                </a>
            <?php endif; ?>

            <?php if (session()->get('role') != 'user'): ?>
                <a href="<?= base_url('pengaduan/create') ?>" class="btn btn-primary">
                    <i class="bi bi-plus-circle"></i> Pengaduan
                </a>
            <?php endif; ?>
        </div>
    </div>

    <!-- ALERT -->
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success">
            <i class="bi bi-check-circle"></i>
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <!-- FILTER ADMIN -->
    <?php if (session()->get('role') == 'admin'): ?>
        <div class="card mb-3 shadow-sm">
            <div class="card-body">
                <form method="get" action="<?= base_url('pengaduan') ?>" class="row g-2">

                    <div class="col-md-2">
                        <input type="date" name="tanggal" class="form-control">
                    </div>

                    <div class="col-md-2">
                        <input type="month" name="bulan" class="form-control">
                    </div>

                    <div class="col-md-2">
                        <input type="text" name="id_user" class="form-control" placeholder="Nama User">
                    </div>

                    <div class="col-md-3">
                        <select name="id_aspirasi" class="form-control">
                            <option value="">Semua Kategori</option>
                            <?php foreach ($aspirasi as $a): ?>
                                <option value="<?= $a['id_aspirasi'] ?>">
                                    <?= $a['kategori'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="col-md-2">
                        <button type="submit"
                            class="btn w-100 text-white"
                            style="background: linear-gradient(135deg,#6a5af9,#3b82f6); border:none;">
                            <i class="bi bi-search"></i> Cari
                        </button>
                    </div>

                </form>
            </div>
        </div>
    <?php endif; ?>

    <!-- TABLE -->
    <div class="card shadow rounded-4">
        <div class="card-body p-0">

            <div class="table-responsive">
                <table class="table table-hover align-middle text-center mb-0">

                    <thead class="table-primary">
                        <tr>
                            <th>Nama</th>
                            <th>Tanggal</th>
                            <th>Judul</th>
                            <th>Lokasi</th>
                            <th>Kategori</th>
                            <th>Foto</th>
                            <th>Status</th>
                            <th>Feedback</th>

                            <?php if (session()->get('role') == 'admin'): ?>
                                <th width="220">Aksi</th>
                            <?php endif; ?>
                        </tr>
                    </thead>

                    <tbody>

                        <?php if (!empty($pengaduan)): ?>
                            <?php foreach ($pengaduan as $p): ?>

                                <tr>

                                    <td><?= $p['nama'] ?? '-' ?></td>
                                    <td><?= $p['tanggal'] ?></td>
                                    <td class="fw-semibold"><?= $p['judul'] ?></td>
                                    <td><?= $p['lokasi'] ?></td>
                                    <td><?= $p['kategori'] ?? '-' ?></td>

                                    <!-- FOTO -->
                                    <td>
                                        <?php if (!empty($p['foto'])): ?>
                                            <img src="<?= base_url('uploads/' . $p['foto']) ?>"
                                                width="60"
                                                height="60"
                                                class="rounded border">
                                        <?php else: ?>
                                            <span class="text-muted">-</span>
                                        <?php endif; ?>
                                    </td>

                                    <!-- STATUS -->
                                    <td>
                                        <?php
                                        $statusClass = 'bg-warning text-dark';

                                        if ($p['status'] == 'selesai') {
                                            $statusClass = 'bg-success';
                                        } elseif ($p['status'] == 'diproses' || $p['status'] == 'proses') {
                                            $statusClass = 'bg-info';
                                        }
                                        ?>

                                        <span class="badge <?= $statusClass ?>">
                                            <?= ucfirst($p['status']) ?>
                                        </span>
                                    </td>

                                    <!-- FEEDBACK -->
                                    <td>
                                        <?= !empty($p['isi_feedback']) ? $p['isi_feedback'] : 'Belum ada feedback' ?>
                                    </td>

                                    <!-- AKSI ADMIN -->
                                    <?php if (session()->get('role') == 'admin'): ?>
                                        <td>
                                            <div class="d-flex justify-content-center gap-2">

                                                <!-- PROGRES -->
                                                <a href="<?= base_url('progres/create/' . $p['id_pengaduan']) ?>"
                                                    class="btn btn-primary btn-sm">
                                                    <i class="bi bi-plus"></i>
                                                </a>

                                                <!-- EDIT -->
                                                <a href="<?= base_url('pengaduan/edit/' . $p['id_pengaduan']) ?>"
                                                    class="btn btn-outline-warning border-2">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>

                                                <!-- DELETE -->
                                                <a href="<?= base_url('pengaduan/delete/' . $p['id_pengaduan']) ?>"
                                                    class="btn btn-outline-danger border-2"
                                                    onclick="return confirm('Yakin hapus data?')">
                                                    <i class="bi bi-trash-fill"></i>
                                                </a>

                                                <!-- FEEDBACK -->
                                                <a href="<?= base_url('pengaduan/feedback/' . $p['id_pengaduan']) ?>"
                                                    class="btn btn-info text-white">
                                                    <i class="bi bi-chat-left-text"></i>
                                                </a>

                                            </div>
                                        </td>
                                    <?php endif; ?>

                                </tr>

                            <?php endforeach; ?>

                        <?php else: ?>

                            <tr>
                                <td colspan="9" class="text-muted">
                                    <i class="bi bi-info-circle"></i> Belum ada data
                                </td>
                            </tr>

                        <?php endif; ?>

                    </tbody>

                </table>
            </div>

        </div>
    </div>

    <!-- BACK -->
    <div class="mt-3">
        <a href="<?= base_url('dashboard') ?>"
            class="btn text-white"
            style="background: linear-gradient(135deg,#6a5af9,#3b82f6);">
            <i class="bi bi-arrow-left"></i> Kembali ke Dashboard
        </a>
    </div>

</div>

<?= $this->endSection() ?>