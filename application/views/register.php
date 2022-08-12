<?php ?>
<style>
    * {
        margin: 0;
        padding: 0
    }

    html {
        height: 100%
    }

    #grad1 {
        background-color: #e9ecef;
        /* background-image: linear-gradient(120deg, #FF4081, #81D4FA) */
    }

    #msform {
        text-align: center;
        position: relative;
        margin-top: 20px
    }

    #msform fieldset .form-card {
        background: white;
        border: 0 none;
        border-radius: 0px;
        box-shadow: 0 2px 2px 2px rgba(0, 0, 0, 0.2);
        padding: 20px 40px 30px 40px;
        box-sizing: border-box;
        width: 94%;
        margin: 0 3% 20px 3%;
        position: relative
    }

    #msform fieldset {
        background: white;
        border: 0 none;
        border-radius: 0.5rem;
        box-sizing: border-box;
        width: 100%;
        margin: 0;
        padding-bottom: 20px;
        position: relative
    }

    #msform fieldset:not(:first-of-type) {
        display: none
    }

    #msform fieldset .form-card {
        text-align: left;
        color: #9E9E9E
    }

    #msform input,
    #msform textarea {
        padding: 0px 8px 4px 8px;
        border: none;
        border-bottom: 1px solid #ccc;
        border-radius: 0px;
        margin-bottom: 25px;
        margin-top: 2px;
        width: 100%;
        box-sizing: border-box;
        font-family: montserrat;
        color: #2C3E50;
        font-size: 16px;
        letter-spacing: 1px
    }

    #msform input:focus,
    #msform textarea:focus {
        -moz-box-shadow: none !important;
        -webkit-box-shadow: none !important;
        box-shadow: none !important;
        border: none;
        font-weight: bold;
        border-bottom: 2px solid skyblue;
        outline-width: 0
    }

    select.list-dt {
        border: none;
        outline: 0;
        border-bottom: 1px solid #ccc;
        padding: 2px 5px 3px 5px;
        margin: 2px
    }

    select.list-dt:focus {
        border-bottom: 2px solid skyblue
    }

    .card {
        z-index: 0;
        border: none;
        border-radius: 0.5rem;
        position: relative
    }

    .fs-title {
        font-size: 23px;
        color: #1C1F21;
        margin-bottom: 10px;
        font-weight: bold;
        text-align: left
    }

    #progressbar {
        margin-bottom: 30px;
        overflow: hidden;
        color: lightgrey;
        display: flex;
        justify-content: center;
    }

    #progressbar .active {
        color: #000000
    }

    #progressbar li {
        list-style-type: none;
        font-size: 12px;
        width: 33.3%;
        float: left;
        position: relative
    }

    #progressbar #account:before {
        font-family: FontAwesome;
        content: "\f023"
    }

    #progressbar #personal:before {
        font-family: FontAwesome;
        content: "\f007"
    }

    #progressbar #payment:before {
        font-family: FontAwesome;
        content: "\f09d"
    }

    #progressbar #confirm:before {
        font-family: FontAwesome;
        content: "\f00c"
    }

    #progressbar li:before {
        width: 50px;
        height: 50px;
        line-height: 45px;
        display: block;
        font-size: 18px;
        color: #ffffff;
        background: lightgray;
        border-radius: 50%;
        margin: 0 auto 10px auto;
        padding: 2px
    }

    #progressbar li:after {
        content: '';
        width: 100%;
        height: 2px;
        background: lightgray;
        position: absolute;
        left: 0;
        top: 25px;
        z-index: -1
    }

    #progressbar li.active:before,
    #progressbar li.active:after {
        background: skyblue
    }

    .radio-group {
        position: relative;
        margin-bottom: 25px
    }

    .radio {
        display: inline-block;
        width: 204;
        height: 104;
        border-radius: 0;
        background: lightblue;
        box-shadow: 0 2px 2px 2px rgba(0, 0, 0, 0.2);
        box-sizing: border-box;
        cursor: pointer;
        margin: 8px 2px
    }

    .radio:hover {
        box-shadow: 2px 2px 2px 2px rgba(0, 0, 0, 0.3)
    }

    .radio.selected {
        box-shadow: 1px 1px 2px 2px rgba(0, 0, 0, 0.1)
    }

    .fit-image {
        width: 100%;
        object-fit: cover
    }
</style>
<style>
    .password {
        position: relative;
    }

    .password .password_1,
    .password_2 {
        position: absolute;
        bottom: 25px;
        right: 25px;
        cursor: pointer;
    }
