<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

include "../koneksi.php";

if (!isset($_GET['id'])) {
    header("Location: prestasi_admin.php");
    exit;
}

$id = $_GET['id'];

$query = mysqli_query(
    $koneksi,
    "SELECT * FROM prestasi WHERE id_prestasi='$id'"
);

$data = mysqli_fetch_assoc($query);

if (!$data) {
    header("Location: prestasi_admin.php");
    exit;
}

if (isset($_POST['update'])) {

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

    $gambar = $data['gambar'];


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
                    window.history.back();
                  </script>";

            exit;
        }

        $gambar = time() . "_" . $nama_gambar;

        move_uploaded_file(
            $tmp_gambar,
            "../images/" . $gambar
        );
    }


    $update = mysqli_query(
        $koneksi,
        "UPDATE prestasi SET
        nama_prestasi='$nama_prestasi',
        tingkat='$tingkat',
        penyelenggara='$penyelenggara',
        tahun='$tahun',
        deskripsi='$deskripsi',
        gambar='$gambar'
        WHERE id_prestasi='$id'"
    );


    if ($update) {

        echo "<script>
                alert('Data prestasi berhasil diperbarui!');
                window.location='prestasi_admin.php';
              </script>";

        exit;

    } else {

        echo "<script>
                alert('Data gagal diperbarui!');
              </script>";
    }
}

include "navbar_admin.php";
?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="utf-8">

<meta name="viewport"
      content="width=device-width, initial-scale=1">

<title>Edit Prestasi</title>

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

.gambar-lama {
    width: 150px;
    height: 100px;
    object-fit: cover;
}

@media(max-width:767px) {

    body {
        padding-top: 75px;
    }

    .form-box {
        padding: 15px;
    }

    .gambar-lama {
        width: 120px;
        height: 80px;
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
<span class="glyphicon glyphicon-edit"></span>
Edit Prestasi
</h2>

<hr>

<form method="POST"
      enctype="multipart/form-data">


<div class="form-group">

<label>Nama Prestasi</label>

<input type="text"
       name="nama_prestasi"
       class="form-control"
       value="<?php echo htmlspecialchars($data['nama_prestasi']); ?>"
       required>

</div>


<div class="form-group">

<label>Tingkat</label>

<input type="text"
       name="tingkat"
       class="form-control"
       value="<?php echo htmlspecialchars($data['tingkat']); ?>"
       required>

</div>


<div class="form-group">

<label>Penyelenggara</label>

<input type="text"
       name="penyelenggara"
       class="form-control"
       value="<?php echo htmlspecialchars($data['penyelenggara']); ?>"
       required>

</div>


<div class="form-group">

<label>Tahun</label>

<input type="number"
       name="tahun"
       class="form-control"
       value="<?php echo htmlspecialchars($data['tahun']); ?>"
       required>

</div>


<div class="form-group">

<label>Deskripsi</label>

<textarea name="deskripsi"
          class="form-control"
          rows="5"
          required><?php echo htmlspecialchars($data['deskripsi']); ?></textarea>

</div>


<div class="form-group">

<label>Gambar Saat Ini</label>

<br>

<?php if (!empty($data['gambar'])) { ?>

<img src="../images/<?php echo htmlspecialchars($data['gambar']); ?>"
     class="img-thumbnail gambar-lama">

<?php } else { ?>

<p class="text-muted">
Tidak ada gambar
</p>

<?php } ?>

</div>


<div class="form-group">

<label>Ganti Gambar</label>

<input type="file"
       name="gambar"
       class="form-control">

<p class="help-block">
Kosongkan jika tidak ingin mengganti gambar.
</p>

</div>


<button type="submit"
        name="update"
        class="btn btn-success">

<span class="glyphicon glyphicon-save"></span>
Simpan Perubahan

</button>


<a href="prestasi_admin.php"
   class="btn btn-default">

Kembali

</a>

</form>

</div>

</div>

</div>s

</div>

<script src="../bootstrap/js/jquery.min.js"></script>
<script src="../bootstrap/js/bootstrap.min.js"></script>

</body>
</html>