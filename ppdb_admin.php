<?php

session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

include "../koneksi.php";


/* =====================================================
   FUNGSI ESCAPE
===================================================== */

function e($data)
{
    return htmlspecialchars(
        $data ?? '',
        ENT_QUOTES,
        'UTF-8'
    );
}


/* =====================================================
   AMBIL DATA PPDB INFO
===================================================== */

$query_info = mysqli_query(
    $koneksi,
    "SELECT * FROM ppdb_info
     ORDER BY id_ppdb DESC
     LIMIT 1"
);

if (!$query_info) {
    die("Gagal mengambil data PPDB: " . mysqli_error($koneksi));
}

$info = mysqli_fetch_assoc($query_info);

if (!$info) {
    die("Data ppdb_info belum tersedia.");
}


/* =====================================================
   PROSES SEMUA AKSI
===================================================== */

$pesan = "";
$tipe_pesan = "";


/* =====================================================
   UPDATE INFORMASI PPDB
===================================================== */

if (isset($_POST['update_info'])) {

    $id_ppdb = intval($_POST['id_ppdb']);

    $tahun_ajaran = mysqli_real_escape_string(
        $koneksi,
        $_POST['tahun_ajaran']
    );

    $judul_hero = mysqli_real_escape_string(
        $koneksi,
        $_POST['judul_hero']
    );

    $subjudul_hero = mysqli_real_escape_string(
        $koneksi,
        $_POST['subjudul_hero']
    );

    $nama_yayasan = mysqli_real_escape_string(
        $koneksi,
        $_POST['nama_yayasan']
    );

    $periode_pendaftaran = mysqli_real_escape_string(
        $koneksi,
        $_POST['periode_pendaftaran']
    );

    $tingkat_pendidikan = mysqli_real_escape_string(
        $koneksi,
        $_POST['tingkat_pendidikan']
    );

    $biaya_pendidikan = mysqli_real_escape_string(
        $koneksi,
        $_POST['biaya_pendidikan']
    );

    $deskripsi_biaya = mysqli_real_escape_string(
        $koneksi,
        $_POST['deskripsi_biaya']
    );

    $tanggal_pendaftaran = mysqli_real_escape_string(
        $koneksi,
        $_POST['tanggal_pendaftaran']
    );

    $keterangan_jadwal = mysqli_real_escape_string(
        $koneksi,
        $_POST['keterangan_jadwal']
    );

    $judul_persyaratan = mysqli_real_escape_string(
        $koneksi,
        $_POST['judul_persyaratan']
    );

    $judul_alur = mysqli_real_escape_string(
        $koneksi,
        $_POST['judul_alur']
    );

    $judul_biaya = mysqli_real_escape_string(
        $koneksi,
        $_POST['judul_biaya']
    );

    $keterangan_biaya = mysqli_real_escape_string(
        $koneksi,
        $_POST['keterangan_biaya']
    );

    $judul_cta = mysqli_real_escape_string(
        $koneksi,
        $_POST['judul_cta']
    );

    $keterangan_cta = mysqli_real_escape_string(
        $koneksi,
        $_POST['keterangan_cta']
    );

    $status = mysqli_real_escape_string(
        $koneksi,
        $_POST['status']
    );


    $update = mysqli_query(
        $koneksi,
        "UPDATE ppdb_info SET

            tahun_ajaran='$tahun_ajaran',
            judul_hero='$judul_hero',
            subjudul_hero='$subjudul_hero',
            nama_yayasan='$nama_yayasan',
            periode_pendaftaran='$periode_pendaftaran',
            tingkat_pendidikan='$tingkat_pendidikan',
            biaya_pendidikan='$biaya_pendidikan',
            deskripsi_biaya='$deskripsi_biaya',
            tanggal_pendaftaran='$tanggal_pendaftaran',
            keterangan_jadwal='$keterangan_jadwal',
            judul_persyaratan='$judul_persyaratan',
            judul_alur='$judul_alur',
            judul_biaya='$judul_biaya',
            keterangan_biaya='$keterangan_biaya',
            judul_cta='$judul_cta',
            keterangan_cta='$keterangan_cta',
            status='$status'

         WHERE id_ppdb='$id_ppdb'"
    );


    if ($update) {

        $pesan = "Informasi PPDB berhasil diperbarui.";
        $tipe_pesan = "success";

    } else {

        $pesan = "Gagal memperbarui informasi PPDB.";
        $tipe_pesan = "danger";

    }


    /* Ambil ulang data */

    $query_info = mysqli_query(
        $koneksi,
        "SELECT * FROM ppdb_info
         WHERE id_ppdb='$id_ppdb'"
    );

    $info = mysqli_fetch_assoc($query_info);
}


