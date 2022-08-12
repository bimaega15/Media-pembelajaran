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
                            <form action="<?= base_url('Admin/Petunjuk/process') ?>" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="id_petunjuk" value="<?= $row->id_petunjuk; ?>">
                                <div class="form-group">
                                    <label for="">Judul petunjuk</label>
                                    <input type="text" name="judul_petunjuk" class="form-control  <?= form_error('judul_petunjuk') != null ? 'border border-danger' : '' ?>" placeholder="Keterangan petunjuk" value="<?= $row->judul_petunjuk != null ? $row->judul_petunjuk : set_value('judul_petunjuk') ?>">
                                    <?= form_error('judul_petunjuk') ?>
                                </div>
                                <div class="form-group">
                                    <label for="">Keterangan</label>
                                    <textarea name="keterangan" id="keterangan" class="form-control  <?= form_error('keterangan') != null ? 'border border-danger' : '' ?>" placeholder="Keterangan">
                                    <?= $row->keterangan != null ? $row->keterangan : set_value('keterangan') ?>
                                    </textarea>
                                    <?= form_error('keterangan') ?>
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

        var editor = CKEDITOR.replace('keterangan');
        CKFinder.setupCKEditor(editor);

        var pane = $('#keterangan');
        pane.val($.trim(pane.val()).replace(/\s*[\r\n]+\s*/g, '\n')
            .replace(/(<[^\/][^>]*>)\s*/g, '$1')
            .replace(/\s*(<\/[^>]+>)/g, '$1'));

    })
</script>