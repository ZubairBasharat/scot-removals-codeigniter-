-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 03, 2020 at 08:23 PM
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
-- Table structure for table `sma_products_prices`
--

CREATE TABLE `sma_products_prices` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `ground_to_ground` decimal(25,4) NOT NULL DEFAULT '0.0000',
  `ground_to_first` decimal(25,4) NOT NULL DEFAULT '0.0000',
  `ground_to_second` decimal(25,4) NOT NULL DEFAULT '0.0000',
  `ground_to_third` decimal(25,4) NOT NULL DEFAULT '0.0000',
  `ground_to_fourth` decimal(25,4) NOT NULL DEFAULT '0.0000',
  `ground_to_fifth` decimal(25,4) NOT NULL DEFAULT '0.0000',
  `ground_to_sixth` decimal(25,4) NOT NULL DEFAULT '0.0000',
  `first_to_ground` decimal(25,4) NOT NULL DEFAULT '0.0000',
  `first_to_first` decimal(25,4) NOT NULL DEFAULT '0.0000',
  `first_to_second` decimal(25,4) NOT NULL DEFAULT '0.0000',
  `first_to_third` decimal(25,4) NOT NULL DEFAULT '0.0000',
  `first_to_fourth` decimal(25,4) NOT NULL DEFAULT '0.0000',
  `first_to_fifth` decimal(25,4) NOT NULL DEFAULT '0.0000',
  `first_to_sixth` decimal(25,4) NOT NULL DEFAULT '0.0000',
  `second_to_ground` decimal(25,4) NOT NULL DEFAULT '0.0000',
  `second_to_first` decimal(25,4) NOT NULL DEFAULT '0.0000',
  `second_to_second` decimal(25,4) NOT NULL DEFAULT '0.0000',
  `second_to_third` decimal(25,4) NOT NULL DEFAULT '0.0000',
  `second_to_fourth` decimal(25,4) NOT NULL DEFAULT '0.0000',
  `second_to_fifth` decimal(25,4) NOT NULL DEFAULT '0.0000',
  `second_to_sixth` decimal(25,4) NOT NULL DEFAULT '0.0000',
  `third_to_ground` decimal(25,4) NOT NULL DEFAULT '0.0000',
  `third_to_first` decimal(25,4) NOT NULL DEFAULT '0.0000',
  `third_to_second` decimal(25,4) NOT NULL DEFAULT '0.0000',
  `third_to_third` decimal(25,4) NOT NULL DEFAULT '0.0000',
  `third_to_fourth` decimal(25,4) NOT NULL DEFAULT '0.0000',
  `third_to_fifth` decimal(25,4) NOT NULL DEFAULT '0.0000',
  `third_to_sixth` decimal(25,4) NOT NULL DEFAULT '0.0000',
  `fourth_to_ground` decimal(25,4) NOT NULL DEFAULT '0.0000',
  `fourth_to_first` decimal(25,4) NOT NULL DEFAULT '0.0000',
  `fourth_to_second` decimal(25,4) NOT NULL DEFAULT '0.0000',
  `fourth_to_third` decimal(25,4) NOT NULL DEFAULT '0.0000',
  `fourth_to_fourth` decimal(25,4) NOT NULL DEFAULT '0.0000',
  `fourth_to_fifth` decimal(25,4) NOT NULL DEFAULT '0.0000',
  `fourth_to_sixth` decimal(25,4) NOT NULL DEFAULT '0.0000',
  `fifth_to_ground` decimal(25,4) NOT NULL DEFAULT '0.0000',
  `fifth_to_first` decimal(25,4) NOT NULL DEFAULT '0.0000',
  `fifth_to_second` decimal(25,4) NOT NULL DEFAULT '0.0000',
  `fifth_to_third` decimal(25,4) NOT NULL DEFAULT '0.0000',
  `fifth_to_fourth` decimal(25,4) NOT NULL DEFAULT '0.0000',
  `fifth_to_fifth` decimal(25,4) NOT NULL DEFAULT '0.0000',
  `fifth_to_sixth` decimal(25,4) NOT NULL DEFAULT '0.0000',
  `sixth_to_ground` decimal(25,4) NOT NULL DEFAULT '0.0000',
  `sixth_to_first` decimal(25,4) NOT NULL DEFAULT '0.0000',
  `sixth_to_second` decimal(25,4) NOT NULL DEFAULT '0.0000',
  `sixth_to_third` decimal(25,4) NOT NULL DEFAULT '0.0000',
  `sixth_to_fourth` decimal(25,4) NOT NULL DEFAULT '0.0000',
  `sixth_to_fifth` decimal(25,4) NOT NULL DEFAULT '0.0000',
  `sixth_to_sixth` decimal(25,4) NOT NULL DEFAULT '0.0000',
  `per_floor_price` decimal(25,4) NOT NULL DEFAULT '0.0000',
  `per_mile_price` decimal(25,4) NOT NULL DEFAULT '0.0000',
  `o_b_house_to_o_b_house` decimal(25,4) NOT NULL DEFAULT '0.0000',
  `o_b_house_to_t_b_house` decimal(25,4) NOT NULL DEFAULT '0.0000',
  `o_b_house_to_th_b_house` decimal(25,4) NOT NULL DEFAULT '0.0000',
  `o_b_house_to_fp_b_house` decimal(25,4) NOT NULL DEFAULT '0.0000',
  `o_b_house_to_storage_unit` decimal(25,4) NOT NULL DEFAULT '0.0000',
  `t_b_house_to_o_b_house` decimal(25,4) NOT NULL DEFAULT '0.0000',
  `t_b_house_to_t_b_house` decimal(25,4) NOT NULL DEFAULT '0.0000',
  `t_b_house_to_th_b_house` decimal(25,4) NOT NULL DEFAULT '0.0000',
  `t_b_house_to_fp_b_house` decimal(25,4) NOT NULL DEFAULT '0.0000',
  `t_b_house_to_storage_unit` decimal(25,4) NOT NULL DEFAULT '0.0000',
  `th_b_house_to_o_b_house` decimal(25,4) NOT NULL DEFAULT '0.0000',
  `th_b_house_to_t_b_house` decimal(25,4) NOT NULL DEFAULT '0.0000',
  `th_b_house_to_th_b_house` decimal(25,4) NOT NULL DEFAULT '0.0000',
  `th_b_house_to_fp_b_house` decimal(25,4) NOT NULL DEFAULT '0.0000',
  `th_b_house_to_storage_unit` decimal(25,4) NOT NULL DEFAULT '0.0000',
  `fp_b_house_to_o_b_house` decimal(25,4) NOT NULL DEFAULT '0.0000',
  `fp_b_house_to_t_b_house` decimal(25,4) NOT NULL DEFAULT '0.0000',
  `fp_b_house_to_th_b_house` decimal(25,4) NOT NULL DEFAULT '0.0000',
  `fp_b_house_to_fp_b_house` decimal(25,4) NOT NULL DEFAULT '0.0000',
  `fp_b_house_to_storage_unit` decimal(25,4) NOT NULL DEFAULT '0.0000',
  `storage_unit_to_o_b_house` decimal(25,4) NOT NULL DEFAULT '0.0000',
  `storage_unit_to_t_b_house` decimal(25,4) NOT NULL DEFAULT '0.0000',
  `storage_unit_to_th_b_house` decimal(25,4) NOT NULL DEFAULT '0.0000',
  `storage_unit_to_fp_b_house` decimal(25,4) NOT NULL DEFAULT '0.0000',
  `storage_unit_to_storage_unit` decimal(25,4) NOT NULL DEFAULT '0.0000'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sma_products_prices`
--

INSERT INTO `sma_products_prices` (`id`, `product_id`, `ground_to_ground`, `ground_to_first`, `ground_to_second`, `ground_to_third`, `ground_to_fourth`, `ground_to_fifth`, `ground_to_sixth`, `first_to_ground`, `first_to_first`, `first_to_second`, `first_to_third`, `first_to_fourth`, `first_to_fifth`, `first_to_sixth`, `second_to_ground`, `second_to_first`, `second_to_second`, `second_to_third`, `second_to_fourth`, `second_to_fifth`, `second_to_sixth`, `third_to_ground`, `third_to_first`, `third_to_second`, `third_to_third`, `third_to_fourth`, `third_to_fifth`, `third_to_sixth`, `fourth_to_ground`, `fourth_to_first`, `fourth_to_second`, `fourth_to_third`, `fourth_to_fourth`, `fourth_to_fifth`, `fourth_to_sixth`, `fifth_to_ground`, `fifth_to_first`, `fifth_to_second`, `fifth_to_third`, `fifth_to_fourth`, `fifth_to_fifth`, `fifth_to_sixth`, `sixth_to_ground`, `sixth_to_first`, `sixth_to_second`, `sixth_to_third`, `sixth_to_fourth`, `sixth_to_fifth`, `sixth_to_sixth`, `per_floor_price`, `per_mile_price`, `o_b_house_to_o_b_house`, `o_b_house_to_t_b_house`, `o_b_house_to_th_b_house`, `o_b_house_to_fp_b_house`, `o_b_house_to_storage_unit`, `t_b_house_to_o_b_house`, `t_b_house_to_t_b_house`, `t_b_house_to_th_b_house`, `t_b_house_to_fp_b_house`, `t_b_house_to_storage_unit`, `th_b_house_to_o_b_house`, `th_b_house_to_t_b_house`, `th_b_house_to_th_b_house`, `th_b_house_to_fp_b_house`, `th_b_house_to_storage_unit`, `fp_b_house_to_o_b_house`, `fp_b_house_to_t_b_house`, `fp_b_house_to_th_b_house`, `fp_b_house_to_fp_b_house`, `fp_b_house_to_storage_unit`, `storage_unit_to_o_b_house`, `storage_unit_to_t_b_house`, `storage_unit_to_th_b_house`, `storage_unit_to_fp_b_house`, `storage_unit_to_storage_unit`) VALUES
(1, 2, '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '1.0000', '2.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000'),
(5, 52, '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '0.0000', '0.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000'),
(6, 67, '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '1.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '1.0000', '2.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000'),
(7, 63, '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '1.0000', '2.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000'),
(8, 60, '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '1.0000', '2.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000'),
(9, 61, '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '1.0000', '2.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000'),
(10, 62, '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '1.0000', '2.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000'),
(11, 64, '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '1.0000', '2.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000'),
(12, 65, '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '2.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '1.0000', '2.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000'),
(13, 66, '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '1.0000', '2.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000'),
(14, 51, '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '0.0000', '0.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000'),
(15, 53, '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '0.0000', '0.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000'),
(16, 57, '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '0.0000', '0.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000'),
(17, 58, '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '0.0000', '0.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000'),
(18, 59, '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '0.0000', '0.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000'),
(19, 3, '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '1.0000', '2.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000'),
(20, 4, '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '1.0000', '2.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000'),
(21, 12, '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '1.0000', '2.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000'),
(22, 13, '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '1.0000', '2.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000'),
(23, 14, '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '1.0000', '2.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000'),
(24, 15, '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '1.0000', '2.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000'),
(25, 16, '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '1.0000', '2.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000'),
(26, 17, '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '1.0000', '2.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000'),
(27, 18, '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '1.0000', '2.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000'),
(28, 19, '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '1.0000', '2.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000'),
(29, 20, '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '1.0000', '2.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000'),
(30, 21, '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '1.0000', '2.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000'),
(31, 22, '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '1.0000', '2.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000'),
(32, 23, '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '1.0000', '2.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000'),
(33, 24, '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '1.0000', '2.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000'),
(34, 25, '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '1.0000', '2.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000'),
(35, 26, '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '1.0000', '2.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000'),
(36, 27, '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '1.0000', '2.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000'),
(37, 28, '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '1.0000', '2.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000'),
(38, 29, '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '1.0000', '2.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000'),
(39, 30, '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '1.0000', '2.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000'),
(40, 31, '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '1.0000', '2.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000'),
(41, 32, '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '1.0000', '2.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000'),
(42, 33, '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '1.0000', '2.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000'),
(43, 34, '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '1.0000', '2.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000'),
(44, 36, '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '1.0000', '2.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sma_products_prices`
--
ALTER TABLE `sma_products_prices`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sma_products_prices`
--
ALTER TABLE `sma_products_prices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;