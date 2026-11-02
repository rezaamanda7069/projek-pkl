<?php

session_start();

/* =========================================
   CEK LOGIN ADMIN
========================================= */

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

include "../koneksi.php";


/* =========================================
   CEK ID PENDAFTARAN
========================================= */

if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("ID pendaftaran tidak ditemukan.");
}

$id = intval($_GET['id']);


/* =========================================
   AMBIL DATA PENDAFTARAN
========================================= */

$query = mysqli_query(
    $koneksi,
    "SELECT * FROM pendaftaran
     WHERE id_pendaftaran = '$id'"
);

if (!$query || mysqli_num_rows($query) == 0) {
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
   FUNGSI TANGGAL INDONESIA
========================================= */

function tanggalIndonesia($tanggal)
{
    if (empty($tanggal)) {
        return '-';
    }

    $bulan = array(
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

    $timestamp = strtotime($tanggal);

    if ($timestamp === false) {
        return '-';
    }

    return date('d', $timestamp) . ' ' .
           $bulan[(int)date('m', $timestamp)] . ' ' .
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
    Bukti Pendaftaran PPDB - MTs Nurul Huda
</title>


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

    padding: 20px;

    background: #eeeeee;

    font-family: Arial, Helvetica, sans-serif;

    color: #222;

    font-size: 11px;

}


/* =====================================================
   KERTAS
===================================================== */

.paper {

    width: 210mm;

    min-height: 297mm;

    margin: auto;

    background: #ffffff;

    padding: 10mm;

    box-shadow: 0 0 10px rgba(0,0,0,0.15);

}


/* =====================================================
   HEADER
===================================================== */

.header {

    text-align: center;

    border-bottom: 2px solid #16803c;

    padding-bottom: 7px;

    margin-bottom: 8px;

}


.header h1 {

    margin: 0;

    font-size: 20px;

    font-weight: bold;

    color: #176b3a;

}


.header h2 {

    margin: 2px 0;

    font-size: 14px;

    font-weight: bold;

}


.header p {

    margin: 2px 0;

    font-size: 10px;

}


/* =====================================================
   JUDUL
===================================================== */

.title {

    text-align: center;

    margin-bottom: 8px;

}


.title h3 {

    margin: 0 0 3px;

    font-size: 14px;

    font-weight: bold;

}


.title p {

    margin: 0;

    font-size: 9px;

    color: #555;

}


/* =====================================================
   NOMOR PENDAFTARAN
===================================================== */

.nomor {

    border: 1px solid #cccccc;

    background: #f5f5f5;

    padding: 6px;

    text-align: center;

    margin-bottom: 8px;

}


.nomor strong {

    display: block;

    font-size: 8px;

    color: #666;

    margin-bottom: 2px;

}


.nomor span {

    font-size: 15px;

    font-weight: bold;

    color: #176b3a;

}


/* =====================================================
   SECTION
===================================================== */

.section {

    margin-bottom: 7px;

}


.section-title {

    background: #176b3a;

    color: #ffffff;

    padding: 5px 7px;

    font-size: 10px;

    font-weight: bold;

    text-transform: uppercase;

}


/* =====================================================
   TABLE
===================================================== */

table {

    width: 100%;

    border-collapse: collapse;

}


td {

    border: 1px solid #d5d5d5;

    padding: 4px 6px;

    vertical-align: middle;

    line-height: 1.25;

}


td.label {

    width: 27%;

    background: #f7f7f7;

    font-weight: bold;

}


/* =====================================================
   TABEL SISWA
===================================================== */

.tabel-siswa td {

    height: 23px;

}


/* =====================================================
   FOTO
===================================================== */

.foto-cell {

    width: 22%;

    text-align: center;

    vertical-align: middle;

    padding: 5px;

}


.foto {

    width: 70px;

    height: 90px;

    object-fit: cover;

    border: 1px solid #888;

    padding: 2px;

    display: block;

    margin: auto;

}


.foto-keterangan {

    font-size: 8px;

    color: #666;

    margin-top: 3px;

}


.tidak-ada-foto {

    width: 70px;

    height: 90px;

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


/* =====================================================
   DATA ORANG TUA
===================================================== */

.orangtua-wrapper {

    display: table;

    width: 100%;

    table-layout: fixed;

}


.orangtua-box {

    display: table-cell;

    width: 50%;

    vertical-align: top;

}


.orangtua-box:first-child {

    padding-right: 4px;

}


.orangtua-box:last-child {

    padding-left: 4px;

}


.orangtua-title {

    background: #176b3a;

    color: #ffffff;

    padding: 5px 7px;

    font-size: 10px;

    font-weight: bold;

}


.orangtua-box table td {

    padding: 4px 5px;

}


.orangtua-box table td.label {

    width: 38%;

}


/* =====================================================
   PERNYATAAN
===================================================== */

.statement {

    border: 1px solid #d5d5d5;

    padding: 7px;

    line-height: 1.35;

    margin-top: 7px;

    text-align: justify;

    font-size: 9px;

}


/* =====================================================
   TANDA TANGAN
===================================================== */

.signature {

    width: 40%;

    margin-left: auto;

    margin-top: 9px;

    text-align: center;

    line-height: 1.35;

    font-size: 9px;

}


.signature-space {

    height: 32px;

}


.signature strong {

    font-size: 9px;

}


/* =====================================================
   TOMBOL
===================================================== */

.print-button {

    text-align: center;

    margin: 20px auto;

}


.print-button button {

    padding: 10px 20px;

    border: none;

    background: #176b3a;

    color: white;

    border-radius: 5px;

    cursor: pointer;

    font-size: 14px;

}


.print-button button:hover {

    background: #0e542d;

}


.back-button {

    background: #777 !important;

    margin-left: 5px;

}


.back-button:hover {

    background: #555 !important;

}


/* =====================================================
   PRINT A4 1 HALAMAN
===================================================== */

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


    body {

        font-size: 10px;

    }


    .paper {

        width: 210mm;

        height: 297mm;

        min-height: 297mm;

        margin: 0;

        padding: 8mm;

        box-shadow: none;

        overflow: hidden;

    }


    .print-button {

        display: none !important;

    }


    .header {

        padding-bottom: 5px;

        margin-bottom: 6px;

    }


    .header h1 {

        font-size: 18px;

    }


    .header h2 {

        font-size: 13px;

    }


    .header p {

        font-size: 9px;

    }


    .title {

        margin-bottom: 6px;

    }


    .title h3 {

        font-size: 13px;

    }


    .title p {

        font-size: 8px;

    }


    .nomor {

        padding: 5px;

        margin-bottom: 6px;

    }


    .nomor strong {

        font-size: 7px;

    }


    .nomor span {

        font-size: 14px;

    }


    .section {

        margin-bottom: 5px;

    }


    .section-title {

        padding: 4px 6px;

        font-size: 9px;

    }


    td {

        padding: 3px 5px;

        line-height: 1.15;

    }


    .tabel-siswa td {

        height: 20px;

    }


    .foto {

        width: 65px;

        height: 82px;

    }


    .tidak-ada-foto {

        width: 65px;

        height: 82px;

    }


    .foto-keterangan {

        font-size: 7px;

    }


    .orangtua-box table td {

        padding: 3px 4px;

    }


    .statement {

        padding: 5px;

        margin-top: 5px;

        font-size: 8px;

        line-height: 1.25;

    }


    .signature {

        margin-top: 6px;

        font-size: 8px;

    }


    .signature-space {

        height: 25px;

    }


    .signature strong {

        font-size: 8px;

    }


    .section,
    .orangtua-wrapper,
    .statement,
    .signature {

        page-break-inside: avoid;

        break-inside: avoid;

    }

}


/* =====================================================
   RESPONSIVE HP
===================================================== */

@media screen and (max-width: 767px) {

    body {

        padding: 0;

        background: #ffffff;

        overflow-x: auto;

    }


    .paper {

        width: 100%;

        min-height: auto;

        padding: 15px;

        box-shadow: none;

    }


    .header h1 {

        font-size: 22px;

    }


    .header h2 {

        font-size: 16px;

    }


    .title h3 {

        font-size: 16px;

    }


    .orangtua-wrapper {

        display: block;

    }


    .orangtua-box {

        display: block;

        width: 100%;

    }


    .orangtua-box:first-child {

        padding-right: 0;

        margin-bottom: 8px;

    }


    .orangtua-box:last-child {

        padding-left: 0;

    }


    .foto {

        width: 80px;

        height: 105px;

    }


    .tidak-ada-foto {

        width: 80px;

        height: 105px;

    }

}

</style>

</head>


<body>


<div class="paper">


    <!-- =====================================
         HEADER
    ===================================== -->

    <div class="header">

        <h1>
            MTs NURUL HUDA
        </h1>

        <h2>
            PEMATANG CENGAL
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
            Data pendaftaran telah diterima oleh sistem PPDB.
        </p>

    </div>


    <!-- =====================================
         NOMOR
    ===================================== -->

    <div class="nomor">

        <strong>
            NOMOR PENDAFTARAN
        </strong>

        <span>
            <?php echo e($data['no_pendaftaran']); ?>
        </span>

    </div>


    <!-- =====================================
         DATA CALON SISWA
    ===================================== -->

    <div class="section">

        <div class="section-title">
            DATA CALON SISWA
        </div>


        <table class="tabel-siswa">

            <tr>

                <td class="label">
                    Nama Lengkap
                </td>

                <td>
                    <?php echo e($data['nama_lengkap']); ?>
                </td>

                <td class="foto-cell" rowspan="10">

                    <?php if (!empty($data['foto'])) { ?>

                        <img
                            src="../uploads/ppdb/<?php
                            echo rawurlencode($data['foto']);
                            ?>"
                            class="foto"
                            alt="Foto">

                        <div class="foto-keterangan">
                            Foto Calon Siswa
                        </div>

                    <?php } else { ?>

                        <div class="tidak-ada-foto">
                            Foto<br>
                            tidak tersedia
                        </div>

                    <?php } ?>

                </td>

            </tr>


            <tr>

                <td class="label">
                    NIK
                </td>

                <td>
                    <?php echo e($data['nik']); ?>
                </td>

            </tr>


            <tr>

                <td class="label">
                    NISN
                </td>

                <td>
                    <?php echo e($data['nisn']); ?>
                </td>

            </tr>


            <tr>

                <td class="label">
                    Tempat, Tanggal Lahir
                </td>

                <td>
                    <?php echo e($data['tempat_lahir']); ?>,
                    <?php echo e($data['tanggal_lahir']); ?>
                </td>

            </tr>


            <tr>

                <td class="label">
                    Jenis Kelamin
                </td>

                <td>
                    <?php echo e($data['jenis_kelamin']); ?>
                </td>

            </tr>


            <tr>

                <td class="label">
                    Agama
                </td>

                <td>
                    <?php echo e($data['agama']); ?>
                </td>

            </tr>


            <tr>

                <td class="label">
                    Nomor HP
                </td>

                <td>
                    <?php echo e($data['no_hp']); ?>
                </td>

            </tr>


            <tr>

                <td class="label">
                    Asal Sekolah
                </td>

                <td>
                    <?php echo e($data['asal_sekolah']); ?>
                </td>

            </tr>


            <tr>

                <td class="label">
                    Tahun Lulus
                </td>

                <td>
                    <?php echo e($data['tahun_lulus']); ?>
                </td>

            </tr>


            <tr>

                <td class="label">
                    Alamat
                </td>

                <td>
                    <?php echo nl2br(e($data['alamat'])); ?>
                </td>

            </tr>

        </table>

    </div>


    <!-- =====================================
         DATA ORANG TUA
    ===================================== -->

    <div class="orangtua-wrapper">


        <!-- AYAH -->

        <div class="orangtua-box">

            <div class="orangtua-title">
                DATA AYAH
            </div>


            <table>

                <tr>

                    <td class="label">
                        Nama
                    </td>

                    <td>
                        <?php echo e($data['nama_ayah']); ?>
                    </td>

                </tr>


                <tr>

                    <td class="label">
                        NIK
                    </td>

                    <td>
                        <?php echo e($data['nik_ayah']); ?>
                    </td>

                </tr>


                <tr>

                    <td class="label">
                        Pekerjaan
                    </td>

                    <td>
                        <?php echo e($data['pekerjaan_ayah']); ?>
                    </td>

                </tr>


                <tr>

                    <td class="label">
                        No. HP
                    </td>

                    <td>
                        <?php echo e($data['no_hp_ayah']); ?>
                    </td>

                </tr>

            </table>

        </div>


        <!-- IBU -->

        <div class="orangtua-box">

            <div class="orangtua-title">
                DATA IBU
            </div>


            <table>

                <tr>

                    <td class="label">
                        Nama
                    </td>

                    <td>
                        <?php echo e($data['nama_ibu']); ?>
                    </td>

                </tr>


                <tr>

                    <td class="label">
                        NIK
                    </td>

                    <td>
                        <?php echo e($data['nik_ibu']); ?>
                    </td>

                </tr>


                <tr>

                    <td class="label">
                        Pekerjaan
                    </td>

                    <td>
                        <?php echo e($data['pekerjaan_ibu']); ?>
                    </td>

                </tr>


                <tr>

                    <td class="label">
                        No. HP
                    </td>

                    <td>
                        <?php echo e($data['no_hp_ibu']); ?>
                    </td>

                </tr>

            </table>

        </div>

    </div>


    <!-- =====================================
         PERNYATAAN
    ===================================== -->

    <div class="statement">

        <strong>Pernyataan:</strong>

        Bukti pendaftaran ini merupakan tanda bahwa
        calon peserta didik telah melakukan pendaftaran
        melalui sistem PPDB online MTs Nurul Huda
        Pematang Cengal.

        Calon peserta didik wajib menyimpan bukti
        pendaftaran ini dan membawanya apabila
        diperlukan dalam proses verifikasi atau
        pendaftaran ulang.

    </div>


    <!-- =====================================
         TANDA TANGAN
    ===================================== -->

    <div class="signature">

        Pematang Cengal,
        <?php echo tanggalIndonesia($data['tanggal_daftar']); ?>

        <br>

        Panitia PPDB

        <div class="signature-space"></div>

        <strong>
            __________________________________
        </strong>

        <br>

        MTs Nurul Huda Pematang Cengal

    </div>


</div>


<!-- =====================================
     TOMBOL CETAK
===================================== -->

<div class="print-button">

    <button onclick="window.print()">
        🖨 Cetak / Simpan PDF
    </button>

    <button
        type="button"
        class="back-button"
        onclick="window.location.href='detail_pendaftaran_admin.php?id=<?php echo $id; ?>';">

        ← Kembali

    </button>

</div>


</body>

</html>