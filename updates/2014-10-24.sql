ALTER TABLE `classroom` 
ADD COLUMN `create_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `turn`;
ALTER TABLE `student_enrollment` 
ADD COLUMN `create_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `id`;