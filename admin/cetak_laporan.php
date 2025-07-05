<?php
session_start();
require_once '../koneksi.php';

// Cek login
if (!isset($_SESSION['id_admin'])) {
    header("Location: login.php");
    exit();
}

// --- LOGIKA FILTER TERPUSAT ---

// 1. Ambil dan bersihkan nilai filter dari GET request
$tanggal_mulai = isset($_GET['tanggal_mulai']) ? mysqli_real_escape_string($conn, $_GET['tanggal_mulai']) : '';
$tanggal_akhir = isset($_GET['tanggal_akhir']) ? mysqli_real_escape_string($conn, $_GET['tanggal_akhir']) : '';
$status        = isset($_GET['status']) ? mysqli_real_escape_string($conn, $_GET['status']) : '';

// 2. Bangun klausa WHERE secara dinamis
$whereClauses = [];
if ($tanggal_mulai !== '') {
    $whereClauses[] = "DATE(tanggal_daftar) >= '$tanggal_mulai'";
}
if ($tanggal_akhir !== '') {
    $whereClauses[] = "DATE(tanggal_daftar) <= '$tanggal_akhir'";
}
if ($status !== '') {
    $whereClauses[] = "status = '$status'";
}

$whereSql = "1=1";
if (!empty($whereClauses)) {
    $whereSql = implode(' AND ', $whereClauses);
}

// 3. Cek apakah ada filter yang aktif
$isFilterActive = !empty($tanggal_mulai) || !empty($tanggal_akhir) || !empty($status);


// --- FUNGSI EKSPOR EXCEL ---

