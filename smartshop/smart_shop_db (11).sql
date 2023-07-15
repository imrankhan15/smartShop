-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 31, 2013 at 06:02 PM
-- Server version: 5.5.8-log
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `smart_shop_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `bank_history`
--

CREATE TABLE IF NOT EXISTS `bank_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `store_id` int(11) NOT NULL,
  `bank_name` varchar(200) NOT NULL,
  `branch_name` varchar(200) NOT NULL,
  `date` date NOT NULL,
  `description` varchar(200) NOT NULL,
  `bank_transaction_id` varchar(200) NOT NULL,
  `transaction_made_by` varchar(200) NOT NULL,
  `userId` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `store_id` (`store_id`),
  KEY `userId` (`userId`)
) ENGINE=InnoDB  DEFAULT CHARSET=ascii AUTO_INCREMENT=12 ;

--
-- Dumping data for table `bank_history`
--

INSERT INTO `bank_history` (`id`, `store_id`, `bank_name`, `branch_name`, `date`, `description`, `bank_transaction_id`, `transaction_made_by`, `userId`) VALUES
(1, 2, 'Bank Asia', 'Satkania', '2014-01-15', 'need to buy fan', '12345', 'Imran', 1),
(2, 1, 'Bank Asia', 'Station Road', '2014-03-06', 'For punjabi JR', '343434344', 'Mridul', 1),
(3, 1, 'bank asia, chittagong', 'Bangladesh', '0000-00-00', 'Making a new transaction', '234234', 'Mital', 1),
(4, 2, 'dxfv', 'xcv', '2014-03-06', 'xcv', 'xcv', 'Hira', 1),
(5, 1, 'Sonali Bank', 'Sonali Bank', '2013-12-31', 'Cash Give to Punjabi Haroon', '222', 'Abid', 1),
(7, 1, 'bank asia', 'Station Road', '2013-12-31', 'Buying new furniture', '22334545', 'Jibon', 1),
(8, 1, 'Bank Asia', '1 rj street, chittagong', '2013-12-31', 'Buy new shirt from jabed', '0123456789', 'Imran', 1),
(9, 2, 'Bank Asia', '1 rj street, chittagong', '2013-12-31', 'Go to Singaphore for shirts', '0131233344', 'Ibrahim', 3),
(10, 1, 'Bank Asia', '1, Station Road, Reazuddin Bazar', '2013-12-31', 'payment to supplier', '112233334', 'Imam', 1),
(11, 1, 'bank Asia', '1, ab street. dhaka', '2013-12-31', 'go to Singaphore', '112233', 'Miran', 1);

-- --------------------------------------------------------

--
-- Table structure for table `buy`
--

CREATE TABLE IF NOT EXISTS `buy` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `supplier_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `store_id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=ascii AUTO_INCREMENT=13 ;

--
-- Dumping data for table `buy`
--

