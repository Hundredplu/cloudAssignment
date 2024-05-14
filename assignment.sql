-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 17, 2023 at 02:59 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `assignment`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminID` int(100) NOT NULL,
  `adminName` varchar(100) NOT NULL,
  `adminEmail` varchar(100) NOT NULL,
  `adminPassword` varchar(100) NOT NULL,
  `adminImage` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminID`, `adminName`, `adminEmail`, `adminPassword`, `adminImage`) VALUES
(1, 'admin123', 'admin123@gmail.com', 'admin123', ''),
(2, 'Yi Kai', 'yikai@gmail.com', 'yikai123', ''),
(4, 'cqqqq', 'cq123@gmail.com', 'b322e86e0e2f940bcb36a4b0226c86a5', '9d7522239caafaedaa3878d5290108d2.jpg'),
(5, 'batman', 'boonhong@gmail.com', 'ffae129a5f947178008649c4a58298fd', 'default-avatar.png');

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `BookingID` int(100) NOT NULL,
  `CustomerName` varchar(25) NOT NULL,
  `MovieName` varchar(50) NOT NULL,
  `Venue` varchar(10) NOT NULL,
  `ShowingDate` varchar(10) NOT NULL,
  `ShowingTime` varchar(20) NOT NULL,
  `MovieSeat` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`BookingID`, `CustomerName`, `MovieName`, `Venue`, `ShowingDate`, `ShowingTime`, `MovieSeat`) VALUES
(1, 'Apu Takboleh Bakar', 'Avengers : End Game', 'DKA', '2023-05-08', '1pm-4pm', 1),
(5, 'Tongkat Ali', 'Antman', 'H', '2023-05-23', '5pm-8pm', 6),
(6, 'Lim Kah Hao', 'Suzume No Tojimari', 'DKH', '2023-05-15', '9pm-12am', 1),
(11, 'Ching Chong', 'Black Panther', 'DKB', '2023-05-23', '9am-12pm', 3),
(23, 'Yi Long Ma', 'Your Name', 'DKH', '2023-05-23', '9pm-12am', 1);

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feedbackID` int(100) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(30) NOT NULL,
  `feedbackContent` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`feedbackID`, `name`, `email`, `feedbackContent`) VALUES
(1, 'boonhong', 'boonhong@gmail.com', 'Good service, ket ket '),
(16, 'chiaquan', 'cq123@gmail.com', 'i love u 3000\r\n'),
(17, 'derek', 'derekloh@gmail.com', 'no shit '),
(18, 'Abu Takboleh Bakar', 'TanAh@gmail.com', 'blablablablablablablablabalbalblaa');

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `mvid` int(30) NOT NULL,
  `title` text NOT NULL,
  `cover_img` text NOT NULL,
  `description` text NOT NULL,
  `duration` varchar(10) NOT NULL,
  `date_showing` date NOT NULL,
  `end_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`mvid`, `title`, `cover_img`, `description`, `duration`, `date_showing`, `end_date`) VALUES
(1, 'Your Name', 'yourname.jpg', '\"Two teenagers share a profound, magical connection upon discovering they are swapping bodies. Things manage to become even more complicated when the boy and girl decide to meet in person.\"', '3.00hrs', '2023-05-13', '2023-05-24'),
(5, 'Avengers : End Game', 'endgame.jpg', '\"After Thanos, an intergalactic warlord, disintegrates half of the universe, the Avengers must reunite and assemble again to reinvigorate their trounced allies and restore balance.\"', '3.00hrs', '2023-05-09', '2023-05-23'),
(6, 'Antman', 'antman.webp', '\"Ant-Man and the Wasp find themselves exploring the Quantum Realm, interacting with strange new creatures and embarking on an adventure that pushes them beyond the limits of what they thought was possible.\" into a battle for their superpowers, their lives, and the fate of the world.', '2.25hrs', '2023-05-09', '2023-05-23'),
(40, 'Suzume No Tojimari', 'suzume.jpg', '\"As the skies turn red and the planet trembles, Japan stands on the brink of disaster. However, a determined teenager named Suzume sets out on a mission to save her country. Able to see supernatural forces that others cannot, it\'s up to her to close the mysterious doors that are spreading chaos across the land. A perilous journey awaits as the fate of Japan rests on her shoulders.\"', '2.50hrs', '2023-05-13', '2023-05-31'),
(41, 'Black Panther', 'black.jpg', '\"Queen Ramonda, Shuri, M\'Baku, Okoye and the Dora Milaje fight to protect their nation from intervening world powers in the wake of King T\'Challa\'s death. As the Wakandans strive to embrace their next chapter, the heroes must band together with Nakia and Everett Ross to forge a new path for their beloved kingdom.\"', '2.00hrs', '2023-05-13', '2023-05-31');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `paymentID` int(30) NOT NULL,
  `name` varchar(30) NOT NULL,
  `paymentDate` date NOT NULL,
  `paymentMethod` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`paymentID`, `name`, `paymentDate`, `paymentMethod`) VALUES
(1, 'tongkatAli', '2023-05-11', 'Touch n go'),
(19, 'cq', '2023-05-14', 'Credit Card'),
(20, 'gayrald', '2023-05-14', 'Credit Card'),
(21, 'sotong', '2023-05-14', 'Credit Card'),
(23, 'jjfoogaygay', '2023-05-14', 'Credit Card'),
(25, 'tongkatAli', '2023-05-14', 'Credit Card'),
(26, 'superman', '2023-05-14', 'Credit Card'),
(27, 'tongkatAli', '2023-05-14', 'Credit Card'),
(28, 'cq', '2023-05-14', 'Credit Card'),
(30, 'tongkatAli', '2023-05-14', 'Debit Card'),
(32, 'jjfoogaygay', '2023-05-14', 'Debit Card'),
(33, 'tongkatAli', '2023-05-15', 'Debit Card'),
(34, 'cheehoo', '2023-05-15', 'Cash'),
(35, 'Abu ', '2023-05-16', 'Debit Card'),
(36, 'Abu ', '2023-05-16', 'Debit Card');

-- --------------------------------------------------------

--
-- Table structure for table `user_form`
--

CREATE TABLE `user_form` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_form`
--

INSERT INTO `user_form` (`id`, `name`, `email`, `password`, `image`) VALUES
(4, 'yikai', 'yikai@gmail.com', 'aef4aa663c2a8ffa8178aeb3ceab4baa', ''),
(5, 'Yong Tong', 'yongtong@gmail.com', '8c067133ccc3beaa049d9685538b8496', 'default-avatar.png'),
(8, 'ironman', 'cq@gmail.com', '4524a16baff557dd5f6f775362ca8c0f', 'default-avatar.png'),
(9, 'boonhong', 'boonhong@gmail.com', '202cb962ac59075b964b07152d234b70', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminID`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`BookingID`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedbackID`);

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`mvid`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`paymentID`);

--
-- Indexes for table `user_form`
--
ALTER TABLE `user_form`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adminID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `BookingID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedbackID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `mvid` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `paymentID` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `user_form`
--
ALTER TABLE `user_form`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
