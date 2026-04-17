<h3>Feedback</h3>

<p>Judul: <?= $pengaduan['judul'] ?></p>

<form action="<?= base_url('pengaduan/feedback/save') ?>" method="post">
    
    <input type="hidden" name="id_pengaduan" value="<?= $pengaduan['id_pengaduan'] ?>">

    <textarea name="isi_feedback" placeholder="Masukkan feedback"></textarea><br><br>

    <button type="submit">Kirim</button>
</form>

<a href="<?= base_url('pengaduan') ?>">Kembali</a>