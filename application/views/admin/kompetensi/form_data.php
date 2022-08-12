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
                            <a href="<?= base_url('Admin/Kompetensi') ?>" class="btn btn-warning"><i class="fas fa-backward"></i> Kembali</a>
                            <br><br>
                            <form action="<?= base_url('Admin/Kompetensi/process') ?>" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="id_kompetensi" value="<?= $row->id_kompetensi; ?>">

                                <div class="form-group">
                                    <label for="">Judul kompetensi</label>
                                    <input type="text" name="judul_kompetensi" class="form-control  <?= form_error('judul_kompetensi') != null ? 'border border-danger' : '' ?>" placeholder="Judul kompetensi" value="<?= $row->judul_kompetensi != null ? $row->judul_kompetensi : set_value('judul_kompetensi') ?>">
                                    <?= form_error('judul_kompetensi') ?>
                                </div>

                                <div class="form-group">
                                    <label for="">Keterangan</label>
                                    <textarea id="editor" name="keterangan_kompetensi" class="form-control  <?= form_error('keterangan_kompetensi') != null ? 'border border-danger' : '' ?>" placeholder="Keterangan">
                                        <?= $row->keterangan_kompetensi != null ? $row->keterangan_kompetensi : set_value('keterangan_kompetensi') ?>    
                                    </textarea>
                                    <?= form_error('keterangan_kompetensi') ?>
                                </div>

                                <div class="form-group">
                                    <label for="">File RPP</label>
                                    <input type="file" name="file_kompetensi" class="form-control  <?= form_error('file_kompetensi') != null ? 'border border-danger' : '' ?>">
                                    <?= form_error('file_kompetensi') ?>
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
<script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>
<script>
    $(document).ready(function() {
        var pane = $('#keterangan');
        pane.val($.trim(pane.val()).replace(/\s*[\r\n]+\s*/g, '\n')
            .replace(/(<[^\/][^>]*>)\s*/g, '$1')
            .replace(/\s*(<\/[^>]+>)/g, '$1'));

        var editor = CKEDITOR.replace('editor');
        CKFinder.setupCKEditor(editor);
    })
</script>