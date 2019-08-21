-- Adminer 4.2.5 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `uid` varchar(20) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `nama` varchar(100) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `password` varchar(32) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `status` char(1) COLLATE latin1_general_ci DEFAULT '0',
  `online` char(1) COLLATE latin1_general_ci DEFAULT '0',
  `lastaktif` datetime DEFAULT NULL,
  `ipaddr` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `sesino` int(11) DEFAULT NULL,
  `jenis_user` text COLLATE latin1_general_ci,
  `hak_akses` text COLLATE latin1_general_ci,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci ROW_FORMAT=COMPACT;

INSERT INTO `admin` (`uid`, `nama`, `password`, `status`, `online`, `lastaktif`, `ipaddr`, `sesino`, `jenis_user`, `hak_akses`) VALUES
('gobag',	'Gobag',	'827ccb0eea8a706c4c34a16891f84e7b',	'1',	'0',	NULL,	NULL,	NULL,	'operator',	'[{\"jenis\":\"bank\",\"id\":\"2\"},{\"jenis\":\"kas\",\"id\":\"1\"},{\"jenis\":\"kas\",\"id\":\"2\"}]'),
('kszxpo',	'VulnWalker',	'a3bf5a28aef3c4d7d3d3417d7b41f023',	'1',	'0',	'2018-07-14 04:15:57',	'107.170.244.203',	652928885,	'admin',	'[{\"jenis\":\"bank\",\"id\":\"1\"},{\"jenis\":\"bank\",\"id\":\"3\"},{\"jenis\":\"bank\",\"id\":\"2\"},{\"jenis\":\"kas\",\"id\":\"1\"},{\"jenis\":\"kas\",\"id\":\"2\"},{\"jenis\":\"bank\",\"id\":\"4\"}]'),
('NADIA',	'NADIA',	'827ccb0eea8a706c4c34a16891f84e7b',	'1',	'0',	NULL,	NULL,	NULL,	'operator',	'[{\"jenis\":\"kas\",\"id\":\"1\"}]'),
('SA',	'Iwan Hardiwan',	'e10adc3949ba59abbe56e057f20f883e',	'1',	'0',	'2018-07-12 00:16:08',	'36.71.232.22',	754632127,	'operator',	'[{\"jenis\":\"bank\",\"id\":\"1\"},{\"jenis\":\"bank\",\"id\":\"3\"},{\"jenis\":\"bank\",\"id\":\"2\"},{\"jenis\":\"kas\",\"id\":\"1\"},{\"jenis\":\"kas\",\"id\":\"2\"},{\"jenis\":\"bank\",\"id\":\"4\"}]');

DROP TABLE IF EXISTS `angsuran_pinjaman`;
CREATE TABLE `angsuran_pinjaman` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_pinjaman` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `jumlah` decimal(18,2) NOT NULL,
  `nomor_bukti` text COLLATE latin1_general_ci NOT NULL,
  `uraian` text COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;


DROP TABLE IF EXISTS `buku_umum`;
CREATE TABLE `buku_umum` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_kas` int(11) NOT NULL,
  `id_bank` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `kredit` decimal(18,2) NOT NULL,
  `debit` decimal(18,2) NOT NULL,
  `jenis_transaksi` text COLLATE latin1_general_ci NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

