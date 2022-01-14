-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 05, 2020 at 08:06 AM
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
-- Table structure for table `sma_addresses`
--

CREATE TABLE `sma_addresses` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `line1` varchar(50) DEFAULT NULL,
  `line2` varchar(50) DEFAULT NULL,
  `city` text,
  `postal_code` varchar(20) DEFAULT NULL,
  `state` varchar(25) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `lat` text,
  `lon` text,
  `name` varchar(200) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sma_addresses`
--

INSERT INTO `sma_addresses` (`id`, `company_id`, `line1`, `line2`, `city`, `postal_code`, `state`, `country`, `lat`, `lon`, `name`, `phone`, `updated_at`) VALUES
(14, 7, NULL, NULL, 'Minhas Street, Noor Pura', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-04-21 05:35:40'),
(17, 11, NULL, NULL, 'Minhas Street', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-04-21 08:21:57'),
(18, 11, NULL, NULL, 'Minhas 4', NULL, NULL, NULL, NULL, NULL, 'Ali', '444', '2020-04-21 08:40:03'),
(19, 11, NULL, NULL, 'Minhas St, Civil Lines, Gujranwala, Punjab, Pakistan', NULL, NULL, NULL, '32.1793651', '74.1997902', 'Atta Ur Rehman 1', '3213444', '2020-04-22 08:51:47'),
(20, 12, NULL, NULL, 'Minhas St, Civil Lines, Gujranwala, Punjab, Pakistan', NULL, NULL, NULL, '32.1793578', '74.1998682', 'Ebad', '0456789', '2020-04-22 09:11:53'),
(21, 11, NULL, NULL, 'Minhas St, Civil Lines, Gujranwala, Punjab, Pakistan', NULL, NULL, NULL, '32.179417', '74.1997617', 'Atta Ur Rehman', '3213', '2020-04-23 06:55:57'),
(22, 11, NULL, NULL, 'Minhas St, Civil Lines, Gujranwala, Punjab, Pakistan', NULL, NULL, NULL, '32.1793954', '74.1997643', 'Atta Ur Rehman', '3213', '2020-04-24 05:39:05'),
(23, 14, NULL, NULL, 'Minhas St, Civil Lines, Gujranwala, Punjab, Pakistan', NULL, NULL, NULL, '32.179298800000005', '74.1997992', 'shary', '1111', '2020-04-24 06:20:52'),
(24, 14, NULL, NULL, 'Minhas St, Civil Lines, Gujranwala, Punjab, Pakistan', NULL, NULL, NULL, '32.1793492', '74.1997415', 'shary', '1111', '2020-04-24 18:20:50');

-- --------------------------------------------------------

--
-- Table structure for table `sma_api_keys`
--

CREATE TABLE `sma_api_keys` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `reference` varchar(40) NOT NULL,
  `key` varchar(40) NOT NULL,
  `level` int(2) NOT NULL,
  `ignore_limits` tinyint(1) NOT NULL DEFAULT '0',
  `is_private_key` tinyint(1) NOT NULL DEFAULT '0',
  `ip_addresses` text,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sma_api_keys`
--

INSERT INTO `sma_api_keys` (`id`, `user_id`, `reference`, `key`, `level`, `ignore_limits`, `is_private_key`, `ip_addresses`, `date_created`) VALUES
(1, 5, 'dev', '0kks8oswoksockoo4csg0cc44k8s4gw40s04448o', 2, 0, 0, '', 1584468280);

-- --------------------------------------------------------

--
-- Table structure for table `sma_api_limits`
--

