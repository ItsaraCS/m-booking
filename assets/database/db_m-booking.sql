-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 14, 2017 at 06:46 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `m_booking`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `booking_id` int(5) NOT NULL COMMENT 'คีย์ของการจองห้องประชุม',
  `meeting_room_id` int(5) NOT NULL COMMENT 'คีย์ของห้องประชุม',
  `meeting_type_id` int(5) NOT NULL COMMENT 'คีย์ของประเภทการประชุม',
  `start_date` date NOT NULL COMMENT 'วันที่เริ่มการประชุม',
  `end_date` date NOT NULL COMMENT 'วันที่เสร็จสิ้นการประชุม',
  `start_time` time NOT NULL COMMENT 'เวลาที่เริ่มการประชุม',
  `end_time` time NOT NULL COMMENT 'เวลาที่เสร็จสิ้นการประชุม',
  `meeting_topic` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'หัวข้อการประชุม',
  `meeting_number` int(5) NOT NULL COMMENT 'จำนวนผู้เข้าประชุม',
  `meeting_detail` longtext COLLATE utf8_unicode_ci COMMENT 'รายละเอียดการประชุม',
  `booking_status_id` int(5) NOT NULL COMMENT 'คีย์ของสถานะการจองห้องประชุม',
  `department_id` int(5) NOT NULL COMMENT 'คีย์ของแผนก',
  `meeting_table_type_id` int(5) DEFAULT NULL COMMENT 'คีย์ของรูปแบบการจัดโต๊ะห้องประชุม',
  `meeting_required_id` int(5) DEFAULT NULL COMMENT 'คีย์ของสิ่งที่ต้องการในการประชุม',
  `budget_type_id` int(5) NOT NULL COMMENT 'คีย์ของประเภทงบประมาณ',
  `user_id` int(5) NOT NULL COMMENT 'คีย์ของผู้ใช้',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'วัน เวลาที่บันทึกการจองห้องประชุม',
  `updated` timestamp NULL DEFAULT NULL COMMENT 'วัน เวลาที่แก้ไขการจองห้องประชุม'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`booking_id`, `meeting_room_id`, `meeting_type_id`, `start_date`, `end_date`, `start_time`, `end_time`, `meeting_topic`, `meeting_number`, `meeting_detail`, `booking_status_id`, `department_id`, `meeting_table_type_id`, `meeting_required_id`, `budget_type_id`, `user_id`, `created`, `updated`) VALUES
(1, 1, 1, '2016-11-01', '2016-11-01', '08:00:00', '11:00:00', 'ประชุมเรื่องการผลิตสินค้า', 7, 'ประชุมเรื่องการผลิตสินค้าให้เป็นไปตามมาตรฐาน', 1, 6, 1, 4, 1, 1, '2017-01-29 16:07:04', '2017-01-29 16:26:50'),
(2, 3, 2, '2016-11-03', '2016-11-03', '09:00:00', '15:00:00', 'อบรมพนักงานใหม่', 40, 'จัดอบรมให้กับพนักงานฝ่ายผลิตที่สมัครเข้าทำงานใหม่', 3, 3, 4, 8, 3, 1, '2017-01-29 16:10:28', '2017-01-29 16:30:58'),
(3, 3, 3, '2016-11-03', '2016-11-03', '09:00:00', '12:00:00', 'สัมมนาเรื่องการบริหารการใช้ทรัพยาการ', 10, 'สัมมนาเรื่องการบริหารการใช้ทรัพยาการให้เกิดประโยชน์สูงสุด', 2, 5, 6, 1, 1, 1, '2017-01-29 16:14:35', '2017-01-29 16:19:01'),
(4, 4, 1, '2016-11-04', '2016-11-04', '10:00:00', '12:00:00', 'ประชุมหัวหน้าแต่ละฝ่ายประจำเดือน พ.ย. 2559', 17, 'ประชุมหัวหน้าแต่ละฝ่ายประจำเดือน พ.ย. 2559', 4, 3, 2, 1, 3, 1, '2017-01-29 16:18:22', '2017-01-29 16:32:06'),
(5, 5, 1, '2017-01-30', '2017-01-31', '14:00:00', '15:00:00', 'ประชุมพนักงานฝ่ายบุคคล', 8, 'ประชุมพนักงานฝ่ายบุคคล', 5, 3, 1, 1, 1, 1, '2017-01-29 16:24:43', '2017-01-30 09:13:40');

