<?php

include "../koneksi.php";
include "navbar.php";

/* ==================================================
   QUERY BERITA
================================================== */

$query = mysqli_query(
    $koneksi,
    "SELECT * FROM berita
     ORDER BY tanggal DESC"
);

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="utf-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1">

    <title>Berita Sekolah - MTs Nurul Huda</title>

    <style>

        /* ==================================================
           RESET
        ================================================== */

        * {
            box-sizing: border-box;
        }


        /* ==================================================
           BODY
        ================================================== */

        body {
            margin: 0;
            padding-top: 70px;
            background: #f5f7f8;
            color: #333;
            font-family: Arial, Helvetica, sans-serif;
            overflow-x: hidden;
        }


        /* ==================================================
           HALAMAN BERITA
        ================================================== */

        .halaman-berita {
            padding-top: 30px;
            padding-bottom: 50px;
        }


        /* ==================================================
           JUDUL HALAMAN
        ================================================== */

        .judul-berita {
            text-align: center;
            margin-bottom: 35px;
        }

        .judul-berita h2 {
            color: #2e7d32;
            font-size: 32px;
            font-weight: bold;
            margin: 0 0 8px;
            line-height: 1.3;
        }

        .judul-berita p {
            color: #777;
            font-size: 15px;
            margin: 0;
            line-height: 1.6;
        }

        .garis-judul {
            width: 60px;
            height: 3px;
            background: #4CAF50;
            margin: 12px auto 0;
            border-radius: 3px;
        }


        /* ==================================================
           CARD BERITA
        ================================================== */

        .card-berita {
            background: #fff;
            border: 1px solid #e5e5e5;
            border-radius: 10px;
            overflow: hidden;
            margin-bottom: 30px;

            box-shadow: 0 3px 12px rgba(0, 0, 0, 0.08);

            transition: all 0.3s ease;

            height: 100%;
        }

        .card-berita:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.14);
        }


        /* ==================================================
           GAMBAR BERITA
        ================================================== */

        .gambar-berita {
            width: 100%;
            height: 240px;
            overflow: hidden;
            background: #f1f1f1;
        }

        .gambar-berita img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;

            transition: transform 0.4s ease;
        }

        .card-berita:hover .gambar-berita img {
            transform: scale(1.05);
        }


        /* ==================================================
           ISI CARD
        ================================================== */

        .isi-berita {
            padding: 20px;
        }


        /* ==================================================
           LABEL
        ================================================== */

        .label-berita {
            display: inline-block;

            background: #4CAF50;
            color: #fff;

            padding: 5px 10px;

            border-radius: 20px;

            font-size: 12px;

            margin-bottom: 10px;
        }


        /* ==================================================
           JUDUL BERITA
        ================================================== */

        .isi-berita h3 {
            color: #2e7d32;

            font-size: 21px;
            font-weight: bold;

            margin-top: 0;
            margin-bottom: 10px;

            line-height: 1.4;

            word-break: break-word;
        }


        /* ==================================================
           TANGGAL
        ================================================== */

        .tanggal-berita {
            color: #888;

            font-size: 13px;

            margin-bottom: 15px;

            line-height: 1.5;
        }

        .tanggal-berita .glyphicon {
            margin-right: 5px;
            color: #4CAF50;
        }


        /* ==================================================
           GARIS PEMISAH
        ================================================== */

        .garis-berita {
            border: 0;
            border-top: 1px solid #eeeeee;

            margin: 15px 0;
        }


        /* ==================================================
           DESKRIPSI BERITA
        ================================================== */

        .deskripsi-berita {
            color: #555;

            font-size: 14px;

            line-height: 1.8;

            text-align: justify;

            margin-bottom: 0;

            word-wrap: break-word;
        }


        /* ==================================================
           JIKA TIDAK ADA BERITA
        ================================================== */

        .tidak-ada-berita {
            background: #fff;

            border: 1px solid #ddd;

            border-radius: 10px;

            padding: 40px 25px;

            text-align: center;

            color: #777;

            box-shadow: 0 3px 12px rgba(0, 0, 0, 0.06);
        }

        .tidak-ada-berita .glyphicon {
            color: #4CAF50;
        }

        .tidak-ada-berita h4 {
            color: #2e7d32;
            font-size: 20px;
            font-weight: bold;
            margin-top: 15px;
        }

        .tidak-ada-berita p {
            font-size: 14px;
            line-height: 1.7;
            margin-bottom: 0;
        }


        /* ==================================================
           TABLET
        ================================================== */

        @media (min-width: 768px) and (max-width: 991px) {

            body {
                padding-top: 60px;
            }

            .halaman-berita {
                padding-top: 25px;
                padding-bottom: 40px;
            }

            .judul-berita {
                margin-bottom: 30px;
            }

            .judul-berita h2 {
                font-size: 28px;
            }

            .judul-berita p {
                font-size: 14px;
            }

            .gambar-berita {
                height: 220px;
            }

            .isi-berita {
                padding: 17px;
            }

            .isi-berita h3 {
                font-size: 19px;
            }

            .deskripsi-berita {
                font-size: 14px;
                line-height: 1.7;
            }

        }


        /* ==================================================
           HP
        ================================================== */

        @media (max-width: 767px) {

            body {
                padding-top: 60px;
                overflow-x: hidden;
            }


            .halaman-berita {
                padding-top: 20px;
                padding-bottom: 35px;

                padding-left: 10px;
                padding-right: 10px;
            }


            /* JUDUL */

            .judul-berita {
                margin-bottom: 25px;
            }

            .judul-berita h2 {
                font-size: 25px;
                line-height: 1.4;
            }

            .judul-berita p {
                font-size: 13px;
                line-height: 1.6;
            }


            /* CARD */

            .card-berita {
                margin-bottom: 20px;
                border-radius: 8px;

                transform: none !important;
            }

            .card-berita:hover {
                transform: none !important;
            }


            /* GAMBAR */

            .gambar-berita {
                height: 200px;
            }

            .card-berita:hover .gambar-berita img {
                transform: none;
            }


            /* ISI */

            .isi-berita {
                padding: 15px;
            }


            /* LABEL */

            .label-berita {
                font-size: 11px;
                padding: 5px 9px;
                margin-bottom: 9px;
            }


            /* JUDUL */

            .isi-berita h3 {
                font-size: 19px;

                line-height: 1.4;

                margin-bottom: 9px;
            }


            /* TANGGAL */

            .tanggal-berita {
                font-size: 12px;

                margin-bottom: 12px;
            }


            /* DESKRIPSI */

            .deskripsi-berita {
                font-size: 13px;

                line-height: 1.7;

                text-align: left;
            }


            /* TIDAK ADA BERITA */

            .tidak-ada-berita {
                padding: 30px 18px;
            }

            .tidak-ada-berita h4 {
                font-size: 18px;
            }

            .tidak-ada-berita p {
                font-size: 13px;
                line-height: 1.6;
            }

        }


        /* ==================================================
           HP KECIL
        ================================================== */

        @media (max-width: 400px) {

            .halaman-berita {
                padding-left: 8px;
                padding-right: 8px;
            }

            .judul-berita h2 {
                font-size: 22px;
            }

            .judul-berita p {
                font-size: 12px;
            }

            .gambar-berita {
                height: 180px;
            }

            .isi-berita {
                padding: 13px;
            }

            .isi-berita h3 {
                font-size: 18px;
            }

            .deskripsi-berita {
                font-size: 13px;
            }

        }

    </style>

