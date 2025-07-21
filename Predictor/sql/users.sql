CREATE TABLE `users` (
    `user_id` INT(11) NOT NULL AUTO_INCREMENT,
    `username` VARCHAR(100) NOT NULL UNIQUE,
    `email` VARCHAR(100) NOT NULL UNIQUE,
    `password` VARCHAR(255) NOT NULL, -- Password should be stored as a hash
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	`account_type` ENUM('admin', 'user') DEFAULT 'user',
    PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;