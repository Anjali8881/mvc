-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 18, 2021 at 02:12 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cybercomproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminId` int(30) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `status` tinyint(2) NOT NULL,
  `createdDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminId`, `username`, `password`, `status`, `createdDate`) VALUES
(3, 'anjali', '12345678', 0, '2021-01-31 18:50:44'),
(8, 'vanshika', '', 1, '2021-03-17 06:52:44');

-- --------------------------------------------------------

--
-- Table structure for table `attribute`
--

CREATE TABLE `attribute` (
  `attributeId` int(11) NOT NULL,
  `entityTypeId` enum('product','category') NOT NULL,
  `name` varchar(64) NOT NULL,
  `code` varchar(20) NOT NULL,
  `inputType` varchar(20) NOT NULL,
  `backendType` varchar(64) NOT NULL,
  `sortOrder` int(4) NOT NULL,
  `backendModel` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attribute`
--

INSERT INTO `attribute` (`attributeId`, `entityTypeId`, `name`, `code`, `inputType`, `backendType`, `sortOrder`, `backendModel`) VALUES
(4, 'product', 'color', 'color', 'select', 'varchar', 1, NULL),
(5, 'product', 'size', 'size', 'radio', 'varchar', 2, NULL),
(6, 'product', 'brand', 'brand', 'checkbox', 'varchar', 3, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `attribute_option`
--

CREATE TABLE `attribute_option` (
  `optionId` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `attributeId` int(11) NOT NULL,
  `sortOrder` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attribute_option`
--

INSERT INTO `attribute_option` (`optionId`, `name`, `attributeId`, `sortOrder`) VALUES
(1, 'white', 4, 1),
(2, 'yellow', 4, 2),
(3, 'black', 4, 3),
(4, '17', 5, 1),
(5, '18', 5, 2),
(6, '19', 5, 3),
(7, 'addidas', 6, 1),
(8, 'nike', 6, 2);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `categoryId` int(20) NOT NULL,
  `parentCategoryId` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `status` tinyint(2) NOT NULL,
  `featured` tinyint(2) NOT NULL,
  `createdDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `description` varchar(100) NOT NULL,
  `categoryPath` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`categoryId`, `parentCategoryId`, `name`, `status`, `featured`, `createdDate`, `description`, `categoryPath`) VALUES
(1, 0, 'Bedroom', 1, 1, '2021-03-14 07:39:19', 'Bedroom Items', '1'),
(3, 4, 'Panel Bed', 1, 1, '2021-03-14 07:40:26', 'Panel Beds', '4=3'),
(4, 0, 'Living Room', 0, 0, '2021-03-14 07:40:46', 'Living Room items', '4'),
(5, 4, 'Sofa', 1, 1, '2021-03-14 07:41:09', 'leatherete sofa', '4=5');

-- --------------------------------------------------------

--
-- Table structure for table `cmspage`
--

CREATE TABLE `cmspage` (
  `pageId` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `identifier` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `createdDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cmspage`
--

INSERT INTO `cmspage` (`pageId`, `title`, `identifier`, `content`, `status`, `createdDate`) VALUES
(2, 'Customer', 'Customer Details', '<p><b><u>Customer</u></b></p>', 1, '2021-03-13 17:35:04');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customerId` int(30) NOT NULL,
  `groupId` int(11) NOT NULL,
  `firstName` varchar(25) NOT NULL,
  `lastName` varchar(25) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(30) NOT NULL,
  `status` tinyint(2) NOT NULL,
  `createdDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updatedDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customerId`, `groupId`, `firstName`, `lastName`, `email`, `password`, `status`, `createdDate`, `updatedDate`) VALUES
(3, 1, '  Anjali', 'Sharma', 'anjalisharma.glsica16@gmail.com', '123456789', 1, '2021-01-03 22:35:00', '2021-03-14 18:59:03'),
(4, 2, 'Aditya', 'Sharma', 'aditya@gmail.com', '123456', 0, '2021-02-25 06:19:00', '2021-03-11 05:45:32'),
(5, 1, ' Akshay', 'Ardeshana', 'akshay@gmail.com', '1234567', 1, '2021-01-04 19:40:00', '2021-03-14 18:59:07'),
(6, 2, ' Vanshika', 'Agarwal', 'vanshika@gmail.com', '123456', 0, '2020-02-16 18:28:00', '2021-03-11 05:45:47'),
(7, 1, 'Ronak', 'Jain', 'ronak@gmail.com', '32145678', 0, '2019-05-15 10:24:00', '2021-03-14 17:34:28'),
(19, 2, 'sad', 'asd', 'sad', '', 1, '2021-03-17 10:30:59', '2021-03-17 10:30:59');

-- --------------------------------------------------------

--
-- Table structure for table `customeraddress`
--

CREATE TABLE `customeraddress` (
  `addressId` int(11) NOT NULL,
  `customerId` int(11) NOT NULL,
  `address` varchar(30) NOT NULL,
  `city` varchar(20) NOT NULL,
  `state` varchar(20) NOT NULL,
  `zipcode` int(6) NOT NULL,
  `country` varchar(30) NOT NULL,
  `addressType` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customeraddress`
--

INSERT INTO `customeraddress` (`addressId`, `customerId`, `address`, `city`, `state`, `zipcode`, `country`, `addressType`) VALUES
(1, 0, '456', 'sddfdf', 'dsfsfs', 0, 'sff', 0),
(2, 0, '123', '321', 'qq', 0, 'ewqe', 1),
(5, 0, 'sef', 'sf', 'sdf', 0, '345', 0),
(6, 0, 'ad', 'ada', 'ad', 0, '123', 1),
(7, 3, 'asdasd', 'adasd', 'asdas', 382424, 'India', 0),
(8, 3, 'asdas', 'asdasd', 'asdas', 382424, 'India', 1),
(9, 4, 'kakaria', 'Ahmedabad', 'Gujarat', 231234, 'India', 0),
(10, 4, 'maninagar', 'Ahmedabad', 'Gujarat', 321234, 'India', 1),
(11, 5, '12/456', 'Rajkot', 'Gujarat', 321212, 'India', 0),
(12, 5, '89/123', 'asdas', 'asdas', 321212, 'asddas', 1),
(13, 6, '21/111', 'Maninagar', 'Gujarat', 987645, 'India', 0),
(14, 6, '87/009', 'Maninagar', 'Gujarat', 321234, 'India', 1),
(15, 7, '65/222', 'Odhav', 'Gujarat', 321232, 'India', 0),
(16, 7, '65/222', 'Odhav', 'Gujarat', 321232, 'India', 1),
(17, 18, 'asd', 'asdas', 'asdas', 3212, 'asd', 0),
(18, 18, 'd', 'dasd', 'asda', 321, 'asd', 1),
(19, 19, 'asd', 'asd', 'sd', 123, 'ssd', 0),
(20, 19, 'asd', 'asd', 'asd', 123, 'asd', 1);

-- --------------------------------------------------------

--
-- Table structure for table `customergroup`
--

CREATE TABLE `customergroup` (
  `groupId` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `defaultType` tinyint(2) NOT NULL DEFAULT 0,
  `createdDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customergroup`
--

INSERT INTO `customergroup` (`groupId`, `name`, `defaultType`, `createdDate`) VALUES
(1, 'Wholesale', 0, '2021-03-10 16:11:14'),
(2, 'Retailer', 1, '2021-03-10 16:57:59');

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `mediaId` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `label` varchar(20) NOT NULL,
  `small` tinyint(2) NOT NULL,
  `thumb` tinyint(2) NOT NULL,
  `base` tinyint(2) NOT NULL,
  `gallery` tinyint(2) NOT NULL,
  `productId` int(11) NOT NULL,
  `createdDate` timestamp NULL DEFAULT NULL,
  `updatedDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`mediaId`, `image`, `label`, `small`, `thumb`, `base`, `gallery`, `productId`, `createdDate`, `updatedDate`) VALUES
(2, 'logo.png', 'logo1', 1, 0, 1, 1, 1, '0000-00-00 00:00:00', '2021-03-13 14:00:52'),
(8, 'logo_1.png', 'aada', 0, 1, 0, 0, 16, '0000-00-00 00:00:00', '2021-03-14 17:44:35');

-- --------------------------------------------------------

--
-- Table structure for table `paymentmethod`
--

CREATE TABLE `paymentmethod` (
  `paymentMethodId` int(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `code` varchar(50) NOT NULL,
  `description` varchar(100) NOT NULL,
  `status` tinyint(2) NOT NULL,
  `createdDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `paymentmethod`
--

INSERT INTO `paymentmethod` (`paymentMethodId`, `name`, `code`, `description`, `status`, `createdDate`) VALUES
(1, 'Online Payment', 'p_01', 'Safe and secure online payment', 1, '2021-02-12 23:55:00'),
(14, 'Cash on delivery', 'p_02', 'safe and secure payment', 0, '2021-03-08 08:13:27');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `productId` int(40) NOT NULL,
  `sku` int(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `price` int(50) NOT NULL,
  `discount` int(50) NOT NULL,
  `quantity` int(50) NOT NULL,
  `description` varchar(100) NOT NULL,
  `status` tinyint(2) NOT NULL,
  `createdDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updatedDate` timestamp NULL DEFAULT NULL,
  `color` varchar(20) DEFAULT NULL,
  `size` varchar(20) DEFAULT NULL,
  `brand` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`productId`, `sku`, `name`, `price`, `discount`, `quantity`, `description`, `status`, `createdDate`, `updatedDate`, `color`, `size`, `brand`) VALUES
(1, 101, 'Bed', 19876, 10, 1, 'Good quality of bedroom furniture', 1, '2021-01-04 06:49:00', '2021-03-17 19:15:09', '1', '4', '7'),
(2, 102, 'Sofa', 43075, 28, 1, 'The sofa is made of leatherette', 0, '2021-01-31 21:04:00', '2021-03-13 05:45:59', NULL, NULL, NULL),
(8, 103, 'Mobile', 20000, 10, 2, 'Redmi mobile phone', 0, '2021-02-19 05:28:05', '2021-02-25 17:58:32', NULL, NULL, NULL),
(15, 104, 'laptop', 40000, 2, 2, 'Acer Laptop', 0, '2021-03-13 05:46:57', '2021-03-13 05:47:11', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `productgroupprice`
--

CREATE TABLE `productgroupprice` (
  `entityId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `customerGroupId` int(11) NOT NULL,
  `price` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `productgroupprice`
--

INSERT INTO `productgroupprice` (`entityId`, `productId`, `customerGroupId`, `price`) VALUES
(1, 1, 1, '200'),
(2, 1, 2, '600'),
(3, 2, 1, '1000'),
(4, 2, 2, '100'),
(5, 8, 1, '1600'),
(6, 8, 2, '1900'),
(7, 16, 1, '11'),
(8, 16, 2, '22');

-- --------------------------------------------------------

--
-- Table structure for table `shippingmethod`
--

CREATE TABLE `shippingmethod` (
  `shippingMethodId` int(100) NOT NULL,
  `name` varchar(50) NOT NULL,
  `code` varchar(50) NOT NULL,
  `amount` int(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `status` tinyint(2) NOT NULL,
  `createdDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shippingmethod`
--

INSERT INTO `shippingmethod` (`shippingMethodId`, `name`, `code`, `amount`, `description`, `status`, `createdDate`) VALUES
(1, 'Air Mail', 's_01', 120, 'Secure and save shipping', 1, '2021-02-14 21:32:00'),
(2, 'Local Pickup', 's_02', 200, 'This is a local pickup method', 0, '2021-02-18 07:35:00'),
(4, 'Air Mail', 's_03', 100, 'safe and secure shipping', 0, '2021-02-18 07:35:07'),
(13, 'Air Mail', 's_05', 200, 'safe and secure shipping', 0, '2021-03-08 08:34:56'),
(14, 'Air Mail', 's_07', 200, 'safe and secure shipping', 0, '2021-03-08 08:39:35');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminId`);

--
-- Indexes for table `attribute`
--
ALTER TABLE `attribute`
  ADD PRIMARY KEY (`attributeId`);

--
-- Indexes for table `attribute_option`
--
ALTER TABLE `attribute_option`
  ADD PRIMARY KEY (`optionId`),
  ADD KEY `attributeId` (`attributeId`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`categoryId`);

--
-- Indexes for table `cmspage`
--
ALTER TABLE `cmspage`
  ADD PRIMARY KEY (`pageId`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customerId`);

--
-- Indexes for table `customeraddress`
--
ALTER TABLE `customeraddress`
  ADD PRIMARY KEY (`addressId`);

--
-- Indexes for table `customergroup`
--
ALTER TABLE `customergroup`
  ADD PRIMARY KEY (`groupId`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`mediaId`);

--
-- Indexes for table `paymentmethod`
--
ALTER TABLE `paymentmethod`
  ADD PRIMARY KEY (`paymentMethodId`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`productId`);

--
-- Indexes for table `productgroupprice`
--
ALTER TABLE `productgroupprice`
  ADD PRIMARY KEY (`entityId`);

--
-- Indexes for table `shippingmethod`
--
ALTER TABLE `shippingmethod`
  ADD PRIMARY KEY (`shippingMethodId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adminId` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `attribute`
--
ALTER TABLE `attribute`
  MODIFY `attributeId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `attribute_option`
--
ALTER TABLE `attribute_option`
  MODIFY `optionId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `categoryId` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `cmspage`
--
ALTER TABLE `cmspage`
  MODIFY `pageId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customerId` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `customeraddress`
--
ALTER TABLE `customeraddress`
  MODIFY `addressId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `customergroup`
--
ALTER TABLE `customergroup`
  MODIFY `groupId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `mediaId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `paymentmethod`
--
ALTER TABLE `paymentmethod`
  MODIFY `paymentMethodId` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `productId` int(40) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `productgroupprice`
--
ALTER TABLE `productgroupprice`
  MODIFY `entityId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `shippingmethod`
--
ALTER TABLE `shippingmethod`
  MODIFY `shippingMethodId` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attribute_option`
--
ALTER TABLE `attribute_option`
  ADD CONSTRAINT `attribute_option_ibfk_1` FOREIGN KEY (`attributeId`) REFERENCES `attribute` (`attributeId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
