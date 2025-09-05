 README - Instalasi Web dan Database di Localhost XAMPP

 Persyaratan

•	Pastikan Anda telah menginstal XAMPP di komputer Anda. Jika belum, unduh XAMPP di [https://www.apachefriends.org](https://www.apachefriends.org) dan instal sesuai petunjuk.
•	Pastikan XAMPP Apache dan MySQL berjalan dengan baik di localhost.

 Langkah-langkah Instalasi Web dan Database
•	Salin seluruh folder proyek web (termasuk file HTML, CSS, JavaScript, PHP, dll) ke dalam direktori htdocs di XAMPP Anda. Biasanya, direktori ini berada di C:\xampp\htdocs\.
Contoh:  
C:\xampp\htdocs\perpusgratis\
•	Buka XAMPP Control Panel dan pastikan MySQL sudah berjalan.
•	Buka browser dan ketik http://localhost/phpmyadmin/ di address bar.
•	Klik tab Database di phpMyAdmin dan buat database baru dengan nama sesuai yang diperlukan.
Contoh:  Nama Database: perpusgratis
•	Setelah itu, import file database (.sql) yang sudah disediakan. Klik tab Import dan pilih file .sql yang Anda miliki. Klik Go untuk memulai proses import.
•	Buka file konfigurasi koneksi.php database di dalam folder proyek Anda.
•	Edit file konfigurasi tersebut dan sesuaikan dengan pengaturan database yang telah Anda buat sebelumnya:
   <?php
   $host = localhost;
   $username = root;  // username default untuk XAMPP
   $password = ;      // password default untuk XAMPP (kosongkan)
   $database = nama_database;  // Ganti dengan nama database yang Anda buat
   ?>


Instalasi Web dan Database di Server (Infinity Free)
•	Kunjungi InfinityFree.
•	Klik tombol "Sign Up" untuk membuat akun baru.
•	Isi detail akun seperti email, username, dan password.
•	Verifikasi email Anda jika diminta.
•	Setelah login, klik "Create Account" atau "Create New Hosting Account".
•	Pilih nama domain yang Anda inginkan. Jika Anda ingin menggunakan domain gratis, pilih dari opsi subdomain seperti yourdomain.epizy.com.
•	Setelah itu, Anda akan mendapatkan akses ke cPanel dari akun hosting Anda.
•	Di dalam cPanel, buka bagian "SSL/TLS".
•	Pilih domain yang ingin Anda amankan dan pilih opsi untuk memasang SSL gratis.
•	Ikuti instruksi untuk mengaktifkan SSL. Anda akan mendapatkan sertifikat SSL untuk domain Anda.
•	Unduh dan instal FileZilla.
•	Buka FileZilla dan masukkan detail server FTP yang Anda dapatkan dari cPanel (host, username, password).
•	Sambungkan ke server Anda.
•	Pilih file website Anda dari komputer, lalu seret dan letakkan di direktori htdocs pada server.
•	Siapkan file database (misalnya .sql): Pastikan Anda telah mengekspor database Anda dalam format SQL. Jika belum, Anda dapat mengekspor database dari lokal menggunakan phpMyAdmin atau alat database lainnya.
•	Akses phpMyAdmin: Masuk ke cPanel Anda dan buka "phpMyAdmin" di bawah bagian "Databases".
•	Di phpMyAdmin, pilih tab "Databases".
•	Buat database baru dengan memberikan nama yang sesuai (misalnya database_name).
•	Pilih database yang baru saja Anda buat.
•	Klik tab "Import".
•	Pilih file database yang telah diekspor (file .sql).
•	Klik tombol "Go" untuk memulai proses impor.
•	Setelah selesai, Anda akan melihat tabel dan data dari database tersebut di phpMyAdmin.
•	edit file koneksi.php untuk menghubungkan website Anda dengan database.
•	Ganti host, username, password dan nama database  di koneksi.php sesuai dengan database yang anda buat
•	Simpan file koneksi.php dan unggah ke server Anda.
•	Setelah semua file berhasil diunggah dan koneksi terkonfigurasi dengan benar, kunjungi domain Anda untuk melihat website yang telah online.


USERNAME = diki
password = diki
