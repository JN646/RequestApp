-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 04, 2019 at 01:40 PM
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
-- Table structure for table `field_schema`
--

CREATE TABLE `field_schema` (
  `schema_id` int(11) NOT NULL COMMENT 'Schema ID',
  `schema_name` varchar(255) DEFAULT NULL COMMENT 'Schema Name',
  `schema_f1` varchar(255) DEFAULT NULL COMMENT 'Field 1',
  `schema_f2` varchar(255) DEFAULT NULL COMMENT 'Field 2',
  `schema_f3` varchar(255) DEFAULT NULL COMMENT 'Field 3'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `field_schema`
--

INSERT INTO `field_schema` (`schema_id`, `schema_name`, `schema_f1`, `schema_f2`, `schema_f3`) VALUES
(1, 'Food', 'Food Group', 'Price', 'Size'),
(2, 'Lighting', 'Colour Code', 'Pattern', 'Speed'),
(3, 'Music', 'Artist', 'Genre', 'Year'),
(4, 'Presidents', 'Number', 'Party', 'Terms in Office'),
(5, 'Animals', 'Location', 'Size', 'Eat Fish?'),
(6, 'British Royal Family', 'King/Queen', 'House', '');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `item_id` int(11) NOT NULL COMMENT 'ID of the Item',
  `item_name` varchar(50) DEFAULT NULL COMMENT 'Name of the Item',
  `item_type` varchar(50) DEFAULT NULL COMMENT 'Type of the Item',
  `item_image` varchar(50) DEFAULT NULL COMMENT 'Item Image Path',
  `item_active` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Wether the item is active or not.',
  `item_notes` text COMMENT 'Item Notes',
  `item_price` decimal(10,2) DEFAULT '0.00' COMMENT 'Item Price',
  `item_schema` int(11) DEFAULT NULL COMMENT 'Item field schema',
  `item_f1` varchar(255) DEFAULT NULL COMMENT 'Field 1',
  `item_f2` varchar(255) DEFAULT NULL COMMENT 'Field 2',
  `item_f3` varchar(255) DEFAULT NULL COMMENT 'Field 3'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`item_id`, `item_name`, `item_type`, `item_image`, `item_active`, `item_notes`, `item_price`, `item_schema`, `item_f1`, `item_f2`, `item_f3`) VALUES
