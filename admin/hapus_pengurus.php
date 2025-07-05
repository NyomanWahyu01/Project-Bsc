<?php
session_start();
require_once '../koneksi.php';

// Cek login admin
if (!isset($_SESSION['id_admin'])) {
    header("Location: login.php");
    exit();
}

// Cek apakah ada ID pengurus yang dikirim dari URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "
        <script>
            alert('ID Pengurus tidak ditemukan!');
            window.location.href = 'pengaturan.php';
        </script>
    ";
    exit();
}

$id_pengurus = intval($_GET['id']);

// Proses hapus data pengurus dari database
$query = mysqli_query($conn, "DELETE FROM data_pengurus WHERE id_pengurus = '$id_pengurus'");

if ($query) {
    echo "
        <script>
            alert('Pengurus berhasil dihapus!');
            window.location.href = 'pengaturan.php';
        </script>
    ";
} else {
    echo "
        <script>
            alert('Gagal menghapus pengurus: " . mysqli_error($conn) . "');
            window.location.href = 'pengaturan.php';
        </script>
    ";
}
?> 