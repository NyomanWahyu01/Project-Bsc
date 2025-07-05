<?php
session_start();
require_once '../koneksi.php';

// Cek login
if (!isset($_SESSION['id_pengurus'])) {
    header("Location: login.php");
    exit();
}



// Tambah Juara
if (isset($_POST['tambah_juara'])) {
    $kejuaraan = clean_input($_POST['kejuaraan']);
    $tingkat = clean_input($_POST['tingkat']);
    $peringkat = clean_input($_POST['peringkat']);
    $tahun = clean_input($_POST['tahun']);
    $foto = $_FILES['foto'];

    // Validasi upload foto
    if ($foto['error'] == 0) {
        $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
        $file_extension = strtolower(pathinfo($foto['name'], PATHINFO_EXTENSION));

        if (!in_array($file_extension, $allowed_extensions)) {
            $error = "Hanya file dengan format JPG, JPEG, PNG, atau GIF yang diperbolehkan!";
        } else {
            $foto_name = time() . '_' . $foto['name'];
            $upload_dir = '../assets/img/juara';
            if (!file_exists($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }

            $foto_path = $upload_dir . '/' . $foto_name;

            if (move_uploaded_file($foto['tmp_name'], $foto_path)) {
                // Query untuk menambahkan data ke database
                $query = mysqli_query($conn, "INSERT INTO juara_bsc (kejuaraan, tingkat, peringkat, tahun, foto) 
                                              VALUES ('$kejuaraan', '$tingkat', '$peringkat', '$tahun', '$foto_name')");
                if ($query) {
                    $success = "Data juara berhasil ditambahkan!";
                } else {
                    $error = "Gagal menambahkan data juara: " . mysqli_error($conn);
                }
            } else {
                $error = "Gagal mengupload foto!";
            }
        }
    } else {
        $error = "Pilih foto terlebih dahulu!";
    }
}

// Hapus Juara
if (isset($_GET['hapus'])) {
    $id = clean_input($_GET['hapus']);

    // Ambil nama foto untuk dihapus
    $query = mysqli_query($conn, "SELECT foto FROM juara_bsc WHERE id_juara = '$id_juara'");
    $juara = mysqli_fetch_assoc($query);

    if ($juara) {
        // Hapus foto
        $foto_path = '../assets/img/juara/' . $juara['foto'];
        if (file_exists($foto_path)) {
            unlink($foto_path);
        }

        // Hapus data dari database
        $query = mysqli_query($conn, "DELETE FROM juara_bsc WHERE id_juara = '$id_juara'");
        if ($query) {
            $success = "Data juara berhasil dihapus!";
        } else {
            $error = "Gagal menghapus data juara: " . mysqli_error($conn);
        }
    } else {
        $error = "Data tidak ditemukan!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Juara - Pengurus BSC</title>
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

        img {
            width: 50px;
            height: 50px;
            object-fit: cover;
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
                        <h2 class="card-title mb-0">Kelola Juara</h2>
                    </div>
                    <div class="card-body">
                        <?php if (isset($success)): ?>
                            <div class="alert alert-success"><?php echo $success; ?></div>
                        <?php endif; ?>
                        <?php if (isset($error)): ?>
                            <div class="alert alert-danger"><?php echo $error; ?></div>
                        <?php endif; ?>

                        <form method="POST" action="" enctype="multipart/form-data" class="mb-4">
                            <div class="container">
                                <div class="row g-3">
                                    <div class="col-md-3">
                                        <label class="form-label fw-bold">Nama Kejuaraan</label>
                                        <input type="text" name="kejuaraan" class="form-control" required>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label fw-bold">Tingkat</label>
                                        <select name="tingkat" class="form-select" required>
                                            <option value="">Pilih Tingkat</option>
                                            <option value="Sekolah">Sekolah</option>
                                            <option value="Kecamatan">Kecamatan</option>
                                            <option value="Kabupaten">Kabupaten</option>
                                            <option value="Provinsi">Provinsi</option>
                                            <option value="Nasional">Nasional</option>
                                            <option value="Internasional">Internasional</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label fw-bold">Peringkat</label>
                                        <select name="peringkat" class="form-select" required>
                                            <option value="">Pilih Peringkat</option>
                                            <option value="1">Juara 1</option>
                                            <option value="2">Juara 2</option>
                                            <option value="3">Juara 3</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label fw-bold">Tahun</label>
                                        <input type="number" name="tahun" class="form-control" min="2000" max="2099" required>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label fw-bold">Foto</label>
                                        <input type="file" name="foto" class="form-control" accept="image/*" required>
                                    </div>
                                </div>
                                <div class="text-end mt-3">
                                    <button type="submit" name="tambah_juara" class="btn btn-primary px-4">
                                        <i class="fas fa-plus"></i> Tambah Juara
                                    </button>
                                </div>
                            </div>
                        </form>

                        <style>
                            .form-label {
                                font-weight: 600;
                            }

                            .form-control,
                            .form-select {
                                border-radius: 8px;
                                padding: 10px;
                            }

                            .btn-primary {
                                border-radius: 8px;
                                font-weight: bold;
                            }
                        </style>


                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Foto</th>
                                        <th>Kejuaraan</th>
                                        <th>Tingkat</th>
                                        <th>Peringkat</th>
                                        <th>Tahun</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = mysqli_query($conn, "SELECT * FROM juara_bsc ORDER BY tahun DESC, peringkat ASC");
                                    $no = 1;
                                    while ($row = mysqli_fetch_assoc($query)) {
                                    ?>
                                        <tr>
                                            <td><?php echo $no++; ?></td>
                                            <td>
                                                <img src="../assets/img/juara/<?php echo htmlspecialchars($row['foto']); ?>"
                                                    alt="Foto Juara">
                                            </td>
                                            <td><?php echo htmlspecialchars($row['kejuaraan']); ?></td>
                                            <td><?php echo htmlspecialchars($row['tingkat']); ?></td>
                                            <td>Juara <?php echo htmlspecialchars($row['peringkat']); ?></td>
                                            <td><?php echo htmlspecialchars($row['tahun']); ?></td>
                                            <td>
                                                <a href="edit_juara.php?id=<?php echo $row['id_juara']; ?>" class="btn btn-warning btn-sm action-btn">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
                                                <a href="?hapus=<?php echo $row['id_juara']; ?>" class="btn btn-danger btn-sm action-btn"
                                                    onclick="return confirm('Yakin ingin menghapus data juara ini?')">
                                                    <i class="fas fa-trash"></i> Hapus
                                                </a>

                                                <style>
                                                    .action-btn {
                                                        width: 90px;
                                                        /* Pastikan ukuran tombol sama */
                                                        text-align: center;
                                                    }
                                                </style>

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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>