<?php

session_start();



if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}




include "../koneksi.php";




$folder_gambar = "../images/";



function e($value)
{
    return htmlspecialchars(
        $value ?? '',
        ENT_QUOTES,
        'UTF-8'
    );
}




$pesan = "";
$jenis_pesan = "";




if (isset($_POST['simpan'])) {

    $nama_fasilitas = mysqli_real_escape_string(
        $koneksi,
        trim($_POST['nama_fasilitas'])
    );

    $penjelasan = mysqli_real_escape_string(
        $koneksi,
        trim($_POST['penjelasan'])
    );


    

    if ($nama_fasilitas == "" || $penjelasan == "") {

        $pesan = "Nama fasilitas dan penjelasan wajib diisi.";
        $jenis_pesan = "danger";

    } elseif (!isset($_FILES['gambar']) || $_FILES['gambar']['error'] != 0) {

        $pesan = "Silakan pilih foto fasilitas.";
        $jenis_pesan = "danger";

    } else {

        $nama_file = $_FILES['gambar']['name'];
        $tmp_file = $_FILES['gambar']['tmp_name'];
        $ukuran_file = $_FILES['gambar']['size'];

        $ekstensi = strtolower(
            pathinfo(
                $nama_file,
                PATHINFO_EXTENSION
            )
        );


       

        $format_diizinkan = array(
            'jpg',
            'jpeg',
            'png',
            'webp'
        );


       

        $maksimal_ukuran = 2 * 1024 * 1024;


        if (!in_array($ekstensi, $format_diizinkan)) {

            $pesan = "Format foto harus JPG, JPEG, PNG, atau WEBP.";
            $jenis_pesan = "danger";

        } elseif ($ukuran_file > $maksimal_ukuran) {

            $pesan = "Ukuran foto maksimal 2 MB.";
            $jenis_pesan = "danger";

        } else {

           

            $cek_gambar = getimagesize($tmp_file);

            if ($cek_gambar === false) {

                $pesan = "File yang dipilih bukan gambar yang valid.";
                $jenis_pesan = "danger";

            } else {

                

                $nama_file_baru =
                    'fasilitas_' .
                    time() .
                    '_' .
                    rand(100, 999) .
                    '.' .
                    $ekstensi;


                $tujuan = $folder_gambar . $nama_file_baru;


                if (move_uploaded_file($tmp_file, $tujuan)) {

                    $query = mysqli_query(
                        $koneksi,
                        "INSERT INTO fasilitas
                        (
                            gambar,
                            nama_fasilitas,
                            penjelasan
                        )
                        VALUES
                        (
                            '$nama_file_baru',
                            '$nama_fasilitas',
                            '$penjelasan'
                        )"
                    );


                    if ($query) {

                        $pesan = "Fasilitas berhasil ditambahkan.";
                        $jenis_pesan = "success";

                    } else {

                       

                        if (file_exists($tujuan)) {
                            unlink($tujuan);
                        }

                        $pesan = "Data gagal disimpan ke database.";
                        $jenis_pesan = "danger";
                    }

                } else {

                    $pesan = "Foto gagal diupload.";
                    $jenis_pesan = "danger";
                }
            }
        }
    }
}




