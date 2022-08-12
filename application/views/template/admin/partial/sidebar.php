<?php

$konfigurasi = check_konfigurasi();
$uri = $this->uri->segment(1);
$subUri = $this->uri->segment(2);
$subSubUri = $this->uri->segment(3);
$profile = check_profile();
?>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= base_url('Admin/Home') ?>" class="brand-link" style="text-align: center;">
        <img src="<?= base_url('public/image/konfigurasi/' . $konfigurasi->gambar_konfigurasi) ?>" alt="Media Pembelajaran Logo" class="brand-image img-circle elevation-3" style="opacity: .8;">
        <span class="brand-text" style="font-size: 14px;">MEDIA PEMBELAJARAN</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?= base_url('public/image/users/' . $profile->gambar_profile) ?>" class="img-circle elevation-2" alt="User Image" width="50px" height="50px">
            </div>
            <div class="info">
                <a href="<?= base_url('Admin/Profile') ?>" class="d-block">
                    <?= $profile->nama_profile; ?> <br>
                    <span class="badge bg-primary">
                        <?= $profile->level; ?>
                    </span>
                </a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="<?= base_url('Admin/Home') ?>" class="nav-link <?= $uri == 'Admin' && $subUri == 'Home' ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            Home
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('Admin/Kompetensi') ?>" class="nav-link <?= $uri == 'Admin' && $subUri == 'Kompetensi' ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Kompetensi
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('Admin/Jadwal') ?>" class="nav-link <?= $uri == 'Admin' && $subUri == 'Jadwal' ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-clock"></i>
                        <p>
                            Jadwal
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('Admin/Materi') ?>" class="nav-link <?= $uri == 'Admin' && $subUri == 'Materi' ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-book-open"></i>
                        <p>
                            Materi
                        </p>
                    </a>
                </li>

                <?php if ($profile->level == 'admin') : ?>
                    <li class="nav-item">
                        <a href="<?= base_url('Admin/Users') ?>" class="nav-link <?= $uri == 'Admin' && $subUri == 'Users' ? 'active' : '' ?>">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                Users
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= base_url('Admin/Petunjuk') ?>" class="nav-link <?= $uri == 'Admin' && $subUri == 'Petunjuk' ? 'active' : '' ?>">
                            <i class="nav-icon fas fa-book"></i>
                            <p>
                                Petunjuk
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="<?= base_url('Admin/Konfigurasi') ?>" class="nav-link <?= $uri == 'Admin' && $subUri == 'Konfigurasi' ? 'active' : '' ?>">
                            <i class="nav-icon fas fa-cog"></i>
                            <p>
                                Konfigurasi
                            </p>
                        </a>
                    </li>
                <?php endif; ?>
                <li class="nav-item">
                    <a href="<?= base_url('Logout') ?>" class="nav-link <?= $uri == 'Admin' && $subUri == 'logout' ? 'active' : '' ?>" onclick="return confirm('Apakah anda yakin ingin keluar ?')">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>
                            Logout
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>