INSERT INTO `buy` (`id`, `supplier_id`, `date`, `store_id`, `userId`) VALUES
(1, 1, '2013-12-31', 1, 1),
(2, 1, '2013-12-31', 1, 1),
(3, 1, '2013-12-31', 1, 1),
(4, 1, '2013-12-31', 1, 1),
(5, 1, '2013-12-31', 1, 1),
(6, 1, '2013-12-31', 1, 1),
(7, 1, '2013-12-31', 1, 1),
(8, 1, '2013-12-31', 1, 1),
(9, 1, '2013-12-31', 2, 1),
(10, 1, '2013-12-31', 3, 1),
(11, 1, '2013-12-31', 1, 1),
(12, 1, '2013-12-31', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `corrupt_item`
--

CREATE TABLE IF NOT EXISTS `corrupt_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `description` varchar(200) NOT NULL,
  `userId` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=ascii AUTO_INCREMENT=4 ;

--
-- Dumping data for table `corrupt_item`
--

INSERT INTO `corrupt_item` (`id`, `item_id`, `supplier_id`, `description`, `userId`) VALUES
(3, 4, 1, '3 item defect', 1);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `mobile` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `userId` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `userId` (`userId`)
) ENGINE=InnoDB  DEFAULT CHARSET=ascii AUTO_INCREMENT=11 ;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `name`, `mobile`, `email`, `address`, `userId`) VALUES
(1, 'rahim', '01819334545', 'abc@g.ocm', 'kazir dewri', 1),
(2, 'amin', '01819334444', 'a@g.com', 'Jamal Khan', 1),
(3, 'ragib', '33456633', '', '', 1),
(4, 'Rahim', '01941417', 'abc@g.com', '1 rj street, chittagong', 1),
(5, 'Mithun', '01714156305', 'abc@g.com', 'sdc 11, abc , ctg', 3),
(6, 'Unknown Customer', '', '', '', 1),
(7, 'Unknown Customer', '', '', '', 2),
(8, 'Unknown Customer', '', '', '', 3),
(9, 'Imran', '01941417322', 'buetcse110@gmail.com', '122, Rj Street. Chittagong', 4),
(10, 'Mridha Hasan', '123456', 'abc@a.com', '11 ab street chittagong', 1);

-- --------------------------------------------------------

--
-- Table structure for table `daily_item_buy`
--

CREATE TABLE IF NOT EXISTS `daily_item_buy` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `buy_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` int(10) NOT NULL,
  `price` float NOT NULL,
  `paid_by` varchar(200) NOT NULL,
  `due_amount` float NOT NULL,
  `due_description` varchar(200) NOT NULL,
  `userId` int(11) NOT NULL,
  `supplier_delivery_schedule` varchar(300) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `item_id` (`item_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=ascii AUTO_INCREMENT=31 ;

--
-- Dumping data for table `daily_item_buy`
--

INSERT INTO `daily_item_buy` (`id`, `buy_id`, `item_id`, `quantity`, `price`, `paid_by`, `due_amount`, `due_description`, `userId`, `supplier_delivery_schedule`) VALUES
(9, 0, 2, 12, 2333, 'TIKS', 0, '', 1, 'full delivery in next 30 days'),
(11, 1, 1, 12, 1000, 'Harun', 100, 'other in 2 days', 1, 'half delivery in next 15 days, next half in next 20 days after prior delivery.'),
(12, 2, 1, 12, 2000, 'Harun', 89, 'tomorrow', 1, 'full delivery in next 5 days.'),
(13, 0, 1, 1, 999, 'kkk', 0, 'kk', 1, 'kk'),
(14, 0, 4, 12, 1200, 'Eraj', 0, 'no', 1, 'just in time'),
(15, 0, 6, 12, 1200, 'Mizan', 0, '', 4, 'all at once'),
(16, 0, 6, 12, 1200, 'Jishan', 0, 'complete', 4, 'will be complete in 15 days'),
(17, 0, 6, 12, 1200, 'Ikran', 0, '', 4, 'In one month full'),
(18, 0, 7, 12, 2233, 'Mithu', 0, '', 1, 'full'),
(20, 0, 1, 2, 3, '4sdf', 0, '', 1, 'sdfdf'),
(21, 0, 1, 1, 34, '34234', 0, '', 1, 'sdf'),
(22, 2, 1, 1, 1000, 'minar', 0, '', 1, '1 day'),
(23, 2, 1, 2, 333, 'Mridha', 0, '', 1, '1 day'),
(24, 3, 1, 5, 500, 'Minar', 0, '', 1, 'will be complete in 15 days'),
(25, 4, 1, 2, 2000, 'Mridha', 0, '', 1, '1 day '),
(26, 8, 12, 11, 2000, 'Mridha', 0, '', 1, '1'),
(27, 9, 13, 12, 1200, 'Minar', 0, '', 1, '1 day'),
(28, 10, 14, 2, 1200, 'Miner', 0, '', 1, '1 day'),
(29, 11, 15, 3, 3000, 'Mridha', 5000, 'in 2 days.', 1, 'in 5 days.'),
(30, 12, 16, 12, 1200, 'Minar', 3000, 'in 3 days.', 1, 'in 1 days.');

-- --------------------------------------------------------

--
-- Table structure for table `daily_item_sale`
--

CREATE TABLE IF NOT EXISTS `daily_item_sale` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sell_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` float NOT NULL,
  `sold_by` varchar(200) NOT NULL,
  `due_amount` float NOT NULL,
  `due_description` varchar(200) NOT NULL,
  `userId` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `item_id` (`item_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=ascii AUTO_INCREMENT=43 ;

--
-- Dumping data for table `daily_item_sale`
--

INSERT INTO `daily_item_sale` (`id`, `sell_id`, `item_id`, `quantity`, `price`, `sold_by`, `due_amount`, `due_description`, `userId`) VALUES
(7, 1, 2, 12, 1200, 'Hiran', 0, '', 1),
(8, 2, 2, 12, 123, 'Jimab', 0, '', 1),
(9, 3, 2, 12, 1000, 'Ifad', 0, '', 1),
(10, 4, 2, 12, 1000, 'tyu', 0, '', 1),
(11, 5, 1, 3, 1200, 'Niloy', 0, '', 1),
(12, 6, 2, 12, 1000, 'Jishan', 7, 'other in 2 days', 1),
(13, 7, 2, 12, 1000, 'Mina', 987, 'dsfafd', 3),
(14, 8, 1, 40, 555, 'ttt', 0, '0jj', 1),
(15, 9, 1, 10, 666, 'ytu', 0, '009', 1),
(16, 10, 1, 9, 9999, 'tyu', 0, 'kkk', 1),
(17, 11, 1, 12, 1333, 'zxc', 0, '', 1),
(18, 12, 1, 1, 1333, 'zxc', 0, '', 1),
(29, 17, 1, 1, 100, 'sdf', 0, '', 1),
(30, 17, 1, 1, 232, 'zfsdf', 0, '', 1),
(31, 19, 1, 1, 1000, 'IHmra', 0, '', 1),
(32, 19, 4, 3, 300, 'Nihar', 0, '', 1),
(33, 21, 4, 2, 100, 'sdf', 0, '', 1),
(34, 23, 1, 3, 1000, 'Mintu', 0, '', 1),
(35, 24, 1, 1, 1000, 'Unknown', 0, '', 1),
(36, 24, 2, 1, 1000, 'Niloy', 0, '', 1),
(37, 25, 2, 3, 1000, 'Miran', 0, '', 1),
(38, 25, 1, 2, 1000, 'minar', 0, '', 1),
(39, 25, 1, 1, 1000, 'Mridha', 0, '', 1),
(40, 25, 4, 1, 1000, 'Nolen', 0, '', 1),
(41, 26, 1, 6, 1007, 'Nilar', 0, '', 1),
(42, 28, 15, 2, 3005, 'Minar', 2000, 'in 2 days.', 1);

-- --------------------------------------------------------

--
-- Table structure for table `daily_journal`
--

CREATE TABLE IF NOT EXISTS `daily_journal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `work_description` varchar(200) NOT NULL,
  `userId` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=ascii AUTO_INCREMENT=8 ;

--
-- Dumping data for table `daily_journal`
--

INSERT INTO `daily_journal` (`id`, `date`, `work_description`, `userId`) VALUES
(3, '2014-01-07', 'new work', 1),
(5, '2022-08-02', 'we need to make seven other shops', 1),
(6, '2014-03-07', 'take money from Jabed 5000', 1),
(7, '2014-12-31', 'go to desk and study ', 1);

-- --------------------------------------------------------

--
-- Table structure for table `daily_other_cost`
--

CREATE TABLE IF NOT EXISTS `daily_other_cost` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `store_id` int(11) NOT NULL,
  `description` varchar(500) NOT NULL,
  `cost` float NOT NULL,
  `paid_by` varchar(200) NOT NULL,
  `date` date NOT NULL,
  `userId` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=ascii AUTO_INCREMENT=8 ;

--
-- Dumping data for table `daily_other_cost`
--

INSERT INTO `daily_other_cost` (`id`, `store_id`, `description`, `cost`, `paid_by`, `date`, `userId`) VALUES
(1, 1, 'buy mobil for generator', 1000, 'parvez', '2013-12-31', 1),
(2, 2, 'repair glass', 5000, 'Jisan', '2013-07-01', 1),
(3, 3, 'need to buy new fans', 1200, 'ajim', '2013-12-31', 1),
(4, 2, 'need to buy chair', 2000, 'Ajim', '2013-12-31', 1),
(5, 4, 'need to buy new fans', 1200, 'Himel', '2013-12-31', 4),
(6, 5, 'buy shop', 1200, 'Ihram', '2013-12-31', 4),
(7, 1, 'need to fix toilet', 100000, 'Imran', '2013-12-31', 1);

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE IF NOT EXISTS `item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `userId` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `sell_price` int(11) NOT NULL,
  `buy_price` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=ascii AUTO_INCREMENT=17 ;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`id`, `name`, `userId`, `quantity`, `store_id`, `sell_price`, `buy_price`) VALUES
