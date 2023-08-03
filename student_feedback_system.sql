-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 28, 2022 at 04:31 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `student_feedback_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminid` int(10) NOT NULL,
  `adminname` varchar(100) NOT NULL,
  `loginid` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminid`, `adminname`, `loginid`, `password`, `status`) VALUES
(1, 'Raj shekar', 'admin', 'adminadminadmin', 'Active'),
(3, 'Ankesh', 'ankesh', 'ankesh', 'Active'),
(4, 'kamal', 'kamal', '123456789123', 'Active'),
(5, 'Archana', 'archana', 'archana', 'Active'),
(6, 'Akash sharma', 'akashsharma', '123456789', 'Active'),
(7, 'akashk', 'akashk', '123456789', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `course_id` bigint(20) NOT NULL,
  `course_title` varchar(50) NOT NULL,
  `course_description` text NOT NULL,
  `course_status` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`course_id`, `course_title`, `course_description`, `course_status`) VALUES
(1, 'Bsc', 'Bachelor of computer application', 'Active'),
(2, 'Msc', 'Mcomputera', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE `faculty` (
  `faculty_id` bigint(20) NOT NULL,
  `faculty_name` varchar(25) NOT NULL,
  `faculty_designation` varchar(30) NOT NULL,
  `faculty_img` varchar(300) NOT NULL,
  `faculty_profile` text NOT NULL,
  `faculty_status` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`faculty_id`, `faculty_name`, `faculty_designation`, `faculty_img`, `faculty_profile`, `faculty_status`) VALUES
(1, 'Prakash K', 'Lecturer', '285277618Tulips.jpg', 'He is experience lecturer', 'Active'),
(2, 'Raj', 'Lecturer', '206418318Koala.jpg', 'He is experience lecturer', 'Active'),
(3, 'Raj', 'Lecturer', '1823306781Jellyfish.jpg', 'He is experience lecturer', 'Active'),
(4, 'Balakrishna', 'Professor', '1495582553Penguins.jpg', 'Balakrishna is experience', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `feedbackquestion`
--

CREATE TABLE `feedbackquestion` (
  `feedbackquestionid` int(11) NOT NULL,
  `feedbacktopicid` int(11) NOT NULL,
  `question` text NOT NULL,
  `option1` text NOT NULL,
  `option2` text NOT NULL,
  `option3` text NOT NULL,
  `option4` text NOT NULL,
  `option5` text DEFAULT NULL,
  `option6` text DEFAULT NULL,
  `option7` text DEFAULT NULL,
  `option8` text DEFAULT NULL,
  `option9` text DEFAULT NULL,
  `option10` text DEFAULT NULL,
  `question_type` varchar(25) NOT NULL,
  `img` varchar(300) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `feedbackquestion`
--

INSERT INTO `feedbackquestion` (`feedbackquestionid`, `feedbacktopicid`, `question`, `option1`, `option2`, `option3`, `option4`, `option5`, `option6`, `option7`, `option8`, `option9`, `option10`, `question_type`, `img`, `status`) VALUES
(1, 33, 'How you rate our college?', '10%', '20%', '30%', '40%', '50%', '60%', '70%', '80%', '90%', '100%', 'Radio Button', '717044870', 'Active'),
(2, 33, 'What and all  essentials required hostel rooms?', 'TV', 'Radio', 'WIFI', 'Playroom', 'Others', '', '', '', '', '', 'Check Box', '1858801414Untitled.png', 'Active'),
(3, 33, 'Brief about our college', 'Improvements on college?', 'Improvement on rooms?', 'Any improvements on Teaching?', 'Any other feedback?', '', '', '', '', '', '', 'Text Box', '1081519210Online-Banking-project-in-PHP-and-MySQL.png', 'Active'),
(5, 33, 'How you', '', '', '', '', '', '', '', '', '', '', 'Text Box', '1570720566', 'Active'),
(6, 34, 'How is the teaching?', 'Good', 'Bad', 'Average', '', '', '', '', '', '', '', 'Radio Button', '1414765673Chrysanthemum.jpg', 'Active'),
(7, 34, 'What you like with this lecture?', 'Teaching', 'Notes', 'Materials', 'Experience', '', '', '', '', '', '', 'Check Box', '958201194Penguins.jpg', 'Active'),
(8, 34, 'Any feedback on this lecture', '', '', '', '', '', '', '', '', '', '', 'Text Box', '1711349905Penguins.jpg', 'Active'),
(9, 35, 'Rank this year lessons from easiest to hardest.', 'Very Good', 'Good', 'Average', 'Poor', '', '', '', '', '', '', 'Radio Button', '51963507', 'Active'),
(10, 35, 'Given a chance, what is one change that you would like to see?', 'Teaching method', 'Time taken to complete a chapter', 'Extracurricular activities', 'Other', '', '', '', '', '', '', 'Check Box', '38941828809-8092297_student-feedback-student-feedback-png.png', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `feedbackquestion_result`
--

CREATE TABLE `feedbackquestion_result` (
  `feedbackquestion_resultid` bigint(20) NOT NULL,
  `feedbacktopicid` int(11) NOT NULL,
  `studentid` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `feedbackquestionid` bigint(20) NOT NULL,
  `selectedanswer` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `feedbackquestion_result`
--

INSERT INTO `feedbackquestion_result` (`feedbackquestion_resultid`, `feedbacktopicid`, `studentid`, `date`, `feedbackquestionid`, `selectedanswer`) VALUES
(7, 33, 66, '2021-01-08 05:18:42', 1, '60%'),
(8, 33, 66, '2021-01-08 05:18:42', 2, ' Radio, Playroom.'),
(9, 33, 66, '2021-01-08 05:18:42', 3, 'Hello'),
(10, 33, 66, '2021-01-08 05:18:42', 5, ''),
(11, 34, 67, '2021-01-11 01:14:01', 6, 'Good'),
(12, 34, 67, '2021-01-11 01:14:01', 7, ' Teaching, Notes.'),
(13, 34, 67, '2021-01-11 01:14:01', 8, 'Good lecture'),
(14, 33, 67, '2021-01-11 01:23:51', 1, ''),
(15, 33, 67, '2021-01-11 01:23:51', 2, ''),
(16, 33, 67, '2021-01-11 01:23:51', 3, ''),
(17, 33, 67, '2021-01-11 01:23:51', 5, ''),
(21, 33, 2, '2022-02-27 20:54:54', 1, ''),
(22, 33, 2, '2022-02-27 20:54:54', 2, ''),
(23, 33, 2, '2022-02-27 20:54:54', 3, ''),
(24, 33, 2, '2022-02-27 20:54:54', 5, ''),
(28, 35, 2, '2022-02-27 21:30:25', 9, ''),
(29, 35, 2, '2022-02-27 21:30:25', 10, ''),
(30, 33, 5, '2022-02-28 20:40:42', 1, '70%'),
(31, 33, 5, '2022-02-28 20:40:42', 2, ' Radio, WIFI.'),
(32, 33, 5, '2022-02-28 20:40:42', 3, 'zThank you'),
(33, 33, 5, '2022-02-28 20:40:42', 5, 'Fine');

-- --------------------------------------------------------

--
-- Table structure for table `feedbacktopic`
--

CREATE TABLE `feedbacktopic` (
  `feedbacktopicid` int(11) NOT NULL,
  `course_id` bigint(20) NOT NULL,
  `faculty_id` bigint(20) NOT NULL,
  `feedback_topic` varchar(250) NOT NULL,
  `feedbacktopic_date` datetime NOT NULL,
  `feedback_icon` varchar(100) NOT NULL,
  `feedback_disptype` varchar(25) NOT NULL,
  `feedbacktopic_detail` text NOT NULL,
  `feedbacktopic_status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `feedbacktopic`
