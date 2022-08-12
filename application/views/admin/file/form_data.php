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
                            <form action="<?= base_url('Admin/File/process?materi_id=' . $materi_id) ?>" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="id_file" value="<?= $row->id_file; ?>">
                                <input type="hidden" name="materi_id" value="<?= $materi_id; ?>">
                                <div class="form-group">
                                    <label for="">Judul File</label>
                                    <input type="text" name="judul_file" class="form-control  <?= form_error('judul_file') != null ? 'border border-danger' : '' ?>" placeholder="Judul File" value="<?= $row->judul_file != null ? $row->judul_file : set_value('judul_file') ?>">
                                    <?= form_error('judul_file') ?>
                                </div>

                                <div class="form-group">
                                    <label for="">File Materi</label>
                                    <input type="file" name="lampiran_file" class="form-control">
                                    <?= form_error('lampiran_file') ?>
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
        var pane = $('#keterangan');
        pane.val($.trim(pane.val()).replace(/\s*[\r\n]+\s*/g, '\n')
            .replace(/(<[^\/][^>]*>)\s*/g, '$1')
            .replace(/\s*(<\/[^>]+>)/g, '$1'));

    })
</script>