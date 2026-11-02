<?php

$halaman = basename($_SERVER['PHP_SELF']);

$menuInformasi = array(
    'berita.php',
    'agenda.php',
    'ekstrakurikuler.php',
    'prestasi.php'
);

$informasiAktif = in_array($halaman, $menuInformasi);

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>MTs Nurul Huda Pematang Cengal</title>

    <!-- Bootstrap 3 -->
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- DataTables Bootstrap 3 -->
    <link href="../bootstrap/css/dataTables.bootstrap.min.css" rel="stylesheet">

    <!-- CSS tambahan jika memang digunakan -->
    <link href="../bootstrap/css/styles.css" rel="stylesheet">

    <style>

        /* =====================================================
           NAVBAR MTs NURUL HUDA
           CSS dibuat khusus agar tidak mudah bentrok
           ===================================================== */

        body {
            padding-top: 70px;
        }

        /* Navbar utama */
        .navbar-sekolah {
            min-height: 70px;
            margin-bottom: 0;
            border-radius: 0;
            border: 0;
            border-bottom: 2px solid #4CAF50;
            background: #fff;
        }

        /* Container navbar */
        .navbar-sekolah .navbar-header {
            min-height: 70px;
        }

        /* Logo + nama sekolah */
        .navbar-sekolah .navbar-brand {
            height: 70px;
            padding: 15px;
            font-size: 20px;
            line-height: 40px;
            font-weight: bold;
            white-space: nowrap;
            color: #2E7D32;
        }

        .navbar-sekolah .navbar-brand:hover,
        .navbar-sekolah .navbar-brand:focus {
            color: #1B5E20;
            background: transparent;
        }

        /* Logo */
        .navbar-sekolah .navbar-brand img {
            width: 40px;
            height: 40px;
            margin-right: 8px;
            display: inline-block;
            vertical-align: middle;
            object-fit: cover;
        }

        /* Menu utama */
        .navbar-sekolah .navbar-nav > li > a {
            padding: 25px 10px;
            font-size: 14px;
            color: #333;
        }

        /* Hover menu */
        .navbar-sekolah .navbar-nav > li > a:hover,
        .navbar-sekolah .navbar-nav > li > a:focus {
            background: #E8F5E9;
            color: #2E7D32;
        }

        /* Menu aktif */
        .navbar-sekolah .navbar-nav > .active > a,
        .navbar-sekolah .navbar-nav > .active > a:hover,
        .navbar-sekolah .navbar-nav > .active > a:focus {
            background: #4CAF50;
            color: #fff;
        }

        /* Dropdown */
        .navbar-sekolah .dropdown-menu {
            min-width: 210px;
            padding: 5px 0;
            border-top: 3px solid #4CAF50;
        }

        .navbar-sekolah .dropdown-menu > li > a {
            padding: 10px 15px;
            font-size: 14px;
            color: #333;
        }

        .navbar-sekolah .dropdown-menu > li > a:hover,
        .navbar-sekolah .dropdown-menu > li > a:focus {
            background: #E8F5E9;
            color: #2E7D32;
        }

        /* Dropdown aktif */
        .navbar-sekolah .navbar-nav > .dropdown.active > a,
        .navbar-sekolah .navbar-nav > .dropdown.active > a:hover,
        .navbar-sekolah .navbar-nav > .dropdown.active > a:focus {
            background: #4CAF50;
            color: #fff;
        }

        /* =====================================================
           RESPONSIVE HP
           ===================================================== */

        @media (max-width: 767px) {

            body {
                padding-top: 60px;
            }

            /* Navbar HP */
            .navbar-sekolah {
                min-height: 60px;
            }

            .navbar-sekolah .navbar-header {
                min-height: 60px;
            }

            /* Brand HP */
            .navbar-sekolah .navbar-brand {
                height: 60px;
                padding: 12px 15px;
                font-size: 15px;
                line-height: 30px;
            }

            /* Logo HP */
            .navbar-sekolah .navbar-brand img {
                width: 30px;
                height: 30px;
                margin-right: 5px;
            }

            /* Tombol hamburger */
            .navbar-sekolah .navbar-toggle {
                margin-top: 13px;
                margin-right: 15px;
                margin-bottom: 13px;
            }

            /* Menu HP */
            .navbar-sekolah .navbar-nav {
                margin-top: 0;
                margin-bottom: 0;
            }

            .navbar-sekolah .navbar-nav > li > a {
                padding: 12px 15px;
                font-size: 14px;
            }

            /* Dropdown HP */
            .navbar-sekolah .navbar-nav .dropdown-menu {
                width: 100%;
                min-width: 100%;
                padding: 0;
                border-top: 0;
                box-shadow: none;
            }

            .navbar-sekolah .navbar-nav .dropdown-menu > li > a {
                padding: 10px 30px;
            }

            /* Supaya menu tidak terlalu mepet */
            .navbar-sekolah .navbar-collapse {
                border-top: 1px solid #eee;
            }

        }

    </style>

