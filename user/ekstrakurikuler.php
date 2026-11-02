<?php
include "../koneksi.php";
?>
<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Ekstrakurikuler - MTs Nurul Huda Pematang Cengal</title>

 

    <style>

        /* =====================================================
           RESET
        ===================================================== */

        * {
            box-sizing: border-box;
        }


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
            background: #f5f7f6;
            color: #333;
            font-family: Arial, Helvetica, sans-serif;

            /* Memberikan ruang agar konten tidak tertutup navbar */
            padding-top: 70px;

            overflow-x: hidden;
        }


        /* =====================================================
           HALAMAN EKSTRAKURIKULER
        ===================================================== */

        .halaman-ekskul {
            padding-top: 35px;
            padding-bottom: 45px;
        }


        /* =====================================================
           JUDUL HALAMAN
        ===================================================== */

        .judul-ekskul {
            text-align: center;
            margin-bottom: 35px;
        }

        .judul-ekskul h2 {
            color: #087f3d;
            font-size: 32px;
            font-weight: bold;

            margin-top: 0;
            margin-bottom: 10px;

            line-height: 1.3;
        }

        .judul-ekskul h2 .glyphicon {
            margin-right: 5px;
        }

        .judul-ekskul p {
            color: #777;
            font-size: 15px;

            margin: 0 auto;

            line-height: 1.7;

            max-width: 700px;
        }

        .garis-judul {
            width: 55px;
            height: 3px;

            background: #087f3d;

            margin: 14px auto 0;

            border-radius: 3px;
        }


        /* =====================================================
           CARD EKSTRAKURIKULER
        ===================================================== */

        .kartu-ekskul {
            background: #fff;

            border: 1px solid #e5e5e5;

            border-radius: 12px;

            overflow: hidden;

            margin-bottom: 30px;

            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);

            transition:
                transform 0.3s ease,
                box-shadow 0.3s ease;

            height: 100%;
        }

        .kartu-ekskul:hover {
            transform: translateY(-5px);

            box-shadow:
                0 9px 25px rgba(0, 0, 0, 0.13);
        }


        /* =====================================================
           GAMBAR
        ===================================================== */

        .gambar-ekskul {
            width: 100%;

            height: 230px;

            overflow: hidden;

            background: #eeeeee;

            position: relative;
        }

        .gambar-ekskul img {
            width: 100%;
            height: 100%;

            object-fit: cover;

            display: block;

            transition:
                transform 0.4s ease;
        }

        .kartu-ekskul:hover .gambar-ekskul img {
            transform: scale(1.05);
        }


        /* =====================================================
           TIDAK ADA GAMBAR
        ===================================================== */

        .tidak-ada-gambar {
            width: 100%;
            height: 230px;

            display: flex;

            align-items: center;
            justify-content: center;

            flex-direction: column;

            background: #f1f3f2;

            color: #999;

            font-size: 14px;

            text-align: center;
        }

        .tidak-ada-gambar .glyphicon {
            font-size: 35px;

            margin-bottom: 8px;

            color: #aaa;
        }


        /* =====================================================
           ISI CARD
        ===================================================== */

        .isi-ekskul {
            padding: 22px;
        }


        /* =====================================================
           NAMA EKSTRAKURIKULER
        ===================================================== */

        .isi-ekskul h3 {
            color: #087f3d;

            font-size: 21px;

            font-weight: bold;

            margin-top: 0;
            margin-bottom: 14px;

            line-height: 1.4;

            word-wrap: break-word;
        }


        /* =====================================================
           GARIS
        ===================================================== */

        .garis-ekskul {
            border: 0;

            border-top: 1px solid #eeeeee;

            margin: 0 0 17px;
        }


        /* =====================================================
           INFORMASI
        ===================================================== */

        .info-ekskul {
            margin-bottom: 15px;
        }

        .info-item {
            display: flex;

            align-items: flex-start;

            margin-bottom: 12px;

            color: #555;

            font-size: 14px;

            line-height: 1.6;

            word-break: break-word;
        }

        .info-item:last-child {
            margin-bottom: 0;
        }

        .info-item .glyphicon {
            color: #087f3d;

            width: 23px;

            min-width: 23px;

            text-align: center;

            margin-right: 7px;

            margin-top: 3px;
        }

        .label-info-ekskul {
            font-weight: bold;

            color: #333;

            margin-right: 4px;
        }


        /* =====================================================
           DESKRIPSI
        ===================================================== */

        .deskripsi-ekskul {
            color: #666;

            font-size: 14px;

            line-height: 1.8;

            text-align: justify;

            margin: 16px 0 0;

            padding-top: 15px;

            border-top: 1px solid #eeeeee;

            word-wrap: break-word;
        }


        /* =====================================================
           DATA KOSONG
        ===================================================== */

        .data-kosong {
            background: #fff;

            border: 1px solid #ddd;

            border-radius: 10px;

            padding: 40px 20px;

            text-align: center;

            color: #777;

            box-shadow:
                0 3px 10px rgba(0, 0, 0, 0.05);

            margin-bottom: 20px;
        }

        .data-kosong .glyphicon {
            font-size: 35px;

            color: #f0ad4e;

            margin-bottom: 10px;
        }

        .data-kosong h4 {
            color: #555;

            font-weight: bold;

            margin-top: 5px;

            margin-bottom: 8px;
        }

        .data-kosong p {
            margin: 0;

            line-height: 1.7;
        }


        /* =====================================================
           TABLET
        ===================================================== */

        @media (min-width: 768px)
        and (max-width: 991px) {

            body {
                padding-top: 70px;
            }

            .halaman-ekskul {
                padding-top: 30px;
                padding-bottom: 40px;
            }

            .judul-ekskul h2 {
                font-size: 29px;
            }

            .judul-ekskul p {
                font-size: 14px;
            }

            .gambar-ekskul,
            .tidak-ada-gambar {
                height: 210px;
            }

            .isi-ekskul {
                padding: 18px;
            }

            .isi-ekskul h3 {
                font-size: 19px;
            }

            .info-item {
                font-size: 13px;
            }

            .deskripsi-ekskul {
                font-size: 13px;
                text-align: left;
            }

        }


        /* =====================================================
           HP
        ===================================================== */

        @media (max-width: 767px) {

            body {
                padding-top: 60px;

                overflow-x: hidden;
            }

            .halaman-ekskul {
                padding-top: 22px;
                padding-bottom: 30px;

                padding-left: 10px;
                padding-right: 10px;
            }


            /* Judul */

            .judul-ekskul {
                margin-bottom: 25px;

                padding-left: 5px;
                padding-right: 5px;
            }

            .judul-ekskul h2 {
                font-size: 25px;

                line-height: 1.35;
            }

            .judul-ekskul p {
                font-size: 13px;

                line-height: 1.7;
            }

            .garis-judul {
                margin-top: 11px;
            }


            /* Card */

            .kartu-ekskul {
                margin-left: 0;
                margin-right: 0;

                margin-bottom: 20px;

                border-radius: 9px;

                box-shadow:
                    0 3px 12px rgba(0, 0, 0, 0.07);
            }

            .kartu-ekskul:hover {
                transform: none;
            }


            /* Gambar */

            .gambar-ekskul,
            .tidak-ada-gambar {
                height: 205px;
            }

            .kartu-ekskul:hover .gambar-ekskul img {
                transform: none;
            }


            /* Isi */

            .isi-ekskul {
                padding: 17px;
            }

            .isi-ekskul h3 {
                font-size: 19px;

                margin-bottom: 13px;

                line-height: 1.4;
            }


            /* Informasi */

            .info-item {
                font-size: 13px;

                line-height: 1.6;

                margin-bottom: 11px;
            }

            .info-item .glyphicon {
                width: 22px;

                min-width: 22px;

                margin-right: 6px;
            }


            /* Deskripsi */

            .deskripsi-ekskul {
                font-size: 13px;

                line-height: 1.7;

                text-align: left;

                margin-top: 15px;

                padding-top: 14px;
            }


            /* Data kosong */

            .data-kosong {
                padding: 30px 15px;
            }

            .data-kosong h4 {
                font-size: 17px;
            }

            .data-kosong p {
                font-size: 13px;
            }

        }


        /* =====================================================
           HP KECIL
        ===================================================== */

        @media (max-width: 480px) {

            body {
                padding-top: 60px;
            }

            .halaman-ekskul {
                padding-left: 8px;
                padding-right: 8px;
            }

            .judul-ekskul h2 {
                font-size: 22px;
            }

            .judul-ekskul p {
                font-size: 13px;
            }

            .gambar-ekskul,
            .tidak-ada-gambar {
                height: 185px;
            }

            .isi-ekskul {
                padding: 15px;
            }

            .isi-ekskul h3 {
                font-size: 18px;
            }

            .info-item {
                font-size: 13px;
            }

            .deskripsi-ekskul {
                font-size: 13px;
            }

        }

    </style>

