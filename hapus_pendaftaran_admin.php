<?php

session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

include "../koneksi.php";

/* =========================================================
   CEK ID
========================================================= */

if (!isset($_GET['id'])) {
    header("Location: pendaftaran_admin.php");
    exit;
}

$id = intval($_GET['id']);


/* =========================================================
   AMBIL NAMA FILE DOKUMEN
========================================================= */

$query_file = mysqli_query(
    $koneksi,
    "SELECT
        foto,
        dokumen_surat_kelulusan,
        dokumen_skhu,
        dokumen_akte_kelahiran,
        dokumen_kartu_keluarga,
        dokumen_ktp_ayah,
        dokumen_ktp_ibu,
        dokumen_pkh,
        dokumen_kks,
        dokumen_kip
     FROM pendaftaran
     WHERE id_pendaftaran='$id'"
);

if (!$query_file) {

    die(
        "Gagal mengambil data file: " .
        mysqli_error($koneksi)
    );

}

$data_file = mysqli_fetch_assoc($query_file);


/* =========================================================
   JIKA DATA DITEMUKAN
========================================================= */

if ($data_file) {

    /*
     * Folder:
     * laporanpkl/
     * ├── admin/
     * ├── uploads/
     * │   └── ppdb/
     */

    $folder_upload =
        dirname(__DIR__) .
        DIRECTORY_SEPARATOR .
        "uploads" .
        DIRECTORY_SEPARATOR .
        "ppdb" .
        DIRECTORY_SEPARATOR;


    /* =====================================================
       DAFTAR FILE YANG AKAN DIHAPUS
    ===================================================== */

    $daftar_file = array(

        $data_file['foto'],

        $data_file['dokumen_surat_kelulusan'],

        $data_file['dokumen_skhu'],

        $data_file['dokumen_akte_kelahiran'],

        $data_file['dokumen_kartu_keluarga'],

        $data_file['dokumen_ktp_ayah'],

        $data_file['dokumen_ktp_ibu'],

        $data_file['dokumen_pkh'],

        $data_file['dokumen_kks'],

        $data_file['dokumen_kip']

    );


    /* =====================================================
       HAPUS FILE DARI FOLDER
    ===================================================== */

    foreach ($daftar_file as $nama_file) {

        if (!empty($nama_file)) {

            /*
             * basename() supaya hanya nama file
             * yang digunakan
             */

            $nama_file = basename($nama_file);

            $path_file =
                $folder_upload .
                $nama_file;


            if (is_file($path_file)) {

                unlink($path_file);

            }

        }

    }


    /* =====================================================
       HAPUS DATA DARI DATABASE
    ===================================================== */

    $hapus = mysqli_query(
        $koneksi,
        "DELETE FROM pendaftaran
         WHERE id_pendaftaran='$id'"
    );


    if ($hapus) {

        echo "
        <script>

            alert('Data pendaftaran dan semua file dokumen berhasil dihapus!');

            window.location='pendaftaran_admin.php';

        </script>
        ";

    } else {

        echo "
        <script>

            alert('Data pendaftaran gagal dihapus!');

            window.location='pendaftaran_admin.php';

        </script>
        ";

    }

} else {

    echo "
    <script>

        alert('Data pendaftaran tidak ditemukan!');

        window.location='pendaftaran_admin.php';

    </script>
    ";

}

?>