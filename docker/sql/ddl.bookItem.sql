
-- INSERT INTO `bookitems` (`bookName`, `author`, `picturePath`, `description`, `available`, `rating`)
-- VALUES ('Dve veze', 'Tolkien John Ronald Reuel', '54710846063361-the-two-tower.jpg', '2. cast trilogie', 5, 4.9),
--        ('Spolocenstvo prstena', 'Tolkien John Ronald Reuel', '62059482486081-fellowship-of-the-ring.jpg', '1. cast trilogie', 3, 4.8),
--        ('Hobit', 'Tolkien John Ronald Reuel', '62160017672357-hobbit.jpg', 'Predchadza trilogii Pan Prstenov...', 1, 4.8);

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
    `id` integer PRIMARY KEY NOT NULL AUTO_INCREMENT,
    `username` varchar(25) NOT NULL,
    `password_hash` varchar(300) NOT NULL,
    `role` ENUM ('admin', 'user') NOT NULL DEFAULT 'user',
    `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS `bookitems`;
CREATE TABLE `bookitems` (
    `id` integer               PRIMARY KEY NOT NULL AUTO_INCREMENT,
    `bookName` varchar(150)    NOT NULL,
    `pictureName` varchar(300) DEFAULT NULL,
    `description` text         DEFAULT NULL,
    `available` integer        NOT NULL DEFAULT 0,
    `rating` float(5,2)        NOT NULL DEFAULT 0,
    `created` datetime        NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `bookitems` ADD
    CONSTRAINT Check_rating_modify CHECK ( rating >= 0 AND rating <= 5 );


DROP TABLE IF EXISTS `authors`;
CREATE TABLE `authors` (
    `id` integer PRIMARY KEY NOT NULL AUTO_INCREMENT,
    `name` varchar(255) NOT NULL,
    `surname` varchar(255) NOT NULL,
    `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS `bookitem_authors`;
CREATE TABLE `bookitem_authors` (
    `id` integer  PRIMARY KEY NOT NULL AUTO_INCREMENT,
    `author_id`   integer NOT NULL,
    `bookitem_id` integer NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `bookitem_authors` ADD FOREIGN KEY (`author_id`) REFERENCES `authors` (`id`);

ALTER TABLE `bookitem_authors` ADD FOREIGN KEY (`bookitem_id`) REFERENCES `bookitems` (`id`);
