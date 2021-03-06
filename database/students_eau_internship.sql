-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 14, 2022 at 01:25 AM
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
(1, 'thephenome1998@gmail.com', '19e7d665ff5530bf4baf739cfc0d4447', 'วงศ์วสันต์', 'ดวงเกตุ', 'หญิง', 'ประเทศไทย', '0972651700', 'no_avatar.png', 'ผู้ดูแลระบบ', '2021-11-26 13:06:05', '2022-03-30 15:14:59');

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
  `intsn_work_step` text NOT NULL COMMENT 'ขั้นตอนการปฏิบัติงาน',
  `intsn_work_result` text NOT NULL COMMENT 'ผลการปฏิบัติงาน',
  `intsn_work_learn` text NOT NULL COMMENT 'สิ่งที่ได้เรียนรู้จากงานที่ได้รับมอบหมาย',
  `intsn_work_issue` text NOT NULL COMMENT 'ปัญหาจากการปฏิบัติงาน',
  `intsn_work_improve` text NOT NULL COMMENT 'สิ่งที่ต้องปรับปรุง',
  `intsn_work_performance` text NOT NULL COMMENT 'การตรวจสอบผลการปฏิบัติงาน',
  `intsn_ovs_status` varchar(255) NOT NULL COMMENT 'สถานะยืนยันจากหัวหน้างาน',
  `intsn_tch_status` varchar(255) NOT NULL COMMENT 'สถานะยืนยันจากอาจารย์',
  `intsn_created` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'สร้างเมื่อ',
  `intsn_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'อัพเดตล่าสุด'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `internship_notes`
--

INSERT INTO `internship_notes` (`intsn_id`, `std_id`, `intsn_week`, `intsn_date`, `intsn_work_in`, `intsn_work_out`, `intsn_leave`, `intsn_job`, `intsn_work_step`, `intsn_work_result`, `intsn_work_learn`, `intsn_work_issue`, `intsn_work_improve`, `intsn_work_performance`, `intsn_ovs_status`, `intsn_tch_status`, `intsn_created`, `intsn_updated`) VALUES
(11, 1, 1, '2022-03-30', '07:30:00', '17:05:00', 0, 'ศึกษาข้อมูลการใช้ Node js', '- ค้นหาข้อมูลและพื้นฐานการใช้งาน Node js', '- สามารถเริ่มทำตามขั้นตอนพื้นฐานในการเขียน Node js แบบง่ายๆ ได้', 'ได้เรียนรู้การใช้ Node js ขั้นพื้นฐานในการเขียนการเก็บข้อมูลต่างๆ', 'ปัญหา: ต้องศึกษาพื้นฐานในการเขียน Node js\r\n\r\nการแก้ไข: ดูวิดีโอใน Youtube ดูงานจากพี่ที่ทำงานและสอบถามสิ่งที่ไม่เข้าใจ', 'Node js: การใช้งาน if และ else เพื่อไม่ให้ server พัง', 'เรียนรู้งานและปรับตัวได้เร็ว', 'ยืนยันเรียบร้อย', 'ยืนยันเรียบร้อย', '2022-03-30 07:35:50', '2022-03-30 14:20:10'),
(12, 1, 1, '2022-03-31', '07:01:00', '17:06:00', 0, 'ศึกษาข้อมูลการใช้ Node js', '- ค้นหาข้อมูลและพื้นฐานการใช้งาน Node js', '- สามารถเริ่มทำตามขั้นตอนพื้นฐานในการเขียน Node js แบบง่ายๆ ได้', 'ได้เรียนรู้การใช้ Node js ขั้นพื้นฐานในการเขียนการเก็บข้อมูลต่างๆ', 'ปัญหา: ต้องศึกษาพื้นฐานในการเขียน Node js\r\n\r\nการแก้ไข: ดูวิดีโอใน Youtube ดูงานจากพี่ที่ทำงานและสอบถามสิ่งที่ไม่เข้าใจ', 'Node js: การใช้งาน if และ else เพื่อไม่ให้ server พัง', 'เรียนรู้งานและปรับตัวได้เร็ว', 'ยืนยันเรียบร้อย', 'ยืนยันเรียบร้อย', '2022-03-30 11:22:47', '2022-03-30 14:20:10'),
(13, 1, 2, '2022-04-05', '06:55:00', '17:01:00', 0, 'ศึกษาข้อมูลการใช้ Node js', 'T', 'T', 'T', 'T', 'T', 'ทำงานได้ดีและรวดเร็ว', 'ยืนยันเรียบร้อย', 'ยืนยันเรียบร้อย', '2022-03-30 14:39:05', '2022-03-30 14:43:20'),
(14, 1, 2, '2022-04-06', '07:01:00', '17:02:00', 0, 'ศึกษาข้อมูลการใช้ Node js', 'T', 'T', 'T', 'T', 'T', 'ทำงานได้ดีและรวดเร็ว', 'ยืนยันเรียบร้อย', 'ยืนยันเรียบร้อย', '2022-03-30 14:39:39', '2022-03-30 14:43:20'),
(15, 1, 2, '2022-04-07', '00:00:00', '00:00:00', 1, 'ศึกษาข้อมูลการใช้ Node js', 'T', 'T', 'T', 'T', 'T', 'ทำงานได้ดีและรวดเร็ว', 'ยืนยันเรียบร้อย', 'ยืนยันเรียบร้อย', '2022-03-30 14:39:51', '2022-03-30 14:43:20');

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
(5, 1, '2022-01-01', '2022-05-10', '2022-04-12', 'ยืนยันเรียบร้อย', 'ยืนยันเรียบร้อย', 1, 5);

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
  `std_year` int(4) NOT NULL COMMENT 'ปีการศึกษา',
  `std_address` text NOT NULL COMMENT 'ที่อยู่',
  `std_tel` varchar(255) NOT NULL COMMENT 'เบอร์โทร',
  `std_class_year` int(1) DEFAULT NULL COMMENT 'ชั้นปี',
  `std_born` date DEFAULT NULL COMMENT 'วันเดือนปีเกิด',
  `std_nationality` varchar(255) DEFAULT NULL COMMENT 'สัญชาติ',
  `std_ethnicity` varchar(255) DEFAULT NULL COMMENT 'เชื้อชาติ',
  `std_religion` varchar(255) DEFAULT NULL COMMENT 'ศาสนา',
  `std_number` varchar(255) DEFAULT NULL COMMENT 'รหัสนักศึกษา',
  `std_id_card` char(13) DEFAULT NULL COMMENT 'รหัสประจำตัวประชาชน',
  `std_domicile` text DEFAULT NULL COMMENT 'ภูมืลำเนาเดิม',
  `std_father_name` varchar(255) DEFAULT NULL COMMENT 'ชื่อบิดา',
  `std_father_age` int(3) DEFAULT NULL COMMENT 'อายุบิดา',
  `std_father_occupation` varchar(255) DEFAULT NULL COMMENT 'อาชีพบิดา',
  `std_mother_name` varchar(255) DEFAULT NULL COMMENT 'ชื่อมารดา',
  `std_mother_age` int(3) DEFAULT NULL COMMENT 'อายุมารดา',
  `std_mother_occupation` varchar(255) DEFAULT NULL COMMENT 'อาชีพมารดา',
  `std_parent_name` varchar(255) DEFAULT NULL COMMENT 'ชื่อผู้ปกครอง',
  `std_parent_relationship` varchar(255) DEFAULT NULL COMMENT 'ความสัมพันธ์ผู้ปกครอง',
  `std_parent_address` text DEFAULT NULL COMMENT 'ที่อยู่ผู้ปกครอง',
  `std_parent_tel` varchar(255) DEFAULT NULL COMMENT 'เบอร์โทรศัพท์ผู้ปกครอง',
  `std_talent_1` varchar(255) DEFAULT NULL COMMENT 'ความสามารถพิเศษ1',
  `std_talent_2` varchar(255) DEFAULT NULL COMMENT 'ความสามารถพิเศษ2',
  `std_internship_instuctor` varchar(255) DEFAULT 'คณะกรรมการนิเทศนักศึกษาฝึกงาน' COMMENT 'อาจารย์นิเทศการฝึกงาน',
  `std_map` text DEFAULT NULL COMMENT 'ไฟล์แผนที่จากที่พักถึงที่ทำงาน',
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

INSERT INTO `students` (`std_id`, `std_email`, `std_password`, `std_firstname`, `std_lastname`, `std_gender`, `std_year`, `std_address`, `std_tel`, `std_class_year`, `std_born`, `std_nationality`, `std_ethnicity`, `std_religion`, `std_number`, `std_id_card`, `std_domicile`, `std_father_name`, `std_father_age`, `std_father_occupation`, `std_mother_name`, `std_mother_age`, `std_mother_occupation`, `std_parent_name`, `std_parent_relationship`, `std_parent_address`, `std_parent_tel`, `std_talent_1`, `std_talent_2`, `std_internship_instuctor`, `std_map`, `std_image`, `std_role`, `tch_id`, `ovs_id`, `intsp_id`, `std_status`, `std_created`, `std_updated`) VALUES
(1, 'jirayut@gmail.com', '19e7d665ff5530bf4baf739cfc0d4447', 'จิรายุทธ', 'ก้านมะยม', 'ชาย', 2564, 'ประเทศไทย', '0698741122', 4, '1998-02-17', 'ไทย', 'ไทย', 'พุทธ', '59180001', '1459900696781', 'ประเทศไทย', 'จิราพล ก้านมะยม', 44, 'ธุรกิจส่วนตัว', 'จิราพร ก้านมะยม', 42, 'ธุรกิจส่วนตัว', 'จิราพล ก้านมะยม', 'บิดา', 'ประเทศไทย', '0972651700', 'เล่นฟุตบอล', 'ตัดต่อวิดีโอ', 'คณะกรรมการนิเทศนักศึกษาฝึกงาน	', '6255a64497392.jpg', 'no_avatar.png', 'นักศึกษา', 1, 5, 1, 'สำเร็จการฝึกงาน', '2021-12-07 17:02:24', '2022-04-12 16:34:56');

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
  MODIFY `intsn_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัส', AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `internship_places`
--
ALTER TABLE `internship_places`
  MODIFY `intsp_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัส', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `internship_works`
--
ALTER TABLE `internship_works`
  MODIFY `intsw_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัส', AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `overseers`
--
ALTER TABLE `overseers`
  MODIFY `ovs_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัส', AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `std_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัส', AUTO_INCREMENT=7;

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
