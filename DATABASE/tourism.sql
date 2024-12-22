-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 13, 2024 at 10:17 AM
-- Server version: 9.1.0
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tourism`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int NOT NULL AUTO_INCREMENT,
  `UserName` varchar(100) DEFAULT NULL,
  `Password` varchar(100) DEFAULT NULL,
  `updationDate` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `UserName`, `Password`, `updationDate`) VALUES
(1, 'admin', 'b0baee9d279d34fa1dfd71aadb908c3f', '2017-05-13 11:18:49');

-- --------------------------------------------------------

--
-- Table structure for table `tblbooking`
--

DROP TABLE IF EXISTS `tblbooking`;
CREATE TABLE IF NOT EXISTS `tblbooking` (
  `BookingId` int NOT NULL AUTO_INCREMENT,
  `PackageId` int DEFAULT NULL,
  `UserEmail` varchar(100) DEFAULT NULL,
  `FromDate` varchar(100) DEFAULT NULL,
  `ToDate` varchar(100) DEFAULT NULL,
  `Comment` mediumtext,
  `RegDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int DEFAULT NULL,
  `CancelledBy` varchar(5) DEFAULT NULL,
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `GuidePrice` decimal(10,2) DEFAULT NULL,
  `GuideId` int NOT NULL,
  PRIMARY KEY (`BookingId`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblbooking`
--

INSERT INTO `tblbooking` (`BookingId`, `PackageId`, `UserEmail`, `FromDate`, `ToDate`, `Comment`, `RegDate`, `status`, `CancelledBy`, `UpdationDate`, `GuidePrice`, `GuideId`) VALUES
(1, 3, 'pascal.ocan1@gmail.com', '2024-12-19', '2024-12-23', NULL, '2024-12-13 06:36:44', 2, 'u', '2024-12-13 06:44:19', NULL, 2),
(2, 1, 'pascal.ocan1@gmail.com', '2024-12-13', '2024-12-14', NULL, '2024-12-13 06:35:54', NULL, NULL, NULL, NULL, 1),
(3, 2, 'pascal.ocan1@gmail.com', '2024-12-15', '2024-12-26', NULL, '2024-12-13 06:39:18', NULL, NULL, NULL, NULL, 5),
(27, 1, 'pascal.ocan1@gmail.com', '2024-12-14', '2024-12-18', NULL, '2024-12-13 06:52:50', NULL, NULL, NULL, NULL, 6),
(28, 2, 'r.samuel@gmail.com', '2024-12-14', '2024-12-21', NULL, '2024-12-13 07:08:08', NULL, NULL, NULL, NULL, 3),
(29, 1, 'pascal.ocan1@gmail.com', '2024-12-14', '2024-12-19', NULL, '2024-12-13 09:37:56', NULL, NULL, NULL, 150.00, 4),
(30, 1, 'pascal.ocan1@gmail.com', '2024-12-14', '2024-12-16', NULL, '2024-12-13 09:42:59', NULL, NULL, NULL, 200.00, 5),
(31, 1, 'pascal.ocan1@gmail.com', '2024-12-14', '2024-12-21', NULL, '2024-12-13 09:44:16', NULL, NULL, NULL, 90.00, 8);

-- --------------------------------------------------------

--
-- Table structure for table `tblbookings`
--

DROP TABLE IF EXISTS `tblbookings`;
CREATE TABLE IF NOT EXISTS `tblbookings` (
  `BookingId` int NOT NULL AUTO_INCREMENT,
  `PackageId` int DEFAULT NULL,
  `GuideId` int DEFAULT NULL,
  `UserEmail` varchar(100) DEFAULT NULL,
  `BookingDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `Status` varchar(50) DEFAULT 'Pending',
  `BookingNumber` varchar(50) DEFAULT NULL,
  `TotalAmount` decimal(10,2) DEFAULT NULL,
  `PaymentStatus` enum('Pending','Completed','Failed') DEFAULT 'Pending',
  `PaymentMethod` varchar(50) DEFAULT NULL,
  `BookingStatus` enum('Confirmed','Cancelled','Completed','Pending') DEFAULT 'Pending',
  `StartDate` date DEFAULT NULL,
  `EndDate` date DEFAULT NULL,
  `NumberOfPeople` int DEFAULT '1',
  `SpecialRequirements` text,
  PRIMARY KEY (`BookingId`),
  UNIQUE KEY `BookingNumber` (`BookingNumber`),
  KEY `PackageId` (`PackageId`),
  KEY `GuideId` (`GuideId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblenquiry`
--

DROP TABLE IF EXISTS `tblenquiry`;
CREATE TABLE IF NOT EXISTS `tblenquiry` (
  `id` int NOT NULL,
  `FullName` varchar(100) DEFAULT NULL,
  `EmailId` varchar(100) DEFAULT NULL,
  `MobileNumber` char(10) DEFAULT NULL,
  `Subject` varchar(100) DEFAULT NULL,
  `Description` mediumtext,
  `PostingDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `Status` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblenquiry`
--

INSERT INTO `tblenquiry` (`id`, `FullName`, `EmailId`, `MobileNumber`, `Subject`, `Description`, `PostingDate`, `Status`) VALUES
(1, 'anuj', 'anuj.lpu1@gmail.com', '2354235235', 'The standard Lorem Ipsum passage, used since the 1500s', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum', '2017-05-13 22:23:53', 1),
(2, 'efgegter', 'terterte@gmail.com', '3454353453', 'The standard Lorem Ipsum passage', 'nventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat volup', '2017-05-13 22:27:00', 1),
(3, 'fwerwetrwet', 'fwsfhrtre@hdhdhqw.com', '8888888888', 'erwt wet', 'nventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat volup', '2017-05-13 22:28:11', 1),
(4, 'Test', 'test@gm.com', '4747474747', 'Test', 'iidiidiidiidiidiidiidiidiidiidiidiidiidiidiidiidiidiidiidiidiidiidiidiidiidiid', '2017-05-14 07:54:07', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblguideavailability`
--

DROP TABLE IF EXISTS `tblguideavailability`;
CREATE TABLE IF NOT EXISTS `tblguideavailability` (
  `AvailabilityId` int NOT NULL AUTO_INCREMENT,
  `GuideId` int DEFAULT NULL,
  `DateFrom` date DEFAULT NULL,
  `DateTo` date DEFAULT NULL,
  `Status` enum('Available','Booked','On Leave') DEFAULT 'Available',
  `CreatedAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`AvailabilityId`),
  KEY `GuideId` (`GuideId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblissues`
--

DROP TABLE IF EXISTS `tblissues`;
CREATE TABLE IF NOT EXISTS `tblissues` (
  `id` int NOT NULL,
  `UserEmail` varchar(100) DEFAULT NULL,
  `Issue` varchar(100) DEFAULT NULL,
  `Description` mediumtext,
  `PostingDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `AdminRemark` mediumtext,
  `AdminremarkDate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblissues`
--

INSERT INTO `tblissues` (`id`, `UserEmail`, `Issue`, `Description`, `PostingDate`, `AdminRemark`, `AdminremarkDate`) VALUES
(4, 'anuj@gmail.com', 'Cancellation', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco ', '2017-05-13 22:03:33', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur', '2017-05-13 23:50:40'),
(5, 'sarita@gmail.com', 'Cancellation', 'tbt 3y 34y4 3y3hgg34t', '2017-05-14 05:12:14', 'sg sd gs g sdgfs ', '2017-05-14 07:52:07'),
(6, 'demo@test.com', 'Refund', 'demo test.com demo test.comdemo test.comdemo test.comdemo test.com', '2017-05-14 07:45:37', NULL, '0000-00-00 00:00:00'),
(7, 'abc@g.com', 'Refund', 'test test ttest test ttest test ttest test ttest test ttest test t', '2017-05-14 07:56:46', 'vetet ert erteryre', '2017-05-14 07:58:43'),
(8, NULL, NULL, NULL, '2024-02-10 15:51:38', NULL, NULL),
(0, NULL, NULL, NULL, '2024-12-13 07:07:21', NULL, NULL),
(0, 'r.samuel@gmail.com', 'Booking Issues', 'I am failing to finish the booking kindly follow up', '2024-12-13 07:35:43', NULL, NULL),
(0, 'r.samuel@gmail.com', 'Cancellation', 'I am failing to finish the booking kindly follow up', '2024-12-13 07:43:38', NULL, NULL),
(0, 'r.samuel@gmail.com', 'Refund', 'please refund my money i am not happy', '2024-12-13 07:45:12', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblpages`
--

DROP TABLE IF EXISTS `tblpages`;
CREATE TABLE IF NOT EXISTS `tblpages` (
  `id` int NOT NULL,
  `type` varchar(255) DEFAULT '',
  `detail` longtext
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblpages`
--

INSERT INTO `tblpages` (`id`, `type`, `detail`) VALUES
(1, 'terms', '<P align=justify><FONT size=2><STRONG><FONT color=#990000>(1) ACCEPTANCE OF TERMS</FONT><BR><BR></STRONG>Welcome to Yahoo! India. 1Yahoo Web Services India Private Limited Yahoo\", \"we\" or \"us\" as the case may be) provides the Service (defined below) to you, subject to the following Terms of Service (\"TOS\"), which may be updated by us from time to time without notice to you. You can review the most current version of the TOS at any time at: <A href=\"http://in.docs.yahoo.com/info/terms/\">http://in.docs.yahoo.com/info/terms/</A>. In addition, when using particular Yahoo services or third party services, you and Yahoo shall be subject to any posted guidelines or rules applicable to such services which may be posted from time to time. All such guidelines or rules, which maybe subject to change, are hereby incorporated by reference into the TOS. In most cases the guides and rules are specific to a particular part of the Service and will assist you in applying the TOS to that part, but to the extent of any inconsistency between the TOS and any guide or rule, the TOS will prevail. We may also offer other services from time to time that are governed by different Terms of Services, in which case the TOS do not apply to such other services if and to the extent expressly excluded by such different Terms of Services. Yahoo also may offer other services from time to time that are governed by different Terms of Services. These TOS do not apply to such other services that are governed by different Terms of Service. </FONT></P>\r\n<P align=justify><FONT size=2>Welcome to Yahoo! India. Yahoo Web Services India Private Limited Yahoo\", \"we\" or \"us\" as the case may be) provides the Service (defined below) to you, subject to the following Terms of Service (\"TOS\"), which may be updated by us from time to time without notice to you. You can review the most current version of the TOS at any time at: </FONT><A href=\"http://in.docs.yahoo.com/info/terms/\"><FONT size=2>http://in.docs.yahoo.com/info/terms/</FONT></A><FONT size=2>. In addition, when using particular Yahoo services or third party services, you and Yahoo shall be subject to any posted guidelines or rules applicable to such services which may be posted from time to time. All such guidelines or rules, which maybe subject to change, are hereby incorporated by reference into the TOS. In most cases the guides and rules are specific to a particular part of the Service and will assist you in applying the TOS to that part, but to the extent of any inconsistency between the TOS and any guide or rule, the TOS will prevail. We may also offer other services from time to time that are governed by different Terms of Services, in which case the TOS do not apply to such other services if and to the extent expressly excluded by such different Terms of Services. Yahoo also may offer other services from time to time that are governed by different Terms of Services. These TOS do not apply to such other services that are governed by different Terms of Service. </FONT></P>\r\n<P align=justify><FONT size=2>Welcome to Yahoo! India. Yahoo Web Services India Private Limited Yahoo\", \"we\" or \"us\" as the case may be) provides the Service (defined below) to you, subject to the following Terms of Service (\"TOS\"), which may be updated by us from time to time without notice to you. You can review the most current version of the TOS at any time at: </FONT><A href=\"http://in.docs.yahoo.com/info/terms/\"><FONT size=2>http://in.docs.yahoo.com/info/terms/</FONT></A><FONT size=2>. In addition, when using particular Yahoo services or third party services, you and Yahoo shall be subject to any posted guidelines or rules applicable to such services which may be posted from time to time. All such guidelines or rules, which maybe subject to change, are hereby incorporated by reference into the TOS. In most cases the guides and rules are specific to a particular part of the Service and will assist you in applying the TOS to that part, but to the extent of any inconsistency between the TOS and any guide or rule, the TOS will prevail. We may also offer other services from time to time that are governed by different Terms of Services, in which case the TOS do not apply to such other services if and to the extent expressly excluded by such different Terms of Services. Yahoo also may offer other services from time to time that are governed by different Terms of Services. These TOS do not apply to such other services that are governed by different Terms of Service. </FONT></P>'),
(2, 'privacy', '<span style=\"color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\">At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat</span>'),
(3, 'aboutus', '										<span style=\"color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\">Test test</span>'),
(11, 'contact', '										<span style=\"color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\">Address------Test</span>');

-- --------------------------------------------------------

--
-- Table structure for table `tbltourguides`
--

DROP TABLE IF EXISTS `tbltourguides`;
CREATE TABLE IF NOT EXISTS `tbltourguides` (
  `GuideId` int NOT NULL AUTO_INCREMENT,
  `GuideName` varchar(200) NOT NULL,
  `GuideEmail` varchar(100) DEFAULT NULL,
  `GuidePhone` varchar(20) DEFAULT NULL,
  `GuideExperience` int DEFAULT NULL,
  `GuideDescription` text,
  `GuideLanguages` varchar(200) NOT NULL,
  `GuideContact` varchar(20) DEFAULT NULL,
  `GuideImage` varchar(200) DEFAULT NULL,
  `GuideStatus` tinyint(1) DEFAULT '1',
  `CreationDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `AvailabilityStatus` enum('Available','Booked','On Leave') DEFAULT 'Available',
  `TotalTours` int DEFAULT '0',
  `Location` varchar(200) DEFAULT NULL,
  `Certifications` text,
  `WorkingHours` varchar(100) DEFAULT NULL,
  `GuidePrice` decimal(10,2) DEFAULT NULL,
  `Status` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`GuideId`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbltourguides`
--

INSERT INTO `tbltourguides` (`GuideId`, `GuideName`, `GuideEmail`, `GuidePhone`, `GuideExperience`, `GuideDescription`, `GuideLanguages`, `GuideContact`, `GuideImage`, `GuideStatus`, `CreationDate`, `AvailabilityStatus`, `TotalTours`, `Location`, `Certifications`, `WorkingHours`, `GuidePrice`, `Status`) VALUES
(1, 'Pascal Ocan', 'pascal.ocan1@gmail.com', '0778715187', 2, 'I am a test Guide description I am a test Guide description I am a test Guide description I am a test Guide description I am a test Guide description I am a test Guide description', 'Luganda, English', '+256778734923', '6053667108ecf40c93d598a03973b874.jpg', 1, '2024-12-13 00:09:19', 'Available', 24, 'Bwindi', 'tour guide certificate', 'all hours', 100.00, 1),
(2, 'Lamara Jenifer', 'lamara.jenifer@gmail.com', '0778715187', 2, 'I am a test Guide description I am a test Guide description I am a test Guide description I am a test Guide description I am a test Guide description I am a test Guide description', 'Luganda, English', NULL, 'guide_image2.jpg', 1, '2024-12-13 00:09:19', 'Available', 24, 'Bwindi', 'tour guide certificate', 'all hours', 120150.00, 1),
(3, 'Ojara Christopher', 'ojara.christopher@gmail.com', '0778715187', 2, 'I am a test Guide description I am a test Guide description I am a test Guide description I am a test Guide description I am a test Guide description I am a test Guide description', 'Luganda, English', NULL, 'guide_image1.jpg', 1, '2024-12-13 00:09:19', 'Available', 24, 'Bwindi', 'tour guide certificate', 'all hours', NULL, 1),
(4, 'Lubangakene Herbert', 'lubangakene.herbert@gmail.com', '0778715187', 3, 'I am a test Guide description I am a test Guide description I am a test Guide description I am a test Guide description I am a test Guide description I am a test Guide description', '', NULL, 'guide_image3.jpg', 1, '2024-12-13 00:09:19', 'Available', 24, 'Bwindi', 'tour guide certificate', 'all hours', 150.00, 1),
(5, 'Otim Cleverand', 'otim.cleverand@gmail.com', '0778715187', 4, 'I am a test Guide description I am a test Guide description I am a test Guide description I am a test Guide description I am a test Guide description I am a test Guide description', '', NULL, 'guide_image4.jpg', 1, '2024-12-13 00:09:19', 'Available', 24, 'Bwindi', 'tour guide certificate', 'all hours', 200.00, 1),
(6, 'Ojara Geofrey', 'Ojara.Geofrey@gmail.com', '0778715187', 4, 'I am a test Guide description I am a test Guide description I am a test Guide description I am a test Guide description I am a test Guide description I am a test Guide description', '', NULL, 'guide_image5.jpg', 1, '2024-12-13 00:09:19', 'Available', 24, 'Bwindi', 'tour guide certificate', 'all hours', 50.00, 1),
(7, 'Mukisa Patience', 'mukisa.patience@gmail.com', '0778715187', 4, 'I am a test Guide description I am a test Guide description I am a test Guide description I am a test Guide description I am a test Guide description I am a test Guide description', '', NULL, 'guide_image7.jpg', 1, '2024-12-13 00:09:19', 'Available', 24, 'Bwindi', 'tour guide certificate', 'all hours', 70.00, 1),
(8, 'Nakabiri Robinah', 'nakabiri.robinah@gmail.com', '0778715187', 4, 'I am a test Guide description I am a test Guide description I am a test Guide description I am a test Guide description I am a test Guide description I am a test Guide description', '', NULL, 'guide_image8.jpg', 1, '2024-12-13 00:09:19', 'Available', 24, 'Bwindi', 'tour guide certificate', 'all hours', 90.00, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbltourpackages`
--

DROP TABLE IF EXISTS `tbltourpackages`;
CREATE TABLE IF NOT EXISTS `tbltourpackages` (
  `PackageId` int NOT NULL AUTO_INCREMENT,
  `PackageName` varchar(200) NOT NULL,
  `PackageType` varchar(150) DEFAULT NULL,
  `PackageLocation` varchar(200) DEFAULT NULL,
  `PackagePrice` decimal(10,2) DEFAULT NULL,
  `PackageFetures` text,
  `PackageDetails` text,
  `PackageImage` varchar(200) DEFAULT NULL,
  `Creationdate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `Duration` varchar(50) DEFAULT NULL,
  `MaxPeople` int DEFAULT NULL,
  `PackageStatus` enum('Active','Inactive') DEFAULT 'Active',
  `AvailableDates` text,
  `Inclusions` text,
  `Exclusions` text,
  `CancellationPolicy` text,
  PRIMARY KEY (`PackageId`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbltourpackages`
--

INSERT INTO `tbltourpackages` (`PackageId`, `PackageName`, `PackageType`, `PackageLocation`, `PackagePrice`, `PackageFetures`, `PackageDetails`, `PackageImage`, `Creationdate`, `Duration`, `MaxPeople`, `PackageStatus`, `AvailableDates`, `Inclusions`, `Exclusions`, `CancellationPolicy`) VALUES
(1, '12-Day Gorillas, Big 5 and Kidepo, Unique Overland Style12-Day Gorillas, Big 5 and Kidepo, Unique Overland Style', 'Family & Couple Package', 'Kidepo Game Park', 2300.00, 'Air Conditioning ,Balcony / Terrace,Cable / Satellite / Pay TV available,Ceiling Fan,Hairdryer', 'Enjoy a 12-Day Gorillas, Big 5 and Kidepo, Unique Overland Style12-Day Gorillas, Big 5 and Kidepo, Unique Overland Style', 'package_image3.jpg', '2024-12-03 15:20:03', NULL, NULL, 'Active', NULL, NULL, NULL, NULL),
(2, '3-Day Safari to Queen Elizabeth National Park', 'Family & Couple Package', 'Queen Elizabeth National Park, Virunga Mountains, Entebbe', 3000.00, 'Mid-range tour | Private tour | Can start any day | Can be customized | Suitable for solo travelers | 12 Minimum age.', 'Its a good experience for some one who wants to have fun', 'package_image1.jpg', '2024-12-12 14:56:42', NULL, NULL, 'Active', NULL, NULL, NULL, NULL),
(3, '12-Day Gorillas, Big 5 and Kidepo, Unique Overland Style12-Day Gorillas, Big 5 and Kidepo, Unique Overland Style', 'Family Package', 'Bwindi Impenetrable Forest', 2000.00, 'Mid-range tour | Private tour | Can start any day | Can be customized | Suitable for solo travelers | 12 Minimum age.', 'bwindi bwindi bwindibwindi bwindi bwindibwindi bwindi bwindibwindi bwindi bwindibwindi bwindi bwindibwindi bwindi bwindibwindi bwindi bwindibwindi bwindi bwindibwindi bwindi bwindibwindi bwindi bwindibwindi bwindi bwindibwindi bwindi bwindibwindi bwindi bwindibwindi bwindi bwindi', 'package_image3.jpg', '2024-12-12 14:58:43', NULL, NULL, 'Active', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbltourreviews`
--

DROP TABLE IF EXISTS `tbltourreviews`;
CREATE TABLE IF NOT EXISTS `tbltourreviews` (
  `ReviewId` int NOT NULL AUTO_INCREMENT,
  `BookingId` int DEFAULT NULL,
  `UserEmail` varchar(100) DEFAULT NULL,
  `GuideId` int DEFAULT NULL,
  `PackageId` int DEFAULT NULL,
  `Rating` int DEFAULT NULL,
  `ReviewText` text,
  `ReviewDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `Status` enum('Pending','Approved','Rejected') DEFAULT 'Pending',
  PRIMARY KEY (`ReviewId`),
  KEY `BookingId` (`BookingId`),
  KEY `UserEmail` (`UserEmail`),
  KEY `GuideId` (`GuideId`),
  KEY `PackageId` (`PackageId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblusers`
--

DROP TABLE IF EXISTS `tblusers`;
CREATE TABLE IF NOT EXISTS `tblusers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `FullName` varchar(200) DEFAULT NULL,
  `EmailId` varchar(100) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL,
  `MobileNumber` varchar(20) DEFAULT NULL,
  `RegDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `ProfileImage` varchar(200) DEFAULT NULL,
  `Address` text,
  `City` varchar(100) DEFAULT NULL,
  `Country` varchar(100) DEFAULT NULL,
  `PostalCode` varchar(20) DEFAULT NULL,
  `IsEmailVerified` tinyint(1) DEFAULT '0',
  `LastLoginDate` timestamp NULL DEFAULT NULL,
  `AccountStatus` enum('Active','Inactive','Suspended') DEFAULT 'Active',
  PRIMARY KEY (`id`),
  UNIQUE KEY `EmailId` (`EmailId`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tblusers`
--

INSERT INTO `tblusers` (`id`, `FullName`, `EmailId`, `Password`, `MobileNumber`, `RegDate`, `ProfileImage`, `Address`, `City`, `Country`, `PostalCode`, `IsEmailVerified`, `LastLoginDate`, `AccountStatus`) VALUES
(1, 'Abwola Pascal Ocan', 'pascal.ocan1@gmail.com', '202cb962ac59075b964b07152d234b70', '09888', '2024-12-02 15:33:24', NULL, NULL, NULL, NULL, NULL, 0, NULL, 'Active'),
(2, 'Rubangakene Samuel', 'r.samuel@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '0755634297', '2024-12-13 07:07:21', NULL, NULL, NULL, NULL, NULL, 0, NULL, 'Active');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
