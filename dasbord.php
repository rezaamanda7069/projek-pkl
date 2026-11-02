<?php
session_start();

/* =====================================================
   CEK LOGIN
===================================================== */

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

/* =====================================================
   KONEKSI DATABASE
===================================================== */

include "../koneksi.php";

/* =====================================================
   FUNGSI HITUNG DATA
===================================================== */

function jumlah_data($koneksi, $table)
{
    $query = mysqli_query(
        $koneksi,
        "SELECT COUNT(*) AS total FROM `$table`"
    );

    if ($query) {
        $data = mysqli_fetch_assoc($query);
        return (int)$data['total'];
    }

    return 0;
}

/* =====================================================
   JUMLAH DATA
===================================================== */

$total_guru = jumlah_data($koneksi, "guru");
$total_berita = jumlah_data($koneksi, "berita");
$total_pendaftaran = jumlah_data($koneksi, "pendaftaran");
$total_agenda = jumlah_data($koneksi, "agenda");
$total_ekskul = jumlah_data($koneksi, "ekstrakurikuler");
$total_prestasi = jumlah_data($koneksi, "prestasi");
$total_galeri = jumlah_data($koneksi, "galeri");
$total_fasilitas = jumlah_data($koneksi, "fasilitas");

$username = htmlspecialchars($_SESSION['username']);

?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="utf-8">

<meta name="viewport"
      content="width=device-width, initial-scale=1">

<title>Dashboard Admin - MTs Nurul Huda</title>

<!-- BOOTSTRAP 3 -->
<link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">

<!-- GOOGLE FONT -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<link
href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@500;600;700;800&display=swap"
rel="stylesheet">


<style>

/* =====================================================
   GLOBAL
===================================================== */

*{
    box-sizing:border-box;
}

html,
body{
    margin:0;
    padding:0;
    min-height:100%;
}

body{

    background:#f4f7f5;

    color:#18251e;

    font-family:'Inter',
                Arial,
                sans-serif;

    -webkit-font-smoothing:antialiased;
}


/* =====================================================
   AREA DASHBOARD
===================================================== */

/*
   Sidebar navbar_admin.php berada di kiri.
   Lebar sidebar dibuat sekitar 240px.
*/

.dashboard-wrapper{

    margin-left:240px;

    min-height:100vh;

    width:calc(100% - 240px);

    padding:30px 34px 50px 34px;
}


/* =====================================================
   KONTEN UTAMA
===================================================== */

.dashboard-content{

    width:100%;

    max-width:1280px;

    margin:0 auto;
}


/* =====================================================
   WELCOME CARD
===================================================== */

.welcome-card{

    position:relative;

    overflow:hidden;

    min-height:180px;

    padding:34px 38px;

    margin-bottom:30px;

    border-radius:20px;

    color:#ffffff;

    background:
        linear-gradient(
            135deg,
            #0c572f 0%,
            #11743f 48%,
            #39a66a 100%
        );

    box-shadow:
        0 14px 35px rgba(12,87,47,.18);
}


/* dekorasi */

.welcome-card:before{

    content:"";

    position:absolute;

    width:240px;
    height:240px;

    right:-80px;
    top:-120px;

    border-radius:50%;

    background:
        rgba(255,255,255,.08);
}


.welcome-card:after{

    content:"";

    position:absolute;

    width:170px;
    height:170px;

    right:80px;
    bottom:-120px;

    border-radius:50%;

    background:
        rgba(255,255,255,.06);
}


.welcome-content{

    position:relative;

    z-index:2;

    max-width:850px;
}


.welcome-card h1{

    margin:0 0 12px;

    font-family:
        'Plus Jakarta Sans',
        Arial,
        sans-serif;

    font-size:28px;

    font-weight:800;

    line-height:1.35;

    letter-spacing:-.4px;
}


.welcome-card p{

    margin:0;

    max-width:800px;

    font-size:14px;

    line-height:1.8;

    color:rgba(255,255,255,.91);
}


/* =====================================================
   JUDUL SECTION
===================================================== */

.section-header{

    display:flex;

    align-items:flex-end;

    justify-content:space-between;

    margin-bottom:18px;
}


