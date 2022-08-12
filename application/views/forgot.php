<?php

$konfigurasi = check_konfigurasi();
?>

<div class="login-box">
    <div class="login-logo">
        <a href="<?= base_url('Login') ?>"><?= $konfigurasi->nama_aplikasi; ?></a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
        <?php $this->view('session'); ?>
        <div class="card-body login-card-body">
            <p class="login-box-msg"><?= $title ?></p>

            <form action="<?= base_url('Forgot/process/') ?>" method="post">
                <div class="input-group">
                    <input name="username" type="text" class="form-control <?= form_error('username') != null ? 'border border-danger' : '' ?>" placeholder="Username">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user-lock"></span>
                        </div>
                    </div>
                </div>
                <?= form_error('username') ?>
                <div class="mb-3"></div>

                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block">Reset Password</button>
                    </div>
                </div>
            </form>

            <!-- <div class="social-auth-links text-center mb-3">
                    <p>- OR -</p>
                    <a href="#" class="btn btn-block btn-primary">
                        <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
                    </a>
                    <a href="#" class="btn btn-block btn-danger">
                        <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
                    </a>
                </div> -->
            <!-- /.social-auth-links -->

            <div class="d-flex justify-content-between mt-2">
                <a href="<?= base_url('Login') ?>">Login</a>
                <!-- <a href="<?= base_url('Register') ?>">Register</a> -->
            </div>
            <!-- <p class="mb-0">
                <a href="register.html" class="text-center">Register a new membership</a>
            </p> -->
        </div>
        <!-- /.login-card-body -->
    </div>
    <p class="mb-0 text-center mt-3">
        <a href="<?= base_url('Register') ?>" class="text-center btn btn-primary w-100">Pendaftaran Siswa</a>
    </p>
</div>
<!-- /.login-box -->