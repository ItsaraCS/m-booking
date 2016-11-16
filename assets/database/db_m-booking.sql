-- --------------------------------------------------
-- Database name: m_booking
-- --------------------------------------------------
CREATE DATABASE IF NOT EXISTS m_booking
CHARACTER SET=utf8
COLLATE utf8_unicode_ci;

USE m_booking;

-- --------------------------------------------------
-- Table structure for: menu
-- --------------------------------------------------
CREATE TABLE IF NOT EXISTS menu(
	menu_id INT(5) NOT NULL AUTO_INCREMENT COMMENT 'คีย์ของเมนูหลัก',
	menu_name VARCHAR(50) NOT NULL COMMENT 'ชื่อเมนูหลัก',
	PRIMARY KEY (menu_id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO menu(menu_id, menu_name) VALUES
('1', 'รายการจองห้องประชุม'),
('2', 'เกี่ยวกับห้องประชุม'),
('3', 'ผู้ใช้ระบบ');

-- --------------------------------------------------
-- Table structure for: menu_sub
-- --------------------------------------------------
CREATE TABLE IF NOT EXISTS menu_sub(
	menu_sub_id INT(5) NOT NULL AUTO_INCREMENT COMMENT 'คีย์ของเมนูย่อย',
	menu_sub_name VARCHAR(50) NOT NULL COMMENT 'ชื่อเมนูย่อย',
	menu_id INT(5) NOT NULL COMMENT 'คีย์ของเมนูหลัก',
	PRIMARY KEY (menu_sub_id),
	FOREIGN KEY (menu_id) REFERENCES menu(menu_id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO menu_sub(menu_sub_id, menu_sub_name, menu_id) VALUES
('1', 'ปฏิทินการใช้ห้องประชุม', '1'),
('2', 'จองห้องประชุม', '1'),
('3', 'ยกเลิกการจอง', '1'),
('4', 'ค้นหาข้อมูลการจอง', '1'),
('5', 'จัดการสถานะการจอง', '1'),
('6', 'รายละเอียดห้องประชุม', '2'),
('7', 'คำแนะนำการใช้งานระบบ', '2'),
('8', 'เข้าสู่ระบบ', '3'),
('9', 'สมัครสมาชิก', '3'),
('10', 'ข้อมูลส่วนตัว', '3'),
('11', 'ตั้งค่าสิทธิ์การใช้งาน', '3');

-- --------------------------------------------------
-- Table structure for: permission_status
-- --------------------------------------------------
CREATE TABLE IF NOT EXISTS permission_status(
	permission_status_id INT(5) NOT NULL AUTO_INCREMENT COMMENT 'คีย์ของสถานะสิทธิ์การใช้งาน',
	permission_status_code VARCHAR(5) NOT NULL COMMENT 'รหัสแทนสถานะสิทธิ์การใช้งาน',
	permission_status_name VARCHAR(50) NOT NULL COMMENT 'ชื่อสถานะสิทธิ์การใช้งาน',
	PRIMARY KEY (permission_status_id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO permission_status(permission_status_id, permission_status_code, permission_status_name) VALUES
('1', 'DN', 'ไม่ให้สิทธิ์'),
('2', 'R', 'อ่านได้อย่างเดียว'),
('3', 'R/W', 'อ่านและแก้ไขได้'),
('4', 'ADMIN', 'ให้สิทธิ์เป็นผู้ดูแลระบบ');

-- --------------------------------------------------
-- Table structure for: department
-- --------------------------------------------------
CREATE TABLE IF NOT EXISTS department(
	department_id INT(5) NOT NULL AUTO_INCREMENT COMMENT 'คีย์ของหน่วยงาน',
	department_code VARCHAR(2) NOT NULL COMMENT 'รหัสหน่วยงาน',
	department_name VARCHAR(50) NOT NULL COMMENT 'ชื่อหน่วยงาน',
	PRIMARY KEY (department_id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO department(department_id, department_code, department_name) VALUES
('1', '01', 'Accounting'),
('2', '02', 'Finance'),
('3', '03', 'Humanresource'),
('4', '04', 'Information technology'),
('5', '05', 'Quality Control'),
('6', '06', 'Production'),
('7', '07', 'Customer Service'),
('8', '08', 'Procurement Electric'),
('9', '09', 'Mantennce'),
('10', '10', 'Store'),
('11', '11', 'Warehouse'),
('12', '12', 'Document Control'),
('13', '13', 'Technical'),
('14', '14', 'Weight scale'),
('15', '15', 'Biogas'),
('16', '16', 'Power pant');

-- --------------------------------------------------
-- Table structure for: user
-- --------------------------------------------------
CREATE TABLE IF NOT EXISTS user(
	user_id INT(5) NOT NULL AUTO_INCREMENT COMMENT 'คีย์ของผู้ใช้',
	email VARCHAR(50) NOT NULL COMMENT 'อีเมล์ของผู้ใช้',
	password VARCHAR(50) NOT NULL COMMENT 'รหัสผ่านของผู้ใช้',
	firstname VARCHAR(50) NOT NULL COMMENT 'ชื่อของผู้ใช้',
	lastname VARCHAR(50) NOT NULL COMMENT 'นามสกุลของผู้ใช้',
	position VARCHAR(50) NULL COMMENT 'ตำแหน่งของผู้ใช้',
	phone VARCHAR(50) NULL COMMENT 'เบอร์โทรศัพท์',
	local_phone VARCHAR(50) NOT NULL COMMENT 'เบอร์ติดต่อภายในหน่วยงาน',
	department_id INT(5) NOT NULL COMMENT 'คีย์ของหน่วยงาน',
	created TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'วัน เวลาที่สมัครบัญชีผู้ใช้',
	updated TIMESTAMP NULL COMMENT 'วัน เวลาที่แก้ไขบัญชีผู้ใช้',
	PRIMARY KEY (user_id),
	FOREIGN KEY (department_id) REFERENCES department(department_id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO user(user_id, email, password, firstname, lastname, position, phone, local_phone, department_id) VALUES
('1', 'aa@aa', 'aa', 'Admin', 'Admin', 'Admin', '011111111', '044-000-000', '1');

-- --------------------------------------------------
-- Table structure for: permission
-- --------------------------------------------------
CREATE TABLE IF NOT EXISTS permission(
	permission_id INT(5) NOT NULL AUTO_INCREMENT COMMENT 'คีย์ของสิทธิ์การใช้งาน',
	user_id INT(5) NOT NULL COMMENT 'คีย์ของผู้ใช้',
	menu_id INT(5) NOT NULL COMMENT 'คีย์ของเมนูหลัก',
	menu_sub_id INT(5) NOT NULL COMMENT 'คีย์ของเมนูย่อย',
	permission_status_id INT(5) NOT NULL COMMENT 'คีย์ของสถานะสิทธิ์การใช้งาน',
	created TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'วัน เวลาที่ตั้งค่าสิทธ์การใช้งาน',
	updated TIMESTAMP NULL COMMENT 'วัน เวลาที่แก้ไขสิทธ์การใช้งาน',
	PRIMARY KEY (permission_id),
	FOREIGN KEY (user_id) REFERENCES user(user_id),
	FOREIGN KEY (menu_id) REFERENCES menu(menu_id),
	FOREIGN KEY (menu_sub_id) REFERENCES menu_sub(menu_sub_id),
	FOREIGN KEY (permission_status_id) REFERENCES permission_status(permission_status_id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO permission(permission_id, user_id, menu_id, menu_sub_id, permission_status_id) VALUES
('1', '1', '1', '1', '4'),
('2', '1', '1', '2', '4'),
('3', '1', '1', '3', '4'),
('4', '1', '1', '4', '4'),
('5', '1', '1', '5', '4'),
('6', '1', '2', '6', '4'),
('7', '1', '2', '7', '4'),
('8', '1', '3', '8', '4'),
('9', '1', '3', '9', '4'),
('10', '1', '3', '10', '4'),
('11', '1', '3', '11', '4');

-- --------------------------------------------------
-- Table structure for: meeting_room
-- --------------------------------------------------
CREATE TABLE IF NOT EXISTS meeting_room(
	meeting_room_id INT(5) NOT NULL AUTO_INCREMENT COMMENT 'คีย์ของห้องประชุม',
	meeting_room_code VARCHAR(3) NULL COMMENT 'รหัสของห้องประชุม',
	meeting_room_name VARCHAR(50) NOT NULL COMMENT 'ชื่อห้องประชุม',
	meeting_room_size INT(10) NOT NULL COMMENT 'จำนวนที่นั่ง',
	meeting_room_location VARCHAR(255) NOT NULL COMMENT 'สถานที่ตั้ง',
	meeting_room_detail LONGTEXT NULL COMMENT 'รายละเอียดห้องประชุม',
	meeting_room_supervise VARCHAR(255) NULL COMMENT 'ผู้ดูแลห้องประชุม',
	meeting_room_phone VARCHAR(50) NULL COMMENT 'เบอร์ผู้ดูแลห้องประชุม',
	PRIMARY KEY (meeting_room_id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO meeting_room(meeting_room_id, meeting_room_code, meeting_room_name) VALUES
('1', '101', 'ห้องประชุมใหม่เอี่ยมเฮง'),
('2', '201', 'ห้องประชุมโมดิฟาย'),
('3', '102', 'ห้องประชุมสุดาวรรณ'),
('4', '103', 'ห้องประชุมอู่เงินอู่ทอง'),
('5', '104', 'ห้องประชุมฝ่ายบุคคล');

-- --------------------------------------------------
-- Table structure for: meeting_type
-- --------------------------------------------------
CREATE TABLE IF NOT EXISTS meeting_type(
	meeting_type_id INT(5) NOT NULL AUTO_INCREMENT COMMENT 'คีย์ของประเภทการประชุม',
	meeting_type_name VARCHAR(50) NOT NULL COMMENT 'ประเภทการประชุม',
	PRIMARY KEY (meeting_type_id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO meeting_type(meeting_type_id, meeting_type_name) VALUES
('1', 'ประชุม'),
('2', 'อบรม'),
('3', 'สัมมนา'),
('4', 'คณะศึกษาดูงาน');

-- --------------------------------------------------
-- Table structure for: meeting_table_type
-- --------------------------------------------------
CREATE TABLE IF NOT EXISTS meeting_table_type(
	meeting_table_type_id INT(5) NOT NULL AUTO_INCREMENT COMMENT 'คีย์ของรูปแบบการจัดโต๊ะห้องประชุม',
	meeting_table_type_name VARCHAR(50) NOT NULL COMMENT 'รูปแบบการจัดโต๊ะห้องประชุม',
	PRIMARY KEY (meeting_table_type_id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO meeting_table_type(meeting_table_type_id, meeting_table_type_name) VALUES
('1', 'แบบ U shape (จัดแบบตัว U)'),
('2', 'แบบ Boardroom (จัดแบบประชุมคณะกรรมการ)'),
('3', 'แบบ Clusters (จัดแบบกลุ่ม/หมู่คณะ)'),
('4', 'แบบ Classroom (จัดแบบห้องเรียน)'),
('5', 'แบบ Theater (จัดแบบโรงละคร)'),
('6', 'แบบ Circle of chairs (จัดแบบเก้าอี้วงกลม)');

-- --------------------------------------------------
-- Table structure for: budget_type
-- --------------------------------------------------
CREATE TABLE IF NOT EXISTS budget_type(
	budget_type_id INT(5) NOT NULL AUTO_INCREMENT COMMENT 'คีย์ของประเภทงบประมาณ',
	budget_type_name VARCHAR(50) NOT NULL COMMENT 'ประเภทงบประมาณ',
	PRIMARY KEY (budget_type_id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO budget_type(budget_type_id, budget_type_name) VALUES
('1', 'เงินบำรุง'),
('2', 'เงินสวัสดิการ'),
('3', 'เงินโครงการ'),
('4', 'เงินผู้จัด');

-- --------------------------------------------------
-- Table structure for: meeting_required
-- --------------------------------------------------
CREATE TABLE IF NOT EXISTS meeting_required(
	meeting_required_id INT(5) NOT NULL AUTO_INCREMENT COMMENT 'คีย์ของสิ่งที่ต้องการในการประชุม',
	meeting_required_name VARCHAR(50) NOT NULL COMMENT 'สิ่งที่ต้องการในการประชุม',
	PRIMARY KEY (meeting_required_id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO meeting_required(meeting_required_id, meeting_required_name) VALUES
('1', 'จัดเครื่องดื่ม(น้ำเปล่า) 1 รอบเบรค'),
('2', 'จัดเครื่องดื่ม(น้ำเปล่า) 2 รอบเบรค'),
('3', 'จัดเครื่องดื่ม(น้ำเปล่า) 3 รอบเบรค'),
('4', 'จัดเครื่องดื่มพร้อมอาหารว่าง 1 รอบเบรค'),
('5', 'จัดเครื่องดื่มพร้อมอาหารว่าง 2 รอบเบรค'),
('6', 'จัดเครื่องดื่มพร้อมอาหารว่าง 3 รอบเบรค'),
('7', 'จัดเครื่องดื่มพร้อมอาหารว่าง 1 รอบเบรค และข้าวมื้อกลางวัน'),
('8', 'จัดเครื่องดื่มพร้อมอาหารว่าง 2 รอบเบรค และข้าวมื้อกลางวัน'),
('9', 'จัดเครื่องดื่มพร้อมอาหารว่าง 3 รอบเบรค และข้าวมื้อกลางวัน');

-- --------------------------------------------------
-- Table structure for: equipment
-- --------------------------------------------------
CREATE TABLE IF NOT EXISTS equipment(
	equipment_id INT(5) NOT NULL AUTO_INCREMENT COMMENT 'คีย์ของอุปกรณ์ที่ใช้ในการประชุม',
	equipment_name VARCHAR(50) NOT NULL COMMENT 'อุปกรณ์ที่ใช้ในการประชุม',
	PRIMARY KEY (equipment_id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO equipment(equipment_id, equipment_name) VALUES
('1', 'คอมพิวเตอร์ Notebook'),
('2', 'เครื่องฉายแผ่นทึบ Visualizer'),
('3', 'เครื่องฉาย LCD Projecter'),
('4', 'โทรทัศน์สี LED TV'),
('5', 'ไมโครโฟนแบบตั้งโต๊ะ'),
('6', 'ไมโครโฟนแบบไร้สาย'),
('7', 'เครื่องบันทึกเสียง'),
('8', 'กล้องบันทึกวีดีโอ'),
('9', 'กล้องถ่ายภาพ');

-- --------------------------------------------------
-- Table structure for: booking_status
-- --------------------------------------------------
CREATE TABLE IF NOT EXISTS booking_status(
	booking_status_id INT(5) NOT NULL AUTO_INCREMENT COMMENT 'คีย์ของสถานะการจองห้องประชุม',
	booking_status_code VARCHAR(50) NOT NULL COMMENT 'รหัสสถานะการจองห้องประชุม',
	booking_status_name VARCHAR(50) NOT NULL COMMENT 'สถานะการจองห้องประชุม',
	PRIMARY KEY (booking_status_id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO booking_status(booking_status_id, booking_status_code, booking_status_name) VALUES
('1', 'approve', 'อนุมัติ'),
('2', 'waitapprove', 'รออนุมัติ'),
('3', 'cancel', 'ยกเลิก'),
('4', 'waitcancel', 'รอยกเลิก'),
('5', 'notapprove', 'ไม่อนุมัติ');

-- --------------------------------------------------
-- Table structure for: booking
-- --------------------------------------------------
CREATE TABLE IF NOT EXISTS booking(
	booking_id INT(5) NOT NULL AUTO_INCREMENT COMMENT 'คีย์ของการจองห้องประชุม',
	meeting_room_id INT(5) NOT NULL COMMENT 'คีย์ของห้องประชุม',
	meeting_type_id INT(5) NOT NULL COMMENT 'คีย์ของประเภทการประชุม',
	start_date DATE NOT NULL COMMENT 'วันที่เริ่มการประชุม',
	end_date DATE NOT NULL COMMENT 'วันที่เสร็จสิ้นการประชุม',
	start_time TIME NOT NULL COMMENT 'เวลาที่เริ่มการประชุม',
	end_time TIME NOT NULL COMMENT 'เวลาที่เสร็จสิ้นการประชุม',
	meeting_topic VARCHAR(255) NOT NULL COMMENT 'หัวข้อการประชุม',
	meeting_number INT(5) NOT NULL COMMENT 'จำนวนผู้เข้าประชุม',
	meeting_detail LONGTEXT NULL COMMENT 'รายละเอียดการประชุม',
	booking_status_id INT(5) NOT NULL COMMENT 'คีย์ของสถานะการจองห้องประชุม',
	department_id INT(5) NOT NULL COMMENT 'คีย์ของแผนก',
	meeting_table_type_id INT(5) NULL DEFAULT '2' COMMENT 'คีย์ของรูปแบบการจัดโต๊ะห้องประชุม',
	meeting_required_id INT(5) NULL COMMENT 'คีย์ของสิ่งที่ต้องการในการประชุม',
	budget_type_id INT(5) NOT NULL COMMENT 'คีย์ของประเภทงบประมาณ',
	user_id INT(5) NOT NULL COMMENT 'คีย์ของผู้ใช้',
	created TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'วัน เวลาที่บันทึกการจองห้องประชุม',
	updated TIMESTAMP NULL COMMENT 'วัน เวลาที่แก้ไขการจองห้องประชุม',
	PRIMARY KEY (booking_id),
	FOREIGN KEY (meeting_room_id) REFERENCES meeting_room(meeting_room_id),
	FOREIGN KEY (meeting_type_id) REFERENCES meeting_type(meeting_type_id),
	FOREIGN KEY (booking_status_id) REFERENCES booking_status(booking_status_id),
	FOREIGN KEY (department_id) REFERENCES department(department_id),
	FOREIGN KEY (meeting_table_type_id) REFERENCES meeting_table_type(meeting_table_type_id),
	FOREIGN KEY (meeting_required_id) REFERENCES meeting_required(meeting_required_id),
	FOREIGN KEY (budget_type_id) REFERENCES budget_type(budget_type_id),
	FOREIGN KEY (user_id) REFERENCES user(user_id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------
-- Table structure for: booking_equipment
-- --------------------------------------------------
CREATE TABLE IF NOT EXISTS booking_equipment(
	booking_equipment_id INT(5) NOT NULL AUTO_INCREMENT COMMENT 'คีย์ของการจองอุปกรณ์ที่ใช้ในการประชุม',
	booking_id INT(5) NOT NULL COMMENT 'คีย์ของการจองห้องประชุม',
	equipment_id INT(5) NOT NULL COMMENT 'คีย์ของอุปกรณ์ที่ใช้ในการประชุม',
	PRIMARY KEY (booking_equipment_id),
	FOREIGN KEY (booking_id) REFERENCES booking(booking_id),
	FOREIGN KEY (equipment_id) REFERENCES equipment(equipment_id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;