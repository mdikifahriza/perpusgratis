<?php
session_start();
include("koneksi.php");

// Mendapatkan ID kategori dari URL
$id_kategori = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Memeriksa jika ID kategori valid
if ($id_kategori > 0) {
    $sql_kategori = "SELECT * FROM kategori WHERE id_kategori = $id_kategori";
    $result_kategori = $conn->query($sql_kategori);

    // Memeriksa jika kategori ditemukan
    if ($result_kategori->num_rows > 0) {
        $kategori = $result_kategori->fetch_assoc();
    } else {
        echo "Kategori tidak ditemukan.";
        exit();
    }
} else {
    echo "ID kategori tidak valid.";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PerpusGratis - <?php echo $kategori['kategori']; ?></title>
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
    .header h2 {
      color: #ffcc00;
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
      align-items: left;
    }
    .btn-custom:hover {
      background-color: #e6b800;
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
      <h2>Kategori: <?php echo $kategori['kategori']; ?></h2>
    </div>
  </header>

  <section id="books" class="py-5">
    <div class="container">
      <div class="text-center mb-3">
        <a href="index.php" class="btn btn-custom mx-auto">Kembali ke Beranda</a>
      </div>
      <form method="GET" action="kategori.php" class="mb-4 text-center">
        <select name="id" class="form-select d-inline-block w-auto">
          <?php
            $sql_all_kategori = "SELECT * FROM kategori ORDER BY kategori ASC";
            $result_all_kategori = $conn->query($sql_all_kategori);
            while ($row = $result_all_kategori->fetch_assoc()) {
              $selected = ($row['id_kategori'] == $id_kategori) ? "selected" : "";
              echo "<option value='" . $row['id_kategori'] . "' $selected>" . $row['kategori'] . "</option>";
            }
          ?>
        </select>
        <button type="submit" class="btn btn-custom ms-2">Pilih</button>
      </form>
      <div class="row">
        <?php
          $sql_buku = "SELECT * FROM buku WHERE id_kategori = $id_kategori ORDER BY judul_buku ASC";
          $result_buku = $conn->query($sql_buku);

            if ($result_buku->num_rows > 0) {
                // Tampilkan hasil pencarian
                while ($row = $result_buku->fetch_assoc()) {
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
            } else {
                echo "<p class='text-center'>Buku Kosong.</p>";
            }
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
