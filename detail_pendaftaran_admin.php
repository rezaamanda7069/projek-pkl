
<?php

session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

include "../koneksi.php";


/* =========================================================
   FUNGSI ESCAPE
========================================================= */

function e($data)
{
    return htmlspecialchars(
        $data ?? '',
        ENT_QUOTES,
        'UTF-8'
    );
}


/* =========================================================
   CEK ID
========================================================= */

if (!isset($_GET['id']) || empty($_GET['id'])) {

    header("Location: pendaftaran_admin.php");
    exit;

}

$id = intval($_GET['id']);


/* =========================================================
   PROSES AKSI PENDAFTARAN
   SEMUA DIPROSES DI FILE INI
========================================================= */

if (isset($_POST['aksi'])) {

    $aksi = $_POST['aksi'];

    /* -----------------------------------------
       TERIMA PENDAFTARAN
    ----------------------------------------- */

    if ($aksi == 'terima') {

        $query_update = mysqli_query(
            $koneksi,
            "UPDATE pendaftaran
             SET
                status = 'Diterima',
                alasan_ditolak = NULL
             WHERE id_pendaftaran = '$id'"
        );

        if ($query_update) {

            echo "<script>
                alert('Pendaftaran berhasil diterima.');
                window.location='detail_pendaftaran_admin.php?id=$id';
            </script>";

            exit;

        } else {

            echo "<script>
                alert('Gagal menerima pendaftaran.');
                window.location='detail_pendaftaran_admin.php?id=$id';
            </script>";

            exit;
        }
    }


    /* -----------------------------------------
       TOLAK PENDAFTARAN
    ----------------------------------------- */

    if ($aksi == 'tolak') {

        $alasan = isset($_POST['alasan_ditolak'])
            ? trim($_POST['alasan_ditolak'])
            : '';

        if ($alasan == '') {

            echo "<script>
                alert('Alasan penolakan wajib diisi.');
                window.location='detail_pendaftaran_admin.php?id=$id';
            </script>";

            exit;
        }

        $alasan = mysqli_real_escape_string(
            $koneksi,
            $alasan
        );

        $query_update = mysqli_query(
            $koneksi,
            "UPDATE pendaftaran
             SET
                status = 'Ditolak',
                alasan_ditolak = '$alasan'
             WHERE id_pendaftaran = '$id'"
        );

        if ($query_update) {

            echo "<script>
                alert('Pendaftaran berhasil ditolak.');
                window.location='detail_pendaftaran_admin.php?id=$id';
            </script>";

            exit;

        } else {

            echo "<script>
                alert('Gagal menolak pendaftaran.');
                window.location='detail_pendaftaran_admin.php?id=$id';
            </script>";

            exit;
        }
    }


    /* -----------------------------------------
       KEMBALIKAN KE MENUNGGU
    ----------------------------------------- */

    if ($aksi == 'menunggu') {

        $query_update = mysqli_query(
            $koneksi,
            "UPDATE pendaftaran
             SET
                status = 'Menunggu',
                alasan_ditolak = NULL
             WHERE id_pendaftaran = '$id'"
        );

        if ($query_update) {

            echo "<script>
                alert('Status berhasil dikembalikan menjadi Menunggu.');
                window.location='detail_pendaftaran_admin.php?id=$id';
            </script>";

            exit;

        } else {

            echo "<script>
                alert('Gagal mengubah status.');
                window.location='detail_pendaftaran_admin.php?id=$id';
            </script>";

            exit;
        }
    }
}


/* =========================================================
   AMBIL DATA PENDAFTAR
========================================================= */

$query = mysqli_query(
    $koneksi,
    "SELECT *
     FROM pendaftaran
     WHERE id_pendaftaran = '$id'"
);


if (!$query || mysqli_num_rows($query) == 0) {

    echo "<script>

        alert('Data pendaftaran tidak ditemukan.');

        window.location='pendaftaran_admin.php';

    </script>";

    exit;
}


