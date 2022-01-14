-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 18, 2020 at 03:31 PM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `admin_scot`
--

-- --------------------------------------------------------

--
-- Table structure for table `sma_products`
--

CREATE TABLE `sma_products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(25,4) NOT NULL DEFAULT '0.0000',
  `image` varchar(255) DEFAULT 'no_image.png',
  `details` varchar(1000) DEFAULT NULL,
  `product_type` varchar(255) NOT NULL,
  `type` enum('product','sub_product','property') NOT NULL DEFAULT 'product',
  `parent` int(11) NOT NULL DEFAULT '0',
  `lift_option` enum('Yes','No') DEFAULT NULL,
  `font` varchar(55) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sma_products`
--

INSERT INTO `sma_products` (`id`, `name`, `price`, `image`, `details`, `product_type`, `type`, `parent`, `lift_option`, `font`) VALUES
(1, 'Sofas', '123.0000', '962f6433949e5b1f1c0f37b8a2511d63.png', '', 'furniture_delivery', 'product', 0, NULL, NULL),
(2, 'Two Seater Sofa', '123.0000', 'no_image.png', NULL, 'furniture_delivery', 'sub_product', 1, NULL, NULL),
(3, 'Three Seater Sofa', '123.0000', 'no_image.png', NULL, 'furniture_delivery', 'sub_product', 1, NULL, NULL),
(4, 'Four Seater Sofa', '123.0000', 'no_image.png', NULL, 'furniture_delivery', 'sub_product', 1, NULL, NULL),
(5, 'Wardrobes', '123.0000', 'e4161d189d9c3e1ccfc6e34fd42aaa66.png', '<p>All Wardrobes</p>', 'furniture_delivery', 'product', 0, NULL, NULL),
(6, 'Boxes', '123.0000', '4e9c43605e533bf96567268bcb784258.png', '<p>All Boxes</p>', 'furniture_delivery', 'product', 0, NULL, NULL),
(7, 'Beds & Mattresses', '123.0000', 'd498d1f88f164bf40675c1d5ceeed7f4.png', '<p>All Beds & Mattresses</p>', 'furniture_delivery', 'product', 0, NULL, NULL),
(8, 'Tables', '123.0000', '883e3844ae511141d1ea192629b5ef61.png', '<p>All Tables</p>', 'furniture_delivery', 'product', 0, NULL, NULL),
(9, 'Televisions', '123.0000', '05ea9e7ce8b0fbd7ba8d5928d8621837.png', '<p>All Televisions</p>', 'furniture_delivery', 'product', 0, NULL, NULL),
(10, 'Clothing', '123.0000', '6759fc0b530540a81d9c6d3f4f4f00b3.png', '<p>All Clothing</p>', 'furniture_delivery', 'product', 0, NULL, NULL),
(11, 'Chairs', '123.0000', '784490a7ccb52dc39ae589f50f5759b7.png', '<p>All Chairs</p>', 'furniture_delivery', 'product', 0, NULL, NULL),
(12, 'Single Wardrobe', '123.0000', 'no_image.png', NULL, 'furniture_delivery', 'sub_product', 5, NULL, NULL),
(13, 'Double Wardrobe', '123.0000', 'no_image.png', NULL, 'furniture_delivery', 'sub_product', 5, NULL, NULL),
(14, 'Triple Wardrobe', '123.0000', 'no_image.png', NULL, 'furniture_delivery', 'sub_product', 5, NULL, NULL),
(15, 'Small Box', '123.0000', 'no_image.png', NULL, 'furniture_delivery', 'sub_product', 6, NULL, NULL),
(16, 'Medium Box', '123.0000', 'no_image.png', NULL, 'furniture_delivery', 'sub_product', 6, NULL, NULL),
(17, 'Large Box', '123.0000', 'no_image.png', NULL, 'furniture_delivery', 'sub_product', 6, NULL, NULL),
(18, 'Single Bed & Mattress', '123.0000', 'no_image.png', NULL, 'furniture_delivery', 'sub_product', 7, NULL, NULL),
(19, 'Double Bed & Mattress', '123.0000', 'no_image.png', NULL, 'furniture_delivery', 'sub_product', 7, NULL, NULL),
(20, 'Kingsize Bed & Mattress', '123.0000', 'no_image.png', NULL, 'furniture_delivery', 'sub_product', 7, NULL, NULL),
(21, 'Coffee Table', '123.0000', 'no_image.png', NULL, 'furniture_delivery', 'sub_product', 8, NULL, NULL),
(22, 'Bedside Table', '123.0000', 'no_image.png', NULL, 'furniture_delivery', 'sub_product', 8, NULL, NULL),
(23, 'Garden Table', '123.0000', 'no_image.png', NULL, 'furniture_delivery', 'sub_product', 8, NULL, NULL),
(24, '4 Seater Dining Table & Chairs', '123.0000', 'no_image.png', NULL, 'furniture_delivery', 'sub_product', 8, NULL, NULL),
(25, '6 Seater Dining Table & Chairs', '123.0000', 'no_image.png', NULL, 'furniture_delivery', 'sub_product', 8, NULL, NULL),
(26, 'Small Television/TV (Less than 30\")', '123.0000', 'no_image.png', NULL, 'furniture_delivery', 'sub_product', 9, NULL, NULL),
(27, 'Medium Television/TV (30\" to 40\")', '123.0000', 'no_image.png', NULL, 'furniture_delivery', 'sub_product', 9, NULL, NULL),
(28, 'Large Television/TV (Greater than 40\")', '123.0000', 'no_image.png', NULL, 'furniture_delivery', 'sub_product', 9, NULL, NULL),
(29, 'Small Bag', '123.0000', 'no_image.png', NULL, 'furniture_delivery', 'sub_product', 10, NULL, NULL),
(30, 'Large Bag', '123.0000', 'no_image.png', NULL, 'furniture_delivery', 'sub_product', 10, NULL, NULL),
(31, 'Suitcase', '123.0000', 'no_image.png', NULL, 'furniture_delivery', 'sub_product', 10, NULL, NULL),
(32, 'Box Of Clothes', '123.0000', 'no_image.png', NULL, 'furniture_delivery', 'sub_product', 10, NULL, NULL),
(33, 'Armchair', '123.0000', 'no_image.png', NULL, 'furniture_delivery', 'sub_product', 11, NULL, NULL),
(34, 'Dining Chair', '123.0000', 'no_image.png', NULL, 'furniture_delivery', 'sub_product', 11, NULL, NULL),
(36, 'Office Chair', '123.0000', 'no_image.png', NULL, 'furniture_delivery', 'sub_product', 11, NULL, NULL),
(37, '1 Bed House', '0.0000', 'no_image.png', '', 'house_removals', 'property', 1, 'No', NULL),
(38, '2 Bed House', '0.0000', 'no_image.png', '', 'house_removals', 'property', 1, 'No', NULL),
(39, '3 Bed House', '0.0000', 'no_image.png', '', 'house_removals', 'property', 1, 'No', NULL),
(40, '4+ Bed House', '0.0000', 'no_image.png', '', 'house_removals', 'property', 1, 'No', NULL),
(41, '1 Bed Flat', '0.0000', 'no_image.png', '', 'house_removals', 'property', 2, 'Yes', NULL),
(42, '2 Bed Flat', '0.0000', 'no_image.png', '', 'house_removals', 'property', 2, 'Yes', NULL),
(43, '3 Bed Flat', '0.0000', 'no_image.png', '', 'house_removals', 'property', 2, 'Yes', NULL),
(44, '4+ Bed Flat', '0.0000', 'no_image.png', '', 'house_removals', 'property', 2, 'Yes', NULL),
(45, 'Studio', '0.0000', 'no_image.png', '', 'house_removals', 'property', 3, 'Yes', NULL),
(46, 'Storage Unit', '0.0000', 'no_image.png', '', 'house_removals', 'property', 3, 'No', NULL),
(47, 'Flatshare', '0.0000', 'no_image.png', '', 'house_removals', 'property', 3, 'Yes', NULL),
(48, 'Bedrooms', '123.0000', '8ead0543c26b9b7b641b565f489067fe.svg', '', 'house_removals', 'product', 0, NULL, NULL),
(49, 'Bathroom', '123.0000', '517a272d70134d90b0513ca4fde0abfa.svg', '', 'house_removals', 'product', 0, NULL, NULL),
(50, 'Boxes & Packaging', '123.0000', '91f30d0a02252203c67d016d6b6c3fa6.svg', '', 'house_removals', 'product', 0, NULL, NULL),
(51, 'Single Bed & Mattress', '123.0000', 'no_image.png', NULL, 'house_removals', 'sub_product', 48, NULL, NULL),
(52, 'Small Mirror', '123.0000', 'no_image.png', NULL, 'house_removals', 'sub_product', 49, NULL, NULL),
(53, 'Small Box', '123.0000', 'no_image.png', NULL, 'house_removals', 'sub_product', 50, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sma_products`
--
ALTER TABLE `sma_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `id_2` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sma_products`
--
ALTER TABLE `sma_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
