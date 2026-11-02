<?php
include "../koneksi.php";
?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Prestasi Sekolah - MTs Nurul Huda Pematang Cengal</title>

    <style>

        /* =====================================================
           DASAR HALAMAN
        ===================================================== */

        html,
        body{
            margin:0;
            padding:0;
            width:100%;
        }

        body{
            background:#f5f7f6;
            color:#444;
        }


        /* =====================================================
           HALAMAN PRESTASI
        ===================================================== */

        .halaman-prestasi{
            padding-top:40px;
            padding-bottom:50px;
        }


        /* =====================================================
           JUDUL HALAMAN
        ===================================================== */

        .judul-prestasi{
            text-align:center;
            margin-bottom:40px;
        }

        .judul-prestasi h2{
            color:#087f3d;
            font-size:32px;
            font-weight:bold;
            margin:0 0 10px;
            line-height:1.4;
        }

        .judul-prestasi h2 .glyphicon{
            margin-right:6px;
        }

        .judul-prestasi p{
            color:#777;
            font-size:15px;
            line-height:1.7;
            margin:0 auto;
            max-width:700px;
        }

        .garis-judul{
            width:60px;
            height:3px;
            background:#087f3d;
            margin:15px auto 0;
            border-radius:5px;
        }


        /* =====================================================
           CARD PRESTASI
        ===================================================== */

        .kartu-prestasi{
            background:#fff;
            border:1px solid #e5e5e5;
            border-radius:12px;
            overflow:hidden;

            margin-bottom:30px;

            box-shadow:0 3px 15px rgba(0,0,0,0.07);

            transition:
                transform 0.3s ease,
                box-shadow 0.3s ease;
        }

        .kartu-prestasi:hover{
            transform:translateY(-6px);
            box-shadow:0 10px 28px rgba(0,0,0,0.13);
        }


        /* =====================================================
           GAMBAR PRESTASI
        ===================================================== */

        .gambar-prestasi{
            width:100%;
            height:230px;
            overflow:hidden;
            background:#eeeeee;
            position:relative;
        }

        .gambar-prestasi img{
            width:100%;
            height:100%;
            object-fit:cover;
            display:block;

            transition:transform 0.5s ease;
        }

        .kartu-prestasi:hover .gambar-prestasi img{
            transform:scale(1.06);
        }


        /* =====================================================
           JIKA TIDAK ADA GAMBAR
        ===================================================== */

        .tidak-ada-gambar{
            width:100%;
            height:230px;

            display:flex;
            align-items:center;
            justify-content:center;
            flex-direction:column;

            background:#f1f3f2;
            color:#999;

            font-size:14px;
        }

        .tidak-ada-gambar .glyphicon{
            font-size:32px;
            margin-bottom:8px;
            color:#aaa;
        }


        /* =====================================================
           ISI CARD
        ===================================================== */

        .isi-prestasi{
            padding:22px;
        }


        /* =====================================================
           NAMA PRESTASI
        ===================================================== */

        .isi-prestasi h3{
            color:#087f3d;
            font-size:21px;
            font-weight:bold;

            margin:0 0 15px;

            line-height:1.5;
        }


        /* =====================================================
           GARIS CARD
        ===================================================== */

        .garis-prestasi{
            border:0;
            border-top:1px solid #eeeeee;

            margin:15px 0 18px;
        }


        /* =====================================================
           INFORMASI PRESTASI
        ===================================================== */

        .info-prestasi{
            margin-bottom:10px;
        }

        .info-item{
            display:flex;
            align-items:flex-start;

            color:#555;
            font-size:14px;

            line-height:1.6;

            margin-bottom:13px;
        }

        .info-item .glyphicon{
            width:22px;
            min-width:22px;

            color:#087f3d;

            text-align:center;

            margin-right:7px;

            font-size:14px;
        }

        .label-info{
            color:#333;
            font-weight:bold;

            margin-right:5px;
        }


        /* =====================================================
           BADGE TINGKAT
        ===================================================== */

        .tingkat-prestasi{
            display:inline-block;

            background:#087f3d;
            color:#fff;

            padding:4px 10px;

            border-radius:20px;

            font-size:12px;
            font-weight:bold;

            line-height:1.4;
        }


        /* =====================================================
           BADGE TAHUN
        ===================================================== */

        .tahun-prestasi{
            display:inline-block;

            background:#f0ad4e;
            color:#fff;

            padding:4px 10px;

            border-radius:20px;

            font-size:12px;
            font-weight:bold;

            line-height:1.4;
        }


        /* =====================================================
           DESKRIPSI
        ===================================================== */

        .deskripsi-prestasi{
            color:#666;

            font-size:14px;

            line-height:1.8;

            text-align:justify;

            margin:0;
        }


        /* =====================================================
           DATA KOSONG
        ===================================================== */

        .data-kosong{
            background:#fff;

            border:1px solid #ddd;

            border-radius:10px;

            padding:40px 20px;

            text-align:center;

            color:#777;

            box-shadow:0 3px 12px rgba(0,0,0,0.05);
        }

        .data-kosong .glyphicon{
            display:block;

            font-size:40px;

            color:#f0ad4e;

            margin-bottom:12px;
        }

        .data-kosong h4{
            color:#555;

            font-weight:bold;

            margin:0 0 8px;
        }

        .data-kosong p{
            margin:0;

            font-size:14px;

            line-height:1.7;
        }


        /* =====================================================
           TABLET
        ===================================================== */

        @media (min-width:768px) and (max-width:991px){

            .halaman-prestasi{
                padding-top:35px;
            }

            .judul-prestasi h2{
                font-size:29px;
            }

            .gambar-prestasi,
            .tidak-ada-gambar{
                height:210px;
            }

            .isi-prestasi{
                padding:18px;
            }

            .isi-prestasi h3{
                font-size:20px;
            }

        }


        /* =====================================================
           HP
        ===================================================== */

        @media (max-width:767px){

            .halaman-prestasi{
                padding-top:25px;
                padding-bottom:30px;
            }

            .judul-prestasi{
                margin-bottom:28px;
                padding:0 10px;
            }

            .judul-prestasi h2{
                font-size:25px;
                line-height:1.4;
            }

            .judul-prestasi p{
                font-size:14px;
                line-height:1.7;
            }

            .garis-judul{
                width:50px;
                margin-top:12px;
            }


            /* CARD */

            .kartu-prestasi{
                margin-left:5px;
                margin-right:5px;
                margin-bottom:22px;

                border-radius:9px;
            }


            /* GAMBAR */

            .gambar-prestasi,
            .tidak-ada-gambar{
                height:200px;
            }


            /* ISI */

            .isi-prestasi{
                padding:17px;
            }

            .isi-prestasi h3{
                font-size:20px;
                line-height:1.45;
            }


            /* INFORMASI */

            .info-item{
                font-size:14px;
                margin-bottom:12px;
            }


            /* DESKRIPSI */

            .deskripsi-prestasi{
                font-size:14px;
                line-height:1.7;
                text-align:left;
            }


            /* DATA KOSONG */

            .data-kosong{
                margin:0 5px;
                padding:30px 15px;
            }

        }


        /* =====================================================
           HP KECIL
        ===================================================== */

        @media (max-width:480px){

            .halaman-prestasi{
                padding-top:20px;
            }

            .judul-prestasi{
                margin-bottom:25px;
            }

            .judul-prestasi h2{
                font-size:23px;
            }

            .judul-prestasi p{
                font-size:13px;
            }

            .gambar-prestasi,
            .tidak-ada-gambar{
                height:180px;
            }

            .isi-prestasi{
                padding:15px;
            }

            .isi-prestasi h3{
                font-size:19px;
            }

            .info-item{
                font-size:13px;
            }

            .deskripsi-prestasi{
                font-size:13px;
            }

        }

    </style>

