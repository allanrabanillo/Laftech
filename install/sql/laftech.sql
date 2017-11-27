-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 27, 2017 at 10:03 AM
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
-- Table structure for table `announcements`
--

CREATE TABLE `announcements` (
  `a_id` int(11) NOT NULL,
  `a_message` text NOT NULL,
  `a_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `a_title` varchar(50) NOT NULL,
  `a_active` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `announcements`
--

INSERT INTO `announcements` (`a_id`, `a_message`, `a_date`, `a_title`, `a_active`) VALUES
(3, 'Due to National Holiday.\r\nWednesday October 23rd.\r\nWill be a day off. Enjoy this short break.\r\n', '2017-11-27 12:52:07', 'Day Off', 0);

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
(1, 'Diode', 'Diode', '#f44336'),
(2, 'Resistor', 'Resistor', '#3f51b5'),
(3, 'Potentiometer', 'Potentiometer', '#9c27b0');

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
(2, 'JSI Logistics', 'John Doe', 'Pascor Drive, Sky freight Paranaque City', 2147483647, 'jsilogistics@gmail.com'),
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
  `t_id` int(11) NOT NULL,
  `t_error_code` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `job_traveler`
--

INSERT INTO `job_traveler` (`job_no`, `test_no`, `t_remarks`, `t_status`, `t_user`, `t_id`, `t_error_code`) VALUES
('LIS-15263', 1, 'test remarks', 0, '5', 1, 'Error code 4023'),
('LIS-16045', 1, 'this is a test', 0, '1', 2, '404'),
('LIS-15263', 2, 'Code error', 0, '1', 3, 'Error  code 500');

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
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `message` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `module` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `status`, `message`, `user_id`, `created_at`, `module`) VALUES
(2, 1, 'Received a new stock for 1N4002 (1A 100V) with 1 qty.', 1, '2017-11-24 02:34:46', 'Receiving'),
(3, 1, 'Undo Received (PartNo/Desc: 0.5Ω 2W (4 Band) Quantity: 2 DateReceived: 2017-11-24 02:55:52).', 1, '2017-11-24 02:48:48', 'Receiving'),
(4, 1, 'New Part created (PartNo/Desc: 100 OHMS-YELLOW|BoxNo: 3|Type: DIP|Package:|Critical Level:1).', 1, '2017-11-24 04:41:16', 'Parts'),
(5, 1, 'Update Part FROM (PartNo/Desc: 1N4002 (1A 100V)|BoxNo: 2|Type: SMD|Package:|Critical Level:5) TO (PartNo/Desc: 1N4002 (1A 100V)|BoxNo: 2|Type: SMD|Package:asd|Critical Level:5).', 1, '2017-11-24 04:52:45', 'Parts'),
(6, 1, 'Customer detail updated FROM (Name: JSI Logistics|Contact Person: John Doe|Address: Pascor Drive, Sky freight Paranaque|Contact No: 2147483647|Email : jsilogistics@gmail.com) TO (Name: JSI Logistics|Contact Person: John Doe|Address: Pascor Drive, Sky freight Paranaque City|Contact No: 2147483647|Email : jsilogistics@gmail.com).', 1, '2017-11-24 05:11:38', 'Customers'),
(7, 1, 'User :  has been activated.', 1, '2017-11-24 07:16:47', 'Groups'),
(8, 1, 'User : john doe has been activated.', 1, '2017-11-24 07:19:51', 'Users'),
(9, 1, 'User : john doe has been deactivated.', 1, '2017-11-24 07:20:51', 'Users'),
(10, 1, 'User : john doe has been activated.', 1, '2017-11-24 07:21:00', 'Users'),
(11, 1, 'Request item has been removed. (RQ no: 6 | Part Desc: 100 OHMS-YELLOW | Qty: 1 ).', 1, '2017-11-24 07:50:09', 'Request'),
(12, 1, 'Request item has been removed. (RQ no: 6 | Part Desc: 100 OHMS-YELLOW | Qty: 1 ).', 1, '2017-11-24 07:51:48', 'Request'),
(13, 1, 'Request item has been added. (RQ no:  | Part Desc: 1N4002 (1A 100V) | Qty: 1 ).', 5, '2017-11-24 07:59:08', 'Request'),
(14, 1, 'Request item has been added. (RQ no: 6 | Part Desc: 1N4002 (1A 100V) | Qty: 1 ).', 5, '2017-11-24 08:00:02', 'Request'),
(15, 1, 'Request has been approved by the owner. (RQ no: 6).', 5, '2017-11-24 08:00:13', 'Request'),
(16, 1, 'Request has been rejected by the owner. (RQ no: 6).', 5, '2017-11-24 08:02:28', 'Request'),
(17, 1, 'Request item has been added. (RQ no: 6 | Part Desc: 1N4002 (1A 100V) | Qty: 1 ).', 5, '2017-11-24 08:02:48', 'Request'),
(18, 1, 'Request has been approved by the owner. (RQ no: 6).', 5, '2017-11-24 08:02:51', 'Request'),
(19, 1, 'Request has been approved by the admin. (RQ no: 6).', 1, '2017-11-24 08:03:33', 'Request'),
(20, 1, 'New Stock has been added. (PartNo/Desc: 100 OHMS-YELLOW | Quantity: 5 | Supplier OHMS CORP ).', 1, '2017-11-24 08:13:23', 'Receiving'),
(21, 1, 'Job detail has been updated (Job No: ).', 1, '2017-11-24 08:30:32', 'In and Out'),
(22, 1, 'Job detail has been updated (Job No: ).', 1, '2017-11-24 08:30:47', 'In and Out'),
(23, 1, 'Request has been rejected by the admin. (RQ no: 6).', 1, '2017-11-24 08:31:26', 'Request'),
(24, 1, 'New category created (Name: Diode|Desc: sadad).', 1, '2017-11-24 08:36:53', 'Categories'),
(25, 1, 'User detail update (First Name: Allan|Last Name: Rabanillo|Email: ).', 1, '2017-11-25 03:33:19', 'Users'),
(26, 1, 'User detail update (First Name: Allan|Last Name: Rabanillo|Email: ).', 1, '2017-11-25 03:33:43', 'Users'),
(27, 1, 'New Stock has been added. (PartNo/Desc: 100 OHMS-YELLOW | Quantity: 100 | Supplier: this is a test supplier ).', 1, '2017-11-25 03:34:07', 'Receiving'),
(28, 1, 'Undo Received (PartNo/Desc: 100 OHMS-YELLOW Quantity: 100 DateReceived: 2017-11-25 04:34:07).', 1, '2017-11-25 03:35:06', 'Receiving'),
(29, 1, 'Request has been approved by the admin. (RQ: 6).', 1, '2017-11-25 03:35:30', 'Request'),
(30, 1, 'New announcement created (Title: 2nd test title|Message: this is a second test announcement.).', 1, '2017-11-27 04:00:44', 'Announcements'),
(31, 1, 'Announcement updated FROM (Title: 2nd test title|Message: this is a second test announcement.) TO (Title: 2nd test title|Message: this is a second test announcement. test).', 1, '2017-11-27 04:09:20', 'Announcements'),
(32, 1, 'Announcement deleted (Title: This is a test title |  Message: This is a test announcement.).', 1, '2017-11-27 04:24:51', 'Announcements'),
(33, 1, 'New announcement created (Title: Day Off|Message: Due to National Holiday.\r\nWednesday October 23rd.\r\nWill be a day off. Enjoy this short break.\r\n).', 1, '2017-11-27 04:52:07', 'Announcements'),
(34, 1, 'Announcement deleted (Title: 2nd test title |  Message: this is a second test announcement. test).', 1, '2017-11-27 05:14:31', 'Announcements');

-- --------------------------------------------------------

--
-- Table structure for table `parts`
--

CREATE TABLE `parts` (
  `p_id` int(11) NOT NULL,
  `p_desc` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `p_boxno` varchar(255) NOT NULL,
  `p_type` varchar(255) NOT NULL,
  `p_c_level` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `p_package` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `parts`
--

INSERT INTO `parts` (`p_id`, `p_desc`, `p_boxno`, `p_type`, `p_c_level`, `cat_id`, `p_package`) VALUES
(1, '0.5Ω 2W (4 Band)', '1', 'DIP', 5, 2, ''),
(3, '1N4002 (1A 100V)', '2', 'SMD', 5, 1, 'asd'),
(4, '100 OHMS-YELLOW', '3', 'DIP', 1, 3, '');

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
  `tech_id` int(11) NOT NULL,
  `r_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`r_id`, `job_no`, `test_no`, `admin_approval`, `tech_approval`, `admin_id`, `tech_id`, `r_date`) VALUES
