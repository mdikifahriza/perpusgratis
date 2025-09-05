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

// Mengambil semua data buku untuk ditampilkan dalam tabel
$buku_sql = "SELECT * FROM buku";
$buku_result = $conn->query($buku_sql);
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Koleksi Buku - PerpusGratis</title>
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
            <h1>Koleksi Buku</h1>
            <!-- Tombol untuk menambah buku -->
            <a href="tambahbuku.php" class="btn btn-success mb-3">Tambah Buku</a>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Foto Buku</th>
                        <th>Judul</th>
                        <th>Pengarang</th>
                        <th>Penerbit</th>
                        <th>Tahun Terbit</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($buku_result->num_rows > 0) {
                        $no = 1;
                        while ($buku_data = $buku_result->fetch_assoc()) {
                            $foto_buku = 'img/buku/' . $buku_data['foto']; // Path foto buku
                            echo "<tr>";
                            echo "<td>$no</td>";
                            // Foto buku dengan modal
                            echo "<td><img src='$foto_buku' alt='Foto Buku' data-bs-toggle='modal' data-bs-target='#fotoModal$no'></td>";
                            echo "<td>{$buku_data['judul_buku']}</td>";
                            echo "<td>{$buku_data['pengarang']}</td>";
                            echo "<td>{$buku_data['penerbit']}</td>";
                            echo "<td>{$buku_data['tahun_terbit']}</td>";
                            echo "<td>
                                    <a href='editbuku.php?id_buku={$buku_data['id_buku']}' class='btn btn-primary btn-sm'>Edit</a>
                                    <a href='hapusbuku.php?id_buku={$buku_data['id_buku']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Yakin ingin menghapus buku?\")'>Hapus</a>
                                  </td>";
                            echo "</tr>";
                            // Modal untuk menampilkan foto
                            echo "
                            <div class='modal fade' id='fotoModal$no' tabindex='-1' aria-labelleconny='fotoModalLabel$no' aria-hidden='true'>
                                <div class='modal-dialog modal-dialog-centered'>
                                    <div class='modal-content'>
                                        <div class='modal-header'>
                                            <h5 class='modal-title' id='fotoModalLabel$no'>Foto Buku: {$buku_data['judul_buku']}</h5>
                                            <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                        </div>
                                        <div class='modal-body'>
                                            <img src='$foto_buku' alt='Foto Buku' class='img-fluid'>
                                        </div>
                                    </div>
                                </div>
                            </div>";
                            $no++;
                        }
                    } else {
                        echo "<tr><td colspan='7'>Tidak ada data buku</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
