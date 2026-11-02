<?php

include "../koneksi.php";

$status_ditemukan = false;
$data = null;
$pesan = "";


/* =====================================
   CEK STATUS
===================================== */

if (isset($_POST['cek_status'])) {

    $no_pendaftaran = mysqli_real_escape_string(
        $koneksi,
        trim($_POST['no_pendaftaran'])
    );

    if ($no_pendaftaran == "") {

        $pesan = "Silakan masukkan nomor pendaftaran.";

    } else {

        $query = mysqli_query(
            $koneksi,
            "SELECT
                id_pendaftaran,
                no_pendaftaran,
                nama_lengkap,
                asal_sekolah,
                status,
                alasan_ditolak
             FROM pendaftaran
             WHERE no_pendaftaran = '$no_pendaftaran'
             LIMIT 1"
        );

        if ($query && mysqli_num_rows($query) > 0) {

            $data = mysqli_fetch_assoc($query);

            $status_ditemukan = true;

        } else {

            $pesan =
                "Nomor pendaftaran tidak ditemukan. " .
                "Pastikan nomor yang dimasukkan benar.";

        }

    }

}

?>


<?php include "navbar.php"; ?>


<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="utf-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1">

    <title>
        Cek Status Pendaftaran - PPDB
    </title>


    <style>

        /* =====================================
           BODY
        ===================================== */

        body {

            background: #f4f6f8;

            padding-top: 70px;

            font-family: Arial, sans-serif;

            color: #333;

        }


        /* =====================================
           CONTAINER
        ===================================== */

        .status-container {

            padding-top: 40px;

            padding-bottom: 60px;

        }


        /* =====================================
           CARD
        ===================================== */

        .status-card {

            max-width: 650px;

            margin: 0 auto;

            background: #fff;

            border-radius: 14px;

            box-shadow:
                0 5px 20px rgba(0,0,0,.08);

            overflow: hidden;

        }


        /* =====================================
           HEADER
        ===================================== */

        .status-header {

            background:
                linear-gradient(
                    135deg,
                    #176b3a,
                    #2e8b57
                );

            color: #fff;

            padding: 35px 25px;

            text-align: center;

        }


        .status-icon {

            width: 70px;

            height: 70px;

            line-height: 70px;

            margin: 0 auto 15px;

            border-radius: 50%;

            background:
                rgba(255,255,255,.15);

            font-size: 30px;

        }


        .status-header h2 {

            margin: 0 0 8px;

            font-size: 27px;

            font-weight: bold;

        }


        .status-header p {

            margin: 0;

            font-size: 14px;

            opacity: .9;

        }


        /* =====================================
           BODY
        ===================================== */

        .status-body {

            padding: 30px;

        }


        .status-body label {

            font-weight: bold;

            margin-bottom: 8px;

        }


        .form-control {

            height: 45px;

            border-radius: 7px;

            box-shadow: none;

        }


        .form-control:focus {

            border-color: #2e7d32;

            box-shadow:
                0 0 5px
                rgba(46,125,50,.2);

        }


        /* =====================================
           TOMBOL CEK STATUS
        ===================================== */

        .btn-status {

            width: 100%;

            height: 45px;

            margin-top: 10px;

            border: none;

            border-radius: 7px;

            background: #2e7d32;

            color: #fff;

            font-weight: bold;

            font-size: 15px;

        }


        .btn-status:hover {

            background: #1b5e20;

            color: #fff;

        }


        /* =====================================
           HASIL STATUS
        ===================================== */

        .result-box {

            margin-top: 25px;

            border-radius: 10px;

            padding: 20px;

            background: #f8faf9;

            border: 1px solid #e5e5e5;

        }


        .result-title {

            font-size: 17px;

            font-weight: bold;

            margin-bottom: 15px;

            color: #2e7d32;

        }


        .data-row {

            padding: 10px 0;

            border-bottom: 1px solid #eee;

        }


        .data-row:last-child {

            border-bottom: none;

        }


        .data-label {

            color: #777;

            font-size: 13px;

            margin-bottom: 3px;

        }


        .data-value {

            font-size: 15px;

            font-weight: bold;

        }


        /* =====================================
           STATUS LABEL
        ===================================== */

        .status-label {

            display: inline-block;

            padding: 8px 16px;

            border-radius: 20px;

            font-size: 13px;

            font-weight: bold;

        }


        .status-menunggu {

            background: #fff3cd;

            color: #856404;

        }


        .status-diverifikasi {

            background: #d9edf7;

            color: #31708f;

        }


        .status-diterima {

            background: #dff0d8;

            color: #3c763d;

        }


        .status-ditolak {

            background: #f2dede;

            color: #a94442;

        }


        .status-default {

            background: #eee;

            color: #555;

        }


        /* =====================================
           INFO
        ===================================== */

        .info-box {

            margin-top: 20px;

            padding: 13px 15px;

            border-left: 4px solid #2e7d32;

            background: #f1f8f3;

            color: #666;

            font-size: 13px;

            line-height: 1.6;

            border-radius: 4px;

        }


        /* =====================================
           ALASAN DITOLAK
        ===================================== */

        .alasan-ditolak {

            margin-top: 20px;

            padding: 18px;

            background: #fff5f5;

            border: 1px solid #ebccd1;

            border-left: 5px solid #d9534f;

            border-radius: 8px;

        }


        .alasan-ditolak-title {

            margin-bottom: 10px;

            color: #a94442;

            font-size: 15px;

            font-weight: bold;

        }


        .alasan-ditolak-title .glyphicon {

            margin-right: 5px;

        }


        .alasan-ditolak-text {

            margin: 0;

            color: #555;

            font-size: 14px;

            line-height: 1.7;

            font-weight: normal;

            word-wrap: break-word;

        }


        /* =====================================
           TOMBOL CETAK
        ===================================== */

        .cetak-area {

            margin-top: 20px;

            padding-top: 20px;

            border-top: 1px solid #e5e5e5;

            text-align: center;

        }


        .btn-cetak {

            display: inline-block;

            padding: 11px 22px;

            background: #337ab7;

            color: #fff;

            border: none;

            border-radius: 6px;

            font-size: 14px;

            font-weight: bold;

            text-decoration: none;

            transition: .3s;

        }


        .btn-cetak:hover {

            background: #286090;

            color: #fff;

            text-decoration: none;

        }


        /* =====================================
           RESPONSIVE
        ===================================== */

        @media(max-width: 767px) {

            .status-container {

                padding-top: 20px;

                padding-bottom: 40px;

            }


            .status-header {

                padding: 28px 18px;

            }


            .status-header h2 {

                font-size: 23px;

            }


            .status-body {

                padding: 20px;

            }


            .status-card {

                border-radius: 10px;

            }


            .btn-cetak {

                width: 100%;

                display: block;

            }


            .alasan-ditolak {

                padding: 15px;

            }

        }


        @media(max-width: 480px) {

            .status-header h2 {

                font-size: 21px;

            }


            .status-header p {

                font-size: 13px;

            }


            .status-body {

                padding: 15px;

            }


            .result-box {

                padding: 15px;

            }

        }

    </style>

