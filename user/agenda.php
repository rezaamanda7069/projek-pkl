<?php
include "../koneksi.php";
include "navbar.php";
?>

<!DOCTYPE html>
<html lang="id">
<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Agenda Sekolah - MTs Nurul Huda Pematang Cengal</title>

    <style>

        /* =====================================================
           BODY
        ===================================================== */

        html,
        body {
            margin: 0;
            padding: 0;
            width: 100%;
            min-height: 100%;
        }

        body {
            background: #f5f7f8;
            color: #333;
            font-family: Arial, Helvetica, sans-serif;
            overflow-x: hidden;
        }


        /* =====================================================
           HALAMAN AGENDA
        ===================================================== */

        .halaman-agenda {
            width: 100%;
            padding-top: 90px;
            padding-bottom: 50px;
        }


        /* =====================================================
           JUDUL
        ===================================================== */

        .judul-agenda {
            text-align: center;
            margin-bottom: 35px;
        }

        .judul-agenda h2 {
            margin: 0 0 10px;
            color: #2e7d32;
            font-size: 32px;
            font-weight: bold;
            line-height: 1.3;
        }

        .judul-agenda h2 .glyphicon {
            margin-right: 5px;
        }

        .judul-agenda p {
            margin: 0;
            color: #777;
            font-size: 15px;
            line-height: 1.6;
        }

        .garis-judul {
            width: 60px;
            height: 3px;
            background: #4caf50;
            margin: 12px auto 0;
            border-radius: 3px;
        }


        /* =====================================================
           CARD AGENDA
        ===================================================== */

        .card-agenda {
            background: #fff;
            border: 1px solid #e5e5e5;
            border-radius: 12px;
            overflow: hidden;
            margin-bottom: 30px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
            height: 100%;
        }

        .card-agenda:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.13);
        }


        /* =====================================================
           HEADER CARD
        ===================================================== */

        .header-agenda {
            background: linear-gradient(
                135deg,
                #176b3a,
                #2e8b57
            );

            color: #fff;
            padding: 20px;
            min-height: 75px;

            display: flex;
            align-items: center;
        }

        .header-agenda h3 {
            margin: 0;
            font-size: 20px;
            font-weight: bold;
            line-height: 1.45;
            word-break: break-word;
        }

        .header-agenda .glyphicon {
            margin-right: 7px;
        }


        /* =====================================================
           BODY CARD
        ===================================================== */

        .body-agenda {
            padding: 22px;
        }


        /* =====================================================
           BADGE
        ===================================================== */

        .tanggal-badge {
            display: inline-block;
            background: #e8f5e9;
            color: #2e7d32;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .tanggal-badge .glyphicon {
            margin-right: 4px;
        }


        /* =====================================================
           INFORMASI AGENDA
        ===================================================== */

        .info-agenda {
            margin-bottom: 15px;
        }

        .info-item {
            display: flex;
            align-items: flex-start;
            padding: 11px 0;
            border-bottom: 1px solid #eeeeee;
        }

        .info-item:last-child {
            border-bottom: none;
        }

        .info-icon {
            width: 35px;
            min-width: 35px;
            color: #4caf50;
            font-size: 16px;
            padding-top: 2px;
        }

        .info-label {
            width: 75px;
            min-width: 75px;
            font-weight: bold;
            color: #555;
            line-height: 1.6;
        }

        .info-value {
            flex: 1;
            color: #555;
            line-height: 1.6;
            word-break: break-word;
        }


        /* =====================================================
           DESKRIPSI
        ===================================================== */

        .deskripsi-agenda {
            border-top: 1px solid #eeeeee;
            margin-top: 10px;
            padding-top: 17px;
            color: #555;
            font-size: 14px;
            line-height: 1.8;
            text-align: justify;
            word-break: break-word;
        }

        .label-deskripsi {
            display: block;
            color: #2e7d32;
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 8px;
        }

        .label-deskripsi .glyphicon {
            margin-right: 4px;
        }


        /* =====================================================
           TIDAK ADA AGENDA
        ===================================================== */

        .tidak-ada-agenda {
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 40px 25px;
            text-align: center;
            color: #777;
            box-shadow: 0 3px 12px rgba(0,0,0,0.05);
        }

        .tidak-ada-agenda .glyphicon {
            display: block;
            font-size: 38px;
            color: #4caf50;
            margin-bottom: 15px;
        }

        .tidak-ada-agenda h4 {
            margin: 0 0 8px;
            color: #555;
            font-weight: bold;
            font-size: 18px;
        }

        .tidak-ada-agenda p {
            margin: 0;
            line-height: 1.7;
            font-size: 14px;
        }


        /* =====================================================
           TABLET
        ===================================================== */

        @media (min-width: 768px) and (max-width: 991px) {

            .halaman-agenda {
                padding-top: 85px;
                padding-bottom: 40px;
            }

            .judul-agenda h2 {
                font-size: 29px;
            }

            .judul-agenda p {
                font-size: 14px;
            }

            .header-agenda {
                padding: 17px;
            }

            .header-agenda h3 {
                font-size: 18px;
            }

            .body-agenda {
                padding: 18px;
            }

            .info-label {
                width: 70px;
                min-width: 70px;
            }

        }


        /* =====================================================
           HP
        ===================================================== */

        @media (max-width: 767px) {

            body {
                overflow-x: hidden;
            }

            .halaman-agenda {
                width: 100%;
                padding-top: 85px;
                padding-left: 10px;
                padding-right: 10px;
                padding-bottom: 35px;
            }


            /* JUDUL */

            .judul-agenda {
                margin-bottom: 25px;
            }

            .judul-agenda h2 {
                font-size: 25px;
                line-height: 1.35;
            }

            .judul-agenda h2 .glyphicon {
                font-size: 22px;
            }

            .judul-agenda p {
                font-size: 13px;
                line-height: 1.7;
                padding: 0 5px;
            }

            .garis-judul {
                width: 50px;
                margin-top: 10px;
            }


            /* CARD */

            .card-agenda {
                margin-bottom: 18px;
                border-radius: 10px;
                box-shadow: 0 3px 12px rgba(0,0,0,0.08);
            }

            .card-agenda:hover {
                transform: none;
            }


            /* HEADER */

            .header-agenda {
                padding: 16px;
                min-height: auto;
            }

            .header-agenda h3 {
                font-size: 17px;
                line-height: 1.45;
            }

            .header-agenda .glyphicon {
                font-size: 15px;
                margin-right: 5px;
            }


            /* BODY */

            .body-agenda {
                padding: 16px;
            }


            /* BADGE */

            .tanggal-badge {
                font-size: 11px;
                padding: 6px 10px;
                margin-bottom: 12px;
            }


            /* INFORMASI */

            .info-item {
                padding: 10px 0;
            }

            .info-icon {
                width: 30px;
                min-width: 30px;
                font-size: 15px;
            }

            .info-label {
                width: 65px;
                min-width: 65px;
                font-size: 13px;
            }

            .info-value {
                font-size: 13px;
                line-height: 1.6;
            }


            /* DESKRIPSI */

            .deskripsi-agenda {
                padding-top: 14px;
                font-size: 13px;
                line-height: 1.75;
                text-align: left;
            }

            .label-deskripsi {
                font-size: 13px;
                margin-bottom: 7px;
            }


            /* TIDAK ADA AGENDA */

            .tidak-ada-agenda {
                padding: 30px 18px;
                border-radius: 9px;
            }

            .tidak-ada-agenda .glyphicon {
                font-size: 32px;
                margin-bottom: 12px;
            }

            .tidak-ada-agenda h4 {
                font-size: 17px;
            }

            .tidak-ada-agenda p {
                font-size: 13px;
                line-height: 1.7;
            }

        }


        /* =====================================================
           HP KECIL
        ===================================================== */

        @media (max-width: 400px) {

            .halaman-agenda {
                padding-top: 80px;
                padding-left: 8px;
                padding-right: 8px;
            }

            .judul-agenda h2 {
                font-size: 22px;
            }

            .judul-agenda h2 .glyphicon {
                font-size: 20px;
            }

            .judul-agenda p {
                font-size: 12px;
            }

            .header-agenda {
                padding: 14px;
            }

            .header-agenda h3 {
                font-size: 16px;
            }

            .body-agenda {
                padding: 14px;
            }

            .info-label {
                width: 60px;
                min-width: 60px;
                font-size: 12px;
            }

            .info-value {
                font-size: 12px;
            }

            .deskripsi-agenda {
                font-size: 12px;
            }

        }

    </style>