--

INSERT INTO `feedbacktopic` (`feedbacktopicid`, `course_id`, `faculty_id`, `feedback_topic`, `feedbacktopic_date`, `feedback_icon`, `feedback_disptype`, `feedbacktopic_detail`, `feedbacktopic_status`) VALUES
(32, 0, 0, 'Feedback on College', '2021-01-07 23:28:10', '1233402049Untitled.png', 'Pagination Viewer', 'Kindly provide feedback on colleges', 'Approved'),
(33, 0, 0, 'Feedback on College', '2021-01-07 23:36:57', '1203748258Online Charity Use Case Diagram.png', 'Pagination Viewer', 'Kindly provide feedback on college', 'Approved'),
(34, 1, 1, 'Feedback on Faculty', '2021-01-10 23:59:23', '1390149222Jellyfish.jpg', 'Pagination Viewer', 'Feedback on faculty description', 'Approved'),
(35, 1, 1, '5th Semester Feedback', '2022-02-27 21:18:10', '1615118510809-8092297_student-feedback-student-feedback-png.png', 'Pagination Viewer', '5th Semester just Finished some days before. Kindly provide feedback on 5th semeseter.\r\nYour feedback is very important for us.', 'Approved');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `studentid` int(10) NOT NULL,
  `studentname` varchar(50) NOT NULL,
  `rollno` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `course_id` int(25) NOT NULL,
  `section` varchar(25) NOT NULL,
  `dateofbirth` date NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`studentid`, `studentname`, `rollno`, `password`, `course_id`, `section`, `dateofbirth`, `status`) VALUES