</head>


<body>


<!-- ==================================================
     KONTEN BERITA
================================================== -->

<div class="container halaman-berita">


    <!-- ==================================================
         JUDUL HALAMAN
    ================================================== -->

    <div class="judul-berita">

        <h2>

            <span class="glyphicon glyphicon-list-alt"></span>

            Berita Sekolah

        </h2>

        <p>

            Informasi dan kegiatan terbaru
            MTs Nurul Huda Pematang Cengal

        </p>

        <div class="garis-judul"></div>

    </div>


    <!-- ==================================================
         DATA BERITA
    ================================================== -->

    <?php

    if ($query && mysqli_num_rows($query) > 0) {

    ?>

        <div class="row">

            <?php

            while ($data = mysqli_fetch_assoc($query)) {

                $judul = htmlspecialchars(
                    $data['judul'],
                    ENT_QUOTES,
                    'UTF-8'
                );

                $isi = htmlspecialchars(
                    $data['isi'],
                    ENT_QUOTES,
                    'UTF-8'
                );

                $gambar = htmlspecialchars(
                    $data['gambar'],
                    ENT_QUOTES,
                    'UTF-8'
                );

            ?>


                <!-- ==================================================
                     CARD BERITA
                ================================================== -->

                <div class="col-sm-6 col-md-6">

                    <div class="card-berita">


                        <!-- GAMBAR -->

                        <div class="gambar-berita">

                            <?php if (!empty($gambar)) { ?>

                                <img
                                    src="../images/<?php echo $gambar; ?>"
                                    alt="<?php echo $judul; ?>"
                                >

                            <?php } else { ?>

                                <img
                                    src="../images/noimage.png"
                                    alt="Tidak ada gambar"
                                >

                            <?php } ?>

                        </div>


                        <!-- ISI BERITA -->

                        <div class="isi-berita">


                            <!-- LABEL -->

                            <span class="label-berita">

                                <span class="glyphicon glyphicon-bullhorn"></span>

                                Berita Sekolah

                            </span>


                            <!-- JUDUL -->

                            <h3>

                                <?php echo $judul; ?>

                            </h3>


                            <!-- TANGGAL -->

                            <p class="tanggal-berita">

                                <span class="glyphicon glyphicon-calendar"></span>

                                <?php

                                echo date(
                                    'd F Y',
                                    strtotime($data['tanggal'])
                                );

                                ?>

                            </p>


                            <!-- GARIS -->

                            <hr class="garis-berita">


                            <!-- ISI -->

                            <p class="deskripsi-berita">

                                <?php

                                echo nl2br($isi);

                                ?>

                            </p>


                        </div>

                    </div>

                </div>


            <?php

            }

            ?>

        </div>


    <?php

    } else {

    ?>


        <!-- ==================================================
             JIKA BELUM ADA BERITA
        ================================================== -->

        <div class="tidak-ada-berita">

            <span
                class="glyphicon glyphicon-info-sign"
                style="font-size:40px;">
            </span>

            <h4>
                Belum Ada Berita
            </h4>

            <p>

                Saat ini belum terdapat berita atau kegiatan
                yang dipublikasikan oleh MTs Nurul Huda
                Pematang Cengal.

            </p>

        </div>


    <?php

    }

    ?>


</div>


<!-- ==================================================
     FOOTER
================================================== -->

<?php include "footer.php"; ?>


</body>

</html>