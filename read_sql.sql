
ALTER TABLE `quotations_master` ADD `detail_amount` VARCHAR(255) NULL AFTER `valid_until`;
ALTER TABLE `quotations_master` ADD `discount` VARCHAR(255) NULL AFTER `detail_amount`;
ALTER TABLE `quotations_master` ADD `final_amount` VARCHAR(255) NULL AFTER `discount`;





ALTER TABLE `quotations_detail` CHANGE `material` `material` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL;
ALTER TABLE `quotations_detail` CHANGE `hsn_sac` `hsn_sac` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL;
ALTER TABLE `quotations_detail` CHANGE `description` `description` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL;
ALTER TABLE `quotations_detail` CHANGE `make` `make` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL;
ALTER TABLE `quotations_detail` CHANGE `quantity` `quantity` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL;
ALTER TABLE `quotations_detail` CHANGE `unit` `unit` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL;
ALTER TABLE `quotations_detail` CHANGE `rate` `rate` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL;
ALTER TABLE `quotations_detail` CHANGE `amount` `amount` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL;
ALTER TABLE `quotations_detail` CHANGE `gst_percentage` `gst_percentage` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL;
ALTER TABLE `quotations_detail` CHANGE `gst_amount` `gst_amount` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL;
ALTER TABLE `quotations_detail` CHANGE `total_amount` `total_amount` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL;


ALTER TABLE `quotations_master` CHANGE `client_name` `client_name` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL;
ALTER TABLE `quotations_master` CHANGE `client_address` `client_address` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL;
ALTER TABLE `quotations_master` CHANGE `rfq_number` `rfq_number` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL;

ALTER TABLE `quotations_master` ADD `status` INT NULL DEFAULT '0' AFTER `is_active`;

ALTER TABLE `quotations_detail` ADD `buyers_name` VARCHAR(100) NULL DEFAULT NULL AFTER `transportation_charges`;
CREATE TABLE `users` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `username` varchar(150) NOT NULL,
 `email` varchar(150) NOT NULL,
 `password` text NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1
