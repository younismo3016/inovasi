/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50527
Source Host           : localhost:3306
Source Database       : inovasi

Target Server Type    : MYSQL
Target Server Version : 50527
File Encoding         : 65001

Date: 2017-04-10 16:26:42
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `adm_inovasi`
-- ----------------------------
DROP TABLE IF EXISTS `adm_inovasi`;
CREATE TABLE `adm_inovasi` (
  `id_kriteria_inovasi` int(11) NOT NULL AUTO_INCREMENT,
  `kriteria` varchar(70) DEFAULT NULL,
  `id_kriteria` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`id_kriteria_inovasi`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of adm_inovasi
-- ----------------------------
INSERT INTO `adm_inovasi` VALUES ('1', 'TUJUAN INOVASI\r', 'n1');
INSERT INTO `adm_inovasi` VALUES ('2', 'KEDUDUKAN SEBELUM INOVASI ', 'n2');
INSERT INTO `adm_inovasi` VALUES ('3', 'MASALAH YANG DIHADAPI ', 'n3');
INSERT INTO `adm_inovasi` VALUES ('4', 'INOVASI YANG DILAKSANAKAN ', 'n4');
INSERT INTO `adm_inovasi` VALUES ('5', 'KREATIVITI\r\nKREATIVITI', 'n5');
INSERT INTO `adm_inovasi` VALUES ('6', 'EFISIENSI – PENJIMATAN MASA ', 'n6');
INSERT INTO `adm_inovasi` VALUES ('7', 'EFISIENSI – PENJIMATAN KOS', 'n7');
INSERT INTO `adm_inovasi` VALUES ('8', 'EFISIENSI – PENINGKATAN PRODUK', 'n8');
INSERT INTO `adm_inovasi` VALUES ('9', 'EFISIENSI –MUDAH DIGUNAKAN (USER FRIENDLY) ', 'n9');
INSERT INTO `adm_inovasi` VALUES ('10', 'EFISIENSI – LAIN-LAIN FAEDAH ', 'n10');
INSERT INTO `adm_inovasi` VALUES ('11', 'SIGNIFIKAN\r\n', 'n11');
INSERT INTO `adm_inovasi` VALUES ('12', 'REPLICABILITY\r\n', 'n12');
INSERT INTO `adm_inovasi` VALUES ('13', 'POTENSI PELAKSANAAN\r\n', 'n13');
INSERT INTO `adm_inovasi` VALUES ('14', 'KOMITMEN PENGURUSAN ATASAN\r\n', 'n14');
INSERT INTO `adm_inovasi` VALUES ('15', 'HARTA INTELEK DAN KOMERSIAL\r\n', 'n15');
INSERT INTO `adm_inovasi` VALUES ('16', 'SENTUHAN KEPADA RAKYAT\r\n', 'n16');

-- ----------------------------
-- Table structure for `adm_jabatan`
-- ----------------------------
DROP TABLE IF EXISTS `adm_jabatan`;
CREATE TABLE `adm_jabatan` (
  `id_jabatan` int(11) NOT NULL AUTO_INCREMENT,
  `nama_jabatan` varchar(10) DEFAULT NULL,
  `nama_penuh_jabatan` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_jabatan`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of adm_jabatan
-- ----------------------------
INSERT INTO `adm_jabatan` VALUES ('1', 'PDRM', 'Polis Diraja Malaysia');
INSERT INTO `adm_jabatan` VALUES ('2', 'JIM', 'Jabatan Imigresen Malaysia');
INSERT INTO `adm_jabatan` VALUES ('3', 'JPP', 'Jabatan Pendaftaran Pertubuhan');
INSERT INTO `adm_jabatan` VALUES ('4', 'JPN', 'Jabatan Pendaftaran Negara');
INSERT INTO `adm_jabatan` VALUES ('5', 'JPM', 'Jabatan Penjara Malaysia');
INSERT INTO `adm_jabatan` VALUES ('6', 'KDN', 'Kementerian Dalam Negeri');
INSERT INTO `adm_jabatan` VALUES ('7', 'AADK', 'Agensi Anti Dadah Kebangsaan');
INSERT INTO `adm_jabatan` VALUES ('8', 'JPAM', 'Jabatan Pertahanan Awam');
INSERT INTO `adm_jabatan` VALUES ('9', 'RELA', 'Jabatan Sukarelawan Malaysia');

-- ----------------------------
-- Table structure for `adm_negeri`
-- ----------------------------
DROP TABLE IF EXISTS `adm_negeri`;
CREATE TABLE `adm_negeri` (
  `id_adm_negeri` tinyint(4) NOT NULL AUTO_INCREMENT,
  `kod_negeri` varchar(2) DEFAULT NULL,
  `negeri` varchar(40) DEFAULT NULL,
  `kod_negara` varchar(3) NOT NULL,
  `created_by` varchar(14) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_by` varchar(14) DEFAULT NULL,
  `modified_date` datetime NOT NULL,
  `aktif` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_adm_negeri`),
  UNIQUE KEY `kod_negeri` (`kod_negeri`) USING BTREE,
  KEY `adm_negeri_ibfk_1` (`kod_negara`) USING BTREE,
  KEY `id_negeri` (`id_adm_negeri`,`negeri`) USING BTREE,
  KEY `object_id` (`id_adm_negeri`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=127 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of adm_negeri
-- ----------------------------
INSERT INTO `adm_negeri` VALUES ('1', 'JE', 'JOHOR', 'MYS', 'migrate', '0000-00-00 00:00:00', 'migrate', '0000-00-00 00:00:00', '1');
INSERT INTO `adm_negeri` VALUES ('2', 'KD', 'KEDAH', 'MYS', 'migrate', '0000-00-00 00:00:00', 'migrate', '0000-00-00 00:00:00', '1');
INSERT INTO `adm_negeri` VALUES ('3', 'KN', 'KELANTAN', 'MYS', 'migrate', '0000-00-00 00:00:00', 'migrate', '0000-00-00 00:00:00', '1');
INSERT INTO `adm_negeri` VALUES ('4', 'MA', 'MELAKA', 'MYS', 'migrate', '0000-00-00 00:00:00', 'migrate', '0000-00-00 00:00:00', '1');
INSERT INTO `adm_negeri` VALUES ('5', 'NS', 'NEGERI SEMBILAN', 'MYS', 'migrate', '0000-00-00 00:00:00', 'migrate', '0000-00-00 00:00:00', '1');
INSERT INTO `adm_negeri` VALUES ('6', 'PH', 'PAHANG', 'MYS', 'migrate', '0000-00-00 00:00:00', 'migrate', '0000-00-00 00:00:00', '1');
INSERT INTO `adm_negeri` VALUES ('7', 'PP', 'PULAU PINANG', 'MYS', 'migrate', '0000-00-00 00:00:00', 'migrate', '0000-00-00 00:00:00', '1');
INSERT INTO `adm_negeri` VALUES ('8', 'PK', 'PERAK', 'MYS', 'migrate', '0000-00-00 00:00:00', 'migrate', '0000-00-00 00:00:00', '1');
INSERT INTO `adm_negeri` VALUES ('9', 'PS', 'PERLIS', 'MYS', 'migrate', '0000-00-00 00:00:00', 'migrate', '0000-00-00 00:00:00', '1');
INSERT INTO `adm_negeri` VALUES ('10', 'SL', 'SELANGOR', 'MYS', 'migrate', '0000-00-00 00:00:00', 'migrate', '0000-00-00 00:00:00', '1');
INSERT INTO `adm_negeri` VALUES ('12', 'SH', 'SABAH', 'MYS', 'migrate', '0000-00-00 00:00:00', 'migrate', '0000-00-00 00:00:00', '1');
INSERT INTO `adm_negeri` VALUES ('13', 'SW', 'SARAWAK', 'MYS', 'migrate', '0000-00-00 00:00:00', 'migrate', '0000-00-00 00:00:00', '1');
INSERT INTO `adm_negeri` VALUES ('14', 'WP', 'W.P. KUALA LUMPUR', 'MYS', 'migrate', '0000-00-00 00:00:00', 'migrate', '0000-00-00 00:00:00', '1');
INSERT INTO `adm_negeri` VALUES ('16', 'PJ', 'W.P. PUTRAJAYA', 'MYS', 'migrate', '0000-00-00 00:00:00', 'migrate', '0000-00-00 00:00:00', '1');
INSERT INTO `adm_negeri` VALUES ('127', 'TG', 'TERENGGANU', 'MYS', 'migrate', '0000-00-00 00:00:00', 'migrate', '0000-00-00 00:00:00', '1');

-- ----------------------------
-- Table structure for `ahli_pasukan`
-- ----------------------------
DROP TABLE IF EXISTS `ahli_pasukan`;
CREATE TABLE `ahli_pasukan` (
  `id_ahli_pasukan` int(11) NOT NULL AUTO_INCREMENT,
  `nama_ahli` varchar(30) DEFAULT NULL,
  `no_tel_bimbit` varchar(30) DEFAULT NULL,
  `jawatan` varchar(30) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `no_tel` varchar(30) DEFAULT NULL,
  `gred` varchar(5) DEFAULT NULL,
  `cipta_pada` datetime DEFAULT NULL,
  `id_ketua_projek` int(11) DEFAULT NULL,
  `id_projek` int(11) DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_ahli_pasukan`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ahli_pasukan
-- ----------------------------
INSERT INTO `ahli_pasukan` VALUES ('4', 'ahlin pancing1', '1312312', 'lawyer', 'ahlipancing1@gmail.com', '01234434343', '44', '2017-03-22 00:00:00', '31', '14', '3');
INSERT INTO `ahli_pasukan` VALUES ('6', 'Iron 1', '0123333434', 'ketua', 'iron1@moha.gov.my', '01234434343', '56', '2017-04-04 00:00:00', '51', '17', '3');
INSERT INTO `ahli_pasukan` VALUES ('7', 'iron 2', '0123333434', 'ketua', 'zzzz@gmail.com', '1212312312312', '56', '2017-04-04 00:00:00', '51', '17', '3');
INSERT INTO `ahli_pasukan` VALUES ('8', 'iron 3', '123123123123', 'Pegawai Kesihatan', 'aaa@gmail.com', '0388881234', '56', '2017-04-04 00:00:00', '51', '17', '3');

-- ----------------------------
-- Table structure for `keputusan_inovasi`
-- ----------------------------
DROP TABLE IF EXISTS `keputusan_inovasi`;
CREATE TABLE `keputusan_inovasi` (
  `id_keputusan_inovasi` int(11) NOT NULL AUTO_INCREMENT,
  `id_projek` int(11) DEFAULT NULL,
  `markah_n1` varchar(20) DEFAULT NULL,
  `markah_n2` varchar(20) DEFAULT NULL,
  `markah_n3` varchar(20) DEFAULT NULL,
  `markah_n4` varchar(20) DEFAULT NULL,
  `markah_n5` varchar(20) DEFAULT NULL,
  `markah_n6` varchar(20) DEFAULT NULL,
  `markah_n7` varchar(20) DEFAULT NULL,
  `markah_n8` varchar(20) DEFAULT NULL,
  `markah_n9` varchar(20) DEFAULT NULL,
  `markah_n10` varchar(20) DEFAULT NULL,
  `markah_n11` varchar(20) DEFAULT NULL,
  `markah_n12` varchar(20) DEFAULT NULL,
  `markah_n13` varchar(20) DEFAULT NULL,
  `markah_n14` varchar(20) DEFAULT NULL,
  `markah_n15` varchar(20) DEFAULT NULL,
  `markah_n16` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_keputusan_inovasi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of keputusan_inovasi
-- ----------------------------

-- ----------------------------
-- Table structure for `keputusan_kik`
-- ----------------------------
DROP TABLE IF EXISTS `keputusan_kik`;
CREATE TABLE `keputusan_kik` (
  `id_keputusan_kik` int(11) NOT NULL AUTO_INCREMENT,
  `id_projek` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_keputusan_kik`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of keputusan_kik
-- ----------------------------

-- ----------------------------
-- Table structure for `maklumat_inovasi`
-- ----------------------------
DROP TABLE IF EXISTS `maklumat_inovasi`;
CREATE TABLE `maklumat_inovasi` (
  `id_maklumat_inovasi` int(11) NOT NULL AUTO_INCREMENT,
  `n1` text,
  `n2` varchar(600) DEFAULT NULL,
  `n3` varchar(600) DEFAULT NULL,
  `n4` varchar(600) DEFAULT NULL,
  `n5` varchar(600) DEFAULT NULL,
  `n6` varbinary(600) DEFAULT NULL,
  `n7` varchar(600) DEFAULT NULL,
  `n8` varchar(600) DEFAULT NULL,
  `n9` varchar(600) DEFAULT NULL,
  `n10` varchar(600) DEFAULT NULL,
  `n11` varchar(600) DEFAULT NULL,
  `n12` varchar(600) DEFAULT NULL,
  `n13` varchar(600) DEFAULT NULL,
  `n14` varchar(600) DEFAULT NULL,
  `n15` varchar(600) DEFAULT NULL,
  `n16` varchar(600) DEFAULT NULL,
  `id_projek` int(11) DEFAULT NULL,
  `image1_n1` varchar(20) DEFAULT NULL,
  `image2_n1` varchar(20) DEFAULT NULL,
  `image1_n2` varchar(20) DEFAULT NULL,
  `image2_n2` varchar(20) DEFAULT NULL,
  `image1_n3` varchar(20) DEFAULT NULL,
  `image2_n3` varchar(20) DEFAULT NULL,
  `image1_n4` varchar(20) DEFAULT NULL,
  `image2_n4` varchar(20) DEFAULT NULL,
  `image1_n5` varchar(20) DEFAULT NULL,
  `image2_n5` varchar(20) DEFAULT NULL,
  `image1_n6` varchar(20) DEFAULT NULL,
  `image2_n6` varchar(20) DEFAULT NULL,
  `image1_n7` varchar(20) DEFAULT NULL,
  `image2_n7` varchar(20) DEFAULT NULL,
  `image1_n8` varchar(20) DEFAULT NULL,
  `image2_n8` varchar(20) DEFAULT NULL,
  `image1_n9` varchar(20) DEFAULT NULL,
  `image2_n9` varchar(20) DEFAULT NULL,
  `image1_n10` varchar(20) DEFAULT NULL,
  `image2_n10` varchar(20) DEFAULT NULL,
  `image1_n11` varchar(20) DEFAULT NULL,
  `image2_n11` varchar(20) DEFAULT NULL,
  `image1_n12` varchar(20) DEFAULT NULL,
  `image2_n12` varchar(20) DEFAULT NULL,
  `image1_n13` varchar(20) DEFAULT NULL,
  `image2_n13` varchar(20) DEFAULT NULL,
  `image1_n14` varchar(20) DEFAULT NULL,
  `image2_n14` varchar(20) DEFAULT NULL,
  `image1_n15` varchar(20) DEFAULT NULL,
  `image2_n15` varchar(20) DEFAULT NULL,
  `image1_n16` varchar(20) DEFAULT NULL,
  `image2_n16` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_maklumat_inovasi`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of maklumat_inovasi
-- ----------------------------
INSERT INTO `maklumat_inovasi` VALUES ('1', 'aaaaaa7qweqeqeqe', '2a', '33', '44', '55', 0x3636, '7', '88', '99', '100', '110', '120', '130', '140', '150', '16', '1', '07052015bill.pdf', '81.jpg', null, null, '51.jpg', null, '4.jpg', null, '52.jpg', null, '8.jpg', null, '7.jpg', null, '81.jpg', null, '6.jpg', null, 'faq-1.jpg', null, 'Q11-W3C.jpg', null, 'Q12-IKUTI_KAMI.JPG', null, 'Q14-AUDIO-VIDEO.jpg', null, 'q5_6.JPG', null, 'q2.JPG', null, 'Q12-EBOOK.jpg', null);
INSERT INTO `maklumat_inovasi` VALUES ('2', 'mengukur kelapa', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '3', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `maklumat_inovasi` VALUES ('3', '1sahab', '2', null, null, null, null, null, null, null, null, null, null, null, null, null, null, '2', '51.jpg', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `maklumat_inovasi` VALUES ('4', 'tujuan1', 'kedudukan n2', null, null, null, null, null, null, null, null, null, null, null, null, null, null, '4', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `maklumat_inovasi` VALUES ('5', 'tujuan inovasi', 'huraian kedudukan sebelum inovasi', null, null, null, null, null, null, null, null, null, null, null, null, null, null, '5', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `maklumat_inovasi` VALUES ('6', '1', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '15', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `maklumat_inovasi` VALUES ('11', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '2', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `maklumat_inovasi` VALUES ('12', 'qweqweqwe', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '9', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `maklumat_inovasi` VALUES ('13', 'qweqwqwesdfdsfsdf', '123123123', null, null, null, null, null, null, null, null, null, null, null, null, null, null, '10', '5.jpg', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `maklumat_inovasi` VALUES ('14', 'asdadaddas', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, '11', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `maklumat_inovasi` VALUES ('15', '1212121', 'Malaysia (Listeni/m??le???/ m?-LAY-zh? or Listeni/m??le?si?/ m?-LAY-see-?; Malaysian pronunciation: [m?lejsi?]) is a federal constitutional monarchy located in Southeast Asia. It consists of thirteen states and three federal territories and has a total landmass of 330,803 square kilometres (127,720 sq mi) separated by the South China Sea into two similarly sized regions, Peninsular Malaysia and East Malaysia (Malaysian Borneo). Peninsular Malaysia shares a land and maritime border with Thailand and maritime borders with Singapore, Vietnam, and Indonesia. East Malaysia shares land and maritime ', '1', '2', '<b>Malaysia (Listeni/m??le???/ m?-LAY-zh? or Listeni/m??le?si?/ m?-LAY-see-?; Malaysian pronunciation: [m?lejsi?]) is a federal constitutional monarchy located in Southeast Asia. It consists of thirteen states and three federal territories and has a total landmass of 330,803 square kilometres (127,720 sq mi) separated by the South China Sea into two similarly sized regions, Peninsular Malaysia and East Malaysia (Malaysian Borneo). Peninsular Malaysia shares a land and maritime border with Thailand and maritime borders with Singapore, Vietnam, and Indonesia. East Malaysia shares land and mariti', 0x33, '4', '5', '6', '77', '88', '99', '9999', '456546', 'asdadasdas', 'bbbb', '17', 'eksa5.JPG', null, '6.jpg', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);

-- ----------------------------
-- Table structure for `maklumat_kik`
-- ----------------------------
DROP TABLE IF EXISTS `maklumat_kik`;
CREATE TABLE `maklumat_kik` (
  `id_maklumat_kik` int(11) NOT NULL AUTO_INCREMENT,
  `k1` varchar(600) DEFAULT NULL,
  `k2` varchar(600) DEFAULT NULL,
  `k3` varchar(600) DEFAULT NULL,
  `k4` varchar(600) DEFAULT NULL,
  `k5` varchar(600) DEFAULT NULL,
  `k6` varchar(600) DEFAULT NULL,
  `k7` varchar(600) DEFAULT NULL,
  `k8` varchar(600) DEFAULT NULL,
  `k9` varchar(600) DEFAULT NULL,
  `k10` varchar(600) DEFAULT NULL,
  `k11` varchar(600) DEFAULT NULL,
  `k12` varchar(600) DEFAULT NULL,
  `k13` varchar(600) DEFAULT NULL,
  `k14` varchar(600) DEFAULT NULL,
  `id_projek` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_maklumat_kik`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of maklumat_kik
-- ----------------------------

-- ----------------------------
-- Table structure for `markah_inovasi`
-- ----------------------------
DROP TABLE IF EXISTS `markah_inovasi`;
CREATE TABLE `markah_inovasi` (
  `id_markah_inovasi` int(11) NOT NULL AUTO_INCREMENT,
  `id_projek` varchar(20) DEFAULT NULL,
  `markah_n1` varchar(20) DEFAULT NULL,
  `markah_n2` varchar(20) DEFAULT NULL,
  `markah_n3` varchar(20) DEFAULT NULL,
  `markah_n4` varchar(20) DEFAULT NULL,
  `markah_n5` varchar(20) DEFAULT NULL,
  `markah_n6` varchar(20) DEFAULT NULL,
  `markah_n7` varchar(20) DEFAULT NULL,
  `markah_n8` varchar(20) DEFAULT NULL,
  `markah_n9` varchar(20) DEFAULT NULL,
  `markah_n10` varchar(20) DEFAULT NULL,
  `markah_n11` varchar(20) DEFAULT NULL,
  `markah_n12` varchar(20) DEFAULT NULL,
  `markah_n13` varchar(20) DEFAULT NULL,
  `markah_n14` varchar(20) DEFAULT NULL,
  `markah_n15` varchar(20) DEFAULT NULL,
  `markah_n16` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_markah_inovasi`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of markah_inovasi
-- ----------------------------
INSERT INTO `markah_inovasi` VALUES ('1', '1', '22', '1', '1', '222', '55', '666', '777', '888', '999', '1000', '1111', '12000', '1300', '1400', '1500', '1600');
INSERT INTO `markah_inovasi` VALUES ('2', '2', '10', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `markah_inovasi` VALUES ('3', '3', '21', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `markah_inovasi` VALUES ('4', '9', '21', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `markah_inovasi` VALUES ('5', '11', '33', null, null, null, null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `markah_inovasi` VALUES ('6', '10', '22', '12121', null, null, null, null, null, null, null, null, null, null, null, null, null, null);

-- ----------------------------
-- Table structure for `projek`
-- ----------------------------
DROP TABLE IF EXISTS `projek`;
CREATE TABLE `projek` (
  `id_projek` int(11) NOT NULL AUTO_INCREMENT,
  `jabatan` int(11) DEFAULT NULL,
  `negeri` int(11) DEFAULT NULL,
  `alamat1` varchar(25) DEFAULT NULL,
  `alamat2` varchar(25) DEFAULT NULL,
  `alamat3` varchar(25) DEFAULT NULL,
  `tajuk_projek` varchar(25) DEFAULT NULL,
  `id_ketua_projek` int(11) DEFAULT NULL,
  `id_ketua_organisasi` int(11) DEFAULT NULL,
  `kategori` varchar(11) DEFAULT NULL,
  `nama_kumpulan` varchar(25) DEFAULT NULL,
  `pertandingan` varchar(11) DEFAULT NULL,
  `bidang` varchar(11) DEFAULT NULL,
  `cawangan` varchar(25) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `tahun` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id_projek`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of projek
-- ----------------------------
INSERT INTO `projek` VALUES ('1', '5', '3', 'alamat 1', 'alamat 2', 'alamat 3', 'KUKUR KELAPA', '4', '38', '1', 'kumpulan kelapa', '2', '1', 'pahang', '2', null);
INSERT INTO `projek` VALUES ('2', '6', '2', 'alamat 1', 'alamat 2', 'alamat 3', 'kereta laju', '4', '38', '1', 'cipta kereta', '1', '1', 'hq', '3', null);
INSERT INTO `projek` VALUES ('3', '2', '4', 'dfsdfsdfs', 'dsdfsdfs', 'sdfsdfs', 'asdasdasd', '4', '38', '1', 'dsdsdfsdfsdfsdfs', '1', '1', 'dsfdfsdfsdfs', '1', null);
INSERT INTO `projek` VALUES ('4', '6', '16', 'alamat1', 'alamat2', 'alamat3', 'Alam Sekitar', '37', '38', '1', 'Bintang 3', '1', '1', 'Putrajaya', '1', null);
INSERT INTO `projek` VALUES ('5', '1', '2', 'alamat 1', 'alamat 2', 'alamat 3', 'Kerusi Bergerak sendiri', '35', '45', '-Pilih-', 'Geng jahat', '1', '-Pilih-', 'Caw Kedah', '3', null);
INSERT INTO `projek` VALUES ('6', '1', '2', 'alamat 1', 'alamat 2', 'alamat 3', 'projek 2', '35', '28', '1', 'projek 2', '2', '2', 'Caw Kedah', '1', null);
INSERT INTO `projek` VALUES ('7', '3', '16', 'alamat 1', 'alamat 2', 'alamat 3', 'Basikal lipat', '42', '28', '1', 'basikal tua', '1', '2', 'Putrajaya', '1', null);
INSERT INTO `projek` VALUES ('8', '1', '2', 'alamat 1', 'alamat 2', 'alamat 3', 'Transformer', '4', '30', '1', 'Bumble bee', '1', '1', 'Caw Kedah', '1', null);
INSERT INTO `projek` VALUES ('9', '4', '4', 'alamat 1', 'alamat 2', 'alamat 3', 'sistem', '4', '30', '1', 'projek 3', '1', '1', 'Caw Kedah', '1', null);
INSERT INTO `projek` VALUES ('10', '1', '3', 'alamat 1', 'alamat 2', 'alamat 3', 'Basikal terbang', '4', '45', '1', 'Geng jahat', '1', '1', 'Putrajaya', null, null);
INSERT INTO `projek` VALUES ('11', '2', '2', 'alamat 1', 'alamat 2', 'alamat 3', 'siram bungan', '4', '46', '1', 'projek 3', '2', '1', 'Caw Kedah', '1', null);
INSERT INTO `projek` VALUES ('14', '1', '16', 'alamat 1', 'alamat 2', 'alamat 3', 'kolam bersih', '31', '26', '1', 'pancing', '1', '1', 'Putrajaya', '1', null);
INSERT INTO `projek` VALUES ('15', '3', '16', 'alamat 1', 'alamat 2', 'alamat 3', 'kolam bersih2', '31', '29', '1', 'pancing2', '1', '1', 'Putrajaya', '1', null);
INSERT INTO `projek` VALUES ('16', '2', '14', 'alamat 1', 'alamat 2', 'alamat 3', 'mesin bar', '4', '46', '1', 'ggg', '2', '1', 'Putrajaya', '1', '2017');
INSERT INTO `projek` VALUES ('17', '1', '16', 'alamat 1', 'alamat 2', 'alamat 3', 'Baju Besi', '51', '52', '1', 'Iron Man', '1', '1', 'Putrajaya', '1', '2017');
INSERT INTO `projek` VALUES ('18', '3', '127', 'alamat 1', 'alamat 2', 'alamat 3', 'baju kayu', '51', '52', '1', 'Iron Man2', '1', '1', 'Putrajaya', '1', '2017');

-- ----------------------------
-- Table structure for `user`
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `no_tel_bimbit` varchar(20) DEFAULT NULL,
  `nama_penuh` varchar(50) DEFAULT NULL,
  `jawatan` varchar(25) DEFAULT NULL,
  `gred` varchar(4) DEFAULT NULL,
  `no_tel` varchar(14) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `kata_laluan` varchar(50) DEFAULT NULL,
  `level` varchar(3) DEFAULT NULL COMMENT 'Tahap capaian bagi pengguna(administrator,pengguna,',
  `cipta_oleh` varchar(11) DEFAULT NULL,
  `cipta_pada` datetime DEFAULT NULL,
  `kemaskini_oleh` varchar(11) DEFAULT NULL,
  `kemaskini_pada` timestamp NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `status` tinyint(4) DEFAULT '1' COMMENT 'status sama ada aktif atau tidak 0=tidak dan 1=aktif (default)',
  `email_ketua` varchar(45) DEFAULT NULL,
  `id_ketua_organisasi` int(11) DEFAULT NULL,
  `id_jabatan` int(11) DEFAULT NULL,
  `id_ketua_projek` int(11) DEFAULT NULL,
  `date_range` date DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=latin1 COMMENT='1.Ketua Jabatan';

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('4', '55555555555555', 'Yunizar Bin Mohd Yunus', 'Programer', '48', '4444444', 'aaa@gmail.com', '202cb962ac59075b964b07152d234b70', '4', null, '2017-01-19 00:00:00', null, '2017-04-07 12:26:28', '2', 'vdvdv@gmail.com', '46', '3', null, '2017-04-04');
INSERT INTO `user` VALUES ('26', null, 'Ketua', 'dg44', '44', '12131213', 'ketua@gmail.com', '202cb962ac59075b964b07152d234b70', '1', null, null, null, '2017-03-27 17:10:35', '1', null, '28', null, null, '2017-03-20');
INSERT INTO `user` VALUES ('27', '324324324', 'sarele', 'sdfdfd', '44', '21312312', 'abdmalik@gmail.com', null, null, null, null, null, '2017-03-27 17:10:35', '1', null, null, null, '4', '2017-03-20');
INSERT INTO `user` VALUES ('28', '', 'Yafiq zafran', 'bisnesman', '', '', 'yafiq@gmail.com', '202cb962ac59075b964b07152d234b70', '1', null, '2017-02-17 00:00:00', null, '2017-03-27 17:10:35', '1', null, null, null, null, '2017-03-20');
INSERT INTO `user` VALUES ('29', null, 'azmir', null, null, null, 'azmir@gmail.com', '202cb962ac59075b964b07152d234b70', '1', null, '2017-02-17 00:00:00', null, '2017-03-27 17:10:35', '1', null, null, null, null, '2017-03-20');
INSERT INTO `user` VALUES ('30', null, 'norizi', null, null, null, 'norizi@gmail.com', '202cb962ac59075b964b07152d234b70', '1', null, '2017-02-17 00:00:00', null, '2017-03-27 17:10:35', '1', null, null, null, null, '2017-03-20');
INSERT INTO `user` VALUES ('31', '0123333434', 'fauzi', 'Pegawai Khas', '52', '0388881234', 'fauzi@gmail.com', '202cb962ac59075b964b07152d234b70', '2', null, '2017-02-17 00:00:00', null, '2017-03-27 17:10:35', '1', null, '29', null, null, '2017-03-20');
INSERT INTO `user` VALUES ('32', null, 'nizam', null, null, null, 'nizam@gmail.com', '202cb962ac59075b964b07152d234b70', '2', null, '2017-02-17 00:00:00', null, '2017-03-27 17:10:35', '1', null, null, null, null, '2017-03-20');
INSERT INTO `user` VALUES ('33', null, 'zafran', null, null, null, 'zafran@gmail.com', '202cb962ac59075b964b07152d234b70', '2', null, '2017-02-17 00:00:00', null, '2017-03-27 17:10:35', '1', null, null, null, null, '2017-03-20');
INSERT INTO `user` VALUES ('34', null, 'qayum', null, null, null, 'qayum@gmail.com', '202cb962ac59075b964b07152d234b70', '2', null, '2017-02-17 00:00:00', null, '2017-03-27 17:10:35', '1', null, null, null, null, '2017-03-20');
INSERT INTO `user` VALUES ('35', '01234567890', 'aidil bin jaafar', 'Penolong pegawai', 'F29', '121312', 'aidil@gmail.com', '202cb962ac59075b964b07152d234b70', '2', null, '2017-02-17 00:00:00', null, '2017-03-27 17:10:35', '1', null, null, null, null, '2017-03-20');
INSERT INTO `user` VALUES ('36', null, 'matjan', null, null, null, 'matjan@gmail.com', '202cb962ac59075b964b07152d234b70', '2', null, '2017-02-17 00:00:00', null, '2017-03-27 17:10:35', '1', null, null, null, null, '2017-03-20');
INSERT INTO `user` VALUES ('37', '123123123', 'hazlee', 'pegawai', 'F29', '03123123123', 'hazlee@moha.gov.my', '202cb962ac59075b964b07152d234b70', '2', null, '2017-02-20 00:00:00', null, '2017-03-27 17:10:35', '1', null, null, null, null, '2017-03-20');
INSERT INTO `user` VALUES ('38', null, 'Fuziah Binti Abu Hanifah', 'SUB IT', 'Jusa', '03123123123', 'fuziah@moha.gov.my', '202cb962ac59075b964b07152d234b70', '1', null, null, null, '2017-03-27 17:10:35', '1', null, null, null, null, '2017-03-20');
INSERT INTO `user` VALUES ('39', '12312123123', 'matjan', 'PPTM', 'f29', '123123123123', 'mj@gmail.com', null, null, null, null, null, '2017-03-27 17:10:35', '1', null, null, null, '37', '2017-03-20');
INSERT INTO `user` VALUES ('40', null, 'Sub', 'SUB KP', 'Jusa', '324324', 'sub@moha.gov.my', '202cb962ac59075b964b07152d234b70', '1', null, null, null, '2017-03-27 17:10:35', '1', null, '35', null, null, '2017-03-20');
INSERT INTO `user` VALUES ('41', '123123', 'jamil', 'werwe', 'f54', '12312', 'jamil@moha.gov.my', null, null, null, null, null, '2017-03-27 17:10:35', '1', null, null, null, '35', '2017-03-20');
INSERT INTO `user` VALUES ('42', '123123123123', 'afifah', 'lawyer', '44', '1212312312312', 'afif@moha.gov.my', '202cb962ac59075b964b07152d234b70', '2', null, '2017-03-08 00:00:00', null, '2017-03-27 17:10:35', '1', null, null, null, null, '2017-03-20');
INSERT INTO `user` VALUES ('43', '12312123123', 'ahli1', '32', '44', '03123123123', 'ahli1@moha.gov.my', null, null, null, null, null, '2017-03-27 17:10:35', '1', null, null, null, '42', '2017-03-20');
INSERT INTO `user` VALUES ('44', '12312123123', 'ahli2', 'piun', '44', '01234434343', 'ahli1@moha.gov.my', null, '3', null, null, null, '2017-03-27 17:10:35', '1', null, null, null, '42', '2017-03-20');
INSERT INTO `user` VALUES ('45', '', 'Ketua Baru', '121231', '1231', '123123123', 'ketuabaru@gmail.com', '202cb962ac59075b964b07152d234b70', '1', null, null, null, '2017-03-27 17:10:35', '1', null, '42', null, null, '2017-03-20');
INSERT INTO `user` VALUES ('46', null, 'Ketua Baru lagi', 'ketua', '56', '1212312312312', 'ketuabarulagi@gmail.com', '202cb962ac59075b964b07152d234b70', '1', null, null, null, '2017-03-27 17:10:35', '1', null, '42', null, null, '2017-03-20');
INSERT INTO `user` VALUES ('47', null, 'Jamaludin', null, null, null, 'jamaludin@moha.gov.my', '81dc9bdb52d04dc20036dbd8313ed055', '2', null, '2017-03-24 00:00:00', null, '2017-03-27 17:10:35', '1', null, null, null, null, '2017-03-20');
INSERT INTO `user` VALUES ('48', null, 'john', null, null, null, 'john@gmail.com', '202cb962ac59075b964b07152d234b70', '2', null, '2017-03-24 00:00:00', null, '2017-03-27 17:10:35', '1', null, null, null, null, '2017-03-20');
INSERT INTO `user` VALUES ('49', null, 'jawa', null, null, null, 'jawa@moha.gov.my', '202cb962ac59075b964b07152d234b70', '2', null, '2017-03-24 00:00:00', null, '2017-03-27 17:10:35', '1', null, null, null, null, '2017-03-20');
INSERT INTO `user` VALUES ('50', null, 'adam', null, null, null, 'adam@gmail.com', '202cb962ac59075b964b07152d234b70', '2', null, '2017-03-27 00:00:00', null, '2017-04-02 15:05:43', '1', null, null, null, null, '2017-04-04');
INSERT INTO `user` VALUES ('51', '12312123123', 'Halim Bin Nor', 'Pegawai Kesihatan', 'F29', '01234434343', 'halim@gmail.com', '202cb962ac59075b964b07152d234b70', '2', null, '2017-04-04 00:00:00', null, '2017-04-04 15:17:01', '1', null, '52', null, null, '2017-04-04');
INSERT INTO `user` VALUES ('52', null, 'Dato Rosli', 'Ketua dah Pencen', 'Jusa', '0388881234', 'rosli@moha.gov.my', '202cb962ac59075b964b07152d234b70', '1', null, null, null, '0000-00-00 00:00:00', '1', null, '51', null, null, null);
