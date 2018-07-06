-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 27, 2018 at 09:24 AM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 7.0.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hosy2`
--

-- --------------------------------------------------------

--
-- Table structure for table `drugs`
--

CREATE TABLE `drugs` (
  `s_no` int(4) NOT NULL,
  `drug` varchar(100) DEFAULT NULL,
  `chem` varchar(100) DEFAULT NULL,
  `status` varchar(1) DEFAULT NULL,
  `weight` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `drugs`
--

INSERT INTO `drugs` (`s_no`, `drug`, `chem`, `status`, `weight`) VALUES
(1, 'Parecetamol', 'paracentamol', 'A', 1000),
(2, 'Asmal', 'Brufen and cadiatic', 'A', 20001),
(3, 'Actm', 'Quininine and atimalrial drug', 'I', 3000),
(4, 'Brufen', 'Amoxillin', 'I', 5000),
(5, 'Sleep', 'Navirapine', 'A', 200);

-- --------------------------------------------------------

--
-- Table structure for table `laboratory_test`
--

CREATE TABLE `laboratory_test` (
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `visit_no` varchar(4) NOT NULL,
  `reg_no` varchar(15) NOT NULL,
  `attended` varchar(1) NOT NULL DEFAULT '0',
  `test` varchar(200) DEFAULT NULL,
  `result` varchar(200) DEFAULT NULL,
  `conducted_by` varchar(54) DEFAULT NULL,
  `submited_by` varchar(54) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `laboratory_test`
--

INSERT INTO `laboratory_test` (`date`, `visit_no`, `reg_no`, `attended`, `test`, `result`, `conducted_by`, `submited_by`) VALUES
('2018-06-26 10:43:04', '44', 'ci/00089/014', '4', '<ol><li>Malaria</li><li>typhid</li><li><p>HIV/AIDS</p>\r\n</li></ol>', '<ol><li>no mps seen</li><li>no typhoid</li><li>HIV Positive</li></ol>', ' ', 'Mary Emmaculate');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `fromm` varchar(32) NOT NULL,
  `too` varchar(32) NOT NULL,
  `subject` varchar(32) NOT NULL,
  `message` varchar(100) NOT NULL,
  `read` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`time`, `fromm`, `too`, `subject`, `message`, `read`) VALUES
('2016-07-26 01:12:49', '', 'abramogol@gmail.com', 'Mcogol', 'i love&nbsp; you soo much ', 1),
('2016-07-26 01:12:49', '', 'abramogol@gmail.com', 'Mcogol', 'Much Much love lol ', 1),
('2016-07-26 01:12:49', 'abramogol@gmail.com', 'abramogol@gmail.com', 'let me try again', 'I love you Jesus ', 1),
('2016-07-29 15:55:43', 'evansobuya@gmail.com', 'evansobuya@gmail.com', 'My account settings', 'My account has an update failure please reffer', 0),
('2018-06-26 11:48:03', 'maryemmaculate96@gmail.com', 'maryemmaculate96@gmail.com', 'greeting', '<p>Hello.</p>\r\n', 1);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `sno` int(4) NOT NULL,
  `first_name` varchar(12) NOT NULL,
  `last_name` varchar(12) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL DEFAULT 'maseno',
  `level` varchar(1) NOT NULL,
  `dob` varchar(20) DEFAULT NULL,
  `email` varchar(32) DEFAULT NULL,
  `id_no` varchar(22) DEFAULT NULL,
  `tel` varchar(14) DEFAULT NULL,
  `sex` varchar(4) DEFAULT NULL,
  `address` varchar(30) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `active` text,
  `profile_image` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`sno`, `first_name`, `last_name`, `username`, `password`, `level`, `dob`, `email`, `id_no`, `tel`, `sex`, `address`, `status`, `active`, `profile_image`) VALUES
(2, 'Joan', 'Amollo', 'joanamollo', 'd41d8cd98f00b204e9800998ecf8427e', '2', '1995/13/10', 'joanamollo@gmail.com', '343432344', '755454546', 'M', 'Kombewa', 1, 'YES', NULL),
(3, 'Mary', 'Emmaculate', 'maryadmin', 'fc59947d8e5048c06259e9cf1eaba368', '5', '1996/06/15', 'maryemmaculate96@gmail.com', '32952962', '0790563611', 'F', 'Maseno', 1, 'YES', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `staff_kin`
--

CREATE TABLE `staff_kin` (
  `first_name` varchar(32) NOT NULL,
  `last_name` varchar(23) NOT NULL,
  `reg_no` varchar(23) NOT NULL,
  `contact` varchar(23) DEFAULT NULL,
  `d_o_b` varchar(12) NOT NULL,
  `profile_image` varchar(54) DEFAULT NULL,
  `sex` varchar(9) NOT NULL,
  `relationship` varchar(23) NOT NULL,
  `health_info` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff_kin`