(1, 'Chocolate Cookies', '1', 'chocolatecookies.jpg', 1, 'Beat butter, sugar, eggs and vanilla in a large bowl until light and fluffy. Combine flour, cocoa, bicarb and salt in a small bowl; stir into butter mixture until well blended. Mix in chocolate chips and walnuts. Drop by rounded teaspoonfuls onto ungreased baking trays.', '1.00', 1, 'Dessert', '', ''),
(2, 'Turnip', '1', 'turnip.jpg', 1, NULL, '1.00', 1, 'Vegetable', NULL, NULL),
(3, 'Dog', '2', 'dog.jpg', 1, 'Dogs are a type of animal.', '200.00', 5, 'Land', 'Medium', 'No'),
(4, 'Egg Plant', '1', 'eggplant.jpg', 1, NULL, '1.00', 1, 'Vegetable', '£1.20', 'Small'),
(5, 'Turn Down For What', '3', NULL, 1, NULL, '0.00', 3, 'Lil Jon', NULL, NULL),
(6, 'Tuna Pizza', '1', 'tunapizza.jpg', 1, NULL, '8.20', 1, 'Pizza', '£8.00', 'Large'),
(7, 'Red', '4', 'red.jpg', 1, NULL, '0.00', 2, 'RGB(255,0,0)', NULL, NULL),
(8, 'Blue', '4', 'blue.png', 0, NULL, '0.00', 2, 'RGB(0,0,255)', NULL, NULL),
(9, 'Green', '4', 'green.jpg', 0, NULL, '0.00', 2, 'RGB(0,255,0)', NULL, NULL),
(10, 'Elephant', '2', 'elephant.jpg', 1, '', '0.00', 5, 'Mammal', 'Very Big', 'No'),
(11, 'Dancing Queen', '3', NULL, 1, NULL, '0.00', 3, 'ABBA', 'Pop', NULL),
(12, 'Shake Rattle and Roll', '3', NULL, 1, NULL, '0.00', 3, NULL, NULL, NULL),
(13, 'Lemon Cake', '1', 'lemoncake.jpg', 1, 'This wonderfully simple lemon drizzle is super-quick to prepare and perfect for weekend baking with the kids.', '2.00', 1, 'Dessert', '', ''),
(14, 'Yellow', '4', 'yellow.jpg', 1, NULL, '3.15', 2, NULL, NULL, NULL),
(15, 'Pink', '4', 'pink.png', 1, NULL, '3.00', 2, '', '', ''),
(16, 'Carrots', '1', 'carrot.jpg', 0, 'Carrot, Daucus carota, is an edible, biennial herb in the family Apiaceae grown for its edible root. The carrot plant produces a rosette of 8–12 leaves above ground and a fleshy conical taproot below ground. The plant produces small (2 mm) flowers which are white, red or purple in colour.', '1.00', 1, 'Vegetable', '£0.80', 'Small'),
(17, 'Theresa May', '5', 'TheresaMay.jpg', 1, 'The woman.', '-10.00', 4, '', '', ''),
(18, 'Donald Trump', '5', 'Potus45.jpg', 1, NULL, '0.00', 4, '45', 'Republican', '1'),
(19, 'George Washington', '5', 'Potus1.jpg', 0, NULL, '0.00', 4, '1', NULL, NULL),
(20, 'John Adams', '5', 'Potus2.jpg', 0, NULL, '0.00', 4, '2', NULL, NULL),
(21, 'Thomas Jefferson', '5', 'Potus3.jpg', 0, NULL, '0.00', 4, '3', NULL, NULL),
(22, 'James Madison', '5', 'Potus4.jpg', 0, NULL, '0.00', 4, '4', NULL, NULL),
(23, 'James Monroe', '5', 'Potus5.jpg', 0, NULL, '0.00', 4, '5', NULL, NULL),
(24, 'John Quincy Adams', '5', 'Potus6.jpg', 0, NULL, '0.00', 4, '6', NULL, NULL),
(25, 'Andrew Jackson', '5', 'Potus7.jpg', 0, NULL, '0.00', 4, '7', NULL, NULL),
(26, 'Martin Van Buren', '5', 'Potus8.jpg', 0, NULL, '0.00', 4, '8', NULL, NULL),
(27, 'William Henry Harrison', '5', 'Potus9.jpg', 0, NULL, '0.00', 4, '9', NULL, NULL),
(28, 'John Tyler', '5', 'Potus10.jpg', 0, NULL, '0.00', 4, '10', NULL, NULL),
(29, 'Barack Obama', '5', 'Potus44.jpg', 1, NULL, '0.00', 4, '44', 'Democrat', '2'),
(30, 'George W Bush', '5', 'Potus43.jpg', 1, 'George Walker Bush was born on July 6, 1946, in New Haven, Connecticut. He is the eldest of six children of George Herbert Walker Bush and Barbara Pierce Bush. The Bush family had been involved in business and politics since the 1950s. Bush&#039;s grandfather, Prescott Bush, was a former Wall Street banker and progressive Republican senator from Connecticut, and his father was a businessman, diplomat, and vice president and president of the United States.\r\n\r\nIn 1948, George H.W. Bush moved the family to Midland, Texas, where he made his fortune in the oil business. Young George spent most of his childhood in Midland, attending school there until the seventh grade. The family moved to Houston in 1961, and George W. Bush was sent to Phillips Academy in Andover, Massachusetts. There he was an all-around athlete, playing baseball, basketball and football. He was a fair student and had a reputation for being an occasional troublemaker. Despite this, family connections helped him enter Yale University in 1964.\r\n\r\nGeorge W. Bush was a popular student at Yale, becoming president of the Delta Kappa Epsilon fraternity and also playing rugby. For Bush, grades took a back seat to Yale’s social life. Despite his privileged background, he was comfortable with all kinds of people and had a wide circle of friends and acquaintances. Like his father and grandfather before him, George W. Bush became a member of Yale’s secretive Skull and Bones society, an invitation-only club whose membership contains some of American’s most powerful and elite family members.\r\n\r\nTwo weeks before graduation, at the end of his draft deferment, George W. Bush enlisted in the Texas Air National Guard. It was 1968 and the Vietnam War was at its height. Though the Guard unit had a long waiting list, Bush was accepted through the unsolicited help of a family friend. Commissioned as a second lieutenant, he earned his fighter pilot certification in June of 1970. Despite irregular attendance and questions about whether he had completely fulfilled his military obligation, Bush was honorably discharged from the Air Force Reserve on November 21, 1974.', '0.00', 4, '43', 'Republican', '2'),
(31, 'Bill Clinton', '5', 'Potus42.jpg', 1, 'Bill Clinton was the 42nd president of the United States, and the second to be impeached. He oversaw the country&#039;s longest peacetime economic expansion.', '2.25', 4, '42', 'Democrat', '2'),
(32, 'George H W Bush', '5', 'Potus41.jpg', 0, 'Bush became chairman of the Harris County Republican Party in 1963. The following year, he ran an unsuccessful campaign for a U.S. Senate seat in Texas. It didn&#039;t take long for Bush to enter Congress, however; in 1966, two years after his unsuccessful Senate bid, he was elected to the U.S. House of Representatives, ultimately serving two terms. Bush was later appointed to several important positions, including U.S. ambassador to the United Nations in 1971, head of the Republican National Committee during the Watergate scandal, U.S. envoy to China, and director of the Central Intelligence Agency in 1976.\r\n\r\nBush then set his sights on the U.S. presidency, but failed to win his party&#039;s nomination in 1980, losing it to his opponent, Ronald Reagan. Bush would make it to the White House soon after, however: He was chosen as Reagan&#039;s vice-presidential running mate. Reagan won the 1980 election, defeating Democrat challenger Jimmy Carter. He was re-elected in 1984, with Bush serving as his vice president for both terms.', '0.00', 4, '41', 'Republican', '1'),
(33, 'Ronald Reagan', '5', 'Potus40.jpg', 0, NULL, '40.00', 4, '40', 'Republican', '2'),
(34, 'Jimmy Carter', '5', 'Potus39.jpg', 1, 'James Earl Carter Jr. was born on October 1, 1924 in Plains, Georgia. His father, James Sr., was a hardworking peanut farmer who owned his own small plot of land as well as a warehouse and store. His mother, Bessie Lillian Gordy, was a registered nurse who in the 1920s had crossed racial divides to counsel black women on health care issues. \r\n\r\nWhen Jimmy Carter was four years old, the family relocated to Archery, a town approximately two miles from Plains. It was a sparsely populated and deeply rural town, where mule-drawn wagons remained the dominant mode of transportation and electricity and indoor plumbing were still uncommon. Carter was a studious boy who avoided trouble and began working at his father&#039;s store at the age of ten. His favorite childhood pastime was sitting with his father in the evenings, listening to baseball games and politics on the battery-operated radio.', '39.00', 4, '39', 'Democrat', '1'),
(35, 'Gerald Ford', '5', 'Potus38.jpg', 0, NULL, '38.00', 4, '38', NULL, NULL),
(36, 'Richard Nixon', '5', 'Potus37.jpg', 0, NULL, '37.00', 4, '37', NULL, NULL),
(37, 'Lyndon B Johnson', '5', 'Potus36.jpg', 0, NULL, '36.00', 4, '36', NULL, NULL),
(38, 'John F Kennedy', '5', 'Potus35.jpg', 0, 'The early 1960s were tumultuous times for the United States and the world. To gain an understanding of this era, these essays provide brief discussions of the significant events that occurred during President Kennedy&#039;s years in office, and are intended to give you an overview of the challenges and issues that defined his administration.', '35.00', 4, '35', '', ''),
(39, 'James K Polk', '5', 'Potus11.jpg', 0, NULL, '11.00', 4, NULL, NULL, NULL),
(40, 'Zachary Taylor', '5', 'Potus12.jpg', 0, NULL, '12.00', 4, NULL, NULL, NULL),
(41, 'Millard Fillmore', '5', 'Potus13.jpg', 0, NULL, '13.00', 4, NULL, NULL, NULL),
(42, 'Franklin Pierce', '5', 'Potus14.jpg', 0, NULL, '14.00', 4, NULL, NULL, NULL),
(43, 'James Buchanan', '5', 'Potus15.jpg', 0, NULL, '15.00', 4, NULL, NULL, NULL),
(44, 'Abraham Lincoln', '5', 'Potus16.jpg', 0, '', '16.00', 4, '16', '', ''),
(45, 'Andrew Johnson', '5', 'Potus17.jpg', 0, NULL, '17.00', 4, NULL, NULL, NULL),
(46, 'Ulysses S Grant', '5', 'Potus18.jpg', 0, NULL, '18.00', 4, NULL, NULL, NULL),
(47, 'Rutherford B Hayes', '5', 'Potus19.jpg', 0, NULL, '19.00', 4, NULL, NULL, NULL),
(48, 'James A Garfield', '5', 'Potus20.jpg', 0, NULL, '20.00', 4, NULL, NULL, NULL),
(49, 'Chester A Arthur', '5', 'Potus21.jpg', 0, NULL, '21.00', 4, NULL, NULL, NULL),
(50, 'Grover Cleveland', '5', 'Potus22.jpg', 0, NULL, '22.00', 4, NULL, NULL, NULL),
(51, 'Benjamin Harrison', '5', 'Potus23.jpg', 0, NULL, '0.00', 4, '23', NULL, NULL),
(52, 'William McKinley', '5', 'Potus25.jpg', 0, NULL, '0.00', 4, '25', NULL, NULL),
(53, 'Theodore Roosevelt', '5', 'Potus26.jpg', 0, NULL, '0.00', 4, '26', NULL, NULL),
(54, 'William Howard Taft', '5', 'Potus27.jpg', 0, NULL, '0.00', 4, '27', NULL, NULL),
(55, 'Woodrow Wilson', '5', 'Potus28.jpg', 0, NULL, '0.00', 4, '28', NULL, NULL),
(56, 'Warren G Harding', '5', 'Potus29.jpg', 0, NULL, '0.00', 4, '29', NULL, NULL),
(57, 'Calvin Coolidge', '5', 'Potus30.jpg', 0, NULL, '0.00', 4, '30', NULL, NULL),
(58, 'Herbert Hoover', '5', 'Potus31.jpg', 0, NULL, '0.00', 4, '31', NULL, NULL),
(59, 'Franklin D Roosevelt', '5', 'Potus32.jpg', 0, NULL, '0.00', 4, '32', NULL, NULL),
(60, 'Harry S Truman', '5', 'Potus33.jpg', 0, NULL, '0.00', 4, '33', NULL, NULL),
(61, 'Dwight D Eisenhower', '5', 'Potus34.jpg', 0, NULL, '0.00', 4, '34', NULL, NULL),
(63, 'Bacon', '1', 'bacon.png', 1, 'Bacon is good.', '0.00', 1, 'Food', '', ''),
(64, 'Lemons', '1', '', 0, 'Lemons are bad.', '0.00', NULL, '', '', ''),
(65, 'Meerkat', '2', '', 0, '', '8.00', 5, 'Rodent', 'Small', 'No'),
(66, 'Cat', '2', 'cat.jpg', 1, 'Cats are very good, because they sleep.', '40.00', 5, 'Land', 'Small', 'Yes'),
(67, 'Whole Lotta Shakin Goin On', '3', '', 1, 'This is a good song.', '0.00', NULL, 'Jerry Lee Lewis', 'Rock and Roll', '1956'),
(68, 'Pop', '3', '', 1, '', '0.00', NULL, '', '', ''),
(69, 'Rock', '3', '', 1, '', '0.00', NULL, '', '', ''),
(70, 'Hip-Hop', '3', '', 1, '', '0.00', NULL, '', '', ''),
(71, 'Eggs', '1', '', 1, '', '0.00', 1, '', '', ''),
(72, 'Turkey', '1', 'turkey.jpg', 1, 'The Christmas Item.', '0.00', 1, '', '', ''),
(73, 'Salmon', '6', 'salmon.jpg', 1, 'The fish.', '19.00', NULL, '', '', ''),
(74, 'Elizabeth II', '10', 'elizabeth2.jpg', 1, 'The current Queen.', '6.50', 6, 'Queen', 'Windsor', ''),
(75, 'George VI', '10', 'george6.jpg', 0, 'He never wanted to be king.', '3.00', 6, 'King', 'Windsor', ''),
(76, 'Edward VIII', '10', 'edward8.jpg', 0, 'Abdicated!', '3.00', 6, 'King', 'Windsor', '');

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `location_id` int(11) NOT NULL COMMENT 'Location ID',
  `location_name` varchar(255) DEFAULT NULL COMMENT 'Location Name',
  `location_description` text COMMENT 'Location Description'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`location_id`, `location_name`, `location_description`) VALUES
