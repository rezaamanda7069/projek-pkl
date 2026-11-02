<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

include "../koneksi.php";
include "navbar_admin.php";

/* =====================================================
   PENCARIAN DATA
===================================================== */

if (isset($_GET['cari']) && $_GET['cari'] != '') {

    $cari = mysqli_real_escape_string(
        $koneksi,
        $_GET['cari']
    );

    $query = mysqli_query(
        $koneksi,
        "SELECT * FROM guru
         WHERE nama_guru LIKE '%$cari%'
         OR mata_pelajaran LIKE '%$cari%'
         OR jabatan LIKE '%$cari%'
         OR nip LIKE '%$cari%'
         ORDER BY nama_guru ASC"
    );

} else {

    $query = mysqli_query(
        $koneksi,
        "SELECT * FROM guru
         ORDER BY nama_guru ASC"
    );
}

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="utf-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1">

    <title>Data Guru - Admin MTs Nurul Huda</title>

    <link href="../bootstrap/css/bootstrap.min.css"
          rel="stylesheet">

    <style>

        html,
        body {

            margin: 0;
            padding: 0;

            background: #f4f7f5;

            color: #17251c;

            font-family:
                Arial,
                Helvetica,
                sans-serif;
        }


        /* =====================================================
           CONTENT
        ===================================================== */

        .admin-content {

            min-height: 100vh;

            padding: 28px 30px 50px;
        }


        /* =====================================================
           HEADER
        ===================================================== */

        .guru-header {

            background: #ffffff;

            border-radius: 14px;

            padding: 24px 26px;

            margin-bottom: 20px;

            border: 1px solid #e5ebe7;

            box-shadow:
                0 4px 18px rgba(20, 50, 30, 0.06);
        }


        .guru-header-content {

            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 20px;
        }


        .guru-title {

            display: flex;

            align-items: center;

            min-width: 0;
        }


        .guru-title-icon {

            width: 52px;
            height: 52px;

            min-width: 52px;

            border-radius: 12px;

            background: rgba(8,127,61,0.10);

            color: #087f3d;

            display: flex;

            align-items: center;

            justify-content: center;

            font-size: 22px;

            margin-right: 15px;
        }


        .guru-title h1 {

            margin: 0;

            color: #173522;

            font-size: 24px;

            font-weight: 700;

            line-height: 1.3;
        }


        .guru-title p {

            margin: 5px 0 0;

            color: #718078;

            font-size: 13px;
        }


        /* =====================================================
           BUTTON TAMBAH
        ===================================================== */

        .btn-tambah {

            background: #087f3d;

            color: #ffffff !important;

            border: none;

            border-radius: 8px;

            padding: 10px 16px;

            font-size: 13px;

            font-weight: bold;

            white-space: nowrap;

            transition: all .2s ease;
        }


        .btn-tambah:hover {

            background: #066b33;

            transform: translateY(-1px);

            box-shadow:
                0 5px 12px rgba(8,127,61,0.20);
        }


        /* =====================================================
           BOX DATA
        ===================================================== */

        .guru-box {

            background: #ffffff;

            border: 1px solid #e5ebe7;

            border-radius: 14px;

            box-shadow:
                0 4px 18px rgba(20, 50, 30, 0.06);

            overflow: hidden;
        }


        /* =====================================================
           TOOLBAR
        ===================================================== */

        .guru-toolbar {

            padding: 18px 22px;

            border-bottom: 1px solid #e8edea;

            background: #ffffff;
        }


        .search-form {

            display: flex;

            align-items: center;

            gap: 8px;

            max-width: 600px;
        }


        .search-input {

            height: 40px;

            border-radius: 8px !important;

            border: 1px solid #dce4df;

            box-shadow: none !important;

            font-size: 13px;
        }


        .search-input:focus {

            border-color: #087f3d;

            box-shadow:
                0 0 0 2px rgba(8,127,61,0.08) !important;
        }


        .btn-cari {

            height: 40px;

            border-radius: 8px;

            background: #087f3d;

            border-color: #087f3d;

            font-weight: bold;
        }


        .btn-cari:hover {

            background: #066b33;

            border-color: #066b33;
        }


        .btn-reset {

            height: 40px;

            border-radius: 8px;

            border: 1px solid #d9e1dc;

            background: #ffffff;

            color: #59655e;
        }


        .btn-reset:hover {

            background: #f4f7f5;
        }


        /* =====================================================
           INFO DATA
        ===================================================== */

        .data-info {

            padding: 15px 22px;

            border-bottom: 1px solid #e8edea;

            color: #718078;

            font-size: 12px;
        }


        .data-info strong {

            color: #087f3d;
        }


        /* =====================================================
           GRID GURU
        ===================================================== */

        .guru-grid {

            padding: 25px;

            display: grid;

            grid-template-columns:
                repeat(4, 1fr);

            gap: 18px;
        }


        /* =====================================================
           CARD GURU
        ===================================================== */

        .guru-card {

            background: #ffffff;

            border: 1px solid #dfe7e2;

            border-radius: 12px;

            overflow: hidden;

            transition:
                transform .2s ease,
                box-shadow .2s ease,
                border-color .2s ease;
        }


        .guru-card:hover {

            transform: translateY(-3px);

            box-shadow:
                0 8px 20px rgba(20,50,30,0.10);

            border-color: #087f3d;
        }


        /* =====================================================
           GAMBAR
        ===================================================== */

        .guru-gambar {

            width: 100%;

            height: 230px;

            background: #eeeeee;

            overflow: hidden;

            position: relative;
        }


        .guru-gambar img {

            width: 100%;

            height: 100%;

            object-fit: cover;

            object-position: center top;

            display: block;
        }


        .gambar-kosong {

            width: 100%;

            height: 100%;

            display: flex;

            align-items: center;

            justify-content: center;

            flex-direction: column;

            color: #9aa59f;

            background: #f1f4f2;
        }


        .gambar-kosong .glyphicon {

            font-size: 45px;

            margin-bottom: 8px;
        }


        .gambar-kosong span:last-child {

            font-size: 12px;
        }


        /* =====================================================
           INFORMASI GURU
        ===================================================== */

        .guru-info {

            padding: 15px;
        }


        .guru-mapel {

            color: #087f3d;

            font-size: 11px;

            font-weight: bold;

            text-transform: uppercase;

            margin-bottom: 6px;
        }


        .guru-nama {

            color: #17251c;

            font-size: 16px;

            font-weight: bold;

            line-height: 1.4;

            margin-bottom: 6px;
        }


        .guru-jabatan {

            color: #718078;

            font-size: 12px;

            line-height: 1.5;
        }


        /* =====================================================
           AKSI
        ===================================================== */

        .guru-aksi {

            padding: 0 15px 15px;

            display: flex;

            gap: 7px;
        }


        .guru-aksi .btn {

            flex: 1;

            border-radius: 6px;

            font-size: 11px;

            padding: 7px 8px;
        }


        .btn-edit {

            background: #f0ad4e;

            border-color: #f0ad4e;

            color: #ffffff;
        }


        .btn-edit:hover {

            background: #ec971f;

            border-color: #ec971f;

            color: #ffffff;
        }


        .btn-hapus {

            background: #d9534f;

            border-color: #d9534f;

            color: #ffffff;
        }


        .btn-hapus:hover {

            background: #c9302c;

            border-color: #c9302c;

            color: #ffffff;
        }


        /* =====================================================
           DATA KOSONG
        ===================================================== */

        .data-kosong {

            padding: 60px 20px;

            text-align: center;

            color: #87928b;
        }


        .data-kosong .glyphicon {

            display: block;

            font-size: 40px;

            margin-bottom: 12px;

            color: #b7c2bb;
        }


        /* =====================================================
           TABLET
        ===================================================== */

        @media (max-width: 1199px) {

            .guru-grid {

                grid-template-columns:
                    repeat(3, 1fr);
            }

        }


        /* =====================================================
           TABLET KECIL
        ===================================================== */

        @media (max-width: 991px) {

            .admin-content {

                padding: 22px 20px 40px;
            }


            .guru-title h1 {

                font-size: 21px;
            }


            .guru-title-icon {

                width: 46px;
                height: 46px;

                min-width: 46px;

                font-size: 19px;
            }


            .guru-grid {

                grid-template-columns:
                    repeat(2, 1fr);

                padding: 20px;
            }

        }


        /* =====================================================
           HP
        ===================================================== */

        @media (max-width: 767px) {

            .admin-content {

                padding:
                    70px 15px 30px;
            }


            .guru-header {

                padding: 20px;

                border-radius: 12px;
            }


            .guru-header-content {

                display: block;
            }


            .guru-title {

                margin-bottom: 17px;
            }


            .guru-title h1 {

                font-size: 20px;
            }


            .guru-title p {

                font-size: 12px;

                line-height: 1.6;
            }


            .guru-title-icon {

                width: 44px;
                height: 44px;

                min-width: 44px;

                margin-right: 12px;
            }


            .btn-tambah {

                display: block;

                width: 100%;

                text-align: center;

                padding: 11px;
            }


            .guru-box {

                border-radius: 12px;
            }


            .guru-toolbar {

                padding: 15px;
            }


            .search-form {

                display: block;

                max-width: none;
            }


            .search-input {

                width: 100%;

                margin-bottom: 8px;
            }


            .btn-cari,
            .btn-reset {

                width:
                    calc(50% - 5px);
            }


            .data-info {

                padding: 13px 15px;
            }


            .guru-grid {

                grid-template-columns:
                    1fr;

                padding: 15px;
            }


            .guru-gambar {

                height: 280px;
            }

        }


        /* =====================================================
           HP KECIL
        ===================================================== */

        @media (max-width: 480px) {

            .admin-content {

                padding:
                    65px 10px 25px;
            }


            .guru-header {

                padding: 16px;
            }


            .guru-title h1 {

                font-size: 18px;
            }


            .guru-title p {

                font-size: 11.5px;
            }


            .guru-title-icon {

                width: 40px;
                height: 40px;

                min-width: 40px;

                font-size: 17px;
            }


            .guru-toolbar {

                padding: 13px;
            }


            .data-info {

                font-size: 11px;
            }


            .guru-gambar {

                height: 260px;
            }


            .guru-nama {

                font-size: 15px;
            }

        }

    </style>

