<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

include "../koneksi.php";
include "navbar_admin.php";

if (isset($_POST['simpan'])) {

    $nama_prestasi = mysqli_real_escape_string(
        $koneksi,
        $_POST['nama_prestasi']
    );

    $tingkat = mysqli_real_escape_string(
        $koneksi,
        $_POST['tingkat']
    );

    $penyelenggara = mysqli_real_escape_string(
        $koneksi,
        $_POST['penyelenggara']
    );

    $tahun = mysqli_real_escape_string(
        $koneksi,
        $_POST['tahun']
    );

    $deskripsi = mysqli_real_escape_string(
        $koneksi,
        $_POST['deskripsi']
    );

    $gambar = "";

    if (!empty($_FILES['gambar']['name'])) {

        $nama_gambar = $_FILES['gambar']['name'];
        $tmp_gambar = $_FILES['gambar']['tmp_name'];

        $ekstensi = strtolower(
            pathinfo($nama_gambar, PATHINFO_EXTENSION)
        );

        $allowed = array(
            "jpg",
            "jpeg",
            "png",
            "gif"
        );

        if (!in_array($ekstensi, $allowed)) {

            echo "<script>
                    alert('Format gambar tidak diperbolehkan!');
                  </script>";

        } else {

            $gambar = time() . "_" . $nama_gambar;

            move_uploaded_file(
                $tmp_gambar,
                "../images/" . $gambar
            );

            mysqli_query(
                $koneksi,
                "INSERT INTO prestasi
                (nama_prestasi, tingkat, penyelenggara, tahun, deskripsi, gambar)
                VALUES
                ('$nama_prestasi',
                 '$tingkat',
                 '$penyelenggara',
                 '$tahun',
                 '$deskripsi',
                 '$gambar')"
            );

            echo "<script>
                    alert('Data prestasi berhasil ditambahkan!');
                    window.location='prestasi_admin.php';
                  </script>";
        }

    } else {

        mysqli_query(
            $koneksi,
            "INSERT INTO prestasi
            (nama_prestasi, tingkat, penyelenggara, tahun, deskripsi, gambar)
            VALUES
            ('$nama_prestasi',
             '$tingkat',
             '$penyelenggara',
             '$tahun',
             '$deskripsi',
             '')"
        );

        echo "<script>
                alert('Data prestasi berhasil ditambahkan!');
                window.location='prestasi_admin.php';
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

<title>Tambah Prestasi</title>

<link href="../bootstrap/css/bootstrap.min.css"
      rel="stylesheet">

<style>

body {
    padding-top: 90px;
    background: #f5f5f5;
}

.form-box {
    background: white;
    padding: 25px;
    border-radius: 5px;
}

@media(max-width:767px) {

    body {
        padding-top: 75px;
    }

    .form-box {
        padding: 15px;
    }

}

</style>

</head>

<body>

<div class="container">

<div class="row">

<div class="col-md-8 col-md-offset-2">

<div class="form-box">

<h2>
<span class="glyphicon glyphicon-star"></span>
Tambah Prestasi
</h2>

<hr>

<form method="POST"
      enctype="multipart/form-data">

<div class="form-group">

<label>Nama Prestasi</label>

<input type="text"
       name="nama_prestasi"
       class="form-control"
       required>

</div>


<div class="form-group">

<label>Tingkat</label>

<input type="text"
       name="tingkat"
       class="form-control"
       placeholder="Contoh: Kecamatan, Kabupaten, Provinsi"
       required>

</div>


<div class="form-group">

<label>Penyelenggara</label>

<input type="text"
       name="penyelenggara"
       class="form-control"
       required>

</div>


<div class="form-group">

<label>Tahun</label>

<input type="number"
       name="tahun"
       class="form-control"
       min="1900"
       max="2100"
       required>

</div>


<div class="form-group">

<label>Deskripsi</label>

<textarea name="deskripsi"
          class="form-control"
          rows="5"
          required></textarea>

</div>


<div class="form-group">

<label>Gambar</label>

<input type="file"
       name="gambar"
       class="form-control">

<p class="help-block">
Format: JPG, JPEG, PNG, GIF
</p>

</div>


<button type="submit"
        name="simpan"
        class="btn btn-success">

<span class="glyphicon glyphicon-save"></span>
Simpan

</button>

<a href="prestasi_admin.php"
   class="btn btn-default">

Kembali

</a>

</form>

</div>

</div>

</div>

</div>

<script src="../bootstrap/js/jquery.min.js"></script>
<script src="../bootstrap/js/bootstrap.min.js"></script>

</body>
</html>