INSERT INTO `buku_umum` (`id`, `id_kas`, `id_bank`, `tanggal`, `kredit`, `debit`, `jenis_transaksi`, `id_transaksi`) VALUES
(46,	0,	1,	'2018-01-02',	500000000.00,	0.00,	'SALDO AWAL',	18),
(47,	0,	3,	'2018-01-02',	500000000.00,	0.00,	'SALDO AWAL',	19),
(48,	0,	2,	'2018-01-02',	500000000.00,	0.00,	'SALDO AWAL',	20),
(49,	1,	0,	'2018-01-02',	5000000.00,	0.00,	'SALDO AWAL',	21),
(50,	2,	0,	'2018-01-02',	0.00,	0.00,	'SALDO AWAL',	22),
(51,	0,	4,	'2018-01-02',	10000000.00,	0.00,	'SALDO AWAL',	23),
(52,	1,	0,	'2018-07-12',	0.00,	1000000.00,	'PENGELUARAN KAS',	4),
(53,	1,	0,	'2018-07-12',	0.00,	1000000.00,	'PENGELUARAN KAS',	5),
(56,	0,	1,	'2018-07-12',	0.00,	500000.00,	'MUTASI BANK KE KAS',	5),
(57,	1,	0,	'2018-07-12',	500000.00,	0.00,	'MUTASI BANK KE KAS',	5),
(58,	0,	2,	'2018-07-12',	2300000.00,	0.00,	'PENERIMAAN BANK',	3);

DROP TABLE IF EXISTS `cashbon`;
CREATE TABLE `cashbon` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` text COLLATE latin1_general_ci NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `jenis_akun` int(11) NOT NULL,
  `id_akun` int(11) NOT NULL,
  `status` text COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;


DROP TABLE IF EXISTS `debit`;
CREATE TABLE `debit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` date NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `jenis_akun` text COLLATE latin1_general_ci NOT NULL,
  `id_akun` text COLLATE latin1_general_ci NOT NULL,
  `dokumen` text COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_transaksi` (`id_transaksi`),
  CONSTRAINT `debit_ibfk_1` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;


DROP TABLE IF EXISTS `detail_spj`;
CREATE TABLE `detail_spj` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_spj` int(11) NOT NULL,
  `item` text COLLATE latin1_general_ci NOT NULL,
  `jumlah` int(11) NOT NULL,
  `satuan` text COLLATE latin1_general_ci NOT NULL,
  `harga` decimal(18,2) NOT NULL,
  `total` decimal(18,2) NOT NULL,
  `username` text COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;


DROP TABLE IF EXISTS `kredit`;
CREATE TABLE `kredit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` date NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `jenis_akun` text COLLATE latin1_general_ci NOT NULL,
  `id_akun` int(11) NOT NULL,
  `dokumen` text COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;


DROP TABLE IF EXISTS `mutasi`;
CREATE TABLE `mutasi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` text COLLATE latin1_general_ci NOT NULL,
  `jenis_mutasi` text COLLATE latin1_general_ci NOT NULL,
  `asal` int(11) NOT NULL,
  `tujuan` int(11) NOT NULL,
  `jumlah` decimal(18,2) NOT NULL,
  `username` text COLLATE latin1_general_ci NOT NULL,
  `nomor_bukti` text COLLATE latin1_general_ci NOT NULL,
  `metode_transaksi` text COLLATE latin1_general_ci NOT NULL,
  `uraian` text COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

INSERT INTO `mutasi` (`id`, `tanggal`, `jenis_mutasi`, `asal`, `tujuan`, `jumlah`, `username`, `nomor_bukti`, `metode_transaksi`, `uraian`) VALUES
(5,	'2018-07-12',	'2',	1,	1,	500000.00,	'kszxpo',	'22323',	'1',	'23');

DROP TABLE IF EXISTS `pembayaran_pinjaman`;
CREATE TABLE `pembayaran_pinjaman` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` date NOT NULL,
  `id_pinjaman` int(11) NOT NULL,
  `jenis_pinjaman` int(11) NOT NULL,
  `jumlah` decimal(18,2) NOT NULL,
  `dokumen` text COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;


