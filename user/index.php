<?php

include "../koneksi.php";

/* =========================================================
   DATA SAMBUTAN KEPALA MADRASAH
   ========================================================= */
$query_sambutan = mysqli_query(
    $koneksi,
    "SELECT *
     FROM sambutan
     WHERE status = 'Aktif'
     ORDER BY id_sambutan DESC
     LIMIT 1"
);

$sambutan = mysqli_fetch_assoc($query_sambutan);


/* =========================================================
   DATA FASILITAS
   ========================================================= */
$query_fasilitas = mysqli_query(
    $koneksi,
    "SELECT *
     FROM fasilitas
     ORDER BY id_fasilitas ASC"
);


/* =========================================================
   FUNGSI ESCAPE
   ========================================================= */
function e($value)
{
    return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}

?>

<?php include "navbar.php"; ?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MTs Nurul Huda Pematang Cengal</title>

    <style>

        html {
            scroll-behavior: smooth;
        }

        body {
            background: #f5f7f6;
            color: #333;
            font-family: Arial, Helvetica, sans-serif;
            padding-top: 70px;
            overflow-x: hidden;
        }

        img {
            max-width: 100%;
        }

        .beranda-container {
            padding-bottom: 10px;
        }

        /* =====================================================
           BANNER SLIDESHOW
           ===================================================== */

        .home-banner {
            position: relative;
            width: 100%;
            height: 410px;
            background-image: url('../images/sekolah.jpeg');
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            border-radius: 12px;
            overflow: hidden;
            margin-top: 20px;
            margin-bottom: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .home-slide {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
            opacity: 0;
            transition: opacity 1.5s ease-in-out;
        }

        .home-slide.active {
            opacity: 1;
        }

        .home-banner-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 2;
            background: linear-gradient(135deg, rgba(0, 0, 0, 0.72), rgba(0, 0, 0, 0.42));
        }

        .home-banner-content {
            position: relative;
            z-index: 3;
            width: 100%;
            max-width: 900px;
            margin: 0 auto;
            padding: 30px;
            text-align: center;
            color: #e7e1e1;
        }

        .home-banner-content h1 {
            margin: 0 0 15px;
            font-size: 46px;
            line-height: 1.2;
            font-weight: bold;
            text-shadow: 0 3px 8px rgba(0, 0, 0, 0.45);
        }

        .home-banner-content h2 {
            margin: 0 0 18px;
            font-size: 29px;
            line-height: 1.4;
            font-weight: bold;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.7);
        }

        .home-banner-content p {
            max-width: 760px;
            margin: 0 auto 25px;
            font-size: 17px;
            line-height: 1.8;
            text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.8);
        }

        /* =====================================================
           TOMBOL PPDB ONLINE (BANNER)
           ===================================================== */

        .home-btn-ppdb-banner {
            display: inline-block;
            padding: 13px 25px;
            background: #5cb85c;
            color: #fff;
            font-size: 17px;
            font-weight: bold;
            text-decoration: none;
            border-radius: 5px;
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.3);
            transition: all 0.3s ease;
        }

        .home-btn-ppdb-banner:hover,
        .home-btn-ppdb-banner:focus {
            background: #449d44;
            color: #fff;
            text-decoration: none;
            transform: translateY(-2px);
        }

        /* =====================================================
           JUDUL SEKSI
           ===================================================== */

        .home-section-title {
            text-align: center;
            margin-top: 45px;
            margin-bottom: 30px;
        }

        .home-section-title h3 {
            margin: 0 0 12px;
            color: #087f3d;
            font-size: 28px;
            font-weight: bold;
        }

        .home-section-title h3:after {
            content: "";
            display: block;
            width: 55px;
            height: 3px;
            margin: 12px auto 0;
            background: #087f3d;
            border-radius: 5px;
        }

        .home-section-title p {
            max-width: 700px;
            margin: 15px auto 0;
            color: #df0808;
            font-size: 15px;
            line-height: 1.7;
        }

        /* =====================================================
           SAMBUTAN KEPALA MADRASAH
           ===================================================== */

        .home-sambutan {
            background: #ffffff;
            border: 1px solid #e92a2a;
            border-radius: 12px;
            margin-bottom: 40px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        }

        .home-sambutan-header {
            padding: 16px 20px;
            background: #087f3d;
            color: #fff;
        }

        .home-sambutan-header h3 {
            margin: 0;
            font-size: 19px;
            font-weight: bold;
        }

        .home-sambutan-header .glyphicon {
            margin-right: 8px;
        }

        .home-sambutan-body {
            padding: 30px;
        }

        .home-sambutan-profile {
            text-align: center;
        }

        .home-sambutan-photo {
            width: 175px;
            height: 175px;
            object-fit: cover;
            border-radius: 50%;
            border: 5px solid #40ff86;
            box-shadow: 0 5px 18px rgba(0, 0, 0, 0.15);
        }

        .home-sambutan-name {
            margin-top: 15px;
            margin-bottom: 5px;
            color: #087f3d;
            font-size: 17px;
            font-weight: bold;
        }

        .home-sambutan-position {
            color: #777;
            font-size: 14px;
        }

        .home-sambutan-text {
            color: #444;
            font-size: 15px;
            line-height: 1.9;
            text-align: justify;
        }

        .home-sambutan-text p {
            margin-bottom: 12px;
        }

        /* =====================================================
           PROFIL / VISI / MISI
           ===================================================== */

        .home-info-card {
            height: 100%;
            min-height: 245px;
            background: #fff;
            border-radius: 10px;
            overflow: hidden;
            margin-bottom: 25px;
            border: 1px solid #e5e5e5;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.07);
            transition: transform 0.25s ease, box-shadow 0.25s ease;
        }

        .home-info-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 22px rgba(0, 0, 0, 0.11);
        }

        .home-info-heading {
            padding: 15px 18px;
            color: #fff;
            font-size: 17px;
            font-weight: bold;
        }

        .home-info-heading .glyphicon {
            margin-right: 7px;
        }

        .home-info-heading.profile {
            background: #337ab7;
        }

        .home-info-heading.visi {
            background: #087f3d;
        }

        .home-info-heading.misi {
            background: #f0ad4e;
        }

        .home-info-body {
            padding: 22px;
            color: #555;
            font-size: 14px;
            line-height: 1.8;
        }

        .home-info-body p {
            margin: 0;
        }

        .home-misi-list {
            margin: 0;
            padding-left: 20px;
        }

        .home-misi-list li {
            margin-bottom: 9px;
        }

        .home-misi-list li:last-child {
            margin-bottom: 0;
        }

        /* =====================================================
           FASILITAS
           ===================================================== */

        .home-fasilitas-section {
            margin-top: 50px;
            margin-bottom: 45px;
        }

        .home-fasilitas-card {
            height: 100%;
            background: #fff;
            border-radius: 10px;
            overflow: hidden;
            margin-bottom: 25px;
            border: 1px solid #e6e6e6;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.07);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .home-fasilitas-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.13);
        }

        .home-fasilitas-image {
            width: 100%;
            height: 190px;
            overflow: hidden;
            background: #eee;
        }

        .home-fasilitas-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s ease;
        }

        .home-fasilitas-card:hover .home-fasilitas-image img {
            transform: scale(1.06);
        }

        .home-fasilitas-content {
            padding: 20px 18px 22px;
            text-align: center;
        }

        .home-fasilitas-content h4 {
            margin: 0 0 12px;
            color: #087f3d;
            font-size: 19px;
            font-weight: bold;
        }

        .home-fasilitas-content h4 .glyphicon {
            margin-right: 5px;
        }

        .home-fasilitas-content p {
            margin: 0;
            color: #666;
            font-size: 14px;
            line-height: 1.7;
            text-align: justify;
        }

        /* =====================================================
           PROGRAM HARIAN
           ===================================================== */

        .home-program-section {
            margin-top: 50px;
            margin-bottom: 45px;
        }

        .home-program-card {
            min-height: 205px;
            background: #fff;
            border-radius: 10px;
            padding: 22px 18px;
            margin-bottom: 25px;
            border: 1px solid #e6e6e6;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.07);
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .home-program-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.12);
        }

        .home-program-icon {
            width: 58px;
            height: 58px;
            line-height: 58px;
            margin: 0 auto 12px;
            border-radius: 50%;
            background: #eaf5ee;
            color: #087f3d;
            font-size: 25px;
        }

        .home-program-day {
            margin-bottom: 9px;
            color: #087f3d;
            font-size: 17px;
            font-weight: bold;
        }

        .home-program-card h4 {
            margin: 0 0 9px;
            color: #333;
            font-size: 16px;
            font-weight: bold;
            line-height: 1.4;
        }

        .home-program-card p {
            margin: 0;
            color: #666;
            font-size: 13px;
            line-height: 1.7;
        }

        /* =====================================================
           PENDIDIKAN GRATIS
           ===================================================== */

        .home-gratis-section {
            margin-top: 45px;
            margin-bottom: 45px;
        }

        .home-gratis-box {
            position: relative;
            overflow: hidden;
            padding: 45px 30px;
            border-radius: 12px;
            background: linear-gradient(135deg, #087f3d, #065f2e);
            color: #fff;
            text-align: center;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .home-gratis-box:before {
            content: "";
            position: absolute;
            width: 180px;
            height: 180px;
            top: -70px;
            left: -50px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.08);
        }

        .home-gratis-box:after {
            content: "";
            position: absolute;
            width: 220px;
            height: 220px;
            right: -60px;
            bottom: -100px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.06);
        }

        .home-gratis-content {
            position: relative;
            z-index: 2;
        }

        .home-gratis-icon {
            margin-bottom: 10px;
            font-size: 45px;
        }

        .home-gratis-box h2 {
            margin: 5px 0 10px;
            font-size: 34px;
            font-weight: bold;
            line-height: 1.3;
        }

        .home-gratis-box h3 {
            margin: 0 0 15px;
            font-size: 23px;
            font-weight: bold;
            line-height: 1.4;
        }

        .home-gratis-box p {
            max-width: 750px;
            margin: 0 auto 23px;
            font-size: 15px;
            line-height: 1.8;
        }

        .home-btn-ppdb {
            display: inline-block;
            padding: 11px 22px;
            background: #fff;
            color: #087f3d;
            border-radius: 6px;
            font-size: 14px;
            font-weight: bold;
            text-decoration: none;
            transition: all 0.25s ease;
        }

        .home-btn-ppdb:hover,
        .home-btn-ppdb:focus {
            background: #044d25;
            color: #fff;
            text-decoration: none;
            transform: translateY(-2px);
        }

        /* =====================================================
           INFORMASI SEKOLAH
           ===================================================== */

        .home-menu-section {
            margin-top: 50px;
            margin-bottom: 45px;
        }

        .home-menu-card-wrapper {
            margin-bottom: 25px;
        }

        .home-menu-card {
            display: block;
            height: 100%;
            overflow: hidden;
            background: #fff;
            border-radius: 10px;
            border: 1px solid #e5e5e5;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.07);
            text-decoration: none;
            color: #333;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .home-menu-card:hover,
        .home-menu-card:focus {
            color: #333;
            text-decoration: none;
            transform: translateY(-6px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.13);
        }

        .home-menu-image {
            width: 100%;
            height: 175px;
            overflow: hidden;
            background: #eee;
        }

        .home-menu-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s ease;
        }

        .home-menu-card:hover .home-menu-image img {
            transform: scale(1.06);
        }

        .home-menu-content {
            padding: 20px 15px 22px;
            text-align: center;
        }

        .home-menu-content h4 {
            margin: 0 0 10px;
            color: #087f3d;
            font-size: 18px;
            font-weight: bold;
        }

        .home-menu-content h4 .glyphicon {
            margin-right: 5px;
        }

        .home-menu-content p {
            min-height: 45px;
            margin: 0 0 15px;
            color: #666;
            font-size: 13px;
            line-height: 1.7;
        }

        .home-menu-button {
            display: inline-block;
            padding: 8px 15px;
            border-radius: 5px;
            background: #087f3d;
            color: #fff;
            font-size: 13px;
            transition: background 0.25s ease;
        }

        .home-menu-card:hover .home-menu-button {
            background: #065f2e;
            color: #fff;
        }

        /* =====================================================
           GOOGLE MAPS
           ===================================================== */

        .home-map-section {
            margin-top: 45px;
            margin-bottom: 45px;
        }

        .home-map-box {
            overflow: hidden;
            background: #fff;
            border-radius: 10px;
            border: 1px solid #e5e5e5;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.07);
        }

        .home-map-header {
            padding: 16px 20px;
            background: #087f3d;
            color: #fff;
        }

        .home-map-header h3 {
            margin: 0;
            font-size: 19px;
            font-weight: bold;
        }

        .home-map-header .glyphicon {
            margin-right: 8px;
        }

        .home-map-container {
            position: relative;
            width: 100%;
            height: 400px;
            overflow: hidden;
        }

        .home-map-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: 0;
        }

        .home-map-button {
            padding: 15px;
            text-align: center;
            background: #fff;
        }

        /* =====================================================
           RESPONSIVE - TABLET (max-width: 991px)
           ===================================================== */

        @media (max-width: 991px) {

            .home-banner {
                height: 360px;
            }

            .home-banner-content h1 {
                font-size: 40px;
            }

            .home-banner-content h2 {
                font-size: 26px;
            }

            .home-banner-content p {
                font-size: 16px;
            }

            .home-sambutan-photo {
                width: 155px;
                height: 155px;
            }

            .home-info-card {
                min-height: 230px;
            }

            .home-gratis-box h2 {
                font-size: 30px;
            }

            .home-gratis-box h3 {
                font-size: 21px;
            }

            .home-map-container {
                height: 350px;
            }
        }

        /* =====================================================
           RESPONSIVE - HP (max-width: 767px)
           ===================================================== */

        @media (max-width: 767px) {

            body {
                padding-top: 70px;
            }

            .beranda-container {
                padding-left: 15px;
                padding-right: 15px;
            }

            /* Banner */
            .home-banner {
                height: 350px;
                margin-top: 10px;
                margin-bottom: 30px;
                border-radius: 8px;
            }

            .home-banner-content {
                padding: 20px 15px;
            }

            .home-banner-content h1 {
                font-size: 29px;
                line-height: 1.3;
            }

            .home-banner-content h2 {
                font-size: 20px;
                line-height: 1.4;
            }

            .home-banner-content p {
                font-size: 14px;
                line-height: 1.7;
            }

            /* Judul seksi */
            .home-section-title {
                margin-top: 30px;
                margin-bottom: 23px;
            }

            .home-section-title h3 {
                font-size: 24px;
            }

            .home-section-title p {
                font-size: 14px;
            }

            /* Sambutan */
            .home-sambutan {
                margin-bottom: 30px;
            }

            .home-sambutan-header {
                padding: 14px 15px;
            }

            .home-sambutan-header h3 {
                font-size: 16px;
            }

            .home-sambutan-body {
                padding: 22px 15px;
            }

            .home-sambutan-photo {
                width: 135px;
                height: 135px;
            }

            .home-sambutan-text {
                margin-top: 25px;
                font-size: 14px;
                line-height: 1.8;
            }

            /* Profil */
            .home-info-card {
                min-height: auto;
                margin-bottom: 20px;
            }

            .home-info-heading {
                padding: 13px 15px;
                font-size: 16px;
            }

            .home-info-body {
                padding: 18px 15px;
                font-size: 14px;
            }

            /* Fasilitas */
            .home-fasilitas-section {
                margin-top: 30px;
                margin-bottom: 30px;
            }

            .home-fasilitas-image {
                height: 190px;
            }

            .home-fasilitas-content {
                padding: 18px 15px 20px;
            }

            .home-fasilitas-content h4 {
                font-size: 18px;
            }

            .home-fasilitas-content p {
                font-size: 13px;
            }

            /* Program */
            .home-program-section {
                margin-top: 35px;
                margin-bottom: 30px;
            }

            .home-program-card {
                min-height: auto;
                padding: 20px 15px;
                margin-bottom: 20px;
            }

            .home-program-card h4 {
                font-size: 16px;
            }

            .home-program-card p {
                font-size: 13px;
            }

            /* Gratis */
            .home-gratis-section {
                margin-top: 30px;
                margin-bottom: 30px;
            }

            .home-gratis-box {
                padding: 35px 20px;
            }

            .home-gratis-icon {
                font-size: 38px;
            }

            .home-gratis-box h2 {
                font-size: 27px;
            }

            .home-gratis-box h3 {
                font-size: 20px;
            }

            .home-gratis-box p {
                font-size: 14px;
            }

            .home-btn-ppdb {
                padding: 11px 17px;
                font-size: 13px;
            }

            /* Menu informasi */
            .home-menu-section {
                margin-top: 35px;
                margin-bottom: 30px;
            }

            .home-menu-image {
                height: 190px;
            }

            .home-menu-content {
                padding: 18px 15px 20px;
            }

            .home-menu-content h4 {
                font-size: 18px;
            }

            .home-menu-content p {
                font-size: 13px;
            }

            /* Map */
            .home-map-section {
                margin-top: 30px;
                margin-bottom: 30px;
            }

            .home-map-header {
                padding: 14px 15px;
            }

            .home-map-header h3 {
                font-size: 17px;
            }

            .home-map-container {
                height: 300px;
            }
        }

        /* =====================================================
           RESPONSIVE - HP KECIL (max-width: 480px)
           ===================================================== */

        @media (max-width: 480px) {

            .home-banner {
                height: 320px;
            }

            .home-banner-content h1 {
                font-size: 25px;
            }

            .home-banner-content h2 {
                font-size: 18px;
            }

            .home-banner-content p {
                font-size: 13px;
            }

            .home-sambutan-photo {
                width: 120px;
                height: 120px;
            }

            .home-fasilitas-image {
                height: 170px;
            }

            .home-menu-image {
                height: 170px;
            }

            .home-gratis-box {
                padding: 30px 15px;
            }

            .home-gratis-box h2 {
                font-size: 23px;
            }

            .home-gratis-box h3 {
                font-size: 18px;
            }

            .home-map-container {
                height: 270px;
            }
        }

    </style>
