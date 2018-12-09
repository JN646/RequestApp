-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 09, 2018 at 03:54 PM
-- Server version: 5.7.23
-- PHP Version: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `RequestApp`
--

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `item_id` int(11) NOT NULL COMMENT 'ID of the Item',
  `item_name` varchar(50) DEFAULT NULL COMMENT 'Name of the Item',
  `item_type` varchar(50) DEFAULT NULL COMMENT 'Type of the Item',
  `item_image` varchar(50) DEFAULT NULL COMMENT 'Item Image Path',
  `item_active` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Wether the item is active or not.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`item_id`, `item_name`, `item_type`, `item_image`, `item_active`) VALUES
(1, 'Chocolate Cookies', '1', 'chocolatecookies.jpg', 1),
(2, 'Turnip', '1', 'turnip.jpg', 1),
(3, 'Dog', '2', 'dog.jpg', 1),
(4, 'Egg Plant', '1', 'eggplant.jpg', 1),
(5, 'Turn Down For What', '3', NULL, 1),
(6, 'Tuna Pizza', '1', 'tunapizza.jpg', 1),
(7, 'Red', '4', 'red.jpg', 1),
(8, 'Blue', '4', 'blue.png', 1),
(9, 'Green', '4', 'green.jpg', 1),
(10, 'Elephant', '2', 'elephant.jpg', 1),
(11, 'Dancing Queen', '3', NULL, 1),
(12, 'Shake Rattle and Roll', '3', NULL, 1),
(13, 'Lemon Cake', '1', 'lemoncake.jpg', 1),
(14, 'Yellow', '4', 'yellow.jpg', 1),
(15, 'Pink', '4', 'pink.png', 1),
(16, 'Carrots', '1', 'carrot.jpg', 0),
(17, 'Theresa May', '5', 'TheresaMay.jpg', 1),
(18, 'Donald Trump', '5', 'Potus45.jpg', 1),
(19, 'George Washington', '5', 'Potus1.jpg', 0),
(20, 'John Adams', '5', 'Potus2.jpg', 0),
(21, 'Thomas Jefferson', '5', 'Potus3.jpg', 0),
(22, 'James Madison', '5', 'Potus4.jpg', 0),
(23, 'James Monroe', '5', 'Potus5.jpg', 0),
(24, 'John Quincy Adams', '5', 'Potus6.jpg', 0),
(25, 'Andrew Jackson', '5', 'Potus7.jpg', 0),
(26, 'Martin Van Buren', '5', 'Potus8.jpg', 0),
(27, 'William Henry Harrison', '5', 'Potus9.jpg', 0),
(28, 'John Tyler', '5', 'Potus10.jpg', 0),
(29, 'Barack Obama', '5', 'Potus44.jpg', 1),
(30, 'George W Bush', '5', 'Potus43.jpg', 1),
(31, 'Bill Clinton', '5', 'Potus42.jpg', 1),
(32, 'George H W Bush', '5', 'Potus41.jpg', 0),
(33, 'Ronald Reagan', '5', 'Potus40.jpg', 0),
(34, 'Jimmy Carter', '5', 'Potus39.jpg', 1),
(35, 'Gerald Ford', '5', 'Potus38.jpg', 0),
(36, 'Richard Nixon', '5', 'Potus37.jpg', 0),
(37, 'Lyndon B Johnson', '5', 'Potus36.jpg', 0),
(38, 'John F Kennedy', '5', 'Potus35.jpg', 0),
(39, 'James K Polk', '5', 'Potus11.jpg', 0),
(40, 'Zachary Taylor', '5', 'Potus12.jpg', 0),
(41, 'Millard Fillmore', '5', 'Potus13.jpg', 0),
(42, 'Franklin Pierce', '5', 'Potus14.jpg', 0),
(43, 'James Buchanan', '5', 'Potus15.jpg', 0),
(44, 'Abraham Lincoln', '5', 'Potus16.jpg', 0),
(45, 'Andrew Johnson', '5', 'Potus17.jpg', 0),
(46, 'Ulysses S Grant', '5', 'Potus18.jpg', 0),
(47, 'Rutherford B Hayes', '5', 'Potus19.jpg', 0),
(48, 'James A Garfield', '5', 'Potus20.jpg', 0),
(49, 'Chester A Arthur', '5', 'Potus21.jpg', 0),
(50, 'Grover Cleveland', '5', 'Potus22.jpg', 0),
(51, 'Benjamin Harrison', '5', 'Potus23.jpg', 0),
(52, 'William McKinley', '5', 'Potus25.jpg', 0),
(53, 'Theodore Roosevelt', '5', 'Potus26.jpg', 0),
(54, 'William Howard Taft', '5', 'Potus27.jpg', 0),
(55, 'Woodrow Wilson', '5', 'Potus28.jpg', 0),
(56, 'Warren G Harding', '5', 'Potus29.jpg', 0),
(57, 'Calvin Coolidge', '5', 'Potus30.jpg', 0),
(58, 'Herbert Hoover', '5', 'Potus31.jpg', 0),
(59, 'Franklin D Roosevelt', '5', 'Potus32.jpg', 0),
(60, 'Harry S Truman', '5', 'Potus33.jpg', 0),
(61, 'Dwight D Eisenhower', '5', 'Potus34.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `types`
--

CREATE TABLE `types` (
  `type_id` int(11) NOT NULL COMMENT 'The ID of the Type',
  `type_name` varchar(50) NOT NULL COMMENT 'The Name of the Type'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `types`
--

INSERT INTO `types` (`type_id`, `type_name`) VALUES
(1, 'Food'),
(2, 'Animal'),
(3, 'Music'),
(4, 'Lights'),
(5, 'People');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`type_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID of the Item', AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `types`
--
ALTER TABLE `types`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'The ID of the Type', AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
