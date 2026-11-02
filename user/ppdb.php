<?php

include "../koneksi.php";

/* =====================================================
   AMBIL DATA PPDB INFO
===================================================== */

$query_info = mysqli_query(
    $koneksi,
    "SELECT * FROM ppdb_info
     WHERE status = 'Aktif'
     ORDER BY id_ppdb DESC
     LIMIT 1"
);

if (!$query_info || mysqli_num_rows($query_info) == 0) {
    die("Data PPDB belum tersedia.");
}

$ppdb = mysqli_fetch_assoc($query_info);


/* =====================================================
   FUNGSI ESCAPE
===================================================== */

function e($data)
{
    return htmlspecialchars(
        $data ?? '',
        ENT_QUOTES,
        'UTF-8'
    );
}


/* =====================================================
   AMBIL DATA PERSYARATAN
===================================================== */

$query_syarat = mysqli_query(
    $koneksi,
    "SELECT *
     FROM ppdb_persyaratan
     WHERE status = 'Aktif'
     ORDER BY urutan ASC, id_persyaratan ASC"
);


/* =====================================================
   AMBIL DATA ALUR
===================================================== */

$query_alur = mysqli_query(
    $koneksi,
    "SELECT *
     FROM ppdb_alur
     WHERE status = 'Aktif'
     ORDER BY nomor ASC, id_alur ASC"
);

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="utf-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1">

    <title>
        PPDB - <?php echo e($ppdb['tahun_ajaran']); ?>
    </title>

    <style>

        /* =====================================================
           RESET
        ===================================================== */

        .ppdb-page,
        .ppdb-page * {
            box-sizing: border-box;
        }


        /* =====================================================
           BODY
        ===================================================== */

        body {
            background: #f4f7f5;
            color: #333;
            font-family: Arial, Helvetica, sans-serif;
            overflow-x: hidden;
        }


        /* =====================================================
           HALAMAN PPDB
        ===================================================== */

        .ppdb-page {
            width: 100%;
            padding-top: 30px;
            padding-bottom: 45px;
        }


        /* =====================================================
           CONTAINER
        ===================================================== */

        .ppdb-container {
            max-width: 1140px;
            margin: 0 auto;
        }


        /* =====================================================
           HERO
        ===================================================== */

        .ppdb-hero {
            position: relative;
            overflow: hidden;

            background: linear-gradient(
                135deg,
                #176b3a 0%,
                #2e8b57 100%
            );

            color: #fff;

            text-align: center;

            padding: 55px 35px;

            margin-bottom: 28px;

            border-radius: 16px;

            box-shadow:
                0 8px 25px rgba(0,0,0,0.12);
        }


        .ppdb-hero:before {
            content: "";

            position: absolute;

            width: 220px;
            height: 220px;

            border-radius: 50%;

            background: rgba(255,255,255,0.06);

            top: -90px;
            right: -70px;
        }


        .ppdb-hero:after {
            content: "";

            position: absolute;

            width: 180px;
            height: 180px;

            border-radius: 50%;

            background: rgba(255,255,255,0.05);

            bottom: -90px;
            left: -60px;
        }


        .ppdb-hero h1,
        .ppdb-hero h2,
        .ppdb-hero p,
        .ppdb-hero a {
            position: relative;
            z-index: 2;
        }


        .ppdb-hero h1 {
            margin: 0 0 12px;

            font-size: 40px;

            font-weight: bold;

            line-height: 1.3;
        }


        .ppdb-hero h2 {
            margin: 0 0 15px;

            font-size: 25px;

            font-weight: normal;

            line-height: 1.4;
        }


        .ppdb-hero p {
            margin: 0 0 28px;

            font-size: 16px;

            line-height: 1.8;

            color: rgba(255,255,255,0.92);
        }


        /* =====================================================
           BUTTON
        ===================================================== */

        .btn-daftar,
        .btn-cek {
            display: inline-block;

            padding: 13px 25px;

            margin: 4px;

            border-radius: 7px;

            font-size: 15px;

            font-weight: bold;

            text-decoration: none !important;

            transition: all 0.25s ease;
        }


        .btn-daftar {
            background: #ffc107;

            color: #222;

            border: 2px solid #ffc107;
        }


        .btn-daftar:hover,
        .btn-daftar:focus {
            background: #ffca28;

            color: #222;

            transform: translateY(-2px);

            box-shadow: 0 5px 12px rgba(0,0,0,0.15);
        }


        .btn-cek {
            background: #fff;

            color: #176b3a;

            border: 2px solid #fff;
        }


        .btn-cek:hover,
        .btn-cek:focus {
            background: #f1f1f1;

            color: #176b3a;

            transform: translateY(-2px);
        }


        /* =====================================================
           CARD UMUM
        ===================================================== */

        .info-card,
        .jadwal,
        .syarat,
        .alur,
        .biaya,
        .cta,
        .mengapa-ppdb {

            background: #fff;

            border: 1px solid #e8ece9;

            border-radius: 12px;

            padding: 25px;

            margin-bottom: 25px;

            box-shadow:
                0 4px 15px rgba(0,0,0,0.06);
        }


        /* =====================================================
           MENGAPA PPDB
        ===================================================== */

        .mengapa-header {
            text-align: center;

            margin-bottom: 25px;
        }


        .mengapa-header h2 {
            margin: 0 0 8px;

            color: #176b3a;

            font-size: 27px;

            font-weight: bold;

            line-height: 1.4;
        }


        .mengapa-header h2:after {
            content: "";

            display: block;

            width: 55px;

            height: 3px;

            background: #2e8b57;

            margin: 12px auto 0;
        }


        .mengapa-header p {
            margin: 15px auto 0;

            max-width: 700px;

            color: #777;

            font-size: 14px;

            line-height: 1.7;
        }


        .mengapa-item {
            height: 100%;

            padding: 22px 20px;

            background: #f8faf9;

            border: 1px solid #e6eee8;

            border-radius: 10px;

            transition: all 0.25s ease;
        }


        .mengapa-item:hover {
            transform: translateY(-4px);

            box-shadow:
                0 7px 18px rgba(0,0,0,0.08);
        }


        .mengapa-icon {
            width: 52px;
            height: 52px;

            line-height: 52px;

            text-align: center;

            border-radius: 12px;

            background: #e8f5e9;

            color: #176b3a;

            font-size: 22px;

            margin-bottom: 15px;
        }


        .mengapa-item h3 {
            margin: 0 0 8px;

            color: #176b3a;

            font-size: 17px;

            font-weight: bold;

            line-height: 1.4;
        }


        .mengapa-item p {
            margin: 0;

            color: #666;

            font-size: 13px;

            line-height: 1.7;
        }


        /* =====================================================
           INFO PPDB
        ===================================================== */

        .info-card {
            height: 100%;

            transition: all 0.25s ease;
        }


        .info-card:hover {
            transform: translateY(-3px);

            box-shadow:
                0 8px 20px rgba(0,0,0,0.09);
        }


        .info-icon {
            width: 55px;
            height: 55px;

            line-height: 55px;

            text-align: center;

            border-radius: 50%;

            background: #e8f5e9;

            color: #2e7d32;

            font-size: 24px;

            margin-bottom: 15px;
        }


        .info-card h3,
        .jadwal h3,
        .syarat h3,
        .alur h3 {

            margin-top: 0;

            margin-bottom: 15px;

            color: #2e7d32;

            font-size: 20px;

            font-weight: bold;

            line-height: 1.4;
        }


        .info-card p {
            color: #555;

            font-size: 14px;

            line-height: 1.8;

            margin: 0;
        }


        /* =====================================================
           JADWAL
        ===================================================== */

        .tanggal {
            background: #eaf7ee;

            border-left: 5px solid #2e7d32;

            padding: 18px;

            border-radius: 7px;

            color: #555;

            line-height: 1.8;
        }


        .tanggal strong {
            display: block;

            color: #2e7d32;

            font-size: 23px;

            margin-bottom: 6px;

            line-height: 1.4;
        }


        /* =====================================================
           PERSYARATAN
        ===================================================== */

        .syarat ol {
            margin: 0;

            padding-left: 25px;
        }


        .syarat li {
            padding: 11px 5px;

            border-bottom: 1px solid #eeeeee;

            color: #555;

            font-size: 14px;

            line-height: 1.7;
        }


        .syarat li:last-child {
            border-bottom: none;
        }


        .wajib {
            color: #d9534f;

            font-size: 11px;

            font-weight: bold;

            margin-left: 5px;

            background: #fcebea;

            padding: 3px 7px;

            border-radius: 4px;
        }


        .opsional {
            color: #777;

            font-size: 11px;

            margin-left: 5px;

            background: #f1f1f1;

            padding: 3px 7px;

            border-radius: 4px;
        }


        /* =====================================================
           ALUR
        ===================================================== */

        .alur-item {
            position: relative;

            padding: 16px 18px 16px 70px;

            margin-bottom: 14px;

            background: #f8faf9;

            border: 1px solid #e8eee9;

            border-radius: 9px;

            min-height: 68px;
        }


        .alur-item:last-child {
            margin-bottom: 0;
        }


        .alur-nomor {
            position: absolute;

            left: 17px;

            top: 15px;

            width: 40px;
            height: 40px;

            line-height: 40px;

            text-align: center;

            border-radius: 50%;

            background: #2e7d32;

            color: #fff;

            font-size: 16px;

            font-weight: bold;
        }


        .alur-item strong {
            display: block;

            margin-bottom: 5px;

            color: #333;

            font-size: 15px;

            line-height: 1.5;
        }


        .alur-item span {
            display: block;

            color: #777;

            font-size: 13px;

            line-height: 1.6;
        }


        /* =====================================================
           BIAYA
        ===================================================== */

        .biaya {
            background: linear-gradient(
                135deg,
                #176b3a,
                #2e8b57
            );

            color: #fff;

            text-align: center;

            border: none;
        }


        .biaya h3 {
            color: #fff;

            margin-bottom: 12px;
        }


        .gratis {
            margin: 10px 0 15px;

            color: #ffc107;

            font-size: 40px;

            font-weight: bold;

            line-height: 1.3;
        }


        .biaya p {
            margin: 0;

            color: rgba(255,255,255,0.92);

            font-size: 14px;

            line-height: 1.8;
        }


        /* =====================================================
           CTA
        ===================================================== */

        .cta {
            text-align: center;

            padding: 35px 25px;
        }


        .cta h3 {
            margin: 0 0 10px;

            color: #176b3a;

            font-size: 23px;

            font-weight: bold;

            line-height: 1.5;
        }


        .cta p {
            max-width: 700px;

            margin: 0 auto 22px;

            color: #777;

            font-size: 14px;

            line-height: 1.8;
        }


        /* =====================================================
           TABLET
        ===================================================== */

        @media (max-width: 991px) {

            .ppdb-page {
                padding-top: 25px;
            }


            .ppdb-container {
                padding-left: 15px;
                padding-right: 15px;
            }


            .ppdb-hero {
                padding: 45px 25px;
            }


            .ppdb-hero h1 {
                font-size: 35px;
            }


            .ppdb-hero h2 {
                font-size: 23px;
            }


            .mengapa-item {
                margin-bottom: 15px;

                height: auto;
            }

        }


        /* =====================================================
           HP
        ===================================================== */

        @media (max-width: 767px) {

            body {
                overflow-x: hidden;
            }


            .ppdb-page {
                padding-top: 18px;

                padding-bottom: 25px;
            }


            .ppdb-container {
                width: 100%;

                padding-left: 10px;

                padding-right: 10px;
            }


            /* HERO */

            .ppdb-hero {
                padding: 32px 18px;

                border-radius: 12px;

                margin-bottom: 18px;
            }


            .ppdb-hero h1 {
                font-size: 27px;

                line-height: 1.35;

                margin-bottom: 10px;
            }


            .ppdb-hero h2 {
                font-size: 18px;

                line-height: 1.5;

                margin-bottom: 12px;
            }


            .ppdb-hero p {
                font-size: 13px;

                line-height: 1.7;

                margin-bottom: 20px;
            }


            /* BUTTON */

            .btn-daftar,
            .btn-cek {
                display: block;

                width: 100%;

                margin: 8px 0;

                padding: 12px 15px;

                font-size: 14px;
            }


            /* CARD */

            .info-card,
            .jadwal,
            .syarat,
            .alur,
            .biaya,
            .cta,
            .mengapa-ppdb {

                padding: 18px;

                margin-bottom: 15px;

                border-radius: 10px;
            }


            /* MENGAPA */

            .mengapa-header {
                margin-bottom: 18px;
            }


            .mengapa-header h2 {
                font-size: 21px;

                line-height: 1.4;
            }


            .mengapa-header p {
                font-size: 13px;

                line-height: 1.6;
            }


            .mengapa-item {
                height: auto;

                margin-bottom: 12px;

                padding: 17px;
            }


            .mengapa-icon {
                width: 45px;

                height: 45px;

                line-height: 45px;

                font-size: 19px;

                margin-bottom: 12px;
            }


            .mengapa-item h3 {
                font-size: 16px;
            }


            .mengapa-item p {
                font-size: 13px;

                line-height: 1.6;
            }


            /* INFO */

            .info-card h3,
            .jadwal h3,
            .syarat h3,
            .alur h3 {

                font-size: 18px;

                line-height: 1.4;
            }


            .info-card p {
                font-size: 13px;

                line-height: 1.7;
            }


            .info-icon {
                width: 47px;

                height: 47px;

                line-height: 47px;

                font-size: 20px;
            }


            /* JADWAL */

            .tanggal {
                padding: 14px;

                font-size: 13px;

                line-height: 1.7;
            }


            .tanggal strong {
                font-size: 18px;

                line-height: 1.4;
            }


            /* PERSYARATAN */

            .syarat ol {
                padding-left: 20px;
            }


            .syarat li {
                font-size: 13px;

                padding: 9px 3px;

                line-height: 1.6;
            }


            .wajib,
            .opsional {
                display: inline-block;

                font-size: 10px;

                margin-top: 3px;

                margin-left: 2px;
            }


            /* ALUR */

            .alur-item {
                padding: 14px 12px 14px 58px;

                margin-bottom: 10px;

                min-height: 60px;
            }


            .alur-nomor {
                left: 12px;

                top: 13px;

                width: 35px;

                height: 35px;

                line-height: 35px;

                font-size: 14px;
            }


            .alur-item strong {
                font-size: 14px;

                line-height: 1.5;
            }


            .alur-item span {
                font-size: 12px;

                line-height: 1.6;
            }


            /* BIAYA */

            .gratis {
                font-size: 30px;

                line-height: 1.4;
            }


            .biaya p {
                font-size: 13px;
            }


            /* CTA */

            .cta {
                padding: 25px 18px;
            }


            .cta h3 {
                font-size: 19px;

                line-height: 1.5;
            }


            .cta p {
                font-size: 13px;

                line-height: 1.7;
            }

        }


        /* =====================================================
           HP KECIL
        ===================================================== */

        @media (max-width: 400px) {

            .ppdb-container {
                padding-left: 8px;

                padding-right: 8px;
            }


            .ppdb-hero {
                padding: 27px 14px;
            }


            .ppdb-hero h1 {
                font-size: 24px;
            }


            .ppdb-hero h2 {
                font-size: 17px;
            }


            .ppdb-hero p {
                font-size: 12px;
            }


            .mengapa-header h2 {
                font-size: 20px;
            }


            .gratis {
                font-size: 27px;
            }

        }

    </style>

