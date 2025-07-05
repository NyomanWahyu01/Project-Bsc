<?php
session_start();
require_once '../koneksi.php';

// Cek login
if (!isset($_SESSION['id_admin'])) {
    header("Location: login.php");
    exit();
}

// Cek apakah ada ID admin yang dikirim
if (!isset($_GET['id_admin'])) {
    echo "
        <script>
            alert('ID Admin tidak ditemukan!');
            window.location.href = 'pengaturan.php';
        </script>
    ";
    exit();
}

$id_admin = $_GET['id_admin'];

// Cek apakah admin mencoba menghapus dirinya sendiri
if ($id_admin == $_SESSION['id_admin']) {
    echo "
        <script>
            alert('Anda tidak dapat menghapus akun admin yang sedang digunakan!');
            window.location.href = 'pengaturan.php';
        </script>
    ";
    exit();
}

// Proses hapus admin
$query = mysqli_query($conn, "DELETE FROM data_admin WHERE id_admin = '$id_admin'");

if ($query) {
    echo "
        <script>
            alert('Admin berhasil dihapus!');
            window.location.href = 'pengaturan.php';
        </script>
    ";
} else {
    echo "
        <script>
            alert('Gagal menghapus admin: " . mysqli_error($conn) . "');
            window.location.href = 'pengaturan.php';
        </script>
    ";
}
?> 