<?php
require_once 'koneksi.php';
session_start();

if (isset($_POST['submit'])) {
    $no_whatsapp = clean_input($_POST['no_whatsapp']);
    $nama = clean_input($_POST['nama']);
    $tempat_lahir = clean_input($_POST['tempat_lahir']);
    $tanggal_lahir = clean_input($_POST['tanggal_lahir']);
    $jenis_kelamin = clean_input($_POST['jenis_kelamin']);
    $kelas = clean_input($_POST['kelas']);
    $alasan_masuk = clean_input($_POST['alasan']);

    // Menggunakan tanggal saat ini untuk tanggal_daftar dan tanggal_masuk
    $tanggal_daftar = date('Y-m-d');

    // Memastikan 'tanggal_masuk' diisi untuk memenuhi aturan database
    $query = "INSERT INTO data_siswa (
        no_whatsapp, 
        nama, 
        tempat_lahir, 
        tanggal_lahir, 
        tanggal_daftar, 
        tanggal_masuk,
        jenis_kelamin, 
        kelas, 
        alasan_masuk
    ) VALUES (
        '$no_whatsapp', 
        '$nama', 
        '$tempat_lahir', 
        '$tanggal_lahir', 
        '$tanggal_daftar', 
        '$tanggal_daftar',
        '$jenis_kelamin', 
        '$kelas', 
        '$alasan_masuk'
    )";

    if (mysqli_query($conn, $query)) {
        echo "<script>
                alert('Pendaftaran berhasil! Status Anda sekarang \"Pending\" dan akan segera ditinjau oleh Admin.');
                window.location.href = 'index.php';
              </script>";
    } else {
        echo "<script>
                alert('Error: " . mysqli_error($conn) . "');
              </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Pendaftaran BSC</title>
    <link rel="icon" href="/assets/images/logo-bsc.ico" type="image/x-icon" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-br from-blue-100 via-white to-blue-200 min-h-screen flex items-center justify-center">

    <div class="bg-white shadow-xl rounded-2xl max-w-2xl w-full p-8">
        <div class="text-center mb-6">
            <h2 class="text-3xl font-extrabold text-blue-600 tracking-tight">Formulir Pendaftaran BSC</h2>
            <p class="text-sm text-gray-500 mt-1">Silakan isi data lengkap di bawah ini</p>
        </div>

        <form method="POST" action="" onsubmit="return validateForm()" class="space-y-5">
            <!-- WhatsApp -->
            <div>
                <label for="no_whatsapp" class="block text-sm font-semibold text-gray-600">Nomor WhatsApp</label>
                <input type="text" id="no_whatsapp" name="no_whatsapp" placeholder="08xxxxxxxxxx"
                    class="w-full px-4 py-2 mt-1 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>

            <!-- Nama -->
            <div>
                <label for="nama" class="block text-sm font-semibold text-gray-600">Nama Lengkap</label>
                <input type="text" id="nama" name="nama" placeholder="Nama lengkap"
                    class="w-full px-4 py-2 mt-1 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>

            <!-- Tempat Lahir -->
            <div>
                <label for="tempat_lahir" class="block text-sm font-semibold text-gray-600">Tempat Lahir</label>
                <input type="text" id="tempat_lahir" name="tempat_lahir" placeholder="Contoh: Makassar"
                    class="w-full px-4 py-2 mt-1 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>

            <!-- Tanggal Lahir -->
            <div>
                <label for="tanggal_lahir" class="block text-sm font-semibold text-gray-600">Tanggal Lahir</label>
                <input type="date" id="tanggal_lahir" name="tanggal_lahir"
                    class="w-full px-4 py-2 mt-1 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>

            <!-- Jenis Kelamin -->
            <div>
                <label for="jenis_kelamin" class="block text-sm font-semibold text-gray-600">Jenis Kelamin</label>
                <select id="jenis_kelamin" name="jenis_kelamin"
                    class="w-full px-4 py-2 mt-1 border border-gray-300 rounded-lg shadow-sm bg-white focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Pilih Jenis Kelamin</option>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>

            <!-- Kelas -->
            <div>
                <label for="kelas" class="block text-sm font-semibold text-gray-600">Kelas</label>
                <input type="text" id="kelas" name="kelas"
                    placeholder="Contoh: X IPA 5"
                    class="w-full px-4 py-2 mt-1 border border-gray-300 rounded-lg shadow-sm bg-white focus:ring-blue-500 focus:border-blue-500" required>
            </div>

            <!-- Alasan Masuk -->
            <div>
                <label for="alasan" class="block text-sm font-semibold text-gray-600">Alasan Masuk BSC</label>
                <textarea id="alasan" name="alasan" rows="4" placeholder="Tulis alasan kamu di sini..."
                    class="w-full px-4 py-2 mt-1 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"></textarea>
            </div>

            <!-- Tombol Submit -->
            <div>
                <button type="submit" name="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 rounded-lg transition-all duration-200 shadow-md">
                    Kirim
                </button>
            </div>
        </form>
    </div>

    <script>
        function validateForm() {
            const no_whatsapp = document.getElementById('no_whatsapp').value.trim();
            const nama = document.getElementById('nama').value.trim();
            const tempat_lahir = document.getElementById('tempat_lahir').value.trim();
            const tanggal_lahir = document.getElementById('tanggal_lahir').value;
            const alasan = document.getElementById('alasan').value.trim();

            if (!/^\d+$/.test(no_whatsapp)) {
                alert('Nomor WhatsApp hanya boleh berisi angka!');
                return false;
            }

            if (nama.length < 3) {
                alert('Nama harus minimal 3 karakter!');
                return false;
            }

            if (tempat_lahir.length < 3) {
                alert('Tempat lahir harus minimal 3 karakter!');
                return false;
            }

            const today = new Date();
            const birthDate = new Date(tanggal_lahir);
            if (birthDate > today) {
                alert('Tanggal lahir tidak boleh di masa depan!');
                return false;
            }

            if (alasan.length < 10) {
                alert('Alasan masuk BSC harus minimal 10 karakter!');
                return false;
            }

            return true;
        }
    </script>

</body>

</html>