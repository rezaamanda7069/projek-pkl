<?php

include "../koneksi.php";

/* =========================================
   CEK ID PENDAFTARAN
========================================= */

if (
    !isset($_GET['id']) ||
    trim($_GET['id']) == ''
) {
    die("ID pendaftaran tidak ditemukan.");
}

$id = intval($_GET['id']);

/* =========================================
   AMBIL DATA PENDAFTARAN
========================================= */

$query = mysqli_query(
    $koneksi,
    "SELECT *
     FROM pendaftaran
     WHERE id_pendaftaran = '$id'
     LIMIT 1"
);

if (!$query) {
    die(
        "Terjadi kesalahan database: " .
        mysqli_error($koneksi)
    );
}

if (mysqli_num_rows($query) == 0) {
    die("Data pendaftaran tidak ditemukan.");
}

$data = mysqli_fetch_assoc($query);

/* =========================================
   FUNGSI ESCAPE
========================================= */

function e($value)
{
    return htmlspecialchars(
        $value ?? '',
        ENT_QUOTES,
        'UTF-8'
    );
}

/* =========================================
   STATUS
========================================= */

$status = $data['status'] ?? 'Menunggu';

if ($status == "Menunggu") {

    $status_class = "menunggu";

} elseif ($status == "Diverifikasi") {

    $status_class = "diverifikasi";

} elseif ($status == "Diterima") {

    $status_class = "diterima";

} elseif ($status == "Ditolak") {

    $status_class = "ditolak";

} else {

    $status_class = "default";

}

/* =========================================
   FORMAT TANGGAL PENDAFTARAN
========================================= */

$tanggal_pendaftaran = "-";