(2, 'Raj kiran', '123456789', '123456789', 1, '4', '2003-12-31', 'Active'),
(3, 'Rajesh', '123000', '123456', 2, 'A', '2005-02-01', 'Active'),
(4, 'Akash', '78900', '1234567890', 1, 'A', '2008-04-09', 'Active'),
(5, 'Ananth kumar', '11156789', '1234567890', 2, 'AA', '2008-04-09', 'Active'),
(6, 'Sapalya', '10001', '10001', 1, 'A', '2008-04-09', 'Active'),
(7, 'Karan', '10002', '1234567890', 1, 'A', '2008-04-09', 'Active'),
(8, 'Krishna', '10003', '1234567890', 1, 'A', '2008-04-09', 'Active'),
(9, 'manohar', '10004', '1234567890', 2, 'A', '2008-04-09', 'Active'),
(10, 'Rakesh', '10005', '1234567890', 2, 'A', '2008-04-09', 'Active'),
(11, 'Ahalya', '10006', '1234567890', 2, 'A', '2008-04-09', 'Active'),
(12, 'Ajinkya', '10007', '1234567890', 2, 'A', '2008-04-09', 'Active'),
(13, 'Krithi', '10008', 'q1w2e3r4', 1, 'A', '2008-04-09', ''),
(14, 'Kristita', '10009', '1234567890', 1, 'A', '2008-04-09', 'Active'),
(15, 'nandan', '10010', '1234567890', 1, 'A', '2008-04-09', 'Active'),
(32, 'Ananth raj', '12300789', '123456789', 1, 'a', '2020-05-21', 'Active'),
(34, 'amin kumar', '789456111', 'q1w2e3r4aaa', 1, 'a', '1999-05-21', 'Active'),
(35, 'Alfred Raz', 'mvaravinda@gmail.com', 'a1s2d3f4', 1, 'A', '2008-04-09', 'Active'),
(36, 'Akash singh', 'akashsingh123@gmail.com', '123456789', 1, 'icj institute', '2006-01-01', ''),
(37, 'Original Name', 'Email ID', 'Password', 1, 'University Name', '2010-06-01', 'Active'),
(39, 'Anitha', 'anitha@gmail.com', '123456789', 1, 'Mangalore university', '2003-06-12', 'Pending'),
(41, 'Manvith', 'manvith@gmail.com', '778899445566', 1, 'Mangalore university', '1995-01-01', 'Active'),
(46, 'Aravind', 'aravinda@technopulse.in', '123456789', 1, 'Himalay', '1997-01-01', 'Active'),
(47, 'Maroom', 'maroom@gmail.com', '123456789', 1, 'A', '2005-01-01', 'Active'),
(49, 'Maroom', 'maroom1222@gmail.com', 'q1w2e3r4', 1, 'Maroon university', '2005-01-01', 'Pending'),
(50, 'akash', 'akazh@gma.com', '123456789', 1, 'Bellur', '1998-01-01', 'Pending'),
(51, 'Pratham', 'pratham1@gmail.com', '123456789', 1, 'Mino university', '2004-01-01', 'Pending'),
(52, 'Preetham', 'preetham2323@gmail.com', '789456123', 1, 'Als university', '1995-02-01', 'Pending'),
(53, 'deeraj', 'deeraj@gmail.com', '789456123', 1, 'mangalore university', '2008-01-01', 'Pending'),
(54, 'Miraj', 'miraj2@gmail.com', '789456123', 1, 'Mangalore university', '2008-12-31', 'Active'),
(55, 'Preetham kumar', 'preethamkumar@gamilc.om', '123456789', 1, 'Mangalore university', '2011-12-30', 'Active'),
(56, 'Raj chandra', 'rajdchandra@gmail.com', '789789789', 1, 'Maroon university', '2005-01-01', 'Active'),
(57, 'Punich', '78979', '789789', 1, 'A', '2001-12-30', 'Active'),
(58, 'amin', 'amin@gmail.com', '123456789', 1, 'Mangalore university', '2008-12-30', 'Active'),
(60, 'Manthesh', '44478979', '123456789', 1, 'a', '1999-01-01', 'Active'),
(61, 'Ananth kumar', '238923823', 'q1w2e3r4', 1, 'aa', '1998-05-04', ''),
(62, 'Bharath chipli', '8792344', '123456789', 1, 'a', '2017-01-08', 'Active'),
(63, 'Pratham', '71829379', 'q1w2e3r4', 1, 'A', '1988-05-04', 'Active'),
(65, 'Pallavi K', '789456', '123456789', 1, 'A', '1988-01-07', 'Active'),
(66, 'Balakrishna', '789901', '123456789', 1, 'A', '1888-05-04', 'Active'),
(67, 'Veeksha', '7979', '123456789', 1, 'a', '1998-05-01', 'Active'),
(68, 'Sudeep', '741852963', 'q1w2e3r4', 2, 'A', '1998-05-04', 'Active'),
(69, 'Shrikanth kumar', 'A1002454', 'Q1w2e3r4/', 1, 'A', '2010-05-04', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `studymaterial`
--

CREATE TABLE `studymaterial` (
  `studymaterial_id` int(11) NOT NULL,
  `categoryid` int(11) NOT NULL,
  `studentid` int(11) NOT NULL,
  `adminid` int(10) NOT NULL,
  `reply_studymaterial_id` int(11) NOT NULL,
  `studymaterial_title` varchar(150) NOT NULL,
  `studymaterial_date` datetime NOT NULL,
  `studymaterial_description` text NOT NULL,
  `attachments` varchar(300) NOT NULL,
  `studymaterial_status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `studymaterial`
--

INSERT INTO `studymaterial` (`studymaterial_id`, `categoryid`, `studentid`, `adminid`, `reply_studymaterial_id`, `studymaterial_title`, `studymaterial_date`, `studymaterial_description`, `attachments`, `studymaterial_status`) VALUES
(1046, 5, 7, 0, 0, 'Make the Best of Uncertain Times..', '2020-05-28 00:02:32', 'Researchers around the world are trying to make the best of unprecedented and uncertain times. Take advantage of Academiaâ€™s full suite of Premium productivity and analytics tools.', '1870702857IRJET-V5I3345.pdf', 'Approved'),
(1047, 0, 7, 0, 1046, '', '2020-05-28 00:02:21', 'hello', '1432978145', 'Student Reply'),
(1048, 5, 32, 0, 0, 'ligible for Ezoic Premium', '2020-05-28 00:05:44', 'The concept of Premium is simpleâ€”you\'ll make more money. This invite-only program will increase your revenue by giving you access to advanced features. Check out the benefits.', '1997377856Trade Notice.pdf', 'Approved'),
(1049, 0, 32, 0, 1048, '', '2020-05-28 00:06:26', 'hello', '85792285', 'Student Reply'),
(1050, 0, 0, 1, 1048, '', '2020-05-28 00:06:47', 'Thanks for sharing', '1262331359php.jpg', 'Admin Reply'),
(1051, 8, 32, 0, 0, 'Is your site reachable for search engines and visitors?', '2020-05-28 00:08:37', 'If you have a site, you probably want to know whether your site is reachable for search engines and visitors. So, did you know that Yoast SEO provides a tool that monitors your siteâ€™s indexability? You can find it in the WordPress Site Health tool. Itâ€™s time to check if your site is indexable!', '1203339224Trade Notice.pdf', 'Approved'),
(1052, 21, 3, 0, 0, 'Get the free app for faster savings near you..', '2020-05-28 21:34:54', 'Like our email?\r\nWe value your feedback to continuously improve our products.', '352428222Trade Notice.pdf', 'Approved'),
(1054, 0, 3, 0, 1052, '', '2020-05-28 21:33:28', 'Hello', '1495034522', 'Student Reply'),
(1055, 0, 3, 0, 1052, '', '2020-05-28 21:33:38', 'Hello', '435979628', 'Student Reply'),
(1056, 0, 3, 0, 1052, '', '2020-05-28 21:34:23', 'This is my record', '1867521861php.jpg', 'Student Reply'),
(1057, 21, 0, 1, 0, '5 BULLET FRIDAY - NEWS & INFO THIS WEEK', '2020-05-28 22:02:08', 'How Food Publishers are Helping the Restaurant Industry & Teen Vogue\'s Virtual Prom', '293365719Trade Notice.pdf', 'Approved'),
(1058, 0, 0, 1, 1052, '', '2020-05-28 22:20:55', 'Hello', '539755597', 'Admin Reply'),
(1059, 0, 0, 1, 1052, '', '2020-05-28 22:21:08', 'et us leave no stone\r\nunturned & join hands to\r\nfight the pandemic', '174927695floppy.jpg', 'Admin Reply'),
(1060, 0, 0, 1, 1052, '', '2020-05-28 22:23:43', 'For any contribution or payment done on\r\nPaytm, we will contribute an extra up to â‚¹10', '1183159667', 'Admin Reply'),
(1061, 21, 2, 0, 0, 'aaa', '2020-06-11 13:58:09', 'cc', '1393401860header3.pdf', 'Approved'),
(1062, 22, 2, 0, 0, 'cc', '2020-06-11 13:58:34', 'dd', '1304699671My Account _ Manage your Billing.pdf', 'Approved'),
(1065, 21, 0, 1, 0, 'aaccdd', '2020-06-13 13:53:39', 'atest', '1462754123My Account _ Manage your Billing.pdf', 'Approved'),
(1066, 0, 0, 1, 1063, '', '2020-06-13 13:54:51', 'Th', '2121320726', 'Admin Reply'),
(1068, 0, 0, 1, 1067, '', '2020-06-13 14:11:46', 'sf', '677989781', 'Admin Reply'),
(1069, 0, 0, 1, 1067, '', '2020-06-13 14:13:09', 'aaa', '402197990', 'Admin Reply');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminid`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`faculty_id`);

--
-- Indexes for table `feedbackquestion`
--
ALTER TABLE `feedbackquestion`
  ADD PRIMARY KEY (`feedbackquestionid`);

--
-- Indexes for table `feedbackquestion_result`
--
ALTER TABLE `feedbackquestion_result`
  ADD PRIMARY KEY (`feedbackquestion_resultid`);

--
-- Indexes for table `feedbacktopic`
--
ALTER TABLE `feedbacktopic`
  ADD PRIMARY KEY (`feedbacktopicid`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`studentid`),
  ADD UNIQUE KEY `rollno` (`rollno`);

--
-- Indexes for table `studymaterial`
--
ALTER TABLE `studymaterial`
  ADD PRIMARY KEY (`studymaterial_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adminid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `course_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `faculty`
--
ALTER TABLE `faculty`
  MODIFY `faculty_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `feedbackquestion`
--
ALTER TABLE `feedbackquestion`
  MODIFY `feedbackquestionid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `feedbackquestion_result`
--
ALTER TABLE `feedbackquestion_result`
  MODIFY `feedbackquestion_resultid` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `feedbacktopic`
--
ALTER TABLE `feedbacktopic`
  MODIFY `feedbacktopicid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `studentid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `studymaterial`
--
ALTER TABLE `studymaterial`
  MODIFY `studymaterial_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1070;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
