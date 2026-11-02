<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

include "../koneksi.php";
include "navbar_admin.php";

/* =====================================================
   CEK ID GURU
===================================================== */

if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "<script>
            alert('ID guru tidak ditemukan');
            window.location='data_guru_admin.php';
          </script>";
    exit;
}

$id = mysqli_real_escape_string($koneksi, $_GET['id']);


/* =====================================================
   AMBIL DATA GURU
===================================================== */

$query = mysqli_query(
    $koneksi,
    "SELECT * FROM guru WHERE id_guru='$id'"
);

if (mysqli_num_rows($query) == 0) {
    echo "<script>
            alert('Data guru tidak ditemukan');
            window.location='data_guru_admin.php';
          </script>";
    exit;
}

$row = mysqli_fetch_assoc($query);


/* =====================================================
   PROSES UPDATE
===================================================== */

if (isset($_POST['update'])) {

    $nama = mysqli_real_escape_string(
        $koneksi,
        $_POST['nama_guru']
    );

    $jabatan = mysqli_real_escape_string(
        $koneksi,
        $_POST['jabatan']
    );

    $mapel = mysqli_real_escape_string(
        $koneksi,
        $_POST['mata_pelajaran']
    );


    /* =================================================
       GAMBAR LAMA
    ================================================= */

    $gambar_lama = $row['gambar'];

    $nama_gambar = $gambar_lama;


    /* =================================================
       CEK UPLOAD GAMBAR
    ================================================= */

    if (
        isset($_FILES['gambar']) &&
        $_FILES['gambar']['error'] != UPLOAD_ERR_NO_FILE
    ) {

        $file = $_FILES['gambar'];

        $nama_file = $file['name'];
        $tmp_file  = $file['tmp_name'];
        $ukuran    = $file['size'];
        $error     = $file['error'];

        /* ---------------------------------------------
           CEK ERROR UPLOAD
        --------------------------------------------- */

        if ($error !== UPLOAD_ERR_OK) {

            echo "<script>
                    alert('Gambar gagal diupload');
                  </script>";

        } else {

            /* -----------------------------------------
               EXTENSION FILE
            ----------------------------------------- */

            $extension = strtolower(
                pathinfo($nama_file, PATHINFO_EXTENSION)
            );

            $extension_diperbolehkan = array(
                'jpg',
                'jpeg',
                'png',
                'gif'
            );


            /* -----------------------------------------
               CEK FORMAT
            ----------------------------------------- */

            if (!in_array(
                $extension,
                $extension_diperbolehkan
            )) {

                echo "<script>
                        alert('Format gambar harus JPG, JPEG, PNG atau GIF');
                      </script>";

            }
            /* -----------------------------------------
               CEK UKURAN
            ----------------------------------------- */
            elseif ($ukuran > 2 * 1024 * 1024) {

                echo "<script>
                        alert('Ukuran gambar maksimal 2 MB');
                      </script>";

            } else {

                /* -------------------------------------
                   BUAT NAMA FILE BARU
                ------------------------------------- */

                $nama_gambar =
                    'guru_' .
                    time() .
                    '_' .
                    rand(100, 999) .
                    '.' .
                    $extension;


                $folder_gambar = "../images/";


                /* -------------------------------------
                   PINDAHKAN GAMBAR
                ------------------------------------- */

                if (
                    move_uploaded_file(
                        $tmp_file,
                        $folder_gambar . $nama_gambar
                    )
                ) {

                    /* ---------------------------------
                       HAPUS GAMBAR LAMA
                    --------------------------------- */

                    if (
                        !empty($gambar_lama) &&
                        file_exists(
                            $folder_gambar . $gambar_lama
                        )
                    ) {

                        unlink(
                            $folder_gambar . $gambar_lama
                        );
                    }

                } else {

                    echo "<script>
                            alert('Gagal menyimpan gambar');
                          </script>";

                    $nama_gambar = $gambar_lama;
                }
            }
        }
    }


    /* =================================================
       UPDATE DATABASE
    ================================================= */

    $update = mysqli_query(
        $koneksi,
        "UPDATE guru SET

            nama_guru='$nama',
            jabatan='$jabatan',
            mata_pelajaran='$mapel',
            gambar='$nama_gambar'

         WHERE id_guru='$id'"
    );


    /* =================================================
       HASIL UPDATE
    ================================================= */

    if ($update) {

        echo "<script>
                alert('Data guru berhasil diperbarui');
                window.location='data_guru_admin.php';
              </script>";

        exit;

    } else {

        echo "<script>
                alert('Data guru gagal diperbarui');
              </script>";
    }
}

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Edit Data Guru - Admin</title>

    <link
        href="../bootstrap/css/bootstrap.min.css"
        rel="stylesheet"
    >


    <style>

        html,
        body {

            margin: 0;
            padding: 0;

            background: #f4f7f5;

            font-family:
                Arial,
                Helvetica,
                sans-serif;
        }


        /* =====================================================
           AREA CONTENT
        ===================================================== */

        .edit-page {

            margin-left: 250px;

            width: calc(100% - 250px);

            min-height: 100vh;

            padding: 30px;

            box-sizing: border-box;
        }


        .edit-wrapper {

            width: 100%;

            max-width: 1000px;

            margin: 0 auto;
        }


        /* =====================================================
           HEADER
        ===================================================== */

        .edit-header {

            background: #ffffff;

            border-radius: 14px;

            padding: 24px 28px;

            margin-bottom: 20px;

            border: 1px solid #e5ebe7;

            box-shadow:
                0 4px 18px rgba(20, 50, 30, 0.06);
        }


        .edit-header-content {

            display: flex;

            align-items: center;

            gap: 15px;
        }


        .edit-icon {

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
        }


        .edit-header h2 {

            margin: 0;

            color: #173522;

            font-size: 24px;

            font-weight: 700;
        }


        .edit-header p {

            margin: 5px 0 0;

            color: #718078;

            font-size: 13px;
        }


        /* =====================================================
           CARD
        ===================================================== */

        .edit-card {

            background: #ffffff;

            border: 1px solid #e5ebe7;

            border-radius: 14px;

            box-shadow:
                0 4px 18px rgba(20, 50, 30, 0.06);

            overflow: hidden;
        }


        .card-title {

            padding: 18px 25px;

            border-bottom: 1px solid #e8edea;

            font-size: 15px;

            font-weight: bold;

            color: #222;
        }


        .card-title .glyphicon {

            color: #087f3d;

            margin-right: 8px;
        }


        /* =====================================================
           FORM
        ===================================================== */

        .edit-form {

            padding: 25px;
        }


        .form-group {

            margin-bottom: 20px;
        }


        .form-group label {

            font-size: 13px;

            font-weight: 600;

            color: #333;

            margin-bottom: 7px;
        }


        .form-control {

            height: 42px;

            border-radius: 8px;

            border: 1px solid #d9e1dd;

            box-shadow: none;

            font-size: 13px;
        }


        .form-control:focus {

            border-color: #087f3d;

            box-shadow:
                0 0 0 2px rgba(8,127,61,0.08);
        }


        /* =====================================================
           PREVIEW GAMBAR
        ===================================================== */

        .gambar-preview {

            width: 180px;

            height: 210px;

            border-radius: 10px;

            overflow: hidden;

            border: 1px solid #dfe7e2;

            background: #f1f4f2;

            margin-bottom: 12px;
        }


        .gambar-preview img {

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

            flex-direction: column;

            align-items: center;

            justify-content: center;

            color: #9aa59f;
        }


        .gambar-kosong .glyphicon {

            font-size: 45px;

            margin-bottom: 8px;
        }


        .gambar-info {

            color: #777;

            font-size: 11px;

            margin-top: 7px;
        }


        /* =====================================================
           BUTTON
        ===================================================== */

        .form-footer {

            border-top: 1px solid #eeeeee;

            padding-top: 20px;

            margin-top: 10px;

            display: flex;

            justify-content: flex-end;

            gap: 10px;
        }


        .form-footer .btn {

            border-radius: 8px;

            padding: 10px 18px;

            font-size: 13px;
        }


        .btn-success {

            background: #087f3d;

            border-color: #087f3d;
        }


        .btn-success:hover {

            background: #066b33;

            border-color: #066b33;
        }


        /* =====================================================
           MOBILE
        ===================================================== */

        @media (max-width: 991px) {

            .edit-page {

                margin-left: 220px;

                width: calc(100% - 220px);

                padding: 20px;
            }
        }


        @media (max-width: 767px) {

            .edit-page {

                margin-left: 0;

                width: 100%;

                padding: 70px 15px 25px;
            }


            .edit-header {

                padding: 18px;

                border-radius: 12px;
            }


            .edit-header h2 {

                font-size: 20px;
            }


            .edit-header p {

                font-size: 12px;

                line-height: 1.5;
            }


            .edit-icon {

                width: 45px;

                height: 45px;

                min-width: 45px;

                font-size: 19px;
            }


            .edit-form {

                padding: 18px;
            }


            .gambar-preview {

                width: 150px;

                height: 180px;

                margin-left: auto;

                margin-right: auto;
            }


            .form-footer {

                display: flex;

                flex-direction: column-reverse;
            }


            .form-footer .btn {

                width: 100%;

                margin: 0;
            }
        }


        @media (max-width: 480px) {

            .edit-page {

                padding:
                    65px 10px 20px;
            }


            .edit-header {

                padding: 15px;
            }


            .edit-header h2 {

                font-size: 18px;
            }


            .edit-header p {

                font-size: 11px;
            }


            .edit-form {

                padding: 15px;
            }


            .card-title {

                padding: 15px;
            }
        }

    </style>

