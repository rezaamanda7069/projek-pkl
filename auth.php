<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../koneksi.php';

function db()
{
    global $koneksi, $conn, $mysqli;

    foreach (array($koneksi, $conn, $mysqli) as $connection) {
        if ($connection instanceof mysqli) {
            $connection->set_charset('utf8mb4');
            return $connection;
        }
    }

    die('Koneksi database tidak ditemukan. Periksa ../koneksi.php');
}

function redirect_to($page)
{
    header('Location: ' . $page);
    exit;
}

function set_flash($message, $type = 'danger')
{
    $_SESSION['flash_message'] = $message;
    $_SESSION['flash_type'] = $type;
}

function show_flash()
{
    if (!empty($_SESSION['flash_message'])) {
        $message = htmlspecialchars($_SESSION['flash_message'], ENT_QUOTES, 'UTF-8');
        $type = htmlspecialchars($_SESSION['flash_type'], ENT_QUOTES, 'UTF-8');

        echo '<div class="alert alert-' . $type . '">' . $message . '</div>';

        unset($_SESSION['flash_message'], $_SESSION['flash_type']);
    }
}

function csrf_token()
{
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }

    return $_SESSION['csrf_token'];
}

function verify_csrf()
{
    if (
        empty($_POST['csrf_token']) ||
        empty($_SESSION['csrf_token']) ||
        !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])
    ) {
        die('Permintaan tidak valid. Silakan coba lagi.');
    }
}

function require_admin_login()
{
    if (empty($_SESSION['admin_id'])) {
        set_flash('Silakan login terlebih dahulu.');
        redirect_to('login.php');
    }
}