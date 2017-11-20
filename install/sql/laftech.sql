-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 20, 2017 at 10:33 AM
-- Server version: 10.1.22-MariaDB
-- PHP Version: 7.0.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laftech`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_preferences`
--

CREATE TABLE `admin_preferences` (
  `id` tinyint(1) NOT NULL,
  `user_panel` tinyint(1) NOT NULL DEFAULT '0',
  `sidebar_form` tinyint(1) NOT NULL DEFAULT '0',
  `messages_menu` tinyint(1) NOT NULL DEFAULT '0',
  `notifications_menu` tinyint(1) NOT NULL DEFAULT '0',
  `tasks_menu` tinyint(1) NOT NULL DEFAULT '0',
  `user_menu` tinyint(1) NOT NULL DEFAULT '1',
  `ctrl_sidebar` tinyint(1) NOT NULL DEFAULT '0',
  `transition_page` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin_preferences`
--

INSERT INTO `admin_preferences` (`id`, `user_panel`, `sidebar_form`, `messages_menu`, `notifications_menu`, `tasks_menu`, `user_menu`, `ctrl_sidebar`, `transition_page`) VALUES
(1, 1, 0, 0, 0, 0, 1, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(50) NOT NULL,
  `cat_desc` varchar(60) NOT NULL,
  `cat_color` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_name`, `cat_desc`, `cat_color`) VALUES
(1, 'Diode', 'diode desc1', '#f44336'),
(2, 'Resistor', 'test desc', '#3f51b5'),
(3, 'Potentiometer', 'test2', '#9c27b0');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `c_id` int(11) NOT NULL,
  `c_name` varchar(50) NOT NULL,
  `c_person` varchar(50) NOT NULL,
  `c_address` varchar(255) NOT NULL,
  `c_contactno` int(11) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`c_id`, `c_name`, `c_person`, `c_address`, `c_contactno`, `email`) VALUES
