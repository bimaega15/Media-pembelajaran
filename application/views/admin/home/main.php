<?php
$konfigurasi = check_konfigurasi();
$profile = check_profile();
?>


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><?= $title; ?></h1>
                </div>
                <div class="col-sm-6">
                    <?= $breadcrumb; ?>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?= $admin ?></h3>
                            <p>Admin</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-ios-person"></i>
                        </div>
                        <!-- <a href="<?= base_url('Admin/Users') ?>" class="small-box-footer">More info <i class="fas fa-user-lock"></i></a> -->
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3><?= $guru ?></h3>

                            <p>Guru</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-ios-person-outline"></i>
                        </div>
                        <!-- <a href="<?= base_url('Admin/Users') ?>" class="small-box-footer">More info <i class="fas fa-user-tie"></i></a> -->
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3><?= $siswa ?></h3>

                            <p>Siswa</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-stalker"></i>
                        </div>
                        <!-- <a href="<?= base_url('Admin/Users') ?>" class="small-box-footer">More info <i class="fas fa-users"></i></a> -->
                    </div>
                </div>


                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?= $materi ?></h3>

                            <p>Materi</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-ios-book-outline"></i>
                        </div>
                        <!-- <a href="<?= base_url('Admin/Materi') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <figure class="highcharts-figure">
                                <div id="container"></div>
                                <p class="highcharts-description">
                                    Data Master Sistem Informasi Media Pembelajaran
                                </p>
                            </figure>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="calendar calendar-first" id="calendar_first">
                        <div class="calendar_header">
                            <button class="switch-month switch-left"> <i class="fa fa-chevron-left"></i></button>
                            <h2></h2>
                            <button class="switch-month switch-right"> <i class="fa fa-chevron-right"></i></button>
                        </div>
                        <div class="calendar_weekdays"></div>
                        <div class="calendar_content"></div>
                    </div>
                </div>
            </div>

        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<script src="<?= base_url('assets/') ?>plugins/jquery/jquery.min.js"></script>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<script>
    Highcharts.chart('container', {

        chart: {
            styledMode: true
        },

        title: {
            text: 'Data Master'
        },
        series: [{
            type: 'pie',
            allowPointSelect: true,
            keys: ['name', 'y', 'selected', 'sliced'],
            data: [
                ['Admin', <?= $admin ?>, false],
                ['Guru', <?= $guru ?>, false],
                ['Siswa', <?= $siswa ?>, false],
                ['Materi', <?= $materi ?>, false],
            ],
            showInLegend: true
        }]
    });
</script>