<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

include "../koneksi.php";
include "navbar_admin.php";

/* =====================================================
   PENCARIAN BERITA
===================================================== */

if (isset($_GET['cari']) && $_GET['cari'] != '') {

    $cari = mysqli_real_escape_string(
        $koneksi,
        $_GET['cari']
    );

    $query = mysqli_query(
        $koneksi,
        "SELECT * FROM berita
         WHERE judul LIKE '%$cari%'
         OR isi LIKE '%$cari%'
         ORDER BY tanggal DESC"
    );

} else {

    $query = mysqli_query(
        $koneksi,
        "SELECT * FROM berita
         ORDER BY tanggal DESC"
    );
}
?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="utf-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1">

    <title>Data Berita - Admin MTs Nurul Huda</title>

    <link
        href="../bootstrap/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <style>

        /* =====================================================
           DASAR
        ===================================================== */

        html,
        body {
            margin: 0;
            padding: 0 !important;
            background: #f5f7f6;
            color: #17251c;
            width: 100%;
            max-width: 100%;
        }

        * {
            box-sizing: border-box;
        }


        /* =====================================================
           AREA UTAMA
        ===================================================== */

        .berita-page {
            margin-left: 250px;
            width: calc(100% - 250px);
            min-height: 100vh;
            padding: 30px;
        }


        .berita-wrapper {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
        }


        /* =====================================================
           HEADER
        ===================================================== */

        .berita-header {
            background: #ffffff;
            border: 1px solid #e5ebe7;
            border-radius: 15px;
            padding: 24px 28px;
            margin-bottom: 20px;

            box-shadow:
                0 4px 16px rgba(23,37,28,0.05);
        }


        .berita-header-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
        }


        .berita-title-area {
            display: flex;
            align-items: center;
            gap: 15px;
            min-width: 0;
        }


        .berita-icon {
            width: 52px;
            height: 52px;
            min-width: 52px;

            border-radius: 12px;

            background: rgba(26,107,60,0.10);
            color: #1a6b3c;

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 22px;
        }


        .berita-title-area h2 {
            margin: 0;
            color: #17251c;
            font-size: 24px;
            font-weight: 700;
        }


        .berita-title-area p {
            margin: 6px 0 0;
            color: #71857a;
            font-size: 13px;
        }


        /* =====================================================
           TOMBOL TAMBAH
        ===================================================== */

        .btn-tambah-berita {
            background: #1a6b3c;
            border-color: #1a6b3c;

            border-radius: 9px;

            padding: 11px 17px;

            font-size: 13px;
            font-weight: 600;

            white-space: nowrap;

            transition: all .2s ease;
        }


        .btn-tambah-berita:hover {
            background: #0f4a29;
            border-color: #0f4a29;
        }


        /* =====================================================
           CARD
        ===================================================== */

        .berita-card {
            background: #ffffff;

            border: 1px solid #e5ebe7;

            border-radius: 15px;

            box-shadow:
                0 4px 16px rgba(23,37,28,0.05);

            /*
             * Jangan menggunakan overflow:hidden di sini.
             * Supaya tabel bisa digeser horizontal di HP.
             */
            overflow: visible;
        }


        /* =====================================================
           CARD HEADER
        ===================================================== */

        .berita-card-header {
            padding: 18px 22px;

            border-bottom: 1px solid #e8edea;

            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 15px;
        }


        .data-title {
            font-size: 15px;
            font-weight: 700;
            color: #17251c;
        }


        .data-title .glyphicon {
            color: #1a6b3c;
            margin-right: 7px;
        }


        .data-info {
            color: #71857a;
            font-size: 12px;
        }


        /* =====================================================
           SEARCH
        ===================================================== */

        .search-area {
            padding: 18px 22px;

            background: #fbfcfb;

            border-bottom: 1px solid #e8edea;
        }


        .search-form {
            display: flex;

            align-items: center;

            gap: 8px;

            width: 100%;
            max-width: 700px;
        }


        .search-input {
            flex: 1;
            position: relative;
            min-width: 0;
        }


        .search-input .form-control {
            height: 42px;

            width: 100%;

            border-radius: 9px;

            border: 1px solid #d8e1dc;

            box-shadow: none;

            padding-left: 40px;

            font-size: 13px;
        }


        .search-input .form-control:focus {
            border-color: #1a6b3c;

            box-shadow:
                0 0 0 2px rgba(26,107,60,.08);
        }


        .search-icon {
            position: absolute;

            left: 14px;
            top: 13px;

            color: #8a9991;

            z-index: 2;
        }


        .btn-cari {
            height: 42px;

            border-radius: 9px;

            padding: 0 17px;

            background: #1a6b3c;
            border-color: #1a6b3c;

            font-size: 13px;

            font-weight: 600;

            white-space: nowrap;
        }


        .btn-reset {
            height: 42px;

            border-radius: 9px;

            padding: 0 15px;

            font-size: 13px;

            white-space: nowrap;
        }


        /* =====================================================
           AREA TABEL
        ===================================================== */

        .table-area {
            padding: 0 22px 22px;

            width: 100%;
        }


        /*
         * INI BAGIAN PALING PENTING UNTUK HP.
         * Tabel akan bisa digeser kiri-kanan.
         */

        .table-responsive {
            display: block;

            width: 100%;

            max-width: 100%;

            overflow-x: auto !important;
            overflow-y: hidden;

            -webkit-overflow-scrolling: touch;

            margin-top: 20px;

            border: 1px solid #e3e9e5;

            border-radius: 10px;

            /*
             * Supaya scrollbar tetap muncul
             */
            scrollbar-width: thin;
        }


        /* Scrollbar Chrome / Edge */

        .table-responsive::-webkit-scrollbar {
            height: 10px;
        }


        .table-responsive::-webkit-scrollbar-track {
            background: #edf2ef;
            border-radius: 10px;
        }


        .table-responsive::-webkit-scrollbar-thumb {
            background: #aebeb5;
            border-radius: 10px;
        }


        .table-responsive::-webkit-scrollbar-thumb:hover {
            background: #7e9588;
        }


        /* =====================================================
           TABEL
        ===================================================== */

        .table-berita {
            width: 100%;

            /*
             * Lebar minimum membuat tabel tidak dipaksa
             * mengecil sampai tulisan bertumpuk.
             */
            min-width: 950px;

            margin: 0;

            border: 0;

            table-layout: fixed;
        }


        /* =====================================================
           HEADER TABEL
        ===================================================== */

        .table-berita thead th {
            background: #f0f6f2;

            color: #315340;

            border-color: #e0e8e3 !important;

            padding: 13px 12px;

            font-size: 12px;

            font-weight: 700;

            text-transform: uppercase;

            letter-spacing: .3px;

            text-align: center;

            vertical-align: middle;

            white-space: nowrap;
        }


        /* =====================================================
           ISI TABEL
        ===================================================== */

        .table-berita tbody td {
            padding: 13px 12px;

            border-color: #e7ece9 !important;

            color: #405048;

            font-size: 12.5px;

            vertical-align: middle !important;

            /*
             * Mencegah tulisan keluar dari kolom
             */
            overflow-wrap: break-word;
            word-wrap: break-word;

            word-break: normal;
        }


        .table-berita tbody tr {
            transition: background .15s ease;
        }


        .table-berita tbody tr:hover {
            background: #f8fbf9;
        }


        /* =====================================================
           LEBAR MASING-MASING KOLOM
        ===================================================== */

        .kolom-no {
            width: 55px;
        }


        .kolom-gambar {
            width: 125px;
        }


        .kolom-judul {
            width: 230px;
        }


        .kolom-isi {
            width: 370px;
        }


        .kolom-tanggal {
            width: 120px;
        }


        .kolom-aksi {
            width: 155px;
        }


        /* =====================================================
           NOMOR
        ===================================================== */

        .nomor {
            width: 55px;

            text-align: center;

            font-weight: 600;

            color: #71857a;

            white-space: nowrap;
        }


        /* =====================================================
           GAMBAR
        ===================================================== */

        .gambar-cell {
            width: 125px;

            text-align: center;
        }


        .gambar-berita {
            width: 90px;

            height: 62px;

            object-fit: cover;

            border-radius: 8px;

            border: 1px solid #dfe7e2;

            padding: 2px;

            background: #ffffff;
        }


        .no-gambar {
            display: inline-block;

            width: 90px;

            padding: 19px 5px;

            border-radius: 8px;

            background: #f2f5f3;

            color: #8a9991;

            font-size: 10px;
        }


        /* =====================================================
           JUDUL
        ===================================================== */

        .judul-cell {
            width: 230px;

            max-width: 230px;

            white-space: normal !important;

            overflow-wrap: break-word;

            word-break: break-word;
        }


        .judul-cell strong {
            display: block;

            color: #17251c;

            font-size: 13px;

            line-height: 1.5;

            /*
             * Judul tidak boleh keluar tabel
             */
            white-space: normal;

            overflow-wrap: break-word;

            word-break: break-word;
        }


        /* =====================================================
           ISI BERITA
        ===================================================== */

        .isi-berita {
            width: 370px;

            max-width: 370px;

            color: #718078 !important;

            line-height: 1.6;

            /*
             * INI YANG MEMPERBAIKI TEKS KELUAR TABEL
             */
            white-space: normal !important;

            overflow-wrap: break-word !important;

            word-wrap: break-word !important;

            word-break: break-word !important;

            /*
             * Jangan sampai isi melebar keluar
             */
            overflow: hidden;
        }


        /* =====================================================
           TANGGAL
        ===================================================== */

        .tanggal-cell {
            width: 120px;

            text-align: center;

            white-space: nowrap;
        }


        /* =====================================================
           AKSI
        ===================================================== */

        .aksi {
            width: 155px;

            text-align: center;

            white-space: nowrap;
        }


        .aksi .btn {
            border-radius: 7px;

            font-size: 11px;

            padding: 6px 9px;

            margin: 2px;
        }


        .aksi .btn-warning {
            background: #c9974a;

            border-color: #c9974a;

            color: #ffffff;
        }


        .aksi .btn-warning:hover {
            background: #ae7f3b;

            border-color: #ae7f3b;
        }


        /* =====================================================
           DATA KOSONG
        ===================================================== */

        .empty-data {
            padding: 45px 20px !important;

            color: #71857a !important;

            text-align: center;
        }


        .empty-data .glyphicon {
            display: block;

            font-size: 28px;

            margin-bottom: 10px;

            color: #aab7b0;
        }


        /* =====================================================
           TABLET
        ===================================================== */

        @media (max-width: 991px) {

            .berita-page {
                margin-left: 220px;

                width: calc(100% - 220px);

                padding: 20px;
            }


            .berita-header {
                padding: 20px;
            }


            .berita-title-area h2 {
                font-size: 21px;
            }

        }


        /* =====================================================
           MOBILE
        ===================================================== */

        @media (max-width: 767px) {

            html,
            body {
                width: 100%;
                max-width: 100%;
                overflow-x: hidden;
            }


            .berita-page {

                margin-left: 0;

                width: 100%;

                max-width: 100%;

                padding: 70px 12px 25px;
            }


            .berita-wrapper {

                width: 100%;

                max-width: 100%;
            }


            /* HEADER */

            .berita-header {

                width: 100%;

                padding: 18px;

                border-radius: 12px;
            }


            .berita-header-inner {

                flex-direction: column;

                align-items: stretch;

                width: 100%;
            }


            .berita-title-area {

                align-items: flex-start;

                width: 100%;
            }


            .berita-icon {

                width: 45px;

                height: 45px;

                min-width: 45px;

                font-size: 19px;
            }


            .berita-title-area h2 {

                font-size: 19px;

                line-height: 1.3;
            }


            .berita-title-area p {

                font-size: 11.5px;

                line-height: 1.5;
            }


            .btn-tambah-berita {

                width: 100%;

                text-align: center;
            }


            /* CARD */

            .berita-card {

                width: 100%;

                max-width: 100%;

                border-radius: 12px;
            }


            .berita-card-header {

                padding: 15px;

                display: block;

                width: 100%;
            }


            .data-info {

                display: block;

                margin-top: 5px;

                line-height: 1.5;
            }


            /* SEARCH */

            .search-area {

                padding: 15px;

                width: 100%;
            }


            .search-form {

                display: block;

                width: 100%;

                max-width: none;
            }


            .search-input {

                width: 100%;

                margin-bottom: 8px;
            }


            .search-input .form-control {

                width: 100%;

                height: 42px;
            }


            .btn-cari,
            .btn-reset {

                width: 100%;

                margin-bottom: 8px;

                height: 42px;
            }


            /* TABLE AREA */

            .table-area {

                width: 100%;

                padding: 0 10px 15px;
            }


            /*
             * Scroll horizontal khusus HP
             */

            .table-responsive {

                width: 100%;

                max-width: 100%;

                overflow-x: scroll !important;

                overflow-y: hidden;

                margin-top: 15px;

                border-radius: 9px;
            }


            /*
             * Tabel sengaja dibuat lebar.
             * Pengguna tinggal geser ke kiri/kanan.
             */

            .table-berita {

                min-width: 950px;

                width: 950px;

                table-layout: fixed;
            }


            .table-berita thead th {

                font-size: 11px;

                padding: 11px 10px;
            }


            .table-berita tbody td {

                font-size: 12px;

                padding: 12px 10px;

                vertical-align: top !important;
            }


            .kolom-no {
                width: 50px;
            }


            .kolom-gambar {
                width: 115px;
            }


            .kolom-judul {
                width: 210px;
            }


            .kolom-isi {
                width: 350px;
            }


            .kolom-tanggal {
                width: 115px;
            }


            .kolom-aksi {
                width: 150px;
            }


            .judul-cell {

                width: 210px;

                max-width: 210px;

                white-space: normal !important;

                overflow-wrap: anywhere !important;

                word-break: break-word !important;
            }


            .judul-cell strong {

                white-space: normal !important;

                overflow-wrap: anywhere !important;

                word-break: break-word !important;

                line-height: 1.5;
            }


            .isi-berita {

                width: 350px;

                max-width: 350px;

                white-space: normal !important;

                overflow-wrap: anywhere !important;

                word-break: break-word !important;

                line-height: 1.6;

                overflow: hidden;
            }


            .tanggal-cell {

                width: 115px;

                white-space: nowrap;
            }


            .aksi {

                width: 150px;

                white-space: nowrap;
            }

        }


        /* =====================================================
           HP KECIL
        ===================================================== */

        @media (max-width: 480px) {

            .berita-page {

                padding: 65px 8px 20px;
            }


            .berita-header {

                padding: 15px;
            }


            .berita-title-area h2 {

                font-size: 18px;
            }


            .berita-title-area p {

                font-size: 11px;
            }


            .berita-card-header {

                padding: 14px;
            }


            .search-area {

                padding: 12px;
            }


            .table-area {

                padding: 0 8px 10px;
            }


            .table-responsive {

                margin-top: 12px;

                /*
                 * Scrollbar lebih mudah disentuh
                 */
                padding-bottom: 2px;
            }


            .table-berita {

                min-width: 950px;

                width: 950px;
            }

        }

    </style>