(1, 'Table 1', 'The first table.'),
(2, 'Table 2', 'The second table.'),
(3, 'Booth 1', 'This is a large booth that can hold 6 people. And features a long description to test what large values will look like.'),
(4, 'Booth 2', 'London'),
(5, 'Booth 3', 'Sydney'),
(6, 'Booth 4', 'Washington DC'),
(7, 'Booth 5', 'Paris');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `session_id` int(11) NOT NULL COMMENT 'The session ID',
  `session_start` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Session start time',
  `session_end` timestamp NULL DEFAULT NULL COMMENT 'Session end time',
  `session_paid` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Has the session been paid',
  `session_closed` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Has the session been closed?',
  `session_location_id` int(11) DEFAULT NULL COMMENT 'Session Location ID'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`session_id`, `session_start`, `session_end`, `session_paid`, `session_closed`, `session_location_id`) VALUES
(38, '2019-01-03 16:30:53', NULL, 0, 1, 3),
(39, '2019-01-03 19:53:23', NULL, 0, 1, 1),
(40, '2019-01-03 22:45:48', NULL, 0, 1, 3),
(41, '2019-01-03 22:54:58', NULL, 0, 1, 3),
(42, '2019-01-03 23:13:34', NULL, 0, 1, 3),
(43, '2019-01-03 23:26:00', NULL, 0, 1, 3),
(44, '2019-01-03 23:27:00', NULL, 0, 1, 3),
(45, '2019-01-03 23:57:04', NULL, 0, 1, 1),
(46, '2019-01-04 00:07:21', NULL, 0, 1, 3),
(47, '2019-01-04 00:07:55', NULL, 0, 1, 1),
(48, '2019-01-04 00:10:04', NULL, 0, 1, 3),
(49, '2019-01-04 00:11:38', NULL, 0, 1, 1),
(50, '2019-01-04 00:12:22', '2019-01-04 00:12:24', 0, 1, 2),
(51, '2019-01-04 00:15:14', '2019-01-04 00:53:33', 0, 1, 3),
(52, '2019-01-04 00:53:36', '2019-01-04 11:24:54', 0, 1, 2),
(53, '2019-01-04 11:09:57', '2019-01-04 13:02:23', 0, 1, 3),
(54, '2019-01-04 11:25:00', NULL, 0, 0, 2),
(55, '2019-01-04 13:10:09', NULL, 0, 0, 3);

