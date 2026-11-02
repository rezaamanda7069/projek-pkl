<?php
session_start();

// Cek apakah admin sudah login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

include "../koneksi.php";

// Cek apakah ada parameter id
if (isset($_GET['id'])) {

    $id = intval($_GET['id']);

    // Query hapus data guru
    $hapus = mysqli_query($koneksi, "DELETE FROM guru WHERE id_guru='$id'");

    if ($hapus) {

        echo "<script>
                alert('Data guru berhasil dihapus.');
                window.location='data_guru_admin.php';
              </script>";

    } else {

        echo "<script>
                alert('Data guru gagal dihapus.');
                window.location='data_guru_admin.php';
              </script>";

    }

} else {

    echo "<script>
            alert('ID guru tidak ditemukan.');
            window.location='data_guru_admin.php';
          </script>";

}
?>