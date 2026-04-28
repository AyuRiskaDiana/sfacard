<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-4">

    <div class="card shadow">
        <div class="card-header bg-danger text-white">
            <h5 class="mb-0">Form Penolakan Pengaduan</h5>
        </div>

        <div class="card-body">

            <form action="<?= base_url('pengaduan/simpanPenolakan') ?>" method="post">

                <input type="hidden" name="id_pengaduan"
                       value="<?= $pengaduan['id_pengaduan'] ?>">

                <div class="mb-3">
                    <label class="form-label">Topik Pengaduan</label>
                    <input type="text"
                           class="form-control"
                           value="<?= $pengaduan['judul'] ?>"
                           readonly>
                </div>

                <div class="mb-3">
                    <label class="form-label">Alasan Penolakan</label>
                   <textarea
    name="alasan_penolakan"
    class="form-control"
    rows="5"
    required
    placeholder="Masukkan alasan penolakan..."></textarea>
                </div>

                <button type="submit" class="btn btn-danger">
                    Simpan Penolakan
                </button>

                <a href="<?= base_url('pengaduan') ?>"
                   class="btn btn-secondary">
                    Kembali
                </a>

            </form>

        </div>
    </div>

</div>

<?= $this->endSection() ?>