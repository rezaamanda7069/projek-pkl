<?php

include "../koneksi.php";

/* ==========================================
   CEK FORM
========================================== */

if (!isset($_POST['daftar'])) {
    header("Location: form_pendaftaran.php");
    exit;
}


/* ==========================================
   FUNGSI MEMBERSIHKAN DATA
========================================== */

function bersihkan($koneksi, $data)
{
    return mysqli_real_escape_string(
        $koneksi,
        trim($data)
    );
}


/* ==========================================
   DATA CALON SISWA
========================================== */

$nama_lengkap = bersihkan($koneksi, $_POST['nama_lengkap']);
$nik = bersihkan($koneksi, $_POST['nik']);
$nisn = bersihkan($koneksi, $_POST['nisn']);
$tempat_lahir = bersihkan($koneksi, $_POST['tempat_lahir']);
$tanggal_lahir = bersihkan($koneksi, $_POST['tanggal_lahir']);
$jenis_kelamin = bersihkan($koneksi, $_POST['jenis_kelamin']);
$agama = bersihkan($koneksi, $_POST['agama']);
$alamat = bersihkan($koneksi, $_POST['alamat']);
$no_hp = bersihkan($koneksi, $_POST['no_hp']);
$asal_sekolah = bersihkan($koneksi, $_POST['asal_sekolah']);
$tahun_lulus = bersihkan($koneksi, $_POST['tahun_lulus']);


/* ==========================================
   DATA AYAH
========================================== */

$nama_ayah = bersihkan($koneksi, $_POST['nama_ayah']);
$nik_ayah = bersihkan($koneksi, $_POST['nik_ayah']);
$pekerjaan_ayah = bersihkan($koneksi, $_POST['pekerjaan_ayah']);
$no_hp_ayah = bersihkan($koneksi, $_POST['no_hp_ayah']);


/* ==========================================
   DATA IBU
========================================== */

$nama_ibu = bersihkan($koneksi, $_POST['nama_ibu']);
$nik_ibu = bersihkan($koneksi, $_POST['nik_ibu']);
$pekerjaan_ibu = bersihkan($koneksi, $_POST['pekerjaan_ibu']);
$no_hp_ibu = bersihkan($koneksi, $_POST['no_hp_ibu']);


/* ==========================================
   CEK NIK / NISN
========================================== */

$cek_data = mysqli_query(
    $koneksi,
    "SELECT id_pendaftaran
     FROM pendaftaran
     WHERE nik='$nik'
     OR nisn='$nisn'
     LIMIT 1"
);

if (mysqli_num_rows($cek_data) > 0) {

    echo "
    <script>
        alert('NIK atau NISN sudah terdaftar.');
        window.location='form_pendaftaran.php';
    </script>
    ";

    exit;
}


/* ==========================================
   FOLDER UPLOAD
========================================== */

$folder_upload = "../uploads/ppdb/";


if (!is_dir($folder_upload)) {

    mkdir(
        $folder_upload,
        0777,
        true
    );
}


/* ==========================================
   FUNGSI UPLOAD FILE
========================================== */

function uploadFile(
    $file,
    $folder,
    $wajib = true
) {

    /* Tidak ada file */

    if (
        !isset($file) ||
        $file['error'] == UPLOAD_ERR_NO_FILE
    ) {

        if ($wajib) {
            return false;
        }

        return "";
    }


    /* Error upload */

    if ($file['error'] !== UPLOAD_ERR_OK) {
        return false;
    }


    /* Maksimal 5 MB */

    if ($file['size'] > 5 * 1024 * 1024) {
        return false;
    }


    /* Ekstensi */

    $ekstensi = strtolower(
        pathinfo(
            $file['name'],
            PATHINFO_EXTENSION
        )
    );


    $allowed = array(
        "jpg",
        "jpeg",
        "png",
        "pdf"
    );


    if (!in_array($ekstensi, $allowed)) {
        return false;
    }


    /* Nama file baru */

    $nama_file =
        uniqid("ppdb_", true)
        . "_"
        . time()
        . "."
        . $ekstensi;


    $tujuan =
        $folder .
        $nama_file;


    /* Pindahkan file */

    if (
        move_uploaded_file(
            $file['tmp_name'],
            $tujuan
        )
    ) {

        return $nama_file;

    }


    return false;
}


/* ==========================================
   UPLOAD DOKUMEN
========================================== */


/* Foto */

$foto = uploadFile(
    $_FILES['foto'],
    $folder_upload,
    true
);


/* Surat Kelulusan */

$dokumen_surat_kelulusan = uploadFile(
    $_FILES['dokumen_surat_kelulusan'],
    $folder_upload,
    true
);


/* SKHU */

$dokumen_skhu = uploadFile(
    $_FILES['dokumen_skhu'],
    $folder_upload,
    true
);


/* Akte */

$dokumen_akte_kelahiran = uploadFile(
    $_FILES['dokumen_akte_kelahiran'],
    $folder_upload,
    false
);


/* KK */

$dokumen_kartu_keluarga = uploadFile(
    $_FILES['dokumen_kartu_keluarga'],
    $folder_upload,
    true
);


/* KTP Ayah */

$dokumen_ktp_ayah = uploadFile(
    $_FILES['dokumen_ktp_ayah'],
    $folder_upload,
    true
);


/* KTP Ibu */

$dokumen_ktp_ibu = uploadFile(
    $_FILES['dokumen_ktp_ibu'],
    $folder_upload,
    true
);


/* PKH */

$dokumen_pkh = uploadFile(
    $_FILES['dokumen_pkh'],
    $folder_upload,
    false
);


/* KKS */

$dokumen_kks = uploadFile(
    $_FILES['dokumen_kks'],
    $folder_upload,
    false
);


