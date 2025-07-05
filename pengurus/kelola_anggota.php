<?php
session_start();
require_once '../koneksi.php';

// Cek login
if (!isset($_SESSION['id_pengurus'])) {
    header("Location: login.php");
    exit();
}

// Tambah anggota
if (isset($_POST['tambah_anggota'])) {
    $nama = htmlspecialchars(trim($_POST['nama']));
    $kelas = htmlspecialchars(trim($_POST['kelas']));
    $deskripsi = htmlspecialchars(trim($_POST['deskripsi']));
    $status = htmlspecialchars(trim($_POST['status']));

    if (strtoupper($status) === 'ANGGOTA') {
        $query = mysqli_query($conn, "INSERT INTO anggota_bsc (nama, kelas, deskripsi, status) VALUES ('$nama', '$kelas', '$deskripsi', '$status')");
        $_SESSION['msg'] = 'Anggota telah berhasil ditambahkan!';
        header("Location: kelola_anggota.php");
        exit();
    } elseif (strtoupper($status) === 'SENIOR') {
        $query = mysqli_query($conn, "INSERT INTO anggota_bsc (nama, kelas, deskripsi, status) VALUES ('$nama', '$kelas', '$deskripsi', '$status')");
        $_SESSION['msg'] = 'Senior telah berhasil ditambahkan!';
        header("Location: kelola_anggota.php");
        exit();
    } else {
        $_SESSION['msg'] = 'Status hanya boleh ANGGOTA atau SENIOR!';
        header("Location: kelola_anggota.php");
        exit();
    }
}

// Edit anggota
if (isset($_POST['edit_anggota'])) {
    $id = intval($_POST['id_anggota']);
    $nama = htmlspecialchars(trim($_POST['nama']));
    $kelas = htmlspecialchars(trim($_POST['kelas']));
    $deskripsi = htmlspecialchars(trim($_POST['deskripsi']));
    $status = htmlspecialchars(trim($_POST['status']));

    if (strtoupper($status) === 'ANGGOTA') {
        $query = mysqli_query($conn, "UPDATE anggota_bsc SET nama = '$nama', kelas = '$kelas', deskripsi = '$deskripsi', status = '$status' WHERE id_anggota = $id");
        $_SESSION['msg'] = 'Anggota telah berhasil diedit!';
        header("Location: kelola_anggota.php");
        exit();
    } elseif (strtoupper($status) === 'SENIOR') {
        $query = mysqli_query($conn, "UPDATE anggota_bsc SET nama = '$nama', kelas = '$kelas', deskripsi = '$deskripsi', status = '$status' WHERE id_anggota = $id");
        $_SESSION['msg'] = 'Senior telah berhasil diedit!';
        header("Location: kelola_anggota.php");
        exit();
    } else {
        $_SESSION['msg'] = 'Status hanya boleh ANGGOTA atau SENIOR!';
        header("Location: kelola_anggota.php");
        exit();
    }
}

