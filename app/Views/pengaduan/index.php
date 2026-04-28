<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
    body {
        background: #f8fafc;
    }

    .page-header {
        background: linear-gradient(135deg, #6a5af9, #3b82f6);
        color: white;
        border-radius: 16px;
        padding: 22px;
        margin-bottom: 20px;
        box-shadow: 0 8px 20px rgba(0,0,0,0.08);
    }

    .card-custom {
        border: none;
        border-radius: 16px;
        box-shadow: 0 6px 18px rgba(0,0,0,0.06);
        transition: 0.2s;
        overflow: hidden;
    }

    .card-custom:hover {
        transform: translateY(-2px);
    }

    .filter-card {
        border: none;
        border-radius: 14px;
        box-shadow: 0 4px 14px rgba(0,0,0,0.05);
    }

    .status-badge {
        padding: 8px 14px;
        border-radius: 30px;
        font-size: 13px;
        font-weight: 600;
    }

    .foto-preview {
        max-height: 220px;
        width: 100%;
        object-fit: cover;
        border-radius: 12px;
        border: 1px solid #e5e7eb;
    }

    .section-title {
        font-size: 14px;
        font-weight: 600;
        color: #64748b;
        margin-bottom: 4px;
    }

    .section-value {
        font-size: 15px;
        color: #1e293b;
        margin-bottom: 10px;
    }

    .btn-action {
        border-radius: 10px;
        padding: 8px 14px;
        font-size: 13px;
        font-weight: 500;
    }

    .feedback-box {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 14px;
        margin-top: 12px;
    }

    .empty-box {
        border-radius: 14px;
        padding: 20px;
        text-align: center;
        background: white;
        box-shadow: 0 4px 14px rgba(0,0,0,0.05);
    }
</style>

<div class="container mt-4">

    <!-- HEADER -->
    <div class="page-header">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <h4 class="fw-bold mb-1">
                    <i class="bi bi-clipboard-data"></i> Data Aspirasi
                </h4>
                <small>Kelola seluruh data aspirasi dengan tampilan yang lebih rapi</small>
            </div>

            <div class="d-flex gap-2 flex-wrap">
                <?php if (!empty($pengaduan)): ?>
                    <a href="<?= base_url('pengaduan/print?' . http_build_query(array_filter(service('request')->getGet()))) ?>"
                        target="_blank"
                        class="btn btn-success btn-action">
                        <i class="bi bi-printer"></i> Print
                    </a>
                <?php endif; ?>

                <?php if (session()->get('role') != 'user'): ?>
                    <a href="<?= base_url('pengaduan/create') ?>" class="btn btn-light btn-action">
                        <i class="bi bi-plus-circle"></i> Pengaduan
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- ALERT -->
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success rounded-4">
            <i class="bi bi-check-circle"></i>
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <!-- FILTER ADMIN -->
    <?php if (session()->get('role') == 'admin'): ?>
        <div class="card filter-card mb-4">
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

    <!-- VERTICAL LIST -->
    <div class="row">
        <div class="col-12">

            <?php if (!empty($pengaduan)): ?>
                <?php foreach ($pengaduan as $p): ?>

                    <div class="card card-custom mb-4">
                        <div class="card-body p-4">

                            <!-- HEADER -->
                            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                                <div>
                                    <h5 class="fw-bold mb-1">
                                        <?= $p['nama'] ?? '-' ?>
                                    </h5>
                                    <small class="text-muted">
                                        <?= $p['tanggal'] ?>
                                    </small>
                                </div>

                                <?php
                                $status = strtolower(trim($p['status'] ?? ''));
                                $statusClass = 'bg-warning text-dark';
                                $statusText  = 'Menunggu';

                                if ($status == 'selesai') {
                                    $statusClass = 'bg-success';
                                    $statusText  = 'Selesai';
                                } elseif ($status == 'diproses' || $status == 'proses') {
                                    $statusClass = 'bg-info';
                                    $statusText  = 'Diproses';
                                } elseif ($status == 'ditolak') {
                                    $statusClass = 'bg-danger';
                                    $statusText  = 'Ditolak';
                                }
                                ?>

                                <span class="badge status-badge <?= $statusClass ?>">
                                    <?= $statusText ?>
                                </span>
                            </div>

                            <hr>

                            <!-- ISI -->
                            <div class="row">
                                <div class="col-md-7">

                                    <div class="section-title">Topik Pengaduan</div>
                                    <div class="section-value"><?= $p['judul'] ?></div>

                                    <div class="section-title">Lokasi</div>
                                    <div class="section-value"><?= $p['lokasi'] ?></div>

                                    <div class="section-title">Kategori</div>
                                    <div class="section-value"><?= $p['kategori'] ?? '-' ?></div>

                                    <?php if ($status == 'ditolak'): ?>

    <div class="feedback-box" style="border-left: 4px solid #dc3545;">
        <div class="section-title text-danger">
            Alasan Penolakan
        </div>

        <div class="section-value mb-0">
            <?= !empty($p['alasan_penolakan']) 
                ? $p['alasan_penolakan'] 
                : 'Tidak ada alasan penolakan' ?>
        </div>
    </div>

<?php else: ?>

    <div class="feedback-box">
        <div class="section-title">Feedback</div>

        <div class="section-value mb-0">
            <?= !empty($p['isi_feedback']) 
                ? $p['isi_feedback'] 
                : 'Belum ada feedback' ?>
        </div>
    </div>

<?php endif; ?>
                                    
                                </div>

                                <div class="col-md-5">

                                    <div class="section-title">Foto</div>

                                    <?php if (!empty($p['foto'])): ?>
                                        <img src="<?= base_url('uploads/' . $p['foto']) ?>"
                                            class="foto-preview">
                                    <?php else: ?>
                                        <div class="text-muted">
                                            Tidak ada foto
                                        </div>
                                    <?php endif; ?>

                                </div>
                            </div>

                            <!-- AKSI ADMIN -->
                            <?php if (session()->get('role') == 'admin'): ?>
                                <div class="d-flex flex-wrap gap-2 mt-4">

                                    <a href="<?= base_url('progres/create/' . $p['id_pengaduan']) ?>"
                                        class="btn btn-primary btn-sm btn-action">
                                        <i class="bi bi-plus"></i> Progres
                                    </a>

                                    <a href="<?= base_url('pengaduan/edit/' . $p['id_pengaduan']) ?>"
                                        class="btn btn-warning btn-sm btn-action">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </a>

                                    <a href="<?= base_url('pengaduan/delete/' . $p['id_pengaduan']) ?>"
                                        class="btn btn-danger btn-sm btn-action"
                                        onclick="return confirm('Yakin hapus data?')">
                                        <i class="bi bi-trash"></i> Hapus
                                    </a>

                                    <a href="<?= base_url('pengaduan/tolak/' . $p['id_pengaduan']) ?>"
                                        class="btn btn-outline-danger btn-sm btn-action">
                                        <i class="bi bi-x-circle"></i> Tolak
                                    </a>

                                </div>
                            <?php endif; ?>

                        </div>
                    </div>

                <?php endforeach; ?>

            <?php else: ?>

                <div class="empty-box">
                    <i class="bi bi-info-circle fs-4"></i>
                    <p class="mt-2 mb-0">Belum ada data pengaduan.</p>
                </div>

            <?php endif; ?>

        </div>
    </div>

</div>

<?= $this->endSection() ?>