-- --------------------------------------------------------

--
-- Table structure for table `transaction_log`
--

CREATE TABLE `transaction_log` (
  `trans_id` int(11) NOT NULL COMMENT 'Transaction ID',
  `trans_session_id` int(11) DEFAULT NULL COMMENT 'Transaction Session ID',
  `trans_item_id` int(11) DEFAULT NULL COMMENT 'Transaction Item ID',
  `trans_type_id` int(11) DEFAULT NULL COMMENT 'Transaction Type ID',
  `trans_time` datetime DEFAULT CURRENT_TIMESTAMP COMMENT 'Transaction Time',
  `trans_delivered` tinyint(1) DEFAULT '0' COMMENT 'Has the item been delivered to the customer?'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `transaction_log`
--

INSERT INTO `transaction_log` (`trans_id`, `trans_session_id`, `trans_item_id`, `trans_type_id`, `trans_time`, `trans_delivered`) VALUES
(9, 1, 10, 2, '2018-12-14 12:44:46', 1),
(10, 1, 1, 1, '2018-12-14 12:45:03', 1),
(11, 1, 31, 5, '2018-12-14 13:28:32', 0),
(12, 1, 6, 1, '2018-12-14 13:43:25', 1),
(13, 1, 14, 4, '2018-12-14 14:18:20', 1),
(14, 1, 17, 5, '2018-12-14 20:45:25', 0),
(15, 1, 31, 5, '2018-12-16 20:11:10', 0),
(16, 1, 2, 1, '2018-12-26 14:21:58', 0),
(17, 2, 14, 4, '2018-12-26 14:23:50', 0),
(18, 3, 15, 4, '2018-12-29 23:43:11', 0),
(19, 38, 10, 2, '2019-01-03 16:35:41', 0),
(20, 40, 1, 1, '2019-01-03 22:51:25', 1),
(21, 40, 74, 10, '2019-01-03 22:51:29', 1),
(22, 51, 29, 5, '2019-01-04 00:15:23', 1),
(23, 51, 18, 5, '2019-01-04 00:15:26', 0),
(24, 51, 34, 5, '2019-01-04 00:15:31', 0);

-- --------------------------------------------------------

--
-- Table structure for table `types`
--

CREATE TABLE `types` (
  `type_id` int(11) NOT NULL COMMENT 'The ID of the Type',
  `type_name` varchar(50) NOT NULL COMMENT 'The Name of the Type',
  `type_icon` varchar(250) DEFAULT NULL COMMENT 'Icon of the type',
  `type_active` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Is the type active?'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `types`
--

INSERT INTO `types` (`type_id`, `type_name`, `type_icon`, `type_active`) VALUES
(1, 'Food', '<i class=\"fas fa-apple-alt\"></i>', 1),
(2, 'Animal', '<i class=\"fas fa-paw\"></i>', 1),
(3, 'Music', '<i class=\"fas fa-music\"></i>', 0),
(4, 'Lights', '<i class=\"far fa-lightbulb\"></i>', 1),
(5, 'US Presidents', '<i class=\"fas fa-users\"></i>', 1),
(6, 'Fish', '<i class=\'fas fa-fish\'></i>', 1),
(10, 'British Royal Family', '<i class=\"fas fa-crown\"></i>', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `field_schema`
--
ALTER TABLE `field_schema`
  ADD PRIMARY KEY (`schema_id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`location_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`session_id`);

--
-- Indexes for table `transaction_log`
--
ALTER TABLE `transaction_log`
  ADD PRIMARY KEY (`trans_id`);

--
-- Indexes for table `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`type_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `field_schema`
--
ALTER TABLE `field_schema`
  MODIFY `schema_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Schema ID', AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID of the Item', AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `location_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Location ID', AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `session_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'The session ID', AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `transaction_log`
--
ALTER TABLE `transaction_log`
  MODIFY `trans_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Transaction ID', AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `types`
--
ALTER TABLE `types`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'The ID of the Type', AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
