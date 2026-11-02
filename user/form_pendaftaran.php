<?php

include "../koneksi.php";

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="utf-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1">

    <title>Form Pendaftaran PPDB - MTs Nurul Huda</title>

    <link href="../bootstrap/css/bootstrap.min.css"
          rel="stylesheet">


    <style>

        /* =====================================
           BODY
        ===================================== */

        body{
            background:#f4f7f5;
            padding-top:70px;
            color:#333;
            font-family:Arial, sans-serif;
        }


        /* =====================================
           CONTAINER
        ===================================== */

        .ppdb-container{
            padding-top:30px;
            padding-bottom:60px;
        }


        /* =====================================
           HEADER
        ===================================== */

        .ppdb-header{
            background:linear-gradient(
                135deg,
                #176b3a,
                #2e8b57
            );

            color:#fff;

            padding:35px 25px;

            border-radius:14px;

            text-align:center;

            margin-bottom:25px;

            box-shadow:
                0 5px 18px
                rgba(0,0,0,.10);
        }

        .ppdb-header .header-icon{
            width:70px;
            height:70px;

            line-height:70px;

            margin:0 auto 15px;

            border-radius:50%;

            background:rgba(255,255,255,.15);

            font-size:32px;
        }

        .ppdb-header h1{
            margin:0 0 10px;

            font-size:30px;

            font-weight:bold;
        }

        .ppdb-header p{
            margin:0;

            font-size:15px;

            line-height:1.7;
        }


        /* =====================================
           INFORMASI
        ===================================== */

        .info-box{
            background:#fff;

            border-left:5px solid #2e7d32;

            padding:18px 20px;

            border-radius:8px;

            margin-bottom:25px;

            box-shadow:
                0 3px 10px
                rgba(0,0,0,.05);
        }

        .info-box h4{
            margin-top:0;

            color:#2e7d32;

            font-weight:bold;
        }

        .info-box p{
            margin-bottom:5px;

            color:#666;
        }


        /* =====================================
           PANEL
        ===================================== */

        .form-panel{
            background:#fff;

            border-radius:12px;

            margin-bottom:22px;

            overflow:hidden;

            box-shadow:
                0 3px 14px
                rgba(0,0,0,.06);
        }


        .form-heading{
            background:#f8faf9;

            border-bottom:1px solid #e7e7e7;

            padding:18px 22px;

            color:#2e7d32;

            font-size:18px;

            font-weight:bold;
        }

        .form-heading .glyphicon{
            margin-right:8px;
        }


        .form-body{
            padding:25px;
        }


        /* =====================================
           LABEL
        ===================================== */

        .form-group label{
            font-size:14px;

            font-weight:bold;

            color:#444;

            margin-bottom:7px;
        }

        .required{
            color:#d9534f;
        }

        .optional{
            color:#999;

            font-size:12px;

            font-weight:normal;
        }


        /* =====================================
           INPUT
        ===================================== */

        .form-control{
            height:43px;

            border-radius:7px;

            border:1px solid #ddd;

            box-shadow:none;

            transition:.2s;
        }

        textarea.form-control{
            height:100px;

            resize:vertical;
        }

        .form-control:focus{
            border-color:#2e7d32;

            box-shadow:
                0 0 0 2px
                rgba(46,125,50,.08);
        }


        /* =====================================
           FILE UPLOAD
        ===================================== */

        .upload-box{
            background:#f8faf9;

            border:1px solid #e5e9e6;

            border-radius:8px;

            padding:15px;

            margin-bottom:15px;
        }

        .upload-box label{
            margin-bottom:8px;
        }

        .upload-box .form-control{
            background:#fff;

            height:auto;

            padding:9px;
        }

        .file-help{
            display:block;

            margin-top:6px;

            color:#888;

            font-size:12px;
        }


        /* =====================================
           KETENTUAN UPLOAD
        ===================================== */

        .upload-info{
            background:#eef8f0;

            border:1px solid #d5ead8;

            border-radius:8px;

            padding:15px;

            margin-bottom:20px;

            color:#555;

            font-size:13px;

            line-height:1.7;
        }

        .upload-info strong{
            color:#2e7d32;
        }


        /* =====================================
           CHECKBOX
        ===================================== */

        .agreement{
            background:#f8faf9;

            border:1px solid #e5e9e6;

            border-radius:8px;

            padding:15px;

            margin-bottom:20px;
        }

        .agreement label{
            font-weight:normal;

            line-height:1.6;

            margin:0;
        }


        /* =====================================
           SUBMIT
        ===================================== */

        .submit-panel{
            background:#fff;

            padding:25px;

            border-radius:12px;

            box-shadow:
                0 3px 14px
                rgba(0,0,0,.06);

            text-align:center;
        }

        .btn-submit{
            background:#2e7d32;

            border:none;

            color:#fff;

            padding:13px 35px;

            border-radius:8px;

            font-size:16px;

            font-weight:bold;

            transition:.2s;
        }

        .btn-submit:hover{
            background:#1b5e20;

            color:#fff;

            transform:translateY(-1px);
        }


        .btn-reset{
            margin-left:8px;

            padding:13px 25px;

            border-radius:8px;

            font-size:15px;
        }


        /* =====================================
           RESPONSIVE
        ===================================== */

        @media(max-width:767px){

            body{
                padding-top:70px;
            }

            .ppdb-container{
                padding-top:15px;

                padding-bottom:35px;
            }

            .ppdb-header{
                padding:28px 18px;

                border-radius:10px;
            }

            .ppdb-header h1{
                font-size:23px;
            }

            .ppdb-header p{
                font-size:13px;
            }

            .form-body{
                padding:18px;
            }

            .form-heading{
                padding:15px 18px;

                font-size:16px;
            }

            .form-control{
                height:42px;
            }

            .btn-submit,
            .btn-reset{
                width:100%;

                margin:0 0 10px 0;
            }

        }

    </style>

