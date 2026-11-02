<?php include "navbar.php"; ?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Profil Sekolah - MTs Nurul Huda Pematang Cengal</title>


    <style>

        /* =====================================================
           HALAMAN PROFIL
        ===================================================== */

        .profile-page{
            padding-top:90px;
            padding-bottom:35px;
        }


        /* =====================================================
           HEADER PROFIL
        ===================================================== */

        .profile-header{
            background:#4CAF50;
            color:#fff;
            border-radius:8px;
            padding:35px 20px;
            text-align:center;
            margin-bottom:25px;
            box-shadow:0 3px 10px rgba(0,0,0,0.15);
        }


        .profile-header img{
            width:120px;
            height:120px;
            object-fit:contain;
            background:#fff;
            padding:8px;
            border-radius:50%;
            box-shadow:0 3px 8px rgba(0,0,0,0.25);
            margin-bottom:15px;
        }


        .profile-header h1{
            font-size:30px;
            font-weight:bold;
            margin:10px 0;
            line-height:1.4;
        }


        .profile-header p{
            font-size:16px;
            line-height:1.7;
            margin:0 auto;
            max-width:800px;
        }


        /* =====================================================
           KOTAK PROFIL
        ===================================================== */

        .profile-box{
            background:#fff;
            border:1px solid #ddd;
            border-radius:7px;
            margin-bottom:20px;
            box-shadow:0 2px 7px rgba(0,0,0,0.08);
            overflow:hidden;
        }


        /* =====================================================
           JUDUL KOTAK
        ===================================================== */

        .profile-box-heading{
            background:#4CAF50;
            color:#fff;
            padding:13px 18px;
            font-size:18px;
            font-weight:bold;
            line-height:1.5;
        }


        .profile-box-heading .glyphicon{
            margin-right:6px;
        }


        /* =====================================================
           ISI KOTAK
        ===================================================== */

        .profile-box-content{
            padding:20px;
            color:#333;
            line-height:1.8;
            font-size:15px;
        }


        .profile-box-content p{
            margin-top:0;
            margin-bottom:0;
        }


        .profile-box-content ul{
            margin-top:0;
            margin-bottom:0;
            padding-left:25px;
        }


        .profile-box-content li{
            margin-bottom:8px;
        }


        .profile-box-content li:last-child{
            margin-bottom:0;
        }


        /* =====================================================
           VISI DAN MISI
        ===================================================== */

        .profile-info-box{
            min-height:245px;
        }


        .profile-info-box .profile-box-content{
            padding:18px;
        }


        /* =====================================================
           TABEL IDENTITAS
        ===================================================== */

        .profile-table{
            margin-bottom:0;
        }


        .profile-table th{
            width:30%;
            background:#f5f5f5;
            vertical-align:middle !important;
        }


        .profile-table td{
            vertical-align:middle !important;
        }


        /* =====================================================
           RESPONSIVE TABLET / HP
        ===================================================== */

        @media(max-width:767px){

            .profile-page{
                padding-top:75px;
                padding-bottom:25px;
            }


            /* Header */

            .profile-header{
                padding:25px 15px;
                margin-bottom:20px;
                border-radius:6px;
            }


            .profile-header img{
                width:100px;
                height:100px;
                margin-bottom:10px;
            }


            .profile-header h1{
                font-size:23px;
                line-height:1.4;
                margin:8px 0;
            }


            .profile-header p{
                font-size:14px;
                line-height:1.7;
            }


            /* Kotak */

            .profile-box{
                margin-bottom:15px;
            }


            .profile-box-heading{
                padding:12px 15px;
                font-size:17px;
            }


            .profile-box-content{
                padding:15px;
                font-size:14px;
                line-height:1.8;
            }


            /* Visi Misi */

            .profile-info-box{
                min-height:auto;
            }


            .profile-info-box .profile-box-content{
                padding:15px;
            }


            /* List */

            .profile-box-content ul{
                padding-left:22px;
            }


            .profile-box-content li{
                margin-bottom:7px;
            }


            /* Tabel */

            .profile-table th{
                width:40%;
            }


            .profile-table th,
            .profile-table td{
                padding:10px !important;
                font-size:13px;
            }

        }


        /* =====================================================
           HP LAYAR KECIL
        ===================================================== */

        @media(max-width:480px){

            .profile-page{
                padding-left:10px;
                padding-right:10px;
            }


            .profile-header{
                padding:22px 12px;
            }


            .profile-header img{
                width:90px;
                height:90px;
            }


            .profile-header h1{
                font-size:21px;
            }


            .profile-header p{
                font-size:13px;
            }


            .profile-box-heading{
                font-size:16px;
                padding:11px 13px;
            }


            .profile-box-content{
                font-size:13px;
                padding:14px;
            }


            .profile-table th,
            .profile-table td{
                font-size:12px;
                padding:8px !important;
            }

        }

    </style>

</head>


