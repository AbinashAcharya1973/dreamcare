-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 07, 2023 at 11:13 AM
-- Server version: 8.0.34
-- PHP Version: 8.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dreamcar_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE IF NOT EXISTS `members` (
  `memid` int NOT NULL AUTO_INCREMENT,
  `mname` varchar(100) DEFAULT NULL,
  `address` varchar(150) DEFAULT NULL,
  `city_village` varchar(100) DEFAULT NULL,
  `pin` varchar(10) DEFAULT NULL,
  `statecode` int DEFAULT NULL,
  `emailid` varchar(200) DEFAULT NULL,
  `mobileno` varchar(10) DEFAULT NULL,
  `bankac` varchar(20) DEFAULT NULL,
  `ifsc` varchar(20) DEFAULT NULL,
  `aadhar` varchar(20) DEFAULT NULL,
  `product` varchar(20) DEFAULT NULL,
  `joingindate` datetime DEFAULT NULL,
  `totalamount` double DEFAULT '1050',
  `paid` varchar(1) DEFAULT NULL,
  `txid` varchar(100) DEFAULT NULL,
  `mactive` varchar(1) DEFAULT NULL,
  `sponsorid` int DEFAULT NULL,
  `membercode` varchar(15) DEFAULT NULL,
  `totalreferral` int DEFAULT NULL,
  `currentlevel` int DEFAULT NULL,
  `affiliatelink` varchar(100) DEFAULT NULL,
  `atlevel` int DEFAULT NULL,
  `pwd` varchar(10) DEFAULT 'pass@123',
  PRIMARY KEY (`memid`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`memid`, `mname`, `address`, `city_village`, `pin`, `statecode`, `emailid`, `mobileno`, `bankac`, `ifsc`, `aadhar`, `product`, `joingindate`, `totalamount`, `paid`, `txid`, `mactive`, `sponsorid`, `membercode`, `totalreferral`, `currentlevel`, `affiliatelink`, `atlevel`, `pwd`) VALUES
(1, 'Gobinda Chandra Nayak', 'Birakishorepur', 'Athgarh', '754029', 21, '', '7978117239', '', '', '', 'Zorich', '2023-08-26 15:12:54', 1000, 'Y', 'Cash', 'Y', 0, '1-1-2023', 0, 0, 'http://dreamcaresolution.in/refjoin.php?ref=1', NULL, 'pass@123'),
(2, 'Niranjan swain', 'Regedapara', 'Khuntakata', '754029', 21, '', '6370509393', '', '', '', 'Zorum', '2023-08-27 07:16:19', 0, 'Y', 'Cash', 'Y', 1, '1-2-2023', 9, 0, 'http://dreamcaresolution.in/refjoin.php?ref=2', NULL, 'pass@123'),
(3, 'Laxmidhar rout', 'Ankula', 'Sankarpur', '754029', 21, '', '9853188230', '', '', '', '4 LED BULBS', '2023-08-27 07:28:44', 1000, 'Y', 'Cash', 'Y', 2, '2-3-2023', 2, 0, 'http://dreamcaresolution.in/refjoin.php?ref=3', NULL, 'pass@123'),
(4, 'Sukanta pradhan', 'Ankula', 'Sankarpur', '754029', 21, '', '9853188230', '', '', '', 'Zorich', '2023-08-27 07:31:11', 1000, 'Y', 'Cash', 'Y', 3, '3-4-2023', 0, 0, 'http://dreamcaresolution.in/refjoin.php?ref=4', NULL, 'pass@123'),
(5, 'Suresh kumar biswal', 'Ankula', 'Sankarpur', '754029', 21, '', '7077639426', '', '', '', '4 LED BULBS', '2023-08-27 07:34:06', 1000, 'Y', 'Cash', 'Y', 3, '3-5-2023', 0, 0, 'http://dreamcaresolution.in/refjoin.php?ref=5', NULL, 'pass@123'),
(6, 'Dharanidhar sethy', 'Radhanathpur ', 'Sasan', '754029', 21, '', '9337723662', '', '', '', 'Zorum', '2023-08-27 08:26:07', 1000, 'Y', 'Cash', 'Y', 1, '1-6-2023', 31, 0, 'http://dreamcaresolution.in/refjoin.php?ref=6', NULL, 'pass@123'),
(7, 'Dharanidhar Sethy', 'Radhanathpur sasan', 'Athgarh', '754029', 21, '', '0933772366', '', '', '', 'Zorich', '2023-08-27 08:34:00', 1000, 'Y', 'Cash', 'Y', 6, '6-7-2023', 0, 0, 'http://dreamcaresolution.in/refjoin.php?ref=7', NULL, 'pass@123'),
(8, 'Dharanidhar Sethy2', 'Radhanathpur sasan', 'Athgarh', '754029', 21, '', '0933772366', '', '', '', 'Zorich', '2023-08-27 08:37:24', 1000, 'Y', 'Cash', 'Y', 6, '6-8-2023', 0, 0, 'http://dreamcaresolution.in/refjoin.php?ref=8', NULL, 'pass@123'),
(9, 'Dharanidhar Sethy8', 'Radhanathpur sasan', 'Athgarh', '754029', 21, '', '0933772366', '', '', '', 'Zorich', '2023-08-27 08:39:25', 1000, 'Y', 'Cash', 'Y', 6, '6-9-2023', 0, 0, 'http://dreamcaresolution.in/refjoin.php?ref=9', NULL, 'pass@123'),
(10, 'Arun ku patra', 'Rasaradikpur', 'Athgarh', '754029', 21, '', '7205704043', '0553000400006687', 'Punb0055300', '', 'Zorich', '2023-08-27 10:21:34', 1000, 'Y', 'Cash', 'Y', 1, '1-10-2023', 4, 0, 'http://dreamcaresolution.in/refjoin.php?ref=10', NULL, 'pass@123'),
(11, 'Jitendra kumar Nayak ', 'Gopamathura', 'Baramba', '754029', 21, '', '9692691002', '', '', '', 'Zorich', '2023-08-27 11:01:50', 1000, 'Y', 'Cash', 'Y', 10, '10-11-2023', 1, 0, 'http://dreamcaresolution.in/refjoin.php?ref=11', NULL, 'pass@123'),
(12, 'Pushpanjali Nayak', 'Gopamathura', 'Baramba', '754029', 21, '', '9692691002', '', '', '', 'Zorum', '2023-08-27 11:24:54', 1000, 'Y', 'Cash', 'Y', 11, '11-12-2023', 0, 0, 'http://dreamcaresolution.in/refjoin.php?ref=12', NULL, 'pass@123'),
(13, 'Arun ku patra1', 'Rasaradikpur', 'Athgarh', '754029', 21, '', '0720570404', '', '', '', 'Zorich', '2023-08-27 11:54:12', 1000, 'Y', 'Cash', 'Y', 10, '10-13-2023', 0, 0, 'http://dreamcaresolution.in/refjoin.php?ref=13', NULL, 'pass@123'),
(14, 'Arun ku patra2', 'Rasaradikpur', 'Athgarh', '754029', 21, '', '0720570404', '', '', '', 'Zorich', '2023-08-27 11:59:07', 1000, 'Y', 'Cash', 'Y', 10, '10-14-2023', 0, 0, 'http://dreamcaresolution.in/refjoin.php?ref=14', NULL, 'pass@123'),
(15, 'Prasanna Kumar Mishra', 'Radhanathpur sasan', 'Athgarh', '754029', 21, '', '9337126009', '', '', '', 'Zorum', '2023-08-27 16:07:33', 1000, 'Y', 'Cash', 'Y', 1, '1-15-2023', 6, 0, 'http://dreamcaresolution.in/refjoin.php?ref=15', NULL, 'pass@123'),
(16, 'Anita Nayak', 'Hemamalapur', 'Athgarh', '754029', 21, '', '9937436761', '', '', '', 'Zorich', '2023-08-27 16:10:00', 1000, 'Y', 'Cash', 'Y', 15, '15-16-2023', 2, 0, 'http://dreamcaresolution.in/refjoin.php?ref=16', NULL, 'pass@123'),
(17, 'Anita Nayak1', 'Hemamalapur', 'Athgarh', '754029', 21, '', '9937436761', '', '', '', 'Zorich', '2023-08-27 16:12:03', 1000, 'Y', 'Cash', 'Y', 16, '16-17-2023', 0, 0, 'http://dreamcaresolution.in/refjoin.php?ref=17', NULL, 'pass@123'),
(18, 'Sibaprasad jena', 'Rajanagar', 'Athgarh', '754029', 21, '', '9777456890', '20288236143', 'Sbin0017947', '', 'Zorum', '2023-08-28 04:20:32', 1000, 'Y', 'Cash', 'Y', 1, '1-18-2023', 0, 0, 'http://dreamcaresolution.in/refjoin.php?ref=18', NULL, 'pass@123'),
(19, 'Mamata Das', 'Upparsahi', 'Athgarh', '754029', 21, '', '9348743301', '', '', '', 'Zorich', '2023-08-28 04:22:20', 1000, 'Y', 'Cash', 'Y', 1, '1-19-2023', 1, 0, 'http://dreamcaresolution.in/refjoin.php?ref=19', NULL, 'pass@123'),
(20, 'Gangadhar swain', 'Banki', 'Cuttack ', '754029', 21, '', '8847845738', '9583907517', 'Cnrb0004128', '', 'Zorum', '2023-08-28 04:24:51', 1000, 'Y', 'Cash', 'Y', 1, '1-20-2023', 1, 0, 'http://dreamcaresolution.in/refjoin.php?ref=20', NULL, 'pass@123'),
(21, 'Madhu smita mohamansingh', 'Achalkota', 'Dhenkanal', '754029', 21, '', '6370738682', '', '', '', 'Zorich', '2023-08-28 04:27:15', 1000, 'Y', 'Cash', 'Y', 16, '16-21-2023', 1, 0, 'http://dreamcaresolution.in/refjoin.php?ref=21', NULL, 'pass@123'),
(22, 'Monalisa mohanty', 'Banikanthanagar', 'Athgarh ', '754029', 21, '', '6371331936', '', '', '', 'Zorich', '2023-08-28 04:28:47', 1000, 'Y', 'Cash', 'Y', 1, '1-22-2023', 4, 0, 'http://dreamcaresolution.in/refjoin.php?ref=22', NULL, 'pass@123'),
(23, 'Rashmi Nayak', 'Banikanthanagar', 'Athgarh ', '754029', 21, '', '8093775701', '', '', '', 'Zorich', '2023-08-28 04:30:22', 1000, 'Y', 'Cash', 'Y', 1, '1-23-2023', 0, 0, 'http://dreamcaresolution.in/refjoin.php?ref=23', NULL, 'pass@123'),
(24, 'Manorama dei', 'Banikanthanagar', 'Athgarh ', '754029', 21, '', '9438582132', '', '', '', 'Zorum', '2023-08-28 04:32:37', 1000, 'Y', 'Cash', 'Y', 1, '1-24-2023', 0, 0, 'http://dreamcaresolution.in/refjoin.php?ref=24', NULL, 'pass@123'),
(25, 'Ramkrishna bagdia', 'Malgodwon', 'Cuttack', '754029', 21, '', '9937195191', '', '', '', 'Zorich', '2023-08-28 04:34:24', 1000, 'Y', 'Cash', 'Y', 1, '1-25-2023', 0, 0, 'http://dreamcaresolution.in/refjoin.php?ref=25', NULL, 'pass@123'),
(26, 'Dipteeranjan mohamansingh', 'Achalkot', 'Dhenkanal', '754029', 21, '', '6370738682', '', '', '', 'Zorich', '2023-08-28 04:36:39', 1000, 'Y', 'Cash', 'Y', 21, '21-26-2023', 0, 0, 'http://dreamcaresolution.in/refjoin.php?ref=26', NULL, 'pass@123'),
(27, 'Susmita mishra', 'Sasan', 'Athgarh ', '754029', 21, '', '9778383979', '', '', '', 'Zorich', '2023-08-28 05:10:35', 1000, 'Y', 'Cash', 'Y', 15, '15-27-2023', 3, 0, 'http://dreamcaresolution.in/refjoin.php?ref=27', NULL, 'pass@123'),
(28, 'Seshadeba mishra', 'Dorada', 'Athgarh ', '754029', 21, '', '7735843851', '', '', '', 'Zorum', '2023-08-28 05:12:38', 1000, 'Y', 'Cash', 'Y', 15, '15-28-2023', 2, 0, 'http://dreamcaresolution.in/refjoin.php?ref=28', NULL, 'pass@123'),
(29, 'Sumitra dei', 'Nuabandha', 'Athgarh ', '754029', 21, 'tarinee.labs@gmail.com', '9337553360', '11259965010', 'SBIN0001083', '', 'Zorum', '2023-08-28 05:15:08', 1000, 'Y', 'Cash', 'Y', 15, '15-29-2023', 1, 0, 'http://dreamcaresolution.in/refjoin.php?ref=29', NULL, 'pass@123'),
(30, 'Sarojini sethy', 'Uparsahi', 'Athgarh ', '754029', 21, '', '9348502620', '', '', '', 'Zorum', '2023-08-28 05:17:42', 1000, 'Y', 'Cash', 'Y', 19, '19-30-2023', 0, 0, 'http://dreamcaresolution.in/refjoin.php?ref=30', NULL, 'pass@123'),
(31, 'Monalisa mohanty1', 'Banikanthanagar', 'Athgarh', '754029', 21, '', '6371331936', '', '', '', 'Zorich', '2023-08-28 05:19:40', 1000, 'Y', 'Cash', 'Y', 22, '22-31-2023', 0, 0, 'http://dreamcaresolution.in/refjoin.php?ref=31', NULL, 'pass@123'),
(32, 'Monalisa mohanty2', 'Banikanthanagar', 'Athgarh', '754029', 21, '', '6371331936', '', '', '', 'Zorich', '2023-08-28 05:20:54', 1000, 'Y', 'Cash', 'Y', 1, '1-32-2023', 0, 0, 'http://dreamcaresolution.in/refjoin.php?ref=32', NULL, 'pass@123'),
(33, 'Monalisa mohanty3', 'Banikanthanagar', 'Athgarh', '754029', 21, '', '6371331936', '', '', '', 'Zorich', '2023-08-28 05:21:56', 1000, 'Y', 'Cash', 'Y', 1, '1-33-2023', 0, 0, 'http://dreamcaresolution.in/refjoin.php?ref=33', NULL, 'pass@123'),
(34, 'Monalisa mohanty4', 'Banikanthanagar', 'Athgarh', '754029', 21, '', '6371331936', '', '', '', 'Zorich', '2023-08-28 05:22:42', 1000, 'Y', 'Cash', 'Y', 1, '1-34-2023', 0, 0, 'http://dreamcaresolution.in/refjoin.php?ref=34', NULL, 'pass@123'),
(35, 'Monalisa mohanty02', 'Banikanthanagar', 'Athgarh', '754029', 21, '', '6371331936', '', '', '', 'Zorich', '2023-08-28 05:38:20', 0, 'N', '', 'N', 22, '22-35-2023', 0, 0, 'http://dreamcaresolution.in/refjoin.php?ref=35', NULL, 'pass@123'),
(36, 'Monalisa mohanty03', 'Banikanthanagar', 'Athgarh', '754029', NULL, '', '6371331936', '', '', '', 'Zorich', '2023-08-28 05:39:37', 0, 'Y', 'Cash', 'Y', 22, '22-36-2023', 0, 0, 'http://dreamcaresolution.in/refjoin.php?ref=36', NULL, 'pass@123'),
(37, 'Monalisa mohanty03', 'Banikanthanagar', 'Athgarh', '754029', NULL, '', '6371331936', '', '', '', 'Zorich', '2023-08-28 05:40:10', 0, 'Y', 'Cash', 'Y', 1, '1-37-2023', 0, 0, 'http://dreamcaresolution.in/refjoin.php?ref=37', NULL, 'pass@123'),
(38, 'Monalisa mohanty04', 'Banikanthanagar', 'Athgarh', '754029', 21, '', '6371331936', '', '', '', 'Zorich', '2023-08-28 05:41:13', 0, 'Y', 'Cash', 'Y', 22, '22-38-2023', 0, 0, 'http://dreamcaresolution.in/refjoin.php?ref=38', NULL, 'pass@123'),
(39, 'Gitanjali dhirsamanta', 'Sasan', 'Athgarh', '754029', 21, '', '9658200656', '', '', '', 'Zorum', '2023-08-28 05:45:41', 1000, 'Y', 'Cash', 'Y', 27, '27-39-2023', 0, 0, 'http://dreamcaresolution.in/refjoin.php?ref=39', NULL, 'pass@123'),
(40, 'Susanta ku barik', 'Oldbusstand', 'Athgarh', '754029', 21, '', '9853127308', '', '', '', 'Zorum', '2023-08-28 05:48:25', 1000, 'Y', 'Cash', 'Y', 27, '27-40-2023', 0, 0, 'http://dreamcaresolution.in/refjoin.php?ref=40', NULL, 'pass@123'),
(41, 'Ranjan ku sahu', 'Dhaipur', 'Athgarh', '754029', 21, '', '9348371931', '', '', '', 'Zorum', '2023-08-28 05:50:25', 1000, 'Y', 'Cash', 'Y', 27, '27-41-2023', 1, 0, 'http://dreamcaresolution.in/refjoin.php?ref=41', NULL, 'pass@123'),
(42, 'Ranjan kumar sahu1', 'Dhaipur', 'Athgarh', '754029', 21, '', '9861797556', '', '', '', '4 LED BULBS', '2023-08-28 09:29:04', 1000, 'Y', 'Cash', 'Y', 41, '41-42-2023', 0, 0, 'http://dreamcaresolution.in/refjoin.php?ref=42', NULL, 'pass@123'),
(43, 'Gouri mallick', 'Radhanathpur sasan', 'Athgarh', '754029', 21, '', '9337723662', '', '', '', 'Zorich', '2023-08-28 09:30:57', 1000, 'Y', 'Cash', 'Y', 6, '6-43-2023', 0, 0, 'http://dreamcaresolution.in/refjoin.php?ref=43', NULL, 'pass@123'),
(44, 'DDS2', 'Radhanathpur sasan', 'Athgarh', '754029', 21, '', '9337723662', '', '', '', 'Zorum', '2023-08-28 09:33:36', 1000, 'Y', 'Cash', 'Y', 6, '6-44-2023', 0, 0, 'http://dreamcaresolution.in/refjoin.php?ref=44', NULL, 'pass@123'),
(45, 'DDS3', 'Radhanathpur sasan', 'Athgarh', '754029', 21, '', '9337723662', '', '', '', 'Zorum', '2023-08-28 09:34:44', 1000, 'Y', 'Cash', 'Y', 6, '6-45-2023', 0, 0, 'http://dreamcaresolution.in/refjoin.php?ref=45', NULL, 'pass@123'),
(46, 'DDS4', 'Radhanathpur sasan', 'Athgarh', '754029', 21, '', '9337723662', '', '', '', 'Zorum', '2023-08-28 09:36:14', 1000, 'Y', 'Cash', 'Y', 6, '6-46-2023', 0, 0, 'http://dreamcaresolution.in/refjoin.php?ref=46', NULL, 'pass@123'),
(47, 'DDS5', 'Radhanathpur sasan', 'Athgarh', '754029', 21, '', '9337723662', '', '', '', 'Zorum', '2023-08-28 09:37:06', 1000, 'Y', 'Cash', 'Y', 6, '6-47-2023', 0, 0, 'http://dreamcaresolution.in/refjoin.php?ref=47', NULL, 'pass@123'),
(48, 'DDS6', 'Radhanathpur sasan', 'Athgarh', '754029', 21, '', '9337723662', '', '', '', 'Zorum', '2023-08-28 09:37:52', 1000, 'Y', 'Cash', 'Y', 6, '6-48-2023', 0, 0, 'http://dreamcaresolution.in/refjoin.php?ref=48', NULL, 'pass@123'),
(49, 'DDS7', 'Radhanathpur sasan', 'Athgarh', '754029', 21, '', '9337723662', '', '', '', 'Zorum', '2023-08-28 09:38:41', 1000, 'Y', 'Cash', 'Y', 6, '6-49-2023', 0, 0, 'http://dreamcaresolution.in/refjoin.php?ref=49', NULL, 'pass@123'),
(50, 'DDS9', 'Radhanathpur sasan', 'Athgarh', '754029', 21, '', '9337723662', '', '', '', 'Zorum', '2023-08-28 09:40:46', 1000, 'Y', 'Cash', 'Y', 6, '6-50-2023', 0, 0, 'http://dreamcaresolution.in/refjoin.php?ref=50', NULL, 'pass@123'),
(51, 'DDS10', 'Radhanathpur sasan', 'Athgarh', '754029', 21, '', '9337723662', '', '', '', 'Zorum', '2023-08-28 09:41:57', 1000, 'Y', 'Cash', 'Y', 6, '6-51-2023', 0, 0, 'http://dreamcaresolution.in/refjoin.php?ref=51', NULL, 'pass@123'),
(52, ' Swati Srabani mishra', 'Dorada', 'Athgarh', '754029', 21, '', '9692044115', '', '', '', 'Zorum', '2023-08-28 11:16:41', 1000, 'Y', 'Cash', 'Y', 28, '28-52-2023', 0, 0, 'http://dreamcaresolution.in/refjoin.php?ref=52', NULL, 'pass@123'),
(53, 'Abdul niyamat', 'Dorada', 'Athgarh', '754029', 21, '', '7735843851', '', '', '', 'Zorum', '2023-08-28 11:23:05', 1000, 'Y', 'Cash', 'Y', 28, '28-53-2023', 0, 0, 'http://dreamcaresolution.in/refjoin.php?ref=53', NULL, 'pass@123'),
(54, 'Nirmal ch swain', 'Regedapara', 'Athgarh', '754029', 21, '', '6370509393', '', '', '', 'Zorum', '2023-08-28 11:37:13', 1000, 'Y', 'Cash', 'Y', 2, '2-54-2023', 0, 0, 'http://dreamcaresolution.in/refjoin.php?ref=54', NULL, 'pass@123'),
(55, 'Rasmiranjan swain', 'Regedapara', 'Athgarh', '754029', 21, '', '6370509393', '', '', '', 'Zorum', '2023-08-28 11:38:29', 1000, 'Y', 'Cash', 'Y', 2, '2-55-2023', 0, 0, 'http://dreamcaresolution.in/refjoin.php?ref=55', NULL, 'pass@123'),
(56, 'NS1', 'Regedapara', 'Athgarh', '754029', 21, '', '6370509393', '', '', '', 'Zorum', '2023-08-28 11:39:33', 1000, 'Y', 'Cash', 'Y', 2, '2-56-2023', 0, 0, 'http://dreamcaresolution.in/refjoin.php?ref=56', NULL, 'pass@123'),
(57, 'NS2', 'Regedapara', 'Athgarh', '754029', 21, '', '6370509393', '', '', '', 'Zorum', '2023-08-28 11:40:51', 1000, 'Y', 'Cash', 'Y', 2, '2-57-2023', 0, 0, 'http://dreamcaresolution.in/refjoin.php?ref=57', NULL, 'pass@123'),
(58, 'NS3', 'Regedapara', 'Athgarh', '754029', 21, '', '6370509393', '', '', '', 'Zorum', '2023-08-28 11:41:42', 1000, 'Y', 'Cash', 'Y', 1, '1-58-2023', 0, 0, 'http://dreamcaresolution.in/refjoin.php?ref=58', NULL, 'pass@123'),
(59, 'NS4', 'Regedapara', 'Athgarh', '754029', 21, '', '6370509393', '', '', '', 'Zorum', '2023-08-28 11:42:29', 1000, 'Y', 'Cash', 'Y', 2, '2-59-2023', 0, 0, 'http://dreamcaresolution.in/refjoin.php?ref=59', NULL, 'pass@123'),
(60, 'NS5', 'Regedapara', 'Athgarh', '754029', 21, '', '6370509393', '', '', '', 'Zorum', '2023-08-28 11:43:18', 1000, 'Y', 'Cash', 'Y', 2, '2-60-2023', 0, 0, 'http://dreamcaresolution.in/refjoin.php?ref=60', NULL, 'pass@123'),
(61, 'NS6', 'Regedapara', 'Athgarh', '754029', 21, '', '6370509393', '', '', '', 'Zorum', '2023-08-28 11:44:25', 1000, 'Y', 'Cash', 'Y', 2, '2-61-2023', 0, 0, 'http://dreamcaresolution.in/refjoin.php?ref=61', NULL, 'pass@123'),
(62, 'DDS11', 'Radhanathpur sasan', 'Athgarh', '754029', 21, '', '0933772366', '', '', '', 'Zorich', '2023-08-29 07:26:57', 1000, 'Y', 'Cash', 'Y', 6, '6-62-2023', 0, 0, 'http://dreamcaresolution.in/refjoin.php?ref=62', NULL, 'pass@123'),
(63, 'DDS12', 'Radhanathpur sasan', 'Athgarh', '754029', 21, '', '0933772366', '', '', '', 'Zorich', '2023-08-30 07:50:41', 0, 'Y', 'Cash', 'Y', 6, '6-63-2023', 0, 0, 'http://dreamcaresolution.in/refjoin.php?ref=63', NULL, 'pass@123'),
(64, 'Ashok kumar jena', 'Jatamundia', 'Banki', '754008', 21, '', '9078688099', '039710050547', 'IPOS0000001', '', 'Zorich', '2023-08-30 12:55:29', 1000, 'Y', 'Cash', 'Y', 1, '1-64-2023', 1, 0, 'http://dreamcaresolution.in/refjoin.php?ref=64', NULL, 'pass@123'),
(65, 'Ashok kumar jena1', 'Jatamundia', 'Banki', '754008', 21, '', '0958388633', '', '', '', 'Zorum', '2023-08-30 13:19:56', 0, 'Y', 'Cash', 'Y', 64, '64-65-2023', 0, 0, 'http://dreamcaresolution.in/refjoin.php?ref=65', NULL, 'pass@123'),
(66, 'DDS13', 'Radhanathpur sasan', 'Athgarh', '754029', 21, '', '0933772366', '', '', '', '4 LED BULBS', '2023-08-31 07:51:15', 0, 'Y', 'Cash', 'Y', 6, '6-66-2023', 0, 0, 'http://dreamcaresolution.in/refjoin.php?ref=66', NULL, 'pass@123'),
(67, 'DDS14', 'Old busstand', 'Athgarh', '754029', 21, '', '0933772366', '', '', '', '4 LED BULBS', '2023-09-01 07:46:52', 1000, 'Y', 'Cash', 'Y', 6, '6-67-2023', 0, 0, 'http://dreamcaresolution.in/refjoin.php?ref=67', NULL, 'pass@123'),
(68, 'DDS15', 'Radhanathpur sasan', 'Athgarh', '754029', 21, '', '0933772366', '', '', '', '4 LED BULBS', '2023-09-02 07:46:54', 1000, 'Y', '324512640172', 'Y', 6, '6-68-2023', 0, 0, 'http://dreamcaresolution.in/refjoin.php?ref=68', NULL, 'pass@123'),
(69, 'SUBAS CHANDRA NATH', 'ATHAGARH RAJANAGAR GARIYAPATA CUTTACK', 'CUTTACK', '754029', NULL, 'subaschandranath65@gmail.com', '0969276729', '65292764480', 'SBIN0032648', 'AIFPN0122M', 'Zorum', '2023-09-02 08:03:30', 1000, 'Y', 'Cash', 'Y', 10, '10-69-2023', 1, 0, 'http://dreamcaresolution.in/refjoin.php?ref=69', NULL, 'pass@123'),
(70, 'ROJALIN NATH', 'ATHAGARH RAJANAGAR GARIYAPATA CUTTACK', 'CUTTACK', 'RAJANA', 21, 'rojalinnath455@gmail.com', '0969276729', '07700110076712', 'UCBA0000770', '675339520581', '4 LED BULBS', '2023-09-02 08:42:41', 1000, 'Y', 'Cash', 'Y', 1, '1-70-2023', 0, 0, 'http://dreamcaresolution.in/refjoin.php?ref=70', NULL, 'pass@123'),
(71, 'Rojalin Nath', 'Rajnagar', 'Athgarh ', '754029', 21, 'rojalinnath455@gmail.com', '9692767294', '07700110076712', 'UCBA0000770', '675339520581', '4 LED BULBS', '2023-09-02 09:07:29', 1000, 'Y', 'Cash', 'Y', 69, '69-71-2023', 1, 0, 'http://dreamcaresolution.in/refjoin.php?ref=71', NULL, 'pass@123'),
(72, 'Ramachandra rana', 'Radhanathpur sasan', 'Athgarh', '754029', 21, '', '9337506863', '', '', '', 'Zorich', '2023-09-03 13:29:16', 1000, 'Y', 'Cash', 'Y', 15, '15-72-2023', 4, 0, 'http://dreamcaresolution.in/refjoin.php?ref=72', NULL, 'pass@123'),
(73, 'Satyaswarup mishra', 'Radhanathpur sasan', 'Athgarh', '754029', 21, '', '7377392023', '', '', '', 'Zorich', '2023-09-03 13:40:14', 1000, 'Y', 'Cash', 'Y', 72, '72-73-2023', 0, 0, 'http://dreamcaresolution.in/refjoin.php?ref=73', NULL, 'pass@123'),
(74, 'Satyaswarup mishra', 'Radhanathpur sasan', 'Athgarh', '754029', 21, '', '7377392023', '', '', '', 'Zorich', '2023-09-03 13:43:36', 1000, 'Y', 'Cash', 'Y', 72, '72-74-2023', 0, 0, 'http://dreamcaresolution.in/refjoin.php?ref=74', NULL, 'pass@123'),
(75, 'Chittaranjan mishra', 'Radhanathpur sasan', 'Athgarh', '754029', 21, '', '8260808839', '', '', '', 'Zorich', '2023-09-03 14:00:06', 1000, 'Y', 'Cash', 'Y', 72, '72-75-2023', 0, 0, 'http://dreamcaresolution.in/refjoin.php?ref=75', NULL, 'pass@123'),
(76, 'Pradeep kumar Tripathy', 'Radhanathpur sasan', 'Athgarh', '754029', 21, 'tripathypradeep8@gmail.com', '8249922437', '', '', 'AFYPT6773L', 'Zorich', '2023-09-04 07:34:49', 1000, 'Y', 'Cash', 'Y', 1, '1-76-2023', 0, 0, 'http://dreamcaresolution.in/refjoin.php?ref=76', NULL, 'pass@123'),
(77, 'DDS16', 'Radhanathpur sasan', 'Athgarh', '754029', 21, '', '0933772366', '', '', '', '4 LED BULBS', '2023-09-04 13:05:52', 1000, 'Y', 'Cash', 'Y', 6, '6-77-2023', 0, 0, 'http://dreamcaresolution.in/refjoin.php?ref=77', NULL, 'pass@123'),
(78, 'DDS17', 'Radhanathpur sasan', 'Athgarh', '754029', 21, '', '0933772366', '', '', '', '4 LED BULBS', '2023-09-04 13:07:30', 1000, 'Y', 'Cash', 'Y', 6, '6-78-2023', 0, 0, 'http://dreamcaresolution.in/refjoin.php?ref=78', NULL, 'pass@123'),
(79, 'DDS18', 'Radhanathpur sasan', 'Athgarh', '754029', 21, '', '0933772366', '', '', '', '4 LED BULBS', '2023-09-05 08:26:12', 1000, 'Y', 'Cash', 'Y', 6, '6-79-2023', 0, 0, 'http://dreamcaresolution.in/refjoin.php?ref=79', NULL, 'pass@123'),
(80, 'SUBAS CHANDRA NATH 1', 'ATHAGARH RAJANAGAR GARIYAPATA CUTTACK', 'CUTTACK', '754029', 21, 'subaschandranath65@gmail.com', '0969276729', '65292764480', 'SBIN0032648', 'AIFPN0122M', 'Zorum', '2023-09-06 08:45:06', 1000, 'Y', 'Cash', 'Y', 71, '71-80-2023', 0, 0, 'http://dreamcaresolution.in/refjoin.php?ref=80', NULL, 'pass@123'),
(81, 'Bijaya kumar Mishra', 'Bhubaneswar ', 'Nayapalli', '750017', 21, '', '9437541969', '', '', '', 'Zorum', '2023-09-07 05:22:00', 1000, 'Y', 'Cash', 'Y', 15, '15-81-2023', 1, 0, 'http://dreamcaresolution.in/refjoin.php?ref=81', NULL, 'pass@123'),
(82, 'B prasad Barik', 'Athgarh ', 'Mahakalbasta', '754029', 21, '', '9777993615', '922010010515361', 'UTIB0003896', 'AMMPB7187M', 'Zorum', '2023-09-07 05:45:01', 1000, 'Y', 'Cash', 'Y', 81, '81-82-2023', 1, 0, 'http://dreamcaresolution.in/refjoin.php?ref=82', NULL, 'pass@123'),
(83, 'Benudhar jena', 'Athgarh', 'Cuttack ', '754029', NULL, 'bjsir.math@gmail.com', '7978945923', '20420991469', 'CBIN0017947', 'ADNPJ9525D', 'Zorich', '2023-09-10 06:10:32', 1000, 'Y', 'Cash ', 'Y', 1, '1-83-2023', 0, 0, 'http://dreamcaresolution.in/refjoin.php?ref=83', NULL, 'pass@123'),
(84, 'DDS 19', 'Radhanathpur sasan', 'Athgarh', '754029', 21, '', '0933772366', '', '', '', '4 LED BULBS', '2023-09-11 07:26:47', 1000, 'Y', 'Cash', 'Y', 6, '6-84-2023', 0, 0, 'http://dreamcaresolution.in/refjoin.php?ref=84', NULL, 'pass@123'),
(85, 'DDS 20', 'Radhanathpur sasan', 'Athgarh', '754029', 21, '', '0933772366', '', '', '', '4 LED BULBS', '2023-09-12 08:08:13', 1000, 'Y', 'Cash', 'Y', 6, '6-85-2023', 0, 0, 'http://dreamcaresolution.in/refjoin.php?ref=85', NULL, 'pass@123'),
(86, 'DDS 21', 'Radhanathpur sasan', 'Athgarh', '754029', 21, '', '0933772366', '', '', '', '4 LED BULBS', '2023-09-16 06:16:07', 1000, 'Y', 'Cash', 'Y', 6, '6-86-2023', 0, 0, 'http://dreamcaresolution.in/refjoin.php?ref=86', NULL, 'pass@123'),
(87, 'Prakash kumar mohanty', 'Nuabandha', 'Jenapada', '754029', 21, 'tarinee.labs@gmail.com', '7894510896', '07700110028742', 'UCBA0000770', 'CJXPM2130F', 'Zorum', '2023-09-18 07:08:30', 1000, 'Y', 'Cash', 'Y', 29, '29-87-2023', 0, 0, 'http://dreamcaresolution.in/refjoin.php?ref=87', NULL, 'pass@123'),
(88, 'DDS22', 'radhanathpur sasan', 'athgarh', '754029', 21, '', '9337723662', '', '', '', 'Zorum', '2023-09-21 07:57:57', 1000, 'Y', 'cash', 'Y', 6, '6-88-2023', 0, 0, 'http://dreamcaresolution.in/refjoin.php?ref=88', NULL, 'pass@123'),
(89, 'Narahari Sethi', 'Jenapada', 'Athgarh ', '754029', 21, '', '9777216209', '31136077242', 'sbin0001083 ', '408947226110', 'Zorich', '2023-09-21 12:01:10', 1000, 'Y', 'Cash', 'Y', 2, '2-89-2023', 0, 0, 'http://dreamcaresolution.in/refjoin.php?ref=89', NULL, 'pass@123'),
(90, 'DDS23', 'Radhanathpur sasan', 'Athgarh', '754029', 21, '', '0933772366', '', '', '', '4 LED BULBS', '2023-09-22 08:06:46', 1000, 'Y', 'Cash', 'Y', 6, '6-90-2023', 0, 0, 'http://dreamcaresolution.in/refjoin.php?ref=90', NULL, 'pass@123'),
(91, 'DDS24', 'Radhanathpur sasan', 'Athgarh', '754029', 21, '', '0933772366', '', '', '', 'Zorich', '2023-09-23 08:01:18', 1000, 'Y', 'Cash', 'Y', 6, '6-91-2023', 0, 0, 'http://dreamcaresolution.in/refjoin.php?ref=91', NULL, 'pass@123'),
(92, 'DDS25', 'Radhanathpur sasan', 'Athgarh', '754029', 21, '', '0933772366', '', '', '', 'Zorich', '2023-09-23 08:03:44', 1000, 'Y', 'Cash', 'Y', 6, '6-92-2023', 0, 0, 'http://dreamcaresolution.in/refjoin.php?ref=92', NULL, 'pass@123'),
(93, 'Sushant nayak', 'Similipur', 'Banki', '754008', 21, '', '9583907517', '4128101002518', 'CNRB0004128', '', 'Zorich', '2023-09-24 11:44:11', 1000, 'Y', 'Cash', 'Y', 20, '20-93-2023', 0, 0, 'http://dreamcaresolution.in/refjoin.php?ref=93', NULL, 'pass@123'),
(94, 'Dds26', 'Radhanathpur sasan', 'Athgarh', '754029', 21, '', '0933772366', '', '', '', 'Zorich', '2023-09-25 07:56:21', 1000, 'Y', 'Cash', 'Y', 6, '6-94-2023', 0, 0, 'http://dreamcaresolution.in/refjoin.php?ref=94', NULL, 'pass@123'),
(95, 'Abhimanyu Barik', 'Sadangi', 'Dhenkanal', '759016', 21, '', '8144825979', '', '', '', 'Zorum', '2023-09-25 09:00:04', 1000, 'Y', 'Qr', 'Y', 82, '82-95-2023', 0, 0, 'http://dreamcaresolution.in/refjoin.php?ref=95', NULL, 'pass@123'),
(96, 'Sasmita sahoo', 'Padmasahi', 'Athgarh', '754029', 21, '', '8249616311', '41579772938', 'Sbin0001083 ', '', '4 LED BULBS', '2023-09-26 15:12:11', 1000, 'Y', 'Cash', 'Y', 1, '1-96-2023', 0, 0, 'http://dreamcaresolution.in/refjoin.php?ref=96', NULL, 'pass@123'),
(97, 'DDS27', 'Radanathpur sasan', 'Athgarh ', '754029', 21, '', '9337723662', '', '', '', 'Zorich', '2023-09-27 07:41:23', 1000, 'Y', 'Cash', 'Y', 6, '6-97-2023', 0, 0, 'http://dreamcaresolution.in/refjoin.php?ref=97', NULL, 'pass@123'),
(98, 'DDS28', 'Radanathpur sasan', 'Athgarh', '754029', 21, '', '0933772366', '', '', '', 'Zorich', '2023-09-28 07:48:24', 1000, 'Y', 'Cash', 'Y', 6, '6-98-2023', 0, 0, 'http://dreamcaresolution.in/refjoin.php?ref=98', NULL, 'pass@123'),
(99, 'DDS29', 'Radanathpur sasan', 'Athgarh', '754029', 21, '', '0933772366', '', '', '', 'Zorich', '2023-09-29 08:14:08', 1000, 'Y', 'Cash', 'Y', 6, '6-99-2023', 0, 0, 'http://dreamcaresolution.in/refjoin.php?ref=99', NULL, 'pass@123'),
(100, 'Dr Brahma nanda Das', 'Khuntakata,sai nilayam', 'Athgada', '754295', 21, '8658090586das@gmail.com', '8658090586', '11259885838', 'Sbin0001083 ', '', 'Zorich', '2023-09-30 05:31:35', 1000, 'Y', 'Qr', 'Y', 72, '72-100-2023', 0, 0, 'http://dreamcaresolution.in/refjoin.php?ref=100', NULL, 'pass@123');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