if (isset($_POST['update'])) {

    $id_fasilitas = intval(
        $_POST['id_fasilitas']
    );

    $nama_fasilitas = mysqli_real_escape_string(
        $koneksi,
        trim($_POST['nama_fasilitas'])
    );

    $penjelasan = mysqli_real_escape_string(
        $koneksi,
        trim($_POST['penjelasan'])
    );


    if ($nama_fasilitas == "" || $penjelasan == "") {

        $pesan = "Nama fasilitas dan penjelasan wajib diisi.";
        $jenis_pesan = "danger";

    } else {

        

        $query_lama = mysqli_query(
            $koneksi,
            "SELECT *
             FROM fasilitas
             WHERE id_fasilitas = $id_fasilitas"
        );

        $data_lama = mysqli_fetch_assoc(
            $query_lama
        );


        if (!$data_lama) {

            $pesan = "Data fasilitas tidak ditemukan.";
            $jenis_pesan = "danger";

        } else {

            $nama_file_baru = $data_lama['gambar'];
            $foto_baru_diupload = false;


            

            if (
                isset($_FILES['gambar']) &&
                $_FILES['gambar']['error'] != 4
            ) {

                $nama_file = $_FILES['gambar']['name'];
                $tmp_file = $_FILES['gambar']['tmp_name'];
                $ukuran_file = $_FILES['gambar']['size'];

                $ekstensi = strtolower(
                    pathinfo(
                        $nama_file,
                        PATHINFO_EXTENSION
                    )
                );


                $format_diizinkan = array(
                    'jpg',
                    'jpeg',
                    'png',
                    'webp'
                );


                $maksimal_ukuran =
                    2 * 1024 * 1024;


                if (!in_array(
                    $ekstensi,
                    $format_diizinkan
                )) {

                    $pesan =
                        "Format foto harus JPG, JPEG, PNG, atau WEBP.";

                    $jenis_pesan = "danger";

                } elseif (
                    $ukuran_file > $maksimal_ukuran
                ) {

                    $pesan =
                        "Ukuran foto maksimal 2 MB.";

                    $jenis_pesan = "danger";

                } elseif (
                    getimagesize($tmp_file) === false
                ) {

                    $pesan =
                        "File yang dipilih bukan gambar yang valid.";

                    $jenis_pesan = "danger";

                } else {

                    $nama_file_baru =
                        'fasilitas_' .
                        time() .
                        '_' .
                        rand(100, 999) .
                        '.' .
                        $ekstensi;


                    $tujuan =
                        $folder_gambar .
                        $nama_file_baru;


                    if (
                        move_uploaded_file(
                            $tmp_file,
                            $tujuan
                        )
                    ) {

                        $foto_baru_diupload = true;

                    } else {

                        $pesan =
                            "Foto baru gagal diupload.";

                        $jenis_pesan = "danger";
                    }
                }
            }


            

            if (
                $jenis_pesan != "danger"
            ) {

                $query_update = mysqli_query(
                    $koneksi,
                    "UPDATE fasilitas
                     SET
                        gambar = '$nama_file_baru',
                        nama_fasilitas = '$nama_fasilitas',
                        penjelasan = '$penjelasan'
                     WHERE
                        id_fasilitas = $id_fasilitas"
                );


                if ($query_update) {

                    /* HAPUS FOTO LAMA JIKA ADA FOTO BARU */

                    if (
                        $foto_baru_diupload &&
                        !empty($data_lama['gambar'])
                    ) {

                        $foto_lama =
                            $folder_gambar .
                            $data_lama['gambar'];

                        if (
                            file_exists($foto_lama)
                        ) {

                            unlink($foto_lama);
                        }
                    }


                    $pesan =
                        "Fasilitas berhasil diperbarui.";

                    $jenis_pesan = "success";

                } else {

                    /* HAPUS FOTO BARU JIKA UPDATE GAGAL */

                    if (
                        $foto_baru_diupload &&
                        file_exists($tujuan)
                    ) {

                        unlink($tujuan);
                    }


                    $pesan =
                        "Data fasilitas gagal diperbarui.";

                    $jenis_pesan = "danger";
                }
            }
        }
    }
}




if (isset($_GET['hapus'])) {

    $id_fasilitas = intval(
        $_GET['hapus']
    );


    /* AMBIL DATA */

    $query_hapus = mysqli_query(
        $koneksi,
        "SELECT gambar
         FROM fasilitas
         WHERE id_fasilitas = $id_fasilitas"
    );

    $data_hapus = mysqli_fetch_assoc(
        $query_hapus
    );


    if ($data_hapus) {

        /* HAPUS DATABASE */

        $hapus = mysqli_query(
            $koneksi,
            "DELETE FROM fasilitas
             WHERE id_fasilitas = $id_fasilitas"
        );


        if ($hapus) {

            /* HAPUS FILE FOTO */

            if (
                !empty($data_hapus['gambar'])
            ) {

                $file_gambar =
                    $folder_gambar .
                    $data_hapus['gambar'];

                if (
                    file_exists($file_gambar)
                ) {

                    unlink($file_gambar);
                }
            }


            $pesan =
                "Fasilitas berhasil dihapus.";

            $jenis_pesan = "success";

        } else {

            $pesan =
                "Fasilitas gagal dihapus.";

            $jenis_pesan = "danger";
        }

    } else {

        $pesan =
            "Data fasilitas tidak ditemukan.";

        $jenis_pesan = "danger";
    }
}