</head>


<body>


<!-- =====================================================
     AREA HALAMAN BERITA
===================================================== -->

<div class="berita-page">

    <div class="berita-wrapper">


        <!-- =================================================
             HEADER
        ================================================== -->

        <div class="berita-header">

            <div class="berita-header-inner">


                <div class="berita-title-area">

                    <div class="berita-icon">

                        <span class="glyphicon glyphicon-list-alt"></span>

                    </div>


                    <div>

                        <h2>
                            Data Berita
                        </h2>

                        <p>
                            Kelola berita dan informasi
                            MTs Nurul Huda Pematang Cengal
                        </p>

                    </div>

                </div>


                <div>

                    <a
                        href="tambah_berita.php"
                        class="btn btn-success btn-tambah-berita"
                    >

                        <span class="glyphicon glyphicon-plus"></span>

                        &nbsp; Tambah Berita

                    </a>

                </div>


            </div>

        </div>


        <!-- =================================================
             CARD DATA
        ================================================== -->

        <div class="berita-card">


            <!-- CARD HEADER -->

            <div class="berita-card-header">

                <div class="data-title">

                    <span class="glyphicon glyphicon-list-alt"></span>

                    Daftar Berita

                </div>


                <div class="data-info">

                    Data berita terbaru ditampilkan terlebih dahulu

                </div>

            </div>


            <!-- =================================================
                 SEARCH
            ================================================== -->

            <div class="search-area">

                <form
                    method="GET"
                    class="search-form"
                >


                    <div class="search-input">

                        <span
                            class="glyphicon glyphicon-search search-icon">
                        </span>


                        <input
                            type="text"
                            name="cari"
                            class="form-control"
                            placeholder="Cari judul atau isi berita..."
                            value="<?php

                            if (isset($_GET['cari'])) {

                                echo htmlspecialchars(
                                    $_GET['cari']
                                );

                            }

                            ?>"
                        >

                    </div>


                    <button
                        type="submit"
                        class="btn btn-success btn-cari"
                    >

                        <span
                            class="glyphicon glyphicon-search">
                        </span>

                        Cari

                    </button>


                    <a
                        href="berita_admin.php"
                        class="btn btn-default btn-reset"
                    >

                        <span
                            class="glyphicon glyphicon-refresh">
                        </span>

                        Reset

                    </a>


                </form>

            </div>


            <!-- =================================================
                 TABEL
            ================================================== -->

            <div class="table-area">

                <div class="table-responsive">

                    <table
                        id="tabelData"
                        class="table table-bordered table-striped table-berita"
                    >


                        <thead>

                            <tr>

                                <th class="kolom-no">
                                    No
                                </th>

                                <th class="kolom-gambar">
                                    Gambar
                                </th>

                                <th class="kolom-judul">
                                    Judul
                                </th>

                                <th class="kolom-isi">
                                    Isi Berita
                                </th>

                                <th class="kolom-tanggal">
                                    Tanggal
                                </th>

                                <th class="kolom-aksi">
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


                                <!-- NO -->

                                <td class="nomor">

                                    <?php
                                    echo $no++;
                                    ?>

                                </td>


                                <!-- GAMBAR -->

                                <td class="gambar-cell">

                                    <?php

                                    if (
                                        !empty(
                                            $data['gambar']
                                        )
                                    ) {

                                    ?>

                                        <img
                                            src="../images/<?php
                                            echo htmlspecialchars(
                                                $data['gambar']
                                            );
                                            ?>"
                                            alt="Gambar Berita"
                                            class="gambar-berita"
                                        >

                                    <?php

                                    } else {

                                    ?>

                                        <span
                                            class="no-gambar"
                                        >

                                            Tidak ada gambar

                                        </span>

                                    <?php

                                    }

                                    ?>

                                </td>


                                <!-- JUDUL -->

                                <td class="judul-cell">

                                    <strong>

                                        <?php

                                        echo htmlspecialchars(
                                            $data['judul']
                                        );

                                        ?>

                                    </strong>

                                </td>


                                <!-- ISI BERITA -->

                                <td class="isi-berita">

                                    <?php

                                    $isi = strip_tags(
                                        $data['isi']
                                    );


                                    /*
                                     * Membatasi isi berita
                                     * agar tabel tetap rapi.
                                     */

                                    if (strlen($isi) > 180) {

                                        echo htmlspecialchars(
                                            substr(
                                                $isi,
                                                0,
                                                180
                                            )
                                        );

                                        echo "...";

                                    } else {

                                        echo htmlspecialchars(
                                            $isi
                                        );

                                    }

                                    ?>

                                </td>


                                <!-- TANGGAL -->

                                <td class="tanggal-cell">

                                    <span
                                        class="glyphicon glyphicon-calendar">
                                    </span>

                                    &nbsp;

                                    <?php

                                    echo date(
                                        'd-m-Y',
                                        strtotime(
                                            $data['tanggal']
                                        )
                                    );

                                    ?>

                                </td>


                                <!-- AKSI -->

                                <td class="aksi">


                                    <a
                                        href="edit_berita.php?id=<?php
                                        echo $data['id_berita'];
                                        ?>"
                                        class="btn btn-warning btn-sm"
                                    >

                                        <span
                                            class="glyphicon glyphicon-edit">
                                        </span>

                                        Edit

                                    </a>


                                    <a
                                        href="hapus_berita_admin.php?id=<?php
                                        echo $data['id_berita'];
                                        ?>"
                                        class="btn btn-danger btn-sm"

                                        onclick="return confirm(
                                            'Yakin ingin menghapus berita ini?'
                                        )"
                                    >

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
                                    colspan="6"
                                    class="empty-data"
                                >

                                    <span
                                        class="glyphicon glyphicon-info-sign">
                                    </span>

                                    Data berita tidak ditemukan.

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

</div>


<script
    src="../bootstrap/js/jquery.min.js">
</script>

<script
    src="../bootstrap/js/bootstrap.min.js">
</script>


</body>

</html>