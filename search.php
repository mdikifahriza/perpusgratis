<?php
session_start();
include "koneksi.php";

// Koneksi ke database
$conn = new mysqli($server, $username, $password, $database);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil query pencarian dari input pengguna
$query = isset($_GET['query']) ? $conn->real_escape_string($_GET['query']) : '';

// SQL untuk mencari buku berdasarkan judul, pengarang, atau kategori
$sql = "
    SELECT b.id_buku, b.judul_buku, b.pengarang, b.foto, k.kategori 
    FROM buku b
    LEFT JOIN kategori k ON b.id_kategori = k.id_kategori
    WHERE b.judul_buku LIKE '%$query%' 
       OR b.pengarang LIKE '%$query%' 
       OR k.kategori LIKE '%$query%'
    ORDER BY b.tanggal_input DESC
";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Pencarian</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background: url('img/rak.jpeg') no-repeat center center fixed;
            background-size: cover;
            color: #fff;
        }
        .navbar {
            background-color: rgba(0, 0, 0, 0.8);
        }
        .navbar .nav-link {
            color: #fff;
        }
        .navbar .nav-link:hover {
            color: #ffcc00;
        }
        .card img {
            height: 500px;
            object-fit: cover;
        }
        .btn-custom {
            background-color: #ffcc00;
            color: #000;
            border: none;
        }
        .btn-custom:hover {
            background-color: #e6b800;
        }
        footer {
            padding: 20px 0;
            background: rgba(0, 0, 0, 0.9);
            text-align: center;
            color: #ffcc00;
        }
        footer a {
            color: #ffcc00;
            text-decoration: none;
        }
        footer a:hover {
            text-decoration: underline;
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

<section class="py-5">
    <div class="container">
    <div class="text-center mb-4">
        <h2>Cari Buku</h2>
      </div>
      <form action="search.php" method="GET" class="d-flex justify-content-center">
        <input type="text" name="query" class="form-control w-50" placeholder="Cari judul buku, penulis, atau kategori">
        <button type="submit" class="btn btn-custom ms-2">Cari</button>
      </form>
      <h1></h1>
      <div class="text-center mt-4">
            <a href="index.php" class="btn btn-custom">Kembali</a>
    </div>
    <h1></h1>
        <h2 class="text-center mb-5">Hasil Pencarian untuk: "<?php echo htmlspecialchars($query); ?>"</h2>

        <div class="row">
            <?php
            if ($result->num_rows > 0) {
                // Tampilkan hasil pencarian
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
            } else {
                echo "<p class='text-center'>Tidak ada hasil ditemukan untuk pencarian tersebut.</p>";
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

<?php
$conn->close();
?>
