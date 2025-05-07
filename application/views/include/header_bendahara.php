<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">
    <!-- Title Page-->
    <title>Kas & Sampah | <?= $judul; ?></title>
    <link rel="shortcut icon" type="image/png" href="<?= base_url(); ?>assets/favicon.png">
    <!-- Fontfaces CSS-->
    <link href="<?= base_url(); ?>assets/css/font-face.css" rel="stylesheet" media="all">
    <link href="<?= base_url(); ?>assets/vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="<?= base_url(); ?>assets/vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="<?= base_url(); ?>assets/vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <!-- Bootstrap CSS-->
    <link href="<?= base_url(); ?>assets/vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">
    <!-- Vendor CSS-->
    <link href="<?= base_url(); ?>assets/vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="<?= base_url(); ?>assets/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="<?= base_url(); ?>assets/vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="<?= base_url(); ?>assets/vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="<?= base_url(); ?>assets/vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="<?= base_url(); ?>assets/vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="<?= base_url(); ?>assets/vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">
    <!-- Main CSS-->
    <link href="<?= base_url(); ?>assets/css/theme.css" rel="stylesheet" media="all">

    <style>
        .header__navbar .nav-item {
            width: 13%;
        }
    </style>
</head>

<body class="animsition">
    <div class="page-wrapper">
        <!-- HEADER -->
        <header class="d-block">
            <nav class="navbar navbar-expand-lg navbar-light bg-light" style="background-color: #393939 !important;">
                <a class="navbar-brand" href="<?= base_url('admin'); ?>">
                    <img src="<?= base_url(); ?>assets/icon-home.png" width="30" alt="E-KasRT">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainNavbar"
                    aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Navbar content -->
                <div class="collapse navbar-collapse" id="mainNavbar">
                    <ul class="navbar-nav mx-auto">
                        <li class="nav-item mr-3">
                            <a class="nav-link text-white" href="<?= base_url('admin'); ?>">
                                <i class="fas fa-home"></i> Dashboard
                            </a>
                        </li>

                        <!-- Dropdown Kas -->
                        <li class="nav-item  mr-3 dropdown">
                            <a class="nav-link dropdown-toggle text-white" href="#" id="kasDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-credit-card"></i></i> Transaksi
                            </a>
                            <div class="dropdown-menu" aria-labelledby="kasDropdown" style="background-color: #393939 !important;">
                                <a class="dropdown-item text-white" href="<?= base_url('penduduk'); ?>">
                                    <i class="fas fa-plus"></i> Kas Masuk
                                </a>
                                <a class="dropdown-item text-white" href="<?= base_url('penduduk/kasKeluar'); ?>">
                                    <i class="fas fa-minus"></i> Kas Keluar
                                </a>
                                <a class="dropdown-item text-white" href="<?= base_url('penduduk/sampah'); ?>">
                                    <i class="fas fa-plus"></i> Pembayaran Sampah
                                </a>
                            </div>
                        </li>

                        <li class="nav-item  mr-3">
                            <a class="nav-link text-white" href="<?= base_url('warga'); ?>">
                                <i class="fas fa-check-square"></i> Warga
                            </a>
                        </li>

                        <li class="nav-item  mr-3 dropdown">
                            <a class="nav-link dropdown-toggle text-white" href="#" id="laporanDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bar-chart-o"></i></i> Laporan
                            </a>
                            <div class="dropdown-menu" aria-labelledby="laporanDropdown" style="background-color: #393939 !important;">
                                <a class="dropdown-item text-white" href="<?= base_url('penduduk/laporan'); ?>">
                                    Laporan Kas
                                </a>
                                <a class="dropdown-item text-white" href="<?= base_url('penduduk/laporanSampah'); ?>">
                                    Laporan Sampah
                                </a>
                                <a class="dropdown-item text-white" href="<?= base_url('penduduk/laporanPembayaranSampahPerbulan'); ?>">
                                    Laporan Pembayaran Sampah Perbulan
                                </a>
                            </div>
                        </li>

                        <li class="nav-item  mr-3">
                            <a class="nav-link text-white" href="<?= base_url('warga/ubahDataDiri'); ?>">
                                <i class="fas fa-user"></i> Ubah Data Diri
                            </a>
                        </li>
                    </ul>

                    <!-- Akun dropdown -->
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item  mr-3 dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center text-white" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="<?= base_url('assets/profil/' . $user['img']); ?>" width="30" class="rounded-circle mr-2" alt="User">
                                <?= $user['username']; ?>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown" style="background-color: #393939 !important;">
                                <a class="dropdown-item text-white" href="#!" onclick="changePassword('<?= base_url('admin/changePassword/' . $user['user_id']); ?>')">
                                    <i class="zmdi zmdi-key"></i> Change Password
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item text-white" href="<?= base_url('auth/logout'); ?>">
                                    <i class="zmdi zmdi-power"></i> Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- END HEADER -->