-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 19, 2023 at 09:43 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `library`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `ID` int(11) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`ID`, `Email`, `password`) VALUES
(14, 'bokybob81@gmail.com', '$2y$10$ACX1uagxAfBzEd17HZUgFear.eezidXgWPEOnTmTfsAqKXWPvOPmW'),
(15, 'omar@gmail.com', '$2y$10$CQRFg8Yztd8TQ..k7z8x5.a4ToYAcPKexzE9sZlHjcbwzBuwzmkxW'),
(16, 'body@gmail.com', '$2y$10$S6dvAwNYhbVQ70v8HKkH8.Z8Dh8qjKBtDqiGMBUpcJauvYxFXTdNO'),
(17, 'bolbol@gmail.com', '$2y$10$pM4rsUOYSud2M0Pk/p15.ue514HILuFs1XYwgxyhdaYq5oAhykR.6'),
(18, 'khattab@gmail.com', '$2y$10$Daqq5.AXiCs.065454jRP.cVhTtwjFNVXRVgcJcEq38MrBnvc5c9K'),
(19, 'test@gmail.com', '$2y$10$uYB7BvxwaW1hxuOo5Z195uwrnfxeSdhGIQVJ3CYhQo/L0n4YH2P7a'),
(20, 'test2@gmail.com', '$2y$10$bYsMPxhEE6J2mPCt2OS9reiD1wRbsBRbYBl9VA6cCfhDC6Th4yhiW'),
(21, 'test3@gmail.com', '$2y$10$OVK32SjVSUogYBUw6TJJquQDiZd1tlNp8dIzcpl0dT4dd9/INQlkO'),
(22, 'test4@gmail.com', '$2y$10$sYoMC8KRGi16DY5mtwOSTOzFcgq889sLmTbqIoMcvJHWSxra2JTui'),
(23, 'test5@gmail.com', '$2y$10$aKwLQaneHR/At1TO/aYPiugvPJKRZJIx.V6yvtsHFkuVEhi0ZdaYq'),
(24, 'test6@gmail.com', '$2y$10$LgJc.U4FiYKi9K2u2ThPi.cDcXul88e6eYtjsk/eycDKShl4hjTFu'),
(25, 'test7@gmail.com', '$2y$10$MAnhNPy57wppoL6gbwJivOQTarHouJxVRV9G2eu1MouIKAkBkfbtm'),
(26, 'test8@gmail.com', '$2y$10$nwwL9oZak6KQggJFMQ/1/uaWG8JirzOrIk4Io8LMVIwTW/ekamk5m'),
(27, 'test9@gmail.com', '$2y$10$NqPo0WFmMKU74FOR5fxODu9utf9F38QcKrKuEyd44NQCoiIvcz/gW'),
(28, 'test10@gmail.com', '$2y$10$VBBbLa9EizQwRoLCDN8vteY410FpvhhiXX.D5KfZKDn0PAeDIyX2m');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `Name` varchar(255) NOT NULL,
  `ID` int(30) NOT NULL,
  `Author` varchar(255) NOT NULL,
  `Price` float NOT NULL,
  `quantity` int(11) NOT NULL,
  `IDdepartement` int(11) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`Name`, `ID`, `Author`, `Price`, `quantity`, `IDdepartement`, `image_path`) VALUES
