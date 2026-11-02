<?php

session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

include "../koneksi.php";

$query = mysqli_query(
    $koneksi,
    "SELECT * FROM sambutan
     ORDER BY id_sambutan DESC"
);

if (!$query) {
    die("Query error: " . mysqli_error($koneksi));
}

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1">

    <title>Data Sambutan Kepala Madrasah</title>

    <link href="../bootstrap/css/bootstrap.min.css"
          rel="stylesheet">

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

        body {
            margin: 0;
            padding: 0;
            background: #f4f6f8;
            font-family: Arial, Helvetica, sans-serif;
            color: #333;
        }


        /* =====================================================
           KONTEN ADMIN
        ===================================================== */

        .main-content {
            margin-left: 250px;
            padding: 30px;
            min-height: 100vh;
        }


        /* =====================================================
           HEADER
        ===================================================== */

        .page-header-sambutan {
            background: #ffffff;
            border-radius: 10px;
            padding: 22px 25px;
            margin-bottom: 20px;

            box-shadow:
                0 2px 10px rgba(0,0,0,0.06);
        }


        .page-header-sambutan h2 {
            margin: 0;
            color: #2e7d32;
            font-size: 25px;
            font-weight: bold;
        }


        .page-header-sambutan p {
            margin: 7px 0 0;
            color: #777;
            font-size: 14px;
        }


        /* =====================================================
           TOMBOL TAMBAH
        ===================================================== */

        .btn-tambah {
            margin-top: 3px;
            padding: 9px 15px;
            border-radius: 5px;
            font-weight: bold;
        }


        /* =====================================================
           CARD
        ===================================================== */

        .sambutan-card {
            background: #ffffff;
            border-radius: 10px;

            box-shadow:
                0 2px 10px rgba(0,0,0,0.06);

            overflow: hidden;
        }


        /* =====================================================
           AREA TABEL
        ===================================================== */

        .table-area {
            padding: 20px 25px 25px;
        }


        /* =====================================================
           TABLE RESPONSIVE
        ===================================================== */

        .table-responsive {
            width: 100%;
            overflow-x: auto;
            overflow-y: hidden;

            border: 0;
            margin: 0;

            -webkit-overflow-scrolling: touch;
        }


        /*
           Lebar minimum tabel.

           Jika layar HP terlalu kecil,
           tabel tidak dipaksa mengecil.

           HP dapat menggeser tabel
           ke kiri dan kanan.
        */

        .table-sambutan {
            min-width: 1050px;
            margin-bottom: 0;
        }


        /* =====================================================
           HEADER TABLE
        ===================================================== */

        .table-sambutan thead th {
            background: #2e7d32;
            color: #ffffff;

            text-align: center;
            vertical-align: middle !important;

            border-color: #256628 !important;

            font-size: 13px;
            font-weight: bold;

            white-space: nowrap;

            padding: 11px 8px;
        }


        /* =====================================================
           ISI TABLE
        ===================================================== */

        .table-sambutan tbody td {
            vertical-align: middle !important;

            padding: 10px 8px;

            font-size: 13px;

            border-color: #e2e8e4 !important;
        }


        .table-sambutan tbody tr:hover {
            background: #f5faf6;
        }


        /* =====================================================
           FOTO
        ===================================================== */

        .foto-admin {
            width: 80px;
            height: 80px;

            object-fit: cover;

            border-radius: 6px;

            border: 1px solid #ddd;

            display: block;

            margin: auto;
        }


        /* =====================================================
           NAMA
        ===================================================== */

        .nama-kepala {
            min-width: 160px;

            font-weight: bold;

            color: #333;

            line-height: 1.5;

            white-space: normal;

            word-break: break-word;

            overflow-wrap: anywhere;
        }


        /* =====================================================
           JABATAN
        ===================================================== */

        .jabatan {
            min-width: 140px;

            white-space: normal;

            word-break: break-word;

            overflow-wrap: anywhere;

            line-height: 1.5;
        }


        /* =====================================================
           ISI SAMBUTAN
        ===================================================== */

        .isi-sambutan {
            width: 350px;
            max-width: 350px;

            line-height: 1.6;

            color: #555;

            text-align: justify;

            white-space: normal;

            word-wrap: break-word;

            overflow-wrap: anywhere;

            word-break: break-word;
        }


        /*
           Supaya isi yang sangat panjang
           tetap berada di dalam kolom.
        */

        .isi-sambutan p {
            margin: 0;
        }


        /* =====================================================
           STATUS
        ===================================================== */

        .status {
            text-align: center;

            white-space: nowrap;
        }


        /* =====================================================
           AKSI
        ===================================================== */

        .aksi {
            text-align: center;

            white-space: nowrap;

            min-width: 155px;
        }


        .aksi .btn {
            margin: 2px;

            border-radius: 4px;
        }


        /* =====================================================
           DATA KOSONG
        ===================================================== */

        .data-kosong {
            text-align: center;

            padding: 50px 20px !important;

            color: #888;
        }


        .data-kosong .glyphicon {
            display: block;

            font-size: 38px;

            color: #bbb;

            margin-bottom: 12px;
        }


        /* =====================================================
           TABLET
        ===================================================== */

        @media (max-width: 991px) {

            .main-content {
                margin-left: 230px;

                padding: 20px;
            }


            .page-header-sambutan h2 {
                font-size: 22px;
            }


            .table-area {
                padding: 15px;
            }


            .table-sambutan {
                min-width: 1050px;
            }

        }


        /* =====================================================
           HP
        ===================================================== */

        @media (max-width: 767px) {

            .main-content {

                margin-left: 0;

                padding: 15px;

                /*
                   Sesuaikan jika navbar admin
                   memiliki tinggi berbeda.
                */

                padding-top: 75px;
            }


            .page-header-sambutan {

                padding: 18px;

                border-radius: 8px;

            }


            .page-header-sambutan h2 {

                font-size: 20px;

                text-align: center;

                line-height: 1.4;

            }


            .page-header-sambutan p {

                font-size: 12px;

                line-height: 1.5;

                text-align: center;

            }


            .btn-tambah {

                display: block;

                width: 100%;

                margin-top: 15px;

            }


            .sambutan-card {

                border-radius: 8px;

            }


            .table-area {

                padding: 15px;

            }


            /*
               Tabel tetap memiliki lebar
               sehingga tidak menimpa isi.

               Geser kiri/kanan pada HP.
            */

            .table-sambutan {

                min-width: 1000px;

                font-size: 12px;

            }


            .table-sambutan thead th {

                font-size: 12px;

                padding: 9px 7px;

            }


            .table-sambutan tbody td {

                font-size: 12px;

                padding: 9px 7px;

            }


            .foto-admin {

                width: 70px;

                height: 70px;

            }


            .isi-sambutan {

                width: 320px;

                max-width: 320px;

                line-height: 1.5;

            }

        }


        /* =====================================================
           HP KECIL
        ===================================================== */

        @media (max-width: 480px) {

            .main-content {

                padding-left: 10px;

                padding-right: 10px;

                padding-top: 70px;

            }


            .page-header-sambutan {

                padding: 15px;

            }


            .page-header-sambutan h2 {

                font-size: 18px;

            }


            .page-header-sambutan p {

                font-size: 11px;

            }


            .table-area {

                padding: 10px;

            }


            .table-sambutan {

                min-width: 1000px;

            }


            .isi-sambutan {

                width: 300px;

                max-width: 300px;

            }

        }

    </style>

