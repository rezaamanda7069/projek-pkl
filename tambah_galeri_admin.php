<?php

session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}


include "../koneksi.php";

if(isset($_POST['simpan'])){

    $judul = mysqli_real_escape_string(
        $koneksi,
        $_POST['judul']
    );

    $keterangan = mysqli_real_escape_string(
        $koneksi,
        $_POST['keterangan']
    );

    $tanggal = $_POST['tanggal'];


    /* UPLOAD GAMBAR */

    $nama_file = $_FILES['gambar']['name'];

    $tmp_file = $_FILES['gambar']['tmp_name'];

    $ukuran = $_FILES['gambar']['size'];

    $error = $_FILES['gambar']['error'];


    if($error === 0){

        $ekstensi = strtolower(
            pathinfo(
                $nama_file,
                PATHINFO_EXTENSION
            )
        );


        $ekstensi_diperbolehkan = [
            'jpg',
            'jpeg',
            'png',
            'webp'
        ];


        if(!in_array(
            $ekstensi,
            $ekstensi_diperbolehkan
        )){

            echo "<script>
                    alert('Format gambar tidak diperbolehkan!');
                    window.history.back();
                  </script>";

            exit;

        }


        if($ukuran > 5 * 1024 * 1024){

            echo "<script>
                    alert('Ukuran gambar maksimal 5 MB!');
                    window.history.back();
                  </script>";

            exit;

        }


        $nama_baru =
            uniqid('galeri_')
            . '.'
            . $ekstensi;


        move_uploaded_file(
            $tmp_file,
            '../images/' . $nama_baru
        );


        mysqli_query(
            $koneksi,
            "INSERT INTO galeri
            (judul,gambar,keterangan,tanggal)
            VALUES
            ('$judul','$nama_baru','$keterangan','$tanggal')"
        );


        header("Location: galeri_admin.php");
        exit;

    }

}

?>

<!DOCTYPE html>
<html lang="id">
    <?php include "navbar_admin.php"; ?>

<head>

<meta charset="utf-8">

<meta name="viewport"
      content="width=device-width, initial-scale=1">

<title>Tambah Galeri</title>

<link href="../bootstrap/css/bootstrap.min.css"rel="stylesheet">

<style>

body{
    background:#f5f5f5;
    
}

.box{
    background:white;
    padding:25px;
    border-radius:6px;
    box-shadow:0 2px 8px rgba(0,0,0,0.08);
}

.judul{
    color:#2e7d32;
    margin-top:0;
}

.form-group label{
    font-weight:bold;
}



</style>

</head>

<body>

<div class="admin-content">

<div class="box">

<h2 class="judul">

    <span class="glyphicon glyphicon-picture"></span>

    Tambah Galeri

</h2>

<p>
    Tambahkan dokumentasi kegiatan MTs Nurul Huda Pematang Cengal.
</p>

<hr>


<form method="POST"
      enctype="multipart/form-data">


<div class="form-group">

<label>
    Judul Galeri
</label>

<input type="text"
       name="judul"
       class="form-control"
       placeholder="Masukkan judul galeri"
       required>

</div>


<div class="form-group">

<label>
    Tanggal
</label>

<input type="date"
       name="tanggal"
       class="form-control"
       required>

</div>


<div class="form-group">

<label>
    Gambar
</label>

<input type="file"
       name="gambar"
       class="form-control"
       accept=".jpg,.jpeg,.png,.webp"
       required>

<p class="help-block">
    Format JPG, JPEG, PNG atau WEBP. Maksimal 5 MB.
</p>

</div>


<div class="form-group">

<label>
    Keterangan
</label>

<textarea name="keterangan"
          class="form-control"
          rows="5"
          placeholder="Masukkan keterangan foto"></textarea>

</div>


<button type="submit"
        name="simpan"
        class="btn btn-success">

    <span class="glyphicon glyphicon-save"></span>

    Simpan

</button>


<a href="galeri_admin.php"
   class="btn btn-default">

    <span class="glyphicon glyphicon-arrow-left"></span>

    Kembali

</a>


</form>

</div>

</div>


<script src="../bootstrap/js/jquery.min.js"></script>

<script src="../bootstrap/js/bootstrap.min.js"></script>

</body>

</html>