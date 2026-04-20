<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>


<div class="container mt-5">

    <div class="card shadow">
        <div class="card-header bg-warning">
            <h4>Edit Pengaduan</h4>
        </div>

        <div class="card-body">

            <form action="<?= base_url('pengaduan/update/' . $pengaduan['id_pengaduan']) ?>"
                method="post"
                enctype="multipart/form-data">

                <!-- simpan foto lama -->
                <input type="hidden" name="foto_lama" value="<?= $pengaduan['foto'] ?>">

                <div class="mb-3">
                    <label>Judul</label>
                    <input type="text" name="judul" class="form-control"
                        value="<?= $pengaduan['judul'] ?>" required>
                </div>

                <div class="mb-3">
                    <label>Foto Sekarang</label><br>
                    <?php if ($pengaduan['foto']): ?>
                        <img src="<?= base_url('uploads/' . $pengaduan['foto']) ?>" width="100"><br><br>
                    <?php endif; ?>

                    <input type="file" name="foto" class="form-control">
                    <small class="text-muted">Kosongkan jika tidak ingin mengganti foto</small>
                </div>

                <div class="mb-3">
                    <label>Lokasi</label>
                    <input type="text" name="lokasi" class="form-control"
                        value="<?= $pengaduan['lokasi'] ?>" required>
                </div>

                <div class="mb-3">
                    <label>Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" rows="4" required><?= $pengaduan['deskripsi'] ?></textarea>
                </div>

                <div class="mb-3">
                    <label>Tanggal</label>
                    <input type="date" name="tanggal" class="form-control"
                        value="<?= $pengaduan['tanggal'] ?>" required>
                </div>

                <div class="mb-3">
                    <label>Status</label>
                    <select name="status" class="form-control">
                        <option value="menunggu" <?= ($pengaduan['status'] == 'menunggu') ? 'selected' : '' ?>>Menunggu</option>
                        <option value="proses" <?= ($pengaduan['status'] == 'proses') ? 'selected' : '' ?>>Proses</option>
                        <option value="selesai" <?= ($pengaduan['status'] == 'selesai') ? 'selected' : '' ?>>Selesai</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-success">Update</button>
                <a href="<?= base_url('pengaduan') ?>" class="btn btn-secondary">Kembali</a>

            </form>

        </div>
    </div>

</div>
<?= $this->endSection() ?>