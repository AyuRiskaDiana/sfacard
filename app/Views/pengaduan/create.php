<div>

<?php if(session()->get('role') == 'admin'): ?>

    <h3>Tambah User</h3>

    <form action="<?= base_url('users/store') ?>" method="post" enctype="multipart/form-data">

        <p>
            Nama:<br>
            <input type="text" name="nama" required>
        </p>

        <p>
            Username:<br>
            <input type="text" name="username" required>
        </p>

        <p>
            Password:<br>
            <input type="password" name="password" required>
        </p>

        <p>
            Role:<br>
            <select name="role" required>
                <option value="">-- Pilih Role --</option>
                <option value="admin">Admin</option>
                <option value="guru">Guru</option>
                <option value="siswa">Siswa</option>
            </select>
        </p>

        <p>
            Foto:<br>
            <input type="file" name="foto">
        </p>

        <p>
            <button type="submit">Simpan</button>
            <a href="<?= base_url('users') ?>">Kembali</a>
        </p>

    </form>

<?php else: ?>


<?php endif; ?>

</div>

</div>

<div>

    <h4>Tambah Aspirasi Baru</h4>

    <?php if(session()->getFlashdata('success')): ?>
        <p><?= session()->getFlashdata('success'); ?></p>
    <?php endif; ?>

    <form action="<?= base_url('pengaduan/store') ?>" method="post" enctype="multipart/form-data">

        <p>
            <label>Aspirasi</label><br>
            <select name="id_aspirasi">
                <option value="">Pilih Kategori</option>

                <?php if(!empty($aspirasi)): ?>
                    <?php foreach($aspirasi as $a): ?>
                        <option value="<?= $a['id_aspirasi'] ?>">
                            <?= $a['kategori'] ?>
                        </option>
                    <?php endforeach; ?>
                <?php else: ?>
                    <option value="1">Kerusakan</option>
                    <option value="2">Kinerja Guru</option>
                    <option value="3">Kebijakan Sekolah</option>
                <?php endif; ?>
            </select>
        </p>

        <p>
            <label>Judul</label><br>
            <input type="text" name="judul" placeholder="Masukkan judul">
        </p>

        <p>
            <label>Lokasi</label><br>
            <input type="text" name="lokasi" placeholder="Masukkan lokasi">
        </p>

        <p>
            <label>Deskripsi</label><br>
            <textarea name="deskripsi" rows="4" placeholder="Jelaskan Secara Detail.."></textarea>
        </p>

        <p>
            <label>Foto</label><br>
            <input type="file" name="foto">
        </p>

        <p>
            <label>Tanggal</label><br>
            <input type="date" name="tanggal">
        </p>

        <p>
            <button type="submit">Kirim Pengaduan</button>
            <a href="<?= base_url('pengaduan') ?>">Kembali</a>
        </p>

    </form>

</div>