(1, 'punjabi', 1, 7, 1, 1007, 2000),
(2, 'Shirt', 1, 6, 1, 1000, 900),
(3, 'T-shirt', 1, 10, 1, 1000, 900),
(4, 'Polo -Shirt', 1, 0, 1, 1000, 900),
(5, 'baby-set', 1, 10, 1, 1000, 900),
(6, 'Polo- shirt', 4, 18, 1, 1000, 900),
(7, 'Ganjee-Full', 1, 0, 1, 1000, 900),
(8, 'Baba Lungi', 1, 0, 2, 1000, 900),
(10, 'Luxury Sando Ganjee', 1, 0, 1, 1000, 900),
(14, 'Pant1388516440', 1, 2, 3, 2000, 1200),
(15, 'Punjabi1388514516', 1, 1, 1, 3005, 3000),
(16, 'Punjabi1388514913', 1, 12, 1, 0, 1200);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE IF NOT EXISTS `login` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `password` varchar(200) NOT NULL,
  `username` varchar(200) NOT NULL,
  `join_date` date NOT NULL,
  `last_date` date NOT NULL,
  `email` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=ascii AUTO_INCREMENT=21 ;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `password`, `username`, `join_date`, `last_date`, `email`) VALUES
(1, '8cb2237d0679ca88db6464eac60da96345513964', 'imran', '2014-01-01', '2014-01-30', ''),
(2, '1234', 'Iqbal', '2014-01-01', '2014-01-07', ''),
(3, '12', 'Mizan', '2014-01-01', '2014-01-07', ''),
(4, '123', 'Habib', '2014-01-01', '2014-01-07', ''),
(5, '123', 'Jibon', '2014-01-01', '2014-01-07', ''),
(13, '12', 'sdf', '2013-12-31', '2014-01-07', ''),
(14, '1234', 'mithu', '2013-12-31', '2014-01-07', ''),
(15, '12345', 'Mridha', '2013-12-31', '2014-01-07', 'a@b.com'),
(16, '1234', 'Nirla', '2013-12-31', '2014-01-07', 'a@b.com'),
(17, 'df', 'sdf', '2013-12-31', '2014-01-07', 'sdf'),
(18, '23', 'mridal', '2013-12-31', '2014-01-07', '23'),
(19, '34', 'Mina3', '2013-12-31', '2014-01-07', 'sdf@a.com'),
(20, '8cb2237d0679ca88db6464eac60da96345513964', 'ImranKhan', '2013-12-31', '2014-01-07', 'a@b.com');

