<?php

session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

include "navbar_admin.php";
include "../koneksi.php";

?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="utf-8">

<meta name="viewport"
      content="width=device-width, initial-scale=1">

<title>Galeri Admin</title>

<link href="../bootstrap/css/bootstrap.min.css"
      rel="stylesheet">

<style>

body{
    background:#f5f5f5;
}

.box-galeri{
    background:white;
    padding:20px;
    border-radius:6px;
    box-shadow:0 2px 8px rgba(0,0,0,0.08);
}

.judul-galeri{
    margin-bottom:20px;
}

.judul-galeri h2{
    margin-top:0;
    color:#2e7d32;
}

.gambar-galeri{
    width:120px;
    height:80px;
    object-fit:cover;
    border-radius:4px;
}

.table th{
    text-align:center;
    vertical-align:middle !important;
    white-space:nowrap;
}

.table td{
    vertical-align:middle !important;
}

.aksi{
    white-space:nowrap;
    text-align:center;
}

.btn{
    margin:2px;
}

    .box-galeri{
        padding:12px;
    }

    .judul-galeri{
        text-align:center;
    }

    .judul-galeri h2{
        font-size:24px;
    }

    .tombol-tambah{
        width:100%;
        margin-top:10px;
    }

    .form-pencarian{
        margin-bottom:15px;
    }

    .gambar-galeri{
        width:100px;
        height:70px;
    }



</style>

</head>

<body>

<div class="admin-content">

<div class="box-galeri">

<!-- JUDUL -->

<div class="row judul-galeri">

    <div class="col-sm-7">

        <h2>

            <span class="glyphicon glyphicon-picture"></span>

            Data Galeri

        </h2>

        <p>
            Kelola galeri kegiatan MTs Nurul Huda Pematang Cengal
        </p>

    </div>


    <div class="col-sm-5 text-right">

        <a href="tambah_galeri_admin.php"
           class="btn btn-success tombol-tambah">

            <span class="glyphicon glyphicon-plus"></span>

            Tambah Galeri

        </a>

    </div>

</div>


<hr>


<!-- PENCARIAN -->

<form method="GET">

<div class="row form-pencarian">

    <div class="col-sm-5">

        <input type="text"
               name="cari"
               class="form-control"
               placeholder="Cari galeri..."
               value="<?php

               if(isset($_GET['cari'])){
                   echo htmlspecialchars($_GET['cari']);
               }

               ?>">

    </div>


    <div class="col-sm-2">

        <button type="submit"
                class="btn btn-primary">

            <span class="glyphicon glyphicon-search"></span>

            Cari

        </button>


        <?php if(isset($_GET['cari'])){ ?>

        <a href="galeri_admin.php"
           class="btn btn-default">

            <span class="glyphicon glyphicon-refresh"></span>

            Reset

        </a>

        <?php } ?>

    </div>

</div>

</form>


<br>


<!-- QUERY -->

<?php

if(isset($_GET['cari']) && $_GET['cari'] != ''){

    $cari = mysqli_real_escape_string(
        $koneksi,
        $_GET['cari']
    );

    $query = mysqli_query(
        $koneksi,
        "SELECT * FROM galeri
         WHERE judul LIKE '%$cari%'
         OR keterangan LIKE '%$cari%'
         ORDER BY tanggal DESC"
    );

}else{

    $query = mysqli_query(
        $koneksi,
        "SELECT * FROM galeri
         ORDER BY tanggal DESC"
    );

}

?>


<!-- TABLE -->

<div class="table-responsive">

<table class="table table-bordered table-hover">

<thead>

<tr class="success">

    <th>No</th>

    <th>Gambar</th>

    <th>Judul</th>

    <th>Keterangan</th>

    <th>Tanggal</th>

    <th>Aksi</th>

</tr>

</thead>


<tbody>

<?php

$no = 1;

if(mysqli_num_rows($query) > 0){

    while($data = mysqli_fetch_assoc($query)){

?>

<tr>

<td class="text-center">

    <?php echo $no++; ?>

</td>


<td class="text-center">

    <?php if(!empty($data['gambar'])){ ?>

        <img
            src="../images/<?php echo htmlspecialchars($data['gambar']); ?>"
            class="img-thumbnail gambar-galeri"
            alt="Galeri">

    <?php }else{ ?>

        <span class="text-muted">
            Tidak ada gambar
        </span>

    <?php } ?>

</td>


<td>

<strong>

<?php

echo htmlspecialchars(
    $data['judul']
);

?>

</strong>

</td>


<td>

<?php

$keterangan = $data['keterangan'];

if(strlen($keterangan) > 100){

    echo htmlspecialchars(
        substr($keterangan,0,100)
    );

    echo "...";

}else{

    echo htmlspecialchars(
        $keterangan
    );

}

?>

</td>


<td class="text-center">

<?php

echo date(
    'd-m-Y',
    strtotime($data['tanggal'])
);

?>

</td>


<td class="aksi">

<a href="edit_galeri_admin.php?id=<?php echo $data['id_galeri']; ?>"
   class="btn btn-warning btn-sm">

    <span class="glyphicon glyphicon-edit"></span>

    Edit

</a>


<a href="hapus_galeri_admin.php?id=<?php echo $data['id_galeri']; ?>"
   class="btn btn-danger btn-sm"
   onclick="return confirm('Yakin ingin menghapus galeri ini?')">

    <span class="glyphicon glyphicon-trash"></span>

    Hapus

</a>

</td>

</tr>

<?php

    }

}else{

?>

<tr>

<td colspan="6"
    class="text-center">

    Data galeri belum tersedia.

</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

</div>

</div>


<script src="../bootstrap/js/jquery.min.js"></script>

<script src="../bootstrap/js/bootstrap.min.js"></script>

</body>

</html>