CREATE TABLE `sma_api_limits` (
  `id` int(11) NOT NULL,
  `uri` varchar(255) NOT NULL,
  `count` int(10) NOT NULL,
  `hour_started` int(11) NOT NULL,
  `api_key` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sma_api_limits`
--

INSERT INTO `sma_api_limits` (`id`, `uri`, `count`, `hour_started`, `api_key`) VALUES
(1, 'uri:api/v1/products/index:get', 8, 1587718413, '0kks8oswoksockoo4csg0cc44k8s4gw40s04448o'),
(2, 'uri:api/v1/categories/index:get', 8, 1586644086, '0kks8oswoksockoo4csg0cc44k8s4gw40s04448o'),
(3, 'uri:api/v1/Companies/index:get', 4, 1586643860, '0kks8oswoksockoo4csg0cc44k8s4gw40s04448o'),
(4, 'uri:api/v1/sales/index:get', 15, 1586670921, '0kks8oswoksockoo4csg0cc44k8s4gw40s04448o'),
(5, 'uri:api/v1/Cart/index:get', 2, 1587718698, '0kks8oswoksockoo4csg0cc44k8s4gw40s04448o'),
(6, 'uri:api/v1/Quotes/index:get', 1, 1585852336, '0kks8oswoksockoo4csg0cc44k8s4gw40s04448o');

-- --------------------------------------------------------

--
-- Table structure for table `sma_api_logs`
--

CREATE TABLE `sma_api_logs` (
  `id` int(11) NOT NULL,
  `uri` varchar(255) NOT NULL,
  `method` varchar(6) NOT NULL,
  `params` text,
  `api_key` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `time` int(11) NOT NULL,
  `rtime` float DEFAULT NULL,
  `authorized` varchar(1) NOT NULL,
  `response_code` smallint(3) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sma_api_logs`
--

INSERT INTO `sma_api_logs` (`id`, `uri`, `method`, `params`, `api_key`, `ip_address`, `time`, `rtime`, `authorized`, `response_code`) VALUES
(1, 'api/v1/products', 'get', 'a:14:{s:7:\"api-key\";s:40:\"0kks8oswoksockoo4csg0cc44k8s4gw40s04448o\";s:7:\"include\";s:15:\"photos,category\";s:5:\"start\";s:1:\"1\";s:5:\"limit\";s:2:\"10\";s:4:\"lang\";s:6:\"arabic\";s:11:\"customer_id\";s:2:\"11\";s:10:\"User-Agent\";s:21:\"PostmanRuntime/7.24.1\";s:6:\"Accept\";s:3:\"*/*\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:13:\"Postman-Token\";s:36:\"1a5c20d1-783e-4667-b650-421871cd069a\";s:4:\"Host\";s:9:\"localhost\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:10:\"Connection\";s:10:\"keep-alive\";s:6:\"Cookie\";s:44:\"sma_cart_id=45c1390cc9b7a32d5e600a0b9dbba9d1\";}', '0kks8oswoksockoo4csg0cc44k8s4gw40s04448o', '::1', 1587481257, 0.067874, '1', 200),
(2, 'api/v1/products', 'get', 'a:14:{s:7:\"api-key\";s:40:\"0kks8oswoksockoo4csg0cc44k8s4gw40s04448o\";s:7:\"include\";s:15:\"photos,category\";s:5:\"start\";s:1:\"1\";s:5:\"limit\";s:2:\"10\";s:4:\"lang\";s:6:\"arabic\";s:11:\"customer_id\";s:2:\"11\";s:10:\"User-Agent\";s:21:\"PostmanRuntime/7.24.1\";s:6:\"Accept\";s:3:\"*/*\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:13:\"Postman-Token\";s:36:\"0f4b6120-2b70-4970-ac5a-77184da94991\";s:4:\"Host\";s:9:\"localhost\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:10:\"Connection\";s:10:\"keep-alive\";s:6:\"Cookie\";s:134:\"sma_cart_id=45c1390cc9b7a32d5e600a0b9dbba9d1; sma_token_cookie=dbc292157f5a6422d7d65950d80d6f71; sess=lu6g0kfro6nfae41l5l5tfo60rggu65c\";}', '0kks8oswoksockoo4csg0cc44k8s4gw40s04448o', '::1', 1587481270, 0.0312109, '1', 0),
(3, 'api/v1/products', 'get', 'a:14:{s:7:\"api-key\";s:40:\"0kks8oswoksockoo4csg0cc44k8s4gw40s04448o\";s:7:\"include\";s:15:\"photos,category\";s:5:\"start\";s:1:\"1\";s:5:\"limit\";s:2:\"10\";s:4:\"lang\";s:6:\"arabic\";s:11:\"customer_id\";s:2:\"11\";s:10:\"User-Agent\";s:21:\"PostmanRuntime/7.24.1\";s:6:\"Accept\";s:3:\"*/*\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:13:\"Postman-Token\";s:36:\"70b9c1d1-2901-4fdc-8957-14e773c6309e\";s:4:\"Host\";s:9:\"localhost\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:10:\"Connection\";s:10:\"keep-alive\";s:6:\"Cookie\";s:134:\"sma_cart_id=45c1390cc9b7a32d5e600a0b9dbba9d1; sma_token_cookie=dbc292157f5a6422d7d65950d80d6f71; sess=lu6g0kfro6nfae41l5l5tfo60rggu65c\";}', '0kks8oswoksockoo4csg0cc44k8s4gw40s04448o', '::1', 1587481567, 0.0379529, '1', 0),
(4, 'api/v1/Cart', 'get', 'a:22:{s:7:\"api-key\";s:40:\"0kks8oswoksockoo4csg0cc44k8s4gw40s04448o\";s:9:\"fcm_token\";s:5:\"fcm11\";s:3:\"add\";s:1:\"1\";s:4:\"lang\";s:6:\"arabic\";s:10:\"product_id\";s:3:\"138\";s:8:\"quantity\";s:1:\"2\";s:3:\"lat\";s:3:\"001\";s:3:\"lon\";s:3:\"002\";s:14:\"shipping_phone\";s:4:\"0345\";s:13:\"shipping_city\";s:3:\"Guj\";s:14:\"shipping_state\";s:6:\"Punjab\";s:16:\"shipping_country\";s:8:\"Pakistan\";s:7:\"comment\";s:27:\"This is order comment brooo\";s:2:\"id\";s:2:\"10\";s:10:\"User-Agent\";s:21:\"PostmanRuntime/7.24.1\";s:6:\"Accept\";s:3:\"*/*\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:13:\"Postman-Token\";s:36:\"8bd78097-17ff-45b5-a2bd-2c55c115b815\";s:4:\"Host\";s:9:\"localhost\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:10:\"Connection\";s:10:\"keep-alive\";s:6:\"Cookie\";s:134:\"sma_cart_id=45c1390cc9b7a32d5e600a0b9dbba9d1; sma_token_cookie=dbc292157f5a6422d7d65950d80d6f71; sess=sv649tkf6cnvcte8lmj54jjfdvqu9qeo\";}', '0kks8oswoksockoo4csg0cc44k8s4gw40s04448o', '::1', 1587481623, 0.050601, '1', 0),
(5, 'api/v1/Cart', 'get', 'a:22:{s:7:\"api-key\";s:40:\"0kks8oswoksockoo4csg0cc44k8s4gw40s04448o\";s:9:\"fcm_token\";s:5:\"fcm11\";s:3:\"add\";s:1:\"1\";s:4:\"lang\";s:6:\"arabic\";s:10:\"product_id\";s:3:\"138\";s:8:\"quantity\";s:1:\"2\";s:3:\"lat\";s:3:\"001\";s:3:\"lon\";s:3:\"002\";s:14:\"shipping_phone\";s:4:\"0345\";s:13:\"shipping_city\";s:3:\"Guj\";s:14:\"shipping_state\";s:6:\"Punjab\";s:16:\"shipping_country\";s:8:\"Pakistan\";s:7:\"comment\";s:27:\"This is order comment brooo\";s:2:\"id\";s:2:\"10\";s:10:\"User-Agent\";s:21:\"PostmanRuntime/7.24.1\";s:6:\"Accept\";s:3:\"*/*\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:13:\"Postman-Token\";s:36:\"146e7d7c-470f-47a8-8102-9b4005d4a5da\";s:4:\"Host\";s:9:\"localhost\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:10:\"Connection\";s:10:\"keep-alive\";s:6:\"Cookie\";s:134:\"sma_cart_id=45c1390cc9b7a32d5e600a0b9dbba9d1; sma_token_cookie=dbc292157f5a6422d7d65950d80d6f71; sess=sv649tkf6cnvcte8lmj54jjfdvqu9qeo\";}', '0kks8oswoksockoo4csg0cc44k8s4gw40s04448o', '::1', 1587481632, 0.0334771, '1', 0),
(6, 'api/v1/Cart', 'get', 'a:21:{s:7:\"api-key\";s:40:\"0kks8oswoksockoo4csg0cc44k8s4gw40s04448o\";s:9:\"fcm_token\";s:5:\"fcm11\";s:4:\"lang\";s:6:\"arabic\";s:10:\"product_id\";s:3:\"138\";s:8:\"quantity\";s:1:\"2\";s:3:\"lat\";s:3:\"001\";s:3:\"lon\";s:3:\"002\";s:14:\"shipping_phone\";s:4:\"0345\";s:13:\"shipping_city\";s:3:\"Guj\";s:14:\"shipping_state\";s:6:\"Punjab\";s:16:\"shipping_country\";s:8:\"Pakistan\";s:7:\"comment\";s:27:\"This is order comment brooo\";s:2:\"id\";s:2:\"10\";s:10:\"User-Agent\";s:21:\"PostmanRuntime/7.24.1\";s:6:\"Accept\";s:3:\"*/*\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:13:\"Postman-Token\";s:36:\"7397b076-70e2-450f-b9bc-03dbe5069ddc\";s:4:\"Host\";s:9:\"localhost\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:10:\"Connection\";s:10:\"keep-alive\";s:6:\"Cookie\";s:134:\"sma_cart_id=45c1390cc9b7a32d5e600a0b9dbba9d1; sma_token_cookie=dbc292157f5a6422d7d65950d80d6f71; sess=sv649tkf6cnvcte8lmj54jjfdvqu9qeo\";}', '0kks8oswoksockoo4csg0cc44k8s4gw40s04448o', '::1', 1587481638, 0.0674419, '1', 200),
(7, 'api/v1/products', 'get', 'a:14:{s:7:\"api-key\";s:40:\"0kks8oswoksockoo4csg0cc44k8s4gw40s04448o\";s:7:\"include\";s:15:\"photos,category\";s:5:\"start\";s:1:\"1\";s:5:\"limit\";s:2:\"10\";s:4:\"lang\";s:6:\"arabic\";s:11:\"customer_id\";s:2:\"11\";s:10:\"User-Agent\";s:21:\"PostmanRuntime/7.24.1\";s:6:\"Accept\";s:3:\"*/*\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:13:\"Postman-Token\";s:36:\"cfb72353-5da4-411d-b462-a992fb88449b\";s:4:\"Host\";s:9:\"localhost\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:10:\"Connection\";s:10:\"keep-alive\";s:6:\"Cookie\";s:134:\"sma_cart_id=45c1390cc9b7a32d5e600a0b9dbba9d1; sma_token_cookie=dbc292157f5a6422d7d65950d80d6f71; sess=sv649tkf6cnvcte8lmj54jjfdvqu9qeo\";}', '0kks8oswoksockoo4csg0cc44k8s4gw40s04448o', '::1', 1587481661, 0.0327868, '1', 0),
(8, 'api/v1/products', 'get', 'a:14:{s:7:\"api-key\";s:40:\"0kks8oswoksockoo4csg0cc44k8s4gw40s04448o\";s:7:\"include\";s:15:\"photos,category\";s:5:\"start\";s:1:\"1\";s:5:\"limit\";s:2:\"10\";s:4:\"lang\";s:6:\"arabic\";s:11:\"customer_id\";s:2:\"11\";s:10:\"User-Agent\";s:21:\"PostmanRuntime/7.24.1\";s:6:\"Accept\";s:3:\"*/*\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:13:\"Postman-Token\";s:36:\"68627661-6e69-4a2e-a808-1ed7ae1ff4b1\";s:4:\"Host\";s:9:\"localhost\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:10:\"Connection\";s:10:\"keep-alive\";s:6:\"Cookie\";s:134:\"sma_cart_id=45c1390cc9b7a32d5e600a0b9dbba9d1; sma_token_cookie=dbc292157f5a6422d7d65950d80d6f71; sess=sv649tkf6cnvcte8lmj54jjfdvqu9qeo\";}', '0kks8oswoksockoo4csg0cc44k8s4gw40s04448o', '::1', 1587481706, 0.0383739, '1', 0),
(9, 'api/v1/products', 'get', 'a:14:{s:7:\"api-key\";s:40:\"0kks8oswoksockoo4csg0cc44k8s4gw40s04448o\";s:7:\"include\";s:15:\"photos,category\";s:5:\"start\";s:1:\"1\";s:5:\"limit\";s:2:\"10\";s:4:\"lang\";s:6:\"arabic\";s:11:\"customer_id\";s:2:\"11\";s:10:\"User-Agent\";s:21:\"PostmanRuntime/7.24.1\";s:6:\"Accept\";s:3:\"*/*\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:13:\"Postman-Token\";s:36:\"8e2693c8-5ab3-4b67-ba11-f9cdb60c1eef\";s:4:\"Host\";s:9:\"localhost\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:10:\"Connection\";s:10:\"keep-alive\";s:6:\"Cookie\";s:134:\"sma_cart_id=45c1390cc9b7a32d5e600a0b9dbba9d1; sma_token_cookie=dbc292157f5a6422d7d65950d80d6f71; sess=sv649tkf6cnvcte8lmj54jjfdvqu9qeo\";}', '0kks8oswoksockoo4csg0cc44k8s4gw40s04448o', '::1', 1587481723, 0.286929, '1', 0),
(10, 'api/v1/products', 'get', 'a:14:{s:7:\"api-key\";s:40:\"0kks8oswoksockoo4csg0cc44k8s4gw40s04448o\";s:7:\"include\";s:15:\"photos,category\";s:5:\"start\";s:1:\"1\";s:5:\"limit\";s:2:\"10\";s:4:\"lang\";s:6:\"arabic\";s:11:\"customer_id\";s:2:\"11\";s:10:\"User-Agent\";s:21:\"PostmanRuntime/7.24.1\";s:6:\"Accept\";s:3:\"*/*\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:13:\"Postman-Token\";s:36:\"e193d277-8ec7-4a2d-b025-8146d399b5b1\";s:4:\"Host\";s:9:\"localhost\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:10:\"Connection\";s:10:\"keep-alive\";s:6:\"Cookie\";s:134:\"sma_cart_id=45c1390cc9b7a32d5e600a0b9dbba9d1; sma_token_cookie=dbc292157f5a6422d7d65950d80d6f71; sess=sv649tkf6cnvcte8lmj54jjfdvqu9qeo\";}', '0kks8oswoksockoo4csg0cc44k8s4gw40s04448o', '::1', 1587481766, 0.0362899, '1', 0),
(11, 'api/v1/products', 'get', 'a:14:{s:7:\"api-key\";s:40:\"0kks8oswoksockoo4csg0cc44k8s4gw40s04448o\";s:7:\"include\";s:15:\"photos,category\";s:5:\"start\";s:1:\"1\";s:5:\"limit\";s:2:\"10\";s:4:\"lang\";s:6:\"arabic\";s:11:\"customer_id\";s:2:\"11\";s:10:\"User-Agent\";s:21:\"PostmanRuntime/7.24.1\";s:6:\"Accept\";s:3:\"*/*\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:13:\"Postman-Token\";s:36:\"c9a59c88-3b4b-468e-b14c-3bbb2a1ed2bc\";s:4:\"Host\";s:9:\"localhost\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:10:\"Connection\";s:10:\"keep-alive\";s:6:\"Cookie\";s:134:\"sma_cart_id=45c1390cc9b7a32d5e600a0b9dbba9d1; sma_token_cookie=dbc292157f5a6422d7d65950d80d6f71; sess=sv649tkf6cnvcte8lmj54jjfdvqu9qeo\";}', '0kks8oswoksockoo4csg0cc44k8s4gw40s04448o', '::1', 1587481777, 0.0271058, '1', 0),
(12, 'api/v1/products', 'get', 'a:14:{s:7:\"api-key\";s:40:\"0kks8oswoksockoo4csg0cc44k8s4gw40s04448o\";s:7:\"include\";s:15:\"photos,category\";s:5:\"start\";s:1:\"1\";s:5:\"limit\";s:2:\"10\";s:4:\"lang\";s:6:\"arabic\";s:11:\"customer_id\";s:2:\"11\";s:10:\"User-Agent\";s:21:\"PostmanRuntime/7.24.1\";s:6:\"Accept\";s:3:\"*/*\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:13:\"Postman-Token\";s:36:\"3ae5058b-4efe-4e9e-a390-43d31adc97dc\";s:4:\"Host\";s:9:\"localhost\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:10:\"Connection\";s:10:\"keep-alive\";s:6:\"Cookie\";s:134:\"sma_cart_id=45c1390cc9b7a32d5e600a0b9dbba9d1; sma_token_cookie=dbc292157f5a6422d7d65950d80d6f71; sess=sv649tkf6cnvcte8lmj54jjfdvqu9qeo\";}', '0kks8oswoksockoo4csg0cc44k8s4gw40s04448o', '::1', 1587481791, 0.029084, '1', 0),
(13, 'api/v1/products', 'get', 'a:14:{s:7:\"api-key\";s:40:\"0kks8oswoksockoo4csg0cc44k8s4gw40s04448o\";s:7:\"include\";s:15:\"photos,category\";s:5:\"start\";s:1:\"1\";s:5:\"limit\";s:2:\"10\";s:4:\"lang\";s:6:\"arabic\";s:11:\"customer_id\";s:2:\"11\";s:10:\"User-Agent\";s:21:\"PostmanRuntime/7.24.1\";s:6:\"Accept\";s:3:\"*/*\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:13:\"Postman-Token\";s:36:\"7fdbae4b-09c8-4858-b3b0-ae26b37694ac\";s:4:\"Host\";s:9:\"localhost\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:10:\"Connection\";s:10:\"keep-alive\";s:6:\"Cookie\";s:134:\"sma_cart_id=45c1390cc9b7a32d5e600a0b9dbba9d1; sma_token_cookie=dbc292157f5a6422d7d65950d80d6f71; sess=sv649tkf6cnvcte8lmj54jjfdvqu9qeo\";}', '0kks8oswoksockoo4csg0cc44k8s4gw40s04448o', '::1', 1587481805, 0.0373421, '1', 0),
(14, 'api/v1/products', 'get', 'a:14:{s:7:\"api-key\";s:40:\"0kks8oswoksockoo4csg0cc44k8s4gw40s04448o\";s:7:\"include\";s:15:\"photos,category\";s:5:\"start\";s:1:\"1\";s:5:\"limit\";s:2:\"10\";s:4:\"lang\";s:6:\"arabic\";s:11:\"customer_id\";s:2:\"11\";s:10:\"User-Agent\";s:21:\"PostmanRuntime/7.24.1\";s:6:\"Accept\";s:3:\"*/*\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:13:\"Postman-Token\";s:36:\"8685df63-a07f-4f7d-84d7-c6d622366388\";s:4:\"Host\";s:9:\"localhost\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:10:\"Connection\";s:10:\"keep-alive\";s:6:\"Cookie\";s:134:\"sma_cart_id=45c1390cc9b7a32d5e600a0b9dbba9d1; sma_token_cookie=dbc292157f5a6422d7d65950d80d6f71; sess=sv649tkf6cnvcte8lmj54jjfdvqu9qeo\";}', '0kks8oswoksockoo4csg0cc44k8s4gw40s04448o', '::1', 1587481871, 0.0902891, '1', 0),
(15, 'api/v1/products', 'get', 'a:14:{s:7:\"api-key\";s:40:\"0kks8oswoksockoo4csg0cc44k8s4gw40s04448o\";s:7:\"include\";s:15:\"photos,category\";s:5:\"start\";s:1:\"1\";s:5:\"limit\";s:2:\"10\";s:4:\"lang\";s:6:\"arabic\";s:11:\"customer_id\";s:2:\"11\";s:10:\"User-Agent\";s:21:\"PostmanRuntime/7.24.1\";s:6:\"Accept\";s:3:\"*/*\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:13:\"Postman-Token\";s:36:\"188cba40-2c6d-4e6a-9135-8fe9f43f71e3\";s:4:\"Host\";s:9:\"localhost\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:10:\"Connection\";s:10:\"keep-alive\";s:6:\"Cookie\";s:134:\"sma_cart_id=45c1390cc9b7a32d5e600a0b9dbba9d1; sma_token_cookie=dbc292157f5a6422d7d65950d80d6f71; sess=ml7feb61rcrvflh9hrgt1upj975qh5j7\";}', '0kks8oswoksockoo4csg0cc44k8s4gw40s04448o', '::1', 1587481898, 0.0378079, '1', 0),
(16, 'api/v1/products', 'get', 'a:14:{s:7:\"api-key\";s:40:\"0kks8oswoksockoo4csg0cc44k8s4gw40s04448o\";s:7:\"include\";s:15:\"photos,category\";s:5:\"start\";s:1:\"1\";s:5:\"limit\";s:2:\"10\";s:4:\"lang\";s:6:\"arabic\";s:11:\"customer_id\";s:2:\"11\";s:10:\"User-Agent\";s:21:\"PostmanRuntime/7.24.1\";s:6:\"Accept\";s:3:\"*/*\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:13:\"Postman-Token\";s:36:\"9176db31-11e3-4e4c-8eb6-f451c1589916\";s:4:\"Host\";s:9:\"localhost\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:10:\"Connection\";s:10:\"keep-alive\";s:6:\"Cookie\";s:134:\"sma_cart_id=45c1390cc9b7a32d5e600a0b9dbba9d1; sma_token_cookie=dbc292157f5a6422d7d65950d80d6f71; sess=ml7feb61rcrvflh9hrgt1upj975qh5j7\";}', '0kks8oswoksockoo4csg0cc44k8s4gw40s04448o', '::1', 1587481991, 0.0501771, '1', 200),
(17, 'api/v1/Cart', 'get', 'a:22:{s:7:\"api-key\";s:40:\"0kks8oswoksockoo4csg0cc44k8s4gw40s04448o\";s:9:\"fcm_token\";s:5:\"fcm11\";s:3:\"add\";s:1:\"1\";s:4:\"lang\";s:6:\"arabic\";s:10:\"product_id\";s:3:\"139\";s:8:\"quantity\";s:1:\"2\";s:3:\"lat\";s:3:\"001\";s:3:\"lon\";s:3:\"002\";s:14:\"shipping_phone\";s:4:\"0345\";s:13:\"shipping_city\";s:3:\"Guj\";s:14:\"shipping_state\";s:6:\"Punjab\";s:16:\"shipping_country\";s:8:\"Pakistan\";s:7:\"comment\";s:27:\"This is order comment brooo\";s:2:\"id\";s:2:\"10\";s:10:\"User-Agent\";s:21:\"PostmanRuntime/7.24.1\";s:6:\"Accept\";s:3:\"*/*\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:13:\"Postman-Token\";s:36:\"dafccb6b-be1d-4fc8-9731-4ab89d3c390e\";s:4:\"Host\";s:9:\"localhost\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:10:\"Connection\";s:10:\"keep-alive\";s:6:\"Cookie\";s:134:\"sma_cart_id=45c1390cc9b7a32d5e600a0b9dbba9d1; sma_token_cookie=dbc292157f5a6422d7d65950d80d6f71; sess=ml7feb61rcrvflh9hrgt1upj975qh5j7\";}', '0kks8oswoksockoo4csg0cc44k8s4gw40s04448o', '::1', 1587482700, 0.034085, '1', 0),
(18, 'api/v1/Cart', 'get', 'a:21:{s:7:\"api-key\";s:40:\"0kks8oswoksockoo4csg0cc44k8s4gw40s04448o\";s:9:\"fcm_token\";s:5:\"fcm11\";s:4:\"lang\";s:6:\"arabic\";s:10:\"product_id\";s:3:\"139\";s:8:\"quantity\";s:1:\"2\";s:3:\"lat\";s:3:\"001\";s:3:\"lon\";s:3:\"002\";s:14:\"shipping_phone\";s:4:\"0345\";s:13:\"shipping_city\";s:3:\"Guj\";s:14:\"shipping_state\";s:6:\"Punjab\";s:16:\"shipping_country\";s:8:\"Pakistan\";s:7:\"comment\";s:27:\"This is order comment brooo\";s:2:\"id\";s:2:\"10\";s:10:\"User-Agent\";s:21:\"PostmanRuntime/7.24.1\";s:6:\"Accept\";s:3:\"*/*\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:13:\"Postman-Token\";s:36:\"dc44ff64-43f6-4a66-80e5-ffaf7a2a08bd\";s:4:\"Host\";s:9:\"localhost\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:10:\"Connection\";s:10:\"keep-alive\";s:6:\"Cookie\";s:134:\"sma_cart_id=45c1390cc9b7a32d5e600a0b9dbba9d1; sma_token_cookie=dbc292157f5a6422d7d65950d80d6f71; sess=ol0n10o9c7mtqd6sj3ikkofjehvaf2t3\";}', '0kks8oswoksockoo4csg0cc44k8s4gw40s04448o', '::1', 1587482706, 0.0274041, '1', 200),
(19, 'api/v1/products', 'get', 'a:14:{s:7:\"api-key\";s:40:\"0kks8oswoksockoo4csg0cc44k8s4gw40s04448o\";s:7:\"include\";s:15:\"photos,category\";s:5:\"start\";s:1:\"1\";s:5:\"limit\";s:2:\"10\";s:4:\"lang\";s:6:\"arabic\";s:11:\"customer_id\";s:2:\"11\";s:10:\"User-Agent\";s:21:\"PostmanRuntime/7.24.1\";s:6:\"Accept\";s:3:\"*/*\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:13:\"Postman-Token\";s:36:\"7939f208-8129-4f52-8ec4-6bd278d657b2\";s:4:\"Host\";s:9:\"localhost\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:10:\"Connection\";s:10:\"keep-alive\";s:6:\"Cookie\";s:134:\"sma_cart_id=45c1390cc9b7a32d5e600a0b9dbba9d1; sma_token_cookie=dbc292157f5a6422d7d65950d80d6f71; sess=ol0n10o9c7mtqd6sj3ikkofjehvaf2t3\";}', '0kks8oswoksockoo4csg0cc44k8s4gw40s04448o', '::1', 1587482716, 0.069844, '1', 200),
(20, 'api/v1/Cart', 'get', 'a:21:{s:7:\"api-key\";s:40:\"0kks8oswoksockoo4csg0cc44k8s4gw40s04448o\";s:9:\"fcm_token\";s:5:\"fcm11\";s:4:\"lang\";s:6:\"arabic\";s:10:\"product_id\";s:3:\"139\";s:8:\"quantity\";s:1:\"2\";s:3:\"lat\";s:3:\"001\";s:3:\"lon\";s:3:\"002\";s:14:\"shipping_phone\";s:4:\"0345\";s:13:\"shipping_city\";s:3:\"Guj\";s:14:\"shipping_state\";s:6:\"Punjab\";s:16:\"shipping_country\";s:8:\"Pakistan\";s:7:\"comment\";s:27:\"This is order comment brooo\";s:2:\"id\";s:2:\"10\";s:10:\"User-Agent\";s:21:\"PostmanRuntime/7.24.1\";s:6:\"Accept\";s:3:\"*/*\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:13:\"Postman-Token\";s:36:\"81da9c44-bb54-4020-921c-63b4f52afef4\";s:4:\"Host\";s:9:\"localhost\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:10:\"Connection\";s:10:\"keep-alive\";s:6:\"Cookie\";s:134:\"sma_cart_id=45c1390cc9b7a32d5e600a0b9dbba9d1; sma_token_cookie=dbc292157f5a6422d7d65950d80d6f71; sess=ol0n10o9c7mtqd6sj3ikkofjehvaf2t3\";}', '0kks8oswoksockoo4csg0cc44k8s4gw40s04448o', '::1', 1587482806, 0.0726919, '1', 200),
(21, 'api/v1/products', 'get', 'a:14:{s:7:\"api-key\";s:40:\"0kks8oswoksockoo4csg0cc44k8s4gw40s04448o\";s:7:\"include\";s:15:\"photos,category\";s:5:\"start\";s:1:\"1\";s:5:\"limit\";s:2:\"10\";s:4:\"lang\";s:6:\"arabic\";s:11:\"customer_id\";s:2:\"11\";s:10:\"User-Agent\";s:21:\"PostmanRuntime/7.24.1\";s:6:\"Accept\";s:3:\"*/*\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:13:\"Postman-Token\";s:36:\"aa5e85ca-8576-4817-bd68-56861a8fd1a3\";s:4:\"Host\";s:9:\"localhost\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:10:\"Connection\";s:10:\"keep-alive\";s:6:\"Cookie\";s:134:\"sma_cart_id=45c1390cc9b7a32d5e600a0b9dbba9d1; sma_token_cookie=dbc292157f5a6422d7d65950d80d6f71; sess=ol0n10o9c7mtqd6sj3ikkofjehvaf2t3\";}', '0kks8oswoksockoo4csg0cc44k8s4gw40s04448o', '::1', 1587482823, 0.072835, '1', 200),
(22, 'api/v1/products', 'get', 'a:14:{s:7:\"api-key\";s:40:\"0kks8oswoksockoo4csg0cc44k8s4gw40s04448o\";s:7:\"include\";s:15:\"photos,category\";s:5:\"start\";s:1:\"1\";s:5:\"limit\";s:2:\"10\";s:4:\"lang\";s:6:\"arabic\";s:11:\"customer_id\";s:2:\"11\";s:10:\"User-Agent\";s:21:\"PostmanRuntime/7.24.1\";s:6:\"Accept\";s:3:\"*/*\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:13:\"Postman-Token\";s:36:\"c9be8a89-ac9d-48b1-987b-6d38692ca799\";s:4:\"Host\";s:9:\"localhost\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:10:\"Connection\";s:10:\"keep-alive\";s:6:\"Cookie\";s:134:\"sma_cart_id=45c1390cc9b7a32d5e600a0b9dbba9d1; sma_token_cookie=dbc292157f5a6422d7d65950d80d6f71; sess=ol0n10o9c7mtqd6sj3ikkofjehvaf2t3\";}', '0kks8oswoksockoo4csg0cc44k8s4gw40s04448o', '::1', 1587482932, 0.048708, '1', 200),
(23, 'api/v1/products', 'get', 'a:14:{s:7:\"api-key\";s:40:\"0kks8oswoksockoo4csg0cc44k8s4gw40s04448o\";s:7:\"include\";s:15:\"photos,category\";s:5:\"start\";s:1:\"1\";s:5:\"limit\";s:2:\"10\";s:4:\"lang\";s:6:\"arabic\";s:11:\"customer_id\";s:2:\"11\";s:10:\"User-Agent\";s:21:\"PostmanRuntime/7.24.1\";s:6:\"Accept\";s:3:\"*/*\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:13:\"Postman-Token\";s:36:\"909e7d0d-4167-4a4b-9f08-6a838fb5d941\";s:4:\"Host\";s:9:\"localhost\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:10:\"Connection\";s:10:\"keep-alive\";s:6:\"Cookie\";s:134:\"sma_cart_id=45c1390cc9b7a32d5e600a0b9dbba9d1; sma_token_cookie=dbc292157f5a6422d7d65950d80d6f71; sess=ol0n10o9c7mtqd6sj3ikkofjehvaf2t3\";}', '0kks8oswoksockoo4csg0cc44k8s4gw40s04448o', '::1', 1587482976, 0.0260711, '1', 0),
(24, 'api/v1/products', 'get', 'a:14:{s:7:\"api-key\";s:40:\"0kks8oswoksockoo4csg0cc44k8s4gw40s04448o\";s:7:\"include\";s:15:\"photos,category\";s:5:\"start\";s:1:\"1\";s:5:\"limit\";s:2:\"10\";s:4:\"lang\";s:6:\"arabic\";s:11:\"customer_id\";s:2:\"11\";s:10:\"User-Agent\";s:21:\"PostmanRuntime/7.24.1\";s:6:\"Accept\";s:3:\"*/*\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:13:\"Postman-Token\";s:36:\"78c314c6-32c3-4a14-912e-d548b780d286\";s:4:\"Host\";s:9:\"localhost\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:10:\"Connection\";s:10:\"keep-alive\";s:6:\"Cookie\";s:134:\"sma_cart_id=45c1390cc9b7a32d5e600a0b9dbba9d1; sma_token_cookie=dbc292157f5a6422d7d65950d80d6f71; sess=ol0n10o9c7mtqd6sj3ikkofjehvaf2t3\";}', '0kks8oswoksockoo4csg0cc44k8s4gw40s04448o', '::1', 1587482995, 0.0354471, '1', 0),
(25, 'api/v1/products', 'get', 'a:14:{s:7:\"api-key\";s:40:\"0kks8oswoksockoo4csg0cc44k8s4gw40s04448o\";s:7:\"include\";s:15:\"photos,category\";s:5:\"start\";s:1:\"1\";s:5:\"limit\";s:2:\"10\";s:4:\"lang\";s:6:\"arabic\";s:11:\"customer_id\";s:2:\"11\";s:10:\"User-Agent\";s:21:\"PostmanRuntime/7.24.1\";s:6:\"Accept\";s:3:\"*/*\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:13:\"Postman-Token\";s:36:\"defef92b-5434-455a-a5f8-b11614bacc95\";s:4:\"Host\";s:9:\"localhost\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:10:\"Connection\";s:10:\"keep-alive\";s:6:\"Cookie\";s:134:\"sma_cart_id=45c1390cc9b7a32d5e600a0b9dbba9d1; sma_token_cookie=dbc292157f5a6422d7d65950d80d6f71; sess=ol0n10o9c7mtqd6sj3ikkofjehvaf2t3\";}', '0kks8oswoksockoo4csg0cc44k8s4gw40s04448o', '::1', 1587483024, 0.041661, '1', 200),
(26, 'api/v1/products', 'get', 'a:14:{s:7:\"api-key\";s:40:\"0kks8oswoksockoo4csg0cc44k8s4gw40s04448o\";s:7:\"include\";s:15:\"photos,category\";s:5:\"start\";s:1:\"1\";s:5:\"limit\";s:2:\"10\";s:4:\"lang\";s:6:\"arabic\";s:11:\"customer_id\";s:2:\"11\";s:10:\"User-Agent\";s:21:\"PostmanRuntime/7.24.1\";s:6:\"Accept\";s:3:\"*/*\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:13:\"Postman-Token\";s:36:\"ed516f8d-44db-4fbd-8c93-dbd4cf01f01f\";s:4:\"Host\";s:9:\"localhost\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:10:\"Connection\";s:10:\"keep-alive\";s:6:\"Cookie\";s:134:\"sma_cart_id=45c1390cc9b7a32d5e600a0b9dbba9d1; sma_token_cookie=dbc292157f5a6422d7d65950d80d6f71; sess=sbficp6d9d3lip45godve9cq4tcr3o91\";}', '0kks8oswoksockoo4csg0cc44k8s4gw40s04448o', '::1', 1587483040, 0.0718348, '1', 0),
(27, 'api/v1/products', 'get', 'a:14:{s:7:\"api-key\";s:40:\"0kks8oswoksockoo4csg0cc44k8s4gw40s04448o\";s:7:\"include\";s:15:\"photos,category\";s:5:\"start\";s:1:\"1\";s:5:\"limit\";s:2:\"10\";s:4:\"lang\";s:6:\"arabic\";s:11:\"customer_id\";s:2:\"11\";s:10:\"User-Agent\";s:21:\"PostmanRuntime/7.24.1\";s:6:\"Accept\";s:3:\"*/*\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:13:\"Postman-Token\";s:36:\"3002826f-2a6e-4030-89f2-b110de5f99a5\";s:4:\"Host\";s:9:\"localhost\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:10:\"Connection\";s:10:\"keep-alive\";s:6:\"Cookie\";s:134:\"sma_cart_id=45c1390cc9b7a32d5e600a0b9dbba9d1; sma_token_cookie=dbc292157f5a6422d7d65950d80d6f71; sess=sbficp6d9d3lip45godve9cq4tcr3o91\";}', '0kks8oswoksockoo4csg0cc44k8s4gw40s04448o', '::1', 1587483068, 0.0440879, '1', 200),
(28, 'api/v1/products', 'get', 'a:14:{s:7:\"api-key\";s:40:\"0kks8oswoksockoo4csg0cc44k8s4gw40s04448o\";s:7:\"include\";s:15:\"photos,category\";s:5:\"start\";s:1:\"1\";s:5:\"limit\";s:2:\"10\";s:4:\"lang\";s:6:\"arabic\";s:11:\"customer_id\";s:2:\"11\";s:10:\"User-Agent\";s:21:\"PostmanRuntime/7.24.1\";s:6:\"Accept\";s:3:\"*/*\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:13:\"Postman-Token\";s:36:\"013a829a-a219-4a7e-baf1-91f5c57cfd1e\";s:4:\"Host\";s:9:\"localhost\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:10:\"Connection\";s:10:\"keep-alive\";s:6:\"Cookie\";s:134:\"sma_cart_id=45c1390cc9b7a32d5e600a0b9dbba9d1; sma_token_cookie=dbc292157f5a6422d7d65950d80d6f71; sess=sbficp6d9d3lip45godve9cq4tcr3o91\";}', '0kks8oswoksockoo4csg0cc44k8s4gw40s04448o', '::1', 1587483187, 0.0351861, '1', 0),
(29, 'api/v1/products', 'get', 'a:14:{s:7:\"api-key\";s:40:\"0kks8oswoksockoo4csg0cc44k8s4gw40s04448o\";s:7:\"include\";s:15:\"photos,category\";s:5:\"start\";s:1:\"1\";s:5:\"limit\";s:2:\"10\";s:4:\"lang\";s:6:\"arabic\";s:11:\"customer_id\";s:2:\"11\";s:10:\"User-Agent\";s:21:\"PostmanRuntime/7.24.1\";s:6:\"Accept\";s:3:\"*/*\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:13:\"Postman-Token\";s:36:\"4ec7716c-5ec4-45a3-9233-9b882452764e\";s:4:\"Host\";s:9:\"localhost\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:10:\"Connection\";s:10:\"keep-alive\";s:6:\"Cookie\";s:134:\"sma_cart_id=45c1390cc9b7a32d5e600a0b9dbba9d1; sma_token_cookie=dbc292157f5a6422d7d65950d80d6f71; sess=sbficp6d9d3lip45godve9cq4tcr3o91\";}', '0kks8oswoksockoo4csg0cc44k8s4gw40s04448o', '::1', 1587483223, 0.028764, '1', 0),
(30, 'api/v1/products', 'get', 'a:14:{s:7:\"api-key\";s:40:\"0kks8oswoksockoo4csg0cc44k8s4gw40s04448o\";s:7:\"include\";s:15:\"photos,category\";s:5:\"start\";s:1:\"1\";s:5:\"limit\";s:2:\"10\";s:4:\"lang\";s:6:\"arabic\";s:11:\"customer_id\";s:2:\"11\";s:10:\"User-Agent\";s:21:\"PostmanRuntime/7.24.1\";s:6:\"Accept\";s:3:\"*/*\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:13:\"Postman-Token\";s:36:\"8c7073ab-3321-439e-a742-2171aa6e223a\";s:4:\"Host\";s:9:\"localhost\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:10:\"Connection\";s:10:\"keep-alive\";s:6:\"Cookie\";s:134:\"sma_cart_id=45c1390cc9b7a32d5e600a0b9dbba9d1; sma_token_cookie=dbc292157f5a6422d7d65950d80d6f71; sess=sbficp6d9d3lip45godve9cq4tcr3o91\";}', '0kks8oswoksockoo4csg0cc44k8s4gw40s04448o', '::1', 1587483254, 0.0329618, '1', 0),
(31, 'api/v1/products', 'get', 'a:14:{s:7:\"api-key\";s:40:\"0kks8oswoksockoo4csg0cc44k8s4gw40s04448o\";s:7:\"include\";s:15:\"photos,category\";s:5:\"start\";s:1:\"1\";s:5:\"limit\";s:2:\"10\";s:4:\"lang\";s:6:\"arabic\";s:11:\"customer_id\";s:2:\"11\";s:10:\"User-Agent\";s:21:\"PostmanRuntime/7.24.1\";s:6:\"Accept\";s:3:\"*/*\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:13:\"Postman-Token\";s:36:\"5836db58-1d24-401d-b77c-7adffa260b84\";s:4:\"Host\";s:9:\"localhost\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:10:\"Connection\";s:10:\"keep-alive\";s:6:\"Cookie\";s:134:\"sma_cart_id=45c1390cc9b7a32d5e600a0b9dbba9d1; sma_token_cookie=dbc292157f5a6422d7d65950d80d6f71; sess=sbficp6d9d3lip45godve9cq4tcr3o91\";}', '0kks8oswoksockoo4csg0cc44k8s4gw40s04448o', '::1', 1587483302, 0.0354679, '1', 200),
(32, 'api/v1/Cart', 'get', 'a:22:{s:7:\"api-key\";s:40:\"0kks8oswoksockoo4csg0cc44k8s4gw40s04448o\";s:9:\"fcm_token\";s:5:\"fcm11\";s:3:\"add\";s:1:\"1\";s:4:\"lang\";s:6:\"arabic\";s:10:\"product_id\";s:3:\"140\";s:8:\"quantity\";s:1:\"2\";s:3:\"lat\";s:3:\"001\";s:3:\"lon\";s:3:\"002\";s:14:\"shipping_phone\";s:4:\"0345\";s:13:\"shipping_city\";s:3:\"Guj\";s:14:\"shipping_state\";s:6:\"Punjab\";s:16:\"shipping_country\";s:8:\"Pakistan\";s:7:\"comment\";s:27:\"This is order comment brooo\";s:2:\"id\";s:2:\"10\";s:10:\"User-Agent\";s:21:\"PostmanRuntime/7.24.1\";s:6:\"Accept\";s:3:\"*/*\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:13:\"Postman-Token\";s:36:\"b390d36c-65ca-402d-8973-1650c59dde72\";s:4:\"Host\";s:9:\"localhost\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:10:\"Connection\";s:10:\"keep-alive\";s:6:\"Cookie\";s:134:\"sma_cart_id=45c1390cc9b7a32d5e600a0b9dbba9d1; sma_token_cookie=dbc292157f5a6422d7d65950d80d6f71; sess=sbficp6d9d3lip45godve9cq4tcr3o91\";}', '0kks8oswoksockoo4csg0cc44k8s4gw40s04448o', '::1', 1587483337, 0.0482161, '1', 0),
(33, 'api/v1/products', 'get', 'a:14:{s:7:\"api-key\";s:40:\"0kks8oswoksockoo4csg0cc44k8s4gw40s04448o\";s:7:\"include\";s:15:\"photos,category\";s:5:\"start\";s:1:\"1\";s:5:\"limit\";s:2:\"10\";s:4:\"lang\";s:6:\"arabic\";s:11:\"customer_id\";s:2:\"11\";s:10:\"User-Agent\";s:21:\"PostmanRuntime/7.24.1\";s:6:\"Accept\";s:3:\"*/*\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:13:\"Postman-Token\";s:36:\"6eb59850-ffaa-4941-90a6-473880470b45\";s:4:\"Host\";s:9:\"localhost\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:10:\"Connection\";s:10:\"keep-alive\";s:6:\"Cookie\";s:134:\"sma_cart_id=45c1390cc9b7a32d5e600a0b9dbba9d1; sma_token_cookie=dbc292157f5a6422d7d65950d80d6f71; sess=fp9ijobnh7odih1a9800qannic3n82lj\";}', '0kks8oswoksockoo4csg0cc44k8s4gw40s04448o', '::1', 1587483342, 0.039062, '1', 200),
(34, 'api/v1/Cart', 'get', 'a:22:{s:7:\"api-key\";s:40:\"0kks8oswoksockoo4csg0cc44k8s4gw40s04448o\";s:9:\"fcm_token\";s:5:\"fcm11\";s:3:\"add\";s:1:\"1\";s:4:\"lang\";s:6:\"arabic\";s:10:\"product_id\";s:3:\"140\";s:8:\"quantity\";s:1:\"2\";s:3:\"lat\";s:3:\"001\";s:3:\"lon\";s:3:\"002\";s:14:\"shipping_phone\";s:4:\"0345\";s:13:\"shipping_city\";s:3:\"Guj\";s:14:\"shipping_state\";s:6:\"Punjab\";s:16:\"shipping_country\";s:8:\"Pakistan\";s:7:\"comment\";s:27:\"This is order comment brooo\";s:2:\"id\";s:2:\"10\";s:10:\"User-Agent\";s:21:\"PostmanRuntime/7.24.1\";s:6:\"Accept\";s:3:\"*/*\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:13:\"Postman-Token\";s:36:\"5556dd50-ae52-4bbb-929a-5a52817eaa12\";s:4:\"Host\";s:9:\"localhost\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:10:\"Connection\";s:10:\"keep-alive\";s:6:\"Cookie\";s:134:\"sma_cart_id=45c1390cc9b7a32d5e600a0b9dbba9d1; sma_token_cookie=dbc292157f5a6422d7d65950d80d6f71; sess=fp9ijobnh7odih1a9800qannic3n82lj\";}', '0kks8oswoksockoo4csg0cc44k8s4gw40s04448o', '::1', 1587483368, 0.0397069, '1', 0),
(35, 'api/v1/Cart', 'get', 'a:21:{s:7:\"api-key\";s:40:\"0kks8oswoksockoo4csg0cc44k8s4gw40s04448o\";s:9:\"fcm_token\";s:5:\"fcm11\";s:4:\"lang\";s:6:\"arabic\";s:10:\"product_id\";s:3:\"140\";s:8:\"quantity\";s:1:\"2\";s:3:\"lat\";s:3:\"001\";s:3:\"lon\";s:3:\"002\";s:14:\"shipping_phone\";s:4:\"0345\";s:13:\"shipping_city\";s:3:\"Guj\";s:14:\"shipping_state\";s:6:\"Punjab\";s:16:\"shipping_country\";s:8:\"Pakistan\";s:7:\"comment\";s:27:\"This is order comment brooo\";s:2:\"id\";s:2:\"10\";s:10:\"User-Agent\";s:21:\"PostmanRuntime/7.24.1\";s:6:\"Accept\";s:3:\"*/*\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:13:\"Postman-Token\";s:36:\"09db7a3e-fa6d-45e3-8513-47324d685da8\";s:4:\"Host\";s:9:\"localhost\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:10:\"Connection\";s:10:\"keep-alive\";s:6:\"Cookie\";s:134:\"sma_cart_id=45c1390cc9b7a32d5e600a0b9dbba9d1; sma_token_cookie=dbc292157f5a6422d7d65950d80d6f71; sess=fp9ijobnh7odih1a9800qannic3n82lj\";}', '0kks8oswoksockoo4csg0cc44k8s4gw40s04448o', '::1', 1587483373, 0.0309131, '1', 200),
(36, 'api/v1/Cart', 'get', 'a:23:{s:7:\"api-key\";s:40:\"0kks8oswoksockoo4csg0cc44k8s4gw40s04448o\";s:9:\"fcm_token\";s:5:\"fcm11\";s:4:\"lang\";s:6:\"arabic\";s:10:\"product_id\";s:3:\"140\";s:8:\"quantity\";s:1:\"2\";s:6:\"remove\";s:1:\"1\";s:6:\"row_id\";s:32:\"8f5c9a09b955a2eab184b1e4b47638b5\";s:3:\"lat\";s:3:\"001\";s:3:\"lon\";s:3:\"002\";s:14:\"shipping_phone\";s:4:\"0345\";s:13:\"shipping_city\";s:3:\"Guj\";s:14:\"shipping_state\";s:6:\"Punjab\";s:16:\"shipping_country\";s:8:\"Pakistan\";s:7:\"comment\";s:27:\"This is order comment brooo\";s:2:\"id\";s:2:\"10\";s:10:\"User-Agent\";s:21:\"PostmanRuntime/7.24.1\";s:6:\"Accept\";s:3:\"*/*\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:13:\"Postman-Token\";s:36:\"40957749-8524-4bf7-a69a-ba5793187215\";s:4:\"Host\";s:9:\"localhost\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:10:\"Connection\";s:10:\"keep-alive\";s:6:\"Cookie\";s:134:\"sma_cart_id=45c1390cc9b7a32d5e600a0b9dbba9d1; sma_token_cookie=dbc292157f5a6422d7d65950d80d6f71; sess=fp9ijobnh7odih1a9800qannic3n82lj\";}', '0kks8oswoksockoo4csg0cc44k8s4gw40s04448o', '::1', 1587483389, 0.0654478, '1', 0),
(37, 'api/v1/products', 'get', 'a:14:{s:7:\"api-key\";s:40:\"0kks8oswoksockoo4csg0cc44k8s4gw40s04448o\";s:7:\"include\";s:15:\"photos,category\";s:5:\"start\";s:1:\"1\";s:5:\"limit\";s:2:\"10\";s:4:\"lang\";s:6:\"arabic\";s:11:\"customer_id\";s:2:\"11\";s:10:\"User-Agent\";s:21:\"PostmanRuntime/7.24.1\";s:6:\"Accept\";s:3:\"*/*\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:13:\"Postman-Token\";s:36:\"d2ebb8a9-6bb5-4ef3-8146-699786fb54d8\";s:4:\"Host\";s:9:\"localhost\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:10:\"Connection\";s:10:\"keep-alive\";s:6:\"Cookie\";s:134:\"sma_cart_id=45c1390cc9b7a32d5e600a0b9dbba9d1; sma_token_cookie=dbc292157f5a6422d7d65950d80d6f71; sess=fp9ijobnh7odih1a9800qannic3n82lj\";}', '0kks8oswoksockoo4csg0cc44k8s4gw40s04448o', '::1', 1587483398, 0.044981, '1', 200),
(38, 'api/v1/Cart', 'get', 'a:24:{s:7:\"api-key\";s:40:\"0kks8oswoksockoo4csg0cc44k8s4gw40s04448o\";s:9:\"fcm_token\";s:5:\"fcm11\";s:4:\"lang\";s:6:\"arabic\";s:10:\"product_id\";s:3:\"140\";s:8:\"quantity\";s:1:\"2\";s:6:\"remove\";s:1:\"1\";s:6:\"row_id\";s:32:\"8f5c9a09b955a2eab184b1e4b47638b5\";s:7:\"destroy\";s:1:\"1\";s:3:\"lat\";s:3:\"001\";s:3:\"lon\";s:3:\"002\";s:14:\"shipping_phone\";s:4:\"0345\";s:13:\"shipping_city\";s:3:\"Guj\";s:14:\"shipping_state\";s:6:\"Punjab\";s:16:\"shipping_country\";s:8:\"Pakistan\";s:7:\"comment\";s:27:\"This is order comment brooo\";s:2:\"id\";s:2:\"10\";s:10:\"User-Agent\";s:21:\"PostmanRuntime/7.24.1\";s:6:\"Accept\";s:3:\"*/*\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:13:\"Postman-Token\";s:36:\"81d5e4f6-f681-47d6-8a6b-418105b1bdb2\";s:4:\"Host\";s:9:\"localhost\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:10:\"Connection\";s:10:\"keep-alive\";s:6:\"Cookie\";s:134:\"sma_cart_id=45c1390cc9b7a32d5e600a0b9dbba9d1; sma_token_cookie=dbc292157f5a6422d7d65950d80d6f71; sess=fp9ijobnh7odih1a9800qannic3n82lj\";}', '0kks8oswoksockoo4csg0cc44k8s4gw40s04448o', '::1', 1587483444, 0.0410519, '1', 0),
(39, 'api/v1/Cart', 'get', 'a:22:{s:7:\"api-key\";s:40:\"0kks8oswoksockoo4csg0cc44k8s4gw40s04448o\";s:9:\"fcm_token\";s:5:\"fcm11\";s:4:\"lang\";s:6:\"arabic\";s:10:\"product_id\";s:3:\"140\";s:8:\"quantity\";s:1:\"2\";s:7:\"destroy\";s:1:\"1\";s:3:\"lat\";s:3:\"001\";s:3:\"lon\";s:3:\"002\";s:14:\"shipping_phone\";s:4:\"0345\";s:13:\"shipping_city\";s:3:\"Guj\";s:14:\"shipping_state\";s:6:\"Punjab\";s:16:\"shipping_country\";s:8:\"Pakistan\";s:7:\"comment\";s:27:\"This is order comment brooo\";s:2:\"id\";s:2:\"10\";s:10:\"User-Agent\";s:21:\"PostmanRuntime/7.24.1\";s:6:\"Accept\";s:3:\"*/*\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:13:\"Postman-Token\";s:36:\"461347a3-d3cf-4f84-9f7c-5298249c39af\";s:4:\"Host\";s:9:\"localhost\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:10:\"Connection\";s:10:\"keep-alive\";s:6:\"Cookie\";s:134:\"sma_cart_id=45c1390cc9b7a32d5e600a0b9dbba9d1; sma_token_cookie=dbc292157f5a6422d7d65950d80d6f71; sess=fp9ijobnh7odih1a9800qannic3n82lj\";}', '0kks8oswoksockoo4csg0cc44k8s4gw40s04448o', '::1', 1587483454, 0.0393379, '1', 0),
(40, 'api/v1/products', 'get', 'a:14:{s:7:\"api-key\";s:40:\"0kks8oswoksockoo4csg0cc44k8s4gw40s04448o\";s:7:\"include\";s:15:\"photos,category\";s:5:\"start\";s:1:\"1\";s:5:\"limit\";s:2:\"10\";s:4:\"lang\";s:6:\"arabic\";s:11:\"customer_id\";s:2:\"11\";s:10:\"User-Agent\";s:21:\"PostmanRuntime/7.24.1\";s:6:\"Accept\";s:3:\"*/*\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:13:\"Postman-Token\";s:36:\"f9d07e18-84fd-4b14-a9be-eaeccfe2bdf8\";s:4:\"Host\";s:9:\"localhost\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:10:\"Connection\";s:10:\"keep-alive\";s:6:\"Cookie\";s:134:\"sma_cart_id=45c1390cc9b7a32d5e600a0b9dbba9d1; sma_token_cookie=dbc292157f5a6422d7d65950d80d6f71; sess=fp9ijobnh7odih1a9800qannic3n82lj\";}', '0kks8oswoksockoo4csg0cc44k8s4gw40s04448o', '::1', 1587483458, 0.046643, '1', 0),
(41, 'api/v1/products', 'get', 'a:14:{s:7:\"api-key\";s:40:\"0kks8oswoksockoo4csg0cc44k8s4gw40s04448o\";s:7:\"include\";s:15:\"photos,category\";s:5:\"start\";s:1:\"1\";s:5:\"limit\";s:2:\"10\";s:4:\"lang\";s:6:\"arabic\";s:11:\"customer_id\";s:2:\"11\";s:10:\"User-Agent\";s:21:\"PostmanRuntime/7.24.1\";s:6:\"Accept\";s:3:\"*/*\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:13:\"Postman-Token\";s:36:\"a61f7362-11b2-4e5a-967f-34c20b7c523a\";s:4:\"Host\";s:9:\"localhost\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:10:\"Connection\";s:10:\"keep-alive\";s:6:\"Cookie\";s:134:\"sma_cart_id=45c1390cc9b7a32d5e600a0b9dbba9d1; sma_token_cookie=dbc292157f5a6422d7d65950d80d6f71; sess=fp9ijobnh7odih1a9800qannic3n82lj\";}', '0kks8oswoksockoo4csg0cc44k8s4gw40s04448o', '::1', 1587483574, 0.0481811, '1', 200),
(42, 'api/v1/products', 'get', 'a:14:{s:7:\"api-key\";s:40:\"0kks8oswoksockoo4csg0cc44k8s4gw40s04448o\";s:7:\"include\";s:15:\"photos,category\";s:5:\"start\";s:1:\"1\";s:5:\"limit\";s:2:\"10\";s:4:\"lang\";s:6:\"arabic\";s:11:\"customer_id\";s:2:\"11\";s:10:\"User-Agent\";s:21:\"PostmanRuntime/7.24.1\";s:6:\"Accept\";s:3:\"*/*\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:13:\"Postman-Token\";s:36:\"0ae321c9-947f-428f-86dc-851bf1a0fd38\";s:4:\"Host\";s:9:\"localhost\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:10:\"Connection\";s:10:\"keep-alive\";s:6:\"Cookie\";s:134:\"sma_cart_id=45c1390cc9b7a32d5e600a0b9dbba9d1; sma_token_cookie=dbc292157f5a6422d7d65950d80d6f71; sess=fp9ijobnh7odih1a9800qannic3n82lj\";}', '0kks8oswoksockoo4csg0cc44k8s4gw40s04448o', '::1', 1587483616, 0.0541821, '1', 200),
(43, 'api/v1/Cart', 'get', 'a:23:{s:7:\"api-key\";s:40:\"0kks8oswoksockoo4csg0cc44k8s4gw40s04448o\";s:9:\"fcm_token\";s:5:\"fcm11\";s:3:\"add\";s:1:\"1\";s:4:\"lang\";s:6:\"arabic\";s:10:\"product_id\";s:3:\"148\";s:8:\"quantity\";s:1:\"2\";s:7:\"destroy\";s:1:\"1\";s:3:\"lat\";s:3:\"001\";s:3:\"lon\";s:3:\"002\";s:14:\"shipping_phone\";s:4:\"0345\";s:13:\"shipping_city\";s:3:\"Guj\";s:14:\"shipping_state\";s:6:\"Punjab\";s:16:\"shipping_country\";s:8:\"Pakistan\";s:7:\"comment\";s:27:\"This is order comment brooo\";s:2:\"id\";s:2:\"10\";s:10:\"User-Agent\";s:21:\"PostmanRuntime/7.24.1\";s:6:\"Accept\";s:3:\"*/*\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:13:\"Postman-Token\";s:36:\"5be23431-66bc-4c55-82ec-77a8b28f1749\";s:4:\"Host\";s:9:\"localhost\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:10:\"Connection\";s:10:\"keep-alive\";s:6:\"Cookie\";s:134:\"sma_cart_id=45c1390cc9b7a32d5e600a0b9dbba9d1; sma_token_cookie=dbc292157f5a6422d7d65950d80d6f71; sess=fp9ijobnh7odih1a9800qannic3n82lj\";}', '0kks8oswoksockoo4csg0cc44k8s4gw40s04448o', '::1', 1587483644, 0.0472031, '1', 0),
(44, 'api/v1/Cart', 'get', 'a:22:{s:7:\"api-key\";s:40:\"0kks8oswoksockoo4csg0cc44k8s4gw40s04448o\";s:9:\"fcm_token\";s:5:\"fcm11\";s:3:\"add\";s:1:\"1\";s:4:\"lang\";s:6:\"arabic\";s:10:\"product_id\";s:3:\"148\";s:8:\"quantity\";s:1:\"2\";s:3:\"lat\";s:3:\"001\";s:3:\"lon\";s:3:\"002\";s:14:\"shipping_phone\";s:4:\"0345\";s:13:\"shipping_city\";s:3:\"Guj\";s:14:\"shipping_state\";s:6:\"Punjab\";s:16:\"shipping_country\";s:8:\"Pakistan\";s:7:\"comment\";s:27:\"This is order comment brooo\";s:2:\"id\";s:2:\"10\";s:10:\"User-Agent\";s:21:\"PostmanRuntime/7.24.1\";s:6:\"Accept\";s:3:\"*/*\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:13:\"Postman-Token\";s:36:\"d5cdf01f-d9a8-44a7-a25b-f1a91338b3f0\";s:4:\"Host\";s:9:\"localhost\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:10:\"Connection\";s:10:\"keep-alive\";s:6:\"Cookie\";s:134:\"sma_cart_id=45c1390cc9b7a32d5e600a0b9dbba9d1; sma_token_cookie=dbc292157f5a6422d7d65950d80d6f71; sess=ijoskf7qvd67jd9vr9e8vabsebpniden\";}', '0kks8oswoksockoo4csg0cc44k8s4gw40s04448o', '::1', 1587483647, 0.0372279, '1', 0),
(45, 'api/v1/products', 'get', 'a:14:{s:7:\"api-key\";s:40:\"0kks8oswoksockoo4csg0cc44k8s4gw40s04448o\";s:7:\"include\";s:15:\"photos,category\";s:5:\"start\";s:1:\"1\";s:5:\"limit\";s:2:\"10\";s:4:\"lang\";s:6:\"arabic\";s:11:\"customer_id\";s:2:\"11\";s:10:\"User-Agent\";s:21:\"PostmanRuntime/7.24.1\";s:6:\"Accept\";s:3:\"*/*\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:13:\"Postman-Token\";s:36:\"68786168-4721-4d22-9c69-e628d885d7f2\";s:4:\"Host\";s:9:\"localhost\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:10:\"Connection\";s:10:\"keep-alive\";s:6:\"Cookie\";s:134:\"sma_cart_id=45c1390cc9b7a32d5e600a0b9dbba9d1; sma_token_cookie=dbc292157f5a6422d7d65950d80d6f71; sess=ijoskf7qvd67jd9vr9e8vabsebpniden\";}', '0kks8oswoksockoo4csg0cc44k8s4gw40s04448o', '::1', 1587483651, 0.0384159, '1', 200),
(46, 'api/v1/Cart', 'get', 'a:22:{s:7:\"api-key\";s:40:\"0kks8oswoksockoo4csg0cc44k8s4gw40s04448o\";s:9:\"fcm_token\";s:5:\"fcm11\";s:4:\"lang\";s:6:\"arabic\";s:10:\"product_id\";s:3:\"148\";s:8:\"quantity\";s:1:\"2\";s:7:\"destroy\";s:1:\"1\";s:3:\"lat\";s:3:\"001\";s:3:\"lon\";s:3:\"002\";s:14:\"shipping_phone\";s:4:\"0345\";s:13:\"shipping_city\";s:3:\"Guj\";s:14:\"shipping_state\";s:6:\"Punjab\";s:16:\"shipping_country\";s:8:\"Pakistan\";s:7:\"comment\";s:27:\"This is order comment brooo\";s:2:\"id\";s:2:\"10\";s:10:\"User-Agent\";s:21:\"PostmanRuntime/7.24.1\";s:6:\"Accept\";s:3:\"*/*\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:13:\"Postman-Token\";s:36:\"89dfddbe-bd47-4715-9b72-8505d1eeabb8\";s:4:\"Host\";s:9:\"localhost\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:10:\"Connection\";s:10:\"keep-alive\";s:6:\"Cookie\";s:134:\"sma_cart_id=45c1390cc9b7a32d5e600a0b9dbba9d1; sma_token_cookie=dbc292157f5a6422d7d65950d80d6f71; sess=ijoskf7qvd67jd9vr9e8vabsebpniden\";}', '0kks8oswoksockoo4csg0cc44k8s4gw40s04448o', '::1', 1587483661, 0.081624, '1', 0),
(47, 'api/v1/products', 'get', 'a:14:{s:7:\"api-key\";s:40:\"0kks8oswoksockoo4csg0cc44k8s4gw40s04448o\";s:7:\"include\";s:15:\"photos,category\";s:5:\"start\";s:1:\"1\";s:5:\"limit\";s:2:\"10\";s:4:\"lang\";s:6:\"arabic\";s:11:\"customer_id\";s:2:\"11\";s:10:\"User-Agent\";s:21:\"PostmanRuntime/7.24.1\";s:6:\"Accept\";s:3:\"*/*\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:13:\"Postman-Token\";s:36:\"83b55eb1-0cb3-4094-a004-b8f8dc132e81\";s:4:\"Host\";s:9:\"localhost\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:10:\"Connection\";s:10:\"keep-alive\";s:6:\"Cookie\";s:134:\"sma_cart_id=45c1390cc9b7a32d5e600a0b9dbba9d1; sma_token_cookie=dbc292157f5a6422d7d65950d80d6f71; sess=ijoskf7qvd67jd9vr9e8vabsebpniden\";}', '0kks8oswoksockoo4csg0cc44k8s4gw40s04448o', '::1', 1587483664, 0.0339789, '1', 200),
(48, 'api/v1/products', 'get', 'a:13:{s:7:\"api-key\";s:40:\"0kks8oswoksockoo4csg0cc44k8s4gw40s04448o\";s:7:\"include\";s:15:\"photos,category\";s:5:\"start\";s:1:\"1\";s:5:\"limit\";s:2:\"10\";s:4:\"lang\";s:6:\"arabic\";s:10:\"User-Agent\";s:21:\"PostmanRuntime/7.24.1\";s:6:\"Accept\";s:3:\"*/*\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:13:\"Postman-Token\";s:36:\"7de8a95f-e76b-4791-877d-359343f22451\";s:4:\"Host\";s:9:\"localhost\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:10:\"Connection\";s:10:\"keep-alive\";s:6:\"Cookie\";s:134:\"sma_cart_id=45c1390cc9b7a32d5e600a0b9dbba9d1; sma_token_cookie=dbc292157f5a6422d7d65950d80d6f71; sess=ijoskf7qvd67jd9vr9e8vabsebpniden\";}', '0kks8oswoksockoo4csg0cc44k8s4gw40s04448o', '::1', 1587483677, 0.0809619, '1', 200),
(49, 'api/v1/Cart', 'get', 'a:22:{s:7:\"api-key\";s:40:\"0kks8oswoksockoo4csg0cc44k8s4gw40s04448o\";s:9:\"fcm_token\";s:5:\"fcm11\";s:4:\"lang\";s:6:\"arabic\";s:10:\"product_id\";s:3:\"148\";s:8:\"quantity\";s:1:\"2\";s:7:\"destroy\";s:1:\"1\";s:3:\"lat\";s:3:\"001\";s:3:\"lon\";s:3:\"002\";s:14:\"shipping_phone\";s:4:\"0345\";s:13:\"shipping_city\";s:3:\"Guj\";s:14:\"shipping_state\";s:6:\"Punjab\";s:16:\"shipping_country\";s:8:\"Pakistan\";s:7:\"comment\";s:27:\"This is order comment brooo\";s:2:\"id\";s:2:\"10\";s:10:\"User-Agent\";s:21:\"PostmanRuntime/7.24.1\";s:6:\"Accept\";s:3:\"*/*\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:13:\"Postman-Token\";s:36:\"4955435e-c016-4bf7-8da4-c0d5235d7182\";s:4:\"Host\";s:9:\"localhost\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:10:\"Connection\";s:10:\"keep-alive\";s:6:\"Cookie\";s:134:\"sma_cart_id=45c1390cc9b7a32d5e600a0b9dbba9d1; sma_token_cookie=dbc292157f5a6422d7d65950d80d6f71; sess=ijoskf7qvd67jd9vr9e8vabsebpniden\";}', '0kks8oswoksockoo4csg0cc44k8s4gw40s04448o', '::1', 1587483708, 0.0294042, '1', 0),
(50, 'api/v1/Cart', 'get', 'a:22:{s:7:\"api-key\";s:40:\"0kks8oswoksockoo4csg0cc44k8s4gw40s04448o\";s:9:\"fcm_token\";s:5:\"fcm11\";s:3:\"add\";s:1:\"1\";s:4:\"lang\";s:6:\"arabic\";s:10:\"product_id\";s:3:\"148\";s:8:\"quantity\";s:1:\"2\";s:3:\"lat\";s:3:\"001\";s:3:\"lon\";s:3:\"002\";s:14:\"shipping_phone\";s:4:\"0345\";s:13:\"shipping_city\";s:3:\"Guj\";s:14:\"shipping_state\";s:6:\"Punjab\";s:16:\"shipping_country\";s:8:\"Pakistan\";s:7:\"comment\";s:27:\"This is order comment brooo\";s:2:\"id\";s:2:\"10\";s:10:\"User-Agent\";s:21:\"PostmanRuntime/7.24.1\";s:6:\"Accept\";s:3:\"*/*\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:13:\"Postman-Token\";s:36:\"4f439a19-26bd-475a-a197-4d154a2f18ed\";s:4:\"Host\";s:9:\"localhost\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:10:\"Connection\";s:10:\"keep-alive\";s:6:\"Cookie\";s:134:\"sma_cart_id=45c1390cc9b7a32d5e600a0b9dbba9d1; sma_token_cookie=dbc292157f5a6422d7d65950d80d6f71; sess=ijoskf7qvd67jd9vr9e8vabsebpniden\";}', '0kks8oswoksockoo4csg0cc44k8s4gw40s04448o', '::1', 1587483715, 0.049886, '1', 0),
(51, 'api/v1/Cart', 'get', 'a:21:{s:7:\"api-key\";s:40:\"0kks8oswoksockoo4csg0cc44k8s4gw40s04448o\";s:9:\"fcm_token\";s:5:\"fcm11\";s:4:\"lang\";s:6:\"arabic\";s:10:\"product_id\";s:3:\"148\";s:8:\"quantity\";s:1:\"2\";s:3:\"lat\";s:3:\"001\";s:3:\"lon\";s:3:\"002\";s:14:\"shipping_phone\";s:4:\"0345\";s:13:\"shipping_city\";s:3:\"Guj\";s:14:\"shipping_state\";s:6:\"Punjab\";s:16:\"shipping_country\";s:8:\"Pakistan\";s:7:\"comment\";s:27:\"This is order comment brooo\";s:2:\"id\";s:2:\"10\";s:10:\"User-Agent\";s:21:\"PostmanRuntime/7.24.1\";s:6:\"Accept\";s:3:\"*/*\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:13:\"Postman-Token\";s:36:\"e8da429c-c301-40c7-894e-aecfe543c5ca\";s:4:\"Host\";s:9:\"localhost\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:10:\"Connection\";s:10:\"keep-alive\";s:6:\"Cookie\";s:134:\"sma_cart_id=45c1390cc9b7a32d5e600a0b9dbba9d1; sma_token_cookie=dbc292157f5a6422d7d65950d80d6f71; sess=ijoskf7qvd67jd9vr9e8vabsebpniden\";}', '0kks8oswoksockoo4csg0cc44k8s4gw40s04448o', '::1', 1587483722, 0.030545, '1', 200),
(52, 'api/v1/products', 'get', 'a:12:{s:7:\"api-key\";s:40:\"0kks8oswoksockoo4csg0cc44k8s4gw40s04448o\";s:7:\"include\";s:15:\"photos,category\";s:5:\"start\";s:1:\"1\";s:5:\"limit\";s:2:\"10\";s:10:\"User-Agent\";s:21:\"PostmanRuntime/7.24.1\";s:6:\"Accept\";s:3:\"*/*\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:13:\"Postman-Token\";s:36:\"4dd709fc-33db-4ac2-bbdc-e9034b044b3e\";s:4:\"Host\";s:9:\"localhost\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:10:\"Connection\";s:10:\"keep-alive\";s:6:\"Cookie\";s:44:\"sma_cart_id=45c1390cc9b7a32d5e600a0b9dbba9d1\";}', '0kks8oswoksockoo4csg0cc44k8s4gw40s04448o', '::1', 1587568544, 0.050771, '1', 200),
(53, 'api/v1/products', 'get', 'a:13:{s:7:\"api-key\";s:40:\"0kks8oswoksockoo4csg0cc44k8s4gw40s04448o\";s:7:\"include\";s:15:\"photos,category\";s:5:\"start\";s:1:\"1\";s:5:\"limit\";s:2:\"10\";s:11:\"customer_id\";s:2:\"11\";s:10:\"User-Agent\";s:21:\"PostmanRuntime/7.24.1\";s:6:\"Accept\";s:3:\"*/*\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:13:\"Postman-Token\";s:36:\"79d2327d-dc61-45bf-b36a-f0a5ca09b93f\";s:4:\"Host\";s:9:\"localhost\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:10:\"Connection\";s:10:\"keep-alive\";s:6:\"Cookie\";s:134:\"sma_cart_id=45c1390cc9b7a32d5e600a0b9dbba9d1; sma_token_cookie=70575dc56e57f5bac2f9d774db4f4421; sess=09pchqspgb15pqgfkn6vo4u8e02k26b8\";}', '0kks8oswoksockoo4csg0cc44k8s4gw40s04448o', '::1', 1587568554, 0.0346551, '1', 200),
(54, 'api/v1/products', 'get', 'a:13:{s:7:\"api-key\";s:40:\"0kks8oswoksockoo4csg0cc44k8s4gw40s04448o\";s:7:\"include\";s:15:\"photos,category\";s:5:\"start\";s:1:\"1\";s:5:\"limit\";s:2:\"10\";s:9:\"fcm_token\";s:5:\"fcm11\";s:10:\"User-Agent\";s:21:\"PostmanRuntime/7.24.1\";s:6:\"Accept\";s:3:\"*/*\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:13:\"Postman-Token\";s:36:\"f99f826c-85e1-475d-a944-47c310debb65\";s:4:\"Host\";s:9:\"localhost\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:10:\"Connection\";s:10:\"keep-alive\";s:6:\"Cookie\";s:134:\"sma_cart_id=45c1390cc9b7a32d5e600a0b9dbba9d1; sma_token_cookie=70575dc56e57f5bac2f9d774db4f4421; sess=09pchqspgb15pqgfkn6vo4u8e02k26b8\";}', '0kks8oswoksockoo4csg0cc44k8s4gw40s04448o', '::1', 1587568574, 0.0390069, '1', 200),
(55, 'api/v1/Cart', 'get', 'a:21:{s:7:\"api-key\";s:40:\"0kks8oswoksockoo4csg0cc44k8s4gw40s04448o\";s:9:\"fcm_token\";s:5:\"fcm11\";s:4:\"lang\";s:6:\"arabic\";s:10:\"product_id\";s:3:\"148\";s:8:\"quantity\";s:1:\"2\";s:3:\"lat\";s:3:\"001\";s:3:\"lon\";s:3:\"002\";s:14:\"shipping_phone\";s:4:\"0345\";s:13:\"shipping_city\";s:3:\"Guj\";s:14:\"shipping_state\";s:6:\"Punjab\";s:16:\"shipping_country\";s:8:\"Pakistan\";s:7:\"comment\";s:27:\"This is order comment brooo\";s:2:\"id\";s:2:\"10\";s:10:\"User-Agent\";s:21:\"PostmanRuntime/7.24.1\";s:6:\"Accept\";s:3:\"*/*\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:13:\"Postman-Token\";s:36:\"e9f3bb7f-871e-41f3-a5e6-6cdf5358f69f\";s:4:\"Host\";s:9:\"localhost\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:10:\"Connection\";s:10:\"keep-alive\";s:6:\"Cookie\";s:134:\"sma_cart_id=45c1390cc9b7a32d5e600a0b9dbba9d1; sma_token_cookie=70575dc56e57f5bac2f9d774db4f4421; sess=09pchqspgb15pqgfkn6vo4u8e02k26b8\";}', '0kks8oswoksockoo4csg0cc44k8s4gw40s04448o', '::1', 1587568620, 0.037452, '1', 200);
INSERT INTO `sma_api_logs` (`id`, `uri`, `method`, `params`, `api_key`, `ip_address`, `time`, `rtime`, `authorized`, `response_code`) VALUES
(56, 'api/v1/products', 'get', 'a:13:{s:7:\"api-key\";s:40:\"0kks8oswoksockoo4csg0cc44k8s4gw40s04448o\";s:7:\"include\";s:15:\"photos,category\";s:5:\"start\";s:1:\"1\";s:5:\"limit\";s:2:\"10\";s:9:\"fcm_token\";s:5:\"fcm11\";s:10:\"User-Agent\";s:21:\"PostmanRuntime/7.24.1\";s:6:\"Accept\";s:3:\"*/*\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:13:\"Postman-Token\";s:36:\"1fce83bb-0193-42f3-b27c-cf35ada00c96\";s:4:\"Host\";s:9:\"localhost\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:10:\"Connection\";s:10:\"keep-alive\";s:6:\"Cookie\";s:134:\"sma_cart_id=45c1390cc9b7a32d5e600a0b9dbba9d1; sma_token_cookie=70575dc56e57f5bac2f9d774db4f4421; sess=09pchqspgb15pqgfkn6vo4u8e02k26b8\";}', '0kks8oswoksockoo4csg0cc44k8s4gw40s04448o', '::1', 1587568693, 0.035619, '1', 0),
(57, 'api/v1/products', 'get', 'a:13:{s:7:\"api-key\";s:40:\"0kks8oswoksockoo4csg0cc44k8s4gw40s04448o\";s:7:\"include\";s:15:\"photos,category\";s:5:\"start\";s:1:\"1\";s:5:\"limit\";s:2:\"10\";s:9:\"fcm_token\";s:5:\"fcm11\";s:10:\"User-Agent\";s:21:\"PostmanRuntime/7.24.1\";s:6:\"Accept\";s:3:\"*/*\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:13:\"Postman-Token\";s:36:\"06016ee1-89a4-487c-a57a-8d073e9a3603\";s:4:\"Host\";s:9:\"localhost\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:10:\"Connection\";s:10:\"keep-alive\";s:6:\"Cookie\";s:134:\"sma_cart_id=45c1390cc9b7a32d5e600a0b9dbba9d1; sma_token_cookie=70575dc56e57f5bac2f9d774db4f4421; sess=09pchqspgb15pqgfkn6vo4u8e02k26b8\";}', '0kks8oswoksockoo4csg0cc44k8s4gw40s04448o', '::1', 1587568745, 0.026051, '1', 0),
(58, 'api/v1/products', 'get', 'a:13:{s:7:\"api-key\";s:40:\"0kks8oswoksockoo4csg0cc44k8s4gw40s04448o\";s:7:\"include\";s:15:\"photos,category\";s:5:\"start\";s:1:\"1\";s:5:\"limit\";s:2:\"10\";s:9:\"fcm_token\";s:5:\"fcm11\";s:10:\"User-Agent\";s:21:\"PostmanRuntime/7.24.1\";s:6:\"Accept\";s:3:\"*/*\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:13:\"Postman-Token\";s:36:\"1d6fe1c0-a1bc-46e8-926c-ed83baffea34\";s:4:\"Host\";s:9:\"localhost\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:10:\"Connection\";s:10:\"keep-alive\";s:6:\"Cookie\";s:134:\"sma_cart_id=45c1390cc9b7a32d5e600a0b9dbba9d1; sma_token_cookie=70575dc56e57f5bac2f9d774db4f4421; sess=09pchqspgb15pqgfkn6vo4u8e02k26b8\";}', '0kks8oswoksockoo4csg0cc44k8s4gw40s04448o', '::1', 1587568768, 0.0579438, '1', 200),
(59, 'api/v1/products', 'get', 'a:13:{s:7:\"api-key\";s:40:\"0kks8oswoksockoo4csg0cc44k8s4gw40s04448o\";s:7:\"include\";s:15:\"photos,category\";s:5:\"start\";s:1:\"1\";s:5:\"limit\";s:2:\"10\";s:9:\"fcm_token\";s:5:\"fcm11\";s:10:\"User-Agent\";s:21:\"PostmanRuntime/7.24.1\";s:6:\"Accept\";s:3:\"*/*\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:13:\"Postman-Token\";s:36:\"90862eed-2629-4d8d-aed7-4d5cc0721f0d\";s:4:\"Host\";s:9:\"localhost\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:10:\"Connection\";s:10:\"keep-alive\";s:6:\"Cookie\";s:134:\"sma_cart_id=45c1390cc9b7a32d5e600a0b9dbba9d1; sma_token_cookie=70575dc56e57f5bac2f9d774db4f4421; sess=09pchqspgb15pqgfkn6vo4u8e02k26b8\";}', '0kks8oswoksockoo4csg0cc44k8s4gw40s04448o', '::1', 1587568836, 0.0641119, '1', 200),
(60, 'api/v1/products', 'get', 'a:13:{s:7:\"api-key\";s:40:\"0kks8oswoksockoo4csg0cc44k8s4gw40s04448o\";s:7:\"include\";s:15:\"photos,category\";s:5:\"start\";s:1:\"1\";s:5:\"limit\";s:2:\"10\";s:9:\"fcm_token\";s:5:\"fcm11\";s:10:\"User-Agent\";s:21:\"PostmanRuntime/7.24.1\";s:6:\"Accept\";s:3:\"*/*\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:13:\"Postman-Token\";s:36:\"6419c90a-a401-41e6-9935-9c332c316dbc\";s:4:\"Host\";s:9:\"localhost\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:10:\"Connection\";s:10:\"keep-alive\";s:6:\"Cookie\";s:134:\"sma_cart_id=45c1390cc9b7a32d5e600a0b9dbba9d1; sma_token_cookie=70575dc56e57f5bac2f9d774db4f4421; sess=09pchqspgb15pqgfkn6vo4u8e02k26b8\";}', '0kks8oswoksockoo4csg0cc44k8s4gw40s04448o', '::1', 1587568869, 0.04338, '1', 200),
(61, 'api/v1/products', 'get', 'a:13:{s:7:\"api-key\";s:40:\"0kks8oswoksockoo4csg0cc44k8s4gw40s04448o\";s:7:\"include\";s:15:\"photos,category\";s:5:\"start\";s:1:\"1\";s:5:\"limit\";s:2:\"20\";s:9:\"fcm_token\";s:5:\"fcm11\";s:10:\"User-Agent\";s:21:\"PostmanRuntime/7.24.1\";s:6:\"Accept\";s:3:\"*/*\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:13:\"Postman-Token\";s:36:\"da2e0e68-7ac1-4aab-aff5-3898acc70f99\";s:4:\"Host\";s:9:\"localhost\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:10:\"Connection\";s:10:\"keep-alive\";s:6:\"Cookie\";s:134:\"sma_cart_id=45c1390cc9b7a32d5e600a0b9dbba9d1; sma_token_cookie=70575dc56e57f5bac2f9d774db4f4421; sess=nd0i4oog57rn6h48olivb5s7jo8p9ij2\";}', '0kks8oswoksockoo4csg0cc44k8s4gw40s04448o', '::1', 1587569167, 0.0309122, '1', 0),
(62, 'api/v1/products', 'get', 'a:13:{s:7:\"api-key\";s:40:\"0kks8oswoksockoo4csg0cc44k8s4gw40s04448o\";s:7:\"include\";s:15:\"photos,category\";s:5:\"start\";s:1:\"1\";s:5:\"limit\";s:2:\"20\";s:9:\"fcm_token\";s:5:\"fcm11\";s:10:\"User-Agent\";s:21:\"PostmanRuntime/7.24.1\";s:6:\"Accept\";s:3:\"*/*\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:13:\"Postman-Token\";s:36:\"83de3251-2746-4c91-b960-c6194c9275cd\";s:4:\"Host\";s:9:\"localhost\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:10:\"Connection\";s:10:\"keep-alive\";s:6:\"Cookie\";s:134:\"sma_cart_id=45c1390cc9b7a32d5e600a0b9dbba9d1; sma_token_cookie=70575dc56e57f5bac2f9d774db4f4421; sess=nd0i4oog57rn6h48olivb5s7jo8p9ij2\";}', '0kks8oswoksockoo4csg0cc44k8s4gw40s04448o', '::1', 1587569174, 0.0339561, '1', 200),
(63, 'api/v1/products', 'get', 'a:13:{s:7:\"api-key\";s:40:\"0kks8oswoksockoo4csg0cc44k8s4gw40s04448o\";s:7:\"include\";s:15:\"photos,category\";s:5:\"start\";s:1:\"1\";s:5:\"limit\";s:2:\"20\";s:9:\"fcm_token\";s:5:\"fcm11\";s:10:\"User-Agent\";s:21:\"PostmanRuntime/7.24.1\";s:6:\"Accept\";s:3:\"*/*\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:13:\"Postman-Token\";s:36:\"739443b5-804a-41b6-82a0-862d841d99aa\";s:4:\"Host\";s:9:\"localhost\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:10:\"Connection\";s:10:\"keep-alive\";s:6:\"Cookie\";s:44:\"sma_cart_id=45c1390cc9b7a32d5e600a0b9dbba9d1\";}', '0kks8oswoksockoo4csg0cc44k8s4gw40s04448o', '::1', 1587718413, 0.119251, '1', 200),
(64, 'api/v1/products', 'get', 'a:14:{s:7:\"api-key\";s:40:\"0kks8oswoksockoo4csg0cc44k8s4gw40s04448o\";s:7:\"include\";s:15:\"photos,category\";s:5:\"start\";s:1:\"1\";s:5:\"limit\";s:2:\"20\";s:4:\"code\";s:8:\"71830599\";s:9:\"fcm_token\";s:5:\"fcm11\";s:10:\"User-Agent\";s:21:\"PostmanRuntime/7.24.1\";s:6:\"Accept\";s:3:\"*/*\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:13:\"Postman-Token\";s:36:\"0bfbb0bb-b344-4544-b2dc-f5a9973a227a\";s:4:\"Host\";s:9:\"localhost\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:10:\"Connection\";s:10:\"keep-alive\";s:6:\"Cookie\";s:134:\"sma_cart_id=45c1390cc9b7a32d5e600a0b9dbba9d1; sma_token_cookie=62b8c8a2a7a6a9516e5aaf697fef4093; sess=rqjmpfh14492i6u8pvlvnkkr6u9ak30s\";}', '0kks8oswoksockoo4csg0cc44k8s4gw40s04448o', '::1', 1587718550, 0.0765891, '1', 200),
(65, 'api/v1/products', 'get', 'a:14:{s:7:\"api-key\";s:40:\"0kks8oswoksockoo4csg0cc44k8s4gw40s04448o\";s:7:\"include\";s:15:\"photos,category\";s:5:\"start\";s:1:\"1\";s:5:\"limit\";s:2:\"20\";s:4:\"code\";s:8:\"71830599\";s:9:\"fcm_token\";s:5:\"fcm11\";s:10:\"User-Agent\";s:21:\"PostmanRuntime/7.24.1\";s:6:\"Accept\";s:3:\"*/*\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:13:\"Postman-Token\";s:36:\"82219a32-aaf1-457d-93bd-685299164351\";s:4:\"Host\";s:9:\"localhost\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:10:\"Connection\";s:10:\"keep-alive\";s:6:\"Cookie\";s:134:\"sma_cart_id=45c1390cc9b7a32d5e600a0b9dbba9d1; sma_token_cookie=62b8c8a2a7a6a9516e5aaf697fef4093; sess=rqjmpfh14492i6u8pvlvnkkr6u9ak30s\";}', '0kks8oswoksockoo4csg0cc44k8s4gw40s04448o', '::1', 1587718662, 0.077323, '1', 200),
(66, 'api/v1/Cart', 'get', 'a:22:{s:7:\"api-key\";s:40:\"0kks8oswoksockoo4csg0cc44k8s4gw40s04448o\";s:9:\"fcm_token\";s:5:\"fcm11\";s:3:\"add\";s:1:\"1\";s:4:\"lang\";s:6:\"arabic\";s:10:\"product_id\";s:3:\"138\";s:8:\"quantity\";s:1:\"2\";s:3:\"lat\";s:3:\"001\";s:3:\"lon\";s:3:\"002\";s:14:\"shipping_phone\";s:4:\"0345\";s:13:\"shipping_city\";s:3:\"Guj\";s:14:\"shipping_state\";s:6:\"Punjab\";s:16:\"shipping_country\";s:8:\"Pakistan\";s:7:\"comment\";s:27:\"This is order comment brooo\";s:2:\"id\";s:2:\"10\";s:10:\"User-Agent\";s:21:\"PostmanRuntime/7.24.1\";s:6:\"Accept\";s:3:\"*/*\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:13:\"Postman-Token\";s:36:\"3c633f93-173e-4c72-b341-1c1421b28a21\";s:4:\"Host\";s:9:\"localhost\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:10:\"Connection\";s:10:\"keep-alive\";s:6:\"Cookie\";s:134:\"sma_cart_id=45c1390cc9b7a32d5e600a0b9dbba9d1; sma_token_cookie=62b8c8a2a7a6a9516e5aaf697fef4093; sess=rqjmpfh14492i6u8pvlvnkkr6u9ak30s\";}', '0kks8oswoksockoo4csg0cc44k8s4gw40s04448o', '::1', 1587718698, 0.0584531, '1', 0),
(67, 'api/v1/products', 'get', 'a:14:{s:7:\"api-key\";s:40:\"0kks8oswoksockoo4csg0cc44k8s4gw40s04448o\";s:7:\"include\";s:15:\"photos,category\";s:5:\"start\";s:1:\"1\";s:5:\"limit\";s:2:\"20\";s:4:\"code\";s:8:\"71830599\";s:9:\"fcm_token\";s:5:\"fcm11\";s:10:\"User-Agent\";s:21:\"PostmanRuntime/7.24.1\";s:6:\"Accept\";s:3:\"*/*\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:13:\"Postman-Token\";s:36:\"ae3d98ae-2895-471b-a6e3-80a1323f54e3\";s:4:\"Host\";s:9:\"localhost\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:10:\"Connection\";s:10:\"keep-alive\";s:6:\"Cookie\";s:134:\"sma_cart_id=45c1390cc9b7a32d5e600a0b9dbba9d1; sma_token_cookie=62b8c8a2a7a6a9516e5aaf697fef4093; sess=rqjmpfh14492i6u8pvlvnkkr6u9ak30s\";}', '0kks8oswoksockoo4csg0cc44k8s4gw40s04448o', '::1', 1587718704, 0.0671229, '1', 200),
(68, 'api/v1/products', 'get', 'a:14:{s:7:\"api-key\";s:40:\"0kks8oswoksockoo4csg0cc44k8s4gw40s04448o\";s:7:\"include\";s:15:\"photos,category\";s:5:\"start\";s:1:\"1\";s:5:\"limit\";s:2:\"20\";s:4:\"code\";s:8:\"71830599\";s:9:\"fcm_token\";s:5:\"fcm11\";s:10:\"User-Agent\";s:21:\"PostmanRuntime/7.24.1\";s:6:\"Accept\";s:3:\"*/*\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:13:\"Postman-Token\";s:36:\"0cc148d6-d64a-4bbd-b707-9edf33fcddaa\";s:4:\"Host\";s:9:\"localhost\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:10:\"Connection\";s:10:\"keep-alive\";s:6:\"Cookie\";s:134:\"sma_cart_id=45c1390cc9b7a32d5e600a0b9dbba9d1; sma_token_cookie=62b8c8a2a7a6a9516e5aaf697fef4093; sess=rqjmpfh14492i6u8pvlvnkkr6u9ak30s\";}', '0kks8oswoksockoo4csg0cc44k8s4gw40s04448o', '::1', 1587718775, 0.0460241, '1', 0),
(69, 'api/v1/products', 'get', 'a:14:{s:7:\"api-key\";s:40:\"0kks8oswoksockoo4csg0cc44k8s4gw40s04448o\";s:7:\"include\";s:15:\"photos,category\";s:5:\"start\";s:1:\"1\";s:5:\"limit\";s:2:\"20\";s:4:\"code\";s:8:\"71830599\";s:9:\"fcm_token\";s:5:\"fcm11\";s:10:\"User-Agent\";s:21:\"PostmanRuntime/7.24.1\";s:6:\"Accept\";s:3:\"*/*\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:13:\"Postman-Token\";s:36:\"76a9bf7b-eb01-4167-9576-ff96e4be6477\";s:4:\"Host\";s:9:\"localhost\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:10:\"Connection\";s:10:\"keep-alive\";s:6:\"Cookie\";s:134:\"sma_cart_id=45c1390cc9b7a32d5e600a0b9dbba9d1; sma_token_cookie=62b8c8a2a7a6a9516e5aaf697fef4093; sess=jhovthlpk6cg490dnnh7higbsljpob51\";}', '0kks8oswoksockoo4csg0cc44k8s4gw40s04448o', '::1', 1587718788, 0.0551801, '1', 200),
(70, 'api/v1/Cart', 'get', 'a:22:{s:7:\"api-key\";s:40:\"0kks8oswoksockoo4csg0cc44k8s4gw40s04448o\";s:9:\"fcm_token\";s:5:\"fcm11\";s:3:\"add\";s:1:\"1\";s:4:\"lang\";s:6:\"arabic\";s:10:\"product_id\";s:3:\"138\";s:8:\"quantity\";s:1:\"5\";s:3:\"lat\";s:3:\"001\";s:3:\"lon\";s:3:\"002\";s:14:\"shipping_phone\";s:4:\"0345\";s:13:\"shipping_city\";s:3:\"Guj\";s:14:\"shipping_state\";s:6:\"Punjab\";s:16:\"shipping_country\";s:8:\"Pakistan\";s:7:\"comment\";s:27:\"This is order comment brooo\";s:2:\"id\";s:2:\"10\";s:10:\"User-Agent\";s:21:\"PostmanRuntime/7.24.1\";s:6:\"Accept\";s:3:\"*/*\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:13:\"Postman-Token\";s:36:\"089804ef-4225-4cd4-96ab-0be296408334\";s:4:\"Host\";s:9:\"localhost\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:10:\"Connection\";s:10:\"keep-alive\";s:6:\"Cookie\";s:134:\"sma_cart_id=45c1390cc9b7a32d5e600a0b9dbba9d1; sma_token_cookie=62b8c8a2a7a6a9516e5aaf697fef4093; sess=jhovthlpk6cg490dnnh7higbsljpob51\";}', '0kks8oswoksockoo4csg0cc44k8s4gw40s04448o', '::1', 1587718799, 0.0677719, '1', 0),
(71, 'api/v1/products', 'get', 'a:14:{s:7:\"api-key\";s:40:\"0kks8oswoksockoo4csg0cc44k8s4gw40s04448o\";s:7:\"include\";s:15:\"photos,category\";s:5:\"start\";s:1:\"1\";s:5:\"limit\";s:2:\"20\";s:4:\"code\";s:8:\"71830599\";s:9:\"fcm_token\";s:5:\"fcm11\";s:10:\"User-Agent\";s:21:\"PostmanRuntime/7.24.1\";s:6:\"Accept\";s:3:\"*/*\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:13:\"Postman-Token\";s:36:\"190c5849-afb0-47e6-a401-0cbb82a5e44a\";s:4:\"Host\";s:9:\"localhost\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:10:\"Connection\";s:10:\"keep-alive\";s:6:\"Cookie\";s:134:\"sma_cart_id=45c1390cc9b7a32d5e600a0b9dbba9d1; sma_token_cookie=62b8c8a2a7a6a9516e5aaf697fef4093; sess=jhovthlpk6cg490dnnh7higbsljpob51\";}', '0kks8oswoksockoo4csg0cc44k8s4gw40s04448o', '::1', 1587718804, 0.047219, '1', 200),
(72, 'api/v1/products', 'get', 'a:13:{s:7:\"api-key\";s:40:\"0kks8oswoksockoo4csg0cc44k8s4gw40s04448o\";s:7:\"include\";s:15:\"photos,category\";s:5:\"start\";s:1:\"1\";s:5:\"limit\";s:2:\"20\";s:9:\"fcm_token\";s:5:\"fcm11\";s:10:\"User-Agent\";s:21:\"PostmanRuntime/7.24.1\";s:6:\"Accept\";s:3:\"*/*\";s:13:\"Cache-Control\";s:8:\"no-cache\";s:13:\"Postman-Token\";s:36:\"2315b367-c2d6-4a94-92e6-49f4c9a8d1b2\";s:4:\"Host\";s:9:\"localhost\";s:15:\"Accept-Encoding\";s:17:\"gzip, deflate, br\";s:10:\"Connection\";s:10:\"keep-alive\";s:6:\"Cookie\";s:134:\"sma_cart_id=45c1390cc9b7a32d5e600a0b9dbba9d1; sma_token_cookie=62b8c8a2a7a6a9516e5aaf697fef4093; sess=jhovthlpk6cg490dnnh7higbsljpob51\";}', '0kks8oswoksockoo4csg0cc44k8s4gw40s04448o', '::1', 1587718824, 0.091625, '1', 200);

-- --------------------------------------------------------

--
-- Table structure for table `sma_calendar`
--

CREATE TABLE `sma_calendar` (
  `id` int(11) NOT NULL,
  `title` varchar(55) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `start` datetime NOT NULL,
  `end` datetime DEFAULT NULL,
  `color` varchar(7) NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sma_captcha`
--

CREATE TABLE `sma_captcha` (
  `captcha_id` bigint(13) UNSIGNED NOT NULL,
  `captcha_time` int(10) UNSIGNED NOT NULL,
  `ip_address` varchar(16) CHARACTER SET latin1 NOT NULL DEFAULT '0',
  `word` varchar(20) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sma_cart`
--

CREATE TABLE `sma_cart` (
  `id` int(11) NOT NULL,
  `time` varchar(30) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `data` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sma_cart`
--

INSERT INTO `sma_cart` (`id`, `time`, `user_id`, `data`) VALUES
(246, '1587718799', 11, '{\"6793d9dc2ae3429d488a7374bc85d2a0\":{\"id\":\"47d1e990583c9c67424d369f3414728e\",\"product_id\":\"148\",\"product_details\":\"<p>10 KG<\\/p>\",\"details\":\"<p>A <strong>banana<\\/strong> is an edible \\r\\nfruit \\u2013 botanically a berry \\u2013 produced by several kinds of large \\r\\nherbaceous flowering plants in the genus Musa. In some countries, <strong>bananas<\\/strong> used for cooking may be called \\\"plantains\\\", distinguishing them from dessert <strong>bananas<\\/strong>. ... The fruits grow in clusters hanging from the top of the plant.<\\/p>\",\"qty\":2,\"name\":\"Pine apple\",\"price\":\"4.000\",\"image\":\"http:\\/\\/localhost\\/alawi-live\\/assets\\/uploads\\/edc7ec9c59c514915dd3eb2dec7ffcc7.jpeg\",\"trans_name\":\"\\u0623\\u0646\\u0627\\u0646\\u0627\\u0633\",\"trans_product_details\":\"<p>\\u0645\\u0639 \\u0625\\u0646\\u062a\\u0627\\u062c \\u0639\\u0627\\u0644\\u0645\\u064a \\u064a\\u0632\\u064a\\u062f \\u0639\\u0646 18 \\u0645\\u0644\\u064a\\u0648\\u0646 \\u0637\\u0646 \\u0641\\u064a \\u0639\\u0627\\u0645 2009 \\u060c \\u062a\\u062d\\u062a\\u0644 \\u0627\\u0644\\u0623\\u0646\\u0627\\u0646\\u0627\\u0633 \\u0627\\u0644\\u0645\\u0631\\u062a\\u0628\\u0629 12 \\u0628\\u064a\\u0646 \\u0645\\u062d\\u0627\\u0635\\u064a\\u0644 \\u0627\\u0644\\u0641\\u0627\\u0643\\u0647\\u0629 \\u0641\\u064a \\u062c\\u0645\\u064a\\u0639 \\u0623\\u0646\\u062d\\u0627\\u0621 \\u0627\\u0644\\u0639\\u0627\\u0644\\u0645 (\\u0645\\u0646\\u0638\\u0645\\u0629 \\u0627\\u0644\\u0623\\u063a\\u0630\\u064a\\u0629 \\u0648\\u0627\\u0644\\u0632\\u0631\\u0627\\u0639\\u0629 \\u060c 2011). \\u064a\\u062a\\u0645 \\u0627\\u0633\\u062a\\u0647\\u0644\\u0627\\u0643 \\u062d\\u0648\\u0627\\u0644\\u064a 70 \\u066a \\u0645\\u0646 \\u0627\\u0644\\u0623\\u0646\\u0627\\u0646\\u0627\\u0633 \\u0627\\u0644\\u0645\\u0646\\u062a\\u062c \\u0641\\u064a \\u0627\\u0644\\u0639\\u0627\\u0644\\u0645 \\u0643\\u0641\\u0627\\u0643\\u0647\\u0629 \\u0637\\u0627\\u0632\\u062c\\u0629 \\u0641\\u064a \\u0628\\u0644\\u062f \\u0627\\u0644\\u0645\\u0646\\u0634\\u0623<\\/p>\",\"trans_details\":\"\",\"rowid\":\"6793d9dc2ae3429d488a7374bc85d2a0\",\"subtotal\":\"8.0000\"},\"cart_total\":18,\"total_items\":7,\"total_unique_items\":2,\"c3a84b38a0489b202ebfef7c9f856299\":{\"id\":\"013d407166ec4fa56eb1e1f8cbe183b9\",\"product_id\":\"138\",\"product_details\":\"<p>8 KG<\\/p>\",\"details\":\"<p>A <strong>banana<\\/strong> is an edible \\r\\nfruit \\u2013 botanically a berry \\u2013 produced by several kinds of large \\r\\nherbaceous flowering plants in the genus Musa. In some countries, <strong>bananas<\\/strong> used for cooking may be called \\\"plantains\\\", distinguishing them from dessert <strong>bananas<\\/strong>. ... The fruits grow in clusters hanging from the top of the plant.<\\/p>\",\"qty\":5,\"name\":\"Apple\",\"price\":\"2.000\",\"image\":\"http:\\/\\/localhost\\/alawi-live2\\/assets\\/uploads\\/d6328ca3f2ba5051f38c34ca09beb8e8.jpeg\",\"trans_name\":\"\\u062a\\u0641\\u0627\\u062d\\u0629\",\"trans_product_details\":\"<p>\\u0627\\u0644\\u0645\\u0648\\u0632 \\u0647\\u0648 \\u0641\\u0627\\u0643\\u0647\\u0629 \\u0635\\u0627\\u0644\\u062d\\u0629 \\u0644\\u0644\\u0623\\u0643\\u0644 - \\u062a\\u0648\\u062a \\u0646\\u0628\\u0627\\u062a\\u064a - \\u062a\\u0646\\u062a\\u062c\\u0647\\u0627 \\u0639\\u062f\\u0629 \\u0623\\u0646\\u0648\\u0627\\u0639 \\u0645\\u0646 \\u0627\\u0644\\u0646\\u0628\\u0627\\u062a\\u0627\\u062a \\r\\n\\u0627\\u0644\\u0645\\u0632\\u0647\\u0631\\u0629 \\u0627\\u0644\\u0639\\u0634\\u0628\\u064a\\u0629 \\u0627\\u0644\\u0643\\u0628\\u064a\\u0631\\u0629 \\u0641\\u064a \\u062c\\u0646\\u0633 \\u0645\\u0648\\u0633\\u0649. \\u0641\\u064a \\u0628\\u0639\\u0636 \\u0627\\u0644\\u0628\\u0644\\u062f\\u0627\\u0646 \\u060c \\u064a\\u0645\\u0643\\u0646 \\u0623\\u0646 \\u064a\\u0637\\u0644\\u0642 \\u0639\\u0644\\u0649 \\r\\n\\u0627\\u0644\\u0645\\u0648\\u0632 \\u0627\\u0644\\u0645\\u0633\\u062a\\u062e\\u062f\\u0645 \\u0641\\u064a \\u0627\\u0644\\u0637\\u0647\\u064a \\\"\\u0627\\u0644\\u0645\\u0648\\u0632\\\" \\u060c \\u0645\\u0645\\u0627 \\u064a\\u0645\\u064a\\u0632\\u0647 \\u0639\\u0646 \\u0627\\u0644\\u0645\\u0648\\u0632 \\u0627\\u0644\\u062d\\u0644\\u0648. ... \\u062a\\u0646\\u0645\\u0648 \\r\\n\\u0627\\u0644\\u062b\\u0645\\u0627\\u0631 \\u0641\\u064a \\u0645\\u062c\\u0645\\u0648\\u0639\\u0627\\u062a \\u0645\\u0639\\u0644\\u0642\\u0629 \\u0645\\u0646 \\u0623\\u0639\\u0644\\u0649 \\u0627\\u0644\\u0646\\u0628\\u0627\\u062a.<\\/p>\",\"trans_details\":\"<p>8kg<\\/p>\",\"rowid\":\"c3a84b38a0489b202ebfef7c9f856299\",\"subtotal\":\"10.0000\"}}');

-- --------------------------------------------------------

--
-- Table structure for table `sma_cart_web`
--

CREATE TABLE `sma_cart_web` (
  `id` varchar(50) NOT NULL,
  `time` varchar(30) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `data` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sma_categories`
--

CREATE TABLE `sma_categories` (
  `id` int(11) NOT NULL,
  `code` varchar(55) NOT NULL,
  `name` varchar(55) NOT NULL,
  `image` varchar(55) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `slug` varchar(55) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sma_categories`
--

INSERT INTO `sma_categories` (`id`, `code`, `name`, `image`, `parent_id`, `slug`, `description`) VALUES
(32, '01', 'Fruits and Vegtables', NULL, NULL, 'FruitsandVegtables', 'Fruits and Vegtables Desc');

-- --------------------------------------------------------

--
-- Table structure for table `sma_categories_translation`
--

CREATE TABLE `sma_categories_translation` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `trans_name` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `trans_description` text NOT NULL,
  `trans_lang` varchar(10) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sma_categories_translation`
--

INSERT INTO `sma_categories_translation` (`id`, `category_id`, `trans_name`, `trans_description`, `trans_lang`) VALUES
(1, 47, 'Detergents Ar', 'Detergents Desc Ar', 'arabic'),
(2, 46, 'Cold Drinks Ar', 'Cold Drinks Desc Ar', 'arabic'),
(3, 3, 'Cloths Ar', 'Cloths Desc Ar', 'arabic'),
(4, 32, 'فواكه وخضروات', 'وصف الفواكه والخضروات', 'arabic');

-- --------------------------------------------------------

--
-- Table structure for table `sma_companies`
--

CREATE TABLE `sma_companies` (
  `id` int(11) NOT NULL,
  `fcm_token` text,
  `group_name` varchar(20) DEFAULT NULL,
  `name` varchar(55) DEFAULT NULL,
  `company` varchar(255) DEFAULT NULL,
  `vat_no` varchar(100) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(55) DEFAULT NULL,
  `state` varchar(55) DEFAULT NULL,
  `postal_code` varchar(8) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `logo` varchar(255) DEFAULT 'logo.png',
  `invoice_footer` text,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sma_companies`
--

INSERT INTO `sma_companies` (`id`, `fcm_token`, `group_name`, `name`, `company`, `vat_no`, `address`, `city`, `state`, `postal_code`, `country`, `phone`, `email`, `logo`, `invoice_footer`, `created_at`) VALUES
(3, NULL, 'biller', 'Alawi', 'Alawi', NULL, NULL, 'Muscat', NULL, NULL, 'Oman', '98593372', 'AlawiExpress@gmail.com', 'Website-Logo3.png', NULL, '2020-04-20 18:46:08'),
(11, 'fcm11', 'customer', 'Atta Ur Rehman', '-', NULL, '', NULL, NULL, NULL, NULL, '3213', 'atta@gmail.com', 'logo.png', NULL, '2020-04-21 10:43:36'),
(12, NULL, NULL, 'Ebad', '-', NULL, NULL, NULL, NULL, NULL, NULL, '0456789', 'ebad@g.com', 'logo.png', NULL, NULL),
(13, NULL, 'customer', 'hassan', '-', NULL, NULL, NULL, NULL, NULL, NULL, '444555', 'hassan@g.com', 'logo.png', NULL, '2020-04-24 09:46:29'),
(14, NULL, 'customer', 'shary', '-', NULL, NULL, NULL, NULL, NULL, NULL, '1111', 'shary@gmail.com', 'logo.png', NULL, '2020-04-24 10:20:17');

-- --------------------------------------------------------

--
-- Table structure for table `sma_currencies`
--

CREATE TABLE `sma_currencies` (
  `id` int(11) NOT NULL,
  `code` varchar(5) NOT NULL,
  `name` varchar(55) NOT NULL,
  `rate` decimal(12,4) NOT NULL,
  `auto_update` tinyint(1) NOT NULL DEFAULT '0',
  `symbol` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sma_currencies`
--

INSERT INTO `sma_currencies` (`id`, `code`, `name`, `rate`, `auto_update`, `symbol`) VALUES
(3, 'OMR', 'OMR', '1.0000', 0, 'OMR');

-- --------------------------------------------------------

--
-- Table structure for table `sma_date_format`
--

CREATE TABLE `sma_date_format` (
  `id` int(11) NOT NULL,
  `js` varchar(20) NOT NULL,
  `php` varchar(20) NOT NULL,
  `sql` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sma_date_format`
--

INSERT INTO `sma_date_format` (`id`, `js`, `php`, `sql`) VALUES
(1, 'mm-dd-yyyy', 'm-d-Y', '%m-%d-%Y'),
(2, 'mm/dd/yyyy', 'm/d/Y', '%m/%d/%Y'),
(3, 'mm.dd.yyyy', 'm.d.Y', '%m.%d.%Y'),
(4, 'dd-mm-yyyy', 'd-m-Y', '%d-%m-%Y'),
(5, 'dd/mm/yyyy', 'd/m/Y', '%d/%m/%Y'),
(6, 'dd.mm.yyyy', 'd.m.Y', '%d.%m.%Y');

-- --------------------------------------------------------

--
-- Table structure for table `sma_deposits`
--

CREATE TABLE `sma_deposits` (
  `id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `company_id` int(11) NOT NULL,
  `amount` decimal(25,4) NOT NULL,
  `paid_by` varchar(50) DEFAULT NULL,
  `note` varchar(255) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sma_deposits`
--

INSERT INTO `sma_deposits` (`id`, `date`, `company_id`, `amount`, `paid_by`, `note`, `created_by`, `updated_by`, `updated_at`) VALUES
(1, '2018-08-08 23:44:00', 1, '500.0000', 'EcoCash', '<p>Deposit paid in my customer</p>', 2, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sma_floors`
--

CREATE TABLE `sma_floors` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `lift_option` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sma_floors`
--

INSERT INTO `sma_floors` (`id`, `name`, `slug`, `lift_option`, `created_at`, `updated_at`) VALUES
(4, 'Basement', 'ground', 0, '2020-05-15 14:05:02', '2020-05-30 07:13:32'),
(5, 'Ground floor', 'ground', 0, '2020-05-15 14:05:25', '2020-05-30 07:13:53'),
(6, '1st floor', 'first', 1, '2020-05-15 14:05:40', '2020-05-30 07:14:03'),
(7, '2nd floor', 'second', 1, '2020-05-15 14:05:52', '2020-05-30 07:14:12'),
(8, '3rd floor', 'third', 1, '2020-05-15 14:06:07', '2020-05-30 07:14:20'),
(9, '4th floor', 'fourth', 1, '2020-05-15 14:06:24', '2020-05-30 07:14:30'),
(10, '5th floor', 'fifth', 1, '2020-05-15 14:06:36', '2020-05-30 07:14:38'),
(11, '6th floor', 'sixth', 1, '2020-05-15 14:06:47', '2020-05-30 07:14:51'),
(12, 'Above 6th floor', 'sixth', 1, '2020-05-15 14:07:23', '2020-05-30 07:15:08');

-- --------------------------------------------------------

--
-- Table structure for table `sma_groups`
--

CREATE TABLE `sma_groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sma_groups`
--

INSERT INTO `sma_groups` (`id`, `name`, `description`) VALUES
(1, 'owner', 'Owner'),
(2, 'admin', 'Administrator'),
(3, 'customer', 'Customer'),
(5, 'sales', 'Sales Staff'),
(6, 'viewer', 'Only can view');

-- --------------------------------------------------------

--
-- Table structure for table `sma_login_attempts`
--

CREATE TABLE `sma_login_attempts` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `ip_address` varbinary(16) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sma_migrations`
--

CREATE TABLE `sma_migrations` (
  `version` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sma_migrations`
--

INSERT INTO `sma_migrations` (`version`) VALUES
(315);

-- --------------------------------------------------------

--
-- Table structure for table `sma_notifications`
--

CREATE TABLE `sma_notifications` (
  `id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `from_date` datetime DEFAULT NULL,
  `till_date` datetime DEFAULT NULL,
  `scope` tinyint(1) NOT NULL DEFAULT '3'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sma_order_ref`
--

CREATE TABLE `sma_order_ref` (
  `ref_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `so` int(11) NOT NULL DEFAULT '1',
  `qu` int(11) NOT NULL DEFAULT '1',
  `po` int(11) NOT NULL DEFAULT '1',
  `to` int(11) NOT NULL DEFAULT '1',
  `pos` int(11) NOT NULL DEFAULT '1',
  `do` int(11) NOT NULL DEFAULT '1',
  `pay` int(11) NOT NULL DEFAULT '1',
  `re` int(11) NOT NULL DEFAULT '1',
  `rep` int(11) NOT NULL DEFAULT '1',
  `ex` int(11) NOT NULL DEFAULT '1',
  `ppay` int(11) NOT NULL DEFAULT '1',
  `qa` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sma_order_ref`
--

INSERT INTO `sma_order_ref` (`ref_id`, `date`, `so`, `qu`, `po`, `to`, `pos`, `do`, `pay`, `re`, `rep`, `ex`, `ppay`, `qa`) VALUES
(1, '2018-08-01', 217, 2, 28, 1, 23, 1, 26, 2, 1, 4, 12, 9);

-- --------------------------------------------------------

--
-- Table structure for table `sma_pages`
--

CREATE TABLE `sma_pages` (
  `id` int(11) NOT NULL,
  `name` varchar(15) NOT NULL,
  `title` varchar(60) NOT NULL,
  `description` varchar(180) NOT NULL,
  `slug` varchar(55) DEFAULT NULL,
  `body` text NOT NULL,
  `active` tinyint(1) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `order_no` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sma_permissions`
--

CREATE TABLE `sma_permissions` (
  `id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `products-index` tinyint(1) DEFAULT '0',
  `products-add` tinyint(1) DEFAULT '0',
  `products-edit` tinyint(1) DEFAULT '0',
  `products-delete` tinyint(1) DEFAULT '0',
  `products-cost` tinyint(1) DEFAULT '0',
  `products-price` tinyint(1) DEFAULT '0',
  `quotes-index` tinyint(1) DEFAULT '0',
  `quotes-add` tinyint(1) DEFAULT '0',
  `quotes-edit` tinyint(1) DEFAULT '0',
  `quotes-pdf` tinyint(1) DEFAULT '0',
  `quotes-email` tinyint(1) DEFAULT '0',
  `quotes-delete` tinyint(1) DEFAULT '0',
  `sales-index` tinyint(1) DEFAULT '0',
  `sales-add` tinyint(1) DEFAULT '0',
  `sales-edit` tinyint(1) DEFAULT '0',
  `sales-pdf` tinyint(1) DEFAULT '0',
  `sales-email` tinyint(1) DEFAULT '0',
  `sales-delete` tinyint(1) DEFAULT '0',
  `purchases-index` tinyint(1) DEFAULT '0',
  `purchases-add` tinyint(1) DEFAULT '0',
  `purchases-edit` tinyint(1) DEFAULT '0',
  `purchases-pdf` tinyint(1) DEFAULT '0',
  `purchases-email` tinyint(1) DEFAULT '0',
  `purchases-delete` tinyint(1) DEFAULT '0',
  `transfers-index` tinyint(1) DEFAULT '0',
  `transfers-add` tinyint(1) DEFAULT '0',
  `transfers-edit` tinyint(1) DEFAULT '0',
  `transfers-pdf` tinyint(1) DEFAULT '0',
  `transfers-email` tinyint(1) DEFAULT '0',
  `transfers-delete` tinyint(1) DEFAULT '0',
  `customers-index` tinyint(1) DEFAULT '0',
  `customers-add` tinyint(1) DEFAULT '0',
  `customers-edit` tinyint(1) DEFAULT '0',
  `customers-delete` tinyint(1) DEFAULT '0',
  `suppliers-index` tinyint(1) DEFAULT '0',
  `suppliers-add` tinyint(1) DEFAULT '0',
  `suppliers-edit` tinyint(1) DEFAULT '0',
  `suppliers-delete` tinyint(1) DEFAULT '0',
  `sales-deliveries` tinyint(1) DEFAULT '0',
  `sales-add_delivery` tinyint(1) DEFAULT '0',
  `sales-edit_delivery` tinyint(1) DEFAULT '0',
  `sales-delete_delivery` tinyint(1) DEFAULT '0',
  `sales-email_delivery` tinyint(1) DEFAULT '0',
  `sales-pdf_delivery` tinyint(1) DEFAULT '0',
  `sales-gift_cards` tinyint(1) DEFAULT '0',
  `sales-add_gift_card` tinyint(1) DEFAULT '0',
  `sales-edit_gift_card` tinyint(1) DEFAULT '0',
  `sales-delete_gift_card` tinyint(1) DEFAULT '0',
  `pos-index` tinyint(1) DEFAULT '0',
  `sales-return_sales` tinyint(1) DEFAULT '0',
  `reports-index` tinyint(1) DEFAULT '0',
  `reports-warehouse_stock` tinyint(1) DEFAULT '0',
  `reports-quantity_alerts` tinyint(1) DEFAULT '0',
  `reports-expiry_alerts` tinyint(1) DEFAULT '0',
  `reports-products` tinyint(1) DEFAULT '0',
  `reports-daily_sales` tinyint(1) DEFAULT '0',
  `reports-monthly_sales` tinyint(1) DEFAULT '0',
  `reports-sales` tinyint(1) DEFAULT '0',
  `reports-payments` tinyint(1) DEFAULT '0',
  `reports-purchases` tinyint(1) DEFAULT '0',
  `reports-profit_loss` tinyint(1) DEFAULT '0',
  `reports-customers` tinyint(1) DEFAULT '0',
  `reports-suppliers` tinyint(1) DEFAULT '0',
  `reports-staff` tinyint(1) DEFAULT '0',
  `reports-register` tinyint(1) DEFAULT '0',
  `sales-payments` tinyint(1) DEFAULT '0',
  `purchases-payments` tinyint(1) DEFAULT '0',
  `purchases-expenses` tinyint(1) DEFAULT '0',
  `products-adjustments` tinyint(1) NOT NULL DEFAULT '0',
  `bulk_actions` tinyint(1) NOT NULL DEFAULT '0',
  `customers-deposits` tinyint(1) NOT NULL DEFAULT '0',
  `customers-delete_deposit` tinyint(1) NOT NULL DEFAULT '0',
  `products-barcode` tinyint(1) NOT NULL DEFAULT '0',
  `purchases-return_purchases` tinyint(1) NOT NULL DEFAULT '0',
  `reports-expenses` tinyint(1) NOT NULL DEFAULT '0',
  `reports-daily_purchases` tinyint(1) DEFAULT '0',
  `reports-monthly_purchases` tinyint(1) DEFAULT '0',
  `products-stock_count` tinyint(1) DEFAULT '0',
  `edit_price` tinyint(1) DEFAULT '0',
  `returns-index` tinyint(1) DEFAULT '0',
  `returns-add` tinyint(1) DEFAULT '0',
  `returns-edit` tinyint(1) DEFAULT '0',
  `returns-delete` tinyint(1) DEFAULT '0',
  `returns-email` tinyint(1) DEFAULT '0',
  `returns-pdf` tinyint(1) DEFAULT '0',
  `reports-tax` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sma_permissions`
--

INSERT INTO `sma_permissions` (`id`, `group_id`, `products-index`, `products-add`, `products-edit`, `products-delete`, `products-cost`, `products-price`, `quotes-index`, `quotes-add`, `quotes-edit`, `quotes-pdf`, `quotes-email`, `quotes-delete`, `sales-index`, `sales-add`, `sales-edit`, `sales-pdf`, `sales-email`, `sales-delete`, `purchases-index`, `purchases-add`, `purchases-edit`, `purchases-pdf`, `purchases-email`, `purchases-delete`, `transfers-index`, `transfers-add`, `transfers-edit`, `transfers-pdf`, `transfers-email`, `transfers-delete`, `customers-index`, `customers-add`, `customers-edit`, `customers-delete`, `suppliers-index`, `suppliers-add`, `suppliers-edit`, `suppliers-delete`, `sales-deliveries`, `sales-add_delivery`, `sales-edit_delivery`, `sales-delete_delivery`, `sales-email_delivery`, `sales-pdf_delivery`, `sales-gift_cards`, `sales-add_gift_card`, `sales-edit_gift_card`, `sales-delete_gift_card`, `pos-index`, `sales-return_sales`, `reports-index`, `reports-warehouse_stock`, `reports-quantity_alerts`, `reports-expiry_alerts`, `reports-products`, `reports-daily_sales`, `reports-monthly_sales`, `reports-sales`, `reports-payments`, `reports-purchases`, `reports-profit_loss`, `reports-customers`, `reports-suppliers`, `reports-staff`, `reports-register`, `sales-payments`, `purchases-payments`, `purchases-expenses`, `products-adjustments`, `bulk_actions`, `customers-deposits`, `customers-delete_deposit`, `products-barcode`, `purchases-return_purchases`, `reports-expenses`, `reports-daily_purchases`, `reports-monthly_purchases`, `products-stock_count`, `edit_price`, `returns-index`, `returns-add`, `returns-edit`, `returns-delete`, `returns-email`, `returns-pdf`, `reports-tax`) VALUES
(1, 5, 1, 0, 0, 0, 0, 0, 1, 1, 1, 1, 1, 0, 1, 1, 0, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 0, 0, 0, 0, 0, 1, 1, 1, 0, 0, 1, 1, 1, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(2, 6, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, 0, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sma_pos_settings`
--

CREATE TABLE `sma_pos_settings` (
  `pos_id` int(1) NOT NULL,
  `cat_limit` int(11) NOT NULL,
  `pro_limit` int(11) NOT NULL,
  `default_category` int(11) NOT NULL,
  `default_customer` int(11) NOT NULL,
  `default_biller` int(11) NOT NULL,
  `display_time` varchar(3) NOT NULL DEFAULT 'yes',
  `receipt_printer` varchar(55) DEFAULT NULL,
  `cash_drawer_codes` varchar(55) DEFAULT NULL,
  `focus_add_item` varchar(55) DEFAULT NULL,
  `add_manual_product` varchar(55) DEFAULT NULL,
  `customer_selection` varchar(55) DEFAULT NULL,
  `add_customer` varchar(55) DEFAULT NULL,
  `toggle_category_slider` varchar(55) DEFAULT NULL,
  `toggle_subcategory_slider` varchar(55) DEFAULT NULL,
  `cancel_sale` varchar(55) DEFAULT NULL,
  `suspend_sale` varchar(55) DEFAULT NULL,
  `print_items_list` varchar(55) DEFAULT NULL,
  `finalize_sale` varchar(55) DEFAULT NULL,
  `today_sale` varchar(55) DEFAULT NULL,
  `open_hold_bills` varchar(55) DEFAULT NULL,
  `close_register` varchar(55) DEFAULT NULL,
  `keyboard` tinyint(1) NOT NULL,
  `pos_printers` varchar(255) DEFAULT NULL,
  `java_applet` tinyint(1) NOT NULL,
  `product_button_color` varchar(20) NOT NULL DEFAULT 'default',
  `tooltips` tinyint(1) DEFAULT '1',
  `rounding` tinyint(1) DEFAULT '0',
  `char_per_line` tinyint(4) DEFAULT '42',
  `pin_code` varchar(20) DEFAULT NULL,
  `version` varchar(10) DEFAULT '3.4.6',
  `after_sale_page` tinyint(1) DEFAULT '0',
  `item_order` tinyint(1) DEFAULT '0',
  `authorize` tinyint(1) DEFAULT '0',
  `toggle_brands_slider` varchar(55) DEFAULT NULL,
  `remote_printing` tinyint(1) DEFAULT '1',
  `printer` int(11) DEFAULT NULL,
  `order_printers` varchar(55) DEFAULT NULL,
  `auto_print` tinyint(1) DEFAULT '0',
  `customer_details` tinyint(1) DEFAULT NULL,
  `local_printers` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sma_pos_settings`
--

INSERT INTO `sma_pos_settings` (`pos_id`, `cat_limit`, `pro_limit`, `default_category`, `default_customer`, `default_biller`, `display_time`, `receipt_printer`, `cash_drawer_codes`, `focus_add_item`, `add_manual_product`, `customer_selection`, `add_customer`, `toggle_category_slider`, `toggle_subcategory_slider`, `cancel_sale`, `suspend_sale`, `print_items_list`, `finalize_sale`, `today_sale`, `open_hold_bills`, `close_register`, `keyboard`, `pos_printers`, `java_applet`, `product_button_color`, `tooltips`, `rounding`, `char_per_line`, `pin_code`, `version`, `after_sale_page`, `item_order`, `authorize`, `toggle_brands_slider`, `remote_printing`, `printer`, `order_printers`, `auto_print`, `customer_details`, `local_printers`) VALUES
(1, 22, 50, 7, 1, 3, '1', NULL, 'x1C', 'Ctrl+F3', 'Ctrl+Shift+M', 'Ctrl+Shift+C', 'Ctrl+Shift+A', 'Ctrl+F11', 'Ctrl+F12', 'F4', 'F7', 'F9', 'F8', 'Ctrl+F1', 'Ctrl+F2', 'Ctrl+F10', 1, NULL, 0, 'default', 1, 0, 42, NULL, '3.4.6', 0, 0, 0, '', 1, NULL, 'null', 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sma_printers`
--

CREATE TABLE `sma_printers` (
  `id` int(11) NOT NULL,
  `title` varchar(55) NOT NULL,
  `type` varchar(25) NOT NULL,
  `profile` varchar(25) NOT NULL,
  `char_per_line` tinyint(3) UNSIGNED DEFAULT NULL,
  `path` varchar(255) DEFAULT NULL,
  `ip_address` varbinary(45) DEFAULT NULL,
  `port` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `slug` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sma_products`
--

INSERT INTO `sma_products` (`id`, `name`, `price`, `image`, `details`, `product_type`, `type`, `parent`, `lift_option`, `font`, `price_added`, `slug`) VALUES
(1, 'Sofas', '123.0000', '962f6433949e5b1f1c0f37b8a2511d63.png', '', 'furniture_delivery', 'product', 0, NULL, NULL, 0, NULL),
(2, 'Two Seater Sofa', '123.0000', 'no_image.png', NULL, 'furniture_delivery', 'sub_product', 1, NULL, NULL, 1, NULL),
(3, 'Three Seater Sofa', '123.0000', 'no_image.png', NULL, 'furniture_delivery', 'sub_product', 1, NULL, NULL, 1, NULL),
(4, 'Four Seater Sofa', '123.0000', 'no_image.png', NULL, 'furniture_delivery', 'sub_product', 1, NULL, NULL, 1, NULL),
(5, 'Wardrobes', '123.0000', 'e4161d189d9c3e1ccfc6e34fd42aaa66.png', '<p>All Wardrobes</p>', 'furniture_delivery', 'product', 0, NULL, NULL, 0, NULL),
(6, 'Boxes', '123.0000', '4e9c43605e533bf96567268bcb784258.png', '<p>All Boxes</p>', 'furniture_delivery', 'product', 0, NULL, NULL, 0, NULL),
(7, 'Beds & Mattresses', '123.0000', 'd498d1f88f164bf40675c1d5ceeed7f4.png', '<p>All Beds & Mattresses</p>', 'furniture_delivery', 'product', 0, NULL, NULL, 0, NULL),
(8, 'Tables', '123.0000', '883e3844ae511141d1ea192629b5ef61.png', '<p>All Tables</p>', 'furniture_delivery', 'product', 0, NULL, NULL, 0, NULL),
(9, 'Televisions', '123.0000', '05ea9e7ce8b0fbd7ba8d5928d8621837.png', '<p>All Televisions</p>', 'furniture_delivery', 'product', 0, NULL, NULL, 0, NULL),
(10, 'Clothing', '123.0000', '6759fc0b530540a81d9c6d3f4f4f00b3.png', '<p>All Clothing</p>', 'furniture_delivery', 'product', 0, NULL, NULL, 0, NULL),
(11, 'Chairs', '123.0000', '784490a7ccb52dc39ae589f50f5759b7.png', '<p>All Chairs</p>', 'furniture_delivery', 'product', 0, NULL, NULL, 0, NULL),
(12, 'Single Wardrobe', '123.0000', 'no_image.png', NULL, 'furniture_delivery', 'sub_product', 5, NULL, NULL, 1, NULL),
(13, 'Double Wardrobe', '123.0000', 'no_image.png', NULL, 'furniture_delivery', 'sub_product', 5, NULL, NULL, 1, NULL),
(14, 'Triple Wardrobe', '123.0000', 'no_image.png', NULL, 'furniture_delivery', 'sub_product', 5, NULL, NULL, 1, NULL),
(15, 'Small Box', '123.0000', 'no_image.png', NULL, 'furniture_delivery', 'sub_product', 6, NULL, NULL, 1, NULL),
(16, 'Medium Box', '123.0000', 'no_image.png', NULL, 'furniture_delivery', 'sub_product', 6, NULL, NULL, 1, NULL),
(17, 'Large Box', '123.0000', 'no_image.png', NULL, 'furniture_delivery', 'sub_product', 6, NULL, NULL, 1, NULL),
(18, 'Single Bed & Mattress', '123.0000', 'no_image.png', NULL, 'furniture_delivery', 'sub_product', 7, NULL, NULL, 1, NULL),
(19, 'Double Bed & Mattress', '123.0000', 'no_image.png', NULL, 'furniture_delivery', 'sub_product', 7, NULL, NULL, 1, NULL),
(20, 'Kingsize Bed & Mattress', '123.0000', 'no_image.png', NULL, 'furniture_delivery', 'sub_product', 7, NULL, NULL, 1, NULL),
(21, 'Coffee Table', '123.0000', 'no_image.png', NULL, 'furniture_delivery', 'sub_product', 8, NULL, NULL, 1, NULL),
(22, 'Bedside Table', '123.0000', 'no_image.png', NULL, 'furniture_delivery', 'sub_product', 8, NULL, NULL, 1, NULL),
(23, 'Garden Table', '123.0000', 'no_image.png', NULL, 'furniture_delivery', 'sub_product', 8, NULL, NULL, 1, NULL),
(24, '4 Seater Dining Table & Chairs', '123.0000', 'no_image.png', NULL, 'furniture_delivery', 'sub_product', 8, NULL, NULL, 1, NULL),
(25, '6 Seater Dining Table & Chairs', '123.0000', 'no_image.png', NULL, 'furniture_delivery', 'sub_product', 8, NULL, NULL, 1, NULL),
(26, 'Small Television/TV (Less than 30\")', '123.0000', 'no_image.png', NULL, 'furniture_delivery', 'sub_product', 9, NULL, NULL, 1, NULL),
(27, 'Medium Television/TV (30\" to 40\")', '123.0000', 'no_image.png', NULL, 'furniture_delivery', 'sub_product', 9, NULL, NULL, 1, NULL),
(28, 'Large Television/TV (Greater than 40\")', '123.0000', 'no_image.png', NULL, 'furniture_delivery', 'sub_product', 9, NULL, NULL, 1, NULL),
(29, 'Small Bag', '123.0000', 'no_image.png', NULL, 'furniture_delivery', 'sub_product', 10, NULL, NULL, 1, NULL),
(30, 'Large Bag', '123.0000', 'no_image.png', NULL, 'furniture_delivery', 'sub_product', 10, NULL, NULL, 1, NULL),
(31, 'Suitcase', '123.0000', 'no_image.png', NULL, 'furniture_delivery', 'sub_product', 10, NULL, NULL, 1, NULL),
(32, 'Box Of Clothes', '123.0000', 'no_image.png', NULL, 'furniture_delivery', 'sub_product', 10, NULL, NULL, 1, NULL),
(33, 'Armchair', '123.0000', 'no_image.png', NULL, 'furniture_delivery', 'sub_product', 11, NULL, NULL, 1, NULL),
(34, 'Dining Chair', '123.0000', 'no_image.png', NULL, 'furniture_delivery', 'sub_product', 11, NULL, NULL, 1, NULL),
(36, 'Office Chair', '123.0000', 'no_image.png', NULL, 'furniture_delivery', 'sub_product', 11, NULL, NULL, 1, NULL),
(37, '1 Bed House', '0.0000', 'no_image.png', '', 'house_removals', 'property', 1, 'No', NULL, 0, 'o_b_house'),
(38, '2 Bed House', '0.0000', 'no_image.png', '', 'house_removals', 'property', 1, 'No', NULL, 0, 't_b_house'),
(39, '3 Bed House', '0.0000', 'no_image.png', '', 'house_removals', 'property', 1, 'No', NULL, 0, 'th_b_house'),
(40, '4+ Bed House', '0.0000', 'no_image.png', '', 'house_removals', 'property', 1, 'No', NULL, 0, 'fp_b_house'),
(41, '1 Bed Flat', '0.0000', 'no_image.png', '', 'house_removals', 'property', 2, 'Yes', NULL, 0, 'o_b_flat'),
(42, '2 Bed Flat', '0.0000', 'no_image.png', '', 'house_removals', 'property', 2, 'Yes', NULL, 0, 't_b_flat'),
(43, '3 Bed Flat', '0.0000', 'no_image.png', '', 'house_removals', 'property', 2, 'Yes', NULL, 0, 'th_b_flat'),
(44, '4+ Bed Flat', '0.0000', 'no_image.png', '', 'house_removals', 'property', 2, 'Yes', NULL, 0, 'fp_b_flat'),
(45, 'Studio', '0.0000', 'no_image.png', '', 'house_removals', 'property', 3, 'Yes', NULL, 0, 'studio'),
(46, 'Storage Unit', '0.0000', 'no_image.png', '', 'house_removals', 'property', 3, 'No', NULL, 0, 'storage_unit'),
(47, 'Flatshare', '0.0000', 'no_image.png', '', 'house_removals', 'property', 3, 'Yes', NULL, 0, 'flat_share'),
(48, 'Bedrooms', '123.0000', '8ead0543c26b9b7b641b565f489067fe.svg', '', 'house_removals', 'product', 0, NULL, NULL, 0, NULL),
(49, 'Bathroom', '123.0000', '517a272d70134d90b0513ca4fde0abfa.svg', '', 'house_removals', 'product', 0, NULL, NULL, 0, NULL),
(50, 'Boxes & Packaging', '123.0000', '91f30d0a02252203c67d016d6b6c3fa6.svg', '', 'house_removals', 'product', 0, NULL, NULL, 0, NULL),
(51, 'Single Bed & Mattress', '123.0000', 'no_image.png', NULL, 'house_removals', 'sub_product', 48, NULL, NULL, 1, NULL),
(52, 'Small Mirror', '123.0000', 'no_image.png', NULL, 'house_removals', 'sub_product', 49, NULL, NULL, 1, NULL),
(53, 'Small Box', '123.0000', 'no_image.png', NULL, 'house_removals', 'sub_product', 50, NULL, NULL, 1, NULL),
(54, 'Living', '123.0000', '33da4a259380ff9fd1f1ad49fc193bf8.svg', '', 'house_removals', 'product', 0, NULL, NULL, 0, NULL),
(55, 'Dining', '123.0000', '5916e3379523fc4d0ba8dfa2b5d2a94e.svg', '', 'house_removals', 'product', 0, NULL, NULL, 0, NULL),
(56, 'Kitchen', '123.0000', 'e46ffa157b3765ae3e04fa5a1e36b130.svg', '', 'house_removals', 'product', 0, NULL, NULL, 0, NULL),
(57, 'Two Seater Sofa', '123.0000', 'no_image.png', NULL, 'house_removals', 'sub_product', 54, NULL, NULL, 1, NULL),
(58, 'Dining Chair', '123.0000', 'no_image.png', NULL, 'house_removals', 'sub_product', 55, NULL, NULL, 1, NULL),
(59, 'Microwave Oven', '123.0000', 'no_image.png', NULL, 'house_removals', 'sub_product', 56, NULL, NULL, 1, NULL),
(60, 'Piano1', '123.0000', 'f31efe54ef30eb852bac0d6d3e93e777.png', '', 'piano_transport', 'product', 0, NULL, NULL, 1, NULL),
(61, 'Piano2', '123.0000', '5296c1a319283a7ff246e92f040900e8.jpg', '', 'piano_transport', 'product', 0, NULL, NULL, 1, NULL),
(62, 'Piano3', '123.0000', '71de96af9daadba60c7d2797756dbb9e.png', '', 'piano_transport', 'product', 0, NULL, NULL, 1, NULL),
(63, 'Piano4', '123.0000', '0e311452c506bfe40014791d49b265ed.png', '', 'piano_transport', 'product', 0, NULL, NULL, 1, NULL),
(64, 'Piano5', '123.0000', '5a3ed40f49a97f2841b271029761ceca.png', '', 'piano_transport', 'product', 0, NULL, NULL, 1, NULL),
(65, 'Crates', '123.0000', 'no_image.png', '', 'office_removals', 'product', 0, NULL, NULL, 1, NULL),
(66, 'Chairs', '123.0000', 'no_image.png', '', 'office_removals', 'product', 0, NULL, NULL, 1, NULL),
(67, 'Box Medium', '123.0000', 'no_image.png', '', 'office_removals', 'product', 0, NULL, NULL, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sma_products_categories`
--

CREATE TABLE `sma_products_categories` (
  `id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `category_font` varchar(55) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sma_products_categories`
--

INSERT INTO `sma_products_categories` (`id`, `category_name`, `category_font`) VALUES
(1, 'House', 'fa fa-home'),
(2, 'Flat', 'fas fa-city'),
(3, 'Other', 'fas fa-building');

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
(5, 52, '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '1.0000', '2.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000'),
(6, 67, '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '1.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '1.0000', '2.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000'),
(7, 63, '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '1.0000', '2.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000'),
(8, 60, '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '1.0000', '2.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000'),
(9, 61, '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '1.0000', '2.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000'),
(10, 62, '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '1.0000', '2.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000'),
(11, 64, '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '1.0000', '2.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000'),
(12, 65, '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '2.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '1.0000', '2.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000'),
(13, 66, '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '1.0000', '2.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000', '0.0000'),
(14, 51, '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '1.0000', '2.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000'),
(15, 53, '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '1.0000', '2.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000'),
(16, 57, '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '1.0000', '2.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000'),
(17, 58, '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '1.0000', '2.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000'),
(18, 59, '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '1.0000', '2.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000', '3.0000', '4.0000', '5.0000', '6.0000', '7.0000', '8.0000', '9.0000', '1.0000', '2.0000'),
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

-- --------------------------------------------------------

--
-- Table structure for table `sma_products_translation`
--

CREATE TABLE `sma_products_translation` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `trans_name` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `trans_product_details` text,
  `trans_details` text,
  `trans_lang` varchar(10) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sma_products_translation`
--

INSERT INTO `sma_products_translation` (`id`, `product_id`, `trans_name`, `trans_product_details`, `trans_details`, `trans_lang`) VALUES
(3, 134, 'Surf Exel Ar', '<p>500 Gram Pack Ar</p>', '<p>Further details Ar</p>', 'arabic'),
(4, 135, 'Bonus Ar', '<p>Further details Ar</p>', '<p>500 Gram Pack Ar</p>', 'arabic'),
(5, 136, 'Ariel Ar', '<p>500 Gram Pack Ariel Ar</p>', '<p>Further details Ariel Ar</p>', 'arabic'),
(6, 132, 'Oranges Ar', '<p>500 grams in one pack Ar</p>', '<p>This is very much detailed description on the item Ar</p>', 'arabic'),
(7, 148, 'أناناس', '<p>مع إنتاج عالمي يزيد عن 18 مليون طن في عام 2009 ، تحتل الأناناس المرتبة 12 بين محاصيل الفاكهة في جميع أنحاء العالم (منظمة الأغذية والزراعة ، 2011). يتم استهلاك حوالي 70 ٪ من الأناناس المنتج في العالم كفاكهة طازجة في بلد المنشأ</p>', '', 'arabic'),
(8, 141, 'الموز الهند', '<p>الموز هو فاكهة صالحة للأكل - توت نباتي - تنتجها عدة أنواع من النباتات المزهرة العشبية الكبيرة في جنس موسى. في بعض البلدان ، يمكن أن يطلق على الموز المستخدم في الطهي \"الموز\" ، مما يميزه عن الموز الحلو. ... تنمو الثمار في مجموعات معلقة من أعلى النبات.</p>', '<p>2kg</p>', 'arabic'),
(9, 139, 'التفاح الاخضر', '', '<p>الموز هو فاكهة صالحة للأكل - توت نباتي - تنتجها عدة أنواع من النباتات \r\nالمزهرة العشبية الكبيرة في جنس موسى. في بعض البلدان ، يمكن أن يطلق على \r\nالموز المستخدم في الطهي \"الموز\" ، مما يميزه عن الموز الحلو. ... تنمو \r\nالثمار في مجموعات معلقة من أعلى النبات.</p>', 'arabic'),
(10, 146, 'العنب الأسود', '<p>1kg</p>', '<p>الموز هو فاكهة صالحة للأكل - توت نباتي - تنتجها عدة أنواع من النباتات \r\nالمزهرة العشبية الكبيرة في جنس موسى. في بعض البلدان ، يمكن أن يطلق على \r\nالموز المستخدم في الطهي \"الموز\" ، مما يميزه عن الموز الحلو. ... تنمو \r\nالثمار في مجموعات معلقة من أعلى النبات.</p>', 'arabic'),
(11, 140, 'الأفوكادو أوغندا', '<p>1kg</p>', '<p>الموز هو فاكهة صالحة للأكل - توت نباتي - تنتجها عدة أنواع من النباتات \r\nالمزهرة العشبية الكبيرة في جنس موسى. في بعض البلدان ، يمكن أن يطلق على \r\nالموز المستخدم في الطهي \"الموز\" ، مما يميزه عن الموز الحلو. ... تنمو \r\nالثمار في مجموعات معلقة من أعلى النبات.</p>', 'arabic'),
(12, 143, 'جزر أستراليا', '<p>الموز هو فاكهة صالحة للأكل - توت نباتي - تنتجها عدة أنواع من النباتات \r\nالمزهرة العشبية الكبيرة في جنس موسى. في بعض البلدان ، يمكن أن يطلق على \r\nالموز المستخدم في الطهي \"الموز\" ، مما يميزه عن الموز الحلو. ... تنمو \r\nالثمار في مجموعات معلقة من أعلى النبات.</p>', '<p>ikg</p>', 'arabic'),
(13, 142, 'الموز الفلبيني', '<p>1kg</p>', '<p>الموز هو فاكهة صالحة للأكل - توت نباتي - تنتجها عدة أنواع من النباتات \r\nالمزهرة العشبية الكبيرة في جنس موسى. في بعض البلدان ، يمكن أن يطلق على \r\nالموز المستخدم في الطهي \"الموز\" ، مما يميزه عن الموز الحلو. ... تنمو \r\nالثمار في مجموعات معلقة من أعلى النبات.</p>', 'arabic'),
(14, 138, 'تفاحة', '<p>الموز هو فاكهة صالحة للأكل - توت نباتي - تنتجها عدة أنواع من النباتات \r\nالمزهرة العشبية الكبيرة في جنس موسى. في بعض البلدان ، يمكن أن يطلق على \r\nالموز المستخدم في الطهي \"الموز\" ، مما يميزه عن الموز الحلو. ... تنمو \r\nالثمار في مجموعات معلقة من أعلى النبات.</p>', '<p>8kg</p>', 'arabic'),
(15, 147, 'كيوي', '', '<p>الموز هو فاكهة صالحة للأكل - توت نباتي - تنتجها عدة أنواع من النباتات \r\nالمزهرة العشبية الكبيرة في جنس موسى. في بعض البلدان ، يمكن أن يطلق على \r\nالموز المستخدم في الطهي \"الموز\" ، مما يميزه عن الموز الحلو. ... تنمو \r\nالثمار في مجموعات معلقة من أعلى النبات.</p>', 'arabic'),
(16, 144, 'زنجبيل', '', '<p>الموز هو فاكهة صالحة للأكل - توت نباتي - تنتجها عدة أنواع من النباتات \r\nالمزهرة العشبية الكبيرة في جنس موسى. في بعض البلدان ، يمكن أن يطلق على \r\nالموز المستخدم في الطهي \"الموز\" ، مما يميزه عن الموز الحلو. ... تنمو \r\nالثمار في مجموعات معلقة من أعلى النبات.</p>', 'arabic'),
(17, 145, 'العنب', '', '<p>الموز هو فاكهة صالحة للأكل - توت نباتي - تنتجها عدة أنواع من النباتات \r\nالمزهرة العشبية الكبيرة في جنس موسى. في بعض البلدان ، يمكن أن يطلق على \r\nالموز المستخدم في الطهي \"الموز\" ، مما يميزه عن الموز الحلو. ... تنمو \r\nالثمار في مجموعات معلقة من أعلى النبات.</p>', 'arabic'),
(18, 149, 'أورانج مصر', '', '<p>الموز هو فاكهة صالحة للأكل - توت نباتي - تنتجها عدة أنواع من النباتات \r\nالمزهرة العشبية الكبيرة في جنس موسى. في بعض البلدان ، يمكن أن يطلق على \r\nالموز المستخدم في الطهي \"الموز\" ، مما يميزه عن الموز الحلو. ... تنمو \r\nالثمار في مجموعات معلقة من أعلى النبات.</p>', 'arabic');

-- --------------------------------------------------------

--
-- Table structure for table `sma_product_photos`
--

CREATE TABLE `sma_product_photos` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `photo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sma_product_photos`
--

INSERT INTO `sma_product_photos` (`id`, `product_id`, `photo`) VALUES
(2, 148, '963e2e39afeedf27ed761ea193d1411c.jpeg'),
(3, 148, 'cba142d0a8c92ae4788025fb3220848b.jpg'),
(4, 138, '0b097677b24069e5437d24ba9eacb016.jpg'),
(5, 143, '2d090f229828543e3546c3a6b658646c.png');

-- --------------------------------------------------------

--
-- Table structure for table `sma_sales`
--

CREATE TABLE `sma_sales` (
  `id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `reference_no` varchar(55) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `customer` varchar(55) DEFAULT NULL,
  `biller_id` int(11) NOT NULL,
  `biller` varchar(55) NOT NULL,
  `note` varchar(1000) DEFAULT NULL,
  `total` decimal(25,4) NOT NULL,
  `product_discount` decimal(25,4) DEFAULT '0.0000',
  `order_discount_id` varchar(20) DEFAULT NULL,
  `total_discount` decimal(25,4) DEFAULT '0.0000',
  `order_discount` decimal(25,4) DEFAULT '0.0000',
  `order_discount_type` int(1) DEFAULT '0',
  `shipping` decimal(25,4) DEFAULT '1.0000',
  `grand_total` decimal(25,4) NOT NULL,
  `sale_status` varchar(20) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `total_items` smallint(6) DEFAULT NULL,
  `attachment` varchar(55) DEFAULT NULL,
  `sale_id` int(11) DEFAULT NULL,
  `rounding` decimal(10,4) DEFAULT NULL,
  `suspend_note` varchar(255) DEFAULT NULL,
  `api` tinyint(1) DEFAULT '0',
  `shop` tinyint(1) DEFAULT '0',
  `address_id` int(11) DEFAULT NULL,
  `reserve_id` int(11) DEFAULT NULL,
  `hash` varchar(255) DEFAULT NULL,
  `payment_method` varchar(55) DEFAULT 'Charge on Delivery'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sma_sales`
--

INSERT INTO `sma_sales` (`id`, `date`, `reference_no`, `customer_id`, `customer`, `biller_id`, `biller`, `note`, `total`, `product_discount`, `order_discount_id`, `total_discount`, `order_discount`, `order_discount_type`, `shipping`, `grand_total`, `sale_status`, `created_by`, `updated_by`, `updated_at`, `total_items`, `attachment`, `sale_id`, `rounding`, `suspend_note`, `api`, `shop`, `address_id`, `reserve_id`, `hash`, `payment_method`) VALUES
(3, '2020-04-21 04:35:40', '118168594969', 7, 'Hassan', 3, 'Alawi', 'untttt', '4.0000', '0.0000', NULL, '0.0000', '0.0000', 0, '1.0000', '5.0000', 'pending', NULL, NULL, NULL, 3, NULL, NULL, NULL, NULL, 0, 1, 14, NULL, '80368813a80b87b9e71e6e32d59c29812bdef42972a40cf0d3585bbb8865b1bf', 'cod'),
(4, '2020-04-21 06:27:21', '495762680306', 11, 'Atta', 3, 'Alawi', 'bly lby 2', '3.0000', '0.0000', NULL, '0.0000', '0.0000', 0, '1.0000', '4.0000', 'pending', 22, NULL, NULL, 2, NULL, NULL, NULL, NULL, 0, 1, 15, NULL, 'c441e3dcaf6ab366b8b20e2743728c8df6b6ba55329f2ffe707842862a0a3c34', 'cod'),
(5, '2020-04-21 07:21:57', '397829285784', 11, 'Atta', 3, 'Alawi', 'bly bly 3', '2.8000', '0.0000', NULL, '0.0000', '0.0000', 0, '1.0000', '3.8000', 'pending', 22, NULL, NULL, 2, NULL, NULL, NULL, NULL, 0, 1, 17, NULL, 'f33813dc411bab4a3ccb271a63eeb7b1193d51a25be40d04cfb444842e75cd8c', 'cod'),
(6, '2020-04-21 07:40:03', '554920638947', 11, 'Atta', 3, 'Alawi', 'Bly bly 4', '10.0000', '0.0000', NULL, '0.0000', '0.0000', 0, '1.0000', '11.0000', 'cancel', 22, NULL, NULL, 3, NULL, NULL, NULL, NULL, 0, 1, 18, NULL, 'e57d78d160a155e5556f169b65c7f49bc4b811c6287740bddb8e9192e6b6ed21', 'cod'),
(7, '2020-04-22 07:51:47', '226005145241', 11, 'Atta Ur Rehman', 3, 'Alawi', 'bly with map', '1.0000', '0.0000', NULL, '0.0000', '0.0000', 0, '1.0000', '2.0000', 'cancel', 22, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 19, NULL, '7501815e93982e261879503abb7212234f52b87ec175a1d2851bc43441e6d8bf', 'cod'),
(8, '2020-04-22 08:11:53', '204790986235', 12, 'Ebad', 3, 'Alawi', 'bly bly with maps 2', '10.0000', '0.0000', NULL, '0.0000', '0.0000', 0, '1.0000', '11.0000', 'pending', NULL, NULL, NULL, 5, NULL, NULL, NULL, NULL, 0, 1, 20, NULL, 'c4c0dad3e8d0c28430da4413a5aca29d4d68e4c97753dab2dc2a255991521796', 'cod'),
(9, '2020-04-23 05:55:57', '216839657471', 11, 'Atta Ur Rehman', 3, 'Alawi', 'bly', '7.0000', '0.0000', NULL, '0.0000', '0.0000', 0, '1.0000', '8.0000', 'cancel', 22, NULL, NULL, 4, NULL, NULL, NULL, NULL, 0, 1, 21, NULL, 'e388d71fb6fe53efb7e9ae9b3ced48d4dcbc1fc5f2843714ce0461bcbed0538f', 'cod'),
(10, '2020-04-24 04:39:05', '599116961118', 11, 'Atta Ur Rehman', 3, 'Alawi', 'bly bly', '8.0000', '0.0000', NULL, '0.0000', '0.0000', 0, '1.0000', '9.0000', 'cancel', 22, NULL, NULL, 3, NULL, NULL, NULL, NULL, 0, 1, 22, NULL, 'ddb4119aa220575c60dd4e8d17a2acb419e2c1db6b12a968fc38f054a3250e3c', 'cod'),
(11, '2020-04-24 05:20:52', '119893810634', 14, 'shary', 3, 'Alawi', 'note', '2.0000', '0.0000', NULL, '0.0000', '0.0000', 0, '1.0000', '3.0000', 'pending', 24, NULL, NULL, 1, NULL, NULL, NULL, NULL, 0, 1, 23, NULL, 'c58e1f0f1a5745c5dafc2a6a60cf938d44f4dcc0ad8728e3c3a04916a4ad3da8', 'cod'),
(12, '2020-04-24 17:20:50', '792571122322', 14, 'shary', 3, 'Alawi', 'bly', '6.0000', '0.0000', NULL, '0.0000', '0.0000', 0, '1.0000', '7.0000', 'pending', 24, NULL, NULL, 3, NULL, NULL, NULL, NULL, 0, 1, 24, NULL, 'e28eda2237a93d7b86982ab0698e479f85639d931511f87022344400ffddf608', 'cod');

-- --------------------------------------------------------

--
-- Table structure for table `sma_sale_items`
--

CREATE TABLE `sma_sale_items` (
  `id` int(11) NOT NULL,
  `sale_id` int(11) UNSIGNED NOT NULL,
  `product_id` int(11) UNSIGNED NOT NULL,
  `product_code` varchar(55) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_type` varchar(20) DEFAULT NULL,
  `net_unit_price` decimal(25,4) NOT NULL,
  `unit_price` decimal(25,4) DEFAULT NULL,
  `quantity` decimal(15,4) NOT NULL,
  `discount` varchar(55) DEFAULT NULL,
  `item_discount` decimal(25,4) DEFAULT NULL,
  `subtotal` decimal(25,4) NOT NULL,
  `real_unit_price` decimal(25,4) DEFAULT NULL,
  `sale_item_id` int(11) DEFAULT NULL,
  `product_unit_id` int(11) DEFAULT NULL,
  `product_unit_code` varchar(10) DEFAULT NULL,
  `unit_quantity` decimal(15,4) NOT NULL,
  `comment` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sma_sale_items`
--

INSERT INTO `sma_sale_items` (`id`, `sale_id`, `product_id`, `product_code`, `product_name`, `product_type`, `net_unit_price`, `unit_price`, `quantity`, `discount`, `item_discount`, `subtotal`, `real_unit_price`, `sale_item_id`, `product_unit_id`, `product_unit_code`, `unit_quantity`, `comment`) VALUES
(1, 3, 144, '8397930', 'Ginger', 'standard', '1.0000', '1.0000', '1.0000', NULL, '0.0000', '1.0000', '1.0000', NULL, NULL, NULL, '1.0000', NULL),
(2, 3, 145, '8679650', 'Grapes', 'standard', '2.0000', '2.0000', '1.0000', NULL, '0.0000', '2.0000', '2.0000', NULL, NULL, NULL, '1.0000', NULL),
(3, 3, 140, '4289695', 'Avocado Uganda', 'standard', '1.0000', '1.0000', '1.0000', NULL, '0.0000', '1.0000', '1.0000', NULL, NULL, NULL, '1.0000', NULL),
(4, 4, 138, '71830599', 'Apple', 'standard', '2.0000', '2.0000', '1.0000', NULL, '0.0000', '2.0000', '2.0000', NULL, NULL, NULL, '1.0000', NULL),
(5, 4, 139, '1821453', 'Apple Green', 'standard', '1.0000', '1.0000', '1.0000', NULL, '0.0000', '1.0000', '1.0000', NULL, NULL, NULL, '1.0000', NULL),
(6, 5, 138, '71830599', 'Apple', 'standard', '2.0000', '2.0000', '1.0000', NULL, '0.0000', '2.0000', '2.0000', NULL, NULL, NULL, '1.0000', NULL),
(7, 5, 147, '83355065', 'Kiwi', 'standard', '0.8000', '0.8000', '1.0000', NULL, '0.0000', '0.8000', '0.8000', NULL, NULL, NULL, '1.0000', NULL),
(8, 6, 148, '98967657', 'Pine apple', 'standard', '4.0000', '4.0000', '2.0000', NULL, '0.0000', '8.0000', '4.0000', NULL, NULL, NULL, '2.0000', NULL),
(9, 6, 145, '8679650', 'Grapes', 'standard', '2.0000', '2.0000', '1.0000', NULL, '0.0000', '2.0000', '2.0000', NULL, NULL, NULL, '1.0000', NULL),
(10, 7, 139, '1821453', 'Apple Green', 'standard', '1.0000', '1.0000', '1.0000', NULL, '0.0000', '1.0000', '1.0000', NULL, NULL, NULL, '1.0000', NULL),
(11, 8, 143, '45749695', 'Carrot Australia', 'standard', '2.0000', '2.0000', '5.0000', NULL, '0.0000', '10.0000', '2.0000', NULL, NULL, NULL, '5.0000', NULL),
(12, 9, 145, '8679650', 'Grapes', 'standard', '2.0000', '2.0000', '3.0000', NULL, '0.0000', '6.0000', '2.0000', NULL, NULL, NULL, '3.0000', NULL),
(13, 9, 140, '4289695', 'Avocado Uganda', 'standard', '1.0000', '1.0000', '1.0000', NULL, '0.0000', '1.0000', '1.0000', NULL, NULL, NULL, '1.0000', NULL),
(14, 10, 138, '71830599', 'Apple', 'standard', '2.0000', '2.0000', '1.0000', NULL, '0.0000', '2.0000', '2.0000', NULL, NULL, NULL, '1.0000', NULL),
(15, 10, 148, '98967657', 'Pine apple', 'standard', '4.0000', '4.0000', '1.0000', NULL, '0.0000', '4.0000', '4.0000', NULL, NULL, NULL, '1.0000', NULL),
(16, 10, 143, '45749695', 'Carrot Australia', 'standard', '2.0000', '2.0000', '1.0000', NULL, '0.0000', '2.0000', '2.0000', NULL, NULL, NULL, '1.0000', NULL),
(17, 11, 138, '71830599', 'Apple', 'standard', '2.0000', '2.0000', '1.0000', NULL, '0.0000', '2.0000', '2.0000', NULL, NULL, NULL, '1.0000', NULL),
(18, 12, 138, '71830599', 'Apple', 'standard', '2.0000', '2.0000', '3.0000', NULL, '0.0000', '6.0000', '2.0000', NULL, NULL, NULL, '3.0000', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sma_sessions`
--

CREATE TABLE `sma_sessions` (
  `id` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sma_sessions`
--

INSERT INTO `sma_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('5dek4t8l4hm9ttkm4sb98pdpm1i47ggc', '::1', 1591255038, 0x5f5f63695f6c6173745f726567656e65726174657c693a313539313235353033383b686f7573655f72656d6f76616c5f736c75677c733a32323a226f5f625f686f7573655f746f5f745f625f686f757365223b686f7573655f72656d6f76616c5f747970657c733a31333a22686f7573655f72656d6f76616c223b),
('5iraduf3skcd2vh1ls0rke5hktjdtj16', '::1', 1591257977, 0x5f5f63695f6c6173745f726567656e65726174657c693a313539313235373937373b6572726f727c733a3135373a223c68343e343034204e6f7420466f756e64213c2f68343e3c703e546865207061676520796f7520617265206c6f6f6b696e6720666f722063616e206e6f7420626520666f756e642e3c2f703e687474703a2f2f6c6f63616c686f73743a383038302f73636f742d72656d6f76616c732f7468656d65732f64656661756c742f73686f702f6173736574732f736372697074732f67656e6572616c2e6a73223b5f5f63695f766172737c613a313a7b733a353a226572726f72223b733a333a226f6c64223b7d),
('6tiq7l1cq6upbdn6kj6vg8nrkjogegd2', '::1', 1591247906, 0x5f5f63695f6c6173745f726567656e65726174657c693a313539313234373930363b7265717565737465645f706167657c733a353a2261646d696e223b6964656e746974797c733a373a2274657374696e67223b757365726e616d657c733a373a2274657374696e67223b656d61696c7c733a32303a22696e666f406164726f69744c696768742e636f6d223b757365725f69647c733a313a2235223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231353931323032383837223b6c6173745f69707c733a333a223a3a31223b6176617461727c733a33363a2263343261653833313639373564386166303135636262626563393339376666312e6a7067223b67656e6465727c733a343a226d616c65223b766965775f72696768747c733a313a2231223b656469745f72696768747c733a313a2230223b616c6c6f775f646973636f756e747c733a313a2230223b62696c6c65725f69647c4e3b636f6d70616e795f69647c4e3b73686f775f636f73747c733a313a2230223b73686f775f70726963657c733a313a2230223b),
('7080skvngmgvkml1aupeij36p0s3m3be', '::1', 1591252516, 0x5f5f63695f6c6173745f726567656e65726174657c693a313539313235323531363b7265717565737465645f706167657c733a353a2261646d696e223b6964656e746974797c733a373a2274657374696e67223b757365726e616d657c733a373a2274657374696e67223b656d61696c7c733a32303a22696e666f406164726f69744c696768742e636f6d223b757365725f69647c733a313a2235223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231353931323032383837223b6c6173745f69707c733a333a223a3a31223b6176617461727c733a33363a2263343261653833313639373564386166303135636262626563393339376666312e6a7067223b67656e6465727c733a343a226d616c65223b766965775f72696768747c733a313a2231223b656469745f72696768747c733a313a2230223b616c6c6f775f646973636f756e747c733a313a2230223b62696c6c65725f69647c4e3b636f6d70616e795f69647c4e3b73686f775f636f73747c733a313a2230223b73686f775f70726963657c733a313a2230223b),
('77b5jo0jf9shtetaepct4rl46ivqrrho', '::1', 1591248215, 0x5f5f63695f6c6173745f726567656e65726174657c693a313539313234383231353b7265717565737465645f706167657c733a353a2261646d696e223b6964656e746974797c733a373a2274657374696e67223b757365726e616d657c733a373a2274657374696e67223b656d61696c7c733a32303a22696e666f406164726f69744c696768742e636f6d223b757365725f69647c733a313a2235223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231353931323032383837223b6c6173745f69707c733a333a223a3a31223b6176617461727c733a33363a2263343261653833313639373564386166303135636262626563393339376666312e6a7067223b67656e6465727c733a343a226d616c65223b766965775f72696768747c733a313a2231223b656469745f72696768747c733a313a2230223b616c6c6f775f646973636f756e747c733a313a2230223b62696c6c65725f69647c4e3b636f6d70616e795f69647c4e3b73686f775f636f73747c733a313a2230223b73686f775f70726963657c733a313a2230223b),
('879v39ihnj65epj6oua1688nmt5lvtl0', '::1', 1591257465, 0x5f5f63695f6c6173745f726567656e65726174657c693a313539313235373436333b),
('9jlsk6r08l7j0o1f5lai7ep9mb8b2dhh', '::1', 1591250568, 0x5f5f63695f6c6173745f726567656e65726174657c693a313539313235303536383b7265717565737465645f706167657c733a353a2261646d696e223b6964656e746974797c733a373a2274657374696e67223b757365726e616d657c733a373a2274657374696e67223b656d61696c7c733a32303a22696e666f406164726f69744c696768742e636f6d223b757365725f69647c733a313a2235223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231353931323032383837223b6c6173745f69707c733a333a223a3a31223b6176617461727c733a33363a2263343261653833313639373564386166303135636262626563393339376666312e6a7067223b67656e6465727c733a343a226d616c65223b766965775f72696768747c733a313a2231223b656469745f72696768747c733a313a2230223b616c6c6f775f646973636f756e747c733a313a2230223b62696c6c65725f69647c4e3b636f6d70616e795f69647c4e3b73686f775f636f73747c733a313a2230223b73686f775f70726963657c733a313a2230223b),
('afop6q894jiip0nv4mutrg0nt8uu0338', '::1', 1591260617, 0x5f5f63695f6c6173745f726567656e65726174657c693a313539313236303631373b),
('frkanilnfe877l9bmfpprkpv9atlno1r', '::1', 1591253558, 0x5f5f63695f6c6173745f726567656e65726174657c693a313539313235333535383b7265717565737465645f706167657c733a353a2261646d696e223b6964656e746974797c733a373a2274657374696e67223b757365726e616d657c733a373a2274657374696e67223b656d61696c7c733a32303a22696e666f406164726f69744c696768742e636f6d223b757365725f69647c733a313a2235223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231353931323032383837223b6c6173745f69707c733a333a223a3a31223b6176617461727c733a33363a2263343261653833313639373564386166303135636262626563393339376666312e6a7067223b67656e6465727c733a343a226d616c65223b766965775f72696768747c733a313a2231223b656469745f72696768747c733a313a2230223b616c6c6f775f646973636f756e747c733a313a2230223b62696c6c65725f69647c4e3b636f6d70616e795f69647c4e3b73686f775f636f73747c733a313a2230223b73686f775f70726963657c733a313a2230223b686f7573655f72656d6f76616c5f736c75677c733a32363a2274685f625f686f7573655f746f5f73746f726167655f756e6974223b686f7573655f72656d6f76616c5f747970657c733a31333a22686f7573655f72656d6f76616c223b),
('gu4ok17p3nfb3h0dvrscg9e9muuk6pd3', '::1', 1591250216, 0x5f5f63695f6c6173745f726567656e65726174657c693a313539313235303231363b7265717565737465645f706167657c733a353a2261646d696e223b6964656e746974797c733a373a2274657374696e67223b757365726e616d657c733a373a2274657374696e67223b656d61696c7c733a32303a22696e666f406164726f69744c696768742e636f6d223b757365725f69647c733a313a2235223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231353931323032383837223b6c6173745f69707c733a333a223a3a31223b6176617461727c733a33363a2263343261653833313639373564386166303135636262626563393339376666312e6a7067223b67656e6465727c733a343a226d616c65223b766965775f72696768747c733a313a2231223b656469745f72696768747c733a313a2230223b616c6c6f775f646973636f756e747c733a313a2230223b62696c6c65725f69647c4e3b636f6d70616e795f69647c4e3b73686f775f636f73747c733a313a2230223b73686f775f70726963657c733a313a2230223b6572726f727c733a3136393a223c68343e343034204e6f7420466f756e64213c2f68343e3c703e546865207061676520796f7520617265206c6f6f6b696e6720666f722063616e206e6f7420626520666f756e642e3c2f703e687474703a2f2f6c6f63616c686f73743a383038302f73636f742d72656d6f76616c732f7468656d65732f64656661756c742f73686f702f6173736574732f626f6f7473747261702f6a732f706f707065722e6d696e2e6a732e6d6170223b5f5f63695f766172737c613a313a7b733a353a226572726f72223b733a333a226f6c64223b7d),
('hfcb0vig2bm7ejod7gam10lqbna1cj7u', '::1', 1591251775, 0x5f5f63695f6c6173745f726567656e65726174657c693a313539313235313737353b7265717565737465645f706167657c733a353a2261646d696e223b6964656e746974797c733a373a2274657374696e67223b757365726e616d657c733a373a2274657374696e67223b656d61696c7c733a32303a22696e666f406164726f69744c696768742e636f6d223b757365725f69647c733a313a2235223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231353931323032383837223b6c6173745f69707c733a333a223a3a31223b6176617461727c733a33363a2263343261653833313639373564386166303135636262626563393339376666312e6a7067223b67656e6465727c733a343a226d616c65223b766965775f72696768747c733a313a2231223b656469745f72696768747c733a313a2230223b616c6c6f775f646973636f756e747c733a313a2230223b62696c6c65725f69647c4e3b636f6d70616e795f69647c4e3b73686f775f636f73747c733a313a2230223b73686f775f70726963657c733a313a2230223b),
('higm7s00sehinla3k2cg1h9i3452gp5g', '::1', 1591260820, 0x5f5f63695f6c6173745f726567656e65726174657c693a313539313236303631373b7265717565737465645f706167657c733a353a2261646d696e223b6964656e746974797c733a373a2274657374696e67223b757365726e616d657c733a373a2274657374696e67223b656d61696c7c733a32303a22696e666f406164726f69744c696768742e636f6d223b757365725f69647c733a313a2235223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231353931323437353338223b6c6173745f69707c733a333a223a3a31223b6176617461727c733a33363a2263343261653833313639373564386166303135636262626563393339376666312e6a7067223b67656e6465727c733a343a226d616c65223b766965775f72696768747c733a313a2231223b656469745f72696768747c733a313a2230223b616c6c6f775f646973636f756e747c733a313a2230223b62696c6c65725f69647c4e3b636f6d70616e795f69647c4e3b73686f775f636f73747c733a313a2230223b73686f775f70726963657c733a313a2230223b),
('ig2soodogtc9reu2kpugqjoquuc6iu6d', '::1', 1591251427, 0x5f5f63695f6c6173745f726567656e65726174657c693a313539313235313432373b7265717565737465645f706167657c733a353a2261646d696e223b6964656e746974797c733a373a2274657374696e67223b757365726e616d657c733a373a2274657374696e67223b656d61696c7c733a32303a22696e666f406164726f69744c696768742e636f6d223b757365725f69647c733a313a2235223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231353931323032383837223b6c6173745f69707c733a333a223a3a31223b6176617461727c733a33363a2263343261653833313639373564386166303135636262626563393339376666312e6a7067223b67656e6465727c733a343a226d616c65223b766965775f72696768747c733a313a2231223b656469745f72696768747c733a313a2230223b616c6c6f775f646973636f756e747c733a313a2230223b62696c6c65725f69647c4e3b636f6d70616e795f69647c4e3b73686f775f636f73747c733a313a2230223b73686f775f70726963657c733a313a2230223b),
('lofj0rk57gng1u60rsu7l3tunq8qhjfu', '::1', 1591247506, 0x5f5f63695f6c6173745f726567656e65726174657c693a313539313234373530363b),
('mcv37i9o98nv7jcren3f0fue40j09uh5', '::1', 1591258380, 0x5f5f63695f6c6173745f726567656e65726174657c693a313539313235383338303b),
('mutteesudi0rfcp5kosndndidtqp5lq9', '::1', 1591254430, 0x5f5f63695f6c6173745f726567656e65726174657c693a313539313235343433303b7265717565737465645f706167657c733a353a2261646d696e223b6964656e746974797c733a373a2274657374696e67223b757365726e616d657c733a373a2274657374696e67223b656d61696c7c733a32303a22696e666f406164726f69744c696768742e636f6d223b757365725f69647c733a313a2235223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231353931323032383837223b6c6173745f69707c733a333a223a3a31223b6176617461727c733a33363a2263343261653833313639373564386166303135636262626563393339376666312e6a7067223b67656e6465727c733a343a226d616c65223b766965775f72696768747c733a313a2231223b656469745f72696768747c733a313a2230223b616c6c6f775f646973636f756e747c733a313a2230223b62696c6c65725f69647c4e3b636f6d70616e795f69647c4e3b73686f775f636f73747c733a313a2230223b73686f775f70726963657c733a313a2230223b686f7573655f72656d6f76616c5f736c75677c733a32363a2274685f625f686f7573655f746f5f73746f726167655f756e6974223b686f7573655f72656d6f76616c5f747970657c733a31333a22686f7573655f72656d6f76616c223b),
('p06lmc9f7q89iduhvvifmcvpg42vljh2', '::1', 1591253103, 0x5f5f63695f6c6173745f726567656e65726174657c693a313539313235333130333b7265717565737465645f706167657c733a353a2261646d696e223b6964656e746974797c733a373a2274657374696e67223b757365726e616d657c733a373a2274657374696e67223b656d61696c7c733a32303a22696e666f406164726f69744c696768742e636f6d223b757365725f69647c733a313a2235223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231353931323032383837223b6c6173745f69707c733a333a223a3a31223b6176617461727c733a33363a2263343261653833313639373564386166303135636262626563393339376666312e6a7067223b67656e6465727c733a343a226d616c65223b766965775f72696768747c733a313a2231223b656469745f72696768747c733a313a2230223b616c6c6f775f646973636f756e747c733a313a2230223b62696c6c65725f69647c4e3b636f6d70616e795f69647c4e3b73686f775f636f73747c733a313a2230223b73686f775f70726963657c733a313a2230223b686f7573655f72656d6f76616c5f736c75677c733a32363a2274685f625f686f7573655f746f5f73746f726167655f756e6974223b686f7573655f72656d6f76616c5f747970657c733a31333a22686f7573655f72656d6f76616c223b),
('scavi6p0dcvcvqrld8k45d815tdu0dbf', '::1', 1591252081, 0x5f5f63695f6c6173745f726567656e65726174657c693a313539313235323038313b7265717565737465645f706167657c733a353a2261646d696e223b6964656e746974797c733a373a2274657374696e67223b757365726e616d657c733a373a2274657374696e67223b656d61696c7c733a32303a22696e666f406164726f69744c696768742e636f6d223b757365725f69647c733a313a2235223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231353931323032383837223b6c6173745f69707c733a333a223a3a31223b6176617461727c733a33363a2263343261653833313639373564386166303135636262626563393339376666312e6a7067223b67656e6465727c733a343a226d616c65223b766965775f72696768747c733a313a2231223b656469745f72696768747c733a313a2230223b616c6c6f775f646973636f756e747c733a313a2230223b62696c6c65725f69647c4e3b636f6d70616e795f69647c4e3b73686f775f636f73747c733a313a2230223b73686f775f70726963657c733a313a2230223b),
('ti2bm5nr050vndsceas4gv85g23otbjv', '::1', 1591249823, 0x5f5f63695f6c6173745f726567656e65726174657c693a313539313234393832333b7265717565737465645f706167657c733a353a2261646d696e223b6964656e746974797c733a373a2274657374696e67223b757365726e616d657c733a373a2274657374696e67223b656d61696c7c733a32303a22696e666f406164726f69744c696768742e636f6d223b757365725f69647c733a313a2235223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231353931323032383837223b6c6173745f69707c733a333a223a3a31223b6176617461727c733a33363a2263343261653833313639373564386166303135636262626563393339376666312e6a7067223b67656e6465727c733a343a226d616c65223b766965775f72696768747c733a313a2231223b656469745f72696768747c733a313a2230223b616c6c6f775f646973636f756e747c733a313a2230223b62696c6c65725f69647c4e3b636f6d70616e795f69647c4e3b73686f775f636f73747c733a313a2230223b73686f775f70726963657c733a313a2230223b),
('ufakjp8kavbf2s1gb8n6m06o1k4h2of7', '::1', 1591246661, 0x5f5f63695f6c6173745f726567656e65726174657c693a313539313234363636303b),
('vk56iucoaecnrd9noc2sd17stmupb7nt', '::1', 1591254734, 0x5f5f63695f6c6173745f726567656e65726174657c693a313539313235343733343b7265717565737465645f706167657c733a353a2261646d696e223b6964656e746974797c733a373a2274657374696e67223b757365726e616d657c733a373a2274657374696e67223b656d61696c7c733a32303a22696e666f406164726f69744c696768742e636f6d223b757365725f69647c733a313a2235223b6f6c645f6c6173745f6c6f67696e7c733a31303a2231353931323032383837223b6c6173745f69707c733a333a223a3a31223b6176617461727c733a33363a2263343261653833313639373564386166303135636262626563393339376666312e6a7067223b67656e6465727c733a343a226d616c65223b766965775f72696768747c733a313a2231223b656469745f72696768747c733a313a2230223b616c6c6f775f646973636f756e747c733a313a2230223b62696c6c65725f69647c4e3b636f6d70616e795f69647c4e3b73686f775f636f73747c733a313a2230223b73686f775f70726963657c733a313a2230223b686f7573655f72656d6f76616c5f736c75677c733a32363a2274685f625f686f7573655f746f5f73746f726167655f756e6974223b686f7573655f72656d6f76616c5f747970657c733a31333a22686f7573655f72656d6f76616c223b);

-- --------------------------------------------------------

--
-- Table structure for table `sma_settings`
--

CREATE TABLE `sma_settings` (
  `setting_id` int(1) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `logo2` varchar(255) NOT NULL,
  `site_name` varchar(55) NOT NULL,
  `language` varchar(20) NOT NULL,
  `default_warehouse` int(2) NOT NULL,
  `accounting_method` tinyint(4) NOT NULL DEFAULT '0',
  `default_currency` varchar(3) NOT NULL,
  `default_currency_id` int(1) NOT NULL,
  `default_tax_rate` int(2) NOT NULL,
  `rows_per_page` int(2) NOT NULL,
  `version` varchar(10) NOT NULL DEFAULT '1.0',
  `default_tax_rate2` int(11) NOT NULL DEFAULT '0',
  `dateformat` int(11) NOT NULL,
  `sales_prefix` varchar(20) DEFAULT NULL,
  `quote_prefix` varchar(20) DEFAULT NULL,
  `purchase_prefix` varchar(20) DEFAULT NULL,
  `transfer_prefix` varchar(20) DEFAULT NULL,
  `delivery_prefix` varchar(20) DEFAULT NULL,
  `payment_prefix` varchar(20) DEFAULT NULL,
  `return_prefix` varchar(20) DEFAULT NULL,
  `returnp_prefix` varchar(20) DEFAULT NULL,
  `expense_prefix` varchar(20) DEFAULT NULL,
  `item_addition` tinyint(1) NOT NULL DEFAULT '0',
  `theme` varchar(20) NOT NULL,
  `product_serial` tinyint(4) NOT NULL,
  `default_discount` int(11) NOT NULL,
  `product_discount` tinyint(1) NOT NULL DEFAULT '0',
  `discount_method` tinyint(4) NOT NULL,
  `tax1` tinyint(4) NOT NULL,
  `tax2` tinyint(4) NOT NULL,
  `overselling` tinyint(1) NOT NULL DEFAULT '0',
  `restrict_user` tinyint(4) NOT NULL DEFAULT '0',
  `restrict_calendar` tinyint(4) NOT NULL DEFAULT '0',
  `timezone` varchar(100) DEFAULT NULL,
  `iwidth` int(11) NOT NULL DEFAULT '0',
  `iheight` int(11) NOT NULL,
  `twidth` int(11) NOT NULL,
  `theight` int(11) NOT NULL,
  `watermark` tinyint(1) DEFAULT NULL,
  `reg_ver` tinyint(1) DEFAULT NULL,
  `allow_reg` tinyint(1) DEFAULT NULL,
  `reg_notification` tinyint(1) DEFAULT NULL,
  `auto_reg` tinyint(1) DEFAULT NULL,
  `protocol` varchar(20) NOT NULL DEFAULT 'mail',
  `mailpath` varchar(55) DEFAULT '/usr/sbin/sendmail',
  `smtp_host` varchar(100) DEFAULT NULL,
  `smtp_user` varchar(100) DEFAULT NULL,
  `smtp_pass` varchar(255) DEFAULT NULL,
  `smtp_port` varchar(10) DEFAULT '25',
  `smtp_crypto` varchar(10) DEFAULT NULL,
  `corn` datetime DEFAULT NULL,
  `customer_group` int(11) NOT NULL,
  `default_email` varchar(100) NOT NULL,
  `mmode` tinyint(1) NOT NULL,
  `bc_fix` tinyint(4) NOT NULL DEFAULT '0',
  `auto_detect_barcode` tinyint(1) NOT NULL DEFAULT '0',
  `captcha` tinyint(1) NOT NULL DEFAULT '1',
  `reference_format` tinyint(1) NOT NULL DEFAULT '1',
  `racks` tinyint(1) DEFAULT '0',
  `attributes` tinyint(1) NOT NULL DEFAULT '0',
  `product_expiry` tinyint(1) NOT NULL DEFAULT '0',
  `decimals` tinyint(2) NOT NULL DEFAULT '2',
  `qty_decimals` tinyint(2) NOT NULL DEFAULT '2',
  `decimals_sep` varchar(2) NOT NULL DEFAULT '.',
  `thousands_sep` varchar(2) NOT NULL DEFAULT ',',
  `invoice_view` tinyint(1) DEFAULT '0',
  `default_biller` int(11) DEFAULT NULL,
  `rtl` tinyint(1) DEFAULT '0',
  `each_spent` decimal(15,4) DEFAULT NULL,
  `ca_point` tinyint(4) DEFAULT NULL,
  `each_sale` decimal(15,4) DEFAULT NULL,
  `sa_point` tinyint(4) DEFAULT NULL,
  `update` tinyint(1) DEFAULT '0',
  `sac` tinyint(1) DEFAULT '0',
  `display_all_products` tinyint(1) DEFAULT '0',
  `display_symbol` tinyint(1) DEFAULT NULL,
  `symbol` varchar(50) DEFAULT NULL,
  `remove_expired` tinyint(1) DEFAULT '0',
  `barcode_separator` varchar(2) NOT NULL DEFAULT '-',
  `set_focus` tinyint(1) NOT NULL DEFAULT '0',
  `price_group` int(11) DEFAULT NULL,
  `barcode_img` tinyint(1) NOT NULL DEFAULT '1',
  `ppayment_prefix` varchar(20) DEFAULT 'POP',
  `disable_editing` smallint(6) DEFAULT '90',
  `qa_prefix` varchar(55) DEFAULT NULL,
  `update_cost` tinyint(1) DEFAULT NULL,
  `apis` tinyint(1) NOT NULL DEFAULT '0',
  `state` varchar(100) DEFAULT NULL,
  `pdf_lib` varchar(20) DEFAULT 'dompdf'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sma_settings`
--

INSERT INTO `sma_settings` (`setting_id`, `logo`, `logo2`, `site_name`, `language`, `default_warehouse`, `accounting_method`, `default_currency`, `default_currency_id`, `default_tax_rate`, `rows_per_page`, `version`, `default_tax_rate2`, `dateformat`, `sales_prefix`, `quote_prefix`, `purchase_prefix`, `transfer_prefix`, `delivery_prefix`, `payment_prefix`, `return_prefix`, `returnp_prefix`, `expense_prefix`, `item_addition`, `theme`, `product_serial`, `default_discount`, `product_discount`, `discount_method`, `tax1`, `tax2`, `overselling`, `restrict_user`, `restrict_calendar`, `timezone`, `iwidth`, `iheight`, `twidth`, `theight`, `watermark`, `reg_ver`, `allow_reg`, `reg_notification`, `auto_reg`, `protocol`, `mailpath`, `smtp_host`, `smtp_user`, `smtp_pass`, `smtp_port`, `smtp_crypto`, `corn`, `customer_group`, `default_email`, `mmode`, `bc_fix`, `auto_detect_barcode`, `captcha`, `reference_format`, `racks`, `attributes`, `product_expiry`, `decimals`, `qty_decimals`, `decimals_sep`, `thousands_sep`, `invoice_view`, `default_biller`, `rtl`, `each_spent`, `ca_point`, `each_sale`, `sa_point`, `update`, `sac`, `display_all_products`, `display_symbol`, `symbol`, `remove_expired`, `barcode_separator`, `set_focus`, `price_group`, `barcode_img`, `ppayment_prefix`, `disable_editing`, `qa_prefix`, `update_cost`, `apis`, `state`, `pdf_lib`) VALUES
(1, 'Website-Logo.png', 'banner_alawi1.png', 'Scot Removals', 'english', 1, 2, 'OMR', 1, 1, 25, '3.4.6', 1, 5, NULL, 'QUOTE', 'PO', 'TR', 'DO', NULL, 'SR', 'PR', '', 1, 'default', 1, 1, 0, 1, 1, 1, 0, 1, 0, 'Asia/Muscat', 1080, 1220, 150, 150, 0, 0, 0, 0, NULL, 'smtp', '/usr/sbin/sendmail', 'smtp.gmail.com', 'scotremovals@gmail.com', 'omanoman123', '465', 'tls', NULL, 1, 'aliyounas41@gmail.com', 0, 4, 1, 0, 0, 0, 1, 0, 3, 0, '', '', 2, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, 2, '', 0, '-', 0, NULL, 1, NULL, 90, '', 0, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sma_shop_settings`
--

CREATE TABLE `sma_shop_settings` (
  `shop_id` int(11) NOT NULL,
  `shop_name` varchar(55) NOT NULL,
  `description` varchar(160) NOT NULL,
  `biller` int(11) NOT NULL,
  `about_link` varchar(55) NOT NULL,
  `terms_link` varchar(55) NOT NULL,
  `privacy_link` varchar(55) NOT NULL,
  `contact_link` varchar(55) NOT NULL,
  `payment_text` varchar(100) NOT NULL,
  `follow_text` varchar(100) NOT NULL,
  `facebook` varchar(55) NOT NULL,
  `twitter` varchar(55) DEFAULT NULL,
  `google_plus` varchar(55) DEFAULT NULL,
  `instagram` varchar(55) DEFAULT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `email` varchar(55) DEFAULT NULL,
  `cookie_message` varchar(180) DEFAULT NULL,
  `cookie_link` varchar(55) DEFAULT NULL,
  `slider` text,
  `shipping` int(11) DEFAULT NULL,
  `version` varchar(10) DEFAULT '3.4.6',
  `logo` varchar(55) DEFAULT NULL,
  `bank_details` varchar(255) DEFAULT NULL,
  `products_page` tinyint(1) DEFAULT NULL,
  `hide0` tinyint(1) DEFAULT '0',
  `products_description` varchar(255) DEFAULT NULL,
  `private` tinyint(1) DEFAULT '0',
  `hide_price` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sma_shop_settings`
--

INSERT INTO `sma_shop_settings` (`shop_id`, `shop_name`, `description`, `biller`, `about_link`, `terms_link`, `privacy_link`, `contact_link`, `payment_text`, `follow_text`, `facebook`, `twitter`, `google_plus`, `instagram`, `phone`, `email`, `cookie_message`, `cookie_link`, `slider`, `shipping`, `version`, `logo`, `bank_details`, `products_page`, `hide0`, `products_description`, `private`, `hide_price`) VALUES
(1, 'Scot Removals', 'Scot Removals', 3, '', '', '', '', 'We accept PayPal or you can pay with your credit/debit cards.', 'Please click the link below to follow us on social media.', 'http://facebook.com/scotRemovals', '', '', '', '98593372', 'scotremovals@gmail.com', 'We use cookies to improve your experience on our website. By browsing this website, you agree to our use of cookies.', '', '[{\"image\":\"truk_circle.png\",\"link\":\"\",\"caption\":\"\"}]', 1, '3.4.6', 'Website-Logo3.png', '', 0, 0, 'Scot Removals', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `sma_sms_settings`
--

CREATE TABLE `sma_sms_settings` (
  `id` int(11) NOT NULL,
  `auto_send` tinyint(1) DEFAULT NULL,
  `config` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sma_sms_settings`
--

INSERT INTO `sma_sms_settings` (`id`, `auto_send`, `config`) VALUES
(1, NULL, '{\"gateway\":\"Log\",\"Log\":{}');

-- --------------------------------------------------------

--
-- Table structure for table `sma_suspended_bills`
--

CREATE TABLE `sma_suspended_bills` (
  `id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `customer_id` int(11) NOT NULL,
  `customer` varchar(55) DEFAULT NULL,
  `count` int(11) NOT NULL,
  `order_discount_id` varchar(20) DEFAULT NULL,
  `order_tax_id` int(11) DEFAULT NULL,
  `total` decimal(25,4) NOT NULL,
  `biller_id` int(11) DEFAULT NULL,
  `warehouse_id` int(11) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `suspend_note` varchar(255) DEFAULT NULL,
  `shipping` decimal(15,4) DEFAULT '0.0000',
  `cgst` decimal(25,4) DEFAULT NULL,
  `sgst` decimal(25,4) DEFAULT NULL,
  `igst` decimal(25,4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sma_suspended_items`
--

CREATE TABLE `sma_suspended_items` (
  `id` int(11) NOT NULL,
  `suspend_id` int(11) UNSIGNED NOT NULL,
  `product_id` int(11) UNSIGNED NOT NULL,
  `product_code` varchar(55) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `net_unit_price` decimal(25,4) NOT NULL,
  `unit_price` decimal(25,4) NOT NULL,
  `quantity` decimal(15,4) DEFAULT '0.0000',
  `warehouse_id` int(11) DEFAULT NULL,
  `item_tax` decimal(25,4) DEFAULT NULL,
  `tax_rate_id` int(11) DEFAULT NULL,
  `tax` varchar(55) DEFAULT NULL,
  `discount` varchar(55) DEFAULT NULL,
  `item_discount` decimal(25,4) DEFAULT NULL,
  `subtotal` decimal(25,4) NOT NULL,
  `serial_no` varchar(255) DEFAULT NULL,
  `option_id` int(11) DEFAULT NULL,
  `product_type` varchar(20) DEFAULT NULL,
  `real_unit_price` decimal(25,4) DEFAULT NULL,
  `product_unit_id` int(11) DEFAULT NULL,
  `product_unit_code` varchar(10) DEFAULT NULL,
  `unit_quantity` decimal(15,4) NOT NULL,
  `comment` varchar(255) DEFAULT NULL,
  `gst` varchar(20) DEFAULT NULL,
  `cgst` decimal(25,4) DEFAULT NULL,
  `sgst` decimal(25,4) DEFAULT NULL,
  `igst` decimal(25,4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sma_units`
--

CREATE TABLE `sma_units` (
  `id` int(11) NOT NULL,
  `code` varchar(10) NOT NULL,
  `name` varchar(55) NOT NULL,
  `base_unit` int(11) DEFAULT NULL,
  `operator` varchar(1) DEFAULT NULL,
  `unit_value` varchar(55) DEFAULT NULL,
  `operation_value` varchar(55) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sma_units`
--

INSERT INTO `sma_units` (`id`, `code`, `name`, `base_unit`, `operator`, `unit_value`, `operation_value`) VALUES
(1, 'unit', 'Unit', NULL, NULL, NULL, NULL),
(2, 'kg', 'KILOGRAME', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sma_users`
--

CREATE TABLE `sma_users` (
  `id` int(11) UNSIGNED NOT NULL,
  `last_ip_address` varbinary(45) DEFAULT NULL,
  `ip_address` varbinary(45) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(40) NOT NULL,
  `salt` varchar(40) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) UNSIGNED DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) UNSIGNED NOT NULL,
  `last_login` int(11) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `avatar` varchar(55) DEFAULT NULL,
  `gender` varchar(20) DEFAULT NULL,
  `group_id` int(10) UNSIGNED NOT NULL,
  `biller_id` int(10) UNSIGNED DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `show_cost` tinyint(1) DEFAULT '0',
  `show_price` tinyint(1) DEFAULT '0',
  `award_points` int(11) DEFAULT '0',
  `view_right` tinyint(1) NOT NULL DEFAULT '0',
  `edit_right` tinyint(1) NOT NULL DEFAULT '0',
  `allow_discount` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sma_users`
--

INSERT INTO `sma_users` (`id`, `last_ip_address`, `ip_address`, `name`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `company`, `phone`, `avatar`, `gender`, `group_id`, `biller_id`, `company_id`, `show_cost`, `show_price`, `award_points`, `view_right`, `edit_right`, `allow_discount`) VALUES
(5, 0x3a3a31, 0x34312e36302e3131352e313431, NULL, 'testing', '3570067ef54c74c5b433c13aebd7cc2443238dbb', NULL, 'info@adroitLight.com', NULL, NULL, NULL, '1634752cc2e3e730528104ce47d8d44a63f38a41', 1534798528, 1591260782, 1, 'ALS', '03066634430', 'c42ae8316975d8af015cbbbec9397ff1.jpg', 'male', 1, NULL, NULL, 0, 0, 0, 1, 0, 0),
(6, 0x3137382e32302e31392e313336, 0x38322e3137382e3138352e323139, NULL, 'alawi', '432003099b9ab38fb02dc55e24f71ffe24c61e6a', NULL, 'alawiexpress@gmail.com', NULL, NULL, NULL, NULL, 1585673574, 1586633182, 1, 'ALAWI', '98593373', NULL, 'male', 1, NULL, NULL, 0, 0, 0, 1, 0, 0),
(7, 0x3a3a31, 0x3a3a31, NULL, 'alibinyounas', 'c06e84cf6f4ee05ddeb63fad890175b6dcfe4bd0', NULL, 'aliyounas41@gmail.com', '7717b6794b9e390cfd1cc09f9670b7c899b42544', NULL, NULL, NULL, 1587390569, 1587391197, 1, 'ALS', '345', NULL, 'male', 3, NULL, NULL, 0, 0, 0, 0, 0, 0),
(22, 0x3a3a31, 0x3a3a31, 'Atta Ur Rehman', 'atta@gmail.com', 'ed503e875d5b582a073b36208caecda5e25badaf', NULL, 'atta@gmail.com', NULL, NULL, NULL, NULL, 1587451416, 1587705320, 1, NULL, '3213', NULL, 'male', 3, NULL, 11, 0, 0, 0, 0, 0, 0),
(23, NULL, 0x3a3a31, 'hassan', 'hassan@g.com', 'ed14d502561411192f04ca927d66e7249d6fcf91', NULL, 'hassan@g.com', NULL, NULL, NULL, NULL, 1587707189, 1587707189, 1, '-', '444555', NULL, 'male', 3, NULL, 13, 0, 0, 0, 0, 0, 0),
(24, 0x3a3a31, 0x3a3a31, 'shary', 'shary@gmail.com', '7b2328509ef955380d24c6d22d10a88f97505d50', NULL, 'shary@gmail.com', NULL, NULL, NULL, '5d7f2e55d869a4dcffed28eaa380b90eda82a5e9', 1587709217, 1587811965, 1, '-', '1111', NULL, 'male', 3, NULL, 14, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `sma_user_logins`
--

CREATE TABLE `sma_user_logins` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `company_id` int(11) DEFAULT NULL,
  `ip_address` varbinary(16) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sma_user_logins`
--

INSERT INTO `sma_user_logins` (`id`, `user_id`, `company_id`, `ip_address`, `login`, `time`) VALUES
(1, 7, NULL, 0x3a3a31, 'aliyounas41@gmail.com', '2020-04-20 13:52:04'),
(2, 7, NULL, 0x3a3a31, 'aliyounas41@gmail.com', '2020-04-20 13:59:57'),
(3, 22, NULL, 0x3a3a31, 'atta@gmail.com', '2020-04-21 06:43:56'),
(4, 22, NULL, 0x3a3a31, 'atta@gmail.com', '2020-04-21 08:12:13'),
(5, 22, NULL, 0x3a3a31, 'atta@gmail.com', '2020-04-21 08:18:49'),
(6, 22, NULL, 0x3a3a31, 'atta@gmail.com', '2020-04-21 14:49:20'),
(7, 22, NULL, 0x3a3a31, 'atta@gmail.com', '2020-04-22 07:14:53'),
(8, 22, NULL, 0x3a3a31, 'atta@gmail.com', '2020-04-22 09:39:44'),
(9, 22, NULL, 0x3a3a31, 'atta@gmail.com', '2020-04-22 12:13:57'),
(10, 22, NULL, 0x3a3a31, 'atta@gmail.com', '2020-04-22 14:52:45'),
(11, 22, NULL, 0x3a3a31, 'atta@gmail.com', '2020-04-22 17:46:07'),
(12, 5, NULL, 0x3a3a31, 'testing', '2020-04-22 17:57:56'),
(13, 5, NULL, 0x3a3a31, 'testing', '2020-04-23 05:24:49'),
(14, 5, NULL, 0x3a3a31, 'testing', '2020-04-23 05:24:59'),
(15, 5, NULL, 0x3a3a31, 'testing', '2020-04-23 06:20:06'),
(16, 22, NULL, 0x3a3a31, 'atta@gmail.com', '2020-04-23 06:54:11'),
(17, 22, NULL, 0x3a3a31, 'atta@gmail.com', '2020-04-23 09:02:06'),
(18, 22, NULL, 0x3a3a31, 'atta@gmail.com', '2020-04-23 18:33:41'),
(19, 5, NULL, 0x3a3a31, 'testing', '2020-04-23 18:45:34'),
(20, 22, NULL, 0x3a3a31, 'atta@gmail.com', '2020-04-24 05:15:20'),
(21, 24, NULL, 0x3a3a31, 'shary@gmail.com', '2020-04-24 06:20:38'),
(22, 5, NULL, 0x3a3a31, 'testing', '2020-04-25 11:13:26'),
(23, 5, NULL, 0x3a3a31, 'testing', '2020-04-25 11:13:54'),
(24, 5, NULL, 0x3a3a31, 'testing', '2020-05-04 12:05:42'),
(25, 5, NULL, 0x3a3a31, 'testing', '2020-05-05 10:42:12'),
(26, 5, NULL, 0x3a3a31, 'testing', '2020-05-14 06:08:37'),
(27, 5, NULL, 0x3a3a31, 'testing', '2020-05-14 07:45:07'),
(28, 5, NULL, 0x3a3a31, 'testing', '2020-05-15 04:54:46'),
(29, 5, NULL, 0x3a3a31, 'testing', '2020-05-15 09:02:04'),
(30, 5, NULL, 0x3a3a31, 'testing', '2020-05-15 09:04:06'),
(31, 5, NULL, 0x3a3a31, 'testing', '2020-05-16 04:36:07'),
(32, 5, NULL, 0x3a3a31, 'testing', '2020-05-16 07:11:10'),
(33, 5, NULL, 0x3a3a31, 'testing', '2020-05-16 08:56:17'),
(34, 5, NULL, 0x3a3a31, 'testing', '2020-05-18 06:20:04'),
(35, 5, NULL, 0x3a3a31, 'testing', '2020-05-19 09:04:45'),
(36, 5, NULL, 0x3a3a31, 'testing', '2020-05-19 09:55:16'),
(37, 5, NULL, 0x3a3a31, 'testing', '2020-05-19 10:39:16'),
(38, 5, NULL, 0x3a3a31, 'testing', '2020-05-27 06:30:11'),
(39, 5, NULL, 0x3a3a31, 'testing', '2020-05-27 06:56:36'),
(40, 5, NULL, 0x3a3a31, 'testing', '2020-05-28 12:42:45'),
(41, 5, NULL, 0x3a3a31, 'testing', '2020-05-29 10:27:50'),
(42, 5, NULL, 0x3a3a31, 'testing', '2020-05-30 06:49:27'),
(43, 5, NULL, 0x3a3a31, 'testing', '2020-05-30 08:50:05'),
(44, 5, NULL, 0x3a3a31, 'testing', '2020-06-02 05:34:33'),
(45, 5, NULL, 0x3a3a31, 'testing', '2020-06-03 15:34:51'),
(46, 5, NULL, 0x3a3a31, 'testing', '2020-06-03 16:48:07'),
(47, 5, NULL, 0x3a3a31, 'testing', '2020-06-04 05:12:18'),
(48, 5, NULL, 0x3a3a31, 'testing', '2020-06-04 08:53:02');

-- --------------------------------------------------------

--
-- Table structure for table `sma_wishlist`
--

CREATE TABLE `sma_wishlist` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sma_addresses`
--
ALTER TABLE `sma_addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_id` (`company_id`);

--
-- Indexes for table `sma_api_keys`
--
ALTER TABLE `sma_api_keys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sma_api_limits`
--
ALTER TABLE `sma_api_limits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sma_api_logs`
--
ALTER TABLE `sma_api_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sma_calendar`
--
ALTER TABLE `sma_calendar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sma_captcha`
--
ALTER TABLE `sma_captcha`
  ADD PRIMARY KEY (`captcha_id`),
  ADD KEY `word` (`word`);

--
-- Indexes for table `sma_cart`
--
ALTER TABLE `sma_cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sma_cart_web`
--
ALTER TABLE `sma_cart_web`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sma_categories`
--
ALTER TABLE `sma_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `sma_categories_translation`
--
ALTER TABLE `sma_categories_translation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sma_companies`
--
ALTER TABLE `sma_companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sma_currencies`
--
ALTER TABLE `sma_currencies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sma_date_format`
--
ALTER TABLE `sma_date_format`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sma_deposits`
--
ALTER TABLE `sma_deposits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sma_floors`
--
ALTER TABLE `sma_floors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sma_groups`
--
ALTER TABLE `sma_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sma_login_attempts`
--
ALTER TABLE `sma_login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sma_notifications`
--
ALTER TABLE `sma_notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sma_order_ref`
--
ALTER TABLE `sma_order_ref`
  ADD PRIMARY KEY (`ref_id`);

--
-- Indexes for table `sma_pages`
--
ALTER TABLE `sma_pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sma_permissions`
--
ALTER TABLE `sma_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sma_pos_settings`
--
ALTER TABLE `sma_pos_settings`
  ADD PRIMARY KEY (`pos_id`);

--
-- Indexes for table `sma_printers`
--
ALTER TABLE `sma_printers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sma_products`
--
ALTER TABLE `sma_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `id_2` (`id`);

--
-- Indexes for table `sma_products_categories`
--
ALTER TABLE `sma_products_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sma_products_prices`
--
ALTER TABLE `sma_products_prices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sma_products_translation`
--
ALTER TABLE `sma_products_translation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sma_product_photos`
--
ALTER TABLE `sma_product_photos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sma_sales`
--
ALTER TABLE `sma_sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `sma_sale_items`
--
ALTER TABLE `sma_sale_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sale_id` (`sale_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `product_id_2` (`product_id`,`sale_id`),
  ADD KEY `sale_id_2` (`sale_id`,`product_id`);

--
-- Indexes for table `sma_sessions`
--
ALTER TABLE `sma_sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ci_sessions_timestamp` (`timestamp`);

--
-- Indexes for table `sma_settings`
--
ALTER TABLE `sma_settings`
  ADD PRIMARY KEY (`setting_id`);

--
-- Indexes for table `sma_shop_settings`
--
ALTER TABLE `sma_shop_settings`
  ADD PRIMARY KEY (`shop_id`);

--
-- Indexes for table `sma_sms_settings`
--
ALTER TABLE `sma_sms_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sma_suspended_bills`
--
ALTER TABLE `sma_suspended_bills`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sma_suspended_items`
--
ALTER TABLE `sma_suspended_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sma_units`
--
ALTER TABLE `sma_units`
  ADD PRIMARY KEY (`id`),
  ADD KEY `base_unit` (`base_unit`);

--
-- Indexes for table `sma_users`
--
ALTER TABLE `sma_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `group_id` (`group_id`,`biller_id`),
  ADD KEY `group_id_2` (`group_id`,`company_id`);

--
-- Indexes for table `sma_user_logins`
--
ALTER TABLE `sma_user_logins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sma_wishlist`
--
ALTER TABLE `sma_wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sma_addresses`
--
ALTER TABLE `sma_addresses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `sma_api_keys`
--
ALTER TABLE `sma_api_keys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sma_api_limits`
--
ALTER TABLE `sma_api_limits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sma_api_logs`
--
ALTER TABLE `sma_api_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `sma_calendar`
--
ALTER TABLE `sma_calendar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sma_captcha`
--
ALTER TABLE `sma_captcha`
  MODIFY `captcha_id` bigint(13) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sma_cart`
--
ALTER TABLE `sma_cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=247;

--
-- AUTO_INCREMENT for table `sma_categories`
--
ALTER TABLE `sma_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `sma_categories_translation`
--
ALTER TABLE `sma_categories_translation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sma_companies`
--
ALTER TABLE `sma_companies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `sma_currencies`
--
ALTER TABLE `sma_currencies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sma_date_format`
--
ALTER TABLE `sma_date_format`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sma_deposits`
--
ALTER TABLE `sma_deposits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sma_floors`
--
ALTER TABLE `sma_floors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `sma_groups`
--
ALTER TABLE `sma_groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sma_login_attempts`
--
ALTER TABLE `sma_login_attempts`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sma_notifications`
--
ALTER TABLE `sma_notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sma_order_ref`
--
ALTER TABLE `sma_order_ref`
  MODIFY `ref_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sma_pages`
--
ALTER TABLE `sma_pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sma_permissions`
--
ALTER TABLE `sma_permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sma_printers`
--
ALTER TABLE `sma_printers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sma_products`
--
ALTER TABLE `sma_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `sma_products_categories`
--
ALTER TABLE `sma_products_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sma_products_prices`
--
ALTER TABLE `sma_products_prices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `sma_products_translation`
--
ALTER TABLE `sma_products_translation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `sma_product_photos`
--
ALTER TABLE `sma_product_photos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sma_sales`
--
ALTER TABLE `sma_sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `sma_sale_items`
--
ALTER TABLE `sma_sale_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `sma_sms_settings`
--
ALTER TABLE `sma_sms_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sma_suspended_bills`
--
ALTER TABLE `sma_suspended_bills`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sma_suspended_items`
--
ALTER TABLE `sma_suspended_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sma_units`
--
ALTER TABLE `sma_units`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sma_users`
--
ALTER TABLE `sma_users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `sma_user_logins`
--
ALTER TABLE `sma_user_logins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `sma_wishlist`
--
ALTER TABLE `sma_wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
