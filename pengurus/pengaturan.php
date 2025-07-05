<?php
session_start();
require_once '../koneksi.php';

// Cek login
if (!isset($_SESSION['id_admin'])) {
    header("Location: login.php");
    exit();
}

// Fungsi validasi password
function validatePassword($password)
{
    // Minimal 8 karakter
    if (strlen($password) < 8) {
        return "Password harus minimal 8 karakter!";
    }

    // Harus mengandung huruf
    if (!preg_match("/[a-zA-Z]/", $password)) {
        return "Password harus mengandung huruf!";
    }

    // Harus mengandung angka
    if (!preg_match("/[0-9]/", $password)) {
        return "Password harus mengandung angka!";
    }

    // Harus mengandung simbol
    if (!preg_match("/[!@#$%^&*(),.?\":{}|<>]/", $password)) {
        return "Password harus mengandung simbol!";
    }

    return true;
}

// Proses tambah admin baru
if (isset($_POST['tambah_admin'])) {
    $username_admin = clean_input($_POST['username']);
    $password_admin = clean_input($_POST['password']);
    $konfirmasi_password_admin = clean_input($_POST['konfirmasi_password']);

    // Validasi password
    $password_validation = validatePassword($password_admin);
    if ($password_validation !== true) {
        $error = $password_validation;
    } else if ($password_admin !== $konfirmasi_password_admin) {
        $error = "Password dan konfirmasi password tidak cocok!";
    } else {
        // Cek apakah username sudah ada
        $cek = mysqli_query($conn, "SELECT * FROM data_admin WHERE username_admin = '$username_admin'");
        if (mysqli_num_rows($cek) > 0) {
            $error = "Username sudah digunakan!";
        } else {
            // Hash password sebelum disimpan
            $password_hash = password_hash($password_admin, PASSWORD_DEFAULT);
            $query = mysqli_query($conn, "INSERT INTO data_admin (username_admin, password_admin) VALUES ('$username_admin', '$password_admin')");
            if ($query) {
                $success = "Admin baru berhasil ditambahkan!";
            } else {
                $error = "Gagal menambahkan admin: " . mysqli_error($conn);
            }
        }
    }
}

// Proses ubah password
if (isset($_POST['ubah_password'])) {
    $password_lama = clean_input($_POST['password_lama']);
    $password_baru = clean_input($_POST['password_baru']);
    $konfirmasi_baru = clean_input($_POST['konfirmasi_password_baru']);

    // Validasi password baru
    $password_validation = validatePassword($password_baru);
    if ($password_validation !== true) {
        $error_password = $password_validation;
    } else if ($password_baru !== $konfirmasi_baru) {
        $error_password = "Password baru dan konfirmasi tidak cocok!";
    } else {
        // Cek password lama
        $id_admin = $_SESSION['id_admin'];
        $cek = mysqli_query($conn, "SELECT * FROM data_admin WHERE id_admin = '$id_admin'");
        $admin = mysqli_fetch_assoc($cek);

        // Verifikasi password lama dengan direct comparison karena password belum di-hash
        if ($password_lama !== $admin['password_admin']) {
            $error_password = "Password lama tidak sesuai!";
        } else {
            // Hash password baru
            $password_hash = password_hash($password_baru, PASSWORD_DEFAULT);

            // Update password
            $query = mysqli_query($conn, "UPDATE data_admin SET password_admin = '$password_baru' WHERE id_admin = '$id_admin'");
            if ($query) {
                $success_password = "Password berhasil diubah!";

                // Redirect setelah berhasil untuk refresh halaman
                echo "<script>
                    alert('Password berhasil diubah!');
                    window.location.href='pengaturan.php';
                </script>";
            } else {
                $error_password = "Gagal mengubah password: " . mysqli_error($conn);
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan - Pengurus BSC</title>
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
                <h2 class="mb-4">Pengaturan</h2>

                <div class="row">
                    <!-- Ubah Password - Left Column -->
                    <div class="col-md-6">
                        <div class="card h-100">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Ubah Password</h5>
                            </div>
                            <div class="card-body">
                                <?php if (isset($success_password)): ?>
                                    <div class="alert alert-success"><?php echo $success_password; ?></div>
                                <?php endif; ?>
                                <?php if (isset($error_password)): ?>
                                    <div class="alert alert-danger"><?php echo $error_password; ?></div>
                                <?php endif; ?>

                                <form method="POST" action="">
                                    <div class="mb-3">
                                        <label class="form-label">Password Lama</label>
                                        <input type="password" name="password_lama" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Password Baru</label>
                                        <input type="password" name="password_baru" class="form-control" required
                                            title="Minimal 8 karakter, harus mengandung huruf, angka, dan simbol">
                                        <div class="form-text text-muted">
                                            Password Minimal 8 karakter mengandung Huruf Awalan Besar, Angka, dan Simbol
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Konfirmasi Password Baru</label>
                                        <input type="password" name="konfirmasi_password_baru" class="form-control" required>
                                    </div>
                                    <button type="submit" name="ubah_password" class="btn btn-primary">
                                        <i class="fas fa-key"></i> Ubah Password
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Tambah Admin Baru - Right Column -->
                    <div class="col-md-6">
                        <div class="card h-100">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Tambah Admin Baru</h5>
                            </div>
                            <div class="card-body">
                                <?php if (isset($success)): ?>
                                    <div class="alert alert-success"><?php echo $success; ?></div>
                                <?php endif; ?>
                                <?php if (isset($error)): ?>
                                    <div class="alert alert-danger"><?php echo $error; ?></div>
                                <?php endif; ?>

                                <form method="POST" action="">
                                    <div class="mb-3">
                                        <label class="form-label">Username</label>
                                        <input type="text" name="username" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Password</label>
                                        <input type="password" name="password" class="form-control" required
                                            title="Minimal 8 karakter, harus mengandung huruf, angka, dan simbol">
                                        <div class="form-text text-muted">
                                            Password Minimal 8 karakter mengandung Huruf Awalan Besar, Angka, dan Simbol
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Konfirmasi Password</label>
                                        <input type="password" name="konfirmasi_password" class="form-control" required>
                                    </div>
                                    <button type="submit" name="tambah_admin" class="btn btn-success">
                                        <i class="fas fa-user-plus"></i> Tambah Admin
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Daftar Admin -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Daftar Admin</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Username</th>
                                        <th>Password</th>
                                        <th>Tanggal Dibuat</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = mysqli_query($conn, "SELECT * FROM data_admin ORDER BY id_admin DESC");
                                    $no = 1;
                                    while ($row = mysqli_fetch_assoc($query)) {
                                    ?>
                                        <tr>
                                            <td><?php echo $no++; ?></td>
                                            <td><?php echo htmlspecialchars($row['username_admin']); ?></td>
                                            <td><?php echo htmlspecialchars($row['password_admin']); ?></td>
                                            <td><?php echo date('d/m/Y H:i', strtotime($row['created_at'])); ?></td>
                                            <td>
                                                <a href="hapus_admin.php?id_admin=<?php echo $row['id_admin']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus admin ini?');">
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
    </div> -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>