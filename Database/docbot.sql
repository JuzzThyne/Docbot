-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 12, 2022 at 03:54 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `docbot`
--

-- --------------------------------------------------------

--
-- Table structure for table `botsettings`
--

CREATE TABLE `botsettings` (
  `id` int(255) NOT NULL,
  `SystemName` varchar(255) NOT NULL,
  `introMessage` varchar(255) NOT NULL,
  `noresultmessage` longtext NOT NULL,
  `botavatar` varchar(255) NOT NULL,
  `useravatar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `botsettings`
--

INSERT INTO `botsettings` (`id`, `SystemName`, `introMessage`, `noresultmessage`, `botavatar`, `useravatar`) VALUES
(1, 'Docbot', 'Hello There How can I Help you ? ', 'I am sorry. I cant understand your question. Please rephrase your question and make sure it is related to this site. Thank you :)', '1620181980_bot2.jpg', 'December-2022-Calendar.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `chatbot`
--

CREATE TABLE `chatbot` (
  `id` int(255) NOT NULL,
  `queries` longtext NOT NULL,
  `replies` longtext NOT NULL,
  `Diseases` varchar(255) NOT NULL,
  `MedImage` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `chatbot`
--

INSERT INTO `chatbot` (`id`, `queries`, `replies`, `Diseases`, `MedImage`) VALUES
(29, 'Paracetamol', 'a synthetic compound used as a drug to relieve and reduce fever, usually taken in tablet form; acetaminophen', 'headache', 'asfasdfasdf.jpg'),
(30, 'aspirin', 'a synthetic compound used medicinally to relieve mild or chronic pain and to reduce fever and inflammation', 'headache', '152649096_1580025925719965_4784917860049977589_n.jpg'),
(31, 'Bioflu', 'is the one solution that provides relief for the different symptoms of flu like fever, body pain, colds, cough (from post-nasal drip), etc. Thus, it is not advised to take other solutions for these symptoms.', 'Body Pain', 'Oct25-Bioflu-Banner-768x768-FA.jpg'),
(37, 'ask for recommended medicine', '111', '1111', 'asfasdfasdf.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `inquiry`
--

CREATE TABLE `inquiry` (
  `id` int(11) NOT NULL,
  `NoAnswer` varchar(255) NOT NULL,
  `Date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inquiry`
--

INSERT INTO `inquiry` (`id`, `NoAnswer`, `Date`) VALUES
(40, '1231', '2022-12-06'),
(41, 'cancer', '2022-12-06'),
(42, 'paracetamol', '2022-12-06'),
(43, 'PARACETAMOL', '2022-12-06'),
(44, 'PARACETAMOL', '2022-12-06'),
(45, 'HEAD ACHE', '2022-12-06'),
(46, 'hello', '2022-12-06'),
(47, 'echo', '2022-12-06'),
(48, 'cancer', '2022-12-06'),
(49, 'bodypain', '2022-12-06'),
(50, 'cancer', '2022-12-07'),
(51, 'cancer', '2022-12-08');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(255) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `Username`, `Password`, `Name`) VALUES
(1, 'admin', 'admin', 'Administrator'),
(2, 'user', 'user', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `botsettings`
--
ALTER TABLE `botsettings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chatbot`
--
ALTER TABLE `chatbot`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inquiry`
--
ALTER TABLE `inquiry`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `botsettings`
--
ALTER TABLE `botsettings`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `chatbot`
--
ALTER TABLE `chatbot`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `inquiry`
--
ALTER TABLE `inquiry`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
