<?php

session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

include "../koneksi.php";

/* =====================================================
   CEK ID BERITA
===================================================== */

if (!isset($_GET['id'])) {
    header("Location: berita_admin.php");
    exit;
}

$id = intval($_GET['id']);

/* =====================================================
   AMBIL DATA BERITA
===================================================== */

$query = mysqli_query(
    $koneksi,
    "SELECT * FROM berita WHERE id_berita='$id'"
);

if (!$query || mysqli_num_rows($query) == 0) {

    echo "<script>
            alert('Data berita tidak ditemukan!');
            window.location='berita_admin.php';
          </script>";

    exit;
}

/* =====================================================
   AMBIL DATA BERITA
===================================================== */

$data = mysqli_fetch_assoc($query);

/*
   Ambil nama file gambar
*/
$gambar = $data['gambar'];

/* =====================================================
   HAPUS GAMBAR DARI FOLDER IMAGES
===================================================== */

if (!empty($gambar)) {

    $lokasi_gambar = "../images/" . $gambar;

    /*
       Cek apakah file gambar benar-benar ada
    */

    if (file_exists($lokasi_gambar)) {

        unlink($lokasi_gambar);
    }
}

/* =====================================================
   HAPUS DATA BERITA DARI DATABASE
===================================================== */

$hapus = mysqli_query(
    $koneksi,
    "DELETE FROM berita WHERE id_berita='$id'"
);

/* =====================================================
   HASIL HAPUS
===================================================== */

if ($hapus) {

    echo "<script>
            alert('Berita dan gambar berhasil dihapus.');
            window.location='berita_admin.php';
          </script>";

} else {

    echo "<script>
            alert('Berita gagal dihapus.');
            window.location='berita_admin.php';
          </script>";
}

?>