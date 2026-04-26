<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>

    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/bootstrap-icons-1.13.1/bootstrap-icons.css') ?>" rel="stylesheet">

    <style>
        body {
            height: 100vh;
            background: linear-gradient(135deg, #6f42c1, #d63384);
        }

        .login-container {
            height: 100vh;
        }

        .login-card {
            border-radius: 15px;
            overflow: hidden;
        }

        .left-panel {
            background: #fff;
            padding: 40px;
        }

        .right-panel {
            background: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .right-panel img {
            max-width: 80%;
        }

        .form-control {
            border-radius: 10px;
        }

        .btn-primary {
            border-radius: 10px;
        }
    </style>
</head>

<body>

<div class="container login-container d-flex justify-content-center align-items-center">
    <div class="card login-card shadow" style="width: 900px;">
        <div class="row g-0">

            <!-- KIRI (FORM) -->
            <div class="col-md-6 left-panel">
                <h4 class="mb-3 fw-bold">Welcome Back!</h4>
                <p class="text-muted">Please sign in to continue</p>

                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                <?php endif; ?>

                <?php if (session()->getFlashdata('salahpw')): ?>
                    <div class="alert alert-danger"><?= session()->getFlashdata('salahpw') ?></div>
                <?php endif; ?>

                <form action="<?= base_url('/proses-login') ?>" method="post">

                    <div class="mb-3">
                        <input type="text" name="username" class="form-control"
                               placeholder="Username" required>
                    </div>

                    <div class="mb-3">
                        <input type="password" name="password" class="form-control"
                               placeholder="Password" required>
                    </div>

                    <button class="btn btn-primary w-100">
                        Login
                    </button>
                </form>

                <div class="text-center mt-3">
                    <small>Belum punya akun?</small><br>
                    <a href="<?= base_url('users/create') ?>">Register Now</a>
                    <a href="<?= base_url('restore') ?>" class="btn btn-outline-danger btn-sm">
                        <i class="bi bi-database"></i> Restore DB
                        </a>
                </div>
            </div>
                    
            <!-- KANAN (GAMBAR) -->
            <div class="col-md-6 right-panel">
                <img src="<?= base_url('uploads/login/login.png') ?>" alt="login">
            </div>

        </div>
    </div>
</div>

<script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
</body>
</html>