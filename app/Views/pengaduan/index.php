<div style="padding:20px;">

    <h2>Laporan Aspirasi</h2>

    <?php if(session()->getFlashdata('success')): ?>
        <p style="color:green;">
            <?= session()->getFlashdata('success') ?>
        </p>
    <?php endif; ?>

    <?php if(session()->get('role') == 'admin'): ?>

    <form method="get" action="<?= base_url('pengaduan') ?>">
        <p>
            Tanggal:
            <input type="date" name="tanggal">

            Bulan:
            <input type="month" name="bulan">

            Siswa/Guru:
            <input type="text" name="id_user" placeholder="ID User">

            Kategori:
            <select name="id_aspirasi">
                <option value="">Semua</option>

                <?php if(!empty($aspirasi)): ?>
                    <?php foreach($aspirasi as $a): ?>
                        <option value="<?= $a['id_aspirasi'] ?>">
                            <?= $a['kategori'] ?>
                        </option>
                    <?php endforeach; ?>
                <?php endif; ?>

            </select>

            <button type="submit">Cari</button>
        </p>
    </form>

    <?php endif; ?>

    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>Nama</th>
            <th>Judul</th>
            <th>Lokasi</th>
            <th>Status</th>
            <th>Foto</th>
            <th>Tanggal</th>
            <th>Feedback</th>
            <th>Kategori</th>

            <?php if (session()->get('role') == 'admin') : ?>
                <th>Aksi</th>
            <?php endif; ?>
        </tr>

        <?php foreach($pengaduan as $p): ?>
        <tr>

            <td><?= $p['nama'] ?? '-' ?></td>
            <td><?= $p['judul'] ?></td>
            <td><?= $p['lokasi'] ?></td>

            <td><?= $p['status'] ?></td>

            <td>
                <?php if(!empty($p['foto'])): ?>
                    <img src="<?= base_url('uploads/'.$p['foto']) ?>" width="80">
                <?php else: ?>
                    -
                <?php endif; ?>
            </td>

            <td><?= $p['tanggal'] ?></td>

            <td>
                <?= $p['isi_feedback'] ?? 'Belum ada feedback' ?>
            </td>

            <td>
                <?= $p['kategori'] ?? '-' ?>
            </td>

            <?php if(session()->get('role') == 'admin'): ?>
            <td>

                <a href="<?= base_url('pengaduan/edit/'.$p['id_pengaduan']) ?>">Edit</a> |
                
                <a href="<?= base_url('pengaduan/delete/'.$p['id_pengaduan']) ?>"
                   onclick="return confirm('Yakin hapus data?')">Hapus</a> |
                
                <a href="<?= base_url('pengaduan/feedback/'.$p['id_pengaduan']) ?>">
                    Feedback
                </a>

            </td>
            <?php endif; ?>

        </tr>
        <?php endforeach; ?>

    </table>

</div>

<p>
    <a href="<?= base_url('dashboard') ?>">
        ← Kembali ke Dashboard
    </a>
</p>