DROP TABLE IF EXISTS `penerimaan`;
CREATE TABLE `penerimaan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` date NOT NULL,
  `id_bank` int(11) NOT NULL,
  `id_kas` int(11) NOT NULL,
  `jenis_penerimaan` text COLLATE latin1_general_ci NOT NULL,
  `id_projek` int(11) NOT NULL,
  `id_pihak_luar` int(11) NOT NULL,
  `jumlah` decimal(18,2) NOT NULL,
  `nomor_bukti` text COLLATE latin1_general_ci NOT NULL,
  `uraian` text COLLATE latin1_general_ci NOT NULL,
  `metode_transaksi` text COLLATE latin1_general_ci NOT NULL,
  `kode_rekening_1` text COLLATE latin1_general_ci NOT NULL,
  `kode_rekening_2` text COLLATE latin1_general_ci NOT NULL,
  `kode_rekening_3` text COLLATE latin1_general_ci NOT NULL,
  `kode_rekening_4` text COLLATE latin1_general_ci NOT NULL,
  `username` text COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

INSERT INTO `penerimaan` (`id`, `tanggal`, `id_bank`, `id_kas`, `jenis_penerimaan`, `id_projek`, `id_pihak_luar`, `jumlah`, `nomor_bukti`, `uraian`, `metode_transaksi`, `kode_rekening_1`, `kode_rekening_2`, `kode_rekening_3`, `kode_rekening_4`, `username`) VALUES
(3,	'2018-07-12',	2,	0,	'2',	1,	0,	2300000.00,	'66',	'666',	'1',	'4',	'1',	'2',	'03',	'kszxpo');

DROP TABLE IF EXISTS `pengeluaran`;
CREATE TABLE `pengeluaran` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` date NOT NULL,
  `id_bank` int(11) NOT NULL,
  `id_kas` int(11) NOT NULL,
  `jenis_pengeluaran` text COLLATE latin1_general_ci NOT NULL,
  `id_projek` int(11) NOT NULL,
  `id_pihak_luar` int(11) NOT NULL,
  `jumlah` decimal(18,2) NOT NULL,
  `nomor_bukti` text COLLATE latin1_general_ci NOT NULL,
  `metode_transaksi` text COLLATE latin1_general_ci NOT NULL,
  `uraian` text COLLATE latin1_general_ci NOT NULL,
  `kode_rekening_1` text COLLATE latin1_general_ci NOT NULL,
  `kode_rekening_2` text COLLATE latin1_general_ci NOT NULL,
  `kode_rekening_3` text COLLATE latin1_general_ci NOT NULL,
  `kode_rekening_4` text COLLATE latin1_general_ci NOT NULL,
  `username` text COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

INSERT INTO `pengeluaran` (`id`, `tanggal`, `id_bank`, `id_kas`, `jenis_pengeluaran`, `id_projek`, `id_pihak_luar`, `jumlah`, `nomor_bukti`, `metode_transaksi`, `uraian`, `kode_rekening_1`, `kode_rekening_2`, `kode_rekening_3`, `kode_rekening_4`, `username`) VALUES
(4,	'2018-07-12',	0,	1,	'1',	0,	0,	1000000.00,	'01',	'1',	'Bayar Listrik Bulan Jan',	'5',	'1',	'2',	'01',	'SA'),
(5,	'2018-07-12',	0,	1,	'2',	1,	0,	1000000.00,	'02',	'1',	'Penagihan',	'5',	'3',	'2',	'01',	'SA');

DROP TABLE IF EXISTS `pengeluaran_spj`;
CREATE TABLE `pengeluaran_spj` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nomor_spj` text COLLATE latin1_general_ci NOT NULL,
  `tanggal` date NOT NULL,
  `id_bank` int(11) NOT NULL,
  `id_kas` int(11) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `kode_rekening_1` text COLLATE latin1_general_ci NOT NULL,
  `kode_rekening_2` text COLLATE latin1_general_ci NOT NULL,
  `kode_rekening_3` text COLLATE latin1_general_ci NOT NULL,
  `kode_rekening_4` text COLLATE latin1_general_ci NOT NULL,
  `jumlah` decimal(18,2) NOT NULL,
  `uraian` text COLLATE latin1_general_ci NOT NULL,
  `nomor_bukti` text COLLATE latin1_general_ci NOT NULL,
  `metode_transaksi` text COLLATE latin1_general_ci NOT NULL,
  `username` text COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;


