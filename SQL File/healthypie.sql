-- phpMyAdmin SQL Dump
-- version 4.4.13.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 15, 2017 at 02:41 PM
-- Server version: 5.6.31-0ubuntu0.15.10.1
-- PHP Version: 5.6.11-1ubuntu3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `healthypie`
--

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `cmnt_id` int(11) NOT NULL,
  `recipe_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`cmnt_id`, `recipe_id`, `username`, `comment`, `date`) VALUES
(1, 4, 'bipul', 'This looks delicious :)', '2017-08-12 00:50:29'),
(2, 4, 'sample', 'Thank you for the recipe', '2017-08-12 00:54:52'),
(3, 5, 'sample', 'Can we make veg,mutton burger from this recipe?', '2017-08-12 00:55:35'),
(4, 3, 'sample', 'Cauli sausage new to me so I am gonna sure try this. Thanks for the post', '2017-08-12 00:56:11'),
(5, 2, 'sample', 'Thanks for the post', '2017-08-12 00:57:38'),
(6, 6, 'dipesh', 'sai metho xa yar rai ', '2017-08-13 11:31:52');

-- --------------------------------------------------------

--
-- Table structure for table `ingredients`
--

CREATE TABLE IF NOT EXISTS `ingredients` (
  `id` int(11) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `amount_unit` varchar(255) NOT NULL,
  `calorie` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ingredients`
--

INSERT INTO `ingredients` (`id`, `item_name`, `amount_unit`, `calorie`) VALUES
(1, 'Rice', 'Cup', 225),
(2, 'Apple', 'Number', 80),
(3, 'Banana', 'Number', 101),
(4, 'Grape', 'Number', 2),
(5, 'Mango', 'Number', 135),
(6, 'Orange', 'Number', 71),
(7, 'Strawberry', 'Cup', 53),
(8, 'Broccoli', 'Cup', 40),
(9, 'Carrots', 'Cup', 45),
(10, 'Cucumber', 'Number', 30),
(11, 'Tomato', 'Cup', 29),
(12, 'Chicken', 'Slice', 95),
(13, 'Egg', 'Number', 79),
(14, 'Fish', 'Slice', 80),
(15, 'Pork', 'Slice', 130),
(16, 'Bread', 'Slice', 75),
(17, 'Butter', 'Spoon', 102),
(18, 'Chocolate', 'Spoon', 150),
(19, 'Corn', 'Cup', 140),
(20, 'Pizza', 'Slice', 180),
(21, 'Potato', 'Number', 120),
(22, 'Beer', 'Can', 150),
(23, 'Cocacola', 'Cup', 97),
(24, 'Dietcoke', 'Cup', 3),
(25, 'Milk_lowfat', 'Cup', 104),
(26, 'Milk_whole', 'Cup', 150),
(27, 'Yogurt', 'Cup', 200);

-- --------------------------------------------------------

--
-- Table structure for table `liked`
--

