<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
   .history-header {
    background: linear-gradient(135deg, #6a5af9, #3b82f6);
    color: white;
    border-radius: 15px;
    padding: 25px;
    position: relative;
    overflow: hidden;
}

/* efek halus biar gak bentrok */
.history-header::after {
    content: "";
    position: absolute;
    top: 0;
    right: 0;
    width: 200px;
    height: 200px;
    background: rgba(255,255,255,0.1);
    border-radius: 50%;
    transform: translate(50%, -50%);
}

/* judul */
.history-header h4 {
    font-weight: 600;
    margin-bottom: 5px;
}

/* deskripsi */
.history-header p {
    color: rgba(255,255,255,0.85); /* 🔥 bukan abu-abu lagi */
    font-size: 13px;
    margin-bottom: 0;
}
</style>

<div class="container-fluid mt-3 px-3">

    <!-- HEADER -->
    <div class="history-header mb-4">
        <h4>📊 History Pengaduan</h4>
        <p class="small-text">
            Pantau progres, biaya, dan status laporan kamu
        </p>
    </div>

    <!-- LIST DATA -->
    <?php if (!empty($pengaduan)): ?>
        <?php foreach ($pengaduan as $p): ?>

        <div class="card card-history mb-3">
            <div class="card-body">

                <!-- HEADER CARD -->
                <div class="d-flex justify-content-between align-items-start">

                    <div>
                        <h5 class="fw-bold mb-1"><?= $p['judul'] ?></h5>
                        <div class="small-text">
                            <?= $p['nama'] ?? '-' ?> • <?= $p['tanggal'] ?>
                        </div>
                    </div>

                    <?php
                    $statusClass = 'bg-secondary';
                    if ($p['status'] == 'selesai') {
                        $statusClass = 'bg-success';
                    } elseif ($p['status'] == 'diproses') {
                        $statusClass = 'bg-warning text-dark';
                    }
                    ?>
                    <span class="badge badge-status <?= $statusClass ?>">
                        <?= strtoupper($p['status']) ?>
                    </span>
                </div>

                <hr>

                <!-- DETAIL -->
                <div class="row">

                    <div class="col-md-8">

                        <p><b>📍 Lokasi:</b> <?= $p['lokasi'] ?></p>
                        <p><b>📂 Kategori:</b> <?= $p['kategori'] ?? '-' ?></p>

                        <!-- PROGRES -->
                        <h6 class="mt-3">🔧 Progres Pengerjaan</h6>

                        <?php $listProgres = $progres[$p['id_pengaduan']] ?? null; ?>

                        <?php if (!empty($listProgres)): ?>
                            <?php foreach ($listProgres as $pr): ?>

                                <div class="progres-box">

                                    <b><?= $pr['progres'] ?>%</b> - <?= $pr['tindakan'] ?>

                                    <div class="progress mt-1" style="height:6px;">
                                        <div class="progress-bar bg-success" 
                                             style="width: <?= $pr['progres'] ?>%">
                                        </div>
                                    </div>

                                    <?php if (!empty($pr['foto'])): ?>
                                        <img src="<?= base_url('uploads/' . $pr['foto']) ?>" 
                                             width="80" class="mt-2 rounded"
                                             style="max-width: 80px; max-height: 80px; object-fit: cover;">
                                    <?php endif; ?>

                                    <?php if (!empty($pr['biaya'])): ?>
                                        <div class="mt-1">
                                            💰 Rp <?= number_format($pr['biaya'],0,',','.') ?>
                                        </div>
                                    <?php endif; ?>

                                </div>

                            <?php endforeach; ?>
                        <?php else: ?>
                            <span class="text-muted">Belum ada progres</span>
                        <?php endif; ?>

                        <!-- FEEDBACK -->
                        <div class="mt-3">
                            <b>💬 Feedback:</b><br>
                            <?= $p['isi_feedback'] ?? '<span class="text-muted">Belum ada</span>' ?>
                        </div>

                       

                        <!-- KOMENTAR -->
                        <?php if (!empty($p['komentar'])): ?>
                        <div class="mt-2">
                            <b>💬 Komentar:</b><br>
                            <span class="text-muted"><?= nl2br(htmlspecialchars($p['komentar'])) ?></span>
                        </div>
                        <?php endif; ?>

                    </div>

                    <!-- FOTO UTAMA -->
                    <div class="col-md-4 text-center">
                        <?php if (!empty($p['foto'])): ?>
                            <img src="<?= base_url('uploads/' . $p['foto']) ?>" 
                                 class="img-fluid rounded shadow-sm"
                                 style="max-width: 150px; max-height: 150px; object-fit: cover;">
                        <?php else: ?>
                            <span class="text-muted">Tidak ada foto</span>
                        <?php endif; ?>
                    </div>

                </div>

                <!-- AKSI ADMIN -->
                <?php if (session()->get('role') == 'admin'): ?>
                <div class="mt-3">
                    <a href="<?= base_url('pengaduan/edit/' . $p['id_pengaduan']) ?>" 
                       class="btn btn-warning btn-sm">
                       Edit
                    </a>

                    <a href="<?= base_url('pengaduan/delete/' . $p['id_pengaduan']) ?>" 
                       class="btn btn-danger btn-sm"
                       onclick="return confirm('Yakin?')">
                       Hapus
                    </a>
                </div>
                <?php endif; ?>

            </div>
        </div>

        <?php endforeach; ?>
    <?php else: ?>
        <div class="text-center text-muted">
            Belum ada data
        </div>
    <?php endif; ?>

</div>

<?= $this->endSection() ?>