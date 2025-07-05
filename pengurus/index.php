<?php
session_start();
require_once '../koneksi.php';

// Cek login
if (!isset($_SESSION['id_pengurus'])) {
    header("Location: login.php");
    exit();
}

// Statistik
$total_anggota = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM anggota_bsc WHERE status = 'ANGGOTA'"));
$total_senior = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM anggota_bsc WHERE status = 'SENIOR'"));
$total_pengurus = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM pengurus_bsc"));
$total_juara = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM juara_bsc"));
$total_coach = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM coach_bsc"));
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Dashboard Pengurus</title>
    <link rel="icon" href="assets/images/logo-bsc.ico" type="image/x-icon" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <style>
        .stat-card {
            border-radius: 15px;
            padding: 20px;
            background: linear-gradient(135deg, #1abc9c, #16a085);
            color: white;
            text-align: center;
            margin-bottom: 20px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.07);
        }
        .stat-card i {
            margin-bottom: 10px;
        }
        .badge-stat {
            display: inline-block;
            background: #1abc9c;
            color: #fff;
            font-weight: bold;
            font-size: 1.3em;
            border-radius: 12px;
            padding: 2px 16px;
            margin-bottom: 8px;
            margin-top: 6px;
        }
    </style>
</head>

<body>

    <?php include 'sidebar.php'; ?>

    <div class="main-content">
        <h1 class="mb-4">Selamat Datang, PENGURUS BADMINTON SMAPUL CLUB!</h1>
        <div class="row mb-4">
        <div class="card-container">
            <div class="card">
                <i class="fas fa-users"></i>
                <h3>Data Anggota</h3>
                <span class="badge-stat"><?= $total_anggota ?></span>
                <p>Kelola dan lihat seluruh anggota klub.</p>
            </div>
            <div class="card">
                <i class="fas fa-user-tie"></i>
                <h3>Data Senior</h3>
                <span class="badge-stat"><?= $total_senior ?></span>
                <p>Kelola struktur organisasi alumni.</p>
            </div>
            <div class="card">
                <i class="fas fa-user-cog"></i>
                <h3>Data Pengurus</h3>
                <span class="badge-stat"><?= $total_pengurus ?></span>
                <p>Kelola struktur organisasi pengurus.</p>
            </div>
            <div class="card">
                <i class="fas fa-chalkboard-teacher"></i>
                <h3>Data Coach</h3>
                <span class="badge-stat"><?= $total_coach ?></span>
                <p>Informasi Tentang pelatih aktif di klub.</p>
            </div>
            <div class="card">
                <i class="fas fa-medal"></i>
                <h3>Data Juara</h3>
                <span class="badge-stat"><?= $total_juara ?></span>
                <p>Lihat prestasi yang telah diraih klub.</p>
            </div>
        </div>
    </div>

    <!-- Tambahkan styling yang khusus untuk konten -->
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f6fa;
        }

        .main-content {
            margin-left: 220px;
            padding: 20px;
            transition: margin-left 0.3s;
        }

        @media (max-width: 768px) {
            .main-content {
                margin-left: 0;
            }
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
            color: #2c3e50;
        }

        .card-container {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            justify-content: center;
        }

        .card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            padding: 30px;
            width: 280px;
            transition: transform 0.2s;
            text-align: center;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card i {
            font-size: 30px;
            color: #1abc9c;
            margin-bottom: 10px;
        }

        .card h3 {
            font-size: 18px;
            margin: 10px 0 5px;
            color: #2c3e50;
        }

        .card p {
            font-size: 14px;
            color: #7f8c8d;
        }
    </style>

</body>

</html>