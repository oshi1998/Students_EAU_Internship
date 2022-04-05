-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 30, 2021 at 02:40 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `students_eau_internship`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `ad_id` int(11) NOT NULL COMMENT 'รหัส',
  `ad_email` varchar(255) NOT NULL COMMENT 'อีเมล',
  `ad_password` varchar(255) NOT NULL COMMENT 'รหัสผ่าน',
  `ad_firstname` varchar(255) NOT NULL COMMENT 'ชื่อจริง',
  `ad_lastname` varchar(255) NOT NULL COMMENT 'นามสกุล',
  `ad_gender` varchar(255) NOT NULL COMMENT 'เพศ',
  `ad_address` text NOT NULL COMMENT 'ที่อยู่',
  `ad_tel` varchar(255) NOT NULL COMMENT 'เบอร์โทร',
  `ad_image` text NOT NULL COMMENT 'รูปประจำตัว',
  `ad_role` varchar(255) NOT NULL DEFAULT 'ผู้ดูแลระบบ' COMMENT 'ตำแหน่ง',
  `ad_created` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'สร้างเมื่อ',
  `ad_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'อัพเดตล่าสุด'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`ad_id`, `ad_email`, `ad_password`, `ad_firstname`, `ad_lastname`, `ad_gender`, `ad_address`, `ad_tel`, `ad_image`, `ad_role`, `ad_created`, `ad_updated`) VALUES
(1, 'thephenome1998@gmail.com', '19e7d665ff5530bf4baf739cfc0d4447', 'วงศ์วสันต์', 'ดวงเกตุ', 'ชาย', 'ประเทศไทย', '0972651700', 'no_avatar.png', 'ผู้ดูแลระบบ', '2021-11-26 13:06:05', '2021-12-07 16:42:00');

-- --------------------------------------------------------

--
-- Table structure for table `internship_notes`
--

CREATE TABLE `internship_notes` (
  `intsn_id` int(11) NOT NULL COMMENT 'รหัส',
  `std_id` int(11) NOT NULL COMMENT 'นักศึกษา',
  `intsn_week` int(2) NOT NULL COMMENT 'สัปดาห์ที่',
  `intsn_date` date NOT NULL COMMENT 'วันที่',
  `intsn_work_in` time NOT NULL COMMENT 'เวลาเข้างาน',
  `intsn_work_out` time NOT NULL COMMENT 'เวลาออกงาน',
  `intsn_leave` int(1) NOT NULL COMMENT '0 = มาทำงาน , 1 = ลางาน',
  `intsn_job` text NOT NULL COMMENT 'งานที่ได้รับมอบหมาย',
  `intsn_ovs_status` varchar(255) NOT NULL COMMENT 'สถานะยืนยันจากหัวหน้างาน',
  `intsn_tch_status` varchar(255) NOT NULL COMMENT 'สถานะยืนยันจากอาจารย์',
  `intsn_created` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'สร้างเมื่อ',
  `intsn_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'อัพเดตล่าสุด'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `internship_notes`
--

INSERT INTO `internship_notes` (`intsn_id`, `std_id`, `intsn_week`, `intsn_date`, `intsn_work_in`, `intsn_work_out`, `intsn_leave`, `intsn_job`, `intsn_ovs_status`, `intsn_tch_status`, `intsn_created`, `intsn_updated`) VALUES
(1, 1, 1, '2021-12-21', '08:00:00', '17:00:00', 0, 'จัดส่ง Supply Model ตามไลน์งาน', 'ยืนยันเรียบร้อย', 'ยืนยันเรียบร้อย', '2021-12-21 09:01:15', '2021-12-24 05:52:22'),
(3, 1, 1, '2021-12-22', '07:52:00', '17:05:00', 0, 'จัดส่ง Supply Model ตามไลน์งาน', 'ยืนยันเรียบร้อย', 'ยืนยันเรียบร้อย', '2021-12-21 09:02:21', '2021-12-24 05:52:22'),
(4, 1, 1, '2021-12-23', '00:00:00', '00:00:00', 1, '', 'ยืนยันเรียบร้อย', 'ยืนยันเรียบร้อย', '2021-12-21 09:04:16', '2021-12-24 05:52:22'),
(5, 1, 1, '2021-12-24', '07:36:00', '17:10:00', 0, 'จัดส่ง Supply Model ตามไลน์งาน', 'ยืนยันเรียบร้อย', 'ยืนยันเรียบร้อย', '2021-12-21 10:09:29', '2021-12-24 05:52:22'),
(6, 1, 2, '2021-12-27', '07:55:00', '17:55:00', 0, 'จัดส่ง Supply Model ตามไลน์งาน', 'ยืนยันเรียบร้อย', 'ยืนยันเรียบร้อย', '2021-12-24 05:49:19', '2021-12-30 12:43:37');

