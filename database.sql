CREATE DATABASE IF NOT EXISTS `GoodbenTransfert` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;


CREATE TABLE `Account` (
  `id` int NOT NULL AUTO_INCREMENT,
  `numAccount` varchar(10) NOT NULL,
  `ownerId` varchar(10) NOT NULL,
  `balance` decimal(9,2) NOT NULL,
  `currency` varchar(10) NOT NULL, 
  PRIMARY KEY (`id`)
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8;


INSERT INTO `Account` (`numAccount`, `ownerId`, `balance`, `currency`) VALUES
('1000202201', '3565243167', '120', 'USD'),
('1100202201', '3323657772', '200', 'USD'),
('1200202201', '3223144156', '550', 'USD'),
('1300202201', '3126715625', '0', 'USD'),
('1400202201', '3031367816', '100', 'USD');

CREATE TABLE `Beneficiary` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ownerId` varchar(10) NOT NULL,
  `userIdBeneficiary` varchar(10) NOT NULL, 
  `label` varchar(30) NOT NULL, 
  PRIMARY KEY (`id`)
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8; 

INSERT INTO `Beneficiary` (`ownerId`, `userIdBeneficiary`, `label`) VALUES
('3565243167', '3323657772', 'Kellie KABONGO'),
('3565243167', '3223144156', 'Dieudo KABONGO'),
('3223144156', '3126715625', 'Gauthier Mukena'),
('3323657772', '3126715625', 'Obama');


CREATE TABLE `Country` (
  `id` int NOT NULL AUTO_INCREMENT,
  `countryCode` varchar(10) NOT NULL,
  `countryName` varchar(255) NOT NULL,
  `currency` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8; 


INSERT INTO `Country` (`countryCode`, `countryName`, `currency`) VALUES
('DE', 'REPUBLIQUE FEDERALE D ALLEMAGNE', 'EUR'),
('MA', 'ROYAUME DU MAROC', 'MAD'),
('JP', 'JAPON', 'JPY'),
('MX', 'MEXIQUE', 'MXN'),
('CD', 'REPUBLIQUE DEMOCRATIQUE DU CONGO', 'CDF');



CREATE TABLE `Transfert` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ownerId` varchar(10) NOT NULL,
  `userIdBeneficiary` varchar(10) NOT NULL, 
  `amountSent` decimal(9,2) NOT NULL,
  `amountReceived` decimal(9,2) NOT NULL,
  `currency` varchar(10) NOT NULL,
  `dateTransfert` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `numAccount` varchar(10) NOT NULL,
  `reference` varchar(30) NOT NULL,
  `taux` decimal(13,6) NOT NULL,
  `label` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8;


INSERT INTO `transfert` (`ownerId`, `userIdBeneficiary`, `amountSent`, `amountReceived`, `dateTransfert`, `reference`, `taux`) VALUES
('3565243167', '3323657772', 20, 20, now(), 's33sghgdfw1234', 1),
('3565243167', '3323657772', 10, 10, now(), 'shasgh431245ca', 1),
('3223144156', '3126715625', 30, 30, now(), 'dahkadjh7613hd', 1),
('3223144156', '3126715625', 10, 10, now(), '123dddj44413ld', 1),
('3323657772', '3126715625', 105, 105, now(), '1qweddjsdwerrd', 1);





