<?php
session_start();
require_once '../koneksi.php';

// Cek login
if (!isset($_SESSION['id_admin'])) {
    header("Location: login.php");
    exit();
}

// Cek apakah ada ID pendaftar yang dikirim
if (!isset($_GET['id_siswa'])) {
    echo "
        <script>
            alert('ID Pendaftar tidak ditemukan!');
            window.location.href = 'data_pendaftar.php';
        </script>
    ";
    exit();
}

$id_siswa = clean_input($_GET['id_siswa']);

// Ambil data pendaftar untuk konfirmasi
$query = mysqli_query($conn, "SELECT nama FROM data_siswa WHERE id_siswa = '$id_siswa'");
$pendaftar = mysqli_fetch_assoc($query);

if (!$pendaftar) {
    echo "
        <script>
            alert('Data pendaftar tidak ditemukan!');
            window.location.href = 'data_pendaftar.php';
        </script>
    ";
    exit();
}

// Proses hapus pendaftar
$query = mysqli_query($conn, "DELETE FROM data_siswa WHERE id_siswa = '$id_siswa'");

if ($query) {
    echo "
        <script>
            alert('Data pendaftar berhasil dihapus!');
            window.location.href = 'data_pendaftar.php';
        </script>
    ";
} else {
    echo "
        <script>
            alert('Gagal menghapus data pendaftar: " . mysqli_error($conn) . "');
            window.location.href = 'data_pendaftar.php';
        </script>
    ";
}
?> 