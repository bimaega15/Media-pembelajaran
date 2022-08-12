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
                                <a href="<?= base_url('Admin/Quiz/add?materi_id=' . $materi_id) ?>" class="btn btn-dark"><i class="fas fa-plus"></i> Tambah</a>
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
                                            <th>Tipe Soal</th>
                                            <th>Tanggal</th>
                                            <th>Waktu Pengerjaan</th>
                                            <th width="25%;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($result as $row) :
                                            $checkHasil = check_hasil($row->id_quiz);
                                        ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td><?= $row->judul_quiz; ?></td>
                                                <td><?= $row->tipe_soal; ?></td>
                                                <td><?= $row->tanggal_entri; ?></td>
                                                <td><?= $row->waktu_pengerjaan; ?> Menit</td>
                                                <td class="text-center">
                                                    <div>
                                                        <?php if ($profile->level != 'siswa') : ?>
                                                            <a href="<?= base_url('Admin/Soal?materi_id=' . $materi_id . '&quiz_id=' . $row->id_quiz) ?>" class="btn btn-info btn-sm">
                                                                <i class="fas fa-pen-square"></i> Soal</a>
                                                            <a href="<?= base_url('Admin/Quiz/edit/' . $row->id_quiz . '?materi_id=' . $materi_id) ?>" class="btn btn-warning btn-sm">
                                                                <i class="fas fa-pencil-alt"></i> Edit</a>
                                                            <a onclick="return confirm('Yakin ingin menghapus data ini?')" href="<?= base_url('Admin/Quiz/delete/' . $row->id_quiz . '?materi_id=' . $materi_id) ?>" class="btn btn-danger btn-sm">
                                                                <i class="fas fa-trash"></i>
                                                                Delete</a>
                                                        <?php else : ?>
                                                            <?php
                                                            if ($checkHasil == false) :
                                                            ?>
                                                                <form action="<?= base_url('Admin/Ujian?materi_id=' . $materi_id . '&quiz_id=' . $row->id_quiz); ?>" method="post">
                                                                    <button onclick="return confirm('Ingin memulai quiz ? ')" class="btn btn-primary btn-sm">
                                                                        <i class="fas fa-play"></i> Ujian
                                                                    </button>
                                                                </form>
                                                            <?php elseif ($checkHasil != false && $checkHasil != true) : ?>
                                                                <a href="<?= base_url('Admin/Ujian/mulai?materi_id=' . $materi_id . '&quiz_id=' . $row->id_quiz . '&siswa_ujian=' . $checkHasil); ?>" class="btn btn-warning btn-sm">
                                                                    <i class="fas fa-play"></i> Masuk</a>
                                                            <?php endif; ?>
                                                        <?php endif; ?>

                                                        <a href="<?= base_url('Admin/Hasil?materi_id=' . $materi_id . '&quiz_id=' . $row->id_quiz) ?>" class="btn btn-success btn-sm">
                                                            <i class="fas fa-trophy"></i> Hasil</a>
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