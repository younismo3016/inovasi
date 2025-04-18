-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 20, 2013 at 02:14 AM
-- Server version: 5.1.36
-- PHP Version: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `audit`
--

-- --------------------------------------------------------

--
-- Table structure for table `pegawai_ptj`
--

CREATE TABLE IF NOT EXISTS `pegawai_ptj` (
  `id_pegawai_ptj` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(80) DEFAULT NULL,
  `no_tel` varchar(14) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `jawatan` varchar(45) DEFAULT NULL,
  `status_aktif` tinyint(1) DEFAULT '1' COMMENT ' 0 =tak aktif1= aktif',
  `cipta_oleh` int(11) DEFAULT NULL,
  `cipta_pada` datetime DEFAULT NULL,
  `kemaskini_oleh` int(11) DEFAULT NULL,
  `kemaskini_pada` timestamp NULL DEFAULT NULL,
  KEY `id_pegawai_ptj` (`id_pegawai_ptj`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `pegawai_ptj`
--


-- --------------------------------------------------------

--
-- Table structure for table `penerimaan`
--

CREATE TABLE IF NOT EXISTS `penerimaan` (
  `id_penerimaan` int(11) NOT NULL AUTO_INCREMENT,
  `tarikh_semak` date NOT NULL COMMENT 'Tarikh mula semakan dibuat',
  `tarikh_terima` date NOT NULL COMMENT 'Tarikh terima dikaunter terimaan',
  `tarikh_siap_semak` date NOT NULL COMMENT 'Tarikh siap semak semua dokumen',
  `tarikh_kuiri` date NOT NULL COMMENT 'Tarikh pertanyaan dokumen tidak lengkap dan tarikh mula surat peringatan dikira',
  `tahun_terima` varchar(20) NOT NULL,
  `bulan_kkwt` varchar(15) NOT NULL COMMENT 'Bulan penerimaan dokumen',
  `bil_resit` int(10) NOT NULL COMMENT 'jumlah bilangan resit yang diterima',
  `jumlah_hasil` varchar(20) NOT NULL COMMENT 'Jumlah hasil kutipan resit(RM)',
  `status` varchar(20) NOT NULL COMMENT 'Status penerimaan dokumen sudah diterima atau belum diterima',
  `tarikh_surat_peringatan1` date NOT NULL COMMENT 'Tarikh surat peringatan dihantar kali pertama',
  `tarikh_surat_peringatan2` date NOT NULL COMMENT 'Tarikh surat peringatan dihantar kali kedua',
  `tarikh_surat_peringatan3` date NOT NULL COMMENT 'Tarikh surat peringatan dihantar kali ketiga',
  `id_ptj` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `cipta_oleh` varchar(11) NOT NULL,
  `cipta_pada` datetime NOT NULL,
  `kemaskini_oleh` varchar(11) NOT NULL,
  `kemaskini_pada` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_penerimaan`),
  KEY `id_ptj` (`id_ptj`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=143 ;

--
-- Dumping data for table `penerimaan`
--

INSERT INTO `penerimaan` (`id_penerimaan`, `tarikh_semak`, `tarikh_terima`, `tarikh_siap_semak`, `tarikh_kuiri`, `tahun_terima`, `bulan_kkwt`, `bil_resit`, `jumlah_hasil`, `status`, `tarikh_surat_peringatan1`, `tarikh_surat_peringatan2`, `tarikh_surat_peringatan3`, `id_ptj`, `id_user`, `cipta_oleh`, `cipta_pada`, `kemaskini_oleh`, `kemaskini_pada`) VALUES
(1, '2013-06-06', '2013-04-17', '2013-04-16', '2013-04-17', '', '', 11, '22222', '', '2013-04-16', '2013-04-16', '0000-00-00', 0, 0, '', '0000-00-00 00:00:00', '', '2013-06-06 16:20:49'),
(46, '2013-06-06', '2013-04-17', '2013-06-06', '0000-00-00', '', 'JUN', 11, '22222', '', '0000-00-00', '0000-00-00', '0000-00-00', 0, 0, '', '0000-00-00 00:00:00', '', '2013-06-06 16:20:49'),
(63, '0000-00-00', '2013-04-18', '0000-00-00', '0000-00-00', '', 'MAC', 0, '', '', '0000-00-00', '0000-00-00', '0000-00-00', 5, 0, '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
(64, '0000-00-00', '2013-04-19', '0000-00-00', '0000-00-00', '', 'MAC', 0, '', '', '0000-00-00', '0000-00-00', '0000-00-00', 5, 0, '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
(65, '0000-00-00', '2013-04-27', '0000-00-00', '0000-00-00', '', 'OKTOBER', 0, '', '', '0000-00-00', '0000-00-00', '0000-00-00', 2, 0, '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
(104, '2013-02-13', '2013-04-21', '0000-00-00', '0000-00-00', '', 'FEBRUARI', 0, '', '', '2013-04-25', '0000-00-00', '0000-00-00', 22, 0, '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
(105, '2013-04-23', '2013-04-21', '0000-00-00', '0000-00-00', '', 'FEBRUARI', 12, '12300', '', '0000-00-00', '0000-00-00', '0000-00-00', 22, 0, '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
(106, '2013-04-23', '2013-04-27', '0000-00-00', '0000-00-00', '', 'APRIL', 0, '', '', '0000-00-00', '0000-00-00', '0000-00-00', 29, 0, '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
(107, '2013-06-06', '2013-04-19', '0000-00-00', '0000-00-00', '', 'FEBRUARI', 111, '1111111', '', '0000-00-00', '0000-00-00', '0000-00-00', 19, 0, '', '0000-00-00 00:00:00', '', '2013-06-06 16:23:12'),
(108, '2013-04-20', '2013-04-23', '0000-00-00', '0000-00-00', '', 'OKTOBER', 0, '', '', '0000-00-00', '0000-00-00', '0000-00-00', 21, 0, '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
(109, '2013-06-06', '2013-02-08', '0000-00-00', '0000-00-00', '', 'FEBRUARI', 111, '1111111', '', '0000-00-00', '0000-00-00', '0000-00-00', 19, 0, '', '0000-00-00 00:00:00', '', '2013-06-06 16:23:12'),
(110, '2013-04-19', '2013-02-21', '0000-00-00', '0000-00-00', '', 'FEBRUARI', 4, '100,1000', '', '0000-00-00', '0000-00-00', '0000-00-00', 22, 0, '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
(111, '0000-00-00', '2013-04-12', '0000-00-00', '0000-00-00', '', 'FEBRUARI', 0, '', '', '0000-00-00', '0000-00-00', '0000-00-00', 1, 0, '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
(112, '0000-00-00', '2013-02-12', '0000-00-00', '0000-00-00', '', 'FEBRUARI', 0, '', '', '0000-00-00', '0000-00-00', '0000-00-00', 1, 0, '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
(113, '2013-06-06', '2013-04-24', '0000-00-00', '0000-00-00', '', 'JANUARI', 111, '1111111', '', '2013-04-30', '0000-00-00', '0000-00-00', 19, 0, '', '0000-00-00 00:00:00', '', '2013-06-06 16:23:12'),
(114, '2013-04-23', '2013-04-22', '0000-00-00', '0000-00-00', '', 'MEI', 5, '5000', '', '0000-00-00', '0000-00-00', '0000-00-00', 27, 0, '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
(115, '0000-00-00', '2013-05-05', '0000-00-00', '0000-00-00', '', 'MEI', 0, '', '', '0000-00-00', '0000-00-00', '0000-00-00', 33, 0, '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
(116, '0000-00-00', '2013-05-05', '0000-00-00', '0000-00-00', '', 'JUN', 0, '', '', '0000-00-00', '0000-00-00', '0000-00-00', 33, 0, '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
(117, '0000-00-00', '2013-04-22', '0000-00-00', '0000-00-00', '', 'OKTOBER', 0, '', '', '0000-00-00', '0000-00-00', '0000-00-00', 29, 0, '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
(118, '0000-00-00', '2013-04-24', '0000-00-00', '0000-00-00', '', 'MAC', 0, '', '', '0000-00-00', '0000-00-00', '0000-00-00', 21, 0, '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
(119, '2013-04-23', '2013-04-22', '0000-00-00', '0000-00-00', '', 'FEBRUARI', 23, '1000', '', '0000-00-00', '0000-00-00', '0000-00-00', 21, 0, '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
(120, '2013-06-06', '2013-04-25', '0000-00-00', '0000-00-00', '', 'FEBRUARI', 111, '1111111', '', '0000-00-00', '0000-00-00', '0000-00-00', 19, 0, '', '0000-00-00 00:00:00', '', '2013-06-06 16:23:12'),
(121, '2013-04-27', '2013-04-25', '0000-00-00', '0000-00-00', '', 'APRIL', 12, '12000', '', '0000-00-00', '0000-00-00', '0000-00-00', 36, 0, '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
(122, '0000-00-00', '2013-04-24', '0000-00-00', '0000-00-00', '', 'APRIL', 0, '', '', '0000-00-00', '0000-00-00', '0000-00-00', 36, 0, '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
(123, '0000-00-00', '2013-04-23', '0000-00-00', '0000-00-00', '', 'APRIL', 0, '', '', '0000-00-00', '0000-00-00', '0000-00-00', 41, 0, '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
(124, '0000-00-00', '2013-04-25', '0000-00-00', '0000-00-00', '', 'APRIL', 0, '', '', '0000-00-00', '0000-00-00', '0000-00-00', 40, 0, '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
(125, '2013-06-06', '2013-04-26', '0000-00-00', '0000-00-00', '', 'FEBRUARI', 111, '1111111', '', '0000-00-00', '0000-00-00', '0000-00-00', 19, 0, '', '0000-00-00 00:00:00', '', '2013-06-06 16:23:12'),
(126, '2013-06-06', '0000-00-00', '0000-00-00', '0000-00-00', '', 'JANUARI', 111, '1111111', '', '0000-00-00', '0000-00-00', '0000-00-00', 19, 0, '', '0000-00-00 00:00:00', '', '2013-06-06 16:23:12'),
(127, '2013-06-06', '0000-00-00', '0000-00-00', '0000-00-00', '', 'MAC', 111, '1111111', 'BELUM DITERIMA', '0000-00-00', '0000-00-00', '0000-00-00', 19, 0, '', '0000-00-00 00:00:00', '', '2013-06-06 16:23:12'),
(129, '2013-06-06', '0000-00-00', '0000-00-00', '0000-00-00', '', 'JANUARI', 111, '1111111', 'DITERIMA', '0000-00-00', '0000-00-00', '0000-00-00', 19, 0, '', '0000-00-00 00:00:00', '', '2013-06-06 16:23:12'),
(130, '2013-06-06', '0000-00-00', '0000-00-00', '0000-00-00', '', 'JANUARI', 111, '1111111', 'DITERIMA', '0000-00-00', '0000-00-00', '0000-00-00', 19, 0, '', '0000-00-00 00:00:00', '', '2013-06-06 16:23:12'),
(131, '2013-06-06', '0000-00-00', '0000-00-00', '0000-00-00', '', 'JANUARI', 111, '1111111', 'DITERIMA', '0000-00-00', '0000-00-00', '0000-00-00', 19, 0, '', '0000-00-00 00:00:00', '', '2013-06-06 16:23:12'),
(132, '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00', '', 'JANUARI', 0, '', 'DITERIMA', '0000-00-00', '0000-00-00', '0000-00-00', 40, 0, '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
(133, '2013-06-06', '0000-00-00', '0000-00-00', '0000-00-00', '', 'JANUARI', 111, '1111111', 'DITERIMA', '0000-00-00', '0000-00-00', '0000-00-00', 19, 0, '', '0000-00-00 00:00:00', '', '2013-06-06 16:23:12'),
(134, '2013-05-24', '0000-00-00', '0000-00-00', '0000-00-00', '', 'JANUARI', 343, '5555', 'DITERIMA', '0000-00-00', '0000-00-00', '0000-00-00', 37, 0, '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
(135, '0000-00-00', '2013-04-26', '0000-00-00', '0000-00-00', '', 'APRIL', 0, '', 'DITERIMA', '0000-00-00', '0000-00-00', '0000-00-00', 36, 0, '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
(136, '2013-06-06', '2013-04-29', '0000-00-00', '0000-00-00', '', 'MAC', 111, '1111111', 'DITERIMA', '0000-00-00', '0000-00-00', '0000-00-00', 19, 0, '', '0000-00-00 00:00:00', '', '2013-06-06 16:23:12'),
(137, '2013-06-06', '2013-04-29', '0000-00-00', '0000-00-00', '', 'FEBRUARI', 111, '1111111', 'DITERIMA', '0000-00-00', '0000-00-00', '0000-00-00', 19, 0, '', '0000-00-00 00:00:00', '', '2013-06-06 16:23:12'),
(138, '2013-06-06', '2013-05-15', '0000-00-00', '0000-00-00', '', 'JANUARI', 111, '1111111', 'DITERIMA', '0000-00-00', '0000-00-00', '0000-00-00', 19, 0, '', '0000-00-00 00:00:00', '', '2013-06-06 16:23:12'),
(139, '2013-06-06', '2013-06-06', '0000-00-00', '0000-00-00', '', 'JANUARI', 111, '1111111', 'DITERIMA', '0000-00-00', '0000-00-00', '0000-00-00', 19, 0, '', '0000-00-00 00:00:00', '', '2013-06-06 16:23:12'),
(140, '2013-06-06', '2013-06-06', '0000-00-00', '0000-00-00', '', 'JANUARI', 11, '22222', 'DITERIMA', '0000-00-00', '0000-00-00', '0000-00-00', 0, 0, '', '0000-00-00 00:00:00', '', '2013-06-06 16:20:49'),
(141, '2013-06-06', '2013-06-06', '0000-00-00', '0000-00-00', '', 'OGOS', 11, '22222', 'DITERIMA', '0000-00-00', '0000-00-00', '0000-00-00', 0, 0, '', '0000-00-00 00:00:00', '', '2013-06-06 16:20:49'),
(142, '0000-00-00', '2013-06-06', '0000-00-00', '0000-00-00', '', 'JUN', 0, '', 'DITERIMA', '0000-00-00', '0000-00-00', '0000-00-00', 0, 0, '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `ptj`
--

CREATE TABLE IF NOT EXISTS `ptj` (
  `id_ptj` int(11) NOT NULL AUTO_INCREMENT,
  `kod_ptj` int(8) NOT NULL,
  `nama_ptj` varchar(50) NOT NULL,
  `nama_jabatan` varchar(100) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `alamat2` varchar(30) NOT NULL,
  `alamat3` varchar(30) NOT NULL,
  `poskod` char(5) NOT NULL,
  `negeri` varchar(50) NOT NULL,
  `nama_pegawai` varchar(100) NOT NULL,
  `nama_penyemak` varchar(100) NOT NULL,
  `no_telefon` varchar(15) NOT NULL,
  `saiz_ptj` char(2) NOT NULL COMMENT 'Saiz PTJ mengikut jumlah kutipan cth XL,L,M,S',
  `id_pegawai_ptj` int(11) NOT NULL COMMENT 'id Pegawai PTJ yang bertanggung jawab',
  `cipta_oleh` varchar(11) NOT NULL,
  `cipta_pada` datetime NOT NULL,
  `kemaskini_oleh` varchar(11) NOT NULL,
  `kemaskini_pada` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_ptj`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=43 ;

--
-- Dumping data for table `ptj`
--

INSERT INTO `ptj` (`id_ptj`, `kod_ptj`, `nama_ptj`, `nama_jabatan`, `alamat`, `alamat2`, `alamat3`, `poskod`, `negeri`, `nama_pegawai`, `nama_penyemak`, `no_telefon`, `saiz_ptj`, `id_pegawai_ptj`, `cipta_oleh`, `cipta_pada`, `kemaskini_oleh`, `kemaskini_pada`) VALUES
(19, 267010300, 'Bahagian Khidmat Pengurusan', 'KEMENTERIAN DALAM NEGERI', 'Kementerian Dalam Negeri \r\nBahagian Khidmat Pengurusan \r\nAras 34 Blok D2 Kompleks D                 ', '', '', '', 'PUTRAJAYA', '', '', '38869090', 'X', 0, '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
(36, 267010100, 'Pejabat Kewangan Bahagian Kewangan', 'KEMENTERIAN DALAM NEGERI', 'Kementerian Dalam Negeri \r\nBahagian Kewangan \r\nAras 3 Blok D2 Kompleks D\r\n62546                     ', '', '', '', 'PUTRAJAYA', '', '', '3', 'X', 0, '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
(37, 267010200, 'Bahagian Akaun', 'KEMENTERIAN DALAM NEGERI', 'Kementerian Dalam Negeri \r\nBahagian Akaun\r\nAras 8 Blok D2 Kompleks D                                ', '', '', '', 'PUTRAJAYA', '', '', '388868494', 'X', 0, '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
(38, 263010900, 'Bahagian Pekerja Asing', 'Jabatan Imigresen', 'Kementerian Dalam Negeri \r\nBahagian Kewangan \r\nAras 3 Blok D2 Kompleks D                            ', '', '', '', 'PUTRAJAYA', '', '', '387878787', 'L', 0, '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
(39, 263010300, 'Bahagian Pas Pengajian', 'Jabatan Imigresen', 'Kementerian Dalam Negeri \r\nBahagian Kewangan \r\nAras 3 Blok D2 Kompleks D                            ', '', '', '', 'PUTRAJAYA', '', '', '2147483647', 'L', 0, '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
(40, 263010700, 'Bahagian Visa,Pas dan Permit', 'Jabatan Imigresen', 'Kementerian Dalam Negeri \r\nBahagian Kewangan \r\nAras 3 Blok D2 Kompleks D                            ', '', '', '', 'PUTRAJAYA', '', '', '387878787', 'M', 0, '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
(41, 265010700, 'Kaunter Perkhidmatan Kad Pintar Putrajaya', 'Jabatan Pendaftaran Negara', 'Kementerian Dalam Negeri \r\nBahagian Kewangan \r\nAras 3 Blok D2 Kompleks D                            ', '', '', '', 'PUTRAJAYA', '', '', '123408989', 'L', 0, '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
(42, 265020900, 'Pejabat Pendaftaran Negara Daerah Muar', 'Jabatan Pendaftaran Negara', 'Kementerian Dalam Negeri \r\nBahagian Kewangan \r\nAras 3 Blok D2 Kompleks D                            ', '', '', '', 'JOHOR', '', '', '799898888', 'L', 0, '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `nama_penuh` varchar(45) DEFAULT NULL,
  `jawatan` varchar(25) NOT NULL,
  `gred` varchar(4) NOT NULL,
  `no_tel` varchar(14) DEFAULT NULL,
  `email` varchar(45) NOT NULL,
  `kata_laluan` varchar(30) NOT NULL,
  `level` varchar(3) NOT NULL COMMENT 'Tahap capaian bagi pengguna(administrator,pengguna,',
  `cipta_oleh` varchar(11) NOT NULL,
  `cipta_pada` datetime NOT NULL,
  `kemaskini_oleh` varchar(11) NOT NULL,
  `kemaskini_pada` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `id_ptj` int(11) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama`, `nama_penuh`, `jawatan`, `gred`, `no_tel`, `email`, `kata_laluan`, `level`, `cipta_oleh`, `cipta_pada`, `kemaskini_oleh`, `kemaskini_pada`, `id_ptj`) VALUES
(1, 'a', 'a', 'a', 'a', 'a', 'a', 'a', '1', '', '2013-06-19 00:00:00', '', '0000-00-00 00:00:00', 0),
(2, 'b', 'b', 'b', 'b', 'b', 'b', 'b', '2', '', '2013-06-19 00:00:00', '', '0000-00-00 00:00:00', 0),
(3, 'c', 'c', 'c', 'c', 'c', 'c', 'c', '1', '', '2013-06-19 00:00:00', '', '0000-00-00 00:00:00', 0),
(4, 'd', 'd', 'd', 'd', 'd', 'd', 'd', '1', '', '2013-06-19 00:00:00', '', '0000-00-00 00:00:00', 0);
