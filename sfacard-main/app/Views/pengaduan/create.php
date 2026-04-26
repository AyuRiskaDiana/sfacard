<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-4">

<?php if(session()->get('role') == 'guru' || session()->get('role') == 'siswa'): ?>

    <div class="card shadow rounded-4">
        <div class="card-body">

            <h4 class="mb-3">
                <i class="bi bi-plus-circle text-primary"></i> Tambah Aspirasi Baru
            </h4>

            <?php if(session()->getFlashdata('success')): ?>
                <div class="alert alert-success">
                    <?= session()->getFlashdata('success'); ?>
                </div>
            <?php endif; ?>

            <form action="<?= base_url('pengaduan/store') ?>" method="post" enctype="multipart/form-data">

                <div class="mb-3">
                    <label class="form-label">Kategori</label>
                    <select name="id_aspirasi" class="form-control">
                        <option value="">Pilih Kategori</option>

                        <?php if(!empty($aspirasi)): ?>
                            <?php foreach($aspirasi as $a): ?>
                                <option value="<?= $a['id_aspirasi'] ?>">
                                    <?= $a['kategori'] ?>
                                </option>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <option value="1">Kerusakan</option>
                            <option value="2">Kinerja Guru</option>
                            <option value="3">Kebijakan Sekolah</option>
                        <?php endif; ?>

                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Judul</label>
                    <input type="text" name="judul" class="form-control" placeholder="Masukkan judul">
                </div>

                <div class="mb-3">
                    <label class="form-label">Lokasi</label>
                    <input type="text" name="lokasi" class="form-control" placeholder="Masukkan lokasi">
                </div>

                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" rows="4" placeholder="Jelaskan secara detail..."></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Foto</label>
                    <input type="file" name="foto" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Tanggal</label>
                    <input type="date" name="tanggal" class="form-control">
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-send"></i> Kirim
                    </button>

                    <a href="<?= base_url('pengaduan') ?>" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                </div>

            </form>

        </div>
    </div>

<?php else: ?>

    <div class="alert alert-warning">
        Halaman ini hanya untuk user/guru.
    </div>

<?php endif; ?>

</div>

<?= $this->endSection() ?>