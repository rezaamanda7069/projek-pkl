<?php

if (isset($_POST['kirim'])) {

    $nama  = htmlspecialchars($_POST['nama']);
    $email = htmlspecialchars($_POST['email']);
    $pesan = htmlspecialchars($_POST['pesan']);

    $nomor = "6285362532382";

    $text = "Assalamu'alaikum Admin MTs Nurul Huda Pematang Cengal\n\n";
    $text .= "Nama : " . $nama . "\n";
    $text .= "Email : " . $email . "\n";
    $text .= "Pesan :\n" . $pesan;

    $url = "https://wa.me/" . $nomor . "?text=" . urlencode($text);

    echo "<script>
            window.open('$url', '_blank');
          </script>";
}

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Kontak - MTs Nurul Huda Pematang Cengal</title>


    <style>

        /* =========================================
           BODY
        ========================================= */

        body {
            margin: 0;
            padding: 0;
            background: #f5f7f6;
            color: #444;
            font-family: Arial, sans-serif;
        }


        /* =========================================
           HALAMAN KONTAK
        ========================================= */

        .kontak-page {
            padding-top: 35px;
            padding-bottom: 45px;
            min-height: 500px;
        }


        /* =========================================
           JUDUL
        ========================================= */

        .judul-kontak {
            text-align: center;
            margin-bottom: 35px;
            padding: 0 15px;
        }

        .judul-kontak h2 {
            color: #087f3d;
            font-size: 32px;
            font-weight: bold;
            margin: 0 0 12px;
            line-height: 1.4;
        }

        .judul-kontak h2 .glyphicon {
            margin-right: 6px;
        }

        .judul-kontak p {
            color: #777;
            font-size: 15px;
            line-height: 1.8;
            max-width: 700px;
            margin: 0 auto;
        }

        .garis-kontak {
            width: 55px;
            height: 3px;
            background: #087f3d;
            margin: 15px auto 0;
            border-radius: 5px;
        }


        /* =========================================
           BOX
        ========================================= */

        .kontak-box {
            background: #fff;
            border: 1px solid #e5e5e5;
            border-radius: 12px;
            overflow: hidden;
            margin-bottom: 25px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.07);
        }


        /* =========================================
           HEADER BOX
        ========================================= */

        .kontak-header {
            background: #087f3d;
            color: #fff;
            padding: 17px 20px;
        }

        .kontak-header h3 {
            margin: 0;
            font-size: 19px;
            font-weight: bold;
            line-height: 1.5;
        }

        .kontak-header .glyphicon {
            margin-right: 8px;
        }


        /* =========================================
           BODY BOX
        ========================================= */

        .kontak-body {
            padding: 20px;
        }


        /* =========================================
           INFORMASI SEKOLAH
        ========================================= */

        .info-item {
            position: relative;
            padding: 14px 0;
            border-bottom: 1px solid #eeeeee;
            min-height: 68px;
        }

        .info-item:first-child {
            padding-top: 5px;
        }

        .info-item:last-child {
            border-bottom: none;
            padding-bottom: 5px;
        }


        /* =========================================
           ICON INFORMASI
        ========================================= */

        .info-icon {
            width: 42px;
            height: 42px;
            line-height: 42px;
            text-align: center;
            background: #eaf7ef;
            color: #087f3d;
            border-radius: 50%;
            float: left;
            margin-right: 13px;
            font-size: 16px;
        }


        /* =========================================
           TEXT INFORMASI
        ========================================= */

        .info-text {
            overflow: hidden;
            padding-top: 1px;
        }

        .info-text strong {
            display: block;
            color: #333;
            font-size: 13px;
            margin-bottom: 4px;
        }

        .info-text span,
        .info-text p {
            color: #666;
            font-size: 14px;
            line-height: 1.7;
            margin: 0;
        }


        /* =========================================
           FORM
        ========================================= */

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            color: #444;
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 7px;
        }

        .form-control {
            width: 100%;
            height: 43px;
            border: 1px solid #ddd;
            border-radius: 6px;
            box-shadow: none;
            font-size: 14px;
            padding: 10px 12px;
            box-sizing: border-box;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #087f3d;
            box-shadow: 0 0 4px rgba(8,127,61,0.15);
            outline: none;
        }

        textarea.form-control {
            height: auto;
            min-height: 150px;
            resize: vertical;
        }


        /* =========================================
           TOMBOL WHATSAPP
        ========================================= */

        .btn-whatsapp {
            width: 100%;
            background: #25D366;
            border: none;
            color: #fff;
            font-weight: bold;
            font-size: 15px;
            padding: 12px 15px;
            border-radius: 6px;
            transition: all 0.3s ease;
        }

        .btn-whatsapp:hover,
        .btn-whatsapp:focus {
            background: #1ebe5d;
            color: #fff;
            text-decoration: none;
            outline: none;
        }


        /* =========================================
           INFORMASI TAMBAHAN
        ========================================= */

        .info-tambahan {
            margin-top: 15px;
            padding: 13px 15px;
            background: #f0f8f3;
            border-left: 4px solid #087f3d;
            border-radius: 4px;
        }

        .info-tambahan p {
            margin: 0;
            color: #666;
            font-size: 13px;
            line-height: 1.7;
        }

        .info-tambahan .glyphicon {
            color: #087f3d;
            margin-right: 5px;
        }


        /* =========================================
           RESPONSIVE TABLET
        ========================================= */

        @media (max-width: 991px) {

            .kontak-page {
                padding-top: 30px;
            }

            .kontak-header {
                padding: 15px 18px;
            }

            .kontak-body {
                padding: 18px;
            }

            .kontak-header h3 {
                font-size: 18px;
            }

        }


        /* =========================================
           RESPONSIVE HP
        ========================================= */

        @media (max-width: 767px) {

            .kontak-page {
                padding-top: 25px;
                padding-bottom: 30px;
            }


            /* Judul */

            .judul-kontak {
                margin-bottom: 25px;
                padding: 0 10px;
            }

            .judul-kontak h2 {
                font-size: 25px;
            }

            .judul-kontak p {
                font-size: 14px;
                line-height: 1.7;
            }


            /* Box */

            .kontak-box {
                border-radius: 9px;
                margin-bottom: 20px;
            }


            /* Header */

            .kontak-header {
                padding: 14px 15px;
            }

            .kontak-header h3 {
                font-size: 17px;
            }


            /* Body */

            .kontak-body {
                padding: 15px;
            }


            /* Informasi */

            .info-item {
                padding: 12px 0;
                min-height: 64px;
            }

            .info-icon {
                width: 38px;
                height: 38px;
                line-height: 38px;
                font-size: 14px;
                margin-right: 10px;
            }

            .info-text strong {
                font-size: 12px;
            }

            .info-text span,
            .info-text p {
                font-size: 13px;
                line-height: 1.6;
            }


            /* Form */

            .form-group {
                margin-bottom: 15px;
            }

            .form-group label {
                font-size: 13px;
            }

            .form-control {
                height: 41px;
                font-size: 14px;
            }

            textarea.form-control {
                min-height: 130px;
            }


            /* Tombol */

            .btn-whatsapp {
                font-size: 14px;
                padding: 11px 10px;
            }


            /* Informasi tambahan */

            .info-tambahan {
                padding: 11px 12px;
            }

            .info-tambahan p {
                font-size: 12px;
            }

        }


        /* =========================================
           HP KECIL
        ========================================= */

        @media (max-width: 480px) {

            .kontak-page {
                padding-top: 20px;
            }

            .judul-kontak h2 {
                font-size: 23px;
            }

            .judul-kontak p {
                font-size: 13px;
            }

            .kontak-body {
                padding: 14px;
            }

            .info-icon {
                width: 36px;
                height: 36px;
                line-height: 36px;
            }

            .info-text span,
            .info-text p {
                font-size: 12.5px;
            }

            .btn-whatsapp {
                font-size: 13px;
            }

        }

    </style>

