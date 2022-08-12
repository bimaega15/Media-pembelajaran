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
                            <?php
                            if ($profile->level != 'siswa') :
                            ?>
                                <a href="<?= base_url('Admin/Kompetensi/add') ?>" class="btn btn-dark"><i class="fas fa-plus"></i> Tambah</a>
                                <br><br>
                            <?php endif; ?>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTables">
                                    <thead>
                                        <tr align="center">
                                            <th width="5%;">No.</th>
                                            <th>Judul</th>
                                            <th width="15%;" class="text-center">File</th>
                                            <th width="25%;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($result as $row) :
                                        ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td><?= $row->judul_kompetensi; ?></td>
                                                <td class="text-center">
                                                    <a href="<?= base_url('public/image/file/' . $row->file_kompetensi) ?>" target="_blank" class="btn btn-success"> Lihat File</a>
                                                </td>
                                                <td class="text-center">

                                                    <div>
                                                        <a href="<?= base_url('Admin/Kompetensi/detail/' . $row->id_kompetensi) ?>" class="btn btn-info btn-sm">
                                                            <i class="fas fa-eye"></i> Detail</a>
                                                        <?php
                                                        if ($profile->level != 'siswa') :
                                                        ?>
                                                            <a href="<?= base_url('Admin/Kompetensi/edit/' . $row->id_kompetensi) ?>" class="btn btn-warning btn-sm">
                                                                <i class="fas fa-pencil-alt"></i> Edit</a>
                                                            <a onclick="return confirm('Yakin ingin menghapus data ini?')" href="<?= base_url('Admin/Kompetensi/delete/' . $row->id_kompetensi) ?>" class="btn btn-danger btn-sm">
                                                                <i class="fas fa-trash"></i>
                                                                Delete</a>
                                                        <?php endif; ?>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
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