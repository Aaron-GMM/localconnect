CREATE DATABASE IF NOT EXISTS localconncetion;

use localconncetion; 

CREATE TABLE IF NOT EXISTS `user` (
`id` int NOT NULL AUTO_INCREMENT,
`nome` VARCHAR(255) NOT NULL,
`email` VARCHAR(255) NOT NULL,
`password` VARCHAR(255) NOT NULL,
`cidade` VARCHAR(255) NOT NULL,
`estado` VARCHAR(255) NOT NULL,
PRIMARY KEY (`id`)
    
)