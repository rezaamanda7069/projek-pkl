<?php

session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

include "../koneksi.php";
include "navbar_admin.php";


if (isset($_POST['simpan'])) {

    $nama_kepala = mysqli_real_escape_string(
        $koneksi,
        $_POST['nama_kepala']
    );

    $jabatan = mysqli_real_escape_string(
        $koneksi,
        $_POST['jabatan']
    );

    $isi_sambutan = mysqli_real_escape_string(
        $koneksi,
        $_POST['isi_sambutan']
    );

    $status = mysqli_real_escape_string(
        $koneksi,
        $_POST['status']
    );


    /* ================================
       UPLOAD FOTO
    ================================= */

    $foto = "";

    if (
        isset($_FILES['foto']) &&
        $_FILES['foto']['error'] == 0
    ) {

        $nama_file =
            $_FILES['foto']['name'];

        $tmp_file =
            $_FILES['foto']['tmp_name'];

        $ukuran =
            $_FILES['foto']['size'];


        $ekstensi =
            strtolower(
                pathinfo(
                    $nama_file,
                    PATHINFO_EXTENSION
                )
            );


        $ekstensi_diperbolehkan = [
            'jpg',
            'jpeg',
            'png'
        ];


        if (
            !in_array(
                $ekstensi,
                $ekstensi_diperbolehkan
            )
        ) {

            echo "<script>
                    alert('Format foto harus JPG, JPEG, atau PNG.');
                    window.history.back();
                  </script>";

            exit;

        }


        if ($ukuran > 2 * 1024 * 1024) {

            echo "<script>
                    alert('Ukuran foto maksimal 2 MB.');
                    window.history.back();
                  </script>";

            exit;

        }


        $nama_baru =
            'kepala_' .
            time() .
            '_' .
            uniqid() .
            '.' .
            $ekstensi;


        $folder =
            "../images/";


        if (
            move_uploaded_file(
                $tmp_file,
                $folder . $nama_baru
            )
        ) {

            $foto = $nama_baru;

        } else {

            echo "<script>
                    alert('Foto gagal diupload.');
                    window.history.back();
                  </script>";

            exit;

        }

    }


    /* ================================
       JIKA STATUS AKTIF
       NONAKTIFKAN DATA AKTIF LAIN
    ================================= */

    if ($status == "Aktif") {

        mysqli_query(
            $koneksi,
            "UPDATE sambutan
             SET status = 'Tidak Aktif'"
        );

    }


    /* ================================
       SIMPAN DATA
    ================================= */

    $insert = mysqli_query(
        $koneksi,
        "INSERT INTO sambutan
        (
            nama_kepala,
            jabatan,
            foto,
            isi_sambutan,
            status
        )
        VALUES
        (
            '$nama_kepala',
            '$jabatan',
            '$foto',
            '$isi_sambutan',
            '$status'
        )"
    );


    if ($insert) {

        echo "<script>
                alert('Data sambutan berhasil disimpan.');
                window.location='sambutan_admin.php';
              </script>";

        exit;

    } else {

        echo "<script>
                alert('Data gagal disimpan: " .
                mysqli_error($koneksi) .
                "');
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
        content="width=device-width, initial-scale=1">

    <title>
        Tambah Sambutan
    </title>

    <link
        href="../bootstrap/css/bootstrap.min.css"
        rel="stylesheet">

    <style>

        body {
            background: #f5f7f6;
        }

        .form-container {
            max-width: 850px;
            margin: 30px auto;
        }

        .panel {
            border: none;
            border-radius: 8px;
            box-shadow: 0 3px 15px rgba(0,0,0,0.08);
        }

        .panel-heading {
            background: #087f3d !important;
            color: white !important;
        }

        textarea {
            resize: vertical;
            min-height: 220px;
        }

    </style>

</head>

<body>


<div class="admin-content">

    <div class="panel panel-success">

        <div class="panel-heading">

            <h3 class="panel-title">

                <span
                    class="glyphicon glyphicon-plus">
                </span>

                Tambah Sambutan Kepala Madrasah

            </h3>

        </div>


        <div class="panel-body">

            <form
                method="post"
                enctype="multipart/form-data">


                <div class="form-group">

                    <label>
                        Nama Kepala Madrasah
                    </label>

                    <input
                        type="text"
                        name="nama_kepala"
                        class="form-control"
                        placeholder="Masukkan nama kepala madrasah"
                        required>

                </div>


                <div class="form-group">

                    <label>
                        Jabatan
                    </label>

                    <input
                        type="text"
                        name="jabatan"
                        class="form-control"
                        value="Kepala Madrasah"
                        required>

                </div>


                <div class="form-group">

                    <label>
                        Foto Kepala Madrasah
                    </label>

                    <input
                        type="file"
                        name="foto"
                        class="form-control"
                        accept=".jpg,.jpeg,.png">

                    <p class="help-block">
                        Format JPG, JPEG, PNG. Maksimal 2 MB.
                    </p>

                </div>


                <div class="form-group">

                    <label>
                        Isi Sambutan
                    </label>

                    <textarea
                        name="isi_sambutan"
                        class="form-control"
                        placeholder="Tuliskan sambutan kepala madrasah..."
                        required></textarea>

                </div>


                <div class="form-group">

                    <label>
                        Status
                    </label>

                    <select
                        name="status"
                        class="form-control">

                        <option value="Aktif">
                            Aktif
                        </option>

                        <option value="Tidak Aktif">
                            Tidak Aktif
                        </option>

                    </select>

                </div>


                <hr>


                <button
                    type="submit"
                    name="simpan"
                    class="btn btn-success">

                    <span
                        class="glyphicon glyphicon-save">
                    </span>

                    Simpan

                </button>


                <a
                    href="sambutan_admin.php"
                    class="btn btn-default">

                    <span
                        class="glyphicon glyphicon-arrow-left">
                    </span>

                    Kembali

                </a>


            </form>

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