/* =====================================================
   TAMBAH PERSYARATAN
===================================================== */

if (isset($_POST['tambah_persyaratan'])) {

    $persyaratan = mysqli_real_escape_string(
        $koneksi,
        $_POST['persyaratan']
    );

    $keterangan = mysqli_real_escape_string(
        $koneksi,
        $_POST['keterangan']
    );

    $urutan = intval($_POST['urutan']);

    if ($urutan <= 0) {
        $urutan = 1;
    }


    $insert = mysqli_query(
        $koneksi,
        "INSERT INTO ppdb_persyaratan
        (
            persyaratan,
            keterangan,
            urutan,
            status
        )
        VALUES
        (
            '$persyaratan',
            '$keterangan',
            '$urutan',
            'Aktif'
        )"
    );


    if ($insert) {

        $pesan = "Persyaratan berhasil ditambahkan.";
        $tipe_pesan = "success";

    } else {

        $pesan = "Gagal menambahkan persyaratan.";
        $tipe_pesan = "danger";

    }
}


/* =====================================================
   EDIT PERSYARATAN
===================================================== */

if (isset($_POST['edit_persyaratan'])) {

    $id = intval($_POST['id_persyaratan']);

    $persyaratan = mysqli_real_escape_string(
        $koneksi,
        $_POST['persyaratan']
    );

    $keterangan = mysqli_real_escape_string(
        $koneksi,
        $_POST['keterangan']
    );

    $urutan = intval($_POST['urutan']);

    $status = mysqli_real_escape_string(
        $koneksi,
        $_POST['status']
    );


    $update = mysqli_query(
        $koneksi,
        "UPDATE ppdb_persyaratan SET

            persyaratan='$persyaratan',
            keterangan='$keterangan',
            urutan='$urutan',
            status='$status'

         WHERE id_persyaratan='$id'"
    );


    if ($update) {

        $pesan = "Persyaratan berhasil diperbarui.";
        $tipe_pesan = "success";

    } else {

        $pesan = "Gagal memperbarui persyaratan.";
        $tipe_pesan = "danger";

    }
}


/* =====================================================
   HAPUS PERSYARATAN
===================================================== */

if (isset($_GET['hapus_persyaratan'])) {

    $id = intval($_GET['hapus_persyaratan']);


    $hapus = mysqli_query(
        $koneksi,
        "DELETE FROM ppdb_persyaratan
         WHERE id_persyaratan='$id'"
    );


    if ($hapus) {

        $pesan = "Persyaratan berhasil dihapus.";
        $tipe_pesan = "success";

    } else {

        $pesan = "Gagal menghapus persyaratan.";
        $tipe_pesan = "danger";

    }
}


/* =====================================================
   TAMBAH ALUR
===================================================== */

if (isset($_POST['tambah_alur'])) {

    $nomor = intval($_POST['nomor']);

    $judul = mysqli_real_escape_string(
        $koneksi,
        $_POST['judul']
    );

    $keterangan = mysqli_real_escape_string(
        $koneksi,
        $_POST['keterangan']
    );


    $insert = mysqli_query(
        $koneksi,
        "INSERT INTO ppdb_alur
        (
            nomor,
            judul,
            keterangan,
            status
        )
        VALUES
        (
            '$nomor',
            '$judul',
            '$keterangan',
            'Aktif'
        )"
    );


    if ($insert) {

        $pesan = "Alur pendaftaran berhasil ditambahkan.";
        $tipe_pesan = "success";

    } else {

        $pesan = "Gagal menambahkan alur.";
        $tipe_pesan = "danger";

    }
}


/* =====================================================
   EDIT ALUR
===================================================== */

