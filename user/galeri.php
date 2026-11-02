<?php
include "../koneksi.php";
?>
<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="utf-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1">

    <title>Galeri - MTs Nurul Huda Pematang Cengal</title>

    <?php include "navbar.php"; ?>

    <style>

        /* =====================================================
           BODY
        ===================================================== */

        body{
            background:#f5f7f6;
            margin:0;
            padding-top:70px;
            font-family:Arial, sans-serif;
        }


        /* =====================================================
           HALAMAN GALERI
        ===================================================== */

        .halaman-galeri{
            padding-top:35px;
            padding-bottom:45px;
        }


        /* =====================================================
           JUDUL
        ===================================================== */

        .judul-galeri{
            text-align:center;
            margin-bottom:35px;
        }

        .judul-galeri h2{
            color:#2e7d32;
            font-size:32px;
            font-weight:bold;
            margin-top:0;
            margin-bottom:10px;
        }

        .judul-galeri h2 .glyphicon{
            margin-right:6px;
        }

        .judul-galeri p{
            color:#777;
            font-size:15px;
            line-height:1.7;
            margin:0;
        }

        .garis-judul{
            width:55px;
            height:3px;
            background:#4caf50;
            margin:12px auto 0;
            border-radius:5px;
        }


        /* =====================================================
           KARTU GALERI
        ===================================================== */

        .kartu-galeri{
            margin-bottom:30px;
        }

        .kartu-galeri .thumbnail{
            padding:0;
            margin-bottom:0;

            border:none;
            border-radius:12px;

            overflow:hidden;

            background:#fff;

            box-shadow:0 4px 15px rgba(0,0,0,0.08);

            transition:all .3s ease;
        }

        .kartu-galeri .thumbnail:hover{
            transform:translateY(-6px);

            box-shadow:0 10px 25px rgba(0,0,0,0.13);
        }


        /* =====================================================
           GAMBAR
        ===================================================== */

        .gambar-galeri{
            width:100%;
            height:230px;

            object-fit:cover;
            display:block;

            transition:transform .4s ease;
        }

        .kartu-galeri .thumbnail:hover .gambar-galeri{
            transform:scale(1.04);
        }


        /* =====================================================
           CAPTION
        ===================================================== */

        .kartu-galeri .caption{
            padding:20px;
        }

        .kartu-galeri h4{
            color:#2e7d32;

            font-size:19px;
            font-weight:bold;

            line-height:1.4;

            margin-top:0;
            margin-bottom:10px;
        }

        .kartu-galeri p{
            color:#555;

            font-size:14px;

            line-height:1.7;

            margin-bottom:10px;
        }


        /* =====================================================
           TANGGAL
        ===================================================== */

        .tanggal{
            color:#888 !important;

            font-size:13px !important;

            margin-bottom:12px !important;
        }

        .tanggal .glyphicon{
            color:#4caf50;
            margin-right:5px;
        }


        /* =====================================================
           GARIS CAPTION
        ===================================================== */

        .garis-galeri{
            border:0;
            border-top:1px solid #eeeeee;

            margin:12px 0 15px;
        }


        /* =====================================================
           KETERANGAN
        ===================================================== */

        .keterangan-galeri{
            color:#666 !important;

            font-size:14px !important;

            line-height:1.8 !important;

            margin-bottom:0 !important;

            text-align:justify;
        }


        /* =====================================================
           DATA KOSONG
        ===================================================== */

        .data-kosong{
            background:#fff;

            border:1px solid #e5e5e5;

            border-radius:10px;

            padding:40px 20px;

            text-align:center;

            color:#777;

            box-shadow:0 3px 12px rgba(0,0,0,0.06);
        }

        .data-kosong .glyphicon{
            font-size:38px;
            color:#4caf50;

            margin-bottom:12px;
        }

        .data-kosong h4{
            color:#555;

            font-weight:bold;

            margin-top:10px;
            margin-bottom:8px;
        }

        .data-kosong p{
            margin-bottom:0;
            line-height:1.7;
        }


        /* =====================================================
           FOOTER
        ===================================================== */

        .footer{
            background:#2e7d32;

            color:#fff;

            margin-top:0;

            padding:45px 0 20px;
        }

        .footer h3{
            margin-top:0;

            margin-bottom:15px;

            font-size:22px;

            font-weight:bold;

            color:#fff;
        }

        .footer h4{
            margin-top:0;

            margin-bottom:20px;

            padding-bottom:10px;

            font-size:17px;

            font-weight:bold;

            color:#fff;

            border-bottom:2px solid rgba(255,255,255,0.35);
        }

        .footer p{
            color:#f5f5f5;

            font-size:14px;

            line-height:1.8;

            margin-bottom:12px;
        }

        .footer a{
            color:#fff;

            text-decoration:none;

            transition:.2s;
        }

        .footer a:hover{
            color:#dcedc8;

            text-decoration:none;

            padding-left:3px;
        }

        .footer .glyphicon{
            width:20px;

            margin-right:5px;
        }

        .footer-bottom{
            border-top:1px solid rgba(255,255,255,0.25);

            margin-top:30px;

            padding-top:20px;

            text-align:center;
        }

        .footer-bottom p{
            margin:0;

            color:rgba(255,255,255,0.9);

            font-size:13px;
        }


        /* =====================================================
           TABLET
        ===================================================== */

        @media(min-width:768px) and (max-width:991px){

            body{
                padding-top:70px;
            }

            .halaman-galeri{
                padding-top:30px;
                padding-bottom:40px;
            }

            .judul-galeri h2{
                font-size:29px;
            }

            .gambar-galeri{
                height:210px;
            }

            .kartu-galeri .caption{
                padding:17px;
            }

            .kartu-galeri h4{
                font-size:18px;
            }

        }


        /* =====================================================
           HP
        ===================================================== */

        @media(max-width:767px){

            body{
                padding-top:60px;
            }

            .halaman-galeri{
                padding-top:25px;
                padding-bottom:30px;

                padding-left:10px;
                padding-right:10px;
            }


            /* Judul */

            .judul-galeri{
                margin-bottom:25px;

                padding:0 5px;
            }

            .judul-galeri h2{
                font-size:25px;

                line-height:1.4;
            }

            .judul-galeri p{
                font-size:14px;

                line-height:1.7;
            }


            /* Kartu */

            .kartu-galeri{
                margin-bottom:20px;

                padding-left:5px;
                padding-right:5px;
            }

            .kartu-galeri .thumbnail{
                border-radius:10px;
            }


            /* Gambar */

            .gambar-galeri{
                height:210px;
            }


            /* Caption */

            .kartu-galeri .caption{
                padding:16px;
            }

            .kartu-galeri h4{
                font-size:19px;

                line-height:1.4;

                margin-bottom:8px;
            }

            .kartu-galeri p{
                font-size:14px;

                line-height:1.7;
            }

            .keterangan-galeri{
                text-align:left;

                line-height:1.7 !important;
            }


            /* Data kosong */

            .data-kosong{
                padding:30px 15px;

                margin:0 5px;
            }


            /* Footer */

            .footer{
                padding:35px 15px 15px;

                text-align:center;
            }

            .footer .col-sm-4{
                margin-bottom:30px;
            }

            .footer h3{
                font-size:21px;
            }

            .footer h4{
                font-size:16px;

                display:inline-block;

                min-width:180px;
            }

            .footer p{
                font-size:14px;

                line-height:1.8;
            }

            .footer-bottom{
                margin-top:10px;
            }

        }


        /* =====================================================
           HP KECIL
        ===================================================== */

        @media(max-width:480px){

            body{
                padding-top:55px;
            }

            .halaman-galeri{
                padding-top:20px;

                padding-left:8px;
                padding-right:8px;
            }

            .judul-galeri{
                margin-bottom:22px;
            }

            .judul-galeri h2{
                font-size:22px;
            }

            .judul-galeri p{
                font-size:13px;
            }

            .gambar-galeri{
                height:185px;
            }

            .kartu-galeri{
                padding-left:3px;
                padding-right:3px;

                margin-bottom:18px;
            }

            .kartu-galeri .caption{
                padding:15px;
            }

            .kartu-galeri h4{
                font-size:18px;
            }

            .keterangan-galeri{
                font-size:13px !important;
            }

            .footer{
                padding-top:30px;
            }

        }

    </style>

