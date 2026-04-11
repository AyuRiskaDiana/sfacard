<h3>Feedback Pengaduan</h3>

<?php if(isset($pengaduan)): ?>

<p>Judul: <?= $pengaduan['judul'] ?></p>
<p>Lokasi: <?= $pengaduan['lokasi'] ?></p>
<p>Deskripsi: <?= $pengaduan['deskripsi'] ?></p>

<form action="<?= base_url('pengaduan/saveFeedback') ?>" method="post">

    <input type="hidden" name="id_pengaduan" value="<?= $pengaduan['id_pengaduan'] ?>">

    <textarea name="isi_feedback"></textarea><br><br>

    <button type="submit">Simpan</button>

</form>

<?php else: ?>
    <p>Klik Untuk Memberikan Feedback</p>
<?php endif; ?>

<br>
<a href="<?= base_url('pengaduan') ?>">Feedback</a>

