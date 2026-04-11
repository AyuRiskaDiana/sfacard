<h3>History Pengaduan (Selesai)</h3>

<table border="1">
    <tr>
        <th>Judul</th>
        <th>Lokasi</th>
        <th>Tanggal</th>
        <th>Status</th>
        <th>Feedback</th>
    </tr>

    <?php foreach($pengaduan as $p): ?>
    <tr>
        <td><?= $p['judul'] ?></td>
        <td><?= $p['lokasi'] ?></td>
        <td><?= $p['tanggal'] ?></td>
        <td><?= $p['status'] ?></td>
        <td><?= $p['isi_feedback'] ?? 'Belum ada' ?></td>
    </tr>
    <?php endforeach; ?>
</table>

<br>
<a href="<?= base_url('dashboard') ?>">Kembali</a>