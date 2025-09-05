<?php
session_start();
include "koneksi.php"; // Menambahkan include koneksi.php

// Periksa apakah session id_admin telah diatur
if (!isset($_SESSION['id_admin'])) {
    die("Session id_admin tidak ditemukan.");
}

// Periksa apakah ada parameter id_admin yang diterima dari URL
if (!isset($_GET['id_admin'])) {
    die("ID Admin tidak ditemukan.");
}

$id_admin = $_GET['id_admin'];
$login_id_admin = $_SESSION['id_admin']; // ID admin yang sedang login

if ($id_admin == $login_id_admin) {
    echo "<script>
            alert('Anda tidak dapat menghapus diri sendiri.');
            window.history.back();
          </script>";
    exit; // Hentikan eksekusi lebih lanjut setelah menampilkan pesan
}

// Mengambil data admin berdasarkan id_admin
$admin_sql = "SELECT * FROM admin WHERE id_admin = '$id_admin'";
$admin_result = $conn->query($admin_sql);
if ($admin_result->num_rows == 0) {
    die("Admin tidak ditemukan.");
}
$admin = $admin_result->fetch_assoc();

// Menghapus foto admin jika ada
if ($admin['foto_admin'] != '') {
    $foto_path = "img/admin/" . $admin['foto_admin'];
    if (file_exists($foto_path)) {
        unlink($foto_path); // Menghapus file foto
    }
}

// Menghapus data admin dari database
$hapus_sql = "DELETE FROM admin WHERE id_admin = '$id_admin'";

if ($conn->query($hapus_sql)) {
    // Redirect ke halaman dataadmin.php setelah berhasil menghapus
    header("Location: dataadmin.php");
    exit();
} else {
    // Jika terjadi kesalahan
    die("Terjadi kesalahan saat menghapus data admin.");
}
?>
