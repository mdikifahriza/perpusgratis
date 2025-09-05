# README - Instalasi Web dan Database di Localhost XAMPP

## Persyaratan

* Pastikan Anda telah menginstal **XAMPP** di komputer Anda. Jika belum, unduh XAMPP di [https://www.apachefriends.org](https://www.apachefriends.org) dan instal sesuai petunjuk.
* Pastikan **XAMPP Apache** dan **MySQL** berjalan dengan baik di localhost.

---

## Langkah-langkah Instalasi Web dan Database

1. Salin seluruh folder proyek web (termasuk file HTML, CSS, JavaScript, PHP, dll) ke dalam direktori `htdocs` di XAMPP Anda. Biasanya, direktori ini berada di:

   ```
   C:\xampp\htdocs\
   ```

   **Contoh:**

   ```
   C:\xampp\htdocs\perpusgratis\
   ```

2. Buka **XAMPP Control Panel** dan pastikan **MySQL** sudah berjalan.

3. Buka browser dan ketik:
   [http://localhost/phpmyadmin/](http://localhost/phpmyadmin/)

4. Klik tab **Database** di phpMyAdmin dan buat database baru dengan nama sesuai yang diperlukan.
   **Contoh:**

   ```
   Nama Database: perpusgratis
   ```

5. Import file database (.sql) yang sudah disediakan.

   * Klik tab **Import**.
   * Pilih file `.sql` yang Anda miliki.
   * Klik **Go** untuk memulai proses import.

6. Buka file konfigurasi `koneksi.php` database di dalam folder proyek Anda.

7. Edit file konfigurasi tersebut dan sesuaikan dengan pengaturan database yang telah Anda buat sebelumnya:

   ```php
   <?php
   $host = "localhost";
   $username = "root";  // username default untuk XAMPP
   $password = "";      // password default untuk XAMPP (kosongkan)
   $database = "nama_database";  // Ganti dengan nama database yang Anda buat
   ?>
   ```

---

# Instalasi Web dan Database di Server (Infinity Free)

1. Kunjungi **InfinityFree**.
2. Klik tombol **Sign Up** untuk membuat akun baru.
3. Isi detail akun seperti email, username, dan password.
4. Verifikasi email Anda jika diminta.
5. Setelah login, klik **Create Account** atau **Create New Hosting Account**.
6. Pilih nama domain yang Anda inginkan. Jika ingin menggunakan domain gratis, pilih dari opsi subdomain seperti `yourdomain.epizy.com`.
7. Setelah itu, Anda akan mendapatkan akses ke **cPanel** dari akun hosting Anda.
8. Di dalam cPanel, buka bagian **SSL/TLS**.
9. Pilih domain yang ingin Anda amankan dan pilih opsi untuk memasang SSL gratis.
10. Ikuti instruksi untuk mengaktifkan SSL. Anda akan mendapatkan sertifikat SSL untuk domain Anda.
11. Unduh dan instal **FileZilla**.
12. Buka FileZilla dan masukkan detail server FTP yang Anda dapatkan dari cPanel (host, username, password).
13. Sambungkan ke server Anda.
14. Pilih file website Anda dari komputer, lalu seret dan letakkan di direktori `htdocs` pada server.
15. Siapkan file database (misalnya `.sql`). Pastikan Anda telah mengekspor database Anda dalam format SQL. Jika belum, ekspor database dari lokal menggunakan phpMyAdmin atau alat database lainnya.
16. Akses **phpMyAdmin** melalui cPanel pada bagian **Databases**.
17. Klik tab **Databases**.
18. Buat database baru dengan nama sesuai (misalnya `database_name`).
19. Pilih database yang baru saja Anda buat.
20. Klik tab **Import**.
21. Pilih file database yang telah diekspor (file `.sql`).
22. Klik tombol **Go** untuk memulai proses impor.
23. Setelah selesai, Anda akan melihat tabel dan data dari database tersebut di phpMyAdmin.
24. Edit file `koneksi.php` untuk menghubungkan website Anda dengan database.
25. Ganti host, username, password, dan nama database di `koneksi.php` sesuai dengan database yang Anda buat.
26. Simpan file `koneksi.php` dan unggah ke server Anda.
27. Setelah semua file berhasil diunggah dan koneksi terkonfigurasi dengan benar, kunjungi domain Anda untuk melihat website yang telah online.

---

## Kredensial Login

```
USERNAME = diki
PASSWORD = diki
```
