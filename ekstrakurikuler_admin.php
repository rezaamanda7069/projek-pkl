<?php

session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

include "../koneksi.php";

/* =====================================================
   PENCARIAN
===================================================== */

$cari = "";

if (isset($_GET['cari'])) {

    $cari = mysqli_real_escape_string(
        $koneksi,
        trim($_GET['cari'])
    );
}


/* =====================================================
   QUERY DATA
===================================================== */

if ($cari != "") {

    $query = mysqli_query(
        $koneksi,
        "SELECT *
         FROM ekstrakurikuler
         WHERE nama_ekskul LIKE '%$cari%'
         OR pembina LIKE '%$cari%'
         OR jadwal LIKE '%$cari%'
         OR deskripsi LIKE '%$cari%'
         ORDER BY id_ekskul DESC"
    );

} else {

    $query = mysqli_query(
        $koneksi,
        "SELECT *
         FROM ekstrakurikuler
         ORDER BY id_ekskul DESC"
    );
}


if (!$query) {

    die(
        "Query error: " .
        mysqli_error($koneksi)
    );
}

?>

<!DOCTYPE html>

<html lang="id">

<head>

    <meta charset="utf-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >

    <title>Data Ekstrakurikuler Admin</title>

    <link
        href="../bootstrap/css/bootstrap.min.css"
        rel="stylesheet"
    >


    <style>

        /* =====================================================
           RESET
        ===================================================== */

        * {
            box-sizing: border-box;
        }


        html,
        body {
            width: 100%;
            max-width: 100%;
            margin: 0;
            padding: 0;
        }


        /* =====================================================
           BODY
        ===================================================== */

        body {

            background: #f4f7f5;

            font-family:
                Arial,
                Helvetica,
                sans-serif;

            color: #333;

            overflow-x: hidden;
        }


        /* =====================================================
           KONTEN ADMIN
           
           Desktop mengikuti sidebar 250px
        ===================================================== */

        .main-content {

            margin-left: 250px;

            padding: 30px;

            min-height: 100vh;

            width: auto;

            max-width: 100%;
        }


        /* =====================================================
           KOTAK UTAMA
        ===================================================== */

        .ekskul-page {

            background: #ffffff;

            border: 1px solid #e5ebe7;

            border-radius: 12px;

            padding: 25px;

            box-shadow:
                0 3px 15px rgba(20,50,30,.06);

            width: 100%;

            max-width: 100%;

            overflow: hidden;
        }


        /* =====================================================
           HEADER
        ===================================================== */

        .ekskul-header {

            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 20px;

            margin-bottom: 20px;
        }


        .ekskul-title {

            margin: 0;

            color: #17251c;

            font-size: 24px;

            font-weight: 700;

            line-height: 1.4;
        }


        .ekskul-title .glyphicon {

            color: #087f3d;

            margin-right: 7px;
        }


        .ekskul-subtitle {

            margin: 6px 0 0;

            color: #777;

            font-size: 13px;

            line-height: 1.5;
        }


        /* =====================================================
           TOMBOL TAMBAH
        ===================================================== */

        .btn-tambah-ekskul {

            background: #087f3d;

            border-color: #087f3d;

            border-radius: 7px;

            font-weight: 600;

            padding: 9px 15px;

            white-space: nowrap;
        }


        .btn-tambah-ekskul:hover,
        .btn-tambah-ekskul:focus {

            background: #076b34;

            border-color: #076b34;

            color: #fff;
        }


        /* =====================================================
           PEMBATAS
        ===================================================== */

        .ekskul-divider {

            border-top:
                1px solid #e8eee9;

            margin:
                0 0 20px;
        }


        /* =====================================================
           PENCARIAN
        ===================================================== */

        .search-box {

            margin-bottom: 20px;

            width: 100%;
        }


        .search-box form {

            width: 100%;
        }


        .search-box .input-group {

            max-width: 600px;

            width: 100%;
        }


        .search-box .form-control {

            height: 40px;

            border-radius:
                7px 0 0 7px;

            border-color:
                #d8e1db;

            box-shadow: none;
        }


        .search-box .form-control:focus {

            border-color:
                #087f3d;

            box-shadow:
                0 0 0 2px
                rgba(8,127,61,.08);
        }


        .search-box .btn {

            height: 40px;

            border-radius:
                0 7px 7px 0;
        }


        .btn-reset {

            margin-left: 8px;

            height: 40px;

            border-radius: 7px;
        }


        /* =====================================================
           HASIL PENCARIAN
        ===================================================== */

        .hasil-pencarian {

            margin-bottom: 20px;
        }


        .hasil-pencarian .alert {

            margin-bottom: 0;

            word-break: break-word;
        }


        /* =====================================================
           AREA TABEL
           
           INI YANG MEMBUAT TABEL BISA DIGESER
           DI HP
        ===================================================== */

        .table-responsive {

            width: 100%;

            max-width: 100%;

            overflow-x: auto;

            overflow-y: hidden;

            -webkit-overflow-scrolling: touch;

            border: 0;

            margin: 0;

            padding: 0;
        }


        /* =====================================================
           TABEL
        ===================================================== */

        .tabel-ekskul {

            margin-bottom: 0;

            border: 1px solid #dfe7e1;

            width: 100%;

            min-width: 950px;

            table-layout: fixed;
        }


        /* =====================================================
           HEADER TABEL
        ===================================================== */

        .tabel-ekskul thead th {

            background: #e9f5ed;

            color: #174b2d;

            font-size: 12px;

            font-weight: 700;

            text-align: center;

            vertical-align: middle !important;

            border-color:
                #d7e5db !important;

            white-space: nowrap;

            padding: 11px 8px;
        }


        /* =====================================================
           ISI TABEL
        ===================================================== */

        .tabel-ekskul tbody td {

            vertical-align: middle !important;

            border-color:
                #e5ebe7 !important;

            padding: 10px 8px;

            font-size: 13px;

            word-wrap: break-word;

            overflow-wrap: break-word;

            word-break: normal;

            white-space: normal;
        }


        .tabel-ekskul tbody tr:hover {

            background: #f8fbf9;
        }


        /* =====================================================
           LEBAR KOLOM
        ===================================================== */

        .tabel-ekskul th:nth-child(1),
        .tabel-ekskul td:nth-child(1) {

            width: 50px;
        }


        .tabel-ekskul th:nth-child(2),
        .tabel-ekskul td:nth-child(2) {

            width: 120px;
        }


        .tabel-ekskul th:nth-child(3),
        .tabel-ekskul td:nth-child(3) {

            width: 170px;
        }


        .tabel-ekskul th:nth-child(4),
        .tabel-ekskul td:nth-child(4) {

            width: 150px;
        }


        .tabel-ekskul th:nth-child(5),
        .tabel-ekskul td:nth-child(5) {

            width: 140px;
        }


        .tabel-ekskul th:nth-child(6),
        .tabel-ekskul td:nth-child(6) {

            width: 280px;
        }


        .tabel-ekskul th:nth-child(7),
        .tabel-ekskul td:nth-child(7) {

            width: 150px;
        }


        /* =====================================================
           GAMBAR
        ===================================================== */

        .gambar-ekskul {

            width: 90px;

            height: 65px;

            object-fit: cover;

            border:
                1px solid #d9e2dc;

            border-radius: 6px;

            padding: 2px;

            background: #fff;

            display: inline-block;
        }


        /* =====================================================
           NAMA
        ===================================================== */

        .nama-ekskul {

            font-weight: bold;

            color: #333;

            line-height: 1.5;

            white-space: normal;

            overflow-wrap: break-word;

            word-break: break-word;
        }


        /* =====================================================
           PEMBINA
        ===================================================== */

        .pembina-ekskul {

            line-height: 1.5;

            white-space: normal;

            overflow-wrap: break-word;

            word-break: break-word;
        }


        /* =====================================================
           JADWAL
        ===================================================== */

        .jadwal-ekskul {

            line-height: 1.5;

            white-space: normal;

            overflow-wrap: break-word;

            word-break: break-word;
        }


        /* =====================================================
           DESKRIPSI
           
           DESKRIPSI TIDAK AKAN KELUAR DARI TABEL
        ===================================================== */

        .isi-deskripsi {

            width: 100%;

            max-width: 280px;

            color: #555;

            line-height: 1.5;

            white-space: normal;

            overflow-wrap: break-word;

            word-wrap: break-word;

            word-break: break-word;

            text-align: left;
        }


        /* =====================================================
           AKSI
        ===================================================== */

        .aksi {

            text-align: center;

            white-space: normal;

            vertical-align: middle !important;
        }


        .aksi .btn {

            margin: 2px;

            border-radius: 5px;
        }


        /* =====================================================
           DATA KOSONG
        ===================================================== */

        .data-kosong {

            padding:
                40px 20px !important;

            color: #777;

            text-align: center;
        }


        .data-kosong .glyphicon {

            font-size: 30px;

            color: #aaa;

            display: block;

            margin-bottom: 10px;
        }


        /* =====================================================
           TABLET
        ===================================================== */

        @media (max-width: 991px) {

            .main-content {

                margin-left: 230px;

                padding: 20px;
            }


            .ekskul-page {

                padding: 20px;
            }


            .ekskul-title {

                font-size: 21px;
            }


            .tabel-ekskul {

                min-width: 950px;
            }
        }


        /* =====================================================
           HP
        ===================================================== */

        @media (max-width: 767px) {

            .main-content {

                margin-left: 0;

                padding:
                    15px;

                padding-top:
                    75px;

                width: 100%;

                max-width: 100%;

                overflow: hidden;
            }


            .ekskul-page {

                padding: 15px;

                border-radius: 10px;

                width: 100%;

                max-width: 100%;
            }


            .ekskul-header {

                display: block;

                text-align: left;

                margin-bottom: 18px;
            }


            .ekskul-title {

                font-size: 20px;

                line-height: 1.4;

                word-break: break-word;
            }


            .ekskul-subtitle {

                font-size: 12px;

                line-height: 1.5;

                margin-bottom: 15px;
            }


            .btn-tambah-ekskul {

                width: 100%;

                display: block;

                text-align: center;

                margin-top: 10px;
            }


            /* SEARCH HP */

            .search-box {

                width: 100%;

                margin-bottom: 15px;
            }


            .search-box .input-group {

                width: 100%;

                max-width: 100%;

                display: table;
            }


            .search-box .form-control {

                width: 100%;

                height: 40px;

                font-size: 13px;
            }


            .search-box .input-group-btn {

                width: 1%;

                white-space: nowrap;
            }


            .search-box .input-group-btn .btn {

                height: 40px;

                padding-left: 12px;

                padding-right: 12px;
            }


            .btn-reset {

                display: block;

                width: 100%;

                margin:
                    10px 0 0;
            }


            /* HASIL PENCARIAN */

            .hasil-pencarian {

                margin-bottom: 15px;
            }


            .hasil-pencarian .alert {

                font-size: 12px;

                line-height: 1.5;

                word-break: break-word;
            }


            /* TABEL HP */

            .table-responsive {

                width: 100%;

                max-width: 100%;

                overflow-x: auto;

                overflow-y: hidden;

                display: block;

                -webkit-overflow-scrolling: touch;
            }


            .tabel-ekskul {

                min-width: 950px;

                width: 950px;

                table-layout: fixed;

                font-size: 12px;
            }


            .tabel-ekskul thead th {

                font-size: 12px;

                padding:
                    9px 7px;
            }


            .tabel-ekskul tbody td {

                font-size: 12px;

                padding:
                    9px 7px;

                vertical-align: top !important;

                white-space: normal;

                word-wrap: break-word;

                overflow-wrap: break-word;

                word-break: break-word;
            }


            /* GAMBAR HP */

            .gambar-ekskul {

                width: 75px;

                height: 55px;
            }


            /* DESKRIPSI HP */

            .isi-deskripsi {

                width: 100%;

                max-width: 280px;

                white-space: normal;

                word-break: break-word;

                overflow-wrap: break-word;

                word-wrap: break-word;

                line-height: 1.5;
            }


            /* AKSI HP */

            .aksi {

                white-space: normal;

                min-width: 150px;
            }


            .aksi .btn {

                display: inline-block;

                margin:
                    2px 1px;
            }
        }


        /* =====================================================
           HP KECIL
        ===================================================== */

        @media (max-width: 480px) {

            .main-content {

                padding:
                    10px;

                padding-top:
                    70px;
            }


            .ekskul-page {

                padding: 12px;

                border-radius: 8px;
            }


            .ekskul-title {

                font-size: 18px;
            }


            .ekskul-subtitle {

                font-size: 11px;
            }


            .tabel-ekskul {

                min-width: 950px;

                width: 950px;
            }


            .tabel-ekskul thead th,
            .tabel-ekskul tbody td {

                padding:
                    8px 6px;
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


    <div class="ekskul-page">


        <!-- =================================================
             HEADER
        ================================================== -->

        <div class="ekskul-header">

            <div>

                <h2 class="ekskul-title">

                    <span
                        class="glyphicon glyphicon-flag">
                    </span>

                    Data Ekstrakurikuler

                </h2>


                <p class="ekskul-subtitle">

                    Kelola data ekstrakurikuler
                    MTs Nurul Huda Pematang Cengal

                </p>

            </div>


            <div>

                <a
                    href="tambah_ekstrakurikuler_admin.php"
                    class="btn btn-success btn-tambah-ekskul"
                >

                    <span
                        class="glyphicon glyphicon-plus">
                    </span>

                    Tambah Ekstrakurikuler

                </a>

            </div>

        </div>


        <div class="ekskul-divider"></div>


        <!-- =================================================
             PENCARIAN
        ================================================== -->

        <div class="search-box">

            <form method="GET">

                <div class="input-group">

                    <input
                        type="text"
                        name="cari"
                        class="form-control"
                        placeholder="Cari ekstrakurikuler, pembina, jadwal..."
                        value="<?php
                        echo htmlspecialchars($cari);
                        ?>"
                    >

                    <span class="input-group-btn">

                        <button
                            type="submit"
                            class="btn btn-primary"
                        >

                            <span
                                class="glyphicon glyphicon-search">
                            </span>

                            Cari

                        </button>

                    </span>

                </div>


                <?php if ($cari != "") { ?>

                    <a
                        href="ekstrakurikuler_admin.php"
                        class="btn btn-default btn-reset"
                    >

                        <span
                            class="glyphicon glyphicon-refresh">
                        </span>

                        Reset

                    </a>

                <?php } ?>

            </form>

        </div>


        <!-- =================================================
             HASIL PENCARIAN
        ================================================== -->

        <?php if ($cari != "") { ?>

            <div class="hasil-pencarian">

                <div class="alert alert-info">

                    <span
                        class="glyphicon glyphicon-search">
                    </span>

                    Hasil pencarian untuk:

                    <strong>

                        <?php
                        echo htmlspecialchars($cari);
                        ?>

                    </strong>

                </div>

            </div>

        <?php } ?>


        <!-- =================================================
             TABEL
        ================================================== -->

        <div class="table-responsive">

            <table
                class="table table-bordered table-hover tabel-ekskul"
            >

                <thead>

                    <tr>

                        <th width="50">
                            No
                        </th>

                        <th width="120">
                            Gambar
                        </th>

                        <th width="170">
                            Nama Ekstrakurikuler
                        </th>

                        <th width="150">
                            Pembina
                        </th>

                        <th width="140">
                            Jadwal
                        </th>

                        <th width="280">
                            Deskripsi
                        </th>

                        <th width="150">
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

                ?>

                    <tr>


                        <!-- =================================================
                             NO
                        ================================================== -->

                        <td class="text-center">

                            <?php
                            echo $no++;
                            ?>

                        </td>


                        <!-- =================================================
                             GAMBAR
                        ================================================== -->

                        <td class="text-center">

                            <?php

                            if (
                                !empty($data['gambar'])
                            ) {

                            ?>

                                <img
                                    src="../images/<?php
                                    echo htmlspecialchars(
                                        $data['gambar']
                                    );
                                    ?>"
                                    class="img-thumbnail gambar-ekskul"
                                    alt="Gambar Ekstrakurikuler"
                                >

                            <?php

                            } else {

                            ?>

                                <span class="text-muted">

                                    Tidak ada gambar

                                </span>

                            <?php

                            }

                            ?>

                        </td>


                        <!-- =================================================
                             NAMA
                        ================================================== -->

                        <td>

                            <div class="nama-ekskul">

                                <?php

                                echo htmlspecialchars(
                                    $data['nama_ekskul']
                                );

                                ?>

                            </div>

                        </td>


                        <!-- =================================================
                             PEMBINA
                        ================================================== -->

                        <td>

                            <div class="pembina-ekskul">

                                <?php

                                if (
                                    !empty(
                                        $data['pembina']
                                    )
                                ) {

                                    echo htmlspecialchars(
                                        $data['pembina']
                                    );

                                } else {

                                    echo "-";

                                }

                                ?>

                            </div>

                        </td>


                        <!-- =================================================
                             JADWAL
                        ================================================== -->

                        <td>

                            <div class="jadwal-ekskul">

                                <?php

                                if (
                                    !empty(
                                        $data['jadwal']
                                    )
                                ) {

                                    echo htmlspecialchars(
                                        $data['jadwal']
                                    );

                                } else {

                                    echo "-";

                                }

                                ?>

                            </div>

                        </td>


                        <!-- =================================================
                             DESKRIPSI
                        ================================================== -->

                        <td>

                            <div class="isi-deskripsi">

                                <?php

                                $deskripsi =
                                    strip_tags(
                                        $data['deskripsi']
                                    );


                                if (
                                    strlen($deskripsi) > 120
                                ) {

                                    echo htmlspecialchars(
                                        substr(
                                            $deskripsi,
                                            0,
                                            120
                                        )
                                    );

                                    echo "...";

                                } else {

                                    echo htmlspecialchars(
                                        $deskripsi
                                    );

                                }

                                ?>

                            </div>

                        </td>


                        <!-- =================================================
                             AKSI
                        ================================================== -->

                        <td class="aksi">

                            <a
                                href="edit_ekstrakurikuler_admin.php?id=<?php echo $data['id_ekskul']; ?>"
                                class="btn btn-warning btn-sm"
                                title="Edit"
                            >

                                <span
                                    class="glyphicon glyphicon-edit">
                                </span>

                                Edit

                            </a>


                            <a
                                href="hapus_ekstrakurikuler_admin.php?id=<?php echo $data['id_ekskul']; ?>"
                                class="btn btn-danger btn-sm"
                                title="Hapus"
                                onclick="return confirm('Yakin ingin menghapus data ekstrakurikuler ini?');"
                            >

                                <span
                                    class="glyphicon glyphicon-trash">
                                </span>

                                Hapus

                            </a>

                        </td>


                    </tr>


                <?php

                    }

                } else {

                ?>


                    <!-- =================================================
                         DATA KOSONG
                    ================================================== -->

                    <tr>

                        <td
                            colspan="7"
                            class="data-kosong"
                        >

                            <span
                                class="glyphicon glyphicon-info-sign">
                            </span>

                            <strong>
                                Data ekstrakurikuler tidak ditemukan
                            </strong>

                            <br>

                            <small>
                                Belum ada data ekstrakurikuler yang tersedia.
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


<script
    src="../bootstrap/js/jquery.min.js">
</script>

<script
    src="../bootstrap/js/bootstrap.min.js">
</script>


</body>

</html>