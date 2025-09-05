<?php
session_start();
include "koneksi.php"; // Menambahkan include koneksi.php

// Periksa apakah session id_admin telah diatur
if (!isset($_SESSION['id_admin'])) {
    die("Session id_admin tidak ditemukan.");
}

// Mengambil data admin
$id_admin = $_SESSION['id_admin']; 
$admin_sql = "SELECT * FROM admin WHERE id_admin = '$id_admin'";
$admin_result = $conn->query($admin_sql);
$admin = $admin_result->fetch_assoc();

// Menghitung jumlah total buku
$buku_sql = "SELECT COUNT(*) AS total_buku FROM buku";
$buku_result = $conn->query($buku_sql);
$total_buku = $buku_result->fetch_assoc()['total_buku'];

// Menghitung jumlah total unduhan
$download_sql = "SELECT SUM(downloads) AS total_unduhan FROM buku";
$download_result = $conn->query($download_sql);
$total_unduhan = $download_result->fetch_assoc()['total_unduhan'];

$views_sql = "SELECT SUM(views) AS total_views FROM buku";
$views_result = $conn->query($views_sql);
$total_views = $views_result->fetch_assoc()['total_views'];

$kategori_sql = "SELECT count(kategori) AS total_kategori FROM kategori";
$kategori_result = $conn->query($kategori_sql);
$total_kategori = $kategori_result->fetch_assoc()['total_kategori'];

$kunjungan_sql = "SELECT kunjungan FROM trafik";
$result = $conn->query($kunjungan_sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $kunjungan_int = $row['kunjungan'];
        $kunjungan_str = strval($kunjungan_int);   
    }
} 

// Tidak perlu menutup koneksi di sini karena sudah ditangani oleh koneksi.php
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dasbor Admin - PerpusGratis</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f1f3f5;
            color: #495057;
        }
        .sidebar {
            height: 100vh;
            background-color: #343a40;
            padding-top: 20px;
            box-shadow: 4px 0 6px rgba(0, 0, 0, 0.1);
        }
        .sidebar a {
            color: #fff;
            display: block;
            padding: 15px 20px;
            text-decoration: none;
            font-size: 1.1rem;
            transition: background-color 0.3s ease;
        }
        .sidebar a:hover {
            background-color: #495057;
            border-radius: 5px;
        }
        .sidebar img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin-bottom: 15px;
            border: 3px solid #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            display: block;
            margin-left: auto;
            margin-right: auto;
        }
        .sidebar h4 {
            color: #fff;
            margin-top: 10px;
        }
        .dashboard-content {
            padding: 40px;
            flex-grow: 1;
        }
        .dashboard-content h1 {
            color: #343a40;
            margin-bottom: 30px;
        }
        .card {
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }
        .card-title {
            font-size: 1.3rem;
            font-weight: 600;
        }
        .card-text {
            font-size: 1.5rem;
            font-weight: 700;
            margin-top: 15px;
        }
        .bg-primary {
            background-color: #007bff !important;
        }
        .bg-success {
            background-color: #28a745 !important;
        }
        .bg-info {
            background-color: #17a2b8 !important;
        }
    </style>
</head>
<body>
    <div class="d-flex">
        <div class="sidebar d-flex flex-column align-items-center">
            <a href="profiladmin.php">
                <img src="img/admin/<?php echo $admin['foto_admin']; ?>" alt="Admin Photo">
                <h4 class="mt-2"><?php echo $admin['nama_admin']; ?></h4>
            </a>
            <a href="dasbor.php">Dasbor</a>
            <a href="dataadmin.php">Admin</a>
            <a href="datakategori.php">Kategori</a>
            <a href="koleksi.php">Koleksi</a>
            <a href="logout.php">Logout</a>
        </div>
        <div class="dashboard-content flex-grow-1">
            <h1>Dasbor Admin</h1>
            <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <h5 class="card-title">Total Buku</h5>
                    <p class="card-text"><?php echo $total_buku; ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card text-white bg-success">
                <div class="card-body">
                    <h5 class="card-title">Total Unduhan</h5>
                    <p class="card-text"><?php echo $total_unduhan; ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card text-white bg-info">
                <div class="card-body">
                    <h5 class="card-title">Total Kunjungan</h5>
                    <p class="card-text"><?php echo $kunjungan_str; ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card text-white bg-warning">
                <div class="card-body">
                    <h5 class="card-title">Total View</h5>
                    <p class="card-text"><?php echo $total_views; ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card text-white bg-danger">
                <div class="card-body">
                    <h5 class="card-title">Total Kategori</h5>
                    <p class="card-text"><?php echo $total_kategori; ?></p>
                </div>
            </div>
        </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
