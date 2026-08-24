-- 10 may-2021

ALTER TABLE `users` ADD `user_role` ENUM('super_admin','admin','user') NOT NULL DEFAULT 'user' AFTER `updated_at`;

-- 11 may 2021

ALTER TABLE `users` ADD `fname` VARCHAR(255) NULL AFTER `name`, ADD `lname` VARCHAR(255) NULL AFTER `fname`;
ALTER TABLE `users` ADD `stripe_planid` VARCHAR(255) NULL AFTER `stateid`;

-- 12 may 2021

ALTER TABLE `users` ADD `payment_status` TINYINT NOT NULL DEFAULT '0' COMMENT '\"0\"=>\"not paid\", \"1\"=>\"paid\"' AFTER `stripe_id`;
ALTER TABLE `users` ADD `step_position` INT NOT NULL DEFAULT '1' AFTER `payment_status`;
ALTER TABLE `users` ADD `access_code` VARCHAR(10) NULL AFTER `email_verified_at`;
