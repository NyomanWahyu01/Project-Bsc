<?php
require 'vendor/autoload.php'; // PhpSpreadsheet
require 'koneksi.php'; // Koneksi ke database

use PhpOffice\PhpSpreadsheet\IOFactory;

if (isset($_POST['import'])) {
    $file = $_FILES['file_excel']['tmp_name'];

    // Validasi file ada
    if (!file_exists($file)) {
        echo "<script>alert('File tidak ditemukan!'); window.location='data_siswa.php';</script>";
        exit;
    }

    // Baca isi Excel
    $spreadsheet = IOFactory::load($file);
    $sheet = $spreadsheet->getActiveSheet()->toArray();

    $jumlah_berhasil = 0;

    // Lewati baris pertama jika berisi header
    for ($i = 1; $i < count($sheet); $i++) {
        $no_wa        = mysqli_real_escape_string($conn, $sheet[$i][0]);
        $nama         = mysqli_real_escape_string($conn, $sheet[$i][1]);
        $tempat       = mysqli_real_escape_string($conn, $sheet[$i][2]);
        $tgl_lahir    = date('Y-m-d', strtotime($sheet[$i][3])); // Format YYYY-MM-DD
        $jenis_kelamin       = mysqli_real_escape_string($conn, $sheet[$i][4]);
        $kelas        = mysqli_real_escape_string($conn, $sheet[$i][5]);
        $alasan       = mysqli_real_escape_string($conn, $sheet[$i][6]);
        $tanggal_masuk = date('Y-m-d'); // auto isi tanggal hari ini

        $query = "INSERT INTO data_siswa 
        (no_whatsapp, nama, tempat_lahir, tanggal_lahir, tanggal_masuk, jenis_kelamin, kelas, alasan_masuk)
        VALUES 
        ('$no_wa', '$nama', '$tempat', '$tgl_lahir', '$tanggal_masuk', '$jenis_kelamin', '$kelas', '$alasan')";

        if (mysqli_query($conn, $query)) {
            $jumlah_berhasil++;
        }
    }

    echo "<script>alert('Import berhasil! Data masuk: $jumlah_berhasil siswa'); window.location='data_siswa.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Import Data Siswa - BSC SMAPUL</title>
    <link rel="icon" href="assets/images/logo-bsc.ico" type="image/x-icon" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body class="bg-light">

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">🧾 Import Data Siswa dari Excel</h5>
                    </div>
                    <div class="card-body">
                        <form action="import_excel.php" method="POST" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="file_excel" class="form-label">Pilih File Excel (.xlsx atau .xls)</label>
                                <input type="file" class="form-control" name="file_excel" id="file_excel" accept=".xlsx,.xls" required>
                            </div>
                            <div class="text-end">
                                <button type="submit" name="import" class="btn btn-success">
                                    <i class="bi bi-upload"></i> Import Sekarang
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer small text-muted">
                        Pastikan file Excel sesuai urutan: <strong>No WA, Nama, Tempat Lahir, Tgl Lahir, Jenis Kelamin, Kelas, Alasan Masuk</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Optional Bootstrap Icons (for button icons) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

</body>

</html>