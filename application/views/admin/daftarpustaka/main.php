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
            <?php
            $this->view('admin/button/materi', [
                'materi_id' => $materi_id
            ]);
            ?>
            <div class="card mt-3">
                <?php $this->view('session'); ?>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <?php if ($profile->level != 'siswa') : ?>
                                <a href="<?= base_url('Admin/DaftarPustaka/add?materi_id=' . $materi_id) ?>" class="btn btn-dark"><i class="fas fa-plus"></i> Tambah</a>
                                <br><br>
                            <?php endif; ?>
                            <strong>
                                <?php
                                $materi = check_materi($materi_id)->row();
                                echo $materi->judul_materi;
                                ?>
                            </strong>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTables">
                                    <thead>
                                        <tr align="center">
                                            <th width="5%;">No.</th>
                                            <th>Judul</th>
                                            <th>Penulis</th>
                                            <th>Jenis Pustaka</th>
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
                                                <td><?= $row->judul; ?></td>
                                                <td><?= $row->penulis; ?></td>
                                                <td><?= $row->jenis_pustaka; ?></td>

                                                <td class="text-center">
                                                    <div>

                                                        <a href="<?= base_url('Admin/DaftarPustaka/detail/' . $row->id_pustaka . '?materi_id=' . $materi_id) ?>" class="btn btn-info btn-sm">
                                                            <i class="fas fa-eye"></i> Detail</a>
                                                        <?php if ($profile->level != 'siswa') : ?>
                                                            <a href="<?= base_url('Admin/DaftarPustaka/edit/' . $row->id_pustaka . '?materi_id=' . $materi_id) ?>" class="btn btn-warning btn-sm">
                                                                <i class="fas fa-pencil-alt"></i> Edit</a>
                                                            <a onclick="return confirm('Yakin ingin menghapus data ini?')" href="<?= base_url('Admin/DaftarPustaka/delete/' . $row->id_pustaka . '?materi_id=' . $materi_id) ?>" class="btn btn-danger btn-sm">
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