</head>


<body>


<?php include "navbar_admin.php"; ?>


<!-- =====================================================
     KONTEN UTAMA
===================================================== -->

<div class="main-content">


    <!-- =================================================
         HEADER
    ================================================== -->

    <div class="page-header-sambutan">

        <div class="row">

            <div class="col-sm-8">

                <h2>

                    <span class="glyphicon glyphicon-user"></span>

                    Data Sambutan Kepala Madrasah

                </h2>

                <p>

                    Kelola sambutan Kepala Madrasah
                    MTs Nurul Huda Pematang Cengal

                </p>

            </div>


            <div class="col-sm-4 text-right">

                <a
                    href="tambah_sambutan.php"
                    class="btn btn-success btn-tambah">

                    <span
                        class="glyphicon glyphicon-plus">
                    </span>

                    Tambah Sambutan

                </a>

            </div>

        </div>

    </div>


    <!-- =================================================
         CARD
    ================================================== -->

    <div class="sambutan-card">


        <!-- =================================================
             TABEL
        ================================================== -->

        <div class="table-area">

            <div class="table-responsive">

                <table
                    class="table table-bordered table-hover table-sambutan">

                    <thead>

                        <tr>

                            <th width="50">
                                No
                            </th>

                            <th width="110">
                                Foto
                            </th>

                            <th width="170">
                                Nama Kepala
                            </th>

                            <th width="150">
                                Jabatan
                            </th>

                            <th width="370">
                                Isi Sambutan
                            </th>

                            <th width="110">
                                Status
                            </th>

                            <th width="160">
                                Aksi
                            </th>

                        </tr>

                    </thead>


                    <tbody>


                    <?php

                    $no = 1;

                    if (mysqli_num_rows($query) > 0) {

                        while (
                            $data =
                            mysqli_fetch_assoc($query)
                        ) {

                    ?>

                        <tr>


                            <!-- =========================
                                 NO
                            ========================== -->

                            <td class="text-center">

                                <?php

                                echo $no++;

                                ?>

                            </td>


                            <!-- =========================
                                 FOTO
                            ========================== -->

                            <td class="text-center">

                                <?php

                                if (!empty($data['foto'])) {

                                ?>

                                    <img
                                        src="../images/<?php
                                            echo htmlspecialchars(
                                                $data['foto']
                                            );
                                        ?>"
                                        class="foto-admin"
                                        alt="Foto Kepala Madrasah">

                                <?php

                                } else {

                                ?>

                                    <span class="text-muted">

                                        Tidak ada foto

                                    </span>

                                <?php

                                }

                                ?>

                            </td>


                            <!-- =========================
                                 NAMA
                            ========================== -->

                            <td class="nama-kepala">

                                <?php

                                echo htmlspecialchars(
                                    $data['nama_kepala']
                                );

                                ?>

                            </td>


                            <!-- =========================
                                 JABATAN
                            ========================== -->

                            <td class="jabatan">

                                <?php

                                if (!empty($data['jabatan'])) {

                                    echo htmlspecialchars(
                                        $data['jabatan']
                                    );

                                } else {

                                    echo "-";

                                }

                                ?>

                            </td>


                            <!-- =========================
                                 ISI SAMBUTAN
                            ========================== -->

                            <td>

                                <div class="isi-sambutan">

                                    <?php

                                    $isi = strip_tags(
                                        $data['isi_sambutan']
                                    );

                                    echo nl2br(
                                        htmlspecialchars($isi)
                                    );

                                    ?>

                                </div>

                            </td>


                            <!-- =========================
                                 STATUS
                            ========================== -->

                            <td class="status">

                                <?php

                                if (
                                    $data['status'] == 'Aktif'
                                ) {

                                ?>

                                    <span
                                        class="label label-success">

                                        Aktif

                                    </span>

                                <?php

                                } else {

                                ?>

                                    <span
                                        class="label label-default">

                                        Tidak Aktif

                                    </span>

                                <?php

                                }

                                ?>

                            </td>


                            <!-- =========================
                                 AKSI
                            ========================== -->

                            <td class="aksi">

                                <a
                                    href="edit_sambutan.php?id=<?php
                                        echo $data['id_sambutan'];
                                    ?>"
                                    class="btn btn-warning btn-sm"
                                    title="Edit Sambutan">

                                    <span
                                        class="glyphicon glyphicon-edit">
                                    </span>

                                    Edit

                                </a>


                                <a
                                    href="hapus_sambutan.php?id=<?php
                                        echo $data['id_sambutan'];
                                    ?>"
                                    class="btn btn-danger btn-sm"
                                    title="Hapus Sambutan"
                                    onclick="return confirm(
                                        'Yakin ingin menghapus data sambutan ini?'
                                    );">

                                    <span
                                        class="glyphicon glyphicon-trash">
                                    </span>

                                    Hapus

                                </a>

                            </td>


                        </tr>


                    <?php

                        }

                    } else {

                    ?>

                        <tr>

                            <td
                                colspan="7"
                                class="data-kosong">

                                <span
                                    class="glyphicon glyphicon-user">
                                </span>

                                <strong>
                                    Data sambutan tidak ditemukan
                                </strong>

                                <br>

                                <small>
                                    Belum ada sambutan Kepala Madrasah.
                                </small>

                            </td>

                        </tr>

                    <?php

                    }

                    ?>


                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>


<script
    src="../bootstrap/js/jquery.min.js">
</script>

<script
    src="../bootstrap/js/bootstrap.min.js">
</script>


</body>

</html>