<?php
session_start();
require_once '../koneksi.php';

// Cek login
if (!isset($_SESSION['id_admin'])) {
    header("Location: login.php");
    exit();
}

// Tambah Anggota
if (isset($_POST['tambah_anggota'])) {
    $nama = clean_input($_POST['nama']);
    $kelas = clean_input($_POST['kelas']);
    $deskripsi = clean_input($_POST['deskripsi']);
    
    $query = mysqli_query($conn, "INSERT INTO anggota_bsc (nama, kelas, deskripsi) VALUES ('$nama', '$kelas', '$deskripsi')");
    if ($query) {
        $success_anggota = "Anggota berhasil ditambahkan!";
    } else {
        $error_anggota = "Gagal menambahkan anggota: " . mysqli_error($conn);
    }
}

// Hapus Anggota
if (isset($_GET['hapus_anggota'])) {
    $id = clean_input($_GET['hapus_anggota']);
    $query = mysqli_query($conn, "DELETE FROM anggota_bsc WHERE id = '$id'");
    if ($query) {
        $success_anggota = "Anggota berhasil dihapus!";
    } else {
        $error_anggota = "Gagal menghapus anggota: " . mysqli_error($conn);
    }
}

// Tambah Pengurus
if (isset($_POST['tambah_pengurus'])) {
    $nama = clean_input($_POST['nama']);
    $jabatan = clean_input($_POST['jabatan']);
    $periode = clean_input($_POST['periode']);
    $foto = $_FILES['foto'];
    
    // Upload foto
    if ($foto['error'] == 0) {
        $foto_name = time() . '_' . $foto['name'];
        $foto_path = '../assets/img/pengurus/' . $foto_name;
        
        if (move_uploaded_file($foto['tmp_name'], $foto_path)) {
            $query = mysqli_query($conn, "INSERT INTO pengurus_bsc (nama, jabatan, periode, foto) 
                                        VALUES ('$nama', '$jabatan', '$periode', '$foto_name')");
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

// Hapus Pengurus
if (isset($_GET['hapus_pengurus'])) {
    $id = clean_input($_GET['hapus_pengurus']);
    
    // Ambil nama foto untuk dihapus
    $query = mysqli_query($conn, "SELECT foto FROM pengurus_bsc WHERE id = '$id'");
    $pengurus = mysqli_fetch_assoc($query);
    
    if ($pengurus) {
        // Hapus foto
        $foto_path = '../assets/img/pengurus/' . $pengurus['foto'];
        if (file_exists($foto_path)) {
            unlink($foto_path);
        }
        
        // Hapus data dari database
        $query = mysqli_query($conn, "DELETE FROM pengurus_bsc WHERE id = '$id'");
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
    <title>Kelola Pengurus - Admin BSC</title>
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
            <div class="col-md-10 offset-md-2 content">
                <!-- Kelola Anggota -->
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title mb-0">Kelola Anggota</h2>
                    </div>
                    <div class="card-body">
                        <?php if(isset($success_anggota)): ?>
                            <div class="alert alert-success"><?php echo $success_anggota; ?></div>
                        <?php endif; ?>
                        <?php if(isset($error_anggota)): ?>
                            <div class="alert alert-danger"><?php echo $error_anggota; ?></div>
                        <?php endif; ?>

                        <form method="POST" action="" class="mb-4">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Nama Anggota</label>
                                        <input type="text" name="nama" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Kelas</label>
                                        <input type="text" name="kelas" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Deskripsi</label>
                                        <textarea name="deskripsi" class="form-control" rows="1"></textarea>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" name="tambah_anggota" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Tambah Anggota
                            </button>
                        </form>

                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Kelas</th>
                                        <th>Deskripsi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = mysqli_query($conn, "SELECT * FROM anggota_bsc ORDER BY id DESC");
                                    $no = 1;
                                    while($row = mysqli_fetch_assoc($query)) {
                                    ?>
                                    <tr>
                                        <td><?php echo $no++; ?></td>
                                        <td><?php echo htmlspecialchars($row['nama']); ?></td>
                                        <td><?php echo htmlspecialchars($row['kelas']); ?></td>
                                        <td><?php echo htmlspecialchars($row['deskripsi']); ?></td>
                                        <td>
                                            <a href="?hapus_anggota=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus anggota ini?')">
                                                <i class="fas fa-trash"></i> Hapus
                                            </a>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Kelola Pengurus -->
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title mb-0">Kelola Pengurus</h2>
                    </div>
                    <div class="card-body">
                        <?php if(isset($success_pengurus)): ?>
                            <div class="alert alert-success"><?php echo $success_pengurus; ?></div>
                        <?php endif; ?>
                        <?php if(isset($error_pengurus)): ?>
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
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label">Jabatan</label>
                                        <select name="jabatan" class="form-select" required>
                                            <option value="">Pilih Jabatan</option>
                                            <option value="Ketua">Ketua</option>
                                            <option value="Wakil Ketua">Wakil Ketua</option>
                                            <option value="Sekretaris">Sekretaris</option>
                                            <option value="Bendahara">Bendahara</option>
                                            <option value="Anggota">Anggota</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label">Periode</label>
                                        <input type="text" name="periode" class="form-control" placeholder="2023/2024" required>
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
                                    while($row = mysqli_fetch_assoc($query)) {
                                    ?>
                                    <tr>
                                        <td><?php echo $no++; ?></td>
                                        <td>
                                            <img src="../assets/img/pengurus/<?php echo $row['foto']; ?>" alt="Foto <?php echo $row['nama']; ?>" 
                                                 style="width: 50px; height: 50px; object-fit: cover; border-radius: 50%;">
                                        </td>
                                        <td><?php echo htmlspecialchars($row['nama']); ?></td>
                                        <td><?php echo htmlspecialchars($row['jabatan']); ?></td>
                                        <td><?php echo htmlspecialchars($row['periode']); ?></td>
                                        <td>
                                            <a href="?hapus_pengurus=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus pengurus ini?')">
                                                <i class="fas fa-trash"></i> Hapus
                                            </a>
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
