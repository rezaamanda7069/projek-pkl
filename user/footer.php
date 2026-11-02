<style>
.footer-sekolah {
    background-color: #2e7d32;
    color: #fff;
    margin-top: 50px;
    padding: 35px 0 20px;
}

/* Judul utama footer */
.footer-sekolah .footer-judul {
    margin: 0 0 15px;
    font-size: 24px;
    font-weight: bold;
    line-height: 1.3;
}

/* Judul setiap kolom */
.footer-sekolah .footer-subjudul {
    margin: 0 0 15px;
    padding-bottom: 12px;
    border-bottom: 2px solid rgba(255,255,255,0.5);
    font-size: 18px;
    font-weight: bold;
    line-height: 1.4;
}

/* Paragraf */
.footer-sekolah .footer-deskripsi {
    margin: 0 0 10px;
    font-size: 14px;
    line-height: 1.8;
}

/* Informasi alamat */
.footer-sekolah .footer-item {
    margin-bottom: 10px;
    font-size: 14px;
    line-height: 1.7;
}

/* Icon Bootstrap glyphicon */
.footer-sekolah .glyphicon {
    width: 25px;
    font-size: 15px;
}

/* Semua link footer */
.footer-sekolah a {
    color: #fff;
    text-decoration: none;
}

/* Hover link */
.footer-sekolah a:hover,
.footer-sekolah a:focus {
    color: #dff0d8;
    text-decoration: none;
}


/* =========================================
   MEDIA SOSIAL
========================================= */

.footer-sekolah .media-sosial {
    margin-top: 20px;
}

.footer-sekolah .media-sosial .footer-subjudul {
    border-bottom: none;
    padding-bottom: 0;
    margin-bottom: 12px;
}

.footer-sekolah .media-sosial-link {
    display: inline-block;
    width: 40px;
    height: 40px;
    margin-right: 7px;
    line-height: 40px;
    text-align: center;
    border-radius: 50%;
    background-color: rgba(255,255,255,0.15);
    font-size: 18px;
    transition: all 0.3s ease;
}

.footer-sekolah .media-sosial-link:hover,
.footer-sekolah .media-sosial-link:focus {
    background-color: #fff;
    color: #2e7d32;
    transform: translateY(-3px);
}


/* =========================================
   LINK TERKAIT
========================================= */

.footer-sekolah .footer-link {
    list-style: none;
    margin: 0;
    padding: 0;
}

.footer-sekolah .footer-link li {
    margin: 0 0 12px;
    padding: 0;
}

.footer-sekolah .footer-link li:last-child {
    margin-bottom: 0;
}

.footer-sekolah .footer-link li a {
    display: block;
    font-size: 14px;
    line-height: 1.6;
    transition: all 0.2s ease;
}

.footer-sekolah .footer-link li a:hover,
.footer-sekolah .footer-link li a:focus {
    padding-left: 5px;
}


/* =========================================
   BAGIAN COPYRIGHT
========================================= */

.footer-sekolah .footer-bawah {
    margin-top: 30px;
    padding-top: 18px;
    border-top: 1px solid rgba(255,255,255,0.3);
    text-align: center;
}

.footer-sekolah .footer-copyright {
    margin: 0;
    font-size: 13px;
    line-height: 1.8;
}


/* =========================================
   RESPONSIVE TABLET
========================================= */

@media (max-width: 991px) {

    .footer-sekolah {
        padding-top: 30px;
    }

    .footer-sekolah .footer-judul {
        font-size: 22px;
    }

    .footer-sekolah .footer-subjudul {
        font-size: 17px;
    }

}


/* =========================================
   RESPONSIVE HP
========================================= */

@media (max-width: 767px) {

    .footer-sekolah {
        margin-top: 30px;
        padding: 30px 15px 15px;
        text-align: center;
    }

    .footer-sekolah .footer-judul {
        font-size: 21px;
    }

    .footer-sekolah .footer-subjudul {
        margin-top: 30px;
        margin-bottom: 15px;
        font-size: 17px;
    }

    /* Kolom pertama tidak perlu jarak atas */
    .footer-sekolah .footer-kolom:first-child .footer-subjudul {
        margin-top: 0;
    }

    .footer-sekolah .footer-deskripsi {
        font-size: 14px;
        line-height: 1.7;
    }

    .footer-sekolah .footer-item {
        font-size: 14px;
        line-height: 1.7;
    }

    .footer-sekolah .footer-link li {
        margin-bottom: 10px;
    }

    .footer-sekolah .footer-link li a {
        font-size: 14px;
    }

    .footer-sekolah .media-sosial {
        margin-top: 20px;
    }

    .footer-sekolah .media-sosial-link {
        width: 42px;
        height: 42px;
        margin: 3px;
        line-height: 42px;
    }

    .footer-sekolah .footer-bawah {
        margin-top: 25px;
        padding-top: 15px;
    }

    .footer-sekolah .footer-copyright {
        font-size: 12px;
        line-height: 1.7;
    }

}


/* =========================================
   HP KECIL
========================================= */

