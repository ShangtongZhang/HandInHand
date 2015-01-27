CREATE TABLE `HandInHand`.`topic` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `topic` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`));

CREATE TABLE `HandInHand`.`user` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(45),
  `nickname` VARCHAR(45),
  `password` VARCHAR(45),
  `score1` INT,
  `portrait` VARCHAR(45),
  `score2` INT,
  `remark` VARCHAR(45),
  `male` INT,
  `signature` VARCHAR(100),
  PRIMARY KEY (`id`));

CREATE TABLE `HandInHand`.`question` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `content` VARCHAR(500),
  `score1` INT,
  `score2` INT,
  `uid` INT NOT NULL,
  `createdTime` INT,
  `picture` VARCHAR(45),
  `title` VARCHAR(45),
  PRIMARY KEY (`id`));

CREATE TABLE `HandInHand`.`question_topic` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `tid` INT NOT NULL,
  `qid` INT NOT NULL,
  PRIMARY KEY (`id`));

INSERT INTO `HandInHand`.`topic` (`topic`) VALUES ('Work');
INSERT INTO `HandInHand`.`topic` (`topic`) VALUES ('HearthStone');
INSERT INTO `HandInHand`.`topic` (`topic`) VALUES ('Emotion');


CREATE TABLE `HandInHand`.`answer` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `content` VARCHAR(200) NOT NULL,
  `score1` INT NOT NULL DEFAULT 0,
  `score2` INT NOT NULL DEFAULT 0,
  `uid` INT NOT NULL,
  `qid` INT NOT NULL,
  `createdTime` VARCHAR(45) NOT NULL,
  `picture` VARCHAR(45) NULL,
  PRIMARY KEY (`id`));

CREATE TABLE `HandInHand`.`user_topic` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `uid` INT NOT NULL,
  `tid` INT NOT NULL,
  PRIMARY KEY (`id`));

CREATE TABLE `HandInHand`.`favorite` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `uid` INT NOT NULL,
  `qid` INT NOT NULL,
  PRIMARY KEY (`id`));
