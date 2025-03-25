USE `assignment_srms`;

ALTER TABLE course 
MODIFY COLUMN status tinyint

ALTER TABLE users 
MODIFY COLUMN status tinyint

ALTER TABLE users 
MODIFY COLUMN user_type tinyint

ALTER TABLE users 
MODIFY COLUMN registration_number VARCHAR(20)

ALTER TABLE exam 
MODIFY COLUMN semester tinyint

ALTER TABLE users
MODIFY COLUMN username VARCHAR(255) UNIQUE;