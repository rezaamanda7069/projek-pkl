<?php

session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

include "../koneksi.php";

/* =====================================================
   CEK ID GALERI
===================================================== */

if (!isset($_GET['id'])) {
    header("Location: galeri_admin.php");
    exit;
}

$id = intval($_GET['id']);

/* =====================================================
   AMBIL DATA GALERI
===================================================== */

$query = mysqli_query(
    $koneksi,
    "SELECT gambar
     FROM galeri
     WHERE id_galeri='$id'"
);

if (!$query || mysqli_num_rows($query) == 0) {

    echo "<script>
            alert('Data galeri tidak ditemukan!');
            window.location='galeri_admin.php';
          </script>";

    exit;
}

/* =====================================================
   AMBIL DATA
===================================================== */

$data = mysqli_fetch_assoc($query);

$gambar = $data['gambar'];

/* =====================================================
   HAPUS FILE GAMBAR
===================================================== */

if (!empty($gambar)) {

    $lokasi_gambar = "../images/" . $gambar;

    if (file_exists($lokasi_gambar)) {

        unlink($lokasi_gambar);
    }
}

/* =====================================================
   HAPUS DATA DARI DATABASE
===================================================== */

$hapus = mysqli_query(
    $koneksi,
    "DELETE FROM galeri
     WHERE id_galeri='$id'"
);

/* =====================================================
   HASIL
===================================================== */

if ($hapus) {

    echo "<script>
            alert('Data galeri dan gambar berhasil dihapus!');
            window.location='galeri_admin.php';
          </script>";

} else {

    echo "<script>
            alert('Data galeri gagal dihapus!');
            window.location='galeri_admin.php';
          </script>";
}

?>
