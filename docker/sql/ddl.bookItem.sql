
-- INSERT INTO `bookitems` (`bookName`, `author`, `picturePath`, `description`, `available`, `rating`)
-- VALUES ('Dve veze', 'Tolkien John Ronald Reuel', '54710846063361-the-two-tower.jpg', '2. cast trilogie', 5, 4.9),
--        ('Spolocenstvo prstena', 'Tolkien John Ronald Reuel', '62059482486081-fellowship-of-the-ring.jpg', '1. cast trilogie', 3, 4.8),
--        ('Hobit', 'Tolkien John Ronald Reuel', '62160017672357-hobbit.jpg', 'Predchadza trilogii Pan Prstenov...', 1, 4.8);

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
    `id` integer PRIMARY KEY NOT NULL AUTO_INCREMENT,
    `username` varchar(25) NOT NULL UNIQUE,
    `passwordHash` varchar(100) NOT NULL,
    `realName` varchar(40) NOT NULL,
    `realSurname` varchar(40) NOT NULL,
    `role` ENUM ('admin', 'user') NOT NULL DEFAULT 'user',
    `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS `bookitems`;
CREATE TABLE `bookitems` (
    `id` integer               PRIMARY KEY NOT NULL AUTO_INCREMENT,
    `bookName` varchar(90)    NOT NULL,
    `pictureName` varchar(80) DEFAULT NULL,
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
    `name` varchar(40) NOT NULL,
    `surname` varchar(40) NOT NULL,
    `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS `authorrights`;
CREATE TABLE `authorrights` (
    `id` integer  PRIMARY KEY NOT NULL AUTO_INCREMENT,
    `authorId`   integer NOT NULL,
    `bookItemId` integer NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `authorrights` ADD FOREIGN KEY (`authorId`) REFERENCES `authors` (`id`);

ALTER TABLE `authorrights` ADD FOREIGN KEY (`bookItemId`) REFERENCES `bookitems` (`id`);


DROP TABLE IF EXISTS `reservations`;
CREATE TABLE `reservations` (
    `id`          integer             PRIMARY KEY NOT NULL AUTO_INCREMENT,
    `bookItemId`  integer             NOT NULL,
    `customerId`  integer             NULL,
    `borrowed`    datetime            NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `reservations` ADD FOREIGN KEY (`bookItemId`) REFERENCES `bookitems` (`id`);
ALTER TABLE `reservations` ADD FOREIGN KEY (`customerId`) REFERENCES `users` (`id`);

-- DROP TABLE IF EXISTS `articles`;
-- CREATE TABLE `articles` (
--     `id`          integer             PRIMARY KEY NOT NULL AUTO_INCREMENT,
--     `authorId`    integer             NOT NULL,
--     `title`       varchar(90)         NOT NULL,
--     `lastEdit`    datetime            NOT NULL,
--     `content`     text                NOT NULL,
--     `pictureName` varchar(80)         DEFAULT NULL,
--     `edited`      integer             DEFAULT NULL,
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
--
-- ALTER TABLE `articles` ADD FOREIGN KEY (`authorId`) REFERENCES `users` (`id`);
-- ALTER TABLE `articles` ADD FOREIGN KEY (`edited`) REFERENCES `users` (`id`);

-- DROP TABLE IF EXISTS `articleitems`;
-- CREATE TABLE `articles` (
--                             `id`          integer                PRIMARY KEY NOT NULL AUTO_INCREMENT,
--                             `articleId`   integer                NOT NULL, /* FK */
--                             `particleId`  integer                NOT NULL, /* order by particleId */
--                             `fontSize`    ENUM(1,2,3,4,5)        NOT NULL DEFAULT 3,
--                             `newLine`     bool                   NOT NULL DEFAULT FALSE,
--                             `type`        ENUM('p', 'img', 'h')  NOT NULL DEFAULT 'h',
--                             `content`     text                DEFAULT NULL,
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
