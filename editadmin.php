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

// Mengambil data admin berdasarkan id_admin
$admin_sql = "SELECT * FROM admin WHERE id_admin = ?";
$stmt = $conn->prepare($admin_sql);
$stmt->bind_param("s", $id_admin);
$stmt->execute();
$admin_result = $stmt->get_result();

if ($admin_result->num_rows == 0) {
    die("Admin tidak ditemukan.");
}

$admin = $admin_result->fetch_assoc();

// Proses update data admin
if (isset($_POST['update'])) {
    $nama_admin = $_POST['nama_admin'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $foto_admin = $_FILES['foto_admin'];

    if ($foto_admin['name'] != "") {
        $foto_admin_name = time() . "_" . basename($foto_admin['name']);
        $target_dir = "img/admin/";
        $target_file = $target_dir . $foto_admin_name;
        $image_file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
        if (in_array($image_file_type, $allowed_types)) {
            move_uploaded_file($foto_admin['tmp_name'], $target_file);
            $update_sql = "UPDATE admin SET nama_admin = ?, username = ?, password = ?, foto_admin = ? WHERE id_admin = ?";
            $stmt = $conn->prepare($update_sql);
            $stmt->bind_param("sssss", $nama_admin, $username, $password, $foto_admin_name, $id_admin);
        } else {
            echo "<script>alert('Format foto tidak diperbolehkan!');</script>";
            exit();
        }
    } else {
        // Jika foto tidak diubah, update hanya data lainnya
        $update_sql = "UPDATE admin SET nama_admin = ?, username = ?, password = ? WHERE id_admin = ?";
        $stmt = $conn->prepare($update_sql);
        $stmt->bind_param("ssss", $nama_admin, $username, $password, $id_admin);
    }

    if ($stmt->execute()) {
        echo "<script>alert('Data admin berhasil diperbarui.'); window.location.href = 'dataadmin.php';</script>";
    } else {
        echo "<script>alert('Terjadi kesalahan saat memperbarui data.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Admin - PerpusGratis</title>
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
        .form-group {
            margin-bottom: 20px;
        }
        .btn-warning {
            background-color: #ffc107;
            border: none;
            padding: 10px 20px;
            color: white;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .btn-warning:hover {
            background-color: #e0a800;
        }
        .btn-secondary {
            background-color: #6c757d;
            border: none;
            padding: 10px 20px;
            color: white;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .btn-secondary:hover {
            background-color: #5a6268;
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
            <h1>Edit Admin</h1>
            <form method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="nama_admin">Nama Admin</label>
                    <input type="text" name="nama_admin" id="nama_admin" class="form-control" value="<?php echo $admin['nama_admin']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" class="form-control" value="<?php echo $admin['username']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control" value="<?php echo $admin['password']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="foto_admin">Foto Admin</label>
                    <input type="file" name="foto_admin" id="foto_admin" class="form-control">
                    <small class="form-text text-muted">Biarkan kosong jika tidak ingin mengganti foto.</small>
                </div>
                <div class="form-group">
                    <button type="submit" name="update" class="btn-warning">Perbarui</button>
                    <a href="dataadmin.php" class="btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
