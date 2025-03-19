CREATE DATABASE IF NOT EXISTS `assignment_srms`;

USE `assignment_srms`;


SET time_zone = '+06:00';

DROP TABLE IF EXISTS `users`;

CREATE TABLE IF NOT EXISTS `users`(
    `user_id` INT AUTO_INCREMENT PRIMARY KEY,
    `username` VARCHAR(100) NOT NULL,
    `email` VARCHAR(100) NOT NULL UNIQUE,
    `password` VARCHAR(255) NOT NULL,
    `user_type` INT NOT NULL,
    `status` INT NOT NULL DEFAULT 1,
    `registration_number` VARCHAR(100) NOT NULL UNIQUE,
    `phone_number` VARCHAR(20) NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NULL DEFAULT NULL
);

TRUNCATE TABLE `users`;

INSERT INTO `users` (`username`, `email`, `password`, `user_type`, `status`, `registration_number`, `phone_number`)
VALUES ('root', 'root@gmail.com', 'root', 1, 1, 'A-001', '017xxxxxxxx');


DROP TABLE IF EXISTS `profile`;

CREATE TABLE IF NOT EXISTS `profile`(
    `first_name` VARCHAR(100) NOT NULL,
    `middle_name` VARCHAR(100) NOT NULL,
    `last_name` VARCHAR(100) NOT NULL,
    `department` VARCHAR(100) NOT NULL,
    `session` VARCHAR(255) NULL DEFAULT NULL,
    `user_id` INT NOT NULL,
    FOREIGN KEY (`user_id`) REFERENCES `users`(`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
);


DROP TABLE IF EXISTS `course`;

CREATE TABLE IF NOT EXISTS `course`(
    `course_id` INT AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL,
    `status` INT NOT NULL DEFAULT 1,
    `credit` INT NOT NULL,
    `created_by` VARCHAR(100) NOT NULL
);


DROP TABLE IF EXISTS `department`;

CREATE TABLE IF NOT EXISTS `department`(
    `department_id` INT AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL,
    `created_by` VARCHAR(100) NOT NULL
);


DROP TABLE IF EXISTS `exam`;

CREATE TABLE IF NOT EXISTS `exam` (
    `exam_id` INT AUTO_INCREMENT PRIMARY KEY,
    `course_id` INT NOT NULL,
    `exam_title` VARCHAR(255) NOT NULL,
    `department_id` INT NOT NULL,
    `semester` VARCHAR(50) NOT NULL,
    `credit` INT NOT NULL,
    `exam_type` VARCHAR(50) NOT NULL,
    `marks` INT NOT NULL,
    `instructor_id` INT NOT NULL,
    `created_by` VARCHAR(100) NOT NULL,
    FOREIGN KEY (`course_id`) REFERENCES `course`(`course_id`)  ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (`department_id`) REFERENCES `department`(`department_id`)  ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (`instructor_id`) REFERENCES `users`(`user_id`)  ON DELETE CASCADE ON UPDATE CASCADE
);


DROP TABLE IF EXISTS `marks`;

CREATE TABLE IF NOT EXISTS `marks` (
    `marks_id` INT AUTO_INCREMENT PRIMARY KEY,
    `student_id` INT NOT NULL,
    `exam_id` INT NOT NULL,
    `course_id` INT NOT NULL,
    `marks` INT NOT NULL,
    `semester` VARCHAR(50) NOT NULL,
    `gpa` DECIMAL(3,2) NOT NULL,
    FOREIGN KEY (`student_id`) REFERENCES `users`(`user_id`)  ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (`exam_id`) REFERENCES `exam`(`exam_id`)  ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (`course_id`) REFERENCES `course`(`course_id`)  ON DELETE CASCADE ON UPDATE CASCADE
);



DROP TABLE IF EXISTS `results`;

CREATE TABLE IF NOT EXISTS `results` (
    `results_id` INT AUTO_INCREMENT PRIMARY KEY,
    `student_id` INT NOT NULL,
    `final_cgpa` DECIMAL(3,2) NOT NULL,
    FOREIGN KEY (`student_id`) REFERENCES `users`(`user_id`)  ON DELETE CASCADE ON UPDATE CASCADE
);

ALTER TABLE `users` COLUMN status NULL;