</head>


<body>


<!-- =====================================================
     HALAMAN AGENDA
===================================================== -->

<div class="container halaman-agenda">


    <!-- =================================================
         JUDUL HALAMAN
    ================================================== -->

    <div class="judul-agenda">

        <h2>

            <span class="glyphicon glyphicon-calendar"></span>

            Agenda Sekolah

        </h2>

        <p>
            Jadwal kegiatan dan agenda
            MTs Nurul Huda Pematang Cengal
        </p>

        <div class="garis-judul"></div>

    </div>


    <!-- =================================================
         QUERY DATABASE
    ================================================== -->

    <?php

    $query = mysqli_query(
        $koneksi,
        "SELECT *
         FROM agenda
         ORDER BY tanggal ASC, waktu ASC"
    );

    ?>


    <?php if ($query && mysqli_num_rows($query) > 0) { ?>


        <!-- =================================================
             DAFTAR AGENDA
        ================================================== -->

        <div class="row">

            <?php while ($data = mysqli_fetch_assoc($query)) {


                $judul = htmlspecialchars(
                    $data['judul'] ?? '',
                    ENT_QUOTES,
                    'UTF-8'
                );

                $tempat = htmlspecialchars(
                    $data['tempat'] ?? '',
                    ENT_QUOTES,
                    'UTF-8'
                );

                $deskripsi = htmlspecialchars(
                    $data['deskripsi'] ?? '',
                    ENT_QUOTES,
                    'UTF-8'
                );

                $waktu = htmlspecialchars(
                    $data['waktu'] ?? '',
                    ENT_QUOTES,
                    'UTF-8'
                );

            ?>


                <!-- =================================================
                     CARD AGENDA
                ================================================== -->

                <div class="col-md-6 col-sm-6">

                    <div class="card-agenda">


                        <!-- HEADER -->

                        <div class="header-agenda">

                            <h3>

                                <span class="glyphicon glyphicon-calendar"></span>

                                <?php echo $judul; ?>

                            </h3>

                        </div>


                        <!-- BODY -->

                        <div class="body-agenda">


                            <!-- BADGE -->

                            <div class="tanggal-badge">

                                <span class="glyphicon glyphicon-time"></span>

                                Jadwal Kegiatan

                            </div>


                            <!-- INFORMASI AGENDA -->

                            <div class="info-agenda">


                                <!-- TANGGAL -->

                                <div class="info-item">

                                    <div class="info-icon">

                                        <span class="glyphicon glyphicon-calendar"></span>

                                    </div>

                                    <div class="info-label">
                                        Tanggal
                                    </div>

                                    <div class="info-value">

                                        <?php

                                        if (!empty($data['tanggal'])) {

                                            echo date(
                                                'd F Y',
                                                strtotime($data['tanggal'])
                                            );

                                        } else {

                                            echo '-';

                                        }

                                        ?>

                                    </div>

                                </div>


                                <!-- WAKTU -->

                                <div class="info-item">

                                    <div class="info-icon">

                                        <span class="glyphicon glyphicon-time"></span>

                                    </div>

                                    <div class="info-label">
                                        Waktu
                                    </div>

                                    <div class="info-value">

                                        <?php echo $waktu; ?>

                                        <?php if (!empty($waktu)) { ?>
                                            WIB
                                        <?php } ?>

                                    </div>

                                </div>


                                <!-- TEMPAT -->

                                <div class="info-item">

                                    <div class="info-icon">

                                        <span class="glyphicon glyphicon-map-marker"></span>

                                    </div>

                                    <div class="info-label">
                                        Tempat
                                    </div>

                                    <div class="info-value">

                                        <?php

                                        if (!empty($tempat)) {

                                            echo $tempat;

                                        } else {

                                            echo '-';

                                        }

                                        ?>

                                    </div>

                                </div>


                            </div>


                            <!-- DESKRIPSI -->

                            <div class="deskripsi-agenda">

                                <span class="label-deskripsi">

                                    <span class="glyphicon glyphicon-info-sign"></span>

                                    Deskripsi Kegiatan

                                </span>

                                <?php

                                if (!empty($deskripsi)) {

                                    echo nl2br($deskripsi);

                                } else {

                                    echo 'Tidak ada deskripsi kegiatan.';

                                }

                                ?>

                            </div>


                        </div>

                    </div>

                </div>


            <?php } ?>

        </div>


    <?php } else { ?>


        <!-- =================================================
             BELUM ADA AGENDA
        ================================================== -->

        <div class="tidak-ada-agenda">

            <span class="glyphicon glyphicon-calendar"></span>

            <h4>
                Belum Ada Agenda
            </h4>

            <p>
                Saat ini belum terdapat agenda kegiatan
                yang dipublikasikan oleh
                MTs Nurul Huda Pematang Cengal.
            </p>

        </div>


    <?php } ?>


</div>

<?php include "footer.php"; ?>
</body>

</html>


