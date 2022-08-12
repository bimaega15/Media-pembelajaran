<?php
$profile = check_profile();
?>
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
                <?php $this->view('session'); ?>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form action="<?= base_url('Admin/Konfigurasi/process') ?>" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="id_konfigurasi" value="<?= $row->id_konfigurasi; ?>">
                                <div class="form-group">
                                    <label for="">Nama aplikasi</label>
                                    <input type="text" name="nama_aplikasi" class="form-control  <?= form_error('nama_aplikasi') != null ? 'border border-danger' : '' ?>" placeholder="Kode kelas" value="<?= $row->nama_aplikasi != null ? $row->nama_aplikasi : set_value('nama_aplikasi') ?>">
                                    <?= form_error('nama_aplikasi') ?>
                                </div>
                                <div class="form-group">
                                    <label for="">Keterangan</label>
                                    <textarea name="keterangan" id="keterangan" class="form-control  <?= form_error('keterangan') != null ? 'border border-danger' : '' ?>" placeholder="Keterangan">
                                    <?= $row->keterangan != null ? $row->keterangan : set_value('keterangan') ?>
                                    </textarea>
                                    <?= form_error('keterangan') ?>
                                </div>
                                <div class="form-group">
                                    <label for="">Created By</label>
                                    <input type="text" name="created_by" class="form-control  <?= form_error('created_by') != null ? 'border border-danger' : '' ?>" placeholder="Created By" value="<?= $row->created_by != null ? $row->created_by : set_value('created_by') ?>">
                                    <?= form_error('created_by') ?>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="">Facebook</label>
                                            <input type="text" name="facebook" class="form-control  <?= form_error('facebook') != null ? 'border border-danger' : '' ?>" placeholder="Created By" value="<?= $row->facebook != null ? $row->facebook : set_value('facebook') ?>">
                                            <?= form_error('facebook') ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="">Instagram</label>
                                            <input type="text" name="instagram" class="form-control  <?= form_error('instagram') != null ? 'border border-danger' : '' ?>" placeholder="Created By" value="<?= $row->instagram != null ? $row->instagram : set_value('instagram') ?>">
                                            <?= form_error('instagram') ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="">Youtube</label>
                                            <input type="text" name="youtube" class="form-control  <?= form_error('youtube') != null ? 'border border-danger' : '' ?>" placeholder="Created By" value="<?= $row->youtube != null ? $row->youtube : set_value('youtube') ?>">
                                            <?= form_error('youtube') ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="">Alamat</label>
                                            <textarea id="alamat" name="alamat" class="form-control  <?= form_error('alamat') != null ? 'border border-danger' : '' ?>" placeholder="Alamat">
                                    <?= $row->alamat != null ? $row->alamat : set_value('alamat') ?>
                                    </textarea>
                                            <?= form_error('alamat') ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="">No. Handphone</label>
                                            <input type="number" name="no_hp" class="form-control  <?= form_error('no_hp') != null ? 'border border-danger' : '' ?>" placeholder="Created By" value="<?= $row->no_hp != null ? $row->no_hp : set_value('no_hp') ?>">
                                            <?= form_error('no_hp') ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Gambar Aplikasi</label>
                                    <input type="file" name="gambar_konfigurasi" class="form-control">
                                    <?php if ($row->gambar_konfigurasi != null) : ?>
                                        <a href="<?= base_url('public/image/konfigurasi/' . $row->gambar_konfigurasi) ?>" target="_blank">
                                            <img src="<?= base_url('public/image/konfigurasi/' . $row->gambar_konfigurasi) ?>" class="w-25" alt="">
                                        </a>
                                    <?php endif; ?>
                                </div>
                                <div class="form-group">
                                    <button type="reset" class="btn btn-danger"> <i class="fas fa-undo"></i> Reset</button>
                                    <button name="<?= $page; ?>" type="submit" class="btn btn-primary"> <i class="fas fa-save"></i> Submit</button>
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
        var pane = $('#keterangan');
        pane.val($.trim(pane.val()).replace(/\s*[\r\n]+\s*/g, '\n')
            .replace(/(<[^\/][^>]*>)\s*/g, '$1')
            .replace(/\s*(<\/[^>]+>)/g, '$1'));

    })
</script>