(1, 'AAFSOFTWAREWORKS', 'Allan Rabanillo', 'Stark Bldg, USA', 2147483647, 'aafsoftwareworks@gmail.com'),
(2, 'JSI Logistics', 'John Doe', 'Pascor Drive, Sky freight Paranaque', 2147483647, 'jsilogistics@gmail.com'),
(3, 'asdasdsad', 'sadasd', 'ASD\'s Room', 213213213, 'asdasdasd@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  `bgcolor` char(7) NOT NULL DEFAULT '#607D8B'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`, `bgcolor`) VALUES
(1, 'admin', 'Administrator', '#F44336'),
(2, 'members', 'General User', '#2196F3'),
(3, 'Technician', 'Group for Technician', '#009688');

-- --------------------------------------------------------

--
-- Table structure for table `in_and_out`
--

CREATE TABLE `in_and_out` (
  `job_no` varchar(50) NOT NULL,
  `c_id` int(11) NOT NULL,
  `item_desc` varchar(150) NOT NULL,
  `serialno` varchar(50) NOT NULL,
  `partno` varchar(50) NOT NULL,
  `modelno` varchar(50) NOT NULL,
  `refno` varchar(50) NOT NULL,
  `date_in` date NOT NULL,
  `date_out` date NOT NULL,
  `drno` varchar(50) NOT NULL,
  `status` varchar(20) NOT NULL,
  `dn_no` varchar(50) NOT NULL,
  `invno` varchar(50) NOT NULL,
  `date_inv` date DEFAULT NULL,
  `remarks` varchar(150) NOT NULL,
  `images` varchar(250) NOT NULL,
  `drawing` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `in_and_out`
--

INSERT INTO `in_and_out` (`job_no`, `c_id`, `item_desc`, `serialno`, `partno`, `modelno`, `refno`, `date_in`, `date_out`, `drno`, `status`, `dn_no`, `invno`, `date_inv`, `remarks`, `images`, `drawing`) VALUES
('LIS-15263', 1, 'VEHICLE MANAGER (BR243 ZENNITH FOODS)', '1401170025', '1045780/106R', '', '', '2015-12-17', '2016-03-27', '0810', 'UNDERWARRANTY', '31207', '', '0000-00-00', 'FORTEST BTHI in', 'LIS-15263_p1.png,LIS-15263_sa1.png', 'LIS-15263_316701b.png,LIS-15263_epak.png,LIS-15263_impinj1.PNG,LIS-15263_impinj2.PNG,LIS-15263_impinj3.PNG,LIS-15263_magento_credentials.PNG'),
('LIS-16045', 2, 'VEHICLE MANAGER (POLAR BEAR)', '13082301592', '1045780/105', '', '', '2016-05-12', '0000-00-00', '', 'NAU', '0038843', '', '0000-00-00', 'NO AVAILABLE UNIT', 'LIS-16045_epak.png,LIS-16045_iam+_order.PNG,LIS-16045_impinj2.PNG', 'LIS-16045_s9.png,LIS-16045_s10.png');

-- --------------------------------------------------------

--
-- Table structure for table `job_history`
--

CREATE TABLE `job_history` (
  `id` int(11) NOT NULL,
  `job_no` varchar(50) NOT NULL,
  `old_job_no` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `job_history`
--

INSERT INTO `job_history` (`id`, `job_no`, `old_job_no`) VALUES
(1, 'LIS-16045', 'LIS-15263'),
(11, 'LIS-15263', 'LIS-16045');

-- --------------------------------------------------------

--
-- Table structure for table `job_traveler`
--

CREATE TABLE `job_traveler` (
  `job_no` varchar(150) NOT NULL,
  `test_no` int(11) NOT NULL,
  `t_remarks` varchar(150) NOT NULL,
  `t_status` int(50) NOT NULL,
  `t_user` varchar(50) NOT NULL,
  `t_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `job_traveler`
--

INSERT INTO `job_traveler` (`job_no`, `test_no`, `t_remarks`, `t_status`, `t_user`, `t_id`) VALUES
('LIS-15263', 1, 'Error code 404', 0, '5', 1),
('LIS-16045', 1, 'this is a test', 0, '1', 2);

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(15) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `parts`
--

CREATE TABLE `parts` (
  `p_id` int(11) NOT NULL,
  `p_desc` varchar(255) NOT NULL,
  `p_boxno` varchar(255) NOT NULL,
  `p_type` varchar(255) NOT NULL,
  `p_c_level` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `parts`
--

INSERT INTO `parts` (`p_id`, `p_desc`, `p_boxno`, `p_type`, `p_c_level`, `cat_id`) VALUES
(1, 'diode101', '1', 'cmd', 5, 1),
(2, 'this is a test part1', '2', 'cddddd', 3, 3),
(3, 'asdasddasd', '1', 'adqwd', 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `public_preferences`
--

CREATE TABLE `public_preferences` (
  `id` int(1) NOT NULL,
  `transition_page` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `public_preferences`
--

INSERT INTO `public_preferences` (`id`, `transition_page`) VALUES
(1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `r_id` int(11) NOT NULL,
  `job_no` varchar(50) NOT NULL,
  `test_no` varchar(50) NOT NULL,
  `admin_approval` int(11) NOT NULL,
  `tech_approval` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `tech_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`r_id`, `job_no`, `test_no`, `admin_approval`, `tech_approval`, `admin_id`, `tech_id`) VALUES
(1, 'LIS-15263', '1', 1, 0, 1, 5),
(2, 'LIS-16045', '1', 0, 0, 1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `request_items`
--

CREATE TABLE `request_items` (
  `r_item_id` int(11) NOT NULL,
  `r_id` int(11) NOT NULL,
  `s_id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `request_items`
--

INSERT INTO `request_items` (`r_item_id`, `r_id`, `s_id`, `p_id`, `qty`) VALUES
(27, 2, 0, 1, 2),
(34, 1, 0, 3, 4);

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE `stocks` (
  `s_id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `qtyout` int(11) NOT NULL,
  `s_date` datetime NOT NULL,
  `s_by` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stocks`
--

INSERT INTO `stocks` (`s_id`, `p_id`, `qty`, `qtyout`, `s_date`, `s_by`) VALUES
(4, 1, 2, 0, '2017-11-06 08:47:31', 'administrator'),
(10, 1, 2, 0, '2017-11-06 09:23:39', 'administrator'),
(11, 1, 67, 0, '2017-11-06 14:45:33', 'administrator'),
(12, 1, 20, 0, '2017-11-06 14:59:02', 'administrator'),
(13, 3, 5, 0, '2017-11-20 10:31:17', 'administrator');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(15) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) UNSIGNED DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) UNSIGNED NOT NULL,
  `last_login` int(11) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES
(1, '127.0.0.1', 'administrator', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', '', 'admin@admin.com', '', NULL, NULL, 'ZWF0m/yzsHPISbbkGKMINO', 1268889823, 1511170213, 1, 'Allan', 'Rabanillo', 'ADMIN', '234234324'),
(4, '::1', 'allan rabanillo', '$2y$08$nARdb5EHVJGgYwZ9VtlCpOA70wF/QQLUImZdsFBvSrfAbua5jWhWy', NULL, 'allanrabanillo@gmail.com', NULL, NULL, NULL, NULL, 1509690576, 1509701465, 1, 'Allan', 'Rabanillo', 'JSI', '09567383179'),
(5, '::1', 'reymark rabanillo', '$2y$08$B11FZmzpg2ZJVSsqXsHDGOZNywsI87swKvheOAcWVfjieIsjCpJDG', NULL, 'reymark@gmail.com', NULL, NULL, NULL, NULL, 1509979757, 1511164750, 1, 'Reymark', 'Rabanillo', 'Laftech', '09234422332'),
(6, '::1', 'john doe', '$2y$08$s1v.06S5BgZNC5aYSfLjteABghcgs2R76OT8GLt3l8pY93GZ19fVm', NULL, 'tech@tech.com', NULL, NULL, NULL, NULL, 1511159419, 1511164650, 1, 'John', 'Doe', 'ASD', '123213213213');

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE `users_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(14, 1, 1),
(11, 4, 1),
(13, 5, 3),
(16, 6, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_preferences`
--
ALTER TABLE `admin_preferences`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `in_and_out`
--
ALTER TABLE `in_and_out`
  ADD PRIMARY KEY (`job_no`);

--
-- Indexes for table `job_history`
--
ALTER TABLE `job_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_traveler`
--
ALTER TABLE `job_traveler`
  ADD PRIMARY KEY (`t_id`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parts`
--
ALTER TABLE `parts`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `public_preferences`
--
ALTER TABLE `public_preferences`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`r_id`);

--
-- Indexes for table `request_items`
--
ALTER TABLE `request_items`
  ADD PRIMARY KEY (`r_item_id`);

--
-- Indexes for table `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`s_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  ADD KEY `fk_users_groups_users1_idx` (`user_id`),
  ADD KEY `fk_users_groups_groups1_idx` (`group_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_preferences`
--
ALTER TABLE `admin_preferences`
  MODIFY `id` tinyint(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `job_history`
--
ALTER TABLE `job_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `job_traveler`
--
ALTER TABLE `job_traveler`
  MODIFY `t_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `parts`
--
ALTER TABLE `parts`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `public_preferences`
--
ALTER TABLE `public_preferences`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `r_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `request_items`
--
ALTER TABLE `request_items`
  MODIFY `r_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
