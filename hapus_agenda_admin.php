<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

include "../koneksi.php";

// Cek apakah ID tersedia
if (!isset($_GET['id'])) {
    header("Location: agenda_admin.php");
    exit;
}

$id = intval($_GET['id']);

// Cek apakah data agenda ada
$query = mysqli_query(
    $koneksi,
    "SELECT * FROM agenda WHERE id_agenda='$id'"
);

if (mysqli_num_rows($query) == 0) {

    echo "<script>
            alert('Data agenda tidak ditemukan!');
            window.location='agenda_admin.php';
          </script>";

    exit;
}

// Hapus data agenda
$hapus = mysqli_query(
    $koneksi,
    "DELETE FROM agenda WHERE id_agenda='$id'"
);

if ($hapus) {

    echo "<script>
            alert('Agenda berhasil dihapus!');
            window.location='agenda_admin.php';
          </script>";

} else {

    echo "<script>
            alert('Agenda gagal dihapus!');
            window.location='agenda_admin.php';
          </script>";

}
?>