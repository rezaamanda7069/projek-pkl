<?php

session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

include "../koneksi.php";


/* =========================================================
   HAPUS DATA PENDAFTARAN + FILE UPLOAD
========================================================= */

if (isset($_GET['hapus'])) {

    $id = intval($_GET['hapus']);

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
         WHERE id_pendaftaran = '$id'"
    );

    if (!$query_file) {
        die("Gagal mengambil data file: " . mysqli_error($koneksi));
    }

    $data_file = mysqli_fetch_assoc($query_file);

    if ($data_file) {

        $folder_upload =
            dirname(__DIR__) .
            DIRECTORY_SEPARATOR .
            "uploads" .
            DIRECTORY_SEPARATOR .
            "ppdb" .
            DIRECTORY_SEPARATOR;

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

        foreach ($daftar_file as $nama_file) {

            if (!empty($nama_file)) {

                $nama_file = basename($nama_file);

                $path_file =
                    $folder_upload .
                    $nama_file;

                if (is_file($path_file)) {
                    unlink($path_file);
                }
            }
        }

        $hapus_data = mysqli_query(
            $koneksi,
            "DELETE FROM pendaftaran
             WHERE id_pendaftaran = '$id'"
        );

        if (!$hapus_data) {
            die(
                "Data gagal dihapus dari database: " .
                mysqli_error($koneksi)
            );
        }
    }

    header("Location: pendaftaran_admin.php?pesan=hapus");
    exit;
}


/* =========================================================
   UPDATE STATUS
========================================================= */

if (
    isset($_GET['status']) &&
    isset($_GET['id'])
) {

    $id = intval($_GET['id']);

    $status = mysqli_real_escape_string(
        $koneksi,
        $_GET['status']
    );

    $status_valid = array(
        "Menunggu",
        "Diterima",
        "Ditolak"
    );

    if (in_array($status, $status_valid)) {

        mysqli_query(
            $koneksi,
            "UPDATE pendaftaran
             SET status='$status'
             WHERE id_pendaftaran='$id'"
        );
    }

    $parameter = array();

    if (
        isset($_GET['cari']) &&
        trim($_GET['cari']) != ""
    ) {

        $parameter['cari'] = $_GET['cari'];
    }

    if (
        isset($_GET['filter_status']) &&
        $_GET['filter_status'] != ""
    ) {

        $parameter['filter_status'] =
            $_GET['filter_status'];
    }

    $redirect = "pendaftaran_admin.php";

    if (count($parameter) > 0) {

        $redirect .=
            "?" .
            http_build_query($parameter);
    }

    header("Location: " . $redirect);
    exit;
}


/* =========================================================
   PESAN
========================================================= */

$pesan = "";

if (isset($_GET['pesan'])) {

    if ($_GET['pesan'] == "hapus") {

        $pesan =
            "Data pendaftaran dan semua file dokumen berhasil dihapus.";
    }
}


/* =========================================================
   PENCARIAN
========================================================= */

$where = array();

if (
    isset($_GET['cari']) &&
    trim($_GET['cari']) != ""
) {

    $cari = mysqli_real_escape_string(
        $koneksi,
        trim($_GET['cari'])
    );

    $where[] = "
        (
            nama_lengkap LIKE '%$cari%'
            OR nisn LIKE '%$cari%'
            OR no_pendaftaran LIKE '%$cari%'
            OR asal_sekolah LIKE '%$cari%'
        )
    ";
}


/* =========================================================
   FILTER STATUS
========================================================= */

$status_filter = "";

if (
    isset($_GET['filter_status']) &&
    $_GET['filter_status'] != ""
) {

    $status_filter = mysqli_real_escape_string(
        $koneksi,
        $_GET['filter_status']
    );

    $status_valid = array(
        "Menunggu",
        "Diterima",
        "Ditolak"
    );

    if (in_array($status_filter, $status_valid)) {

        if ($status_filter == "Menunggu") {

            $where[] = "
                (
                    status='Menunggu'
                    OR status IS NULL
                    OR status=''
                )
            ";

        } else {

            $where[] =
                "status='$status_filter'";
        }

    } else {

        $status_filter = "";
    }
}


/* =========================================================
   WHERE SQL
========================================================= */

$where_sql = "";

if (count($where) > 0) {

    $where_sql =
        "WHERE " .
        implode(" AND ", $where);
}