.section-title{

    margin:0;

    font-family:
        'Plus Jakarta Sans',
        Arial,
        sans-serif;

    font-size:19px;

    font-weight:800;

    color:#18251e;
}


.section-title .glyphicon{

    margin-right:7px;

    color:#13743f;
}


.section-subtitle{

    margin:6px 0 0;

    color:#77877e;

    font-size:12.5px;
}


/* =====================================================
   STATISTIK
===================================================== */

.stats-grid{

    display:grid;

    grid-template-columns:
        repeat(4, minmax(0,1fr));

    gap:18px;

    margin-bottom:30px;
}


.stat-card{

    position:relative;

    min-height:128px;

    display:flex;

    align-items:center;

    gap:15px;

    padding:20px;

    background:#ffffff;

    border:1px solid #e5ebe7;

    border-radius:16px;

    box-shadow:
        0 5px 18px rgba(23,43,32,.05);

    transition:
        transform .2s ease,
        box-shadow .2s ease;
}


.stat-card:hover{

    transform:translateY(-4px);

    box-shadow:
        0 12px 28px rgba(23,43,32,.10);
}


.stat-icon{

    width:52px;

    height:52px;

    min-width:52px;

    display:flex;

    align-items:center;

    justify-content:center;

    border-radius:14px;

    font-size:21px;
}


/* warna */

.stat-guru .stat-icon{

    color:#28739b;

    background:#e9f1f6;
}


.stat-berita .stat-icon{

    color:#187442;

    background:#e7f2eb;
}


.stat-pendaftaran .stat-icon{

    color:#9b6b21;

    background:#f8f0df;
}


.stat-agenda .stat-icon{

    color:#b07a20;

    background:#f8f0df;
}


.stat-ekskul .stat-icon{

    color:#6b4b9b;

    background:#eeeaf5;
}


.stat-prestasi .stat-icon{

    color:#bd5330;

    background:#f7eae5;
}


.stat-galeri .stat-icon{

    color:#258b7b;

    background:#e6f2ef;
}

.stat-fasilitas .stat-icon{

    color:#3f7f5f;

    background:#e8f2eb;
}

.stat-content{

    min-width:0;
}


.stat-number{

    margin:0 0 5px;

    font-family:
        'Plus Jakarta Sans',
        Arial,
        sans-serif;

    font-size:27px;

    font-weight:800;

    line-height:1;

    color:#16221b;
}


.stat-label{

    margin:0;

    font-size:12px;

    font-weight:500;

    color:#78877f;
}


/* =====================================================
   AREA BAWAH
===================================================== */

.dashboard-bottom{

    display:grid;

    grid-template-columns:
        minmax(0,2fr)
        minmax(280px,1fr);

    gap:20px;

    align-items:start;
}


/* =====================================================
   PANEL
===================================================== */

.dashboard-panel{

    background:#ffffff;

    border:1px solid #e5ebe7;

    border-radius:17px;

    overflow:hidden;

    box-shadow:
        0 5px 18px rgba(23,43,32,.05);

    margin-bottom:20px;
}


.panel-header{

    display:flex;

    align-items:center;

    gap:9px;

    min-height:62px;

    padding:0 22px;

    border-bottom:1px solid #e9eeeb;

    font-family:
        'Plus Jakarta Sans',
        Arial,
        sans-serif;

    font-size:15px;

    font-weight:800;

    color:#18251e;
}


.panel-header .glyphicon{

    color:#11743f;

    font-size:15px;
}


.panel-body{

    padding:22px;
}


/* =====================================================
   AKSES CEPAT
===================================================== */

.quick-description{

    margin:0 0 18px;

    color:#78877f;

    font-size:13px;

    line-height:1.7;
}


.quick-grid{

    display:grid;

    grid-template-columns:
        repeat(3, minmax(0,1fr));

    gap:12px;
}


.quick-btn{

    min-height:100px;

    display:flex;

    flex-direction:column;

    align-items:center;

    justify-content:center;

    gap:10px;

    padding:14px 8px;

    background:#ffffff;

    border:1px solid #e4ebe7;

    border-radius:13px;

    text-decoration:none !important;

    font-size:12px;

    font-weight:700;

    transition:
        transform .2s ease,
        box-shadow .2s ease,
        border-color .2s ease;
}


