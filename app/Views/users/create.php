<!-- app/Views/users/create.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Tambah User</title>
</head>

<body>

    <h3>Form Tambah User</h3>

    <?php if (session()->getFlashdata('error')): ?>
        <p style="color:red;">
            <?= session()->getFlashdata('error') ?>
        </p>
    <?php endif; ?>

    <form action="<?= base_url('users/store') ?>" method="post" enctype="multipart/form-data">

        <p>
            <label>Nama Lengkap</label><br>
            <input type="text" name="nama" required>
        </p>

        <p>
            <label>Username</label><br>
            <input type="text" name="username" required>
        </p>

        <p>
            <label>Password</label><br>
            <input type="password" name="password" required>
        </p>

        <p>
            <label>Role</label><br>
            <select name="role" required>
                <option value="">-- Pilih Role --</option>
                <option value="admin">Admin</option>
                <option value="guru">Guru</option>
                <option value="siswa">Siswa</option>
            </select>
        </p>

        <p>
            <label>Foto Profil</label><br>
            <input type="file" name="foto" accept="image/*"><br>
            <small>Kosongkan jika tidak upload foto</small>
        </p>

        <p>
            <button type="submit">Simpan</button>
            <a href="<?= base_url('login') ?>">Sudah Punya Akun</a>
        </p>

    </form>

</body>

</html>