/* =========================================================
   QUERY DATA
========================================================= */

$query = mysqli_query(
    $koneksi,
    "SELECT *
     FROM pendaftaran
     $where_sql
     ORDER BY id_pendaftaran DESC"
);

if (!$query) {

    die(
        "Query error: " .
        mysqli_error($koneksi)
    );
}


/* =========================================================
   TOTAL PENDAFTAR
========================================================= */

$total_query = mysqli_query(
    $koneksi,
    "SELECT COUNT(*) AS total
     FROM pendaftaran"
);

$total_data = mysqli_fetch_assoc($total_query);

$total_pendaftar =
    $total_data['total'];


/* =========================================================
   TOTAL MENUNGGU
========================================================= */

$menunggu_query = mysqli_query(
    $koneksi,
    "SELECT COUNT(*) AS total
     FROM pendaftaran
     WHERE status='Menunggu'
     OR status IS NULL
     OR status=''"
);

$data_menunggu =
    mysqli_fetch_assoc($menunggu_query);

$total_menunggu =
    $data_menunggu['total'];


/* =========================================================
   TOTAL DITERIMA
========================================================= */

$diterima_query = mysqli_query(
    $koneksi,
    "SELECT COUNT(*) AS total
     FROM pendaftaran
     WHERE status='Diterima'"
);

$data_diterima =
    mysqli_fetch_assoc($diterima_query);

$total_diterima =
    $data_diterima['total'];


/* =========================================================
   TOTAL DITOLAK
========================================================= */

$ditolak_query = mysqli_query(
    $koneksi,
    "SELECT COUNT(*) AS total
     FROM pendaftaran
     WHERE status='Ditolak'"
);

$data_ditolak =
    mysqli_fetch_assoc($ditolak_query);

$total_ditolak =
    $data_ditolak['total'];

?>

<!DOCTYPE html>

<html lang="id">

<head>

<meta charset="utf-8">

<meta
    name="viewport"
    content="width=device-width, initial-scale=1"
>

<title>Pendaftaran PPDB - Admin</title>

<link
    href="../bootstrap/css/bootstrap.min.css"
    rel="stylesheet"
>


<style>

/* =========================================================
   BODY
========================================================= */

html,
body {

    margin:0;

    padding:0;

    background:#f4f6f8;

    font-family:Arial, sans-serif;

    color:#333;

}


/* =========================================================
   KONTEN UTAMA
   SIDEBAR = ±230px
========================================================= */

.main-content {

    margin-left:230px;

    padding:25px;

    min-height:100vh;

    box-sizing:border-box;

}


/* =========================================================
   HEADER
========================================================= */

.page-header-custom {

    background:linear-gradient(
        135deg,
        #176b3a,
        #2e8b57
    );

    color:#fff;

    padding:25px 28px;

    border-radius:10px;

    margin-bottom:20px;

    box-shadow:
    0 3px 10px
    rgba(0,0,0,.08);

}


.page-header-custom h2 {

    margin:0 0 8px 0;

    font-size:25px;

    font-weight:bold;

}


.page-header-custom p {

    margin:0;

    font-size:14px;

    opacity:.92;

}


/* =========================================================
   PESAN
========================================================= */

.alert-pesan {

    border-radius:7px;

    margin-bottom:20px;

}


/* =========================================================
   STATISTIK
========================================================= */

.stat-box {

    background:#fff;

    border-radius:9px;

    padding:17px;

    margin-bottom:20px;

    min-height:92px;

    box-shadow:
    0 2px 8px
    rgba(0,0,0,.06);

}


.stat-icon {

    width:46px;

    height:46px;

    line-height:46px;

    text-align:center;

    border-radius:8px;

    color:#fff;

    font-size:19px;

    float:left;

    margin-right:12px;

}


.stat-number {

    font-size:25px;

    font-weight:bold;

    line-height:28px;

}


.stat-title {

    color:#777;

    font-size:12px;

    margin-top:4px;

}


.icon-total {

    background:#3498db;

}


.icon-menunggu {

    background:#f39c12;

}


.icon-diterima {

    background:#27ae60;

}


.icon-ditolak {

    background:#e74c3c;

}


/* =========================================================
   CARD DATA
========================================================= */

.content-card {

    background:#fff;

    border-radius:10px;

    box-shadow:
    0 2px 10px
    rgba(0,0,0,.06);

    overflow:hidden;

}


