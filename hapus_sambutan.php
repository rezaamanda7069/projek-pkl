<?php

session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

include "../koneksi.php";


if (
    !isset($_GET['id']) ||
    !is_numeric($_GET['id'])
) {

    die("ID sambutan tidak ditemukan.");

}


$id = intval($_GET['id']);


/* =====================================
   AMBIL DATA FOTO
===================================== */

$query = mysqli_query(
    $koneksi,
    "SELECT foto
     FROM sambutan
     WHERE id_sambutan = '$id'
     LIMIT 1"
);


if (
    mysqli_num_rows($query) == 0
) {

    echo "<script>
            alert('Data sambutan tidak ditemukan.');
            window.location='sambutan_admin.php';
          </script>";

    exit;

}


$data = mysqli_fetch_assoc($query);


/* =====================================
   HAPUS DATA
===================================== */

$hapus = mysqli_query(
    $koneksi,
    "DELETE FROM sambutan
     WHERE id_sambutan = '$id'"
);


if ($hapus) {


    /* HAPUS FOTO */

    if (
        !empty($data['foto']) &&
        file_exists(
            "../images/" .
            $data['foto']
        )
    ) {

        unlink(
            "../images/" .
            $data['foto']
        );

    }


    echo "<script>
            alert('Data sambutan berhasil dihapus.');
            window.location='sambutan_admin.php';
          </script>";

    exit;

} else {

    echo "<script>
            alert('Data gagal dihapus.');
            window.location='sambutan_admin.php';
          </script>";

    exit;

}

?>