--

INSERT INTO `staff_kin` (`first_name`, `last_name`, `reg_no`, `contact`, `d_o_b`, `profile_image`, `sex`, `relationship`, `health_info`) VALUES
('John', 'Wick', 'ci/1111/1112', '123456789', '2016/08/01', '', 'M', 'son', NULL),
('Stephen', 'Ondeche', 'cb/0098/212', '', '2016/08/01', '1470259129_20150722_183245.jpg', 'M', 'wife', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `staff_patient`
--

CREATE TABLE `staff_patient` (
  `first_name` varchar(23) NOT NULL,
  `last_name` varchar(23) NOT NULL,
  `reg_no` varchar(22) NOT NULL,
  `its_email` varchar(50) NOT NULL,
  `email` varchar(43) NOT NULL,
  `d_o_b` varchar(10) NOT NULL,
  `contact` varchar(13) NOT NULL,
  `profile_image` varchar(100) DEFAULT NULL,
  `fuculty` varchar(34) NOT NULL,
  `position` varchar(23) NOT NULL,
  `status` varchar(8) NOT NULL,
  `health_info` varchar(100) DEFAULT NULL,
  `address` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff_patient`
--

INSERT INTO `staff_patient` (`first_name`, `last_name`, `reg_no`, `its_email`, `email`, `d_o_b`, `contact`, `profile_image`, `fuculty`, `position`, `status`, `health_info`, `address`) VALUES
('Wekesa', 'Noah', 'ci/1111/1112', 'noa@gmail.com', 'noa@gmail.com', '2016/08/01', '0123455678', '', 'Computing', 'Lecturer', 'married', '', 'Kisumu');

-- --------------------------------------------------------

--
-- Table structure for table `student_patient`
--

CREATE TABLE `student_patient` (
  `first_name` varchar(11) CHARACTER SET utf8 NOT NULL,
  `last_name` varchar(11) CHARACTER SET utf8mb4 NOT NULL,
  `reg_no` varchar(20) CHARACTER SET utf8mb4 NOT NULL,
  `address` varchar(11) CHARACTER SET utf8mb4 NOT NULL,
  `email` varchar(23) NOT NULL,
  `d_o_b` varchar(10) NOT NULL,
  `contact` varchar(23) NOT NULL,
  `profile_image` varchar(100) DEFAULT NULL,
  `course` varchar(40) DEFAULT NULL,
  `fuculty` varchar(40) DEFAULT NULL,
  `health_info` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_patient`
--

INSERT INTO `student_patient` (`first_name`, `last_name`, `reg_no`, `address`, `email`, `d_o_b`, `contact`, `profile_image`, `course`, `fuculty`, `health_info`) VALUES
('Andrew', 'Ogol', 'BS/00001/014', 'Kisumu', 'andrew@gmail.com', '2001/10/13', '0726412357', '2.jpg', 'Bcom', 'Computing', 'none'),
('Conie', 'Mayai', 'ci/00019/01', 'nyawita', 'conie@gmail.com', '2016/09/01', '1234567890', '1472860780_1.jpg', 'css', 'Medicine', 'ggggggggg'),
('Caroline', 'Ahenda', 'ci/00089/014', '1069-50300', 'carolineahenga@gmail.co', '1997/04/28', '0713996435', '1530084073_photo.JPG', 'ICT', 'Computing', 'Healthy'),
('Mary Emmacu', 'Adhiambo', 'CI/00094/014', '1069-50300', 'maryemmaculate96@gmail.', '1996/06/15', '0790563611', '1530084148_IMG_9694.JPG', 'Bsc. IT', 'Computing', 'Unhealthy'),
('JACOB', 'MOTH', 'ED/00023/021', 'Kisumu', 'jacobmoth@gmail.com', '2013/08/03', '0704497273', '1470264612_IMG_20150708_135031.jpg', 'BEc Econ', 'Medicine', '');

-- --------------------------------------------------------

--
-- Table structure for table `treatment`
--

CREATE TABLE `treatment` (
  `visit_no` varchar(5) NOT NULL,
  `reg_no` varchar(15) NOT NULL,
  `signs` varchar(50) DEFAULT NULL,
  `notes` varchar(100) DEFAULT NULL,
  `attended` int(1) NOT NULL DEFAULT '0',
  `prescription` varchar(100) DEFAULT NULL,
  `druged_by` varchar(30) DEFAULT NULL,
  `seen_by` varchar(33) DEFAULT NULL,
  `prescribed_by` varchar(33) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `treatment`
--

INSERT INTO `treatment` (`visit_no`, `reg_no`, `signs`, `notes`, `attended`, `prescription`, `druged_by`, `seen_by`, `prescribed_by`) VALUES
('32', 'ci/00098/102', '<ol>\r\n	<li>fever</li>\r\n	<li>hadache</li>\r\n	<li>col', '<p>sighns of malaria</p>', 3, '<ol>\r\n	<li>P', 'Mary Emmaculate', 'Mary Emmaculate', 'Mary Emmaculate'),
('33', 'ci/00098/14', '<p>Hass the following signs</p>\r\n\r\n<ol>\r\n	<li>feve', '<p>food poisoning may have caoused the same</p>', 3, '<ol>\r\n	<li>p', 'Mary Emmaculate', 'Mary Emmaculate', 'Mary Emmaculate'),
('35', 'ci/00098/14', '<p>Savere head injuries</p>', '<p>exterla injury</p>', 0, NULL, NULL, 'Mary Emmaculate', NULL),
('38', 'ci/00098/102', '<p>fever and hadache</p>', '<p>lab prescription</p>', 3, '<p>Paracetamol</p>\r\n', 'Mary Emmaculate', 'Mary Emmaculate', 'Mary Emmaculate'),
('40', 'ci/00098/14', '<p>Fever , hadache, diarrhear and vomit</p>', '<p>No serious signs jas&nbsp; an antimalerial drug would do</p>', 3, '<p>Malaria tabs and ACTMS </p>', 'Mary Emmaculate', 'Mary Emmaculate', 'Abraham Ogol'),
('44', 'ci/00089/014', '<p>Seems pale.</p>\r\n\r\n<p>Loss of appetite.</p>', '<p>Test for malaria.</p>', 3, '<p>ARVs</p>\r\n', 'Mary Emmaculate', 'Mary Emmaculate', 'Mary Emmaculate');

-- --------------------------------------------------------

--
-- Table structure for table `visit`
--

CREATE TABLE `visit` (
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `reg_no` varchar(20) NOT NULL,
  `visit_no` int(20) NOT NULL,
  `case` int(1) NOT NULL,
  `attended` int(1) DEFAULT '0',
  `temp` varchar(5) DEFAULT NULL,
  `bp` varchar(5) DEFAULT NULL,
  `examined_by` varchar(32) DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `visit`
--

INSERT INTO `visit` (`date`, `reg_no`, `visit_no`, `case`, `attended`, `temp`, `bp`, `examined_by`, `created_by`) VALUES
('2018-06-26 10:30:41', 'ci/00089/014', 44, 0, 3, '37', '100', 'Mary Emmaculate', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `drugs`
--
ALTER TABLE `drugs`
  ADD PRIMARY KEY (`s_no`);

--
-- Indexes for table `laboratory_test`
--
ALTER TABLE `laboratory_test`
  ADD PRIMARY KEY (`visit_no`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `staff_patient`
--
ALTER TABLE `staff_patient`
  ADD PRIMARY KEY (`reg_no`);

--
-- Indexes for table `student_patient`
--
ALTER TABLE `student_patient`
  ADD PRIMARY KEY (`reg_no`);

--
-- Indexes for table `treatment`
--
ALTER TABLE `treatment`
  ADD PRIMARY KEY (`visit_no`);

--
-- Indexes for table `visit`
--
ALTER TABLE `visit`
  ADD PRIMARY KEY (`visit_no`),
  ADD KEY `visit_no` (`visit_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `drugs`
--
ALTER TABLE `drugs`
  MODIFY `s_no` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `sno` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `visit`
--
ALTER TABLE `visit`
  MODIFY `visit_no` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