CREATE TABLE IF NOT EXISTS `liked` (
  `like_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `like_num` int(11) DEFAULT '0',
  `dislike_num` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `liked`
--

INSERT INTO `liked` (`like_id`, `post_id`, `user_id`, `like_num`, `dislike_num`) VALUES
(1, 4, 8, 1, 0),
(2, 1, 11, 1, 0),
(3, 6, 16, 1, 0),
(4, 6, 8, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `portfolio_profile`
--

CREATE TABLE IF NOT EXISTS `portfolio_profile` (
  `portfolio_id` int(11) NOT NULL,
  `reg_id` int(11) NOT NULL,
  `user_height` int(11) NOT NULL,
  `user_weight` int(11) NOT NULL,
  `user_age` int(11) NOT NULL,
  `user_sex` varchar(50) NOT NULL,
  `user_activity` int(11) NOT NULL,
  `calorie_needed` int(11) NOT NULL,
  `user_bmi` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `portfolio_profile`
--

INSERT INTO `portfolio_profile` (`portfolio_id`, `reg_id`, `user_height`, `user_weight`, `user_age`, `user_sex`, `user_activity`, `calorie_needed`, `user_bmi`) VALUES
(3, 16, 180, 79, 21, 'male', 3, 2963, 24),
(4, 17, 160, 49, 20, 'female', 1, 786, 19),
(5, 8, 178, 69, 22, 'male', 4, 3031, 22);

-- --------------------------------------------------------

--
-- Table structure for table `portfolio_userbmi`
--

CREATE TABLE IF NOT EXISTS `portfolio_userbmi` (
  `id` int(11) NOT NULL,
  `portfolio_id` int(11) DEFAULT NULL,
  `bmi_points` text
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `portfolio_userbmi`
--

INSERT INTO `portfolio_userbmi` (`id`, `portfolio_id`, `bmi_points`) VALUES
(7, 3, '31.11'),
(8, 3, '31.25'),
(9, 3, '33.33'),
(10, 3, '25.95'),
(11, 4, '19.14'),
(12, 3, '30.86'),
(13, 3, '30.86'),
(14, 5, '21.22'),
(15, 5, '21.78'),
(16, 3, '24.38');

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE IF NOT EXISTS `profile` (
  `id` int(11) NOT NULL,
  `birthplace` text NOT NULL,
  `contact` int(50) NOT NULL,
  `usersex` varchar(30) NOT NULL,
  `dob` date NOT NULL,
  `biography` text NOT NULL,
  `image` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`id`, `birthplace`, `contact`, `usersex`, `dob`, `biography`, `image`) VALUES
(8, 'kathmandu', 9860000, 'male', '1996-02-05', 'Kathmandu University', 0x636172322e6a7067),
(10, 'kathmandu', 2147483647, 'Male', '1990-12-25', 'hello all', 0x696e74656c2e6a7067),
(15, 'baglung', 9869000, 'male', '2010-02-03', 'Learning IT', 0x66622e706e67),
(16, '', 0, '', '0000-00-00', '', ''),
(17, '', 0, '', '0000-00-00', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `recipe`
--

CREATE TABLE IF NOT EXISTS `recipe` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `ingredients` text NOT NULL,
  `direction` text NOT NULL,
  `time` text NOT NULL,
  `image` mediumblob NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `keyword` varchar(255) NOT NULL,
  `total_calorie` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `recipe`
--

INSERT INTO `recipe` (`id`, `title`, `ingredients`, `direction`, `time`, `image`, `user_id`, `date`, `keyword`, `total_calorie`) VALUES
(1, 'Paneer cauli', 'paneer,cauliflower,coriander,brocauli,cheese', 'Directions...\r\n1. Boil the cauliflower and brocauli.\r\n2.Then add spices in the boiled items.\r\n3.The fry out panner.\r\n4.Add cheese,paneer and mix masala then its ready ', '15 Minutes', 0x6361756c692e6a7067, 8, '2017-08-12 00:32:10', 'cauli,cauliflower,brocauli,panner,cheese', 1500),
(2, 'Potato roll', 'potato-paste,tomato,salt,cheese,cabbage', 'Directions... \r\n1.Make potato-paste with fine small pieces of potato cuts\r\n2.Add boiled cheese  with salt and cut pieces of tomatoes within it', '5 Minutes', 0x6b61692e6a7067, 8, '2017-08-12 00:35:12', 'potato,cheese,cabbage,roll', 1550),
(3, 'Cauli sausage', 'chicken-sausage,cauliflower,potato,salt', 'Directions... \r\n1. Boil the cauliflower\r\n2.Add masala and salt to it.\r\n3.Fry the potato.\r\n4.Mix this with the boiled items.\r\n5.Add sausage to it', '8 Minutes', 0x736175736167655f6361756c692e6a7067, 8, '2017-08-12 00:37:48', 'chicken,sausage,cauliflower,potato', 1600),
(4, 'Chicken momo', 'chicken,flour,tomato-soup', 'Directions... \r\n1. make keema of chicken meat\r\n2. add it with flour item.\r\n3.Steam it for 14 min', '20 Minutes', 0x6d6f6d6f2e6a7067, 8, '2017-08-12 00:39:59', 'momo,chicken', 2150),
(5, 'Burger', 'chicken,cabbage,tomato,cheese,bread', 'Directions... \n1.take the two cut pieces of bread.\n2.Add thin slice of tomato and cheese within it.\n4.Add chicken meat inside it.\n3.Then it is ready to eat.', '10 Minutes', 0x4261636b67726f756e642e6a7067, 8, '2017-08-12 00:42:46', 'burger,chicken,cheese,cabbage', 2500),
(6, 'Aaloo Paratha', 'Corn, potato', '1. Boil Potato <br>\n2. Add water to corn <br>\n3. Mix it <br>\n4. Cook for 5 mins <br>\n5. Serve <br>', '5 Minutes', 0x6361756c692e6a7067, 16, '2017-08-13 04:16:47', 'Aaloo Paratha', 520);

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE IF NOT EXISTS `register` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` text NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`id`, `firstname`, `lastname`, `email`, `username`, `password`, `role`) VALUES
(8, 'bipul', 'thapa', 'bipulthapa10@gmail.com', 'bipul', 'e2fc714c4727ee9395f324cd2e7f331f', 'user'),
(10, 'sample', 'one', 'sample@sample.com', 'sample', '81dc9bdb52d04dc20036dbd8313ed055', 'user'),
(15, 'sample', 'Two', 'sample2@gmail.com', 'sample2', '81dc9bdb52d04dc20036dbd8313ed055', 'user'),
(16, 'Dipesh', 'Rai', 'Dipesh_Rai78@gmail.com', 'dipesh', '81dc9bdb52d04dc20036dbd8313ed055', 'user'),
(17, 'Elina', 'Baral', 'elina@gmail.com', 'elina', 'b0c39b2b615a250c8ebf9a4a0d323686', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `reply`
--

CREATE TABLE IF NOT EXISTS `reply` (
  `reply_id` int(11) NOT NULL,
  `cmnt_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `reply_text` text NOT NULL,
  `reply_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reply`
--

INSERT INTO `reply` (`reply_id`, `cmnt_id`, `username`, `reply_text`, `reply_date`) VALUES
(1, 1, 'sample', 'Yes it looks delicious. Thanks for this recipe! I am gonna try this out.', '2017-08-12 00:54:18'),
(2, 5, 'sample2', 'this post really help people make delicious dishes', '2017-08-12 01:01:02'),
(3, 3, 'sample2', 'Yes sure we can', '2017-08-12 01:03:15'),
(4, 2, 'bipul', 'Your welcome!', '2017-08-12 01:22:04'),
(5, 3, 'sample', 'Please answer this?', '2017-08-12 03:10:18'),
(6, 3, 'sample2', 'I have successfully done this', '2017-08-12 06:19:52'),
(7, 6, 'dipesh', 'woo\r\n', '2017-08-13 11:32:51');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`cmnt_id`);

--
-- Indexes for table `liked`
--
ALTER TABLE `liked`
  ADD PRIMARY KEY (`like_id`);

--
-- Indexes for table `portfolio_profile`
--
ALTER TABLE `portfolio_profile`
  ADD PRIMARY KEY (`portfolio_id`),
  ADD UNIQUE KEY `reg_id` (`reg_id`);

--
-- Indexes for table `portfolio_userbmi`
--
ALTER TABLE `portfolio_userbmi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `portfolio_id` (`portfolio_id`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `recipe`
--
ALTER TABLE `recipe`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `reply`
--
ALTER TABLE `reply`
  ADD PRIMARY KEY (`reply_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `cmnt_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `liked`
--
ALTER TABLE `liked`
  MODIFY `like_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `portfolio_profile`
--
ALTER TABLE `portfolio_profile`
  MODIFY `portfolio_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `portfolio_userbmi`
--
ALTER TABLE `portfolio_userbmi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `recipe`
--
ALTER TABLE `recipe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `register`
--
ALTER TABLE `register`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `reply`
--
ALTER TABLE `reply`
  MODIFY `reply_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `portfolio_userbmi`
--
ALTER TABLE `portfolio_userbmi`
  ADD CONSTRAINT `portfolio_userbmi_ibfk_1` FOREIGN KEY (`portfolio_id`) REFERENCES `portfolio_profile` (`portfolio_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
