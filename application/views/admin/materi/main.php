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
                            <?php if ($profile->level != 'siswa') : ?>
                                <a href="<?= base_url('Admin/Materi/add') ?>" class="btn btn-dark"><i class="fas fa-plus"></i> Tambah</a>
                                <br><br>
                            <?php endif; ?>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTables">
                                    <thead>
                                        <tr align="center">
                                            <th width="5%;">No.</th>
                                            <th>Judul</th>
                                            <th>Guru</th>
                                            <th>Jadwal</th>
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
                                                <td><?= $row->judul_materi; ?></td>
                                                <td><?= check_users($row->users_id)->nama_profile; ?></td>
                                                <td><?php
                                                    $jadwal = check_jadwal($row->jadwal_id)->row();
                                                    echo ($jadwal->hari) . ' ' . time_show($jadwal->dari_waktu) . ' - ' . time_show($jadwal->sampai_waktu); ?></td>
                                                <td class="text-center">
                                                    <div>
                                                        <a href="<?= base_url('Admin/File?materi_id=' . $row->id_materi) ?>" class="btn btn-info btn-sm">
                                                            <i class="fas fa-eye"></i> Detail</a>
                                                        <?php if ($profile->level != 'siswa') : ?>
                                                            <a href="<?= base_url('Admin/Materi/edit/' . $row->id_materi) ?>" class="btn btn-warning btn-sm">
                                                                <i class="fas fa-pencil-alt"></i> Edit</a>
                                                            <a onclick="return confirm('Yakin ingin menghapus data ini?')" href="<?= base_url('Admin/Materi/delete/' . $row->id_materi) ?>" class="btn btn-danger btn-sm">
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