-- --------------------------------------------------------

--
-- Table structure for table `booking_equipment`
--

CREATE TABLE `booking_equipment` (
  `booking_equipment_id` int(5) NOT NULL COMMENT 'คีย์ของการจองอุปกรณ์ที่ใช้ในการประชุม',
  `booking_id` int(5) NOT NULL COMMENT 'คีย์ของการจองห้องประชุม',
  `equipment_id` int(5) NOT NULL COMMENT 'คีย์ของอุปกรณ์ที่ใช้ในการประชุม'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `booking_equipment`
--

INSERT INTO `booking_equipment` (`booking_equipment_id`, `booking_id`, `equipment_id`) VALUES
(1, 1, 1),
(2, 1, 3),
(3, 1, 5),
(4, 1, 9),
(5, 2, 1),
(6, 2, 3),
(7, 2, 6),
(8, 2, 9),
(9, 3, 1),
(10, 3, 3),
(11, 3, 5),
(12, 3, 7),
(13, 3, 8),
(14, 4, 1),
(15, 4, 3),
(16, 4, 5),
(17, 4, 7),
(18, 4, 9),
(19, 5, 1),
(20, 5, 3),
(21, 5, 5);

-- --------------------------------------------------------

--
-- Table structure for table `booking_status`
--

CREATE TABLE `booking_status` (
  `booking_status_id` int(5) NOT NULL COMMENT 'คีย์ของสถานะการจองห้องประชุม',
  `booking_status_code` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'รหัสสถานะการจองห้องประชุม',
  `booking_status_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'สถานะการจองห้องประชุม'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `booking_status`
--

INSERT INTO `booking_status` (`booking_status_id`, `booking_status_code`, `booking_status_name`) VALUES
(1, 'approve', 'อนุมัติ'),
(2, 'waitapprove', 'รออนุมัติ'),
(3, 'cancel', 'ยกเลิก'),
(4, 'waitcancel', 'รอยกเลิก'),
(5, 'notapprove', 'ไม่อนุมัติ');

-- --------------------------------------------------------

--
-- Table structure for table `budget_type`
--

CREATE TABLE `budget_type` (
  `budget_type_id` int(5) NOT NULL COMMENT 'คีย์ของประเภทงบประมาณ',
  `budget_type_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ประเภทงบประมาณ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `budget_type`
--

INSERT INTO `budget_type` (`budget_type_id`, `budget_type_name`) VALUES
(1, 'เงินบำรุง'),
(2, 'เงินสวัสดิการ'),
(3, 'เงินโครงการ'),
(4, 'เงินผู้จัด');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `department_id` int(5) NOT NULL COMMENT 'คีย์ของหน่วยงาน',
  `department_code` varchar(2) COLLATE utf8_unicode_ci NOT NULL COMMENT 'รหัสหน่วยงาน',
  `department_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ชื่อหน่วยงาน'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`department_id`, `department_code`, `department_name`) VALUES
(1, '01', 'Accounting'),
(2, '02', 'Finance'),
(3, '03', 'Humanresource'),
(4, '04', 'Information technology'),
(5, '05', 'Quality Control'),
(6, '06', 'Production'),
(7, '07', 'Customer Service'),
(8, '08', 'Procurement Electric'),
(9, '09', 'Mantennce'),
(10, '10', 'Store'),
(11, '11', 'Warehouse'),
(12, '12', 'Document Control'),
(13, '13', 'Technical'),
(14, '14', 'Weight scale'),
(15, '15', 'Biogas'),
(16, '16', 'Power pant');

-- --------------------------------------------------------

--
-- Table structure for table `equipment`
--

CREATE TABLE `equipment` (
  `equipment_id` int(5) NOT NULL COMMENT 'คีย์ของอุปกรณ์ที่ใช้ในการประชุม',
  `equipment_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'อุปกรณ์ที่ใช้ในการประชุม'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `equipment`
--

INSERT INTO `equipment` (`equipment_id`, `equipment_name`) VALUES
(1, 'คอมพิวเตอร์ Notebook'),
(2, 'เครื่องฉายแผ่นทึบ Visualizer'),
(3, 'เครื่องฉาย LCD Projecter'),
(4, 'โทรทัศน์สี LED TV'),
(5, 'ไมโครโฟนแบบตั้งโต๊ะ'),
(6, 'ไมโครโฟนแบบไร้สาย'),
(7, 'เครื่องบันทึกเสียง'),
(8, 'กล้องบันทึกวีดีโอ'),
(9, 'กล้องถ่ายภาพ');

-- --------------------------------------------------------

--
-- Table structure for table `meeting_required`
--

CREATE TABLE `meeting_required` (
  `meeting_required_id` int(5) NOT NULL COMMENT 'คีย์ของสิ่งที่ต้องการในการประชุม',
  `meeting_required_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL COMMENT 'สิ่งที่ต้องการในการประชุม'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `meeting_required`
--

INSERT INTO `meeting_required` (`meeting_required_id`, `meeting_required_name`) VALUES
(0, ''),
(1, 'จัดเครื่องดื่ม(น้ำเปล่า) 1 รอบเบรค'),
(2, 'จัดเครื่องดื่ม(น้ำเปล่า) 2 รอบเบรค'),
(3, 'จัดเครื่องดื่ม(น้ำเปล่า) 3 รอบเบรค'),
(4, 'จัดเครื่องดื่มพร้อมอาหารว่าง 1 รอบเบรค'),
(5, 'จัดเครื่องดื่มพร้อมอาหารว่าง 2 รอบเบรค'),
(6, 'จัดเครื่องดื่มพร้อมอาหารว่าง 3 รอบเบรค'),
(7, 'จัดเครื่องดื่มพร้อมอาหารว่าง 1 รอบเบรค และข้าวมื้อกลางวัน'),
(8, 'จัดเครื่องดื่มพร้อมอาหารว่าง 2 รอบเบรค และข้าวมื้อกลางวัน'),
(9, 'จัดเครื่องดื่มพร้อมอาหารว่าง 3 รอบเบรค และข้าวมื้อกลางวัน');

-- --------------------------------------------------------

--
-- Table structure for table `meeting_room`
--

CREATE TABLE `meeting_room` (
  `meeting_room_id` int(5) NOT NULL COMMENT 'คีย์ของห้องประชุม',
  `meeting_room_code` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'รหัสของห้องประชุม',
  `meeting_room_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ชื่อห้องประชุม',
  `meeting_room_size` int(10) NOT NULL COMMENT 'จำนวนที่นั่ง',
  `meeting_room_location` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'สถานที่ตั้ง',
  `meeting_room_detail` longtext COLLATE utf8_unicode_ci COMMENT 'รายละเอียดห้องประชุม',
  `meeting_room_supervise` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'ผู้ดูแลห้องประชุม',
  `meeting_room_phone` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'เบอร์ผู้ดูแลห้องประชุม',
  `meeting_room_img` varchar(2083) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ชื่อไฟล์รูปห้องประชุม'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `meeting_room`
--

INSERT INTO `meeting_room` (`meeting_room_id`, `meeting_room_code`, `meeting_room_name`, `meeting_room_size`, `meeting_room_location`, `meeting_room_detail`, `meeting_room_supervise`, `meeting_room_phone`, `meeting_room_img`) VALUES
(1, '101', 'ห้องประชุมใหม่เอี่ยมเฮง', 40, 'อาคาร 1 ชั้น 2', 'สำหรับประชุมเรื่องทั่วไป', NULL, NULL, 'meeting-room-1.jpg'),
(2, '201', 'ห้องประชุมโมดิฟาย', 40, 'อาคาร 1 ชั้น 3', 'สำหรับประชุมเรื่องทั่วไป', NULL, NULL, 'meeting-room-2.jpg'),
(3, '102', 'ห้องประชุมสุดาวรรณ', 20, 'อาคาร 1 ชั้น 1', 'สำหรับประชุมหัวหน้าแผนก', NULL, NULL, 'meeting-room-3.jpg'),
(4, '103', 'ห้องประชุมอู่เงินอู่ทอง', 40, 'อาคาร 1 ชั้น 3', 'สำหรับประชุมเรื่องทั่วไป', NULL, NULL, 'meeting-room-4.jpg'),
(5, '104', 'ห้องประชุมฝ่ายบุคคล', 20, 'อาคาร 1 ชั้น 1', 'สำหรับประชุมฝ่าย', NULL, NULL, 'meeting-room-5.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `meeting_table_type`
--

CREATE TABLE `meeting_table_type` (
  `meeting_table_type_id` int(5) NOT NULL COMMENT 'คีย์ของรูปแบบการจัดโต๊ะห้องประชุม',
  `meeting_table_type_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'รูปแบบการจัดโต๊ะห้องประชุม'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `meeting_table_type`
--

INSERT INTO `meeting_table_type` (`meeting_table_type_id`, `meeting_table_type_name`) VALUES
(0, ''),
(1, 'แบบ U shape (จัดแบบตัว U)'),
(2, 'แบบ Boardroom (จัดแบบประชุมคณะกรรมการ)'),
(3, 'แบบ Clusters (จัดแบบกลุ่ม/หมู่คณะ)'),
(4, 'แบบ Classroom (จัดแบบห้องเรียน)'),
(5, 'แบบ Theater (จัดแบบโรงละคร)'),
(6, 'แบบ Circle of chairs (จัดแบบเก้าอี้วงกลม)');

-- --------------------------------------------------------

--
-- Table structure for table `meeting_type`
--

CREATE TABLE `meeting_type` (
  `meeting_type_id` int(5) NOT NULL COMMENT 'คีย์ของประเภทการประชุม',
  `meeting_type_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ประเภทการประชุม'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `meeting_type`
--

INSERT INTO `meeting_type` (`meeting_type_id`, `meeting_type_name`) VALUES
(1, 'ประชุม'),
(2, 'อบรม'),
(3, 'สัมมนา'),
(4, 'ศึกษาดูงาน');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `menu_id` int(5) NOT NULL COMMENT 'คีย์ของเมนูหลัก',
  `menu_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ชื่อเมนูหลัก'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`menu_id`, `menu_name`) VALUES
(1, 'รายการจองห้องประชุม'),
(2, 'เกี่ยวกับห้องประชุม'),
(3, 'ผู้ใช้ระบบ');

-- --------------------------------------------------------

--
-- Table structure for table `menu_sub`
--

CREATE TABLE `menu_sub` (
  `menu_sub_id` int(5) NOT NULL COMMENT 'คีย์ของเมนูย่อย',
  `menu_sub_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ชื่อเมนูย่อย',
  `menu_id` int(5) NOT NULL COMMENT 'คีย์ของเมนูหลัก'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `menu_sub`
--

INSERT INTO `menu_sub` (`menu_sub_id`, `menu_sub_name`, `menu_id`) VALUES
(1, 'ปฏิทินการใช้ห้องประชุม', 1),
(2, 'จองห้องประชุม', 1),
(3, 'ยกเลิกการจอง', 1),
(4, 'ค้นหาข้อมูลการจอง', 1),
(5, 'จัดการสถานะการจอง', 1),
(6, 'รายละเอียดห้องประชุม', 2),
(7, 'คำแนะนำการใช้งานระบบ', 2),
(8, 'เข้าสู่ระบบ', 3),
(9, 'สมัครสมาชิก', 3),
(10, 'ข้อมูลส่วนตัว', 3),
(11, 'ตั้งค่าสิทธิ์การใช้งาน', 3);

-- --------------------------------------------------------

--
-- Table structure for table `permission`
--

CREATE TABLE `permission` (
  `permission_id` int(5) NOT NULL COMMENT 'คีย์ของสิทธิ์การใช้งาน',
  `user_id` int(5) NOT NULL COMMENT 'คีย์ของผู้ใช้',
  `menu_id` int(5) NOT NULL COMMENT 'คีย์ของเมนูหลัก',
  `menu_sub_id` int(5) NOT NULL COMMENT 'คีย์ของเมนูย่อย',
  `permission_status_id` int(5) NOT NULL COMMENT 'คีย์ของสถานะสิทธิ์การใช้งาน',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'วัน เวลาที่ตั้งค่าสิทธ์การใช้งาน',
  `updated` timestamp NULL DEFAULT NULL COMMENT 'วัน เวลาที่แก้ไขสิทธ์การใช้งาน'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `permission`
--

INSERT INTO `permission` (`permission_id`, `user_id`, `menu_id`, `menu_sub_id`, `permission_status_id`, `created`, `updated`) VALUES
(1, 1, 1, 1, 4, '2017-01-25 16:49:44', NULL),
(2, 1, 1, 2, 4, '2017-01-25 16:49:44', NULL),
(3, 1, 1, 3, 4, '2017-01-25 16:49:44', NULL),
(4, 1, 1, 4, 4, '2017-01-25 16:49:44', NULL),
(5, 1, 1, 5, 4, '2017-01-25 16:49:44', NULL),
(6, 1, 2, 6, 4, '2017-01-25 16:49:44', NULL),
(7, 1, 2, 7, 4, '2017-01-25 16:49:44', NULL),
(8, 1, 3, 8, 4, '2017-01-25 16:49:44', NULL),
(9, 1, 3, 9, 4, '2017-01-25 16:49:44', NULL),
(10, 1, 3, 10, 4, '2017-01-25 16:49:44', NULL),
(11, 1, 3, 11, 4, '2017-01-25 16:49:44', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `permission_status`
--

CREATE TABLE `permission_status` (
  `permission_status_id` int(5) NOT NULL COMMENT 'คีย์ของสถานะสิทธิ์การใช้งาน',
  `permission_status_code` varchar(5) COLLATE utf8_unicode_ci NOT NULL COMMENT 'รหัสแทนสถานะสิทธิ์การใช้งาน',
  `permission_status_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ชื่อสถานะสิทธิ์การใช้งาน'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `permission_status`
--

INSERT INTO `permission_status` (`permission_status_id`, `permission_status_code`, `permission_status_name`) VALUES
(1, 'DN', 'ไม่ให้สิทธิ์'),
(2, 'R', 'อ่านได้อย่างเดียว'),
(3, 'R/W', 'อ่านและแก้ไขได้'),
(4, 'ADMIN', 'ให้สิทธิ์เป็นผู้ดูแลระบบ');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(5) NOT NULL COMMENT 'คีย์ของผู้ใช้',
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'อีเมล์ของผู้ใช้',
  `password` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'รหัสผ่านของผู้ใช้',
  `firstname` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ชื่อของผู้ใช้',
  `lastname` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'นามสกุลของผู้ใช้',
  `position` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'ตำแหน่งของผู้ใช้',
  `phone` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'เบอร์โทรศัพท์',
  `local_phone` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'เบอร์ติดต่อภายในหน่วยงาน',
  `department_id` int(5) NOT NULL COMMENT 'คีย์ของหน่วยงาน',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'วัน เวลาที่สมัครบัญชีผู้ใช้',
  `updated` timestamp NULL DEFAULT NULL COMMENT 'วัน เวลาที่แก้ไขบัญชีผู้ใช้'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `email`, `password`, `firstname`, `lastname`, `position`, `phone`, `local_phone`, `department_id`, `created`, `updated`) VALUES
(1, 'admin@admin.com', 'admin', 'Admin', 'Admin', 'Admin', '0970125090', '044-000-000', 13, '2017-01-25 16:49:43', '2017-02-03 04:25:07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `meeting_room_id` (`meeting_room_id`),
  ADD KEY `meeting_type_id` (`meeting_type_id`),
  ADD KEY `booking_status_id` (`booking_status_id`),
  ADD KEY `department_id` (`department_id`),
  ADD KEY `meeting_table_type_id` (`meeting_table_type_id`),
  ADD KEY `meeting_required_id` (`meeting_required_id`),
  ADD KEY `budget_type_id` (`budget_type_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `booking_equipment`
--
ALTER TABLE `booking_equipment`
  ADD PRIMARY KEY (`booking_equipment_id`),
  ADD KEY `booking_id` (`booking_id`),
  ADD KEY `equipment_id` (`equipment_id`);

--
-- Indexes for table `booking_status`
--
ALTER TABLE `booking_status`
  ADD PRIMARY KEY (`booking_status_id`);

--
-- Indexes for table `budget_type`
--
ALTER TABLE `budget_type`
  ADD PRIMARY KEY (`budget_type_id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`department_id`);

--
-- Indexes for table `equipment`
--
ALTER TABLE `equipment`
  ADD PRIMARY KEY (`equipment_id`);

--
-- Indexes for table `meeting_required`
--
ALTER TABLE `meeting_required`
  ADD PRIMARY KEY (`meeting_required_id`);

--
-- Indexes for table `meeting_room`
--
ALTER TABLE `meeting_room`
  ADD PRIMARY KEY (`meeting_room_id`);

--
-- Indexes for table `meeting_table_type`
--
ALTER TABLE `meeting_table_type`
  ADD PRIMARY KEY (`meeting_table_type_id`);

--
-- Indexes for table `meeting_type`
--
ALTER TABLE `meeting_type`
  ADD PRIMARY KEY (`meeting_type_id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`menu_id`);

--
-- Indexes for table `menu_sub`
--
ALTER TABLE `menu_sub`
  ADD PRIMARY KEY (`menu_sub_id`),
  ADD KEY `menu_id` (`menu_id`);

--
-- Indexes for table `permission`
--
ALTER TABLE `permission`
  ADD PRIMARY KEY (`permission_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `menu_id` (`menu_id`),
  ADD KEY `menu_sub_id` (`menu_sub_id`),
  ADD KEY `permission_status_id` (`permission_status_id`);

--
-- Indexes for table `permission_status`
--
ALTER TABLE `permission_status`
  ADD PRIMARY KEY (`permission_status_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `department_id` (`department_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `booking_id` int(5) NOT NULL AUTO_INCREMENT COMMENT 'คีย์ของการจองห้องประชุม', AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `booking_equipment`
--
ALTER TABLE `booking_equipment`
  MODIFY `booking_equipment_id` int(5) NOT NULL AUTO_INCREMENT COMMENT 'คีย์ของการจองอุปกรณ์ที่ใช้ในการประชุม', AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `booking_status`
--
ALTER TABLE `booking_status`
  MODIFY `booking_status_id` int(5) NOT NULL AUTO_INCREMENT COMMENT 'คีย์ของสถานะการจองห้องประชุม', AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `budget_type`
--
ALTER TABLE `budget_type`
  MODIFY `budget_type_id` int(5) NOT NULL AUTO_INCREMENT COMMENT 'คีย์ของประเภทงบประมาณ', AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `department_id` int(5) NOT NULL AUTO_INCREMENT COMMENT 'คีย์ของหน่วยงาน', AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `equipment`
--
ALTER TABLE `equipment`
  MODIFY `equipment_id` int(5) NOT NULL AUTO_INCREMENT COMMENT 'คีย์ของอุปกรณ์ที่ใช้ในการประชุม', AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `meeting_required`
--
ALTER TABLE `meeting_required`
  MODIFY `meeting_required_id` int(5) NOT NULL AUTO_INCREMENT COMMENT 'คีย์ของสิ่งที่ต้องการในการประชุม', AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `meeting_room`
--
ALTER TABLE `meeting_room`
  MODIFY `meeting_room_id` int(5) NOT NULL AUTO_INCREMENT COMMENT 'คีย์ของห้องประชุม', AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `meeting_table_type`
--
ALTER TABLE `meeting_table_type`
  MODIFY `meeting_table_type_id` int(5) NOT NULL AUTO_INCREMENT COMMENT 'คีย์ของรูปแบบการจัดโต๊ะห้องประชุม', AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `meeting_type`
--
ALTER TABLE `meeting_type`
  MODIFY `meeting_type_id` int(5) NOT NULL AUTO_INCREMENT COMMENT 'คีย์ของประเภทการประชุม', AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `menu_id` int(5) NOT NULL AUTO_INCREMENT COMMENT 'คีย์ของเมนูหลัก', AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `menu_sub`
--
ALTER TABLE `menu_sub`
  MODIFY `menu_sub_id` int(5) NOT NULL AUTO_INCREMENT COMMENT 'คีย์ของเมนูย่อย', AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `permission`
--
ALTER TABLE `permission`
  MODIFY `permission_id` int(5) NOT NULL AUTO_INCREMENT COMMENT 'คีย์ของสิทธิ์การใช้งาน', AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `permission_status`
--
ALTER TABLE `permission_status`
  MODIFY `permission_status_id` int(5) NOT NULL AUTO_INCREMENT COMMENT 'คีย์ของสถานะสิทธิ์การใช้งาน', AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(5) NOT NULL AUTO_INCREMENT COMMENT 'คีย์ของผู้ใช้', AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`meeting_room_id`) REFERENCES `meeting_room` (`meeting_room_id`),
  ADD CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`meeting_type_id`) REFERENCES `meeting_type` (`meeting_type_id`),
  ADD CONSTRAINT `booking_ibfk_3` FOREIGN KEY (`booking_status_id`) REFERENCES `booking_status` (`booking_status_id`),
  ADD CONSTRAINT `booking_ibfk_4` FOREIGN KEY (`department_id`) REFERENCES `department` (`department_id`),
  ADD CONSTRAINT `booking_ibfk_5` FOREIGN KEY (`meeting_table_type_id`) REFERENCES `meeting_table_type` (`meeting_table_type_id`),
  ADD CONSTRAINT `booking_ibfk_6` FOREIGN KEY (`meeting_required_id`) REFERENCES `meeting_required` (`meeting_required_id`),
  ADD CONSTRAINT `booking_ibfk_7` FOREIGN KEY (`budget_type_id`) REFERENCES `budget_type` (`budget_type_id`),
  ADD CONSTRAINT `booking_ibfk_8` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `booking_equipment`
--
ALTER TABLE `booking_equipment`
  ADD CONSTRAINT `booking_equipment_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `booking` (`booking_id`),
  ADD CONSTRAINT `booking_equipment_ibfk_2` FOREIGN KEY (`equipment_id`) REFERENCES `equipment` (`equipment_id`);

--
-- Constraints for table `menu_sub`
--
ALTER TABLE `menu_sub`
  ADD CONSTRAINT `menu_sub_ibfk_1` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`menu_id`);

--
-- Constraints for table `permission`
--
ALTER TABLE `permission`
  ADD CONSTRAINT `permission_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `permission_ibfk_2` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`menu_id`),
  ADD CONSTRAINT `permission_ibfk_3` FOREIGN KEY (`menu_sub_id`) REFERENCES `menu_sub` (`menu_sub_id`),
  ADD CONSTRAINT `permission_ibfk_4` FOREIGN KEY (`permission_status_id`) REFERENCES `permission_status` (`permission_status_id`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `department` (`department_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
