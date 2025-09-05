CREATE TABLE `admin` (
  `id_admin` int(4) NOT NULL,
  `nama_admin` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(16) NOT NULL,
  `foto_admin` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `admin` (`id_admin`, `nama_admin`, `username`, `password`, `foto_admin`) VALUES
(5, 'M. Diki Fahriza', 'diki', 'diki', '1736469064_potodiki.jpg');

CREATE TABLE `buku` (
  `id_buku` int(4) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `judul_buku` varchar(50) NOT NULL,
  `pengarang` varchar(20) NOT NULL,
  `penerbit` varchar(20) NOT NULL,
  `tahun_terbit` int(4) NOT NULL,
  `tebal_buku` varchar(20) NOT NULL,
  `ukuran_buku` varchar(20) NOT NULL,
  `isbn` varchar(17) NOT NULL,
  `hak_cipta` varchar(20) NOT NULL,
  `tanggal_input` date NOT NULL,
  `deskripsi` varchar(1000) NOT NULL,
  `foto` varchar(50) NOT NULL,
  `pdf` varchar(50) NOT NULL,
  `views` int(11) DEFAULT 0,
  `downloads` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `buku` (`id_buku`, `id_kategori`, `judul_buku`, `pengarang`, `penerbit`, `tahun_terbit`, `tebal_buku`, `ukuran_buku`, `isbn`, `hak_cipta`, `tanggal_input`, `deskripsi`, `foto`, `pdf`, `views`, `downloads`) VALUES
(1, 5, 'Aksi Massa', 'Tan Malaka', '-', 1926, '-', '-', '-', 'free', '2025-01-07', 'Tan Malaka menganggap aksi massa sebagai solusi untuk mencapai tujuan sebuah gerakan. Dalam buku Aksi Massa, Tan Malaka menyampaikan pemikirannya bahwa upaya perebutan kekuasaan secara radikal (putch) bukanlah solusi terbaik. Menurut Tan Malaka, putch adalah aksi yang dilakukan oleh segerombolan kecil yang bergerak diam-diam dan tidak berhubungan dengan rakyat banyak. \r\nTan Malaka menyampaikan bahwa aksi massa harus disiapkan dengan hati-hati untuk membuat revolusi. Dalam sejarah umat manusia, aksi massa selalu membawa perubahan melalui revolusi-revolusi yang ditimbulkannya. ', 'foto_67806f823f90c7.95678225.png', 'pdf_67806f823fd9e3.83487717.pdf', 0, 0),
(2, 5, 'Di Bawah Bendera Revolusi 1', 'Soekarno', 'Panitia DBR', 1964, '624 hal', 'tidak diketahui', '-', 'free', '2025-01-06', 'Dibawah Bendera Revolusi adalah buku yang berisi kumpulan tulisan dan pidato Ir. Soekarno, Presiden pertama Indonesia, di masa revolusi menuju kemerdekaan. Buku ini dianggap sebagai karya klasik yang menjadi referensi sejarah pergerakan, perjuangan politik, kenegaraan, dan kemasyarakatan', 'foto_67806fa173c847.97304713.png', 'pdf_67806fa17401a9.75979254.pdf', 0, 0),
(3, 5, 'Di Bawah Bendera Revolusi 2', 'Soekarno', 'Panitia DBR', 1965, '455 hal', 'tidak diketahui', '-', 'free', '2025-01-06', 'Dibawah Bendera Revolusi adalah buku yang berisi kumpulan tulisan dan pidato Ir. Soekarno, Presiden pertama Indonesia, di masa revolusi menuju kemerdekaan. Buku ini dianggap sebagai karya klasik yang menjadi referensi sejarah pergerakan, perjuangan politik, kenegaraan, dan kemasyarakatan', 'foto_67806fcee45ba5.45312177.png', 'pdf_67806fcee49a95.97149791.pdf', 0, 0),
(4, 5, 'Gerpolek', 'Tan Malaka', 'Djambatan', 1948, '110', 'tidak diketahui', '-', 'free', '2025-01-06', 'Gerpolek merupakan buku yang dikonsep dan ditulis oleh Tan Malaka ketika dirinya meringkuk di penjara Madiun. Buku ini ditulis tanpa dukungan informasi kepustakaan atau apapun. Ia hanya mengandalkan pengetahuan, ingatan dan semangat kepemimpinan untuk tetap memikirkan kelangsungan kemerdekaan Republik tercinta.', 'foto_67806ff0cf4836.60181477.png', 'pdf_67806ff0cf9dd7.90962088.pdf', 0, 0),
(5, 5, 'Indonesia Menggugat', 'Soekarno', 'Departemen Peneranga', 1930, '140 hal', 'tidak diketahui', '-', 'free', '2025-01-06', 'Indonesia Menggugat merupakan pidato pembelaan yang disampaikan Ir. Sukarno dalam proses pengadilannya. Saat itu Ir. Sukarno dan ketiga pemimpin Perserikatan Nasional Indonesia (PNI) didakwa tengah mempersiapkan sebuah pemberontakan bersenjata melawan Pemerintah Kolonial Hindia Belanda.', 'foto_67807014ac5492.42232253.png', 'pdf_67807014accc08.40381914.pdf', 0, 0),
(6, 5, 'Materialise Dialektika dan Logika', 'Tan Malaka', '-', 1943, '388 hal.', 'tidak diketahui', '-', 'free', '2025-01-06', 'adilog oleh Iljas Hussein (nama pena Tan Malaka), pertama kali diterbitkan pada tahun 1943, edisi pertama resmi tahun 1951, adalah magnum opus dari Tan Malaka, pahlawan nasional Indonesia dan merupakan karya paling berpengaruh dalam sejarah filsafat Indonesia modern. Madilog adalah akronim bahasa Indonesia yang merupakan kependekan dari Materialisme Dialektika Logika. Ini adalah sintesis materialisme dialektis Marxis dan logika Hegelian. Madilog ditulis di Batavia di mana Malaka bersembunyi selama pendudukan Jepang di Indonesia, menyamar sebagai tukang jahit.\r\n\r\nJika esai Malaka \"Naar de Republiek Indonesië\" (\"Menuju Republik Indonesia\") diterbitkan pada tahun 1928, di bawah pemerintah Hindia Belanda, berdiri sebagai perumusan identitas nasional Indonesia, maka Madilog berdiri sebagai antiklimaks dari idenya dalam arti membangun karakter Indonesia dalam masyarakat modern. Meskipun Madilog didasarkan pada Marxisme, ia tidak mengimplementasikan pandangan Marxis atau mencoba untuk membang', 'foto_67807035916d83.16279384.png', 'pdf_6780703591a247.38004276.pdf', 0, 0),
(7, 5, 'Penyambung Lidah Rakyat', 'Soekarno', '-', 1966, '-', '-', '-', 'free', '2025-01-07', 'Bung Karno Penyambung Lidah Rakyat Indonesia adalah buku yang menceritakan perjalanan hidup, pemikiran, dan gagasan Soekarno mengenai kehidupan berbangsa dan bernegara di Indonesia. Buku ini merupakan terjemahan otobiografi Soekarno yang ditulis oleh Cindy Adams. \r\nBerikut beberapa hal yang dibahas dalam buku Bung Karno Penyambung Lidah Rakyat Indonesia:\r\nPerjalanan hidup Soekarno, mulai dari lahir hingga pasca-Revolusi Indonesia \r\nPerasaan Soekarno saat dipenjara, termasuk bagaimana ia menulis pledoi terkenal “Indonesia Menggugat” di atas kaleng tempat buang air \r\nDinamika tim antara Soekarno, Mohammad Hatta, dan Sutan Sjahrir \r\nPeristiwa ketika Soekarno ditahan di penjara Banceuy, Sukamiskin, hingga bebas dari penjara \r\nRevolusi yang mulai berkobar \r\nDokumentasi saat sidang Kabinet Dwikora, beberapa hari setelah peristiwa G30S di Istana Bogor \r\nFoto pada saat Soekarno wafat dan banyak sekali tokoh pahlawan yang melayat \r\nBuku ini pertama kali diterbitkan pada tahun 1966 dan telah men', 'foto_6780704f7ee0c7.71373912.png', 'pdf_6780704f7f1c29.50632467.pdf', 0, 0),
(8, 5, 'Rencana Ekonomi Berjuang', 'Tan Malaka', '-', 1945, '84 hal', 'tidak diketahui', '-', '-', '2025-01-06', 'Adapun telah terhitung dua lusin tahun lamanya saya menunggu kejadian yang berlaku dengan pesat dahsyatnya di Indonesia seperti sekarang ini. Berbahagialah rasanya hidup saya dapat menyaksikan perjuangan di Surabaya selama satu minggu lamanya pada tanggal 17 sampai 24 November 1945. Adanya sikap dan semangat proletar, tani, dan pemuda Indonesia memuncak, sesuai semua karya dan pengharapan saya selama dalam perantauan. Di Shanghai atau Berlin, di Mesir atau Moskow, saya tidak menjumpai sikap dan semangat yang lebih tepat, tangkas, dan tegap. Tetapi rasanya masih ada kekurangan baik ditilik dari penjuru ideologi maupun organisasi. yang\r\n\r\nDi sebuah pertemuan, yang mana Tan Malaka hadir tetapi tanpa diundang itu berkata secara lantang, bahwa kemerdekaan itu tidak kalian rancang untuk kemaslahatan atau kebaikan bersama. Namun kemerdekaan kalian atur hanya untuk segelintir manusia dan tidak menciptakan revolusi yang besar untuk menjadi merdeka itu harus 100 persen.\r\n\r\nAdapun cita-cita Tan M', 'foto_6780706d25f9f6.39553994.png', 'pdf_6780706d263d13.69851201.pdf', 0, 0),
(9, 5, 'Sarinah', 'Soekarno', 'Soekarno Foundation', 1947, '293 hal', 'tidak diketahui', '-', 'free', '2025-01-06', 'Saya namakan kitab ini Sarinah sebagai tanda terima kasih saya kepada pengasuh saya ketika saya masih kanak-kanak. Pengasuh saya itu bernama Sarinah. Ia mbok saya... Dari dia, saya banyak mendapat pelajaran mencintai orang kecil. Dia sendiri pun orang kecil, tetapi budinya selalu besar!Ir. SukarnoBuku Sarinah ini pertama kali terbit pada November 1947. Isinya merupakan kumpulan bahan pengajaran Bung Karno dalam kursus wanita. Melalui buku ini, Bung Karno mengkritisi kebanyakan laki-laki yang masih memandang perempuan sebagai suatu blasteran antara Dewi dan seorang tolol. Dipuji-puji bak Dewi, sekaligus dianggap tolol dalam beberapa hal lainnya.Meskipun juga tidak menyetujui gerakan feminisme yang kelewat batas di Eropa saat itu, Bung Karno menekankan pentingnya bagi para wanita untuk mengambil bagian dalam pembangunan Negara Indonesia. Kepada Sarinah-Sarinah masa kini, Bung Karno lantang berpesan, Hai wanita-wanita Indonesia, jadilah revolusioner, - tiada kemenangan revolusi', 'foto_678070df04ecd0.20264602.png', 'pdf_678070df052088.48781386.pdf', 0, 0),
(10, 5, 'Semangat Muda', 'Tan Malaka', '-', 1926, '122 hal', '-', '-', 'free', '2025-01-06', 'Semangat Muda : Kelak Rakyat Keturunanmu dan Angin Kemerdekaan Berbisik dengan Bunga di atas Kuburanmu: “ Di sini Bersemayam Semangat Revolusioner”\r\n\r\n\r\nSemangat Muda Tan Malaka 1926 ini mempunyai pemikiran untuk menjalankan organisasi revolusioner sesuai dengan kondisi Indonesia saat itu, seperti mengajak perjuangan politik nasional dengan perjuangan perekonomian dengan menyatukan perjuangan pembebasan nasional dan buruh. Kemudian terkait isi dari naskah ini, memiliki beberapa program nasional yang mana Kaum Borjuis dan Kaum Tani ikut serta. Hal ini disebabkan Kaum Buruh sebagai pemimpin suatu gerakan Indonesia, yang mana gerakan anti modal asing harus disatukan dengan gerakan pembebasan buruh. Adapun pergerakan yang dipimpin Kaum Buruh ini tidak terlepas dari kesatuan Indonesia.\r\n\r\nTerlebih ada beberapa revolusi yang terjadi dalam naskah \"Semangat Muda\", meliputi peperangan dan revolusi, revolusi yang terjadi di Indonesia, taktik yang terjadi, “Aksi Massa\" oleh Kaum Buruh, rapat raky', 'foto_678070f9e62353.79756989.png', 'pdf_678070f9e68c63.33963717.pdf', 0, 0);

CREATE TABLE `kategori` (
  `id_kategori` int(4) NOT NULL,
  `kategori` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `kategori` (`id_kategori`, `kategori`) VALUES
(5, 'Biografi'),
(7, 'Bisnis'),
(9, 'Memoir'),
(10, 'Panduan Manual'),
(11, 'Ensiklopedia'),
(12, 'Kamus'),
(13, 'Jurnalisme'),
(14, 'Sains Populer'),
(15, 'Psikologi'),
(16, 'Motivasi'),
(17, 'Pelajaran'),
(18, 'Humor'),
(19, 'Komik'),
(20, 'Cerpen'),
(21, 'Majalah'),
(22, 'Teks');


CREATE TABLE `trafik` (
  `kunjungan` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO `trafik` (`kunjungan`) VALUES
(15);

ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

ALTER TABLE `buku`
  ADD PRIMARY KEY (`id_buku`),
  ADD UNIQUE KEY `foto` (`foto`),
  ADD UNIQUE KEY `pdf` (`pdf`);

ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

ALTER TABLE `trafik`
  ADD UNIQUE KEY `kunjungan` (`kunjungan`);

ALTER TABLE `admin`
  MODIFY `id_admin` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

ALTER TABLE `buku`
  MODIFY `id_buku` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

ALTER TABLE `kategori`
  MODIFY `id_kategori` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;