.content-heading {

    padding:17px 20px;

    border-bottom:1px solid #eee;

}


.content-heading h4 {

    margin:0;

    font-size:18px;

    font-weight:bold;

    color:#333;

}


.content-body {

    padding:20px;

}


/* =========================================================
   FILTER
========================================================= */

.filter-box {

    background:#f8faf9;

    border:1px solid #e7ece9;

    padding:17px;

    border-radius:8px;

    margin-bottom:18px;

}


.filter-box label {

    font-size:11px;

    font-weight:bold;

    color:#666;

    margin-bottom:6px;

}


.filter-box .form-control {

    height:36px;

}


.filter-button {

    padding-top:22px;

}


/* =========================================================
   INFORMASI FILTER
========================================================= */

.filter-info {

    border-radius:6px;

    font-size:13px;

}


/* =========================================================
   TABEL
========================================================= */

.table-responsive {

    width:100%;

    overflow-x:auto;

    border:1px solid #ddd;

    border-radius:6px;

}


.table {

    margin-bottom:0;

    min-width:1050px;

}


.table > thead > tr > th {

    background:#e8f5e9;

    color:#333;

    border-bottom:2px solid #c8dfca;

    font-size:12px;

    font-weight:bold;

    white-space:nowrap;

    text-align:center;

    vertical-align:middle;

    padding:11px 10px;

}


.table > tbody > tr > td {

    font-size:13px;

    vertical-align:middle;

    padding:10px;

}


.table-hover > tbody > tr:hover {

    background:#f8fbf9;

}


/* =========================================================
   NOMOR PENDAFTARAN
========================================================= */

.no-pendaftaran {

    color:#176b3a;

    font-weight:bold;

    white-space:nowrap;

}


/* =========================================================
   STATUS
========================================================= */

.status {

    display:inline-block;

    padding:6px 10px;

    border-radius:20px;

    font-size:10px;

    font-weight:bold;

    white-space:nowrap;

}


.status-menunggu {

    background:#fff3cd;

    color:#856404;

}


.status-diterima {

    background:#d4edda;

    color:#155724;

}


.status-ditolak {

    background:#f8d7da;

    color:#721c24;

}


/* =========================================================
   AKSI
========================================================= */

.aksi {

    white-space:nowrap;

    text-align:center;

}


.btn-action {

    margin:2px;

    border-radius:4px;

}


/* =========================================================
   DATA KOSONG
========================================================= */

.empty-data {

    text-align:center;

    padding:50px 20px !important;

    color:#888;

}


.empty-data .glyphicon {

    font-size:35px;

    color:#bbb;

    margin-bottom:12px;

}


/* =========================================================
   RESPONSIVE TABLET
========================================================= */

@media(max-width:991px) {

    .main-content {

        margin-left:230px;

        padding:20px;

    }


    .page-header-custom {

        padding:22px;

    }


    .page-header-custom h2 {

        font-size:22px;

    }


    .filter-button {

        padding-top:0;

    }

}


/* =========================================================
   RESPONSIVE HP
========================================================= */

@media(max-width:767px) {

    .main-content {

        margin-left:0;

        padding:15px;

        padding-top:15px;

    }


    .page-header-custom {

        padding:20px 17px;

        border-radius:8px;

    }


    .page-header-custom h2 {

        font-size:20px;

    }


    .page-header-custom p {

        font-size:12px;

        line-height:20px;

    }


    .content-body {

        padding:15px;

    }


    .content-heading {

        padding:15px;

    }


    .content-heading h4 {

        font-size:16px;

    }


    .stat-box {

        margin-bottom:12px;

    }


    .filter-box {

        padding:12px;

    }


    .filter-button {

        margin-top:5px;

    }


    .filter-button .btn {

        margin-bottom:5px;

    }

}


/* =========================================================
   HP SANGAT KECIL
========================================================= */

@media(max-width:480px) {

    .main-content {

        padding:10px;

    }


    .page-header-custom {

        padding:17px 14px;

    }


    .page-header-custom h2 {

        font-size:18px;

    }


    .content-body {

        padding:10px;

    }


    .stat-box {

        padding:14px;

    }

}

</style>

</head>


<body>


<?php include "navbar_admin.php"; ?>


<!-- =====================================================
     KONTEN UTAMA
