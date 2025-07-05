<?php
session_start();
require_once '../koneksi.php';

// Cek login
if (!isset($_SESSION['id_pengurus'])) {
    header("Location: login.php");
    exit();
}

// Tambah Coach
if (isset($_POST['tambah_coach'])) {
    $nama = clean_input($_POST['nama']);
    $jabatan = clean_input($_POST['jabatan']); // Senior Coach atau Pembina
    $status = clean_input($_POST['status']); // Alumni BSC Angkatan 3 atau Guru Olahraga
    $motto = clean_input($_POST['motto']);
    $prestasi = clean_input($_POST['prestasi']);
    $foto = $_FILES['foto'];

    // Upload foto
    if ($foto['error'] == 0) {
        $foto_name = time() . '_' . $foto['name'];
        // Pastikan folder ada
        $upload_dir = '../assets/img/coach';
        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        $foto_path = $upload_dir . '/' . $foto_name;

        if (move_uploaded_file($foto['tmp_name'], $foto_path)) {
            $query = mysqli_query($conn, "INSERT INTO coach_bsc (nama, jabatan, status, motto, prestasi, foto) 
                                        VALUES ('$nama', '$jabatan', '$status', '$motto', '$prestasi', '$foto_name')");
            if ($query) {
                $success = "Coach berhasil ditambahkan!";
            } else {
                $error = "Gagal menambahkan coach: " . mysqli_error($conn);
            }
        } else {
            $error = "Gagal mengupload foto!";
        }
    } else {
        $error = "Pilih foto terlebih dahulu!";
    }
}

// Edit Coach
if (isset($_POST['edit_coach'])) {
    $id = clean_input($_POST['id_coach']);
    $nama = clean_input($_POST['nama']);
    $jabatan = clean_input($_POST['jabatan']);
    $status = clean_input($_POST['status']);
    $motto = clean_input($_POST['motto']);
    $prestasi = clean_input($_POST['prestasi']);

    if ($_FILES['foto']['error'] == 0) {
        // Jika ada foto baru
        $foto = $_FILES['foto'];
        $foto_name = time() . '_' . $foto['name'];
        $upload_dir = '../assets/img/coach';
        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        $foto_path = $upload_dir . '/' . $foto_name;

        // Hapus foto lama
        $old_foto = mysqli_fetch_assoc(mysqli_query($conn, "SELECT foto FROM coach_bsc WHERE id_coach = '$id'"))['foto'];
        if ($old_foto && file_exists($upload_dir . '/' . $old_foto)) {
            unlink($upload_dir . '/' . $old_foto);
        }

        if (move_uploaded_file($foto['tmp_name'], $foto_path)) {
            $query = mysqli_query($conn, "UPDATE coach_bsc SET 
                                        nama = '$nama',
                                        jabatan = '$jabatan',
                                        status = '$status',
                                        motto = '$motto',
                                        prestasi = '$prestasi',
                                        foto = '$foto_name'
                                        WHERE id_coach = '$id'");
        }
    } else {
        // Jika tidak ada foto baru
        $query = mysqli_query($conn, "UPDATE coach_bsc SET 
                                    nama = '$nama',
                                    jabatan = '$jabatan',
                                    status = '$status',
                                    motto = '$motto',
                                    prestasi = '$prestasi'
                                    WHERE id_coach = '$id'");
    }

    if ($query) {
        $success = "Data coach berhasil diupdate!";
    } else {
        $error = "Gagal mengupdate data coach: " . mysqli_error($conn);
    }
}

// Hapus Coach
if (isset($_GET['hapus'])) {
    $id = clean_input($_GET['hapus']);

    // Ambil nama foto untuk dihapus
    $query = mysqli_query($conn, "SELECT foto FROM coach_bsc WHERE id_coach = '$id'");
    $coach = mysqli_fetch_assoc($query);

    if ($coach) {
        // Hapus foto
        $foto_path = '../assets/img/coach/' . $coach['foto'];
        if (file_exists($foto_path)) {
            unlink($foto_path);
        }

        // Hapus data dari database
        $query = mysqli_query($conn, "DELETE FROM coach_bsc WHERE id_coach = '$id'");
        if ($query) {
            $success = "Coach berhasil dihapus!";
        } else {
            $error = "Gagal menghapus coach: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Coach - Pengurus BSC</title>
    <link rel="icon" href="assets/images/logo-bsc.ico" type="image/x-icon" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .content {
            padding: 20px;
        }

        .card {
            margin-bottom: 20px;
        }

        .preview-image {
            max-width: 100px;
            max-height: 100px;
            object-fit: cover;
            border-radius: 50%;
        }

        /* Modal always centered and responsive */
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
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title mb-0">Kelola Coach</h2>
                    </div>
                    <div class="card-body">
                        <?php if (isset($success)): ?>
                            <div class="alert alert-success"><?php echo $success; ?></div>
                        <?php endif; ?>
                        <?php if (isset($error)): ?>
                            <div class="alert alert-danger"><?php echo $error; ?></div>
                        <?php endif; ?>

                        <form method="POST" action="" enctype="multipart/form-data" class="mb-4">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Nama Coach</label>
                                        <input type="text" name="nama" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Jabatan</label>
                                        <select name="jabatan" class="form-select" required>
                                            <option value="">Pilih Jabatan</option>
                                            <option value="Senior Coach">Senior Coach</option>
                                            <option value="Pembina BSC">Pembina BSC</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Status</label>
                                        <input type="text" name="status" class="form-control" placeholder="Contoh: Alumni BSC Angkatan 3" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Motto</label>
                                        <textarea name="motto" class="form-control" rows="3" required></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Prestasi/Pengalaman</label>
                                        <textarea name="prestasi" class="form-control" rows="3" required></textarea>
                                        <small class="text-muted">Pisahkan dengan baris baru untuk setiap prestasi</small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Foto</label>
                                        <input type="file" name="foto" class="form-control" accept="image/*" required>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" name="tambah_coach" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Tambah Coach
                            </button>
                        </form>

                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Foto</th>
                                        <th>Nama</th>
                                        <th>Jabatan</th>
                                        <th>Status</th>
                                        <th>Motto</th>
                                        <th>Prestasi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = mysqli_query($conn, "SELECT * FROM coach_bsc ORDER BY jabatan ASC");
                                    $no = 1;
                                    while ($row = mysqli_fetch_assoc($query)) {
                                    ?>
                                        <tr>
                                            <td><?php echo $no++; ?></td>
                                            <td>
                                                <img src="../assets/img/coach/<?php echo htmlspecialchars($row['foto']); ?>"
                                                    alt="Foto <?php echo htmlspecialchars($row['nama']); ?>"
                                                    class="preview-image">
                                            </td>
                                            <td><?php echo htmlspecialchars($row['nama']); ?></td>
                                            <td><?php echo htmlspecialchars($row['jabatan']); ?></td>
                                            <td><?php echo htmlspecialchars($row['status']); ?></td>
                                            <td><?php echo $row['motto']; ?></td>
                                            <td><?php echo nl2br(htmlspecialchars($row['prestasi'])); ?></td>
                                            <td class="text-center" style="width: 120px;">
                                                <button type="button" class="btn btn-warning btn-sm d-block w-100 mb-2"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#editModal<?php echo $row['id_coach']; ?>">
                                                    <i class="fas fa-edit"></i> Edit
                                                </button>
                                                <a href="?hapus=<?php echo $row['id_coach']; ?>"
                                                    class="btn btn-danger btn-sm d-block w-100"
                                                    onclick="return confirm('Yakin ingin menghapus coach ini?')">
                                                    <i class="fas fa-trash"></i> Hapus
                                                </a>
                                            </td>
                                        </tr>

                                        <!-- Modal Edit -->
                                        <div class="modal fade" id="editModal<?php echo $row['id_coach']; ?>" tabindex="-1">
                                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Edit Coach</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <form method="POST" action="" enctype="multipart/form-data">
                                                        <div class="modal-body">
                                                            <input type="hidden" name="id_coach" value="<?php echo $row['id_coach']; ?>">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Nama Coach</label>
                                                                        <input type="text" name="nama" class="form-control"
                                                                            value="<?php echo htmlspecialchars($row['nama']); ?>" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Jabatan</label>
                                                                        <select name="jabatan" class="form-select" required>
                                                                            <option value="">Pilih Jabatan</option>
                                                                            <option value="Senior Coach" <?php echo $row['jabatan'] == 'Senior Coach' ? 'selected' : ''; ?>>Senior Coach</option>
                                                                            <option value="Pembina" <?php echo $row['jabatan'] == 'Pembina BSC' ? 'selected' : ''; ?>>Pembina BSC</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Status</label>
                                                                        <input type="text" name="status" class="form-control"
                                                                            value="<?php echo htmlspecialchars($row['status']); ?>" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Motto</label>
                                                                        <textarea name="motto" class="form-control" rows="3" required><?php echo htmlspecialchars_decode($row['motto']); ?></textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Prestasi/Pengalaman</label>
                                                                        <textarea name="prestasi" class="form-control" rows="3" required><?php echo htmlspecialchars($row['prestasi']); ?></textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Foto</label>
                                                                        <input type="file" name="foto" class="form-control" accept="image/*">
                                                                        <small class="text-muted">Kosongkan jika tidak ingin mengubah foto</small>
                                                                        <?php if ($row['foto']): ?>
                                                                            <div class="mt-2">
                                                                                <img src="../assets/img/coach/<?php echo htmlspecialchars($row['foto']); ?>"
                                                                                    alt="Current Photo" class="preview-image">
                                                                            </div>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                            <button type="submit" name="edit_coach" class="btn btn-primary">Simpan</button>
                                                        </div>
                                                    </form>
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
</body>

</html>