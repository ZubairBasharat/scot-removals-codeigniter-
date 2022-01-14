-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 19, 2020 at 12:15 PM
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
  `font` varchar(55) DEFAULT NULL,
  `price_added` tinyint(1) NOT NULL DEFAULT '0',
  `slug` varchar(255) DEFAULT NULL,
  `order_by` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sma_products`
--

INSERT INTO `sma_products` (`id`, `name`, `price`, `image`, `details`, `product_type`, `type`, `parent`, `lift_option`, `font`, `price_added`, `slug`, `order_by`) VALUES
(1, 'Sofas', '123.0000', '962f6433949e5b1f1c0f37b8a2511d63.png', '', 'furniture_delivery', 'product', 0, NULL, NULL, 0, NULL, 0),
(2, 'Two Seater Sofa', '123.0000', 'no_image.png', NULL, 'furniture_delivery', 'sub_product', 1, NULL, NULL, 1, NULL, 0),
(3, 'Three Seater Sofa', '123.0000', 'no_image.png', NULL, 'furniture_delivery', 'sub_product', 1, NULL, NULL, 1, NULL, 0),
(4, 'Four Seater Sofa', '123.0000', 'no_image.png', NULL, 'furniture_delivery', 'sub_product', 1, NULL, NULL, 1, NULL, 0),
(5, 'Wardrobes', '123.0000', 'e4161d189d9c3e1ccfc6e34fd42aaa66.png', '<p>All Wardrobes</p>', 'furniture_delivery', 'product', 0, NULL, NULL, 0, NULL, 0),
(6, 'Boxes', '123.0000', '4e9c43605e533bf96567268bcb784258.png', '<p>All Boxes</p>', 'furniture_delivery', 'product', 0, NULL, NULL, 0, NULL, 0),
(7, 'Beds & Mattresses', '123.0000', 'd498d1f88f164bf40675c1d5ceeed7f4.png', '<p>All Beds & Mattresses</p>', 'furniture_delivery', 'product', 0, NULL, NULL, 0, NULL, 0),
(8, 'Tables', '123.0000', '883e3844ae511141d1ea192629b5ef61.png', '<p>All Tables</p>', 'furniture_delivery', 'product', 0, NULL, NULL, 0, NULL, 0),
(9, 'Televisions', '123.0000', '05ea9e7ce8b0fbd7ba8d5928d8621837.png', '<p>All Televisions</p>', 'furniture_delivery', 'product', 0, NULL, NULL, 0, NULL, 0),
(10, 'Clothing', '123.0000', '6759fc0b530540a81d9c6d3f4f4f00b3.png', '<p>All Clothing</p>', 'furniture_delivery', 'product', 0, NULL, NULL, 0, NULL, 0),
(11, 'Chairs', '123.0000', '784490a7ccb52dc39ae589f50f5759b7.png', '<p>All Chairs</p>', 'furniture_delivery', 'product', 0, NULL, NULL, 0, NULL, 0),
(12, 'Single Wardrobe', '123.0000', 'no_image.png', NULL, 'furniture_delivery', 'sub_product', 5, NULL, NULL, 1, NULL, 0),
(13, 'Double Wardrobe', '123.0000', 'no_image.png', NULL, 'furniture_delivery', 'sub_product', 5, NULL, NULL, 1, NULL, 0),
(14, 'Triple Wardrobe', '123.0000', 'no_image.png', NULL, 'furniture_delivery', 'sub_product', 5, NULL, NULL, 1, NULL, 0),
(15, 'Small Box', '123.0000', 'no_image.png', NULL, 'furniture_delivery', 'sub_product', 6, NULL, NULL, 1, NULL, 0),
(16, 'Medium Box', '123.0000', 'no_image.png', NULL, 'furniture_delivery', 'sub_product', 6, NULL, NULL, 1, NULL, 0),
(17, 'Large Box', '123.0000', 'no_image.png', NULL, 'furniture_delivery', 'sub_product', 6, NULL, NULL, 1, NULL, 0),
(18, 'Single Bed & Mattress', '123.0000', 'no_image.png', NULL, 'furniture_delivery', 'sub_product', 7, NULL, NULL, 1, NULL, 0),
(19, 'Double Bed & Mattress', '123.0000', 'no_image.png', NULL, 'furniture_delivery', 'sub_product', 7, NULL, NULL, 1, NULL, 0),
(20, 'Kingsize Bed & Mattress', '123.0000', 'no_image.png', NULL, 'furniture_delivery', 'sub_product', 7, NULL, NULL, 1, NULL, 0),
(21, 'Coffee Table', '123.0000', 'no_image.png', NULL, 'furniture_delivery', 'sub_product', 8, NULL, NULL, 1, NULL, 0),
(22, 'Bedside Table', '123.0000', 'no_image.png', NULL, 'furniture_delivery', 'sub_product', 8, NULL, NULL, 1, NULL, 0),
(23, 'Garden Table', '123.0000', 'no_image.png', NULL, 'furniture_delivery', 'sub_product', 8, NULL, NULL, 1, NULL, 0),
(24, '4 Seater Dining Table & Chairs', '123.0000', 'no_image.png', NULL, 'furniture_delivery', 'sub_product', 8, NULL, NULL, 1, NULL, 0),
(25, '6 Seater Dining Table & Chairs', '123.0000', 'no_image.png', NULL, 'furniture_delivery', 'sub_product', 8, NULL, NULL, 1, NULL, 0),
(26, 'Small Television/TV (Less than 30\")', '123.0000', 'no_image.png', NULL, 'furniture_delivery', 'sub_product', 9, NULL, NULL, 1, NULL, 0),
(27, 'Medium Television/TV (30\" to 40\")', '123.0000', 'no_image.png', NULL, 'furniture_delivery', 'sub_product', 9, NULL, NULL, 1, NULL, 0),
(28, 'Large Television/TV (Greater than 40\")', '123.0000', 'no_image.png', NULL, 'furniture_delivery', 'sub_product', 9, NULL, NULL, 1, NULL, 0),
(29, 'Small Bag', '123.0000', 'no_image.png', NULL, 'furniture_delivery', 'sub_product', 10, NULL, NULL, 1, NULL, 0),
(30, 'Large Bag', '123.0000', 'no_image.png', NULL, 'furniture_delivery', 'sub_product', 10, NULL, NULL, 1, NULL, 0),
(31, 'Suitcase', '123.0000', 'no_image.png', NULL, 'furniture_delivery', 'sub_product', 10, NULL, NULL, 1, NULL, 0),
(32, 'Box Of Clothes', '123.0000', 'no_image.png', NULL, 'furniture_delivery', 'sub_product', 10, NULL, NULL, 1, NULL, 0),
(33, 'Armchair', '123.0000', 'no_image.png', NULL, 'furniture_delivery', 'sub_product', 11, NULL, NULL, 1, NULL, 0),
(34, 'Dining Chair', '123.0000', 'no_image.png', NULL, 'furniture_delivery', 'sub_product', 11, NULL, NULL, 1, NULL, 0),
(36, 'Office Chair', '123.0000', 'no_image.png', NULL, 'furniture_delivery', 'sub_product', 11, NULL, NULL, 1, NULL, 0),
(37, '1 Bed House', '0.0000', 'no_image.png', '', 'house_removals', 'property', 1, 'No', NULL, 0, 'o_b_house', 0),
(38, '2 Bed House', '0.0000', 'no_image.png', '', 'house_removals', 'property', 1, 'No', NULL, 0, 't_b_house', 0),
(39, '3 Bed House', '0.0000', 'no_image.png', '', 'house_removals', 'property', 1, 'No', NULL, 0, 'th_b_house', 0),
(40, '4+ Bed House', '0.0000', 'no_image.png', '', 'house_removals', 'property', 1, 'No', NULL, 0, 'fp_b_house', 0),
(41, '1 Bed Flat', '0.0000', 'no_image.png', '', 'house_removals', 'property', 2, 'Yes', NULL, 0, 'o_b_flat', 0),
(42, '2 Bed Flat', '0.0000', 'no_image.png', '', 'house_removals', 'property', 2, 'Yes', NULL, 0, 't_b_flat', 0),
(43, '3 Bed Flat', '0.0000', 'no_image.png', '', 'house_removals', 'property', 2, 'Yes', NULL, 0, 'th_b_flat', 0),
(44, '4+ Bed Flat', '0.0000', 'no_image.png', '', 'house_removals', 'property', 2, 'Yes', NULL, 0, 'fp_b_flat', 0),
(45, 'Studio', '0.0000', 'no_image.png', '', 'house_removals', 'property', 3, 'Yes', NULL, 0, 'studio', 0),
(46, 'Storage Unit', '0.0000', 'no_image.png', '', 'house_removals', 'property', 3, 'No', NULL, 0, 'storage_unit', 0),
(47, 'Flatshare', '0.0000', 'no_image.png', '', 'house_removals', 'property', 3, 'Yes', NULL, 0, 'flat_share', 0),
(48, 'Bedrooms', '123.0000', '8ead0543c26b9b7b641b565f489067fe.svg', '', 'house_removals', 'product', 0, NULL, NULL, 0, NULL, 0),
(49, 'Bathroom', '123.0000', '517a272d70134d90b0513ca4fde0abfa.svg', '', 'house_removals', 'product', 0, NULL, NULL, 0, NULL, 0),
(50, 'Boxes & Packaging', '123.0000', '91f30d0a02252203c67d016d6b6c3fa6.svg', '', 'house_removals', 'product', 0, NULL, NULL, 0, NULL, 0),
(51, 'Single Bed & Mattress', '123.0000', 'no_image.png', NULL, 'house_removals', 'sub_product', 48, NULL, NULL, 1, NULL, 0),
(52, 'Small Mirror', '123.0000', 'no_image.png', NULL, 'house_removals', 'sub_product', 49, NULL, NULL, 1, NULL, 0),
(53, 'Small Box', '123.0000', 'no_image.png', NULL, 'house_removals', 'sub_product', 50, NULL, NULL, 1, NULL, 0),
(54, 'Living', '123.0000', '33da4a259380ff9fd1f1ad49fc193bf8.svg', '', 'house_removals', 'product', 0, NULL, NULL, 0, NULL, 0),
(55, 'Dining', '123.0000', '5916e3379523fc4d0ba8dfa2b5d2a94e.svg', '', 'house_removals', 'product', 0, NULL, NULL, 0, NULL, 0),
(56, 'Kitchen', '123.0000', 'e46ffa157b3765ae3e04fa5a1e36b130.svg', '', 'house_removals', 'product', 0, NULL, NULL, 0, NULL, 0),
(57, 'Two Seater Sofa', '123.0000', 'no_image.png', NULL, 'house_removals', 'sub_product', 54, NULL, NULL, 1, NULL, 0),
(58, 'Dining Chair', '123.0000', 'no_image.png', NULL, 'house_removals', 'sub_product', 55, NULL, NULL, 1, NULL, 0),
(59, 'Microwave Oven', '123.0000', 'no_image.png', NULL, 'house_removals', 'sub_product', 56, NULL, NULL, 1, NULL, 0),
(60, 'Piano1', '123.0000', 'f31efe54ef30eb852bac0d6d3e93e777.png', '', 'piano_transport', 'product', 0, NULL, NULL, 1, NULL, 0),
(61, 'Piano2', '123.0000', '5296c1a319283a7ff246e92f040900e8.jpg', '', 'piano_transport', 'product', 0, NULL, NULL, 1, NULL, 0),
(62, 'Piano3', '123.0000', '71de96af9daadba60c7d2797756dbb9e.png', '', 'piano_transport', 'product', 0, NULL, NULL, 1, NULL, 0),
(63, 'Piano4', '123.0000', '0e311452c506bfe40014791d49b265ed.png', '', 'piano_transport', 'product', 0, NULL, NULL, 1, NULL, 0),
(64, 'Piano5', '123.0000', '5a3ed40f49a97f2841b271029761ceca.png', '', 'piano_transport', 'product', 0, NULL, NULL, 1, NULL, 0),
(65, 'Crates', '123.0000', 'no_image.png', '', 'office_removals', 'product', 0, NULL, NULL, 1, NULL, 0),
(66, 'Chairs', '123.0000', 'no_image.png', '', 'office_removals', 'product', 0, NULL, NULL, 1, NULL, 0),
(67, 'Box Medium', '123.0000', 'no_image.png', '', 'office_removals', 'product', 0, NULL, NULL, 1, NULL, 0),
(68, 'Sofas', '123.0000', '962f6433949e5b1f1c0f37b8a2511d63.png', '', 'man_and_van', 'product', 0, NULL, NULL, 0, NULL, 0),
(69, 'Wardrobes', '123.0000', '962f6433949e5b1f1c0f37b8a2511d63.png', '', 'man_and_van', 'product', 0, NULL, NULL, 0, NULL, 0),
(70, 'Boxes', '123.0000', '962f6433949e5b1f1c0f37b8a2511d63.png', '', 'man_and_van', 'product', 0, NULL, NULL, 0, NULL, 0),
(71, 'Beds & Mattresses', '123.0000', '962f6433949e5b1f1c0f37b8a2511d63.png', '', 'man_and_van', 'product', 0, NULL, NULL, 0, NULL, 0),
(72, 'Tables', '123.0000', '962f6433949e5b1f1c0f37b8a2511d63.png', '', 'man_and_van', 'product', 0, NULL, NULL, 0, NULL, 0),
(73, 'Televisions', '123.0000', '962f6433949e5b1f1c0f37b8a2511d63.png', '', 'man_and_van', 'product', 0, NULL, NULL, 0, NULL, 0),
(74, 'Clothing', '123.0000', '962f6433949e5b1f1c0f37b8a2511d63.png', '', 'man_and_van', 'product', 0, NULL, NULL, 0, NULL, 0),
(75, 'Chairs', '123.0000', '962f6433949e5b1f1c0f37b8a2511d63.png', '', 'man_and_van', 'product', 0, NULL, NULL, 0, NULL, 0),
(76, 'Four Seater Sofa', '123.0000', 'no_image.png', NULL, 'man_and_van', 'sub_product', 68, NULL, NULL, 1, NULL, 0),
(77, 'Three Seater Sofa', '123.0000', 'no_image.png', NULL, 'man_and_van', 'sub_product', 68, NULL, NULL, 1, NULL, 0),
(78, 'Two Seater Sofa', '123.0000', 'no_image.png', NULL, 'man_and_van', 'sub_product', 68, NULL, NULL, 1, NULL, 0),
(79, 'Triple Wardrobe', '123.0000', 'no_image.png', NULL, 'man_and_van', 'sub_product', 69, NULL, NULL, 1, NULL, 0),
(80, 'Double Wardrobe', '123.0000', 'no_image.png', NULL, 'man_and_van', 'sub_product', 69, NULL, NULL, 1, NULL, 0),
(81, 'Single Wardrobe', '123.0000', 'no_image.png', NULL, 'man_and_van', 'sub_product', 69, NULL, NULL, 1, NULL, 0),
(82, 'Large Box', '123.0000', 'no_image.png', NULL, 'man_and_van', 'sub_product', 70, NULL, NULL, 1, NULL, 0),
(83, 'Medium Box', '123.0000', 'no_image.png', NULL, 'man_and_van', 'sub_product', 70, NULL, NULL, 1, NULL, 0),
(84, 'Small Box', '123.0000', 'no_image.png', NULL, 'man_and_van', 'sub_product', 70, NULL, NULL, 1, NULL, 0),
(85, 'Kingsize Bed & Mattress', '123.0000', 'no_image.png', NULL, 'man_and_van', 'sub_product', 71, NULL, NULL, 1, NULL, 0),
(86, 'Double Bed & Mattress', '123.0000', 'no_image.png', NULL, 'man_and_van', 'sub_product', 71, NULL, NULL, 1, NULL, 0),
(87, 'Single Bed & Mattress', '123.0000', 'no_image.png', NULL, 'man_and_van', 'sub_product', 71, NULL, NULL, 1, NULL, 0),
(88, '6 Seater Dining Table & Chairs', '123.0000', 'no_image.png', NULL, 'man_and_van', 'sub_product', 72, NULL, NULL, 1, NULL, 0),
(89, '4 Seater Dining Table & Chairs', '123.0000', 'no_image.png', NULL, 'man_and_van', 'sub_product', 72, NULL, NULL, 1, NULL, 0),
(90, 'Garden Table', '123.0000', 'no_image.png', NULL, 'man_and_van', 'sub_product', 72, NULL, NULL, 1, NULL, 0),
(91, 'Bedside Table', '123.0000', 'no_image.png', NULL, 'man_and_van', 'sub_product', 72, NULL, NULL, 1, NULL, 0),
(92, 'Coffee Table', '123.0000', 'no_image.png', NULL, 'man_and_van', 'sub_product', 72, NULL, NULL, 1, NULL, 0),
(93, 'Large Television/TV (Greater than 40\")', '123.0000', 'no_image.png', NULL, 'man_and_van', 'sub_product', 73, NULL, NULL, 1, NULL, 0),
(94, 'Medium Television/TV (30\" to 40\")', '123.0000', 'no_image.png', NULL, 'man_and_van', 'sub_product', 73, NULL, NULL, 1, NULL, 0),
(95, 'Small Television/TV (Less than 30\")', '123.0000', 'no_image.png', NULL, 'man_and_van', 'sub_product', 73, NULL, NULL, 1, NULL, 0),
(96, 'Box Of Clothes', '123.0000', 'no_image.png', NULL, 'man_and_van', 'sub_product', 74, NULL, NULL, 1, NULL, 0),
(97, 'Suitcase', '123.0000', 'no_image.png', NULL, 'man_and_van', 'sub_product', 74, NULL, NULL, 1, NULL, 0),
(98, 'Large Bag', '123.0000', 'no_image.png', NULL, 'man_and_van', 'sub_product', 74, NULL, NULL, 1, NULL, 0),
(99, 'Small Bag', '123.0000', 'no_image.png', NULL, 'man_and_van', 'sub_product', 74, NULL, NULL, 1, NULL, 0),
(100, 'Office Chair', '123.0000', 'no_image.png', NULL, 'man_and_van', 'sub_product', 75, NULL, NULL, 1, NULL, 0),
(101, 'Dining Chair', '123.0000', 'no_image.png', NULL, 'man_and_van', 'sub_product', 75, NULL, NULL, 1, NULL, 0),
(102, 'Armchair', '123.0000', 'no_image.png', NULL, 'man_and_van', 'sub_product', 75, NULL, NULL, 1, NULL, 0);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
