<?php

session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

include "../koneksi.php";

/* =====================================================
   CEK ID
===================================================== */

if (!isset($_GET['id'])) {
    header("Location: ekstrakurikuler_admin.php");
    exit;
}

$id = intval($_GET['id']);

/* =====================================================
   AMBIL DATA EKSTRAKURIKULER
===================================================== */

$query = mysqli_query(
    $koneksi,
    "SELECT * FROM ekstrakurikuler
     WHERE id_ekskul='$id'"
);

if (!$query || mysqli_num_rows($query) == 0) {

    echo "<script>
            alert('Data ekstrakurikuler tidak ditemukan!');
            window.location='ekstrakurikuler_admin.php';
          </script>";

    exit;
}

/* =====================================================
   AMBIL DATA
===================================================== */

$data = mysqli_fetch_assoc($query);

/* =====================================================
   AMBIL NAMA GAMBAR
===================================================== */

$gambar = $data['gambar'];

/* =====================================================
   HAPUS GAMBAR DARI FOLDER IMAGES
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
    "DELETE FROM ekstrakurikuler
     WHERE id_ekskul='$id'"
);

/* =====================================================
   HASIL
===================================================== */

if ($hapus) {

    echo "<script>
            alert('Data ekstrakurikuler dan gambar berhasil dihapus!');
            window.location='ekstrakurikuler_admin.php';
          </script>";

} else {

    echo "<script>
            alert('Data ekstrakurikuler gagal dihapus!');
            window.location='ekstrakurikuler_admin.php';
          </script>";
}

?>