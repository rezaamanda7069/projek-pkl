<?php

session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

include "../koneksi.php";

/* =====================================================
   CEK ID PRESTASI
===================================================== */

if (!isset($_GET['id'])) {
    header("Location: prestasi_admin.php");
    exit;
}

$id = intval($_GET['id']);

/* =====================================================
   AMBIL DATA PRESTASI
===================================================== */

$query = mysqli_query(
    $koneksi,
    "SELECT gambar
     FROM prestasi
     WHERE id_prestasi='$id'"
);

if (!$query || mysqli_num_rows($query) == 0) {

    echo "<script>
            alert('Data prestasi tidak ditemukan!');
            window.location='prestasi_admin.php';
          </script>";

    exit;
}

/* =====================================================
   AMBIL DATA GAMBAR
===================================================== */

$data = mysqli_fetch_assoc($query);

$gambar = $data['gambar'];

/* =====================================================
   HAPUS FILE GAMBAR DARI FOLDER IMAGES
===================================================== */

if (!empty($gambar)) {

    $lokasi_gambar = "../images/" . $gambar;

    if (file_exists($lokasi_gambar)) {

        unlink($lokasi_gambar);
    }
}

/* =====================================================
   HAPUS DATA PRESTASI DARI DATABASE
===================================================== */

$hapus = mysqli_query(
    $koneksi,
    "DELETE FROM prestasi
     WHERE id_prestasi='$id'"
);

/* =====================================================
   HASIL
===================================================== */

if ($hapus) {

    echo "<script>
            alert('Data prestasi dan gambar berhasil dihapus!');
            window.location='prestasi_admin.php';
          </script>";

} else {

    echo "<script>
            alert('Data prestasi gagal dihapus!');
            window.location='prestasi_admin.php';
          </script>";
}

?>