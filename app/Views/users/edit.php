<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div style="padding:20px;">

    <h3>Edit User</h3>

    <form action="<?= base_url('users/update/' . $user['id_user']) ?>" method="post" enctype="multipart/form-data">

        <p>
            <label>Nama Lengkap</label><br>
            <input type="text" name="nama" value="<?= $user['nama'] ?>" required>
        </p>

        <p>
            <label>Username</label><br>
            <input type="text" name="username" value="<?= $user['username'] ?>" required>
        </p>

        <p>
            <label>Password (kosongkan jika tidak diubah)</label><br>
            <input type="password" name="password">
        </p>

        <p>
            <label>Foto</label><br>
            <input type="file" name="foto"><br><br>

            Foto sekarang:<br>

            <?php if (!empty($user['foto'])): ?>
                <img src="<?= base_url('uploads/users/' . $user['foto']) ?>" width="80">
            <?php else: ?>
                -
            <?php endif; ?>
        </p>

        <p>
            <button type="submit">Update</button>
            <a href="<?= base_url('users') ?>">Kembali</a>
        </p>

    </form>

</div>

<?= $this->endSection() ?>