@media (max-width: 480px) {

    .footer-sekolah {
        padding-left: 12px;
        padding-right: 12px;
    }

    .footer-sekolah .footer-judul {
        font-size: 20px;
    }

    .footer-sekolah .footer-subjudul {
        font-size: 16px;
    }

    .footer-sekolah .footer-deskripsi,
    .footer-sekolah .footer-item {
        font-size: 13px;
    }

    .footer-sekolah .footer-link li a {
        font-size: 13px;
    }

    .footer-sekolah .footer-copyright {
        font-size: 11px;
    }

}

</style>


<footer class="footer-sekolah">

    <div class="container">

        <div class="row">

            <!-- =================================
                 INFORMASI SEKOLAH
            ================================== -->
            <div class="col-sm-4 footer-kolom">

                <h3 class="footer-judul">
                    MTs Nurul Huda
                </h3>

                <p class="footer-deskripsi">
                    Website resmi MTs Nurul Huda Pematang Cengal
                    sebagai media informasi dan komunikasi sekolah
                    dengan siswa, orang tua, guru, dan masyarakat.
                </p>


                <!-- MEDIA SOSIAL -->
                <div class="media-sosial">

                    <h4 class="footer-subjudul">
                        Ikuti Kami
                    </h4>


                    <a href="https://www.facebook.com/profile.php?id=100089624137693"
                       target="_blank"
                       rel="noopener noreferrer"
                       title="Facebook"
                       class="media-sosial-link">

                        <span class="glyphicon glyphicon-thumbs-up"></span>

                    </a>


                    <a href="https://www.instagram.com/yaspennurulhudap.cengal"
                       target="_blank"
                       rel="noopener noreferrer"
                       title="Instagram"
                       class="media-sosial-link">

                        <span class="glyphicon glyphicon-camera"></span>

                    </a>


                    <a href="https://www.tiktok.com/@yaspen.nurul.huda85"
                       target="_blank"
                       rel="noopener noreferrer"
                       title="TikTok"
                       class="media-sosial-link">

                        <span class="glyphicon glyphicon-music"></span>

                    </a>

                </div>

            </div>


            
            <div class="col-sm-4 footer-kolom">

                <h4 class="footer-subjudul">

                    <span class="glyphicon glyphicon-map-marker"></span>

                    Alamat Sekolah

                </h4>


                <div class="footer-item">

                    <strong>
                        MTs Nurul Huda Pematang Cengal
                    </strong>

                </div>


                <div class="footer-item">
                    Desa Pematang Cengal
                </div>


                <div class="footer-item">
                    Kabupaten Langkat
                </div>


                <div class="footer-item">
                    Sumatera Utara
                </div>


                <div class="footer-item">

                    <span class="glyphicon glyphicon-phone"></span>

                    WA: 085362532382

                </div>


                <div class="footer-item">

                    <span class="glyphicon glyphicon-envelope"></span>

                    Email: info@mtsnurulhuda.sch.id

                </div>

            </div>


            <!-- =================================
                 LINK TERKAIT
            ================================== -->
            <div class="col-sm-4 footer-kolom">

                <h4 class="footer-subjudul">

                    <span class="glyphicon glyphicon-link"></span>

                    Link Terkait

                </h4>


                <ul class="footer-link">

                    <li>
                        <a href="index.php">

                            <span class="glyphicon glyphicon-home"></span>

                            Beranda

                        </a>
                    </li>


                    <li>
                        <a href="profile.php">

                            <span class="glyphicon glyphicon-info-sign"></span>

                            Profil Sekolah

                        </a>
                    </li>


                    <li>
                        <a href="data_guru.php">

                            <span class="glyphicon glyphicon-education"></span>

                            Data Guru

                        </a>
                    </li>


                    <li>
                        <a href="berita.php">

                            <span class="glyphicon glyphicon-list-alt"></span>

                            Berita

                        </a>
                    </li>


                    <li>
                        <a href="agenda.php">

                            <span class="glyphicon glyphicon-calendar"></span>

                            Agenda

                        </a>
                    </li>


                    <li>
                        <a href="ekstrakurikuler.php">

                            <span class="glyphicon glyphicon-flag"></span>

                            Ekstrakurikuler

                        </a>
                    </li>


                    <li>
                        <a href="prestasi.php">

                            <span class="glyphicon glyphicon-star"></span>

                            Prestasi

                        </a>
                    </li>


                    <li>
                        <a href="galeri.php">

                            <span class="glyphicon glyphicon-picture"></span>

                            Galeri

                        </a>
                    </li>


                    <li>
                        <a href="kontak.php">

                            <span class="glyphicon glyphicon-earphone"></span>

                            Kontak

                        </a>
                    </li>

                </ul>

            </div>

        </div>


        <!-- =================================
             COPYRIGHT
        ================================== -->

        <div class="footer-bawah">

            <p class="footer-copyright">

                Copyright © 2026 MTs Nurul Huda Pematang Cengal.
                All rights reserved.

            </p>

        </div>

    </div>

</footer>