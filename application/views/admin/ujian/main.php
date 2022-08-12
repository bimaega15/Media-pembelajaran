<?php
$profile = check_profile();
?>
<style>
    .card-body strong {
        display: block;
    }

    .card-body strong p {
        display: inline;
    }

    label p {
        display: inline;
        margin: 0;
    }

    #paginationNumber {
        width: 0%;
        height: 100%;
        position: fixed;
        right: 0;
        top: 0;
        background-color: #225ba9;
        z-index: 9999;
        transition: all 0.5s;
    }

    #paginationNumber .btn_pull {
        position: absolute;
        top: 50%;
        right: 0%;
        transition: all 0.5s;
    }

    .border-left-info {
        border-left: 6px solid blue;
    }

    .border-left-success {
        border-left: 6px solid green;
    }

    .btn-light:not(:disabled):not(.disabled):active,
    .btn-light:not(:disabled):not(.disabled).active,
    .show>.btn-light.dropdown-toggle {
        color: #212529;
        background-color: #dae0e5;
        border-color: #d3d9df;
        border-left: 6px solid green;
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
                <?php $this->view('session'); ?>
                <div class="card-header text-center bg-info">
                    <?php
                    $getQuiz = check_quiz($quiz_id)->row();
                    ?>
                    <div class="d-flex justify-content-between align-items-center">
                        <strong><?= $getQuiz->judul_quiz; ?></strong>
                        <strong id="timecircle" data-timer="<?= $waktu_ujian; ?>" style="height: 70px;"></strong>
                    </div>
                </div>
                <div id="loadUjian">
                </div>
            </div>
            <div id="paginationNumber">
                <a href="#" class="btn btn-secondary btn_pull">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <div id="loadTab"></div>

            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<script src="<?= base_url('assets/') ?>plugins/jquery/jquery.min.js"></script>

<script>
    function loadUjian(soal_id = '', type = '', tab = '') {
        $.ajax({
            url: '<?= base_url('Admin/Ujian/loadUjian') ?>',
            method: 'get',
            dataType: 'json',
            data: {
                quiz_id: '<?= $quiz_id ?>',
                soal_id: soal_id,
                type: type,
                tab: tab,
            },
            success: function(data) {
                // console.log(data);
                $('#loadUjian').html(data);
                MathJax.typeset(["#loadUjian"]);
            },
            error: function(x, t, m) {
                console.log(x.responseText);
            }
        })
    }

    function loadTab() {
        $.ajax({
            url: '<?= base_url('Admin/Ujian/loadTab') ?>',
            method: 'get',
            dataType: 'json',
            data: {
                quiz_id: '<?= $quiz_id ?>'
            },
            success: function(data) {
                // console.log(data);
                $('#loadTab').html(data);
            },
            error: function(x, t, m) {
                console.log(x.responseText);
            }
        })
    }

    $(document).ready(function() {
        var id_soal = "<?= $id_soal ?>";
        loadUjian(id_soal);
        loadTab();

        $(document).on('click', '.btn_forward', function(e) {
            e.preventDefault();
            var id_soal = $(this).data('id_soal');
            loadUjian(id_soal, 'next');
        })
        $(document).on('click', '.btn_back', function(e) {
            e.preventDefault();
            var id_soal = $(this).data('id_soal');
            loadUjian(id_soal, 'back');
        })

        $(document).on('click', '.btn_choose', function() {
            $('label.btn').removeClass('border-left-success').addClass('border-left-info');
            $(this).closest('label.btn').removeClass('border-left-info').addClass('border-left-success');
            var pilihan = $(this).val();
            var id_soal = $(this).data('id_soal');


            $.ajax({
                url: "<?= base_url('Admin/Ujian/pilihJawaban') ?>",
                method: 'post',
                dataType: 'json',
                data: {
                    id_soal: id_soal,
                    pilihan: pilihan
                },
                success: function(data) {
                    loadUjian(data.id_soal);
                    loadTab();

                },
                error: function(x, t, m) {
                    console.log(x.responseText);
                }
            })
        })

        // waktu ujian
        var intervalWaktu = setInterval(() => {
            var waktuUjian = $("#timecircle").TimeCircles({
                "time": {
                    "Days": {
                        "text": "Days",
                        "color": "#FFCC66",
                        "show": false
                    },
                    "Hours": {
                        "text": "Hours",
                        "color": "#99CCFF",
                        "show": true
                    },
                    "Minutes": {
                        "text": "Minutes",
                        "color": "#BBFFBB",
                        "show": true
                    },
                    "Seconds": {
                        "text": "Seconds",
                        "color": "#FF9999",
                        "show": true
                    }
                }
            }).getTime();

            if (waktuUjian <= 0) {
                $("#timecircle").TimeCircles().stop();
                clearInterval(intervalWaktu);
                insertDataUjian();
            }
        }, 1000);

        function insertDataUjian() {
            $.ajax({
                url: "<?= base_url('Admin/Ujian/insertUjian') ?>",
                method: 'post',
                dataType: 'json',
                data: {
                    siswa_ujian: "<?= $siswa_ujian ?>",
                    quiz_id: '<?= $quiz_id ?>',
                    materi_id: '<?= $materi_id ?>',
                },
                success: function(data) {
                    if (data.status == 200) {
                        window.location.replace(data.url);
                    }
                },
                error: function(x, t, m) {
                    console.log(x.responseText);
                }
            })
        }

        $(document).on('click', '.btn_pull', function() {
            $('.btn_pull').addClass('active');
            $('.btn_pull.active i').removeClass('fas fa-arrow-left').addClass('fas fa-arrow-right');

            $('#paginationNumber').css({
                width: '20%',
            })
            $('.btn_pull').css({
                right: '100%'
            })
        })

        $(document).on('click', '.btn_pull.active', function() {
            $('.btn_pull').removeClass('active');
            $('.btn_pull i').removeClass('fas fa-arrow-right').addClass('fas fa-arrow-left');

            $('#paginationNumber').css({
                width: '0%',
            })
            $('.btn_pull').css({
                right: '0%'
            })
        })

        $(document).on('click', '.btn_tab', function(e) {
            e.preventDefault();
            var soal_id = $(this).data('soal_id');
            var tab = $(this).text();
            loadUjian(soal_id, '', tab);
        })

        $(document).on('click', '.btn_ragu', function(e) {
            e.preventDefault();
            var id_soal = $(this).data('id_soal');
            $.ajax({
                url: "<?= base_url('Admin/Ujian/raguAnswer') ?>",
                method: 'post',
                dataType: 'json',
                data: {
                    id_soal: id_soal,
                },
                success: function(data) {
                    loadUjian(data.id_soal);
                    loadTab();
                },
                error: function(x, t, m) {
                    console.log(x.responseText);
                }
            })
        })

        $(document).on('click', '.btn_finish', function(e) {
            e.preventDefault();
            if (confirm('Yakin ingin selesaikan ujian ?')) {
                insertDataUjian();
            }
        })
    })
</script>