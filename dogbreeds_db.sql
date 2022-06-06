-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 06, 2022 at 02:17 AM
-- Server version: 10.4.24-MariaDB-log
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dogbreeds_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `breeds`
--

CREATE TABLE `breeds` (
  `breedID` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `sizeID` int(11) DEFAULT NULL,
  `temperamentID` int(11) DEFAULT NULL,
  `categoryID` int(11) DEFAULT NULL,
  `originID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `breeds`
--

INSERT INTO `breeds` (`breedID`, `name`, `sizeID`, `temperamentID`, `categoryID`, `originID`) VALUES
(1, 'Golden Retriever', 4, 2, 1, 3),
(2, 'Weimaraner', 4, 1, 1, 4),
(3, 'Pitbull Terrier', 3, 1, 3, 5),
(4, 'Great Dane', 5, 2, 4, 4),
(5, 'Toy Poodle', 1, 1, 5, 4),
(6, 'French Bulldog', 3, 3, 7, 2),
(7, 'German Shepherd', 4, 1, 6, 4),
(8, 'Standard Poodle', 3, 2, 7, 4),
(9, 'English Bulldog', 3, 3, 7, 5),
(10, 'Beagle', 2, 2, 2, 5),
(11, 'Rottweiler', 5, 1, 4, 4),
(12, 'German Shorthaired Pointer', 3, 2, 1, 4),
(13, 'Dachshund', 2, 1, 2, 4),
(14, 'Pembroke Welsh Corgi', 2, 2, 6, 6),
(15, 'Australian Shepherd', 3, 1, 6, 7),
(16, 'Yorkshire Terrier', 1, 1, 5, 5);

-- --------------------------------------------------------

--
-- Table structure for table `breed_color`
--

CREATE TABLE `breed_color` (
  `breed_color_id` int(11) NOT NULL,
  `breedID` int(11) NOT NULL,
  `colorID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `breed_color`
--

INSERT INTO `breed_color` (`breed_color_id`, `breedID`, `colorID`) VALUES
(1, 1, 5),
(2, 2, 9),
(3, 3, 1),
(4, 3, 2),
(5, 3, 4),
(6, 4, 1),
(7, 4, 2),
(8, 4, 4),
(9, 4, 9),
(10, 5, 1),
(11, 5, 2),
(12, 5, 3),
(13, 5, 7),
(14, 6, 1),
(15, 6, 4),
(16, 6, 7),
(17, 7, 1),
(18, 7, 2),
(19, 7, 7),
(20, 7, 8),
(21, 7, 9),
(22, 8, 1),
(23, 8, 2),
(24, 8, 3),
(25, 8, 4),
(26, 8, 7),
(27, 8, 8),
(28, 8, 9),
(29, 8, 19),
(30, 8, 20),
(31, 9, 1),
(32, 9, 3),
(33, 9, 4),
(34, 10, 1),
(35, 10, 2),
(36, 10, 3),
(37, 10, 8),
(38, 10, 21),
(39, 11, 1),
(40, 11, 2),
(41, 11, 3),
(42, 12, 1),
(43, 12, 2),
(44, 12, 4),
(45, 13, 1),
(46, 13, 2),
(47, 13, 3),
(48, 13, 7),
(49, 14, 1),
(50, 14, 2),
(51, 14, 3),
(52, 15, 2),
(53, 15, 3),
(54, 15, 7),
(55, 15, 8),
(56, 16, 1),
(57, 16, 2),
(58, 16, 5),
(59, 16, 8);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `categoryID` int(11) NOT NULL,
  `categoryName` varchar(60) NOT NULL,
  `categoryDesc` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`categoryID`, `categoryName`, `categoryDesc`) VALUES
