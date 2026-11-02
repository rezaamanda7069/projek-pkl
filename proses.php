<?php
session_start();
require_once "../koneksi.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: login.php");
    exit;
}

$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';

if ($username === '' || $password === '') {
    echo "<script>
        alert('Username dan password wajib diisi.');
        window.location='login.php';
    </script>";
    exit;
}

$stmt = mysqli_prepare(
    $koneksi,
    "SELECT id_admin, username, password FROM admin WHERE username = ? LIMIT 1"
);

mysqli_stmt_bind_param($stmt, "s", $username);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);
$data = mysqli_fetch_assoc($result);

if ($data && password_verify($password, $data['password'])) {
    session_regenerate_id(true);

    $_SESSION['admin_id'] = $data['id_admin'];
    $_SESSION['username'] = $data['username'];

    header("Location: dasbord.php");
    exit;
}

echo "<script>
    alert('Login gagal! Username atau password salah.');
    window.location='login.php';
</script>";
exit;
?>