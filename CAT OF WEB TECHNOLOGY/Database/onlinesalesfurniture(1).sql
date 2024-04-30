-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 30, 2024 at 02:06 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `onlinesalesfurniture`
--

-- --------------------------------------------------------

--
-- Table structure for table `command`
--

CREATE TABLE `command` (
  `Command_id` int(10) NOT NULL,
  `Command_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `Status` varchar(30) DEFAULT NULL,
  `Furniture_id` int(11) DEFAULT NULL,
  `Customer_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `command`
--

INSERT INTO `command` (`Command_id`, `Command_date`, `Status`, `Furniture_id`, `Customer_id`) VALUES
(33, '2024-04-05 22:00:00', 'Delivered', 2, 8),
(34, '2024-04-10 22:00:00', 'pending', 9, 2),
(46, '2024-04-11 22:00:00', 'pending', 3, 4),
(47, '2024-04-25 22:00:00', 'Delivered', 6, 5);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `Customer_id` int(10) NOT NULL,
  `Name` varchar(30) DEFAULT NULL,
  `Email` varchar(35) DEFAULT NULL,
  `Phonenumber` varchar(15) DEFAULT NULL,
  `Address` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`Customer_id`, `Name`, `Email`, `Phonenumber`, `Address`) VALUES
(2, 'Akaliza Louise', 'akaliza@gmail.com', '0784578905', 'Nyabihu'),
(3, 'Umwali Kelia', 'uwera@gmail.com', '0726382844', 'Rusizi'),
(4, 'INEZA lena', 'ineza@gmail.com', '0788650943', 'Bugesera'),
(5, 'Akaliza Lea', 'leaakaliza@gmail.com', '0786547021', 'Kayonza'),
(8, 'Uwase Belinda', 'belinda@gmail.com', '0783670124', 'Kenya'),
(12, 'Kamanzi jmv', 'kamanzi@gmail.com', '0783406344', 'Rwamagana');

-- --------------------------------------------------------

--
-- Table structure for table `furniture`
--

CREATE TABLE `furniture` (
  `Furniture_id` int(10) NOT NULL,
  `Type` varchar(30) DEFAULT NULL,
  `Category` varchar(15) DEFAULT NULL,
  `Name` varchar(15) DEFAULT NULL,
  `Size` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `furniture`
--

INSERT INTO `furniture` (`Furniture_id`, `Type`, `Category`, `Name`, `Size`) VALUES
(1, 'timber', 'medium', 'chair', 'medium'),
(2, 'Office ', 'chairs', 'Sofa', 'Medium'),
(3, 'Wooden furniture', 'Diningroom', 'Table', 'Large'),
(4, 'sleeping furniture', 'beds', 'pillow', 'large'),
(6, 'home furniture', 'tables', 'work  table', 'medium'),
(9, 'officefurniture', 'tables', 'conferenechair', 'medium'),
(11, 'sleepingfurniture', 'beds', 'sofa', 'large'),
(15, 'woodenfurniture', 'kitchen', 'table', 'medium'),
(16, 'officefurniture', 'worktable', 'table', 'medium'),
(19, 'Wood', 'dinningchairs', 'sofa', 'large'),
(21, 'woodenfurniture', 'chairs', 'sofa', 'medium');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `Payment_id` int(10) NOT NULL,
  `Total_amount` varchar(35) DEFAULT NULL,
  `Payment_method` varchar(30) DEFAULT NULL,
  `Date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Furniture_id` int(11) DEFAULT NULL,
  `Customer_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`Payment_id`, `Total_amount`, `Payment_method`, `Date`, `Furniture_id`, `Customer_id`) VALUES
(1, '800000', 'cheque', '0000-00-00 00:00:00', 9, 3),
(8, '90000', 'cheque', '0000-00-00 00:00:00', 9, 5),
(14, '8000000', 'apple pay', '2024-04-03 22:00:00', 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `stock_id` int(10) NOT NULL,
  `Address` varchar(15) DEFAULT NULL,
  `Furniture_id` int(11) DEFAULT NULL,
  `Quantity` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`stock_id`, `Address`, `Furniture_id`, `Quantity`) VALUES
(2, 'Huye', 2, 60),
(3, 'Nairobi', 1, 700),
(4, 'Kenya', 6, 900),
(6, 'Kenya', 6, 900),
(7, 'Muhanaga', 6, 40);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `User_id` int(15) NOT NULL,
  `FirstName` varchar(20) NOT NULL,
  `LastName` varchar(25) NOT NULL,
  `UserName` varchar(30) NOT NULL,
  `Gender` varchar(15) NOT NULL,
  `Email` text NOT NULL,
  `Telephone` int(20) NOT NULL,
  `Password` text NOT NULL,
  `Status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`User_id`, `FirstName`, `LastName`, `UserName`, `Gender`, `Email`, `Telephone`, `Password`, `Status`) VALUES