(1, 'sporting', 'Sporting group dogs were bred to be the helper of the wildfowl hunter. Sporting group dogs are attentive and attuned to their humans and environment, and have plenty of stamina for long treks in the great outdoors. While they can be high energy, these aim-to-please pets are easily trained.'),
(2, 'hound', 'Their strength lies in their impressive scent-tracking abilities to chase and sometimes catch prey. They are attentive and attuned to their humans and environment.'),
(3, 'terrier', 'Determined, high-spirited dogs with an independent streak are what you get in a terrier. Bred to pursue and root out vermin and sound the alarm on intruders, these dogs let very little escape their keen senses. Without proper training and direction, terriers can develop unwanted habits like nuisance barking, digging, and destruction of shoes and other things around the house.'),
(4, 'working', 'We call on these athletic, intelligent, watchful dogs to get the job done. Most of these working dogs are large breeds, at 70+ pounds in weight. These working group dogs can guard people and property, haul sleds, and perform water rescue.\r\n'),
(5, 'toy', 'These companion dogs may be small, but they come with big hearts and big personalities. That’s what makes life with a toy dog delightful. Origins of the various toy breeds vary wildly. Some are lap-sized versions of terriers and other larger-sized dogs while others are bred specifically to provide a friendly furry friend.'),
(6, 'herding', 'Herding dogs are stacked with brains and athleticism that make them excellent companions for an active lifestyle. What separates herding dogs from the pack is their responsiveness and awareness of other animals, and their drive and aptitude to keep them under their watch and control.'),
(7, 'nonsporting', 'There’s no one way to describe this broad category of dogs. Some are dedicated couch potatoes while others are happiest when they have space to run and explore. Some are easygoing, whereas others will keep you on their toes with their independent personalities. But where this diverse group of non-sporting dogs finds common ground is how they provide love and companionship to their human families.');

-- --------------------------------------------------------

--
-- Table structure for table `colors`
--

