-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 26, 2025 at 08:32 AM
-- Server version: 9.1.0
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_discountelectronics`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_adminlogin`
--

DROP TABLE IF EXISTS `tbl_adminlogin`;
CREATE TABLE IF NOT EXISTS `tbl_adminlogin` (
  `loginid` int NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  PRIMARY KEY (`loginid`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_adminlogin`
--

INSERT INTO `tbl_adminlogin` (`loginid`, `username`, `password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_booking`
--

DROP TABLE IF EXISTS `tbl_booking`;
CREATE TABLE IF NOT EXISTS `tbl_booking` (
  `booking_id` int NOT NULL AUTO_INCREMENT,
  `totalamount` int NOT NULL,
  `status` varchar(50) NOT NULL,
  PRIMARY KEY (`booking_id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_booking`
--

INSERT INTO `tbl_booking` (`booking_id`, `totalamount`, `status`) VALUES
(1, 1000, 'successful'),
(2, 0, 'successful'),
(3, 0, 'successful'),
(4, 250, 'successful'),
(5, 0, 'successful'),
(6, 0, 'successful'),
(7, 760, 'successful'),
(8, 0, 'successful'),
(9, 0, 'successful'),
(10, 68400, 'successful'),
(11, 136800, 'successful'),
(12, 137430, 'successful'),
(13, 138060, 'successful'),
(14, 138690, 'successful'),
(15, 138690, 'successful'),
(16, 139320, 'successful'),
(17, 139950, 'successful'),
(18, 140580, 'successful'),
(19, 133750, 'successful'),
(20, 205000, 'successful'),
(21, 274330, 'successful'),
(22, 3125000, 'successful'),
(23, 156750, 'successful');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bookingdetails`
--

DROP TABLE IF EXISTS `tbl_bookingdetails`;
CREATE TABLE IF NOT EXISTS `tbl_bookingdetails` (
  `details_id` int NOT NULL AUTO_INCREMENT,
  `booking_id` int NOT NULL,
  `amount` int NOT NULL,
  `quantity` int NOT NULL,
  `product_id` int NOT NULL,
  `date` date NOT NULL,
  `customer_id` int NOT NULL,
  PRIMARY KEY (`details_id`),
  KEY `tbl_bookingdetails` (`booking_id`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_bookingdetails`
--

INSERT INTO `tbl_bookingdetails` (`details_id`, `booking_id`, `amount`, `quantity`, `product_id`, `date`, `customer_id`) VALUES
(1, 0, 380, 1, 10, '2025-09-22', 2),
(2, 1, 1000, 4, 18, '2025-09-25', 4),
(3, 4, 250, 1, 18, '2025-09-25', 4),
(4, 7, 760, 2, 10, '2025-09-25', 4),
(5, 21, 68020, 1, 8, '2025-09-29', 4),
(6, 21, 380, 1, 10, '2025-09-29', 4),
(7, 21, 380, 1, 10, '2025-09-29', 4),
(8, 21, 68020, 1, 8, '2025-09-29', 4),
(9, 21, 380, 1, 10, '2025-09-29', 4),
(10, 21, 250, 1, 18, '2025-09-29', 4),
(11, 21, 380, 1, 10, '2025-09-29', 4),
(12, 21, 250, 1, 18, '2025-09-29', 4),
(13, 21, 380, 1, 10, '2025-09-29', 4),
(14, 21, 250, 1, 18, '2025-09-29', 4),
(15, 21, 380, 1, 10, '2025-09-29', 4),
(16, 21, 250, 1, 18, '2025-09-29', 4),
(17, 21, 380, 1, 10, '2025-09-29', 4),
(18, 21, 250, 1, 18, '2025-09-29', 4),
(19, 21, 380, 1, 10, '2025-09-29', 4),
(20, 21, 250, 1, 18, '2025-09-29', 4),
(21, 0, 71250, 1, 20, '2025-09-29', 3),
(22, 0, 62500, 1, 19, '2025-09-29', 3),
(23, 0, 71250, 1, 20, '2025-09-29', 3),
(24, 21, 71250, 1, 20, '2025-10-03', 4),
(25, 21, 62500, 1, 19, '2025-10-03', 4),
(26, 22, 3125000, 50, 22, '2025-10-06', 4),
(27, 23, 42750, 3, 21, '2025-10-08', 4),
(28, 23, 114000, 1, 23, '2025-10-08', 4);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_brand`
--

DROP TABLE IF EXISTS `tbl_brand`;
CREATE TABLE IF NOT EXISTS `tbl_brand` (
  `brand_id` int NOT NULL AUTO_INCREMENT,
  `brand_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `image` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`brand_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_brand`
--

INSERT INTO `tbl_brand` (`brand_id`, `brand_name`, `image`) VALUES
(6, 'samsung', 'samsunglogo.avif'),
(8, 'Asus', 'applelogo.avif');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

DROP TABLE IF EXISTS `tbl_category`;
CREATE TABLE IF NOT EXISTS `tbl_category` (
  `category_id` int NOT NULL AUTO_INCREMENT,
  `category_name` varchar(50) NOT NULL,
  `image` varchar(50) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`category_id`, `category_name`, `image`) VALUES
(8, 'Laptop', 'electronics logo.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer`
--

DROP TABLE IF EXISTS `tbl_customer`;
CREATE TABLE IF NOT EXISTS `tbl_customer` (
  `customer_id` int NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `contact` int NOT NULL,
  `landmark` varchar(70) NOT NULL,
  `address` varchar(200) NOT NULL,
  `pincode` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`customer_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_customer`
--

INSERT INTO `tbl_customer` (`customer_id`, `customer_name`, `email`, `contact`, `landmark`, `address`, `pincode`, `username`, `password`) VALUES
(1, 'Jommon', 'jommon@gmail.com', 2147483647, 'Lenskart Piravom', 'Puthumana(H),Alapuram', 686665, 'jommon78', '123'),
(2, 'Arnold Sherry', 'arnoldmachanezzer@gmail.com', 2147483647, '', 'Puthumana(H),', 686665, 'huhu', '123'),
(3, 'arnold', 'arnoldsherry999@gmail.com', 2147483647, 'erge', 'rt', 456, 'asd', '123'),
(4, 'Billu', 'billuj85@gmail.com', 2147483647, 'kalayanthani', 'EUJ', 885566, 'Bilvert', 'Bilvert');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_deliveryaddress`
--

DROP TABLE IF EXISTS `tbl_deliveryaddress`;
CREATE TABLE IF NOT EXISTS `tbl_deliveryaddress` (
  `deliveryaddress_id` int NOT NULL AUTO_INCREMENT,
  `customer_id` int NOT NULL,
  `address` int NOT NULL,
  `landmark` varchar(50) NOT NULL,
  `pincode` int NOT NULL,
  `booking_id` int NOT NULL,
  PRIMARY KEY (`deliveryaddress_id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_deliveryaddress`
--

INSERT INTO `tbl_deliveryaddress` (`deliveryaddress_id`, `customer_id`, `address`, `landmark`, `pincode`, `booking_id`) VALUES
(1, 2, 0, 'jj', 686662, 0),
(2, 4, 0, 'kalayanthani', 686662, 2),
(3, 4, 0, 'kalayanthani', 686662, 3),
(4, 4, 0, 'iok', 34, 4),
(5, 4, 0, 'Mount', 456, 5),
(6, 4, 0, 'Mount', 456, 6),
(7, 4, 0, 'jsbs', 123, 8),
(8, 4, 0, 'ewF', 1458, 10),
(9, 4, 0, 'ikk', 885566, 12),
(10, 4, 0, 'OK', 686665, 14),
(11, 4, 0, 'od', 34, 16),
(12, 4, 0, 'fewf', 456, 18),
(13, 4, 0, 'EJKBFW', 8596, 20),
(14, 3, 0, 'oihfweo', 789, 22),
(15, 3, 0, 'biuoho', 8596, 23),
(16, 4, 0, 'Rem', 456, 24),
(17, 4, 0, 'Rem', 456, 25),
(18, 4, 0, 'Elanji', 885, 26),
(19, 4, 0, 'Temple', 875695, 27),
(20, 4, 0, 'Temple', 875695, 28);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_district`
--

DROP TABLE IF EXISTS `tbl_district`;
CREATE TABLE IF NOT EXISTS `tbl_district` (
  `district_id` int NOT NULL AUTO_INCREMENT,
  `district_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`district_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_district`
--

INSERT INTO `tbl_district` (`district_id`, `district_name`) VALUES
(1, 'alappuzha');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_location`
--

DROP TABLE IF EXISTS `tbl_location`;
CREATE TABLE IF NOT EXISTS `tbl_location` (
  `location_id` int NOT NULL AUTO_INCREMENT,
  `location_name` varchar(50) NOT NULL,
  `district_id` int NOT NULL,
  PRIMARY KEY (`location_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_location`
--

INSERT INTO `tbl_location` (`location_id`, `location_name`, `district_id`) VALUES
(5, 'kok', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payment`
--

DROP TABLE IF EXISTS `tbl_payment`;
CREATE TABLE IF NOT EXISTS `tbl_payment` (
  `payment_id` int NOT NULL AUTO_INCREMENT,
  `date` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `booking_id` int NOT NULL,
  `amount` int NOT NULL,
  `status` varchar(50) NOT NULL,
  PRIMARY KEY (`payment_id`),
  KEY `booking_id` (`booking_id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_payment`
--

INSERT INTO `tbl_payment` (`payment_id`, `date`, `booking_id`, `amount`, `status`) VALUES
(3, '2025-09-25', 8, 0, 'paid'),
(2, '2025-09-25', 7, 760, 'paid'),
(4, '2025-09-25', 9, 0, 'paid'),
(5, '2025-09-29', 10, 68400, 'paid'),
(6, '2025-09-29', 11, 136800, 'paid'),
(7, '2025-09-29', 12, 137430, 'paid'),
(8, '2025-09-29', 13, 138060, 'paid'),
(9, '2025-09-29', 14, 138690, 'paid'),
(10, '2025-09-29', 15, 138690, 'paid'),
(11, '2025-09-29', 16, 139320, 'paid'),
(12, '2025-09-29', 17, 139950, 'paid'),
(13, '2025-09-29', 18, 140580, 'paid'),
(14, '2025-09-29', 19, 133750, 'paid'),
(15, '2025-09-29', 20, 205000, 'paid'),
(16, '2025-10-03', 21, 274330, 'paid'),
(17, '2025-10-06', 22, 3125000, 'paid'),
(18, '2025-10-08', 23, 156750, 'paid');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

DROP TABLE IF EXISTS `tbl_product`;
CREATE TABLE IF NOT EXISTS `tbl_product` (
  `product_id` int NOT NULL AUTO_INCREMENT,
  `product_name` varchar(50) NOT NULL,
  `price` int NOT NULL,
  `description` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `stock` int NOT NULL,
  `brand_id` int NOT NULL,
  `category_id` int NOT NULL,
  `seller_id` int NOT NULL,
  `offer_perc` int NOT NULL,
  `offer_price` int NOT NULL,
  `product_image` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`product_id`, `product_name`, `price`, `description`, `stock`, `brand_id`, `category_id`, `seller_id`, `offer_perc`, `offer_price`, `product_image`) VALUES
(23, 'Asus TUF A21', 120000, 'Laptop Ryzen 5', 49, 5, 8, 85, 5, 114000, 'asuslogo.jpg'),
(22, 'Asus TUF A15', 125000, 'Laptop Ryzen 5', 10, 5, 8, 1, 50, 62500, 'asus tuf f17.jpg'),
(21, 'Samsung Laptop', 95000, 'Laptop', 47, 6, 8, 1, 85, 14250, 'asus vivobook.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_seller`
--

DROP TABLE IF EXISTS `tbl_seller`;
CREATE TABLE IF NOT EXISTS `tbl_seller` (
  `seller_id` int NOT NULL AUTO_INCREMENT,
  `seller_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` bigint NOT NULL,
  `idproof` varchar(50) NOT NULL,
  `license` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  PRIMARY KEY (`seller_id`)
) ENGINE=MyISAM AUTO_INCREMENT=86 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_seller`
--

INSERT INTO `tbl_seller` (`seller_id`, `seller_name`, `email`, `phone`, `idproof`, `license`, `username`, `password`, `status`) VALUES
(1, 'Alok', 'alok@gmail.com', 7895862631, 'license', '45894', 'alok9', '123', 'Accepted'),
(2, 'Fiona', 'fiona@gamil.com', 78945612336, 'driving license', 'KL75968', 'fiona90', '123', 'Rejected'),
(8, 'Loki', 'loki@gmail.com', 789465613, 'license', '74589', 'lki9', 'loki0', 'Rejected'),
(84, 'Alen', 'alen@gmail.com', 1234567890, 'aadhar', '6529', 'alenm', 'alenm', 'Accepted'),
(85, 'Arnold', 'arnold@gmail.com', 9856421325, 'license', 'KL78920258', 'arnold', 'arnold', 'accepted');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