.quick-btn:hover{

    transform:translateY(-3px);

    box-shadow:
        0 8px 20px rgba(23,43,32,.08);
}


.quick-btn .glyphicon{

    width:40px;

    height:40px;

    display:flex;

    align-items:center;

    justify-content:center;

    border-radius:11px;

    font-size:17px;
}


/* warna */

.quick-guru{
    color:#28739b;
}

.quick-guru .glyphicon{
    background:#e9f1f6;
}


.quick-berita{
    color:#187442;
}

.quick-berita .glyphicon{
    background:#e7f2eb;
}


.quick-pendaftaran{
    color:#9b6b21;
}

.quick-pendaftaran .glyphicon{
    background:#f8f0df;
}


.quick-agenda{
    color:#b07a20;
}

.quick-agenda .glyphicon{
    background:#f8f0df;
}


.quick-ekskul{
    color:#6b4b9b;
}

.quick-ekskul .glyphicon{
    background:#eeeaf5;
}


.quick-prestasi{
    color:#bd5330;
}

.quick-prestasi .glyphicon{
    background:#f7eae5;
}


.quick-galeri{
    color:#258b7b;
}

.quick-galeri .glyphicon{
    background:#e6f2ef;
}


.quick-sambutan{
    color:#176c4a;
}

.quick-sambutan .glyphicon{
    background:#e5f2eb;
}


.quick-ppdb {
    color: #176c4a;
}

.quick-ppdb .glyphicon {
    background: #e5f2eb;
    color: #176c4a;
}

.quick-fasilitas{
    color:#3f7f5f;
}

.quick-fasilitas .glyphicon{
    background:#e8f2eb;
}



.admin-profile{

    text-align:center;
}


.admin-avatar{

    width:82px;

    height:82px;

    margin:3px auto 14px;

    display:flex;

    align-items:center;

    justify-content:center;

    border-radius:50%;

    color:#ffffff;

    font-size:30px;

    background:
        linear-gradient(
            135deg,
            #11743f,
            #35a369
        );

    box-shadow:
        0 8px 20px rgba(17,116,63,.22);
}


.admin-name{

    margin:0;

    font-family:
        'Plus Jakarta Sans',
        Arial,
        sans-serif;

    font-size:17px;

    font-weight:800;

    color:#18251e;
}


.admin-role{

    margin:5px 0 20px;

    font-size:12px;

    color:#7a8981;
}


.admin-info{

    padding:13px 15px;

    margin-bottom:13px;

    text-align:left;

    background:#f5f8f6;

    border:1px solid #e7ede9;

    border-radius:11px;
}


.admin-info-label{

    display:block;

    margin-bottom:5px;

    color:#89958e;

    font-size:10px;

    font-weight:800;

    letter-spacing:.7px;
}


.admin-info-value{

    display:block;

    color:#26352d;

    font-size:13px;

    font-weight:600;

    word-break:break-word;
}


.profile-btn{

    display:block;

    width:100%;

    padding:12px;

    margin-bottom:10px;

    border-radius:10px;

    color:#13713e !important;

    background:#eaf4ed;

    font-size:12.5px;

    font-weight:700;

    text-decoration:none !important;

    transition:.2s;
}


.profile-btn:hover{

    background:#dceee3;
}


.logout-btn{

    width:100%;

    padding:12px;

    border:0;

    border-radius:10px;

    font-size:12.5px;

    font-weight:700;

    background:#dc4c4c;

    transition:.2s;
}


.logout-btn:hover{

    background:#c63e3e;
}


/* =====================================================
   SAMBUTAN
===================================================== */

.info-box{

    display:flex;

    gap:14px;

    padding:16px;

    border-radius:12px;

    background:#f5f8f6;

    border:1px solid #e7ede9;
}


.info-icon{

    width:42px;

    height:42px;

    min-width:42px;

    display:flex;

    align-items:center;

    justify-content:center;

    border-radius:11px;

    color:#13713e;

    background:#e5f2eb;

    font-size:17px;
}


