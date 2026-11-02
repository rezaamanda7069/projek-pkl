<?php

session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

include "../koneksi.php";


// =========================================
// PENCARIAN AGENDA
// =========================================

$cari = "";

if (isset($_GET['cari'])) {

    $cari = mysqli_real_escape_string(
        $koneksi,
        trim($_GET['cari'])
    );
}


// =========================================
// QUERY DATA
// =========================================

if ($cari != "") {

    $query = mysqli_query(
        $koneksi,
        "SELECT * FROM agenda
         WHERE judul LIKE '%$cari%'
         OR tempat LIKE '%$cari%'
         OR deskripsi LIKE '%$cari%'
         ORDER BY tanggal DESC, waktu DESC"
    );

} else {

    $query = mysqli_query(
        $koneksi,
        "SELECT * FROM agenda
         ORDER BY tanggal DESC, waktu DESC"
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

    <title>Data Agenda Admin</title>

    <link
        href="../bootstrap/css/bootstrap.min.css"
        rel="stylesheet"
    >


    <style>

        /* =========================================
           RESET
        ========================================= */

        * {
            box-sizing: border-box;
        }


        html,
        body {

            margin: 0;
            padding: 0;

            width: 100%;
            min-height: 100%;

            background: #f4f6f8;

            font-family: Arial, Helvetica, sans-serif;

            color: #333;

            overflow-x: hidden;
        }


        /* =========================================
           KONTEN UTAMA ADMIN
        ========================================= */

        .main-content {

            margin-left: 250px;

            width: calc(100% - 250px);

            min-height: 100vh;

            padding: 30px;

            overflow-x: hidden;
        }


        /* =========================================
           HEADER
        ========================================= */

        .page-header-agenda {

            background: #ffffff;

            border-radius: 10px;

            padding: 22px 25px;

            margin-bottom: 20px;

            box-shadow:
                0 2px 10px rgba(0,0,0,0.06);
        }


        .page-header-agenda h2 {

            margin: 0;

            color: #2e7d32;

            font-size: 25px;

            font-weight: bold;

            line-height: 1.4;
        }


        .page-header-agenda p {

            margin: 7px 0 0;

            color: #777;

            font-size: 14px;

            line-height: 1.5;
        }


        /* =========================================
           TOMBOL TAMBAH
        ========================================= */

        .btn-tambah {

            margin-top: 3px;

            padding: 9px 15px;

            border-radius: 5px;

            font-weight: bold;
        }


        /* =========================================
           CARD
        ========================================= */

        .agenda-card {

            width: 100%;

            background: #ffffff;

            border-radius: 10px;

            box-shadow:
                0 2px 10px rgba(0,0,0,0.06);

            overflow: hidden;
        }


        /* =========================================
           FILTER
        ========================================= */

        .filter-area {

            padding: 20px 25px;

            background: #ffffff;

            border-bottom: 1px solid #eeeeee;
        }


        .filter-title {

            display: block;

            font-size: 12px;

            font-weight: bold;

            color: #777;

            margin-bottom: 7px;
        }


        .filter-area .form-control {

            height: 38px;

            border-radius: 4px;
        }


        .filter-area .btn {

            height: 38px;
        }


        .btn-reset {

            margin-left: 5px;
        }


        /* =========================================
           HASIL PENCARIAN
        ========================================= */

        .hasil-pencarian {

            margin: 20px 25px 0;
        }


        .hasil-pencarian .alert {

            margin-bottom: 0;

            word-break: break-word;
        }


        /* =========================================
           AREA TABEL
        ========================================= */

        .table-area {

            width: 100%;

            padding: 20px 25px 25px;

            overflow: hidden;
        }


        /* =========================================
           PEMBUNGKUS TABEL
           
           INI YANG MEMBUAT TABEL BISA
           DIGESER KIRI KANAN DI HP
        ========================================= */

        .table-responsive {

            width: 100%;

            max-width: 100%;

            margin: 0;

            padding: 0;

            overflow-x: auto !important;

            overflow-y: hidden;

            -webkit-overflow-scrolling: touch;

            border: 1px solid #ddd;

            border-radius: 6px;
        }


        /* =========================================
           TABLE

           Lebar sengaja dibuat 1100px.
           Di HP tabel dapat digeser kiri-kanan.
        ========================================= */

        .table-agenda {

            width: 1100px !important;

            min-width: 1100px !important;

            max-width: none !important;

            margin: 0 !important;

            table-layout: fixed;

            border-collapse: collapse;
        }


        /* =========================================
           LEBAR KOLOM
        ========================================= */

        .col-no {

            width: 55px;
        }


        .col-judul {

            width: 220px;
        }


        .col-tanggal {

            width: 115px;
        }


        .col-waktu {

            width: 95px;
        }


        .col-tempat {

            width: 180px;
        }


        .col-deskripsi {

            width: 280px;
        }


        .col-aksi {

            width: 155px;
        }


        /* =========================================
           HEADER TABEL
        ========================================= */

        .table-agenda thead th {

            background: #2e7d32;

            color: #ffffff;

            text-align: center;

            vertical-align: middle !important;

            border-color: #256628 !important;

            font-size: 13px;

            font-weight: bold;

            padding: 11px 8px;

            white-space: nowrap;

            overflow: hidden;
        }


        /* =========================================
           ISI TABEL
        ========================================= */

        .table-agenda tbody td {

            vertical-align: top !important;

            padding: 10px 8px;

            font-size: 13px;

            border-color: #dddddd !important;

            line-height: 1.5;

            white-space: normal !important;

            word-wrap: break-word;

            overflow-wrap: break-word;

            word-break: break-word;

            overflow: hidden;
        }


        /* =========================================
           HOVER
        ========================================= */

        .table-agenda tbody tr:hover {

            background: #f5faf6;
        }


        /* =========================================
           NOMOR
        ========================================= */

        .nomor-agenda {

            text-align: center;

            vertical-align: middle !important;

            font-weight: bold;

            color: #555;

            white-space: nowrap !important;
        }


        /* =========================================
           JUDUL
        ========================================= */

        .judul-agenda {

            width: 100%;

            font-weight: bold;

            color: #333;

            line-height: 1.5;

            white-space: normal !important;

            overflow-wrap: anywhere;

            word-break: break-word;
        }


        /* =========================================
           TANGGAL
        ========================================= */

        .tanggal {

            text-align: center;

            white-space: nowrap !important;

            vertical-align: middle !important;
        }


        /* =========================================
           WAKTU
        ========================================= */

        .waktu {

            text-align: center;

            white-space: nowrap !important;

            color: #555;

            vertical-align: middle !important;
        }


        /* =========================================
           TEMPAT
        ========================================= */

        .tempat {

            width: 100%;

            line-height: 1.5;

            white-space: normal !important;

            overflow-wrap: anywhere;

            word-break: break-word;
        }


        /* =========================================
           DESKRIPSI

           Teks panjang WAJIB turun ke bawah,
           tidak boleh keluar dari TD.
        ========================================= */

        .deskripsi {

            display: block;

            width: 100%;

            max-width: 100%;

            color: #666;

            line-height: 1.6;

            white-space: normal !important;

            overflow-wrap: anywhere;

            word-break: break-word;

            word-wrap: break-word;

            overflow: hidden;
        }


        /* =========================================
           AKSI
        ========================================= */

        .aksi {

            text-align: center;

            vertical-align: middle !important;

            white-space: nowrap !important;
        }


        .aksi .btn {

            margin: 2px;

            border-radius: 4px;

            font-size: 12px;
        }


        /* =========================================
           DATA KOSONG
        ========================================= */

        .data-kosong {

            text-align: center;

            padding: 50px 20px !important;

            color: #888;

            white-space: normal !important;
        }


        .data-kosong .glyphicon {

            display: block;

            font-size: 38px;

            color: #bbb;

            margin-bottom: 12px;
        }


        /* =========================================
           TABLET
        ========================================= */

        @media (max-width: 991px) {

            .main-content {

                margin-left: 230px;

                width: calc(100% - 230px);

                padding: 20px;

            }


            .page-header-agenda {

                padding: 20px;
            }


            .page-header-agenda h2 {

                font-size: 22px;
            }

        }


        /* =========================================
           HP
        ========================================= */

        @media (max-width: 767px) {

            .main-content {

                margin-left: 0;

                width: 100%;

                max-width: 100%;

                padding: 75px 12px 20px;

                overflow-x: hidden;
            }


            /* HEADER */

            .page-header-agenda {

                padding: 18px;

                border-radius: 8px;

                margin-bottom: 15px;
            }


            .page-header-agenda h2 {

                font-size: 20px;

                text-align: center;

                line-height: 1.4;
            }


            .page-header-agenda p {

                font-size: 12px;

                text-align: center;

                line-height: 1.6;
            }


            /* TOMBOL */

            .btn-tambah {

                display: block;

                width: 100%;

                margin-top: 15px;

                text-align: center;
            }


            /* CARD */

            .agenda-card {

                border-radius: 8px;

                width: 100%;

                max-width: 100%;

                overflow: hidden;
            }


            /* FILTER */

            .filter-area {

                padding: 15px;
            }


            .filter-title {

                margin-top: 3px;
            }


            .filter-area .form-control {

                width: 100%;

                margin-bottom: 10px;
            }


            .filter-area .input-group {

                display: block;

                width: 100%;
            }


            .filter-area .input-group .form-control {

                display: block;

                width: 100%;

                border-radius: 4px;

                margin-bottom: 8px;
            }


            .filter-area .input-group-btn {

                display: block;

                width: 100%;
            }


            .filter-area .input-group-btn .btn {

                display: block;

                width: 100%;

                border-radius: 4px;

                margin: 0;
            }


            .btn-reset {

                display: block;

                width: 100%;

                margin: 10px 0 0;

                text-align: center;
            }


            /* HASIL PENCARIAN */

            .hasil-pencarian {

                margin: 15px;
            }


            .hasil-pencarian .alert {

                font-size: 12px;

                line-height: 1.5;
            }


            /* AREA TABEL */

            .table-area {

                width: 100%;

                padding: 15px;

                overflow: hidden;
            }


            /*

               PENTING:

               Jangan menghilangkan overflow-x.

               Tabel tetap 1100px sehingga HP
               dapat menggeser tabel kiri-kanan.
            */

            .table-responsive {

                display: block;

                width: 100%;

                max-width: 100%;

                overflow-x: auto !important;

                overflow-y: hidden;

                -webkit-overflow-scrolling: touch;

                border-radius: 6px;
            }


            .table-agenda {

                width: 1100px !important;

                min-width: 1100px !important;

                table-layout: fixed;
            }


            .table-agenda thead th {

                font-size: 12px;

                padding: 10px 7px;
            }


            .table-agenda tbody td {

                font-size: 12px;

                padding: 9px 7px;

                line-height: 1.5;
            }


            .judul-agenda {

                font-size: 12px;

                line-height: 1.5;
            }


            .deskripsi {

                font-size: 12px;

                line-height: 1.6;

                white-space: normal !important;

                word-break: break-word;

                overflow-wrap: anywhere;
            }


            .tempat {

                font-size: 12px;

                white-space: normal !important;

                word-break: break-word;

                overflow-wrap: anywhere;
            }


            .aksi .btn {

                font-size: 11px;

                padding: 5px 8px;
            }

        }


        /* =========================================
           HP KECIL
        ========================================= */

        @media (max-width: 480px) {

            .main-content {

                padding: 70px 8px 15px;
            }


            .page-header-agenda {

                padding: 15px;
            }


            .page-header-agenda h2 {

                font-size: 18px;
            }


            .page-header-agenda p {

                font-size: 11px;
            }


            .filter-area {

                padding: 12px;
            }


            .table-area {

                padding: 12px;
            }


            .table-responsive {

                border-radius: 5px;
            }


            .table-agenda {

                width: 1100px !important;

                min-width: 1100px !important;
            }


            .table-agenda thead th {

                font-size: 11px;

                padding: 9px 6px;
            }


            .table-agenda tbody td {

                font-size: 11px;

                padding: 8px 6px;
            }


            .judul-agenda {

                font-size: 11px;
            }


            .deskripsi {

                font-size: 11px;

                line-height: 1.6;
            }


            .tempat {

                font-size: 11px;
            }

        }

    </style>

</head>


<body>


<?php include "navbar_admin.php"; ?>


<!-- =========================================
     KONTEN UTAMA
========================================= -->

<div class="main-content">


    <!-- =====================================
         HEADER
    ====================================== -->

    <div class="page-header-agenda">

        <div class="row">

            <div class="col-sm-8">

                <h2>

                    <span
                        class="glyphicon glyphicon-calendar">
                    </span>

                    Data Agenda

                </h2>


                <p>

                    Kelola agenda dan kegiatan
                    MTs Nurul Huda Pematang Cengal

                </p>

            </div>


            <div class="col-sm-4 text-right">

                <a
                    href="tambah_agenda.php"
                    class="btn btn-success btn-tambah"
                >

                    <span
                        class="glyphicon glyphicon-plus">
                    </span>

                    Tambah Agenda

                </a>

            </div>

        </div>

    </div>



    <!-- =====================================
         CARD
    ====================================== -->

    <div class="agenda-card">


        <!-- =================================
             FILTER / SEARCH
        ================================== -->

        <div class="filter-area">

            <form method="GET">

                <div class="row">


                    <div class="col-sm-7">

                        <label class="filter-title">

                            PENCARIAN AGENDA

                        </label>


                        <div class="input-group">

                            <input
                                type="text"
                                name="cari"
                                class="form-control"
                                placeholder="Cari judul, tempat, atau deskripsi..."
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

                    </div>


                    <div class="col-sm-5">

                        <label class="filter-title">

                            &nbsp;

                        </label>


                        <?php if ($cari != "") { ?>

                            <a
                                href="agenda_admin.php"
                                class="btn btn-default btn-reset"
                            >

                                <span
                                    class="glyphicon glyphicon-refresh">
                                </span>

                                Reset

                            </a>

                        <?php } ?>


                    </div>


                </div>

            </form>

        </div>



        <!-- =================================
             HASIL PENCARIAN
        ================================== -->

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



        <!-- =================================
             TABEL
        ================================== -->

        <div class="table-area">


            <div class="table-responsive">


                <table
                    class="table table-bordered table-hover table-agenda"
                >


                    <!-- =========================
                         LEBAR KOLOM
                    ========================== -->

                    <colgroup>

                        <col class="col-no">

                        <col class="col-judul">

                        <col class="col-tanggal">

                        <col class="col-waktu">

                        <col class="col-tempat">

                        <col class="col-deskripsi">

                        <col class="col-aksi">

                    </colgroup>



                    <thead>

                        <tr>

                            <th>

                                No

                            </th>


                            <th>

                                Judul Agenda

                            </th>


                            <th>

                                Tanggal

                            </th>


                            <th>

                                Waktu

                            </th>


                            <th>

                                Tempat

                            </th>


                            <th>

                                Deskripsi

                            </th>


                            <th>

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


                            <!-- =================
                                 NO
                            ================== -->

                            <td class="nomor-agenda">

                                <?php
                                echo $no++;
                                ?>

                            </td>



                            <!-- =================
                                 JUDUL
                            ================== -->

                            <td>

                                <div class="judul-agenda">

                                    <?php

                                    echo htmlspecialchars(
                                        $data['judul']
                                    );

                                    ?>

                                </div>

                            </td>



                            <!-- =================
                                 TANGGAL
                            ================== -->

                            <td class="tanggal">

                                <?php

                                if (
                                    !empty(
                                        $data['tanggal']
                                    )
                                ) {

                                    echo date(
                                        'd-m-Y',
                                        strtotime(
                                            $data['tanggal']
                                        )
                                    );

                                } else {

                                    echo "-";

                                }

                                ?>

                            </td>



                            <!-- =================
                                 WAKTU
                            ================== -->

                            <td class="waktu">

                                <?php

                                if (
                                    !empty(
                                        $data['waktu']
                                    )
                                ) {

                                    echo date(
                                        'H:i',
                                        strtotime(
                                            $data['waktu']
                                        )
                                    );

                                    echo " WIB";

                                } else {

                                    echo "-";

                                }

                                ?>

                            </td>



                            <!-- =================
                                 TEMPAT
                            ================== -->

                            <td>

                                <div class="tempat">

                                    <?php

                                    if (
                                        !empty(
                                            $data['tempat']
                                        )
                                    ) {

                                        echo htmlspecialchars(
                                            $data['tempat']
                                        );

                                    } else {

                                        echo "-";

                                    }

                                    ?>

                                </div>

                            </td>



                            <!-- =================
                                 DESKRIPSI
                            ================== -->

                            <td>

                                <div class="deskripsi">

                                    <?php

                                    $deskripsi =
                                        strip_tags(
                                            $data['deskripsi']
                                        );


                                    if (
                                        strlen(
                                            $deskripsi
                                        ) > 150
                                    ) {

                                        echo htmlspecialchars(
                                            substr(
                                                $deskripsi,
                                                0,
                                                150
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



                            <!-- =================
                                 AKSI
                            ================== -->

                            <td class="aksi">


                                <a
                                    href="edit_agenda_admin.php?id=<?php echo $data['id_agenda']; ?>"
                                    class="btn btn-warning btn-sm"
                                    title="Edit Agenda"
                                >

                                    <span
                                        class="glyphicon glyphicon-edit">
                                    </span>

                                    Edit

                                </a>



                                <a
                                    href="hapus_agenda_admin.php?id=<?php echo $data['id_agenda']; ?>"
                                    class="btn btn-danger btn-sm"
                                    title="Hapus Agenda"
                                    onclick="return confirm('Yakin ingin menghapus agenda ini?');"
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


                        <tr>

                            <td
                                colspan="7"
                                class="data-kosong"
                            >

                                <span
                                    class="glyphicon glyphicon-calendar">
                                </span>


                                <strong>

                                    Data agenda tidak ditemukan

                                </strong>


                                <br>


                                <small>

                                    Belum ada agenda yang tersedia.

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



<script
    src="../bootstrap/js/jquery.min.js">
</script>


<script
    src="../bootstrap/js/bootstrap.min.js">
</script>


</body>

</html>