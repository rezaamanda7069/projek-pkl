<?php
require_once 'auth.php';
require_admin_login();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect_to('ubah_password.php');
}

verify_csrf();

$passwordLama = $_POST['password_lama'] ?? '';
$passwordBaru = $_POST['password_baru'] ?? '';
$konfirmasi = $_POST['konfirmasi_password'] ?? '';

if (strlen($passwordBaru) < 12) {
    set_flash('Password baru minimal 12 karakter.');
    redirect_to('ubah_password.php');
}

if ($passwordBaru !== $konfirmasi) {
    set_flash('Konfirmasi password tidak sama.');
    redirect_to('ubah_password.php');
}

$db = db();
$adminId = (int) $_SESSION['admin_id'];

$stmt = $db->prepare('SELECT password FROM admin WHERE id_admin = ? LIMIT 1');
$stmt->bind_param('i', $adminId);
$stmt->execute();
$admin = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$admin || !password_verify($passwordLama, $admin['password'])) {
    set_flash('Password lama salah.');
    redirect_to('ubah_password.php');
}

$passwordHash = password_hash($passwordBaru, PASSWORD_DEFAULT);

$stmt = $db->prepare(
    'UPDATE admin
     SET password = ?, password_updated_at = NOW()
     WHERE id_admin = ?'
);
$stmt->bind_param('si', $passwordHash, $adminId);
$stmt->execute();
$stmt->close();

set_flash('Password berhasil diubah.', 'success');
redirect_to('ubah_password.php');