DROP TABLE IF EXISTS `pertanggung_jawaban_spj`;
CREATE TABLE `pertanggung_jawaban_spj` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_spj` int(11) NOT NULL,
  `rincian` text COLLATE latin1_general_ci NOT NULL,
  `harga` decimal(18,2) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `total` decimal(18,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;


DROP TABLE IF EXISTS `pinjaman`;
CREATE TABLE `pinjaman` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nomor_pinjaman` text COLLATE latin1_general_ci NOT NULL,
  `tanggal` date NOT NULL,
  `id_bank` int(11) NOT NULL,
  `id_kas` int(11) NOT NULL,
  `jenis_pinjaman` text COLLATE latin1_general_ci NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `id_pihak_luar` int(11) NOT NULL,
  `jumlah` decimal(18,2) NOT NULL,
  `nomor_bukti` text COLLATE latin1_general_ci NOT NULL,
  `metode_transaksi` text COLLATE latin1_general_ci NOT NULL,
  `uraian` text COLLATE latin1_general_ci NOT NULL,
  `kode_rekening_1` text COLLATE latin1_general_ci NOT NULL,
  `kode_rekening_2` text COLLATE latin1_general_ci NOT NULL,
  `kode_rekening_3` text COLLATE latin1_general_ci NOT NULL,
  `kode_rekening_4` text COLLATE latin1_general_ci NOT NULL,
  `username` text COLLATE latin1_general_ci NOT NULL,
  `status` text COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;


DROP TABLE IF EXISTS `pinjaman_karyawan`;
CREATE TABLE `pinjaman_karyawan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_pinjaman` text COLLATE latin1_general_ci NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `jenis_akun` int(11) NOT NULL,
  `id_akun` int(11) NOT NULL,
  `dokumen` text COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;


DROP TABLE IF EXISTS `pinjaman_pihak_luar`;
CREATE TABLE `pinjaman_pihak_luar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_pinjaman` int(11) NOT NULL,
  `id_pihak_luar` int(11) NOT NULL,
  `jenis_akun` int(11) NOT NULL,
  `id_akun` int(11) NOT NULL,
  `dokumen` text COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;


DROP TABLE IF EXISTS `ref_bank`;
CREATE TABLE `ref_bank` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nomor_rekening` text COLLATE latin1_general_ci NOT NULL,
  `nama_bank` text COLLATE latin1_general_ci NOT NULL,
  `cabang` text COLLATE latin1_general_ci NOT NULL,
  `atas_nama` text COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

INSERT INTO `ref_bank` (`id`, `nomor_rekening`, `nama_bank`, `cabang`, `atas_nama`) VALUES
(1,	'01',	'BJB CAB SARIJADI',	'SARIJADI',	'PT PILAR WAHANA ARTHA'),
(2,	'02',	'BJB CAB EQUITAS',	'EQUITAS',	'PT PILAR WAHANA ARTHA'),
(3,	'03',	'BJB CAB SUCI',	'SUCI',	'CV EXACON GUNA BANGSA'),
(4,	'04',	'BRI CAB CITAMIANG',	'CITAMIANG',	'HARDIWAN');

DROP TABLE IF EXISTS `ref_kas`;
CREATE TABLE `ref_kas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kas` text COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

INSERT INTO `ref_kas` (`id`, `nama_kas`) VALUES
(1,	'KAS KANTOR BANDUNG');

DROP TABLE IF EXISTS `ref_pegawai`;
CREATE TABLE `ref_pegawai` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nik` text COLLATE latin1_general_ci NOT NULL,
  `nama` text COLLATE latin1_general_ci NOT NULL,
  `kelamin` text COLLATE latin1_general_ci NOT NULL,
  `alamat` text COLLATE latin1_general_ci NOT NULL,
  `nomor_hp` text COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

INSERT INTO `ref_pegawai` (`id`, `nik`, `nama`, `kelamin`, `alamat`, `nomor_hp`) VALUES
(1,	'001',	'Dzakir Harist Abdullah',	'1',	'Kp. Cibeber Hilir RT 02/02, Batujajar, Bandung Barat',	'081223744803');

