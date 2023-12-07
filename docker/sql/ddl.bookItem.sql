SET NAMES utf8mb4;

DROP TABLE IF EXISTS `BookItems`;
CREATE TABLE `bookitems`
(
    `id`           int(8)           NOT NULL AUTO_INCREMENT,
    `bookName`     varchar(100)     NOT NULL,
    `author`       varchar(50)      NOT NULL,
    `picturePath`  varchar(300)     DEFAULT NULL,
    `description`  text             DEFAULT NULL,
    `available`    tinyint UNSIGNED DEFAULT 0 NULL,
    `rating`       float(5,4)       DEFAULT 0 NULL,
    CONSTRAINT Check_rating CHECK ( rating >= 0 AND rating <= 5 ),
    PRIMARY KEY (`id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4;

ALTER TABLE `bookitems` ADD
    CONSTRAINT Check_rating_modify CHECK ( rating >= 0 AND rating <= 5 );

INSERT INTO `bookitems` (`bookName`, `author`, `picturePath`, `description`, `available`, `rating`)
VALUES ('Dve veze', 'Tolkien John Ronald Reuel', '54710846063361-the-two-tower.jpg', '2. cast trilogie', 5, 4.9),
       ('Spolocenstvo prstena', 'Tolkien John Ronald Reuel', '62059482486081-fellowship-of-the-ring.jpg', '1. cast trilogie', 3, 4.8),
       ('Hobit', 'Tolkien John Ronald Reuel', '62160017672357-hobbit.jpg', 'Predchadza trilogii Pan Prstenov...', 1, 4.8);

