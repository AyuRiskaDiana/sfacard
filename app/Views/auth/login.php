<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SFACARD</title>

    <!-- Bootstrap Offline -->
    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/bootstrap-icons-1.13.1/bootstrap-icons.css') ?>" rel="stylesheet">

    <style>
        body {
            margin: 0;
            min-height: 100vh;
            background: linear-gradient(135deg, #6a5af9, #3b82f6);
            font-family: 'Segoe UI', sans-serif;
        }

        .login-wrapper {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 30px;
        }

        .login-card {
            width: 950px;
            border: none;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 15px 40px rgba(0,0,0,0.12);
            background: #fff;
        }

        .left-panel {
            padding: 50px;
            background: #ffffff;
        }

        .right-panel {
            background: #f8faff;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 30px;
        }

        .right-panel img {
            max-width: 85%;
            height: auto;
        }

        .logo-title {
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 5px;
        }

        .sub-text {
            color: #6b7280;
            font-size: 14px;
            margin-bottom: 30px;
        }

        .form-label {
            font-weight: 600;
            font-size: 14px;
            margin-bottom: 6px;
        }

        .form-control {
            height: 48px;
            border-radius: 12px;
            border: 1px solid #dbe2ea;
            padding-left: 15px;
        }

        .form-control:focus {
            box-shadow: none;
            border-color: #6a5af9;
        }

        .btn-login {
            height: 48px;
            border: none;
            border-radius: 12px;
            background: linear-gradient(135deg, #6a5af9, #3b82f6);
            font-weight: 600;
            color: white;
        }

        .btn-login:hover {
            opacity: 0.95;
        }

        .register-box {
            margin-top: 25px;
            text-align: center;
        }

        .register-box a {
            text-decoration: none;
            font-weight: 600;
            color: #3b82f6;
        }

        .restore-btn {
            margin-top: 15px;
        }

        @media (max-width: 768px) {
            .right-panel {
                display: none;
            }

            .left-panel {
                padding: 35px;
            }

            .login-card {
                width: 100%;
            }
        }
    </style>
</head>

<body>

<div class="login-wrapper">

    <div class="card login-card">
        <div class="row g-0">

            <!-- LEFT SIDE -->
            <div class="col-md-6 left-panel">

                <h3 class="logo-title">Selamat Datang 👋</h3>
                <p class="sub-text">
                    Silakan login untuk melanjutkan ke sistem SFACARD
                </p>

                <!-- ALERT -->
                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger rounded-3">
                        <?= session()->getFlashdata('error') ?>
                    </div>
                <?php endif; ?>

                <?php if (session()->getFlashdata('salahpw')): ?>
                    <div class="alert alert-danger rounded-3">
                        <?= session()->getFlashdata('salahpw') ?>
                    </div>
                <?php endif; ?>

                <!-- FORM -->
                <form action="<?= base_url('/proses-login') ?>" method="post">

                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input 
                            type="text" 
                            name="username" 
                            class="form-control"
                            placeholder="Masukkan username"
                            required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Password</label>
                        <input 
                            type="password" 
                            name="password" 
                            class="form-control"
                            placeholder="Masukkan password"
                            required>
                    </div>

                    <button type="submit" class="btn btn-login w-100">
                        <i class="bi bi-box-arrow-in-right"></i> Login
                    </button>

                </form>

                <!-- REGISTER -->
                <div class="register-box">
                    <small class="text-muted">
                        Belum punya akun?
                    </small><br>

                    <a href="<?= base_url('users/create') ?>">
                        Register Sekarang
                    </a>

                    <div class="restore-btn">
                        <a href="<?= base_url('restore') ?>" 
                           class="btn btn-outline-danger btn-sm">
                            <i class="bi bi-database"></i> Restore Database
                        </a>
                    </div>
                </div>

            </div>

            <!-- RIGHT SIDE -->
            <div class="col-md-6 right-panel">
                <img 
                    src="<?= base_url('uploads/login/login.png') ?>" 
                    alt="Login Illustration">
            </div>

        </div>
    </div>

</div>

<script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
</body>
</html>