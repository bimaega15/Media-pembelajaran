<?php
$ci = get_instance();
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
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form action="<?= base_url('Admin/Soal/process?materi_id=' . $materi_id . '&quiz_id=' . $quiz_id) ?>" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="id_soal" value="<?= $row->id_soal; ?>">
                                <input type="hidden" name="materi_id" value="<?= $materi_id; ?>">
                                <input type="hidden" name="quiz_id" value="<?= $quiz_id; ?>">
                                <div class="form-group">
                                    <label for="">Judul Soal</label>
                                    <textarea name="judul_soal" id="ckjudul_soal" class="form-control  <?= form_error('judul_soal') != null ? 'border border-danger' : '' ?>" placeholder="Judul Soal">
                                    <?= $row->judul_soal != null ? ($row->judul_soal) : (set_value('judul_soal')) ?>
                                    </textarea>
                                    <?= form_error('judul_soal') ?>
                                </div>
                                <?php
                                if ($get_quiz->tipe_soal == 'A-C') {
                                    $number = 3;
                                } else if ($get_quiz->tipe_soal == 'A-D') {
                                    $number = 4;
                                } else if ($get_quiz->tipe_soal == 'A-E') {
                                    $number = 5;
                                }

                                $soalDetail = $ci->db->get_where('soal_detail', [
                                    'soal_id' => $row->id_soal
                                ])->result();
                                $pilihan = array_column($soalDetail, 'pilihan');
                                ?>
                                <?php for ($i = 1; $i <= $number; $i++) : ?>
                                    <div class="form-group">
                                        <label for="jawaban">Jawaban <?= convert_number_answer($i); ?></label>
                                        <input type="hidden" name="pilihan[]" value="<?= convert_number_answer($i); ?>">
                                        <textarea name="jawaban[]" id="ckjawaban<?= convert_number_answer($i); ?>" class="form-control " placeholder="Jawaban <?= convert_number_answer($i); ?>">
                                        <?php
                                        if (in_array(convert_number_answer($i), $pilihan)) {
                                            echo $soalDetail[$i - 1]->jawaban;
                                        }
                                        ?>
                                        </textarea>
                                        <?php
                                        if (in_array(convert_number_answer($i), $pilihan)) {
                                            echo '<input type="hidden" name="soal_detail_id[]" value="' . $soalDetail[$i - 1]->id_soal_detail . '">';
                                        }
                                        ?>
                                        <?= form_error('jawaban') ?>
                                    </div>
                                <?php endfor; ?>
                                <?= form_error('jawaban'); ?>

                                <div class="form-group">
                                    <label for="">Jawaban Soal</label>
                                    <?php
                                    $jawabanSoal = $row->jawaban_soal != null ? $row->jawaban_soal : set_value('jawaban_soal');
                                    ?>
                                    <select name="jawaban_soal" id="ckjawaban_soal" class="form-control  <?= form_error('jawaban_soal') != null ? 'border border-danger' : '' ?>">
                                        <option value="">-- Jawaban Soal --</option>
                                        <?php for ($i = 1; $i <= $number; $i++) : ?>
                                            <option value="<?= convert_number_answer($i) ?>" <?= $jawabanSoal == convert_number_answer($i) ? 'selected' : '' ?>><?= convert_number_answer($i) ?></option>
                                        <?php endfor; ?>
                                    </select>
                                    <?= form_error('jawaban_soal') ?>
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
        var pane = $('#ckjudul_soal');
        pane.val($.trim(pane.val()).replace(/\s*[\r\n]+\s*/g, '\n')
            .replace(/(<[^\/][^>]*>)\s*/g, '$1')
            .replace(/\s*(<\/[^>]+>)/g, '$1'));


        CKEDITOR.plugins.addExternal('ckeditor_wiris', '<?= base_url('public/js/ckeditor/plugins/ckeditor_wiris/plugin.js') ?>');
        CKEDITOR.plugins.addExternal('video', '<?= base_url('public/js/ckeditor/plugins/video/plugin.js') ?>');

        var editor = CKEDITOR.replace('ckjudul_soal', {
            extraPlugins: ['ckeditor_wiris', 'video'],
        });
        CKFinder.setupCKEditor(editor);

        <?php for ($i = 1; $i <= $number; $i++) : ?>
            CKEDITOR.plugins.addExternal('ckeditor_wiris', '<?= base_url('public/js/ckeditor/plugins/ckeditor_wiris/plugin.js') ?>');
            CKEDITOR.plugins.addExternal('video', '<?= base_url('public/js/ckeditor/plugins/video/plugin.js') ?>');

            var editor = CKEDITOR.replace('ckjawaban<?= convert_number_answer($i); ?>', {
                extraPlugins: ['ckeditor_wiris', 'video'],
            });
            CKFinder.setupCKEditor(editor);

            var pane = $('#ckjawaban<?= convert_number_answer($i); ?>');
            pane.val($.trim(pane.val()).replace(/\s*[\r\n]+\s*/g, '\n')
                .replace(/(<[^\/][^>]*>)\s*/g, '$1')
                .replace(/\s*(<\/[^>]+>)/g, '$1'));
        <?php endfor; ?>
    })
</script>