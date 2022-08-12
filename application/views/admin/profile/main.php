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

            <div class="row">
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header bg-info text-white"><i class="fas fa-user"></i> Profile</div>
                        <div class="card-body">
                            <a href="<?= base_url('public/image/users/' . $profile->gambar_profile) ?>" target="_blank">
                                <img src="<?= base_url('public/image/users/' . $profile->gambar_profile) ?>" alt="" style="height:250px; width:100%;">
                            </a>
                            <div class="table-responsive">
                                <table class="table">
                                    <tr>
                                        <td>No. Induk</td>
                                        <td>:</td>
                                        <td><?= $profile->nomor_induk ?></td>
                                    </tr>
                                    <tr>
                                        <td>Nama</td>
                                        <td>:</td>
                                        <td><?= $profile->nama_profile ?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card">
                        <?php $this->view('session'); ?>
                        <div class="card-header bg-info text-white"><i class="fas fa-pencil-alt"></i> My Profile</div>
                        <div class="card-body">
                            <form action="<?= base_url('Admin/Profile/process') ?>" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="id_users" value="<?= $profile->id_users; ?>">
                                <input type="hidden" name="password_old" value="<?= $profile->password; ?>">
                                <h4>Data pribadi</h4>
                                <hr>
                                <div class="form-group">
                                    <label for="">Username</label>
                                    <input type="text" name="username" class="form-control  <?= form_error('username') != null ? 'border border-danger' : '' ?>" placeholder="Username" value="<?= $profile->username != null ? $profile->username : set_value('username') ?>" readonly>
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
                                    <label for="">Nama</label>
                                    <input type="text" name="nama_profile" class="form-control  <?= form_error('nama_profile') != null ? 'border border-danger' : '' ?>" placeholder="Nama" value="<?= $profile->nama_profile != null ? $profile->nama_profile : set_value('nama_profile') ?>">
                                    <?= form_error('nama_profile') ?>
                                </div>
                                <div class="form-group">
                                    <label for="">Jenis kelamin</label> <br>
                                    <?php
                                    $jenis_kelamin = $profile->jenis_kelamin != null ? $profile->jenis_kelamin : set_value('jenis_kelamin');
                                    ?>
                                    <input type="hidden" name="jenis_kelamin" value="<?= $jenis_kelamin; ?>">
                                    <p><?= $profile->jenis_kelamin == 'L' ? 'Laki laki' : 'Perempuan' ?></p>

                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="">No. handphone</label>
                                            <input type="number" name="no_hp" class="form-control  <?= form_error('no_hp') != null ? 'border border-danger' : '' ?>" placeholder="No. Handphone" value="<?= $profile->no_hp != null ? $profile->no_hp : set_value('no_hp') ?>">
                                            <?= form_error('no_hp') ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="">Alamat</label>
                                            <textarea id="alamat" name="alamat" class="form-control  <?= form_error('alamat') != null ? 'border border-danger' : '' ?>" placeholder="Alamat">
                                            <?= $profile->alamat != null ? $profile->alamat : set_value('alamat') ?>
                                            </textarea>
                                            <?= form_error('alamat') ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">
                                        <?php if ($profile->level == 'siswa') : ?>
                                            NISN
                                        <?php endif; ?>
                                        <?php if ($profile->level != 'siswa') : ?>
                                            NIP
                                        <?php endif; ?>
                                    </label>
                                    <input type="text" name="nomor_induk" class="form-control  <?= form_error('nomor_induk') != null ? 'border border-danger' : '' ?>" placeholder="Nomor induk" value="<?= $profile->nomor_induk != null ? $profile->nomor_induk : set_value('nomor_induk') ?>" readonly>
                                    <?= form_error('nomor_induk') ?>
                                </div>
                                <div class="form-group">
                                    <label for="">Foto Profile</label>
                                    <input type="file" name="gambar_profile" class="form-control">
                                </div>
                                <!-- <div class="form-group">
                                    <label for="">Agama</label> <br>
                                    <?php
                                    $agama_id = $profile->agama_id != null ? $profile->agama_id : set_value('agama_id');
                                    ?>
                                    <select name="agama_id" class="form-control <?= form_error('agama_id') != null ? 'border border-danger' : '' ?>">
                                        <option value="">-- Agama --</option>
                                        <?php foreach ($agama as $r_agama_id) : ?>
                                            <option value="<?= $r_agama_id->id_agama ?>" <?= $agama_id == $r_agama_id->id_agama ? 'selected' : '' ?>><?= $r_agama_id->nama_agama; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <?= form_error('agama_id') ?>
                                </div> -->
                                <?php if ($profile->level == 'siswa') : ?>
                                    <h4>Data Ayah</h4>
                                    <hr>
                                    <div class="form-group">
                                        <label for="">Nama Ayah</label>
                                        <input type="text" name="nama_ayah" class="form-control  <?= form_error('nama_ayah') != null ? 'border border-danger' : '' ?>" placeholder="Nama ayah" value="<?= $profile->nama_ayah != null ? $profile->nama_ayah : set_value('nama_ayah') ?>">
                                        <?= form_error('nama_ayah') ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="">No. HP Ayah</label>
                                        <input type="text" name="no_hp_ayah" class="form-control  <?= form_error('no_hp_ayah') != null ? 'border border-danger' : '' ?>" placeholder="Nomor HP ayah" value="<?= $profile->no_hp_ayah != null ? $profile->no_hp_ayah : set_value('no_hp_ayah') ?>">
                                        <?= form_error('no_hp_ayah') ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Alamat ayah</label>
                                        <textarea name="alamat_ayah" id="alamat_ayah" class="form-control  <?= form_error('alamat_ayah') != null ? 'border border-danger' : '' ?>" placeholder="Alamat ayah">
                                    <?= $profile->alamat_ayah != null ? $profile->alamat_ayah : set_value('alamat_ayah') ?>
                                    </textarea>
                                        <?= form_error('alamat_ayah') ?>
                                    </div>
                                    <!-- <div class="form-group">
                                        <label for="">Agama</label> <br>
                                        <?php
                                        $agama_ayah = $profile->agama_ayah != null ? $profile->agama_ayah : set_value('agama_ayah');
                                        ?>
                                        <select name="agama_ayah" class="form-control <?= form_error('agama_ayah') != null ? 'border border-danger' : '' ?>">
                                            <option value="">-- Agama ayah --</option>
                                            <?php foreach ($agama as $r_agama_ayah) : ?>
                                                <option value="<?= $r_agama_ayah->id_agama ?>" <?= $agama_ayah == $r_agama_ayah->id_agama ? 'selected' : '' ?>><?= $r_agama_ayah->nama_agama; ?></option>

                                            <?php endforeach; ?>
                                        </select>
                                        <?= form_error('agama_ayah') ?>
                                    </div> -->

                                    <h4>Data Ibu</h4>
                                    <hr>
                                    <div class="form-group">
                                        <label for="">Nama ibu</label>
                                        <input type="text" name="nama_ibu" class="form-control  <?= form_error('nama_ibu') != null ? 'border border-danger' : '' ?>" placeholder="Nama ibu" value="<?= $profile->nama_ibu != null ? $profile->nama_ibu : set_value('nama_ibu') ?>">
                                        <?= form_error('nama_ibu') ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="">No. HP ibu</label>
                                        <input type="text" name="no_hp_ibu" class="form-control  <?= form_error('no_hp_ibu') != null ? 'border border-danger' : '' ?>" placeholder="Nomor HP ibu" value="<?= $profile->no_hp_ibu != null ? $profile->no_hp_ibu : set_value('no_hp_ibu') ?>">
                                        <?= form_error('no_hp_ibu') ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Alamat ibu</label>
                                        <textarea name="alamat_ibu" id="alamat_ibu" class="form-control  <?= form_error('alamat_ibu') != null ? 'border border-danger' : '' ?>" placeholder="Alamat ibu">
                                    <?= $profile->alamat_ibu != null ? $profile->alamat_ibu : set_value('alamat_ibu') ?>
                                    </textarea>
                                        <?= form_error('alamat_ibu') ?>
                                    </div>
                                    <!-- <div class="form-group">
                                        <label for="">Agama</label> <br>
                                        <?php
                                        $agama_ibu = $profile->agama_ibu != null ? $profile->agama_ibu : set_value('agama_ibu');
                                        ?>
                                        <select name="agama_ibu" class="form-control <?= form_error('agama_ibu') != null ? 'border border-danger' : '' ?>">
                                            <option value="">-- Agama ibu --</option>
                                            <?php foreach ($agama as $r_agama_ibu) : ?>
                                                <option value="<?= $r_agama_ibu->id_agama ?>" <?= $agama_ibu == $r_agama_ibu->id_agama ? 'selected' : '' ?>><?= $r_agama_ibu->nama_agama; ?></option>

                                            <?php endforeach; ?>
                                        </select>
                                        <?= form_error('agama_ibu') ?>
                                    </div> -->
                                <?php endif; ?>
                                <div class="form-group">
                                    <button type="reset" class="btn btn-danger"><i class="fas fa-undo"></i> Reset</button>
                                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Submit</button>
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
        var pane = $('#alamat_ayah');
        pane.val($.trim(pane.val()).replace(/\s*[\r\n]+\s*/g, '\n')
            .replace(/(<[^\/][^>]*>)\s*/g, '$1')
            .replace(/\s*(<\/[^>]+>)/g, '$1'));
        var pane = $('#alamat_ibu');
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