<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<div class="container mt-5">

    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4>Tambah Pengaduan</h4>
        </div>

        <div class="card-body">

        <form action="<?= base_url('pengaduan/store') ?>" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label>Judul</label>
                    <input type="text" name="judul" class="form-control" placeholder="Masukkan judul">
                </div>

                <div class="mb-3">
                    <label>Lokasi</label>
                    <input type="text" name="lokasi" class="form-control" placeholder="Masukkan lokasi">
                </div>

                <div class="mb-3">
                    <label>Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" rows="4" placeholder="Masukkan deskripsi"></textarea>
                </div>
                
                <div class="mb-3">
                <label>Foto</label>
                <input type="file" name="foto" class="form-control">
                </div>

                <div class="mb-3">
    <           label>Tanggal</label>
                <input type="date" name="tanggal" class="form-control">
                </div>

                <button type="submit" class="btn btn-success">
                    Simpan
                </button>

                <a href="<?= base_url('pengaduan') ?>" class="btn btn-secondary">
                    Kembali
                </a>

            </form>

        </div>
    </div>

</div>