-- --------------------------------------------------------

--
-- Table structure for table `internship_places`
--

CREATE TABLE `internship_places` (
  `intsp_id` int(11) NOT NULL COMMENT 'รหัส',
  `intsp_name` varchar(255) NOT NULL COMMENT 'ชื่อสถานที่',
  `intsp_address` text NOT NULL COMMENT 'ที่อยู่',
  `intsp_tel` varchar(255) NOT NULL COMMENT 'เบอร์โทรติดต่อ',
  `intsp_created` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'สร้างเมื่อ',
  `intsp_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'อัพเดตล่าสุด'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `internship_places`
--

INSERT INTO `internship_places` (`intsp_id`, `intsp_name`, `intsp_address`, `intsp_tel`, `intsp_created`, `intsp_updated`) VALUES
(1, 'บริษัท โซนี่ เทคโนโลยี (ประเทศไทย) จำกัด', 'นิคมอุตสาหกรรมอมตะซิตี้ชลบุรี (เฟส4) 700/402 หมู่ 7 ต.ดอนหัวฬอ อ.เมืองชลบุรี จ.ชลบุรี 20000', '038-458908', '2021-12-07 15:40:44', '2021-12-07 15:49:39');

-- --------------------------------------------------------

--
-- Table structure for table `internship_works`
--

CREATE TABLE `internship_works` (
  `intsw_id` int(11) NOT NULL COMMENT 'รหัส',
  `std_id` int(11) NOT NULL COMMENT 'รหัสนักศึกษา',
  `intsw_start_date` date NOT NULL COMMENT 'วันที่เริ่มฝึกงาน',
  `intsw_end_date` date NOT NULL COMMENT 'วันที่จบการฝึกงาน',
  `intsw_date` date NOT NULL COMMENT 'วันที่ขอจบการฝึกงาน',
  `intsw_tch_status` varchar(255) NOT NULL COMMENT 'สถานะยืนยันจากอาจารย์',
  `intsw_ovs_status` varchar(255) NOT NULL COMMENT 'สถานะยืนยันจากหัวหน้างาน',
  `tch_id` int(11) NOT NULL COMMENT 'รหัสอาจารย์',
  `ovs_id` int(11) NOT NULL COMMENT 'รหัสหัวหน้างาน'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `internship_works`
--

INSERT INTO `internship_works` (`intsw_id`, `std_id`, `intsw_start_date`, `intsw_end_date`, `intsw_date`, `intsw_tch_status`, `intsw_ovs_status`, `tch_id`, `ovs_id`) VALUES
(3, 1, '2021-12-24', '2022-02-24', '2021-12-24', 'ยืนยันเรียบร้อย', 'ยืนยันเรียบร้อย', 1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `overseers`
--

CREATE TABLE `overseers` (
  `ovs_id` int(11) NOT NULL COMMENT 'รหัส',
  `ovs_email` varchar(255) NOT NULL COMMENT 'อีเมล',
  `ovs_password` varchar(255) NOT NULL COMMENT 'รหัสผ่าน',
  `ovs_firstname` varchar(255) NOT NULL COMMENT 'ชื่อจริง',
  `ovs_lastname` varchar(255) NOT NULL COMMENT 'นามสกุล',
  `ovs_gender` varchar(255) NOT NULL COMMENT 'เพศ',
  `ovs_address` text NOT NULL COMMENT 'ที่อยู่',
  `ovs_tel` varchar(255) NOT NULL COMMENT 'เบอร์โทร',
  `ovs_image` text NOT NULL COMMENT 'รูปประจำตัว',
  `ovs_role` varchar(255) NOT NULL DEFAULT 'หัวหน้างาน' COMMENT 'ตำแหน่ง',
  `intsp_id` int(11) NOT NULL COMMENT 'สถานที่ฝึกงาน',
  `ovs_created` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'สร้างเมื่อ',
  `ovs_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'อัพเดตล่าสุด'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `overseers`
--

INSERT INTO `overseers` (`ovs_id`, `ovs_email`, `ovs_password`, `ovs_firstname`, `ovs_lastname`, `ovs_gender`, `ovs_address`, `ovs_tel`, `ovs_image`, `ovs_role`, `intsp_id`, `ovs_created`, `ovs_updated`) VALUES
(5, 'test001@gmail.com', '19e7d665ff5530bf4baf739cfc0d4447', 'กฤตภาส', 'สัมฤทธิ์', 'ชาย', 'ประเทศไทย', '9999999999', 'no_avatar.png', 'หัวหน้างาน', 1, '2021-12-07 16:54:33', '2021-12-07 16:54:33');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `std_id` int(11) NOT NULL COMMENT 'รหัส',
  `std_email` varchar(255) NOT NULL COMMENT 'อีเมล',
  `std_password` varchar(255) NOT NULL COMMENT 'รหัสผ่าน',
  `std_firstname` varchar(255) NOT NULL COMMENT 'ชื่อจริง',
  `std_lastname` varchar(255) NOT NULL COMMENT 'นามสกุล',
  `std_gender` varchar(255) NOT NULL COMMENT 'เพศ',
  `std_address` text NOT NULL COMMENT 'ที่อยู่',
  `std_tel` varchar(255) NOT NULL COMMENT 'เบอร์โทร',
  `std_image` text NOT NULL COMMENT 'รูปประจำตัว',
  `std_role` varchar(255) NOT NULL DEFAULT 'นักศึกษา' COMMENT 'ตำแหน่ง',
  `tch_id` int(11) NOT NULL COMMENT 'อาจารย์ที่ปรึกษา',
  `ovs_id` int(11) NOT NULL COMMENT 'หัวหน้างาน',
  `intsp_id` int(11) NOT NULL COMMENT 'สถานที่ฝึกงาน',
  `std_status` varchar(255) NOT NULL DEFAULT 'อยู่ระหว่างการฝึกงาน' COMMENT 'สถานะฝึกงาน',
  `std_created` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'สร้างเมื่อ',
  `std_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'อัพเดตล่าสุด'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`std_id`, `std_email`, `std_password`, `std_firstname`, `std_lastname`, `std_gender`, `std_address`, `std_tel`, `std_image`, `std_role`, `tch_id`, `ovs_id`, `intsp_id`, `std_status`, `std_created`, `std_updated`) VALUES
(1, 'jirayut@gmail.com', '19e7d665ff5530bf4baf739cfc0d4447', 'จิรายุทธ', 'ก้านมะยม', 'ชาย', 'ประเทศไทย', '0698741122', 'no_avatar.png', 'นักศึกษา', 1, 5, 1, 'สำเร็จการฝึกงาน', '2021-12-07 17:02:24', '2021-12-24 08:54:25');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `tch_id` int(11) NOT NULL COMMENT 'รหัส',
  `tch_email` varchar(255) NOT NULL COMMENT 'อีเมล',
  `tch_password` varchar(255) NOT NULL COMMENT 'รหัสผ่าน',
  `tch_firstname` varchar(255) NOT NULL COMMENT 'ชื่อจริง',
  `tch_lastname` varchar(255) NOT NULL COMMENT 'นามสกุล',
  `tch_gender` varchar(255) NOT NULL COMMENT 'เพศ',
  `tch_address` text NOT NULL COMMENT 'ที่อยู่',
  `tch_tel` varchar(255) NOT NULL COMMENT 'เบอร์โทร',
  `tch_image` text NOT NULL COMMENT 'รูปประจำตัว',
  `tch_role` varchar(255) NOT NULL DEFAULT 'อาจารย์' COMMENT 'ตำแหน่ง',
  `tch_created` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'สร้างเมื่อ',
  `tch_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'อัพเดตล่าสุด'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`tch_id`, `tch_email`, `tch_password`, `tch_firstname`, `tch_lastname`, `tch_gender`, `tch_address`, `tch_tel`, `tch_image`, `tch_role`, `tch_created`, `tch_updated`) VALUES
