CREATE TABLE `contact` ( `id` INT(10) NOT NULL AUTO_INCREMENT , 
	`name` VARCHAR(100) NULL , 
	`email` VARCHAR(100) NULL , 
	`phone` VARCHAR(100) NULL , 
	`message` TEXT NULL , 
	`created` DATETIME NOT NULL , 
	`status` TINYINT(2) NULL DEFAULT '0' ,
	 PRIMARY KEY (`id`)) ENGINE = InnoDB;

CREATE TABLE `blogs` ( 
	`id` INT(10) NOT NULL AUTO_INCREMENT , 
	`title` VARCHAR(200) NULL , 
	`title_key` VARCHAR(200) NOT NULL , 
	`id_category` INT(10) NULL , 
	`photo` VARCHAR(200) NULL , 
	`description` TEXT NULL ,
	`created` DATETIME  NULL,
	PRIMARY KEY (`id`)) ENGINE = InnoDB;