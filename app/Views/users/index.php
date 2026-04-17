<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<?php if(session()->get('role') == 'admin'): ?>
    <a href="<?= base_url('users/create') ?>">+ Tambah User</a>
<?php endif; ?>
<div>

    <h3>Data Users</h3>

    <?php if (session()->getFlashdata('success')): ?>
        <p style="color:green;">
            <?= session()->getFlashdata('success') ?>
        </p>
    <?php endif; ?>

    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Username</th>
            <th>Role</th>
            <th>Foto</th>

            <?php if (session()->get('role') == 'admin') : ?>
                <th>Aksi</th>
            <?php endif; ?>
        </tr>

        <?php if (!empty($users)): ?>
            <?php $no = 1; foreach ($users as $u): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $u['nama'] ?></td>
                    <td><?= $u['username'] ?></td>
                    <td><?= ucfirst($u['role']) ?></td>

                    <td>
                        <?php if (!empty($u['foto'])): ?>
                            <img src="<?= base_url('uploads/users/' . $u['foto']) ?>" width="60">
                        <?php else: ?>
                            -
                        <?php endif; ?>
                    </td>

                    <?php if (session()->get('role') == 'admin') : ?>
                        <td>

                            <a href="<?= base_url('users/edit/' . $u['id_user']) ?>">
                                Edit
                            </a> |

                            <a href="<?= base_url('users/delete/' . $u['id_user']) ?>"
                               onclick="return confirm('Hapus user ini?')">
                                Hapus
                            </a>

                        </td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="6">Belum ada data user</td>
            </tr>
        <?php endif; ?>

    </table>

</div>

<?= $this->endSection() ?>