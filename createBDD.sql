CREATE TABLE `markers` (
  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
  `name` VARCHAR( 60 ) NOT NULL ,
  `address` VARCHAR( 80 ) NOT NULL ,
  `owner` INT NOT NULL ,
  `ownername` VARCHAR( 80 ) ,
  `ownerfirstname` VARCHAR( 80 ) ,
  `ownerphone` VARCHAR( 10 ) ,
  `ownermail` VARCHAR( 80 ) ,
  `ownerage` INT ,
  `lat` FLOAT( 10, 6 ) NOT NULL ,
  `lng` FLOAT( 10, 6 ) NOT NULL ,
  `type` VARCHAR( 30 )
) ENGINE = MYISAM ;

CREATE TABLE `users` (
  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
  `name` VARCHAR( 60 ) NOT NULL ,
  `firstname` VARCHAR( 60 ) NOT NULL ,
  `phone` VARCHAR( 10 ) NOT NULL ,
  `email` VARCHAR( 100 ) NOT NULL ,
  `password` VARCHAR( 60 ) NOT NULL ,
  `age` INT NOT NULL
) ENGINE = MYISAM ;

INSERT INTO `markers` (`id`, `name`, `address`, `lat`, `lng`, `type`) VALUES ('1', 'Dechetterie les 4 vents', 'Les Quatre Vents, 18000 Bourges', '47.117758', '2.443675', 'Dechetterie');
INSERT INTO `markers` (`id`, `name`, `address`, `lat`, `lng`, `type`) VALUES ('2', 'Dechetterie Saint Doulchard', '18230 Saint-Doulchard', '47.098226', '2.333796', 'Dechetterie');
INSERT INTO `markers` (`id`, `name`, `address`, `lat`, `lng`, `type`) VALUES ('3', 'Dechetterie les Danjons', 'Allee Francois Arago, 18000 Bourges', '47.079544', '2.357025', 'Dechetterie');
INSERT INTO `markers` (`id`, `name`, `address`, `lat`, `lng`, `type`) VALUES ('4', 'Dechetterie la Chapelle St Ursin', 'Allée des Italiens ZI, Les Laburets, 18570 La Chapelle-Saint-Ursin', '47.049251', '2.306438', 'Dechetterie');
INSERT INTO `markers` (`id`, `name`, `address`, `lat`, `lng`, `type`) VALUES ('5', 'Dechetterie de Trouy', 'Avenue des Anciens Combattants, 18570 Trouy', '47.010344', '2.342968', 'Dechetterie');
INSERT INTO `markers` (`id`, `name`, `address`, `lat`, `lng`, `type`) VALUES ('6', 'Dechetterie Saint Just', '18340 Saint-Just ', '46.995605', '2.510312', 'Dechetterie');