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

// Mengambil semua data admin untuk ditampilkan dalam tabel
$admins_sql = "SELECT * FROM admin";
$admins_result = $conn->query($admins_sql);
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Admin - PerpusGratis</title>
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
        .table th, .table td {
            vertical-align: middle;
        }
        .table img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            border: 3px solid #fff;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }
        .btn {
            font-size: 0.9rem;
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
            <h1>Data Admin</h1>
            <!-- Tombol untuk menambah admin -->
            <a href="tambahadmin.php" class="btn btn-success mb-3">Tambah Admin</a>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Foto</th>
                        <th>Nama Admin</th>
                        <th>Username Admin</th>
                        <th>Password</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($admins_result->num_rows > 0) {
                        $no = 1;
                        while ($admin_data = $admins_result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>$no</td>";
                            echo "<td><img src='img/admin/{$admin_data['foto_admin']}' alt='Foto Admin'></td>";
                            echo "<td>{$admin_data['nama_admin']}</td>";
                            echo "<td>{$admin_data['username']}</td>";
                            echo "<td>{$admin_data['password']}</td>";                         
                            echo "<td>
                                    <a href='editadmin.php?id_admin={$admin_data['id_admin']}' class='btn btn-primary btn-sm'>Edit</a>
                                    <a href='hapusadmin.php?id_admin={$admin_data['id_admin']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Yakin ingin menghapus admin?\")'>Hapus</a>
                                  </td>";
                            echo "</tr>";
                            $no++;
                        }
                    } else {
                        echo "<tr><td colspan='5'>Tidak ada data admin</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
