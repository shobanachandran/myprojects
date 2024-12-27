-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 06, 2019 at 07:26 AM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `iorangeerp`
--

-- --------------------------------------------------------

--
-- Table structure for table `area`
--

CREATE TABLE IF NOT EXISTS `area` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `state_id` int(11) NOT NULL,
  `dist_id` int(11) NOT NULL,
  `area_name` varchar(100) NOT NULL,
  `status` varchar(10) NOT NULL,
  `deleted` varchar(10) NOT NULL,
  `created_by` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `area`
--

INSERT INTO `area` (`id`, `state_id`, `dist_id`, `area_name`, `status`, `deleted`, `created_by`) VALUES
(3, 1, 1, 'Trichy Road', 'Active', 'N', 1),
(4, 1, 2, 'Palladam', 'Active', 'N', 1),
(6, 1, 2, 'tirupur', 'Active', 'N', 1),
(10, 1, 1, 'Gobi', 'Active', 'N', 1),
(13, 1, 9, 'Salem', 'Active', 'N', 1),
(15, 2, 3, 'Kollengode', 'Active', 'N', 1),
(17, 1, 1, 'avinashi road', 'Active', 'N', 1),
(19, 8, 13, '2nd street', 'Active', 'N', 1);

-- --------------------------------------------------------

--
-- Table structure for table `buyer_master`
--

