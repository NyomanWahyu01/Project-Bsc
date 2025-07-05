<?php
session_start();
require_once '../koneksi.php';

// Cek login
if (!isset($_SESSION['id_admin'])) {
    header("Location: login.php");
    exit();
}

// Cek ID juara
if (!isset($_GET['id'])) {
    header("Location: kelola_juara.php");
    exit();
}

$id_juara = clean_input($_GET['id']);

// Ambil data juara
$query = mysqli_query($conn, "SELECT * FROM juara_bsc WHERE id_juara = '$id_juara'");
$juara = mysqli_fetch_assoc($query);

if (!$juara) {
    header("Location: kelola_juara.php");
    exit();
}

// Proses update data
if (isset($_POST['update_juara'])) {
    $kejuaraan = clean_input($_POST['kejuaraan']);
    $tingkat = clean_input($_POST['tingkat']);
    $peringkat = clean_input($_POST['peringkat']);
    $tahun = clean_input($_POST['tahun']);

    // Jika ada foto baru
    if ($_FILES['foto']['error'] == 0) {
        $foto = $_FILES['foto'];
        $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
        $file_extension = strtolower(pathinfo($foto['name'], PATHINFO_EXTENSION));

        if (!in_array($file_extension, $allowed_extensions)) {
            $error = "Hanya file dengan format JPG, JPEG, PNG, atau GIF yang diperbolehkan!";
        } else {
            // Hapus foto lama
            $foto_lama = '../assets/img/juara/' . $juara['foto'];
            if (file_exists($foto_lama)) {
                unlink($foto_lama);
            }

            // Upload foto baru
            $foto_name = time() . '_' . $foto['name'];
            $upload_dir = '../assets/img/juara';
            $foto_path = $upload_dir . '/' . $foto_name;

            if (move_uploaded_file($foto['tmp_name'], $foto_path)) {
                // Update data dengan foto baru
                $query = mysqli_query($conn, "UPDATE juara_bsc SET 
                    kejuaraan = '$kejuaraan',
                    tingkat = '$tingkat',
                    peringkat = '$peringkat',
                    tahun = '$tahun',
                    foto = '$foto_name'
                    WHERE id_juara = '$id_juara'");
            } else {
                $error = "Gagal mengupload foto!";
            }
        }
    } else {
        // Update data tanpa mengubah foto
        $query = mysqli_query($conn, "UPDATE juara_bsc SET 
            kejuaraan = '$kejuaraan',
            tingkat = '$tingkat',
            peringkat = '$peringkat',
            tahun = '$tahun'
            WHERE id_juara = '$id_juara'");
    }

    if (isset($query) && $query) {
        echo "<script>
            alert('Data juara berhasil diupdate!');
            window.location.href = 'kelola_juara.php';
        </script>";
    } else if (!isset($error)) {
        $error = "Gagal mengupdate data juara: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Juara - Admin BSC</title>
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
            max-width: 200px;
            margin-top: 10px;
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
                        <h2 class="card-title mb-0">Edit Juara</h2>
                    </div>
                    <div class="card-body">
                        <?php if (isset($error)): ?>
                            <div class="alert alert-danger"><?php echo $error; ?></div>
                        <?php endif; ?>

                        <form method="POST" action="" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Nama Kejuaraan</label>
                                        <input type="text" name="kejuaraan" class="form-control"
                                            value="<?php echo htmlspecialchars($juara['kejuaraan']); ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Tingkat</label>
                                        <select name="tingkat" class="form-select" required>
                                            <option value="">Pilih Tingkat</option>
                                            <?php
                                            $tingkat_options = ['Sekolah', 'Kecamatan', 'Kabupaten', 'Provinsi', 'Nasional', 'Internasional'];
                                            foreach ($tingkat_options as $option) {
                                                $selected = ($juara['tingkat'] == $option) ? 'selected' : '';
                                                echo "<option value=\"$option\" $selected>$option</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Peringkat</label>
                                        <select name="peringkat" class="form-select" required>
                                            <option value="">Pilih Peringkat</option>
                                            <?php
                                            for ($i = 1; $i <= 3; $i++) {
                                                $selected = ($juara['peringkat'] == $i) ? 'selected' : '';
                                                echo "<option value=\"$i\" $selected>Juara $i</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Tahun</label>
                                        <input type="number" name="tahun" class="form-control" min="2000" max="2099"
                                            value="<?php echo htmlspecialchars($juara['tahun']); ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Foto</label>
                                        <input type="file" name="foto" class="form-control" accept="image/*">
                                        <small class="text-muted">Biarkan kosong jika tidak ingin mengubah foto</small>
                                        <?php if ($juara['foto']): ?>
                                            <div class="mt-2">
                                                <label class="form-label">Foto Saat Ini:</label><br>
                                                <img src="../assets/img/juara/<?php echo htmlspecialchars($juara['foto']); ?>"
                                                    alt="Foto Juara" class="preview-image">
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-3">
                                <button type="submit" name="update_juara" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Simpan Perubahan
                                </button>
                                <a href="kelola_juara.php" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Kembali
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>