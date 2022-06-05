-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 29, 2022 at 09:24 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `fripomocnik`
--

-- --------------------------------------------------------

--
-- Table structure for table `dogodek`
--

CREATE TABLE `dogodek` (
  `DID` int(11) NOT NULL,
  `opis` varchar(255) NOT NULL,
  `datum` date NOT NULL,
  `UID` int(11) NOT NULL,
  `PID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dogodek`
--

INSERT INTO `dogodek` (`DID`, `opis`, `datum`, `UID`, `PID`) VALUES
(4, 'Oddaj Spletno Stran!', '2022-05-29', 4, 3);

-- --------------------------------------------------------

--
-- Table structure for table `obiskuje`
--

CREATE TABLE `obiskuje` (
  `UID` int(11) NOT NULL,
  `PID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `obiskuje`
--

INSERT INTO `obiskuje` (`UID`, `PID`) VALUES
(4, 2),
(4, 3);

-- --------------------------------------------------------

--
-- Table structure for table `ocena`
--

CREATE TABLE `ocena` (
  `OID` int(11) NOT NULL,
  `cifra` int(11) NOT NULL,
  `opis` varchar(255) DEFAULT NULL,
  `UID` int(11) NOT NULL,
  `PID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ocena`
--

INSERT INTO `ocena` (`OID`, `cifra`, `opis`, `UID`, `PID`) VALUES
(7, 10, 'Spletna stran!', 4, 3);

-- --------------------------------------------------------

--
-- Table structure for table `predmet`
--

CREATE TABLE `predmet` (
  `PID` int(11) NOT NULL,
  `naziv` varchar(255) NOT NULL,
  `opis` varchar(255) NOT NULL,
  `kratica` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `predmet`
--

INSERT INTO `predmet` (`PID`, `naziv`, `opis`, `kratica`) VALUES
(2, 'Uporabniški vmesniki', 'Še en super predmet!', 'UV'),
(3, 'Spletne Tehnologije', 'To je zelo lep predmet', 'ST');

-- --------------------------------------------------------

--
-- Table structure for table `uporabnik`
--

CREATE TABLE `uporabnik` (
  `UID` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `uporabnik`
--

INSERT INTO `uporabnik` (`UID`, `username`, `password`) VALUES
(3, 'admin', '$2y$10$f8pY7AUfYZiq5udKMVZNf.UA80rXnXGPHWJ0.hAR7RwFZPqYY0/5S'),
(4, 'user', '$2y$10$UQ7JCT911fai9CmIP.qGzed3HpWpKtai8YiaB.d92gaDADmQoCNyO');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dogodek`
--
ALTER TABLE `dogodek`
  ADD PRIMARY KEY (`DID`),
  ADD KEY `PID` (`PID`),
  ADD KEY `UID` (`UID`);

--
-- Indexes for table `obiskuje`
--
ALTER TABLE `obiskuje`
  ADD KEY `PID` (`PID`),
  ADD KEY `UID` (`UID`);

--
-- Indexes for table `ocena`
--
ALTER TABLE `ocena`
  ADD PRIMARY KEY (`OID`),
  ADD KEY `PID` (`PID`),
  ADD KEY `UID` (`UID`);

--
-- Indexes for table `predmet`
--
ALTER TABLE `predmet`
  ADD PRIMARY KEY (`PID`);

--
-- Indexes for table `uporabnik`
--
ALTER TABLE `uporabnik`
  ADD PRIMARY KEY (`UID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dogodek`
--
ALTER TABLE `dogodek`
  MODIFY `DID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ocena`
--
ALTER TABLE `ocena`
  MODIFY `OID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `predmet`
--
ALTER TABLE `predmet`
  MODIFY `PID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `uporabnik`
--
ALTER TABLE `uporabnik`
  MODIFY `UID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dogodek`
--
ALTER TABLE `dogodek`
  ADD CONSTRAINT `dogodek_ibfk_1` FOREIGN KEY (`PID`) REFERENCES `predmet` (`PID`) ON DELETE CASCADE,
  ADD CONSTRAINT `dogodek_ibfk_2` FOREIGN KEY (`UID`) REFERENCES `uporabnik` (`UID`) ON DELETE CASCADE;

--
-- Constraints for table `obiskuje`
--
ALTER TABLE `obiskuje`
  ADD CONSTRAINT `obiskuje_ibfk_1` FOREIGN KEY (`PID`) REFERENCES `predmet` (`PID`) ON DELETE CASCADE,
  ADD CONSTRAINT `obiskuje_ibfk_2` FOREIGN KEY (`UID`) REFERENCES `uporabnik` (`UID`) ON DELETE CASCADE;

--
-- Constraints for table `ocena`
--
ALTER TABLE `ocena`
  ADD CONSTRAINT `ocena_ibfk_1` FOREIGN KEY (`PID`) REFERENCES `predmet` (`PID`) ON DELETE CASCADE,
  ADD CONSTRAINT `ocena_ibfk_2` FOREIGN KEY (`UID`) REFERENCES `uporabnik` (`UID`) ON DELETE CASCADE;
COMMIT;
