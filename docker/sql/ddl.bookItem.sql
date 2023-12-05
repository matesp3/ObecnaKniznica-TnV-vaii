SET NAMES utf8mb4;

DROP TABLE IF EXISTS `BookItems`;
CREATE TABLE `BookItems`
(
    `id`           int(8)           NOT NULL AUTO_INCREMENT,
    `bookName`     varchar(100)     NOT NULL,
    `author`       varchar(50)      NOT NULL,
    `picture`      varchar(300)     NOT NULL,
    `description`  text             DEFAULT NULL,
    `available`    tinyint UNSIGNED DEFAULT 0 NULL,
    `rating`       float(5,4)       DEFAULT 0 NULL,
    CONSTRAINT Check_rating CHECK ( rating >= 0 AND rating <= 5 ),
    PRIMARY KEY (`id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4;

ALTER TABLE `BookItems` ADD
    CONSTRAINT Check_rating_modify CHECK ( rating >= 0 AND rating <= 5 )

INSERT INTO `BookItems` (`bookName`, `author`, `picture`, `description`, `available`, `rating`)
VALUES ('meno2', 'autor2', 'cestaKObrazku2', 'popis2', 1, 3.4); --,

