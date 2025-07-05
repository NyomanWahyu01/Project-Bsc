<?php
session_start();
require_once '../koneksi.php';

if (isset($_POST['login'])) {
    if (empty($_POST['username']) || empty($_POST['password'])) {
        echo "<script>alert('Lengkapi semua data login');history.back();</script>";
    } else {
        $user = mysqli_real_escape_string($conn, $_POST['username']);
        $pass = $_POST['password']; // Password mentah untuk verifikasi

        $sql = "SELECT * FROM data_admin WHERE username_admin='$user'";
        $query = mysqli_query($conn, $sql);

        if ($query && mysqli_num_rows($query) > 0) {
            $data = mysqli_fetch_assoc($query);
            $stored_password = $data['password_admin'];
            $id_admin = $data['id_admin'];
            
            $login_success = false;

            // 1. Cek dengan password_verify (untuk password yang sudah di-hash)
            if (password_verify($pass, $stored_password)) {
                $login_success = true;
                
                // Jika hash perlu diperbarui (misal: algoritma baru), lakukan di sini
                if (password_needs_rehash($stored_password, PASSWORD_DEFAULT)) {
                    $new_hash = password_hash($pass, PASSWORD_DEFAULT);
                    mysqli_query($conn, "UPDATE data_admin SET password_admin = '$new_hash' WHERE id_admin = '$id_admin'");
                }
            }
            // 2. Fallback: Cek plain text (untuk password lama yang belum di-hash)
            else if ($stored_password === $pass) {
                $login_success = true;
                // Langsung upgrade password ke hash untuk keamanan
                $new_hash = password_hash($pass, PASSWORD_DEFAULT);
                mysqli_query($conn, "UPDATE data_admin SET password_admin = '$new_hash' WHERE id_admin = '$id_admin'");
            }

            if ($login_success) {
                // Login berhasil
            $_SESSION['admin'] = 'admin';
                $_SESSION['id_admin'] = $id_admin;
            echo "<script>alert('Berhasil Login');location.href='index.php';</script>";
                exit();
            }
        }
        
        // Jika username tidak ditemukan atau password salah
        echo "<script>alert('Username atau password salah');history.back();</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        Badminton Smapul Club
    </title>
    <link rel="icon" href="assets/images/logo-bsc.ico" type="image/x-icon" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
        }
    </script>
</head>

<body class="transition-colors duration-700 bg-gray-100 dark:bg-gradient-to-br dark:from-slate-900 dark:to-gray-800 min-h-screen flex items-center justify-center">

    <!-- Toggle Button -->
    <button onclick="document.documentElement.classList.toggle('dark')" class="absolute top-4 right-4 p-2 bg-white dark:bg-slate-700 rounded-full shadow">
        ⚙️
    </button>

    <!-- Login Card -->
    <div class="bg-white dark:bg-slate-800 shadow-2xl rounded-2xl px-10 py-8 w-full max-w-md transition-all duration-500 border-t-4 border-blue-600 dark:border-blue-500">
        <div class="text-center mb-6">
            <img src="assets/images/logo-bsc.png" alt="Logo" class="mx-auto w-16 mb-2">
            <h1 class="text-lg font-bold text-blue-600 dark:text-blue-400 tracking-wide">BADMINTON SMAPUL CLUB</h1>
            <p class="text-xl font-semibold text-gray-700 dark:text-gray-300 mt-2">Login Administrator</p>
        </div>
        <form method="post" action="">
            <div class="mb-4">
                <input type="text" name="username" placeholder="Username Admin" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-slate-700 dark:border-slate-600 dark:text-white">
            </div>
            <div class="mb-6">
                <input type="password" name="password" placeholder="Password" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-slate-700 dark:border-slate-600 dark:text-white">
            </div>
            <button type="submit" name="login" class="w-full py-2 rounded-lg bg-gradient-to-r from-blue-500 to-blue-700 hover:opacity-90 text-white font-semibold transition duration-300">
                SIGN IN
            </button>
        </form>

        <p class="text-center text-gray-500 dark:text-gray-400 mt-4 text-sm">
            © 2025 Badminton Smapul Club
        </p>
    </div>

</body>

</html>