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
        <!-- HEADER DESKTOP-->
        <header class="header-desktop3 d-none d-lg-block">
            <div class="section__content section__content--p35">
                <div class="header3-wrap">
                    <div class="header__logo">
                        <a href="<?= base_url('admin'); ?>">
                            <img src="<?= base_url(); ?>assets/icon-home.png" width="50%" alt="E-KasRT" />
                        </a>
                    </div>
                    <div class="header__navbar">
                        <ul class="list-unstyled d-flex align-items-center">
                            <li class="nav-item">
                                <a class="nav-link" href="<?= base_url('admin'); ?>">
                                    <i class="fas fa-home"></i> Dashboard
                                </a>
                            </li>

                            <!-- Dropdown Kas -->
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="kasDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-money-bill-wave"></i> Kas
                                </a>
                                <div class="dropdown-menu" aria-labelledby="kasDropdown">
                                    <a class="dropdown-item" href="<?= base_url('penduduk'); ?>">
                                        <i class="fas fa-plus"></i> Kas Masuk
                                    </a>
                                    <a class="dropdown-item" href="<?= base_url('penduduk/kasKeluar'); ?>">
                                        <i class="fas fa-minus"></i> Kas Keluar
                                    </a>
                                </div>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="<?= base_url('warga'); ?>">
                                    <i class="fas fa-check-square"></i> Warga
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="<?= base_url('penduduk/laporan'); ?>">
                                    <i class="fas fa-bar-chart-o"></i> Laporan
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="<?= base_url('admin/user'); ?>">
                                    <i class="fas fa-users"></i> Akses
                                </a>
                            </li>
                        </ul>
                    </div>

                    <!-- Akun -->
                    <div class="header__tool">
                        <div class="account-wrap">
                            <div class="account-item account-item--style2 clearfix js-item-menu">
                                <div class="image">
                                    <img src="<?= base_url('assets/profil/' . $user['img']); ?>" alt="User" />
                                </div>
                                <div class="content">
                                    <a class="js-acc-btn" href="#"><?= $user['username']; ?></a>
                                </div>
                                <div class="account-dropdown js-dropdown">
                                    <div class="account-dropdown__body">
                                        <div class="account-dropdown__item">
                                            <a href="#!" onclick="changePassword('<?= base_url('admin/changePassword/' . $user['user_id']); ?>')">
                                                <i class="zmdi zmdi-key"></i>Change Password
                                            </a>
                                        </div>
                                    </div>
                                    <div class="account-dropdown__footer">
                                        <a href="<?= base_url('auth/logout'); ?>">
                                            <i class="zmdi zmdi-power"></i>Logout
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </header>
        <!-- END HEADER DESKTOP-->