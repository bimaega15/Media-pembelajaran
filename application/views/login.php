<?php

$konfigurasi = check_konfigurasi();
?>

<div class="login-box">
    <!-- <div class="login-logo">
        <a href="<?= base_url('Login') ?>"></a>
    </div> -->
    <div style="text-align: center;">
        <img src="<?= base_url('public/image/konfigurasi/' . $konfigurasi->gambar_konfigurasi) ?>" width="150px;">
    </div>
    <!-- /.login-logo -->
    <div class="card mt-3">
        <?php $this->view('session'); ?>
        <div class="card-body login-card-body">
            <p class="login-box-msg"><?= $title; ?></p>
            <form action="<?= base_url('Login/process/') ?>" method="post">
                <div class="input-group">
                    <input name="username" type="text" class="form-control <?= form_error('username') != null ? 'border border-danger' : '' ?>" placeholder="Username" value="<?= set_value('username') ?>">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user-lock"></span>
                        </div>
                    </div>
                </div>
                <?= form_error('username') ?>
                <div class="mb-3"></div>
                <div class="input-group">
                    <input type="password" name="password" class="form-control <?= form_error('password') != null ? 'border border-danger' : '' ?>" placeholder="Password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <?= form_error('password') ?>
                <div class="mb-3"></div>
                <div class="row">
                    <div class="col-8">
                        <div class="icheck-primary">
                            <input name="remember" type="checkbox" id="remember" value="true">
                            <label for="remember">
                                Remember Me
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

        </div>
        <!-- /.login-card-body -->
    </div>
    <p class="mb-0 text-center mt-3">
        <a href="<?= base_url('Register') ?>" class="text-center btn btn-primary w-100">Pendaftaran Siswa</a>
    </p><br>
    <!-- <?php echo $this->session->flashdata('msg'); ?> -->
</div>

</div>
<!-- /.login-box -->