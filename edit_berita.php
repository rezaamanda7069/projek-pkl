<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

include "../koneksi.php";

// Ambil ID berita
$id = $_GET['id'];

$query = mysqli_query($koneksi,"SELECT * FROM berita WHERE id_berita='$id'");
$data = mysqli_fetch_assoc($query);

// Proses Update
if(isset($_POST['update'])){

    $judul   = $_POST['judul'];
    $isi     = $_POST['isi'];
    $tanggal = $_POST['tanggal'];

    $gambarBaru = $_FILES['gambar']['name'];
    $tmp        = $_FILES['gambar']['tmp_name'];

    // Jika upload gambar baru
    if($gambarBaru != ""){

        // Hapus gambar lama
        if($data['gambar'] != "" && file_exists("images/".$data['gambar'])){
            unlink("../images/".$data['gambar']);
        }

        move_uploaded_file($tmp,"../images/".$gambarBaru);

        mysqli_query($koneksi,"UPDATE berita SET
            judul='$judul',
            isi='$isi',
            tanggal='$tanggal',
            gambar='$gambarBaru'
            WHERE id_berita='$id'
        ");

    }else{

        // Tidak mengganti gambar
        mysqli_query($koneksi,"UPDATE berita SET
            judul='$judul',
            isi='$isi',
            tanggal='$tanggal'
            WHERE id_berita='$id'
        ");

    }

    echo "<script>
            alert('Berita berhasil diperbarui');
            window.location='berita_admin.php';
          </script>";
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Edit Berita</title>

<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">

<style>
body{
    padding-top:70px;
}
</style>

</head>
<body>

<div class="container">

<div class="panel panel-success">

<div class="panel-heading">
<h3 class="panel-title">Edit Berita</h3>
</div>

<div class="panel-body">

<form method="POST" enctype="multipart/form-data">

<div class="form-group">
<label>Judul Berita</label>
<input type="text"
name="judul"
class="form-control"
value="<?php echo $data['judul']; ?>"
required>
</div>

<div class="form-group">
<label>Isi Berita</label>
<textarea
name="isi"
rows="8"
class="form-control"
required><?php echo $data['isi']; ?></textarea>
</div>

<div class="form-group">
<label>Tanggal</label>
<input
type="date"
name="tanggal"
class="form-control"
value="<?php echo $data['tanggal']; ?>"
required>
</div>

<div class="form-group">
<label>Gambar Saat Ini</label><br>

<?php
if($data['gambar']!=""){
?>

<img src="../images/<?php echo $data['gambar']; ?>"
width="250"
class="img-thumbnail">

<?php
}else{
    echo "Belum ada gambar.";
}
?>

</div>

<div class="form-group">

<label>Ganti Gambar (Opsional)</label>

<input
type="file"
name="gambar"
class="form-control"
accept=".jpg,.jpeg,.png">

<p class="help-block">
Kosongkan jika tidak ingin mengganti gambar.
</p>

</div>

<hr>

<button
type="submit"
name="update"
class="btn btn-success">

<span class="glyphicon glyphicon-floppy-disk"></span>
Update

</button>

<a href="berita_admin.php"
class="btn btn-default">

<span class="glyphicon glyphicon-arrow-left"></span>
Kembali

</a>

</form>

</div>

</div>

</div>

<script src="../bootstrap/js/jquery.min.js"></script>
<script src="../bootstrap/js/bootstrap.min.js"></script>

</body>
</html>