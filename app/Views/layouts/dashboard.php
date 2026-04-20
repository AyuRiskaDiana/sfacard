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
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
    }

    .stat-card {
        background: rgba(255,255,255,0.15);
        border-radius: 10px;
        padding: 15px;
        color: white;
    }

    .small-text {
        font-size: 12px;
        opacity: 0.8;
    }
</style>

<div class="container mt-3">

    <!-- HEADER -->
    <div class="dashboard-header mb-4">
        <h4>Good morning, <?= session('nama') ?></h4>

        <?php if(session()->get('role') == 'admin'): ?>
            <p class="small-text">Ringkasan sistem hari ini</p>
        <?php else: ?>
            <p class="small-text">Pantau status pengaduan kamu</p>
        <?php endif; ?>

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

            <?php if(session()->get('role') == 'admin'): ?>
            <div class="col-md-3">
                <div class="stat-card">
                    <h6>User</h6>
                    <h4><?= $total_user ?? 0 ?></h4>
                </div>
            </div>
            <?php endif; ?>

        </div>
    </div>

    <!-- CONTENT -->
    <div class="row">

        <!-- LEFT -->
        <div class="col-md-8">
            <div class="card card-custom p-3">

                <?php if(session()->get('role') == 'admin'): ?>
                    <h5>Data Pengaduan Terbaru</h5>
                <?php else: ?>
                    <h5>Pengaduan Terakhir Kamu</h5>
                <?php endif; ?>

                <table class="table mt-3">
                    <tr>
                        <?php if(session()->get('role') == 'admin'): ?>
                            <th>Nama</th>
                        <?php endif; ?>
                        <th>Judul</th>
                        <th>Status</th>
                    </tr>

                    <?php if(!empty($pengaduan)): ?>
                        <?php foreach(array_slice($pengaduan,0,5) as $p): ?>
                        <tr>
                            <?php if(session()->get('role') == 'admin'): ?>
                                <td><?= $p['nama'] ?? '-' ?></td>
                            <?php endif; ?>

                            <td><?= $p['judul'] ?></td>

                            <td>
                                <span class="badge 
                                    <?= $p['status'] == 'selesai' ? 'bg-success' : 
                                        ($p['status'] == 'diproses' ? 'bg-warning text-dark' : 'bg-secondary') ?>">
                                    <?= $p['status'] ?>
                                </span>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="3">Belum ada data</td>
                        </tr>
                    <?php endif; ?>

                </table>
            </div>
        </div>

        <!-- RIGHT -->
        <div class="col-md-4">

            <!-- KHUSUS USER -->
            <?php if(session()->get('role') != 'admin'): ?>
            <div class="card card-custom p-3 mb-3">
                <h6>Aksi Cepat</h6>

                <a href="<?= base_url('pengaduan/create') ?>" class="btn btn-primary w-100 mb-2">
                    <i class="bi bi-plus-circle"></i> Buat Pengaduan
                </a>

                <a href="<?= base_url('pengaduan/history') ?>" class="btn btn-outline-secondary w-100">
                    <i class="bi bi-clock-history"></i> Lihat History
                </a>
            </div>
            <?php endif; ?>

            <!-- UMUM -->
            <div class="card card-custom p-3 mb-3">
                <h6>Aktivitas</h6>
                <ul class="list-unstyled mt-3">
                    <li>📌 Pengaduan dikirim</li>
                    <li>📌 Diproses admin</li>
                    <li>📌 Status diperbarui</li>
                </ul>
            </div>

            <div class="card card-custom p-3">
                <h6>Info</h6>
                <p class="small-text">
                    Sistem pengaduan membantu monitoring laporan secara real-time.
                </p>
            </div>

        </div>

    </div>

</div>

<?= $this->endSection() ?>