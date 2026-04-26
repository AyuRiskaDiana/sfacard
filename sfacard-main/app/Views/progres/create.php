<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
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

<?= $this->endSection() ?>