if (isset($_POST['edit_alur'])) {

    $id = intval($_POST['id_alur']);

    $nomor = intval($_POST['nomor']);

    $judul = mysqli_real_escape_string(
        $koneksi,
        $_POST['judul']
    );

    $keterangan = mysqli_real_escape_string(
        $koneksi,
        $_POST['keterangan']
    );

    $status = mysqli_real_escape_string(
        $koneksi,
        $_POST['status']
    );


    $update = mysqli_query(
        $koneksi,
        "UPDATE ppdb_alur SET

            nomor='$nomor',
            judul='$judul',
            keterangan='$keterangan',
            status='$status'

         WHERE id_alur='$id'"
    );


    if ($update) {

        $pesan = "Alur pendaftaran berhasil diperbarui.";
        $tipe_pesan = "success";

    } else {

        $pesan = "Gagal memperbarui alur.";
        $tipe_pesan = "danger";

    }
}


/* =====================================================
   HAPUS ALUR
===================================================== */

if (isset($_GET['hapus_alur'])) {

    $id = intval($_GET['hapus_alur']);


    $hapus = mysqli_query(
        $koneksi,
        "DELETE FROM ppdb_alur
         WHERE id_alur='$id'"
    );


    if ($hapus) {

        $pesan = "Alur pendaftaran berhasil dihapus.";
        $tipe_pesan = "success";

    } else {

        $pesan = "Gagal menghapus alur.";
        $tipe_pesan = "danger";

    }
}


/* =====================================================
   AMBIL DATA PERSYARATAN
===================================================== */

$query_persyaratan = mysqli_query(
    $koneksi,
    "SELECT *
     FROM ppdb_persyaratan
     ORDER BY urutan ASC, id_persyaratan ASC"
);


/* =====================================================
   AMBIL DATA ALUR
===================================================== */

$query_alur = mysqli_query(
    $koneksi,
    "SELECT *
     FROM ppdb_alur
     ORDER BY nomor ASC, id_alur ASC"
);

?>

<!DOCTYPE html>

<html lang="id">

<head>

    <meta charset="utf-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >

    <title>
        Kelola PPDB - MTs Nurul Huda
    </title>


    <link
        href="../bootstrap/css/bootstrap.min.css"
        rel="stylesheet"
    >


    <style>

        body {
            background:#f4f6f8;
            color:#333;
            font-family:Arial,sans-serif;
        }

        .container-admin {
            padding-top:30px;
            padding-bottom:50px;
        }

        .page-header-custom {
            background:linear-gradient(
                135deg,
                #176b3a,
                #2e8b57
            );

            color:#fff;
            padding:25px;
            border-radius:10px;
            margin-bottom:25px;
            box-shadow:0 4px 12px rgba(0,0,0,.10);
        }

        .page-header-custom h2 {
            margin:0 0 8px;
            font-weight:bold;
        }

        .page-header-custom p {
            margin:0;
        }

        .panel-custom {
            border:none;
            border-radius:10px;
            box-shadow:0 3px 12px rgba(0,0,0,.07);
            margin-bottom:25px;
            overflow:hidden;
        }

        .panel-custom > .panel-heading {
            background:#2e7d32;
            color:#fff;
            padding:15px 20px;
            font-size:17px;
            font-weight:bold;
            border:none;
        }

        .panel-custom > .panel-body {
            padding:25px;
        }

        .form-group label {
            font-weight:bold;
        }

        textarea {
            resize:vertical;
        }

        .table th {
            background:#f1f5f2;
            color:#333;
        }

        .table td {
            vertical-align:middle !important;
        }

        .badge-wajib {
            background:#5cb85c;
        }

        .badge-opsional {
            background:#f0ad4e;
        }

        .badge-aktif {
            background:#5cb85c;
        }

        .badge-tidak {
            background:#d9534f;
        }

        .btn-action {
            margin:2px;
        }

        .edit-box {
            background:#f8faf9;
            border:1px solid #ddd;
            border-radius:8px;
            padding:20px;
            margin-top:15px;
        }

            .container-admin {
                padding-top:15px;
            }

            .page-header-custom {
                text-align:center;
                padding:20px;
            }

            .panel-custom > .panel-body {
                padding:15px;
            }

            .table-responsive {
                border:none;
            }


    </style>

</head>


<body>


<?php include "navbar_admin.php"; ?>


