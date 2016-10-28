CREATE DATABASE IF NOT EXISTS m_booking
CHARACTER SET=utf8
COLLATE utf8_general_ci;

USE m_booking;

CREATE TABLE IF NOT EXISTS meeting_room(
	meeting_room_id INT(5) NOT NULL AUTO_INCREMENT COMMENT 'คีย์ของห้องประชุม',
	meeting_room_code VARCHAR(3) NOT NULL COMMENT 'รหัสของห้องประชุม',
	meeting_room_name VARCHAR(50) NOT NULL COMMENT 'ชื่อห้องประชุม',
	PRIMARY KEY (meeting_room_id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO meeting_room(meeting_room_code, meeting_room_name) VALUES
('101', 'ห้องประชุมใหม่เอี่ยมเฮง'),
('201', 'ห้องประชุมโมดิฟาย'),
('102', 'ห้องประชุมสุดาวรรณ'),
('103', 'ห้องประชุมอู่เงินอู่ทอง'),
('104', 'ห้องประชุมฝ่ายบุคคล');

CREATE TABLE IF NOT EXISTS department(
	department_id INT(5) NOT NULL AUTO_INCREMENT COMMENT 'คีย์ของแผนก',
	department_code VARCHAR(5) NOT NULL COMMENT 'รหัสของแผนก',
	department_name VARCHAR(50) NOT NULL COMMENT 'ชื่อของแผนก',
	PRIMARY KEY (department_id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS user(
	user_id INT(5) NOT NULL AUTO_INCREMENT COMMENT 'คีย์ของผู้ใช้',
	email VARCHAR(50) NOT NULL COMMENT 'อีเมล์ของผู้ใช้',
	password VARCHAR(50) NOT NULL COMMENT 'รหัสผ่านของผู้ใช้',
	firstname VARCHAR(50) NULL COMMENT 'ชื่อของผู้ใช้',
	lastname VARCHAR(50) NULL COMMENT 'นามสกุลของผู้ใช้',
	position VARCHAR(50) NULL COMMENT 'ตำแหน่งของผู้ใช้',
	phone VARCHAR(50) NULL COMMENT 'เบอร์ติดต่อของผู้ใช้',
	user_created TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'วัน เวลาที่สมัครบัญชีผู้ใช้',
	user_update TIMESTAMP NULL COMMENT 'วัน เวลาที่แก้ไขบัญชีผู้ใช้',
	PRIMARY KEY (user_id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO user(email, password, firstname, lastname, position, phone) VALUES
('itsara.ra.cs@hotmail.com', '1234', 'Itsara', 'Rakchanthuek', 'Admin', '0970125090');