</head>


<body>


<div class="container status-container">


    <div class="status-card">


        <!-- =================================
             HEADER
        ================================== -->

        <div class="status-header">

            <div class="status-icon">

                <span class="glyphicon glyphicon-search"></span>

            </div>


            <h2>

                Cek Status Pendaftaran

            </h2>


            <p>

                PPDB MTs Nurul Huda Pematang Cengal

            </p>

        </div>


        <!-- =================================
             BODY
        ================================== -->

        <div class="status-body">


            <form method="POST">

                <div class="form-group">

                    <label>

                        Nomor Pendaftaran

                    </label>


                    <input
                        type="text"
                        name="no_pendaftaran"
                        class="form-control"
                        placeholder="Contoh: PPDB-2026-12345"
                        value="<?php

                            if (isset($_POST['no_pendaftaran'])) {

                                echo htmlspecialchars(
                                    $_POST['no_pendaftaran'],
                                    ENT_QUOTES,
                                    'UTF-8'
                                );

                            }

                        ?>"
                        required>

                </div>


                <button
                    type="submit"
                    name="cek_status"
                    class="btn btn-status">

                    <span class="glyphicon glyphicon-search"></span>

                    Cek Status Pendaftaran

                </button>

            </form>


            <!-- =================================
                 PESAN ERROR
            ================================== -->

            <?php if ($pesan != "") { ?>

                <div
                    class="alert alert-danger"
                    style="margin-top:20px;">

                    <span class="glyphicon glyphicon-warning-sign"></span>

                    <?php
                    echo htmlspecialchars(
                        $pesan,
                        ENT_QUOTES,
                        'UTF-8'
                    );
                    ?>

                </div>

            <?php } ?>


            <!-- =================================
                 HASIL
            ================================== -->

            <?php if ($status_ditemukan) { ?>


                <div class="result-box">


                    <div class="result-title">

                        <span class="glyphicon glyphicon-ok-circle"></span>

                        Data Pendaftaran Ditemukan

                    </div>


                    <!-- NOMOR -->

                    <div class="data-row">

                        <div class="data-label">

                            Nomor Pendaftaran

                        </div>

                        <div class="data-value">

                            <?php

                            echo htmlspecialchars(
                                $data['no_pendaftaran'],
                                ENT_QUOTES,
                                'UTF-8'
                            );

                            ?>

                        </div>

                    </div>


                    <!-- NAMA -->

                    <div class="data-row">

                        <div class="data-label">

                            Nama Calon Siswa

                        </div>

                        <div class="data-value">

                            <?php

                            echo htmlspecialchars(
                                $data['nama_lengkap'],
                                ENT_QUOTES,
                                'UTF-8'
                            );

                            ?>

                        </div>

                    </div>


                    <!-- ASAL SEKOLAH -->

                    <div class="data-row">

                        <div class="data-label">

                            Asal Sekolah

                        </div>

                        <div class="data-value">

                            <?php

                            echo htmlspecialchars(
                                $data['asal_sekolah'],
                                ENT_QUOTES,
                                'UTF-8'
                            );

                            ?>

                        </div>

                    </div>


                    <!-- STATUS -->

                    <div class="data-row">

                        <div class="data-label">

                            Status Pendaftaran

                        </div>


                        <div class="data-value">

                            <?php

                            $status = $data['status'];


                            if ($status == "Menunggu") {

                                $class =
                                    "status-menunggu";

                            } elseif (
                                $status == "Diverifikasi"
                            ) {

                                $class =
                                    "status-diverifikasi";

                            } elseif (
                                $status == "Diterima"
                            ) {

                                $class =
                                    "status-diterima";

                            } elseif (
                                $status == "Ditolak"
                            ) {

                                $class =
                                    "status-ditolak";

                            } else {

                                $class =
                                    "status-default";

                            }

                            ?>


                            <span
                                class="status-label <?php echo $class; ?>">

                                <?php

                                echo htmlspecialchars(
                                    $status,
                                    ENT_QUOTES,
                                    'UTF-8'
                                );

                                ?>

                            </span>

                        </div>

                    </div>


                    <!-- =================================
                         INFORMASI STATUS
                    ================================== -->

                    <?php if ($status == "Menunggu") { ?>

                        <div class="info-box">

                            <strong>

                                <span class="glyphicon glyphicon-time"></span>

                                Informasi:

                            </strong>

                            Pendaftaran Anda telah
                            diterima oleh sistem dan
                            sedang menunggu pemeriksaan
                            dari admin/panitia PPDB.

                        </div>

                    <?php } ?>


                    <?php if ($status == "Diverifikasi") { ?>

                        <div class="info-box">

                            <strong>

                                <span class="glyphicon glyphicon-check"></span>

                                Informasi:

                            </strong>

                            Data dan dokumen pendaftaran
                            Anda telah diperiksa oleh
                            panitia PPDB.

                        </div>

                    <?php } ?>


                    <?php if ($status == "Diterima") { ?>

                        <div
                            class="alert alert-success"
                            style="margin-top:20px;">

                            <strong>

                                <span class="glyphicon glyphicon-ok-circle"></span>

                                Selamat!

                            </strong>

                            Pendaftaran Anda dinyatakan
                            <strong>DITERIMA</strong>
                            di MTs Nurul Huda
                            Pematang Cengal.

                        </div>

                    <?php } ?>


                    <!-- =================================
                         DITOLAK + ALASAN DARI ADMIN
                    ================================== -->

                    <?php if ($status == "Ditolak") { ?>

                        <div class="alasan-ditolak">

                            <div class="alasan-ditolak-title">

                                <span class="glyphicon glyphicon-remove-circle"></span>

                                Pendaftaran Ditolak

                            </div>


                            <p class="alasan-ditolak-text">

                                <strong>
                                    Alasan Penolakan:
                                </strong>

                                <br>


                                <?php

                                if (
                                    !empty(
                                        $data['alasan_ditolak']
                                    )
                                ) {

                                    echo nl2br(
                                        htmlspecialchars(
                                            $data['alasan_ditolak'],
                                            ENT_QUOTES,
                                            'UTF-8'
                                        )
                                    );

                                } else {

                                    echo
                                        "Alasan penolakan belum diberikan oleh panitia PPDB.";

                                }

                                ?>

                            </p>

                        </div>

                    <?php } ?>


                    <!-- =================================
                         CETAK BUKTI PENDAFTARAN
                    ================================== -->

                    <div class="cetak-area">

                        <a
                            href="cetak_pendaftaran.php?id=<?php echo intval($data['id_pendaftaran']); ?>"
                            target="_blank"
                            class="btn-cetak">

                            <span class="glyphicon glyphicon-print"></span>

                            Cetak Bukti Pendaftaran

                        </a>

                    </div>


                </div>


            <?php } ?>


        </div>

    </div>

</div>


<?php include "footer.php"; ?>


<script src="../bootstrap/js/jquery.min.js"></script>

<script src="../bootstrap/js/bootstrap.min.js"></script>


</body>

</html>