('The Rise and Fall of the Third Reich', 9, 'William L. Shirer', 15, 114, 2, 'images/books/The Rise and Fall of the Third Reich - William L. Shirer.jpg'),
('The Wright Brothers', 10, 'David McCullough', 5, 100, 2, 'images/books/The Wright Brothers - David McCullough.jpg'),
('In the Woods', 11, 'Tana French', 3, 100, 3, 'images/books/In the Woods - Tana French.jpg'),
('Astrophysics for Young People in a Hurry', 14, 'Neil deGrasse Tyson', 2, 100, 4, 'images/books/Astrophysics for Young People in a Hurry - Neil deGrasse Tyson.jpg'),
('The Code Book The Science of Secrecy from Ancient Egypt to Quantum Cryptography', 15, 'Simon Singh', 3, 100, 4, 'images/books/The Code Book The Science of Secrecy from Ancient Egypt to Quantum Cryptography - Simon Singh.jpg'),
('The Emperor of All Maladies A Biography of Cancer', 16, 'Siddhartha Mukherjee', 4, 100, 4, 'images/books/The Emperor of All Maladies A Biography of Cancer - Siddhartha Mukherjee.jpg'),
('The Name of the Wind', 21, 'Patrick Rothfuss', 2, 98, 1, 'images/books/The Name of the Wind.jpg'),
('A People\'s History of the United States', 22, 'Howard Zinn', 3, 100, 2, 'images/books/A People s History of the United States - Howard Zinn.jpg'),
('The Silent Patient', 23, 'Alex Michaelides', 3, 100, 3, 'images/books/The Silent Patient -  Alex Michaelides.jpg'),
('1491', 25, 'Charles C . Mann', 4, 100, 2, 'images/books/1491 - Charles C . Mann.jpg'),
('1984', 26, 'George Orwell', 3, 100, 1, 'images/books/1984 -  George Orwell.jpg'),
('Cosmos', 36, 'Carl Sagan', 3, 100, 4, 'images/books/Cosmos - Carl Sagan.jpg'),
('The Kite Runner', 37, ' Khaled Hosseini', 3, 113, 1, 'images/books/The Kite Runner - Khaled Hosseini.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `borrowing`
--

CREATE TABLE `borrowing` (
  `date` date NOT NULL,
  `Delivery_date` date NOT NULL,
  `IDB` int(11) DEFAULT NULL,
  `IDDEP` int(11) DEFAULT NULL,
  `borrower_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `borrowing`
--

INSERT INTO `borrowing` (`date`, `Delivery_date`, `IDB`, `IDDEP`, `borrower_ID`) VALUES
('2023-12-17', '2024-01-01', 37, 1, 16),
('2023-12-19', '2024-01-03', 21, 1, 28),
('2023-12-19', '2024-01-03', 21, 1, 22);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `name` varchar(255) NOT NULL,
  `Phone` varchar(55) NOT NULL,
  `location` varchar(255) NOT NULL,
  `IDC` int(11) DEFAULT NULL,
  `membership` tinyint(1) DEFAULT 0,
  `membership_expire_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`name`, `Phone`, `location`, `IDC`, `membership`, `membership_expire_date`) VALUES
('boky', '01064468422', 'Alex', 14, 1, '2024-12-11'),
('body', '0101645284', 'Alex', 16, 1, '2024-12-11'),
('bolbol', '01054478444', 'Alex - Toson', 17, 1, '2024-12-19'),
('khattab', '01214558744', 'Rashiid', 18, 1, '2024-12-19'),
('test', '64564', 'asdfa', 19, 1, '2024-12-19'),
('test2', '565', 'aleas', 20, 1, '2024-12-19'),
('test3', '54564', 'Alex - Toson', 21, 1, '2024-12-19'),
('test4', '4664', 'aleas', 22, 1, '2024-12-19'),
('test5', '56646', 'asa', 23, 0, NULL),
('test6', '49649', 'Alex - Toson', 24, 0, NULL),
('test7', '4564', 'ale', 25, 0, NULL),
('test8', '441541', 'asdfa', 26, 0, NULL),
('test9', '52445', 'Alex - Toson', 27, 1, '2024-12-19'),
('test10', '5646', 'aasd', 28, 1, '2024-12-19');

-- --------------------------------------------------------

--
-- Table structure for table `departement`
--

CREATE TABLE `departement` (
  `Name` varchar(50) NOT NULL,
  `ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `departement`
--

INSERT INTO `departement` (`Name`, `ID`) VALUES
('Fiction', 1),
('History', 2),
('Mystery', 3),
('Science', 4);

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `Room_number` int(11) NOT NULL,
  `Opening_time` time NOT NULL,
  `Closing_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`Room_number`, `Opening_time`, `Closing_time`) VALUES
(1, '09:30:00', '11:00:00'),
(2, '09:00:00', '11:30:00'),
(3, '10:00:00', '11:00:00'),
(4, '10:30:00', '11:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `name` varchar(255) NOT NULL,
  `Position` varchar(255) NOT NULL,
  `phone` varchar(55) NOT NULL,
  `location` varchar(255) NOT NULL,
  `IDSt` int(11) DEFAULT NULL,
  `IDDep` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`name`, `Position`, `phone`, `location`, `IDSt`, `IDDep`) VALUES
('Omar Mohamed', 'Cleaning', '01064852577', 'Cairo', 15, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_dep_dep` (`IDdepartement`);

--
-- Indexes for table `borrowing`
--
ALTER TABLE `borrowing`
  ADD KEY `fk_book_id` (`IDB`),
  ADD KEY `fk_dep_id` (`IDDEP`),
  ADD KEY `fk_borrower_id` (`borrower_ID`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD KEY `fk_Accounts_customers` (`IDC`);

--
-- Indexes for table `departement`
--
ALTER TABLE `departement`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`Room_number`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD KEY `fk_Accounts_Stuff` (`IDSt`),
  ADD KEY `fk_dep_dp` (`IDDep`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `ID` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `departement`
--
ALTER TABLE `departement`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `fk_dep_dep` FOREIGN KEY (`IDdepartement`) REFERENCES `departement` (`ID`);

--
-- Constraints for table `borrowing`
--
ALTER TABLE `borrowing`
  ADD CONSTRAINT `fk_book_id` FOREIGN KEY (`IDB`) REFERENCES `books` (`ID`),
  ADD CONSTRAINT `fk_borrower_id` FOREIGN KEY (`borrower_ID`) REFERENCES `customers` (`IDC`),
  ADD CONSTRAINT `fk_dep_id` FOREIGN KEY (`IDDEP`) REFERENCES `departement` (`ID`);

--
-- Constraints for table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `fk_Accounts_customers` FOREIGN KEY (`IDC`) REFERENCES `accounts` (`ID`);

--
-- Constraints for table `staff`
--
ALTER TABLE `staff`
  ADD CONSTRAINT `fk_Accounts_Stuff` FOREIGN KEY (`IDSt`) REFERENCES `accounts` (`ID`),
  ADD CONSTRAINT `fk_dep_dp` FOREIGN KEY (`IDDep`) REFERENCES `departement` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
