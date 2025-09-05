<?php
session_start();
include "koneksi.php"; // Menambahkan include koneksi.php

// Periksa apakah session id_admin telah diatur
if (!isset($_SESSION['id_admin'])) {
    die("Session id_admin tidak ditemukan.");
}

// Mendapatkan id_kategori dari URL
$id_kategori = $_GET['id_kategori'];

if (!empty($id_kategori)) {
    // Mengambil semua buku terkait kategori untuk mendapatkan file PDF dan gambar
    $select_files_sql = "SELECT pdf, foto FROM buku WHERE id_kategori = ?";
    $stmt = $conn->prepare($select_files_sql);
    $stmt->bind_param("s", $id_kategori);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        // Hapus file PDF
        $pdf_path = 'pdf/' . $row['pdf'];
        if (file_exists($pdf_path)) {
            unlink($pdf_path);
        }

        // Hapus file gambar
        $foto_path = 'img/buku/' . $row['foto'];
        if (file_exists($foto_path)) {
            unlink($foto_path);
        }
    }

    // Menghapus semua buku yang terkait dengan kategori tersebut
    $delete_buku_sql = "DELETE FROM buku WHERE id_kategori = ?";
    $stmt = $conn->prepare($delete_buku_sql);
    $stmt->bind_param("s", $id_kategori);
    $stmt->execute();

    // Menghapus kategori
    $delete_kategori_sql = "DELETE FROM kategori WHERE id_kategori = ?";
    $stmt = $conn->prepare($delete_kategori_sql);
    $stmt->bind_param("s", $id_kategori);
    if ($stmt->execute()) {
        echo "<script>alert('Kategori dan semua buku terkait berhasil dihapus.'); window.location.href='datakategori.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus kategori.'); window.location.href='datakategori.php';</script>";
    }
} else {
    echo "<script>alert('ID Kategori tidak ditemukan.'); window.location.href='datakategori.php';</script>";
}
?>