-- --------------------------------------------------------

--
-- Table structure for table `owner`
--

CREATE TABLE IF NOT EXISTS `owner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `percentage` float NOT NULL,
  `store_id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `store_id` (`store_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=ascii AUTO_INCREMENT=11 ;

--
-- Dumping data for table `owner`
--

INSERT INTO `owner` (`id`, `name`, `percentage`, `store_id`, `userId`) VALUES
(1, 'Samadul Haque, Shatadal Store', 0.5, 1, 1),
(2, 'Samadul Haque, King of Paristhan', 0.5, 2, 1),
(3, 'Jubair, King of Paristhan', 0.05, 2, 1),
(4, 'Jubair, City Mart', 0.2, 3, 1),
(5, 'Farid, City Mart', 0.2, 3, 1),
(6, 'Rahim, City Mart', 0.3, 3, 1),
(7, 'Samadul Haque, City Mart', 0.1, 3, 1),
(8, 'Nazim, City Mart', 0.2, 3, 1),
(9, 'Hafez Shab, Shatadal', 0.5, 1, 1),
(10, 'Muhammad Badshah, King of Paristhan', 0.5, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `owner_history`
--

CREATE TABLE IF NOT EXISTS `owner_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `owner_id` int(11) NOT NULL,
  `amount` float NOT NULL,
  `description` varchar(200) NOT NULL,
  `date` date NOT NULL,
  `userId` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=ascii AUTO_INCREMENT=7 ;

--
-- Dumping data for table `owner_history`
--

INSERT INTO `owner_history` (`id`, `owner_id`, `amount`, `description`, `date`, `userId`) VALUES
(1, 2, 1233, 'for home', '2013-12-31', 1),
(2, 2, 1233, 'for home', '2013-12-31', 1),
(3, 2, -1200, 'withdraw', '2013-12-31', 1),
(4, 11, -25000, 'family funding', '2013-12-31', 4),
(5, 12, 1200, '500', '2013-12-31', 4),
(6, 1, 10000, 'for new shop corner', '2013-12-31', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sell`
--

CREATE TABLE IF NOT EXISTS `sell` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `store_id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=ascii AUTO_INCREMENT=29 ;

--
-- Dumping data for table `sell`
--

INSERT INTO `sell` (`id`, `customer_id`, `date`, `store_id`, `userId`) VALUES
(1, 2, '2013-12-31', 1, 1),
(2, 1, '2013-12-31', 1, 1),
(3, 1, '2013-12-31', 2, 1),
(4, 1, '2013-12-31', 1, 1),
(5, 6, '2013-12-31', 2, 1),
(6, 6, '2013-12-31', 1, 1),
(7, 1, '2013-12-31', 1, 1),
(8, 2, '2013-12-31', 1, 1),
(9, 2, '2013-12-31', 1, 1),
(10, 1, '2013-12-31', 2, 1),
(11, 2, '2013-12-31', 1, 1),
(12, 2, '2013-12-31', 1, 1),
(13, 2, '2013-12-31', 1, 1),
(14, 2, '2013-12-31', 1, 1),
(15, 1, '2013-12-31', 1, 1),
(16, 1, '2013-12-31', 1, 1),
(17, 2, '2013-12-31', 1, 1),
(18, 2, '2013-12-31', 1, 1),
(19, 1, '2013-12-31', 1, 1),
(20, 1, '2013-12-31', 1, 1),
(21, 6, '2013-12-31', 1, 1),
(22, 1, '2013-12-31', 1, 1),
(23, 6, '2013-12-31', 1, 1),
(24, 6, '2013-12-31', 1, 1),
(25, 6, '2013-12-31', 1, 1),
(26, 6, '2013-12-31', 1, 1),
(27, 6, '2013-12-31', 1, 1),
(28, 2, '2013-12-31', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE IF NOT EXISTS `staff` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `store_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `mobile_number` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `salary` varchar(200) NOT NULL,
  `address` varchar(200) NOT NULL,
  `userId` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `store_id` (`store_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=ascii AUTO_INCREMENT=9 ;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `store_id`, `name`, `mobile_number`, `email`, `salary`, `address`, `userId`) VALUES
(1, 1, 'Al Amin', '', '', '20000', 'Satkania', 1),
(2, 1, 'Amin Sharif', '37565656', '', '20000', 'Satkania', 1),
(3, 3, 'rahim', '11220033', 'a@b.com', '3344', 'Satkania', 1),
(4, 1, 'Mizan', '', '', '1200', '', 1),
(5, 2, 'Kaisar', '0194141646', 'abc@g.com', '20000', 'satkania', 1),
(6, 1, 'rahamat', '019445566', 'av@g.ccc', '4000', '1, ab street', 1),
(7, 4, 'Mithun', '0194151316', 'buetcse110@abc.c', '20000', '1122, ab street', 4),
(8, 1, 'Minu', '01941556677', 'a@b.com', '2000', '11, ab street', 1);

-- --------------------------------------------------------

--
-- Table structure for table `staff_daily_history`
--

CREATE TABLE IF NOT EXISTS `staff_daily_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `staff_id` int(11) NOT NULL,
  `staff_report` varchar(500) NOT NULL,
  `userId` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `staff_id` (`staff_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=ascii AUTO_INCREMENT=9 ;

--
-- Dumping data for table `staff_daily_history`
--

INSERT INTO `staff_daily_history` (`id`, `date`, `staff_id`, `staff_report`, `userId`) VALUES
(4, '2014-01-09', 1, 'no way', 1),
(5, '2013-12-31', 1, 'Very Bad', 1),
(6, '2013-12-31', 2, 'very Good', 1),
(8, '2013-12-31', 2, 'need to work hard today', 1);

-- --------------------------------------------------------

--
-- Table structure for table `store`
--

CREATE TABLE IF NOT EXISTS `store` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `address` varchar(200) NOT NULL,
  `contact_number` varchar(100) NOT NULL,
  `userId` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=ascii AUTO_INCREMENT=7 ;

--
-- Dumping data for table `store`
--

INSERT INTO `store` (`id`, `name`, `address`, `contact_number`, `userId`) VALUES
(1, 'Shatadal', '177 R.S. Road Reazuddin Bazar Chittagong', '031615356', 1),
(2, 'King Of Paristhan', 'Nazir Saleh Complex Reazuddin Bazar Chittagong', '031656579', 1),
(3, 'City Mart', 'Reazuddin Bazar', '0311234567', 1),
(4, 'Margarita', '11, You Street, Chittagong', '34234234', 4),
(5, 'Margarita 2', 'abc', '234234234', 4),
(6, 'Shatadal Plus', 'ab road, Chittagong', '234234234', 1);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE IF NOT EXISTS `supplier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `mobile` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `description` varchar(200) NOT NULL,
  `userId` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=ascii AUTO_INCREMENT=6 ;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id`, `name`, `mobile`, `email`, `address`, `description`, `userId`) VALUES
(1, 'jabbar ali', '', '', '2/2 block-g, lalmatia, dhaka', 'punjabi supplier', 1),
(2, 'Lilac Garments', '0194141516', 'abc@gg.com', 'Mirpur Dhaka', 'Punjabi Supplier', 1),
(3, 'Mehedi', '0194141516', 'ac@g.com', 'lalbag, dhaka', 'Babies Supplier', 1),
(4, 'Mirka', '0133355343', 'abc@ab.com', '33 ab street. com', 'sharee', 4),
(5, 'Mallick Garments', '019895117', 'ab@g.com', '1 rr street, Chittagong', 'Shirts Supplier', 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bank_history`
--
ALTER TABLE `bank_history`
  ADD CONSTRAINT `bank_history_ibfk_1` FOREIGN KEY (`store_id`) REFERENCES `store` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `daily_item_sale`
--
ALTER TABLE `daily_item_sale`
  ADD CONSTRAINT `daily_item_sale_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `owner`
--
ALTER TABLE `owner`
  ADD CONSTRAINT `owner_ibfk_1` FOREIGN KEY (`store_id`) REFERENCES `store` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `staff`
--
ALTER TABLE `staff`
  ADD CONSTRAINT `staff_ibfk_1` FOREIGN KEY (`store_id`) REFERENCES `store` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `staff_daily_history`
--
ALTER TABLE `staff_daily_history`
  ADD CONSTRAINT `staff_daily_history_ibfk_1` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
