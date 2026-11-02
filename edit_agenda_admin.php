<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

include "../koneksi.php";
include "navbar_admin.php";

// Cek ID agenda
if (!isset($_GET['id'])) {
    header("Location: agenda_admin.php");
    exit;
}

$id = intval($_GET['id']);

// Ambil data agenda
$query = mysqli_query(
    $koneksi,
    "SELECT * FROM agenda WHERE id_agenda='$id'"
);

if (mysqli_num_rows($query) == 0) {

    echo "<script>
            alert('Data agenda tidak ditemukan!');
            window.location='agenda_admin.php';
          </script>";

    exit;
}

$data = mysqli_fetch_assoc($query);


// Proses update
if (isset($_POST['update'])) {

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


    $update = mysqli_query(
        $koneksi,
        "UPDATE agenda SET
            judul='$judul',
            tanggal='$tanggal',
            waktu='$waktu',
            tempat='$tempat',
            deskripsi='$deskripsi'
        WHERE id_agenda='$id'"
    );


    if ($update) {

        echo "<script>
                alert('Agenda berhasil diubah!');
                window.location='agenda_admin.php';
              </script>";

        exit;

    } else {

        echo "<script>
                alert('Agenda gagal diubah!');
              </script>";

    }
}

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="utf-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1">

    <title>Edit Agenda - Admin</title>

    <link href="../bootstrap/css/bootstrap.min.css"rel="stylesheet">
    

    <style>

        body {
            
            background-color: #f5f5f5;
        }

        .form-agenda {
            background: white;
            padding: 25px;
            max-width: 900px;
            margin: 0 auto;
            border-radius: 6px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.10);
        }

        .judul-halaman {
            color: #2e7d32;
            margin-top: 0;
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

        .tombol .btn {
            margin-right: 5px;
        

            .form-agenda {
                margin: 10px;
                padding: 15px;
            }

            .judul-halaman {
                font-size: 24px;
            }

            .tombol .btn {
                width: 100%;
                margin-bottom: 10px;
            }

        }

    </style>

</head>

<body>




<div class="admin-content">

    <div class="form-agenda">

        <h2 class="judul-halaman">

            <span class="glyphicon glyphicon-edit"></span>

            Edit Agenda

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
                    value="<?php
                        echo htmlspecialchars($data['judul']);
                    ?>"
                    required>

            </div>


            <!-- Tanggal -->

            <div class="form-group">

                <label>Tanggal</label>

                <input
                    type="date"
                    name="tanggal"
                    class="form-control"
                    value="<?php
                        echo $data['tanggal'];
                    ?>"
                    required>

            </div>


            <!-- Waktu -->

            <div class="form-group">

                <label>Waktu</label>

                <input
                    type="time"
                    name="waktu"
                    class="form-control"
                    value="<?php
                        echo $data['waktu'];
                    ?>"
                    required>

            </div>


            <!-- Tempat -->

            <div class="form-group">

                <label>Tempat</label>

                <input
                    type="text"
                    name="tempat"
                    class="form-control"
                    value="<?php
                        echo htmlspecialchars($data['tempat']);
                    ?>"
                    required>

            </div>


            <!-- Deskripsi -->

            <div class="form-group">

                <label>Deskripsi</label>

                <textarea
                    name="deskripsi"
                    class="form-control"
                    rows="6"
                    required><?php
                        echo htmlspecialchars($data['deskripsi']);
                    ?></textarea>

            </div>


            <!-- Tombol -->

            <div class="tombol">

                <button
                    type="submit"
                    name="update"
                    class="btn btn-success">

                    <span class="glyphicon glyphicon-save"></span>
                    Simpan Perubahan

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