(1, 'kroengpol@gmail.com', '19e7d665ff5530bf4baf739cfc0d4447', 'เกริกพล', 'สัมฤทธิ์', 'ชาย', 'ประเทศไทย', '0916587210', 'no_avatar.png', 'อาจารย์', '2021-12-07 16:37:12', '2021-12-07 16:37:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`ad_id`);

--
-- Indexes for table `internship_notes`
--
ALTER TABLE `internship_notes`
  ADD PRIMARY KEY (`intsn_id`),
  ADD KEY `std_id` (`std_id`);

--
-- Indexes for table `internship_places`
--
ALTER TABLE `internship_places`
  ADD PRIMARY KEY (`intsp_id`);

--
-- Indexes for table `internship_works`
--
ALTER TABLE `internship_works`
  ADD PRIMARY KEY (`intsw_id`),
  ADD KEY `std_id` (`std_id`),
  ADD KEY `tch_id` (`tch_id`),
  ADD KEY `ovs_id` (`ovs_id`);

--
-- Indexes for table `overseers`
--
ALTER TABLE `overseers`
  ADD PRIMARY KEY (`ovs_id`),
  ADD KEY `intsp_id` (`intsp_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`std_id`),
  ADD KEY `intsp_id` (`intsp_id`),
  ADD KEY `ovs_id` (`ovs_id`),
  ADD KEY `tch_id` (`tch_id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`tch_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `ad_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัส', AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `internship_notes`
--
ALTER TABLE `internship_notes`
  MODIFY `intsn_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัส', AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `internship_places`
--
ALTER TABLE `internship_places`
  MODIFY `intsp_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัส', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `internship_works`
--
ALTER TABLE `internship_works`
  MODIFY `intsw_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัส', AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `overseers`
--
ALTER TABLE `overseers`
  MODIFY `ovs_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัส', AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `std_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัส', AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `tch_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัส', AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `internship_notes`
--
ALTER TABLE `internship_notes`
  ADD CONSTRAINT `internship_notes_ibfk_1` FOREIGN KEY (`std_id`) REFERENCES `students` (`std_id`);

--
-- Constraints for table `internship_works`
--
ALTER TABLE `internship_works`
  ADD CONSTRAINT `internship_works_ibfk_1` FOREIGN KEY (`std_id`) REFERENCES `students` (`std_id`),
  ADD CONSTRAINT `internship_works_ibfk_2` FOREIGN KEY (`tch_id`) REFERENCES `teachers` (`tch_id`),
  ADD CONSTRAINT `internship_works_ibfk_3` FOREIGN KEY (`ovs_id`) REFERENCES `overseers` (`ovs_id`);

--
-- Constraints for table `overseers`
--
ALTER TABLE `overseers`
  ADD CONSTRAINT `overseers_ibfk_1` FOREIGN KEY (`intsp_id`) REFERENCES `internship_places` (`intsp_id`);

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`intsp_id`) REFERENCES `internship_places` (`intsp_id`),
  ADD CONSTRAINT `students_ibfk_2` FOREIGN KEY (`ovs_id`) REFERENCES `overseers` (`ovs_id`),
  ADD CONSTRAINT `students_ibfk_3` FOREIGN KEY (`tch_id`) REFERENCES `teachers` (`tch_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