$data = mysqli_fetch_assoc($query);


/* =========================================================
   STATUS
========================================================= */

$status = !empty($data['status'])
    ? trim($data['status'])
    : 'Menunggu';


$status_lower = strtolower($status);


if ($status_lower == 'diterima') {

    $status = 'Diterima';

    $class_status = 'status-diterima';

    $icon_status = 'glyphicon-ok';

} elseif ($status_lower == 'ditolak') {

    $status = 'Ditolak';

    $class_status = 'status-ditolak';

    $icon_status = 'glyphicon-remove';

} else {

    $status = 'Menunggu';

    $class_status = 'status-menunggu';

    $icon_status = 'glyphicon-time';

}


/* =========================================================
   FUNGSI DOKUMEN
========================================================= */

function dokumen($nama)
{

    if (empty($nama)) {

        return '
        <span class="text-muted">
            Tidak ada dokumen
        </span>';

    }


    return '
    <a
        href="../uploads/ppdb/' . rawurlencode($nama) . '"
        target="_blank"
        class="btn btn-info btn-sm">

        <span class="glyphicon glyphicon-file"></span>
        Lihat Dokumen

    </a>';

}

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="utf-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1">

    <title>
        Detail Pendaftaran - MTs Nurul Huda
    </title>


    <!-- BOOTSTRAP 3 -->

    <link
        href="../bootstrap/css/bootstrap.min.css"
        rel="stylesheet">


    <style>

        /* =====================================================
           BODY
        ===================================================== */

        body {

            background: #f4f6f8;

            padding-top: 30px;

            padding-bottom: 30px;

            color: #333;

            font-family: Arial, sans-serif;

        }


        /* =====================================================
           CONTAINER
        ===================================================== */

        .container-detail {

            padding-top: 10px;

            padding-bottom: 30px;

        }


        /* =====================================================
           HEADER
        ===================================================== */

        .page-header-custom {

            background: linear-gradient(
                135deg,
                #176b3a,
                #2e8b57
            );

            color: #fff;

            padding: 25px;

            border-radius: 12px;

            margin-bottom: 20px;

            box-shadow:
                0 5px 15px
                rgba(0,0,0,.10);

        }


        .page-header-custom h2 {

            margin: 0 0 8px;

            font-size: 26px;

            font-weight: bold;

        }


        .page-header-custom p {

            margin: 0;

            opacity: .9;

        }


        /* =====================================================
           NOMOR PENDAFTARAN
        ===================================================== */

        .registration-number {

            background: #fff;

            border-radius: 10px;

            padding: 20px;

            margin-bottom: 20px;

            box-shadow:
                0 3px 12px
                rgba(0,0,0,.07);

        }


        .registration-number strong {

            color: #777;

            font-size: 13px;

        }


        .registration-number .number {

            display: block;

            margin-top: 5px;

            font-size: 22px;

            font-weight: bold;

            color: #2e7d32;

            word-break: break-word;

        }


        /* =====================================================
           STATUS
        ===================================================== */

        .status-badge {

            display: inline-block;

            margin-top: 10px;

            padding: 7px 15px;

            border-radius: 20px;

            font-size: 12px;

            font-weight: bold;

        }


        .status-menunggu {

            background: #fff3cd;

            color: #856404;

        }


        .status-diterima {

            background: #d4edda;

            color: #155724;

        }


        .status-ditolak {

            background: #f8d7da;

            color: #721c24;

        }


        /* =====================================================
           ALASAN DITOLAK
        ===================================================== */

        .alasan-ditolak {

            margin-top: 15px;

            padding: 15px;

            background: #fff5f5;

            border-left: 4px solid #d9534f;

            border-radius: 5px;

            color: #721c24;

            word-break: break-word;

        }


        .alasan-ditolak strong {

            display: block;

            margin-bottom: 6px;

        }


        /* =====================================================
           DETAIL PANEL
        ===================================================== */

        .detail-panel {

            background: #fff;

            border-radius: 10px;

            margin-bottom: 20px;

            overflow: hidden;

            box-shadow:
                0 3px 12px
                rgba(0,0,0,.07);

        }


        .detail-heading {

            padding: 17px 20px;

            background: #f8faf9;

            border-bottom: 1px solid #eee;

            font-size: 18px;

            font-weight: bold;

            color: #2e7d32;

        }


        .detail-body {

            padding: 20px;

        }


        /* =====================================================
           DATA
        ===================================================== */

        .data-row {

            padding: 11px 0;

            border-bottom: 1px solid #eee;

            min-height: 55px;

        }


        .data-row:last-child {

            border-bottom: none;

        }


        .data-label {

            font-weight: bold;

            color: #777;

            margin-bottom: 5px;

        }


        .data-value {

            color: #333;

            word-break: break-word;

        }


        /* =====================================================
           FOTO
        ===================================================== */

        .foto-container {

            text-align: center;

            margin-bottom: 20px;

        }


        .foto-container img {

            width: 150px;

            height: 190px;

            object-fit: cover;

            border-radius: 8px;

            border: 4px solid #f1f1f1;

            box-shadow:
                0 3px 10px
                rgba(0,0,0,.12);

            max-width: 100%;

        }


        /* =====================================================
           AKSI
        ===================================================== */

        .action-area {

            background: #fff;

            padding: 20px;

            border-radius: 10px;

            box-shadow:
                0 3px 12px
                rgba(0,0,0,.07);

            margin-bottom: 20px;

        }


        .action-title {

            margin-top: 0;

            margin-bottom: 15px;

            color: #2e7d32;

            font-weight: bold;

        }


        .current-status {

            margin-bottom: 15px;

            color: #666;

        }


        .current-status .label {

            display: inline-block;

            margin-left: 5px;

            padding: 6px 10px;

            font-size: 12px;

        }


        .action-area hr {

            border-top: 1px solid #eee;

            margin: 15px 0;

        }


        .action-area .btn {

            margin-right: 7px;

            margin-bottom: 7px;

        }


        /* =====================================================
           MODAL
        ===================================================== */

        .modal-header {

            background: #d9534f;

            color: #fff;

        }


        .modal-header .close {

            color: #fff;

            opacity: 1;

        }


        /* =====================================================
           RESPONSIVE HP
        ===================================================== */

        @media (max-width: 767px) {

            body {

                padding-top: 15px;

                padding-bottom: 15px;

            }


            .container-detail {

                padding-left: 10px;

                padding-right: 10px;

                padding-top: 0;

            }


            .page-header-custom {

                padding: 20px 15px;

                text-align: center;

                border-radius: 10px;

            }


            .page-header-custom h2 {

                font-size: 21px;

                line-height: 1.4;

            }


            .page-header-custom p {

                font-size: 13px;

            }


            .registration-number {

                text-align: center;

                padding: 17px 15px;

            }


            .registration-number .number {

                font-size: 18px;

            }


            .detail-heading {

                font-size: 16px;

                padding: 15px;

            }


            .detail-body {

                padding: 15px;

            }


            .data-row {

                padding: 10px 0;

            }


            .foto-container img {

                width: 130px;

                height: 165px;

            }


            .action-area {

                padding: 15px;

            }


            .action-title {

                font-size: 17px;

            }


            .action-area .btn {

                display: block;

                width: 100%;

                margin-right: 0;

                margin-bottom: 10px;

            }


            .current-status {

                text-align: center;

            }


            .modal-dialog {

                margin: 10px;

            }

        }


        /* =====================================================
           RESPONSIVE TABLET
        ===================================================== */

        @media (min-width: 768px) and (max-width: 991px) {

            .page-header-custom h2 {

                font-size: 23px;

            }

            .detail-body {

                padding: 18px;

            }

        }

    </style>

