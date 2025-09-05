<?php
session_start();
include "koneksi.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Daftar Buku - PerpusGratis</title>
  <meta name="description" content="Daftar Buku Perpustakaan Gratis">
  <meta name="keywords" content="free library, books, daftar buku">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Roboto', sans-serif;
      background: url('img/rak.jpeg') no-repeat center center fixed;
      background-size: cover;
      color: #fff;
      overflow-x: hidden;
    }
    .navbar {
      background-color: rgba(0, 0, 0, 0.8);
    }
    .navbar .nav-link {
      color: #fff;
      font-size: 16px;
    }
    .navbar .nav-link:hover {
      color: #ffcc00;
    }
    .container {
      background: rgba(0, 0, 0, 0.7);
      padding: 20px;
      border-radius: 10px;
    }
    .book-item {
      display: flex;
      margin-bottom: 20px;
      align-items: center;
    }
    .book-item img {
      width: 150px; /* Lebar gambar */
      height: 200px; /* Tinggi gambar */
      object-fit: cover; /* Memastikan gambar tidak terdistorsi */
      margin-right: 20px;
      border-radius: 5px;
      cursor: pointer; /* Mengindikasikan gambar bisa diklik */
      transition: transform 0.3s ease;
    }
    .book-item img:hover {
      transform: scale(1.2); /* Memperbesar gambar saat hover */
    }
    .book-details {
      color: #ffcc00;
      cursor: pointer; /* Mengindikasikan teks bisa diklik */
    }
    .book-details a {
      text-decoration: none;
      color: inherit;
    }
    .book-details a:hover {
      color: #fff;
    }
    footer {
      padding: 20px 0;
      background: rgba(0, 0, 0, 0.9);
      text-align: center;
    }
    footer p {
      margin: 0;
      color: #ffcc00;
    }
  </style>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
      <a class="navbar-brand" href="index.php">PerpusGratis</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="index.php">Beranda</a></li>
          <li class="nav-item"><a class="nav-link" href="search.php">Pencarian</a></li>      
          <li class="nav-item"><a class="nav-link" href="daftarbuku.php">Daftar Buku</a></li>
          <li class="nav-item"><a class="nav-link" href="biodata.html">Tentang</a></li>
          <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container mt-5">
    <h2 class="text-center mb-4">Daftar Buku</h2>
    <?php
    $conn = new mysqli($server, $username, $password, $database);
    if ($conn->connect_error) {
      die("Koneksi gagal: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM buku";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
          // Memotong deskripsi menjadi maksimal 50 karakter
          $deskripsi = $row['deskripsi'];
          if (strlen($deskripsi) > 50) {
              $deskripsi_singkat = substr($deskripsi, 0, 50) . "... <a href='buku.php?id_buku=" . $row['id_buku'] . "' style='color: #ffcc00;'>selengkapnya</a>";
          } else {
              $deskripsi_singkat = $deskripsi;
          }
        echo "<div class='book-item'>
                <a href='buku.php?id_buku=" . $row['id_buku'] . "'>
                  <img src='img/buku/" . $row['foto'] . "' alt='" . $row['judul_buku'] . "'>
                </a>
                <div class='book-details'>
                  <a href='buku.php?id_buku=" . $row['id_buku'] . "'>
                    <h5>" . $row['judul_buku'] . "</h5>
                  </a>
                  <p><strong>Pengarang:</strong> " . $row['pengarang'] . "</p>
                  <p><strong>Penerbit:</strong> " . $row['penerbit'] . "</p>
                  <p><strong>Tahun Terbit:</strong> " . $row['tahun_terbit'] . "</p>
                  <p><strong>Deskripsi:</strong> " . $deskripsi_singkat . "</p>
                </div>
              </div>";
      }
    } else {
      echo "<p class='text-center'>Tidak ada buku tersedia.</p>";
    }

    $conn->close();
    ?>
  </div>

  <footer>
    <div class="container">
      <p>&copy; 2025 PerpusGratis. All Rights Reserved.</p>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