.info-box strong{

    display:block;

    margin-bottom:5px;

    color:#27362e;

    font-size:12.5px;
}


.info-box p{

    margin:0;

    color:#7a8981;

    font-size:11.5px;

    line-height:1.6;
}


/* =====================================================
   TABLET
===================================================== */

@media (max-width:1199px){

    .dashboard-wrapper{

        padding-left:25px;

        padding-right:25px;
    }


    .stats-grid{

        grid-template-columns:
            repeat(3, minmax(0,1fr));
    }

}


/* =====================================================
   TABLET KECIL
===================================================== */

@media (max-width:991px){

    .dashboard-wrapper{

        margin-left:240px;

        width:calc(100% - 240px);

        padding:24px 20px 40px;
    }


    .stats-grid{

        grid-template-columns:
            repeat(2, minmax(0,1fr));

        gap:14px;
    }


    .dashboard-bottom{

        grid-template-columns:1fr;
    }


    .quick-grid{

        grid-template-columns:
            repeat(3, minmax(0,1fr));
    }

}


/* =====================================================
   MOBILE
===================================================== */

@media (max-width:767px){

    .dashboard-wrapper{

        margin-left:0;

        width:100%;

        padding:
            20px
            15px
            35px;
    }


    .dashboard-content{

        max-width:none;
    }


    .welcome-card{

        padding:25px 21px;

        min-height:auto;

        border-radius:16px;

        margin-bottom:25px;
    }


    .welcome-card h1{

        font-size:21px;

        line-height:1.45;
    }


    .welcome-card p{

        font-size:12.5px;

        line-height:1.7;
    }


    .section-header{

        display:block;

        margin-bottom:15px;
    }


    .section-title{

        font-size:17px;
    }


    .section-subtitle{

        font-size:11.5px;

        line-height:1.5;
    }


    .stats-grid{

        grid-template-columns:
            repeat(2, minmax(0,1fr));

        gap:12px;

        margin-bottom:25px;
    }


    .stat-card{

        min-height:105px;

        padding:15px;

        gap:10px;

        border-radius:13px;
    }


    .stat-icon{

        width:43px;

        height:43px;

        min-width:43px;

        border-radius:11px;

        font-size:17px;
    }


    .stat-number{

        font-size:22px;
    }


    .stat-label{

        font-size:10.5px;

        line-height:1.4;
    }


    .panel-header{

        min-height:56px;

        padding:0 17px;

        font-size:14px;
    }


    .panel-body{

        padding:17px;
    }


    .quick-grid{

        grid-template-columns:
            repeat(2, minmax(0,1fr));

        gap:10px;
    }


    .quick-btn{

        min-height:86px;

        font-size:11px;
    }


    .admin-avatar{

        width:72px;

        height:72px;

        font-size:27px;
    }

}


/* =====================================================
   MOBILE SANGAT KECIL
===================================================== */

@media (max-width:420px){

    .dashboard-wrapper{

        padding-left:12px;

        padding-right:12px;
    }


    .welcome-card{

        padding:22px 17px;
    }


    .welcome-card h1{

        font-size:19px;
    }


    .stats-grid{

        grid-template-columns:1fr;
    }


    .stat-card{

        min-height:92px;
    }


    .quick-grid{

        grid-template-columns:1fr;
    }


    .quick-btn{

        flex-direction:row;

        justify-content:flex-start;

        padding:13px 16px;

        min-height:65px;
    }

}


/* =====================================================
   PERBAIKAN BOOTSTRAP
===================================================== */

.row{

    margin-left:0;

    margin-right:0;
}


a:focus,
a:hover{

    outline:none;
}


</style>

</head>


<body>


<!-- =====================================================
     NAVBAR / SIDEBAR ADMIN
===================================================== -->

<?php include "navbar_admin.php"; ?>


<!-- =====================================================
     DASHBOARD
===================================================== -->

<div class="dashboard-wrapper">

<div class="dashboard-content">


<!-- =====================================================
     WELCOME
===================================================== -->