DROP TABLE IF EXISTS `ref_pemda`;
CREATE TABLE `ref_pemda` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_pemda` text COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

INSERT INTO `ref_pemda` (`id`, `nama_pemda`) VALUES
(1,	'Bandung Barat'),
(2,	'Kota Bandung'),
(3,	'Kabupaten Serang'),
(4,	'Kota Serang'),
(5,	'Kabupaten Pandeglang'),
(6,	'Karawang'),
(8,	'Tasik Malaya'),
(9,	'Jawa Barat'),
(10,	'Garut'),
(11,	'Bogor'),
(12,	'Cirebon'),
(13,	'Subang'),
(14,	'Sukabumi');

DROP TABLE IF EXISTS `ref_pihak_luar`;
CREATE TABLE `ref_pihak_luar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` text COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

INSERT INTO `ref_pihak_luar` (`id`, `nama`) VALUES
(1,	'Dealer Honda'),
(2,	'Tukang Galon'),
(3,	'Tukang Koran');

DROP TABLE IF EXISTS `ref_projek`;
CREATE TABLE `ref_projek` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tahun` text COLLATE latin1_general_ci NOT NULL,
  `nama_projek` text COLLATE latin1_general_ci NOT NULL,
  `nama_pemda` text COLLATE latin1_general_ci NOT NULL,
  `status` text COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

INSERT INTO `ref_projek` (`id`, `tahun`, `nama_projek`, `nama_pemda`, `status`) VALUES
(1,	'2018',	'Pengembangan Atisisbada',	'1',	'1');

