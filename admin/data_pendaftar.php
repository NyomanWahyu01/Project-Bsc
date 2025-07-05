<?php
session_start();
require_once '../koneksi.php';

// Cek login
if (!isset($_SESSION['id_admin'])) {
    header("Location: login.php");
    exit();
}

// Proses update posisi jika ada
        if (isset($_POST['update_posisi'])) {
    $id_siswa = clean_input($_POST['id_siswa']);
    $status = isset($_POST['status']) ? clean_input($_POST['status']) : 'Pending';

    $allowed_status = ['Pending', 'Diterima', 'Ditolak'];
    if (!in_array($status, $allowed_status)) {
        $status = 'Pending';
    }

    $query = mysqli_query($conn, "UPDATE data_siswa SET status = '$status' WHERE id_siswa = '$id_siswa'");
    if ($query) {
        echo "<script>alert('Status berhasil diupdate!');</script>";
    } else {
        echo "<script>alert('Gagal mengupdate status: " . mysqli_error($conn) . "');</script>";
    }
}

// Ambil semua data pendaftar
$query = mysqli_query($conn, "SELECT * FROM data_siswa ORDER BY tanggal_daftar DESC");
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pendaftar - Admin BSC</title>
    <link rel="icon" href="assets/images/logo-bsc.ico" type="image/x-icon" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .content {
            padding: 20px;
        }
        /* Modal dialog always centered and max width */
        .modal-dialog {
            margin: 1.75rem auto;
            max-width: 700px;
        }
        @media (max-width: 768px) {
            .modal-dialog {
                max-width: 95vw;
                margin: 1rem auto;
            }
            .modal-content {
                padding: 0.5rem;
            }
        }
        .modal-content {
            border-radius: 18px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.15);
            padding: 1.5rem 1.5rem 1rem 1.5rem;
        }
        .modal-header {
            border-top-left-radius: 18px;
            border-top-right-radius: 18px;
            padding: 1rem 1.5rem;
        }
        .modal-title {
            font-weight: 700;
            font-size: 1.3rem;
        }
        .modal-body {
            padding: 1rem 0 0 0;
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
                <h2 class="mb-4">Data Pendaftar</h2>

                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="pendaftarTable" class="table table-striped table-hover table-bordered text-center">
                                <thead class="table-primary text-center">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>WhatsApp</th>
                                        <th>Kelas</th>
                                        <th>Tanggal Daftar</th>
                                        <th>Posisi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>

                                <tbody class="align-middle text-center">
                                    <?php
                                    $no = 1;
                                    while ($row = mysqli_fetch_assoc($query)) {
                                    ?>
                                        <tr>
                                            <td><?php echo $no++; ?></td>
                                            <td><?php echo htmlspecialchars($row['nama']); ?></td>
                                            <td><?php echo htmlspecialchars($row['no_whatsapp']); ?></td>
                                            <td><?php echo htmlspecialchars($row['kelas']); ?></td>
                                            <td><?php echo date('d/m/Y', strtotime($row['tanggal_daftar'])); ?></td>
                                            <td>
                                                <span class="badge bg-<?php
                                                                        echo $row['status'] == 'Diterima' ? 'success' : ($row['status'] == 'Ditolak' ? 'danger' : 'warning');
                                                                        ?>">
                                                    <?= htmlspecialchars($row['status'] ?? 'Pending'); ?>
                                                </span>
                                            </td>
                                            <td class="d-flex gap-2 justify-content-center">
                                                <button type="button" class="btn btn-sm btn-info"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#detailModal<?php echo $row['id_siswa']; ?>">
                                                    <i class="fas fa-eye"></i> Detail
                                                </button>
                                                <a href="hapus_pendaftar.php?id_siswa=<?php echo $row['id_siswa']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus data ini?')">
                                                    <i class="fas fa-trash"></i> Hapus
                                                </a>
                                                <a href="https://api.whatsapp.com/send?phone=62<?php
                                                                                                $phone = preg_replace('/[^0-9]/', '', $row['no_whatsapp']);
                                                                                                echo ltrim($phone, '0');
                                                                                                ?>&text=<?php
                                                                                                        $nama = htmlspecialchars($row['nama']);
                                                                                                        $pesan = "Assalamualaikum Wr. Wb.\n\n"
                                                                                                            . "Kepada Sdr/i {$nama},\n\n"
                                                                                                            . "Selamat! Anda dinyatakan LULUS sebagai Anggota Badminton Smapul Club (BSC).\n\n"
                                                                                                            . "Silakan bergabung dengan grup WhatsApp BSC melalui link berikut:\n"
                                                                                                            . "https://chat.whatsapp.com/BIxQGZaigvlATQDwUvRHVF\n\n"
                                                                                                            . "Jika sudah bergabung, silakan klik tombol konfirmasi di bawah ini.\n"
                                                                                                            . "Terima kasih.\n"
                                                                                                            . "Admin BSC";
                                                                                                        echo urlencode($pesan);
                                                                                                        ?>"
                                                    class="btn btn-success btn-sm"
                                                    target="_blank"
                                                    onclick="return confirm('Kirim konfirmasi kelulusan ke pendaftar ini?')">
                                                    <i class="fab fa-whatsapp"></i> Konfirmasi
                                                </a>
                                            </td>
                                        </tr>

                                        <!-- Modal Detail -->
                                        <div class="modal fade" id="detailModal<?php echo $row['id_siswa']; ?>" tabindex="-1" aria-labelledby="detailModalLabel<?php echo $row['id_siswa']; ?>" aria-hidden="true">
                                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-primary text-white">
                                                        <h5 class="modal-title" id="detailModalLabel<?php echo $row['id_siswa']; ?>">Detail Pendaftar</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <p><strong>Nama:</strong> <?php echo htmlspecialchars($row['nama']); ?></p>
                                                                <p><strong>No. WhatsApp:</strong> <?php echo htmlspecialchars($row['no_whatsapp']); ?></p>
                                                                <p><strong>Tempat Lahir:</strong> <?php echo htmlspecialchars($row['tempat_lahir']); ?></p>
                                                                <p><strong>Tanggal Lahir:</strong> <?php echo date('d/m/Y', strtotime($row['tanggal_lahir'])); ?></p>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <p><strong>Tanggal Masuk:</strong> <?php echo date('d/m/Y', strtotime($row['tanggal_masuk'])); ?></p>
                                                                <p><strong>Jenis Kelamin:</strong> <?php echo htmlspecialchars($row['jenis_kelamin']); ?></p>
                                                                <p><strong>Kelas:</strong> <?php echo htmlspecialchars($row['kelas']); ?></p>
                                                                <p><strong>Alasan:</strong> <?php echo htmlspecialchars($row['alasan_masuk']); ?></p>
                                                            </div>
                                                        </div>

                                                        <form method="POST" action="">
                                                            <input type="hidden" name="id_siswa" value="<?php echo $row['id_siswa']; ?>">
                                                            <div class="mb-3">
                                                                <label class="form-label">Update Posisi</label>
                                                                <select name="status" class="form-select">
                                                                    <option value="Pilih Status" <?php echo (isset($_POST['status']) && $_POST['status'] == 'Pilih Status' ? 'selected' : ($row['status'] == 'Pilih Status' ? 'selected' : '')); ?>>Pilih Status</option>
                                                                    <option value="Pending" <?php echo (isset($_POST['status']) && $_POST['status'] == 'Pending' ? 'selected' : ($row['status'] == 'Pending' ? 'selected' : '')); ?>>Pending</option>
                                                                    <option value="Diterima" <?php echo (isset($_POST['status']) && $_POST['status'] == 'Diterima' ? 'selected' : ($row['status'] == 'Diterima' ? 'selected' : '')); ?>>Diterima</option>
                                                                    <option value="Ditolak" <?php echo (isset($_POST['status']) && $_POST['status'] == 'Ditolak' ? 'selected' : ($row['status'] == 'Ditolak' ? 'selected' : '')); ?>>Ditolak</option>
                                                                </select>
                                                            </div>
                                                            <button type="submit" name="update_posisi" class="btn btn-primary w-100">Update Posisi</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://kit.fontawesome.com/your-fontawesome-kit.js"></script>
    <script>
        $(document).ready(function() {
            $('#pendaftarTable').DataTable();
        });
    </script>
</body>

</html>