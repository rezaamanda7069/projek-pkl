<?php
$halaman = basename($_SERVER['PHP_SELF']);
?>

<style>


html,
body {
    margin: 0 !important;
    padding: 0 !important;
    background: #f4f7f5;
}


/* =====================================================
   SIDEBAR
===================================================== */

.admin-sidebar {
    position: fixed;
    top: 0;
    left: 0;

    width: 250px;
    height: 100vh;

    background: linear-gradient(
        180deg,
        #087f3d 0%,
        #08783a 100%
    );

    z-index: 9999;

    overflow-y: auto;
    overflow-x: hidden;

    box-shadow: 4px 0 20px rgba(0,0,0,.08);

    scrollbar-width: thin;
}


/* =====================================================
   SCROLLBAR
===================================================== */

.admin-sidebar::-webkit-scrollbar {
    width: 5px;
}

.admin-sidebar::-webkit-scrollbar-track {
    background: rgba(255,255,255,.05);
}

.admin-sidebar::-webkit-scrollbar-thumb {
    background: rgba(255,255,255,.25);
    border-radius: 10px;
}


/* =====================================================
   BRAND
===================================================== */

.admin-brand {
    display: flex;
    align-items: center;

    height: 78px;

    padding: 14px 16px;

    background: #076b34;

    border-bottom: 1px solid rgba(255,255,255,.12);

    color: #fff !important;

    text-decoration: none !important;

    transition: background .2s ease;
}

.admin-brand:hover {
    background: #075f2f;
}


.admin-brand img {
    width: 48px;
    height: 48px;

    object-fit: cover;

    border-radius: 50%;

    margin-right: 11px;

    border: 2px solid rgba(255,255,255,.85);

    flex-shrink: 0;
}


.admin-brand-text {
    min-width: 0;
}


.admin-brand-text strong {
    display: block;

    font-size: 15px;
    font-weight: 700;

    line-height: 1.3;

    white-space: nowrap;
}


.admin-brand-text small {
    display: block;

    margin-top: 4px;

    font-size: 10.5px;

    color: rgba(255,255,255,.75);

    white-space: nowrap;
}


/* =====================================================
   JUDUL MENU
===================================================== */

.admin-menu-title {
    padding: 22px 18px 9px;

    color: rgba(255,255,255,.55);

    font-size: 10px;

    font-weight: 700;

    text-transform: uppercase;

    letter-spacing: 1px;
}


/* =====================================================
   MENU
===================================================== */

.admin-menu {
    list-style: none;

    padding: 0;
    margin: 0;
}


.admin-menu li {
    margin: 3px 10px;
}


.admin-menu li a {
    display: flex;
    align-items: center;

    min-height: 42px;

    padding: 10px 13px;

    color: rgba(255,255,255,.88);

    text-decoration: none !important;

    border-radius: 8px;

    font-size: 13px;
    font-weight: 500;

    transition:
        background .2s ease,
        color .2s ease,
        transform .2s ease;
}


.admin-menu li a .glyphicon {
    width: 25px;

    margin-right: 8px;

    text-align: center;

    font-size: 15px;
}


.admin-menu li a:hover {
    background: rgba(255,255,255,.12);

    color: #fff;

    transform: translateX(2px);
}


/* =====================================================
   MENU AKTIF
===================================================== */

.admin-menu li.active a {
    background: #fff;

    color: #087f3d;

    font-weight: 700;

    box-shadow:
        0 4px 12px rgba(0,0,0,.10);
}


.admin-menu li.active a .glyphicon {
    color: #087f3d;
}


/* =====================================================
   DIVIDER
===================================================== */

.admin-divider {
    height: 1px;

    margin: 16px 18px;

    background: rgba(255,255,255,.12);
}


/* =====================================================
   LOGOUT
===================================================== */

.admin-menu li.logout {
    margin-top: 5px;
}


.admin-menu li.logout a {
    color: #ffdede;
}


.admin-menu li.logout a:hover {
    background: rgba(217,83,79,.18);

    color: #fff;

    transform: translateX(2px);
}


/* =====================================================
   PENTING:
   AREA DASHBOARD
===================================================== */

/*
   Ini bagian yang memperbaiki masalah dashboard
   terlalu ke kanan.

   Bootstrap .container biasanya memiliki width
   1170px dan margin otomatis.

   Kita override supaya dashboard menggunakan
   seluruh ruang yang tersedia di sebelah sidebar.
*/

body > .container.dashboard,
.container.dashboard {

    width: auto !important;

    max-width: none !important;

    margin-left: 250px !important;
    margin-right: 0 !important;

    padding-left: 30px !important;
    padding-right: 30px !important;
}


/* Kalau ada admin-content dari halaman admin lain */

.admin-content {

    min-height: 100vh;

    margin-left: 250px;

    padding: 30px;

}


/* =====================================================
   TOPBAR
===================================================== */

