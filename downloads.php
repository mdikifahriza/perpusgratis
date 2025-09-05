<?php
session_start();
include "koneksi.php";

$conn = new mysqli($server, $username, $password, $database);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if (isset($_GET['id_buku']) && preg_match('/^\d+$/', $_GET['id_buku'])) {
    $id_buku = $_GET['id_buku'];

    // Update downloads count
    $stmt = $conn->prepare("UPDATE buku SET downloads = downloads + 1 WHERE id_buku = ?");
    $stmt->bind_param("i", $id_buku);
    $stmt->execute();
    $stmt->close();

    // Ambil nama file PDF dan judul buku
    $stmt = $conn->prepare("SELECT pdf, judul_buku FROM buku WHERE id_buku = ?");
    $stmt->bind_param("i", $id_buku);
    $stmt->execute();
    $stmt->bind_result($pdf, $judul_buku);
    $stmt->fetch();
    $stmt->close();

    if ($pdf && $judul_buku) {
        $file = 'pdf/' . $pdf;
        if (file_exists($file)) {
            // Bersihkan judul dari karakter yang tidak cocok untuk nama file
            $judul_bersih = preg_replace('/[^A-Za-z0-9_\-]/', '_', $judul_buku);
            $nama_file_download = "PerpusGratis-" . $judul_bersih . ".pdf";

            header('Content-Description: File Transfer');
            header('Content-Type: application/pdf');
            header('Content-Disposition: attachment; filename="' . $nama_file_download . '"');
            header('Content-Length: ' . filesize($file));
            flush();
            readfile($file);
            exit;
        } else {
            echo "File tidak ditemukan.";
        }
    } else {
        echo "Data buku tidak ditemukan.";
    }
} else {
    echo "ID Buku tidak valid.";
}

$conn->close();
?>
