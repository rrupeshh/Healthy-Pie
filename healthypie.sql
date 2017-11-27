-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 12, 2017 at 08:24 AM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

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

CREATE TABLE `comment` (
  `cmnt_id` int(11) NOT NULL,
  `recipe_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`cmnt_id`, `recipe_id`, `username`, `comment`, `date`) VALUES
(1, 4, 'bipul', 'This looks delicious :)', '2017-08-12 00:50:29'),
(2, 4, 'sample', 'Thank you for the recipe', '2017-08-12 00:54:52'),
(3, 5, 'sample', 'Can we make veg,mutton burger from this recipe?', '2017-08-12 00:55:35'),
(4, 3, 'sample', 'Cauli sausage new to me so I am gonna sure try this. Thanks for the post', '2017-08-12 00:56:11'),
(5, 2, 'sample', 'Thanks for the post', '2017-08-12 00:57:38');

-- --------------------------------------------------------

--
-- Table structure for table `liked`
--

CREATE TABLE `liked` (
  `like_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `like_num` int(11) DEFAULT '0',
  `dislike_num` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `liked`
--

INSERT INTO `liked` (`like_id`, `post_id`, `user_id`, `like_num`, `dislike_num`) VALUES
(1, 4, 8, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
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
(15, 'baglung', 9869000, 'male', '2010-02-03', 'Learning IT', 0x66622e706e67);

-- --------------------------------------------------------

--
-- Table structure for table `recipe`
--

CREATE TABLE `recipe` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `ingredients` text NOT NULL,
  `direction` text NOT NULL,
  `time` time NOT NULL,
  `image` mediumblob NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `keyword` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `recipe`
--

INSERT INTO `recipe` (`id`, `title`, `ingredients`, `direction`, `time`, `image`, `user_id`, `date`, `keyword`) VALUES
(1, 'paneer cauli', 'paneer,cauliflower,coriander,brocauli,cheese', 'Directions...\r\n1. Boil the cauliflower and brocauli.\r\n2.Then add spices in the boiled items.\r\n3.The fry out panner.\r\n4.Add cheese,paneer and mix masala then its ready ', '00:00:15', 0x6361756c692e6a7067, 8, '2017-08-12 00:32:10', 'cauli,cauliflower,brocauli,panner,cheese'),
(2, 'potato roll', 'potato-paste,tomato,salt,cheese,cabbage', 'Directions... \r\n1.Make potato-paste with fine small pieces of potato cuts\r\n2.Add boiled cheese  with salt and cut pieces of tomatoes within it', '00:00:05', 0x6b61692e6a7067, 8, '2017-08-12 00:35:12', 'potato,cheese,cabbage,roll'),
(3, 'cauli sausage', 'chicken-sausage,cauliflower,potato,salt', 'Directions... \r\n1. Boil the cauliflower\r\n2.Add masala and salt to it.\r\n3.Fry the potato.\r\n4.Mix this with the boiled items.\r\n5.Add sausage to it', '00:00:08', 0x736175736167655f6361756c692e6a7067, 8, '2017-08-12 00:37:48', 'chicken,sausage,cauliflower,potato'),
(4, 'chciken momo', 'chicken,flour,tomato-soup', 'Directions... \r\n1. make keema of chicken meat\r\n2. add it with flour item.\r\n3.Steam it for 14 min', '00:00:20', 0x6d6f6d6f2e6a7067, 8, '2017-08-12 00:39:59', 'momo,chicken'),
(5, 'burger', 'chicken,cabbage,tomato,cheese,bread', 'Directions... \r\n1.take the two cut pieces of bread.\r\n2.Add thin slice of tomato and cheese within it.\r\n4.Add chicken meat inside it.\r\n3.Then it is ready to eat.', '00:00:05', 0x4261636b67726f756e642e6a7067, 8, '2017-08-12 00:42:46', 'burger,chicken,cheese,cabbage');

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` text NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`id`, `firstname`, `lastname`, `email`, `username`, `password`, `role`) VALUES
(8, 'bipul', 'thapa', 'bipulthapa10@gmail.com', 'bipul', 'e2fc714c4727ee9395f324cd2e7f331f', 'user'),
(10, 'sample', 'one', 'sample@sample.com', 'sample', '81dc9bdb52d04dc20036dbd8313ed055', 'user'),
(15, 'sample', 'Two', 'sample2@gmail.com', 'sample2', '81dc9bdb52d04dc20036dbd8313ed055', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `reply`
--

CREATE TABLE `reply` (
  `reply_id` int(11) NOT NULL,
  `cmnt_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `reply_text` text NOT NULL,
  `reply_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reply`
--

INSERT INTO `reply` (`reply_id`, `cmnt_id`, `username`, `reply_text`, `reply_date`) VALUES
(1, 1, 'sample', 'Yes it looks delicious. Thanks for this recipe! I am gonna try this out.', '2017-08-12 00:54:18'),
(2, 5, 'sample2', 'this post really help people make delicious dishes', '2017-08-12 01:01:02'),
(3, 3, 'sample2', 'Yes sure we can', '2017-08-12 01:03:15'),
(4, 2, 'bipul', 'Your welcome!', '2017-08-12 01:22:04'),
(5, 3, 'sample', 'Please answer this?', '2017-08-12 03:10:18'),
(6, 3, 'sample2', 'I have successfully done this', '2017-08-12 06:19:52');

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
  MODIFY `cmnt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `liked`
--
ALTER TABLE `liked`
  MODIFY `like_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `recipe`
--
ALTER TABLE `recipe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `register`
--
ALTER TABLE `register`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `reply`
--
ALTER TABLE `reply`
  MODIFY `reply_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
