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
                    <!-- <?= $breadcrumb; ?> -->
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
                            <?php if ($profile->level == 'admin') : ?>
                                <a href="<?= base_url('Admin/Siswa/add') ?>" class="btn btn-dark"><i class="fas fa-plus"></i> Tambah Siswa</a><br>

                                <span class="badge badge-info">Jumlah Siswa Jurusan Otomatisasi Tata Kelola Perkantoran: <?php echo $jum_otkp ?> Siswa</span><br>
                                <span class="badge badge-info">Jumlah Siswa Jurusan Bisnis Daring dan Pemasaran: <?php echo $jum_bdp ?> Siswa</span><br>
                                <span class="badge badge-info">Jumlah Siswa Jurusan Akuntansi dan Keuangan Lembaga: <?php echo $jum_akl ?> Siswa</span><br>
                                <span class="badge badge-info">Jumlah Siswa Jurusan Rekayasa Perangkat Lunak: <?php echo $jum_rpl ?> Siswa</span><br>
                                <span class="badge badge-info">Jumlah Siswa Jurusan Multimedia: <?php echo $jum_mm ?> Siswa</span>
                            <?php endif; ?>
                            <br><br>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTables">
                                    <thead>
                                        <tr align="center">
                                            <th width="5%;">No.</th>
                                            <!-- <th>Username</th> -->
                                            <th>NISN</th>
                                            <th>Nama</th>
                                            <th>J.K</th>
                                            <th>Jurusan</th>
                                            <!-- <th>Jurusan</th> -->
                                            <th width="10%;">Gambar</th>
                                            <th width="15%;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($result as $row) :
                                        ?>
                                            <tr align="center">
                                                <td><?= $no++; ?></td>
                                                <!-- <td><?= $row->username; ?></td> -->
                                                <td><?= $row->nomor_induk; ?></td>
                                                <td><?= $row->nama_profile; ?></td>
                                                <td><?= $row->jenis_kelamin; ?></td>
                                                <td><?= $row->kode_jurusan; ?>

                                                </td>
                                                <td>
                                                    <a href="<?= base_url('public/image/users/' . $row->gambar_profile) ?>" target="_blank">
                                                        <img src="<?= base_url('public/image/users/' . $row->gambar_profile) ?>" alt="" width="90 px;" height="100 px">
                                                    </a>
                                                </td>
                                                <td align="center">
                                                    <?php if ($profile->level == 'admin') : ?>
                                                        <a href="<?= base_url('Admin/Siswa/edit/' . $row->id_users) ?>" class="btn btn-warning btn-sm">Edit</a>
                                                        <a onclick="return confirm('Yakin ingin menghapus data ini?')" href="<?= base_url('Admin/Siswa/delete/' . $row->id_users) ?>" class="btn btn-danger btn-sm">Delete</a>
                                                    <?php endif; ?>
                                                    <?php if ($profile->level == 'guru') : ?>
                                                        <a class=" btn btn-primary btn-sm" href="<?= base_url('Admin/Siswa/detail/' . $row->id_users) ?>">Detail</a>
                                                    <?php endif; ?>
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