-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 15, 2020 at 10:30 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.3.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `family_dashboard`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `ID` int(1) NOT NULL,
  `type_ID` int(2) NOT NULL,
  `Description` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `category_names`
--

CREATE TABLE `category_names` (
  `ID` int(10) NOT NULL,
  `Family_ID` int(3) NOT NULL,
  `Category_ID` int(1) NOT NULL,
  `Type_ID` int(2) NOT NULL DEFAULT 1,
  `Name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `default_tasks`
--

CREATE TABLE `default_tasks` (
  `ID` int(4) NOT NULL,
  `Category_ID` int(2) NOT NULL,
  `Task` varchar(30) NOT NULL,
  `Freq_ID_Default` int(2) NOT NULL,
  `Time_Default` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `family`
--

CREATE TABLE `family` (
  `ID` int(3) NOT NULL,
  `Family` varchar(10) DEFAULT NULL,
  `Postal_Code` varchar(10) NOT NULL,
  `Account_Type` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `family-members`
--

CREATE TABLE `family-members` (
  `ID` int(10) NOT NULL,
  `Family_ID` int(3) NOT NULL,
  `Name` varchar(15) DEFAULT NULL,
  `hashed_password` varchar(255) NOT NULL,
  `Initial` varchar(2) NOT NULL,
  `Color` varchar(7) NOT NULL,
  `Admin` tinyint(1) NOT NULL,
  `Email` tinytext NOT NULL,
  `Mobile Phone` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `frequency`
--

CREATE TABLE `frequency` (
  `ID` int(2) NOT NULL,
  `Frequency` varchar(20) NOT NULL,
  `Hours_Between` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `ID` int(5) NOT NULL,
  `Family_ID` int(3) NOT NULL,
  `User_ID` int(10) NOT NULL,
  `Cat_Name_ID` int(10) NOT NULL,
  `Task` varchar(30) NOT NULL,
  `Assigned_User_ID` int(10) NOT NULL,
  `Freq_ID` int(2) NOT NULL,
  `Start` timestamp(6) NULL DEFAULT NULL,
  `Time` int(3) NOT NULL,
  `Note` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `task_log`
--

CREATE TABLE `task_log` (
  `ID` int(10) NOT NULL,
  `Family_ID` int(5) NOT NULL,
  `Tasks_ID` int(5) NOT NULL,
  `User_ID` int(10) NOT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `Time` int(2) NOT NULL,
  `Grade` int(1) NOT NULL,
  `Note` tinytext NOT NULL,
  `Redo` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE `test` (
  `ID` int(3) NOT NULL,
  `Name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

CREATE TABLE `type` (
  `ID` int(2) NOT NULL,
  `Type` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `category_names`
--
ALTER TABLE `category_names`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Family_ID_2` (`Family_ID`,`Category_ID`,`Name`),
  ADD KEY `Category_ID` (`Category_ID`),
  ADD KEY `Family_ID` (`Family_ID`);

--
-- Indexes for table `default_tasks`
--
ALTER TABLE `default_tasks`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_Category_ID` (`Category_ID`),
  ADD KEY `fk_Freq_ID` (`Freq_ID_Default`);

--
-- Indexes for table `family`
--
ALTER TABLE `family`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Family` (`Family`);

--
-- Indexes for table `family-members`
--
ALTER TABLE `family-members`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Family_ID` (`Family_ID`) USING BTREE,
  ADD KEY `Email` (`Email`(255));

--
-- Indexes for table `frequency`
--
ALTER TABLE `frequency`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_Family_ID` (`Family_ID`),
  ADD KEY `fk_Category_Name_ID` (`Cat_Name_ID`),
  ADD KEY `fk_User_ID` (`Assigned_User_ID`),
  ADD KEY `fk_Freq_ID` (`Freq_ID`);

--
-- Indexes for table `task_log`
--
ALTER TABLE `task_log`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `ID` int(1) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category_names`
--
ALTER TABLE `category_names`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `default_tasks`
--
ALTER TABLE `default_tasks`
  MODIFY `ID` int(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `family`
--
ALTER TABLE `family`
  MODIFY `ID` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `family-members`
--
ALTER TABLE `family-members`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `frequency`
--
ALTER TABLE `frequency`
  MODIFY `ID` int(2) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `ID` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `task_log`
--
ALTER TABLE `task_log`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `test`
--
ALTER TABLE `test`
  MODIFY `ID` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `type`
--
ALTER TABLE `type`
  MODIFY `ID` int(2) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `family-members`
--
ALTER TABLE `family-members`
  ADD CONSTRAINT `fk_Family_ID` FOREIGN KEY (`Family_ID`) REFERENCES `family` (`ID`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
