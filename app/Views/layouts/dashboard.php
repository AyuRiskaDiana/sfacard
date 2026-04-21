<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
    .dashboard-header {
        background: linear-gradient(135deg, #6a5af9, #3b82f6);
        color: white;
        border-radius: 15px;
        padding: 20px;
    }

    .card-custom {
        border-radius: 12px;
        border: none;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
    }

    .stat-card {
        background: rgba(255, 255, 255, 0.15);
        border-radius: 10px;
        padding: 15px;
        color: white;
    }

    .small-text {
        font-size: 12px;
        opacity: 0.8;
    }

    .notification-list {
        max-height: 350px;
        overflow-y: auto;
    }

    .notification-item-card {
        background: #e7f3ff;
        border-left: 4px solid #0066cc;
        padding: 10px;
        border-radius: 6px;
        font-size: 13px;
        margin-bottom: 8px;
    }
</style>

<!-- 🔥 FIX DI SINI -->
<div class="container-fluid mt-3 px-3">

    <!-- HEADER -->
    <div class="dashboard-header mb-4">
        <h4>Good morning, <?= session('nama') ?></h4>

        <p class="small-text">
            <?= session()->get('role') == 'admin'
                ? 'Ringkasan sistem hari ini'
                : 'Pantau status pengaduan kamu' ?>
        </p>

        <div class="row mt-3">

            <div class="col-md-3">
                <div class="stat-card">
                    <h6>Total Pengaduan</h6>
                    <h4><?= count($pengaduan ?? []) ?></h4>
                </div>
            </div>

            <div class="col-md-3">
                <div class="stat-card">
                    <h6>Diproses</h6>
                    <h4><?= $diproses ?? 0 ?></h4>
                </div>
            </div>

            <div class="col-md-3">
                <div class="stat-card">
                    <h6>Selesai</h6>
                    <h4><?= $selesai ?? 0 ?></h4>
                </div>
            </div>

            <?php if (session()->get('role') == 'admin'): ?>
            <div class="col-md-3">
                <div class="stat-card">
                    <h6>User</h6>
                    <h4><?= $total_user ?? 0 ?></h4>
                </div>
            </div>
            <?php endif; ?>

        </div>
    </div>

    <div class="row">

        <!-- LEFT -->
        <div class="col-md-8">
            <div class="card card-custom p-3">

                <h5>
                    <?= session()->get('role') == 'admin'
                        ? 'Data Pengaduan Terbaru'
                        : 'Pengaduan Terakhir Kamu' ?>
                </h5>

                <table class="table mt-3">
                    <thead>
                        <tr>
                            <?php if (session()->get('role') == 'admin'): ?>
                                <th>Nama</th>
                            <?php endif; ?>
                            <th>Judul</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>
                    <?php if (!empty($pengaduan)): ?>
                        <?php foreach (array_slice($pengaduan, 0, 5) as $p): ?>
                        <tr>

                            <?php if (session()->get('role') == 'admin'): ?>
                                <td><?= $p['nama'] ?? '-' ?></td>
                            <?php endif; ?>

                            <td><?= $p['judul'] ?></td>

                            <td>
                                <?php
                                $badge = 'bg-secondary';
                                if ($p['status'] == 'selesai') {
                                    $badge = 'bg-success';
                                } elseif ($p['status'] == 'diproses') {
                                    $badge = 'bg-warning text-dark';
                                }
                                ?>
                                <span class="badge <?= $badge ?>">
                                    <?= $p['status'] ?>
                                </span>
                            </td>

                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="3" class="text-center text-muted">
                                Belum ada data
                            </td>
                        </tr>
                    <?php endif; ?>
                    </tbody>

                </table>
            </div>
        </div>

        <!-- RIGHT -->
        <div class="col-md-4">

            <?php if (session()->get('role') == 'admin' && !empty($notifikasi)): ?>
            <div class="card card-custom p-3 mb-3">
                <h6>
                    <i class="bi bi-bell-fill"></i> Notifikasi
                    <span class="badge bg-danger"><?= count($notifikasi) ?></span>
                </h6>

                <div class="notification-list mt-2">
                    <?php foreach ($notifikasi as $n): ?>
                        <div class="notification-item-card">
                            <i class="bi bi-exclamation-circle"></i>
                            <?= $n['pesan'] ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>

            <?php if (session()->get('role') != 'admin'): ?>
            <div class="card card-custom p-3 mb-3">
                <h6>Aksi Cepat</h6>

                <a href="<?= base_url('pengaduan/create') ?>" class="btn btn-primary w-100 mb-2">
                    <i class="bi bi-plus-circle"></i> Buat Pengaduan
                </a>

                <a href="<?= base_url('pengaduan/history') ?>" class="btn btn-outline-secondary w-100">
                    <i class="bi bi-clock-history"></i> History
                </a>
            </div>
            <?php endif; ?>

            <div class="card card-custom p-3 mb-3">
                <h6>Aktivitas</h6>
                <ul class="list-unstyled mt-2 mb-0">
                    <li>📌 Pengaduan dikirim</li>
                    <li>📌 Diproses admin</li>
                    <li>📌 Status diperbarui</li>
                </ul>
            </div>

            <div class="card card-custom p-3">
                <h6>Info</h6>
                <p class="small-text mb-0">
                    Sistem pengaduan membantu monitoring laporan secara real-time.
                </p>
            </div>

        </div>

    </div>

</div>

<?= $this->endSection() ?>