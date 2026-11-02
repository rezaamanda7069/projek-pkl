<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

include "../koneksi.php";

if (isset($_POST['simpan'])) {

    $judul = mysqli_real_escape_string(
        $koneksi,
        $_POST['judul']
    );

    $tanggal = mysqli_real_escape_string(
        $koneksi,
        $_POST['tanggal']
    );

    $waktu = mysqli_real_escape_string(
        $koneksi,
        $_POST['waktu']
    );

    $tempat = mysqli_real_escape_string(
        $koneksi,
        $_POST['tempat']
    );

    $deskripsi = mysqli_real_escape_string(
        $koneksi,
        $_POST['deskripsi']
    );


    $query = mysqli_query(
        $koneksi,
        "INSERT INTO agenda
        (judul, tanggal, waktu, tempat, deskripsi)
        VALUES
        ('$judul', '$tanggal', '$waktu', '$tempat', '$deskripsi')"
    );


    if ($query) {

        echo "<script>
                alert('Agenda berhasil ditambahkan!');
                window.location='agenda_admin.php';
              </script>";

        exit;

    } else {

        echo "<script>
                alert('Agenda gagal ditambahkan!');
              </script>";

    }
}
?>

<!DOCTYPE html>
<html lang="id">
   <?php  include "navbar_admin.php"; ?>

<head>

    <meta charset="utf-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1">

    <title>Tambah Agenda</title>

    <link href="../bootstrap/css/bootstrap.min.css"
          rel="stylesheet">

    <style>

        body {
            
            background-color: #f5f5f5;
        }

        .form-agenda {
            background: #fff;
            padding: 25px;
            border-radius: 6px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.10);
            max-width: 900px;
            margin: 0 auto;
        }

        .judul {
            color: #2e7d32;
            margin-top: 0;
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
        }

        textarea {
            resize: vertical;
        }

        .tombol {
            margin-top: 20px;
        }

            .form-agenda {
                margin: 10px;
                padding: 15px;
            }

            .judul {
                font-size: 24px;
            }

            .tombol .btn {
                width: 100%;
                margin-bottom: 10px;
            }

        
    </style>

</head>

<body>




<div class="admin-content">

    <div class="form-agenda">

        <h2 class="judul">
            <span class="glyphicon glyphicon-calendar"></span>
            Tambah Agenda
        </h2>

        <hr>

        <form method="POST">


            <!-- Judul -->

            <div class="form-group">

                <label>Judul Agenda</label>

                <input
                    type="text"
                    name="judul"
                    class="form-control"
                    placeholder="Masukkan judul agenda"
                    required>

            </div>


            <!-- Tanggal -->

            <div class="form-group">

                <label>Tanggal</label>

                <input
                    type="date"
                    name="tanggal"
                    class="form-control"
                    required>

            </div>


            <!-- Waktu -->

            <div class="form-group">

                <label>Waktu</label>

                <input
                    type="time"
                    name="waktu"
                    class="form-control"
                    required>

            </div>


            <!-- Tempat -->

            <div class="form-group">

                <label>Tempat</label>

                <input
                    type="text"
                    name="tempat"
                    class="form-control"
                    placeholder="Contoh: Aula MTs Nurul Huda"
                    required>

            </div>


            <!-- Deskripsi -->

            <div class="form-group">

                <label>Deskripsi</label>

                <textarea
                    name="deskripsi"
                    class="form-control"
                    rows="6"
                    placeholder="Masukkan deskripsi agenda..."
                    required></textarea>

            </div>


            <!-- Tombol -->

            <div class="tombol">

                <button
                    type="submit"
                    name="simpan"
                    class="btn btn-success">

                    <span class="glyphicon glyphicon-save"></span>
                    Simpan Agenda

                </button>


                <a
                    href="agenda_admin.php"
                    class="btn btn-default">

                    <span class="glyphicon glyphicon-arrow-left"></span>
                    Kembali

                </a>

            </div>

        </form>

    </div>

</div>


<script src="../bootstrap/js/jquery.min.js"></script>
<script src="../bootstrap/js/bootstrap.min.js"></script>

</body>

</html>