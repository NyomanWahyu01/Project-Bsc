<?php
session_start();
require_once '../koneksi.php';

// Cek login
if (!isset($_SESSION['id_admin'])) {
    header("Location: login.php");
    exit();
}

// Periksa apakah ID anggota tersedia dan valid
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("<script>alert('ID tidak valid!'); window.location='kelola_anggota.php';</script>");
}

$id_anggota = intval($_GET['id']);
$query = mysqli_query($conn, "SELECT * FROM anggota_bsc WHERE id_anggota = '$id_anggota'");
$anggota = mysqli_fetch_assoc($query);

if (!$anggota) {
    die("<script>alert('Anggota tidak ditemukan!'); window.location='kelola_anggota.php';</script>");
}

if (isset($_POST['update_anggota'])) {
    $nama = clean_input($_POST['nama']);
    $kelas = clean_input($_POST['kelas']);
    $deskripsi = clean_input($_POST['deskripsi']);

    $update_query = mysqli_query($conn, "UPDATE anggota_bsc SET nama = '$nama', kelas = '$kelas', deskripsi = '$deskripsi' WHERE id_anggota = '$id_anggota'");

    if ($update_query) {
        echo "<script>alert('Data anggota berhasil diupdate!'); window.location='kelola_anggota.php';</script>";
    } else {
        echo "<script>alert('Gagal mengupdate data: " . mysqli_error($conn) . "');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Anggota - Admin BSC</title>
    <link rel="icon" href="assets/images/logo-bsc.ico" type="image/x-icon" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h2 class="card-title mb-0">Edit Anggota</h2>
            </div>
            <div class="card-body">
                <form method="POST" action="">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Anggota</label>
                        <input type="text" name="nama" class="form-control" value="<?php echo $anggota['nama']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="kelas" class="form-label">Kelas</label>
                        <select name="kelas" class="form-select" required>
                            <option value="X" <?php if ($anggota['kelas'] == 'X') echo 'selected'; ?>>X</option>
                            <option value="XI" <?php if ($anggota['kelas'] == 'XI') echo 'selected'; ?>>XI</option>
                            <option value="XII" <?php if ($anggota['kelas'] == 'XII') echo 'selected'; ?>>XII</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Jabatan</label>
                        <select name="deskripsi" class="form-select" required>
                            <option value="Anggota BSC" <?php if ($anggota['deskripsi'] == 'Anggota BSC') echo 'selected'; ?>>Anggota BSC</option>
                            <option value="Alumni BSC" <?php if ($anggota['deskripsi'] == 'Alumni BSC') echo 'selected'; ?>>Alumni BSC</option>
                        </select>
                    </div>
                    <button type="submit" name="update_anggota" class="btn btn-success">Update</button>
                    <a href="kelola_anggota.php" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>