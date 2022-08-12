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
                            <a href="<?= base_url('Admin/Materi') ?>" class="btn btn-warning"><i class="fas fa-backward"></i> Kembali</a>
                            <br><br>
                            <form action="<?= base_url('Admin/Materi/process') ?>" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="id_materi" value="<?= $row->id_materi; ?>">

                                <div class="form-group">
                                    <label for="">Judul Materi</label>
                                    <input type="text" name="judul_materi" class="form-control  <?= form_error('judul_materi') != null ? 'border border-danger' : '' ?>" placeholder="Judul Materi" value="<?= $row->judul_materi != null ? $row->judul_materi : set_value('judul_materi') ?>">
                                    <?= form_error('judul_materi') ?>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="">Guru Mengajar</label>
                                            <?php
                                            $users_id = $row->users_id != null ? $row->users_id : set_value('users_id');
                                            ?>
                                            <select name="users_id" class="form-control select2  <?= form_error('users_id') != null ? 'border border-danger' : '' ?>">
                                                <option value="">-- Pilih Guru --</option>
                                                <?php foreach ($users as $key => $r_users) { ?>
                                                    <option value="<?= $r_users->id_users; ?>" <?= $users_id == $r_users->id_users ? 'selected' : '' ?>><?= $r_users->nomor_induk; ?> | <?= $r_users->nama_profile; ?></option>
                                                <?php } ?>
                                            </select>
                                            <?= form_error('users_id') ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="">Jadwal</label>
                                            <?php
                                            $jadwal_id = $row->jadwal_id != null ? $row->jadwal_id : set_value('jadwal_id');
                                            ?>
                                            <select name="jadwal_id" class="form-control select2  <?= form_error('jadwal_id') != null ? 'border border-danger' : '' ?>">
                                                <option value="">-- Pilih Jadwal --</option>
                                                <?php foreach ($jadwal as $key => $r_jadwal) { ?>
                                                    <option value="<?= $r_jadwal->id_jadwal; ?>" <?= $jadwal_id == $r_jadwal->id_jadwal ? 'selected' : '' ?>><?= $r_jadwal->hari; ?> | <?= time_show($r_jadwal->dari_waktu); ?> - <?= time_show($r_jadwal->sampai_waktu); ?></option>
                                                <?php  } ?>
                                            </select>
                                            <?= form_error('jadwal_id') ?>
                                        </div>
                                    </div>
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