</head>


<body>


    <!-- =====================================================
         NAVBAR
    ===================================================== -->

    <?php include "navbar.php"; ?>


    <!-- =====================================================
         KONTEN UTAMA
    ===================================================== -->

    <div class="container halaman-ekskul">


        <!-- =================================================
             JUDUL
        ================================================= -->

        <div class="judul-ekskul">

            <h2>

                <span class="glyphicon glyphicon-education"></span>

                Ekstrakurikuler

            </h2>

            <p>

                Berbagai kegiatan ekstrakurikuler yang tersedia
                di MTs Nurul Huda Pematang Cengal.

            </p>

            <div class="garis-judul"></div>

        </div>


        <!-- =================================================
             DATA EKSTRAKURIKULER
        ================================================= -->

        <div class="row">

            <?php

            $query = mysqli_query(
                $koneksi,
                "SELECT * FROM ekstrakurikuler
                 ORDER BY nama_ekskul ASC"
            );

            if ($query && mysqli_num_rows($query) > 0) {

                while ($data = mysqli_fetch_assoc($query)) {

                    $nama = htmlspecialchars(
                        $data['nama_ekskul'] ?? '',
                        ENT_QUOTES,
                        'UTF-8'
                    );

                    $pembina = htmlspecialchars(
                        $data['pembina'] ?? '',
                        ENT_QUOTES,
                        'UTF-8'
                    );

                    $jadwal = htmlspecialchars(
                        $data['jadwal'] ?? '',
                        ENT_QUOTES,
                        'UTF-8'
                    );

                    $deskripsi = htmlspecialchars(
                        $data['deskripsi'] ?? '',
                        ENT_QUOTES,
                        'UTF-8'
                    );

                    $gambar = htmlspecialchars(
                        $data['gambar'] ?? '',
                        ENT_QUOTES,
                        'UTF-8'
                    );

            ?>


                    <!-- =====================================
                         CARD EKSTRAKURIKULER
                    ====================================== -->

                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">

                        <div class="kartu-ekskul">


                            <!-- =================================
                                 GAMBAR
                            ================================== -->

                            <?php if (!empty($gambar)) { ?>

                                <div class="gambar-ekskul">

                                    <img
                                        src="../images/<?php echo $gambar; ?>"
                                        alt="<?php echo $nama; ?>"
                                    >

                                </div>

                            <?php } else { ?>

                                <div class="tidak-ada-gambar">

                                    <span
                                        class="glyphicon glyphicon-picture">
                                    </span>

                                    <span>
                                        Tidak ada gambar
                                    </span>

                                </div>

                            <?php } ?>


                            <!-- =================================
                                 ISI CARD
                            ================================== -->

                            <div class="isi-ekskul">


                                <!-- Nama -->

                                <h3>

                                    <?php echo $nama; ?>

                                </h3>


                                <!-- Garis -->

                                <hr class="garis-ekskul">


                                <!-- Informasi -->

                                <div class="info-ekskul">


                                    <!-- Pembina -->

                                    <div class="info-item">

                                        <span
                                            class="glyphicon glyphicon-user">
                                        </span>

                                        <div>

                                            <span
                                                class="label-info-ekskul">
                                                Pembina:
                                            </span>

                                            <?php echo $pembina; ?>

                                        </div>

                                    </div>


                                    <!-- Jadwal -->

                                    <div class="info-item">

                                        <span
                                            class="glyphicon glyphicon-calendar">
                                        </span>

                                        <div>

                                            <span
                                                class="label-info-ekskul">
                                                Jadwal:
                                            </span>

                                            <?php echo $jadwal; ?>

                                        </div>

                                    </div>


                                </div>


                                <!-- =================================
                                     DESKRIPSI
                                ================================== -->

                                <?php if (!empty($deskripsi)) { ?>

                                    <p class="deskripsi-ekskul">

                                        <?php
                                        echo nl2br($deskripsi);
                                        ?>

                                    </p>

                                <?php } ?>


                            </div>

                        </div>

                    </div>


            <?php

                }

            } else {

            ?>


                <!-- =================================
                     DATA KOSONG
                ================================== -->

                <div class="col-md-12">

                    <div class="data-kosong">

                        <span
                            class="glyphicon glyphicon-info-sign">
                        </span>

                        <h4>
                            Data Ekstrakurikuler Belum Tersedia
                        </h4>

                        <p>
                            Belum ada data kegiatan ekstrakurikuler
                            yang ditambahkan.
                        </p>

                    </div>

                </div>


            <?php

            }

            ?>

        </div>

    </div>


    <!-- =====================================================
         FOOTER
    ===================================================== -->

    <?php include "footer.php"; ?>


   


</body>

</html>