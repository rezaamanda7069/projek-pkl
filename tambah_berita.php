<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

include "../koneksi.php";


if (isset($_POST['simpan'])) {

    $judul = mysqli_real_escape_string(
        $koneksi,
        $_POST['judul']
    );

    $isi = mysqli_real_escape_string(
        $koneksi,
        $_POST['isi']
    );

    $tanggal = mysqli_real_escape_string(
        $koneksi,
        $_POST['tanggal']
    );

    $gambar = "";

    /* Upload gambar */

    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] == 0) {

        $nama_file = $_FILES['gambar']['name'];
        $tmp_file  = $_FILES['gambar']['tmp_name'];

        $ekstensi = strtolower(
            pathinfo($nama_file, PATHINFO_EXTENSION)
        );

        $ekstensi_diperbolehkan = array(
            'jpg',
            'jpeg',
            'png',
            'gif'
        );

        if (in_array($ekstensi, $ekstensi_diperbolehkan)) {

            $gambar = time() . "_" . $nama_file;

            move_uploaded_file(
                $tmp_file,
                "../images/" . $gambar
            );

        }
    }

    $query = mysqli_query(
        $koneksi,
        "INSERT INTO berita
        (judul, isi, tanggal, gambar)
        VALUES
        ('$judul', '$isi', '$tanggal', '$gambar')"
    );

    if ($query) {

        header("Location: berita_admin.php?pesan=inputBerhasil");
        exit;

    } else {

        $error = "Data berita gagal disimpan.";

    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="utf-8">

<meta name="viewport"
      content="width=device-width, initial-scale=1">

<title>Tambah Berita</title>

<link href="../bootstrap/css/bootstrap.min.css"rel="stylesheet">

<style>

body{
    padding-top:85px;
    background:#f5f5f5;
}

/* Panel */

.panel-berita{
    border-radius:6px;
    border:1px solid #d6e9c6;
    box-shadow:0 2px 8px rgba(0,0,0,0.10);
    background:#fff;
}

/* Header */

.panel-berita .panel-heading{
    background:#dff0d8;
    border-color:#d6e9c6;
    padding:15px 20px;
}

.panel-berita .panel-title{
    font-size:20px;
    font-weight:bold;
    color:#2e7d32;
}

/* Body */

.panel-berita .panel-body{
    padding:25px;
}

/* Label */

.form-group label{
    font-weight:bold;
    color:#444;
}

/* Input */

.form-control{
    border-radius:4px;
}

/* Textarea */

textarea.form-control{
    min-height:180px;
    resize:vertical;
}

/* Upload */

input[type="file"]{
    padding:6px;
    height:auto;
}

/* Tombol */

.btn{
    margin:2px;
}

/* Tombol bawah */

.area-tombol{
    margin-top:20px;
    padding-top:15px;
    border-top:1px solid #eee;
}

/* Responsive HP */

@media(max-width:767px){

    body{
        padding-top:75px;
    }

    .panel-berita{
        margin:10px 0;
    }

    .panel-berita .panel-heading{
        text-align:center;
        padding:13px;
    }

    .panel-berita .panel-title{
        font-size:18px;
    }

    .panel-berita .panel-body{
        padding:15px;
    }

    textarea.form-control{
        min-height:150px;
    }

    .area-tombol{
        text-align:center;
    }

    .area-tombol .btn{
        width:100%;
        margin-bottom:8px;
    }

}

</style>

</head>

<body>

<div class="container">

    <div class="row">

        <div class="col-md-10 col-md-offset-1">

            <div class="panel panel-success panel-berita">

                <!-- HEADER -->

                <div class="panel-heading">

                    <h3 class="panel-title">

                        <span class="glyphicon glyphicon-plus"></span>

                        Tambah Berita

                    </h3>

                </div>


                <!-- BODY -->

                <div class="panel-body">

                    <?php if(isset($error)){ ?>

                        <div class="alert alert-danger">

                            <span class="glyphicon glyphicon-warning-sign"></span>

                            <?php echo $error; ?>

                        </div>

                    <?php } ?>


                    <form method="POST"
                          enctype="multipart/form-data">


                        <!-- JUDUL -->

                        <div class="form-group">

                            <label>
                                Judul Berita
                            </label>

                            <input
                                type="text"
                                name="judul"
                                class="form-control"
                                placeholder="Masukkan judul berita"
                                required>

                        </div>


                        <!-- ISI -->

                        <div class="form-group">

                            <label>
                                Isi Berita
                            </label>

                            <textarea
                                name="isi"
                                class="form-control"
                                placeholder="Masukkan isi berita"
                                required></textarea>

                        </div>


                        <!-- TANGGAL -->

                        <div class="form-group">

                            <label>
                                Tanggal
                            </label>

                            <input
                                type="date"
                                name="tanggal"
                                class="form-control"
                                value="<?php echo date('Y-m-d'); ?>"
                                required>

                        </div>


                        <!-- GAMBAR -->

                        <div class="form-group">

                            <label>
                                Upload Gambar
                            </label>

                            <input
                                type="file"
                                name="gambar"
                                class="form-control"
                                accept=".jpg,.jpeg,.png,.gif">

                            <p class="help-block">
                                Format: JPG, JPEG, PNG atau GIF.
                            </p>

                        </div>


                        <!-- TOMBOL -->

                        <div class="area-tombol">

                            <button
                                type="submit"
                                name="simpan"
                                class="btn btn-success">

                                <span class="glyphicon glyphicon-save"></span>

                                Simpan

                            </button>


                            <a
                                href="berita_admin.php"
                                class="btn btn-default">

                                <span class="glyphicon glyphicon-arrow-left"></span>

                                Kembali

                            </a>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>


<script src="../bootstrap/js/jquery.min.js"></script>

<script src="../bootstrap/js/bootstrap.min.js"></script>

</body>

</html>