$query_fasilitas = mysqli_query(
    $koneksi,
    "SELECT *
     FROM fasilitas
     ORDER BY id_fasilitas DESC"
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
        Kelola Fasilitas - Admin
    </title>


    <!-- BOOTSTRAP 3 -->

    <link
        rel="stylesheet"
        href="../bootstrap/css/bootstrap.min.css"
    >


    <style>

        body {
            background: #f5f7f6;
            font-family: Arial, Helvetica, sans-serif;
        }


        .container-admin {
            margin-top: 25px;
            margin-bottom: 40px;
        }


        .judul-halaman {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            box-shadow: 0 3px 12px rgba(0,0,0,0.08);
        }


        .judul-halaman h2 {
            margin-top: 0;
            margin-bottom: 8px;
            color: #087f3d;
            font-weight: bold;
        }


        .judul-halaman p {
            margin-bottom: 0;
            color: #777;
        }


        .panel {
            border: none;
            border-radius: 8px;
            box-shadow: 0 3px 12px rgba(0,0,0,0.08);
            overflow: hidden;
        }


        .panel-heading {
            font-weight: bold;
            padding: 15px;
        }


        .panel-body {
            padding: 20px;
        }


        .form-group label {
            font-weight: bold;
        }


        .preview-gambar {
            width: 100%;
            max-width: 180px;
            height: 130px;
            object-fit: cover;
            border-radius: 6px;
            border: 1px solid #ddd;
            margin-top: 5px;
        }


        .table-responsive {
            border: none;
        }


        .table {
            background: #fff;
            margin-bottom: 0;
        }


        .table > thead > tr > th {
            background: #087f3d;
            color: #fff;
            text-align: center;
            vertical-align: middle;
        }


        .table > tbody > tr > td {
            vertical-align: middle;
        }


        .gambar-tabel {
            width: 110px;
            height: 80px;
            object-fit: cover;
            border-radius: 5px;
            border: 1px solid #ddd;
        }


        .penjelasan-tabel {
            min-width: 250px;
            max-width: 400px;
            line-height: 1.6;
        }


        .btn-aksi {
            margin-bottom: 5px;
        }


        .modal-header {
            background: #087f3d;
            color: #fff;
        }


        .modal-header .close {
            color: #fff;
            opacity: 1;
        }


        .modal-title {
            font-weight: bold;
        }


        .modal-body {
            padding: 20px;
        }


        .modal-footer {
            background: #f5f5f5;
        }


        .format-info {
            font-size: 12px;
            color: #777;
            margin-top: 5px;
        }


        @media (max-width: 767px) {

            body {
                padding-top: 60px;
            }


            .container-admin {
                margin-top: 15px;
            }


            .judul-halaman {
                padding: 15px;
            }


            .judul-halaman h2 {
                font-size: 23px;
            }


            .panel-body {
                padding: 15px;
            }


            .gambar-tabel {
                width: 90px;
                height: 65px;
            }


            .table {
                font-size: 13px;
            }


            .btn-aksi {
                width: 100%;
                margin-bottom: 5px;
            }


            .preview-gambar {
                max-width: 150px;
                height: 110px;
            }

        }


        @media (max-width: 480px) {

            .judul-halaman h2 {
                font-size: 20px;
            }


            .judul-halaman p {
                font-size: 13px;
            }


            .table {
                font-size: 12px;
            }


            .gambar-tabel {
                width: 80px;
                height: 60px;
            }

        }

    </style>

</head>


<body>


<?php include "navbar_admin.php"; ?>


<div class="admin-content">


    <!-- =================================
         JUDUL
    ================================== -->

    <div class="judul-halaman">

        <h2>

            <span class="glyphicon glyphicon-home"></span>

            Kelola Fasilitas Madrasah

        </h2>

        <p>

            Tambahkan dan kelola fasilitas
            MTs Nurul Huda Pematang Cengal.

        </p>

    </div>


   

    <?php if ($pesan != "") { ?>

        <div
            class="alert alert-<?php echo $jenis_pesan; ?>"
        >

            <button
                type="button"
                class="close"
                data-dismiss="alert"
            >
                &times;
            </button>

            <?php echo e($pesan); ?>

        </div>

    <?php } ?>



    <div class="panel panel-success">

        <div class="panel-heading">

            <span class="glyphicon glyphicon-plus"></span>

            Tambah Fasilitas

        </div>


        <div class="panel-body">

            <form
                method="POST"
                enctype="multipart/form-data"
            >

                <div class="row">


                    

                    <div class="col-md-4">

                        <div class="form-group">

                            <label>
                                Nama Fasilitas
                            </label>

                            <input
                                type="text"
                                name="nama_fasilitas"
                                class="form-control"
                                placeholder="Contoh: Ruang Kelas"
                                required
                            >

                        </div>

                    </div>


                    <!-- FOTO -->

                    <div class="col-md-4">

                        <div class="form-group">

                            <label>
                                Foto Fasilitas
                            </label>

                            <input
                                type="file"
                                name="gambar"
                                class="form-control"
                                accept=".jpg,.jpeg,.png,.webp"
                                required
                            >

                            <div class="format-info">

                                Format:
                                JPG, JPEG, PNG, WEBP.
                                Maksimal 2 MB.

                            </div>

                        </div>

                    </div>


                    <!-- PENJELASAN -->

                    <div class="col-md-4">

                        <div class="form-group">

                            <label>
                                Penjelasan
                            </label>

                            <textarea
                                name="penjelasan"
                                class="form-control"
                                rows="4"
                                placeholder="Jelaskan fasilitas..."
                                required
                            ></textarea>

                        </div>

                    </div>


                </div>


                <button
                    type="submit"
                    name="simpan"
                    class="btn btn-success"
                >

                    <span
                        class="glyphicon glyphicon-save"
                    ></span>

                    Simpan Fasilitas

                </button>


                <button
                    type="reset"
                    class="btn btn-default"
                >

                    <span
                        class="glyphicon glyphicon-refresh"
                    ></span>

                    Reset

                </button>

            </form>

        </div>

    </div>


    <!-- =================================
         DATA FASILITAS
    ================================== -->

    <div class="panel panel-primary">

        <div class="panel-heading">

            <span
                class="glyphicon glyphicon-th-list"
            ></span>

            Data Fasilitas

        </div>


        <div class="panel-body">

            <div class="table-responsive">

                <table
                    class="table table-bordered table-striped"
                >

                    <thead>

                        <tr>

                            <th width="60">
                                No
                            </th>

                            <th width="130">
                                Gambar
                            </th>

                            <th>
                                Nama Fasilitas
                            </th>

                            <th>
                                Penjelasan
                            </th>

                            <th width="150">
                                Aksi
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                    <?php

                    if (
                        mysqli_num_rows(
                            $query_fasilitas
                        ) > 0
                    ) {

                        $no = 1;

                        while (
                            $data =
                            mysqli_fetch_assoc(
                                $query_fasilitas
                            )
                        ) {

                    ?>

                        <tr>

                            <td class="text-center">

                                <?php
                                echo $no++;
                                ?>

                            </td>


                            <!-- GAMBAR -->

                            <td class="text-center">

                                <?php if (
                                    !empty(
                                        $data['gambar']
                                    )
                                ) { ?>

                                    <img
                                        src="../images/<?php
                                        echo e(
                                            $data['gambar']
                                        );
                                        ?>"
                                        class="gambar-tabel"
                                        alt="<?php
                                        echo e(
                                            $data['nama_fasilitas']
                                        );
                                        ?>"
                                    >

                                <?php } else { ?>

                                    <span
                                        class="text-muted"
                                    >
                                        Tidak ada foto
                                    </span>

                                <?php } ?>

                            </td>


                            <!-- NAMA -->

                            <td>

                                <strong>

                                    <?php
                                    echo e(
                                        $data[
                                            'nama_fasilitas'
                                        ]
                                    );
                                    ?>

                                </strong>

                            </td>


                            <!-- PENJELASAN -->

                            <td class="penjelasan-tabel">

                                <?php
                                echo nl2br(
                                    e(
                                        $data[
                                            'penjelasan'
                                        ]
                                    )
                                );
                                ?>

                            </td>


                            <!-- AKSI -->

                            <td class="text-center">

                                <button
                                    type="button"
                                    class="btn btn-warning btn-sm btn-aksi"
                                    data-toggle="modal"
                                    data-target="#modalEdit<?php
                                    echo $data[
                                        'id_fasilitas'
                                    ];
                                    ?>"
                                >

                                    <span
                                        class="glyphicon glyphicon-edit"
                                    ></span>

                                    Edit

                                </button>


                                <a
                                    href="fasilitas.php?hapus=<?php
                                    echo $data[
                                        'id_fasilitas'
                                    ];
                                    ?>"
                                    class="btn btn-danger btn-sm btn-aksi"
                                    onclick="return confirm(
                                        'Apakah Anda yakin ingin menghapus fasilitas ini?'
                                    );"
                                >

                                    <span
                                        class="glyphicon glyphicon-trash"
                                    ></span>

                                    Hapus

                                </a>

                            </td>

                        </tr>


                        <!-- =================================
                             MODAL EDIT
                        ================================== -->

                        <div
                            class="modal fade"
                            id="modalEdit<?php
                            echo $data[
                                'id_fasilitas'
                            ];
                            ?>"
                            tabindex="-1"
                            role="dialog"
                        >

                            <div
                                class="modal-dialog"
                                role="document"
                            >

                                <div class="modal-content">


                                    <form
                                        method="POST"
                                        enctype="multipart/form-data"
                                    >


                                        <div class="modal-header">

                                            <button
                                                type="button"
                                                class="close"
                                                data-dismiss="modal"
                                            >
                                                &times;
                                            </button>


                                            <h4 class="modal-title">

                                                <span
                                                    class="glyphicon glyphicon-edit"
                                                ></span>

                                                Edit Fasilitas

                                            </h4>

                                        </div>


                                        <div class="modal-body">


                                            <input
                                                type="hidden"
                                                name="id_fasilitas"
                                                value="<?php
                                                echo $data[
                                                    'id_fasilitas'
                                                ];
                                                ?>"
                                            >


                                            <!-- NAMA -->

                                            <div class="form-group">

                                                <label>
                                                    Nama Fasilitas
                                                </label>

                                                <input
                                                    type="text"
                                                    name="nama_fasilitas"
                                                    class="form-control"
                                                    value="<?php
                                                    echo e(
                                                        $data[
                                                            'nama_fasilitas'
                                                        ]
                                                    );
                                                    ?>"
                                                    required
                                                >

                                            </div>


                                            <!-- FOTO LAMA -->

                                            <div class="form-group">

                                                <label>
                                                    Foto Saat Ini
                                                </label>

                                                <br>

                                                <?php if (
                                                    !empty(
                                                        $data[
                                                            'gambar'
                                                        ]
                                                    )
                                                ) { ?>

                                                    <img
                                                        src="../images/<?php
                                                        echo e(
                                                            $data[
                                                                'gambar'
                                                            ]
                                                        );
                                                        ?>"
                                                        class="preview-gambar"
                                                        alt="Foto Fasilitas"
                                                    >

                                                <?php } ?>

                                            </div>


                                            <!-- FOTO BARU -->

                                            <div class="form-group">

                                                <label>
                                                    Ganti Foto
                                                </label>

                                                <input
                                                    type="file"
                                                    name="gambar"
                                                    class="form-control"
                                                    accept=".jpg,.jpeg,.png,.webp"
                                                >

                                                <div
                                                    class="format-info"
                                                >

                                                    Kosongkan jika
                                                    tidak ingin
                                                    mengganti foto.

                                                    <br>

                                                    JPG, JPEG, PNG,
                                                    WEBP maksimal
                                                    2 MB.

                                                </div>

                                            </div>


                                            <!-- PENJELASAN -->

                                            <div class="form-group">

                                                <label>
                                                    Penjelasan
                                                </label>

                                                <textarea
                                                    name="penjelasan"
                                                    class="form-control"
                                                    rows="5"
                                                    required
                                                ><?php
                                                echo e(
                                                    $data[
                                                        'penjelasan'
                                                    ]
                                                );
                                                ?></textarea>

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
                                                name="update"
                                                class="btn btn-success"
                                            >

                                                <span
                                                    class="glyphicon glyphicon-save"
                                                ></span>

                                                Simpan Perubahan

                                            </button>

                                        </div>


                                    </form>

                                </div>

                            </div>

                        </div>


                    <?php

                        }

                    } else {

                    ?>

                        <tr>

                            <td
                                colspan="5"
                                class="text-center"
                            >

                                <div
                                    class="alert alert-info"
                                >

                                    <span
                                        class="glyphicon glyphicon-info-sign"
                                    ></span>

                                    Belum ada data fasilitas.

                                </div>

                            </td>

                        </tr>

                    <?php } ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>


</div>




<script
    src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js">
</script>




<script
    src="../bootstrap/js/bootstrap.min.js">
</script>


</body>

</html>