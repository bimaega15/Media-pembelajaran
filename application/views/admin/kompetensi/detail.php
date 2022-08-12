<style>
    img{
        width: 25%;
    }
</style>
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
                            <input type="hidden" name="id_kompetensi" value="<?= $row->id_kompetensi; ?>">

                            <div class="form-group">
                                <label for="">Judul kompetensi</label>
                                <p><?= $row->judul_kompetensi ?></p>
                            </div>

                            <div class="form-group">
                                <label for="">Keterangan</label>
                                <p> <?= htmlspecialchars_decode($row->keterangan_kompetensi); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- /.content -->
</div>