.admin-topbar {

    display: flex;

    align-items: center;

    justify-content: space-between;

    background: #fff;

    padding: 14px 20px;

    margin-bottom: 25px;

    border: 1px solid #e8eee9;

    border-radius: 12px;

    box-shadow:
        0 3px 15px rgba(20,50,30,.05);
}


.admin-topbar-title {

    margin: 0;

    font-size: 20px;

    font-weight: 700;

    color: #17251c;
}


.admin-topbar-title span {
    color: #087f3d;
}


.admin-mobile-title {
    display: none;
}


/* =====================================================
   TOMBOL MOBILE
===================================================== */

.admin-mobile-toggle {

    display: none;

    position: fixed;

    top: 12px;
    left: 12px;

    width: 43px;
    height: 43px;

    padding: 0;

    border: none;

    border-radius: 9px;

    background: #087f3d;

    color: #fff;

    font-size: 18px;

    z-index: 10001;

    box-shadow:
        0 4px 15px rgba(0,0,0,.18);

    outline: none;
}


.admin-mobile-toggle:hover,
.admin-mobile-toggle:focus {
    background: #076b34;

    color: #fff;

    outline: none;
}


/* =====================================================
   OVERLAY
===================================================== */

.admin-overlay {

    display: none;

    position: fixed;

    top: 0;
    left: 0;

    width: 100%;
    height: 100%;

    background: rgba(0,0,0,.45);

    z-index: 9998;
}


/* =====================================================
   TABLET
===================================================== */

@media (max-width: 1199px) {

    .admin-sidebar {
        width: 220px;
    }

    body > .container.dashboard,
    .container.dashboard {

        margin-left: 220px !important;

        padding-left: 25px !important;
        padding-right: 25px !important;
    }

    .admin-content {
        margin-left: 220px;
    }

}


/* =====================================================
   TABLET KECIL
===================================================== */

@media (max-width: 991px) {

    .admin-sidebar {
        width: 210px;
    }

    body > .container.dashboard,
    .container.dashboard {

        margin-left: 210px !important;

        padding-left: 20px !important;
        padding-right: 20px !important;
    }

    .admin-content {
        margin-left: 210px;

        padding: 20px;
    }

    .admin-brand-text strong {
        font-size: 14px;
    }

    .admin-menu li a {
        font-size: 12px;

        padding-left: 11px;
        padding-right: 11px;
    }

}


/* =====================================================
   HP
===================================================== */

@media (max-width: 767px) {

    /* Sidebar */

    .admin-sidebar {

        width: 270px;

        transform: translateX(-100%);

        transition:
            transform .3s ease;

        box-shadow:
            8px 0 25px rgba(0,0,0,.18);
    }


    .admin-sidebar.show {
        transform: translateX(0);
    }


    /* Tombol */

    .admin-mobile-toggle {
        display: block;
    }


    /* Overlay */

    .admin-overlay.show {
        display: block;
    }


    /* Dashboard */

    body > .container.dashboard,
    .container.dashboard {

        width: 100% !important;

        max-width: none !important;

        margin-left: 0 !important;
        margin-right: 0 !important;

        padding-left: 15px !important;
        padding-right: 15px !important;

        padding-top: 65px !important;
    }


    /* Admin content */

    .admin-content {

        margin-left: 0;

        padding:
            70px 15px 20px;
    }


    /* Topbar */

    .admin-topbar {

        padding: 13px 15px;

        margin-bottom: 20px;

        border-radius: 10px;
    }


    .admin-topbar-title {

        font-size: 17px;

        margin-left: 45px;
    }


    .admin-mobile-title {

        display: block;

        font-size: 11px;

        color: #777;

        margin-top: 2px;
    }

}


/* =====================================================
   HP KECIL
===================================================== */

@media (max-width: 480px) {

    .admin-sidebar {
        width: 250px;
    }


    body > .container.dashboard,
    .container.dashboard {

        padding-left: 10px !important;
        padding-right: 10px !important;
    }


    .admin-content {

        padding:
            65px 10px 15px;
    }


    .admin-topbar {

        padding: 12px;
    }


    .admin-topbar-title {

        font-size: 16px;
    }

}


/* =====================================================
   FIX BOOTSTRAP ROW
===================================================== */

/*
   Menghindari row melebar keluar area dashboard.
*/

.dashboard .row {
    margin-left: -10px;
    margin-right: -10px;
}


.dashboard [class*="col-"] {
    padding-left: 10px;
    padding-right: 10px;
}

</style>


<!-- =====================================================
     TOMBOL MOBILE
===================================================== -->

<button
    type="button"
    class="admin-mobile-toggle"
    id="adminMenuToggle">

    <span class="glyphicon glyphicon-menu-hamburger"></span>

</button>


<!-- =====================================================
     OVERLAY
===================================================== -->

<div
    class="admin-overlay"
    id="adminOverlay">
</div>


<!-- =====================================================
     SIDEBAR
===================================================== -->