</head>


<body>

<?php include "navbar.php"; ?>


<!-- =====================================================
     HALAMAN PPDB
===================================================== -->

<div class="ppdb-page">

    <div class="container ppdb-container">


        <!-- =================================================
             HERO
        ================================================== -->

        <div class="ppdb-hero">

            <h1>
                <?php echo e($ppdb['judul_hero']); ?>
            </h1>

            <h2>
                <?php echo e($ppdb['subjudul_hero']); ?>
            </h2>

            <p>

                <?php echo e($ppdb['nama_yayasan']); ?>

                <br>

                Tahun Ajaran
                <?php echo e($ppdb['tahun_ajaran']); ?>

            </p>


            <a href="form_pendaftaran.php"
               class="btn btn-daftar">

                <span class="glyphicon glyphicon-edit"></span>

                Daftar Sekarang

            </a>


            <a href="cek_status.php"
               class="btn btn-cek">

                <span class="glyphicon glyphicon-search"></span>

                Cek Status PPDB

            </a>

        </div>


        <!-- =================================================
             MENGAPA PPDB ONLINE
        ================================================== -->

        <div class="mengapa-ppdb">

            <div class="mengapa-header">

                <h2>
                    Mengapa PPDB Online?
                </h2>

                <p>
                    Pendaftaran dibuat sederhana agar orang tua
                    lebih mudah mendaftarkan putra-putrinya.
                </p>

            </div>


            <div class="row">


                <div class="col-sm-6 col-md-3">

                    <div class="mengapa-item">

                        <div class="mengapa-icon">

                            <span class="glyphicon glyphicon-phone"></span>

                        </div>

                        <h3>
                            Daftar dari HP
                        </h3>

                        <p>
                            Orang tua dapat mengisi formulir
                            pendaftaran melalui smartphone
                            tanpa harus datang ke sekolah.
                        </p>

                    </div>

                </div>


                <div class="col-sm-6 col-md-3">

                    <div class="mengapa-item">

                        <div class="mengapa-icon">

                            <span class="glyphicon glyphicon-time"></span>

                        </div>

                        <h3>
                            Hemat Waktu
                        </h3>

                        <p>
                            Data calon siswa langsung masuk ke
                            sistem sehingga proses administrasi
                            menjadi lebih cepat dan terorganisir.
                        </p>

                    </div>

                </div>


                <div class="col-sm-6 col-md-3">

                    <div class="mengapa-item">

                        <div class="mengapa-icon">

                            <span class="glyphicon glyphicon-search"></span>

                        </div>

                        <h3>
                            Mudah Dipantau
                        </h3>

                        <p>
                            Orang tua dapat mengecek status
                            pendaftaran menggunakan nomor
                            pendaftaran.
                        </p>

                    </div>

                </div>


                <div class="col-sm-6 col-md-3">

                    <div class="mengapa-item">

                        <div class="mengapa-icon">

                            <span class="glyphicon glyphicon-ok"></span>

                        </div>

                        <h3>
                            Proses Sederhana
                        </h3>

                        <p>
                            Proses pendaftaran dibuat sederhana
                            sehingga dapat dilakukan dengan mudah
                            dan nyaman.
                        </p>

                    </div>

                </div>


            </div>

        </div>


        <!-- =================================================
             INFORMASI PPDB
        ================================================== -->

        <div class="row">


            <!-- PERIODE -->

            <div class="col-sm-4">

                <div class="info-card">

                    <div class="info-icon">

                        <span class="glyphicon glyphicon-calendar"></span>

                    </div>

                    <h3>
                        Periode Pendaftaran
                    </h3>

                    <p>

                        Pendaftaran dibuka mulai

                        <strong>
                            <?php echo e($ppdb['periode_pendaftaran']); ?>
                        </strong>

                    </p>

                </div>

            </div>


            <!-- TINGKAT -->

            <div class="col-sm-4">

                <div class="info-card">

                    <div class="info-icon">

                        <span class="glyphicon glyphicon-education"></span>

                    </div>

                    <h3>
                        Tingkat Pendidikan
                    </h3>

                    <p>

                        Pendaftaran peserta didik baru
                        untuk tingkat

                        <strong>
                            <?php echo e($ppdb['tingkat_pendidikan']); ?>
                        </strong>

                    </p>

                </div>

            </div>


            <!-- BIAYA -->

            <div class="col-sm-4">

                <div class="info-card">

                    <div class="info-icon">

                        <span class="glyphicon glyphicon-ok"></span>

                    </div>

                    <h3>
                        Biaya Pendidikan
                    </h3>

                    <p>
                        <?php echo e($ppdb['biaya_pendidikan']); ?>
                    </p>

                </div>

            </div>


        </div>


        <!-- =================================================
             JADWAL
        ================================================== -->

        <div class="jadwal">

            <h3>

                <span class="glyphicon glyphicon-calendar"></span>

                Jadwal Pendaftaran

            </h3>


            <div class="tanggal">

                <strong>

                    <?php echo e($ppdb['tanggal_pendaftaran']); ?>

                </strong>

                <?php echo nl2br(e($ppdb['keterangan_jadwal'])); ?>

            </div>

        </div>


        <!-- =================================================
             PERSYARATAN
        ================================================== -->

        <div class="syarat">

            <h3>

                <span class="glyphicon glyphicon-list-alt"></span>

                <?php echo e($ppdb['judul_persyaratan']); ?>

            </h3>


            <ol>

                <?php

                if (
                    $query_syarat &&
                    mysqli_num_rows($query_syarat) > 0
                ) {

                    while (
                        $syarat = mysqli_fetch_assoc($query_syarat)
                    ) {

                ?>

                    <li>

                        <?php echo e($syarat['persyaratan']); ?>


                        <?php if (
                            $syarat['keterangan'] == 'WAJIB'
                        ) { ?>

                            <span class="wajib">
                                WAJIB
                            </span>

                        <?php } else { ?>

                            <span class="opsional">
                                OPSIONAL
                            </span>

                        <?php } ?>

                    </li>

                <?php

                    }

                } else {

                    echo '<li>Belum ada persyaratan.</li>';

                }

                ?>

            </ol>

        </div>


        <!-- =================================================
             ALUR PENDAFTARAN
        ================================================== -->

        <div class="alur">

            <h3>

                <span class="glyphicon glyphicon-road"></span>

                <?php echo e($ppdb['judul_alur']); ?>

            </h3>


            <?php

            if (
                $query_alur &&
                mysqli_num_rows($query_alur) > 0
            ) {

                while (
                    $alur = mysqli_fetch_assoc($query_alur)
                ) {

            ?>

                <div class="alur-item">

                    <div class="alur-nomor">

                        <?php echo e($alur['nomor']); ?>

                    </div>

                    <strong>

                        <?php echo e($alur['judul']); ?>

                    </strong>

                    <span>

                        <?php echo e($alur['keterangan']); ?>

                    </span>

                </div>

            <?php

                }

            } else {

                echo '<p>Belum ada alur pendaftaran.</p>';

            }

            ?>

        </div>


        <!-- =================================================
             BIAYA PENDIDIKAN
        ================================================== -->

        <div class="biaya">

            <h3>

                <span class="glyphicon glyphicon-ok-circle"></span>

                <?php echo e($ppdb['judul_biaya']); ?>

            </h3>


            <div class="gratis">

                <?php echo e($ppdb['biaya_pendidikan']); ?>

            </div>


            <p>

                <?php echo nl2br(e($ppdb['keterangan_biaya'])); ?>

            </p>

        </div>


        <!-- =================================================
             CTA
        ================================================== -->

        <div class="cta">

            <h3>

                <?php echo e($ppdb['judul_cta']); ?>

            </h3>


            <p>

                <?php echo nl2br(e($ppdb['keterangan_cta'])); ?>

            </p>


            <a href="form_pendaftaran.php"
               class="btn btn-daftar">

                <span class="glyphicon glyphicon-edit"></span>

                Mulai Pendaftaran Online

            </a>

        </div>


    </div>

</div>


<!-- =====================================================
     FOOTER
===================================================== -->

<?php include "footer.php"; ?>


</body>

</html>