<div class="welcome-card">

    <div class="welcome-content">

        <h1>
            Selamat Datang,
            <?php echo $username; ?> 👋
        </h1>

        <p>
            Selamat datang di Dashboard Admin Website
            MTs Nurul Huda Pematang Cengal.
            Kelola informasi sekolah, berita, pendaftaran,
            agenda, ekstrakurikuler, prestasi, dan galeri
            melalui dashboard ini.
        </p>

    </div>

</div>


<!-- =====================================================
     JUDUL STATISTIK
===================================================== -->

<div class="section-header">

    <div>

        <h2 class="section-title">

            <span class="glyphicon glyphicon-stats"></span>

            Ringkasan Website

        </h2>

        <p class="section-subtitle">

            Jumlah data yang tersedia pada website sekolah

        </p>

    </div>

</div>


<!-- =====================================================
     STATISTIK
===================================================== -->

<div class="stats-grid">


<!-- GURU -->

<div class="stat-card stat-guru">

    <div class="stat-icon">

        <span class="glyphicon glyphicon-education"></span>

    </div>

    <div class="stat-content">

        <p class="stat-number">
            <?php echo $total_guru; ?>
        </p>

        <p class="stat-label">
            Data Guru
        </p>

    </div>

</div>


<!-- BERITA -->

<div class="stat-card stat-berita">

    <div class="stat-icon">

        <span class="glyphicon glyphicon-list-alt"></span>

    </div>

    <div class="stat-content">

        <p class="stat-number">
            <?php echo $total_berita; ?>
        </p>

        <p class="stat-label">
            Berita
        </p>

    </div>

</div>


<!-- PENDAFTARAN -->

<div class="stat-card stat-pendaftaran">

    <div class="stat-icon">

        <span class="glyphicon glyphicon-user"></span>

    </div>

    <div class="stat-content">

        <p class="stat-number">
            <?php echo $total_pendaftaran; ?>
        </p>

        <p class="stat-label">
            Pendaftaran
        </p>

    </div>

</div>


<!-- AGENDA -->

<div class="stat-card stat-agenda">

    <div class="stat-icon">

        <span class="glyphicon glyphicon-calendar"></span>

    </div>

    <div class="stat-content">

        <p class="stat-number">
            <?php echo $total_agenda; ?>
        </p>

        <p class="stat-label">
            Agenda
        </p>

    </div>

</div>


<!-- EKSKUL -->

<div class="stat-card stat-ekskul">

    <div class="stat-icon">

        <span class="glyphicon glyphicon-flag"></span>

    </div>

    <div class="stat-content">

        <p class="stat-number">
            <?php echo $total_ekskul; ?>
        </p>

        <p class="stat-label">
            Ekstrakurikuler
        </p>

    </div>

</div>


<!-- PRESTASI -->

<div class="stat-card stat-prestasi">

    <div class="stat-icon">

        <span class="glyphicon glyphicon-star"></span>

    </div>

    <div class="stat-content">

        <p class="stat-number">
            <?php echo $total_prestasi; ?>
        </p>

        <p class="stat-label">
            Prestasi
        </p>

    </div>

</div>


<!-- GALERI -->

<div class="stat-card stat-galeri">

    <div class="stat-icon">

        <span class="glyphicon glyphicon-picture"></span>

    </div>

    <div class="stat-content">

        <p class="stat-number">
            <?php echo $total_galeri; ?>
        </p>

        <p class="stat-label">
            Galeri Foto
        </p>

    </div>

</div>


</div>
<!-- FASILITAS -->

<div class="stat-card stat-fasilitas">

    <div class="stat-icon">

        <span class="glyphicon glyphicon-home"></span>

    </div>

    <div class="stat-content">

        <p class="stat-number">
            <?php echo $total_fasilitas; ?>
        </p>

        <p class="stat-label">
            Fasilitas
        </p>

    </div>

</div>



<div class="dashboard-bottom">



<div>