===================================================== -->

<div class="main-content">


    <!-- HEADER -->

    <div class="page-header-custom">

        <h2>

            <span class="glyphicon glyphicon-list-alt"></span>

            Pendaftaran PPDB

        </h2>

        <p>

            Kelola dan verifikasi data calon siswa
            yang melakukan pendaftaran secara online.

        </p>

    </div>


    <!-- PESAN -->

    <?php if ($pesan != "") { ?>

        <div class="alert alert-success alert-pesan">

            <span class="glyphicon glyphicon-ok"></span>

            <?php
            echo htmlspecialchars($pesan);
            ?>

        </div>

    <?php } ?>


    <!-- =================================================
         STATISTIK
    ================================================== -->

    <div class="row">


        <div class="col-xs-12 col-sm-6 col-md-3">

            <div class="stat-box">

                <div class="stat-icon icon-total">

                    <span class="glyphicon glyphicon-user"></span>

                </div>

                <div class="stat-number">

                    <?php
                    echo $total_pendaftar;
                    ?>

                </div>

                <div class="stat-title">

                    Total Pendaftar

                </div>

                <div style="clear:both;"></div>

            </div>

        </div>


        <div class="col-xs-12 col-sm-6 col-md-3">

            <div class="stat-box">

                <div class="stat-icon icon-menunggu">

                    <span class="glyphicon glyphicon-time"></span>

                </div>

                <div class="stat-number">

                    <?php
                    echo $total_menunggu;
                    ?>

                </div>

                <div class="stat-title">

                    Menunggu Verifikasi

                </div>

                <div style="clear:both;"></div>

            </div>

        </div>


        <div class="col-xs-12 col-sm-6 col-md-3">

            <div class="stat-box">

                <div class="stat-icon icon-diterima">

                    <span class="glyphicon glyphicon-ok"></span>

                </div>

                <div class="stat-number">

                    <?php
                    echo $total_diterima;
                    ?>

                </div>

                <div class="stat-title">

                    Diterima

                </div>

                <div style="clear:both;"></div>

            </div>

        </div>


        <div class="col-xs-12 col-sm-6 col-md-3">

            <div class="stat-box">

                <div class="stat-icon icon-ditolak">

                    <span class="glyphicon glyphicon-remove"></span>

                </div>

                <div class="stat-number">

                    <?php
                    echo $total_ditolak;
                    ?>

                </div>

                <div class="stat-title">

                    Ditolak

                </div>

                <div style="clear:both;"></div>

            </div>

        </div>


    </div>


    <!-- =================================================
         DATA PENDAFTAR
    ================================================== -->

    <div class="content-card">


        <div class="content-heading">

            <h4>

                <span class="glyphicon glyphicon-list"></span>

                Daftar Calon Siswa

            </h4>

        </div>


        <div class="content-body">


            <!-- FILTER -->

            <div class="filter-box">

                <form method="GET">

                    <div class="row">


                        <!-- PENCARIAN -->

                        <div class="col-md-6">

                            <div class="form-group">

                                <label>PENCARIAN</label>

                                <div class="input-group">

                                    <input
                                        type="text"
                                        name="cari"
                                        class="form-control"
                                        placeholder="Nama, NISN, nomor pendaftaran, atau asal sekolah..."
                                        value="<?php

                                        echo isset($_GET['cari'])
                                            ?
                                            htmlspecialchars(
                                                $_GET['cari']
                                            )
                                            :
                                            '';

                                        ?>"
                                    >

                                    <span class="input-group-btn">

                                        <button
                                            type="submit"
                                            class="btn btn-success"
                                        >

                                            <span class="glyphicon glyphicon-search"></span>

                                            Cari

                                        </button>

                                    </span>

                                </div>

                            </div>

                        </div>


                        <!-- STATUS -->

                        <div class="col-md-3">

                            <div class="form-group">

                                <label>FILTER STATUS</label>

                                <select
                                    name="filter_status"
                                    class="form-control"
                                >

                                    <option value="">
                                        Semua Status
                                    </option>

                                    <option
                                        value="Menunggu"
                                        <?php

                                        if (
                                            $status_filter ==
                                            "Menunggu"
                                        ) {
                                            echo "selected";
                                        }

                                        ?>
                                    >
                                        Menunggu
                                    </option>

                                    <option
                                        value="Diterima"
                                        <?php

                                        if (
                                            $status_filter ==
                                            "Diterima"
                                        ) {
                                            echo "selected";
                                        }

                                        ?>
                                    >
                                        Diterima
                                    </option>

                                    <option
                                        value="Ditolak"
                                        <?php

                                        if (
                                            $status_filter ==
                                            "Ditolak"
                                        ) {
                                            echo "selected";
                                        }

                                        ?>
                                    >
                                        Ditolak
                                    </option>

                                </select>

                            </div>

                        </div>


                        <!-- BUTTON -->

                        <div class="col-md-3">

                            <div class="form-group filter-button">

                                <button
                                    type="submit"
                                    class="btn btn-success"
                                >

                                    <span class="glyphicon glyphicon-filter"></span>

                                    Terapkan

                                </button>


                                <a
                                    href="pendaftaran_admin.php"
                                    class="btn btn-default"
                                >

                                    <span class="glyphicon glyphicon-refresh"></span>

                                    Reset

                                </a>

                            </div>

                        </div>


                    </div>

                </form>

            </div>


            <!-- INFORMASI FILTER -->

            <?php

            if (
                $status_filter != "" ||
                (
                    isset($_GET['cari']) &&
                    trim($_GET['cari']) != ""
                )
            ) {

            ?>

                <div class="alert alert-info filter-info">

                    <span class="glyphicon glyphicon-filter"></span>

                    Menampilkan data berdasarkan filter.

                    <?php

                    if (
                        isset($_GET['cari']) &&
                        trim($_GET['cari']) != ""
                    ) {

                    ?>

                        <br>

                        Pencarian:

                        <strong>

                            <?php
                            echo htmlspecialchars(
                                $_GET['cari']
                            );
                            ?>

                        </strong>

                    <?php
                    }


                    if ($status_filter != "") {

                    ?>

                        <br>

                        Status:

                        <strong>

                            <?php
                            echo htmlspecialchars(
                                $status_filter
                            );
                            ?>

                        </strong>

                    <?php
                    }

                    ?>

                </div>

            <?php
            }
            ?>


            <!-- =================================================
                 TABEL
            ================================================== -->

            <div class="table-responsive">

                <table class="table table-bordered table-hover">

                    <thead>

                        <tr>

                            <th width="50">
                                No
                            </th>

                            <th width="150">
                                No. Pendaftaran
                            </th>

                            <th width="190">
                                Nama Calon Siswa
                            </th>

                            <th width="120">
                                NISN
                            </th>

                            <th width="180">
                                Asal Sekolah
                            </th>

                            <th width="120">
                                No. HP
                            </th>

                            <th width="110">
                                Status
                            </th>

                            <th width="220">
                                Aksi
                            </th>

                        </tr>

                    </thead>


                    <tbody>


                    <?php

                    $no = 1;


                    if (
                        mysqli_num_rows($query) > 0
                    ) {


                        while (
                            $data =
                            mysqli_fetch_assoc($query)
                        ) {


                            $status =
                                !empty(
                                    $data['status']
                                )
                                ?
                                $data['status']
                                :
                                "Menunggu";

                    ?>

                        <tr>


                            <!-- NO -->

                            <td class="text-center">

                                <?php
                                echo $no++;
                                ?>

                            </td>


                            <!-- NO PENDAFTARAN -->

                            <td>

                                <span class="no-pendaftaran">

                                    <?php

                                    echo htmlspecialchars(
                                        $data[
                                            'no_pendaftaran'
                                        ]
                                    );

                                    ?>

                                </span>

                            </td>


                            <!-- NAMA -->

                            <td>

                                <strong>

                                    <?php

                                    echo htmlspecialchars(
                                        $data[
                                            'nama_lengkap'
                                        ]
                                    );

                                    ?>

                                </strong>

                            </td>


                            <!-- NISN -->

                            <td>

                                <?php

                                echo htmlspecialchars(
                                    $data['nisn']
                                );

                                ?>

                            </td>


                            <!-- SEKOLAH -->

                            <td>

                                <?php

                                echo htmlspecialchars(
                                    $data[
                                        'asal_sekolah'
                                    ]
                                );

                                ?>

                            </td>


                            <!-- HP -->

                            <td>

                                <?php

                                echo htmlspecialchars(
                                    $data['no_hp']
                                );

                                ?>

                            </td>


                            <!-- STATUS -->

                            <td class="text-center">


                                <?php

                                if (
                                    $status ==
                                    "Diterima"
                                ) {

                                ?>

                                    <span class="status status-diterima">

                                        <span class="glyphicon glyphicon-ok"></span>

                                        Diterima

                                    </span>

                                <?php

                                } elseif (
                                    $status ==
                                    "Ditolak"
                                ) {

                                ?>

                                    <span class="status status-ditolak">

                                        <span class="glyphicon glyphicon-remove"></span>

                                        Ditolak

                                    </span>

                                <?php

                                } else {

                                ?>

                                    <span class="status status-menunggu">

                                        <span class="glyphicon glyphicon-time"></span>

                                        Menunggu

                                    </span>

                                <?php

                                }

                                ?>

                            </td>


                            <!-- AKSI -->

                            <td class="aksi">


                                <!-- DETAIL -->

                                <a
                                    href="detail_pendaftaran_admin.php?id=<?php echo $data['id_pendaftaran']; ?>"
                                    class="btn btn-info btn-sm btn-action"
                                    title="Lihat Detail"
                                >

                                    <span class="glyphicon glyphicon-eye-open"></span>

                                    Detail

                                </a>


                                <!-- TERIMA -->

                                <a
                                    href="pendaftaran_admin.php?status=Diterima&id=<?php echo $data['id_pendaftaran']; ?><?php

                                    if (
                                        isset($_GET['cari']) &&
                                        $_GET['cari'] != ""
                                    ) {

                                        echo "&cari=" .
                                            urlencode(
                                                $_GET['cari']
                                            );
                                    }


                                    if (
                                        isset($_GET['filter_status']) &&
                                        $_GET['filter_status'] != ""
                                    ) {

                                        echo "&filter_status=" .
                                            urlencode(
                                                $_GET['filter_status']
                                            );
                                    }

                                    ?>"
                                    class="btn btn-success btn-sm btn-action"
                                    title="Terima"
                                    onclick="return confirm('Yakin ingin menerima pendaftaran ini?');"
                                >

                                    <span class="glyphicon glyphicon-ok"></span>

                                </a>


                                <!-- TOLAK -->

                                <a
                                    href="pendaftaran_admin.php?status=Ditolak&id=<?php echo $data['id_pendaftaran']; ?><?php

                                    if (
                                        isset($_GET['cari']) &&
                                        $_GET['cari'] != ""
                                    ) {

                                        echo "&cari=" .
                                            urlencode(
                                                $_GET['cari']
                                            );
                                    }


                                    if (
                                        isset($_GET['filter_status']) &&
                                        $_GET['filter_status'] != ""
                                    ) {

                                        echo "&filter_status=" .
                                            urlencode(
                                                $_GET['filter_status']
                                            );
                                    }

                                    ?>"
                                    class="btn btn-warning btn-sm btn-action"
                                    title="Tolak"
                                    onclick="return confirm('Yakin ingin menolak pendaftaran ini?');"
                                >

                                    <span class="glyphicon glyphicon-remove"></span>

                                </a>


                                <!-- HAPUS -->

                                <a
                                    href="pendaftaran_admin.php?hapus=<?php echo $data['id_pendaftaran']; ?>"
                                    class="btn btn-danger btn-sm btn-action"
                                    title="Hapus"
                                    onclick="return confirm('Yakin ingin menghapus data pendaftaran ini? Semua dokumen yang tersimpan di folder uploads/ppdb/ juga akan dihapus.');"
                                >

                                    <span class="glyphicon glyphicon-trash"></span>

                                </a>


                            </td>


                        </tr>


                    <?php

                        }

                    } else {

                    ?>

                        <tr>

                            <td
                                colspan="8"
                                class="empty-data"
                            >

                                <span class="glyphicon glyphicon-folder-open"></span>

                                <br>

                                <strong>
                                    Tidak ada data pendaftaran.
                                </strong>

                                <br>

                                <small>
                                    Belum ada data yang sesuai dengan pencarian atau filter.
                                </small>

                            </td>

                        </tr>

                    <?php

                    }

                    ?>


                    </tbody>

                </table>

            </div>


        </div>

    </div>


</div>


<script src="../bootstrap/js/jquery.min.js"></script>

<script src="../bootstrap/js/bootstrap.min.js"></script>


</body>

</html>