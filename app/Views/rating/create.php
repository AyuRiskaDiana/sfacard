<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <div class="card shadow border-0 rounded-4" style="max-width: 500px; margin: 0 auto;">
        <div class="card-header text-white rounded-top-4" style="background: linear-gradient(135deg,#6a5af9,#3b82f6);">
            <h5 class="mb-0">
                <i class="bi bi-star-fill"></i> Beri Rating & Komentar
            </h5>
        </div>

       <form action="<?= base_url('progres/store') ?>" method="post" enctype="multipart/form-data">

    <input type="hidden" name="id_pengaduan" value="<?= $id_pengaduan ?>">

    <div class="mb-2">
        <label>Progres (%)</label>
        <input type="number" name="progres" class="form-control" required>
    </div>

    <div class="mb-2">
        <label>Tindakan</label>
        <textarea name="tindakan" class="form-control" required></textarea>
    </div>

    <div class="mb-2">
        <label>Biaya</label>
        <input type="number" name="biaya" class="form-control">
    </div>

    <div class="mb-2">
        <label>Foto</label>
        <input type="file" name="foto" class="form-control">
    </div>

    <button type="submit" class="btn btn-primary">Simpan</button>

</form>

                <!-- KOMENTAR -->
                <div class="mb-3">
                    <label for="komentar" class="form-label fw-semibold">
                        Komentar (Opsional):
                    </label>
                    <textarea name="komentar" id="komentar" class="form-control" 
                              rows="4" placeholder="Tulis pengalaman dan kepuasan Anda..."></textarea>
                </div>

                <!-- BUTTONS -->
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-success flex-grow-1">
                        <i class="bi bi-check-circle"></i> Kirim Rating
                    </button>
                    <a href="<?= base_url('pengaduan/history') ?>" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>