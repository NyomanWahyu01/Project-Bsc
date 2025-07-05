<?php
session_start();
if ($_SESSION['role'] != 'pengurus') {
    echo "Akses ditolak!";
    exit;
}