</head>


<body>


<?php
/* =====================================================
   NAVBAR
   ===================================================== */

include "navbar.php";
?>


<!-- =====================================================
     KONTEN UTAMA
===================================================== -->

<div class="container halaman-prestasi">


    <!-- =================================================
         JUDUL
    ================================================= -->

    <div class="judul-prestasi">

        <h2>

            <span class="glyphicon glyphicon-star"></span>

            Prestasi Sekolah

        </h2>

        <p>

            Prestasi yang telah diraih oleh siswa-siswi
            MTs Nurul Huda Pematang Cengal.

        </p>

        <div class="garis-judul"></div>

    </div>


    <!-- =================================================
         DATA PRESTASI
    ================================================= -->

    <div class="row">

        <?php

        $query = mysqli_query(
            $koneksi,
            "SELECT * FROM prestasi
             ORDER BY tahun DESC"
        );


        if(mysqli_num_rows($query) > 0){

            while($data = mysqli_fetch_assoc($query)){

                $nama_prestasi = htmlspecialchars(
                    $data['nama_prestasi'],
                    ENT_QUOTES,
                    'UTF-8'
                );

                $tingkat = htmlspecialchars(
                    $data['tingkat'],
                    ENT_QUOTES,
                    'UTF-8'
                );

                $penyelenggara = htmlspecialchars(
                    $data['penyelenggara'],
                    ENT_QUOTES,
                    'UTF-8'
                );

                $tahun = htmlspecialchars(
                    $data['tahun'],
                    ENT_QUOTES,
                    'UTF-8'
                );

                $deskripsi = htmlspecialchars(
                    $data['deskripsi'],
                    ENT_QUOTES,
                    'UTF-8'
                );

                $gambar = htmlspecialchars(
                    $data['gambar'],
                    ENT_QUOTES,
                    'UTF-8'
                );

        ?>


        <!-- =================================================
             CARD PRESTASI
        ================================================= -->

        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">

            <div class="kartu-prestasi">


                <!-- GAMBAR -->

                <?php if(!empty($gambar)){ ?>

                    <div class="gambar-prestasi">

                        <img
                            src="../images/<?php echo $gambar; ?>"
                            alt="<?php echo $nama_prestasi; ?>"
                            loading="lazy"
                        >

                    </div>

                <?php }else{ ?>

                    <div class="tidak-ada-gambar">

                        <span class="glyphicon glyphicon-picture"></span>

                        <span>
                            Tidak ada gambar
                        </span>

                    </div>

                <?php } ?>


                <!-- ISI CARD -->

                <div class="isi-prestasi">


                    <!-- NAMA PRESTASI -->

                    <h3>

                        <?php echo $nama_prestasi; ?>

                    </h3>


                    <hr class="garis-prestasi">


                    <!-- TINGKAT -->

                    <div class="info-item">

                        <span class="glyphicon glyphicon-flag"></span>

                        <span class="label-info">
                            Tingkat:
                        </span>

                        <span class="tingkat-prestasi">

                            <?php echo $tingkat; ?>

                        </span>

                    </div>


                    <!-- PENYELENGGARA -->

                    <div class="info-item">

                        <span class="glyphicon glyphicon-user"></span>

                        <span class="label-info">
                            Penyelenggara:
                        </span>

                        <span>
                            <?php echo $penyelenggara; ?>
                        </span>

                    </div>


                    <!-- TAHUN -->

                    <div class="info-item">

                        <span class="glyphicon glyphicon-calendar"></span>

                        <span class="label-info">
                            Tahun:
                        </span>

                        <span class="tahun-prestasi">

                            <?php echo $tahun; ?>

                        </span>

                    </div>


                    <!-- DESKRIPSI -->

                    <?php if(!empty($deskripsi)){ ?>

                        <hr class="garis-prestasi">

                        <p class="deskripsi-prestasi">

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

        }else{

        ?>


        <!-- =================================================
             DATA KOSONG
        ================================================= -->

        <div class="col-md-12">

            <div class="data-kosong">

                <span class="glyphicon glyphicon-star"></span>

                <h4>
                    Data Prestasi Belum Tersedia
                </h4>

                <p>
                    Belum ada data prestasi yang
                    ditambahkan ke dalam website.
                </p>

            </div>

        </div>


        <?php

        }

        ?>

    </div>

</div>


<?php


include "footer.php";
?>


</body>

</html>