</head>

<body>


<!-- =====================================================
     NAVBAR
     ===================================================== -->

<nav class="navbar navbar-default navbar-fixed-top navbar-sekolah">

    <div class="container-fluid">


        <!-- =================================================
             HEADER NAVBAR
             ================================================= -->

        <div class="navbar-header">

            <!-- Tombol hamburger HP -->
            <button type="button"
                    class="navbar-toggle collapsed"
                    data-toggle="collapse"
                    data-target="#menuNavbarSekolah"
                    aria-expanded="false">

                <span class="sr-only">
                    Buka Menu
                </span>

                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>

            </button>


            <!-- Logo dan nama sekolah -->
            <a class="navbar-brand" href="index.php">

                <img src="../images/logo.jpeg"
                     alt="Logo MTs Nurul Huda">

                MTs Nurul Huda Pematang Cengal

            </a>

        </div>


        <!-- =================================================
             MENU
             ================================================= -->

        <div class="collapse navbar-collapse"
             id="menuNavbarSekolah">

            <ul class="nav navbar-nav navbar-right">


                <!-- BERANDA -->
                <li class="<?php

                    if ($halaman == 'index.php') {
                        echo 'active';
                    }

                ?>">

                    <a href="index.php">

                        <span class="glyphicon glyphicon-home"></span>
                        Beranda

                    </a>

                </li>


                <!-- PROFILE -->
                <li class="<?php

                    if ($halaman == 'profile.php') {
                        echo 'active';
                    }

                ?>">

                    <a href="profile.php">

                        <span class="glyphicon glyphicon-info-sign"></span>
                        Profile

                    </a>

                </li>


                <!-- PPDB -->
                <li class="<?php

                    if ($halaman == 'ppdb.php') {
                        echo 'active';
                    }

                ?>">

                    <a href="ppdb.php">

                        <span class="glyphicon glyphicon-user"></span>
                        PPDB

                    </a>

                </li>


                <!-- =================================================
                     INFORMASI
                     ================================================= -->

                <li class="dropdown <?php

                    if ($informasiAktif) {
                        echo 'active';
                    }

                ?>">

                    <a href="#"
                       class="dropdown-toggle"
                       data-toggle="dropdown"
                       role="button"
                       aria-haspopup="true"
                       aria-expanded="false">

                        <span class="glyphicon glyphicon-info-sign"></span>

                        Informasi

                        <span class="caret"></span>

                    </a>


                    <ul class="dropdown-menu">


                        <!-- Berita -->
                        <li>

                            <a href="berita.php">

                                <span class="glyphicon glyphicon-list-alt"></span>
                                &nbsp; Berita

                            </a>

                        </li>


                        <!-- Agenda -->
                        <li>

                            <a href="agenda.php">

                                <span class="glyphicon glyphicon-calendar"></span>
                                &nbsp; Agenda

                            </a>

                        </li>


                        <!-- Ekstrakurikuler -->
                        <li>

                            <a href="ekstrakurikuler.php">

                                <span class="glyphicon glyphicon-flag"></span>
                                &nbsp; Ekstrakurikuler

                            </a>

                        </li>


                        <!-- Prestasi -->
                        <li>

                            <a href="prestasi.php">

                                <span class="glyphicon glyphicon-star"></span>
                                &nbsp; Prestasi

                            </a>

                        </li>


                    </ul>

                </li>


                <!-- GALERI -->
                <li class="<?php

                    if ($halaman == 'galeri.php') {
                        echo 'active';
                    }

                ?>">

                    <a href="galeri.php">

                        <span class="glyphicon glyphicon-picture"></span>
                        Galeri

                    </a>

                </li>


                <!-- KONTAK -->
                <li class="<?php

                    if ($halaman == 'kontak.php') {
                        echo 'active';
                    }

                ?>">

                    <a href="kontak.php">

                        <span class="glyphicon glyphicon-earphone"></span>
                        Kontak

                    </a>

                </li>


                <!-- ADMIN -->
                <li>

                    <a href="../admin/login.php">

                        <span class="glyphicon glyphicon-lock"></span>
                        Admin

                    </a>

                </li>


            </ul>

        </div>

    </div>

</nav>




<script src="../bootstrap/js/jquery.min.js"></script>

<script src="../bootstrap/js/bootstrap.min.js"></script>

<script src="../bootstrap/js/jquery.dataTables.js"></script>

<script src="../bootstrap/js/dataTables.bootstrap.min.js"></script>

<script src="../bootstrap/js/scripts.js"></script>