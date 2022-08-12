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
                            <form action="<?= base_url('Admin/Quiz/process?materi_id=' . $materi_id) ?>" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="id_quiz" value="<?= $row->id_quiz; ?>">
                                <input type="hidden" name="materi_id" value="<?= $materi_id; ?>">

                                <div class="form-group">
                                    <label for="">Judul Quiz</label>
                                    <input type="text" name="judul_quiz" class="form-control  <?= form_error('judul_quiz') != null ? 'border border-danger' : '' ?>" placeholder="Judul Quiz" value="<?= $row->judul_quiz != null ? $row->judul_quiz : set_value('judul_quiz') ?>">
                                    <?= form_error('judul_quiz') ?>
                                </div>
                                <div class="form-group">
                                    <label for="tipe_soal">Tipe Soal</label>
                                    <select name="tipe_soal" class="form-control <?= form_error('tipe_soal') != null ? 'border border-danger' : '' ?>">
                                        <option value="">-- Tipe Soal --</option>
                                        <option value="A-C" <?= $row->tipe_soal == 'A-C' ? 'selected' : set_value('tipe_soal') ?>>A - C</option>
                                        <option value="A-D" <?= $row->tipe_soal == 'A-D' ? 'selected' : set_value('tipe_soal') ?>>A - D</option>
                                        <option value="A-E" <?= $row->tipe_soal == 'A-E' ? 'selected' : set_value('tipe_soal') ?>>A - E</option>
                                    </select>
                                    <?= form_error('tipe_soal') ?>
                                </div>
                                <div class="form-group">
                                    <label for="">Waktu</label>
                                    <input type="number" name="waktu_pengerjaan" class="form-control  <?= form_error('waktu_pengerjaan') != null ? 'border border-danger' : '' ?>" placeholder="Waktu Pengerjaan dalam satuan menit" value="<?= $row->waktu_pengerjaan != null ? $row->waktu_pengerjaan : set_value('waktu_pengerjaan') ?>">
                                    <?= form_error('waktu_pengerjaan') ?>
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