DROP TABLE IF EXISTS `ref_rekening`;
CREATE TABLE `ref_rekening` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_rekening_1` char(1) COLLATE latin1_general_ci NOT NULL,
  `kode_rekening_2` char(1) COLLATE latin1_general_ci NOT NULL,
  `kode_rekening_3` char(2) COLLATE latin1_general_ci NOT NULL,
  `kode_rekening_4` char(3) COLLATE latin1_general_ci NOT NULL,
  `nama_rekening` text COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci ROW_FORMAT=COMPACT;

INSERT INTO `ref_rekening` (`id`, `kode_rekening_1`, `kode_rekening_2`, `kode_rekening_3`, `kode_rekening_4`, `nama_rekening`) VALUES
(1,	'4',	'0',	'0',	'00',	'Penerimaan'),
(2,	'4',	'1',	'0',	'00',	'Penerimaan Rutin'),
(3,	'4',	'1',	'1',	'00',	'Penerimaan Bulanan'),
(4,	'4',	'1',	'1',	'01',	'Penerimaan Jasa Sewa Penyimpanan Server'),
(5,	'4',	'1',	'2',	'00',	'Penerimaan Sewaktu'),
(6,	'4',	'1',	'2',	'01',	'Penerimaan Honor Narasumber Bimtek'),
(7,	'4',	'1',	'2',	'02',	'Penerimaan Pendaftaran Peserta Bimtek'),
(8,	'4',	'1',	'2',	'03',	'Penerimaan Jasa Intallasi Server'),
(9,	'4',	'1',	'2',	'04',	'Penerimaan Jasa Migrasi Database'),
(10,	'4',	'2',	'0',	'00',	'Penerimaan Projek'),
(11,	'4',	'2',	'1',	'00',	'Penerimaan Projek Pengembangan aplikasi'),
(12,	'4',	'2',	'1',	'01',	'Penerimaan Projek Pengembangan aplikasi ATISISBADA'),
(13,	'4',	'2',	'1',	'02',	'Penerimaan Projek Pengembangan aplikasi SIAP'),
(14,	'4',	'2',	'1',	'03',	'Penerimaan Projek Pengembangan aplikasi SPD'),
(15,	'4',	'2',	'1',	'04',	'Penerimaan Projek Pengembangan aplikasi Keuangan'),
(16,	'4',	'2',	'1',	'05',	'Penerimaan Projek Pengembangan aplikasi Lainnya'),
(17,	'4',	'2',	'2',	'00',	'Penerimaan Projek Pengadaan Barang'),
(18,	'4',	'2',	'2',	'01',	'Penerimaan Projek Pengadaan Barang Server'),
(19,	'4',	'2',	'2',	'02',	'Penerimaan Projek Pengadaan Barang Printer Barcode'),
(20,	'4',	'2',	'2',	'03',	'Penerimaan Projek Pengadaan Barang Scaner Barcode'),
(21,	'4',	'2',	'2',	'04',	'Penerimaan Projek Pengadaan Barang Lainnya'),
(22,	'4',	'2',	'3',	'00',	'Penerimaan Projek Pengadaan Label'),
(23,	'4',	'2',	'3',	'01',	'Penerimaan Projek Pengadaan Label Barcode Barang'),
(24,	'4',	'2',	'3',	'02',	'Penerimaan Projek Pengadaan Label dan Print Barcode Barang'),
(25,	'4',	'3',	'0',	'00',	'Penerimaan Lain-lain'),
(26,	'4',	'3',	'1',	'00',	'Penerimaan Fee Bendera'),
(27,	'4',	'3',	'1',	'01',	'Penerimaan Fee Bendera PT. PILAR'),
(28,	'4',	'3',	'1',	'02',	'Penerimaan Fee Bendera CV. EXACON'),
(29,	'5',	'0',	'0',	'00',	'Pengeluaran'),
(30,	'5',	'1',	'0',	'00',	'Pengeluaran Rutin'),
(31,	'5',	'1',	'1',	'00',	'Pengeluaran Gaji'),
(32,	'5',	'1',	'1',	'01',	'Biaya Gaji Tenaga Kerja'),
(33,	'5',	'1',	'1',	'02',	'Biaya Gaji Tenaga Kerja Tidak Tetap'),
(34,	'5',	'1',	'2',	'00',	'Pengeluaran Operasional Kantor '),
(35,	'5',	'1',	'2',	'01',	'Biaya Listrik'),
(36,	'5',	'1',	'2',	'02',	'Biaya Telp/Indihome'),
(37,	'5',	'1',	'2',	'03',	'Biaya Air/PDAM'),
(38,	'5',	'1',	'2',	'04',	'Biaya Makan dan Minum'),
(39,	'5',	'1',	'2',	'05',	'Biaya Kebersihan Kantor'),
(40,	'5',	'2',	'0',	'00',	'Pengeluaran Sewaktu'),
(41,	'5',	'2',	'1',	'00',	'Pengeluaran Pemeliharaan'),
(42,	'5',	'2',	'1',	'01',	'Biaya Pemeliharaan Kantor'),
(43,	'5',	'2',	'1',	'02',	'Biaya Pemeliharaan Peralatan Kantor'),
(44,	'5',	'2',	'1',	'03',	'Biaya Pembelian Tinta/Toner Printer'),
(45,	'5',	'2',	'1',	'04',	'Biaya Pemeliharaan Lainnya'),
(46,	'5',	'2',	'2',	'00',	'Pengeluaran Pengadaan Peralatan'),
(47,	'5',	'2',	'2',	'01',	'Biaya Pengadaan Komputer/Printer'),
(48,	'5',	'2',	'2',	'02',	'Biaya Pengadaan Peralatan Jaringan/Internet'),
(49,	'5',	'2',	'2',	'03',	'Biaya Pengadaan Meubelair'),
(50,	'5',	'3',	'0',	'00',	'Pengeluaran Projek'),
(51,	'5',	'3',	'1',	'00',	'Pengeluaran Operasional'),
(52,	'5',	'3',	'1',	'01',	'Biaya Bensin/Parkir'),
(53,	'5',	'3',	'1',	'02',	'Honor Tenaga Lepas'),
(54,	'5',	'3',	'2',	'00',	'Pengeluaran Administrasi'),
(55,	'5',	'3',	'2',	'01',	'Biaya Berkas Penagihan'),
(56,	'5',	'3',	'2',	'02',	'Biaya Pelaporan Projek'),
(57,	'5',	'3',	'3',	'00',	'Pengeluaran Marketing'),
(58,	'5',	'3',	'3',	'01',	'Biaya Operasional Marketing'),
(59,	'5',	'3',	'3',	'02',	'Biaya Fee Marketing');

DROP TABLE IF EXISTS `ref_tahun_anggaran`;
CREATE TABLE `ref_tahun_anggaran` (
  `tahun` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal_saldo_awal` date NOT NULL,
  `status` text COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`tahun`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