<div class="admin-content">


    <!-- =================================================
         HEADER
    ================================================= -->

    <div class="page-header-custom">

        <h2>

            <span class="glyphicon glyphicon-education"></span>

            Kelola PPDB

        </h2>

        <p>
            Kelola seluruh informasi PPDB MTs Nurul Huda Pematang Cengal
        </p>

    </div>


    <!-- =================================================
         PESAN
    ================================================= -->

    <?php if (!empty($pesan)) { ?>

        <div class="alert alert-<?php echo $tipe_pesan; ?>">

            <span class="glyphicon glyphicon-info-sign"></span>

            <?php echo e($pesan); ?>

        </div>

    <?php } ?>


    <!-- =================================================
         INFORMASI PPDB
    ================================================= -->

    <div class="panel panel-custom">

        <div class="panel-heading">

            <span class="glyphicon glyphicon-info-sign"></span>

            Informasi Utama PPDB

        </div>


        <div class="panel-body">


            <form method="post">


                <input
                    type="hidden"
                    name="id_ppdb"
                    value="<?php echo e($info['id_ppdb']); ?>"
                >


                <div class="row">


                    <!-- TAHUN -->

                    <div class="col-md-4">

                        <div class="form-group">

                            <label>
                                Tahun Ajaran
                            </label>

                            <input
                                type="text"
                                name="tahun_ajaran"
                                class="form-control"
                                value="<?php echo e($info['tahun_ajaran']); ?>"
                                required
                            >

                        </div>

                    </div>


                    <!-- JUDUL HERO -->

                    <div class="col-md-8">

                        <div class="form-group">

                            <label>
                                Judul Hero
                            </label>

                            <input
                                type="text"
                                name="judul_hero"
                                class="form-control"
                                value="<?php echo e($info['judul_hero']); ?>"
                                required
                            >

                        </div>

                    </div>


                    <!-- SUBJUDUL -->

                    <div class="col-md-12">

                        <div class="form-group">

                            <label>
                                Subjudul Hero
                            </label>

                            <input
                                type="text"
                                name="subjudul_hero"
                                class="form-control"
                                value="<?php echo e($info['subjudul_hero']); ?>"
                                required
                            >

                        </div>

                    </div>


                    <!-- YAYASAN -->

                    <div class="col-md-12">

                        <div class="form-group">

                            <label>
                                Nama Yayasan
                            </label>

                            <input
                                type="text"
                                name="nama_yayasan"
                                class="form-control"
                                value="<?php echo e($info['nama_yayasan']); ?>"
                            >

                        </div>

                    </div>


                    <!-- PERIODE -->

                    <div class="col-md-6">

                        <div class="form-group">

                            <label>
                                Periode Pendaftaran
                            </label>

                            <input
                                type="text"
                                name="periode_pendaftaran"
                                class="form-control"
                                value="<?php echo e($info['periode_pendaftaran']); ?>"
                                required
                            >

                        </div>

                    </div>


                    <!-- TINGKAT -->

                    <div class="col-md-6">

                        <div class="form-group">

                            <label>
                                Tingkat Pendidikan
                            </label>

                            <input
                                type="text"
                                name="tingkat_pendidikan"
                                class="form-control"
                                value="<?php echo e($info['tingkat_pendidikan']); ?>"
                                required
                            >

                        </div>

                    </div>


                    <!-- BIAYA -->

                    <div class="col-md-6">

                        <div class="form-group">

                            <label>
                                Biaya Pendidikan
                            </label>

                            <input
                                type="text"
                                name="biaya_pendidikan"
                                class="form-control"
                                value="<?php echo e($info['biaya_pendidikan']); ?>"
                                required
                            >

                        </div>

                    </div>


                    <!-- DESKRIPSI BIAYA -->

                    <div class="col-md-6">

                        <div class="form-group">

                            <label>
                                Deskripsi Biaya
                            </label>

                            <textarea
                                name="deskripsi_biaya"
                                class="form-control"
                                rows="3"
                            ><?php echo e($info['deskripsi_biaya']); ?></textarea>

                        </div>

                    </div>


                    <!-- TANGGAL -->

                    <div class="col-md-6">

                        <div class="form-group">

                            <label>
                                Tanggal Pendaftaran
                            </label>

                            <input
                                type="text"
                                name="tanggal_pendaftaran"
                                class="form-control"
                                value="<?php echo e($info['tanggal_pendaftaran']); ?>"
                                required
                            >

                        </div>

                    </div>


                    <!-- KETERANGAN JADWAL -->

                    <div class="col-md-6">

                        <div class="form-group">

                            <label>
                                Keterangan Jadwal
                            </label>

                            <textarea
                                name="keterangan_jadwal"
                                class="form-control"
                                rows="3"
                            ><?php echo e($info['keterangan_jadwal']); ?></textarea>

                        </div>

                    </div>


                    <!-- JUDUL PERSYARATAN -->

                    <div class="col-md-6">

                        <div class="form-group">

                            <label>
                                Judul Persyaratan
                            </label>

                            <input
                                type="text"
                                name="judul_persyaratan"
                                class="form-control"
                                value="<?php echo e($info['judul_persyaratan']); ?>"
                            >

                        </div>

                    </div>


                    <!-- JUDUL ALUR -->

                    <div class="col-md-6">

                        <div class="form-group">

                            <label>
                                Judul Alur
                            </label>

                            <input
                                type="text"
                                name="judul_alur"
                                class="form-control"
                                value="<?php echo e($info['judul_alur']); ?>"
                            >

                        </div>

                    </div>


                    <!-- JUDUL BIAYA -->

                    <div class="col-md-6">

                        <div class="form-group">

                            <label>
                                Judul Biaya
                            </label>

                            <input
                                type="text"
                                name="judul_biaya"
                                class="form-control"
                                value="<?php echo e($info['judul_biaya']); ?>"
                            >

                        </div>

                    </div>


                    <!-- KETERANGAN BIAYA -->

                    <div class="col-md-6">

                        <div class="form-group">

                            <label>
                                Keterangan Biaya
                            </label>

                            <textarea
                                name="keterangan_biaya"
                                class="form-control"
                                rows="3"
                            ><?php echo e($info['keterangan_biaya']); ?></textarea>

                        </div>

                    </div>


                    <!-- JUDUL CTA -->

                    <div class="col-md-6">

                        <div class="form-group">

                            <label>
                                Judul CTA
                            </label>

                            <input
                                type="text"
                                name="judul_cta"
                                class="form-control"
                                value="<?php echo e($info['judul_cta']); ?>"
                            >

                        </div>

                    </div>


                    <!-- KETERANGAN CTA -->

                    <div class="col-md-6">

                        <div class="form-group">

                            <label>
                                Keterangan CTA
                            </label>

                            <textarea
                                name="keterangan_cta"
                                class="form-control"
                                rows="3"
                            ><?php echo e($info['keterangan_cta']); ?></textarea>

                        </div>

                    </div>


                    <!-- STATUS -->

                    <div class="col-md-6">

                        <div class="form-group">

                            <label>
                                Status PPDB
                            </label>

                            <select
                                name="status"
                                class="form-control"
                            >

                                <option
                                    value="Aktif"
                                    <?php
                                    if ($info['status'] == 'Aktif') {
                                        echo 'selected';
                                    }
                                    ?>
                                >
                                    Aktif
                                </option>

                                <option
                                    value="Tidak Aktif"
                                    <?php
                                    if ($info['status'] == 'Tidak Aktif') {
                                        echo 'selected';
                                    }
                                    ?>
                                >
                                    Tidak Aktif
                                </option>

                            </select>

                        </div>

                    </div>


                </div>


                <button
                    type="submit"
                    name="update_info"
                    class="btn btn-success"
                >

                    <span class="glyphicon glyphicon-save"></span>

                    Simpan Informasi PPDB

                </button>


            </form>


        </div>

    </div>


    <!-- =================================================
         PERSYARATAN
    ================================================= -->

    <div class="panel panel-custom">

        <div class="panel-heading">

            <span class="glyphicon glyphicon-list-alt"></span>

            Kelola Persyaratan

        </div>


        <div class="panel-body">


            <!-- TAMBAH -->

            <div class="edit-box">

                <h4>

                    <span class="glyphicon glyphicon-plus"></span>

                    Tambah Persyaratan

                </h4>

                <hr>


                <form method="post">


                    <div class="row">


                        <div class="col-md-7">

                            <div class="form-group">

                                <label>
                                    Persyaratan
                                </label>

                                <textarea
                                    name="persyaratan"
                                    class="form-control"
                                    rows="3"
                                    required
                                ></textarea>

                            </div>

                        </div>


                        <div class="col-md-3">

                            <div class="form-group">

                                <label>
                                    Keterangan
                                </label>

                                <select
                                    name="keterangan"
                                    class="form-control"
                                >

                                    <option value="WAJIB">
                                        WAJIB
                                    </option>

                                    <option value="OPSIONAL">
                                        OPSIONAL
                                    </option>

                                </select>

                            </div>

                        </div>


                        <div class="col-md-2">

                            <div class="form-group">

                                <label>
                                    Urutan
                                </label>

                                <input
                                    type="number"
                                    name="urutan"
                                    class="form-control"
                                    value="1"
                                    min="1"
                                    required
                                >

                            </div>

                        </div>

                    </div>


                    <button
                        type="submit"
                        name="tambah_persyaratan"
                        class="btn btn-success"
                    >

                        <span class="glyphicon glyphicon-plus"></span>

                        Tambah

                    </button>


                </form>

            </div>


            <br>


            <!-- DAFTAR -->

            <div class="table-responsive">

                <table class="table table-bordered table-hover">

                    <thead>

                        <tr>

                            <th width="60">
                                No
                            </th>

                            <th>
                                Persyaratan
                            </th>

                            <th width="110">
                                Keterangan
                            </th>

                            <th width="80">
                                Urutan
                            </th>

                            <th width="100">
                                Status
                            </th>

                            <th width="160">
                                Aksi
                            </th>

                        </tr>

                    </thead>


                    <tbody>


                    <?php

                    $no = 1;

                    while ($row = mysqli_fetch_assoc($query_persyaratan)) {

                    ?>


                        <tr>

                            <td>
                                <?php echo $no++; ?>
                            </td>


                            <td>
                                <?php echo nl2br(e($row['persyaratan'])); ?>
                            </td>


                            <td>

                                <?php if ($row['keterangan'] == 'WAJIB') { ?>

                                    <span class="label badge-wajib">
                                        WAJIB
                                    </span>

                                <?php } else { ?>

                                    <span class="label badge-opsional">
                                        OPSIONAL
                                    </span>

                                <?php } ?>

                            </td>


                            <td>
                                <?php echo e($row['urutan']); ?>
                            </td>


                            <td>

                                <?php if ($row['status'] == 'Aktif') { ?>

                                    <span class="label badge-aktif">
                                        Aktif
                                    </span>

                                <?php } else { ?>

                                    <span class="label badge-tidak">
                                        Tidak Aktif
                                    </span>

                                <?php } ?>

                            </td>


                            <td>

                                <button
                                    type="button"
                                    class="btn btn-primary btn-xs btn-action"
                                    data-toggle="modal"
                                    data-target="#editPersyaratan<?php echo $row['id_persyaratan']; ?>"
                                >

                                    <span class="glyphicon glyphicon-pencil"></span>

                                    Edit

                                </button>


                                <a
                                    href="?hapus_persyaratan=<?php echo $row['id_persyaratan']; ?>"
                                    class="btn btn-danger btn-xs btn-action"
                                    onclick="return confirm('Yakin ingin menghapus persyaratan ini?');"
                                >

                                    <span class="glyphicon glyphicon-trash"></span>

                                    Hapus

                                </a>

                            </td>

                        </tr>


                        <!-- MODAL EDIT -->

                        <div
                            class="modal fade"
                            id="editPersyaratan<?php echo $row['id_persyaratan']; ?>"
                            tabindex="-1"
                            role="dialog"
                        >

                            <div class="modal-dialog">

                                <div class="modal-content">


                                    <form method="post">


                                        <div class="modal-header">

                                            <button
                                                type="button"
                                                class="close"
                                                data-dismiss="modal"
                                            >
                                                &times;
                                            </button>

                                            <h4 class="modal-title">

                                                Edit Persyaratan

                                            </h4>

                                        </div>


                                        <div class="modal-body">


                                            <input
                                                type="hidden"
                                                name="id_persyaratan"
                                                value="<?php echo $row['id_persyaratan']; ?>"
                                            >


                                            <div class="form-group">

                                                <label>
                                                    Persyaratan
                                                </label>

                                                <textarea
                                                    name="persyaratan"
                                                    class="form-control"
                                                    rows="4"
                                                    required
                                                ><?php echo e($row['persyaratan']); ?></textarea>

                                            </div>


                                            <div class="form-group">

                                                <label>
                                                    Keterangan
                                                </label>

                                                <select
                                                    name="keterangan"
                                                    class="form-control"
                                                >

                                                    <option
                                                        value="WAJIB"
                                                        <?php
                                                        if ($row['keterangan'] == 'WAJIB') {
                                                            echo 'selected';
                                                        }
                                                        ?>
                                                    >
                                                        WAJIB
                                                    </option>

                                                    <option
                                                        value="OPSIONAL"
                                                        <?php
                                                        if ($row['keterangan'] == 'OPSIONAL') {
                                                            echo 'selected';
                                                        }
                                                        ?>
                                                    >
                                                        OPSIONAL
                                                    </option>

                                                </select>

                                            </div>


                                            <div class="form-group">

                                                <label>
                                                    Urutan
                                                </label>

                                                <input
                                                    type="number"
                                                    name="urutan"
                                                    class="form-control"
                                                    min="1"
                                                    value="<?php echo e($row['urutan']); ?>"
                                                    required
                                                >

                                            </div>


                                            <div class="form-group">

                                                <label>
                                                    Status
                                                </label>

                                                <select
                                                    name="status"
                                                    class="form-control"
                                                >

                                                    <option
                                                        value="Aktif"
                                                        <?php
                                                        if ($row['status'] == 'Aktif') {
                                                            echo 'selected';
                                                        }
                                                        ?>
                                                    >
                                                        Aktif
                                                    </option>

                                                    <option
                                                        value="Tidak Aktif"
                                                        <?php
                                                        if ($row['status'] == 'Tidak Aktif') {
                                                            echo 'selected';
                                                        }
                                                        ?>
                                                    >
                                                        Tidak Aktif
                                                    </option>

                                                </select>

                                            </div>


                                        </div>


                                        <div class="modal-footer">

                                            <button
                                                type="button"
                                                class="btn btn-default"
                                                data-dismiss="modal"
                                            >
                                                Batal
                                            </button>


                                            <button
                                                type="submit"
                                                name="edit_persyaratan"
                                                class="btn btn-success"
                                            >

                                                <span class="glyphicon glyphicon-save"></span>

                                                Simpan

                                            </button>

                                        </div>


                                    </form>

                                </div>

                            </div>

                        </div>


                    <?php } ?>


                    </tbody>

                </table>

            </div>

        </div>

    </div>


    <!-- =================================================
         ALUR PENDAFTARAN
    ================================================= -->

    <div class="panel panel-custom">

        <div class="panel-heading">

            <span class="glyphicon glyphicon-road"></span>

            Kelola Alur Pendaftaran

        </div>


        <div class="panel-body">


            <!-- TAMBAH ALUR -->

            <div class="edit-box">

                <h4>

                    <span class="glyphicon glyphicon-plus"></span>

                    Tambah Alur Pendaftaran

                </h4>

                <hr>


                <form method="post">


                    <div class="row">


                        <div class="col-md-2">

                            <div class="form-group">

                                <label>
                                    Nomor
                                </label>

                                <input
                                    type="number"
                                    name="nomor"
                                    class="form-control"
                                    value="1"
                                    min="1"
                                    required
                                >

                            </div>

                        </div>


                        <div class="col-md-4">

                            <div class="form-group">

                                <label>
                                    Judul
                                </label>

                                <input
                                    type="text"
                                    name="judul"
                                    class="form-control"
                                    required
                                >

                            </div>

                        </div>


                        <div class="col-md-6">

                            <div class="form-group">

                                <label>
                                    Keterangan
                                </label>

                                <textarea
                                    name="keterangan"
                                    class="form-control"
                                    rows="3"
                                    required
                                ></textarea>

                            </div>

                        </div>

                    </div>


                    <button
                        type="submit"
                        name="tambah_alur"
                        class="btn btn-success"
                    >

                        <span class="glyphicon glyphicon-plus"></span>

                        Tambah Alur

                    </button>


                </form>

            </div>


            <br>


            <!-- DAFTAR ALUR -->

            <div class="table-responsive">

                <table class="table table-bordered table-hover">

                    <thead>

                        <tr>

                            <th width="70">
                                No
                            </th>

                            <th width="250">
                                Judul
                            </th>

                            <th>
                                Keterangan
                            </th>

                            <th width="100">
                                Status
                            </th>

                            <th width="160">
                                Aksi
                            </th>

                        </tr>

                    </thead>


                    <tbody>


                    <?php

                    while ($row = mysqli_fetch_assoc($query_alur)) {

                    ?>


                        <tr>

                            <td class="text-center">

                                <strong>
                                    <?php echo e($row['nomor']); ?>
                                </strong>

                            </td>


                            <td>

                                <strong>
                                    <?php echo e($row['judul']); ?>
                                </strong>

                            </td>


                            <td>

                                <?php
                                echo nl2br(
                                    e($row['keterangan'])
                                );
                                ?>

                            </td>


                            <td>

                                <?php if ($row['status'] == 'Aktif') { ?>

                                    <span class="label badge-aktif">
                                        Aktif
                                    </span>

                                <?php } else { ?>

                                    <span class="label badge-tidak">
                                        Tidak Aktif
                                    </span>

                                <?php } ?>

                            </td>


                            <td>

                                <button
                                    type="button"
                                    class="btn btn-primary btn-xs btn-action"
                                    data-toggle="modal"
                                    data-target="#editAlur<?php echo $row['id_alur']; ?>"
                                >

                                    <span class="glyphicon glyphicon-pencil"></span>

                                    Edit

                                </button>


                                <a
                                    href="?hapus_alur=<?php echo $row['id_alur']; ?>"
                                    class="btn btn-danger btn-xs btn-action"
                                    onclick="return confirm('Yakin ingin menghapus alur ini?');"
                                >

                                    <span class="glyphicon glyphicon-trash"></span>

                                    Hapus

                                </a>

                            </td>

                        </tr>


                        <!-- MODAL EDIT ALUR -->

                        <div
                            class="modal fade"
                            id="editAlur<?php echo $row['id_alur']; ?>"
                            tabindex="-1"
                            role="dialog"
                        >

                            <div class="modal-dialog">

                                <div class="modal-content">


                                    <form method="post">


                                        <div class="modal-header">

                                            <button
                                                type="button"
                                                class="close"
                                                data-dismiss="modal"
                                            >
                                                &times;
                                            </button>

                                            <h4 class="modal-title">

                                                Edit Alur Pendaftaran

                                            </h4>

                                        </div>


                                        <div class="modal-body">


                                            <input
                                                type="hidden"
                                                name="id_alur"
                                                value="<?php echo $row['id_alur']; ?>"
                                            >


                                            <div class="form-group">

                                                <label>
                                                    Nomor
                                                </label>

                                                <input
                                                    type="number"
                                                    name="nomor"
                                                    class="form-control"
                                                    min="1"
                                                    value="<?php echo e($row['nomor']); ?>"
                                                    required
                                                >

                                            </div>


                                            <div class="form-group">

                                                <label>
                                                    Judul
                                                </label>

                                                <input
                                                    type="text"
                                                    name="judul"
                                                    class="form-control"
                                                    value="<?php echo e($row['judul']); ?>"
                                                    required
                                                >

                                            </div>


                                            <div class="form-group">

                                                <label>
                                                    Keterangan
                                                </label>

                                                <textarea
                                                    name="keterangan"
                                                    class="form-control"
                                                    rows="5"
                                                    required
                                                ><?php echo e($row['keterangan']); ?></textarea>

                                            </div>


                                            <div class="form-group">

                                                <label>
                                                    Status
                                                </label>

                                                <select
                                                    name="status"
                                                    class="form-control"
                                                >

                                                    <option
                                                        value="Aktif"
                                                        <?php
                                                        if ($row['status'] == 'Aktif') {
                                                            echo 'selected';
                                                        }
                                                        ?>
                                                    >
                                                        Aktif
                                                    </option>

                                                    <option
                                                        value="Tidak Aktif"
                                                        <?php
                                                        if ($row['status'] == 'Tidak Aktif') {
                                                            echo 'selected';
                                                        }
                                                        ?>
                                                    >
                                                        Tidak Aktif
                                                    </option>

                                                </select>

                                            </div>


                                        </div>


                                        <div class="modal-footer">

                                            <button
                                                type="button"
                                                class="btn btn-default"
                                                data-dismiss="modal"
                                            >
                                                Batal
                                            </button>


                                            <button
                                                type="submit"
                                                name="edit_alur"
                                                class="btn btn-success"
                                            >

                                                <span class="glyphicon glyphicon-save"></span>

                                                Simpan

                                            </button>

                                        </div>


                                    </form>

                                </div>

                            </div>

                        </div>


                    <?php } ?>


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