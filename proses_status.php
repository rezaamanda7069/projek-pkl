<?php

session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

include "../koneksi.php";


/* =========================================
   CEK ID
========================================= */

if (
    isset($_POST['id']) ||
    isset($_GET['id'])
) {

    $id = isset($_POST['id'])
        ? intval($_POST['id'])
        : intval($_GET['id']);

} else {

    header("Location: pendaftaran_admin.php");
    exit;

}


/* =========================================
   AMBIL STATUS
========================================= */

if (isset($_POST['status'])) {

    $status = $_POST['status'];

} elseif (isset($_GET['status'])) {

    $status = $_GET['status'];

} else {

    $status = '';

}


/* =========================================
   STATUS YANG DIPERBOLEHKAN
========================================= */

$status_valid = array(
    'Menunggu',
    'Diterima',
    'Ditolak'
);


if (!in_array($status, $status_valid)) {

    echo "<script>

        alert('Status tidak valid.');

        window.location='detail_pendaftaran_admin.php?id=$id';

    </script>";

    exit;
}


/* =========================================
   JIKA DITOLAK
========================================= */

if ($status == 'Ditolak') {


    /* Harus menggunakan POST */

    if (!isset($_POST['alasan_ditolak'])) {

        echo "<script>

            alert('Alasan penolakan harus diisi.');

            window.location='detail_pendaftaran_admin.php?id=$id';

        </script>";

        exit;

    }


    $alasan = trim(
        $_POST['alasan_ditolak']
    );


    if (empty($alasan)) {

        echo "<script>

            alert('Alasan penolakan tidak boleh kosong.');

            window.location='detail_pendaftaran_admin.php?id=$id';

        </script>";

        exit;

    }


    $alasan = mysqli_real_escape_string(
        $koneksi,
        $alasan
    );


    $query = mysqli_query(
        $koneksi,
        "UPDATE pendaftaran
         SET
            status='Ditolak',
            alasan_ditolak='$alasan'
         WHERE id_pendaftaran='$id'"
    );

}


/* =========================================
   JIKA DITERIMA
========================================= */

elseif ($status == 'Diterima') {


    $query = mysqli_query(
        $koneksi,
        "UPDATE pendaftaran
         SET
            status='Diterima',
            alasan_ditolak=NULL
         WHERE id_pendaftaran='$id'"
    );

}


/* =========================================
   JIKA MENUNGGU
========================================= */

elseif ($status == 'Menunggu') {


    $query = mysqli_query(
        $koneksi,
        "UPDATE pendaftaran
         SET
            status='Menunggu',
            alasan_ditolak=NULL
         WHERE id_pendaftaran='$id'"
    );

}


/* =========================================
   CEK HASIL UPDATE
========================================= */

if (!$query) {

    die(
        "Gagal mengubah status: " .
        mysqli_error($koneksi)
    );

}


/* =========================================
   KEMBALI KE DETAIL
========================================= */

header(
    "Location: detail_pendaftaran_admin.php?id=" . $id
);

exit;

?>