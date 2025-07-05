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

// Proses tambah pengguna baru (Admin/Pengurus)
if (isset($_POST['tambah_pengguna'])) {
    $username = clean_input($_POST['username']);
    $password = clean_input($_POST['password']);
    $konfirmasi_password = clean_input($_POST['konfirmasi_password']);
    $role     = clean_input($_POST['role']);

    $password_validation = validatePassword($password);
    if ($password_validation !== true) {
        $error_tambah = $password_validation;
    } else if ($password !== $konfirmasi_password) {
        $error_tambah = "Password dan konfirmasi password tidak cocok!";
    } else if (empty($role)) {
        $error_tambah = "Silakan pilih peran (Role) untuk pengguna baru.";
    } else {
        $table_name    = ($role === 'admin') ? 'data_admin' : 'data_pengurus';
        $username_col  = ($role === 'admin') ? 'username_admin' : 'username_pengurus';
        $password_col  = ($role === 'admin') ? 'password_admin' : 'password_pengurus';

        $cek = mysqli_query($conn, "SELECT * FROM `$table_name` WHERE `$username_col` = '$username'");
        if (mysqli_num_rows($cek) > 0) {
            $error_tambah = "Username '$username' sudah digunakan untuk peran '$role'!";
        } else {
            $password_hash = password_hash($password, PASSWORD_DEFAULT);
            $query = mysqli_query($conn, "INSERT INTO `$table_name` (`$username_col`, `$password_col`) VALUES ('$username', '$password_hash')");
            if ($query) {
                $success_tambah = "Pengguna baru sebagai '$role' berhasil ditambahkan!";
            } else {
                $error_tambah = "Gagal menambahkan pengguna: " . mysqli_error($conn);
            }
        }
    }
}

