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
                            <form action="<?= base_url('Admin/VideoPembelajaran/process?materi_id=' . $materi_id) ?>" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="id_video" value="<?= $row->id_video; ?>">
                                <input type="hidden" name="materi_id" value="<?= $materi_id ?>">
                                <?php
                                $linkVideo =  $row->link_video != null ? $row->link_video : set_value('link_video');
                                ?>
                                <input type="hidden" name="link_video" value="1">
                                <!-- <div class="form-group">
                                    <label for="link_video">Status Video</label>
                                    <select name="link_video" id="" class="form-control">
                                        <option value="1" <?= $linkVideo == '1' ? 'selected' : '' ?> selected>Url Video</option>
                                        <option value="0" <?= $linkVideo == '0' ? 'selected' : '' ?>>File Video</option>
                                    </select>
                                    <?= form_error('link_video'); ?>
                                </div> -->
                                <div class="form-group">
                                    <label for="judul_video">Judul video</label>
                                    <input type="judul_video" name="judul_video" class="form-control  <?= form_error('judul_video') != null ? 'border border-danger' : '' ?>" placeholder="Judul video" value="<?= $row->judul_video != null ? $row->judul_video : set_value('judul_video') ?>">
                                    <?= form_error('judul_video'); ?>
                                </div>

                                <div id="loadForm"></div>


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
        var link_video = $('input[name="link_video"]').val();
        loadForm(link_video);

        function loadForm(link_video) {
            if (link_video == '0') {
                var output = `
                <div class="form-group">
                    <label for="file_video">File Video</label>
                    <input type="file" class="form-control" name="file_video" placeholder="File Video">
                    <?= form_error('file_video'); ?>
                </div>
            `;

                $('#loadForm').html(output);

            } else if (link_video == '1') {
                var output = `
                <div class="form-group">
                    <label for="url_video">Url Video</label>
                    <textarea class="form-control" name="url_video" placeholder="URL Video diambil dari youtube dengan cara copy embed video" rows="5" id="url_video">
                    <?= $row->url_video != null ? $row->url_video : set_value('url_video') ?>
                    </textarea>
                    <?= form_error('url_video'); ?>
                </div>
            `;
                $('#loadForm').html(output);
            }
        }

        $(document).on('change', 'select[name="link_video"]', function() {
            var link_video = $(this).val();
            loadForm(link_video);

            var pane = $('#url_video');
            pane.val($.trim(pane.val()).replace(/\s*[\r\n]+\s*/g, '\n')
                .replace(/(<[^\/][^>]*>)\s*/g, '$1')
                .replace(/\s*(<\/[^>]+>)/g, '$1'));
        })

        var pane = $('#url_video');
        pane.val($.trim(pane.val()).replace(/\s*[\r\n]+\s*/g, '\n')
            .replace(/(<[^\/][^>]*>)\s*/g, '$1')
            .replace(/\s*(<\/[^>]+>)/g, '$1'));
    })
</script>