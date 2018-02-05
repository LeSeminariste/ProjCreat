CREATE TABLE `markers` (
  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
  `name` VARCHAR( 60 ) NOT NULL ,
  `address` VARCHAR( 80 ) NOT NULL ,
  `lat` FLOAT( 10, 6 ) NOT NULL ,
  `lng` FLOAT( 10, 6 ) NOT NULL ,
  `type` VARCHAR( 30 )
) ENGINE = MYISAM ;

CREATE TABLE `users` (
  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
  `name` VARCHAR( 60 ) NOT NULL ,
  `firstname` VARCHAR( 60 ) NOT NULL ,
  `phone` INT( 10 ) NOT NULL ,
  `email` VARCHAR( 100 ) NOT NULL ,
  `password` VARCHAR( 60 ) NOT NULL ,
  `age` VARCHAR( 3 ) NOT NULL
) ENGINE = MYISAM ;