</head>


<body>


<main class="admin-content">


    <!-- =====================================================
         HEADER
    ====================================================== -->

    <div class="guru-header">

        <div class="guru-header-content">


            <div class="guru-title">

                <div class="guru-title-icon">

                    <span class="glyphicon glyphicon-education"></span>

                </div>


                <div>

                    <h1>
                        Data Guru
                    </h1>

                    <p>
                        Kelola data guru MTs Nurul Huda Pematang Cengal
                    </p>

                </div>

            </div>


            <a href="tambah_guru.php"
               class="btn btn-tambah">

                <span class="glyphicon glyphicon-plus"></span>

                &nbsp; Tambah Guru

            </a>


        </div>

    </div>



    <!-- =====================================================
         BOX DATA
    ====================================================== -->

    <div class="guru-box">


        <!-- SEARCH -->

        <div class="guru-toolbar">

            <form method="GET"
                  class="search-form">


                <input
                    type="text"
                    name="cari"
                    class="form-control search-input"
                    placeholder="Cari nama guru, mata pelajaran, jabatan..."
                    value="<?php

                    if (isset($_GET['cari'])) {

                        echo htmlspecialchars(
                            $_GET['cari']
                        );

                    }

                    ?>">


                <button
                    type="submit"
                    class="btn btn-success btn-cari">

                    <span class="glyphicon glyphicon-search"></span>

                    Cari

                </button>


                <a
                    href="data_guru_admin.php"
                    class="btn btn-default btn-reset">

                    <span class="glyphicon glyphicon-refresh"></span>

                    Reset

                </a>


            </form>

        </div>



        <!-- INFO -->

        <div class="data-info">

            <span class="glyphicon glyphicon-info-sign"></span>

            &nbsp;

            Menampilkan

            <strong>

                <?php

                echo mysqli_num_rows($query);

                ?>

            </strong>

            data guru.

            <?php

            if (
                isset($_GET['cari']) &&
                $_GET['cari'] != ''
            ) {

                echo ' Hasil pencarian untuk: <strong>"'
                    . htmlspecialchars($_GET['cari'])
                    . '"</strong>';

            }

            ?>

        </div>



        <!-- =================================================
             GRID DATA GURU
        ================================================== -->

        <?php

        if (mysqli_num_rows($query) > 0) {

        ?>

            <div class="guru-grid">

                <?php

                while (
                    $data = mysqli_fetch_assoc($query)
                ) {

                ?>

                    <!-- CARD GURU -->

                    <div class="guru-card">


                        <!-- GAMBAR -->

                        <div class="guru-gambar">

                            <?php

                            if (
                                !empty($data['gambar']) &&
                                file_exists("../images/" . $data['gambar'])
                            ) {

                            ?>

                                <img
                                    src="../images/<?php
                                    echo htmlspecialchars(
                                        $data['gambar']
                                    );
                                    ?>"
                                    alt="<?php
                                    echo htmlspecialchars(
                                        $data['nama_guru']
                                    );
                                    ?>">

                            <?php

                            } else {

                            ?>

                                <div class="gambar-kosong">

                                    <span class="glyphicon glyphicon-user"></span>

                                    <span>
                                        Tidak ada gambar
                                    </span>

                                </div>

                            <?php

                            }

                            ?>

                        </div>



                        <!-- INFORMASI -->

                        <div class="guru-info">


                            <!-- MATA PELAJARAN -->

                            <div class="guru-mapel">

                                <?php

                                if (
                                    !empty($data['mata_pelajaran'])
                                ) {

                                    echo htmlspecialchars(
                                        $data['mata_pelajaran']
                                    );

                                } else {

                                    echo "Mata Pelajaran";

                                }

                                ?>

                            </div>



                            <!-- NAMA -->

                            <div class="guru-nama">

                                <?php

                                echo htmlspecialchars(
                                    $data['nama_guru']
                                );

                                ?>

                            </div>



                            <!-- JABATAN -->

                            <div class="guru-jabatan">

                                <?php

                                if (
                                    !empty($data['jabatan'])
                                ) {

                                    echo htmlspecialchars(
                                        $data['jabatan']
                                    );

                                } else {

                                    echo "Guru";

                                }

                                ?>

                            </div>


                        </div>



                        <!-- AKSI -->

                        <div class="guru-aksi">


                            <a
                                href="edit_data_guru.php?id=<?php
                                echo $data['id_guru'];
                                ?>"
                                class="btn btn-edit">

                                <span class="glyphicon glyphicon-edit"></span>

                                Edit

                            </a>



                            <a
                                href="hapus_data_guru_admin.php?id=<?php
                                echo $data['id_guru'];
                                ?>"
                                class="btn btn-hapus"
                                onclick="return confirm('Yakin ingin menghapus data guru ini?');">

                                <span class="glyphicon glyphicon-trash"></span>

                                Hapus

                            </a>


                        </div>


                    </div>


                <?php

                }

                ?>

            </div>


        <?php

        } else {

        ?>

            <!-- DATA KOSONG -->

            <div class="data-kosong">

                <span class="glyphicon glyphicon-info-sign"></span>

                Data guru tidak ditemukan.

            </div>

        <?php

        }

        ?>


    </div>


</main>



<script src="../bootstrap/js/jquery.min.js"></script>

<script src="../bootstrap/js/bootstrap.min.js"></script>


</body>

</html>