</head>


<body>


    

    <?php include "navbar.php"; ?>


   

    <div class="kontak-page">

        <div class="container">


            
            <div class="judul-kontak">

                <h2>

                    <span class="glyphicon glyphicon-earphone"></span>

                    Kontak Kami

                </h2>

                <p>

                    Hubungi MTs Nurul Huda Pematang Cengal
                    untuk mendapatkan informasi lebih lanjut
                    mengenai sekolah dan berbagai kegiatan.

                </p>

                <div class="garis-kontak"></div>

            </div>


            <!-- =====================================
                 BARIS INFORMASI + FORM
            ====================================== -->

            <div class="row">


                <!-- =================================
                     INFORMASI SEKOLAH
                ================================== -->

                <div class="col-md-6">

                    <div class="kontak-box">

                        <div class="kontak-header">

                            <h3>

                                <span class="glyphicon glyphicon-info-sign"></span>

                                Informasi Sekolah

                            </h3>

                        </div>


                        <div class="kontak-body">


                            <!-- Nama Sekolah -->

                            <div class="info-item">

                                <div class="info-icon">

                                    <span class="glyphicon glyphicon-home"></span>

                                </div>

                                <div class="info-text">

                                    <strong>Nama Sekolah</strong>

                                    <span>
                                        MTs Nurul Huda Pematang Cengal
                                    </span>

                                </div>

                            </div>


                            <!-- Alamat -->

                            <div class="info-item">

                                <div class="info-icon">

                                    <span class="glyphicon glyphicon-map-marker"></span>

                                </div>

                                <div class="info-text">

                                    <strong>Alamat</strong>

                                    <span>
                                        Pematang Cengal,
                                        Kabupaten Langkat,
                                        Sumatera Utara
                                    </span>

                                </div>

                            </div>


                            <!-- Telepon -->

                            <div class="info-item">

                                <div class="info-icon">

                                    <span class="glyphicon glyphicon-phone"></span>

                                </div>

                                <div class="info-text">

                                    <strong>Telepon / WhatsApp</strong>

                                    <span>
                                        0812-6016-6780
                                    </span>

                                </div>

                            </div>


                            <!-- Email -->

                            <div class="info-item">

                                <div class="info-icon">

                                    <span class="glyphicon glyphicon-envelope"></span>

                                </div>

                                <div class="info-text">

                                    <strong>Email</strong>

                                    <span>
                                        mtsnurulhuda@gmail.com
                                    </span>

                                </div>

                            </div>


                            <!-- Jam Pelayanan -->

                            <div class="info-item">

                                <div class="info-icon">

                                    <span class="glyphicon glyphicon-time"></span>

                                </div>

                                <div class="info-text">

                                    <strong>Jam Pelayanan</strong>

                                    <p>
                                        Senin - Kamis
                                        (07.30 - 14.00 WIB)
                                        <br>

                                        Jum'at - Sabtu
                                        (07.30 - 12.00 WIB)
                                    </p>

                                </div>

                            </div>


                            <!-- Informasi Tambahan -->

                            <div class="info-tambahan">

                                <p>

                                    <span class="glyphicon glyphicon-info-sign"></span>

                                    Silakan hubungi kami melalui WhatsApp
                                    untuk mendapatkan informasi sekolah
                                    dengan lebih cepat.

                                </p>

                            </div>


                        </div>

                    </div>

                </div>


                <!-- =================================
                     FORM PESAN
                ================================== -->

                <div class="col-md-6">

                    <div class="kontak-box">

                        <div class="kontak-header">

                            <h3>

                                <span class="glyphicon glyphicon-comment"></span>

                                Kirim Pesan

                            </h3>

                        </div>


                        <div class="kontak-body">

                            <form method="post">


                                <!-- Nama -->

                                <div class="form-group">

                                    <label>
                                        Nama Lengkap
                                    </label>

                                    <input
                                        type="text"
                                        name="nama"
                                        class="form-control"
                                        placeholder="Masukkan nama lengkap"
                                        required
                                    >

                                </div>


                                <!-- Email -->

                                <div class="form-group">

                                    <label>
                                        Email
                                    </label>

                                    <input
                                        type="email"
                                        name="email"
                                        class="form-control"
                                        placeholder="Masukkan alamat email"
                                        required
                                    >

                                </div>


                                <!-- Pesan -->

                                <div class="form-group">

                                    <label>
                                        Pesan
                                    </label>

                                    <textarea
                                        name="pesan"
                                        class="form-control"
                                        rows="7"
                                        placeholder="Tuliskan pesan Anda..."
                                        required
                                    ></textarea>

                                </div>


                                <!-- Tombol WhatsApp -->

                                <button
                                    type="submit"
                                    name="kirim"
                                    class="btn btn-whatsapp"
                                >

                                    <span class="glyphicon glyphicon-send"></span>

                                    Kirim Pesan via WhatsApp

                                </button>


                            </form>

                        </div>

                    </div>

                </div>


            </div>

        </div>

    </div>


    <!-- =========================================
         FOOTER
    ========================================== -->

    <?php include "footer.php"; ?>


</body>

</html>