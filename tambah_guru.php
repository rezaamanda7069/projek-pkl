<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

include "../koneksi.php";
include "navbar_admin.php";


if (isset($_POST['simpan'])) {

    $nama    = mysqli_real_escape_string(
        $koneksi,
        $_POST['nama_guru']
    );
            $mapel = isset($_POST['mapel']) ? trim($_POST['mapel']) : '';

            if ($mapel == '') {
                $mapel = 'None';
            }

            $mapel = mysqli_real_escape_string(
                $koneksi,
                $mapel
            );

    $jabatan = mysqli_real_escape_string(
        $koneksi,
        $_POST['jabatan']
    );

    

    $gambar = "";

    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] == 0) {

        $nama_file = $_FILES['gambar']['name'];
        $tmp_file  = $_FILES['gambar']['tmp_name'];
        $ukuran    = $_FILES['gambar']['size'];

        $ekstensi = strtolower(
            pathinfo($nama_file, PATHINFO_EXTENSION)
        );

        $ekstensi_diperbolehkan = array(
            'jpg',
            'jpeg',
            'png'
        );

       
        if (!in_array($ekstensi, $ekstensi_diperbolehkan)) {

            echo "<script>
                    alert('Format gambar harus JPG, JPEG, atau PNG!');
                    history.back();
                  </script>";
            exit;
        }

        if ($ukuran > 2 * 1024 * 1024) {

            echo "<script>
                    alert('Ukuran gambar maksimal 2 MB!');
                    history.back();
                  </script>";
            exit;
        }

       
        $gambar = time() . '_' . rand(100, 999) . '.' . $ekstensi;

        $folder = "../images/";

        
        if (!is_dir($folder)) {
            mkdir($folder, 0777, true);
        }

       
        if (!move_uploaded_file(
            $tmp_file,
            $folder . $gambar
        )) {

            echo "<script>
                    alert('Gambar gagal diupload!');
                    history.back();
                  </script>";
            exit;
        }
    }

    

    $sql = mysqli_query(
        $koneksi,
        "INSERT INTO guru
        (
            gambar,
            nama_guru,
            mata_pelajaran,
            jabatan
        )
        VALUES
        (
            '$gambar',
            '$nama',
            '$mapel',
            '$jabatan'
        )"
    );

    if ($sql) {

        echo "<script>
                alert('Data guru berhasil disimpan');
                window.location='data_guru_admin.php';
              </script>";

        exit;

    } else {

        /* Jika database gagal, hapus gambar */
        if (
            $gambar != "" &&
            file_exists("../images/" . $gambar)
        ) {
            unlink("../images/" . $gambar);
        }

        echo "<script>
                alert('Data guru gagal disimpan: " .
                addslashes(mysqli_error($koneksi)) .
                "');
              </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1">

    <title>Tambah Data Guru - Admin</title>

    <link href="../bootstrap/css/bootstrap.min.css"
          rel="stylesheet">

    <style>

    * {
        box-sizing: border-box;
    }

    body {
        margin: 0;
        padding: 0 !important;
        background: #f5f7f6;
        color: #17251c;
        font-family: Arial, Helvetica, sans-serif;
    }

    /* =====================================================
       KONTEN
    ===================================================== */

    .guru-content {
        min-height: 100vh;
        margin-left: 0;
        padding: 30px;
    }

    /* =====================================================
       HEADER
    ===================================================== */

    .page-header-custom {
        background: #ffffff;
        border: 1px solid #e5ebe7;
        border-radius: 14px;
        padding: 22px 25px;
        margin-bottom: 22px;

        box-shadow:
            0 3px 15px rgba(23,37,28,0.06);

        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
    }

    .page-title {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .page-icon {
        width: 52px;
        height: 52px;

        display: flex;
        align-items: center;
        justify-content: center;

        border-radius: 12px;

        background: rgba(26,107,60,0.10);
        color: #1a6b3c;

        font-size: 22px;
        flex-shrink: 0;
    }

    .page-title h2 {
        margin: 0;
        font-size: 22px;
        font-weight: bold;
        color: #17251c;
    }

    .page-title p {
        margin: 5px 0 0;
        color: #71857a;
        font-size: 13px;
    }

    /* =====================================================
       FORM CARD
    ===================================================== */

    .form-card {
        background: #ffffff;
        border: 1px solid #e5ebe7;
        border-radius: 14px;

        box-shadow:
            0 3px 15px rgba(23,37,28,0.06);

        overflow: hidden;
    }

    .form-card-header {
        padding: 18px 25px;
        border-bottom: 1px solid #e7ede9;
        background: #ffffff;
    }

    .form-card-header h3 {
        margin: 0;
        font-size: 16px;
        font-weight: bold;
        color: #17251c;
    }

    .form-card-header p {
        margin: 5px 0 0;
        font-size: 12px;
        color: #71857a;
    }

    .form-card-body {
        padding: 25px;
    }

    /* =====================================================
       LABEL
    ===================================================== */

    .form-group {
        margin-bottom: 19px;
    }

    .form-group label {
        color: #34473c;
        font-size: 13px;
        font-weight: bold;
        margin-bottom: 7px;
    }

    /* =====================================================
       INPUT
    ===================================================== */

    .form-control {
        height: 42px;

        border: 1px solid #dce5df;
        border-radius: 8px;

        box-shadow: none;

        font-size: 13px;
        color: #17251c;

        transition:
            border-color .2s ease,
            box-shadow .2s ease;
    }

    .form-control:focus {
        border-color: #1a6b3c;

        box-shadow:
            0 0 0 3px rgba(26,107,60,0.10);
    }

    /* =====================================================
       INPUT GAMBAR
    ===================================================== */

    .input-gambar {
        height: auto;
        padding: 10px;
        background: #fafcfb;
    }

    .gambar-info {
        margin-top: 7px;
        font-size: 11px;
        color: #71857a;
        line-height: 1.5;
    }

    /* =====================================================
       PEMISAH
    ===================================================== */

    .form-divider {
        height: 1px;
        background: #e7ede9;
        margin: 8px 0 22px;
    }

    /* =====================================================
       JUDUL SECTION
    ===================================================== */

    .form-section-title {
        display: flex;
        align-items: center;
        gap: 8px;

        margin-bottom: 18px;

        color: #1a6b3c;

        font-size: 14px;
        font-weight: bold;
    }

    .form-section-title .glyphicon {
        font-size: 14px;
    }

    /* =====================================================
       FOOTER FORM
    ===================================================== */

    .form-footer-info {
        color: #71857a;
        font-size: 12px;
        margin-bottom: 18px;
    }

    .form-actions {
        display: flex;
        gap: 8px;
        justify-content: flex-end;
    }

    /* =====================================================
       BUTTON
    ===================================================== */

    .btn {
        border-radius: 8px;

        font-size: 13px;
        font-weight: bold;

        padding: 9px 16px;

        transition:
            transform .15s ease,
            box-shadow .15s ease;
    }

    .btn-success {
        background: #1a6b3c;
        border-color: #1a6b3c;
        color: #ffffff;
    }

    .btn-success:hover,
    .btn-success:focus {
        background: #0f4a29;
        border-color: #0f4a29;
        color: #ffffff;

        transform: translateY(-1px);

        box-shadow:
            0 4px 10px rgba(26,107,60,0.20);
    }

    .btn-default {
        background: #ffffff;
        border-color: #dce5df;
        color: #52645a;
    }

    .btn-default:hover {
        background: #f5f7f6;
        border-color: #cbd7d0;
    }

    /* =====================================================
       REQUIRED
    ===================================================== */

    .required {
        color: #d9534f;
        margin-left: 2px;
    }

    /* =====================================================
       SIDEBAR DESKTOP
    ===================================================== */

    @media (min-width: 768px) {

        .guru-content {
            margin-left: 250px;
        }

    }

    /* =====================================================
       TABLET
    ===================================================== */

    @media (min-width: 768px) and (max-width: 991px) {

        .guru-content {
            margin-left: 220px;
            padding: 25px;
        }

    }

    /* =====================================================
       HP
    ===================================================== */

    @media (max-width: 767px) {

        .guru-content {
            margin-left: 0;
            padding: 70px 15px 25px;
        }

        .page-header-custom {
            padding: 18px;
            margin-bottom: 18px;
        }

        .page-icon {
            width: 45px;
            height: 45px;
            font-size: 19px;
        }

        .page-title h2 {
            font-size: 18px;
        }

        .page-title p {
            font-size: 11px;
            line-height: 1.5;
        }

        .form-card-header {
            padding: 16px 18px;
        }

        .form-card-body {
            padding: 18px;
        }

        .form-actions {
            display: flex;
        }

        .form-actions .btn {
            flex: 1;
        }

    }

    /* =====================================================
       HP KECIL
    ===================================================== */

    @media (max-width: 480px) {

        .guru-content {
            padding: 65px 10px 20px;
        }

        .page-header-custom {
            display: block;
            text-align: center;
        }

        .page-title {
            justify-content: center;
        }

        .page-title p {
            margin-top: 7px;
        }

        .form-card-body {
            padding: 15px;
        }

        .form-actions {
            flex-direction: column;
        }

        .form-actions .btn {
            width: 100%;
        }

    }

    </style>

</head>

<body>

<div class="guru-content">

    <!-- =================================================
         HEADER
    ================================================== -->

    <div class="page-header-custom">

        <div class="page-title">

            <div class="page-icon">

                <span class="glyphicon glyphicon-education"></span>

            </div>

            <div>

                <h2>
                    Tambah Data Guru
                </h2>

                <p>
                    Tambahkan data guru baru ke dalam sistem
                    MTs Nurul Huda Pematang Cengal.
                </p>

            </div>

        </div>

    </div>


    <!-- =================================================
         FORM CARD
    ================================================== -->

    <div class="form-card">

        <!-- HEADER CARD -->

        <div class="form-card-header">

            <h3>

                <span class="glyphicon glyphicon-edit"></span>

                Form Data Guru

            </h3>

            <p>
                Silakan isi data guru dengan lengkap dan benar.
            </p>

        </div>


        <!-- BODY -->

        <div class="form-card-body">

            <form method="POST"
                  enctype="multipart/form-data">

                <div class="row">

                    <!-- =================================
                         GAMBAR
                    ================================== -->

                    <div class="col-md-12">

                        <div class="form-section-title">

                            <span class="glyphicon glyphicon-picture"></span>

                            Data Guru

                        </div>

                    </div>


                    <!-- GAMBAR -->

                    <div class="col-md-4">

                        <div class="form-group">

                            <label>
                                Gambar Guru
                                <span class="required">*</span>
                            </label>

                           <input
                              type="file"
                              name="gambar"
                             class="form-control input-gambar"
                             accept=".jpg,.jpeg,.png"
                            >

                            <div class="gambar-info">
                              <span class="glyphicon glyphicon-info-sign"></span>
                                Foto bersifat opsional. Jika belum ada foto, boleh dikosongkan.
                                Format JPG, JPEG atau PNG. Maksimal 2 MB.
                               </div>

                        </div>

                    </div>


                    <!-- NAMA GURU -->

                    <div class="col-md-8">

                        <div class="form-group">

                            <label>
                                Nama Guru
                                <span class="required">*</span>
                            </label>

                            <input
                                type="text"
                                name="nama_guru"
                                class="form-control"
                                placeholder="Masukkan nama lengkap guru"
                                required
                            >

                        </div>


                        <div class="form-group">

                                  <label>
                                Mata Pelajaran
                                <span style="color:#71857a; font-size:11px; font-weight:normal;">
                                    (Opsional)
                                </span>
                            </label>

                            <input
                                type="text"
                                name="mapel"
                                class="form-control"
                                placeholder="Contoh: Matematika"
                            >

                        </div>

                        <!-- JABATAN -->

                        <div class="form-group">

                            <label>
                                Jabatan
                                <span class="required">*</span>
                            </label>

                            <input
                                type="text"
                                name="jabatan"
                                class="form-control"
                                placeholder="Contoh: Guru / Wali Kelas"
                                required
                            >

                        </div>

                    </div>

                </div>


                <div class="form-divider"></div>


                <!-- CATATAN -->

                <p class="form-footer-info">

                    <span class="required">*</span>

                    Data yang wajib diisi.

                </p>


                <!-- TOMBOL -->

                <div class="form-actions">

                    <button
                        type="submit"
                        name="simpan"
                        class="btn btn-success">

                        <span class="glyphicon glyphicon-floppy-disk"></span>

                        Simpan Data

                    </button>


                    <a
                        href="data_guru_admin.php"
                        class="btn btn-default">

                        <span class="glyphicon glyphicon-arrow-left"></span>

                        Kembali

                    </a>

                </div>

            </form>

        </div>

    </div>

</div>


<script src="../bootstrap/js/jquery.min.js"></script>

<script src="../bootstrap/js/bootstrap.min.js"></script>

</body>

</html>