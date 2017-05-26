-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 26, 2017 at 10:54 AM
-- Server version: 5.6.35-1+deb.sury.org~xenial+0.1
-- PHP Version: 7.0.15-0ubuntu0.16.04.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `status`
--

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

CREATE TABLE `config` (
  `id` int(11) NOT NULL,
  `enablesmart` int(11) NOT NULL,
  `smtp` text NOT NULL,
  `smtp_port` text NOT NULL,
  `smtp_username` text NOT NULL,
  `smtp_password` text NOT NULL,
  `admin_email` text NOT NULL,
  `refresh` int(11) NOT NULL,
  `dir_username` text NOT NULL,
  `dir_password` text NOT NULL,
  `alert_limit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `servers`
--

CREATE TABLE `servers` (
  `id` int(11) NOT NULL,
  `device` text NOT NULL,
  `ip` text NOT NULL,
  `info` text NOT NULL,
  `purpose` text NOT NULL,
  `count` int(11) NOT NULL,
  `ups` int(11) NOT NULL,
  `downs` int(11) NOT NULL,
  `lastup` datetime NOT NULL,
  `lastdown` datetime NOT NULL,
  `lastreset` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `port` int(11) NOT NULL,
  `parent` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `smartcontrols`
--

CREATE TABLE `smartcontrols` (
  `id` int(11) DEFAULT NULL,
  `poweron` text NOT NULL,
  `poweroff` text NOT NULL,
  `parent` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `smartdevices`
--

CREATE TABLE `smartdevices` (
  `id` int(11) NOT NULL,
  `device` text NOT NULL,
  `ip` text NOT NULL,
  `port` text NOT NULL,
  `info` text NOT NULL,
  `purpose` text NOT NULL,
  `count` int(11) NOT NULL,
  `ups` int(11) NOT NULL,
  `downs` int(11) NOT NULL,
  `lastup` datetime NOT NULL,
  `lastdown` datetime NOT NULL,
  `lastreset` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `servers`
--
ALTER TABLE `servers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `smartdevices`
--
ALTER TABLE `smartdevices`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `config`
--
ALTER TABLE `config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `servers`
--
ALTER TABLE `servers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `smartdevices`
--
ALTER TABLE `smartdevices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
