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

            <div class="col-md-3">
                <div class="stat-card">
                    <h6>User</h6>
                    <h4><?= $total_user ?? 0 ?></h4>
                </div>
            </div>

        </div>
        <?php endif; ?>
    </div>

    <!-- GRAFIK -->
    <div class="card card-custom p-3 mb-4">
        <h5>Grafik Pengaduan</h5>
        <canvas id="grafikPengaduan" height="100"></canvas>
    </div>

    <div class="row">

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
                            <th>Judul</th>
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
                                <span class="badge 
                                    <?= $p['status']=='selesai' ? 'bg-success' : 
                                       ($p['status']=='diproses' ? 'bg-warning text-dark' : 'bg-secondary') ?>">
                                    <?= $p['status'] ?>
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

            <!-- NOTIF -->
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

<!-- ✅ OFFLINE CHART -->
<script src="<?= base_url('assets/js/chart.js') ?>"></script>

<script>
const ctx = document.getElementById('grafikPengaduan');

new Chart(ctx, {
    type: 'line',
    data: {
        labels: <?= json_encode($tanggal ?? []) ?>,
        datasets: [
            {
                label: 'Menunggu',
                data: <?= json_encode($menunggu ?? []) ?>,
                borderColor: '#f59e0b',
                tension: 0.3
            },
            {
                label: 'Diproses',
                data: <?= json_encode($diprosesArr ?? []) ?>,
                borderColor: '#3b82f6',
                tension: 0.3
            },
            {
                label: 'Selesai',
                data: <?= json_encode($selesaiArr ?? []) ?>,
                borderColor: '#10b981',
                tension: 0.3
            }
        ]
    }
});
</script>

<?= $this->endSection() ?>