<aside
    class="admin-sidebar"
    id="adminSidebar">


    <!-- BRAND -->

    <a
        href="dasbord.php"
        class="admin-brand">

        <img
            src="../images/logo.jpeg"
            alt="Logo MTs Nurul Huda">

        <div class="admin-brand-text">

            <strong>
                MTs Nurul Huda
            </strong>

            <small>
                Panel Administrator
            </small>

        </div>

    </a>


    <!-- MENU UTAMA -->

    <div class="admin-menu-title">
        Menu Utama
    </div>


    <ul class="admin-menu">


        <!-- DASHBOARD -->

        <li
            <?php
            if ($halaman == "dasbord.php") {
                echo 'class="active"';
            }
            ?>>

            <a href="dasbord.php">

                <span class="glyphicon glyphicon-dashboard"></span>

                Dashboard

            </a>

        </li>


        <!-- DATA GURU -->

        <li
            <?php
            if ($halaman == "data_guru_admin.php") {
                echo 'class="active"';
            }
            ?>>

            <a href="data_guru_admin.php">

                <span class="glyphicon glyphicon-education"></span>

                Data Guru

            </a>

        </li>


        <!-- BERITA -->

        <li
            <?php
            if ($halaman == "berita_admin.php") {
                echo 'class="active"';
            }
            ?>>

            <a href="berita_admin.php">

                <span class="glyphicon glyphicon-list-alt"></span>

                Berita

            </a>

        </li>


        <!-- PENDAFTARAN -->

        <li
            <?php
            if ($halaman == "pendaftaran_admin.php") {
                echo 'class="active"';
            }
            ?>>

            <a href="pendaftaran_admin.php">

                <span class="glyphicon glyphicon-list-alt"></span>

                Pendaftaran

            </a>

        </li>


        <!-- AGENDA -->

        <li
            <?php
            if ($halaman == "agenda_admin.php") {
                echo 'class="active"';
            }
            ?>>

            <a href="agenda_admin.php">

                <span class="glyphicon glyphicon-calendar"></span>

                Agenda

            </a>

        </li>


        <!-- EKSTRAKURIKULER -->

        <li
            <?php
            if ($halaman == "ekstrakurikuler_admin.php") {
                echo 'class="active"';
            }
            ?>>

            <a href="ekstrakurikuler_admin.php">

                <span class="glyphicon glyphicon-flag"></span>

                Ekstrakurikuler

            </a>

        </li>


        <!-- PPDB -->

        <li
            <?php
            if ($halaman == "ppdb_admin.php") {
                echo 'class="active"';
            }
            ?>>

            <a href="ppdb_admin.php">

                <span class="glyphicon glyphicon-list-alt"></span>

                 Syarat PPDB

            </a>

        </li>


        <!-- GALERI -->

        <li
            <?php
            if ($halaman == "galeri_admin.php") {
                echo 'class="active"';
            }
            ?>>

            <a href="galeri_admin.php">

                <span class="glyphicon glyphicon-picture"></span>

                Galeri

            </a>

        </li>


        <!-- SAMBUTAN -->

        <li
            <?php
            if ($halaman == "sambutan_admin.php") {
                echo 'class="active"';
            }
            ?>>

            <a href="sambutan_admin.php">

                <span class="glyphicon glyphicon-user"></span>

                Sambutan

            </a>

        </li>


    </ul>


    <!-- PEMBATAS -->

    <div class="admin-divider"></div>


    <!-- SISTEM -->

    <div class="admin-menu-title">
        Sistem
    </div>


    <ul class="admin-menu">

        <li class="logout">

            <a
                href="logout.php"
                onclick="return confirm('Yakin ingin logout?');">

                <span class="glyphicon glyphicon-log-out"></span>

                Logout

            </a>

        </li>

    </ul>


</aside>


<!-- =====================================================
     JAVASCRIPT MOBILE
===================================================== -->

<script>

(function () {

    var tombol =
        document.getElementById("adminMenuToggle");

    var sidebar =
        document.getElementById("adminSidebar");

    var overlay =
        document.getElementById("adminOverlay");


    if (!tombol || !sidebar || !overlay) {
        return;
    }


    function bukaMenu() {

        sidebar.classList.add("show");

        overlay.classList.add("show");

        document.body.style.overflow = "hidden";
    }


    function tutupMenu() {

        sidebar.classList.remove("show");

        overlay.classList.remove("show");

        document.body.style.overflow = "";
    }


    tombol.addEventListener(
        "click",
        function () {

            if (
                sidebar.classList.contains("show")
            ) {

                tutupMenu();

            } else {

                bukaMenu();

            }

        }
    );


    overlay.addEventListener(
        "click",
        function () {

            tutupMenu();

        }
    );


    var menu =
        sidebar.querySelectorAll("a");


    for (
        var i = 0;
        i < menu.length;
        i++
    ) {

        menu[i].addEventListener(
            "click",
            function () {

                if (
                    window.innerWidth <= 767
                ) {

                    tutupMenu();

                }

            }
        );

    }


    window.addEventListener(
        "resize",
        function () {

            if (
                window.innerWidth > 767
            ) {

                tutupMenu();

            }

        }
    );


})();

</script>