</style>
<div class="login-box w-75">
    <!--<div class="login-logo">
        <a href="<?= base_url('Login') ?>">SIAKAD SMK MADYA DEPOK</a>
    </div>
     /.login-logo -->
    <div class="card card-primary">
        <?php $this->view('session'); ?>

        <div class="card-header">
            <h3 class="card-title">Pendaftaran Siswa</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="<?= base_url('Register/process') ?>" method="post" enctype="multipart/form-data">
            <div class="card-body">

                <input type="hidden" name="id_users" value="<?= $row->id_users; ?>">
                <input type="hidden" name="password_old" value="<?= $row->password; ?>">
                <div class="form-group">
                    <label for="">Username</label>
                    <input type="text" name="username" class="form-control  <?= form_error('username') != null ? 'border border-danger' : '' ?>" placeholder="Username" value="<?= $row->username != null ? $row->username : set_value('username') ?>" <?= $page == 'edit' ? 'readonly' : '' ?>>
                    <?= form_error('username') ?>
                </div>
                <div class="row password">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="password" name="password" class="form-control  <?= form_error('password') != null ? 'border border-danger' : '' ?>" placeholder="Password">
                            <i class="fas fa-eye password_1"></i>
                        </div>

                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="">Confirm Password</label>
                            <input type="password" name="confirm_password" class="form-control  <?= form_error('confirm_password') != null ? 'border border-danger' : '' ?>" placeholder="Confirm password">
                            <i class="fas fa-eye password_2"></i>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <?= form_error('password') ?>
                    </div>
                    <div class="col-lg-6">
                        <?= form_error('confirm_password') ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="">No. Induk</label>
                    <input type="number" name="nomor_induk" class="form-control  <?= form_error('nomor_induk') != null ? 'border border-danger' : '' ?>" placeholder="Nomor induk" value="<?= $row->nomor_induk != null ? $row->nomor_induk : set_value('nomor_induk') ?>">
                    <?= form_error('nomor_induk') ?>
                </div>
                <div class="form-group">
                    <label for="">Nama</label>
                    <input type="text" name="nama_profile" class="form-control  <?= form_error('nama_profile') != null ? 'border border-danger' : '' ?>" placeholder="Nama" value="<?= $row->nama_profile != null ? $row->nama_profile : set_value('nama_profile') ?>">
                    <?= form_error('nama_profile') ?>
                </div>
                <div class="form-group">
                    <label for="">Jenis kelamin</label> <br>
                    <?php
                    $jenis_kelamin = $row->jenis_kelamin != null ? $row->jenis_kelamin : set_value('jenis_kelamin');
                    ?>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="jenis_kelamin" id="p" value="P" <?= $jenis_kelamin == 'P' ? 'checked' : '' ?>>
                        <label class="form-check-label" for="p">Perempuan</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="jenis_kelamin" id="l" value="L" <?= $jenis_kelamin == 'L' ? 'checked' : '' ?>>
                        <label class="form-check-label" for="l">Laki laki</label>
                    </div>
                </div>
                <!-- <div class="form-group">
                                    <label for="">Agama</label> <br>
                                    <?php
                                    $agama_id = $row->agama_id != null ? $row->agama_id : set_value('agama_id');
                                    ?>
                                    <select name="agama_id" class="form-control <?= form_error('agama_id') != null ? 'border border-danger' : '' ?>">
                                        <option value="">-- Agama --</option>
                                        <?php foreach ($agama as $r_agama) : ?>
                                            <option value="<?= $r_agama->id_agama ?>" <?= $agama_id == $r_agama->id_agama ? 'selected' : '' ?>><?= $r_agama->nama_agama; ?></option>

                                        <?php endforeach; ?>
                                    </select>
                                    <?= form_error('agama_id') ?>
                                </div> -->
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="">No. handphone</label>
                            <input type="number" name="no_hp" class="form-control  <?= form_error('no_hp') != null ? 'border border-danger' : '' ?>" placeholder="No. Handphone" value="<?= $row->no_hp != null ? $row->no_hp : set_value('no_hp') ?>">
                            <?= form_error('no_hp') ?>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="">Alamat</label>
                            <textarea id="alamat" name="alamat" class="form-control  <?= form_error('alamat') != null ? 'border border-danger' : '' ?>" placeholder="Alamat">
                                            <?= $row->alamat != null ? $row->alamat : set_value('alamat') ?>
                                            </textarea>
                            <?= form_error('alamat') ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Foto Profil</label>
                    <input type="file" name="gambar_profile" class="form-control">
                    <?= form_error('gambar_profile') ?>

                    <?php
                    if ($row->gambar_profile != null) { ?>
                        <a href="<?= base_url('image/users/' . $row->gambar_profile) ?>" target="_blank">
                            <img src="<?= base_url('public/image/users/' . $row->gambar_profile) ?>" alt="" class="w-25">
                        </a>

                    <?php
                    }
                    ?>
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane"></i> Submit</button>
                    <a href="<?= base_url('Login') ?>" class="text-info">
                        Sudah punya account ?
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- /.login-box -->
<script src="<?= base_url('assets/') ?>plugins/jquery/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        var pane = $('#alamat');
        pane.val($.trim(pane.val()).replace(/\s*[\r\n]+\s*/g, '\n')
            .replace(/(<[^\/][^>]*>)\s*/g, '$1')
            .replace(/\s*(<\/[^>]+>)/g, '$1'));
        $(document).on('click', '.password_1', function() {
            const type = $('input[name="password"]').attr('type');
            if (type == 'password') {
                $('.password_1').attr('class', 'fas fa-eye-slash password_1');
                $('input[name="password"]').attr('type', 'text')
            } else {
                $('.password_1').attr('class', 'fas fa-eye password_1');
                $('input[name="password"]').attr('type', 'password')
            }
        })
        $(document).on('click', '.password_2', function() {
            const type = $('input[name="confirm_password"]').attr('type');
            if (type == 'password') {
                $('.password_2').attr('class', 'fas fa-eye-slash password_2');
                $('input[name="confirm_password"]').attr('type', 'text')
            } else {
                $('.password_2').attr('class', 'fas fa-eye password_2');
                $('input[name="confirm_password"]').attr('type', 'password')
            }
        })
    });
</script>