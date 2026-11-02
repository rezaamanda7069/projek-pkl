<?php

session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}


include "../koneksi.php";


if(!isset($_GET['id'])){

    header("Location: galeri_admin.php");
    exit;

}

$id = intval($_GET['id']);


$query = mysqli_query(
    $koneksi,
    "SELECT * FROM galeri
     WHERE id_galeri='$id'"
);


$data = mysqli_fetch_assoc($query);


if(!$data){

    header("Location: galeri_admin.php");
    exit;

}


if(isset($_POST['update'])){

    $judul = mysqli_real_escape_string(
        $koneksi,
        $_POST['judul']
    );

    $tanggal = $_POST['tanggal'];

    $keterangan = mysqli_real_escape_string(
        $koneksi,
        $_POST['keterangan']
    );


    /* JIKA ADA GAMBAR BARU */

    if(
        isset($_FILES['gambar']) &&
        $_FILES['gambar']['error'] === 0
    ){

        $nama_file =
            $_FILES['gambar']['name'];

        $tmp_file =
            $_FILES['gambar']['tmp_name'];

        $ukuran =
            $_FILES['gambar']['size'];


        $ekstensi = strtolower(
            pathinfo(
                $nama_file,
                PATHINFO_EXTENSION
            )
        );


        $allowed = [
            'jpg',
            'jpeg',
            'png',
            'webp'
        ];


        if(!in_array(
            $ekstensi,
            $allowed
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


        $gambar_baru =
            uniqid('galeri_')
            . '.'
            . $ekstensi;


        move_uploaded_file(
            $tmp_file,
            '../images/' . $gambar_baru
        );


        /* HAPUS GAMBAR LAMA */

        if(
            !empty($data['gambar']) &&
            file_exists(
                '../images/' . $data['gambar']
            )
        ){

            unlink(
                '../images/' . $data['gambar']
            );

        }


        mysqli_query(
            $koneksi,
            "UPDATE galeri SET
            judul='$judul',
            gambar='$gambar_baru',
            tanggal='$tanggal',
            keterangan='$keterangan'
            WHERE id_galeri='$id'"
        );


    }else{

        mysqli_query(
            $koneksi,
            "UPDATE galeri SET
            judul='$judul',
            tanggal='$tanggal',
            keterangan='$keterangan'
            WHERE id_galeri='$id'"
        );

    }


    header("Location:galeri_admin.php");
    exit;

}

?>

<!DOCTYPE html>
<html lang="id">
    <?php include "navbar_admin.php"; ?>

<head>

<meta charset="utf-8">

<meta name="viewport"
      content="width=device-width, initial-scale=1">

<title>Edit Galeri</title>

<link href="../bootstrap/css/bootstrap.min.css"
      rel="stylesheet">

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

.gambar-lama{
    width:180px;
    height:120px;
    object-fit:cover;
    margin-bottom:15px;


    .box{
        padding:15px;
    }

    .gambar-lama{
        width:100%;
        height:auto;
    }

    .btn{
        width:100%;
        margin-bottom:8px;
    }

}

</style>

</head>

<body>

<div class="admin-content">

<div class="box">

<h2 class="judul">

<span class="glyphicon glyphicon-edit"></span>

Edit Galeri

</h2>

<hr>


<form method="POST"
      enctype="multipart/form-data">


<div class="form-group">

<label>Judul Galeri</label>

<input type="text"
       name="judul"
       class="form-control"
       value="<?php echo htmlspecialchars($data['judul']); ?>"
       required>

</div>


<div class="form-group">

<label>Tanggal</label>

<input type="date"
       name="tanggal"
       class="form-control"
       value="<?php echo $data['tanggal']; ?>"
       required>

</div>


<div class="form-group">

<label>Gambar Saat Ini</label>

<br>

<img
    src="../images/<?php echo htmlspecialchars($data['gambar']); ?>"
    class="img-thumbnail gambar-lama"
    alt="Gambar Galeri">

</div>


<div class="form-group">

<label>Ganti Gambar</label>

<input type="file"
       name="gambar"
       class="form-control"
       accept=".jpg,.jpeg,.png,.webp">

<p class="help-block">
    Kosongkan jika tidak ingin mengganti gambar.
</p>

</div>


<div class="form-group">

<label>Keterangan</label>

<textarea name="keterangan"
          class="form-control"
          rows="5"><?php
echo htmlspecialchars(
    $data['keterangan']
);
?></textarea>

</div>


<button type="submit"
        name="update"
        class="btn btn-success">

<span class="glyphicon glyphicon-save"></span>

Simpan Perubahan

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