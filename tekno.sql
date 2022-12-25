-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 25, 2022 at 03:54 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tekno`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id_cart` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `harga` int(20) NOT NULL,
  `kuantiti` int(11) NOT NULL,
  `gambar` varchar(191) NOT NULL,
  `kategori` varchar(50) NOT NULL,
  `total` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id_cart`, `id_user`, `id_produk`, `nama`, `harga`, `kuantiti`, `gambar`, `kategori`, `total`) VALUES
(1, 1, 64, 'CPU Fan Water Cooler Blue', 1760000, 3, '2121010131311612084289fanwatercooler.jfif', 'Komputer', 1760000),
(7, 7, 65, 'GAMING CASE PRIME V[L] Black Yellow', 1300000, 1, '2222121212121670827343primegamingyellow.jpg', 'Komputer', 1300000),
(8, 7, 66, 'Galax GeForce RTX 3090 Hall Of Fame', 38000000, 1, '2222121212121670828433GalaxGeForceRTX3090HallOfFame.jpg', 'Komputer', 38000000);

-- --------------------------------------------------------

--
-- Table structure for table `histori`
--

CREATE TABLE `histori` (
  `id_histori` bigint(20) NOT NULL,
  `tglwaktu` date NOT NULL,
  `id_produk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `histori`
--

INSERT INTO `histori` (`id_histori`, `tglwaktu`, `id_produk`) VALUES
(8, '2022-12-25', 65);

-- --------------------------------------------------------

--
-- Table structure for table `kontak`
--

CREATE TABLE `kontak` (
  `id_kontak` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `tentang` varchar(50) NOT NULL,
  `pesan` text NOT NULL,
  `tgl` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kontak`
--

INSERT INTO `kontak` (`id_kontak`, `nama`, `email`, `tentang`, `pesan`, `tgl`) VALUES
(3, 'afdal ', 'afdalsage@gmail.com', 'Komputer', 'Wahh harganya murah sekali, jadi pengen beli lagi kack', '2022-12-12 08:41:22');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `id_pesan` varchar(20) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `nominal` int(20) NOT NULL,
  `gambar` varchar(191) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `id_pesan`, `nama`, `nominal`, `gambar`) VALUES
(3, '1219061106', 'Bayu Pamungkas', 9000000, '1171632372-2021-01-31-09-25-26-lenovoyoga.jpg'),
(4, '184795202', 'Bayu Pamungkas', 6760000, '1044008663-2021-02-01-04-45-52-Bukti-Transfer-BRI-Terbaru-dan-Terlengkap.jpg'),
(5, '1455538211', 'bayu', 62990000, '1688404207-2021-02-01-04-55-04-Bukti-Transfer-BRI-Terbaru-dan-Terlengkap.jpg'),
(6, '1774062785', 'afdal', 200000, '1856379540-2022-12-12-08-37-11-Screenshot 2022-11-15 105403.png');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `id_penjualan` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `jual` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`id_penjualan`, `id_produk`, `jual`) VALUES
(7, 63, 3),
(8, 64, 3),
(9, 59, 3),
(10, 58, 3),
(11, 66, 3),
(12, 65, 3),
(13, 62, 1);

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `nama` varchar(191) NOT NULL,
  `harga` int(20) NOT NULL,
  `stok` int(11) NOT NULL,
  `gambar` varchar(191) NOT NULL,
  `kategori` varchar(50) NOT NULL,
  `deskripsi` text NOT NULL,
  `createat` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updateat` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `nama`, `harga`, `stok`, `gambar`, `kategori`, `deskripsi`, `createat`, `updateat`) VALUES
