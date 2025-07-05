<?php
session_start();
require_once '../koneksi.php';

// Cek login
if (!isset($_SESSION['id_admin'])) {
    header("Location: login.php");
    exit();
}

// Ambil data statistik
$total_pendaftar = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM data_siswa"))['total'];
$total_diterima = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM data_siswa WHERE status='Diterima'"))['total'];
$total_pending = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM data_siswa WHERE status='Pending'"))['total'];
$total_ditolak = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM data_siswa WHERE status='Ditolak'"))['total'];
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Admin BSC</title>
    <link rel="icon" href="assets/images/logo-bsc.ico" type="image/x-icon" />


    <!-- Bootstrap & Font Awesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="../assets/css/animated.css">
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
            overflow-x: hidden;
            min-height: 100vh;
            margin: 0;
            padding: 0;
        }

        .content {
            padding: 20px;
            margin-left: 250px;
            transition: all 0.3s;
            width: calc(100% - 250px);
            min-height: 100vh;
            overflow-x: hidden;
        }

        .container-fluid {
            padding: 0;
            margin: 0;
            width: 100%;
            overflow-x: hidden;
        }

        .row {
            margin: 0;
            width: 100%;
        }

        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card-dashboard {
            padding: 1.5rem;
            border-radius: 15px;
            position: relative;
            overflow: hidden;
        }

        .card-dashboard::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, rgba(255, 255, 255, 0.15), rgba(255, 255, 255, 0));
            z-index: 1;
        }

        .card-dashboard .card-body {
            position: relative;
            z-index: 2;
        }

        .table {
            border-radius: 10px;
            overflow: hidden;
        }

        .table thead th {
            background-color: #f8f9fa;
            border-bottom: none;
            padding: 15px;
            font-weight: 600;
        }

        .table tbody td {
            padding: 15px;
            vertical-align: middle;
        }

        .badge {
            padding: 8px 12px;
            border-radius: 8px;
            font-weight: 500;
        }

        .animate-fade-in {
            animation: fadeIn 0.5s ease-in;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Include Sidebar -->
            <?php include 'sidebar.php'; ?>

            <!-- Main Content -->
            <div class="content">
                <div class="animate-fade-in px-4">
                    <h2 class="text-3xl font-bold mb-6 text-gray-800">Dashboard</h2>

                    <!-- Statistik Cards -->
                    <div class="row mb-6"> 
                        <div class="col-md-5 mb-4 d-flex justify-content-center align-items-center gap-4">
                            <div class="row g-4">
                                <div class="col-12">
                                    <div class="card bg-gradient-to-r from-blue-500 to-blue-600 text-white card-dashboard animate__animated animate__fadeInLeft">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <h5 class="card-title m-0">Total Pendaftar</h5>
                                                <i class="fas fa-users fa-2x opacity-50"></i>
                                            </div>
                                            <h2 class="display-4 mb-2 font-bold"><?php echo $total_pendaftar; ?></h2>
                                            <p class="mb-0 text-white-50">Siswa terdaftar</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="card bg-gradient-to-r from-green-500 to-green-600 text-white card-dashboard animate__animated animate__fadeInUp">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <h5 class="card-title m-0">Diterima</h5>
                                                <i class="fas fa-check-circle fa-2x opacity-50"></i>
                                            </div>
                                            <h2 class="display-4 mb-2 font-bold"><?php echo $total_diterima; ?></h2>
                                            <p class="mb-0 text-white-50">Siswa diterima</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5 mb-4 d-flex justify-content-center align-items-center gap-4">
                            <div class="row g-4">
                                <div class="col-12">
                                    <div class="card bg-gradient-to-r from-yellow-500 to-yellow-600 text-white card-dashboard animate__animated animate__fadeInRight">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <h5 class="card-title m-0">Pending</h5>
                                                <i class="fas fa-clock fa-2x opacity-50"></i>
                                            </div>
                                            <h2 class="display-4 mb-2 font-bold"><?php echo $total_pending; ?></h2>
                                            <p class="mb-0 text-white-50">Menunggu verifikasi</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="card bg-gradient-to-r from-red-500 to-red-600 text-white card-dashboard animate__animated animate__fadeInRight">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <h5 class="card-title m-0">Ditolak</h5>
                                                <i class="fas fa-times-circle fa-2x opacity-50"></i>
                                            </div>
                                            <h2 class="display-4 mb-2 font-bold"><?php echo $total_ditolak; ?></h2>
                                            <p class="mb-0 text-white-50">Siswa ditolak</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tabel Pendaftar Terbaru -->
                    <div class="card animate__animated animate__fadeInUp">
                        <div class="card-header bg-white py-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-title mb-0 text-xl font-semibold">Pendaftar Terbaru</h5>
                                <button class="btn btn-primary btn-sm rounded-lg">
                                    <i class="fas fa-sync-alt me-1"></i> Refresh
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th>Nama</th>
                                            <th>WhatsApp</th>
                                            <th>Kelas</th>
                                            <th>Tanggal Daftar</th>
                                            <th class="text-center">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $query = mysqli_query($conn, "SELECT * FROM data_siswa ORDER BY tanggal_daftar DESC LIMIT 5");
                                        $no = 1;
                                        while ($row = mysqli_fetch_assoc($query)) {
                                            $status_class = $row['status'] == 'Diterima' ? 'success' : ($row['status'] == 'Ditolak' ? 'danger' : 'warning');
                                            $status_icon = $row['status'] == 'Diterima' ? 'check-circle' : ($row['status'] == 'Ditolak' ? 'times-circle' : 'clock');
                                        ?>
                                            <tr class="align-middle">
                                                <td class="text-center"><?php echo $no++; ?></td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar-sm bg-light rounded-circle p-2 me-3">
                                                            <i class="fas fa-user text-primary"></i>
                                                        </div>
                                                        <?php echo htmlspecialchars($row['nama']); ?>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="https://wa.me/<?php echo htmlspecialchars($row['no_whatsapp']); ?>"
                                                        class="text-decoration-none">
                                                        <i class="fab fa-whatsapp text-success me-1"></i>
                                                        <?php echo htmlspecialchars($row['no_whatsapp']); ?>
                                                    </a>
                                                </td>
                                                <td><?php echo htmlspecialchars($row['kelas']); ?></td>
                                                <td><?php echo date('d/m/Y', strtotime($row['tanggal_daftar'])); ?></td>
                                                <td class="text-center">
                                                    <span class="badge bg-<?php echo $status_class; ?>-soft text-<?php echo $status_class; ?>">
                                                        <i class="fas fa-<?php echo $status_icon; ?> me-1"></i>
                                                        <?= htmlspecialchars($data['status'] ?? ''); ?>
                                                    </span>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/animation.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Add smooth scrolling
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    document.querySelector(this.getAttribute('href')).scrollIntoView({
                        behavior: 'smooth'
                    });
                });
            });

            // Add hover effect to cards
            const cards = document.querySelectorAll('.card-dashboard');
            cards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-5px)';
                });
                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                });
            });

            // Tutup sidebar otomatis saat klik menu di mobile
            document.querySelectorAll('.menu-item a').forEach(function(link) {
                link.addEventListener('click', function() {
                    if(window.innerWidth <= 768) {
                        document.getElementById('sidebar').classList.remove('show');
                        document.getElementById('sidebarOverlay').classList.remove('show');
                        document.body.classList.remove('sidebar-open');
                    }
                });
            });
        });
    </script>
</body>

</html>