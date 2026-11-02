<?php
session_start();

if (empty($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit;
}

require_once "../koneksi.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: profile_admin.php");
    exit;
}

$idAdmin = $_SESSION['admin_id'];
$username = trim($_POST['username'] ?? '');
$passwordLama = $_POST['password_lama'] ?? '';
$passwordBaru = $_POST['password_baru'] ?? '';
$konfirmasiPassword = $_POST['konfirmasi_password'] ?? '';

if ($username === '' || $passwordLama === '') {
    header("Location: profile_admin.php?pesan=Username dan password saat ini wajib diisi.");
    exit;
}

/* Ambil password terbaru dari database */
$stmt = mysqli_prepare(
    $koneksi,
    "SELECT password FROM admin WHERE id_admin = ? LIMIT 1"
);
mysqli_stmt_bind_param($stmt, "i", $idAdmin);
mysqli_stmt_execute($stmt);

$admin = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));

if (!$admin || !password_verify($passwordLama, $admin['password'])) {
    header("Location: profile_admin.php?pesan=Password saat ini salah.");
    exit;
}

/* Pastikan username baru belum digunakan admin lain */
$stmt = mysqli_prepare(
    $koneksi,
    "SELECT id_admin FROM admin WHERE username = ? AND id_admin != ? LIMIT 1"
);
mysqli_stmt_bind_param($stmt, "si", $username, $idAdmin);
mysqli_stmt_execute($stmt);

$usernameSama = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));

if ($usernameSama) {
    header("Location: profile_admin.php?pesan=Username tersebut sudah digunakan.");
    exit;
}

/* Jika password baru diisi, ubah username dan password */
if ($passwordBaru !== '') {
    if (strlen($passwordBaru) < 12) {
        header("Location: profile_admin.php?pesan=Password baru minimal 12 karakter.");
        exit;
    }

    if ($passwordBaru !== $konfirmasiPassword) {
        header("Location: profile_admin.php?pesan=Konfirmasi password baru tidak sama.");
        exit;
    }

    $passwordHash = password_hash($passwordBaru, PASSWORD_DEFAULT);

    $stmt = mysqli_prepare(
        $koneksi,
        "UPDATE admin
         SET username = ?, password = ?, password_updated_at = NOW()
         WHERE id_admin = ?"
    );
    mysqli_stmt_bind_param($stmt, "ssi", $username, $passwordHash, $idAdmin);

} else {
    /* Hanya ubah username */
    $stmt = mysqli_prepare(
        $koneksi,
        "UPDATE admin SET username = ? WHERE id_admin = ?"
    );
    mysqli_stmt_bind_param($stmt, "si", $username, $idAdmin);
}

if (mysqli_stmt_execute($stmt)) {
    session_regenerate_id(true);
    $_SESSION['username'] = $username;

    header("Location: profile_admin.php?pesan=Profil berhasil diperbarui.");
    exit;
}

header("Location: profile_admin.php?pesan=Gagal menyimpan perubahan.");
exit;