</head>


<body>


<?php include "navbar.php"; ?>


<div class="container ppdb-container">


    <!-- =====================================
         HEADER
    ===================================== -->

    <div class="ppdb-header">

        <div class="header-icon">

            <span class="glyphicon glyphicon-edit"></span>

        </div>

        <h1>
            Formulir Pendaftaran PPDB
        </h1>

        <p>

            MTs Nurul Huda Pematang Cengal

            <br>

            Tahun Ajaran 2026/2027

        </p>

    </div>



    <!-- =====================================
         INFORMASI
    ===================================== -->

    <div class="info-box">

        <h4>

            <span class="glyphicon glyphicon-info-sign"></span>

            Petunjuk Pendaftaran

        </h4>

        <p>
            Silakan isi seluruh data calon siswa
            dengan benar dan sesuai dengan dokumen resmi.
        </p>

        <p>
            Kolom dengan tanda
            <span class="required">*</span>
            wajib diisi.
        </p>

        <p>
            Pastikan dokumen yang diupload dapat dibaca
            dengan jelas.
        </p>

    </div>



    <!-- =====================================
         FORM
    ===================================== -->

    <form
        action="proses_pendaftaran.php"
        method="POST"
        enctype="multipart/form-data">


        <!-- =====================================
             DATA CALON SISWA
        ===================================== -->

        <div class="form-panel">

            <div class="form-heading">

                <span class="glyphicon glyphicon-user"></span>

                Data Calon Siswa

            </div>


            <div class="form-body">

                <div class="row">


                    <!-- NAMA -->

                    <div class="col-md-6">

                        <div class="form-group">

                            <label>
                                Nama Lengkap
                                <span class="required">*</span>
                            </label>

                            <input
                                type="text"
                                name="nama_lengkap"
                                class="form-control"
                                placeholder="Masukkan nama lengkap"
                                required>

                        </div>

                    </div>


                    <!-- NIK -->

                    <div class="col-md-6">

                        <div class="form-group">

                            <label>
                                NIK
                                <span class="required">*</span>
                            </label>

                            <input
                                type="text"
                                name="nik"
                                class="form-control"
                                maxlength="20"
                                placeholder="Masukkan NIK"
                                required>

                        </div>

                    </div>


                    <!-- NISN -->

                    <div class="col-md-6">

                        <div class="form-group">

                            <label>
                                NISN
                                <span class="required">*</span>
                            </label>

                            <input
                                type="text"
                                name="nisn"
                                class="form-control"
                                maxlength="20"
                                placeholder="Masukkan NISN"
                                required>

                        </div>

                    </div>


                    <!-- TEMPAT LAHIR -->

                    <div class="col-md-6">

                        <div class="form-group">

                            <label>
                                Tempat Lahir
                                <span class="required">*</span>
                            </label>

                            <input
                                type="text"
                                name="tempat_lahir"
                                class="form-control"
                                placeholder="Contoh: Pematang Cengal"
                                required>

                        </div>

                    </div>


                    <!-- TANGGAL LAHIR -->

                    <div class="col-md-6">

                        <div class="form-group">

                            <label>
                                Tanggal Lahir
                                <span class="required">*</span>
                            </label>

                            <input
                                type="date"
                                name="tanggal_lahir"
                                class="form-control"
                                required>

                        </div>

                    </div>


                    <!-- JENIS KELAMIN -->

                    <div class="col-md-6">

                        <div class="form-group">

                            <label>
                                Jenis Kelamin
                                <span class="required">*</span>
                            </label>

                            <select
                                name="jenis_kelamin"
                                class="form-control"
                                required>

                                <option value="">
                                    -- Pilih Jenis Kelamin --
                                </option>

                                <option value="Laki-laki">
                                    Laki-laki
                                </option>

                                <option value="Perempuan">
                                    Perempuan
                                </option>

                            </select>

                        </div>

                    </div>


                    <!-- AGAMA -->

                    <div class="col-md-6">

                        <div class="form-group">

                            <label>
                                Agama
                                <span class="required">*</span>
                            </label>

                            <select
                                name="agama"
                                class="form-control"
                                required>

                                <option value="">
                                    -- Pilih Agama --
                                </option>

                                <option value="Islam">
                                    Islam
                                </option>

                                <option value="Kristen">
                                    Kristen
                                </option>

                                <option value="Katolik">
                                    Katolik
                                </option>

                                <option value="Hindu">
                                    Hindu
                                </option>

                                <option value="Buddha">
                                    Buddha
                                </option>

                                <option value="Konghucu">
                                    Konghucu
                                </option>

                            </select>

                        </div>

                    </div>


                    <!-- NO HP -->

                    <div class="col-md-6">

                        <div class="form-group">

                            <label>
                                Nomor HP
                                <span class="required">*</span>
                            </label>

                            <input
                                type="text"
                                name="no_hp"
                                class="form-control"
                                placeholder="Contoh: 08123456789"
                                required>

                        </div>

                    </div>


                    <!-- ASAL SEKOLAH -->

                    <div class="col-md-6">

                        <div class="form-group">

                            <label>
                                Asal Sekolah
                                <span class="required">*</span>
                            </label>

                            <input
                                type="text"
                                name="asal_sekolah"
                                class="form-control"
                                placeholder="Nama SD/MI asal"
                                required>

                        </div>

                    </div>


                    <!-- TAHUN LULUS -->

                    <div class="col-md-6">

                        <div class="form-group">

                            <label>
                                Tahun Lulus
                                <span class="required">*</span>
                            </label>

                            <input
                                type="number"
                                name="tahun_lulus"
                                class="form-control"
                                value="2026"
                                min="2000"
                                max="2100"
                                required>

                        </div>

                    </div>


                    <!-- ALAMAT -->

                    <div class="col-md-12">

                        <div class="form-group">

                            <label>
                                Alamat Lengkap
                                <span class="required">*</span>
                            </label>

                            <textarea
                                name="alamat"
                                class="form-control"
                                placeholder="Masukkan alamat lengkap calon siswa"
                                required></textarea>

                        </div>

                    </div>


                </div>

            </div>

        </div>



        <!-- =====================================
             DATA AYAH
        ===================================== -->

        <div class="form-panel">

            <div class="form-heading">

                <span class="glyphicon glyphicon-user"></span>

                Data Ayah

            </div>


            <div class="form-body">

                <div class="row">


                    <div class="col-md-6">

                        <div class="form-group">

                            <label>
                                Nama Ayah
                                <span class="required">*</span>
                            </label>

                            <input
                                type="text"
                                name="nama_ayah"
                                class="form-control"
                                placeholder="Masukkan nama ayah"
                                required>

                        </div>

                    </div>


                    <div class="col-md-6">

                        <div class="form-group">

                            <label>
                                NIK Ayah
                                <span class="optional">
                                    (Opsional)
                                </span>
                            </label>

                            <input
                                type="text"
                                name="nik_ayah"
                                class="form-control"
                                placeholder="Masukkan NIK ayah">

                        </div>

                    </div>


                    <div class="col-md-6">

                        <div class="form-group">

                            <label>
                                Pekerjaan Ayah
                            </label>

                            <input
                                type="text"
                                name="pekerjaan_ayah"
                                class="form-control"
                                placeholder="Masukkan pekerjaan ayah">

                        </div>

                    </div>


                    <div class="col-md-6">

                        <div class="form-group">

                            <label>
                                Nomor HP Ayah
                            </label>

                            <input
                                type="text"
                                name="no_hp_ayah"
                                class="form-control"
                                placeholder="Contoh: 08123456789">

                        </div>

                    </div>


                </div>

            </div>

        </div>



        <!-- =====================================
             DATA IBU
        ===================================== -->

        <div class="form-panel">

            <div class="form-heading">

                <span class="glyphicon glyphicon-user"></span>

                Data Ibu

            </div>


            <div class="form-body">

                <div class="row">


                    <div class="col-md-6">

                        <div class="form-group">

                            <label>
                                Nama Ibu
                                <span class="required">*</span>
                            </label>

                            <input
                                type="text"
                                name="nama_ibu"
                                class="form-control"
                                placeholder="Masukkan nama ibu"
                                required>

                        </div>

                    </div>


                    <div class="col-md-6">

                        <div class="form-group">

                            <label>
                                NIK Ibu
                                <span class="optional">
                                    (Opsional)
                                </span>
                            </label>

                            <input
                                type="text"
                                name="nik_ibu"
                                class="form-control"
                                placeholder="Masukkan NIK ibu">

                        </div>

                    </div>


                    <div class="col-md-6">

                        <div class="form-group">

                            <label>
                                Pekerjaan Ibu
                            </label>

                            <input
                                type="text"
                                name="pekerjaan_ibu"
                                class="form-control"
                                placeholder="Masukkan pekerjaan ibu">

                        </div>

                    </div>


                    <div class="col-md-6">

                        <div class="form-group">

                            <label>
                                Nomor HP Ibu
                            </label>

                            <input
                                type="text"
                                name="no_hp_ibu"
                                class="form-control"
                                placeholder="Contoh: 08123456789">

                        </div>

                    </div>


                </div>

            </div>

        </div>



        <!-- =====================================
             DOKUMEN
        ===================================== -->

        <div class="form-panel">

            <div class="form-heading">

                <span class="glyphicon glyphicon-folder-open"></span>

                Dokumen Persyaratan

            </div>


            <div class="form-body">


                <!-- INFORMASI -->

                <div class="upload-info">

                    <strong>
                        <span class="glyphicon glyphicon-info-sign"></span>
                        Ketentuan Upload
                    </strong>

                    <br>

                    Format file:
                    JPG, JPEG, PNG, atau PDF.

                    <br>

                    Ukuran maksimal:
                    <strong>5 MB per file.</strong>

                    <br>

                    Pastikan dokumen terlihat jelas
                    dan tidak buram.

                </div>



                <!-- FOTO -->

                <div class="upload-box">

                    <div class="form-group">

                        <label>

                            Foto 3x4 Latar Belakang Biru

                            <span class="required">*</span>

                        </label>

                        <input
                            type="file"
                            name="foto"
                            class="form-control"
                            accept=".jpg,.jpeg,.png"
                            required>

                        <span class="file-help">

                            Format JPG, JPEG, atau PNG.

                        </span>

                    </div>

                </div>



                <!-- SURAT KELULUSAN -->

                <div class="upload-box">

                    <div class="form-group">

                        <label>

                            Surat Kelulusan

                            <span class="required">*</span>

                        </label>

                        <input
                            type="file"
                            name="dokumen_surat_kelulusan"
                            class="form-control"
                            accept=".jpg,.jpeg,.png,.pdf"
                            required>

                    </div>

                </div>



                <!-- SKHU -->

                <div class="upload-box">

                    <div class="form-group">

                        <label>

                            SKHU SD/MI

                            <span class="required">*</span>

                        </label>

                        <input
                            type="file"
                            name="dokumen_skhu"
                            class="form-control"
                            accept=".jpg,.jpeg,.png,.pdf"
                            required>

                    </div>

                </div>



                <!-- AKTA -->

                <div class="upload-box">

                    <div class="form-group">

                        <label>

                            Akte Kelahiran

                            <span class="optional">
                                (Jika Ada)
                            </span>

                        </label>

                        <input
                            type="file"
                            name="dokumen_akte_kelahiran"
                            class="form-control"
                            accept=".jpg,.jpeg,.png,.pdf">

                    </div>

                </div>



                <!-- KK -->

                <div class="upload-box">

                    <div class="form-group">

                        <label>

                            Kartu Keluarga

                            <span class="required">*</span>

                        </label>

                        <input
                            type="file"
                            name="dokumen_kartu_keluarga"
                            class="form-control"
                            accept=".jpg,.jpeg,.png,.pdf"
                            required>

                    </div>

                </div>



                <!-- KTP AYAH -->

                <div class="upload-box">

                    <div class="form-group">

                        <label>

                            KTP Ayah

                            <span class="required">*</span>

                        </label>

                        <input
                            type="file"
                            name="dokumen_ktp_ayah"
                            class="form-control"
                            accept=".jpg,.jpeg,.png,.pdf"
                            required>

                    </div>

                </div>



                <!-- KTP IBU -->

                <div class="upload-box">

                    <div class="form-group">

                        <label>

                            KTP Ibu

                            <span class="required">*</span>

                        </label>

                        <input
                            type="file"
                            name="dokumen_ktp_ibu"
                            class="form-control"
                            accept=".jpg,.jpeg,.png,.pdf"
                            required>

                    </div>

                </div>



                <!-- PKH -->

                <div class="upload-box">

                    <div class="form-group">

                        <label>

                            Kartu PKH

                            <span class="optional">
                                (Jika Ada)
                            </span>

                        </label>

                        <input
                            type="file"
                            name="dokumen_pkh"
                            class="form-control"
                            accept=".jpg,.jpeg,.png,.pdf">

                    </div>

                </div>



                <!-- KKS -->

                <div class="upload-box">

                    <div class="form-group">

                        <label>

                            Kartu KKS

                            <span class="optional">
                                (Jika Ada)
                            </span>

                        </label>

                        <input
                            type="file"
                            name="dokumen_kks"
                            class="form-control"
                            accept=".jpg,.jpeg,.png,.pdf">

                    </div>

                </div>



                <!-- KIP -->

                <div class="upload-box">

                    <div class="form-group">

                        <label>

                            Kartu KIP

                            <span class="optional">
                                (Jika Ada)
                            </span>

                        </label>

                        <input
                            type="file"
                            name="dokumen_kip"
                            class="form-control"
                            accept=".jpg,.jpeg,.png,.pdf">

                    </div>

                </div>


            </div>

        </div>



        <!-- =====================================
             PERNYATAAN
        ===================================== -->

        <div class="form-panel">

            <div class="form-heading">

                <span class="glyphicon glyphicon-check"></span>

                Pernyataan

            </div>


            <div class="form-body">

                <div class="agreement">

                    <label>

                        <input
                            type="checkbox"
                            name="persetujuan"
                            value="setuju"
                            required>

                        Saya menyatakan bahwa seluruh data
                        yang saya masukkan dalam formulir
                        pendaftaran ini adalah benar dan dapat
                        dipertanggungjawabkan.

                    </label>

                </div>


                <p class="text-muted">

                    <span class="required">*</span>
                    Wajib diisi.

                </p>

            </div>

        </div>



        <!-- =====================================
             TOMBOL
        ===================================== -->

        <div class="submit-panel">

            <p class="text-muted">

                Periksa kembali seluruh data dan dokumen
                sebelum mengirim pendaftaran.

            </p>


            <button
                type="submit"
                name="daftar"
                class="btn btn-submit">

                <span class="glyphicon glyphicon-send"></span>

                Kirim Pendaftaran

            </button>


            <button
                type="reset"
                class="btn btn-default btn-reset">

                <span class="glyphicon glyphicon-refresh"></span>

                Reset Form

            </button>

        </div>


    </form>


</div>



<?php include "footer.php"; ?>


<script src="../bootstrap/js/jquery.min.js"></script>

<script src="../bootstrap/js/bootstrap.min.js"></script>


</body>

</html>