if (isset($_POST['export_excel'])) {
    if (!$isFilterActive) {
        // Seharusnya ini tidak terjadi jika validasi JS berjalan, tapi sebagai pengaman server-side.
        echo "<script>alert('Silakan terapkan filter terlebih dahulu sebelum mengekspor data!'); window.history.back();</script>";
        exit();
    }
    
    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=Data_Pendaftar_BSC_" . date('Y-m-d') . ".xls");
    header("Pragma: no-cache");
    header("Expires: 0");

    $query_export = mysqli_query($conn, "SELECT * FROM data_siswa WHERE $whereSql ORDER BY tanggal_daftar DESC");

    echo '<table border="1">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>No WhatsApp</th>
                    <th>Tempat Lahir</th>
                    <th>Tanggal Lahir</th>
                    <th>Tanggal Masuk</th>
                    <th>Jenis Kelamin</th>
                    <th>Kelas</th>
                    <th>Alasan Masuk</th>
                    <th>Status</th>
                    <th>Tanggal Daftar</th>
                </tr>
            </thead>
            <tbody>';
    $no = 1;
    while ($row = mysqli_fetch_assoc($query_export)) {
        echo '<tr>
                <td>' . $no++ . '</td>
                <td>' . $row['nama'] . '</td>
                <td>' . $row['no_whatsapp'] . '</td>
                <td>' . $row['tempat_lahir'] . '</td>
                <td>' . date('d/m/Y', strtotime($row['tanggal_lahir'])) . '</td>
                <td>' . date('d/m/Y', strtotime($row['tanggal_masuk'])) . '</td>
                <td>' . $row['jenis_kelamin'] . '</td>
                <td>' . $row['kelas'] . '</td>
                <td>' . $row['alasan_masuk'] . '</td>
                <td>' . $row['status'] . '</td>
                <td>' . date('d/m/Y', strtotime($row['tanggal_daftar'])) . '</td>
            </tr>';
    }
    echo '</tbody></table>';
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Laporan - Admin BSC</title>
    <link rel="icon" href="../assets/images/logo-bsc.ico" type="image/x-icon" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .content {
            padding: 20px;
        }

        .export-card {
            transition: transform 0.3s;
        }

        .export-card:hover {
            transform: translateY(-5px);
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Include Sidebar -->
            <?php include 'sidebar.php'; ?>

            <!-- Main Content -->
            <div class="col-md-9 offset-md-3 content">
                <h2 class="mb-4">Cetak Laporan</h2>

                <div class="row justify-content-center">
                    <div class="col-md-6 mb-4 text-center">
                        <div class="card export-card">
                            <div class="card-body text-center">
                                <i class="fas fa-file-excel fa-4x mb-3 text-success"></i>
                                <h5 class="card-title">Export ke Excel</h5>
                                <p class="card-text">Download data pendaftar dalam format Excel (.xls)</p>
                                <form method="POST" onsubmit="return validateExport()">
                                    <button type="submit" name="export_excel" class="btn btn-success" id="exportBtn">
                                        <i class="fas fa-download"></i> Download Excel
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Filter Tanggal -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Filter Data</h5>
                    </div>
                    <div class="card-body">
                        <form method="GET" class="row g-3" id="filterForm">
                            <div class="col-md-4">
                                <label class="form-label">Tanggal Mulai</label>
                                <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="form-control" value="<?php echo htmlspecialchars($tanggal_mulai); ?>">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Tanggal Akhir</label>
                                <input type="date" name="tanggal_akhir" id="tanggal_akhir" class="form-control" value="<?php echo htmlspecialchars($tanggal_akhir); ?>">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Status</label>
                                <select name="status" class="form-select">
                                    <option value="">Semua Status</option>
                                    <option value="Pending" <?php echo ($status == 'Pending') ? 'selected' : ''; ?>>Pending</option>
                                    <option value="Diterima" <?php echo ($status == 'Diterima') ? 'selected' : ''; ?>>Diterima</option>
                                    <option value="Ditolak" <?php echo ($status == 'Ditolak') ? 'selected' : ''; ?>>Ditolak</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-filter"></i> Filter
                                </button>
                                <a href="cetak_laporan.php" class="btn btn-secondary">
                                    <i class="fas fa-sync"></i> Reset
                                </a>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Preview Data -->
                <?php
                if ($isFilterActive) {
                    $query_preview = mysqli_query($conn, "SELECT * FROM data_siswa WHERE $whereSql ORDER BY tanggal_daftar DESC");
                ?>
                    <div class="card mt-4">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-title mb-0">Preview Data</h5>
                                <span class="badge bg-primary">Total: <?php echo mysqli_num_rows($query_preview); ?> data</span>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>No WhatsApp</th>
                                            <th>Tempat Lahir</th>
                                            <th>Tanggal Lahir</th>
                                            <th>Tanggal Masuk</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Kelas</th>
                                            <th>Alasan Masuk</th>
                                            <th>Status</th>
                                            <th>Tanggal Daftar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        while ($row = mysqli_fetch_assoc($query_preview)) {
                                        ?>
                                            <tr>
                                                <td><?php echo $no++; ?></td>
                                                <td><?php echo htmlspecialchars($row['nama'] ?? ''); ?></td>
                                                <td><?php echo htmlspecialchars($row['no_whatsapp'] ?? ''); ?></td>
                                                <td><?php echo htmlspecialchars($row['tempat_lahir'] ?? ''); ?></td>
                                                <td><?php echo !empty($row['tanggal_lahir']) ? date('d/m/Y', strtotime($row['tanggal_lahir'])) : ''; ?></td>
                                                <td><?php echo !empty($row['tanggal_masuk']) ? date('d/m/Y', strtotime($row['tanggal_masuk'])) : ''; ?></td>
                                                <td><?php echo htmlspecialchars($row['jenis_kelamin'] ?? ''); ?></td>
                                                <td><?php echo htmlspecialchars($row['kelas'] ?? ''); ?></td>
                                                <td><?php echo htmlspecialchars($row['alasan_masuk'] ?? ''); ?></td>
                                                <td>
                                                    <span class="badge bg-<?php
                                                                            echo ($row['status'] ?? '') == 'Diterima' ? 'success' : (($row['status'] ?? '') == 'Ditolak' ? 'danger' : 'warning');
                                                                            ?>">
                                                        <?php echo htmlspecialchars($row['status'] ?? ''); ?>
                                                    </span>
                                                </td>
                                                <td><?php echo !empty($row['tanggal_daftar']) ? date('d/m/Y', strtotime($row['tanggal_daftar'])) : ''; ?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Validasi untuk tombol export
    function validateExport() {
        const tanggalMulai = document.getElementById('tanggal_mulai').value;
        const tanggalAkhir = document.getElementById('tanggal_akhir').value;
        const status = document.querySelector('select[name="status"]').value;

        if (!tanggalMulai && !tanggalAkhir && !status) {
            alert('Silakan terapkan setidaknya satu filter (tanggal atau status) sebelum mengekspor data.');
            return false;
        }
        
        if (tanggalMulai && tanggalAkhir && tanggalAkhir < tanggalMulai) {
            alert('Tanggal akhir tidak boleh lebih kecil dari tanggal mulai!');
            return false;
        }
        
        return true;
    }

    // Validasi untuk form filter utama
    document.getElementById('filterForm').addEventListener('submit', function(e) {
        const tanggalMulai = document.getElementById('tanggal_mulai').value;
        const tanggalAkhir = document.getElementById('tanggal_akhir').value;

        if (tanggalMulai && tanggalAkhir && tanggalAkhir < tanggalMulai) {
            e.preventDefault();
            alert('Tanggal akhir tidak boleh lebih kecil dari tanggal mulai!');
        }
    });
</script>
</body>

</html>