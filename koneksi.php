<?php
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'bsc';

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die('Koneksi gagal: ' . mysqli_connect_error());
}

// Tambahkan debugging
// echo "Database terhubung!";

function clean_input($data)
{
    global $conn;
    if ($data !== null) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        $data = mysqli_real_escape_string($conn, $data);
    }
    return $data;
}

// Fungsi untuk mendapatkan total anggota - menggunakan kolom status
function getTotalAnggota() {
    global $conn;
    $query = mysqli_query($conn, "SELECT COUNT(*) as total FROM anggota_bsc WHERE status = 'ANGGOTA'");
    return mysqli_fetch_assoc($query)['total'];
}

// Fungsi untuk mendapatkan total alumni - menggunakan kolom status
function getTotalAlumni() {
    global $conn;
    $query = mysqli_query($conn, "SELECT COUNT(*) as total FROM anggota_bsc WHERE status = 'SENIOR'");
    return mysqli_fetch_assoc($query)['total'];
}
?>