// Hapus anggota
if (isset($_GET['hapus_anggota'])) {
    $id = intval($_GET['hapus_anggota']);
    $query = mysqli_query($conn, "DELETE FROM anggota_bsc WHERE id_anggota = $id");
    $_SESSION['msg'] = $query ? 'Anggota berhasil dihapus!' : 'Gagal menghapus anggota.';
    header("Location: kelola_anggota.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Kelola Anggota BSC</title>
    <link rel="icon" href="/assets/images/logo-bsc.ico" type="image/x-icon" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .content {
            padding: 40px;
        }

        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .table th,
        .table td {
            vertical-align: middle;
            text-align: center;
        }

        .table th {
            background: linear-gradient(135deg, #0d6efd, #4e91fd);
            color: white;
        }

        .modal .form-control,
        .modal .form-select {
            text-align: center;
        }

        .stat-card {
            border-radius: 15px;
            padding: 20px;
            background: linear-gradient(135deg, #6610f2, #6f42c1);
            color: white;
            text-align: center;
            transition: transform 0.2s ease;
        }

        .stat-card:hover {
            transform: scale(1.05);
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <?php include 'sidebar.php'; ?>
            <div class="col-md-9 offset-md-3 content">
                <?php if (isset($_SESSION['msg'])): ?>
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        <?= $_SESSION['msg'];
                        unset($_SESSION['msg']); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <?php
                $anggota = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM anggota_bsc WHERE status = 'ANGGOTA'"));
                $senior = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM anggota_bsc WHERE status = 'SENIOR'"));
                ?>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="stat-card">
                            <h4 class="card-title">ANGGOTA</h4>
                            <h2 class="fw-bold"><?= $anggota ?></h2>
                            <i class="fas fa-users fa-2x"></i>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="stat-card bg-gradient-danger">
                            <h4 class="card-title">SENIOR</h4>
                            <h2 class="fw-bold"><?= $senior ?></h2>
                            <i class="fas fa-user-tie fa-2x"></i>
                        </div>
                    </div>
                </div>

                <div class="card mb-4">
                    <H5 class="card-header bg-primary text-white text-center">KELOLA ANGGOTA</H5>
                    <div class="card-body">
                        <form method="POST" class="row g-3">
                            <div class="col-md-3">
                                <input type="text" name="nama" class="form-control" placeholder="Nama Anggota" required>
                            </div>
                            <div class="col-md-2">
                                <select name="status" class="form-select" required>
                                    <option value="">Status</option>
                                    <option value="ANGGOTA">ANGGOTA</option>
                                    <option value="SENIOR">SENIOR</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <input type="text" name="kelas" class="form-control" placeholder="Kelas (misal: X IPA 5)" required>
                            </div>
                            <div class="col-md-3">
                                <input type="text" name="deskripsi" class="form-control" placeholder="Deskripsi" required>
                            </div>
                            <div class="col-md-1">
                                <button type="submit" name="tambah_anggota" class="btn btn-success w-100">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <span>Daftar Anggota</span>
                        <input type="text" id="searchAnggota" class="form-control form-control-sm w-auto" placeholder="Cari anggota...">
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Status</th>
                                        <th>Kelas</th>
                                        <th>Deskripsi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $result = mysqli_query($conn, "SELECT * FROM anggota_bsc");
                                    $no = 1;
                                    while ($row = mysqli_fetch_assoc($result)):
                                    ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= htmlspecialchars($row['nama']) ?></td>
                                            <td><?= htmlspecialchars($row['status'] ?? '') ?></td>
                                            <td><?= htmlspecialchars($row['kelas'] ?? '') ?></td>
                                            <td><?= htmlspecialchars($row['deskripsi'] ?? '') ?></td>
                                            <td>
                                                <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editModal<?= $row['id_anggota'] ?>">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <a href="?hapus_anggota=<?= $row['id_anggota']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">
                                                    <i class="fas fa-trash-alt"></i>
                                                </a>
                                            </td>
                                        </tr>

                                        <!-- Modal Edit -->
                                        <div class="modal fade" id="editModal<?= $row['id_anggota'] ?>" tabindex="-1">
                                            <div class="modal-dialog">
                                                <form method="POST">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-primary text-white">
                                                            <h5 class="modal-title">Edit Anggota</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <input type="hidden" name="id_anggota" value="<?= $row['id_anggota'] ?>">
                                                            <div class="mb-3">
                                                                <label>Nama</label>
                                                                <input type="text" name="nama" class="form-control" value="<?= htmlspecialchars($row['nama']) ?>" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label>Status</label>
                                                                <select name="status" class="form-select" required>
                                                                    <option value="ANGGOTA" <?= (strtoupper($row['status']) == 'ANGGOTA' ? 'selected' : '') ?>>ANGGOTA</option>
                                                                    <option value="SENIOR" <?= (strtoupper($row['status']) == 'SENIOR' ? 'selected' : '') ?>>SENIOR</option>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label>Kelas</label>
                                                                <input type="text" name="kelas" class="form-control" value="<?= htmlspecialchars($row['kelas'] ?? '') ?>" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label>Deskripsi</label>
                                                                <input type="text" name="deskripsi" class="form-control" value="<?= htmlspecialchars($row['deskripsi'] ?? '') ?>" required>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" name="edit_anggota" class="btn btn-success">Simpan</button>
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    // Fitur search anggota (client-side)
    document.getElementById('searchAnggota').addEventListener('input', function() {
        const keyword = this.value.toLowerCase();
        const rows = document.querySelectorAll('table.table tbody tr');
        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(keyword) ? '' : 'none';
        });
    });
    </script>
</body>

</html>