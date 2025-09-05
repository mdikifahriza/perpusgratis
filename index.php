<?php
session_start();
include("koneksi.php");
$trafik = "UPDATE trafik SET kunjungan = kunjungan + 1";
$trafik_result = $conn->query($trafik);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PerpusGratis</title>
  <meta name="description" content="Free Library Website">
  <meta name="keywords" content="free library, books, download pdf">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: url('img/rak.jpeg') no-repeat center center fixed;
      background-size: cover;
      color: #fff;
      overflow-x: hidden;
    }
    .container h2{
      color: #fff;
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
    .header {
      text-align: center;
      padding: 60px 0;
      background: rgba(0, 0, 0, 0.6);
    }
    .header h2, .header h3, .header h4 {
      color: #ffcc00;
    }
    .form-control {
      margin: 10px 0;
    }
    .card {
    background-color: rgba(255, 255, 255, 0.9);
    border: none;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
  .card-title {
    color: #333;
    font-size: 18px;
    }
  .btn-custom {
    background-color: #ffcc00;
    color: #000;
    border: none;
    }
  .btn-custom:hover {
    background-color: #e6b800;
    }
    .category-list li {
      list-style: none;
      margin: 10px 0;
    }
    .category-list li a {
      color:rgb(250, 250, 249);
      text-decoration: none;
    }
    .category-list li a:hover {
      text-decoration: underline;
    }
    .card img {
      width: 100%;
      height: auto;
      max-height: 450px;
      object-fit: cover;
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

  <header class="header">
    <div class="container">
      <h2></h2>
      <h3>"Jika kamu tidak tahan akan lelahnya belajar, maka kamu harus sanggup menahan perihnya kebodohan."</h3>
      <h4>- Imam Syafii -</h4>
    </div>
  </header>

  <section id="feature" class="py-5">
    <div class="container">
      <div class="text-center mb-4">
        <h2>Cari Buku</h2>
      </div>
      <form action="search.php" method="GET" class="d-flex justify-content-center">
        <input type="text" name="query" class="form-control w-50" placeholder="Cari judul buku, penulis, atau kategori">
        <button type="submit" class="btn btn-custom ms-2">Cari</button>
      </form>
      <h1></h1>
      <div class="text-center mb-4">
      <h2>Kategori Buku</h2>
    </div>
    <div class="row">
      <?php
        $sql = "SELECT * FROM kategori ORDER BY kategori ASC";
        $result = $conn->query($sql);

        while ($row = $result->fetch_assoc()) {
          echo "<div class='col-6 col-md-4 col-lg-2 mb-4'>
                  <div class='card h-100 text-center'>
                    <div class='card-body'>
                      <h5 class='card-title'>" . $row['kategori'] . "</h5>
                      <a href='kategori.php?id=" . $row['id_kategori'] . "' class='btn btn-custom'>Lihat Buku</a>
                    </div>
                  </div>
                </div>";
        }
      ?>
    </div>
  </div>
</section>

  <section id="recommendations" class="py-5 bg-dark text-white">
    <div class="container">
      <div class="text-center mb-4">
        <h2>Rekomendasi Buku</h2>
      </div>
      <div class="row d-flex flex-wrap">
        <?php
        $conn = new mysqli($server, $username, $password, $database);
        $sql = "SELECT * FROM buku ORDER BY tanggal_input DESC LIMIT 6";
        $result = $conn->query($sql);

        while ($row = $result->fetch_assoc()) {
          echo "<div class='col-md-4 mb-4'>
                  <div class='card h-100 bg-secondary'>
                    <a href='buku.php?id_buku=" . $row['id_buku'] . "'>
                      <img src='img/buku/" . $row['foto'] . "' class='card-img-top' alt='" . $row['judul_buku'] . "'>
                    </a>
                    <div class='card-body'>
                      <h5 class='card-title'>" . $row['judul_buku'] . "</h5>
                      <p class='card-text'>" . $row['pengarang'] . "</p>
                    </div>
                  </div>
                </div>";
        }
        $conn->close();
        ?>
      </div>
    </div>
  </section>

  <footer>
    <div class="container">
      <p>&copy; 2025 PerpusGratis. All Rights Reserved.</p>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