CREATE TABLE IF NOT EXISTS `buyer_master` (
  `buyer_id` int(11) NOT NULL AUTO_INCREMENT,
  `buyer_name` varchar(100) NOT NULL,
  `buyer_short_name` varchar(100) NOT NULL,
  `buyer_desc` text NOT NULL,
  `status` enum('0','1') NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  PRIMARY KEY (`buyer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `buyer_master`
--

INSERT INTO `buyer_master` (`buyer_id`, `buyer_name`, `buyer_short_name`, `buyer_desc`, `status`, `created_by`, `created_date`) VALUES
(1, 'PR GARMENTS', 'PRG', 'About PR Garments', '0', 1, '2019-11-28 18:56:16');

-- --------------------------------------------------------

--
-- Table structure for table `company_info`
--

CREATE TABLE IF NOT EXISTS `company_info` (
  `id` int(11) NOT NULL,
  `company_name` varchar(100) NOT NULL,
  `company_unit` varchar(20) NOT NULL,
  `company_address` text NOT NULL,
  `company_phone` varchar(100) NOT NULL,
  `company_email` varchar(100) NOT NULL,
  `company_url` varchar(100) NOT NULL,
  `company_CIN` varchar(100) NOT NULL,
  `company_GSTIN` varchar(100) NOT NULL,
  `company_pan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company_info`
--

INSERT INTO `company_info` (`id`, `company_name`, `company_unit`, `company_address`, `company_phone`, `company_email`, `company_url`, `company_CIN`, `company_GSTIN`, `company_pan`) VALUES
(1, 'Iorange Innovation', 'unit1', 'address1,address2', '9976552368', 'tamil@iorange.in', '', '', 'GDEFG22232', 'GHAVPK0001');

-- --------------------------------------------------------

--
-- Table structure for table `contractors`
--

CREATE TABLE IF NOT EXISTS `contractors` (
  `con_id` int(11) NOT NULL AUTO_INCREMENT,
  `con_code` varchar(50) NOT NULL,
  `dept_id` int(11) NOT NULL,
  `con_name` varchar(100) NOT NULL,
  `con_address` text NOT NULL,
  `con_number` varchar(100) NOT NULL,
  `doj` date NOT NULL,
  `con_photo` text NOT NULL,
  `status` enum('0','1') NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  PRIMARY KEY (`con_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `contractors`
--

INSERT INTO `contractors` (`con_id`, `con_code`, `dept_id`, `con_name`, `con_address`, `con_number`, `doj`, `con_photo`, `status`, `created_by`, `created_date`) VALUES
(1, 'CON1000', 1, 'contractor name', 'Addresss', '94626266', '2019-11-19', '1.png', '1', 1, '2019-11-29 15:51:58'),
(2, 'CON2', 1, 'sadsad', 'sadsadsad', 'sadsada', '2019-12-28', '19-12-052.jpg', '0', 1, '2019-12-05 10:22:54');

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

CREATE TABLE IF NOT EXISTS `districts` (
  `dist_id` int(11) NOT NULL,
  `state_id` int(11) NOT NULL,
  `dist_name` varchar(100) NOT NULL,
  `status` varchar(10) NOT NULL,
  `deleted` varchar(10) NOT NULL,
  `created_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `districts`
--

INSERT INTO `districts` (`dist_id`, `state_id`, `dist_name`, `status`, `deleted`, `created_by`) VALUES
(1, 1, 'Anantapur', 'Active', 'N', 0),
(2, 1, 'Chittoor', 'Active', 'N', 0),
(3, 1, 'East Godavari', 'Active', 'N', 0),
(4, 1, 'Guntur', 'Active', 'N', 0),
(5, 1, 'Kadapa', 'Active', 'N', 0),
(6, 1, 'Krishna', 'Active', 'N', 0),
(7, 1, 'Kurnool', 'Active', 'N', 0),
(8, 1, 'Nellore', 'Active', 'N', 0),
(9, 1, 'Prakasam', 'Active', 'N', 0),
(10, 1, 'Srikakulam', 'Active', 'N', 0),
(11, 1, 'Visakhapatnam', 'Active', 'N', 0),
(12, 1, 'Vizianagaram', 'Active', 'N', 0),
(13, 1, 'West Godavari', 'Active', 'N', 0),
(14, 3, 'Anjaw', 'Active', 'N', 0),
(15, 3, 'Siang', 'Active', 'N', 0),
(16, 3, 'Changlang', 'Active', 'N', 0),
(17, 3, 'Dibang Valley', 'Active', 'N', 0),
(18, 3, 'East Kameng', 'Active', 'N', 0),
(19, 3, 'East Siang', 'Active', 'N', 0),
(20, 3, 'Kamle', 'Active', 'N', 0),
(21, 3, 'Kra Daadi', 'Active', 'N', 0),
(22, 3, 'Kurung Kumey', 'Active', 'N', 0),
(23, 3, 'Lepa Rada ', 'Active', 'N', 0),
(24, 3, 'Lohit', 'Active', 'N', 0),
(25, 3, 'Longding', 'Active', 'N', 0),
(26, 3, 'Lower Dibang Valley', 'Active', 'N', 0),
(27, 3, 'Lower Siang', 'Active', 'N', 0),
(28, 3, 'Lower Subansiri', 'Active', 'N', 0),
(29, 3, 'Namsai', 'Active', 'N', 0),
(30, 3, 'Pakke Kessang', 'Active', 'N', 0),
(31, 3, 'Papum Pare', 'Active', 'N', 0),
(32, 3, 'Shi Yomi', 'Active', 'N', 0),
(33, 3, 'Tawang', 'Active', 'N', 0),
(34, 3, 'Tirap', 'Active', 'N', 0),
(35, 3, 'Upper Siang', 'Active', 'N', 0),
(36, 3, 'Upper Subansiri', 'Active', 'N', 0),
(37, 3, 'West Kameng', 'Active', 'N', 0),
(38, 3, 'West Siang', 'Active', 'N', 0),
(39, 2, 'BAKSA', 'Active', 'N', 0),
(40, 2, 'BARPETA', 'Active', 'N', 0),
(41, 2, 'BONGAIGAON', 'Active', 'N', 0),
(42, 2, 'CACHAR', 'Active', 'N', 0),
(43, 2, 'CHIRANG', 'Active', 'N', 0),
(44, 2, 'DARRANG', 'Active', 'N', 0),
(45, 2, 'DHEMAJI', 'Active', 'N', 0),
(46, 2, 'DHUBRI', 'Active', 'N', 0),
(47, 2, 'DIBRUGARH', 'Active', 'N', 0),
(48, 2, 'DIMA HASAO', 'Active', 'N', 0),
(49, 2, 'GOALPARA', 'Active', 'N', 0),
(50, 2, 'GOLAGHAT', 'Active', 'N', 0),
(51, 2, 'HAILAKANDI', 'Active', 'N', 0),
(52, 2, 'JORHAT', 'Active', 'N', 0),
(53, 2, 'KAMRUP', 'Active', 'N', 0),
(54, 2, 'KAMRUP METRO', 'Active', 'N', 0),
(55, 2, 'KARBI ANGLONG', 'Active', 'N', 0),
(56, 2, 'KARIMGANJ', 'Active', 'N', 0),
(57, 2, 'KOKRAJHAR', 'Active', 'N', 0),
(58, 2, 'LAKHIMPUR', 'Active', 'N', 0),
(59, 2, 'MARIGAON', 'Active', 'N', 0),
(60, 2, 'NAGAON', 'Active', 'N', 0),
(61, 2, 'NALBARI', 'Active', 'N', 0),
(62, 2, 'SIVASAGAR', 'Active', 'N', 0),
(63, 2, 'SONITPUR', 'Active', 'N', 0),
(64, 2, 'TINSUKIA', 'Active', 'N', 0),
(65, 2, 'UDALGURI', 'Active', 'N', 0),
(66, 4, 'ARARIA', 'Active', 'N', 0),
(67, 4, 'ARWAL', 'Active', 'N', 0),
(68, 4, 'AURANGABAD', 'Active', 'N', 0),
(69, 4, 'BANKA', 'Active', 'N', 0),
(70, 4, 'BEGUSARAI', 'Active', 'N', 0),
(71, 4, 'BHAGALPUR', 'Active', 'N', 0),
(72, 4, 'BHOJPUR', 'Active', 'N', 0),
(73, 4, 'BUXAR', 'Active', 'N', 0),
(74, 4, 'DARBHANGA', 'Active', 'N', 0),
(75, 4, 'GAYA', 'Active', 'N', 0),
(76, 4, 'GOPALGANJ', 'Active', 'N', 0),
(77, 4, 'JAMUI', 'Active', 'N', 0),
(78, 4, 'JEHANABAD', 'Active', 'N', 0),
(79, 4, 'KAIMUR (BHABUA)', 'Active', 'N', 0),
(80, 4, 'KATIHAR', 'Active', 'N', 0),
(81, 4, 'KHAGARIA', 'Active', 'N', 0),
(82, 4, 'KISHANGANJ', 'Active', 'N', 0),
(83, 4, 'LAKHISARAI', 'Active', 'N', 0),
(84, 4, 'MADHEPURA', 'Active', 'N', 0),
(85, 4, 'MADHUBANI', 'Active', 'N', 0),
(86, 4, 'MUNGER', 'Active', 'N', 0),
(87, 4, 'MUZAFFARPUR', 'Active', 'N', 0),
(88, 4, 'NALANDA', 'Active', 'N', 0),
(89, 4, 'NAWADA', 'Active', 'N', 0),
(90, 4, 'PASHCHIM CHAMPARAN', 'Active', 'N', 0),
(91, 4, 'PATNA', 'Active', 'N', 0),
(92, 4, 'PURBI CHAMPARAN', 'Active', 'N', 0),
(93, 4, 'PURNIA', 'Active', 'N', 0),
(94, 4, 'ROHTAS', 'Active', 'N', 0),
(95, 4, 'SAHARSA', 'Active', 'N', 0),
(96, 4, 'SAMASTIPUR', 'Active', 'N', 0),
(97, 4, 'SARAN', 'Active', 'N', 0),
(98, 4, 'SHEIKHPURA', 'Active', 'N', 0),
(99, 4, 'SHEOHAR', 'Active', 'N', 0),
(100, 4, 'SITAMARHI', 'Active', 'N', 0),
(101, 4, 'SIWAN', 'Active', 'N', 0),
(102, 4, 'SUPAUL', 'Active', 'N', 0),
(103, 4, 'VAISHALI', 'Active', 'N', 0),
(104, 5, 'AHMADABAD', 'Active', 'N', 0),
(105, 5, 'AMRELI', 'Active', 'N', 0),
(106, 5, 'ANAND', 'Active', 'N', 0),
(107, 5, 'ARVALLI', 'Active', 'N', 0),
(108, 5, 'BANAS KANTHA', 'Active', 'N', 0),
(109, 5, 'BHARUCH', 'Active', 'N', 0),
(110, 5, 'BHAVNAGAR', 'Active', 'N', 0),
(111, 5, 'BOTAD', 'Active', 'N', 0),
(112, 5, 'CHHOTAUDEPUR', 'Active', 'N', 0),
(113, 5, 'DANG', 'Active', 'N', 0),
(114, 5, 'DEVBHUMI DWARKA', 'Active', 'N', 0),
(115, 5, 'DOHAD', 'Active', 'N', 0),
(116, 5, 'GANDHINAGAR', 'Active', 'N', 0),
(117, 5, 'GIR SOMNATH', 'Active', 'N', 0),
(118, 5, 'JAMNAGAR', 'Active', 'N', 0),
(119, 5, 'JUNAGADH', 'Active', 'N', 0),
(120, 5, 'KACHCHH', 'Active', 'N', 0),
(121, 5, 'KHEDA', 'Active', 'N', 0),
(122, 5, 'MAHESANA', 'Active', 'N', 0),
(123, 5, 'Mahisagar', 'Active', 'N', 0),
(124, 5, 'MORBI', 'Active', 'N', 0),
(125, 5, 'NARMADA', 'Active', 'N', 0),
(126, 5, 'NAVSARI', 'Active', 'N', 0),
(127, 5, 'PANCH MAHALS', 'Active', 'N', 0),
(128, 5, 'PATAN', 'Active', 'N', 0),
(129, 5, 'PORBANDAR', 'Active', 'N', 0),
(130, 5, 'RAJKOT', 'Active', 'N', 0),
(131, 5, 'SABAR KANTHA', 'Active', 'N', 0),
(132, 5, 'SURAT', 'Active', 'N', 0),
(133, 5, 'SURENDRANAGAR', 'Active', 'N', 0),
(134, 5, 'TAPI', 'Active', 'N', 0),
(135, 5, 'VADODARA', 'Active', 'N', 0),
(136, 5, 'VALSAD', 'Active', 'N', 0),
(137, 6, 'AMBALA', 'Active', 'N', 0),
(138, 6, 'BHIWANI', 'Active', 'N', 0),
(139, 6, 'CHARKI DADRI', 'Active', 'N', 0),
(140, 6, 'FARIDABAD', 'Active', 'N', 0),
(141, 6, 'FATEHABAD', 'Active', 'N', 0),
(142, 6, 'GURUGRAM', 'Active', 'N', 0),
(143, 6, 'HISAR', 'Active', 'N', 0),
(144, 6, 'JHAJJAR', 'Active', 'N', 0),
(145, 6, 'JIND', 'Active', 'N', 0),
(146, 6, 'KAITHAL', 'Active', 'N', 0),
(147, 6, 'KARNAL', 'Active', 'N', 0),
(148, 6, 'KURUKSHETRA', 'Active', 'N', 0),
(149, 6, 'MAHENDRAGARH', 'Active', 'N', 0),
(150, 6, 'MEWAT', 'Active', 'N', 0),
(151, 6, 'PALWAL', 'Active', 'N', 0),
(152, 6, 'PANCHKULA', 'Active', 'N', 0),
(153, 6, 'PANIPAT', 'Active', 'N', 0),
(154, 6, 'REWARI', 'Active', 'N', 0),
(155, 6, 'ROHTAK', 'Active', 'N', 0),
(156, 6, 'SIRSA', 'Active', 'N', 0),
(157, 6, 'SONIPAT', 'Active', 'N', 0),
(158, 6, 'YAMUNANAGAR', 'Active', 'N', 0),
(159, 7, 'BILASPUR', 'Active', 'N', 0),
(160, 7, 'CHAMBA', 'Active', 'N', 0),
(161, 7, 'HAMIRPUR', 'Active', 'N', 0),
(162, 7, 'KANGRA', 'Active', 'N', 0),
(163, 7, 'KINNAUR', 'Active', 'N', 0),
(164, 7, 'KULLU', 'Active', 'N', 0),
(165, 7, 'LAHUL AND SPITI', 'Active', 'N', 0),
(166, 7, 'MANDI', 'Active', 'N', 0),
(167, 7, 'SHIMLA', 'Active', 'N', 0),
(168, 7, 'SIRMAUR', 'Active', 'N', 0),
(169, 7, 'SOLAN', 'Active', 'N', 0),
(170, 7, 'UNA', 'Active', 'N', 0),
(171, 8, 'ANANTNAG', 'Active', 'N', 0),
(172, 8, 'BADGAM', 'Active', 'N', 0),
(173, 8, 'BANDIPORA', 'Active', 'N', 0),
(174, 8, 'BARAMULLA', 'Active', 'N', 0),
(175, 8, 'DODA', 'Active', 'N', 0),
(176, 8, 'GANDERBAL', 'Active', 'N', 0),
(177, 8, 'JAMMU', 'Active', 'N', 0),
(178, 8, 'KARGIL', 'Active', 'N', 0),
(179, 8, 'KATHUA', 'Active', 'N', 0),
(180, 8, 'KISHTWAR', 'Active', 'N', 0),
(181, 8, 'KULGAM', 'Active', 'N', 0),
(182, 8, 'KUPWARA', 'Active', 'N', 0),
(183, 8, 'LEH LADAKH', 'Active', 'N', 0),
(184, 8, 'POONCH', 'Active', 'N', 0),
(185, 8, 'PULWAMA', 'Active', 'N', 0),
(186, 8, 'RAJAURI', 'Active', 'N', 0),
(187, 8, 'RAMBAN', 'Active', 'N', 0),
(188, 8, 'REASI', 'Active', 'N', 0),
(189, 8, 'SAMBA', 'Active', 'N', 0),
(190, 8, 'SHOPIAN', 'Active', 'N', 0),
(191, 8, 'SRINAGAR', 'Active', 'N', 0),
(192, 8, 'UDHAMPUR', 'Active', 'N', 0),
(193, 9, 'BAGALKOT', 'Active', 'N', 0),
(194, 9, 'BALLARI', 'Active', 'N', 0),
(195, 9, 'BELAGAVI', 'Active', 'N', 0),
(196, 9, 'BENGALURU RURAL', 'Active', 'N', 0),
(197, 9, 'BENGALURU URBAN', 'Active', 'N', 0),
(198, 9, 'BIDAR', 'Active', 'N', 0),
(199, 9, 'CHAMARAJANAGAR', 'Active', 'N', 0),
(200, 9, 'CHIKBALLAPUR', 'Active', 'N', 0),
(201, 9, 'CHIKKAMAGALURU', 'Active', 'N', 0),
(202, 9, 'CHITRADURGA', 'Active', 'N', 0),
(203, 9, 'DAKSHIN KANNAD', 'Active', 'N', 0),
(204, 9, 'DAVANGERE', 'Active', 'N', 0),
(205, 9, 'DHARWAD', 'Active', 'N', 0),
(206, 9, 'GADAG', 'Active', 'N', 0),
(207, 9, 'HASSAN', 'Active', 'N', 0),
(208, 9, 'HAVERI', 'Active', 'N', 0),
(209, 9, 'KALABURAGI', 'Active', 'N', 0),
(210, 9, 'KODAGU', 'Active', 'N', 0),
(211, 9, 'KOLAR', 'Active', 'N', 0),
(212, 9, 'KOPPAL', 'Active', 'N', 0),
(213, 9, 'MANDYA', 'Active', 'N', 0),
(214, 9, 'MYSURU', 'Active', 'N', 0),
(215, 9, 'RAICHUR', 'Active', 'N', 0),
(216, 9, 'RAMANAGARA', 'Active', 'N', 0),
(217, 9, 'SHIVAMOGGA', 'Active', 'N', 0),
(218, 9, 'TUMAKURU', 'Active', 'N', 0),
(219, 9, 'UDUPI', 'Active', 'N', 0),
(220, 9, 'UTTAR KANNAD', 'Active', 'N', 0),
(221, 9, 'VIJAYAPURA', 'Active', 'N', 0),
(222, 9, 'YADGIR', 'Active', 'N', 0),
(223, 10, 'ALAPPUZHA', 'Active', 'N', 0),
(224, 10, 'ERNAKULAM', 'Active', 'N', 0),
(225, 10, 'IDUKKI', 'Active', 'N', 0),
(226, 10, 'KANNUR', 'Active', 'N', 0),
(227, 10, 'KASARAGOD', 'Active', 'N', 0),
(228, 10, 'KOLLAM', 'Active', 'N', 0),
(229, 10, 'KOTTAYAM', 'Active', 'N', 0),
(230, 10, 'KOZHIKODE', 'Active', 'N', 0),
(231, 10, 'MALAPPURAM', 'Active', 'N', 0),
(232, 10, 'PALAKKAD', 'Active', 'N', 0),
(233, 10, 'PATHANAMTHITTA', 'Active', 'N', 0),
(234, 10, 'THIRUVANANTHAPURAM', 'Active', 'N', 0),
(235, 10, 'THRISSUR', 'Active', 'N', 0),
(236, 10, 'WAYANAD', 'Active', 'N', 0),
(237, 11, 'AGAR MALWA', 'Active', 'N', 0),
(238, 11, 'ALIRAJPUR', 'Active', 'N', 0),
(239, 11, 'ANUPPUR', 'Active', 'N', 0),
(240, 11, 'ASHOKNAGAR', 'Active', 'N', 0),
(241, 11, 'BALAGHAT', 'Active', 'N', 0),
(242, 11, 'BARWANI', 'Active', 'N', 0),
(243, 11, 'BETUL', 'Active', 'N', 0),
(244, 11, 'BHIND', 'Active', 'N', 0),
(245, 11, 'BHOPAL', 'Active', 'N', 0),
(246, 11, 'BURHANPUR', 'Active', 'N', 0),
(247, 11, 'CHHATARPUR', 'Active', 'N', 0),
(248, 11, 'CHHINDWARA', 'Active', 'N', 0),
(249, 11, 'DAMOH', 'Active', 'N', 0),
(250, 11, 'DATIA', 'Active', 'N', 0),
(251, 11, 'DEWAS', 'Active', 'N', 0),
(252, 11, 'DHAR', 'Active', 'N', 0),
(253, 11, 'DINDORI', 'Active', 'N', 0),
(254, 11, 'EAST NIMAR', 'Active', 'N', 0),
(255, 11, 'GUNA', 'Active', 'N', 0),
(256, 11, 'GWALIOR', 'Active', 'N', 0),
(257, 11, 'HARDA', 'Active', 'N', 0),
(258, 11, 'HOSHANGABAD', 'Active', 'N', 0),
(259, 11, 'INDORE', 'Active', 'N', 0),
(260, 11, 'JABALPUR', 'Active', 'N', 0),
(261, 11, 'JHABUA', 'Active', 'N', 0),
(262, 11, 'KATNI', 'Active', 'N', 0),
(263, 11, 'KHARGONE', 'Active', 'N', 0),
(264, 11, 'MANDLA', 'Active', 'N', 0),
(265, 11, 'MANDSAUR', 'Active', 'N', 0),
(266, 11, 'MORENA', 'Active', 'N', 0),
(267, 11, 'NARSINGHPUR', 'Active', 'N', 0),
(268, 11, 'NEEMUCH', 'Active', 'N', 0),
(269, 11, 'PANNA', 'Active', 'N', 0),
(270, 11, 'RAISEN', 'Active', 'N', 0),
(271, 11, 'RAJGARH', 'Active', 'N', 0),
(272, 11, 'RATLAM', 'Active', 'N', 0),
(273, 11, 'REWA', 'Active', 'N', 0),
(274, 11, 'SAGAR', 'Active', 'N', 0),
(275, 11, 'SATNA', 'Active', 'N', 0),
(276, 11, 'SEHORE', 'Active', 'N', 0),
(277, 11, 'SEONI', 'Active', 'N', 0),
(278, 11, 'SHAHDOL', 'Active', 'N', 0),
(279, 11, 'SHAJAPUR', 'Active', 'N', 0),
(280, 11, 'SHEOPUR', 'Active', 'N', 0),
(281, 11, 'SHIVPURI', 'Active', 'N', 0),
(282, 11, 'SIDHI', 'Active', 'N', 0),
(283, 11, 'SINGRAULI', 'Active', 'N', 0),
(284, 11, 'TIKAMGARH', 'Active', 'N', 0),
(285, 11, 'UJJAIN', 'Active', 'N', 0),
(286, 11, 'UMARIA', 'Active', 'N', 0),
(287, 11, 'VIDISHA', 'Active', 'N', 0),
(288, 12, 'AHMEDNAGAR', 'Active', 'N', 0),
(289, 12, 'AKOLA', 'Active', 'N', 0),
(290, 12, 'AMRAVATI', 'Active', 'N', 0),
(291, 12, 'AURANGABAD', 'Active', 'N', 0),
(292, 12, 'BEED', 'Active', 'N', 0),
(293, 12, 'BHANDARA', 'Active', 'N', 0),
(294, 12, 'BULDHANA', 'Active', 'N', 0),
(295, 12, 'CHANDRAPUR', 'Active', 'N', 0),
(296, 12, 'DHULE', 'Active', 'N', 0),
(297, 12, 'GADCHIROLI', 'Active', 'N', 0),
(298, 12, 'GONDIA', 'Active', 'N', 0),
(299, 12, 'HINGOLI', 'Active', 'N', 0),
(300, 12, 'JALGAON', 'Active', 'N', 0),
(301, 12, 'JALNA', 'Active', 'N', 0),
(302, 12, 'KOLHAPUR', 'Active', 'N', 0),
(303, 12, 'LATUR', 'Active', 'N', 0),
(304, 12, 'MUMBAI', 'Active', 'N', 0),
(305, 12, 'MUMBAI SUBURBAN', 'Active', 'N', 0),
(306, 12, 'NAGPUR', 'Active', 'N', 0),
(307, 12, 'NANDED', 'Active', 'N', 0),
(308, 12, 'NANDURBAR', 'Active', 'N', 0),
(309, 12, 'NASHIK', 'Active', 'N', 0),
(310, 12, 'OSMANABAD', 'Active', 'N', 0),
(311, 12, 'PALGHAR', 'Active', 'N', 0),
(312, 12, 'PARBHANI', 'Active', 'N', 0),
(313, 12, 'PUNE', 'Active', 'N', 0),
(314, 12, 'RAIGAD', 'Active', 'N', 0),
(315, 12, 'RATNAGIRI', 'Active', 'N', 0),
(316, 12, 'SANGLI', 'Active', 'N', 0),
(317, 12, 'SATARA', 'Active', 'N', 0),
(318, 12, 'SINDHUDURG', 'Active', 'N', 0),
(319, 12, 'SOLAPUR', 'Active', 'N', 0),
(320, 12, 'THANE', 'Active', 'N', 0),
(321, 12, 'WARDHA', 'Active', 'N', 0),
(322, 12, 'WASHIM', 'Active', 'N', 0),
(323, 12, 'YAVATMAL', 'Active', 'N', 0),
(324, 13, 'BISHNUPUR', 'Active', 'N', 0),
(325, 13, 'CHANDEL', 'Active', 'N', 0),
(326, 13, 'CHURACHANDPUR', 'Active', 'N', 0),
(327, 13, 'IMPHAL EAST', 'Active', 'N', 0),
(328, 13, 'IMPHAL WEST', 'Active', 'N', 0),
(329, 13, 'SENAPATI', 'Active', 'N', 0),
(330, 13, 'TAMENGLONG', 'Active', 'N', 0),
(331, 13, 'THOUBAL', 'Active', 'N', 0),
(332, 13, 'UKHRUL', 'Active', 'N', 0),
(333, 14, 'EAST GARO HILLS', 'Active', 'N', 0),
(334, 14, 'EAST JAINTIA HILLS', 'Active', 'N', 0),
(335, 14, 'EAST KHASI HILLS', 'Active', 'N', 0),
(336, 14, 'NORTH GARO HILLS', 'Active', 'N', 0),
(337, 14, 'RI BHOI', 'Active', 'N', 0),
(338, 14, 'SOUTH GARO HILLS', 'Active', 'N', 0),
(339, 14, 'SOUTH WEST GARO HILLS', 'Active', 'N', 0),
(340, 14, 'SOUTH WEST KHASI HILLS', 'Active', 'N', 0),
(341, 14, 'WEST GARO HILLS', 'Active', 'N', 0),
(342, 14, 'WEST JAINTIA HILLS', 'Active', 'N', 0),
(343, 14, 'WEST KHASI HILLS', 'Active', 'N', 0),
(344, 15, 'AIZAWL', 'Active', 'N', 0),
(345, 15, 'CHAMPHAI', 'Active', 'N', 0),
(346, 15, 'KOLASIB', 'Active', 'N', 0),
(347, 15, 'LAWNGTLAI', 'Active', 'N', 0),
(348, 15, 'LUNGLEI', 'Active', 'N', 0),
(349, 15, 'MAMIT', 'Active', 'N', 0),
(350, 15, 'SAIHA', 'Active', 'N', 0),
(351, 15, 'SERCHHIP', 'Active', 'N', 0),
(352, 16, 'DIMAPUR', 'Active', 'N', 0),
(353, 16, 'KIPHIRE', 'Active', 'N', 0),
(354, 16, 'KOHIMA', 'Active', 'N', 0),
(355, 16, 'LONGLENG', 'Active', 'N', 0),
(356, 16, 'MOKOKCHUNG', 'Active', 'N', 0),
(357, 16, 'MON', 'Active', 'N', 0),
(358, 16, 'PEREN', 'Active', 'N', 0),
(359, 16, 'PHEK', 'Active', 'N', 0),
(360, 16, 'TUENSANG', 'Active', 'N', 0),
(361, 16, 'WOKHA', 'Active', 'N', 0),
(362, 16, 'ZUNHEBOTO', 'Active', 'N', 0),
(363, 17, 'ANUGUL', 'Active', 'N', 0),
(364, 17, 'BALANGIR', 'Active', 'N', 0),
(365, 17, 'BALESHWAR', 'Active', 'N', 0),
(366, 17, 'BARGARH', 'Active', 'N', 0),
(367, 17, 'BHADRAK', 'Active', 'N', 0),
(368, 17, 'BOUDH', 'Active', 'N', 0),
(369, 17, 'CUTTACK', 'Active', 'N', 0),
(370, 17, 'DEOGARH', 'Active', 'N', 0),
(371, 17, 'DHENKANAL', 'Active', 'N', 0),
(372, 17, 'GAJAPATI', 'Active', 'N', 0),
(373, 17, 'GANJAM', 'Active', 'N', 0),
(374, 17, 'JAGATSINGHAPUR', 'Active', 'N', 0),
(375, 17, 'JAJAPUR', 'Active', 'N', 0),
(376, 17, 'JHARSUGUDA', 'Active', 'N', 0),
(377, 17, 'KALAHANDI', 'Active', 'N', 0),
(378, 17, 'KANDHAMAL', 'Active', 'N', 0),
(379, 17, 'KENDRAPARA', 'Active', 'N', 0),
(380, 17, 'KENDUJHAR', 'Active', 'N', 0),
(381, 17, 'KHORDHA', 'Active', 'N', 0),
(382, 17, 'KORAPUT', 'Active', 'N', 0),
(383, 17, 'MALKANGIRI', 'Active', 'N', 0),
(384, 17, 'MAYURBHANJ', 'Active', 'N', 0),
(385, 17, 'NABARANGPUR', 'Active', 'N', 0),
(386, 17, 'NAYAGARH', 'Active', 'N', 0),
(387, 17, 'NUAPADA', 'Active', 'N', 0),
(388, 17, 'PURI', 'Active', 'N', 0),
(389, 17, 'RAYAGADA', 'Active', 'N', 0),
(390, 17, 'SAMBALPUR', 'Active', 'N', 0),
(391, 17, 'SONEPUR', 'Active', 'N', 0),
(392, 17, 'SUNDARGARH', 'Active', 'N', 0),
(393, 18, 'AMRITSAR', 'Active', 'N', 0),
(394, 18, 'BARNALA', 'Active', 'N', 0),
(395, 18, 'BATHINDA', 'Active', 'N', 0),
(396, 18, 'FARIDKOT', 'Active', 'N', 0),
(397, 18, 'FATEHGARH SAHIB', 'Active', 'N', 0),
(398, 18, 'FAZILKA', 'Active', 'N', 0),
(399, 18, 'FIROZEPUR', 'Active', 'N', 0),
(400, 18, 'GURDASPUR', 'Active', 'N', 0),
(401, 18, 'HOSHIARPUR', 'Active', 'N', 0),
(402, 18, 'JALANDHAR', 'Active', 'N', 0),
(403, 18, 'KAPURTHALA', 'Active', 'N', 0),
(404, 18, 'LUDHIANA', 'Active', 'N', 0),
(405, 18, 'MANSA', 'Active', 'N', 0),
(406, 18, 'MOGA', 'Active', 'N', 0),
(407, 18, 'NAWANSHAHR', 'Active', 'N', 0),
(408, 18, 'PATHANKOT', 'Active', 'N', 0),
(409, 18, 'PATIALA', 'Active', 'N', 0),
(410, 18, 'RUPNAGAR', 'Active', 'N', 0),
(411, 18, 'SANGRUR', 'Active', 'N', 0),
(412, 18, 'S.A.S Nagar', 'Active', 'N', 0),
(413, 18, 'SRI MUKTSAR SAHIB', 'Active', 'N', 0),
(414, 18, 'Tarn Taran', 'Active', 'N', 0),
(415, 19, 'AJMER', 'Active', 'N', 0),
(416, 19, 'ALWAR', 'Active', 'N', 0),
(417, 19, 'BANSWARA', 'Active', 'N', 0),
(418, 19, 'BARAN', 'Active', 'N', 0),
(419, 19, 'BARMER', 'Active', 'N', 0),
(420, 19, 'BHARATPUR', 'Active', 'N', 0),
(421, 19, 'BHILWARA', 'Active', 'N', 0),
(422, 19, 'BIKANER', 'Active', 'N', 0),
(423, 19, 'BUNDI', 'Active', 'N', 0),
(424, 19, 'CHITTORGARH', 'Active', 'N', 0),
(425, 19, 'CHURU', 'Active', 'N', 0),
(426, 19, 'DAUSA', 'Active', 'N', 0),
(427, 19, 'DHOLPUR', 'Active', 'N', 0),
(428, 19, 'DUNGARPUR', 'Active', 'N', 0),
(429, 19, 'GANGANAGAR', 'Active', 'N', 0),
(430, 19, 'HANUMANGARH', 'Active', 'N', 0),
(431, 19, 'JAIPUR', 'Active', 'N', 0),
(432, 19, 'JAISALMER', 'Active', 'N', 0),
(433, 19, 'JALORE', 'Active', 'N', 0),
(434, 19, 'JHALAWAR', 'Active', 'N', 0),
(435, 19, 'JHUNJHUNU', 'Active', 'N', 0),
(436, 19, 'JODHPUR', 'Active', 'N', 0),
(437, 19, 'KARAULI', 'Active', 'N', 0),
(438, 19, 'KOTA', 'Active', 'N', 0),
(439, 19, 'NAGAUR', 'Active', 'N', 0),
(440, 19, 'PALI', 'Active', 'N', 0),
(441, 19, 'PRATAPGARH', 'Active', 'N', 0),
(442, 19, 'RAJSAMAND', 'Active', 'N', 0),
(443, 19, 'SAWAI MADHOPUR', 'Active', 'N', 0),
(444, 19, 'SIKAR', 'Active', 'N', 0),
(445, 19, 'SIROHI', 'Active', 'N', 0),
(446, 19, 'TONK', 'Active', 'N', 0),
(447, 19, 'UDAIPUR', 'Active', 'N', 0),
(448, 20, 'EAST DISTRICT', 'Active', 'N', 0),
(449, 20, 'NORTH DISTRICT', 'Active', 'N', 0),
(450, 20, 'SOUTH DISTRICT', 'Active', 'N', 0),
(451, 20, 'WEST DISTRICT', 'Active', 'N', 0),
(452, 21, 'Ariyalur', 'Active', 'N', 0),
(453, 21, 'CHENNAI', 'Active', 'N', 0),
(454, 21, 'COIMBATORE', 'Active', 'N', 0),
(455, 21, 'CUDDALORE', 'Active', 'N', 0),
(456, 21, 'DHARMAPURI', 'Active', 'N', 0),
(457, 21, 'DINDIGUL', 'Active', 'N', 0),
(458, 21, 'ERODE', 'Active', 'N', 0),
(459, 21, 'KANCHIPURAM', 'Active', 'N', 0),
(460, 21, 'KANNIYAKUMARI', 'Active', 'N', 0),
(461, 21, 'KARUR', 'Active', 'N', 0),
(462, 21, 'KRISHNAGIRI', 'Active', 'N', 0),
(463, 21, 'MADURAI', 'Active', 'N', 0),
(464, 21, 'NAGAPATTINAM', 'Active', 'N', 0),
(465, 21, 'NAMAKKAL', 'Active', 'N', 0),
(466, 21, 'PERAMBALUR', 'Active', 'N', 0),
(467, 21, 'PUDUKKOTTAI', 'Active', 'N', 0),
(468, 21, 'RAMANATHAPURAM', 'Active', 'N', 0),
(469, 21, 'SALEM', 'Active', 'N', 0),
(470, 21, 'SIVAGANGA', 'Active', 'N', 0),
(471, 21, 'THANJAVUR', 'Active', 'N', 0),
(472, 21, 'THENI', 'Active', 'N', 0),
(473, 21, 'THE NILGIRIS', 'Active', 'N', 0),
(474, 21, 'THIRUVALLUR', 'Active', 'N', 0),
(475, 21, 'THIRUVARUR', 'Active', 'N', 0),
(476, 21, 'TIRUCHIRAPPALLI', 'Active', 'N', 0),
(477, 21, 'TIRUNELVELI', 'Active', 'N', 0),
(478, 21, 'TIRUPPUR', 'Active', 'N', 0),
(479, 21, 'TIRUVANNAMALAI', 'Active', 'N', 0),
(480, 21, 'TUTICORIN', 'Active', 'N', 0),
(481, 21, 'VELLORE', 'Active', 'N', 0),
(482, 21, 'VILLUPURAM', 'Active', 'N', 0),
(483, 21, 'VIRUDHUNAGAR', 'Active', 'N', 0),
(484, 22, 'Dhalai', 'Active', 'N', 0),
(485, 22, 'Gomati', 'Active', 'N', 0),
(486, 22, 'Khowai', 'Active', 'N', 0),
(487, 22, 'North Tripura', 'Active', 'N', 0),
(488, 22, 'Sepahijala', 'Active', 'N', 0),
(489, 22, 'South Tripura', 'Active', 'N', 0),
(490, 22, 'Unakoti', 'Active', 'N', 0),
(491, 22, 'West Tripura', 'Active', 'N', 0),
(492, 23, 'AGRA', 'Active', 'N', 0),
(493, 23, 'ALIGARH', 'Active', 'N', 0),
(494, 23, 'ALLAHABAD', 'Active', 'N', 0),
(495, 23, 'AMBEDKAR NAGAR', 'Active', 'N', 0),
(496, 23, 'Amethi', 'Active', 'N', 0),
(497, 23, 'AMROHA', 'Active', 'N', 0),
(498, 23, 'AURAIYA', 'Active', 'N', 0),
(499, 23, 'AZAMGARH', 'Active', 'N', 0),
(500, 23, 'BAGHPAT', 'Active', 'N', 0),
(501, 23, 'BAHRAICH', 'Active', 'N', 0),
(502, 23, 'BALLIA', 'Active', 'N', 0),
(503, 23, 'BALRAMPUR', 'Active', 'N', 0),
(504, 23, 'BANDA', 'Active', 'N', 0),
(505, 23, 'BARABANKI', 'Active', 'N', 0),
(506, 23, 'BAREILLY', 'Active', 'N', 0),
(507, 23, 'BASTI', 'Active', 'N', 0),
(508, 23, 'BHADOHI', 'Active', 'N', 0),
(509, 23, 'BIJNOR', 'Active', 'N', 0),
(510, 23, 'BUDAUN', 'Active', 'N', 0),
(511, 23, 'BULANDSHAHR', 'Active', 'N', 0),
(512, 23, 'CHANDAULI', 'Active', 'N', 0),
(513, 23, 'CHITRAKOOT', 'Active', 'N', 0),
(514, 23, 'DEORIA', 'Active', 'N', 0),
(515, 23, 'ETAH', 'Active', 'N', 0),
(516, 23, 'ETAWAH', 'Active', 'N', 0),
(517, 23, 'FAIZABAD', 'Active', 'N', 0),
(518, 23, 'FARRUKHABAD', 'Active', 'N', 0),
(519, 23, 'FATEHPUR', 'Active', 'N', 0),
(520, 23, 'FIROZABAD', 'Active', 'N', 0),
(521, 23, 'GAUTAM BUDDHA NAGAR', 'Active', 'N', 0),
(522, 23, 'GHAZIABAD', 'Active', 'N', 0),
(523, 23, 'GHAZIPUR', 'Active', 'N', 0),
(524, 23, 'GONDA', 'Active', 'N', 0),
(525, 23, 'GORAKHPUR', 'Active', 'N', 0),
(526, 23, 'HAMIRPUR', 'Active', 'N', 0),
(527, 23, 'HAPUR', 'Active', 'N', 0),
(528, 23, 'HARDOI', 'Active', 'N', 0),
(529, 23, 'HATHRAS', 'Active', 'N', 0),
(530, 23, 'JALAUN', 'Active', 'N', 0),
(531, 23, 'JAUNPUR', 'Active', 'N', 0),
(532, 23, 'JHANSI', 'Active', 'N', 0),
(533, 23, 'KANNAUJ', 'Active', 'N', 0),
(534, 23, 'KANPUR DEHAT', 'Active', 'N', 0),
(535, 23, 'KANPUR NAGAR', 'Active', 'N', 0),
(536, 23, 'Kasganj', 'Active', 'N', 0),
(537, 23, 'KAUSHAMBI', 'Active', 'N', 0),
(538, 23, 'KHERI', 'Active', 'N', 0),
(539, 23, 'KUSHI NAGAR', 'Active', 'N', 0),
(540, 23, 'LALITPUR', 'Active', 'N', 0),
(541, 23, 'LUCKNOW', 'Active', 'N', 0),
(542, 23, 'MAHARAJGANJ', 'Active', 'N', 0),
(543, 23, 'MAHOBA', 'Active', 'N', 0),
(544, 23, 'MAINPURI', 'Active', 'N', 0),
(545, 23, 'MATHURA', 'Active', 'N', 0),
(546, 23, 'MAU', 'Active', 'N', 0),
(547, 23, 'MEERUT', 'Active', 'N', 0),
(548, 23, 'MIRZAPUR', 'Active', 'N', 0),
(549, 23, 'MORADABAD', 'Active', 'N', 0),
(550, 23, 'MUZAFFARNAGAR', 'Active', 'N', 0),
(551, 23, 'PILIBHIT', 'Active', 'N', 0),
(552, 23, 'PRATAPGARH', 'Active', 'N', 0),
(553, 23, 'RAE BARELI', 'Active', 'N', 0),
(554, 23, 'RAMPUR', 'Active', 'N', 0),
(555, 23, 'SAHARANPUR', 'Active', 'N', 0),
(556, 23, 'SAMBHAL', 'Active', 'N', 0),
(557, 23, 'SANT KABEER NAGAR', 'Active', 'N', 0),
(558, 23, 'SHAHJAHANPUR', 'Active', 'N', 0),
(559, 23, 'SHAMLI', 'Active', 'N', 0),
(560, 23, 'SHRAVASTI', 'Active', 'N', 0),
(561, 23, 'SIDDHARTH NAGAR', 'Active', 'N', 0),
(562, 23, 'SITAPUR', 'Active', 'N', 0),
(563, 23, 'SONBHADRA', 'Active', 'N', 0),
(564, 23, 'SULTANPUR', 'Active', 'N', 0),
(565, 23, 'UNNAO', 'Active', 'N', 0),
(566, 23, 'VARANASI', 'Active', 'N', 0),
(567, 24, '24 PARAGANAS NORTH', 'Active', 'N', 0),
(568, 24, '24 PARAGANAS SOUTH', 'Active', 'N', 0),
(569, 24, 'Alipurduar', 'Active', 'N', 0),
(570, 24, 'BANKURA', 'Active', 'N', 0),
(571, 24, 'BARDHAMAN', 'Active', 'N', 0),
(572, 24, 'BIRBHUM', 'Active', 'N', 0),
(573, 24, 'COOCHBEHAR', 'Active', 'N', 0),
(574, 24, 'DARJEELING', 'Active', 'N', 0),
(575, 24, 'DINAJPUR DAKSHIN', 'Active', 'N', 0),
(576, 24, 'DINAJPUR UTTAR', 'Active', 'N', 0),
(577, 24, 'HOOGHLY', 'Active', 'N', 0),
(578, 24, 'HOWRAH', 'Active', 'N', 0),
(579, 24, 'JALPAIGURI', 'Active', 'N', 0),
(580, 24, 'KOLKATA', 'Active', 'N', 0),
(581, 24, 'MALDAH', 'Active', 'N', 0),
(582, 24, 'MEDINIPUR EAST', 'Active', 'N', 0),
(583, 24, 'MEDINIPUR WEST', 'Active', 'N', 0),
(584, 24, 'MURSHIDABAD', 'Active', 'N', 0),
(585, 24, 'NADIA', 'Active', 'N', 0),
(586, 24, 'PURULIA', 'Active', 'N', 0),
(587, 25, 'CENTRAL', 'Active', 'N', 0),
(588, 25, 'EAST', 'Active', 'N', 0),
(589, 25, 'NEW DELHI', 'Active', 'N', 0),
(590, 25, 'NORTH', 'Active', 'N', 0),
(591, 25, 'NORTH EAST', 'Active', 'N', 0),
(592, 25, 'NORTH WEST', 'Active', 'N', 0),
(593, 25, 'SHAHDARA', 'Active', 'N', 0),
(594, 25, 'SOUTH', 'Active', 'N', 0),
(595, 25, 'South East', 'Active', 'N', 0),
(596, 25, 'SOUTH WEST', 'Active', 'N', 0),
(597, 25, 'WEST', 'Active', 'N', 0),
(598, 26, 'NORTH GOA', 'Active', 'N', 0),
(599, 26, 'SOUTH GOA', 'Active', 'N', 0),
(600, 27, 'KARAIKAL', 'Active', 'N', 0),
(601, 27, 'MAHE', 'Active', 'N', 0),
(602, 27, 'PONDICHERRY', 'Active', 'N', 0),
(603, 27, 'YANAM', 'Active', 'N', 0),
(604, 28, 'LAKSHADWEEP DISTRICT', 'Active', 'N', 0),
(605, 30, 'DADRA AND NAGAR HAVELI', 'Active', 'N', 0),
(606, 35, 'CHANDIGARH', 'Active', 'N', 0),
(607, 35, 'BALOD', 'Active', 'N', 0),
(608, 35, 'BALODA BAZAR', 'Active', 'N', 0),
(609, 35, 'BALRAMPUR', 'Active', 'N', 0),
(610, 35, 'BASTAR', 'Active', 'N', 0),
(611, 35, 'BEMETARA', 'Active', 'N', 0),
(612, 35, 'BIJAPUR', 'Active', 'N', 0),
(613, 35, 'BILASPUR', 'Active', 'N', 0),
(614, 35, 'DANTEWADA', 'Active', 'N', 0),
(615, 35, 'DHAMTARI', 'Active', 'N', 0),
(616, 35, 'DURG', 'Active', 'N', 0),
(617, 35, 'GARIYABAND', 'Active', 'N', 0),
(618, 35, 'JANJGIR-CHAMPA', 'Active', 'N', 0),
(619, 35, 'JASHPUR', 'Active', 'N', 0),
(620, 35, 'KABIRDHAM', 'Active', 'N', 0),
(621, 35, 'KANKER', 'Active', 'N', 0),
(622, 35, 'KONDAGAON', 'Active', 'N', 0),
(623, 35, 'KORBA', 'Active', 'N', 0),
(624, 35, 'KOREA', 'Active', 'N', 0),
(625, 35, 'MAHASAMUND', 'Active', 'N', 0),
(626, 35, 'MUNGELI', 'Active', 'N', 0),
(627, 35, 'NARAYANPUR', 'Active', 'N', 0),
(628, 35, 'RAIGARH', 'Active', 'N', 0),
(629, 35, 'RAIPUR', 'Active', 'N', 0),
(630, 35, 'RAJNANDGAON', 'Active', 'N', 0),
(631, 35, 'SUKMA', 'Active', 'N', 0),
(632, 35, 'SURAJPUR', 'Active', 'N', 0),
(633, 35, 'SURGUJA', 'Active', 'N', 0),
(634, 32, 'NICOBARS', 'Active', 'N', 0),
(635, 32, 'NORTH AND MIDDLE ANDAMAN', 'Active', 'N', 0),
(636, 32, 'SOUTH ANDAMANS', 'Active', 'N', 0),
(637, 33, 'ALMORA', 'Active', 'N', 0),
(638, 33, 'BAGESHWAR', 'Active', 'N', 0),
(639, 33, 'CHAMOLI', 'Active', 'N', 0),
(640, 33, 'CHAMPAWAT', 'Active', 'N', 0),
(641, 33, 'DEHRADUN', 'Active', 'N', 0),
(642, 33, 'HARIDWAR', 'Active', 'N', 0),
(643, 33, 'NAINITAL', 'Active', 'N', 0),
(644, 33, 'PAURI GARHWAL', 'Active', 'N', 0),
(645, 33, 'PITHORAGARH', 'Active', 'N', 0),
(646, 33, 'RUDRA PRAYAG', 'Active', 'N', 0),
(647, 33, 'TEHRI GARHWAL', 'Active', 'N', 0),
(648, 33, 'UDAM SINGH NAGAR', 'Active', 'N', 0),
(649, 33, 'UTTAR KASHI', 'Active', 'N', 0),
(650, 34, 'BOKARO', 'Active', 'N', 0),
(651, 34, 'CHATRA', 'Active', 'N', 0),
(652, 34, 'DEOGHAR', 'Active', 'N', 0),
(653, 34, 'DHANBAD', 'Active', 'N', 0),
(654, 34, 'DUMKA', 'Active', 'N', 0),
(655, 34, 'EAST SINGHBUM', 'Active', 'N', 0),
(656, 34, 'GARHWA', 'Active', 'N', 0),
(657, 34, 'GIRIDIH', 'Active', 'N', 0),
(658, 34, 'GODDA', 'Active', 'N', 0),
(659, 34, 'GUMLA', 'Active', 'N', 0),
(660, 34, 'HAZARIBAGH', 'Active', 'N', 0),
(661, 34, 'JAMTARA', 'Active', 'N', 0),
(662, 34, 'KHUNTI', 'Active', 'N', 0),
(663, 34, 'KODERMA', 'Active', 'N', 0),
(666, 34, 'PAKUR', 'Active', 'N', 0),
(667, 34, 'PALAMU', 'Active', 'N', 0),
(668, 34, 'RAMGARH', 'Active', 'N', 0),
(669, 34, 'RANCHI', 'Active', 'N', 0),
(670, 34, 'SAHEBGANJ', 'Active', 'N', 0),
(671, 34, 'SARAIKELA KHARSAWAN', 'Active', 'N', 0),
(672, 34, 'SIMDEGA', 'Active', 'N', 0),
(673, 34, 'WEST SINGHBHUM', 'Active', 'N', 0),
(674, 31, 'CHANDIGARH', 'Active', 'N', 0);

-- --------------------------------------------------------

--
-- Table structure for table `jobwork`
--

CREATE TABLE IF NOT EXISTS `jobwork` (
  `jobwork_id` int(11) NOT NULL AUTO_INCREMENT,
  `jobwork_code` varchar(100) NOT NULL,
  `jobwork_type_id` int(11) NOT NULL,
  `jobwork_name` varchar(100) NOT NULL,
  `jobwork_mobile` varchar(50) NOT NULL,
  `jobwork_phone` varchar(50) NOT NULL,
  `jobwork_email` varchar(100) NOT NULL,
  `jobwork_address1` text NOT NULL,
  `jobwork_address2` text NOT NULL,
  `state_id` int(11) NOT NULL,
  `district_id` int(11) NOT NULL,
  `area_id` int(11) NOT NULL,
  `jobwork_country` varchar(50) NOT NULL,
  `jobwork_pincode` varchar(50) NOT NULL,
  `jobwork_pancard` varchar(50) NOT NULL,
  `jobwork_gst` varchar(50) NOT NULL,
  `jobwork_hold` varchar(50) NOT NULL,
  `bank_name` varchar(100) NOT NULL,
  `branch_name` varchar(50) NOT NULL,
  `account_number` varchar(50) NOT NULL,
  `account_name` varchar(100) NOT NULL,
  `ifsc_code` varchar(50) NOT NULL,
  `status` enum('0','1') NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  PRIMARY KEY (`jobwork_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `jobwork`
--

INSERT INTO `jobwork` (`jobwork_id`, `jobwork_code`, `jobwork_type_id`, `jobwork_name`, `jobwork_mobile`, `jobwork_phone`, `jobwork_email`, `jobwork_address1`, `jobwork_address2`, `state_id`, `district_id`, `area_id`, `jobwork_country`, `jobwork_pincode`, `jobwork_pancard`, `jobwork_gst`, `jobwork_hold`, `bank_name`, `branch_name`, `account_number`, `account_name`, `ifsc_code`, `status`, `created_by`, `created_date`) VALUES
(1, 'JOB1000', 0, 'dfsdf', '978866151551', '978866151551', 'tamil@iorange.in', 'sdfsdf', 'sdfsdf', 2, 44, 0, 'India', '654616', 'PNACARD', 'GST', '54', 'IDBI', 'dfs', '', 'fsdf', 'fsd', '0', 1, '2019-12-05 13:11:00');

-- --------------------------------------------------------

--
-- Table structure for table `main_menu`
--

CREATE TABLE IF NOT EXISTS `main_menu` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `menu_name` varchar(100) NOT NULL,
  `menu_url` varchar(100) NOT NULL,
  `menu_files` text NOT NULL,
  `class_name` varchar(100) NOT NULL,
  `menu_order` int(11) NOT NULL,
  `status` enum('0','1') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `main_menu`
--

INSERT INTO `main_menu` (`id`, `menu_id`, `menu_name`, `menu_url`, `menu_files`, `class_name`, `menu_order`, `status`) VALUES
(1, 0, 'Dashboard', 'index.php', 'dashboard.php', 'mdi mdi-view-dashboard', 1, '0'),
(2, 0, 'Company Info', 'company_info.php', 'company_info.php', 'mdi mdi-account-circle', 2, '0'),
(3, 0, 'Master', 'javascript:;', '', 'mdi mdi-format-align-justify', 3, '0'),
(4, 0, 'Admin', 'javascript:;', '', 'mdi mdi-omega', 4, '0'),
(5, 0, 'Merch', 'javascript:;', '', 'mdi mdi-chart-arc', 5, '0'),
(6, 0, 'Yarn', 'javascript:;', '', 'mdi mdi-silverware-spoon', 6, '0'),
(7, 0, 'Fabric', 'javascript:;', '', 'mdi mdi-airballoon', 7, '0'),
(8, 0, 'Store', 'javascript:;', '', 'mdi mdi-flashlight', 8, '0'),
(9, 0, 'Production', 'javascript:;', '', 'mdi mdi-folder', 9, '0'),
(10, 0, 'General DC', 'javascript:;', '', 'mdi mdi-checkbox-multiple-blank-outline', 10, '0'),
(11, 0, 'Accounts', 'javascript:;', '', 'mdi mdi-account', 11, '0'),
(12, 0, 'Stock', 'javascript:;', '', 'mdi mdi-nature', 12, '0'),
(13, 0, 'Buyer', 'javascript:;', '', 'mdi mdi-account-box', 13, '0'),
(14, 0, 'HR', 'javascript:;', '', 'mdi mdi-account-outline', 14, '0'),
(15, 0, 'Report', 'javascript:;', '', 'mdi mdi-format-list-numbers', 15, '0');

-- --------------------------------------------------------

--
-- Table structure for table `menu_rights`
--

CREATE TABLE IF NOT EXISTS `menu_rights` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_type_id` int(11) NOT NULL,
  `main_menu` int(11) NOT NULL,
  `sub_menu` int(11) NOT NULL,
  `add_option` int(11) NOT NULL,
  `edit_option` int(11) NOT NULL,
  `del_option` int(11) NOT NULL,
  `view_option` int(11) NOT NULL,
  `print_option` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=546 ;

--
-- Dumping data for table `menu_rights`
--

INSERT INTO `menu_rights` (`id`, `user_type_id`, `main_menu`, `sub_menu`, `add_option`, `edit_option`, `del_option`, `view_option`, `print_option`) VALUES
(545, 1, 15, 0, 1, 1, 1, 1, 1),
(544, 1, 14, 55, 1, 1, 1, 1, 1),
(543, 1, 14, 54, 1, 1, 1, 1, 1),
(542, 1, 14, 53, 1, 1, 1, 1, 1),
(541, 1, 14, 52, 1, 1, 1, 1, 1),
(540, 1, 14, 0, 1, 1, 1, 1, 1),
(539, 1, 13, 51, 1, 1, 1, 1, 1),
(538, 1, 13, 0, 1, 1, 1, 1, 1),
(537, 1, 12, 50, 1, 1, 1, 1, 1),
(536, 1, 12, 49, 1, 1, 1, 1, 1),
(535, 1, 12, 48, 1, 1, 1, 1, 1),
(534, 1, 12, 0, 1, 1, 1, 1, 1),
(533, 1, 11, 47, 1, 1, 1, 1, 1),
(532, 1, 11, 46, 1, 1, 1, 1, 1),
(531, 1, 11, 45, 1, 1, 1, 1, 1),
(530, 1, 11, 44, 1, 1, 1, 1, 1),
(529, 1, 11, 43, 1, 1, 1, 1, 1),
(528, 1, 11, 42, 1, 1, 1, 1, 1),
(527, 1, 11, 41, 1, 1, 1, 1, 1),
(526, 1, 11, 40, 1, 1, 1, 1, 1),
(525, 1, 11, 39, 1, 1, 1, 1, 1),
(524, 1, 11, 38, 1, 1, 1, 1, 1),
(523, 1, 11, 37, 1, 1, 1, 1, 1),
(522, 1, 11, 36, 1, 1, 1, 1, 1),
(521, 1, 11, 0, 1, 1, 1, 1, 1),
(520, 1, 10, 35, 1, 1, 1, 1, 1),
(519, 1, 10, 34, 1, 1, 1, 1, 1),
(518, 1, 10, 33, 1, 1, 1, 1, 1),
(517, 1, 10, 0, 1, 1, 1, 1, 1),
(516, 1, 9, 32, 1, 1, 1, 1, 1),
(515, 1, 9, 31, 1, 1, 1, 1, 1),
(514, 1, 9, 30, 1, 1, 1, 1, 1),
(513, 1, 9, 0, 1, 1, 1, 1, 1),
(512, 1, 8, 29, 1, 1, 1, 1, 1),
(511, 1, 8, 28, 1, 1, 1, 1, 1),
(510, 1, 8, 27, 1, 1, 1, 1, 1),
(509, 1, 8, 0, 1, 1, 1, 1, 1),
(508, 1, 7, 26, 1, 1, 1, 1, 1),
(507, 1, 7, 25, 1, 1, 1, 1, 1),
(506, 1, 7, 24, 1, 1, 1, 1, 1),
(505, 1, 7, 23, 1, 1, 1, 1, 1),
(504, 1, 7, 22, 1, 1, 1, 1, 1),
(503, 1, 7, 21, 1, 1, 1, 1, 1),
(502, 1, 7, 20, 1, 1, 1, 1, 1),
(501, 1, 7, 0, 1, 1, 1, 1, 1),
(500, 1, 6, 19, 1, 1, 1, 1, 1),
(499, 1, 6, 18, 1, 1, 1, 1, 1),
(498, 1, 6, 17, 1, 1, 1, 1, 1),
(497, 1, 6, 16, 1, 1, 1, 1, 1),
(496, 1, 6, 15, 1, 1, 1, 1, 1),
(495, 1, 6, 14, 1, 1, 1, 1, 1),
(494, 1, 6, 0, 1, 1, 1, 1, 1),
(493, 1, 5, 13, 1, 1, 1, 1, 1),
(492, 1, 5, 12, 1, 1, 1, 1, 1),
(491, 1, 5, 11, 1, 1, 1, 1, 1),
(490, 1, 5, 10, 1, 1, 1, 1, 1),
(489, 1, 5, 9, 1, 1, 1, 1, 1),
(488, 1, 5, 8, 1, 1, 1, 1, 1),
(487, 1, 5, 0, 1, 1, 1, 1, 1),
(486, 1, 4, 7, 1, 1, 1, 1, 1),
(485, 1, 4, 6, 1, 1, 1, 1, 1),
(484, 1, 4, 0, 1, 1, 1, 1, 1),
(483, 1, 3, 5, 1, 1, 1, 1, 1),
(482, 1, 3, 4, 1, 1, 1, 1, 1),
(481, 1, 3, 3, 1, 1, 1, 1, 1),
(480, 1, 3, 2, 1, 1, 1, 1, 1),
(479, 1, 3, 1, 1, 1, 1, 1, 1),
(478, 1, 3, 0, 1, 1, 1, 1, 1),
(477, 1, 2, 0, 1, 1, 1, 1, 1),
(476, 1, 1, 0, 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `process_master`
--

CREATE TABLE IF NOT EXISTS `process_master` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `process_name` varchar(100) NOT NULL,
  `descr` text NOT NULL,
  `status` enum('0','1') NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE IF NOT EXISTS `states` (
  `state_id` int(11) NOT NULL,
  `state_name` varchar(100) NOT NULL,
  `status` varchar(10) NOT NULL,
  `deleted` varchar(10) NOT NULL,
  `created_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`state_id`, `state_name`, `status`, `deleted`, `created_by`) VALUES
(1, 'ANDHRA PRADESH', 'Active', 'N', 0),
(2, 'ASSAM', 'Active', '', 0),
(3, 'ARUNACHAL PRADESH', 'Active', '', 0),
(4, 'BIHAR', 'Active', '', 0),
(5, 'GUJRAT', 'Active', '', 0),
(6, 'HARYANA', 'Active', '', 0),
(7, 'HIMACHAL PRADESH', 'Active', '', 0),
(8, 'JAMMU & KASHMIR', 'Active', '', 0),
(9, 'KARNATAKA', 'Active', '', 0),
(10, 'KERALA', 'Active', '', 0),
(11, 'MADHYA PRADESH', 'Active', '', 0),
(12, 'MAHARASHTRA', 'Active', '', 0),
(13, 'MANIPUR', 'Active', '', 0),
(14, 'MEGHALAYA', 'Active', '', 0),
(15, 'MIZORAM', 'Active', '', 0),
(16, 'NAGALAND', 'Active', '', 0),
(17, 'ORISSA', 'Active', '', 0),
(18, 'PUNJAB', 'Active', '', 0),
(19, 'RAJASTHAN', 'Active', '', 0),
(20, 'SIKKIM', 'Active', '', 0),
(21, 'TAMIL NADU', 'Active', '', 0),
(22, 'TRIPURA', 'Active', '', 0),
(23, 'UTTAR PRADESH', 'Active', '', 0),
(24, 'WEST BENGAL', 'Active', '', 0),
(25, 'DELHI', 'Active', '', 0),
(26, 'GOA', 'Active', '', 0),
(27, 'PONDICHERY', 'Active', '', 0),
(28, 'LAKSHDWEEP', 'Active', '', 0),
(29, 'DAMAN & DIU', 'Active', '', 0),
(30, 'DADRA & NAGAR', 'Active', '', 0),
(31, 'CHANDIGARH', 'Active', '', 0),
(32, 'ANDAMAN & NICOBAR', 'Active', '', 0),
(33, 'UTTARANCHAL', 'Active', '', 0),
(34, 'JHARKHAND', 'Active', '', 0),
(35, 'CHATTISGARH', 'Active', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `sub_menu1`
--

CREATE TABLE IF NOT EXISTS `sub_menu1` (
  `sub_id` int(11) NOT NULL AUTO_INCREMENT,
  `main_id` int(11) NOT NULL,
  `sub_menu` varchar(100) NOT NULL,
  `sub_url` varchar(100) NOT NULL,
  `sub_files` text NOT NULL,
  `menu_order` int(11) NOT NULL,
  `status` enum('0','1') NOT NULL,
  PRIMARY KEY (`sub_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=56 ;

--
-- Dumping data for table `sub_menu1`
--

INSERT INTO `sub_menu1` (`sub_id`, `main_id`, `sub_menu`, `sub_url`, `sub_files`, `menu_order`, `status`) VALUES
(1, 3, 'Admin Master', 'admin_master.php', '', 1, '0'),
(2, 3, 'Product Master', 'product_master.php', 'product_master.php', 2, '0'),
(3, 3, 'Accessories Master', 'accessories_master.php', '', 3, '0'),
(4, 3, 'Accounts Master', 'accounts_master.php', '', 4, '0'),
(5, 3, 'Transport Master', 'transport_master.php', '', 5, '0'),
(6, 4, 'Approvals', 'javascript:void(0);', '', 1, '0'),
(7, 4, 'Task Manager', 'task_manager.php', '', 2, '0'),
(8, 5, 'Costing Module', 'javascript:void(0);', '', 1, '0'),
(9, 5, 'Sample Module', 'javascript:void(0);', '', 2, '0'),
(10, 5, 'Order Module', 'javascript:void(0);', '', 3, '0'),
(11, 5, 'Knitting Planning', 'knitting_planning.php', '', 4, '0'),
(12, 5, 'Dyeing Planning', 'dyeing_planning.php', '', 5, '0'),
(13, 5, 'Process Planning', 'process_planning.php', '', 6, '0'),
(14, 6, 'Yarn Inward', 'yarn_inward.php', '', 1, '0'),
(15, 6, 'Process DC Out', 'process_dc_out.php', '', 2, '0'),
(16, 6, 'Process DC In', 'process_dc_in.php', '', 3, '0'),
(17, 6, 'DC Out Return', 'dc_out_return.php', '', 4, '0'),
(18, 6, 'Process to Production', 'process_to_production.php', '', 5, '0'),
(19, 6, 'Duplicate DC Print', 'duplicate_dc_print.php', '', 6, '0'),
(20, 7, 'Fabric Inward', 'fabric_inward.php', '', 1, '0'),
(21, 7, 'Process DC Out', 'fabric_process_dc_out.php', '', 2, '0'),
(22, 7, 'Process DC In', 'fabric_process_dc_in.php', '', 3, '0'),
(23, 7, 'DC Out Return', 'fabric_dc_out_return.php', '', 4, '0'),
(24, 7, 'Cutting DC', 'cutting_dc.php', '', 5, '0'),
(25, 7, 'Duplicate DC Print', 'fabric_duplicate_dc_print.php', '', 6, '0'),
(26, 7, 'Fabric Style Transfer', 'fabric_style_transfer.php', '', 7, '0'),
(27, 8, 'Accessories Inward', 'accessories_inward.php', '', 1, '0'),
(28, 8, 'Store DC', 'store_dc.php', '', 2, ''),
(29, 8, 'Store Style Transfer', 'store_style_transfer.php', '', 3, '0'),
(30, 9, 'Work Assign', 'javascript:void(0);', '', 1, '0'),
(31, 9, 'Work Done', 'javascript:void(0);', '', 2, '0'),
(32, 9, 'Ship Out', 'ship_out.php', '', 3, '0'),
(33, 10, 'General DC', 'general_dc.php', '', 1, '0'),
(34, 10, 'Return DC', 'return_dc.php', '', 2, '0'),
(35, 10, 'Duplicate DC', 'duplicate_dc.php', '', 3, '0'),
(36, 11, 'Payment Entry', 'payment_entry.php', '', 1, '0'),
(37, 11, 'Contra Voucher', 'contra_voucher.php', '', 2, '0'),
(38, 11, 'Credit Note', 'credit_note.php', '', 3, '0'),
(39, 11, 'Debit Note', 'debit_note.php', '', 4, '0'),
(40, 11, 'Party Outstanding', 'party_outstanding.php', '', 5, '0'),
(41, 11, 'Cash Summary', 'cash_summary.php', '', 6, '0'),
(42, 11, 'Cash Book', 'cash_book.php', '', 7, '0'),
(43, 11, 'Bank Book', 'bank_book.php', '', 8, '0'),
(44, 11, 'Day Book', 'day_book.php', '', 9, '0'),
(45, 11, 'Profit/Loss Account', 'profit_loss.php', '', 10, '0'),
(46, 11, 'Trial Balance', 'trial_balance.php', '', 11, '0'),
(47, 11, 'Balance Sheet', 'balance_sheet.php', '', 12, '0'),
(48, 12, 'Godown', 'godown.php', '', 1, '0'),
(49, 12, 'Order Stock', 'order_stock.php', '', 2, '0'),
(50, 12, 'Virtual Stock', 'virtual_stock.php', '', 3, '0'),
(51, 13, 'Order Status', 'order_status.php', '', 0, '0'),
(52, 14, 'Staff', 'javascript:void(0);', '', 1, '0'),
(53, 14, 'Employee', 'javascript:void(0);', '', 2, '0'),
(54, 14, 'Contractor', 'javascript:void(0);', '', 3, '0'),
(55, 14, 'Job work', 'javascript:void(0);', '', 4, '0');

-- --------------------------------------------------------

--
-- Table structure for table `sub_menu2`
--

CREATE TABLE IF NOT EXISTS `sub_menu2` (
  `sub2_id` int(11) NOT NULL AUTO_INCREMENT,
  `main_id` int(11) NOT NULL,
  `sub_id` int(11) NOT NULL,
  `sub2_menu` varchar(100) NOT NULL,
  `sub2_url` varchar(100) NOT NULL,
  `sub2_files` text NOT NULL,
  `status` enum('0','1') NOT NULL,
  PRIMARY KEY (`sub2_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `sub_menu2`
--

INSERT INTO `sub_menu2` (`sub2_id`, `main_id`, `sub_id`, `sub2_menu`, `sub2_url`, `sub2_files`, `status`) VALUES
(1, 4, 6, 'Contractor Approvals', 'contractor_approval.php', '', '0'),
(2, 4, 6, 'Costing Approvals', 'costing_approvals.php', '', '0'),
(3, 4, 6, 'Yarn PO''s Approvals', 'yarn_approval.php', '', '0'),
(4, 4, 6, 'Fabric PO''s Approvals', 'fabric_po_approval.php', '', '0'),
(5, 4, 6, 'Store Approvals', 'store_approvals.php', '', '0'),
(6, 4, 6, 'Cutting Approvals', 'cutting_approvals.php', '', '0'),
(7, 5, 8, 'Costing Entry', 'javascript:void(0)', '', '0'),
(8, 5, 8, 'Costing List', 'costing_list.php', '', '0'),
(9, 5, 9, 'Sample Section', 'sample_section.php', '', '0'),
(10, 5, 10, 'Order Entry', 'order_entry.php', '', '0'),
(11, 9, 30, 'Work Assign DC', 'work_assign_dc.php', '', '0'),
(12, 9, 30, 'Work Assign Return DC', 'work_assign_return_dc.php', '', '0'),
(13, 9, 30, 'Duplicate DC Print', 'pr_duplicate_dc_print.php', '', '0'),
(14, 9, 31, 'Work Done DC', 'work_done_dc.php', '', '0'),
(15, 9, 31, 'Work Done Return DC', 'work_done_return_dc.php', '', '0'),
(16, 9, 31, 'Duplicate DC Print', 'wd_duplicate_dc_print.php', '', '0'),
(17, 14, 52, 'Staff Salary', 'staff_salary.php', '', '0'),
(18, 14, 52, 'Staff Attendance', 'staff_attendance.php', '', '0'),
(19, 14, 53, 'Employee Salary', 'emp_salary.php', '', '0'),
(20, 14, 53, 'Employee Attendance', 'emp_attendance.php', '', '0'),
(21, 14, 54, 'Contractor Salary', 'contractor_salary.php', '', '0'),
(22, 14, 54, 'Contractor Advance', 'contractor_advance.php', '', '0'),
(23, 14, 55, 'Job Work Salary', 'job_work_salary.php', '', '0'),
(24, 14, 55, 'Job Work Advance', 'job_work_advance.php', '', '0');

-- --------------------------------------------------------

--
-- Table structure for table `sub_menu3`
--

CREATE TABLE IF NOT EXISTS `sub_menu3` (
  `sub3_id` int(11) NOT NULL AUTO_INCREMENT,
  `main_id` int(11) NOT NULL,
  `sub1_id` int(11) NOT NULL,
  `sub2_id` int(11) NOT NULL,
  `sub3_name` varchar(100) NOT NULL,
  `sub3_url` varchar(100) NOT NULL,
  `sub3_files` text NOT NULL,
  `status` enum('0','1') NOT NULL,
  PRIMARY KEY (`sub3_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `sub_menu3`
--

INSERT INTO `sub_menu3` (`sub3_id`, `main_id`, `sub1_id`, `sub2_id`, `sub3_name`, `sub3_url`, `sub3_files`, `status`) VALUES
(1, 5, 8, 7, 'Costing Entry', 'costing_entry.php', '', '0'),
(2, 5, 8, 7, 'Knitting Process Costing', 'knitting_process_costing.php', '', '0'),
(3, 5, 8, 7, 'Dyeing Entry Costing', 'dyeing_process_costing.php', '', '0'),
(4, 5, 8, 7, 'Other Process Costing', 'other_process_costing.php', '', '0'),
(5, 5, 8, 7, 'Accessories Costing', 'accessories_process_costing.php', '', '0'),
(6, 5, 8, 7, 'Department Costing', 'department_process_costing.php', '', '0'),
(7, 5, 8, 7, 'Fabric Costing', 'fabric_costing.php', '', '0'),
(8, 5, 8, 7, 'Expense Costing', 'expense_costing.php', '', '0');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE IF NOT EXISTS `suppliers` (
  `supplier_id` int(11) NOT NULL AUTO_INCREMENT,
  `supplier_code` varchar(100) NOT NULL,
  `supplier_type_id` int(11) NOT NULL,
  `supplier_name` varchar(100) NOT NULL,
  `supplier_mobile` varchar(50) NOT NULL,
  `supplier_phone` varchar(50) NOT NULL,
  `supplier_email` varchar(100) NOT NULL,
  `supplier_address1` text NOT NULL,
  `supplier_address2` text NOT NULL,
  `state_id` int(11) NOT NULL,
  `district_id` int(11) NOT NULL,
  `area_id` int(11) NOT NULL,
  `suplier_country` varchar(50) NOT NULL,
  `supplier_pincode` varchar(50) NOT NULL,
  `supplier_pancard` varchar(50) NOT NULL,
  `supplier_gst` varchar(50) NOT NULL,
  `bank_name` varchar(100) NOT NULL,
  `branch_name` varchar(50) NOT NULL,
  `account_number` varchar(50) NOT NULL,
  `account_name` varchar(100) NOT NULL,
  `ifsc_code` varchar(50) NOT NULL,
  `status` enum('0','1') NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  PRIMARY KEY (`supplier_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`supplier_id`, `supplier_code`, `supplier_type_id`, `supplier_name`, `supplier_mobile`, `supplier_phone`, `supplier_email`, `supplier_address1`, `supplier_address2`, `state_id`, `district_id`, `area_id`, `suplier_country`, `supplier_pincode`, `supplier_pancard`, `supplier_gst`, `bank_name`, `branch_name`, `account_number`, `account_name`, `ifsc_code`, `status`, `created_by`, `created_date`) VALUES
(1, 'io1000', 11, 'Sutrn', '9976552368', '04824621212', 'tamil@iorange.in', 'text addr1', 'text addr2', 1, 2, 4, 'India', '641687', 'AVG4578', 'GST11565', 'IDBI', 'SPalayam', '001654660662306263', 'Tamil', 'IDBI4454434', '0', 1, '2019-11-29 13:15:29');

-- --------------------------------------------------------

--
-- Table structure for table `supplier_types`
--

CREATE TABLE IF NOT EXISTS `supplier_types` (
  `supplier_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `supplier_type` varchar(100) NOT NULL,
  `type_description` text NOT NULL,
  `status` enum('0','1') NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  PRIMARY KEY (`supplier_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `supplier_types`
--

INSERT INTO `supplier_types` (`supplier_type_id`, `supplier_type`, `type_description`, `status`, `created_by`, `created_date`) VALUES
(11, 'Cotton suppliers', 'cotton supliers', '0', 1, '2019-11-29 11:34:05'),
(12, 'Yarn suppliers', 'fsdfsd', '0', 1, '2019-11-29 11:34:17'),
(13, 'Accessories suppliers', 'dsfs', '0', 1, '2019-11-29 11:34:29');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `USERID` int(7) NOT NULL AUTO_INCREMENT,
  `UNAME` varchar(60) NOT NULL,
  `USRNAME` varchar(255) NOT NULL,
  `USRPWD` varchar(255) NOT NULL,
  `EMAIL` varchar(60) NOT NULL,
  `MOBNO` varchar(15) NOT NULL,
  `TYPEID` int(7) NOT NULL,
  `team_id` int(11) NOT NULL,
  `STATUS` varchar(10) NOT NULL,
  `ADDRS` varchar(255) NOT NULL,
  `last_login` datetime NOT NULL,
  `last_logout` datetime NOT NULL,
  `DOJOIN` date NOT NULL,
  `DOBIRTH` date NOT NULL,
  `BLDGRP` varchar(50) NOT NULL,
  `ENUM` varchar(20) NOT NULL,
  `relation` varchar(100) NOT NULL,
  `ADDDATE` datetime NOT NULL,
  `ADDUSER` int(7) NOT NULL,
  `EDTDATE` datetime DEFAULT NULL,
  `EDTUSER` int(7) DEFAULT NULL,
  `DELETED` char(1) NOT NULL,
  `DELUSER` int(7) DEFAULT NULL,
  `DELDATE` datetime DEFAULT NULL,
  PRIMARY KEY (`USERID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`USERID`, `UNAME`, `USRNAME`, `USRPWD`, `EMAIL`, `MOBNO`, `TYPEID`, `team_id`, `STATUS`, `ADDRS`, `last_login`, `last_logout`, `DOJOIN`, `DOBIRTH`, `BLDGRP`, `ENUM`, `relation`, `ADDDATE`, `ADDUSER`, `EDTDATE`, `EDTUSER`, `DELETED`, `DELUSER`, `DELDATE`) VALUES
(1, 'IORANGE ADMIN', 'admin', 'admin@123', 'tamil@iorange.in', '95447545213', 1, 1, 'Active', 'Tirupppur', '2019-07-24 02:48:16', '2019-10-14 01:01:44', '1970-01-01', '2018-01-08', '', '', '', '2018-08-04 01:50:22', 1, '2019-09-06 05:35:01', 1, 'N', 0, '0000-00-00 00:00:00'),
(2, 'Sujith', 'sujith', 'sujith123', 'sujith@iorange.in', '876465564666', 10, 0, 'Active', 'dsfsdfdfds', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1970-01-01', '1970-01-01', 'A+', '6694949', 'Appa', '0000-00-00 00:00:00', 1, NULL, NULL, 'N', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users_type`
--

CREATE TABLE IF NOT EXISTS `users_type` (
  `TYPEID` int(7) NOT NULL,
  `TYPNAME` varchar(60) NOT NULL,
  `DESCRTION` varchar(255) NOT NULL,
  `STATUS` varchar(10) NOT NULL,
  `ADDDATE` datetime NOT NULL,
  `ADDUSER` int(7) NOT NULL,
  `EDTDATE` datetime DEFAULT NULL,
  `EDTUSER` int(7) DEFAULT NULL,
  `DELETED` char(1) NOT NULL,
  `DELUSER` int(7) DEFAULT NULL,
  `DELDATE` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_type`
--

INSERT INTO `users_type` (`TYPEID`, `TYPNAME`, `DESCRTION`, `STATUS`, `ADDDATE`, `ADDUSER`, `EDTDATE`, `EDTUSER`, `DELETED`, `DELUSER`, `DELDATE`) VALUES
(1, 'Super Administrator', 'Super Admin', 'Active', '0000-00-00 00:00:00', 0, '2019-08-13 06:03:01', 1, 'N', NULL, NULL),
(2, 'Cash', 'Cash Department', 'Active', '0000-00-00 00:00:00', 0, '2019-08-13 06:02:51', 1, 'N', NULL, NULL),
(3, 'GM', 'General Manager', 'Active', '0000-00-00 00:00:00', 0, '2019-08-13 06:02:38', 1, 'N', NULL, NULL),
(4, 'FM', 'Factory Manager', 'Active', '0000-00-00 00:00:00', 0, '2019-08-13 06:02:25', 1, 'N', NULL, NULL),
(5, 'Telecalling', 'Telecall Department', 'Active', '0000-00-00 00:00:00', 0, '2019-08-13 06:02:12', 1, 'N', NULL, NULL),
(6, 'Forward', 'Forward Team', 'Active', '0000-00-00 00:00:00', 0, '2019-08-13 06:01:41', 1, 'N', NULL, NULL),
(7, 'Marketing', 'Marketing Department', 'Active', '0000-00-00 00:00:00', 0, '2019-08-13 06:01:30', 1, 'N', NULL, NULL),
(8, 'Training', 'Trainees', 'Active', '0000-00-00 00:00:00', 0, '2019-08-13 06:01:14', 1, 'N', NULL, NULL),
(9, 'Accounts', 'Accounts Department', 'Active', '2019-08-13 05:58:44', 1, '2019-08-13 06:01:06', 1, 'N', NULL, NULL),
(10, 'Administrator', 'Admins', 'Active', '2019-08-13 05:58:58', 1, '2019-08-13 06:00:55', 1, 'N', NULL, NULL),
(11, 'Transport', 'Transport Incharge', 'Active', '2019-08-14 04:22:27', 1, '0000-00-00 00:00:00', 1, 'N', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_department`
--

CREATE TABLE IF NOT EXISTS `user_department` (
  `dept_id` int(11) NOT NULL AUTO_INCREMENT,
  `dept_name` varchar(100) NOT NULL,
  `dept_desc` text NOT NULL,
  `status` enum('0','1') NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  PRIMARY KEY (`dept_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `user_department`
--

INSERT INTO `user_department` (`dept_id`, `dept_name`, `dept_desc`, `status`, `created_by`, `created_date`) VALUES
(1, 'Merch', 'dsfsd', '0', 1, '2019-11-29 15:08:20'),
(2, 'Fabric', 'fsdfs', '0', 1, '2019-11-29 15:08:28'),
(3, 'Yarn', 'dsfsdfs', '0', 1, '2019-11-29 15:08:35');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
