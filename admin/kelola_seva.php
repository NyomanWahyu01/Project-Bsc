<?php
session_start();
if ($_SESSION['role'] != 'admin') {
    echo "Akses ditolak!";
    exit;
}
