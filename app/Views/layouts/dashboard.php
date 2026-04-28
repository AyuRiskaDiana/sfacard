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
        transition: 0.2s;
    }

    .notification-item-card:hover {
        background: #dbeafe;
        transform: translateX(3px);
    }
</style>

<div class="container-fluid mt-3 px-3">

    <!-- HEADER -->
    <div class="dashboard-header mb-4">
        <h4>Good morning, <?= session('nama') ?></h4>

        <p class="small-text">
            <?= session()->get('role') == 'admin'
                ? 'Ringkasan sistem hari ini'
                : 'Pantau status pengaduan kamu' ?>
        </p>

        <?php if (session()->get('role') == 'admin'): ?>
        <div class="row mt-3">

            <div class="col-md-2">
                <div class="stat-card">
                    <h6>Total Pengaduan</h6>
                    <h4><?= count($pengaduan ?? []) ?></h4>
                </div>
            </div>

            <div class="col-md-2">
                <div class="stat-card">
                    <h6>Diproses</h6>
                    <h4><?= $diproses ?? 0 ?></h4>
                </div>
            </div>

            <div class="col-md-2">
                <div class="stat-card">
                    <h6>Selesai</h6>
                    <h4><?= $selesai ?? 0 ?></h4>
                </div>
            </div>

            <div class="col-md-2">
                <div class="stat-card">
                    <h6>Ditolak</h6>
                    <h4><?= $ditolak ?? 0 ?></h4>
                </div>
            </div>

            <div class="col-md-2">
                <div class="stat-card">
                    <h6>User</h6>
                    <h4><?= $total_user ?? 0 ?></h4>
                </div>
            </div>

        </div>
        <?php endif; ?>
    </div>

    <!-- GRAFIK HANYA ADMIN -->
    <?php if (session()->get('role') == 'admin'): ?>
    <div class="card shadow-sm mt-4">
        <div class="card-header">
            <h5 class="mb-0">Grafik Statistik Pengaduan</h5>
        </div>
        <div class="card-body">
            <canvas id="grafikPengaduan" height="100"></canvas>
        </div>
    </div>
    <?php endif; ?>

    <div class="row mt-4">

        <!-- LEFT -->
        <div class="col-md-8">
            <div class="card card-custom p-3">

                <h5>Data Pengaduan Terbaru</h5>

                <?php if (empty($pengaduan)): ?>
                    <div class="alert alert-info mt-3">Belum ada pengaduan</div>
                <?php else: ?>
                <table class="table mt-3">
                    <thead>
                        <tr>
                            <?php if (session()->get('role') == 'admin'): ?>
                            <th>User</th>
                            <?php endif; ?>
                            <th>Topik Pengaduan</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>
                    <?php foreach (array_slice($pengaduan, 0, 5) as $p): ?>
                        <tr>

                            <?php if (session()->get('role') == 'admin'): ?>
                            <td><?= $p['nama'] ?? '-' ?></td>
                            <?php endif; ?>

                            <td><?= $p['judul'] ?></td>

                            <td>
                                <?php
                                $status = strtolower(trim($p['status'] ?? ''));

                                $badgeClass = 'bg-secondary';
                                $statusText = 'Menunggu';

                                if ($status == 'selesai') {
                                    $badgeClass = 'bg-success';
                                    $statusText = 'Selesai';
                                } elseif ($status == 'diproses' || $status == 'proses') {
                                    $badgeClass = 'bg-warning text-dark';
                                    $statusText = 'Diproses';
                                } elseif ($status == 'ditolak') {
                                    $badgeClass = 'bg-danger';
                                    $statusText = 'Ditolak';
                                }
                                ?>

                                <span class="badge <?= $badgeClass ?>">
                                    <?= $statusText ?>
                                </span>
                            </td>

                        </tr>
                    <?php endforeach; ?>
                    </tbody>

                </table>
                <?php endif; ?>

            </div>
        </div>

        <!-- RIGHT -->
        <div class="col-md-4">

            <?php if (!empty($notifikasi)): ?>
            <div class="card card-custom p-3 mb-3">

                <h6>
                    <i class="bi bi-bell-fill"></i> Notifikasi
                    <span class="badge bg-danger"><?= count($notifikasi) ?></span>
                </h6>

                <div class="notification-list mt-2">
                    <?php foreach ($notifikasi as $n): ?>
                        <a href="<?= base_url('dashboard/readNotif/' . $n['id_notifikasi']) ?>"
                           style="text-decoration:none; color:inherit;">

                            <div class="notification-item-card">
                                <i class="bi bi-exclamation-circle"></i>
                                <?= $n['pesan'] ?>
                            </div>

                        </a>
                    <?php endforeach; ?>
                </div>

            </div>
            <?php endif; ?>

        </div>

    </div>

</div>

<script src="<?= base_url('assets/js/chart.js') ?>"></script>

<?php if (session()->get('role') == 'admin'): ?>
<script>
const ctx = document.getElementById('grafikPengaduan');

new Chart(ctx, {
    type: 'bar',
    data: {
        labels: <?= json_encode($bulan ?? []) ?>,
        datasets: [
            {
                label: 'Menunggu',
                data: <?= json_encode($menungguArr ?? []) ?>,
                backgroundColor: '#3b82f6'
            },
            {
                label: 'Diproses',
                data: <?= json_encode($diprosesArr ?? []) ?>,
                backgroundColor: '#f97316'
            },
            {
                label: 'Selesai',
                data: <?= json_encode($selesaiArr ?? []) ?>,
                backgroundColor: '#10b981'
            },
            {
                label: 'Ditolak',
                data: <?= json_encode($ditolakArr ?? []) ?>,
                backgroundColor: '#ef4444'
            }
        ]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'bottom'
            },
            title: {
                display: true,
                text: 'Grafik Statistik Pengaduan'
            }
        },
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>
<?php endif; ?>

<?= $this->endSection() ?>