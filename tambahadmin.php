<?php 
session_start();
include "koneksi.php"; // Menambahkan include koneksi.php

// Periksa apakah admin yang sedang login adalah admin yang sah
if (!isset($_SESSION['id_admin'])) {
    die("Session id_admin tidak ditemukan.");
}

// Mengambil data admin
$id_admin = $_SESSION['id_admin']; 
$admin_sql = "SELECT * FROM admin WHERE id_admin = '$id_admin'";
$admin_result = $conn->query($admin_sql);
$admin = $admin_result->fetch_assoc();

// Proses jika form dit-submit
if (isset($_POST['tambah_admin'])) {
    // Ambil data dari form
    $nama_admin = $_POST['nama_admin'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $foto_admin = $_FILES['foto_admin'];

    if (empty($nama_admin) || empty($username) || empty($password)) {
        echo "<script>alert('Semua kolom harus diisi!');</script>";
    } else {
        if ($foto_admin['error'] == 0) {
            $foto_admin_name = time() . "_" . basename($foto_admin['name']);
            $target_dir = "img/admin/";
            $target_file = $target_dir . $foto_admin_name;
            $image_file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
            if (!in_array($image_file_type, $allowed_types)) {
                echo "<script>alert('Format foto tidak diperbolehkan!');</script>";
            } else {
                if (move_uploaded_file($foto_admin['tmp_name'], $target_file)) {
                    $insert_sql = "INSERT INTO admin (nama_admin, username, password, foto_admin) 
                                   VALUES ('$nama_admin', '$username', '$password', '$foto_admin_name')";

                    if ($conn->query($insert_sql)) {
                        echo "<script>alert('Admin berhasil ditambahkan!'); window.location.href = 'dataadmin.php';</script>";
                    } else {
                        echo "<script>alert('Terjadi kesalahan saat menambahkan admin!');</script>";
                    }
                } else {
                    echo "<script>alert('Gagal mengupload foto!');</script>";
                }
            }
        } else {
            $insert_sql = "INSERT INTO admin (nama_admin, username, password) 
                           VALUES ('$nama_admin', '$username', '$password')";

            if ($conn->query($insert_sql)) {
                echo "<script>alert('Admin berhasil ditambahkan!'); window.location.href = 'dataadmin.php';</script>";
            } else {
                echo "<script>alert('Terjadi kesalahan saat menambahkan admin!');</script>";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Admin - PerpusGratis</title>
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
            <h1>Tambah Admin Baru</h1>
            <form action="tambahadmin.php" method="POST" enctype="multipart/form-data">
                <div class="form-group mb-3">
                    <label for="nama_admin">Nama Admin</label>
                    <input type="text" class="form-control" id="nama_admin" name="nama_admin" required>
                </div>
                <div class="form-group mb-3">
                    <label for="username">Username Admin</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="form-group mb-3">
                    <label for="password">Password Admin</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="form-group mb-3">
                    <label for="foto_admin">Foto Admin</label>
                    <input type="file" class="form-control" id="foto_admin" name="foto_admin" accept="image/*">
                </div>
                <button type="submit" name="tambah_admin" class="btn btn-primary">Tambah Admin</button>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