CREATE TABLE `colors` (
  `colorID` int(11) NOT NULL,
  `colorName` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `colors`
--

INSERT INTO `colors` (`colorID`, `colorName`) VALUES
(1, 'brown'),
(2, 'black'),
(3, 'red'),
(4, 'white'),
(5, 'gold'),
(6, 'yellow'),
(7, 'cream'),
(8, 'blue'),
(9, 'grey'),
(19, 'apricot'),
(20, 'silver'),
(21, 'lemon');

-- --------------------------------------------------------

--
-- Table structure for table `origins`
--

CREATE TABLE `origins` (
  `originID` int(11) NOT NULL,
  `originName` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `origins`
--

INSERT INTO `origins` (`originID`, `originName`) VALUES
(1, 'Newfoundland'),
(2, 'France'),
(3, 'Scotland'),
(4, 'Germany'),
(5, 'Britain'),
(6, 'Pembrokeshire'),
(7, 'Australia');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` tinyint(4) NOT NULL,
  `role` varchar(25) NOT NULL,
  `description` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role`, `description`) VALUES
(1, 'System administrator', 'A system administrator has permissions to manage users and contents of the website.'),
(2, 'User manager', ' A user manager has permission to manage user accounts.'),
(3, 'Advanced user', 'In addition to the permission granted to the basic user role, an advanced user also has access to the search feature.'),
(4, 'Basic user', 'A basic user has access to the shopping cart feature.');

-- --------------------------------------------------------

--
-- Table structure for table `sizes`
--

CREATE TABLE `sizes` (
  `sizeID` int(11) NOT NULL,
  `sizeName` varchar(60) NOT NULL,
  `sizeDesc` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sizes`
--

INSERT INTO `sizes` (`sizeID`, `sizeName`, `sizeDesc`) VALUES
(1, 'xsmall', 'weigh 2-12 lbs'),
(2, 'small', 'weigh 12-24 lbs'),
(3, 'medium', 'weigh 24-59 lbs'),
(4, 'large', 'weigh 59-99 lbs'),
(5, 'xlarge', 'weigh 99+ lbs');

-- --------------------------------------------------------

--
-- Table structure for table `temperaments`
--

CREATE TABLE `temperaments` (
  `temperamentID` int(11) NOT NULL,
  `temperamentName` varchar(60) NOT NULL,
  `temperamentDesc` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `temperaments`
--

INSERT INTO `temperaments` (`temperamentID`, `temperamentName`, `temperamentDesc`) VALUES
(1, 'assertive', 'Assertive dogs can be rough on toys, other animals, and property. They zealously look for action. Assertive dogs will destroy anything in their path to get what they want. They will annihilate toys, even those guaranteed for their forceful makeup!\r\n\r\nAssertive dogs are possessive and territorial. They follow their own rules. Assertive dogs have no boundaries. For them, play fighting often turns into real fighting.'),
(2, 'neutral', 'Neutral dogs are content to find non-destructive ways to amuse themselves if no one to play with. If challenged, they avoid confrontation by either simply walking away or appearing passive. Neutrals would rather chase a Frisbee or retrieve a ball than wrestle.\r\n\r\nThey unselfishly share their food and possessions. Their toys show normal wear and tear but aren’t shred to bits in minutes! They respect and appreciate playing with you or another dog but don’t demand it.\r\n\r\n'),
(3, 'passive', 'Passives would rather sit next to you or be alone rather than mingle and interact with others. They can appear fearful and anxious. Sadly, they frequently are not happy puppies or dogs.\r\n\r\nPassives are easy on toys. They have no impulse to destroy them.\r\n\r\nPassives knowingly avoid any confrontation. They are cautious and apprehensive. Some never know the joy and fun of being a dog. ');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` smallint(6) DEFAULT 4,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `username`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Lily A Weber', 'lilywebe@iu.edu', 'lilywebe', '$2y$10$gsn698KmkPdJNYBABJohDuP3JDJtESZl3i8ozVUur5FtK1wAitSHa', 1, '2022-06-06 00:12:51', '2022-06-06 00:15:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `breeds`
--
ALTER TABLE `breeds`
  ADD PRIMARY KEY (`breedID`),
  ADD KEY `sizeID` (`sizeID`),
  ADD KEY `temperamentID` (`temperamentID`),
  ADD KEY `categoryID` (`categoryID`),
  ADD KEY `originID` (`originID`) USING BTREE;

--
-- Indexes for table `breed_color`
--
ALTER TABLE `breed_color`
  ADD PRIMARY KEY (`breed_color_id`),
  ADD UNIQUE KEY `breedID` (`breedID`,`colorID`) USING BTREE,
  ADD KEY `colorID` (`colorID`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`categoryID`);

--
-- Indexes for table `colors`
--
ALTER TABLE `colors`
  ADD PRIMARY KEY (`colorID`);

--
-- Indexes for table `origins`
--
ALTER TABLE `origins`
  ADD PRIMARY KEY (`originID`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`sizeID`);

--
-- Indexes for table `temperaments`
--
ALTER TABLE `temperaments`
  ADD PRIMARY KEY (`temperamentID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_uindex` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `breeds`
--
ALTER TABLE `breeds`
  MODIFY `breedID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `breed_color`
--
ALTER TABLE `breed_color`
  MODIFY `breed_color_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `categoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `colors`
--
ALTER TABLE `colors`
  MODIFY `colorID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `origins`
--
ALTER TABLE `origins`
  MODIFY `originID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `sizes`
--
ALTER TABLE `sizes`
  MODIFY `sizeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `temperaments`
--
ALTER TABLE `temperaments`
  MODIFY `temperamentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `breeds`
--
ALTER TABLE `breeds`
  ADD CONSTRAINT `breeds_ibfk_1` FOREIGN KEY (`categoryID`) REFERENCES `categories` (`categoryID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `breeds_ibfk_2` FOREIGN KEY (`sizeID`) REFERENCES `sizes` (`sizeID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `breeds_ibfk_3` FOREIGN KEY (`temperamentID`) REFERENCES `temperaments` (`temperamentID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `breeds_ibfk_4` FOREIGN KEY (`originID`) REFERENCES `origins` (`originID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `breed_color`
--
ALTER TABLE `breed_color`
  ADD CONSTRAINT `breed_color_ibfk_1` FOREIGN KEY (`breedID`) REFERENCES `breeds` (`breedID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `breed_color_ibfk_2` FOREIGN KEY (`colorID`) REFERENCES `colors` (`colorID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
