-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 07, 2021 at 02:47 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `questdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminId` int(11) NOT NULL,
  `adminName` varchar(30) NOT NULL,
  `adminPassword` varchar(40) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `createdDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminId`, `adminName`, `adminPassword`, `status`, `createdDate`) VALUES
(2, 'Naeem Valiyani', '@Naeem123', 1, '2021-03-26 08:27:10'),
(20, 'dishant navadiya', '@dishant', 1, '2021-05-05 08:42:28');

-- --------------------------------------------------------

--
-- Table structure for table `attribute`
--

CREATE TABLE `attribute` (
  `attributeId` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `entityTypeId` enum('Product','Category') NOT NULL,
  `code` varchar(20) NOT NULL,
  `inputType` varchar(20) NOT NULL,
  `backendType` varchar(255) DEFAULT NULL,
  `sortOrder` int(4) NOT NULL,
  `backendModel` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attribute`
--

INSERT INTO `attribute` (`attributeId`, `name`, `entityTypeId`, `code`, `inputType`, `backendType`, `sortOrder`, `backendModel`) VALUES
(19, 'color', 'Product', 'color 1', 'radio', 'varchar(255)', 1, 'Model\\Attribute\\Option'),
(20, 'size', 'Product', 'size', 'radio', 'varchar(255)', 2, 'Model\\Attribute\\Option'),
(21, 'brand', 'Product', 'brand', 'textbox', 'varchar(255)', 3, 'Model\\Brand\\Option');

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
(21, 'Yellow', 19, 4),
(22, 'brown', 19, 3),
(23, 'blue', 19, 2),
(24, 'red', 19, 1),
(25, '14', 20, 1),
(26, '13', 20, 2),
(27, '12', 20, 1);

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `brandId` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `image` varchar(50) NOT NULL,
  `sortOrder` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `createdDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`brandId`, `name`, `image`, `sortOrder`, `status`, `createdDate`) VALUES
(13, 'Nike', 'pexels-artem-beliaikin-853199.jpg', 1, 1, '2021-04-13 08:04:33'),
(14, 'Samsung', 'pexels-emiliano-arano-3608311.jpg', 2, 0, '2021-04-13 08:04:47');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cartId` int(11) NOT NULL,
  `customerId` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `discount` int(11) NOT NULL,
  `paymentMethodId` int(11) DEFAULT NULL,
  `shippingMethodId` int(11) DEFAULT NULL,
  `shippingMethodAmount` int(11) NOT NULL,
  `sessionId` varchar(32) NOT NULL,
  `createdDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cartId`, `customerId`, `total`, `discount`, `paymentMethodId`, `shippingMethodId`, `shippingMethodAmount`, `sessionId`, `createdDate`) VALUES
(27, 16, 0, 0, NULL, NULL, 0, 'beqgr972b5domvkq0h2ln527kp', '2021-03-31 07:09:08'),
(28, 18, 0, 0, NULL, NULL, 0, 'beqgr972b5domvkq0h2ln527kp', '2021-03-31 07:09:24'),
(114, 21, 0, 0, 11, 10, 170000, '9pu2i53tau9893e8s7196mnhn4', '2021-04-25 07:34:22'),
(115, 24, 0, 0, NULL, NULL, 0, '9pu2i53tau9893e8s7196mnhn4', '2021-04-25 07:34:46');

-- --------------------------------------------------------

--
-- Table structure for table `cartaddress`
--

CREATE TABLE `cartaddress` (
  `cartAddressId` int(11) NOT NULL,
  `cartId` int(11) NOT NULL,
  `address_id` int(11) DEFAULT NULL,
  `address` text NOT NULL,
  `addressType` varchar(30) NOT NULL,
  `city` varchar(30) NOT NULL,
  `state` varchar(30) NOT NULL,
  `country` varchar(30) NOT NULL,
  `zipCode` varchar(30) NOT NULL,
  `sameAsBilling` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cartaddress`
--

INSERT INTO `cartaddress` (`cartAddressId`, `cartId`, `address_id`, `address`, `addressType`, `city`, `state`, `country`, `zipCode`, `sameAsBilling`) VALUES
(168, 114, 42, 'manipur darbar', 'Billing', 'AHMEDABAD', 'GOA', 'SINGAPORE', '396195', 0),
(169, 114, 43, 'manipur darbar', 'Shipping', 'VADODARA', 'RAJASTHAN', 'SINGAPORE', '396192', 0);

