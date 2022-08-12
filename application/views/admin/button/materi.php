<?php
$uri = $this->uri->segment(1);
$subUri = $this->uri->segment(2);
$profile = check_profile();
?>


<a href="<?= base_url('Admin/File?materi_id=' . $materi_id) ?>" class="btn <?= $uri == 'Admin' && $subUri == 'File' ? 'btn-success' : 'btn-primary' ?>">File Materi</a>
<a href="<?= base_url('Admin/DaftarPustaka?materi_id=' . $materi_id) ?>" class="btn <?= $uri == 'Admin' && $subUri == 'DaftarPustaka' ? 'btn-success' : 'btn-primary' ?>">Daftar Pustaka</a>
<a href="<?= base_url('Admin/VideoPembelajaran?materi_id=' . $materi_id) ?>" class="btn <?= $uri == 'Admin' && $subUri == 'VideoPembelajaran' ? 'btn-success' : 'btn-primary' ?>">Video Pembelajaran</a>

<a href="<?= base_url('Admin/Quiz?materi_id=' . $materi_id) ?>" class="btn <?= $uri == 'Admin' && $subUri == 'Quiz' ? 'btn-success' : 'btn-primary' ?>">Quiz</a>