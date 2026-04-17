<ul class="nav flex-column mt-3">
    <li class="nav-item">
        <a class="nav-link" href="#">
            <b>SFACARD</b> <i class="bi bi-yelp"></i>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('/') ?>">
            <i class="bi bi-house"></i> <span>Dashboard</span>
        </a>
    </li>
    

     <?php if(session()->get('role') == 'admin'): ?>
    <li>
        <a href="<?= base_url('users') ?>">Data Users</a>
    </li>
<?php endif; ?>

        <?php if(session()->get('role') == 'admin'): ?>
    <a href="<?= base_url('pengaduan') ?>">Data Aspirasi</a>
<?php endif; ?>

<?php if(session()->get('role') != 'admin'): ?>
    <a href="<?= base_url('pengaduan/create') ?>">Pengaduan</a>
<?php endif; ?>
    </li>
    
     <?php $idu = session('id_user'); ?>
   
 <li class="nav-item">
        <a class="nav-link" href="<?= base_url('pengaduan/history/') ?>">
            <i class="bi bi-person-gear"></i> <span>History</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('users/edit/' . $idu) ?>">
            <i class="bi bi-person-gear"></i> <span>Setting</span>
        </a>
    </li>

    <a href="<?= site_url('/logout') ?>"> Log Out </a>
</ul>
<li class="nav-item mt-3">
    <span class="nav-link disabled">Masuk sebagai: <b><?= session('nama'); ?> (<?= session('role'); ?>)</b></span>
</li>

<center>
    <img src="<?= base_url('uploads/users/' . session()->get('foto')) ?>" height="80" class="mt-3 rounded-circle" />
</center>