INSERT INTO `ref_tahun_anggaran` (`tahun`, `tanggal_saldo_awal`, `status`) VALUES
(2018,	'2018-01-02',	'AKTIF'),
(2019,	'2019-01-02',	''),
(2020,	'2020-01-02',	'');

DROP TABLE IF EXISTS `saldo_awal`;
CREATE TABLE `saldo_awal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` date NOT NULL,
  `id_kas` int(11) NOT NULL,
  `id_bank` int(11) NOT NULL,
  `jumlah` decimal(18,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

INSERT INTO `saldo_awal` (`id`, `tanggal`, `id_kas`, `id_bank`, `jumlah`) VALUES
(18,	'2018-01-02',	0,	1,	500000000.00),
(19,	'2018-01-02',	0,	3,	500000000.00),
(20,	'2018-01-02',	0,	2,	500000000.00),
(21,	'2018-01-02',	1,	0,	5000000.00),
(22,	'2018-01-02',	2,	0,	0.00),
(23,	'2018-01-02',	0,	4,	10000000.00);

DROP TABLE IF EXISTS `setting`;
CREATE TABLE `setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tahun_anggaran` int(11) NOT NULL,
  `tanggal_saldo_awal` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

INSERT INTO `setting` (`id`, `tahun_anggaran`, `tanggal_saldo_awal`) VALUES
(1,	2018,	'2018-01-02');

DROP TABLE IF EXISTS `spj`;
CREATE TABLE `spj` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_transaksi` int(11) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `jenis_akun` int(11) NOT NULL,
  `id_akun` int(11) NOT NULL,
  `nama_spj` text COLLATE latin1_general_ci NOT NULL,
  `keterangan` text COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;


DROP TABLE IF EXISTS `tanggung_jawab_spj`;
CREATE TABLE `tanggung_jawab_spj` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_spj` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `total_terpakai` decimal(18,2) NOT NULL,
  `total_sisa` decimal(18,2) NOT NULL,
  `total_kekurangan` decimal(18,2) NOT NULL,
  `username` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;


DROP TABLE IF EXISTS `temp_detail_spj`;
CREATE TABLE `temp_detail_spj` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_spj` int(11) NOT NULL,
  `item` text COLLATE latin1_general_ci NOT NULL,
  `jumlah` int(11) NOT NULL,
  `satuan` text COLLATE latin1_general_ci NOT NULL,
  `harga` decimal(18,2) NOT NULL,
  `total` decimal(18,2) NOT NULL,
  `username` text COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;


DROP TABLE IF EXISTS `temp_hak_akses`;
CREATE TABLE `temp_hak_akses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jenis` text COLLATE latin1_general_ci NOT NULL,
  `id_kas_bank` int(11) NOT NULL,
  `status` text COLLATE latin1_general_ci NOT NULL,
  `username` text COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;


DROP TABLE IF EXISTS `transaksi`;
CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` date NOT NULL,
  `kategori` text COLLATE latin1_general_ci NOT NULL,
  `jenis_transaksi` text COLLATE latin1_general_ci NOT NULL,
  `jumlah` decimal(18,2) NOT NULL,
  `keterangan` text COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;


-- 2018-07-13 21:16:11