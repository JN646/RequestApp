-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 12, 2018 at 06:20 PM
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
(4, 'Presidents', 'Number', 'Party', 'Terms in Office');

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
  `item_price` float DEFAULT NULL COMMENT 'Item Price',
  `item_schema` int(11) DEFAULT NULL COMMENT 'Item field schema',
  `item_f1` varchar(255) DEFAULT NULL COMMENT 'Field 1',
  `item_f2` varchar(255) DEFAULT NULL COMMENT 'Field 2',
  `item_f3` varchar(255) DEFAULT NULL COMMENT 'Field 3'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`item_id`, `item_name`, `item_type`, `item_image`, `item_active`, `item_notes`, `item_price`, `item_schema`, `item_f1`, `item_f2`, `item_f3`) VALUES
(1, 'Chocolate Cookies', '1', 'chocolatecookies.jpg', 1, NULL, NULL, 1, 'Dessert', NULL, NULL),
(2, 'Turnip', '1', 'turnip.jpg', 1, NULL, NULL, 1, 'Vegetable', NULL, NULL),
(3, 'Dog', '2', 'dog.jpg', 1, NULL, NULL, NULL, 'Canine', NULL, NULL),
(4, 'Egg Plant', '1', 'eggplant.jpg', 1, NULL, NULL, 1, 'Vegetable', '£1.20', 'Small'),
(5, 'Turn Down For What', '3', NULL, 1, NULL, NULL, 3, 'Lil Jon', NULL, NULL),
(6, 'Tuna Pizza', '1', 'tunapizza.jpg', 1, NULL, NULL, 1, 'Pizza', '£8.00', 'Large'),
(7, 'Red', '4', 'red.jpg', 2, NULL, NULL, 2, 'RGB(255,0,0)', NULL, NULL),
(8, 'Blue', '4', 'blue.png', 2, NULL, NULL, 2, 'RGB(0,0,255)', NULL, NULL),
(9, 'Green', '4', 'green.jpg', 2, NULL, NULL, 2, 'RGB(0,255,0)', NULL, NULL),
(10, 'Elephant', '2', 'elephant.jpg', 1, NULL, NULL, NULL, 'Mammal', NULL, NULL),
(11, 'Dancing Queen', '3', NULL, 1, NULL, NULL, 3, 'ABBA', NULL, NULL),
(12, 'Shake Rattle and Roll', '3', NULL, 1, NULL, NULL, 3, NULL, NULL, NULL),
(13, 'Lemon Cake', '1', 'lemoncake.jpg', 1, NULL, NULL, 1, 'Dessert', NULL, NULL),
(14, 'Yellow', '4', 'yellow.jpg', 1, NULL, NULL, 2, NULL, NULL, NULL),
(15, 'Pink', '4', 'pink.png', 1, NULL, NULL, 2, NULL, NULL, NULL),
(16, 'Carrots', '1', 'carrot.jpg', 0, '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum vitae dolor eget urna bibendum vestibulum nec at eros. Duis faucibus dictum cursus. Fusce scelerisque sapien et felis sagittis, ut interdum urna dignissim. Morbi sollicitudin nisl in euismod vehicula. Duis mollis justo ut quam malesuada, id blandit ligula maximus. Mauris accumsan fermentum feugiat. Vivamus id lectus nulla. Nulla egestas leo est, et condimentum velit finibus at. Aliquam erat volutpat. Ut sagittis lacus at libero consequat, nec dictum turpis fermentum. Aliquam in dictum velit. Curabitur dignissim id nisl a posuere. Nulla volutpat suscipit mi, a elementum nunc feugiat quis.</p>', NULL, 1, 'Vegetable', '£0.80', 'Small'),
(17, 'Theresa May', '5', 'TheresaMay.jpg', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(18, 'Donald Trump', '5', 'Potus45.jpg', 1, NULL, NULL, 4, '45', 'Republican', '1'),
(19, 'George Washington', '5', 'Potus1.jpg', 0, NULL, NULL, 4, '1', NULL, NULL),
(20, 'John Adams', '5', 'Potus2.jpg', 0, NULL, NULL, 4, '2', NULL, NULL),
(21, 'Thomas Jefferson', '5', 'Potus3.jpg', 0, NULL, NULL, 4, '3', NULL, NULL),
(22, 'James Madison', '5', 'Potus4.jpg', 0, NULL, NULL, 4, '4', NULL, NULL),
(23, 'James Monroe', '5', 'Potus5.jpg', 0, NULL, NULL, 4, '5', NULL, NULL),
(24, 'John Quincy Adams', '5', 'Potus6.jpg', 0, NULL, NULL, 4, '6', NULL, NULL),
(25, 'Andrew Jackson', '5', 'Potus7.jpg', 0, NULL, NULL, 4, '7', NULL, NULL),
(26, 'Martin Van Buren', '5', 'Potus8.jpg', 0, NULL, NULL, 4, '8', NULL, NULL),
(27, 'William Henry Harrison', '5', 'Potus9.jpg', 0, NULL, NULL, 4, '9', NULL, NULL),
(28, 'John Tyler', '5', 'Potus10.jpg', 0, NULL, NULL, 4, '10', NULL, NULL),
(29, 'Barack Obama', '5', 'Potus44.jpg', 1, NULL, NULL, 4, '44', 'Democrat', '2'),
(30, 'George W Bush', '5', 'Potus43.jpg', 1, NULL, NULL, 4, '43', 'Republican', '2'),
(31, 'Bill Clinton', '5', 'Potus42.jpg', 1, NULL, NULL, 4, '42', 'Republican', '2'),
(32, 'George H W Bush', '5', 'Potus41.jpg', 0, NULL, NULL, 4, '41', 'Republican', '1'),
(33, 'Ronald Reagan', '5', 'Potus40.jpg', 0, NULL, NULL, 4, '40', 'Republican', '2'),
(34, 'Jimmy Carter', '5', 'Potus39.jpg', 1, NULL, NULL, 4, '39', NULL, '1'),
(35, 'Gerald Ford', '5', 'Potus38.jpg', 0, NULL, NULL, 4, NULL, NULL, NULL),
(36, 'Richard Nixon', '5', 'Potus37.jpg', 0, NULL, NULL, 4, NULL, NULL, NULL),
(37, 'Lyndon B Johnson', '5', 'Potus36.jpg', 0, NULL, NULL, 4, NULL, NULL, NULL),
(38, 'John F Kennedy', '5', 'Potus35.jpg', 0, '&lt;p&gt;President Kennedy was assassinated on 22 November 1963 in Dallas, Texas. According to the Warren Commission established to investigate the assassination, a lone gunman, Lee Harvey Oswald, killed the president, but there has been consistent speculation ever since that Kennedy&#039;s death was the result of a conspiracy.&lt;/p&gt;\r\n&lt;p&gt;He was born John Fitzgerald Kennedy on 29 May 1917 in Massachusetts, into a wealthy and political Irish-American family. Educated at Harvard University, he graduated in 1940. Following naval service in the Pacific in World War Two, he entered politics in 1946, spurred on by his ambitious father Joseph, and won election as a Democrat to the US House of Representatives. In 1952, he was elected to the Senate.&lt;/p&gt;\r\n&lt;p&gt;In 1960, Kennedy won the party&#039;s presidential nomination and defeated Richard Nixon in the subsequent election that same year. At 43, he was the country&#039;s youngest president as well as its first Catholic head of state. He presented himself as a youthful president for a new generation. His wife Jackie added glamour to the presidency, although it was later revealed that he had numerous affairs.&lt;/p&gt;\r\n&lt;p&gt;Kennedy&#039;s years in power were marked in foreign affairs by Cold War tension, together with a rhetorical commitment to introducing domestic reforms - most of all to expanding the civil rights of African Americans.&lt;/p&gt;\r\n&lt;p&gt;He inherited a plan that was devised under the preceding Eisenhower presidency for anti-communist Cuban exiles in the US to invade Cuba and overthrow&amp;nbsp;&lt;a href=&quot;http://www.bbc.co.uk/history/people/fidel_castro&quot;&gt;Fidel Castro&#039;s&lt;/a&gt;&amp;nbsp;government. In April 1961, the &#039;Bay of Pigs&#039; invasion ended in failure. According to some historians, this led the Soviet Union to conclude that Kennedy was a weak leader, and that they could get away with installing nuclear weapons on Cuba in 1962. The Cuban missile crisis ensued. After a thirteen-day stand-off that brought the world to the brink of nuclear war, Soviet leader Nikita Kruschev withdrew the weapons and Kennedy&#039;s reputation was restored.&lt;/p&gt;\r\n&lt;p&gt;Domestically, Kennedy oversaw the desegregation of the University of Mississippi in 1962, and of the University of Alabama the following year - despite each state&#039;s political establishment opposing this policy. More substantial legislation to encode civil rights was not passed, however, until the subsequent administration of Lyndon Johnson (1963 - 1969), who was Vice-President and acceded to the position of President on Kennedy&amp;rsquo;s assassination.&lt;/p&gt;', NULL, 4, '', '', ''),
(39, 'James K Polk', '5', 'Potus11.jpg', 0, NULL, NULL, 4, NULL, NULL, NULL),
(40, 'Zachary Taylor', '5', 'Potus12.jpg', 0, NULL, NULL, 4, NULL, NULL, NULL),
(41, 'Millard Fillmore', '5', 'Potus13.jpg', 0, NULL, NULL, 4, NULL, NULL, NULL),
(42, 'Franklin Pierce', '5', 'Potus14.jpg', 0, NULL, NULL, 4, NULL, NULL, NULL),
(43, 'James Buchanan', '5', 'Potus15.jpg', 0, NULL, NULL, 4, NULL, NULL, NULL),
(44, 'Abraham Lincoln', '5', 'Potus16.jpg', 0, NULL, NULL, 4, NULL, NULL, NULL),
(45, 'Andrew Johnson', '5', 'Potus17.jpg', 0, NULL, NULL, 4, NULL, NULL, NULL),
(46, 'Ulysses S Grant', '5', 'Potus18.jpg', 0, NULL, NULL, 4, NULL, NULL, NULL),
(47, 'Rutherford B Hayes', '5', 'Potus19.jpg', 0, NULL, NULL, 4, NULL, NULL, NULL),
(48, 'James A Garfield', '5', 'Potus20.jpg', 0, NULL, NULL, 4, NULL, NULL, NULL),
(49, 'Chester A Arthur', '5', 'Potus21.jpg', 0, NULL, NULL, 4, NULL, NULL, NULL),
(50, 'Grover Cleveland', '5', 'Potus22.jpg', 0, NULL, NULL, 4, NULL, NULL, NULL),
(51, 'Benjamin Harrison', '5', 'Potus23.jpg', 0, NULL, NULL, 4, NULL, NULL, NULL),
(52, 'William McKinley', '5', 'Potus25.jpg', 0, NULL, NULL, 4, NULL, NULL, NULL),
(53, 'Theodore Roosevelt', '5', 'Potus26.jpg', 0, NULL, NULL, 4, NULL, NULL, NULL),
(54, 'William Howard Taft', '5', 'Potus27.jpg', 0, NULL, NULL, 4, NULL, NULL, NULL),
(55, 'Woodrow Wilson', '5', 'Potus28.jpg', 0, NULL, NULL, 4, NULL, NULL, NULL),
(56, 'Warren G Harding', '5', 'Potus29.jpg', 0, NULL, NULL, 4, NULL, NULL, NULL),
(57, 'Calvin Coolidge', '5', 'Potus30.jpg', 0, NULL, NULL, 4, NULL, NULL, NULL),
(58, 'Herbert Hoover', '5', 'Potus31.jpg', 0, NULL, NULL, 4, NULL, NULL, NULL),
(59, 'Franklin D Roosevelt', '5', 'Potus32.jpg', 0, NULL, NULL, 4, NULL, NULL, NULL),
(60, 'Harry S Truman', '5', 'Potus33.jpg', 0, NULL, NULL, 4, NULL, NULL, NULL),
(61, 'Dwight D Eisenhower', '5', 'Potus34.jpg', 0, NULL, NULL, 4, NULL, NULL, NULL),
(62, 'Salmons', '5', 'salmons.jpg', 1, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `transaction_log`
--

CREATE TABLE `transaction_log` (
  `trans_id` int(11) NOT NULL COMMENT 'Transaction ID',
  `trans_session_id` int(11) DEFAULT NULL COMMENT 'Transaction Session ID',
  `trans_item_id` int(11) DEFAULT NULL COMMENT 'Transaction Item ID',
  `trans_type_id` int(11) DEFAULT NULL COMMENT 'Transaction Type ID',
  `trans_time` datetime DEFAULT CURRENT_TIMESTAMP COMMENT 'Transaction Time'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  MODIFY `schema_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Schema ID', AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID of the Item', AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `transaction_log`
--
ALTER TABLE `transaction_log`
  MODIFY `trans_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Transaction ID';

--
-- AUTO_INCREMENT for table `types`
--
ALTER TABLE `types`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'The ID of the Type', AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
