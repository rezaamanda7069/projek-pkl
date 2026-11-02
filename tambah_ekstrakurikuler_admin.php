<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

include "../koneksi.php";
?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Tambah Ekstrakurikuler</title>

    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <style>

        body {
           
            background: #f5f5f5;
        }

        .kotak-form {
            background: white;
            padding: 25px;
            border-radius: 5px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
            max-width: 800px;
            margin: auto;
        }

        .judul {
            color: #2e7d32;
            margin-top: 0;
        }

        .preview {
            max-width: 200px;
            max-height: 150px;
            margin-top: 10px;
        }

            .kotak-form {
                padding: 15px;
            }


    </style>

</head>

<body>

<?php include "navbar_admin.php"; ?>


<div class="admin-content">

    <div class="kotak-form">

        <h2 class="judul">
            <span class="glyphicon glyphicon-plus"></span>
            Tambah Ekstrakurikuler
        </h2>

        <p>Tambah data ekstrakurikuler MTs Nurul Huda Pematang Cengal.</p>

        <hr>


        <form action="" method="POST" enctype="multipart/form-data">

            <!-- Nama Ekstrakurikuler -->
            <div class="form-group">

                <label>Nama Ekstrakurikuler</label>

                <input
                    type="text"
                    name="nama_ekskul"
                    class="form-control"
                    placeholder="Contoh: Pramuka"
                    required>

            </div>


            <!-- Pembina -->
            <div class="form-group">

                <label>Pembina</label>

                <input
                    type="text"
                    name="pembina"
                    class="form-control"
                    placeholder="Nama pembina"
                    required>

            </div>


            <!-- Jadwal -->
            <div class="form-group">

                <label>Jadwal</label>

                <input
                    type="text"
                    name="jadwal"
                    class="form-control"
                    placeholder="Contoh: Jumat, 14.00 - 16.00"
                    required>

            </div>


            <!-- Deskripsi -->
            <div class="form-group">

                <label>Deskripsi</label>

                <textarea
                    name="deskripsi"
                    class="form-control"
                    rows="5"
                    placeholder="Masukkan deskripsi ekstrakurikuler..."
                    required></textarea>

            </div>


            <!-- Gambar -->
            <div class="form-group">

                <label>Gambar</label>

                <input
                    type="file"
                    name="gambar"
                    class="form-control"
                    accept="image/*">

                <p class="help-block">
                    Format JPG, JPEG, PNG. Maksimal 2 MB.
                </p>

            </div>


            <hr>


            <div class="text-right">

                <a href="ekstrakurikuler_admin.php"
                   class="btn btn-default">

                    <span class="glyphicon glyphicon-arrow-left"></span>
                    Kembali

                </a>

                <button
                    type="submit"
                    name="simpan"
                    class="btn btn-success">

                    <span class="glyphicon glyphicon-save"></span>
                    Simpan

                </button>

            </div>

        </form>

    </div>

</div>


<?php

if (isset($_POST['simpan'])) {

    $nama_ekskul = mysqli_real_escape_string(
        $koneksi,
        $_POST['nama_ekskul']
    );

    $pembina = mysqli_real_escape_string(
        $koneksi,
        $_POST['pembina']
    );

    $jadwal = mysqli_real_escape_string(
        $koneksi,
        $_POST['jadwal']
    );

    $deskripsi = mysqli_real_escape_string(
        $koneksi,
        $_POST['deskripsi']
    );


    // Nama gambar
    $gambar = "";


    // Jika ada gambar yang dipilih
    if (isset($_FILES['gambar']) &&
        $_FILES['gambar']['error'] == 0) {

        $nama_file = $_FILES['gambar']['name'];

        $tmp_file = $_FILES['gambar']['tmp_name'];

        $ukuran = $_FILES['gambar']['size'];


        // Ambil ekstensi
        $ekstensi = strtolower(
            pathinfo($nama_file, PATHINFO_EXTENSION)
        );


        // Ekstensi yang diperbolehkan
        $ekstensi_valid = array(
            'jpg',
            'jpeg',
            'png'
        );


        if (!in_array($ekstensi, $ekstensi_valid)) {

            echo "<script>
                    alert('Format gambar tidak diperbolehkan!');
                  </script>";

            exit;

        }


        // Maksimal 2 MB
        if ($ukuran > 2 * 1024 * 1024) {

            echo "<script>
                    alert('Ukuran gambar maksimal 2 MB!');
                  </script>";

            exit;

        }


        // Buat nama file unik
        $gambar = time() . "_" . $nama_file;


        // Upload ke folder images
        move_uploaded_file(
            $tmp_file,
            "../images/" . $gambar
        );

    }


    // Simpan ke database
    $query = mysqli_query(
        $koneksi,
        "INSERT INTO ekstrakurikuler
        (nama_ekskul, pembina, jadwal, deskripsi, gambar)
        VALUES
        ('$nama_ekskul',
         '$pembina',
         '$jadwal',
         '$deskripsi',
         '$gambar')"
    );


    if ($query) {

        echo "<script>
                alert('Data ekstrakurikuler berhasil ditambahkan!');
                window.location='ekstrakurikuler_admin.php';
              </script>";

    } else {

        echo "<script>
                alert('Data gagal ditambahkan!');
              </script>";

    }

}

?>


<script src="../bootstrap/js/jquery.min.js"></script>
<script src="../bootstrap/js/bootstrap.min.js"></script>

</body>

</html>