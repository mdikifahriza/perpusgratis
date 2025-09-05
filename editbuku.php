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

// Periksa apakah id_buku ada di URL
if (!isset($_GET['id_buku'])) {
    die("ID Buku tidak ditemukan.");
}

$id_buku = $_GET['id_buku'];

// Mengambil data buku berdasarkan id_buku
$buku_sql = "SELECT * FROM buku WHERE id_buku = '$id_buku'";
$buku_result = $conn->query($buku_sql);
if ($buku_result->num_rows == 0) {
    die("Buku tidak ditemukan.");
}

$options_kategori = '';
try {
    $pdo = new PDO("mysql:host=$server;dbname=$database", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->query("SELECT id_kategori, kategori FROM kategori ORDER BY kategori ASC");
    
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $options_kategori .= '<option value="' . $row['id_kategori'] . '">' . $row['kategori'] . '</option>';
    }
} catch (PDOException $e) {
    echo 'Koneksi gagal: ' . $e->getMessage();
}

$buku_data = $buku_result->fetch_assoc();

// Proses untuk mengupdate data buku
if (isset($_POST['submit'])) {
    // Mendapatkan data form
    $id_kategori = $_POST['id_kategori'];
    $judul_buku = $_POST['judul_buku'];
    $pengarang = $_POST['pengarang'];
    $penerbit = $_POST['penerbit'];
    $tahun_terbit = $_POST['tahun_terbit'];
    $tebal_buku = $_POST['tebal_buku'];
    $ukuran_buku = $_POST['ukuran_buku'];
    $isbn = $_POST['isbn'];
    $hak_cipta = $_POST['hak_cipta'];
    $deskripsi = $_POST['deskripsi'];

    // Proses upload foto
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        $file_ext = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
        $foto = uniqid('foto_', true) . '.' . $file_ext;
        $foto_tmp = $_FILES['foto']['tmp_name'];
        $foto_path = 'img/buku/' . $foto;
        
        // Hapus foto lama jika ada
        if (file_exists('img/buku/' . $buku_data['foto'])) {
            unlink('img/buku/' . $buku_data['foto']);
        }
        
        move_uploaded_file($foto_tmp, $foto_path);
    } else {
        $foto = $buku_data['foto']; // Jika tidak ada foto baru, tetap pakai foto lama
    }

    // Proses upload file PDF
    if (isset($_FILES['pdf']) && $_FILES['pdf']['error'] == 0) {
        $pdf_ext = pathinfo($_FILES['pdf']['name'], PATHINFO_EXTENSION);
        $pdf = uniqid('pdf_', true) . '.' . $pdf_ext;
        $pdf_tmp = $_FILES['pdf']['tmp_name'];
        $pdf_path = 'pdf/' . $pdf;
        
        // Hapus PDF lama jika ada
        if (file_exists('pdf/' . $buku_data['pdf'])) {
            unlink('pdf/' . $buku_data['pdf']);
        }
        
        move_uploaded_file($pdf_tmp, $pdf_path);
    } else {
        $pdf = $buku_data['pdf']; // Jika tidak ada file PDF baru, tetap pakai file lama
    }

    // Update data buku ke database
    $update_sql = "UPDATE buku SET 
                    id_kategori = '$id_kategori', 
                    judul_buku = '$judul_buku',
                    pengarang = '$pengarang',
                    penerbit = '$penerbit',
                    tahun_terbit = '$tahun_terbit',
                    tebal_buku = '$tebal_buku',
                    ukuran_buku = '$ukuran_buku',
                    isbn = '$isbn',
                    hak_cipta = '$hak_cipta',
                    deskripsi = '$deskripsi',
                    foto = '$foto',
                    pdf = '$pdf' 
                   WHERE id_buku = '$id_buku'";

    if ($conn->query($update_sql) === TRUE) {
        echo "<script>alert('Buku berhasil diperbarui!'); window.location.href = 'koleksi.php';</script>";
    } else {
        echo "<script>alert('Terjadi kesalahan: " . $conn->error . "');</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Buku - PerpusGratis</title>
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
        .form-label {
            font-weight: bold;
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
            <h1>Edit Buku</h1>
            <form action="editbuku.php?id_buku=<?php echo $id_buku; ?>" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="id_kategori" class="form-label">Kategori</label>
                    <select class="form-control" id="id_kategori" name="id_kategori" required>
                        <?php echo $options_kategori; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="judul_buku" class="form-label">Judul Buku</label>
                    <input type="text" class="form-control" id="judul_buku" name="judul_buku" value="<?php echo $buku_data['judul_buku']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="pengarang" class="form-label">Pengarang</label>
                    <input type="text" class="form-control" id="pengarang" name="pengarang" value="<?php echo $buku_data['pengarang']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="penerbit" class="form-label">Penerbit</label>
                    <input type="text" class="form-control" id="penerbit" name="penerbit" value="<?php echo $buku_data['penerbit']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="tahun_terbit" class="form-label">Tahun Terbit</label>
                    <input type="number" class="form-control" id="tahun_terbit" name="tahun_terbit" value="<?php echo $buku_data['tahun_terbit']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="tebal_buku" class="form-label">Tebal Buku</label>
                    <input type="text" class="form-control" id="tebal_buku" name="tebal_buku" value="<?php echo $buku_data['tebal_buku']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="ukuran_buku" class="form-label">Ukuran Buku</label>
                    <input type="text" class="form-control" id="ukuran_buku" name="ukuran_buku" value="<?php echo $buku_data['ukuran_buku']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="isbn" class="form-label">ISBN</label>
                    <input type="text" class="form-control" id="isbn" name="isbn" value="<?php echo $buku_data['isbn']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="hak_cipta" class="form-label">Hak Cipta</label>
                    <input type="text" class="form-control" id="hak_cipta" name="hak_cipta" value="<?php echo $buku_data['hak_cipta']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required><?php echo $buku_data['deskripsi']; ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="foto" class="form-label">Foto Buku</label>
                    <input type="file" class="form-control" id="foto" name="foto" accept="img/buku/">
                    <img src="img/buku/<?php echo $buku_data['foto']; ?>" alt="Foto Buku" width="100" class="mt-2">
                </div>
                <div class="mb-3">
                    <label for="pdf" class="form-label">PDF Buku (opsional)</label>
                    <input type="file" class="form-control" id="pdf" name="pdf" accept="application/pdf">
                    <?php if ($buku_data['pdf']): ?>
                        <a href="pdf/<?php echo $buku_data['pdf']; ?>" target="_blank">Lihat PDF Buku</a>
                    <?php endif; ?>
                </div>
                <button type="submit" name="submit" class="btn btn-success">Update Buku</button>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
