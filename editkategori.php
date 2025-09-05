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

// Mendapatkan id_kategori dari URL
$id_kategori = $_GET['id_kategori'];

// Mengambil data kategori berdasarkan id_kategori
$kategori_sql = "SELECT * FROM kategori WHERE id_kategori = '$id_kategori'";
$kategori_result = $conn->query($kategori_sql);
$kategori = $kategori_result->fetch_assoc();

// Proses form edit kategori
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $kategori_baru = $_POST['kategori'];
    
    if (!empty($kategori_baru)) {
        $update_sql = "UPDATE kategori SET kategori = '$kategori_baru' WHERE id_kategori = '$id_kategori'";
        if ($conn->query($update_sql) === TRUE) {
            echo "<script>alert('Kategori berhasil diperbarui.'); window.location.href='datakategori.php';</script>";
        } else {
            echo "<script>alert('Gagal memperbarui kategori.');</script>";
        }
    } else {
        echo "<script>alert('Nama kategori tidak boleh kosong.');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Kategori - PerpusGratis</title>
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
        .form-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
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
            <h1>Edit Kategori</h1>
            <div class="form-container">
                <form action="editkategori.php?id_kategori=<?php echo $id_kategori; ?>" method="POST">
                    <div class="mb-3">
                        <label for="kategori" class="form-label">Nama Kategori</label>
                        <input type="text" name="kategori" class="form-control" id="kategori" value="<?php echo $kategori['kategori']; ?>" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    <a href="datakategori.php" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