-- --------------------------------------------------------

--
-- Table structure for table `cartitem`
--

CREATE TABLE `cartitem` (
  `cartItemId` int(11) NOT NULL,
  `cartId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `basePrice` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `discount` int(11) NOT NULL,
  `createdDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cartitem`
--

INSERT INTO `cartitem` (`cartItemId`, `cartId`, `productId`, `quantity`, `basePrice`, `price`, `discount`, `createdDate`) VALUES
(96, 114, 92, 5, 20000, 20000, 20, '2021-04-25 07:34:32'),
(98, 114, 93, 1, 22000, 22000, 10, '2021-05-05 09:16:29');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `categoryId` int(11) NOT NULL,
  `categoryName` varchar(30) NOT NULL,
  `parentId` int(11) DEFAULT NULL,
  `pathId` varchar(50) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`categoryId`, `categoryName`, `parentId`, `pathId`, `status`, `description`) VALUES
(1, 'Bedroom', NULL, '1', 1, 'Bedroom'),
(2, 'Living Room', NULL, '2', 1, ''),
(3, 'Dining & Kitchen', NULL, '3', 1, '\r\n'),
(4, 'Beds', 1, '1=4', 1, ''),
(5, 'Nightstand', 1, '1=5', 1, ''),
(6, 'Sofas', 2, '2=6', 1, ''),
(7, 'Chairs', 2, '2=7', 1, ''),
(8, 'Dining Sets', 3, '3=8', 1, ''),
(9, 'Dining Tables', 3, '3=9', 1, ''),
(10, 'Office', NULL, '10', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `cms_page`
--

CREATE TABLE `cms_page` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `identifier` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `createdDate` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cms_page`
--

INSERT INTO `cms_page` (`id`, `title`, `identifier`, `content`, `status`, `createdDate`) VALUES
(21, 'About Us', 'About Us', '<div class=\"about-section\">\r\n  <h1>About Us Page</h1>\r\n  <p>Some text about who we are and what we do.</p>\r\n  <p>Resize the browser window to see that this page is responsive by the way.</p>\r\n</div>\r\n\r\n<h2 style=\"text-align:center\">Our Team</h2>\r\n<div class=\"row\">\r\n  <div class=\"column\">\r\n    <div class=\"card\">\r\n  \r\n      <div class=\"container\">\r\n        <h2>Mike Ross</h2>\r\n        <p class=\"title\">Art Director</p>\r\n        <p>Some text that describes me lorem ipsum ipsum lorem.</p>\r\n        <p>mike@example.com</p>\r\n        <p><button class=\"button\">Contact</button></p>\r\n      </div>\r\n    </div>\r\n  </div>\r\n</div>', 0, '2021-04-20 10:40:56');

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

CREATE TABLE `config` (
  `configId` int(11) NOT NULL,
  `groupId` int(11) NOT NULL,
  `title` varchar(30) NOT NULL,
  `code` varchar(40) NOT NULL,
  `value` varchar(50) NOT NULL,
  `createdDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `config`
--

INSERT INTO `config` (`configId`, `groupId`, `title`, `code`, `value`, `createdDate`) VALUES
(11, 4, 'webiste', '676456', 'Questecom', '0000-00-00 00:00:00'),
(12, 4, 'Website', 'Website_1', 'Questecom', '0000-00-00 00:00:00'),
(13, 6, 'dishant', '123', '1', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `config_group`
--

CREATE TABLE `config_group` (
  `groupId` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `createdDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `config_group`
--

INSERT INTO `config_group` (`groupId`, `name`, `createdDate`) VALUES
(4, 'website_name', '2021-05-05 09:13:01'),
(6, 'logo_name', '2021-05-05 09:13:10');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customerId` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `firstName` varchar(30) NOT NULL,
  `lastName` varchar(30) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(30) NOT NULL,
  `contactNo` varchar(20) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `createdDate` datetime NOT NULL,
  `updatedDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customerId`, `group_id`, `firstName`, `lastName`, `email`, `password`, `contactNo`, `status`, `createdDate`, `updatedDate`) VALUES
(16, 1, 'pradeep', 'yadav 1', 'pk1@gmail.com', '@123', '8757978757', 1, '2021-03-03 18:54:43', '2021-04-21 06:55:11'),
(18, 4, 'mahesh', 'ok', 'm@gmail.com', '745yud', '89757987797', 1, '2021-03-04 10:10:39', NULL),
(21, 1, 'Naeem', 'Memon', 'naeemmemon60650@gmail.com', 'hwudhu', '9574788888', 1, '2021-03-18 20:36:56', '2021-03-27 11:46:47'),
(24, 1, 'sameer', 'patel', 'cybercom@gmail.com', '@Cybercom123', '985487797', 1, '2021-04-21 18:54:16', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customer_address`
--

CREATE TABLE `customer_address` (
  `address_id` int(11) NOT NULL,
  `customerId` int(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `zipCode` int(10) NOT NULL,
  `country` varchar(50) NOT NULL,
  `addressType` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer_address`
--

INSERT INTO `customer_address` (`address_id`, `customerId`, `address`, `city`, `state`, `zipCode`, `country`, `addressType`) VALUES
(25, 16, 'shreedeep hostel', 'Vapi', 'Maharashtra', 440440, 'Australia', 'Billing'),
(26, 16, 'shreedeep hostel 1', 'Vapi', 'MAHARASHTRA', 412412, 'India', 'Shipping'),
(27, 18, 'mahavir char rasta', 'VALSAD', 'GUJARAT', 396191, 'INDIA', 'Billing'),
(41, 18, 'manipur darbar', 'AHMEDABAD', 'GOA', 948888, 'SINGAPORE', 'Shipping'),
(42, 21, 'manipur darbar', 'AHMEDABAD', 'GOA', 396195, 'SINGAPORE', 'Billing'),
(43, 21, 'manipur darbar', 'VADODARA', 'RAJASTHAN', 396192, 'SINGAPORE', 'Shipping');

-- --------------------------------------------------------

--
-- Table structure for table `customer_group`
--

CREATE TABLE `customer_group` (
  `group_id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `createdDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer_group`
--

INSERT INTO `customer_group` (`group_id`, `name`, `status`, `createdDate`) VALUES
(1, 'wholesale', 1, '2021-03-10 09:18:47'),
(4, 'Retail', 1, '2021-03-04 10:10:00'),
(5, 'okay group', 1, '2021-03-10 11:53:54');

-- --------------------------------------------------------

--
-- Table structure for table `orderaddress`
--

CREATE TABLE `orderaddress` (
  `orderAddressId` int(11) NOT NULL,
  `orderId` int(11) NOT NULL,
  `address_id` int(11) NOT NULL,
  `address` text NOT NULL,
  `addressType` varchar(20) NOT NULL,
  `city` varchar(20) NOT NULL,
  `state` varchar(30) NOT NULL,
  `country` varchar(20) NOT NULL,
  `zipCode` varchar(6) NOT NULL,
  `sameAsBilling` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orderaddress`
--

INSERT INTO `orderaddress` (`orderAddressId`, `orderId`, `address_id`, `address`, `addressType`, `city`, `state`, `country`, `zipCode`, `sameAsBilling`) VALUES
(43, 27, 42, 'manipur darbar', 'Billing', 'AHMEDABAD', 'GOA', 'SINGAPORE', '396195', 0),
(44, 27, 43, 'manipur darbar', 'Shipping', 'VADODARA', 'RAJASTHAN', 'SINGAPORE', '396192', 0);

-- --------------------------------------------------------

--
-- Table structure for table `orderdetails`
--

CREATE TABLE `orderdetails` (
  `orderId` int(11) NOT NULL,
  `customerId` int(11) NOT NULL,
  `firstName` varchar(40) NOT NULL,
  `lastName` varchar(30) NOT NULL,
  `contactNo` varchar(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `discount` decimal(10,2) NOT NULL,
  `paymentMethodId` int(11) NOT NULL,
  `paymentName` varchar(30) NOT NULL,
  `paymentMethodCode` varchar(30) NOT NULL,
  `shippingMethodId` int(11) NOT NULL,
  `shippingName` varchar(30) NOT NULL,
  `shippingMethodCode` varchar(20) NOT NULL,
  `shippingMethodAmount` decimal(10,2) NOT NULL,
  `status` enum('Confirm','Pending','InProcess','Cancelled') NOT NULL,
  `createdDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orderdetails`
--

INSERT INTO `orderdetails` (`orderId`, `customerId`, `firstName`, `lastName`, `contactNo`, `email`, `total`, `discount`, `paymentMethodId`, `paymentName`, `paymentMethodCode`, `shippingMethodId`, `shippingName`, `shippingMethodCode`, `shippingMethodAmount`, `status`, `createdDate`) VALUES
(27, 21, 'Naeem', 'Memon', '9574788888', 'naeemmemon60650@gmail.com', '99800.00', '10.00', 12, 'MASTERCARD', 'gy4938bd', 10, 'Free Delivery', '7436gd', '170000.00', 'Confirm', '2021-04-25 07:11:52');

-- --------------------------------------------------------

--
-- Table structure for table `orderitems`
--

CREATE TABLE `orderitems` (
  `orderItemId` int(11) NOT NULL,
  `orderId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `productName` varchar(30) NOT NULL,
  `quantity` int(11) NOT NULL,
  `basePrice` decimal(10,2) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `discount` decimal(10,2) NOT NULL,
  `createdDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orderitems`
--

INSERT INTO `orderitems` (`orderItemId`, `orderId`, `productId`, `productName`, `quantity`, `basePrice`, `price`, `discount`, `createdDate`) VALUES
(25, 27, 92, 'Washnig Machine', 4, '20000.00', '20000.00', '20.00', '2021-04-25 07:11:52');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `methodId` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `code` varchar(40) NOT NULL,
  `amount` int(30) NOT NULL,
  `description` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `createdDate` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`methodId`, `name`, `code`, `amount`, `description`, `status`, `createdDate`) VALUES
(11, 'VISA', '129388', 12000, 'amazing service', 1, '2021-03-27 12:37:14'),
(12, 'MASTERCARD', 'gy4938bd', 29000, 'nice and cool glasses', 1, '2021-03-27 12:37:43'),
(17, 'simple', 'naeem', 12000, 'okay service', 1, '2021-04-24 16:08:37');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `productId` int(11) NOT NULL,
  `categoryId` int(11) DEFAULT NULL,
  `SKU` varchar(20) NOT NULL,
  `productName` varchar(30) NOT NULL,
  `productPrice` double NOT NULL,
  `productDiscount` double NOT NULL,
  `productQty` int(10) NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  `createdDate` datetime NOT NULL,
  `updatedDate` datetime DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `size` varchar(255) DEFAULT NULL,
  `brand` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`productId`, `categoryId`, `SKU`, `productName`, `productPrice`, `productDiscount`, `productQty`, `description`, `status`, `createdDate`, `updatedDate`, `color`, `size`, `brand`) VALUES
(92, 1, '7Z2784', 'branded sheet cover', 20000, 20, 2, 'Birlanny Silver Queen Upholstered Panel Bed\', \'2094.00\', \'28.57\', 20, \'Part of Birlanny Collection\\r', 0, '2021-04-13 07:09:52', '2021-04-25 10:40:56', 'red', '13', 'okay'),
(93, 5, '7Z2722', 'bedsheet', 22000, 10, 2, 'Part of Lettner Collection from Ashley\\r\\nCrafted fom select birch veneers and hardwood solids\\r\\nBurnished light gray finish\\r\\nStorage footboard\\r\\nOptional Nightstand\\r\\nRequired slat rolls\\r\\nBox Spring Not Required\\r\\nBed is Available in Queen, King & Cal. King Sizes', 0, '2021-04-13 07:12:03', '2021-04-22 10:58:01', 'brown', '', ''),
(101, 8, '897387', 'night stand', 100, 1, 1, 'nice design and full work', 1, '2021-04-22 11:23:52', NULL, NULL, NULL, NULL),
(102, 5, '87348638', 'bedsheet white', 12000, 10, 2, 'amazing product', 1, '2021-04-25 11:02:50', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `productgallery`
--

CREATE TABLE `productgallery` (
  `productId` int(11) NOT NULL,
  `productGalleryId` int(11) NOT NULL,
  `imageName` varchar(255) NOT NULL,
  `imagelabel` varchar(100) NOT NULL,
  `small` tinyint(1) NOT NULL DEFAULT 0,
  `thumb` tinyint(1) NOT NULL DEFAULT 0,
  `base` tinyint(1) NOT NULL DEFAULT 0,
  `gallery` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `productgallery`
--

INSERT INTO `productgallery` (`productId`, `productGalleryId`, `imageName`, `imagelabel`, `small`, `thumb`, `base`, `gallery`) VALUES
(92, 50, 'pexels-aleksandar-pasaric-3310691.jpg', 'Roz', 0, 1, 0, 1),
(92, 51, 'pexels-anni-roenkae-2156881.jpg', 'Main', 1, 0, 0, 0),
(92, 52, 'pexels-dom-j-310452.jpg', 'Grey', 0, 0, 1, 1),
(93, 53, 'pexels-craig-adderley-1546898.jpg', 'geeks', 1, 0, 0, 1),
(93, 54, 'pexels-emiliano-arano-3608311.jpg', 'for', 0, 1, 0, 1),
(102, 56, 'Screenshot (2).png', '', 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `product_group_price`
--

CREATE TABLE `product_group_price` (
  `entityId` int(11) NOT NULL,
  `groupId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `groupPrice` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_group_price`
--

INSERT INTO `product_group_price` (`entityId`, `groupId`, `productId`, `groupPrice`) VALUES
(23, 4, 93, '100.00'),
(25, 1, 93, '500.00'),
(28, 1, 92, '1000.00'),
(29, 4, 92, '0.00'),
(30, 5, 92, '2222.00'),
(31, 5, 93, '200.00'),
(33, 1, 101, '16000.00'),
(34, 4, 101, '100.00'),
(35, 5, 101, '100.00'),
(36, 1, 102, '100.00'),
(37, 4, 102, '0.00'),
(38, 5, 102, '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `shipping`
--

CREATE TABLE `shipping` (
  `methodId` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `code` varchar(40) NOT NULL,
  `amount` int(30) NOT NULL,
  `description` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `createdDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shipping`
--

INSERT INTO `shipping` (`methodId`, `name`, `code`, `amount`, `description`, `status`, `createdDate`) VALUES
(4, 'Platinum Delivery', '7854ggg', 9000, '1 Day Delivery', 1, '2021-02-18 05:22:51'),
(10, 'Free Delivery', '7436gd', 170000, '7 Days Delivery', 1, '2021-03-27 14:06:58');

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
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`brandId`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cartId`),
  ADD KEY `customerId` (`customerId`),
  ADD KEY `paymentMethodId` (`paymentMethodId`),
  ADD KEY `shippingMethodId` (`shippingMethodId`);

--
-- Indexes for table `cartaddress`
--
ALTER TABLE `cartaddress`
  ADD PRIMARY KEY (`cartAddressId`),
  ADD KEY `cartId` (`cartId`),
  ADD KEY `address_id` (`address_id`);

--
-- Indexes for table `cartitem`
--
ALTER TABLE `cartitem`
  ADD PRIMARY KEY (`cartItemId`),
  ADD KEY `cartId` (`cartId`),
  ADD KEY `productId` (`productId`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`categoryId`),
  ADD KEY `parentId` (`parentId`);

--
-- Indexes for table `cms_page`
--
ALTER TABLE `cms_page`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `identifier` (`identifier`);

--
-- Indexes for table `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`configId`),
  ADD KEY `groupId` (`groupId`);

--
-- Indexes for table `config_group`
--
ALTER TABLE `config_group`
  ADD PRIMARY KEY (`groupId`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customerId`),
  ADD KEY `group_id` (`group_id`);

--
-- Indexes for table `customer_address`
--
ALTER TABLE `customer_address`
  ADD PRIMARY KEY (`address_id`),
  ADD KEY `customerId` (`customerId`);

--
-- Indexes for table `customer_group`
--
ALTER TABLE `customer_group`
  ADD PRIMARY KEY (`group_id`);

--
-- Indexes for table `orderaddress`
--
ALTER TABLE `orderaddress`
  ADD PRIMARY KEY (`orderAddressId`),
  ADD KEY `orderId` (`orderId`);

--
-- Indexes for table `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD PRIMARY KEY (`orderId`);

--
-- Indexes for table `orderitems`
--
ALTER TABLE `orderitems`
  ADD PRIMARY KEY (`orderItemId`),
  ADD KEY `orderId` (`orderId`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`methodId`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`productId`),
  ADD KEY `categoryId` (`categoryId`);

--
-- Indexes for table `productgallery`
--
ALTER TABLE `productgallery`
  ADD PRIMARY KEY (`productGalleryId`),
  ADD KEY `productId` (`productId`);

--
-- Indexes for table `product_group_price`
--
ALTER TABLE `product_group_price`
  ADD PRIMARY KEY (`entityId`),
  ADD KEY `groupId` (`groupId`),
  ADD KEY `productId` (`productId`);

--
-- Indexes for table `shipping`
--
ALTER TABLE `shipping`
  ADD PRIMARY KEY (`methodId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adminId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `attribute`
--
ALTER TABLE `attribute`
  MODIFY `attributeId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `attribute_option`
--
ALTER TABLE `attribute_option`
  MODIFY `optionId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `brandId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cartId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- AUTO_INCREMENT for table `cartaddress`
--
ALTER TABLE `cartaddress`
  MODIFY `cartAddressId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=170;

--
-- AUTO_INCREMENT for table `cartitem`
--
ALTER TABLE `cartitem`
  MODIFY `cartItemId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `categoryId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=248;

--
-- AUTO_INCREMENT for table `cms_page`
--
ALTER TABLE `cms_page`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `config`
--
ALTER TABLE `config`
  MODIFY `configId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `config_group`
--
ALTER TABLE `config_group`
  MODIFY `groupId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customerId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `customer_address`
--
ALTER TABLE `customer_address`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `customer_group`
--
ALTER TABLE `customer_group`
  MODIFY `group_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `orderaddress`
--
ALTER TABLE `orderaddress`
  MODIFY `orderAddressId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `orderdetails`
--
ALTER TABLE `orderdetails`
  MODIFY `orderId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `orderitems`
--
ALTER TABLE `orderitems`
  MODIFY `orderItemId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `methodId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `productId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `productgallery`
--
ALTER TABLE `productgallery`
  MODIFY `productGalleryId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `product_group_price`
--
ALTER TABLE `product_group_price`
  MODIFY `entityId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `shipping`
--
ALTER TABLE `shipping`
  MODIFY `methodId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attribute_option`
--
ALTER TABLE `attribute_option`
  ADD CONSTRAINT `attribute_option_ibfk_1` FOREIGN KEY (`attributeId`) REFERENCES `attribute` (`attributeId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`customerId`) REFERENCES `customer` (`customerId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`paymentMethodId`) REFERENCES `payment` (`methodId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cart_ibfk_3` FOREIGN KEY (`shippingMethodId`) REFERENCES `shipping` (`methodId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cartaddress`
--
ALTER TABLE `cartaddress`
  ADD CONSTRAINT `cartaddress_ibfk_1` FOREIGN KEY (`cartId`) REFERENCES `cart` (`cartId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cartaddress_ibfk_2` FOREIGN KEY (`address_id`) REFERENCES `customer_address` (`address_id`);

--
-- Constraints for table `cartitem`
--
ALTER TABLE `cartitem`
  ADD CONSTRAINT `cartitem_ibfk_1` FOREIGN KEY (`cartId`) REFERENCES `cart` (`cartId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cartitem_ibfk_2` FOREIGN KEY (`productId`) REFERENCES `product` (`productId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `config`
--
ALTER TABLE `config`
  ADD CONSTRAINT `config_ibfk_1` FOREIGN KEY (`groupId`) REFERENCES `config_group` (`groupId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `customer_group` (`group_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `customer_address`
--
ALTER TABLE `customer_address`
  ADD CONSTRAINT `customer_address_ibfk_1` FOREIGN KEY (`customerId`) REFERENCES `customer` (`customerId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orderaddress`
--
ALTER TABLE `orderaddress`
  ADD CONSTRAINT `orderaddress_ibfk_1` FOREIGN KEY (`orderId`) REFERENCES `orderdetails` (`orderId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orderitems`
--
ALTER TABLE `orderitems`
  ADD CONSTRAINT `orderitems_ibfk_1` FOREIGN KEY (`orderId`) REFERENCES `orderdetails` (`orderId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`categoryId`) REFERENCES `category` (`categoryId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `productgallery`
--
ALTER TABLE `productgallery`
  ADD CONSTRAINT `productgallery_ibfk_1` FOREIGN KEY (`productId`) REFERENCES `product` (`productId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_group_price`
--
ALTER TABLE `product_group_price`
  ADD CONSTRAINT `product_group_price_ibfk_1` FOREIGN KEY (`groupId`) REFERENCES `customer_group` (`group_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_group_price_ibfk_2` FOREIGN KEY (`productId`) REFERENCES `product` (`productId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
