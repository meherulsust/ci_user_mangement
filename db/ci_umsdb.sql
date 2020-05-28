-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 04, 2018 at 07:25 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ci_umsdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `id_admin_group` int(2) UNSIGNED NOT NULL,
  `username` varchar(20) NOT NULL,
  `passwd` varchar(70) NOT NULL,
  `tr_pass` varchar(200) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `image` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(80) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `create_date` datetime NOT NULL,
  `last_login_time` datetime NOT NULL,
  `status` enum('ACTIVE','INACTIVE','PENDING') NOT NULL,
  `random_number` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `id_admin_group`, `username`, `passwd`, `tr_pass`, `firstname`, `lastname`, `image`, `address`, `city`, `mobile`, `email`, `create_date`, `last_login_time`, `status`, `random_number`) VALUES
(1, 1, 'meher', '87b750fdfeb4468f58c3247b303704ab', '', 'Md.', 'Meherul Islam', '987585_492129.jpg', 'Dhaka', '', '01754954954', 'meherulbds@gmail.com', '0000-00-00 00:00:00', '2018-10-04 11:17:49', 'ACTIVE', '');

-- --------------------------------------------------------

--
-- Table structure for table `admin_group`
--

CREATE TABLE `admin_group` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(50) NOT NULL,
  `comment` varchar(200) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `admin_group`
--

INSERT INTO `admin_group` (`id`, `title`, `comment`, `status`) VALUES
(1, 'super admin', 'access over every options', 'Active'),
(2, 'admin', 'backend admin', 'Active'),
(3, 'User', 'This is general user.', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `blood_group`
--

CREATE TABLE `blood_group` (
  `id` tinyint(2) NOT NULL,
  `title` varchar(20) NOT NULL,
  `symbol` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `blood_group`
--

INSERT INTO `blood_group` (`id`, `title`, `symbol`) VALUES
(1, 'A Positive (A+)', 'A+'),
(2, 'A Negative (A-)', 'A-'),
(3, 'B Positive (B+)', 'B+'),
(4, 'B Negative (B-)', 'B-'),
(5, 'AB Positive (AB+)', 'AB+'),
(6, 'AB Negative (AB-)', 'AB-'),
(7, 'O Positive (O+)', 'O+'),
(8, 'O Negative (O-)', 'O-');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(10) UNSIGNED NOT NULL,
  `parent_id` int(11) NOT NULL,
  `admin_group_id` varchar(40) NOT NULL DEFAULT '0',
  `title` varchar(100) NOT NULL,
  `module_link` varchar(100) NOT NULL,
  `order` tinyint(4) NOT NULL,
  `status` enum('PUBLISH','UNPUBLISH') NOT NULL,
  `icon` varchar(50) NOT NULL,
  `icon_color` varchar(20) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `parent_id`, `admin_group_id`, `title`, `module_link`, `order`, `status`, `icon`, `icon_color`, `create_date`) VALUES
(2, 0, '1,2', 'Menu', 'menu', 2, 'PUBLISH', 'fa-tasks', '#2056ae', '2017-04-13 20:41:08'),
(1, 0, '1,2', 'Home', 'home', 1, 'PUBLISH', 'fa-dashboard', '#0a83a1', '2017-04-13 20:41:08'),
(3, 2, '1,2', 'Add Menu', 'menu/add', 4, 'PUBLISH', 'fa-plus-square', '#1a8f0a', '2017-04-13 20:41:08'),
(4, 2, '1,2', 'Menu List', 'menu/index', 2, 'PUBLISH', 'fa-list-alt', '#e8c810', '2017-04-13 20:41:08'),
(5, 2, '1,2', 'Menu Permission', 'menu/permission', 6, 'PUBLISH', 'fa-cog', '#098599', '2017-04-13 20:41:08'),
(6, 0, '1,2', 'User Manager', 'user', 3, 'PUBLISH', 'fa-user', '#0db6b0', '2017-04-13 20:41:08'),
(10, 6, '1,2', 'User List', 'user/index', 1, 'PUBLISH', 'fa-users', '#10a8b8', '2017-04-13 20:41:08'),
(7, 6, '1,2', 'New User', 'user/add', 2, 'PUBLISH', 'fa-plus-square', '#11aca7', '2017-04-13 20:41:08'),
(8, 6, '1,2', 'Add Admin Group', 'user/addadmingroup', 4, 'PUBLISH', 'fa-plus-square-o', '#1f76be', '2017-04-13 20:41:08'),
(9, 6, '1,2', 'Admin Group List', 'user/admingroup', 3, 'PUBLISH', 'fa-group', '#1d48ca', '2017-04-13 20:41:08');

-- --------------------------------------------------------

--
-- Table structure for table `religion`
--

CREATE TABLE `religion` (
  `id` tinyint(20) UNSIGNED NOT NULL,
  `title` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `religion`
--

INSERT INTO `religion` (`id`, `title`) VALUES
(1, 'Islam'),
(2, 'Hindu'),
(3, 'Chrisrtiain'),
(4, 'Buddha'),
(5, 'Others');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_group`
--
ALTER TABLE `admin_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blood_group`
--
ALTER TABLE `blood_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `religion`
--
ALTER TABLE `religion`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `admin_group`
--
ALTER TABLE `admin_group`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `blood_group`
--
ALTER TABLE `blood_group`
  MODIFY `id` tinyint(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `religion`
--
ALTER TABLE `religion`
  MODIFY `id` tinyint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