if (
    isset($data['tanggal_daftar']) &&
    !empty($data['tanggal_daftar'])
) {

    $timestamp = strtotime($data['tanggal_daftar']);

    $nama_bulan = array(
        1  => 'Januari',
        2  => 'Februari',
        3  => 'Maret',
        4  => 'April',
        5  => 'Mei',
        6  => 'Juni',
        7  => 'Juli',
        8  => 'Agustus',
        9  => 'September',
        10 => 'Oktober',
        11 => 'November',
        12 => 'Desember'
    );

    $tanggal_pendaftaran =
        date('d', $timestamp) . ' ' .
        $nama_bulan[(int)date('m', $timestamp)] . ' ' .
        date('Y', $timestamp);
}

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="utf-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1">

    <title>
        Bukti Pendaftaran PPDB -
        <?php echo e($data['no_pendaftaran']); ?>
    </title>

    <style>

        /* =====================================
           RESET
        ===================================== */

        * {
            box-sizing: border-box;
        }

        html,
        body {
            margin: 0;
            padding: 0;
        }

        body {
            background: #eeeeee;
            font-family: Arial, Helvetica, sans-serif;
            color: #222;
            font-size: 11px;
        }


        /* =====================================
           KERTAS A4
        ===================================== */

        .paper {
            width: 210mm;
            height: 297mm;
            margin: 10px auto;
            padding: 9mm;

            background: #ffffff;

            box-shadow:
                0 0 8px
                rgba(0, 0, 0, 0.15);

            overflow: hidden;
        }


        /* =====================================
           HEADER
        ===================================== */

        .header {
            text-align: center;

            border-bottom: 2px solid #2e7d32;

            padding-bottom: 6px;
            margin-bottom: 8px;
        }

        .header h1 {
            margin: 0;
            font-size: 19px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .header h2 {
            margin: 2px 0;
            font-size: 14px;
        }

        .header p {
            margin: 2px 0;
            font-size: 10px;
        }


        /* =====================================
           JUDUL
        ===================================== */

        .title {
            text-align: center;
            margin-bottom: 8px;
        }

        .title h3 {
            margin: 0 0 3px;
            font-size: 14px;
            text-transform: uppercase;
        }

        .title p {
            margin: 0;
            font-size: 9px;
            color: #555;
        }


        /* =====================================
           NOMOR PENDAFTARAN
        ===================================== */

        .nomor {
            border: 1px solid #cccccc;

            padding: 6px;

            text-align: center;

            margin-bottom: 8px;

            background: #f8f8f8;
        }

        .nomor strong {
            display: block;

            font-size: 8px;

            margin-bottom: 2px;

            color: #666;
        }

        .nomor span {
            font-size: 15px;

            font-weight: bold;

            color: #2e7d32;
        }


        /* =====================================
           SECTION
        ===================================== */

        .section {
            margin-bottom: 8px;

            page-break-inside: avoid;
            break-inside: avoid;
        }

        .section-title {
            background: #2e7d32;

            color: #ffffff;

            padding: 5px 7px;

            font-size: 10px;

            font-weight: bold;

            text-transform: uppercase;
        }


        /* =====================================
           TABLE
        ===================================== */

        table {
            width: 100%;

            border-collapse: collapse;

            table-layout: fixed;
        }

        td {
            border: 1px solid #d9d9d9;

            padding: 4px 6px;

            vertical-align: middle;

            line-height: 1.2;

            word-wrap: break-word;

            overflow-wrap: break-word;
        }

        td.label {
            width: 27%;

            background: #f7f7f7;

            font-weight: bold;
        }

        td.foto-cell {
            width: 20%;

            text-align: center;

            vertical-align: middle;

            padding: 5px;

            background: #ffffff;
        }


        /* =====================================
           FOTO
        ===================================== */

        .foto {
            width: 65px;

            height: 85px;

            object-fit: cover;

            border: 1px solid #999;

            padding: 1px;

            background: #ffffff;

            display: block;

            margin: 0 auto 3px auto;
        }

        .foto-keterangan {
            font-size: 8px;

            color: #666;

            text-align: center;
        }

        .tidak-ada-foto {
            width: 65px;

            height: 85px;

            border: 1px solid #aaa;

            display: flex;

            align-items: center;

            justify-content: center;

            text-align: center;

            margin: auto;

            font-size: 8px;

            color: #777;

            background: #f8f8f8;
        }


        /* =====================================
           STATUS
        ===================================== */

        .status-box {
            margin-top: 7px;

            padding: 7px;

            border: 1px solid #ddd;

            text-align: center;

            background: #f8f8f8;

            page-break-inside: avoid;

            break-inside: avoid;
        }

        .status {
            display: inline-block;

            padding: 5px 13px;

            border-radius: 15px;

            font-weight: bold;

            font-size: 10px;
        }

        .menunggu {
            background: #fff3cd;

            color: #856404;
        }

        .diverifikasi {
            background: #d9edf7;

            color: #31708f;
        }

        .diterima {
            background: #dff0d8;

            color: #3c763d;
        }

        .ditolak {
            background: #f2dede;

            color: #a94442;
        }

        .default {
            background: #eeeeee;

            color: #555555;
        }


        /* =====================================
           ALASAN DITOLAK
        ===================================== */

        .alasan-ditolak {
            margin-top: 6px;

            padding: 6px 8px;

            background: #fff5f5;

            border-left: 3px solid #d9534f;

            text-align: left;

            line-height: 1.3;

            font-size: 10px;

            word-wrap: break-word;
        }

        .alasan-ditolak strong {
            color: #a94442;
        }


        /* =====================================
           PERNYATAAN
        ===================================== */

        .statement {
            border: 1px solid #d9d9d9;

            padding: 7px;

            line-height: 1.3;

            margin-top: 7px;

            text-align: justify;

            font-size: 9px;

            page-break-inside: avoid;

            break-inside: avoid;
        }


        /* =====================================
           TANDA TANGAN
        ===================================== */

        .signature {
            width: 42%;

            margin-left: auto;

            margin-top: 10px;

            text-align: center;

            line-height: 1.3;

            font-size: 10px;

            page-break-inside: avoid;

            break-inside: avoid;
        }

        .signature-space {
            height: 35px;
        }


        /* =====================================
           TOMBOL
        ===================================== */

        .print-button {
            text-align: center;

            margin: 15px auto;
        }

        .print-button button {
            padding: 9px 18px;

            border: none;

            background: #2e7d32;

            color: #ffffff;

            border-radius: 5px;

            cursor: pointer;

            font-size: 13px;

            margin: 3px;
        }

        .print-button button:hover {
            background: #1b5e20;
        }

        .back-button {
            background: #777 !important;
        }

        .back-button:hover {
            background: #555 !important;
        }


        /* =====================================
           RESPONSIVE TABLET
           HANYA UNTUK LAYAR
        ===================================== */

        @media screen and (max-width: 991px) {

            body {
                background: #ffffff;
            }

            .paper {
                width: 100%;

                height: auto;

                min-height: auto;

                margin: 0;

                padding: 25px;

                box-shadow: none;

                overflow: visible;
            }
        }


        /* =====================================
           RESPONSIVE HP
           HANYA UNTUK LAYAR
        ===================================== */

        @media screen and (max-width: 767px) {

            body {
                font-size: 11px;

                background: #ffffff;
            }

            .paper {
                width: 100%;

                padding: 15px;

                margin: 0;

                overflow: visible;
            }

            .header h1 {
                font-size: 18px;
            }

            .header h2 {
                font-size: 14px;
            }

            .header p {
                font-size: 10px;
            }

            .title h3 {
                font-size: 14px;
            }

            .title p {
                font-size: 9px;
            }

            .nomor span {
                font-size: 15px;
            }

            td {
                padding: 5px;

                font-size: 10px;

                word-break: break-word;
            }

            td.label {
                width: 31%;
            }

            td.foto-cell {
                width: 22%;
            }

            .foto {
                width: 60px;

                height: 80px;
            }

            .tidak-ada-foto {
                width: 60px;

                height: 80px;
            }

            .signature {
                width: 55%;
            }

            .print-button {
                padding: 10px;

                margin: 10px auto;
            }

            .print-button button {
                width: 100%;

                margin: 4px 0;
            }
        }


        /* =====================================
           HP KECIL
        ===================================== */

        @media screen and (max-width: 480px) {

            .paper {
                padding: 10px;
            }

            .header h1 {
                font-size: 16px;
            }

            .header h2 {
                font-size: 13px;
            }

            .header p {
                font-size: 9px;
            }

            .title h3 {
                font-size: 13px;
            }

            .title p {
                font-size: 8px;
            }

            .nomor {
                padding: 5px;
            }

            .nomor strong {
                font-size: 8px;
            }

            .nomor span {
                font-size: 14px;
            }

            .section-title {
                font-size: 9px;

                padding: 5px;
            }

            td {
                padding: 5px;

                font-size: 9px;
            }

            td.label {
                width: 34%;
            }

            td.foto-cell {
                width: 23%;
            }

            .foto {
                width: 55px;

                height: 75px;
            }

            .tidak-ada-foto {
                width: 55px;

                height: 75px;
            }

            .status-box {
                font-size: 9px;
            }

            .status {
                font-size: 9px;

                padding: 5px 10px;
            }

            .alasan-ditolak {
                font-size: 9px;
            }

            .statement {
                font-size: 8px;
            }

            .signature {
                width: 60%;

                font-size: 9px;
            }

            .signature-space {
                height: 30px;
            }
        }


        /* =====================================
           PRINT A4
           KHUSUS SAAT CETAK / SIMPAN PDF
        ===================================== */

        @media print {

            @page {
                size: A4 portrait;

                margin: 0;
            }

            html,
            body {
                width: 210mm;

                height: 297mm;

                margin: 0;

                padding: 0;

                background: #ffffff;
            }

            .paper {
                width: 210mm;

                height: 297mm;

                margin: 0;

                padding: 9mm;

                background: #ffffff;

                box-shadow: none;

                overflow: hidden;
            }

            .print-button {
                display: none !important;
            }

            .section,
            .status-box,
            .statement,
            .signature {
                page-break-inside: avoid !important;

                break-inside: avoid !important;
            }

            table {
                width: 100%;

                page-break-inside: avoid;
            }

            tr {
                page-break-inside: avoid;

                break-inside: avoid;
            }

            td {
                font-size: 11px;
            }

            img {
                page-break-inside: avoid;

                break-inside: avoid;
            }
        }

    </style>

</head>


<body>


<!-- =====================================
     KERTAS
===================================== -->

<div class="paper">


    <!-- =====================================
         HEADER
    ===================================== -->

    <div class="header">

        <h1>
            MTs Nurul Huda
        </h1>

        <h2>
            Pematang Cengal
        </h2>

        <p>
            Bukti Pendaftaran Peserta Didik Baru
        </p>

        <p>
            Tahun Ajaran 2026/2027
        </p>

    </div>


    <!-- =====================================
         JUDUL
    ===================================== -->

    <div class="title">

        <h3>
            BUKTI PENDAFTARAN PPDB
        </h3>

        <p>
            Data pendaftaran telah diterima oleh sistem.
        </p>

    </div>


    <!-- =====================================
         NOMOR PENDAFTARAN
    ===================================== -->

    <div class="nomor">

        <strong>
            NOMOR PENDAFTARAN
        </strong>

        <span>
            <?php
            echo e($data['no_pendaftaran']);
            ?>
        </span>

    </div>


    <!-- =====================================
         DATA CALON SISWA
    ===================================== -->

    <div class="section">

        <div class="section-title">
            Data Calon Siswa
        </div>

        <table>

            <tr>

                <td class="label">
                    Nama Lengkap
                </td>

                <td>
                    <?php
                    echo e(
                        $data['nama_lengkap']
                    );
                    ?>
                </td>

                <td
                    class="foto-cell"
                    rowspan="10">

                    <?php
                    if (!empty($data['foto'])) {
                    ?>

                        <img
                            src="../uploads/ppdb/<?php
                            echo rawurlencode(
                                $data['foto']
                            );
                            ?>"
                            class="foto"
                            alt="Foto Calon Siswa">

                        <div class="foto-keterangan">
                            Foto 3 x 4
                        </div>

                    <?php
                    } else {
                    ?>

                        <div class="tidak-ada-foto">

                            Foto
                            <br>
                            tidak tersedia

                        </div>

                    <?php
                    }
                    ?>

                </td>

            </tr>


            <tr>

                <td class="label">
                    NIK
                </td>

                <td>
                    <?php
                    echo e($data['nik']);
                    ?>
                </td>

            </tr>


            <tr>

                <td class="label">
                    NISN
                </td>

                <td>
                    <?php
                    echo e($data['nisn']);
                    ?>
                </td>

            </tr>


            <tr>

                <td class="label">
                    Tempat, Tanggal Lahir
                </td>

                <td>

                    <?php
                    echo e(
                        $data['tempat_lahir']
                    );
                    ?>

                    ,

                    <?php
                    echo e(
                        $data['tanggal_lahir']
                    );
                    ?>

                </td>

            </tr>


            <tr>

                <td class="label">
                    Jenis Kelamin
                </td>

                <td>
                    <?php
                    echo e(
                        $data['jenis_kelamin']
                    );
                    ?>
                </td>

            </tr>


            <tr>

                <td class="label">
                    Agama
                </td>

                <td>
                    <?php
                    echo e(
                        $data['agama']
                    );
                    ?>
                </td>

            </tr>


            <tr>

                <td class="label">
                    Nomor HP
                </td>

                <td>
                    <?php
                    echo e(
                        $data['no_hp']
                    );
                    ?>
                </td>

            </tr>


            <tr>

                <td class="label">
                    Asal Sekolah
                </td>

                <td>
                    <?php
                    echo e(
                        $data['asal_sekolah']
                    );
                    ?>
                </td>

            </tr>


            <tr>

                <td class="label">
                    Tahun Lulus
                </td>

                <td>
                    <?php
                    echo e(
                        $data['tahun_lulus']
                    );
                    ?>
                </td>

            </tr>


            <tr>

                <td class="label">
                    Alamat
                </td>

                <td>
                    <?php
                    echo nl2br(
                        e(
                            $data['alamat']
                        )
                    );
                    ?>
                </td>

            </tr>

        </table>

    </div>


    <!-- =====================================
         DATA AYAH
    ===================================== -->

    <div class="section">

        <div class="section-title">
            Data Ayah
        </div>

        <table>

            <tr>

                <td class="label">
                    Nama Ayah
                </td>

                <td>
                    <?php
                    echo e(
                        $data['nama_ayah']
                    );
                    ?>
                </td>

            </tr>


            <tr>

                <td class="label">
                    NIK Ayah
                </td>

                <td>
                    <?php
                    echo e(
                        $data['nik_ayah']
                    );
                    ?>
                </td>

            </tr>


            <tr>

                <td class="label">
                    Pekerjaan Ayah
                </td>

                <td>
                    <?php
                    echo e(
                        $data['pekerjaan_ayah']
                    );
                    ?>
                </td>

            </tr>


            <tr>

                <td class="label">
                    Nomor HP Ayah
                </td>

                <td>
                    <?php
                    echo e(
                        $data['no_hp_ayah']
                    );
                    ?>
                </td>

            </tr>

        </table>

    </div>


    <!-- =====================================
         DATA IBU
    ===================================== -->

    <div class="section">

        <div class="section-title">
            Data Ibu
        </div>

        <table>

            <tr>

                <td class="label">
                    Nama Ibu
                </td>

                <td>
                    <?php
                    echo e(
                        $data['nama_ibu']
                    );
                    ?>
                </td>

            </tr>


            <tr>

                <td class="label">
                    NIK Ibu
                </td>

                <td>
                    <?php
                    echo e(
                        $data['nik_ibu']
                    );
                    ?>
                </td>

            </tr>


            <tr>

                <td class="label">
                    Pekerjaan Ibu
                </td>

                <td>
                    <?php
                    echo e(
                        $data['pekerjaan_ibu']
                    );
                    ?>
                </td>

            </tr>


            <tr>

                <td class="label">
                    Nomor HP Ibu
                </td>

                <td>
                    <?php
                    echo e(
                        $data['no_hp_ibu']
                    );
                    ?>
                </td>

            </tr>

        </table>

    </div>


    <!-- =====================================
         STATUS PENDAFTARAN
    ===================================== -->

    <div class="status-box">

        <strong>
            STATUS PENDAFTARAN
        </strong>

        <br>
        <br>

        <span
            class="status <?php
            echo $status_class;
            ?>">

            <?php
            echo e($status);
            ?>

        </span>


        <?php
        if (
            $status == "Ditolak" &&
            isset($data['alasan_ditolak']) &&
            trim($data['alasan_ditolak']) != ''
        ) {
        ?>

            <div class="alasan-ditolak">

                <strong>
                    Alasan Pendaftaran Ditolak:
                </strong>

                <br>

                <?php
                echo nl2br(
                    e(
                        $data['alasan_ditolak']
                    )
                );
                ?>

            </div>

        <?php
        }
        ?>

    </div>


    <!-- =====================================
         PERNYATAAN
    ===================================== -->

    <div class="statement">

        <strong>
            Pernyataan:
        </strong>

        <br>

        Bukti pendaftaran ini merupakan tanda bahwa
        calon peserta didik telah melakukan pendaftaran
        melalui sistem PPDB online MTs Nurul Huda
        Pematang Cengal. Calon peserta didik wajib
        menyimpan bukti pendaftaran ini dan membawanya
        apabila diperlukan dalam proses verifikasi atau
        pendaftaran ulang.

    </div>


    <!-- =====================================
         TANDA TANGAN
    ===================================== -->

    <div class="signature">

        Pematang Cengal,
        <?php echo $tanggal_pendaftaran; ?>

        <br>

        Panitia PPDB

        <div class="signature-space"></div>

        <strong>
            ___________________________________
        </strong>

        <br>

        MTs Nurul Huda Pematang Cengal

    </div>


</div>


<!-- =====================================
     TOMBOL CETAK
===================================== -->

<div class="print-button">

    <button
        type="button"
        onclick="window.print();">

        🖨 Cetak / Simpan PDF

    </button>


    <button
        type="button"
        class="back-button"
        onclick="window.location.href='cek_status.php';">

        ← Kembali

    </button>

</div>


</body>

</html>