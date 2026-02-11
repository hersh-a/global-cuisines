CREATE TABLE `ci_cuisines` (
  `cuisine_id` INT(11) NOT NULL AUTO_INCREMENT,
  `cuisine_name` VARCHAR(255) NOT NULL,
  `description` TEXT NOT NULL,
  `author_id` INT(11) NOT NULL,
  PRIMARY KEY (`cuisine_id`)
);

ALTER TABLE ci_cuisines
ADD COLUMN author_id INT(11) NOT NULL;
ADD COLUMN created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP;
ADD COLUMN image VARCHAR(255) NULL;

