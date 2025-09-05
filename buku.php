<?php 
session_start();
include "koneksi.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Detail Buku - PerpusGratis</title>
  <meta name="description" content="Detail Buku Perpustakaan Gratis">
  <meta name="keywords" content="free library, books, detail buku">
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
    .book-cover {
      max-width: 400px;
      height: auto;
      border-radius: 10px;
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
    #recommendations img {
      width: 100%;
      height: 500px;
      object-fit: cover;
      border-radius: 5px;
    }
    #recommendations .card-title {
      font-size: 16px;
      font-weight: bold;
    }
    #recommendations .card-text {
      font-size: 14px;
    }
    .container p {
      text-align: justify;
    }
    .table {
      background-color: transparent;
      color: white;
    }
    .table th,
    .table td {
      border: 1px solid rgba(255, 255, 255, 0.3);
      padding: 8px;
    }
    .table th {
      text-align: left;
      font-weight: bold;
    }
  </style>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
      <a class="navbar-brand" href="index.html">PerpusGratis</a>
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
    <?php
    if (isset($_GET['id_buku'])) {
      $id_buku = $conn->real_escape_string($_GET['id_buku']);
      $sql = "SELECT * FROM buku WHERE id_buku = '$id_buku'";
      $result = $conn->query($sql);

      $stmt = $conn->prepare("UPDATE buku SET views = views + 1 WHERE id_buku = ?");
      $stmt->bind_param("i", $id_buku);
      $stmt->execute();
      $stmt->close();

      if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        ?>
        <div class='row'>
          <div class='col-md-4'>
            <img src='img/buku/<?php echo $row['foto']; ?>' alt='<?php echo $row['judul_buku']; ?>' class='book-cover'>
          </div>
          <div class='col-md-8'>
            <h2><?php echo $row['judul_buku']; ?></h2>
            <table class='table'>
              <tr><th>Pengarang</th><td><?php echo $row['pengarang']; ?></td></tr>
              <tr><th>Penerbit</th><td><?php echo $row['penerbit']; ?></td></tr>
              <tr><th>Tahun Terbit</th><td><?php echo $row['tahun_terbit']; ?></td></tr>
              <tr><th>Tebal Buku</th><td><?php echo $row['tebal_buku']; ?> halaman</td></tr>
              <tr><th>Ukuran Buku</th><td><?php echo $row['ukuran_buku']; ?></td></tr>
              <tr><th>ISBN</th><td><?php echo $row['isbn']; ?></td></tr>
              <tr><th>Hak Cipta</th><td><?php echo $row['hak_cipta']; ?></td></tr>
              <tr><th>Tanggal Input</th><td><?php echo $row['tanggal_input']; ?></td></tr>
              <tr><th>Dilihat</th><td><?php echo $row['views']; ?> kali</td></tr>
              <tr><th>Download</th><td><?php echo $row['downloads']; ?> kali</td></tr>
            </table>
            <p><strong>Deskripsi:</strong> <?php echo $row['deskripsi']; ?></p>
            <div class='mt-4'>
              <button onclick="openPDF('pdf/<?php echo $row['pdf']; ?>');" class='btn btn-success btn-sm'>
                <i class='bi bi-eye-fill'></i> View
              </button>
              <a href='downloads.php?id_buku=<?php echo $row['id_buku']; ?>' class='btn btn-primary btn-sm'>
  <i class='bi bi-download'></i> Download
</a>

            </div>
          </div>
        </div>
        <?php
      } else {
        echo "<p class='text-center'>Buku tidak ditemukan.</p>";
      }
    }
    ?>
  </div>

  <section id="recommendations" class="py-5 bg-dark text-white">
    <div class="container">
      <div class="text-center mb-4">
        <h2>Rekomendasi Buku</h2>
      </div>
      <div class="row">
        <?php
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

  <script>
    function openPDF(filePath) {
      window.open(filePath, '_blank');
    }
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
