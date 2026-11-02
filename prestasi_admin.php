<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

include "../koneksi.php";
 include "navbar_admin.php"; 

// =========================
// PENCARIAN DATA PRESTASI
// =========================

if (isset($_GET['cari']) && $_GET['cari'] != '') {

    $cari = mysqli_real_escape_string(
        $koneksi,
        $_GET['cari']
    );

    $query = mysqli_query(
        $koneksi,
        "SELECT * FROM prestasi
         WHERE nama_prestasi LIKE '%$cari%'
         OR tingkat LIKE '%$cari%'
         OR penyelenggara LIKE '%$cari%'
         OR tahun LIKE '%$cari%'
         OR deskripsi LIKE '%$cari%'
         ORDER BY tahun DESC"
    );

} else {

    $query = mysqli_query(
        $koneksi,
        "SELECT * FROM prestasi
         ORDER BY tahun DESC"
    );
}

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="utf-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1">

    <title>Data Prestasi - Admin</title>

    <!-- Bootstrap 3 -->
    <link href="../bootstrap/css/bootstrap.min.css"
          rel="stylesheet">

    <style>

        body {
           
            background: #f5f5f5;
        }

        .container {
            background: #fff;
            padding: 20px;
            border-radius: 4px;
        }

        .judul {
            margin-bottom: 20px;
        }

        .judul h2 {
            margin-top: 0;
            color: #333;
        }

        .judul p {
            color: #777;
        }

        .gambar-prestasi {
            width: 100px;
            height: 70px;
            object-fit: cover;
        }

        .search-box {
            margin-bottom: 20px;
        }

        .table th {
            text-align: center;
            vertical-align: middle !important;
        }

        .table td {
            vertical-align: middle !important;
        }

        .aksi {
            white-space: nowrap;
        }

       
            

            .container {
                padding: 15px;
            }

            .judul h2 {
                font-size: 24px;
            }

            .tambah {
                margin-top: 15px;
                text-align: left;
            }

            .search-box .btn {
                padding-left: 10px;
                padding-right: 10px;
            }

            .gambar-prestasi {
                width: 80px;
                height: 60px;
            }

        
    </style>

</head>


<body>

<div class="admin-content">

<div class="judul">

    <div class="row">

        <!-- Judul -->
        <div class="col-sm-8">

            <h2>
                <span class="glyphicon glyphicon-star"></span>
                Data Prestasi
            </h2>

            <p>
                Kelola data prestasi MTs Nurul Huda Pematang Cengal
            </p>

        </div>


        <!-- Tombol Tambah -->
        <div class="col-sm-4">

            <div class="text-right">

                <a href="tambah_prestasi_admin.php"
                   class="btn btn-success">

                    <span class="glyphicon glyphicon-plus"></span>
                    Tambah Prestasi

                </a>

            </div>

        </div>

    </div>

</div>
    <div class="row search-box">

        <div class="col-sm-7 col-md-6">

            <form method="GET">

                <div class="input-group">

                    <input type="text"
                           name="cari"
                           class="form-control"
                           placeholder="Cari prestasi..."
                           value="<?php

                           if (isset($_GET['cari'])) {

                               echo htmlspecialchars(
                                   $_GET['cari']
                               );

                           }

                           ?>">

                    <span class="input-group-btn">

                        <button type="submit"
                                class="btn btn-primary">

                            <span class="glyphicon glyphicon-search"></span>

                            Cari

                        </button>

                    </span>

                </div>

            </form>

        </div>


        <div class="col-sm-5 col-md-6"
             style="margin-top:0;">

            <a href="prestasi_admin.php"
               class="btn btn-default">

                <span class="glyphicon glyphicon-refresh"></span>

                Reset

            </a>

        </div>

    </div>



    <!-- =========================
         TABEL
    ========================== -->

    <div class="table-responsive">

        <table class="table table-bordered table-hover">

            <thead>

                <tr class="success">

                    <th>No</th>

                    <th>Gambar</th>

                    <th>Nama Prestasi</th>

                    <th>Tingkat</th>

                    <th>Penyelenggara</th>

                    <th>Tahun</th>

                    <th>Deskripsi</th>

                    <th>Aksi</th>

                </tr>

            </thead>


            <tbody>


            <?php

            $no = 1;


            if ($query && mysqli_num_rows($query) > 0) {


                while ($data = mysqli_fetch_assoc($query)) {

            ?>

                <tr>


                    <!-- NO -->

                    <td class="text-center">

                        <?php echo $no++; ?>

                    </td>


                    <!-- GAMBAR -->

                    <td class="text-center">

                        <?php

                        if (!empty($data['gambar'])) {

                        ?>

                            <img src="../images/<?php
                                echo htmlspecialchars(
                                    $data['gambar']
                                );
                            ?>"
                            class="img-thumbnail gambar-prestasi">

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


                    <!-- NAMA -->

                    <td>

                        <strong>

                            <?php

                            echo htmlspecialchars(
                                $data['nama_prestasi']
                            );

                            ?>

                        </strong>

                    </td>


                    <!-- TINGKAT -->

                    <td>

                        <?php

                        echo htmlspecialchars(
                            $data['tingkat']
                        );

                        ?>

                    </td>


                    <!-- PENYELENGGARA -->

                    <td>

                        <?php

                        echo htmlspecialchars(
                            $data['penyelenggara']
                        );

                        ?>

                    </td>


                    <!-- TAHUN -->

                    <td class="text-center">

                        <?php

                        echo htmlspecialchars(
                            $data['tahun']
                        );

                        ?>

                    </td>


                    <!-- DESKRIPSI -->

                    <td>

                        <?php

                        $deskripsi = $data['deskripsi'];

                        if (strlen($deskripsi) > 100) {

                            echo htmlspecialchars(
                                substr($deskripsi, 0, 100)
                            );

                            echo "...";

                        } else {

                            echo htmlspecialchars(
                                $deskripsi
                            );

                        }

                        ?>

                    </td>


                    <!-- AKSI -->

                    <td class="aksi">

                        <a href="edit_prestasi_admin.php?id=<?php
                            echo $data['id_prestasi'];
                        ?>"
                        class="btn btn-warning btn-sm">

                            <span class="glyphicon glyphicon-edit"></span>

                            Edit

                        </a>


                        <a href="hapus_prestasi_admin.php?id=<?php
                            echo $data['id_prestasi'];
                        ?>"
                        class="btn btn-danger btn-sm"
                        onclick="return confirm(
                            'Yakin ingin menghapus prestasi ini?'
                        )">

                            <span class="glyphicon glyphicon-trash"></span>

                            Hapus

                        </a>

                    </td>


                </tr>


            <?php

                }

            } else {

            ?>


                <tr>

                    <td colspan="8"
                        class="text-center">

                        <span class="glyphicon glyphicon-info-sign"></span>

                        Belum ada data prestasi.

                    </td>

                </tr>


            <?php

            }

            ?>


            </tbody>

        </table>

    </div>


</div>



<!-- Bootstrap 3 -->

<script src="../bootstrap/js/jquery.min.js"></script>

<script src="../bootstrap/js/bootstrap.min.js"></script>


</body>

</html>