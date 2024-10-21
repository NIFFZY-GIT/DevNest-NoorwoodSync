-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 11, 2024 at 05:13 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `noorwoodsync`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cart`
--

CREATE TABLE `tbl_cart` (
  `cartId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `quantity` decimal(10,2) DEFAULT NULL,
  `totalPrice` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_cart`
--

INSERT INTO `tbl_cart` (`cartId`, `userId`, `productId`, `quantity`, `totalPrice`) VALUES
(53, 18, 11, 12.56, 314.00),
(54, 18, 15, 36.56, 7312.00),
(55, 18, 12, 12.00, 372.00);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_employee`
--

CREATE TABLE `tbl_employee` (
  `employeeId` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `contactNumber` varchar(15) NOT NULL,
  `salary` decimal(10,2) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_employee`
--

INSERT INTO `tbl_employee` (`employeeId`, `name`, `contactNumber`, `salary`, `email`) VALUES
(1, 'Nipuna Kotalawalage', '0766604984', 1111.00, 'niffzy@gmail.com'),
(12, 'chathurya', '541654', 556685.00, 'olaf@gmail.com'),
(1221, 'Nipuna', '0766604984', 99999999.99, 'niffzy@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_feedback`
--

CREATE TABLE `tbl_feedback` (
  `feedbackId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `stars` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_feedback`
--

INSERT INTO `tbl_feedback` (`feedbackId`, `userId`, `email`, `message`, `stars`) VALUES
(38, 20, '1234@gmail.com', 'hello im 1234', 4),
(39, 18, '123@gmail.com', 'hello im 123', 1),
(40, 19, 'niffzy@gmail.com', 'hgfgfhvk', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `orderId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `orderDate` date NOT NULL,
  `deliveryLocation` varchar(255) NOT NULL,
  `mobileNumber` varchar(15) NOT NULL,
  `totalAmount` decimal(10,2) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`orderId`, `userId`, `orderDate`, `deliveryLocation`, `mobileNumber`, `totalAmount`, `status`) VALUES
(30, 18, '2024-09-19', 'homagama', '34132', 15000.00, 'Shipped'),
(31, 18, '2024-09-19', 'homagama,magammana', '766604984', 3950.00, 'Shipped'),
(35, 19, '2024-09-22', 'homagana', '3342', 51.45, 'Pending'),
(36, 20, '2024-09-22', 'homagana', '3342', 161.79, 'Pending'),
(37, 18, '2024-10-01', 'homagama,magammana', '119', 3.00, 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order_details`
--

CREATE TABLE `tbl_order_details` (
  `orderDetailsId` int(11) NOT NULL,
  `orderId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_order_details`
--

INSERT INTO `tbl_order_details` (`orderDetailsId`, `orderId`, `productId`, `quantity`, `price`) VALUES
(46, 30, 12, 0, 1000.00),
(47, 30, 13, 0, 200.00),
(48, 30, 11, 150, 100.00),
(49, 31, 11, 1, 100.00),
(50, 31, 12, 2, 1000.00),
(51, 31, 13, 3, 200.00),
(52, 31, 14, 1, 100.00),
(53, 31, 15, 2, 200.00),
(54, 31, 16, 3, 250.00),
(74, 35, 11, 13, 25.00),
(75, 35, 11, 13, 25.00),
(76, 35, 12, 145, 31.00),
(77, 36, 11, 233, 25.00),
(78, 36, 12, 334, 31.00),
(79, 37, 11, 12, 25.00);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `price` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `category` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`id`, `name`, `price`, `image`, `category`) VALUES
(11, 'Black Tea', 25, 'black-tea.jpg', 'tea'),
(12, 'butterfly pea tea', 31, 'butterfly-pea-tea-1024x683.jpg', 'tea'),
(13, 'Green Tea', 200, 'green-tea.jpg', 'tea'),
(14, 'Bites', 100, 'bites.jpg', 'snacks'),
(15, 'Chips', 200, 'Chips.jpeg', 'snacks'),
(16, 'Masala', 250, 'masala.jpeg', 'snacks'),
(20, 'watakolu', 150, 'white-tea-1024x683.jpg', 'tea');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_supplier`
--

CREATE TABLE `tbl_supplier` (
  `supplierId` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL,
  `contactNumber` varchar(15) NOT NULL,
  `location` varchar(100) NOT NULL,
  `category` varchar(10) NOT NULL,
  `productName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_supplier`
--

INSERT INTO `tbl_supplier` (`supplierId`, `name`, `email`, `quantity`, `contactNumber`, `location`, `category`, `productName`) VALUES
(12, 'Nipuna', 'niffzy@gmail.com', 1231, '0766604984', 'kndnnc,snc,asncknals', 'Tea', '12412sdfsd'),
(1000, 'niffzy', 'niffzy@gmail.com', 100, '0766604984', 'homcolombo', 'Snacks', 'ASUS ROG Strix G16 (2024) Gaming Laptop, 16â Nebula Display 16:10 QHD 240Hz, GeForce RTX 4060, Int'),
(1221, 'Nipuna', 'niffzy@gmail.com', 21, '0766604984', 'dsafsd', 'Tea', 'ASUS ROG Strix G16 (2024) Gaming Laptop, 16â Nebula Display 16:10 QHD 240Hz, GeForce RTX 4060, Int');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `userId` int(11) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `userType` varchar(50) NOT NULL DEFAULT 'customer'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`userId`, `fname`, `lname`, `email`, `password`, `userType`) VALUES
(18, 'Nipuna', 'Kotalawalage', '123@gmail.com', '$2y$10$4YE6w8cnJ/uFz1xe7n50deKMLxK9ysT0.Py2nUX5sgTpmzlZCVywO', 'customer'),
(19, 'dasun', 'hello', 'niffzy@gmail.com', '$2y$10$ing.Ck.opYqM6Gq3TUP5U.1c8DRJq34Adb5uf8/piF5cAoIQmOYo2', 'admin'),
(20, 'dasun', 'das', '1234@gmail.com', '$2y$10$uH1lnKq/Yz3Ooz/pEHLPEu1FCrDhNFbfVaJWm/Fn7c95gT.G4lyR6', 'customer'),
(21, 'Nipuna', 'Kotalawalage', '12345@gmail.com', '$2y$10$.ADpwwcB5hcIKdrCI4Cu4.yhw/BEdpcKAMFRk.odL2Z/II99wUr7q', 'customer'),
(22, 'chathurya', 'karavita', 'chathu@gmail.com', '$2y$10$XqUfwyi/Js52AtJqOOKIOudvvinp5TyCdABJR5dsVmKpdhkmyfbjS', 'customer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD PRIMARY KEY (`cartId`),
  ADD KEY `userId` (`userId`),
  ADD KEY `tbl_cart_ibfk_2` (`productId`);

--
-- Indexes for table `tbl_employee`
--
ALTER TABLE `tbl_employee`
  ADD PRIMARY KEY (`employeeId`);

--
-- Indexes for table `tbl_feedback`
--
ALTER TABLE `tbl_feedback`
  ADD PRIMARY KEY (`feedbackId`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`orderId`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `tbl_order_details`
--
ALTER TABLE `tbl_order_details`
  ADD PRIMARY KEY (`orderDetailsId`),
  ADD KEY `orderId` (`orderId`),
  ADD KEY `tbl_order_details_ibfk_2` (`productId`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_supplier`
--
ALTER TABLE `tbl_supplier`
  ADD PRIMARY KEY (`supplierId`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`userId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  MODIFY `cartId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `tbl_employee`
--
ALTER TABLE `tbl_employee`
  MODIFY `employeeId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1222;

--
-- AUTO_INCREMENT for table `tbl_feedback`
--
ALTER TABLE `tbl_feedback`
  MODIFY `feedbackId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `orderId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `tbl_order_details`
--
ALTER TABLE `tbl_order_details`
  MODIFY `orderDetailsId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tbl_supplier`
--
ALTER TABLE `tbl_supplier`
  MODIFY `supplierId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1222;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_feedback`
--
ALTER TABLE `tbl_feedback`
  ADD CONSTRAINT `tbl_feedback_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `tbl_user` (`userId`);

--
-- Constraints for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD CONSTRAINT `tbl_order_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `tbl_user` (`userId`);

--
-- Constraints for table `tbl_order_details`
--
ALTER TABLE `tbl_order_details`
  ADD CONSTRAINT `tbl_order_details_ibfk_1` FOREIGN KEY (`orderId`) REFERENCES `tbl_order` (`orderId`),
  ADD CONSTRAINT `tbl_order_details_ibfk_2` FOREIGN KEY (`productId`) REFERENCES `tbl_product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
