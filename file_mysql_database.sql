-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 09, 2023 at 01:51 AM
-- Server version: 8.0.32-0ubuntu0.20.04.2
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `botlelang_buanakoi`
--

-- --------------------------------------------------------

--
-- Table structure for table `bot_wagroup`
--

CREATE TABLE `bot_wagroup` (
  `id` bigint NOT NULL,
  `botid` tinyint DEFAULT '1',
  `wagroupid` varchar(255) DEFAULT NULL,
  `wagroupname` varchar(255) DEFAULT NULL,
  `invite_link` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `bot_wagroup`
--
------------------------------------------------------

--
-- Table structure for table `log_debug`
--

CREATE TABLE `log_debug` (
  `id` bigint NOT NULL,
  `botid` int DEFAULT NULL,
  `sender` varchar(255) DEFAULT NULL,
  `namafile` text,
  `content` text,
  `debugdate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `log_debug`
--

-- --------------------------------------------------------

--
-- Table structure for table `log_fonnte`
--

CREATE TABLE `log_fonnte` (
  `id` bigint NOT NULL,
  `idfonnte` varchar(255) DEFAULT NULL,
  `sender` varchar(255) DEFAULT NULL,
  `senderName` varchar(255) DEFAULT NULL,
  `isipesan` text,
  `logdate` datetime DEFAULT NULL,
  `group` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `log_fonnte`
--

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `id` bigint NOT NULL,
  `botid` int DEFAULT NULL,
  `nomorwa` varchar(255) DEFAULT NULL,
  `groupid` varchar(255) DEFAULT NULL,
  `groupname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `msbot`
--

CREATE TABLE `msbot` (
  `botid` bigint NOT NULL,
  `userid` bigint NOT NULL,
  `botname` varchar(255) DEFAULT NULL,
  `botdesc` text,
  `botowneremail` varchar(255) DEFAULT NULL,
  `botkey` varchar(255) DEFAULT NULL,
  `botwa` varchar(255) DEFAULT NULL,
  `waowner` varchar(255) DEFAULT NULL,
  `aturan_pemilik` text,
  `aturan_pemilik_tele` text,
  `alamat_pemilik` text,
  `rekening_pemilik` text,
  `tokenfonnte` varchar(255) NOT NULL,
  `wagroupid` varchar(255) DEFAULT NULL,
  `jambuka` datetime DEFAULT NULL,
  `jamtutup` datetime DEFAULT NULL,
  `kelipatan` int DEFAULT NULL,
  `startvalue` int DEFAULT NULL,
  `botregdate` datetime DEFAULT NULL,
  `isactive` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `msbot`
--

INSERT INTO `msbot` (`botid`, `userid`, `botname`, `botdesc`, `botowneremail`, `botkey`, `botwa`, `waowner`, `aturan_pemilik`, `aturan_pemilik_tele`, `alamat_pemilik`, `rekening_pemilik`, `tokenfonnte`, `wagroupid`, `jambuka`, `jamtutup`, `kelipatan`, `startvalue`, `botregdate`, `isactive`) VALUES
(1, 1, 'Nama Farm KOI', 'Nama Farm KOI', 'loginuser@domain.com', 'namafarm', '628xxxxxx', '628xxxx', '*LELANG GABUNGAN NAMA FARM di WA GROUP 1,2,3,4*\r\n \r\n*SABTU 08/04/2023*\r\n\r\nA. *CHAGOI TEMBAGA KINGRIN* (Full Blink2,Super Bulky & Calon Jumbo)\r\nSize : 35 Cm\r\nSex  : Male / Jantan\r\nFarm : Local - Blitar\r\n\r\nB. *SANKE DOITSU STRONG SQ* (Original,Warna Strong & Calon Jumbo) \r\nSize : 32 Cm\r\nSex  : Male  / Jantan\r\nFarm: Local - Blitar\r\n\r\nC. *SANKE DOITSU MARUTEN SQ* (Original,Warna Strong & Calon Jumbo)\r\nSIZE : 29 Cm\r\nSEX  : Male / Jantan\r\nFARM : Local - Blitar\r\n\r\nD. *SANKE DOITSU MARUTEN STRONG SQ* (Original, Warna Strong & Calon Jumbo) SQ\r\nSIZE : 33 Cm\r\nSEX  : Male / Jantan\r\nFARM : LOCAL - BLITAR\r\n\r\nE. *KOHAKU MARUTEN BULKY SQ* (Original,Warna Strong & Calon Jumbo) SQ\r\nSIZE : 32 Cm\r\nSEX  : Male / Jantan\r\nFARM : Local - Blitar\r\n\r\nF. *SHOWA DOITSU STRONG SQ* (Original,Warna Strong & Calon Jumbo)\r\nSIZE : 31 Cm\r\nSEX : Male / Jantan\r\nFARM : Local - Blitar\r\n\r\nG. *SHIRO DOITSU* (Original,Warna Strong & Calon Jumbo) SQ\r\nSIZE : 33 Cm\r\nSEX : Male / Jantan\r\nFARM : Local - Blitar\r\n\r\nH. *SHOWA STRONG* (Warna Strong & Calon Jumbo) SQ\r\nSIZE : 30 Cm\r\nSEX : Male / Jantan\r\nFARM : Local - Blitar\r\n\r\n----------------------------------------\r\n        *Info lelang*   \r\n- OB           : 100.000\r\n- KB           :  50.000 \r\n- Jump Bid     : Sesuai KB\r\n- Lokasi Ikan  : Bandung\r\n- Proses Karantina  Aquarium\r\n----------------------------------------\r\n*Waktu 16.00 - 21.30*\r\n\r\n-Extra Time 5 Menit,Tiap Bid 5 menit terakhir\r\n- Extra Time Berlaku untuk Bid 5 Menit Terakhir\r\n----------------------------------------\r\n*Aturan*\r\n- Max pembayaran 2 x 24jam\r\n- Max penitipan 7 x 24jam yg\r\n*Penitipan Ikan Melewati Batas Waktu*\r\n[Segala resiko ditanggung pemenang]\r\n- *Biaya Packing :*\r\n  *Plastik & Oksigen 15.000*\r\n  *Plastik, Oksigen & Kardus 25.000*\r\n----------------------------------------\r\n*Cek foto, video, rekap sebelum bid*\r\n*BNR Akan Dipublish Di Group*\r\n----------------------------------------', 'LELANG GABUNGAN BUANA KOI\r\n\r\nTata cara mengikuti lelang DEMO ikan koi  \r\n=================================\r\nOB 100\r\nKB 25\r\nSemua ikan adalah produk Demo , untuk belajar cara mengikuti lelang menggunakan botlelang.com\r\n\r\nCara melakukan bid\r\nketik Bid dan Kode Ikan , sebagai contoh\r\n\r\nBID A  \r\natau \r\nBID A,B\r\natau \r\nBID C,D,E,F\r\n\r\nCara melakukan jump bid semua ikan / produk\r\n\r\nKetik Jump Bid ALL [Nominal]\r\n\r\nContoh\r\nJump Bid All 200\r\n\r\nContoh diatas menunjukkan \r\nmenawar semua ikan di harga Rp 200,000\r\n', 'Alamat Buana KOI', 'Rekening Pemilik di Rekening \r\nAgus Budi Prasetyo\r\nBCA 8100811490\r\n', '', NULL, '2023-04-08 16:00:00', '2023-04-08 21:31:00', 50000, 100000, '2021-10-19 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `mscontent`
--

CREATE TABLE `mscontent` (
  `id` bigint NOT NULL,
  `botid` bigint NOT NULL,
  `contentid` varchar(255) NOT NULL,
  `contentdesc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `mscontent`
--

INSERT INTO `mscontent` (`id`, `botid`, `contentid`, `contentdesc`) VALUES
(1, 1, 'LIHAT', 'Produk yang sedang Dilelang saat ini\r\n\r\n[DISPLAY_PRODUCT_LELANG_SAAT_INI]\r\n\r\n\r\nProduk yang akan dilelang pada waktu mendatang\r\n\r\n[DISPLAY_PRODUCT_LELANG_UPCOMING]\r\n\r\n'),
(2, 1, 'BID', 'Untuk ikutan bidding\r\nNilai Kelipatan produk pada setiap produ yang dilelang berbeda-beda, perhatikan nilai kelipatan lelang, dan perhatikan juga\r\nstatistik daftar lelang yang sedang berjalan.\r\n\r\nUntuk berpartisipasi\r\n\r\nKetik BID [PRODUCTCODE]\r\n\r\nSetelah itu akan mendapatkan balasan berupa konfirmasi berupa 6 digit OTP\r\n\r\nKetik 6 digit OTP\r\ndan anda akan masuk ke dalam lelang'),
(3, 1, 'STATS', 'Daftar Lelang yang berlaku saat ini\r\n\r\n[DISPLAY_STATS_LELANG_SAAT_INI]'),
(4, 1, 'INFO', 'Info Tata cara lelang');

-- --------------------------------------------------------

--
-- Table structure for table `msproduct`
--

CREATE TABLE `msproduct` (
  `pid` bigint NOT NULL,
  `botid` bigint DEFAULT NULL,
  `productname` varchar(255) DEFAULT NULL,
  `urlimage1` varchar(255) DEFAULT NULL,
  `urlvideo1` varchar(255) DEFAULT NULL,
  `producturlkey` varchar(255) DEFAULT NULL,
  `productcode` char(64) DEFAULT NULL,
  `productdesc` text,
  `jambuka` datetime DEFAULT NULL,
  `jamtutup` datetime DEFAULT NULL,
  `extratime` datetime DEFAULT NULL,
  `kelipatan` int DEFAULT '1',
  `startvalue` int DEFAULT NULL,
  `maximumbid` int DEFAULT NULL,
  `winnersender` varchar(255) DEFAULT NULL,
  `isupcoming` tinyint(1) DEFAULT '1',
  `isactive` tinyint(1) NOT NULL DEFAULT '0',
  `regdate` datetime DEFAULT NULL,
  `currentprice` int DEFAULT NULL,
  `currentwinner` varchar(255) DEFAULT NULL,
  `currentname` varchar(255) DEFAULT NULL,
  `currentfrom` varchar(255) DEFAULT NULL,
  `ispublishrekap` tinyint(1) DEFAULT '1',
  `ishapus` tinyint(1) DEFAULT '0',
  `datehapus` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `msproduct`
--

INSERT INTO `msproduct` (`pid`, `botid`, `productname`, `urlimage1`, `urlvideo1`, `producturlkey`, `productcode`, `productdesc`, `jambuka`, `jamtutup`, `extratime`, `kelipatan`, `startvalue`, `maximumbid`, `winnersender`, `isupcoming`, `isactive`, `regdate`, `currentprice`, `currentwinner`, `currentname`, `currentfrom`, `ispublishrekap`, `ishapus`, `datehapus`) VALUES
(1, 1, 'A CHAGOI TEMBAGA KINGRIN 35CM MALE (JANTAN) LOCAL BLITAR', '', NULL, NULL, 'A', 'A CHAGOI TEMBAGA KINGRIN 35CM MALE (JANTAN) LOCAL BLITAR\r', '2023-04-08 16:00:00', '2023-04-08 21:31:00', NULL, 50000, 100000, NULL, NULL, 1, 0, '2023-04-08 12:52:25', 200000, '62811672158', 'Safari', '6285321905777-1629820156@g.us', 1, 0, NULL),
(2, 1, 'B SANKE DOITSU STRONG SQ 32CM MALE (JANTAN) LOCAL BLITAR', '', NULL, NULL, 'B', 'B SANKE DOITSU STRONG SQ 32CM MALE (JANTAN) LOCAL BLITAR\r', '2023-04-08 16:00:00', '2023-04-08 21:31:00', NULL, 50000, 100000, NULL, NULL, 1, 0, '2023-04-08 12:52:25', 300000, '628174900100', 'HHJ', '6285321905777-1599370944@g.us', 1, 0, NULL),
(3, 1, 'C SANKE DOITSU MARUTEN SQ 29CM MALE (JANTAN) LOCAL BLITAR', '', NULL, NULL, 'C', 'C SANKE DOITSU MARUTEN SQ 29CM MALE (JANTAN) LOCAL BLITAR\r', '2023-04-08 16:00:00', '2023-04-08 21:31:00', NULL, 50000, 100000, NULL, NULL, 1, 0, '2023-04-08 12:52:25', 250000, '628174900100', 'HHJ', '6285321905777-1599370944@g.us', 1, 0, NULL),
(4, 1, 'D SANKE DOITSU MARUTEN STRONG SQ 33CM MALE (JANTAN) LOCAL BLITAR', '', NULL, NULL, 'D', 'D SANKE DOITSU MARUTEN STRONG SQ 33CM MALE (JANTAN) LOCAL BLITAR\r', '2023-04-08 16:00:00', '2023-04-08 21:31:00', NULL, 50000, 100000, NULL, NULL, 1, 0, '2023-04-08 12:52:25', 200000, '62818400086', 'Yana Lukmana', '6285321905777-1618644552@g.us', 1, 0, NULL),
(5, 1, 'E KOHAKU MARUTEN BULKY SQ 32CM MALE (JANTAN) LOCAL BLITAR', '', NULL, NULL, 'E', 'E KOHAKU MARUTEN BULKY SQ 32CM MALE (JANTAN) LOCAL BLITAR\r', '2023-04-08 16:00:00', '2023-04-08 21:31:00', NULL, 50000, 100000, NULL, NULL, 1, 0, '2023-04-08 12:52:25', 250000, '628174900100', 'HHJ', '6285321905777-1599370944@g.us', 1, 0, NULL),
(6, 1, 'F SHOWA DOITSU STRONG SQ 31CM MALE (JANTAN) LOCAL BLITAR', '', NULL, NULL, 'F', 'F SHOWA DOITSU STRONG SQ 31CM MALE (JANTAN) LOCAL BLITAR\r', '2023-04-08 16:00:00', '2023-04-08 21:31:00', NULL, 50000, 100000, NULL, NULL, 1, 0, '2023-04-08 12:52:25', 250000, '62818400086', 'Yana Lukmana', '6285321905777-1618644552@g.us', 1, 0, NULL),
(7, 1, 'G SHIRO DOITSU 33CM MALE (JANTAN) LOCAL BLITAR', '', NULL, NULL, 'G', 'G SHIRO DOITSU 33CM MALE (JANTAN) LOCAL BLITAR\r', '2023-04-08 16:00:00', '2023-04-08 21:31:00', NULL, 50000, 100000, NULL, NULL, 1, 0, '2023-04-08 12:52:25', 200000, '62811672158', 'Safari', '6285321905777-1618644552@g.us', 1, 0, NULL),
(8, 1, 'H SHOWA STRONG 30CM MALE (JANTAN) LOCAL BLITAR', '', NULL, NULL, 'H', 'H SHOWA STRONG 30CM MALE (JANTAN) LOCAL BLITAR', '2023-04-08 16:00:00', '2023-04-08 21:31:00', NULL, 50000, 100000, NULL, NULL, 1, 0, '2023-04-08 12:52:25', 200000, '62818400086', 'Yana Lukmana', '6285321905777-1618644552@g.us', 1, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `msuser`
--

CREATE TABLE `msuser` (
  `userid` bigint NOT NULL,
  `sender` varchar(255) DEFAULT NULL,
  `emailuser` varchar(255) DEFAULT NULL,
  `fullname` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `lastlogin` datetime NOT NULL,
  `regdate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `msuser`
--

INSERT INTO `msuser` (`userid`, `sender`, `emailuser`, `fullname`, `password`, `lastlogin`, `regdate`) VALUES
(1, '628xxxxxx', 'loginuser@domain.com', 'Nama Farm', 'password_enkripsi', '2023-04-08 22:41:27', '2021-10-10 08:00:21');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_lelang`
--

CREATE TABLE `transaksi_lelang` (
  `id` bigint NOT NULL,
  `botid` bigint DEFAULT NULL,
  `pid` bigint DEFAULT NULL,
  `from` varchar(255) DEFAULT NULL,
  `productcode` char(64) DEFAULT NULL,
  `sender` varchar(255) DEFAULT NULL,
  `senderName` varchar(255) DEFAULT NULL,
  `group_id` varchar(255) DEFAULT NULL,
  `telegramid` varchar(255) DEFAULT NULL,
  `telegramusername` varchar(255) DEFAULT NULL,
  `nilaikelipatan` decimal(25,16) DEFAULT NULL,
  `iswinner` tinyint(1) DEFAULT '0',
  `isactive` tinyint(1) DEFAULT '0',
  `isexpired` tinyint(1) DEFAULT '0',
  `trlelangdate` datetime DEFAULT NULL,
  `iscancel` int DEFAULT '0',
  `canceldate` datetime DEFAULT NULL,
  `istesting` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `transaksi_lelang`
--

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bot_wagroup`
--
ALTER TABLE `bot_wagroup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log_debug`
--
ALTER TABLE `log_debug`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log_fonnte`
--
ALTER TABLE `log_fonnte`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `msbot`
--
ALTER TABLE `msbot`
  ADD PRIMARY KEY (`botid`);

--
-- Indexes for table `mscontent`
--
ALTER TABLE `mscontent`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `msproduct`
--
ALTER TABLE `msproduct`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `msuser`
--
ALTER TABLE `msuser`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `transaksi_lelang`
--
ALTER TABLE `transaksi_lelang`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bot_wagroup`
--
ALTER TABLE `bot_wagroup`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `log_debug`
--
ALTER TABLE `log_debug`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1885;

--
-- AUTO_INCREMENT for table `log_fonnte`
--
ALTER TABLE `log_fonnte`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=898;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `msbot`
--
ALTER TABLE `msbot`
  MODIFY `botid` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `mscontent`
--
ALTER TABLE `mscontent`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `msproduct`
--
ALTER TABLE `msproduct`
  MODIFY `pid` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `msuser`
--
ALTER TABLE `msuser`
  MODIFY `userid` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `transaksi_lelang`
--
ALTER TABLE `transaksi_lelang`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
