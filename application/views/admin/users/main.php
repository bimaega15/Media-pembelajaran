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
                            <a href="<?= base_url('Admin/Users/add') ?>" class="btn btn-dark"><i class="fas fa-plus"></i> Tambah</a>
                            <br><br>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTables">
                                    <thead>
                                        <tr align="center">
                                            <th width="5%;">No.</th>
                                            <th>Username</th>
                                            <th>No. Induk</th>
                                            <th>Level</th>
                                            <th>Nama</th>
                                            <th>J.K</th>
                                            <th width="10%;">Gambar</th>
                                            <th width="15%;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($result as $row) :
                                        ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td><?= $row->username; ?></td>
                                                <td><?= $row->nomor_induk; ?></td>
                                                <td><?= $row->level; ?></td>
                                                <td><?= $row->nama_profile; ?></td>
                                                <td><?= $row->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan'; ?></td>
                                                <td>
                                                    <a href="<?= base_url('public/image/users/' . $row->gambar_profile) ?>" target="_blank">
                                                        <img src="<?= base_url('public/image/users/' . $row->gambar_profile) ?>" alt="" width="100%;">
                                                    </a>
                                                </td>
                                                <td align="center">
                                                    <div>
                                                        <a href="<?= base_url('Admin/Users/edit/' . $row->id_users) ?>" class="btn btn-warning btn-sm">
                                                            <i class="fas fa-pencil-alt"></i> Edit</a>
                                                        <?php if ($row->verifikasi == 0) : ?>
                                                            <a onclick="return confirm('Yakin ingin verifikasi akun ini ?')" href="<?= base_url('Admin/Users/verifikasi/' . $row->id_users) ?>" class="btn btn-success btn-sm">
                                                                <i class="fas fa-check"></i> Verifikasi</a>
                                                        <?php endif; ?>
                                                        <?php if ($profile->users_id != $row->id_users) : ?>
                                                            <a onclick="return confirm('Yakin ingin menghapus data ini?')" href="<?= base_url('Admin/Users/delete/' . $row->id_users) ?>" class="btn btn-danger btn-sm">
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