<body>


    <!-- =====================================================
         HALAMAN PROFIL
    ====================================================== -->

    <div class="container profile-page">


        <!-- =================================================
             HEADER PROFIL
        ================================================== -->

        <div class="profile-header">

            <img src="../images/logo.jpeg"
                 alt="Logo MTs Nurul Huda">

            <h1>
                MTs Nurul Huda Pematang Cengal
            </h1>

            <p>
                Madrasah yang unggul dalam prestasi,
                berakhlakul karimah, serta berwawasan
                ilmu pengetahuan dan teknologi.
            </p>

        </div>


        <!-- =================================================
             SEJARAH
        ================================================== -->

        <div class="profile-box">

            <div class="profile-box-heading">

                <span class="glyphicon glyphicon-book"></span>

                Sejarah Singkat

            </div>


            <div class="profile-box-content">

                <p style="text-align:justify;">

                    MTs Nurul Huda Pematang Cengal merupakan salah satu
                    lembaga pendidikan Islam yang berkomitmen memberikan
                    pendidikan berkualitas kepada peserta didik.

                    Sejak berdirinya, madrasah terus berkembang dalam
                    meningkatkan mutu pendidikan, baik di bidang akademik
                    maupun non-akademik.

                </p>

            </div>

        </div>


        <!-- =================================================
             VISI DAN MISI
        ================================================== -->

        <div class="row">


            <!-- ================= VISI ================= -->

            <div class="col-sm-6">

                <div class="profile-box profile-info-box">

                    <div class="profile-box-heading">

                        <span class="glyphicon glyphicon-eye-open"></span>

                        Visi

                    </div>


                    <div class="profile-box-content">

                        <p style="text-align:justify;">

                            "Terwujudnya peserta didik yang beriman,
                            bertakwa, berakhlakul karimah, berprestasi,
                            dan mampu bersaing di era global."

                        </p>

                    </div>

                </div>

            </div>


            <!-- ================= MISI ================= -->

            <div class="col-sm-6">

                <div class="profile-box profile-info-box">

                    <div class="profile-box-heading">

                        <span class="glyphicon glyphicon-flag"></span>

                        Misi

                    </div>


                    <div class="profile-box-content">

                        <ul>

                            <li>
                                Meningkatkan kualitas pembelajaran
                                yang efektif dan inovatif.
                            </li>

                            <li>
                                Menanamkan nilai-nilai keislaman
                                dalam kehidupan sehari-hari.
                            </li>

                            <li>
                                Meningkatkan prestasi akademik
                                dan non-akademik.
                            </li>

                            <li>
                                Mengembangkan karakter disiplin,
                                jujur, dan bertanggung jawab.
                            </li>

                            <li>
                                Menciptakan lingkungan sekolah
                                yang bersih, nyaman, dan religius.
                            </li>

                        </ul>

                    </div>

                </div>

            </div>

        </div>


        <!-- =================================================
             TUJUAN SEKOLAH
        ================================================== -->

        <div class="profile-box">

            <div class="profile-box-heading">

                <span class="glyphicon glyphicon-ok-circle"></span>

                Tujuan Sekolah

            </div>


            <div class="profile-box-content">

                <ul>

                    <li>
                        Menghasilkan lulusan yang beriman dan
                        bertakwa kepada Allah SWT.
                    </li>

                    <li>
                        Meningkatkan prestasi peserta didik
                        di bidang akademik maupun non-akademik.
                    </li>

                    <li>
                        Membentuk karakter siswa yang disiplin,
                        mandiri, dan bertanggung jawab.
                    </li>

                    <li>
                        Menguasai ilmu pengetahuan dan teknologi
                        sesuai perkembangan zaman.
                    </li>

                </ul>

            </div>

        </div>


        <!-- =================================================
             IDENTITAS SEKOLAH
        ================================================== -->

        <div class="profile-box">

            <div class="profile-box-heading">

                <span class="glyphicon glyphicon-info-sign"></span>

                Identitas Sekolah

            </div>


            <div class="profile-box-content">

                <div class="table-responsive">

                    <table class="table table-bordered profile-table">

                        <tbody>

                            <tr>

                                <th>
                                    Nama Sekolah
                                </th>

                                <td>
                                    MTs Nurul Huda Pematang Cengal
                                </td>

                            </tr>


                            <tr>

                                <th>
                                    Status
                                </th>

                                <td>
                                    Swasta
                                </td>

                            </tr>


                            <tr>

                                <th>
                                    Jenjang Pendidikan
                                </th>

                                <td>
                                    Madrasah Tsanawiyah (MTs)
                                </td>

                            </tr>


                            <tr>

                                <th>
                                    Alamat
                                </th>

                                <td>
                                    Pematang Cengal,
                                    Kabupaten Langkat,
                                    Sumatera Utara
                                </td>

                            </tr>


                            <tr>

                                <th>
                                    Email
                                </th>

                                <td>
                                    info@mtsnurulhuda.sch.id
                                </td>

                            </tr>

                        </tbody>

                    </table>

                </div>

            </div>

        </div>


    </div>


    <!-- =====================================================
         FOOTER
    ====================================================== -->

    <?php include "footer.php"; ?>


</body>

</html>