</head>


<body>


<div class="container container-detail">


    <!-- =====================================================
         HEADER
    ====================================================== -->

    <div class="page-header-custom">

        <h2>

            <span class="glyphicon glyphicon-list-alt"></span>

            Detail Pendaftaran PPDB

        </h2>

        <p>

            MTs Nurul Huda Pematang Cengal

        </p>

    </div>



    <!-- =====================================================
         NOMOR PENDAFTARAN
    ====================================================== -->

    <div class="registration-number">

        <strong>

            NOMOR PENDAFTARAN

        </strong>


        <span class="number">

            <?php

            echo e(
                $data['no_pendaftaran']
            );

            ?>

        </span>


        <!-- STATUS -->

        <span
            class="status-badge <?php echo $class_status; ?>">

            <span
                class="glyphicon <?php echo $icon_status; ?>">
            </span>

            <?php echo e($status); ?>

        </span>


        <!-- ALASAN DITOLAK -->

        <?php if ($status == 'Ditolak') { ?>

            <div class="alasan-ditolak">

                <strong>

                    <span
                        class="glyphicon glyphicon-info-sign">
                    </span>

                    Alasan Penolakan

                </strong>


                <?php

                if (!empty($data['alasan_ditolak'])) {

                    echo nl2br(
                        e($data['alasan_ditolak'])
                    );

                } else {

                    echo 'Tidak ada alasan penolakan.';

                }

                ?>

            </div>

        <?php } ?>

    </div>



    <!-- =====================================================
         DATA CALON SISWA
    ====================================================== -->

    <div class="detail-panel">


        <div class="detail-heading">

            <span class="glyphicon glyphicon-user"></span>

            Data Calon Siswa

        </div>


        <div class="detail-body">


            <div class="row">


                <!-- FOTO -->

                <div class="col-md-3 col-sm-4">

                    <div class="foto-container">


                        <?php if (!empty($data['foto'])) { ?>


                            <img
                                src="../uploads/ppdb/<?php
                                echo rawurlencode(
                                    $data['foto']
                                );
                                ?>"
                                alt="Foto Calon Siswa">


                        <?php } else { ?>


                            <div class="alert alert-warning">

                                Foto tidak tersedia.

                            </div>


                        <?php } ?>


                    </div>

                </div>



                <!-- DATA SISWA -->

                <div class="col-md-9 col-sm-8">

                    <div class="row">


                        <?php

                        $siswa = array(

                            'Nama Lengkap'
                                => 'nama_lengkap',

                            'NIK'
                                => 'nik',

                            'NISN'
                                => 'nisn',

                            'Tempat Lahir'
                                => 'tempat_lahir',

                            'Tanggal Lahir'
                                => 'tanggal_lahir',

                            'Jenis Kelamin'
                                => 'jenis_kelamin',

                            'Agama'
                                => 'agama',

                            'Nomor HP'
                                => 'no_hp',

                            'Asal Sekolah'
                                => 'asal_sekolah',

                            'Tahun Lulus'
                                => 'tahun_lulus'

                        );


                        foreach (
                            $siswa
                            as $label => $field
                        ) {

                        ?>

                            <div class="col-sm-6">

                                <div class="data-row">

                                    <div class="data-label">

                                        <?php
                                        echo $label;
                                        ?>

                                    </div>


                                    <div class="data-value">

                                        <?php

                                        echo e(
                                            $data[$field]
                                            ?? '-'
                                        );

                                        ?>

                                    </div>

                                </div>

                            </div>

                        <?php } ?>


                        <div class="col-md-12">

                            <div class="data-row">

                                <div class="data-label">

                                    Alamat

                                </div>


                                <div class="data-value">

                                    <?php

                                    echo nl2br(
                                        e(
                                            $data['alamat']
                                            ?? '-'
                                        )
                                    );

                                    ?>

                                </div>

                            </div>

                        </div>


                    </div>

                </div>


            </div>

        </div>

    </div>



    <!-- =====================================================
         DATA AYAH
    ====================================================== -->

    <div class="detail-panel">


        <div class="detail-heading">

            <span class="glyphicon glyphicon-user"></span>

            Data Ayah

        </div>


        <div class="detail-body">

            <div class="row">


                <?php

                $ayah = array(

                    'Nama Ayah'
                        => 'nama_ayah',

                    'NIK Ayah'
                        => 'nik_ayah',

                    'Pekerjaan Ayah'
                        => 'pekerjaan_ayah',

                    'Nomor HP Ayah'
                        => 'no_hp_ayah'

                );


                foreach (
                    $ayah
                    as $label => $field
                ) {

                ?>

                    <div class="col-md-6">

                        <div class="data-row">

                            <div class="data-label">

                                <?php echo $label; ?>

                            </div>


                            <div class="data-value">

                                <?php

                                echo e(
                                    $data[$field]
                                    ?? '-'
                                );

                                ?>

                            </div>

                        </div>

                    </div>

                <?php } ?>


            </div>

        </div>

    </div>



    <!-- =====================================================
         DATA IBU
    ====================================================== -->

    <div class="detail-panel">


        <div class="detail-heading">

            <span class="glyphicon glyphicon-user"></span>

            Data Ibu

        </div>


        <div class="detail-body">

            <div class="row">


                <?php

                $ibu = array(

                    'Nama Ibu'
                        => 'nama_ibu',

                    'NIK Ibu'
                        => 'nik_ibu',

                    'Pekerjaan Ibu'
                        => 'pekerjaan_ibu',

                    'Nomor HP Ibu'
                        => 'no_hp_ibu'

                );


                foreach (
                    $ibu
                    as $label => $field
                ) {

                ?>

                    <div class="col-md-6">

                        <div class="data-row">

                            <div class="data-label">

                                <?php echo $label; ?>

                            </div>


                            <div class="data-value">

                                <?php

                                echo e(
                                    $data[$field]
                                    ?? '-'
                                );

                                ?>

                            </div>

                        </div>

                    </div>

                <?php } ?>


            </div>

        </div>

    </div>



    <!-- =====================================================
         DOKUMEN
    ====================================================== -->

    <div class="detail-panel">


        <div class="detail-heading">

            <span class="glyphicon glyphicon-folder-open"></span>

            Dokumen Persyaratan

        </div>


        <div class="detail-body">

            <div class="row">


                <?php

                $dokumen_list = array(

                    'Surat Kelulusan'
                        => 'dokumen_surat_kelulusan',

                    'SKHU SD/MI'
                        => 'dokumen_skhu',

                    'Akte Kelahiran'
                        => 'dokumen_akte_kelahiran',

                    'Kartu Keluarga'
                        => 'dokumen_kartu_keluarga',

                    'KTP Ayah'
                        => 'dokumen_ktp_ayah',

                    'KTP Ibu'
                        => 'dokumen_ktp_ibu',

                    'Kartu PKH'
                        => 'dokumen_pkh',

                    'Kartu KKS'
                        => 'dokumen_kks',

                    'Kartu KIP'
                        => 'dokumen_kip'

                );


                foreach (
                    $dokumen_list
                    as $label => $field
                ) {

                ?>

                    <div class="col-md-6">

                        <div class="data-row">

                            <div class="data-label">

                                <?php echo $label; ?>

                            </div>


                            <div class="data-value">

                                <?php

                                echo dokumen(
                                    $data[$field]
                                    ?? ''
                                );

                                ?>

                            </div>

                        </div>

                    </div>

                <?php } ?>


            </div>

        </div>

    </div>



    <!-- =====================================================
         AKSI PENDAFTARAN
    ====================================================== -->

    <div class="action-area">


        <h4 class="action-title">

            <span class="glyphicon glyphicon-cog"></span>

            Aksi Pendaftaran

        </h4>


        <div class="current-status">

            Status Saat Ini:

            <?php if ($status == 'Diterima') { ?>

                <span class="label label-success">

                    <span class="glyphicon glyphicon-ok"></span>

                    Diterima

                </span>


            <?php } elseif ($status == 'Ditolak') { ?>

                <span class="label label-danger">

                    <span class="glyphicon glyphicon-remove"></span>

                    Ditolak

                </span>


            <?php } else { ?>

                <span class="label label-warning">

                    <span class="glyphicon glyphicon-time"></span>

                    Menunggu

                </span>

            <?php } ?>

        </div>


        <hr>


        <!-- =================================================
             TOMBOL TERIMA
        ================================================== -->

        <form
            method="POST"
            style="display:inline;">

            <input
                type="hidden"
                name="aksi"
                value="terima">

            <button
                type="submit"
                class="btn btn-success"
                onclick="return confirm('Yakin ingin menerima pendaftaran ini?');">

                <span class="glyphicon glyphicon-ok"></span>

                Terima Pendaftaran

            </button>

        </form>



        <!-- =================================================
             TOMBOL TOLAK
        ================================================== -->

        <button
            type="button"
            class="btn btn-danger"
            data-toggle="modal"
            data-target="#modalTolak">

            <span class="glyphicon glyphicon-remove"></span>

            Tolak Pendaftaran

        </button>



        <!-- =================================================
             TOMBOL KEMBALIKAN MENUNGGU
        ================================================== -->

        <form
            method="POST"
            style="display:inline;">

            <input
                type="hidden"
                name="aksi"
                value="menunggu">

            <button
                type="submit"
                class="btn btn-warning"
                onclick="return confirm('Yakin ingin mengembalikan status menjadi Menunggu?');">

                <span class="glyphicon glyphicon-time"></span>

                Kembalikan ke Menunggu

            </button>

        </form>



        <!-- =================================================
             KEMBALI
        ================================================== -->

        <a
            href="pendaftaran_admin.php"
            class="btn btn-default">

            <span class="glyphicon glyphicon-arrow-left"></span>

            Kembali

        </a>



        <!-- =================================================
             CETAK
        ================================================== -->

        <a
            href="cetak_pendaftaran.php?id=<?php echo $id; ?>"
            target="_blank"
            class="btn btn-primary">

            <span class="glyphicon glyphicon-print"></span>

            Cetak Bukti Pendaftaran

        </a>


    </div>


