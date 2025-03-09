-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 06, 2025 at 06:19 AM
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
-- Database: `ty_project_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `Cart_ID` int(11) NOT NULL,
  `User_Id` int(11) DEFAULT NULL,
  `Product_Id` int(11) DEFAULT NULL,
  `Total_Items` int(11) DEFAULT NULL,
  `Total_Price` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `Order_Id` int(11) NOT NULL,
  `Order_Amount` int(11) DEFAULT NULL,
  `Order_Status` enum('pending','processing','shipped','delivered','cancelled') DEFAULT NULL,
  `Delivery_Date` date DEFAULT NULL,
  `Payment_Status` enum('pending','paid','failed','refunded') DEFAULT NULL,
  `User_Id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `Order_Item_Id` int(11) NOT NULL,
  `Order_Id` int(11) DEFAULT NULL,
  `Product_Id` int(11) DEFAULT NULL,
  `Quantity` int(11) DEFAULT NULL,
  `Price` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `Payment_Id` int(11) NOT NULL,
  `User_Id` int(11) DEFAULT NULL,
  `Order_Id` int(11) DEFAULT NULL,
  `Payment_Mode` enum('credit card','debit card','paypal','bank transfer') DEFAULT NULL,
  `Payment_Status` enum('pending','completed','failed','refunded') DEFAULT NULL,
  `Payment_Date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `Product_Id` int(11) NOT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `Price` int(11) DEFAULT NULL,
  `Discount` decimal(10,2) DEFAULT NULL,
  `Inner_Url` varchar(255) DEFAULT NULL,
  `Description` varchar(1000) DEFAULT NULL,
  `Category` varchar(255) DEFAULT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `Rating_Id` int(11) NOT NULL,
  `Product_Id` int(11) DEFAULT NULL,
  `User_Id` int(11) DEFAULT NULL,
  `Review` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `Ticket_Id` int(11) NOT NULL,
  `User_id` int(11) DEFAULT NULL,
  `Order_id` int(11) DEFAULT NULL,
  `Subject` varchar(255) DEFAULT NULL,
  `Status` enum('open','in progress','resolved','closed') DEFAULT NULL,
  `Issue_Description` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `User_id` int(11) NOT NULL,
  `Username` varchar(255) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Contact_information` int(11) DEFAULT NULL,
  `Role` enum('admin','customer') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`User_id`, `Username`, `Password`, `Email`, `Contact_information`, `Role`) VALUES
(0, 'admin', '$2y$10$qn5CDNkSa24E7mX4ikZ4auBd2.7hu9zjCWGFAqn6aLHiWykswR6Bq', 'admin@gmail.com', 1234567890, 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`Cart_ID`),
  ADD KEY `User_Id` (`User_Id`),
  ADD KEY `Product_Id` (`Product_Id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`Order_Id`),
  ADD KEY `User_Id` (`User_Id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`Order_Item_Id`),
  ADD KEY `Order_Id` (`Order_Id`),
  ADD KEY `Product_Id` (`Product_Id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`Payment_Id`),
  ADD KEY `User_Id` (`User_Id`),
  ADD KEY `Order_Id` (`Order_Id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`Product_Id`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`Rating_Id`),
  ADD KEY `Product_Id` (`Product_Id`),
  ADD KEY `User_Id` (`User_Id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`Ticket_Id`),
  ADD KEY `User_id` (`User_id`),
  ADD KEY `Order_id` (`Order_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`User_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`User_Id`) REFERENCES `users` (`User_id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`Product_Id`) REFERENCES `product` (`Product_Id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`User_Id`) REFERENCES `users` (`User_id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`Order_Id`) REFERENCES `orders` (`Order_Id`),
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`Product_Id`) REFERENCES `product` (`Product_Id`);

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`User_Id`) REFERENCES `users` (`User_id`),
  ADD CONSTRAINT `payment_ibfk_2` FOREIGN KEY (`Order_Id`) REFERENCES `orders` (`Order_Id`);

--
-- Constraints for table `rating`
--
ALTER TABLE `rating`
  ADD CONSTRAINT `rating_ibfk_1` FOREIGN KEY (`Product_Id`) REFERENCES `product` (`Product_Id`),
  ADD CONSTRAINT `rating_ibfk_2` FOREIGN KEY (`User_Id`) REFERENCES `users` (`User_id`);

--
-- Constraints for table `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `tickets_ibfk_1` FOREIGN KEY (`User_id`) REFERENCES `users` (`User_id`),
  ADD CONSTRAINT `tickets_ibfk_2` FOREIGN KEY (`Order_id`) REFERENCES `orders` (`Order_Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
