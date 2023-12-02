SET NAMES utf8mb4;

DROP TABLE IF EXISTS `book_items`;
CREATE TABLE `book_items`
(
    `id`           int(8)          NOT NULL AUTO_INCREMENT,
    `name`         varchar(100)     NOT NULL,
    `author`       varchar(50)      NOT NULL,
    `picture`      varchar(300)     NOT NULL,
    `description`  text             DEFAULT NULL,
    `available`    tinyint UNSIGNED DEFAULT 0 NULL,
    `rating`       float(5,4)       DEFAULT 0 NULL,
    CONSTRAINT Check_rating CHECK ( rating >= 0 AND rating <= 5 ),
    PRIMARY KEY (`id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4;

ALTER TABLE `book_items` ADD
    CONSTRAINT Check_rating_modify CHECK ( rating >= 0 AND rating <= 5 )

-- INSERT INTO `book_items` (`id`, `name`, `author`, `picture`, `description`, `available`, `rating`)
-- VALUES (null, 'meno2', 'autor2', 'cestaKObrazku2', 'popis2', 1, 3.4),
--        (2, 'Cesta kľukatiaca sa krásnym údolím', '35981156452928-pexels-photo-13149220.jpeg'),
--        (3, 'Veža v diaľke medzi medzi stromami', '36020276268180-free-photo-of-zelena-veza-kostol-mestsky.jpeg');
