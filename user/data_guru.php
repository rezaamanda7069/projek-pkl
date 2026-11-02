<?php

include "../koneksi.php";
include "navbar.php";

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="utf-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1">

    <title>Data Guru - MTs Nurul Huda Pematang Cengal</title>

    <style>

        * {
            box-sizing: border-box;
        }

        html,
        body {
            margin: 0;
            padding: 0;
        }

        body {
            padding-top: 62px;
            background: #f6f9f7;
            font-family: Arial, Helvetica, sans-serif;
            color: #26352c;
        }


        /* =====================================================
           HEADER
        ===================================================== */

        .guru-header {
            position: relative;
            text-align: center;
            padding: 55px 20px 50px;

            background: linear-gradient(
                135deg,
                #e9fff3 0%,
                #ffffff 55%,
                #f1fff7 100%
            );

            border-bottom: 1px solid #e2ebe6;
        }


        .guru-header:after {
            content: "";
            display: block;

            width: 70px;
            height: 4px;

            background: #087f3d;

            border-radius: 10px;

            margin: 20px auto 0;
        }


        .guru-header h1 {
            margin: 0;

            color: #087f3d;

            font-size: 34px;
            font-weight: 700;

            letter-spacing: .5px;
        }


        .guru-header p {
            max-width: 720px;

            margin: 14px auto 0;

            color: #68776f;

            font-size: 15px;
            line-height: 1.7;
        }


        /* =====================================================
           CONTAINER
        ===================================================== */

        .guru-container {
            width: 100%;
            max-width: 1250px;

            margin: 0 auto;

            padding: 45px 20px 70px;
        }


        /* =====================================================
           CARD GURU
        ===================================================== */

        .guru-card {
            position: relative;

            background: #ffffff;

            border: 1px solid #e2e9e5;

            border-radius: 16px;

            overflow: hidden;

            margin-bottom: 30px;

            box-shadow:
                0 5px 18px rgba(20, 60, 40, .07);

            transition:
                transform .3s ease,
                box-shadow .3s ease;
        }


        .guru-card:hover {
            transform: translateY(-7px);

            box-shadow:
                0 14px 32px rgba(20, 60, 40, .13);
        }


        /* =====================================================
           GAMBAR
        ===================================================== */

        .guru-image {
            position: relative;

            width: 100%;
            height: 300px;

            overflow: hidden;

            background: #edf3ef;
        }


        .guru-image:after {
            content: "";

            position: absolute;

            left: 0;
            right: 0;
            bottom: 0;

            height: 80px;

            background: linear-gradient(
                to top,
                rgba(0,0,0,.16),
                transparent
            );

            pointer-events: none;
        }


        .guru-image img {
            width: 100%;
            height: 100%;

            object-fit: cover;
            object-position: center;

            display: block;

            transition:
                transform .4s ease;
        }


        .guru-card:hover .guru-image img {
            transform: scale(1.05);
        }


        /* =====================================================
           GAMBAR TIDAK TERSEDIA
        ===================================================== */

        .gambar-kosong {
            width: 100%;
            height: 100%;

            display: flex;

            align-items: center;
            justify-content: center;

            text-align: center;

            color: #8b9891;

            background: linear-gradient(
                135deg,
                #f1f5f3,
                #e7eeea
            );
        }


        .gambar-kosong .glyphicon {
            display: block;

            font-size: 55px;

            margin-bottom: 12px;

            color: #aab7b0;
        }


        .gambar-kosong span:last-child {
            font-size: 13px;
        }


        /* =====================================================
           INFORMASI GURU
        ===================================================== */

        .guru-info {
            padding: 20px 20px 22px;

            min-height: 125px;
        }


        /* =====================================================
           MATA PELAJARAN
        ===================================================== */

        .guru-mapel {
            display: inline-block;

            padding: 6px 11px;

            margin-bottom: 10px;

            border-radius: 20px;

            background: #eaf8f0;

            color: #087f3d;

            font-size: 11px;

            font-weight: bold;

            text-transform: uppercase;

            letter-spacing: .4px;

            max-width: 100%;

            white-space: nowrap;

            overflow: hidden;

            text-overflow: ellipsis;
        }


        /* =====================================================
           NAMA GURU
        ===================================================== */

        .guru-nama {
            margin: 0 0 8px;

            color: #25352c;

            font-size: 18px;

            font-weight: 700;

            line-height: 1.4;

            word-wrap: break-word;
        }


        /* =====================================================
           JABATAN
        ===================================================== */

        .guru-jabatan {
            color: #738078;

            font-size: 13px;

            line-height: 1.5;
        }


        .guru-jabatan:before {
            content: "\e008";

            font-family: "Glyphicons Halflings";

            margin-right: 6px;

            color: #087f3d;
        }


        /* =====================================================
           DATA KOSONG
        ===================================================== */

        .data-kosong {
            text-align: center;

            background: #ffffff;

            border: 1px solid #e1e8e4;

            border-radius: 16px;

            padding: 60px 20px;

            color: #7b8880;

            box-shadow:
                0 5px 18px rgba(20, 60, 40, .05);
        }


        .data-kosong .glyphicon {
            font-size: 48px;

            margin-bottom: 15px;

            color: #b5c0ba;
        }


        .data-kosong h4 {
            margin: 0 0 8px;

            color: #4d5c54;

            font-size: 18px;

            font-weight: bold;
        }


        .data-kosong p {
            margin: 0;

            font-size: 13px;
        }


        /* =====================================================
           ALERT
        ===================================================== */

        .guru-alert {
            border-radius: 12px;

            border: none;

            box-shadow:
                0 4px 15px rgba(0,0,0,.05);
        }


        /* =====================================================
           TABLET
        ===================================================== */

        @media (max-width: 991px) {

            .guru-header {
                padding: 45px 20px 40px;
            }


            .guru-header h1 {
                font-size: 29px;
            }


            .guru-container {
                padding: 35px 15px 55px;
            }


            .guru-image {
                height: 280px;
            }


            .guru-info {
                padding: 18px;
            }


            .guru-nama {
                font-size: 17px;
            }

        }


        /* =====================================================
           HP
        ===================================================== */

        @media (max-width: 767px) {

            body {
                padding-top: 55px;
            }


            .guru-header {
                padding: 35px 15px 32px;
            }


            .guru-header h1 {
                font-size: 25px;

                line-height: 1.3;
            }


            .guru-header p {
                font-size: 13px;

                line-height: 1.6;

                margin-top: 10px;
            }


            .guru-header:after {
                margin-top: 16px;
            }


            .guru-container {
                padding: 28px 15px 45px;
            }


            .guru-card {
                margin-bottom: 22px;

                border-radius: 14px;
            }


            .guru-image {
                height: 330px;
            }


            .guru-info {
                padding: 18px;
            }


            .guru-nama {
                font-size: 18px;
            }


            .guru-mapel {
                font-size: 10px;
            }

        }


        /* =====================================================
           HP KECIL
        ===================================================== */

        @media (max-width: 480px) {

            .guru-header {
                padding: 30px 12px 28px;
            }


            .guru-header h1 {
                font-size: 22px;
            }


            .guru-header p {
                font-size: 12px;
            }


            .guru-container {
                padding: 22px 10px 35px;
            }


            .guru-image {
                height: 350px;
            }


            .guru-info {
                padding: 16px;
            }


            .guru-nama {
                font-size: 17px;
            }


            .guru-jabatan {
                font-size: 12px;
            }

        }

    </style>

