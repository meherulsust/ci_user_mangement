-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 04, 2018 at 07:16 AM
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
(2, 0, '1,2', 'Menu', 'menu', 2, 'PUBLISH', 'fa-tasks', '#2056ae', '2017-04-14 02:41:08'),
(1, 0, '1,2', 'Home', 'home', 1, 'PUBLISH', 'fa-dashboard', '#0a83a1', '2017-04-14 02:41:08'),
(3, 2, '1,2', 'Add Menu', 'menu/add', 4, 'PUBLISH', 'fa-plus-square', '#1a8f0a', '2017-04-14 02:41:08'),
(4, 2, '1,2', 'Menu List', 'menu/index', 2, 'PUBLISH', 'fa-list-alt', '#e8c810', '2017-04-14 02:41:08'),
(5, 2, '1,2', 'Menu Permission', 'menu/permission', 6, 'PUBLISH', 'fa-cog', '#098599', '2017-04-14 02:41:08'),
(6, 0, '1,2', 'User Manager', 'user', 3, 'PUBLISH', 'fa-user', '#0db6b0', '2017-04-14 02:41:08'),
(10, 6, '1,2', 'User List', 'user/index', 1, 'PUBLISH', 'fa-users', '#10a8b8', '2017-04-14 02:41:08'),
(7, 6, '1,2', 'New User', 'user/add', 2, 'PUBLISH', 'fa-plus-square', '#11aca7', '2017-04-14 02:41:08'),
(8, 6, '1,2', 'Add Admin Group', 'user/addadmingroup', 4, 'PUBLISH', 'fa-plus-square-o', '#1f76be', '2017-04-14 02:41:08'),
(9, 6, '1,2', 'Admin Group List', 'user/admingroup', 3, 'PUBLISH', 'fa-group', '#1d48ca', '2017-04-14 02:41:08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=207;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