(1, 'Aline', 'Umuhoza', 'Aline umuhoza', 'female', 'umuhoza@gmail.com', 789602346, '$2y$10$54ZJlEIUD05Ib9fHjj23nOIT4bAMjZDB23QSuOPhUb3T82yaKOgLC', 'single'),
(2, 'Brice', 'Uwineza', 'uwineza', 'male', 'brice123@gmail.com', 783424213, '$2y$10$ANQBMYyV1RyyJjBIljEtfeCRffZNaTm.A8FO40GDD7UzDX40KMwMq', ''),
(3, 'sdfgh', 'sdfgh', 'sxcv', 'male', 'sdfghj@gmail.com', 2345, '$2y$10$3GszjnrdoyVPndT171VuHehsC4qVw/Puc5JELVqPS3GMCgH7FSzty', '');

-- --------------------------------------------------------

--
-- Table structure for table `user_account`
--

CREATE TABLE `user_account` (
  `User_id` int(10) NOT NULL,
  `User_name` varchar(30) DEFAULT NULL,
  `Password` varchar(15) DEFAULT NULL,
  `Email` varchar(35) DEFAULT NULL,
  `Phonenumber` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_account`
--

INSERT INTO `user_account` (`User_id`, `User_name`, `Password`, `Email`, `Phonenumber`) VALUES
(5, 'Iradukunda Helene', '12345', 'helene@gmail.com', '0785612078'),
(6, 'Munyaneza innocent', '22222', 'munyaneza@gmail.com', '0780965313'),
(7, 'IRADUKUNDA aline', '', 'alineiradukunda@gmail.com', '0781267064'),
(12, NULL, '09876', 'agaba123@gmail.com', '0789065320'),
(13, 'Agaba Moses', '09876', 'agaba123@gmail.com', '0789065320');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `command`
--
ALTER TABLE `command`
  ADD PRIMARY KEY (`Command_id`),
  ADD KEY `Furniture_id` (`Furniture_id`),
  ADD KEY `Customer_id` (`Customer_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`Customer_id`);

--
-- Indexes for table `furniture`
--
ALTER TABLE `furniture`
  ADD PRIMARY KEY (`Furniture_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`Payment_id`),
  ADD KEY `Furniture_id` (`Furniture_id`),
  ADD KEY `Customer_id` (`Customer_id`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`stock_id`),
  ADD KEY `Furniture_id` (`Furniture_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`User_id`);

--
-- Indexes for table `user_account`
--
ALTER TABLE `user_account`
  ADD PRIMARY KEY (`User_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `command`
--
ALTER TABLE `command`
  MODIFY `Command_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `Customer_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `furniture`
--
ALTER TABLE `furniture`
  MODIFY `Furniture_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `Payment_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `stock_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `User_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_account`
--
ALTER TABLE `user_account`
  MODIFY `User_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `command`
--
ALTER TABLE `command`
  ADD CONSTRAINT `command_ibfk_1` FOREIGN KEY (`Furniture_id`) REFERENCES `furniture` (`Furniture_id`),
  ADD CONSTRAINT `command_ibfk_2` FOREIGN KEY (`Customer_id`) REFERENCES `customer` (`Customer_id`);

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`Furniture_id`) REFERENCES `furniture` (`Furniture_id`),
  ADD CONSTRAINT `payment_ibfk_2` FOREIGN KEY (`Customer_id`) REFERENCES `customer` (`Customer_id`);

--
-- Constraints for table `stock`
--
ALTER TABLE `stock`
  ADD CONSTRAINT `stock_ibfk_1` FOREIGN KEY (`Furniture_id`) REFERENCES `furniture` (`Furniture_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
