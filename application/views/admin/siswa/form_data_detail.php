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
                            <a href="<?= base_url('Admin/Siswa') ?>" class="btn btn-warning"><i class="fas fa-backward"></i> Kembali</a>
                            <br><br>
                            <form action="<?= base_url('Admin/Siswa/process') ?>" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="id_users" value="<?= $row->id_users; ?>">
                                <input type="hidden" name="password_old" value="<?= $row->password; ?>">

                                <h4>Data pribadi</h4>
                                <hr>
                                <!-- <div class="form-group">
                                    <label for="">Username</label>
                                    <input type="text" name="username" class="form-control  <?= form_error('username') != null ? 'border border-danger' : '' ?>" placeholder="Username" value="<?= $row->username != null ? $row->username : set_value('username') ?>" <?= $page == 'edit' ? 'readonly' : '' ?> readonly>
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
                                </div> -->

                                <div class="form-group">
                                    <label for="">Gambar</label> <br>
                                    <!-- <input type="file" name="gambar_profile" class="form-control"> -->
                                    <?php
                                    if ($row->gambar_profile != null) { ?>
                                        <a href="<?= base_url('image/users/' . $row->gambar_profile) ?>" target="_blank">
                                            <img src="<?= base_url('public/image/users/' . $row->gambar_profile) ?>" alt="" class="w-25" width="50 px" height="300 px">
                                        </a>

                                    <?php
                                    }
                                    ?>
                                </div>
                                <div class="form-group">
                                    <label for="">No. Induk</label>
                                    <input type="text" name="nomor_induk" class="form-control  <?= form_error('nomor_induk') != null ? 'border border-danger' : '' ?>" placeholder="Nomor induk" value="<?= $row->nomor_induk != null ? $row->nomor_induk : set_value('nomor_induk') ?>" readonly>
                                    <?= form_error('nomor_induk') ?>
                                </div>
                                <div class="form-group">
                                    <label for="">Nama</label>
                                    <input type="text" name="nama_profile" class="form-control  <?= form_error('nama_profile') != null ? 'border border-danger' : '' ?>" placeholder="Nama" value="<?= $row->nama_profile != null ? $row->nama_profile : set_value('nama_profile') ?>" readonly>
                                    <?= form_error('nama_profile') ?>
                                </div>
                                <div class="form-group">
                                    <label for="">Jenis kelamin</label> <br>
                                    <?php
                                    $jenis_kelamin = $row->jenis_kelamin != null ? $row->jenis_kelamin : set_value('jenis_kelamin');
                                    ?>
                                    <?= $jenis_kelamin == 'L' ? 'Laki laki' : 'Perempuan'; ?>
                                    <!-- <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="jenis_kelamin" id="p" value="P" <?= $jenis_kelamin == 'P' ? 'checked' : '' ?>>
                                        <label class="form-check-label" for="p">Perempuan</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="jenis_kelamin" id="l" value="L" <?= $jenis_kelamin == 'L' ? 'checked' : '' ?>>
                                        <label class="form-check-label" for="l">Laki laki</label>
                                    </div> -->
                                </div>
                                <!-- <div class="form-group">
                                    <label for="">Agama</label> <br>
                                    <?php
                                    $agama_id = $row->agama_id != null ? $row->agama_id : set_value('agama_id');
                                    ?>
                                    <select name="agama_id" class="form-control <?= form_error('agama_id') != null ? 'border border-danger' : '' ?>" readonly>
                                        <option value="">-- Agama ibu --</option>
                                        <?php foreach ($agama as $r_agama_id) : ?>
                                            <option value="<?= $r_agama_id->id_agama ?>" <?= $agama_id == $r_agama_id->id_agama ? 'selected' : '' ?>><?= $r_agama_id->nama_agama; ?></option>

                                        <?php endforeach; ?>
                                    </select>
                                    <?= form_error('agama_id') ?>
                                </div> -->
                                <div class="form-group">
                                    <label for="">Jurusan</label> <br>
                                    <?php
                                    $jurusan_id = $row->jurusan_id != null ? $row->jurusan_id : set_value('jurusan_id');
                                    ?>
                                    <select name="jurusan_id" class="form-control <?= form_error('jurusan_id') != null ? 'border border-danger' : '' ?>" readonly>
                                        <option value="" selected disabled>-- Jurusan --</option>
                                        <?php foreach ($jurusan as $r_jurusan_id) : ?>
                                            <option value="<?= $r_jurusan_id->id_jurusan ?>" <?= $jurusan_id == $r_jurusan_id->id_jurusan ? 'selected' : '' ?>><?= $r_jurusan_id->nama_jurusan; ?></option>

                                        <?php endforeach; ?>
                                    </select>
                                    <?= form_error('jurusan_id') ?>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="">No. handphone</label>
                                            <input type="number" name="no_hp" class="form-control  <?= form_error('no_hp') != null ? 'border border-danger' : '' ?>" placeholder="No. Handphone" value="<?= $row->no_hp != null ? $row->no_hp : set_value('no_hp') ?>" readonly>
                                            <?= form_error('no_hp') ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="">Alamat</label>
                                            <textarea id="alamat" name="alamat" class="form-control  <?= form_error('alamat') != null ? 'border border-danger' : '' ?>" placeholder="Alamat" readonly>
                                            <?= $row->alamat != null ? $row->alamat : set_value('alamat') ?>
                                            </textarea>
                                            <?= form_error('alamat') ?>
                                        </div>
                                    </div>
                                </div>



                                <h4>Data Ayah</h4>
                                <hr>
                                <div class="form-group">
                                    <label for="">Nama Ayah</label>
                                    <input type="text" name="nama_ayah" class="form-control  <?= form_error('nama_ayah') != null ? 'border border-danger' : '' ?>" placeholder="Nama ayah" value="<?= $row->nama_ayah != null ? $row->nama_ayah : set_value('nama_ayah') ?>" readonly>
                                    <?= form_error('nama_ayah') ?>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="">No. HP Ayah</label>
                                            <input type="text" name="no_hp_ayah" class="form-control  <?= form_error('no_hp_ayah') != null ? 'border border-danger' : '' ?>" placeholder="Nomor HP ayah" value="<?= $row->no_hp_ayah != null ? $row->no_hp_ayah : set_value('no_hp_ayah') ?>" readonly>
                                            <?= form_error('no_hp_ayah') ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="">Alamat ayah</label>
                                            <textarea name="alamat_ayah" id="alamat_ayah" class="form-control  <?= form_error('alamat_ayah') != null ? 'border border-danger' : '' ?>" placeholder="Alamat ayah" readonly>
                                    <?= $row->alamat_ayah != null ? $row->alamat_ayah : set_value('alamat_ayah') ?>
                                    </textarea>
                                            <?= form_error('alamat_ayah') ?>
                                        </div>
                                    </div>
                                </div>

                                <h4>Data Ibu</h4>
                                <hr>
                                <div class="form-group">
                                    <label for="">Nama ibu</label>
                                    <input type="text" name="nama_ibu" class="form-control  <?= form_error('nama_ibu') != null ? 'border border-danger' : '' ?>" placeholder="Nama ibu" value="<?= $row->nama_ibu != null ? $row->nama_ibu : set_value('nama_ibu') ?>" readonly>
                                    <?= form_error('nama_ibu') ?>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="">No. HP ibu</label>
                                            <input type="text" name="no_hp_ibu" class="form-control  <?= form_error('no_hp_ibu') != null ? 'border border-danger' : '' ?>" placeholder="Nomor HP ibu" value="<?= $row->no_hp_ibu != null ? $row->no_hp_ibu : set_value('no_hp_ibu') ?>" readonly>
                                            <?= form_error('no_hp_ibu') ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="">Alamat ibu</label>
                                            <textarea name="alamat_ibu" id="alamat_ibu" class="form-control  <?= form_error('alamat_ibu') != null ? 'border border-danger' : '' ?>" placeholder="Alamat ibu" readonly>
                                    <?= $row->alamat_ibu != null ? $row->alamat_ibu : set_value('alamat_ibu') ?>
                                    </textarea>
                                            <?= form_error('alamat_ibu') ?>
                                        </div>
                                    </div>
                                </div>



                                <!-- <div class="form-group">
                                    <button type="reset" class="btn btn-danger"><i class="fas fa-undo"></i> Reset</button>
                                    <button name="<?= $page; ?>" type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Submit</button>
                                </div> -->
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