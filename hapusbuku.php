<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['id_admin'])) {
    die("Session id_admin tidak ditemukan.");
}

$id_admin = $_SESSION['id_admin']; 
$admin_sql = "SELECT * FROM admin WHERE id_admin = '$id_admin'";
$admin_result = $conn->query($admin_sql);
$admin = $admin_result->fetch_assoc();

if (!isset($_GET['id_buku'])) {
    die("ID Buku tidak ditemukan.");
}

$id_buku = $_GET['id_buku'];

$buku_sql = "SELECT * FROM buku WHERE id_buku = '$id_buku'";
$buku_result = $conn->query($buku_sql);
if ($buku_result->num_rows == 0) {
    die("Buku tidak ditemukan.");
}

$buku_data = $buku_result->fetch_assoc();


$foto_buku_path = 'img/buku/' . $buku_data['foto'];
$pdf_buku_path = 'pdf/' . $buku_data['pdf'];

if (file_exists($foto_buku_path)) {
    unlink($foto_buku_path);
}

if (file_exists($pdf_buku_path)) {
    unlink($pdf_buku_path);
}

$delete_sql = "DELETE FROM buku WHERE id_buku = '$id_buku'";

if ($conn->query($delete_sql) === TRUE) {
    echo "<script>alert('Buku berhasil dihapus!'); window.location.href = 'koleksi.php';</script>";
} else {
    echo "<script>alert('Terjadi kesalahan: " . $conn->error . "'); window.location.href = 'koleksi.php';</script>";
}
?>
