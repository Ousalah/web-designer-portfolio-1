-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 24, 2018 at 12:26 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `surveys`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `password`) VALUES
(1, 'm1ousalah@gmail.com', '12345');

-- --------------------------------------------------------

--
-- Table structure for table `delegue`
--

CREATE TABLE `delegue` (
  `id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `delegue`
--

INSERT INTO `delegue` (`id`, `firstname`, `lastname`, `email`, `password`, `image`) VALUES
(1, 'Mohamed', 'Ousalah', 'moha_med555@hotmail.fr', '1122', 'default_image.png'),
(2, 'Karim', 'Jamali', 'karim@gmail.com', '11243', 'default_image.png'),
(3, 'Hamza', 'Saber', 'hamza@gmail.com', '1212', 'default_image.png'),
(4, 'Ayoub', 'Abmlk', 'ayoub@gmail.com', '1223', 'default_image.png'),
(5, 'Soufiane', 'Ail', 'soufiane@gmail.com', '11234', 'default_image.png'),
(6, 'TY', 'FGFG', 'ousalah@hotmail.com', 'FGFHGH', 'bce7fb1c098ebba5749ba565eb2d0136.jpg'),
(7, 'fgfh', 'gfhgh', 'ousalahdffdg@hotmail.com', 'dCMz@Ydfgagfdgfdg&hcZCboYLTm', 'a114d25d7491986cf3480bdc42679c03.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `excel`
--

CREATE TABLE `excel` (
  `id` int(11) NOT NULL,
  `delegue_id` int(11) NOT NULL,
  `xml_id` int(11) NOT NULL,
  `link` varchar(255) NOT NULL,
  `etat` varchar(50) NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `excel`
--

INSERT INTO `excel` (`id`, `delegue_id`, `xml_id`, `link`, `etat`) VALUES
(1, 1, 56, 'test-hieght-Mohamed-Ousalah-2017-09-30-16-18-53--saved-2017-09-30-16-23-45.csv', 'active'),
(2, 1, 62, 'final-test-of-clicked-label-Mohamed-Ousalah-2017-10-01-20-32-03--saved-2017-10-01-20-35-37.csv', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `survey`
--

CREATE TABLE `survey` (
  `City` varchar(20) NOT NULL,
  `checkboxes_1` varchar(255) NOT NULL,
  `Hobbies` varchar(255) NOT NULL,
  `radios_3` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `xml`
--

CREATE TABLE `xml` (
  `id` int(11) NOT NULL,
  `delegue_id` int(11) NOT NULL,
  `link` varchar(255) NOT NULL,
  `etat` varchar(50) NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `xml`
--

INSERT INTO `xml` (`id`, `delegue_id`, `link`, `etat`) VALUES
(42, 1, 'Pesonal-Info-Mohamed-Ousalah-2017-09-26-07-59-23.xml', 'active'),
(43, 1, 'Porsuivre Etude-Mohamed-Ousalah-2017-09-26-16-05-12.xml', 'active'),
(51, 1, 'owed-pc-Mohamed-Ousalah-2017-09-27-23-35-18.xml', 'active'),
(52, 4, 'hghj-Ayoub-Abmlk-2017-09-28-01-59-52.xml', 'active'),
(53, 3, 'dghj-Hamza-Saber-2017-09-28-02-00-49.xml', 'active'),
(54, 1, 'favorit-sport-Mohamed-Ousalah-2017-09-28-03-52-26.xml', 'active'),
(55, 1, 'test-after-changes-Mohamed-Ousalah-2017-09-29-03-59-11.xml', 'active'),
(56, 1, 'test-hieght-Mohamed-Ousalah-2017-09-30-16-18-53.xml', 'active'),
(57, 4, 'dfdf-Ayoub-Abmlk-2017-10-01-19-44-19.xml', 'active'),
(58, 6, 'dffdg-TY-FGFG-2017-10-01-19-48-09.xml', 'active'),
(59, 5, 'TT-Soufiane-Ail-2017-10-01-20-08-25.xml', 'active'),
(60, 1, 'test-chnage-Mohamed-Ousalah-2017-10-01-20-11-52.xml', 'active'),
(61, 1, 'trt666-Mohamed-Ousalah-2017-10-01-20-17-11.xml', 'active'),
(62, 1, 'final-test-of-clicked-label-Mohamed-Ousalah-2017-10-01-20-32-03.xml', 'active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delegue`
--
ALTER TABLE `delegue`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `excel`
--
ALTER TABLE `excel`
  ADD PRIMARY KEY (`id`),
  ADD KEY `delegue_id` (`delegue_id`),
  ADD KEY `xml_id` (`xml_id`);

--
-- Indexes for table `xml`
--
ALTER TABLE `xml`
  ADD PRIMARY KEY (`id`),
  ADD KEY `delegue_id` (`delegue_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `delegue`
--
ALTER TABLE `delegue`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `excel`
--
ALTER TABLE `excel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `xml`
--
ALTER TABLE `xml`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `excel`
--
ALTER TABLE `excel`
  ADD CONSTRAINT `excel_ibfk_1` FOREIGN KEY (`delegue_id`) REFERENCES `delegue` (`id`),
  ADD CONSTRAINT `excel_ibfk_2` FOREIGN KEY (`xml_id`) REFERENCES `xml` (`id`);

--
-- Constraints for table `xml`
--
ALTER TABLE `xml`
  ADD CONSTRAINT `xml_ibfk_1` FOREIGN KEY (`delegue_id`) REFERENCES `delegue` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