</head>

<body>

<div class="container beranda-container">


    <div class="home-banner">

        <div class="home-slide active" style="background-image: url('../images/sekolah.jpeg');"></div>
        <div class="home-slide" style="background-image: url('../images/logo2.jpeg');"></div>
        <div class="home-slide" style="background-image: url('../images/logo3.jpeg');"></div>

        <div class="home-banner-overlay"></div>

        <div class="home-banner-content">

            <h1>Selamat Datang di Website</h1>

            <h2>MTs Nurul Huda Pematang Cengal</h2>

            <p>
                Madrasah yang unggul dalam prestasi,
                berakhlakul karimah, dan berwawasan teknologi.
            </p>

            <a href="ppdb.php" class="home-btn-ppdb-banner">
                <span class="glyphicon glyphicon-edit"></span>
                PPDB Online
                <span class="glyphicon glyphicon-arrow-right"></span>
            </a>

        </div>

    </div>


    <!-- =====================================================
         SAMBUTAN KEPALA MADRASAH
         ===================================================== -->

    <?php if ($sambutan) { ?>

        <div class="home-sambutan">

            <div class="home-sambutan-header">
                <h3>
                    <span class="glyphicon glyphicon-user"></span>
                    Sambutan Kepala Madrasah
                </h3>
            </div>

            <div class="home-sambutan-body">
                <div class="row">

                    <!-- FOTO -->
                    <div class="col-md-3 col-sm-4">
                        <div class="home-sambutan-profile">

                            <?php if (!empty($sambutan['foto'])) { ?>
                                <img
                                    src="../images/<?php echo e($sambutan['foto']); ?>"
                                    class="home-sambutan-photo"
                                    alt="<?php echo e($sambutan['nama_kepala']); ?>"
                                >
                            <?php } else { ?>
                                <img
                                    src="../images/sekolah.jpeg"
                                    class="home-sambutan-photo"
                                    alt="Kepala Madrasah"
                                >
                            <?php } ?>

                            <div class="home-sambutan-name">
                                <?php echo e($sambutan['nama_kepala']); ?>
                            </div>

                            <div class="home-sambutan-position">
                                <?php echo e($sambutan['jabatan']); ?>
                            </div>

                        </div>
                    </div>

                    <!-- ISI SAMBUTAN -->
                    <div class="col-md-9 col-sm-8">
                        <div class="home-sambutan-text">
                            <?php echo nl2br(e($sambutan['isi_sambutan'])); ?>
                        </div>
                    </div>

                </div>
            </div>

        </div>

    <?php } else { ?>

        <div class="alert alert-warning text-center">
            <span class="glyphicon glyphicon-info-sign"></span>
            Data sambutan kepala madrasah belum tersedia.
        </div>

    <?php } ?>


    <!-- =====================================================
         PROFIL - VISI - MISI
         ===================================================== -->

    <div class="row">

        <!-- PROFIL -->
        <div class="col-md-4">
            <div class="home-info-card">
                <div class="home-info-heading profile">
                    <span class="glyphicon glyphicon-home"></span>
                    Profil Sekolah
                </div>
                <div class="home-info-body">
                    <p>
                        MTs Nurul Huda Pematang Cengal
                        merupakan madrasah yang berkomitmen
                        dalam menghasilkan peserta didik
                        yang berprestasi, berakhlak mulia,
                        dan memiliki wawasan teknologi.
                    </p>
                </div>
            </div>
        </div>

        <!-- VISI -->
        <div class="col-md-4">
            <div class="home-info-card">
                <div class="home-info-heading visi">
                    <span class="glyphicon glyphicon-eye-open"></span>
                    Visi
                </div>
                <div class="home-info-body">
                    <p>
                        Menjadi madrasah yang unggul,
                        religius, berprestasi,
                        berkarakter, dan berwawasan
                        teknologi.
                    </p>
                </div>
            </div>
        </div>

        <!-- MISI -->
        <div class="col-md-4">
            <div class="home-info-card">
                <div class="home-info-heading misi">
                    <span class="glyphicon glyphicon-list"></span>
                    Misi
                </div>
                <div class="home-info-body">
                    <ul class="home-misi-list">
                        <li>Meningkatkan iman dan takwa.</li>
                        <li>Meningkatkan kualitas pembelajaran.</li>
                        <li>Mengembangkan bakat dan potensi siswa.</li>
                    </ul>
                </div>
            </div>
        </div>

    </div>


    <!-- =====================================================
         FASILITAS MADRASAH
         ===================================================== -->

    <div class="home-fasilitas-section">

        <div class="home-section-title">
            <h3>Fasilitas Madrasah</h3>
            <p>
                Berbagai fasilitas yang tersedia untuk
                mendukung kegiatan belajar, ibadah,
                olahraga, dan aktivitas siswa
                di MTs Nurul Huda Pematang Cengal.
            </p>
        </div>

        <div class="row">

            <?php if (mysqli_num_rows($query_fasilitas) > 0) { ?>

                <?php while ($fasilitas = mysqli_fetch_assoc($query_fasilitas)) { ?>

                    <div class="col-md-4 col-sm-6">
                        <div class="home-fasilitas-card">

                            <div class="home-fasilitas-image">
                                <?php if (!empty($fasilitas['gambar'])) { ?>
                                    <img
                                        src="../images/<?php echo e($fasilitas['gambar']); ?>"
                                        alt="<?php echo e($fasilitas['nama_fasilitas']); ?>"
                                    >
                                <?php } else { ?>
                                    <img
                                        src="../images/sekolah.jpeg"
                                        alt="Fasilitas Madrasah"
                                    >
                                <?php } ?>
                            </div>

                            <div class="home-fasilitas-content">
                                <h4>
                                    <span class="glyphicon glyphicon-home"></span>
                                    <?php echo e($fasilitas['nama_fasilitas']); ?>
                                </h4>
                                <p><?php echo e($fasilitas['penjelasan']); ?></p>
                            </div>

                        </div>
                    </div>

                <?php } ?>

            <?php } else { ?>

                <div class="col-md-12">
                    <div class="alert alert-info text-center">
                        <span class="glyphicon glyphicon-info-sign"></span>
                        Data fasilitas madrasah belum tersedia.
                    </div>
                </div>

            <?php } ?>

        </div>

    </div>


    <!-- =====================================================
         PROGRAM HARIAN
         ===================================================== -->

    <div class="home-program-section">

        <div class="home-section-title">
            <h3>Program Harian Madrasah</h3>
            <p>
                Kegiatan pembiasaan harian untuk
                membentuk siswa yang disiplin,
                sehat, religius, dan berkarakter.
            </p>
        </div>

        <div class="row">

            <!-- SENIN -->
            <div class="col-md-4 col-sm-6">
                <div class="home-program-card">
                    <div class="home-program-icon">
                        <span class="glyphicon glyphicon-flag"></span>
                    </div>
                    <div class="home-program-day">Senin</div>
                    <h4>Upacara Bendera</h4>
                    <p>
                        Pelaksanaan upacara bendera
                        sebagai sarana membangun
                        kedisiplinan, nasionalisme,
                        dan rasa tanggung jawab siswa.
                    </p>
                </div>
            </div>

            <!-- SELASA -->
            <div class="col-md-4 col-sm-6">
                <div class="home-program-card">
                    <div class="home-program-icon">
                        <span class="glyphicon glyphicon-th-list"></span>
                    </div>
                    <div class="home-program-day">Selasa</div>
                    <h4>Baris di Depan Kelas</h4>
                    <p>
                        Kegiatan baris sebelum pembelajaran
                        untuk membentuk kedisiplinan,
                        ketertiban, dan kesiapan siswa
                        mengikuti kegiatan belajar.
                    </p>
                </div>
            </div>

            <!-- RABU -->
            <div class="col-md-4 col-sm-6">
                <div class="home-program-card">
                    <div class="home-program-icon">
                        <span class="glyphicon glyphicon-th-list"></span>
                    </div>
                    <div class="home-program-day">Rabu</div>
                    <h4>Baris di Depan Kelas</h4>
                    <p>
                        Pembiasaan baris dengan tertib
                        sebelum pembelajaran sebagai
                        bentuk penguatan karakter
                        disiplin peserta didik.
                    </p>
                </div>
            </div>

            <!-- KAMIS -->
            <div class="col-md-4 col-sm-6">
                <div class="home-program-card">
                    <div class="home-program-icon">
                        <span class="glyphicon glyphicon-heart"></span>
                    </div>
                    <div class="home-program-day">Kamis</div>
                    <h4>Sholawatan dan Sholat Duha</h4>
                    <p>
                        Kegiatan keagamaan berupa
                        sholawatan dan sholat dhuha
                        untuk membangun pembiasaan
                        ibadah dan akhlakul karimah.
                    </p>
                </div>
            </div>

            <!-- JUMAT -->
            <div class="col-md-4 col-sm-6">
                <div class="home-program-card">
                    <div class="home-program-icon">
                        <span class="glyphicon glyphicon-book"></span>
                    </div>
                    <div class="home-program-day">Jum'at</div>
                    <h4>Membaca Yasin</h4>
                    <p>
                        Pembacaan Surah Yasin secara
                        bersama-sama sebagai bentuk
                        pembiasaan kegiatan keagamaan
                        dan peningkatan nilai spiritual.
                    </p>
                </div>
            </div>

            <!-- SABTU -->
            <div class="col-md-4 col-sm-6">
                <div class="home-program-card">
                    <div class="home-program-icon">
                        <span class="glyphicon glyphicon-education"></span>
                    </div>
                    <div class="home-program-day">Sabtu</div>
                    <h4>Senam Sehat Seluruh Siswa</h4>
                    <p>
                        Kegiatan senam bersama seluruh
                        siswa untuk menjaga kebugaran,
                        kesehatan, dan meningkatkan
                        semangat sebelum mengikuti
                        aktivitas sekolah.
                    </p>
                </div>
            </div>

        </div>

    </div>


    <!-- =====================================================
         PENDIDIKAN GRATIS
         ===================================================== -->

    <div class="home-gratis-section">
        <div class="home-gratis-box">
            <div class="home-gratis-content">

                <div class="home-gratis-icon">
                    <span class="glyphicon glyphicon-education"></span>
                </div>

                <h2>Pendidikan Gratis</h2>

                <h3>Pendidikan Berkualitas untuk Semua</h3>

                <p>
                    MTs Nurul Huda Pematang Cengal
                    berkomitmen memberikan kesempatan
                    pendidikan yang berkualitas bagi
                    seluruh peserta didik.
                    <br>
                    <strong>Tidak ada biaya pendidikan.</strong>
                    Mari bergabung dan wujudkan masa
                    depan yang lebih baik bersama
                    MTs Nurul Huda Pematang Cengal.
                </p>

                <a href="ppdb.php" class="home-btn-ppdb">
                    <span class="glyphicon glyphicon-edit"></span>
                    &nbsp;Daftar PPDB Sekarang&nbsp;
                    <span class="glyphicon glyphicon-arrow-right"></span>
                </a>

            </div>
        </div>
    </div>


    <!-- =====================================================
         INFORMASI SEKOLAH
         ===================================================== -->

    <div class="home-menu-section">

        <div class="home-section-title">
            <h3>Informasi Sekolah</h3>
            <p>
                Temukan berbagai informasi,
                kegiatan, prestasi, dan layanan
                MTs Nurul Huda Pematang Cengal.
            </p>
        </div>

        <div class="row">

          
            <div class="col-md-4 col-sm-6">
                <div class="home-menu-card-wrapper">
                    <a href="berita.php" class="home-menu-card">
                        <div class="home-menu-image">
                            <img src="../images/berita.jpeg" alt="Berita Sekolah">
                        </div>
                        <div class="home-menu-content">
                            <h4>
                                <span class="glyphicon glyphicon-list-alt"></span>
                                Berita
                            </h4>
                            <p>
                                Informasi dan berita terbaru
                                seputar kegiatan MTs Nurul Huda.
                            </p>
                            <span class="home-menu-button">
                                Lihat Berita
                                <span class="glyphicon glyphicon-arrow-right"></span>
                            </span>
                        </div>
                    </a>
                </div>
            </div>

            
            <div class="col-md-4 col-sm-6">
                <div class="home-menu-card-wrapper">
                    <a href="agenda.php" class="home-menu-card">
                        <div class="home-menu-image">
                            <img src="../images/agenda.jpeg" alt="Agenda Sekolah">
                        </div>
                        <div class="home-menu-content">
                            <h4>
                                <span class="glyphicon glyphicon-calendar"></span>
                                Agenda
                            </h4>
                            <p>
                                Jadwal kegiatan dan agenda
                                sekolah yang akan dilaksanakan.
                            </p>
                            <span class="home-menu-button">
                                Lihat Agenda
                                <span class="glyphicon glyphicon-arrow-right"></span>
                            </span>
                        </div>
                    </a>
                </div>
            </div>

           
            <div class="col-md-4 col-sm-6">
                <div class="home-menu-card-wrapper">
                    <a href="prestasi.php" class="home-menu-card">
                        <div class="home-menu-image">
                            <img src="../images/prestasi.jpeg" alt="Prestasi">
                        </div>
                        <div class="home-menu-content">
                            <h4>
                                <span class="glyphicon glyphicon-star"></span>
                                Prestasi
                            </h4>
                            <p>
                                Prestasi akademik dan
                                non-akademik siswa MTs Nurul Huda.
                            </p>
                            <span class="home-menu-button">
                                Lihat Prestasi
                                <span class="glyphicon glyphicon-arrow-right"></span>
                            </span>
                        </div>
                    </a>
                </div>
            </div>

            
            <div class="col-md-4 col-sm-6">
                <div class="home-menu-card-wrapper">
                    <a href="ekstrakurikuler.php" class="home-menu-card">
                        <div class="home-menu-image">
                            <img src="../images/eskul.jpeg" alt="Ekstrakurikuler">
                        </div>
                        <div class="home-menu-content">
                            <h4>
                                <span class="glyphicon glyphicon-flag"></span>
                                Ekstrakurikuler
                            </h4>
                            <p>
                                Berbagai kegiatan untuk
                                mengembangkan minat dan bakat siswa.
                            </p>
                            <span class="home-menu-button">
                                Lihat Ekstrakurikuler
                                <span class="glyphicon glyphicon-arrow-right"></span>
                            </span>
                        </div>
                    </a>
                </div>
            </div>

            
            <div class="col-md-4 col-sm-6">
                <div class="home-menu-card-wrapper">
                    <a href="galeri.php" class="home-menu-card">
                        <div class="home-menu-image">
                            <img src="../images/fotogaleri.jpeg" alt="Galeri">
                        </div>
                        <div class="home-menu-content">
                            <h4>
                                <span class="glyphicon glyphicon-picture"></span>
                                Galeri
                            </h4>
                            <p>
                                Dokumentasi berbagai kegiatan
                                dan aktivitas MTs Nurul Huda.
                            </p>
                            <span class="home-menu-button">
                                Lihat Galeri
                                <span class="glyphicon glyphicon-arrow-right"></span>
                            </span>
                        </div>
                    </a>
                </div>
            </div>

           
            <div class="col-md-4 col-sm-6">
                <div class="home-menu-card-wrapper">
                    <a href="data_guru.php" class="home-menu-card">
                        <div class="home-menu-image">
                            <img src="../images/guru.jpeg" alt="Data Guru dan Staf">
                        </div>
                        <div class="home-menu-content">
                            <h4>
                                <span class="glyphicon glyphicon-education"></span>
                                Guru &amp; Staf
                            </h4>
                            <p>
                                Informasi tenaga pendidik
                                dan staf MTs Nurul Huda.
                            </p>
                            <span class="home-menu-button">
                                Lihat Guru &amp; Staf
                                <span class="glyphicon glyphicon-arrow-right"></span>
                            </span>
                        </div>
                    </a>
                </div>
            </div>

        </div>

    </div>



    <div class="home-map-section">
        <div class="home-map-box">

            <div class="home-map-header">
                <h3>
                    <span class="glyphicon glyphicon-map-marker"></span>
                    Lokasi Sekolah
                </h3>
            </div>

            <div class="home-map-container">
                <iframe
                    src="https://www.google.com/maps?q=XF24%2BJHM%2C%20Dusun%20Serbaguna%2C%20Pematang%20Cengal%2C%20Kec.%20Tj.%20Pura%2C%20Kabupaten%20Langkat%2C%20Sumatera%20Utara%2020853&output=embed"
                    loading="lazy"
                    allowfullscreen>
                </iframe>
            </div>

            <div class="home-map-button">
                <a href="https://maps.app.goo.gl/1RWTb3eCvYiRAHZW9" target="_blank" class="btn btn-success">
                    <span class="glyphicon glyphicon-map-marker"></span>
                    &nbsp;Lihat Lokasi di Google Maps
                </a>
            </div>

        </div>
    </div>

</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    var slides = document.querySelectorAll(".home-slide");
    var currentSlide = 0;
    var interval = 5000; // 5 detik

    setInterval(function () {
        slides[currentSlide].classList.remove("active");
        currentSlide++;
        if (currentSlide >= slides.length) {
            currentSlide = 0;
        }
        slides[currentSlide].classList.add("active");
    }, interval);
});
</script>

<?php include "footer.php"; ?>

</body>
</html>