</div>



<!-- =========================================================
     MODAL TOLAK
========================================================= -->

<div
    class="modal fade"
    id="modalTolak"
    tabindex="-1"
    role="dialog">


    <div
        class="modal-dialog"
        role="document">


        <div class="modal-content">


            <form
                method="POST">


                <!-- HEADER MODAL -->

                <div class="modal-header">

                    <button
                        type="button"
                        class="close"
                        data-dismiss="modal">

                        <span>&times;</span>

                    </button>


                    <h4 class="modal-title">

                        <span class="glyphicon glyphicon-remove"></span>

                        Tolak Pendaftaran

                    </h4>

                </div>



                <!-- BODY MODAL -->

                <div class="modal-body">


                    <input
                        type="hidden"
                        name="aksi"
                        value="tolak">


                    <div class="form-group">

                        <label>

                            Alasan Penolakan

                        </label>


                        <textarea
                            name="alasan_ditolak"
                            class="form-control"
                            rows="5"
                            placeholder="Masukkan alasan penolakan..."
                            required></textarea>

                    </div>


                </div>



                <!-- FOOTER MODAL -->

                <div class="modal-footer">


                    <button
                        type="button"
                        class="btn btn-default"
                        data-dismiss="modal">

                        Batal

                    </button>


                    <button
                        type="submit"
                        class="btn btn-danger">

                        <span class="glyphicon glyphicon-remove"></span>

                        Tolak Pendaftaran

                    </button>


                </div>


            </form>


        </div>

    </div>

</div>



<!-- =========================================================
     JAVASCRIPT BOOTSTRAP 3
========================================================= -->

<script src="../bootstrap/js/jquery.min.js"></script>

<script src="../bootstrap/js/bootstrap.min.js"></script>


</body>

</html>