</head>


<body>


    <!-- =====================================================
         KONTEN GALERI
    ===================================================== -->

    <main>

        <div class="container halaman-galeri">


            <!-- =================================================
                 JUDUL GALERI
            ================================================= -->

            <div class="judul-galeri">

                <h2>

                    <span class="glyphicon glyphicon-picture"></span>

                    Galeri Kegiatan

                </h2>

                <p>
                    Dokumentasi kegiatan dan aktivitas
                    MTs Nurul Huda Pematang Cengal
                </p>

                <div class="garis-judul"></div>

            </div>


            <!-- =================================================
                 DATA GALERI
            ================================================= -->

            <div class="row">

                <?php

                $query = mysqli_query(
                    $koneksi,
                    "SELECT * FROM galeri
                     ORDER BY tanggal DESC"
                );

                if(mysqli_num_rows($query) > 0){

                    while($data = mysqli_fetch_assoc($query)){

                        $judul = htmlspecialchars(
                            $data['judul'],
                            ENT_QUOTES,
                            'UTF-8'
                        );

                        $gambar = htmlspecialchars(
                            $data['gambar'],
                            ENT_QUOTES,
                            'UTF-8'
                        );

                        $keterangan = htmlspecialchars(
                            $data['keterangan'],
                            ENT_QUOTES,
                            'UTF-8'
                        );

                ?>


                    <!-- =========================================
                         CARD GALERI
                    ========================================== -->

                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 kartu-galeri">

                        <div class="thumbnail">


                            <!-- GAMBAR -->

                            <?php if(!empty($gambar)){ ?>

                                <img
                                    src="../images/<?php echo $gambar; ?>"
                                    class="gambar-galeri"
                                    alt="<?php echo $judul; ?>"
                                >

                            <?php }else{ ?>

                                <div
                                    class="gambar-galeri"
                                    style="
                                        background:#eeeeee;
                                        display:flex;
                                        align-items:center;
                                        justify-content:center;
                                        color:#999;
                                    "
                                >

                                    <span
                                        class="glyphicon glyphicon-picture"
                                        style="font-size:40px;"
                                    ></span>

                                </div>

                            <?php } ?>


                            <!-- CAPTION -->

                            <div class="caption">


                                <!-- JUDUL -->

                                <h4>

                                    <?php echo $judul; ?>

                                </h4>


                                <!-- TANGGAL -->

                                <p class="tanggal">

                                    <span class="glyphicon glyphicon-calendar"></span>

                                    <?php

                                    echo date(
                                        'd F Y',
                                        strtotime($data['tanggal'])
                                    );

                                    ?>

                                </p>


                                <hr class="garis-galeri">


                                <!-- KETERANGAN -->

                                <?php if(!empty($keterangan)){ ?>

                                    <p class="keterangan-galeri">

                                        <?php echo nl2br($keterangan); ?>

                                    </p>

                                <?php }else{ ?>

                                    <p class="keterangan-galeri">

                                        Dokumentasi kegiatan
                                        MTs Nurul Huda Pematang Cengal.

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
                    ================================================== -->

                    <div class="col-md-12">

                        <div class="data-kosong">

                            <span class="glyphicon glyphicon-picture"></span>

                            <h4>
                                Belum Ada Dokumentasi
                            </h4>

                            <p>
                                Saat ini belum terdapat dokumentasi
                                kegiatan yang dipublikasikan oleh
                                MTs Nurul Huda Pematang Cengal.
                            </p>

                        </div>

                    </div>


                <?php

                }

                ?>

            </div>

        </div>

    </main>
 <?php include "footer.php";
    ?>
</body>

</html>