</head>


<body>


<div class="edit-page">

    <div class="edit-wrapper">


        <!-- =================================================
             HEADER
        ================================================== -->

        <div class="edit-header">

            <div class="edit-header-content">

                <div class="edit-icon">

                    <span
                        class="glyphicon glyphicon-edit">
                    </span>

                </div>


                <div>

                    <h2>
                        Edit Data Guru
                    </h2>

                    <p>
                        Perbarui gambar, nama, jabatan dan mata pelajaran guru
                    </p>

                </div>

            </div>

        </div>



        <!-- =================================================
             CARD
        ================================================== -->

        <div class="edit-card">


            <div class="card-title">

                <span
                    class="glyphicon glyphicon-user">
                </span>

                Informasi Guru

            </div>



            <form
                method="POST"
                enctype="multipart/form-data"
                class="edit-form"
            >


                <!-- =================================================
                     GAMBAR
                ================================================== -->

                <div class="form-group">

                    <label>
                        Gambar Guru
                    </label>


                    <div class="gambar-preview">

                        <?php

                        if (
                            !empty($row['gambar']) &&
                            file_exists(
                                "../images/" . $row['gambar']
                            )
                        ) {

                        ?>

                            <img
                                src="../images/<?php
                                    echo htmlspecialchars(
                                        $row['gambar']
                                    );
                                ?>"
                                alt="Gambar Guru"
                            >

                        <?php

                        } else {

                        ?>

                            <div class="gambar-kosong">

                                <span
                                    class="glyphicon glyphicon-user">
                                </span>

                                <span>
                                    Tidak ada gambar
                                </span>

                            </div>

                        <?php

                        }

                        ?>

                    </div>


                    <input
                        type="file"
                        name="gambar"
                        class="form-control"
                        accept=".jpg,.jpeg,.png,.gif"
                    >


                    <div class="gambar-info">

                        Format:
                        JPG, JPEG, PNG, GIF.
                        Maksimal 2 MB.

                    </div>

                </div>



                <!-- =================================================
                     NAMA
                ================================================== -->

                <div class="form-group">

                    <label>
                        Nama Guru
                    </label>

                    <input
                        type="text"
                        name="nama_guru"
                        class="form-control"
                        value="<?php
                            echo htmlspecialchars(
                                $row['nama_guru']
                            );
                        ?>"
                        placeholder="Masukkan nama guru"
                        required
                    >

                </div>



                <!-- =================================================
                     JABATAN
                ================================================== -->

                <div class="form-group">

                    <label>
                        Jabatan
                    </label>

                    <input
                        type="text"
                        name="jabatan"
                        class="form-control"
                        value="<?php
                            echo htmlspecialchars(
                                $row['jabatan']
                            );
                        ?>"
                        placeholder="Masukkan jabatan"
                        required
                    >

                </div>



                <!-- =================================================
                     MATA PELAJARAN
                ================================================== -->

                <div class="form-group">

                    <label>
                        Mata Pelajaran
                    </label>

                    <input
                        type="text"
                        name="mata_pelajaran"
                        class="form-control"
                        value="<?php
                            echo htmlspecialchars(
                                $row['mata_pelajaran']
                            );
                        ?>"
                        placeholder="Masukkan mata pelajaran"
                        
                    >

                </div>



                <!-- =================================================
                     BUTTON
                ================================================== -->

                <div class="form-footer">


                    <a
                        href="data_guru_admin.php"
                        class="btn btn-default"
                    >

                        <span
                            class="glyphicon glyphicon-arrow-left">
                        </span>

                        Kembali

                    </a>


                    <button
                        type="submit"
                        name="update"
                        class="btn btn-success"
                    >

                        <span
                            class="glyphicon glyphicon-floppy-disk">
                        </span>

                        Simpan Perubahan

                    </button>


                </div>


            </form>

        </div>


    </div>

</div>



<script src="../bootstrap/js/jquery.min.js"></script>

<script src="../bootstrap/js/bootstrap.min.js"></script>


</body>

</html>