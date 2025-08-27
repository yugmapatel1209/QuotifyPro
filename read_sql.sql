
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

CREATE TABLE `quotations_master` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `licence` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `client_company` varchar(255) DEFAULT NULL,
  `client_name` text DEFAULT NULL,
  `client_address` text DEFAULT NULL,
  `rfq_number` text DEFAULT NULL,
  `date` date NOT NULL,
  `quotation_number` varchar(255) NOT NULL,
  `valid_until` varchar(255) NOT NULL,
  `detail_amount` varchar(255) DEFAULT NULL,
  `discount` varchar(255) DEFAULT NULL,
  `final_amount` varchar(255) DEFAULT NULL,
  `company_id` int(11) NOT NULL DEFAULT 1,
  `status` int(11) DEFAULT 0,
  `is_active` int(11) NOT NULL DEFAULT 1,
  `is_laterpad_image` tinyint(1) NOT NULL,
  `need_extra_price_comparison` tinyint(4) NOT NULL DEFAULT 0,
  `buyers_name` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=158 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci


CREATE TABLE `quotations_detail` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `quotation_id` int(11) NOT NULL DEFAULT 0,
  `series` varchar(255) NOT NULL,
  `material` varchar(255) DEFAULT NULL,
  `hsn_sac` varchar(255) DEFAULT NULL,
  `description` varchar(5000) DEFAULT NULL,
  `make` varchar(255) DEFAULT NULL,
  `quantity` varchar(255) DEFAULT NULL,
  `unit` varchar(255) DEFAULT NULL,
  `rate` varchar(255) DEFAULT NULL,
  `amount` varchar(255) DEFAULT NULL,
  `including_gst` varchar(100) DEFAULT NULL,
  `excluding_gst` varchar(255) DEFAULT NULL,
  `discount_percentage` varchar(50) DEFAULT NULL,
  `final_amount` varchar(255) DEFAULT NULL,
  `profit_percentage` varchar(255) DEFAULT NULL,
  `original_rate` varchar(255) DEFAULT NULL,
  `purchase_amount` varchar(255) DEFAULT NULL,
  `sales_amount` varchar(255) DEFAULT NULL,
  `transportation_charges` varchar(255) DEFAULT NULL,
  `buyers_name` varchar(255) DEFAULT NULL,
  `gst_percentage` varchar(255) DEFAULT NULL,
  `gst_amount` varchar(255) DEFAULT NULL,
  `total_amount` varchar(255) DEFAULT NULL,
  `benefit` varchar(30) DEFAULT NULL,
  `extra` varchar(255) DEFAULT NULL,
  `is_active` int(11) NOT NULL DEFAULT 1,
  `delivery` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=256 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci


CREATE TABLE purchase_orders (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    po_id VARCHAR(100) NOT NULL,
    quotation_id INT UNSIGNED NOT NULL,
    description VARCHAR(1000) DEFAULT NULL,
    status VARCHAR(50) DEFAULT NULL,
    is_active INT NOT NULL DEFAULT 1,
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL,
    deleted_at TIMESTAMP NULL DEFAULT NULL,
    -- FOREIGN KEY (quotation_id) REFERENCES quotations_master(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE purchase_order_details (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    po_id INT UNSIGNED NOT NULL,
    series VARCHAR(10) DEFAULT NULL,
    material VARCHAR(255) DEFAULT NULL,
    hsn_sac VARCHAR(250) DEFAULT NULL,
    description VARCHAR(1000) DEFAULT NULL,
    make VARCHAR(255) DEFAULT NULL,
    delivery VARCHAR(100) DEFAULT NULL,
    quantity INT DEFAULT NULL,
    unit VARCHAR(250) DEFAULT NULL,
    rate VARCHAR(250) DEFAULT NULL,
    amount VARCHAR(250) DEFAULT NULL,
    gst_percentage VARCHAR(5) DEFAULT NULL,
    buyers_name VARCHAR(255) DEFAULT NULL,
    gst_amount VARCHAR(10) DEFAULT NULL,
    total_amount VARCHAR(10) DEFAULT NULL,
    is_active TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP NULL DEFAULT NULL,
    updated_at TIMESTAMP NULL DEFAULT NULL,
    deleted_at TIMESTAMP NULL DEFAULT NULL,
    FOREIGN KEY (po_id) REFERENCES purchase_orders(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;