</head>


<body>


<!-- =====================================================
     HEADER
===================================================== -->

<div class="guru-header">

    <h1>
        Data Guru
    </h1>

    <p>
        Mengenal para pendidik dan tenaga profesional
        MTs Nurul Huda Pematang Cengal yang berkomitmen
        dalam membimbing dan mendidik peserta didik.
    </p>

</div>


<!-- =====================================================
     DATA GURU
===================================================== -->

<div class="guru-container">

    <div class="row">

        <?php

        $query = mysqli_query(
            $koneksi,
            "SELECT gambar, nama_guru, mata_pelajaran, jabatan
             FROM guru
             ORDER BY nama_guru ASC"
        );


        /* =================================================
           JIKA QUERY ERROR
        ================================================= */

        if (!$query) {

        ?>

            <div class="col-md-12">

                <div class="alert alert-danger guru-alert">

                    <span class="glyphicon glyphicon-warning-sign"></span>

                    &nbsp;

                    Data guru gagal ditampilkan.

                </div>

            </div>

        <?php

        }


        /* =================================================
           JIKA ADA DATA GURU
        ================================================= */

        elseif (mysqli_num_rows($query) > 0) {

            while ($data = mysqli_fetch_assoc($query)) {

                $gambar = trim($data['gambar'] ?? '');

                $nama_guru = trim(
                    $data['nama_guru'] ?? ''
                );

                $mata_pelajaran = trim(
                    $data['mata_pelajaran'] ?? ''
                );

                $jabatan = trim(
                    $data['jabatan'] ?? ''
                );

        ?>

                <div class="col-lg-3 col-md-4 col-sm-6">

                    <div class="guru-card">


                        <!-- =================================================
                             GAMBAR
                        ================================================= -->

                        <div class="guru-image">

                            <?php

                            if (
                                !empty($gambar) &&
                                file_exists("../images/" . $gambar)
                            ) {

                            ?>

                                <img
                                    src="../images/<?php
                                        echo htmlspecialchars(
                                            $gambar,
                                            ENT_QUOTES,
                                            'UTF-8'
                                        );
                                    ?>"
                                    alt="<?php
                                        echo htmlspecialchars(
                                            $nama_guru,
                                            ENT_QUOTES,
                                            'UTF-8'
                                        );
                                    ?>"
                                    loading="lazy">

                            <?php

                            } else {

                            ?>

                                <div class="gambar-kosong">

                                    <div>

                                        <span class="glyphicon glyphicon-user"></span>

                                        <div>
                                            Gambar tidak tersedia
                                        </div>

                                    </div>

                                </div>

                            <?php

                            }

                            ?>

                        </div>


                        <!-- =================================================
                             INFORMASI GURU
                        ================================================= -->

                        <div class="guru-info">


                            <!-- =================================================
                                 MATA PELAJARAN
                            ================================================= -->

                            <?php

                            /*
                             * Mata pelajaran hanya ditampilkan
                             * jika datanya benar-benar diisi.
                             *
                             * Jika kosong atau NULL,
                             * bagian ini tidak muncul.
                             */

                            if (
                                !empty($mata_pelajaran) &&
                                strtolower($mata_pelajaran) != 'none'
                            ) {

                            ?>

                                <div class="guru-mapel">

                                    <?php

                                    echo htmlspecialchars(
                                        $mata_pelajaran,
                                        ENT_QUOTES,
                                        'UTF-8'
                                    );

                                    ?>

                                </div>

                            <?php

                            }

                            ?>


                            <!-- =================================================
                                 NAMA GURU
                            ================================================= -->

                            <h3 class="guru-nama">

                                <?php

                                echo htmlspecialchars(
                                    $nama_guru,
                                    ENT_QUOTES,
                                    'UTF-8'
                                );

                                ?>

                            </h3>


                            <!-- =================================================
                                 JABATAN
                            ================================================= -->

                            <?php

                            /*
                             * Jabatan hanya ditampilkan
                             * jika datanya benar-benar diisi.
                             *
                             * Jika kosong atau NULL,
                             * bagian ini tidak muncul.
                             */

                            if (
                                !empty($jabatan) &&
                                strtolower($jabatan) != 'none'
                            ) {

                            ?>

                                <div class="guru-jabatan">

                                    <?php

                                    echo htmlspecialchars(
                                        $jabatan,
                                        ENT_QUOTES,
                                        'UTF-8'
                                    );

                                    ?>

                                </div>

                            <?php

                            }

                            ?>


                        </div>

                    </div>

                </div>

        <?php

            }

        }


        /* =================================================
           JIKA BELUM ADA DATA
        ================================================= */

        else {

        ?>

            <div class="col-md-12">

                <div class="data-kosong">

                    <span class="glyphicon glyphicon-user"></span>

                    <h4>
                        Data Guru Belum Tersedia
                    </h4>

                    <p>
                        Belum ada data guru yang ditambahkan.
                    </p>

                </div>

            </div>

        <?php

        }

        ?>

    </div>

</div>

<?php include "footer.php"; ?>
</body>

</html>
