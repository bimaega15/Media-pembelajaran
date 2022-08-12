<style>
    img {
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
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <?php
                                    $jenis_pustaka = $row->jenis_pustaka;
                                    if ($jenis_pustaka == 'buku') {
                                        echo '
                                            <tr>
                                                <td>Judul Buku</td>
                                                <td>:</td>
                                                <td>' . $row->judul . '</td>
                                            </tr>
                                              <tr>
                                                <td>Penulis</td>
                                                <td>:</td>
                                                <td>' . $row->penulis . '</td>
                                            </tr>
                                              <tr>
                                                <td>Penerbit</td>
                                                <td>:</td>
                                                <td>' . $row->penerbit . '</td>
                                            </tr>
                                              <tr>
                                                <td>Kota penerbit</td>
                                                <td>:</td>
                                                <td>' . $row->kota_penerbit . '</td>
                                            </tr>
                                              <tr>
                                                <td>Tahun terbit</td>
                                                <td>:</td>
                                                <td>' . $row->tahun_terbit . '</td>
                                            </tr>
                                        ';
                                    } else if ($jenis_pustaka == 'jurnal artikel') {
                                        echo '
                                            <tr>
                                                <td>Judul Jurnal</td>
                                                <td>:</td>
                                                <td>' . $row->judul . '</td>
                                            </tr>
                                              <tr>
                                                <td>Judul Artikel</td>
                                                <td>:</td>
                                                <td>' . $row->judul_artikel . '</td>
                                            </tr>
                                              <tr>
                                                <td>Penulis</td>
                                                <td>:</td>
                                                <td>' . $row->penulis . '</td>
                                            </tr>
                                              <tr>
                                                <td>Penerbit</td>
                                                <td>:</td>
                                                <td>' . $row->penerbit . '</td>
                                            </tr>
                                              <tr>
                                                <td>Kota penerbit</td>
                                                <td>:</td>
                                                <td>' . $row->kota_penerbit . '</td>
                                            </tr>
                                              <tr>
                                                <td>Tahun terbit</td>
                                                <td>:</td>
                                                <td>' . $row->tahun_terbit . '</td>
                                            </tr>
                                        ';
                                    } else if ($jenis_pustaka == 'internet') {
                                        echo '
                                            <tr>
                                                <td>Judul</td>
                                                <td>:</td>
                                                <td>' . $row->judul . '</td>
                                            </tr>
                                              <tr>
                                                <td>Penulis</td>
                                                <td>:</td>
                                                <td>' . $row->penulis . '</td>
                                            </tr>
                                              <tr>
                                                <td>Tanggal tayang</td>
                                                <td>:</td>
                                                <td>' . $row->tanggal_tayang . '</td>
                                            </tr>
                                              <tr>
                                                <td>Tanggal akses</td>
                                                <td>:</td>
                                                <td>' . $row->waktu_akses_tanggal . '</td>
                                            </tr>
                                              <tr>
                                                <td>Waktu akses</td>
                                                <td>:</td>
                                                <td>' . $row->waktu_akses_time . '</td>
                                            </tr>
                                              <tr>
                                                <td>Url</td>
                                                <td>:</td>
                                                <td>' . $row->url . '</td>
                                            </tr>
                                        ';
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