// Proses ubah password
if (isset($_POST['ubah_password'])) {
    // PERBAIKAN: Menggunakan nilai password mentah dari POST, tanpa `clean_input`
    $password_lama = $_POST['password_lama'];
    $password_baru = $_POST['password_baru'];
    $konfirmasi_baru = $_POST['konfirmasi_password_baru'];

    // Validasi password baru
    $password_validation = validatePassword($password_baru);
    if ($password_validation !== true) {
        $error_password = $password_validation;
    } else if ($password_baru !== $konfirmasi_baru) {
        $error_password = "Password baru dan konfirmasi tidak cocok!";
    } else {
        // Cek password lama
        $id_admin = $_SESSION['id_admin'];
        $cek = mysqli_query($conn, "SELECT password_admin FROM data_admin WHERE id_admin = '$id_admin'");
        $admin = mysqli_fetch_assoc($cek);

        // Verifikasi password lama yang dikirim pengguna dengan hash di database
        if (password_verify($password_lama, $admin['password_admin'])) {
            // Hash password baru untuk keamanan
            $password_hash_baru = password_hash($password_baru, PASSWORD_DEFAULT);

            // Update password dengan HASH yang baru
            $query = mysqli_query($conn, "UPDATE data_admin SET password_admin = '$password_hash_baru' WHERE id_admin = '$id_admin'");
            if ($query) {
                // Hancurkan sesi setelah password berhasil diubah untuk memaksa login ulang
                session_destroy();
                echo "<script>
                    alert('Password berhasil diubah! Silakan login kembali dengan password baru Anda.');
                    window.location.href='login.php';
                </script>";
                exit();
            } else {
                $error_password = "Gagal mengubah password: " . mysqli_error($conn);
            }
        } else {
            // Jika verifikasi gagal, fallback ke pengecekan plain text (untuk transisi)
            if ($password_lama === $admin['password_admin']) {
                 $password_hash_baru = password_hash($password_baru, PASSWORD_DEFAULT);
                 $query_update = mysqli_query($conn, "UPDATE data_admin SET password_admin = '$password_hash_baru' WHERE id_admin = '$id_admin'");
                 if ($query_update) {
                    session_destroy();
                    echo "<script>
                        alert('Password lama Anda telah diamankan dan password baru berhasil disimpan. Silakan login kembali.');
                        window.location.href='login.php';
                    </script>";
                    exit();
                 }
            }
            $error_password = "Password lama tidak sesuai!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Pengguna - Admin BSC</title>
    <link rel="icon" href="assets/images/logo-bsc.ico" type="image/x-icon" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .content {
            padding: 30px; 
        }

        /* Modern Card Style */
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 25px rgba(0, 0, 0, 0.08);
            margin-bottom: 30px;
            transition: all 0.3s ease;
        }
        .card:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 30px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background-color: #fff;
            border-bottom: 1px solid #e9ecef;
            padding: 1.25rem 1.5rem;
            border-top-left-radius: 12px;
            border-top-right-radius: 12px;
        }
        .card-header .card-title {
            font-weight: 600;
            color: #343a40;
        }
        .card-body {
            padding: 1.5rem;
        }

        /* Modern Form & Button Style */
        .form-control, .form-select {
            border-radius: 8px;
            padding-top: 12px;
            padding-bottom: 12px;
        }
        .btn {
            border-radius: 8px;
            font-weight: 500;
        }

        /* Modern Table Style */
        .table thead th {
            background-color: transparent;
            border-bottom: 2px solid #e9ecef;
            color: #6c757d;
            font-weight: 600;
            text-transform: none;
            padding: 1rem 1.5rem;
            letter-spacing: 0;
        }
        .table tbody tr {
            transition: background-color 0.2s ease-in-out;
        }
        .table tbody tr:hover {
            background-color: #f1f3f5;
        }
        .table tbody td {
            vertical-align: middle;
            padding: 1rem 1.5rem;
            border-top: 1px solid #f1f3f5;
        }
        .table .action-buttons a.btn {
            margin: 0 4px;
        }
        .table .badge {
            font-size: 0.9em;
            padding: 8px 12px;
            font-weight: 500;
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
                <h2 class="mb-4">Manajemen Pengguna</h2>

                <div class="row">
                    <!-- Ubah Password -->
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header"><h5 class="card-title mb-0">Ubah Password Anda</h5></div>
                            <div class="card-body">
                                <?php if (isset($error_password)): ?><div class="alert alert-danger"><?php echo $error_password; ?></div><?php endif; ?>

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

                    <!-- Tambah Pengguna Baru -->
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header"><h5 class="card-title mb-0">Tambah Pengguna Baru</h5></div>
                            <div class="card-body">
                                <?php if (isset($success_tambah)): ?><div class="alert alert-success"><?php echo $success_tambah; ?></div><?php endif; ?>
                                <?php if (isset($error_tambah)): ?><div class="alert alert-danger"><?php echo $error_tambah; ?></div><?php endif; ?>
                                <form method="POST" action="">
                                    <div class="mb-3">
                                        <label class="form-label">Username</label>
                                        <input type="text" name="username" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Password</label>
                                        <input type="password" name="password" class="form-control" required title="Minimal 8 karakter, harus mengandung huruf, angka, dan simbol">
                                         <div class="form-text text-muted">Min. 8 karakter, mengandung huruf, angka, dan simbol.</div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Konfirmasi Password</label>
                                        <input type="password" name="konfirmasi_password" class="form-control" required>
                                    </div>
                                    <div class="row align-items-end">
                                        <div class="col-md-7">
                                            <label class="form-label">Peran (Role)</label>
                                            <select name="role" class="form-select" required>
                                                <option value="">Pilih Peran</option>
                                                <option value="admin">Admin</option>
                                                <option value="pengurus">Pengurus</option>
                                            </select>
                                        </div>
                                        <div class="col-md-5">
                                            <button type="submit" name="tambah_pengguna" class="btn btn-success w-100"><i class="fas fa-user-plus"></i> Tambah Pengguna</button>
                                        </div>
                                    </div>
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
                        <?php
                        if (isset($_SESSION['reset_success_message'])) {
                            echo '<div class="alert alert-success">' . $_SESSION['reset_success_message'] . '</div>';
                            unset($_SESSION['reset_success_message']);
                        }
                        ?>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Username</th>
                                        <th>Tanggal Dibuat</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $current_admin_id = $_SESSION['id_admin'];
                                    $query_admin = mysqli_query($conn, "SELECT * FROM data_admin ORDER BY created_at DESC");
                                    $no = 1;
                                    while ($row = mysqli_fetch_assoc($query_admin)) {
                                    ?>
                                        <tr>
                                            <td><?php echo $no++; ?></td>
                                            <td><?php echo htmlspecialchars($row['username_admin']); ?></td>
                                            <td><?php echo date('d/m/Y H:i', strtotime($row['created_at'])); ?></td>
                                            <td class="text-center action-buttons">
                                                <?php if ($row['id_admin'] != $current_admin_id): ?>
                                                    <a href="reset_password_admin.php?id=<?php echo $row['id_admin']; ?>" class="btn btn-warning btn-sm" onclick="return confirm('Yakin ingin me-reset password untuk admin ini?');"><i class="fas fa-key"></i> Reset</a>
                                                    <a href="hapus_admin.php?id_admin=<?php echo $row['id_admin']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus admin ini?');"><i class="fas fa-trash"></i> Hapus</a>
                                                <?php else: ?>
                                                    <span class="badge bg-secondary">Akun Anda</span>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                
                <!-- Daftar Pengurus -->
                <div class="card">
                    <div class="card-header"><h5 class="card-title mb-0">Daftar Pengurus</h5></div>
                    <div class="card-body">
                         <?php if (isset($_SESSION['pengurus_reset_success'])): ?>
                            <div class="alert alert-success"><?php echo $_SESSION['pengurus_reset_success']; unset($_SESSION['pengurus_reset_success']); ?></div>
                        <?php endif; ?>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Username</th>
                                        <th>Tanggal Dibuat</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query_pengurus = mysqli_query($conn, "SELECT * FROM data_pengurus ORDER BY created_at DESC");
                                    $no_pengurus = 1;
                                    while ($row_pengurus = mysqli_fetch_assoc($query_pengurus)) {
                                    ?>
                                        <tr>
                                            <td><?php echo $no_pengurus++; ?></td>
                                            <td><?php echo htmlspecialchars($row_pengurus['username_pengurus']); ?></td>
                                            <td><?php echo date('d/m/Y H:i', strtotime($row_pengurus['created_at'])); ?></td>
                                            <td class="text-center action-buttons">
                                                <a href="reset_password_pengurus.php?id=<?php echo $row_pengurus['id_pengurus']; ?>" class="btn btn-warning btn-sm" onclick="return confirm('Yakin ingin me-reset password untuk pengurus ini?');"><i class="fas fa-key"></i> Reset</a>
                                                <a href="hapus_pengurus.php?id=<?php echo $row_pengurus['id_pengurus']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus pengurus ini?');"><i class="fas fa-trash"></i> Hapus</a>
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