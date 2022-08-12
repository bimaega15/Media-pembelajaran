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
                            <form action="<?= base_url('Admin/DaftarPustaka/process?materi_id=' . $materi_id) ?>" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="id_pustaka" value="<?= $row->id_pustaka; ?>">
                                <input type="hidden" name="materi_id" value="<?= $materi_id ?>">
                                <?php
                                $jenisPustaka =  $row->jenis_pustaka != null ? $row->jenis_pustaka : set_value('jenis_pustaka');
                                ?>
                                <div class="form-group">
                                    <label for="jenis_pustaka">Jenis Pustaka</label>
                                    <select name="jenis_pustaka" id="" class="form-control">
                                        <option value="buku" <?= $jenisPustaka == 'buku' ? 'selected' : '' ?> selected>Buku</option>
                                        <option value="jurnal artikel" <?= $jenisPustaka == 'jurnal artikel' ? 'selected' : '' ?>>Jurnal Artikel</option>
                                        <option value="internet" <?= $jenisPustaka == 'internet' ? 'selected' : '' ?>>Internet</option>
                                    </select>
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
        var jenis_pustaka = $('select[name="jenis_pustaka"]').val();

        loadForm(jenis_pustaka);

        function loadForm(jenis_pustaka) {
            if (jenis_pustaka == 'buku') {
                var output = `
                <div class="form-group">
                    <label for="judul">Judul</label>
                    <input type="text" class="form-control" name="judul" value="<?= $row->judul != null ? $row->judul : set_value('judul'); ?>" placeholder = "Judul">
                    <?= form_error('judul'); ?>
                </div>
                <div class="form-group">
                    <label for="penulis">Penulis</label>
                    <input type="text" class="form-control" name="penulis" value="<?= $row->penulis != null ? $row->penulis : set_value('penulis'); ?>" placeholder = "Penulis">
                    <?= form_error('penulis'); ?>

                </div>
                <div class="form-group">
                    <label for="penerbit">Penerbit</label>
                    <input type="text" class="form-control" name="penerbit" value="<?= $row->penerbit != null ? $row->penerbit : set_value('penerbit'); ?>" placeholder = "Penerbit">
                    <?= form_error('penerbit'); ?>

                </div>
                <div class="form-group">
                    <label for="kota_penerbit">Kota penerbit</label>
                    <input type="text" class="form-control" name="kota_penerbit" value="<?= $row->kota_penerbit != null ? $row->kota_penerbit : set_value('kota_penerbit'); ?>" placeholder = "Kota penerbit">
                    <?= form_error('kota_penerbit'); ?>

                </div>
                <div class="form-group">
                    <label for="tahun_terbit">Tahun terbit</label>
                    <input type="text" class="form-control tahun_terbit" name="tahun_terbit" value="<?= $row->tahun_terbit != null ? $row->tahun_terbit : set_value('tahun_terbit'); ?>" placeholder = "Tahun terbit">
                    <?= form_error('tahun_terbit'); ?>

                </div>
            `;

                $('#loadForm').html(output);

            } else if (jenis_pustaka == 'jurnal artikel') {
                var output = `
                <div class="form-group">
                    <label for="judul">Judul Jurnal</label>
                    <input type="text" class="form-control" name="judul" value="<?= $row->judul != null ? $row->judul : set_value('judul'); ?>" placeholder = "Judul">
                    <?= form_error('judul'); ?>
                </div>
                <div class="form-group">
                    <label for="judul_artikel">Judul artikel</label>
                    <input type="text" class="form-control" name="judul_artikel" value="<?= $row->judul_artikel != null ? $row->judul_artikel : set_value('judul_artikel'); ?>" placeholder = "Judul artikel">
                    <?= form_error('judul_artikel'); ?>

                </div>
                <div class="form-group">
                    <label for="penulis">Penulis</label>
                    <input type="text" class="form-control" name="penulis" value="<?= $row->penulis != null ? $row->penulis : set_value('penulis'); ?>" placeholder = "Penulis">
                    <?= form_error('penulis'); ?>
                </div>
                <div class="form-group">
                    <label for="penerbit">Penerbit</label>
                    <input type="text" class="form-control" name="penerbit" value="<?= $row->penerbit != null ? $row->penerbit : set_value('penerbit'); ?>" placeholder = "Penerbit">
                    <?= form_error('penerbit'); ?>
                </div>
                <div class="form-group">
                    <label for="kota_penerbit">Kota penerbit</label>
                    <input type="text" class="form-control" name="kota_penerbit" value="<?= $row->kota_penerbit != null ? $row->kota_penerbit : set_value('kota_penerbit'); ?>" placeholder = "Kota penerbit">
                    <?= form_error('kota_penerbit'); ?>

                </div>
                <div class="form-group">
                    <label for="tahun_terbit">Tahun terbit</label>
                    <input type="text" class="form-control tahun_terbit_jurnal" name="tahun_terbit" value="<?= $row->tahun_terbit != null ? $row->tahun_terbit : set_value('tahun_terbit'); ?>" placeholder = "Tahun terbit">
                    <?= form_error('tahun_terbit'); ?>

                </div>
            `;

                $('#loadForm').html(output);

            } else if (jenis_pustaka == 'internet') {
                var output = `
                <div class="form-group">
                    <label for="judul">Judul</label>
                    <input type="text" class="form-control" name="judul" value="<?= $row->judul != null ? $row->judul : set_value('judul'); ?>" placeholder = "Judul">
                    <?= form_error('judul'); ?>
                </div>
                <div class="form-group">
                    <label for="penulis">Penulis</label>
                    <input type="text" class="form-control" name="penulis" value="<?= $row->penulis != null ? $row->penulis : set_value('penulis'); ?>" placeholder = "Penulis">
                    <?= form_error('penulis'); ?>
                </div>
                <div class="form-group">
                    <label for="tanggal_tayang">Tanggal tayang</label>
                    <input type="text" class="form-control datepicker_tayang" name="tanggal_tayang" value="<?= $row->tanggal_tayang != null ? $row->tanggal_tayang : set_value('tanggal_tayang'); ?>" placeholder = "Tanggal tayang">
                    <?= form_error('tanggal_tayang'); ?>
                </div>
                <div class="form-group">
                    <label for="waktu_akses_tanggal">Tanggal</label>
                    <input type="text" class="form-control datepicker" name="waktu_akses_tanggal" value="<?= $row->waktu_akses_tanggal != null ? $row->waktu_akses_tanggal : set_value('waktu_akses_tanggal'); ?>" placeholder = "Tanggal akses">
                    <?= form_error('waktu_akses_tanggal'); ?>

                </div>
                <div class="form-group">
                    <label for="waktu_akses_time">Waktu</label>
                    <input type="text" class="form-control timepicker" name="waktu_akses_time" value="<?= $row->waktu_akses_time != null ? $row->waktu_akses_time : set_value('waktu_akses_time'); ?>" placeholder = "Waktu akses">
                    <?= form_error('waktu_akses_time'); ?>
                </div>
                <div class="form-group">
                    <label for="url">Tahun terbit</label>
                    <input type="text" class="form-control" name="url" value="<?= $row->url != null ? $row->url : set_value('url'); ?>" placeholder = "URL">
                    <?= form_error('url'); ?>

                </div>
            `;
                $('#loadForm').html(output);
            }
        }

        $(document).on('change', 'select[name="jenis_pustaka"]', function() {
            var jenis_pustaka = $(this).val();
            loadForm(jenis_pustaka);

            $('.timepicker').timepicker({
                timeFormat: 'HH:mm',
                scrollbar: true
            });

            $('.datepicker_tayang').datepicker({
                toggleActive: true,
                autoclose: true,
                format: 'yyyy-mm-dd',
                todayHighlight: true,
            });

            $('.datepicker').datepicker({
                toggleActive: true,
                autoclose: true,
                format: 'yyyy-mm-dd',
                todayHighlight: true,
            });

            $('.tahun_terbit').datepicker({
                toggleActive: true,
                autoclose: true,
                format: 'yyyy',
            });

            $('.tahun_terbit_jurnal').datepicker({
                toggleActive: true,
                autoclose: true,
                format: 'yyyy',
            });
        })

        $('.tahun_terbit').datepicker({
            toggleActive: true,
            autoclose: true,
            format: 'yyyy',
        });

        $('.tahun_terbit_jurnal').datepicker({
            toggleActive: true,
            autoclose: true,
            format: 'yyyy',
        });
    })
</script>