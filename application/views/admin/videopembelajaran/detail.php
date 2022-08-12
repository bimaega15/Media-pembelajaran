<style>
    iframe {
        width: 100%;
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
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tr>
                                        <td>Judul Video</td>
                                        <td>:</td>
                                        <td><?= $row->judul_video ?></td>
                                    </tr>
                                    <tr>
                                        <td>Status Video</td>
                                        <td>:</td>
                                        <td><?= $row->link_video == '1' ? 'Url Video' : 'File Video' ?></td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal</td>
                                        <td>:</td>
                                        <td><?= $row->tanggal_entri; ?></td>
                                    </tr>
                                    <?php
                                    if ($row->link_video == '1') { ?>
                                        <tr>
                                            <td colspan="3" class="text-center">Video</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" class="text-center"><?= htmlspecialchars_decode($row->url_video); ?></td>
                                        </tr>
                                    <?php
                                    } else if ($row->link_video == '0') { ?>
                                        <tr>
                                            <td colspan="3" class="text-center">Video</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" class="text-center">
                                                <video width="100%" controls>
                                                    <source src="<?= base_url('public/image/video/' . $row->file_video); ?>" type="video/mp4">
                                                    <source src="<?= base_url('public/image/video/' . $row->file_video); ?>" type="video/ogg">
                                                    Your browser does not support the video tag.
                                                </video>

                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>


                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- /.content -->
</div>
<script src="<?= base_url('assets/') ?>plugins/jquery/jquery.min.js"></script>
<script src="<?= base_url('public/js/video/aksVideoPlayer.min.js') ?>"></script>