/* KIP */

$dokumen_kip = uploadFile(
    $_FILES['dokumen_kip'],
    $folder_upload,
    false
);


/* ==========================================
   CEK DOKUMEN WAJIB
========================================== */

if (
    $foto === false ||
    $dokumen_surat_kelulusan === false ||
    $dokumen_skhu === false ||
    $dokumen_kartu_keluarga === false ||
    $dokumen_ktp_ayah === false ||
    $dokumen_ktp_ibu === false
) {

    echo "
    <script>
        alert('Pendaftaran gagal. Pastikan semua dokumen wajib sudah diupload dan format file benar.');
        window.location='form_pendaftaran.php';
    </script>
    ";

    exit;
}


/* ==========================================
   BUAT NOMOR PENDAFTARAN
========================================== */

$tahun = date("Y");


do {

    $kode_acak = rand(
        10000,
        99999
    );

    $no_pendaftaran =
        "PPDB-" .
        $tahun .
        "-" .
        $kode_acak;


    $cek_nomor = mysqli_query(
        $koneksi,
        "SELECT id_pendaftaran
         FROM pendaftaran
         WHERE no_pendaftaran='$no_pendaftaran'"
    );


} while (
    mysqli_num_rows($cek_nomor) > 0
);


/* ==========================================
   SIMPAN DATA
========================================== */

$query = mysqli_query(
    $koneksi,

    "INSERT INTO pendaftaran (

        no_pendaftaran,

        nama_lengkap,
        nik,
        nisn,
        tempat_lahir,
        tanggal_lahir,
        jenis_kelamin,
        agama,
        alamat,
        no_hp,
        asal_sekolah,
        tahun_lulus,

        nama_ayah,
        nik_ayah,
        pekerjaan_ayah,
        no_hp_ayah,

        nama_ibu,
        nik_ibu,
        pekerjaan_ibu,
        no_hp_ibu,

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

    )

    VALUES (

        '$no_pendaftaran',

        '$nama_lengkap',
        '$nik',
        '$nisn',
        '$tempat_lahir',
        '$tanggal_lahir',
        '$jenis_kelamin',
        '$agama',
        '$alamat',
        '$no_hp',
        '$asal_sekolah',
        '$tahun_lulus',

        '$nama_ayah',
        '$nik_ayah',
        '$pekerjaan_ayah',
        '$no_hp_ayah',

        '$nama_ibu',
        '$nik_ibu',
        '$pekerjaan_ibu',
        '$no_hp_ibu',

        '$foto',

        '$dokumen_surat_kelulusan',
        '$dokumen_skhu',
        '$dokumen_akte_kelahiran',
        '$dokumen_kartu_keluarga',
        '$dokumen_ktp_ayah',
        '$dokumen_ktp_ibu',
        '$dokumen_pkh',
        '$dokumen_kks',
        '$dokumen_kip'

    )"
);


/* ==========================================
   HASIL PENDAFTARAN
========================================== */

if ($query) {

    ?>

    <!DOCTYPE html>
    <html lang="id">

    <head>

        <meta charset="utf-8">

        <meta name="viewport"
              content="width=device-width, initial-scale=1">

        <title>Pendaftaran Berhasil</title>

        <link
            href="../bootstrap/css/bootstrap.min.css"
            rel="stylesheet">

        <style>

            body{
                background:#f4f6f8;
                padding-top:40px;
            }

            .success-box{
                max-width:600px;
                margin:50px auto;
                background:#fff;
                padding:40px;
                border-radius:12px;
                text-align:center;
                box-shadow:0 5px 20px rgba(0,0,0,.10);
            }

            .success-icon{
                width:80px;
                height:80px;
                line-height:80px;
                margin:0 auto 20px;
                border-radius:50%;
                background:#2e7d32;
                color:#fff;
                font-size:40px;
            }

            .success-box h2{
                color:#2e7d32;
                font-weight:bold;
            }

            .nomor-box{
                background:#f1f8f3;
                border:1px dashed #2e7d32;
                padding:20px;
                margin:25px 0;
                border-radius:8px;
            }

            .nomor-box small{
                display:block;
                color:#777;
                margin-bottom:8px;
            }

            .nomor-box strong{
                font-size:25px;
                color:#2e7d32;
            }

            .btn-kembali{
                background:#2e7d32;
                color:#fff;
                border:none;
                padding:12px 25px;
                border-radius:7px;
            }

            .btn-kembali:hover{
                background:#1b5e20;
                color:#fff;
            }

        </style>

    </head>

    <body>

    <div class="container">

        <div class="success-box">

            <div class="success-icon">

                <span class="glyphicon glyphicon-ok"></span>

            </div>

            <h2>
                Pendaftaran Berhasil!
            </h2>

            <p>
                Data pendaftaran Anda telah berhasil
                disimpan ke dalam sistem PPDB
                MTs Nurul Huda Pematang Cengal.
            </p>


            <div class="nomor-box">

                <small>
                    NOMOR PENDAFTARAN
                </small>

                <strong>
                    <?php echo $no_pendaftaran; ?>
                </strong>

            </div>


            <p>
                <strong>
                    Simpan nomor pendaftaran ini.
                </strong>
                Nomor tersebut dapat digunakan untuk
                mengecek status pendaftaran.
            </p>


            <br>


            <a
                href="ppdb.php"
                class="btn btn-kembali">

                <span class="glyphicon glyphicon-home"></span>

                Kembali ke PPDB

            </a>

        </div>

    </div>

    </body>

    </html>

    <?php

} else {

    echo "

    <script>

        alert(
            'Pendaftaran gagal disimpan. Silakan coba lagi.'
        );

        window.location='form_pendaftaran.php';

    </script>

    ";

}

?>