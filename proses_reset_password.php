<?php
require_once 'auth.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect_to('lupa_password.php');
}

verify_csrf();

$username = trim($_POST['username'] ?? '');
$recoveryCode = $_POST['recovery_code'] ?? '';
$passwordBaru = $_POST['password_baru'] ?? '';
$konfirmasi = $_POST['konfirmasi_password'] ?? '';

if (
    $username === '' ||
    $recoveryCode === '' ||
    $passwordBaru === '' ||
    $konfirmasi === ''
) {
    set_flash('Semua kolom wajib diisi.');
    redirect_to('lupa_password.php');
}

if (strlen($passwordBaru) < 12) {
    set_flash('Password baru minimal 12 karakter.');
    redirect_to('lupa_password.php');
}

if ($passwordBaru !== $konfirmasi) {
    set_flash('Konfirmasi password tidak sama.');
    redirect_to('lupa_password.php');
}

$db = db();

$stmt = $db->prepare(
    'SELECT id_admin, recovery_code_hash
     FROM admin
     WHERE username = ?
     LIMIT 1'
);
$stmt->bind_param('s', $username);
$stmt->execute();
$admin = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (
    !$admin ||
    empty($admin['recovery_code_hash']) ||
    !password_verify($recoveryCode, $admin['recovery_code_hash'])
) {
    set_flash('Username atau kode pemulihan tidak valid.');
    redirect_to('lupa_password.php');
}

$passwordHash = password_hash($passwordBaru, PASSWORD_DEFAULT);

$stmt = $db->prepare(
    'UPDATE admin
     SET password = ?, password_updated_at = NOW()
     WHERE id_admin = ?'
);
$stmt->bind_param('si', $passwordHash, $admin['id_admin']);
$stmt->execute();
$stmt->close();

set_flash('Password berhasil direset. Silakan login.', 'success');
redirect_to('login.php');