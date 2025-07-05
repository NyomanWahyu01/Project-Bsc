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

// Ambil username pengurus yang akan di-reset untuk pesan notifikasi
$userQuery = mysqli_query($conn, "SELECT username_pengurus FROM data_pengurus WHERE id_pengurus = '$id_to_reset'");
if (mysqli_num_rows($userQuery) === 0) {
    // Pengurus target tidak ditemukan
    header("Location: pengaturan.php");
    exit();
}
$pengurus_data = mysqli_fetch_assoc($userQuery);
$pengurus_username = $pengurus_data['username_pengurus'];

// Buat password baru yang acak dan aman
// Contoh: Bsc_aB12cD
$new_password_plain = "Bsc_" . substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 6);

// Hash password baru sebelum disimpan
$new_password_hash = password_hash($new_password_plain, PASSWORD_DEFAULT);

// Update password di database
$updateQuery = mysqli_query($conn, "UPDATE data_pengurus SET password_pengurus = '$new_password_hash' WHERE id_pengurus = '$id_to_reset'");

if ($updateQuery) {
    // Simpan pesan sukses di session untuk ditampilkan setelah redirect
    $_SESSION['pengurus_reset_success'] = "Password untuk pengurus <strong>" . htmlspecialchars($pengurus_username) . "</strong> berhasil di-reset. <br>Password barunya adalah: <strong style='font-size: 1.2em;'>" . htmlspecialchars($new_password_plain) . "</strong> <br><small>Segera berikan password ini kepada yang bersangkutan.</small>";
} else {
    // Simpan pesan error
    $_SESSION['pengurus_reset_error'] = "Gagal me-reset password: " . mysqli_error($conn);
}

// Redirect kembali ke halaman pengaturan
header("Location: pengaturan.php");
exit();

?> 