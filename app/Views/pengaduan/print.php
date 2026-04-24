<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
    @media print {
        body * {
            visibility: hidden;
        }

        .print-area,
        .print-area * {
            visibility: visible;
        }

        .print-area {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
        }

        .no-print {
            display: none !important;
        }
    }
</style>

<!-- TOMBOL PRINT (Luar print-area, tidak muncul saat print) -->
<div class="no-print text-center mt-4 mb-3">
    <button onclick="window.print()" class="btn btn-primary">
        <i class="bi bi-printer"></i> Print
    </button>
    <a href="<?= base_url('pengaduan') ?>" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

<div class="print-area p-4">

    <!-- HEADER PRINT -->
    <div class="text-center mb-4">
        <h4 class="fw-bold">LAPORAN ASPIRASI</h4>
        <p class="text-muted mb-0">Tanggal Cetak: <?= date('d-m-Y') ?></p>
    </div>

    <!-- TABLE -->
    <table class="table table-bordered table-sm text-center">

        <thead class="table-secondary">
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Tanggal</th>
                <th>Judul</th>
                <th>Lokasi</th>
                <th>Kategori</th>
                <th>Status</th>
                <th>Feedback</th>
            </tr>
        </thead>

        <tbody>
            <?php if (!empty($pengaduan)): ?>
                <?php $no = 1; ?>
                <?php foreach ($pengaduan as $p): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $p['nama'] ?? '-' ?></td>
                        <td><?= $p['tanggal'] ?></td>
                        <td><?= $p['judul'] ?></td>
                        <td><?= $p['lokasi'] ?></td>
                        <td><?= $p['kategori'] ?? '-' ?></td>
                        <td><?= $p['status'] ?></td>
                        <td><?= $p['isi_feedback'] ?? '-' ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="8" class="text-muted">Tidak ada data</td>
                </tr>
            <?php endif; ?>
        </tbody>

    </table>

</div>

<?= $this->endSection() ?>