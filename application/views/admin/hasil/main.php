<style>
    td p {
        display: inline;
    }
</style>
<?php
$ci = &get_instance();
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
                            <strong>
                                <?php
                                $materi = check_materi($materi_id)->row();
                                echo $materi->judul_materi . '<br>';
                                $materi = check_quiz($quiz_id)->row();
                                echo $materi->judul_quiz . '<br>';
                                ?>
                            </strong>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTablesHasil">
                                    <thead>
                                        <tr align="center">
                                            <th width="5%;">No.</th>
                                            <th>Nama</th>
                                            <th>Benar</th>
                                            <th>Salah</th>
                                            <th>Tidak Menjawab</th>
                                            <th>Total Soal</th>
                                            <th>Skor</th>
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
                                                <?php
                                                $siswaUjian = $ci->db->get_where('siswa_ujian', [
                                                    'id_siswa_ujian' => $row->siswa_ujian_id
                                                ])->row();
                                                $users = check_profile($siswaUjian->users_id);


                                                ?>
                                                <td><?= $users->nama_profile; ?></td>
                                                <td><?= $row->benar; ?></td>
                                                <td><?= $row->salah; ?></td>
                                                <td><?= $row->tidak_menjawab; ?></td>
                                                <td><?= $row->total_soal; ?></td>
                                                <td><?= $row->skor; ?></td>
                                                <td>
                                                    <a href="<?= base_url('Admin/Hasil/detail/' . $row->id_hasil . '?materi_id=' . $materi_id . '&quiz_id=' . $quiz_id) ?>" class="btn btn-info btn-sm">
                                                        <i class="fas fa-eye"></i> Detail</a>
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
<script src="<?= base_url('assets/') ?>plugins/jquery/jquery.min.js"></script>

<script>
    $(document).ready(function() {
        $('#dataTablesHasil').DataTable({
            "order": [
                [6, "desc"]
            ]
        });
    })
</script>