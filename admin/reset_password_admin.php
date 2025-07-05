<?php
session_start();
require_once '../koneksi.php';

// Cek login admin
if (!isset($_SESSION['id_admin'])) {
    header("Location: login.php");
    exit();
}

// Cek apakah ID target ada di URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: pengaturan.php");
    exit();
}

$id_to_reset = intval($_GET['id']);
$current_admin_id = $_SESSION['id_admin'];

// Pastikan admin tidak me-reset passwordnya sendiri melalui URL ini
if ($id_to_reset === $current_admin_id) {
    $_SESSION['reset_error_message'] = "Anda tidak dapat me-reset password Anda sendiri dari sini.";
    header("Location: pengaturan.php");
    exit();
}

// Ambil username admin yang akan di-reset untuk pesan notifikasi
$userQuery = mysqli_query($conn, "SELECT username_admin FROM data_admin WHERE id_admin = '$id_to_reset'");
if (mysqli_num_rows($userQuery) === 0) {
    // Admin target tidak ditemukan
    header("Location: pengaturan.php");
    exit();
}
$admin_data = mysqli_fetch_assoc($userQuery);
$admin_username = $admin_data['username_admin'];

// Buat password baru yang acak dan aman
// Contoh: Bsc_aB12cD
$new_password_plain = "Bsc_" . substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 6);

// Hash password baru sebelum disimpan
$new_password_hash = password_hash($new_password_plain, PASSWORD_DEFAULT);

// Update password di database
$updateQuery = mysqli_query($conn, "UPDATE data_admin SET password_admin = '$new_password_hash' WHERE id_admin = '$id_to_reset'");

if ($updateQuery) {
    // Simpan pesan sukses di session untuk ditampilkan setelah redirect
    $_SESSION['reset_success_message'] = "Password untuk admin <strong>" . htmlspecialchars($admin_username) . "</strong> berhasil di-reset. <br>Password barunya adalah: <strong style='font-size: 1.2em;'>" . htmlspecialchars($new_password_plain) . "</strong> <br><small>Segera berikan password ini dan minta yang bersangkutan untuk segera mengubahnya.</small>";
} else {
    // Simpan pesan error
    $_SESSION['reset_error_message'] = "Gagal me-reset password: " . mysqli_error($conn);
}

// Redirect kembali ke halaman pengaturan
header("Location: pengaturan.php");
exit();

?> 