(6, 'LIS-15263', '1', 1, 1, 1, 5, '2017-11-22 06:31:08');

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
(36, 1, 0, 1, 5),
(41, 6, 0, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `request_items_out`
--

CREATE TABLE `request_items_out` (
  `r_id` int(11) NOT NULL,
  `r_item_id` int(11) NOT NULL,
  `s_id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `out_date` datetime NOT NULL,
  `tech` varchar(50) NOT NULL,
  `out_by` varchar(50) NOT NULL,
  `r_item_out_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `request_items_out`
--

INSERT INTO `request_items_out` (`r_id`, `r_item_id`, `s_id`, `p_id`, `qty`, `out_date`, `tech`, `out_by`, `r_item_out_id`) VALUES
(6, 41, 6, 3, 1, '2017-11-25 04:35:30', '', '1', 2);

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
  `s_by` varchar(250) NOT NULL,
  `p_supplier` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stocks`
--

INSERT INTO `stocks` (`s_id`, `p_id`, `qty`, `qtyout`, `s_date`, `s_by`, `p_supplier`) VALUES
(6, 3, 1, 1, '2017-11-24 03:34:46', 'administrator', ''),
(7, 4, 5, 0, '2017-11-24 09:13:23', 'administrator', 'OHMS CORP');

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
(1, '127.0.0.1', 'administrator', '$2y$08$9RDXKidYvphil0EbKwH9S.AjebHYGaF9QhJ/lORrJRNIh1eaG2RFy', '', 'admin@admin.com', '', NULL, NULL, 'PiyzP.WpKODjBgwpjZ2Kz.', 1268889823, 1511768262, 1, 'Allan', 'Rabanillo', 'ADMIN', '234234324'),
(4, '::1', 'allan rabanillo', '$2y$08$nARdb5EHVJGgYwZ9VtlCpOA70wF/QQLUImZdsFBvSrfAbua5jWhWy', NULL, 'allanrabanillo@gmail.com', NULL, NULL, NULL, NULL, 1509690576, 1509701465, 1, 'Allan', 'Rabanillo', 'JSI', '09567383179'),
(5, '::1', 'reymark rabanillo', '$2y$08$B11FZmzpg2ZJVSsqXsHDGOZNywsI87swKvheOAcWVfjieIsjCpJDG', NULL, 'reymark@gmail.com', NULL, NULL, NULL, NULL, 1509979757, 1511580429, 1, 'Reymark', 'Rabanillo', 'Laftech', '09234422332'),
(6, '::1', 'john doe', '$2y$08$s1v.06S5BgZNC5aYSfLjteABghcgs2R76OT8GLt3l8pY93GZ19fVm', NULL, 'tech@tech.com', NULL, NULL, NULL, NULL, 1511159419, 1511768236, 1, 'John', 'Doe', 'ASD', '12121212121212');

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
(18, 1, 1),
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
-- Indexes for table `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`a_id`);

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
-- Indexes for table `logs`
--
ALTER TABLE `logs`
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
-- Indexes for table `request_items_out`
--
ALTER TABLE `request_items_out`
  ADD PRIMARY KEY (`r_item_out_id`);

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
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `a_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
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
  MODIFY `t_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `parts`
--
ALTER TABLE `parts`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `public_preferences`
--
ALTER TABLE `public_preferences`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `r_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `request_items`
--
ALTER TABLE `request_items`
  MODIFY `r_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT for table `request_items_out`
--
ALTER TABLE `request_items_out`
  MODIFY `r_item_out_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
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
