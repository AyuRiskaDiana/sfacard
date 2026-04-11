<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<div class="container mt-4">

    <h2 class="mb-3">Data Pengaduan</h2>

    <?php if(session()->get('role') != 'admin'): ?>
    <a href="<?= base_url('pengaduan/create') ?>" class="btn btn-primary mb-3">
        + Tambah Pengaduan
    </a>
<?php endif; ?>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>Judul</th>
                <th>Lokasi</th>
                <th>Status</th>
                <th>Foto</th>
                <th>Tanggal</th>
                 <th>Feedback</th>
                <?php if (session()->get('role') == 'admin') : ?>
                    <th width="150">Aksi</th>
                <?php endif; ?>
            </tr>
        </thead>

        <tbody>
        <?php foreach($pengaduan as $p): ?>
            <tr>
                <td><?= $p['judul'] ?></td>
                <td><?= $p['lokasi'] ?></td>
                <td>
                    <span class="badge bg-warning">
                        <?= $p['status'] ?>
                    </span>
                </td>
                <td>
    <?php if($p['foto']): ?>
        <img src="<?= base_url('uploads/'.$p['foto']) ?>" width="80">
    <?php endif; ?>
</td>

<td><?= $p['tanggal'] ?></td>

<td>
    <?= $p['isi_feedback'] ? $p['isi_feedback'] : 'Belum ada feedback' ?>
</td>

            <td>
<?php if(session()->get('role') == 'admin'): ?>
    
    <a href="<?= base_url('pengaduan/edit/'.$p['id_pengaduan']) ?>" 
       class="btn btn-warning btn-sm">Edit</a>

    <a href="<?= base_url('pengaduan/delete/'.$p['id_pengaduan']) ?>" 
       class="btn btn-danger btn-sm"
       onclick="return confirm('Yakin hapus data?')">Hapus</a>
</td>
       <td>
<a href="<?= base_url('pengaduan/feedback/'.$p['id_pengaduan']) ?>">Feedback</a><?php else: ?>
    -
<?php endif; ?>
</td>
</tr>
        <?php endforeach; ?>

        </tbody>
    </table>
    

</div>
<div class="mt-3">
    <a href="<?= base_url('dashboard') ?>" class="btn btn-secondary">
        ← Kembali ke Dashboard
    </a>
</div>