(48, 'OPPO Reno4 F', 3999000, 100, '2121010124241611470863A93-listimage-white-v1.png', 'Ponsel', 'Dual SIM (Nano-SIM, dual stand-by)\r\nDisplay : 6.43, Super AMOLED, 430 nits (typ), 800 nits (peak)\r\nOS : Android 11, ColorOS 7.2\r\nChipset : Mediatek MT6779V Helio P95 (12 nm)\r\nMain Camera :48MP + 8MP wide angel + 2MP makro + 2MP potrait\r\nSelfie Camera : 16MP dan 2 MP\r\nUSB USB Type-C 2.0, USB On-The-Go\r\nNFC : No\r\nBattery :Li-Po 4000 mAh, non-removable\r\nRam 8GB + Room 128GB', '2022-12-19 14:58:47', '2022-12-19 08:57:45'),
(49, 'Redmi 7A', 1799000, 100, '2121010124241611447418C3M.png', 'Ponsel', 'Size 5.45 inches,\r\nResolution 720 x 1440 pixels, 18:9 ratio\r\nPLATFORM OS Android 9.0 (Pie); MIUI 9\r\nChipset Qualcomm SDM439 Snapdragon 439 (12 nm)\r\nCPU Octa-core RAM or 16 GB, 2 GB RAM\r\nMEMORY Card slot 256 GB (dedicated slot)\r\nMAIN CAMERA Single 13 MP,\r\nSELFIE CAMERA Single 5 MP\r\nBATTERY Non-removable Li-Po 4000 mAh battery', '2022-12-19 14:32:28', '0000-00-00 00:00:00'),
(57, 'OPPO A92', 1909999, 100, '2121010124241611450046A92-white.png', 'Ponsel', 'Dimensions/Weight\r\nHeight : 16.2cm / 162mm\r\nWidth : 7.55cm / 75.5mm\r\nThickness : 0.89cm / 8.9mm\r\nWeight : About 192g\r\n\r\nBasic Parameters\r\nOperating System : ColorOS 7, based on Android 10\r\nProcessor : Qualcomm Snapdragon 665 (SM6125)\r\nCPU frequency : 4*2.0Hz + 4*1.8GHz\r\nGPU Model: Adreno 610\r\nBattery : 4880/5000 mAh (min/typ ko)\r\nCharge Speed: 9V 2A?18W\r\nRAM : 8GB\r\nStorage : 128GB\r\nExternal Memory: Expandable up to 256GB\r\nScreen Size : 6.5\'\'\r\nTouchscreen : Multi-touch, Capacitive Screen\r\nResolution : 1080 x 2400\r\nScreen PPI : 405PPI\r\nSIM Card: Nano-SIM card / Nano-USIM card\r\nUSB Jack: TYPE-C USB 2.0\r\nHeadset Jack: 3.5mm\r\n\r\nCamera\r\nFront: 16M F2.2\r\nMain Camera : Quad Camera 12M+8M+2M+2M aperture F1.8\r\nSensor Size: 1/2.8\'\'/1.25um+1/4\'\'/1.12um+1/5\'\'/1.75um+1/5\'\'/1.75um\r\nFocal Lenght: 4.05mm+1.64mm+1.77mm+1.77mm\r\nImage Size: back 4112x3008 normal, front 4656x3504\r\n\r\nVideo\r\n4K/1080P/720P@30fps?default 1080P@30fps\r\nImage stabilizer: EIS\r\n\r\n5G Network: Not Supported\r\nOTG : Supported\r\nNFC : Not Supported', '2022-12-19 15:00:27', '0000-00-00 00:00:00'),
(58, 'Laptop lenovo', 6000000, 5, '2121010124241611450092lenovothinkpade480.jpg', 'Laptop', 'LENOVO IDEAPAD SLIM 1 14 RYZEN 3 7320U 8GB 256SSD W11+OHS 14.0FHD 2YR CLOUD GRAY -3HID\r\n\r\n\r\nProcessor : AMD Ryzen 3 7320U (4C / 8T, 2.4 / 4.1GHz, 2MB L2 / 4MB L3)\r\n\r\nDisplay : 14\" FHD (1920x1080) TN 220nits Anti-glare\r\n\r\nMemory : 8GB Soldered LPDDR5-5500, Memory soldered to systemboard, no slots\r\n\r\nStorage : 256GB SSD M.2 2242 PCIe 4.0x4 NVMe\r\n\r\nGraphics : Integrated AMD Radeon 610M Graphics\r\n\r\nKeyboard : Non-backlit, English\r\n\r\nFingerprint Reader : NON FINGERPRINT\r\n\r\nWireless : Wi-Fi 6 11ax, 2x2 + BT5.1\r\n\r\nConectivity : 1x USB 2.0\r\n1x USB 3.2 Gen 1\r\n1x USB-C 3.2 Gen 1 (support data transfer only)\r\n1x HDMI 1.4b\r\n1x Card reader\r\n1x Headphone / microphone combo jack (3.5mm)\r\n1x Power connector\r\n\r\nCamera : HD 720p with Privacy Shutter\r\n\r\nSpeakers : Stereo speakers, 1.5W x2, Dolby Audio\r\n\r\nBattery : Integrated 42Wh, 65W Round Tip (3-pin)\r\n\r\nOS : Windows 11 Home + OHS 2021', '2022-12-19 14:49:33', '0000-00-00 00:00:00'),
(60, 'Lenovo Yoga Slim 7 14ITL05', 12000000, 10, '2121010124241611487700lenovoyoga.jpg', 'Laptop', 'Processor Intel Core i5-1135G7 (4C / 8T, 2.4 / 4.2GHz, 8MB)\r\nGraphics Integrated Intel Iris Xe Graphics\r\nChipset Intel SoC Platform\r\nMemory 8GB Soldered DDR4-3200\r\nMemory Slots Memory soldered to systemboard, no slots, dual-channel\r\nMax Memory 8GB soldered memory, not upgradable\r\nStorage 512GB SSD M.2 2280 PCIe 4.0x4 NVMe\r\nStorage Support One drive, up to 1TB M.2 2280 SSD\r\nCard Reader MicroSD Card Reader\r\nOptical None\r\nAudio Chip High Definition (HD) Audio\r\nSpeakers Stereo speakers, 2W x2, Dolby Atmos, Dolby-branded\r\nCamera IR & 720p + ToF Sensor\r\nMicrophone 2x, Array\r\nBattery Integrated 60.7Wh\r\nMax Battery Life \"FHD non-touch model:\r\nMobileMark 2014: 15 hr\r\nLocal video (1080p) playback@150nits: 16 hr\"\r\nPower Adapter 65W USB-C Slim (3-pin)\r\nDESIGN\r\nDisplay 14\" FHD (1920x1080) IPS 300nits Anti-glare, 100% sRGB\r\nTouchscreen None\r\nKeyboard Backlit, English\r\nCase Color Dark Moss/Orchid\r\nSurface Treatment Anodizing Sandblasting\r\nCase Material Aluminium (Top), Aluminium (Bottom)\r\nDimensions (WxDxH) 320.6 x 208.18 x 14.9 mm (12.62 x 8.2 x 0.59 inches)\r\nWeight 1.36 kg (2.99 lbs)\r\nSOFTWARE\r\nOperating System Windows 11 Home 64, English\r\nBundled Software Office Home and Student 2021\r\nCONNECTIVITY\r\nEthernet None\r\nWLAN + Bluetooth 11ax, 2x2 + BT5.0\r\nStandard Ports \"1x Card reader\r\n1x USB 3.2 Gen 1\r\n1x USB 3.2 Gen 1 (Always On)\r\n1x HDMI 1.4b\r\n1x Headphone / microphone combo jack (3.5mm)\r\n2x Thunderbolt 4 / USB4 40Gbps (support data transfer, Power Delivery 3.0 and DisplayPort 1.4)\"\r\nSECURITY & PRIVACY\r\nSecurity Chip Firmware TPM 2.0\r\nFingerprint Reader None\r\nOther Security IR camera for Windows Hello\r\nSERVICE\r\nIncluded Upgrade 2Y ADP & 2Y Premium Care\r\nACCESSORIES\r\nBundled Accessories Lenovo Yoga 14-inch Sleeve\r\nCERTIFICATIONS\r\nGreen Certifications \"ENERGY STAR 8.0\r\nErP Lot 3\r\nRoHS compliant\"\r\nOther Certifications Intel Evo Platform', '2022-12-19 15:06:30', '0000-00-00 00:00:00'),
(61, 'Lenovo ThinkPad T15p', 20000000, 100, '2222121212121670826737leptoptingpet.jpg', 'Laptop', 'Processor intel Genuine 0000 ( 12Cpus )\r\nRam 16 Gb\r\nSsd 512 Gb\r\nVGA intel HD & Nvdia geforce 1650 With Q Max Design 4Gb dedicated Gddr6 ( Siap Render Editing Gaming Animation Dll )\r\n\r\nScreen 15,6 Inch\r\nResolusi FHD IPS 500nits Colour Gamout\r\nWebcam Berfungsi Normal\r\nAudio Speaker Normal\r\nBluetooth\r\nWifi\r\nKeyboard US Ada Versi Backlit & Non Backlit\r\nPort USB 3.0\r\nPort Thunderbolt / Type C\r\nPort LAN\r\nPort HDMI\r\nSlot Sd Card / Mmc\r\nPort Audio Jack\r\nBattery Normal Super Awet\r\nOs Win 11 Pro', '2022-12-19 15:08:16', '2022-12-12 07:32:17'),
(62, 'Mobo MSI Gaming', 2600000, 9, '2121010131311612084164mobomsigaming.jfif', 'Komputer', 'Mobo Gaming Haswell\r\nSoket 1150\r\nMinning bisa 7 slot VGA\r\nwork well tested', '2022-12-19 15:11:38', '0000-00-00 00:00:00'),
(63, 'AMD Ryzhen 9 5000X CPU 12 Core', 5000000, 9, '2121010131311612084235amdryzhen95900X.jpg', 'Komputer', 'Teknologi Core Boost menggabungkan premium layout MSI dan optimized power design yang memungkinkan pengiriman arus yang lebih cepat dan tidak terdistorsi ke CPU dengan presisi pin-point. Tidak hanya mendukung multi-core CPU, juga menciptakan kondisi yang sempurna untuk overclocking CPU Anda.Teknologi Core Boost menggabungkan premium layout MSI dan optimized power design yang memungkinkan pengiriman arus yang lebih cepat dan tidak terdistorsi ke CPU dengan presisi pin-point. Tidak hanya mendukung multi-core CPU, juga menciptakan kondisi yang sempurna untuk overclocking CPU Anda.', '2022-12-12 14:36:14', '2021-01-31 10:16:58'),
(64, 'CPU Fan Water Cooler Blue', 1760000, 3, '2121010131311612084289fanwatercooler.jfif', 'Komputer', 'Mendinginkan PC Anda adalah penting untuk kinerja yang andal. Motherboard MSI memiliki power design yang luar biasa dengan heatsink yang solid dan heavy. Kami telah memastikan untuk menyertakan fan headers yang cukup dengan kontrol penuh yang memungkinkan Anda untuk mendinginkan sistem sesuka Anda ', '2021-01-31 17:57:49', '0000-00-00 00:00:00'),
(65, 'GAMING CASE PRIME V[L] Black Yellow', 1300000, 49, '2222121212121670827343primegamingyellow.jpg', 'Komputer', 'Desain casing prima untuk komponen PC kelas atas Anda, dengan kaca temper sisi penuh berkualitas tinggi, sehingga Anda dapat memamerkan rig Anda', '2022-12-12 14:36:14', '2022-12-12 07:42:23'),
(66, 'Galax GeForce RTX 3090 Hall Of Fame', 38000000, 15, '2222121212121670828433GalaxGeForceRTX3090HallOfFame.jpg', 'Komputer', 'Gainward RTX 3090 Phoenix\r\nGPU GeForce RTX 3090\r\nGPU Clockspeed 1695 MHz (Boost)\r\nMemory 24 GB GDDR6X (384 bits)\r\nMemory Clockspeed 9750Mhz (19.5Gbps)\r\nBandwidth 936 GB/s\r\nBus PCI-Express Gen 4 x16\r\nCooling 2.7 Slot Fan Cooler\r\nVideo-Features HDMI v2.1\r\nConnectivity DisplayPort *3\r\nProduct Size 294mm x 112mm\r\nPower Connector 8-pin *2\r\n\r\nGaransi distributor resmi DTG :\r\nGainward RTX 3090 Phoenix : 2 tahun (1 tahun one to one replacement, 1 tahun service)', '2022-12-19 15:14:40', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `id_status` int(1) NOT NULL,
  `keterangan` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id_status`, `keterangan`) VALUES
(0, ''),
(1, 'Di proses'),
(2, 'Di kirim'),
(3, 'Di terima');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL,
  `id_pesan` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `pengirim` varchar(50) NOT NULL,
  `penerima` varchar(50) NOT NULL,
  `alamat` varchar(150) NOT NULL,
  `telepon` int(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `kuantiti_total` int(11) NOT NULL,
  `total_akhir` int(20) NOT NULL,
  `pembayaran` int(11) NOT NULL,
  `id_status` int(11) NOT NULL,
  `pesan_at` datetime NOT NULL,
  `kirim_at` datetime NOT NULL,
  `terima_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id`, `id_pesan`, `id_user`, `pengirim`, `penerima`, `alamat`, `telepon`, `email`, `kuantiti_total`, `total_akhir`, `pembayaran`, `id_status`, `pesan_at`, `kirim_at`, `terima_at`) VALUES
(6, 1774062785, 5, 'shroud', 'afda', 'jln raya ascent di pearl', 2147483647, 'afdalsage@gmail.com', 8, 198900000, 1, 3, '2022-12-12 08:36:14', '2022-12-12 08:38:09', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_detail`
--

CREATE TABLE `transaksi_detail` (
  `id_transaksi` int(11) NOT NULL,
  `id_pesan` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `kuantiti` int(11) NOT NULL,
  `total` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi_detail`
--

INSERT INTO `transaksi_detail` (`id_transaksi`, `id_pesan`, `id_produk`, `kuantiti`, `total`) VALUES
(1, 1219061106, 61, 1, 9000000),
(9, 1098598934, 63, 1, 5000000),
(10, 184795202, 63, 1, 5000000),
(11, 184795202, 64, 1, 1760000),
(12, 1455538211, 59, 10, 32990000),
(13, 1455538211, 58, 5, 30000000),
(14, 1774062785, 66, 5, 190000000),
(15, 1774062785, 65, 1, 1300000),
(16, 1774062785, 63, 1, 5000000),
(17, 1774062785, 62, 1, 2600000);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(191) NOT NULL,
  `email` varchar(50) NOT NULL,
  `sandi` varchar(191) NOT NULL,
  `image` varchar(191) NOT NULL,
  `role` varchar(15) NOT NULL,
  `createat` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updateat` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `nama`, `email`, `sandi`, `image`, `role`, `createat`, `updateat`) VALUES
(1, 'Azfa Dzulfaqar', 'musketeerhd@gmail.com', '$2y$10$JACVc4V32Jp/fpJJNWJc7eOT9F2sBQcYhZraZUWDrPz6W8R7/ElM6', 'default.png', '1', '2022-12-12 01:31:39', NULL),
(5, 'afdal', 'afdalsage@gmail.com', '$2y$10$o1TpHp1ARpXddvzoyypkeOjNj31x6P9ilX/PG7CbisJYS4CaDV5tq', 'default.png', '2', '2022-12-12 08:14:22', '0000-00-00 00:00:00'),
(6, 'Musketeer', 'musketeer@gmail.com', '$2y$10$5qBUb4gqj1asw5shJliWjeVgBHYsDTsgwF4ESuO7KaWNfgHtaSix.', 'default.png', '2', '2022-12-12 08:24:23', '0000-00-00 00:00:00'),
(7, 'cecepmarkecep', 'acepkecap@gmail.com', '$2y$10$lQ3Mbr6IruqHHyki21LVvucGrwgi89gi2dqI.TwuvmrMN3lUnwHOW', 'default.png', '2', '2022-12-25 02:33:42', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id_cart`);

--
-- Indexes for table `histori`
--
ALTER TABLE `histori`
  ADD PRIMARY KEY (`id_histori`),
  ADD UNIQUE KEY `id_produk` (`id_produk`);

--
-- Indexes for table `kontak`
--
ALTER TABLE `kontak`
  ADD PRIMARY KEY (`id_kontak`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`),
  ADD UNIQUE KEY `id_pesan` (`id_pesan`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id_penjualan`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id_status`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_pesan`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id_cart` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `histori`
--
ALTER TABLE `histori`
  MODIFY `id_histori` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `kontak`
--
ALTER TABLE `kontak`
  MODIFY `id_kontak` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id_penjualan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
