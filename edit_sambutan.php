<?php

session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

include "../koneksi.php";
include "navbar_admin.php";


if (
    !isset($_GET['id']) ||
    !is_numeric($_GET['id'])
) {

    die("ID sambutan tidak ditemukan.");

}


$id = intval($_GET['id']);


$query = mysqli_query(
    $koneksi,
    "SELECT *
     FROM sambutan
     WHERE id_sambutan = '$id'
     LIMIT 1"
);


if (mysqli_num_rows($query) == 0) {

    die("Data sambutan tidak ditemukan.");

}


$data = mysqli_fetch_assoc($query);


/* =====================================
   PROSES UPDATE
===================================== */

if (isset($_POST['update'])) {

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


    $foto_lama =
        $data['foto'];

    $foto_baru =
        $foto_lama;


    /* =================================
       UPLOAD FOTO BARU
    ================================= */

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


        $foto_baru =
            'kepala_' .
            time() .
            '_' .
            uniqid() .
            '.' .
            $ekstensi;


        if (
            move_uploaded_file(
                $tmp_file,
                "../images/" . $foto_baru
            )
        ) {


            /* HAPUS FOTO LAMA */

            if (
                !empty($foto_lama) &&
                file_exists(
                    "../images/" .
                    $foto_lama
                )
            ) {

                unlink(
                    "../images/" .
                    $foto_lama
                );

            }

        } else {

            echo "<script>
                    alert('Foto baru gagal diupload.');
                    window.history.back();
                  </script>";

            exit;

        }

    }


    /* =================================
       JIKA AKTIF
    ================================= */

    if ($status == "Aktif") {

        mysqli_query(
            $koneksi,
            "UPDATE sambutan
             SET status = 'Tidak Aktif'
             WHERE id_sambutan != '$id'"
        );

    }


    /* =================================
       UPDATE DATA
    ================================= */

    $update = mysqli_query(
        $koneksi,
        "UPDATE sambutan SET

            nama_kepala = '$nama_kepala',

            jabatan = '$jabatan',

            foto = '$foto_baru',

            isi_sambutan = '$isi_sambutan',

            status = '$status'

         WHERE id_sambutan = '$id'"
    );


    if ($update) {

        echo "<script>
                alert('Data sambutan berhasil diperbarui.');
                window.location='sambutan_admin.php';
              </script>";

        exit;

    } else {

        echo "<script>
                alert('Data gagal diperbarui: " .
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
        Edit Sambutan
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

        .foto-preview {
            width: 140px;
            height: 140px;
            object-fit: cover;
            border-radius: 8px;
            border: 1px solid #ddd;
            margin-bottom: 10px;
        }

    </style>

</head>

<body>


<div class="container form-container">

    <div class="panel panel-success">

        <div class="panel-heading">

            <h3 class="panel-title">

                <span
                    class="glyphicon glyphicon-pencil">
                </span>

                Edit Sambutan Kepala Madrasah

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
                        value="<?php
                        echo htmlspecialchars(
                            $data['nama_kepala']
                        );
                        ?>"
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
                        value="<?php
                        echo htmlspecialchars(
                            $data['jabatan']
                        );
                        ?>"
                        required>

                </div>


                <div class="form-group">

                    <label>
                        Foto Saat Ini
                    </label>

                    <br>

                    <?php

                    if (
                        !empty(
                            $data['foto']
                        )
                    ) {

                    ?>

                        <img
                            src="../images/<?php
                            echo htmlspecialchars(
                                $data['foto']
                            );
                            ?>"
                            class="foto-preview"
                            alt="Foto Kepala Madrasah">

                    <?php

                    } else {

                    ?>

                        <p class="text-muted">
                            Belum ada foto.
                        </p>

                    <?php

                    }

                    ?>

                </div>


                <div class="form-group">

                    <label>
                        Ganti Foto
                    </label>

                    <input
                        type="file"
                        name="foto"
                        class="form-control"
                        accept=".jpg,.jpeg,.png">

                    <p class="help-block">
                        Kosongkan jika tidak ingin mengganti foto.
                        Maksimal 2 MB.
                    </p>

                </div>


                <div class="form-group">

                    <label>
                        Isi Sambutan
                    </label>

                    <textarea
                        name="isi_sambutan"
                        class="form-control"
                        required><?php
                        echo htmlspecialchars(
                            $data['isi_sambutan']
                        );
                        ?></textarea>

                </div>


                <div class="form-group">

                    <label>
                        Status
                    </label>

                    <select
                        name="status"
                        class="form-control">

                        <option
                            value="Aktif"
                            <?php
                            echo (
                                $data['status']
                                == 'Aktif'
                            )
                            ? 'selected'
                            : '';
                            ?>>

                            Aktif

                        </option>


                        <option
                            value="Tidak Aktif"
                            <?php
                            echo (
                                $data['status']
                                == 'Tidak Aktif'
                            )
                            ? 'selected'
                            : '';
                            ?>>

                            Tidak Aktif

                        </option>

                    </select>

                </div>


                <hr>


                <button
                    type="submit"
                    name="update"
                    class="btn btn-success">

                    <span
                        class="glyphicon glyphicon-save">
                    </span>

                    Simpan Perubahan

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