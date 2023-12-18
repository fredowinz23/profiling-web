# Host: localhost  (Version 5.5.5-10.1.34-MariaDB)
# Date: 2023-12-18 16:13:18
# Generator: MySQL-Front 6.1  (Build 1.26)


#
# Structure for table "account"
#

DROP TABLE IF EXISTS `account`;
CREATE TABLE `account` (
  `Id` tinyint(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstName` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lastName` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'Inactive',
  `role` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dateAdded` date DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `sex` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `educationalBackground` text COLLATE utf8mb4_unicode_ci,
  `teachingExperience` text COLLATE utf8mb4_unicode_ci,
  `civilStatus` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `religion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birthPlace` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sss` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `philHealth` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `isDeleted` int(11) DEFAULT '0',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPACT;

#
# Data for table "account"
#

INSERT INTO `account` VALUES (1,'admin','admin','James','Dean','Archived','Admin',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(2,'Teacher 1','1234','Riena','Canete','Archived','Faculty',NULL,'2023-12-03','Male',NULL,'393940','hsak','sqjwjs','1702209599341214150_1418646425552204_1690687667121205381_n.jpg','kdowqj','hsgu','married','catholic','bacolod','','222',0),(3,'Teacher 2','660105','Lyka ','Yee','Inactive','Faculty',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(4,'Teacher 2','660105','Lyka ','Yee','Inactive','Faculty',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(5,'Teacher 3','959448','Berna','Forton','Inactive','Faculty',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0),(6,'staff 1','12345','Grace','Espuerta','Active','Staff',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0);

#
# Structure for table "attendance"
#

DROP TABLE IF EXISTS `attendance`;
CREATE TABLE `attendance` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `dateAdded` date DEFAULT NULL,
  `facultyId` int(11) DEFAULT NULL,
  `status` varchar(255) DEFAULT 'Present',
  `timeAdded` time DEFAULT NULL,
  `classId` int(255) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

#
# Data for table "attendance"
#

INSERT INTO `attendance` VALUES (1,'2023-12-18',2,'Present',NULL,5);

#
# Structure for table "classes"
#

DROP TABLE IF EXISTS `classes`;
CREATE TABLE `classes` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `facultyId` int(11) DEFAULT NULL,
  `days` varchar(255) DEFAULT NULL,
  `subjectId` int(11) DEFAULT NULL,
  `time` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

#
# Data for table "classes"
#


#
# Structure for table "record"
#

DROP TABLE IF EXISTS `record`;
CREATE TABLE `record` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `userId` int(11) DEFAULT NULL,
  `dateAdded` date DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

#
# Data for table "record"
#

INSERT INTO `record` VALUES (2,'1702205362Screenshot (65).png','duwg','Lesson Plan',2,'2023-12-10'),(3,'1702205403Screenshot (72).png','iswqh','SF10',2,'2023-12-10'),(4,'1702205423Screenshot (70).png','jiniqh','Form',2,'2023-12-10'),(5,'1702206593Screenshot (69).png','dh','SF1',2,'2023-12-10');

#
# Structure for table "strand"
#

DROP TABLE IF EXISTS `strand`;
CREATE TABLE `strand` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `description` text,
  `isDeleted` int(11) DEFAULT '0',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

#
# Data for table "strand"
#

INSERT INTO `strand` VALUES (1,'HUMMS','HUMANITIES AND SOCIAL SCIENCES',0),(3,'TVL','TECHNICAL VOCATIONAL LEARNINGS',0);

#
# Structure for table "subject"
#

DROP TABLE IF EXISTS `subject`;
CREATE TABLE `subject` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `strandId` int(11) DEFAULT NULL,
  `year` varchar(255) DEFAULT NULL,
  `isDeleted` int(11) DEFAULT '0',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

#
# Data for table "subject"
#

INSERT INTO `subject` VALUES (1,'ENGLISH 1',1,'11',0),(2,'ALGEBRA',1,'12',0);
