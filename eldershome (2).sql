-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 28, 2014 at 02:10 PM
-- Server version: 5.5.24-log
-- PHP Version: 5.3.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `eldershome`
--
CREATE DATABASE IF NOT EXISTS `eldershome` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `eldershome`;

-- --------------------------------------------------------

--
-- Table structure for table `asset`
--

CREATE TABLE IF NOT EXISTS `asset` (
  `purchase_id` varchar(10) NOT NULL,
  `remarks` varchar(20) NOT NULL,
  `asset_type` varchar(11) NOT NULL,
  PRIMARY KEY (`purchase_id`),
  KEY `purchase_id` (`purchase_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `asset`
--

INSERT INTO `asset` (`purchase_id`, `remarks`, `asset_type`) VALUES
('P00001', 'sbhjg', 'bed'),
('P00003', 'good', 'bed'),
('P00007', 'remove old beds', 'Steel beds'),
('P00008', ' use Drinks issue', 'Drink cups'),
('P00011', 'gust use', 'cups'),
('P00012', 'gust use', 'chairs'),
('P00014', 'Staff use', 'chairs'),
('P00016', 'elders use', 'plastic');

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE IF NOT EXISTS `branch` (
  `branch_id` varchar(10) NOT NULL,
  `branch_name` varchar(20) NOT NULL,
  `address` varchar(50) NOT NULL,
  `contact_no` int(10) NOT NULL,
  PRIMARY KEY (`branch_id`),
  KEY `branch_id` (`branch_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`branch_id`, `branch_name`, `address`, `contact_no`) VALUES
('B001', 'Kaithady', '"Shanthi Nilayam" Kaithady,Jaffna', 212057881),
('B002', 'Kilinochi', 'Kilinochi', 96878967),
('B003', 'Mullaithivu', 'Mullaithivu', 87997),
('B004', 'Vavuniya', 'vavuniya Ellappar, Maruthankulam.', 245100016),
('B005', 'Mannar', 'Mannar', 87997);

-- --------------------------------------------------------

--
-- Table structure for table `consumable`
--

CREATE TABLE IF NOT EXISTS `consumable` (
  `purchase_id` varchar(10) NOT NULL,
  `item_type` varchar(11) NOT NULL,
  `expiry_date` date NOT NULL,
  PRIMARY KEY (`purchase_id`),
  KEY `purchase_id` (`purchase_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `consumable`
--

INSERT INTO `consumable` (`purchase_id`, `item_type`, `expiry_date`) VALUES
('P00002', 'Soda', '2014-08-15'),
('P00004', 'Soda', '2014-07-01'),
('P00005', 'Soda', '2014-08-07'),
('P00006', 'soda', '2014-07-20'),
('P00009', 'body shop', '2015-02-01'),
('P00010', '5l water bo', '2015-05-06'),
('P00013', 'drink', '2016-05-06'),
('P00015', 'body shop', '2015-06-20');

-- --------------------------------------------------------

--
-- Table structure for table `death`
--

CREATE TABLE IF NOT EXISTS `death` (
  `admission_no` varchar(10) NOT NULL,
  `date` date NOT NULL,
  `death_certificate` varchar(30) NOT NULL,
  `reason` text NOT NULL,
  PRIMARY KEY (`admission_no`),
  KEY `admission_no` (`admission_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `death`
--

INSERT INTO `death` (`admission_no`, `date`, `death_certificate`, `reason`) VALUES
('A0009', '2014-06-06', '', 'heart attack'),
('A0015', '2010-06-04', '', 'fever');

-- --------------------------------------------------------

--
-- Table structure for table `diagnosis`
--

CREATE TABLE IF NOT EXISTS `diagnosis` (
  `date` date NOT NULL,
  `admission_no` varchar(10) NOT NULL,
  `user_id` varchar(10) NOT NULL,
  `remarks` varchar(50) NOT NULL,
  PRIMARY KEY (`date`,`admission_no`),
  KEY `admission_no` (`admission_no`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `diagnosis`
--

INSERT INTO `diagnosis` (`date`, `admission_no`, `user_id`, `remarks`) VALUES
('2014-07-07', 'A0002', 'S019', 'vit e, vit c, vit d'),
('2014-07-08', 'A0011', 'S009', 'fever and cold');

-- --------------------------------------------------------

--
-- Table structure for table `duty`
--

CREATE TABLE IF NOT EXISTS `duty` (
  `user_id` varchar(10) NOT NULL,
  `arrival_time` time NOT NULL,
  `date` date NOT NULL,
  `departure_time` time NOT NULL,
  `home_no` varchar(10) NOT NULL,
  `work` text NOT NULL,
  PRIMARY KEY (`user_id`,`arrival_time`,`date`),
  KEY `user_id` (`user_id`),
  KEY `home_no` (`home_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `duty`
--

INSERT INTO `duty` (`user_id`, `arrival_time`, `date`, `departure_time`, `home_no`, `work`) VALUES
('S011', '09:20:23', '2014-05-13', '19:20:23', 'H002', 'tfdtryd'),
('S011', '17:20:26', '2014-06-01', '03:20:26', 'H002', 'hgvghv'),
('S011', '18:25:58', '2014-06-10', '04:35:58', 'H002', 'fdfdf'),
('S014', '08:00:00', '2014-06-02', '16:00:00', 'H001', 'work'),
('S016', '10:55:04', '2014-06-03', '02:00:00', 'H002', 'sdjfn'),
('S016', '14:20:15', '2014-06-17', '23:20:15', 'H002', 'kkjnjk'),
('S022', '08:14:10', '2014-06-02', '18:14:10', 'H001', 'Nurse'),
('S022', '08:17:31', '2014-06-07', '17:57:31', 'H001', 'Nurse'),
('S022', '08:53:03', '2014-06-04', '18:53:03', 'H001', 'Nurse'),
('S022', '08:54:50', '2014-06-06', '18:54:50', 'H001', 'Nurse'),
('S022', '08:55:48', '2014-06-04', '20:55:48', 'H001', 'Nurse'),
('S023', '08:10:45', '2014-06-03', '17:50:45', 'H001', 'Nurse'),
('S028', '08:10:20', '2014-06-03', '18:26:20', 'H002', 'Nurse');

-- --------------------------------------------------------

--
-- Table structure for table `elders`
--

CREATE TABLE IF NOT EXISTS `elders` (
  `admission_no` varchar(10) NOT NULL,
  `name` varchar(30) NOT NULL,
  `address` varchar(60) NOT NULL,
  `dob` date NOT NULL,
  `joint_date` date NOT NULL,
  `photo` varchar(50) NOT NULL,
  `location` varchar(20) NOT NULL,
  `home_no` varchar(10) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `ward_no` varchar(12) NOT NULL,
  `status` varchar(10) NOT NULL,
  `religion` varchar(10) NOT NULL,
  `bed_no` varchar(10) NOT NULL,
  `branch_id` varchar(10) NOT NULL,
  PRIMARY KEY (`admission_no`),
  KEY `admission_no` (`admission_no`),
  KEY `branch_id` (`branch_id`),
  KEY `fk_elders_guardian1_idx` (`admission_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `elders`
--

INSERT INTO `elders` (`admission_no`, `name`, `address`, `dob`, `joint_date`, `photo`, `location`, `home_no`, `gender`, `ward_no`, `status`, `religion`, `bed_no`, `branch_id`) VALUES
('A0002', 'Mr.kamalanathan Maniyam', 'Chavakacheri West Chavakacheri', '1933-06-14', '2013-05-16', 'el1.jpg', 'chava', 'H001', 'Female', 'W001', 'Live', 'Hindu', '2', 'B001'),
('A0003', 'Mr.Kanapathi Nitham', 'Kaithady North Kaithady', '1955-04-11', '2011-12-12', 'el2.jpg', 'Public Place', 'H001', 'Male', 'W001', 'Death', 'Hindu', '3', 'B001'),
('A0004', 'Mr.suriyamani Vanamaiyil', 'Elaalai West Elaalai', '1947-12-05', '2000-04-04', 'el3.jpg', 'Home', 'H001', 'Male', 'W001', 'Death', 'Christian', '4', 'B001'),
('A0005', 'Mr.vikiramani Suntharam', 'Maduvil North Maduvil', '1948-03-31', '2001-05-12', 'el4.jpg', 'Temple', 'H001', 'Male', 'W001', 'Live', 'Hindu', '5', 'B001'),
('A0006', 'Mrs.srithevi kumaniyam', 'Point pedro road Point pedro', '1945-04-22', '2000-12-15', 'el5.jpg', 'Road Site', 'H001', 'Female', 'W002', 'Live', 'Christian', '1', 'B001'),
('A0007', 'Mrs.Nayanamai Chinnavan', '32/1 Manipay Road Manipay', '1923-05-23', '1999-02-21', 'el6.jpg', 'Public Place', 'H001', 'Female', 'W002', 'Live', 'Christian', '2', 'B001'),
('A0009', 'Mrs.Uma Chanthiran', 'Varani Road Kodikamam', '1955-05-05', '2012-12-03', 'el8.jpg', 'Home', 'H001', 'Female', 'W002', 'Death', 'Hindu', '4', 'B001'),
('A0011', 'Mr.laksumi Narayanan', 'Uduvil West Uduvil ', '1945-05-05', '1996-12-23', 'el9.jpg', 'Temple', 'H001', 'Female', 'W002', 'Live', 'Hindu', '5', 'B001'),
('A0013', 'Mr.Kanaku Balamani', 'Suthumalai North Suthumalai', '2014-06-05', '2014-06-06', 'el11.jpg', 'Suthumalai North Sut', 'H001', 'Male', 'W003', 'Live', 'Hindu', '1', 'B001'),
('A0014', 'Mr.Balaiya Pithan', 'Kaithady North Kaithady', '1930-06-05', '2010-06-06', 'el12.jpg', 'Home', 'H001', 'Male', 'W003', 'Live', 'Hindu', '2', 'B001'),
('A0015', 'Mr.Maniyam Thurai', 'Uduvil West Uduvil ', '1950-06-06', '2012-06-03', 'el13.jpg', 'Home', 'H002', 'Male', 'W001', 'Death', 'Hindu', '2', 'B001'),
('A0016', 'Mrs.kumarika kanaku', '23/5 Nelliyadi Road Nelliyadi', '1948-07-01', '1999-07-02', 'el14.jpg', 'Hospital', 'H001', 'Female', 'W004', 'Live', 'Christian', '3', 'B001'),
('A0017', 'Mr.Chinnama Thampiyan', 'asdfsad', '2014-06-03', '2014-07-03', 'el15.jpg', 'kili', 'H001', 'Male', 'W001', 'Live', 'Hindu', '2', 'B004'),
('A0018', 'Mr.Thampiyan Sabapathi', 'Vavuniya Ponthodam Vavuniya', '1932-04-12', '2010-12-14', 'el16.jpg', 'Vavuniya', 'H002', 'Male', 'W001', 'Live', 'Hindu', '1', 'B004'),
('A0019', 'Mr.Thami Sabapathi', 'Vavuniya east', '1921-04-05', '2011-12-14', '', 'Vavuniya', 'H001', 'Male', 'W001', 'Live', 'Hindu', '1', 'B004'),
('A0020', 'Mrs.Periyammal Chinavan', 'Vavuniya west Vavuniya', '1941-05-12', '2011-12-04', '', 'Vavuniya', 'H001', 'Male', 'W001', 'Live', 'Hindu', '2', 'B004'),
('A0021', 'Mr.Chitampalam nadeshu', 'Navatkuli west Navatkuli', '1932-04-06', '2011-05-05', 'el2.JPG', 'Public Place', 'H001', 'Male', 'W001', 'Live', 'Hindu', '1', 'B001'),
('A0022', 'Mr.Kathirvelu Kanesh', 'Maduli House maduli ', '1940-04-05', '2010-05-16', 'el3.JPG', 'Public Place', 'H001', 'Male', 'W003', 'Live', 'Hindu', '3', 'B001'),
('A0023', 'mr.kanakalikam', 'kaithady west kaithady', '1944-02-26', '1999-04-05', '', 'Temple', 'H001', 'Male', 'W004', 'Live', 'Hindu', '2', 'B001');

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE IF NOT EXISTS `event` (
  `event_id` varchar(10) NOT NULL,
  `user_id` varchar(10) NOT NULL,
  `branch_id` varchar(10) NOT NULL,
  `event_type` varchar(20) NOT NULL,
  `date` date NOT NULL,
  `event` varchar(20) NOT NULL,
  `remarks` varchar(50) NOT NULL,
  PRIMARY KEY (`event_id`),
  KEY `user_id` (`user_id`),
  KEY `branch_id` (`branch_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`event_id`, `user_id`, `branch_id`, `event_type`, `date`, `event`, `remarks`) VALUES
('E001', 'SP001', 'B001', 'Function', '2014-07-07', 'birthday', 'ewrtew'),
('E002', 'SP002', 'B004', 'Fund or Things', '2014-07-02', 'Birthday', 'food'),
('E004', 'SP001', 'B001', 'Function', '2014-07-27', 'lunch', '1st memorial day'),
('E005', 'SP009', 'B001', 'Function', '2014-08-31', 'Birthday', 'lunch ,dinner'),
('E006', 'SP009', 'B001', 'Fund or Things', '2014-08-22', 'memorial day', '5000/='),
('E007', 'SP009', 'B001', 'Function', '2014-09-03', 'memorial day', 'food');

-- --------------------------------------------------------

--
-- Table structure for table `expense`
--

CREATE TABLE IF NOT EXISTS `expense` (
  `expense_id` varchar(10) NOT NULL,
  `date` date NOT NULL,
  `expense_type` varchar(20) NOT NULL,
  `amount` int(20) NOT NULL,
  `remarks` varchar(30) NOT NULL,
  `branch_id` varchar(10) NOT NULL,
  PRIMARY KEY (`expense_id`),
  KEY `branch_id` (`branch_id`),
  KEY `expense_id` (`expense_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `expense`
--

INSERT INTO `expense` (`expense_id`, `date`, `expense_type`, `amount`, `remarks`, `branch_id`) VALUES
('EX00001', '2014-07-01', 'phone bill', 1600, 'hjvhjv', 'B004'),
('EX00002', '2014-06-02', 'current bill', 3500, 'charge increase', 'B001'),
('EX00003', '2014-07-03', 'current bill', 5000, 'increase', 'B004'),
('EX00004', '2014-05-06', 'others', 5000, 'rental,stationary', 'B001'),
('EX00005', '2014-04-25', 'phone bill', 2500, 'landphone,cdma', 'B001'),
('EX00006', '2014-06-02', 'others', 5000, 'water', 'B001');

-- --------------------------------------------------------

--
-- Table structure for table `food`
--

CREATE TABLE IF NOT EXISTS `food` (
  `ward_no` varchar(10) NOT NULL,
  `home_no` varchar(10) NOT NULL,
  `date` date NOT NULL,
  `breakfast` varchar(10) NOT NULL,
  `lunch` varchar(10) NOT NULL,
  `dinner` varchar(10) NOT NULL,
  `branch_id` varchar(10) NOT NULL,
  PRIMARY KEY (`ward_no`,`home_no`,`date`,`branch_id`),
  KEY `branch_id` (`branch_id`),
  KEY `ward_no` (`ward_no`),
  KEY `home_no` (`home_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `food`
--

INSERT INTO `food` (`ward_no`, `home_no`, `date`, `breakfast`, `lunch`, `dinner`, `branch_id`) VALUES
('W001', 'H001', '2014-07-01', '17', '12', '17', 'B004'),
('W001', 'H001', '2014-07-03', '10', '17', '17', 'B004'),
('W002', 'H001', '2014-07-01', '10', '25', '20', 'B004'),
('W002', 'H001', '2014-07-04', '17', '12', '17', 'B004');

-- --------------------------------------------------------

--
-- Table structure for table `guardian`
--

CREATE TABLE IF NOT EXISTS `guardian` (
  `admission_no` varchar(10) NOT NULL,
  `name` varchar(20) NOT NULL,
  `contact_no` int(10) NOT NULL,
  `address` text NOT NULL,
  PRIMARY KEY (`admission_no`),
  KEY `admission_no` (`admission_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `guardian`
--

INSERT INTO `guardian` (`admission_no`, `name`, `contact_no`, `address`) VALUES
('A0002', 'Mr.Jejalinkam GS', 774568521, 'Chavakacheri West Chavakacheri'),
('A0003', 'Mr.bavithan Gs', 771253648, 'Kaithady North Kaithady'),
('A0004', 'Mr.Nadaraja ', 774512852, 'Elaalai West Elaalai'),
('A0005', 'Mr.Nakalinkam', 777100673, 'Maduvil North Maduvil'),
('A0006', 'Mr.S.Kunananthan', 771523412, 'Point pedro road Point pedro'),
('A0007', 'GS', 96878967, '32/1 Manipay Road Manipay'),
('A0009', 'Mr.Tharani', 771215487, 'Varani Road Kodikamam'),
('A0011', 'Mr.Karikalan', 96878967, 'Uduvil West Uduvil'),
('A0013', 'Mr.E.Balamani', 754552168, 'Suthumalai North Suthumalai'),
('A0014', 'Mr.Nadeshu', 771225896, 'Kaithady North Kaithady'),
('A0015', 'Mr.Jejalinkam GS', 774520123, 'Uduvil West Uduvil '),
('A0016', 'Mr.Karikalan', 714562321, '23/5 Nelliyadi Road Nelliyadi'),
('A0017', 'ds', 777100673, 'ghyfytf'),
('A0018', 'Mr.Nakalinkam', 774568521, 'Vavuniya Ponthodam Vavuniya'),
('A0019', 'Mr.Nakalinkam', 775623104, 'Vavuniya'),
('A0020', 'Mr.Nakalinkam', 774568521, 'Vavuniya west Vavuniya'),
('A0021', 'Mr.Nakalinkam', 774568521, 'Navatkuli west Navatkuli'),
('A0022', 'Mr.bavithan Gs', 774568521, 'Maduli House maduli '),
('A0023', 'Mr.bavithan Gs', 771223587, 'kaithady west kaithady');

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE IF NOT EXISTS `item` (
  `item_no` varchar(10) NOT NULL,
  `item_name` varchar(20) NOT NULL,
  `item_type` varchar(20) NOT NULL,
  PRIMARY KEY (`item_no`),
  KEY `item_no` (`item_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`item_no`, `item_name`, `item_type`) VALUES
('I00001', 'bed', 'Asset'),
('I00002', 'Pepsi soda', 'Consumable'),
('I00003', 'plastic cups', 'Asset'),
('I00004', 'silver cups', 'Asset'),
('I00005', 'plastic chairs', 'Asset'),
('I00006', 'plastic tables', 'Asset'),
('I00007', 'wood chairs', 'Asset'),
('I00008', 'wood tables', 'Asset'),
('I00009', 'tipoi', 'Asset'),
('I00010', 'mattress', 'Asset'),
('I00011', 'cupboard', 'Asset'),
('I00012', 'lux soap', 'Consumable'),
('I00013', 'baby soap', 'Consumable'),
('I00014', 'lifebuoy soap', 'Consumable'),
('I00015', 'water bottle', 'Consumable'),
('I00016', 'rice (Kg)', 'Consumable'),
('I00017', 'Biscuits packets', 'Consumable'),
('I00018', 'vegetable oil cans', 'Consumable'),
('I00019', 'eggs', 'Consumable');

-- --------------------------------------------------------

--
-- Table structure for table `medicine`
--

CREATE TABLE IF NOT EXISTS `medicine` (
  `admission_no` varchar(10) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `tablet` varchar(10) NOT NULL,
  `remarks` varchar(30) NOT NULL,
  `user_id` varchar(10) NOT NULL,
  PRIMARY KEY (`admission_no`,`date`,`time`),
  KEY `admission_no` (`admission_no`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `medicine`
--

INSERT INTO `medicine` (`admission_no`, `date`, `time`, `tablet`, `remarks`, `user_id`) VALUES
('A0002', '2014-07-08', '09:25:00', 'vit d', 'rtgtr', 'S011');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE IF NOT EXISTS `message` (
  `mess_id` varchar(10) NOT NULL,
  `user_id` varchar(10) NOT NULL,
  `to_id` varchar(10) NOT NULL,
  `message` varchar(50) NOT NULL,
  `status` varchar(10) NOT NULL,
  `inboxstatus` int(11) NOT NULL,
  `sentstatus` int(11) NOT NULL,
  PRIMARY KEY (`mess_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`mess_id`, `user_id`, `to_id`, `message`, `status`, `inboxstatus`, `sentstatus`) VALUES
('M00001', 's001 ', 'S003', 'hi', '0', 1, 1),
('M00002', 'S003', 'S001', 'Hello', '0', 0, 1),
('M00003', 'S012', 'S001', 'sfdsfdsfdsfdsf sdfds fdsf dsfs df', '0', 1, 1),
('M00004', 's001 ', 'S003', 'hida hw is wrk', '0', 1, 1),
('M00005', 'sp001 ', 'S001', 'Dear sir,\r\n', '0', 1, 1),
('M00006', 'sp001 ', 'S001', 'Dear sir,\r\nhw r u', '1', 1, 1),
('M00007', 's001 ', 'SP002', 'hi', '1', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `news_id` varchar(10) NOT NULL,
  `news` text NOT NULL,
  `date` date NOT NULL,
  `photo` text NOT NULL,
  `user_id` varchar(10) NOT NULL,
  PRIMARY KEY (`news_id`),
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`news_id`, `news`, `date`, `photo`, `user_id`) VALUES
('N00001', '<div style="color: rgb(85, 85, 85); font-family: Ubuntu, Helvetica, Arial, sans-serif; line-height: 18px; text-align: center;"><font face="Arial, Verdana" size="5" color="#3366ff">Opening Ceremony of New Ward Complex at Kaithady Elder''s Home</font></div><div style="color: rgb(85, 85, 85); font-family: Ubuntu, Helvetica, Arial, sans-serif; line-height: 18px;"><font face="Arial, Verdana" size="2"><br></font></div><div style="color: rgb(85, 85, 85); font-family: Ubuntu, Helvetica, Arial, sans-serif; line-height: 18px;"><font face="Arial, Verdana" size="2"><br></font></div><div style="color: rgb(85, 85, 85); font-family: Ubuntu, Helvetica, Arial, sans-serif; line-height: 18px;"><font face="Arial, Verdana" size="2"> </font></div><div style="color: rgb(85, 85, 85); font-family: Ubuntu, Helvetica, Arial, sans-serif; line-height: 18px;"><font face="Arial, Verdana" size="2"><br></font></div><div style="color: rgb(85, 85, 85); font-family: Ubuntu, Helvetica, Arial, sans-serif; line-height: 18px;"><font face="Arial, Verdana" size="2">Opening ceremony of newly built ward complex of Kaithady Shanthi Nilayam was held on 26 May 2013. Governor of Northern Province GA Chandrasiri and Mrs. GN Chandrasiri participated as chief guests and declared open the building. Director of Social Services Department Mrs Nalayini Inparaj organized Â the event. This psychiatric clinic unit for mentally challenged elders was constructed at a cost of 12.3 million rupees under the PSDG.Â </font></div><div style="color: rgb(85, 85, 85); font-family: Ubuntu, Helvetica, Arial, sans-serif; line-height: 18px;"><font face="Arial, Verdana" size="2"><br></font></div><div style="color: rgb(85, 85, 85); font-family: Ubuntu, Helvetica, Arial, sans-serif; line-height: 18px;"><font face="Arial, Verdana" size="2">After the opening ceremony Governor and his wife gave gift packs to the elders in the home. Kiribath was also provided to the elders to mark Wesak festival.Â </font></div><div style="color: rgb(85, 85, 85); font-family: Ubuntu, Helvetica, Arial, sans-serif; line-height: 18px;"><font face="Arial, Verdana" size="2"><br></font></div><div style="color: rgb(85, 85, 85); font-family: Ubuntu, Helvetica, Arial, sans-serif; line-height: 18px;"><font face="Arial, Verdana" size="2">While addressing to the gathering Governor assured that an ambulance vehicle would be provided for the eldersâ€™ home use. He instructed the relevant officials to take measures to paint all the wards and buildings of the home. He also promised to assist on their other needs.</font></div><div style="color: rgb(85, 85, 85); font-family: Ubuntu, Helvetica, Arial, sans-serif; line-height: 18px;"><font face="Arial, Verdana" size="2"><br></font></div><div style="color: rgb(85, 85, 85); font-family: Ubuntu, Helvetica, Arial, sans-serif; line-height: 18px;"><font face="Arial, Verdana" size="2">Chief Secretary of Northern Province Mrs.R.Wijialudchumi and Secretary to the Governor L.Ilaangovan were also participated at this ceremony.</font></div>', '2014-08-19', '', 'S001');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE IF NOT EXISTS `payment` (
  `usertype` varchar(20) NOT NULL,
  `paymenttype` varchar(20) NOT NULL,
  `amount` int(11) NOT NULL,
  PRIMARY KEY (`usertype`,`paymenttype`),
  KEY `usertype` (`usertype`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`usertype`, `paymenttype`, `amount`) VALUES
('admin', 'Allowance', 5000),
('admin', 'overtime', 500),
('clerk', 'overtime', 250),
('doctor', 'overtime', 300),
('Labour', 'overtime', 200),
('manager', 'overtime', 400),
('ward-incharge', 'overtime', 200);

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE IF NOT EXISTS `purchase` (
  `purchase_id` varchar(10) NOT NULL,
  `branch_id` varchar(10) NOT NULL,
  `purchase_date` date NOT NULL,
  `item_no` varchar(10) NOT NULL,
  `no_of_items` int(10) NOT NULL,
  `unit_price` int(10) NOT NULL,
  PRIMARY KEY (`purchase_id`),
  KEY `purchase_id` (`purchase_id`),
  KEY `item_no` (`item_no`),
  KEY `branch_id` (`branch_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase`
--

INSERT INTO `purchase` (`purchase_id`, `branch_id`, `purchase_date`, `item_no`, `no_of_items`, `unit_price`) VALUES
('P00001', 'B004', '2014-07-01', 'I00001', 2, 4000),
('P00002', 'B004', '2014-07-05', 'I00002', 15, 175),
('P00003', 'B002', '2014-07-02', 'I00001', 20, 6000),
('P00004', 'B003', '2014-05-09', 'I00002', 12, 175),
('P00005', 'B004', '2014-06-04', 'I00002', 5, 200),
('P00006', 'B004', '2014-06-30', 'I00002', 10, 200),
('P00007', 'B001', '2014-06-10', 'I00001', 8, 4000),
('P00008', 'B001', '2014-06-09', 'I00003', 50, 20),
('P00009', 'B001', '2014-06-16', 'I00012', 50, 35),
('P00010', 'B001', '2014-06-14', 'I00015', 15, 200),
('P00011', 'B001', '2014-06-23', 'I00004', 50, 100),
('P00012', 'B001', '2014-06-12', 'I00005', 20, 800),
('P00013', 'B001', '2014-06-04', 'I00002', 10, 175),
('P00014', 'B001', '2014-06-20', 'I00007', 5, 5000),
('P00015', 'B001', '2014-06-20', 'I00014', 45, 30),
('P00016', 'B001', '2014-06-12', 'I00009', 20, 2000);

-- --------------------------------------------------------

--
-- Table structure for table `running_chart`
--

CREATE TABLE IF NOT EXISTS `running_chart` (
  `chart_id` varchar(10) NOT NULL,
  `date` date NOT NULL,
  `type` varchar(10) NOT NULL,
  `start_reading` int(10) NOT NULL,
  `end_reading` int(10) NOT NULL,
  `branch_id` varchar(10) NOT NULL,
  PRIMARY KEY (`chart_id`),
  KEY `branch_id` (`branch_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `running_chart`
--

INSERT INTO `running_chart` (`chart_id`, `date`, `type`, `start_reading`, `end_reading`, `branch_id`) VALUES
('C00001', '2014-07-04', 'Van', 1110000, 1112330, 'B004'),
('C00002', '2014-07-04', 'Auto', 111254, 111308, 'B001');

-- --------------------------------------------------------

--
-- Table structure for table `sponsor`
--

CREATE TABLE IF NOT EXISTS `sponsor` (
  `user_id` varchar(10) NOT NULL,
  `address` varchar(60) NOT NULL,
  `country` varchar(20) NOT NULL,
  `name` varchar(20) NOT NULL,
  `contact_no` int(10) NOT NULL,
  `date` date NOT NULL,
  `photo` varchar(50) NOT NULL,
  PRIMARY KEY (`user_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sponsor`
--

INSERT INTO `sponsor` (`user_id`, `address`, `country`, `name`, `contact_no`, `date`, `photo`) VALUES
('SP001', 'Jaffna town', 'srilanka', 'honey', 777100673, '2014-07-04', 'Hydrangeas.jpg'),
('SP002', 'dsfdsf', 'srilanka', 'dhoni', 777100673, '2014-07-11', '01.jpg'),
('SP003', 'sfs', 'srilanka', 'koli', 777100673, '2014-07-13', 'Capture.JPG'),
('SP004', 'colombo', 'srilanka', 'bala', 777100673, '2014-07-14', 'images (1).jpg'),
('SP005', 'chennai', 'india', 'Aswin', 777100673, '2014-07-14', 'images (3).jpg'),
('SP006', 'sdsad', 'sdsad', 'sdasd', 24324123, '2014-07-18', ''),
('SP007', '', 'jhuih', 'Kirubakaran', 777100673, '2014-07-29', ''),
('SP008', '', 'jhuih', 'Kirubakaran', 777100673, '2014-07-29', ''),
('SP009', '12/2,Temple Road, Jaffna.', 'SriLanka', 'Murali Manokar', 711223587, '2014-08-28', '24.JPG'),
('SP010', '4/2,Manipai Road Jaffna', 'SriLanka', 'Kalinkan', 714562312, '2014-08-28', '22.JPG'),
('SP011', '4/2,Manipai Road Jaffna', 'SriLanka', 'Karunakaran', 754572312, '2014-08-28', '22.JPG');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE IF NOT EXISTS `staff` (
  `user_id` varchar(10) NOT NULL,
  `title` varchar(5) NOT NULL,
  `name` varchar(30) NOT NULL,
  `staff_designation` varchar(15) NOT NULL,
  `address` varchar(60) NOT NULL,
  `contact_no` varchar(10) NOT NULL,
  `nic_no` varchar(10) NOT NULL,
  `email_id` varchar(20) NOT NULL,
  `dob` date NOT NULL,
  `branch_id` varchar(10) NOT NULL,
  `basic_salary` int(10) NOT NULL,
  `photo` varchar(50) NOT NULL,
  PRIMARY KEY (`user_id`),
  KEY `user_id` (`user_id`),
  KEY `branch_id` (`branch_id`),
  KEY `dob` (`dob`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`user_id`, `title`, `name`, `staff_designation`, `address`, `contact_no`, `nic_no`, `email_id`, `dob`, `branch_id`, `basic_salary`, `photo`) VALUES
('S001', 'Mr', 'Kirubakaran Periyavan', 'superintendent', 'Jaffna  Town', '0777100673', '652255566V', 'ihujkbyag@gmail.com', '1965-02-09', 'B001', 35000, 's1.jpg'),
('S002', 'Mr', 'Raju', 'clerk', 'chava', '0777100673', '68767987', 'oijoiji@yyy.com', '1980-06-16', 'B002', 15000, ''),
('S003', 'Mr', 'Senthuran', 'superintendent', 'manager', '0777100673', '68767987', 'oijoiji@yyy.com', '1973-07-18', 'B004', 25000, 's2.jpg'),
('S004', 'Mr', 'mainthan', 'Delete', 'kili', '0777352055', '68767987', 'dsfsdfd@fgfg.com', '1985-07-08', 'B002', 25000, 'S004.jpg'),
('S005', 'Mr', 'bala', 'clerk', 'vavuniya', '96878967', '68767987', 'ihuiyg@gmail.com', '1964-05-11', 'B004', 15000, ''),
('S006', 'Miss', 'mala Shuthan', 'clerk', '11/2 Palali Road Jaffna', '0774568521', '855232456V', 'mala@gmail.com', '1985-04-05', 'B001', 15000, 's33.jpg'),
('S009', 'Mr', 'Harikaran', 'Doctor', 'Uduvil West Uduvil ', '0777140673', '824654644v', 'hari@gmail.com', '1982-04-21', 'B001', 30000, 's9.jpg'),
('S010', 'Miss', 'Kamala', 'Delete', 'jaffna', '96878967', '11465464v', '', '1945-05-12', 'B002', 10000, ''),
('S011', 'Mr', 'Jiva', 'Ward incharge', 'sdgfs', '0777100673', '11465464v', 'dsfsdfd@fgfg.com', '1978-04-15', 'B004', 10000, 's11.jpg'),
('S012', 'Mr', 'Kumar', 'Ward incharge', 'vavuniya', '0775585555', '5585655888', 'bvdbdd@gmail.com', '2014-06-10', 'B004', 12000, ''),
('S013', 'Mr', 'ginthan', 'Ward incharge', 'kili', '0777100673', '11465464v', 'bjbjhb@yahoo.com', '2014-06-17', 'B002', 12300, ''),
('S014', 'Mr', 'kunaa', 'Ward incharge', 'hjbhg', '4544657487', '5878979', 'dsndjksahd@yahoo.com', '2014-06-04', 'B003', 10000, ''),
('S015', 'Mr', 'chasi', 'Ward incharge', 'fgchfdxg', '0777100673', '5878979', 'dsndjksahd@yahoo.com', '2014-06-01', 'B003', 10000, ''),
('S016', 'Mr', 'janakan', 'Labour', 'ertyry', '0777100673', '68767987', 'dsndjksahd@yahoo.com', '2014-06-03', 'B004', 4545, ''),
('S017', 'Mr', 'Chasikaran', 'clerk', 'Suthumalai North Suthumalai', '0777100673', '664646555v', 'chasi@yahoo.com', '1966-07-01', 'B001', 10000, 's15.jpg'),
('S018', 'Mr', 'Kumar Maran', 'superintendent', 'Kokuvil West Kokuvil', '0777150673', '654646555v', 'kumar@yahoo.com', '1965-07-01', 'B001', 10000, 's5.jpg'),
('S019', 'Mr', 'Venu', 'Doctor', 'vavuniya', '0777100673', '454646555v', 'dsndjksahd@yahoo.com', '2014-06-30', 'B004', 10000, ''),
('S020', 'Mr', 'Thavapalan', 'Ward incharge', 'punthodam,vavuniya', '0777523262', '821691915V', 'styay@yahoo.com', '1982-02-09', 'B004', 10000, ''),
('S022', 'Mr', 'Thami Sabapathi', 'Ward incharge', 'kaithady Jaffna', '0714562312', '855652314V', 'ihuiyg@gmail.com', '1985-02-04', 'B001', 10000, '22.jpg'),
('S023', 'Mr', 'kamalanathan', 'Ward incharge', 'Jaffna Kaithady', '0774568521', '744591914V', 'dsfsdfd@fgfg.com', '1974-12-04', 'B001', 10000, '23.jpg'),
('S024', 'Mr', 'Janakamurali', 'Ward incharge', 'Jaffna', '0774568521', '652255566V', 'oijoiji@yyy.com', '1965-08-04', 'B001', 10000, '24.jpg'),
('S025', 'Mr', 'Janakamurthi', 'Ward incharge', 'Jaffna', '0774568521', '652255566V', 'oijoiji@yyy.com', '1965-08-04', 'B001', 10000, '26.jpg'),
('S026', 'Mr', 'Kalinkan', 'Ward incharge', 'Jaffna', '0774568521', '564512963V', 'ihuiyg@gmail.com', '1956-04-05', 'B001', 10000, ''),
('S027', 'Mrs', 'Umathevi Mukunth', 'Ward incharge', 'Kaithady', '0774568521', '541223568V', 'uma@gmail.com', '1954-02-04', 'B001', 10000, 's13.jpg'),
('S028', 'Miss', 'Malathi Lakshuman', 'Ward incharge', 'Chunnakam Center Chunnakam,Jaffna', '0774521328', '784523169V', 'malatii@gmail.com', '1978-04-12', 'B001', 10000, '28.JPG'),
('S029', 'Mr', 'Manivanan Parathi', 'Ward incharge', '41/2,Temple Road Jaffna', '0771223587', '824569321V', 'parath@gmail.com', '1982-12-05', 'B001', 10000, '29.JPG'),
('S030', 'Miss', 'Ruba Maniyam', 'Ward incharge', 'Kokuvil West Kokuvil\r\nJaffna', '0714523987', '835612423V', 'Ruba@gmail.com', '1983-04-05', 'B001', 10000, '30.JPG'),
('S031', 'Mr', 'Paavanan Mukunthan', 'Ward incharge', 'Suthumalai West Shanganai', '0774512234', '811256984V', 'Paa@gmail.com', '1981-12-11', 'B001', 10000, '31.JPG'),
('S032', 'Mr', 'Murali Manokar', 'Ward incharge', 'Nelliyadi Center Nelliyadi', '0714526351', '569847142V', 'Murali@yahoo.com', '1956-04-15', 'B001', 10000, '32.JPG'),
('S033', 'Mrs', 'Bavani Kirshan', 'Ward incharge', 'Kaithady West kaithady', '0777756321', '714562238V', 'kirsh@yahoo.com', '1971-08-07', 'B001', 10000, '33.JPG'),
('S034', 'Mr', 'Piranavan Pandiyan', 'Ward incharge', 'Kaithady East Kaithady', '0771223587', '721556984V', 'pira@gmail.com', '1972-06-12', 'B001', 10000, '34.JPG');

-- --------------------------------------------------------

--
-- Table structure for table `supply`
--

CREATE TABLE IF NOT EXISTS `supply` (
  `supply_id` varchar(10) NOT NULL,
  `purchase_id` varchar(10) NOT NULL,
  `user_id` varchar(10) NOT NULL,
  `date` date NOT NULL,
  `no_of_items` int(10) NOT NULL,
  `home_no` varchar(10) NOT NULL,
  `ward_no` varchar(10) NOT NULL,
  PRIMARY KEY (`supply_id`),
  KEY `purchase_id` (`purchase_id`),
  KEY `home_no` (`home_no`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supply`
--

INSERT INTO `supply` (`supply_id`, `purchase_id`, `user_id`, `date`, `no_of_items`, `home_no`, `ward_no`) VALUES
('SI00001', 'P00001', 'S003', '2014-07-01', 2, 'H001', 'W001'),
('SI00002', 'P00005', 'S003', '2014-06-01', 5, 'H001', 'W002'),
('SI00003', 'P00007', 'S018', '2014-07-07', 2, 'H001', 'W001'),
('SI00004', 'P00007', 'S018', '2014-07-01', 2, 'H001', 'W002'),
('SI00005', 'P00009', 'S018', '2014-07-02', 5, 'H001', 'W001'),
('SI00006', 'P00007', 'S018', '2014-06-02', 3, 'H001', 'W003'),
('SI00007', 'P00015', 'S018', '2014-06-05', 5, 'H001', 'W003');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` varchar(10) NOT NULL,
  `password` varchar(20) NOT NULL,
  `usertype` varchar(15) NOT NULL,
  `attempts` int(1) NOT NULL,
  `code` int(10) NOT NULL,
  PRIMARY KEY (`user_id`),
  KEY `user_id` (`user_id`),
  KEY `usertype` (`usertype`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `password`, `usertype`, `attempts`, `code`) VALUES
('S001', '1234567', 'admin', 0, 0),
('S002', '123', 'Delete', 0, 0),
('S003', '123', 'manager', 0, 0),
('S004', '123', 'manager', 0, 19406),
('S005', '111', 'clerk', 0, 0),
('S006', '111', 'clerk', 0, 0),
('S009', '123', 'doctor', 0, 0),
('S010', '123', 'Delete', 0, 0),
('S011', '123', 'ward-incharge', 0, 0),
('S012', '123', 'ward-incharge', 0, 0),
('S013', '123', 'ward-incharge', 0, 0),
('S014', '123', 'ward-incharge', 0, 0),
('S015', '123', 'ward-incharge', 0, 0),
('S016', '123', 'Labour', 0, 0),
('S017', '123', 'clerk', 0, 0),
('S018', '123', 'manager', 0, 0),
('S019', '123', 'doctor', 0, 0),
('S020', '123', 'Delete', 1, 0),
('S021', '111', 'Delete', 2, 0),
('S022', '1234567', 'ward-incharge', 0, 0),
('S023', '1234567', 'ward-incharge', 0, 0),
('S024', '1234567', 'ward-incharge', 0, 0),
('S025', '12345678', 'ward-incharge', 0, 0),
('S026', '1234567', 'Delete', 0, 0),
('S027', '1234568', 'ward-incharge', 0, 0),
('S028', '1234567', 'ward-incharge', 0, 0),
('S029', '1234567', 'ward-incharge', 0, 0),
('S030', '1234567', 'ward-incharge', 0, 0),
('S031', '1234567', 'ward-incharge', 0, 0),
('S032', '1234567', 'ward-incharge', 0, 0),
('S033', '1234567', 'ward-incharge', 0, 0),
('S034', '1234567', 'ward-incharge', 0, 0),
('SP001', '1234567', 'sponsor', 0, 0),
('SP002', '123', 'sponsor', 0, 0),
('SP003', '111', 'sponsor', 0, 0),
('SP004', '111', 'pending', 0, 0),
('SP005', '111', 'pending', 0, 0),
('SP006', 'fdfsdf', 'pending', 0, 0),
('SP007', '111', 'pending', 0, 0),
('SP008', '111', 'pending', 0, 0),
('SP009', '1234567', 'sponsor', 0, 0),
('SP010', '1234567', 'pending', 0, 0),
('SP011', '1234567', 'pending', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ward`
--

CREATE TABLE IF NOT EXISTS `ward` (
  `home_no` varchar(10) NOT NULL,
  `ward_no` varchar(10) NOT NULL,
  `no_of_beds` int(10) NOT NULL,
  `incharge` varchar(10) NOT NULL,
  `remarks` varchar(30) NOT NULL,
  `ward_type` varchar(10) NOT NULL,
  `branch_id` varchar(10) NOT NULL,
  PRIMARY KEY (`home_no`,`ward_no`,`branch_id`),
  KEY `home_no` (`home_no`),
  KEY `ward_no` (`ward_no`),
  KEY `branch_id` (`branch_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ward`
--

INSERT INTO `ward` (`home_no`, `ward_no`, `no_of_beds`, `incharge`, `remarks`, `ward_type`, `branch_id`) VALUES
('H001', 'W001', 5, 'S022', 'Old building ', 'normal', 'B001'),
('H001', 'W001', 5, 'S014', 'hbvh', 'nomal', 'B003'),
('H001', 'W001', 5, 'S011', 'jhgjh', 'normal', 'B004'),
('H001', 'W002', 5, 'S023', 'Old building ', 'normal', 'B001'),
('H001', 'W002', 5, 'S015', 'hghj', 'nomal', 'B003'),
('H001', 'W002', 5, 'S011', 'gjhf', 'normal', 'B004'),
('H001', 'W003', 5, 'S024', 'Old building ', 'upnormal', 'B001'),
('H001', 'W003', 5, 'S020', 'ward', 'normal', 'B004'),
('H001', 'W004', 5, 'S025', 'Old building ', 'normal', 'B001'),
('H001', 'W004', 5, 'S012', 'dfg', 'upnormal', 'B004'),
('H001', 'W005', 5, 'S027', 'Old building ', 'normal', 'B001'),
('H001', 'W005', 5, 'S012', 'bnm', 'nomal', 'B004'),
('H002', 'W001', 7, 'S028', 'New Building', 'normal', 'B001'),
('H002', 'W001', 5, 'S011', 'hj', 'normal', 'B004'),
('H002', 'W002', 5, 'S030', 'New Building', 'normal', 'B001'),
('H002', 'W002', 0, '0', '0', '0', 'B004'),
('H002', 'W003', 5, 'S029', 'New Building', 'upnormal', 'B001'),
('H002', 'W004', 6, 'S031', 'New Building', 'normal', 'B001'),
('H002', 'W005', 5, 'S032', 'New Building', 'normal', 'B001');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `asset`
--
ALTER TABLE `asset`
  ADD CONSTRAINT `asset_ibfk_2` FOREIGN KEY (`purchase_id`) REFERENCES `purchase` (`purchase_id`);

--
-- Constraints for table `consumable`
--
ALTER TABLE `consumable`
  ADD CONSTRAINT `consumable_ibfk_2` FOREIGN KEY (`purchase_id`) REFERENCES `purchase` (`purchase_id`);

--
-- Constraints for table `death`
--
ALTER TABLE `death`
  ADD CONSTRAINT `death_ibfk_1` FOREIGN KEY (`admission_no`) REFERENCES `elders` (`admission_no`);

--
-- Constraints for table `diagnosis`
--
ALTER TABLE `diagnosis`
  ADD CONSTRAINT `diagnosis_ibfk_1` FOREIGN KEY (`admission_no`) REFERENCES `elders` (`admission_no`),
  ADD CONSTRAINT `diagnosis_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `staff` (`user_id`);

--
-- Constraints for table `duty`
--
ALTER TABLE `duty`
  ADD CONSTRAINT `duty_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `staff` (`user_id`),
  ADD CONSTRAINT `duty_ibfk_2` FOREIGN KEY (`home_no`) REFERENCES `ward` (`home_no`);

--
-- Constraints for table `elders`
--
ALTER TABLE `elders`
  ADD CONSTRAINT `elders_ibfk_1` FOREIGN KEY (`branch_id`) REFERENCES `branch` (`branch_id`),
  ADD CONSTRAINT `fk_elders_guardian1` FOREIGN KEY (`admission_no`) REFERENCES `guardian` (`admission_no`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `event`
--
ALTER TABLE `event`
  ADD CONSTRAINT `event_ibfk_1` FOREIGN KEY (`branch_id`) REFERENCES `branch` (`branch_id`),
  ADD CONSTRAINT `event_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `sponsor` (`user_id`);

--
-- Constraints for table `expense`
--
ALTER TABLE `expense`
  ADD CONSTRAINT `expense_ibfk_1` FOREIGN KEY (`branch_id`) REFERENCES `branch` (`branch_id`);

--
-- Constraints for table `food`
--
ALTER TABLE `food`
  ADD CONSTRAINT `food_ibfk_3` FOREIGN KEY (`branch_id`) REFERENCES `ward` (`branch_id`);

--
-- Constraints for table `medicine`
--
ALTER TABLE `medicine`
  ADD CONSTRAINT `medicine_ibfk_1` FOREIGN KEY (`admission_no`) REFERENCES `elders` (`admission_no`),
  ADD CONSTRAINT `medicine_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `staff` (`user_id`);

--
-- Constraints for table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `news_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `staff` (`user_id`);

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`usertype`) REFERENCES `user` (`usertype`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `purchase`
--
ALTER TABLE `purchase`
  ADD CONSTRAINT `purchase_ibfk_2` FOREIGN KEY (`item_no`) REFERENCES `item` (`item_no`),
  ADD CONSTRAINT `purchase_ibfk_3` FOREIGN KEY (`branch_id`) REFERENCES `branch` (`branch_id`);

--
-- Constraints for table `running_chart`
--
ALTER TABLE `running_chart`
  ADD CONSTRAINT `running_chart_ibfk_1` FOREIGN KEY (`branch_id`) REFERENCES `branch` (`branch_id`);

--
-- Constraints for table `sponsor`
--
ALTER TABLE `sponsor`
  ADD CONSTRAINT `sponsor_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `staff`
--
ALTER TABLE `staff`
  ADD CONSTRAINT `staff_ibfk_1` FOREIGN KEY (`branch_id`) REFERENCES `branch` (`branch_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `staff_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `supply`
--
ALTER TABLE `supply`
  ADD CONSTRAINT `supply_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `staff` (`user_id`),
  ADD CONSTRAINT `supply_ibfk_2` FOREIGN KEY (`purchase_id`) REFERENCES `purchase` (`purchase_id`);

--
-- Constraints for table `ward`
--
ALTER TABLE `ward`
  ADD CONSTRAINT `ward_ibfk_1` FOREIGN KEY (`branch_id`) REFERENCES `branch` (`branch_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
