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
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><?= $title; ?></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <?= $breadcrumb; ?>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <a href="<?= base_url('Admin/Users') ?>" class="btn btn-warning"><i class="fas fa-backward"></i> Kembali</a>
                            <br><br>
                            <form action="<?= base_url('Admin/Users/process') ?>" method="post" enctype="multipart/form-data">
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
                                    <input type="text" name="nomor_induk" class="form-control  <?= form_error('nomor_induk') != null ? 'border border-danger' : '' ?>" placeholder="Nomor induk" value="<?= $row->nomor_induk != null ? $row->nomor_induk : set_value('nomor_induk') ?>">
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
                                <?php
                                $level = $row->level != null ? $row->level : set_value('level');
                                ?>
                                <div class="form-group">
                                    <label for="">Level</label> <br>
                                    <select name="level" class="form-control <?= form_error('level') != null ? 'border border-danger' : '' ?>">
                                        <option value="">-- level --</option>
                                        <option value="admin" <?= $level == 'admin' ? 'selected' : '' ?>>Admin</option>
                                        <option value="guru" <?= $level == 'guru' ? 'selected' : '' ?>>Guru</option>
                                        <option value="siswa" <?= $level == 'siswa' ? 'selected' : '' ?>>Siswa</option>

                                    </select>
                                    <?= form_error('level') ?>
                                </div>
                                <div class="form-group">
                                    <button type="reset" class="btn btn-danger"><i class="fas fa-undo"></i> Reset</button>
                                    <button name="<?= $page; ?>" type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- /.content -->
</div>
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
    })
</script>