<div class="dashboard-panel">

    <div class="panel-header">

        <span class="glyphicon glyphicon-th-large"></span>

        Akses Cepat

    </div>


    <div class="panel-body">

        <p class="quick-description">

            Kelola berbagai informasi dan konten
            website MTs Nurul Huda melalui menu berikut.

        </p>


        <div class="quick-grid">


            <!-- GURU -->

            <a
                href="data_guru_admin.php"
                class="quick-btn quick-guru"
            >

                <span class="glyphicon glyphicon-education"></span>

                Data Guru

            </a>


            <!-- BERITA -->

            <a
                href="berita_admin.php"
                class="quick-btn quick-berita"
            >

                <span class="glyphicon glyphicon-list-alt"></span>

                Berita

            </a>


            <!-- PENDAFTARAN -->

            <a
                href="pendaftaran_admin.php"
                class="quick-btn quick-pendaftaran"
            >

                <span class="glyphicon glyphicon-user"></span>

                Pendaftaran

            </a>


            <!-- AGENDA -->

            <a
                href="agenda_admin.php"
                class="quick-btn quick-agenda"
            >

                <span class="glyphicon glyphicon-calendar"></span>

                Agenda

            </a>


            <!-- EKSKUL -->

            <a
                href="ekstrakurikuler_admin.php"
                class="quick-btn quick-ekskul"
            >

                <span class="glyphicon glyphicon-flag"></span>

                Ekstrakurikuler

            </a>


            <!-- PRESTASI -->

            <a
                href="prestasi_admin.php"
                class="quick-btn quick-prestasi"
            >

                <span class="glyphicon glyphicon-star"></span>

                Prestasi

            </a>


            <!-- GALERI -->

            <a
                href="galeri_admin.php"
                class="quick-btn quick-galeri"
            >

                <span class="glyphicon glyphicon-picture"></span>

                Galeri

            </a>


            <!-- SAMBUTAN -->

            <a
                href="sambutan_admin.php"
                class="quick-btn quick-sambutan"
            >

                <span class="glyphicon glyphicon-comment"></span>

                Sambutan Kepala

            </a>


            
            <a
                href="ppdb_admin.php"
                class="quick-btn quick-ppdb">

                <span class="glyphicon glyphicon-list-alt"></span>

                Syarat PPDB

            </a>
            <!-- FASILITAS -->

            <a
                 href="fasilitas.php"
                  class="quick-btn quick-fasilitas">

               <span class="glyphicon glyphicon-home"></span>

                 Fasilitas

                </a>


        </div>

    </div>

</div>





<div class="dashboard-panel">

    <div class="panel-header">

        <span class="glyphicon glyphicon-info-sign"></span>

        Informasi

    </div>


    <div class="panel-body">

        <div class="info-box">

            <div class="info-icon">

                <span class="glyphicon glyphicon-ok"></span>

            </div>

            <div>

                <strong>
                    Dashboard Admin Aktif
                </strong>

                <p>
                    Gunakan menu di atas untuk mengelola
                    seluruh informasi website MTs Nurul Huda
                    Pematang Cengal.
                </p>

            </div>

        </div>

    </div>

</div>


</div>




<div>


<div class="dashboard-panel">

    <div class="panel-header">

        <span class="glyphicon glyphicon-user"></span>

        Profil Admin

    </div>


    <div class="panel-body">


        <div class="admin-profile">


            <!-- AVATAR -->

            <div class="admin-avatar">

                <span class="glyphicon glyphicon-user"></span>

            </div>


            <!-- NAMA -->

            <h3 class="admin-name">

                <?php echo $username; ?>

            </h3>


            <p class="admin-role">

                Administrator Website

            </p>


            <!-- INFO -->

            <div class="admin-info">

                <span class="admin-info-label">
                    USERNAME
                </span>

                <span class="admin-info-value">

                    <?php echo $username; ?>

                </span>

            </div>


            

            <a
                href="profile_admin.php"
                class="profile-btn"
            >

                <span class="glyphicon glyphicon-cog"></span>

                &nbsp; Kelola Profil Admin

            </a>


            <!-- LOGOUT -->

            <a
                href="logout.php"
                class="btn btn-danger logout-btn"
            >

                <span class="glyphicon glyphicon-log-out"></span>

                &nbsp; Logout

            </a>


        </div>

    </div>

</div>


</div>


</div>


</div>

</div>




<script src="../bootstrap/js/jquery.min.js"></script>

<script src="../bootstrap/js/bootstrap.min.js"></script>


</body>

</html>