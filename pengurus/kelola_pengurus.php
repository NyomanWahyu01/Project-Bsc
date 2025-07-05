<?php
session_start();
require_once '../koneksi.php';

// Cek login
if (!isset($_SESSION['id_pengurus'])) {
    header("Location: login.php");
    exit();
}

// Tambah Pengurus
if (isset($_POST['tambah_pengurus'])) {
    $nama = clean_input($_POST['nama']);
    $kelas = clean_input($_POST['kelas']);
    $jabatan = clean_input($_POST['jabatan']);
    $periode = clean_input($_POST['periode']);
    $deskripsi = "Anggota"; // Set default deskripsi
    $foto = $_FILES['foto'];

    // Upload foto
    if ($foto['error'] == 0) {
        $foto_name = time() . '_' . $foto['name'];
        // Pastikan folder ada
        $upload_dir = '../assets/img/pengurus';
        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        $foto_path = $upload_dir . '/' . $foto_name;

        if (move_uploaded_file($foto['tmp_name'], $foto_path)) {
            $query = mysqli_query($conn, "INSERT INTO pengurus_bsc (nama, kelas, jabatan, periode, foto, deskripsi) 
                                        VALUES ('$nama', '$kelas', '$jabatan', '$periode', '$foto_name', '$deskripsi')");
            if ($query) {
                $success_pengurus = "Pengurus berhasil ditambahkan!";
            } else {
                $error_pengurus = "Gagal menambahkan pengurus: " . mysqli_error($conn);
            }
        } else {
            $error_pengurus = "Gagal mengupload foto!";
        }
    } else {
        $error_pengurus = "Pilih foto terlebih dahulu!";
    }
}

// Edit Pengurus
if (isset($_POST['edit_pengurus'])) {
    $id = clean_input($_POST['id_pengurus']);
    $nama = clean_input($_POST['nama']);
    $kelas = clean_input($_POST['kelas']);
    $jabatan = clean_input($_POST['jabatan']);
    $periode = clean_input($_POST['periode']);

    if ($_FILES['foto']['error'] == 0) {
        // Jika ada foto baru
        $foto = $_FILES['foto'];
        $foto_name = time() . '_' . $foto['name'];
        $upload_dir = '../assets/img/pengurus';
        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        $foto_path = $upload_dir . '/' . $foto_name;

        // Hapus foto lama
        $old_foto = mysqli_fetch_assoc(mysqli_query($conn, "SELECT foto FROM pengurus_bsc WHERE id_pengurus = '$id'"))['foto'];
        if ($old_foto && file_exists($upload_dir . '/' . $old_foto)) {
            unlink($upload_dir . '/' . $old_foto);
        }

        if (move_uploaded_file($foto['tmp_name'], $foto_path)) {
            $query = mysqli_query($conn, "UPDATE pengurus_bsc SET 
                                        nama = '$nama',
                                        kelas = '$kelas',
                                        jabatan = '$jabatan',
                                        periode = '$periode',
                                        foto = '$foto_name'
                                        WHERE id_pengurus = '$id'");
        }
    } else {
        // Jika tidak ada foto baru
        $query = mysqli_query($conn, "UPDATE pengurus_bsc SET 
                                    nama = '$nama',
                                    kelas = '$kelas',
                                    jabatan = '$jabatan',
                                    periode = '$periode'
                                    WHERE id_pengurus = '$id'");
    }

    if ($query) {
        $success_pengurus = "Data pengurus berhasil diupdate!";
    } else {
        $error_pengurus = "Gagal mengupdate data pengurus: " . mysqli_error($conn);
    }
}

// Hapus Pengurus
if (isset($_GET['hapus_pengurus'])) {
    $id = clean_input($_GET['hapus_pengurus']);

    // Ambil nama foto untuk dihapus
    $query = mysqli_query($conn, "SELECT foto FROM pengurus_bsc WHERE id_pengurus = '$id'");
    $pengurus = mysqli_fetch_assoc($query);

    if ($pengurus) {
        // Hapus foto
        $foto_path = '../assets/img/pengurus/' . $pengurus['foto'];
        if (file_exists($foto_path)) {
            unlink($foto_path);
        }

        // Hapus data dari database
        $query = mysqli_query($conn, "DELETE FROM pengurus_bsc WHERE id_pengurus = '$id'");
        if ($query) {
            $success_pengurus = "Pengurus berhasil dihapus!";
        } else {
            $error_pengurus = "Gagal menghapus pengurus: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Pengurus - pengurus BSC</title>
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
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Include Sidebar -->
            <?php include 'sidebar.php'; ?>

            <!-- Main Content -->
            <div class="col-md-9 offset-md-3 content">
                <!-- <h2 class="mb-4">Kelola Pengurus BSC</h2> -->

                <!-- Kelola Pengurus -->
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title mb-0">Kelola Pengurus</h2>
                    </div>
                    <div class="card-body">
                        <?php if (isset($success_pengurus)): ?>
                            <div class="alert alert-success"><?php echo $success_pengurus; ?></div>
                        <?php endif; ?>
                        <?php if (isset($error_pengurus)): ?>
                            <div class="alert alert-danger"><?php echo $error_pengurus; ?></div>
                        <?php endif; ?>

                        <form method="POST" action="" enctype="multipart/form-data" class="mb-4">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label">Nama Pengurus</label>
                                        <input type="text" name="nama" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="mb-3">
                                        <label class="form-label">Kelas</label>
                                        <select name="kelas" class="form-select" required>
                                            <option value="">Pilih Kelas</option>
                                            <option value="X">X</option>
                                            <option value="XI">XI</option>
                                            <option value="XII">XII</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label">Jabatan</label>
                                        <select name="jabatan" class="form-select" required>
                                            <option value="">Pilih Jabatan</option>
                                            <option value="Ketua">Ketua</option>
                                            <option value="Wakil Ketua">Wakil Ketua</option>
                                            <option value="Sekretaris">Sekretaris</option>
                                            <option value="Bendahara">Bendahara</option>
                                            <option value="Sesi Perlengkapan">Sesi Perlengkapan</option>
                                            <option value="Sesi Kepelatihan">Sesi Kepelatihan</option>
                                            <option value="Sesi Konsumsi">Sesi Konsumsi</option>
                                            <option value="Sesi Keamanan">Sesi Keamanan</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label">Periode Pengurus</label>
                                        <input type="text" name="periode" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label">Foto</label>
                                        <input type="file" name="foto" class="form-control" accept="image/*" required>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" name="tambah_pengurus" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Tambah Pengurus
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
                                        <th>Periode</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = mysqli_query($conn, "SELECT * FROM pengurus_bsc ORDER BY periode DESC, FIELD(jabatan, 'Ketua', 'Wakil Ketua', 'Sekretaris', 'Bendahara', 'Anggota')");
                                    $no = 1;
                                    while ($row = mysqli_fetch_assoc($query)) {
                                    ?>
                                        <tr>
                                            <td><?php echo $no++; ?></td>
                                            <td>
                                                <?php
                                                $foto_path = '../assets/img/pengurus/' . $row['foto'];
                                                if (file_exists($foto_path)) {
                                                ?>
                                                    <img src="<?php echo $foto_path; ?>" alt="Foto <?php echo $row['nama']; ?>"
                                                        style="width: 50px; height: 50px; object-fit: cover; border-radius: 50%;">
                                                <?php } else { ?>
                                                    <img src="../assets/img/default.png" alt="Default"
                                                        style="width: 50px; height: 50px; object-fit: cover; border-radius: 50%;">
                                                <?php } ?>
                                            </td>
                                            <td><?php echo htmlspecialchars($row['nama']); ?></td>
                                            <td><?php echo htmlspecialchars($row['jabatan']); ?></td>
                                            <td><?php echo htmlspecialchars($row['periode']); ?></td>
                                            <td>
                                                <a href="?hapus_pengurus=<?php echo $row['id_pengurus']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus pengurus ini?')">
                                                    <i class="fas fa-trash"></i> Hapus
                                                </a>
                                                <button type="button"
                                                    class="btn btn-primary btn-sm"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#editModal<?php echo $row['id_pengurus']; ?>">
                                                    <i class="fas fa-edit"></i> Edit
                                                </button>
                                            </td>
                                        </tr>

                                        <!-- Modal Edit -->
                                        <div class="modal fade" id="editModal<?php echo $row['id_pengurus']; ?>" tabindex="-1">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Edit Pengurus</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <form method="POST" action="" enctype="multipart/form-data">
                                                        <div class="modal-body">
                                                            <input type="hidden" name="id_pengurus" value="<?php echo $row['id_pengurus']; ?>">
                                                            <div class="mb-3">
                                                                <label class="form-label">Nama Pengurus</label>
                                                                <input type="text" name="nama" class="form-control" value="<?php echo $row['nama']; ?>" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Kelas</label>
                                                                <select name="kelas" class="form-select" required>
                                                                    <option value="">Pilih Kelas</option>
                                                                    <option value="X" <?php echo $row['kelas'] == 'X' ? 'selected' : ''; ?>>X</option>
                                                                    <option value="XI" <?php echo $row['kelas'] == 'XI' ? 'selected' : ''; ?>>XI</option>
                                                                    <option value="XII" <?php echo $row['kelas'] == 'XII' ? 'selected' : ''; ?>>XII</option>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Jabatan</label>
                                                                <select name="jabatan" class="form-select" required>
                                                                    <option value="">Pilih Jabatan</option>
                                                                    <option value="Ketua" <?php echo $row['jabatan'] == 'Ketua' ? 'selected' : ''; ?>>Ketua</option>
                                                                    <option value="Wakil Ketua" <?php echo $row['jabatan'] == 'Wakil Ketua' ? 'selected' : ''; ?>>Wakil Ketua</option>
                                                                    <option value="Sekretaris" <?php echo $row['jabatan'] == 'Sekretaris' ? 'selected' : ''; ?>>Sekretaris</option>
                                                                    <option value="Bendahara" <?php echo $row['jabatan'] == 'Bendahara' ? 'selected' : ''; ?>>Bendahara</option>
                                                                    <option value="Sesi Perlengkapan" <?php echo $row['jabatan'] == 'Sesi Perlengkapan' ? 'selected' : ''; ?>>Sesi Perlengkapan</option>
                                                                    <option value="Sesi Kepelatihan" <?php echo $row['jabatan'] == 'Sesi Kepelatihan' ? 'selected' : ''; ?>>Sesi Kepelatihan</option>
                                                                    <option value="Sesi Konsumsi" <?php echo $row['jabatan'] == 'Sesi Konsumsi' ? 'selected' : ''; ?>>Sesi Konsumsi</option>
                                                                    <option value="Sesi Keamanan" <?php echo $row['jabatan'] == 'Sesi Keamanan' ? 'selected' : ''; ?>>Sesi Keamanan</option>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Periode</label>
                                                                <input type="text" name="periode" class="form-control" value="<?php echo $row['periode']; ?>" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label">Foto</label>
                                                                <input type="file" name="foto" class="form-control" accept="image/*">
                                                                <small class="text-muted">Kosongkan jika tidak ingin mengubah foto</small>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                            <button type="submit" name="edit_pengurus" class="btn btn-primary">Simpan</button>
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