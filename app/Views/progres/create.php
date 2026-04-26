<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <div class="card shadow border-0 rounded-4" style="max-width: 500px; margin: 0 auto;">
        <div class="card-header text-white rounded-top-4" style="background: linear-gradient(135deg,#6a5af9,#3b82f6);">
            <h5 class="mb-0">
                <i class="bi bi-graph-up-arrow"></i> Tambah Progres
            </h5>
        </div>
        <div class="card-body">
            <form action="<?= base_url('progres/store') ?>" method="post" enctype="multipart/form-data">

    <input type="hidden" name="id_pengaduan" value="<?= $id_pengaduan ?>">

    <div class="mb-2">
        <label>Progres (%)</label>
        <input type="number" name="progres" class="form-control">
    </div>

    <div class="mb-2">
        <label>Tindakan</label>
        <textarea name="tindakan" class="form-control"></textarea>
    </div>

    <div class="mb-2">
        <label>Biaya</label>
        <input type="number" name="biaya" class="form-control">
    </div>

    <div class="mb-2">
        <label>Foto</label>
        <input type="file" name="foto" class="form-control">
    </div>

    <button class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>