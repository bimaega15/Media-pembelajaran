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
                            <a href="<?= base_url('Admin/Jadwal') ?>" class="btn btn-warning"><i class="fas fa-backward"></i> Kembali</a>
                            <br><br>
                            <form action="<?= base_url('Admin/Jadwal/process') ?>" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="id_jadwal" value="<?= $row->id_jadwal; ?>">

                                <div class="form-group">
                                    <label for="">Hari</label>
                                    <input type="text" name="hari" class="form-control  <?= form_error('hari') != null ? 'border border-danger' : '' ?>" placeholder="Hari..." value="<?= $row->hari != null ? $row->hari : set_value('hari') ?>">
                                    <?= form_error('hari') ?>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="">Dari Jam</label>
                                            <input type="text" name="dari_waktu" class="form-control timepicker  <?= form_error('dari_waktu') != null ? 'border border-danger' : '' ?>" placeholder="Dari jam..." value="<?= ($row->dari_waktu) != null ? time_show($row->dari_waktu) : set_value('dari_waktu') ?>">
                                            <?= form_error('dari_waktu') ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="">Sampai Jam</label>
                                            <input type="text" name="sampai_waktu" class="form-control timepicker  <?= form_error('sampai_waktu') != null ? 'border border-danger' : '' ?>" placeholder="Sampai jam..." value="<?= $row->sampai_waktu != null ? time_show($row->sampai_waktu) : set_value('sampai_waktu') ?>">
                                            <?= form_error('sampai_waktu') ?>
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
<script src="<?= base_url('assets/') ?>plugins/jquery/jquery.min.js"></script>

<script>
    $(document).ready(function() {})
</script>