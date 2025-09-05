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

// Mengambil semua data kategori untuk ditampilkan dalam tabel
$kategori_sql = "SELECT kategori.id_kategori, kategori.kategori, GROUP_CONCAT(buku.judul_buku SEPARATOR ', ') AS daftar_buku
                 FROM kategori
                 LEFT JOIN buku ON kategori.id_kategori = buku.id_kategori
                 GROUP BY kategori.id_kategori, kategori.kategori
                 ORDER BY kategori.id_kategori;";
$kategori_result = $conn->query($kategori_sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Koleksi kategori - PerpusGratis</title>
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
        .table th, .table td {
            vertical-align: middle;
        }
        .btn {
            font-size: 0.9rem;
        }
        .table img {
            width: 50px;
            height: 50px;
            border-radius: 5px;
            object-fit: cover;
            cursor: pointer;
            transition: transform 0.3s ease;
        }
        .table img:hover {
            transform: scale(1.1);
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
            <h1>Koleksi kategori</h1>
            <!-- Tombol untuk menambah kategori -->
            <a href="tambahkategori.php" class="btn btn-success mb-3">Tambah kategori</a>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kategori</th>
                        <th>Buku Terkait</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($kategori_result->num_rows > 0) {
                        $no = 1;
                        while ($kategori_data = $kategori_result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>$no</td>";
                            echo "<td>{$kategori_data['kategori']}</td>";
                            echo "<td>{$kategori_data['daftar_buku']}</td>";
                            echo "<td>
                                    <a href='editkategori.php?id_kategori={$kategori_data['id_kategori']}' class='btn btn-primary btn-sm'>Edit</a>
                                    <a href='hapuskategori.php?id_kategori={$kategori_data['id_kategori']}' class='btn btn-danger btn-sm' onclick='return confirmDelete()'>Hapus</a>
                                  </td>";
                            echo "</tr>";
                            $no++;
                        }
                    } else {
                        echo "<tr><td colspan='5'>Tidak ada data kategori</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        function confirmDelete() {
            return confirm("Menghapus kategori ini akan menghapus semua buku yang terkait dengan kategori tersebut. Apakah Anda yakin?");
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
