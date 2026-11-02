<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

include "../koneksi.php";

if (!isset($_GET['id'])) {
    header("Location: ekstrakurikuler_admin.php");
    exit;
}

$id = $_GET['id'];

$query = mysqli_query(
    $koneksi,
    "SELECT * FROM ekstrakurikuler WHERE id_ekskul='$id'"
);

$data = mysqli_fetch_assoc($query);

if (!$data) {
    echo "<script>
            alert('Data tidak ditemukan!');
            window.location='ekstrakurikuler_admin.php';
          </script>";
    exit;
}

if (isset($_POST['update'])) {

    $nama_ekskul = mysqli_real_escape_string(
        $koneksi,
        $_POST['nama_ekskul']
    );

    $pembina = mysqli_real_escape_string(
        $koneksi,
        $_POST['pembina']
    );

    $jadwal = mysqli_real_escape_string(
        $koneksi,
        $_POST['jadwal']
    );

    $deskripsi = mysqli_real_escape_string(
        $koneksi,
        $_POST['deskripsi']
    );

    $gambar = $data['gambar'];

    /*
     * Jika user memilih gambar baru
     */
    if (!empty($_FILES['gambar']['name'])) {

        $nama_gambar = $_FILES['gambar']['name'];
        $tmp_gambar  = $_FILES['gambar']['tmp_name'];

        $ekstensi = strtolower(
            pathinfo($nama_gambar, PATHINFO_EXTENSION)
        );

        $ekstensi_allowed = array(
            'jpg',
            'jpeg',
            'png',
            'gif'
        );

        if (!in_array($ekstensi, $ekstensi_allowed)) {

            echo "<script>
                    alert('Format gambar tidak diperbolehkan!');
                    window.history.back();
                  </script>";
            exit;
        }

        /*
         * Nama file baru
         */
        $gambar = time() . "_" . $nama_gambar;

        /*
         * Upload gambar baru
         */
        move_uploaded_file(
            $tmp_gambar,
            "../images/" . $gambar
        );
    }


    $update = mysqli_query(
        $koneksi,
        "UPDATE ekstrakurikuler SET
        nama_ekskul='$nama_ekskul',
        pembina='$pembina',
        jadwal='$jadwal',
        deskripsi='$deskripsi',
        gambar='$gambar'
        WHERE id_ekskul='$id'"
    );


    if ($update) {

        echo "<script>
                alert('Data ekstrakurikuler berhasil diperbarui!');
                window.location='ekstrakurikuler_admin.php';
              </script>";

    } else {

        echo "<script>
                alert('Data gagal diperbarui!');
              </script>";
    }
}

include "navbar_admin.php";
?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="utf-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1">

    <title>Edit Ekstrakurikuler</title>

    <link href="../bootstrap/css/bootstrap.min.css"
          rel="stylesheet">

    <style>

        body {
            padding-top: 90px;
            background: #f5f5f5;
        }

        .box-form {
            background: white;
            padding: 25px;
            border-radius: 5px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }

        .gambar-lama {
            width: 150px;
            height: 100px;
            object-fit: cover;
            margin-bottom: 10px;
        }

        @media (max-width: 767px) {

            body {
                padding-top: 75px;
            }

            .box-form {
                padding: 15px;
            }

            .gambar-lama {
                width: 120px;
                height: 80px;
            }

        }

    </style>

</head>

<body>

<div class="container">

    <div class="row">

        <div class="col-md-8 col-md-offset-2">

            <div class="box-form">

                <h2>
                    <span class="glyphicon glyphicon-edit"></span>
                    Edit Ekstrakurikuler
                </h2>

                <hr>


                <form method="POST"
                      enctype="multipart/form-data">


                    <!-- Nama -->
                    <div class="form-group">

                        <label>
                            Nama Ekstrakurikuler
                        </label>

                        <input type="text"
                               name="nama_ekskul"
                               class="form-control"
                               value="<?php echo htmlspecialchars($data['nama_ekskul']); ?>"
                               required>

                    </div>


                    <!-- Pembina -->
                    <div class="form-group">

                        <label>Pembina</label>

                        <input type="text"
                               name="pembina"
                               class="form-control"
                               value="<?php echo htmlspecialchars($data['pembina']); ?>"
                               required>

                    </div>


                    <!-- Jadwal -->
                    <div class="form-group">

                        <label>Jadwal</label>

                        <input type="text"
                               name="jadwal"
                               class="form-control"
                               value="<?php echo htmlspecialchars($data['jadwal']); ?>"
                               required>

                    </div>


                    <!-- Deskripsi -->
                    <div class="form-group">

                        <label>Deskripsi</label>

                        <textarea name="deskripsi"
                                  class="form-control"
                                  rows="5"
                                  required><?php echo htmlspecialchars($data['deskripsi']); ?></textarea>

                    </div>


                    <!-- Gambar lama -->
                    <div class="form-group">

                        <label>Gambar Saat Ini</label>

                        <br>

                        <?php if (!empty($data['gambar'])) { ?>

                            <img
                                src="../images/<?php echo htmlspecialchars($data['gambar']); ?>"
                                class="img-thumbnail gambar-lama">

                        <?php } else { ?>

                            <p class="text-muted">
                                Tidak ada gambar
                            </p>

                        <?php } ?>

                    </div>


                    <!-- Gambar baru -->
                    <div class="form-group">

                        <label>
                            Ganti Gambar
                        </label>

                        <input type="file"
                               name="gambar"
                               class="form-control">

                        <p class="help-block">
                            Kosongkan jika tidak ingin mengganti gambar.
                        </p>

                    </div>


                    <button type="submit"
                            name="update"
                            class="btn btn-success">

                        <span class="glyphicon glyphicon-save"></span>
                        Simpan Perubahan

                    </button>


                    <a href="ekstrakurikuler_admin.php"
                       class="btn btn-default">

                        Kembali

                    </a>

                </form>

            </div>

        </div>

    </div>

</div>


<script src="../bootstrap/js/jquery.min.js"></script>
<script src="../bootstrap/js/bootstrap.min.js"></script>

</body>

</html>