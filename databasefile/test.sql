-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 24, 2018 at 02:26 AM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `driver`
--

CREATE TABLE `driver` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) NOT NULL,
  `orders` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `driver`
--

INSERT INTO `driver` (`id`, `username`, `password`, `remember_token`, `orders`) VALUES
(1, 'driver-1', '$2y$10$wyL6otWWc7TDfwUCTC21/exf.rxW14dDo5XFgn/mehOjZ4vDxz7q.', 'urwzFg8mgM7VxU38fHj1w48o1DE6dd8BgRnYQ5VoT6UBzN9hChlRcllU3sYA', '[{\"id\":1,\"address\":\"jkarta\",\"item\":1,\"user\":1,\"driver\":1,\"orderstatus\":\"[{\\\"id\\\":18,\\\"statusdatetime\\\":\\\"2018-06-24 04:11:20\\\",\\\"order\\\":1,\\\"status\\\":17}]\"}]'),
(2, 'driver-2', '$2y$10$swlJLNSjLSTClUZumFetqeY7Mmc9GvxiFAkONtMhhyO4M1TgirCmS', 'ti9qGf4bGQxDMk74QjW00n4G0KgU6pbzmyK3nN2ub8n7zmUN3nnwiAimjROI', '[{\"id\":7,\"address\":\"lombok\",\"item\":3,\"user\":1,\"driver\":2,\"orderstatus\":\"[{\\\"id\\\":30,\\\"statusdatetime\\\":\\\"2018-06-24 07:13:27\\\",\\\"order\\\":7,\\\"status\\\":29}]\"}]');

-- --------------------------------------------------------

--
-- Table structure for table `itemnya`
--

CREATE TABLE `itemnya` (
  `id` int(11) NOT NULL,
  `sku` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` double NOT NULL,
  `orders` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `itemnya`
--

INSERT INTO `itemnya` (`id`, `sku`, `name`, `description`, `price`, `orders`) VALUES
(1, 'SKU001', 'XIAOMI', 'REDMI 3', 3200000, '[{\"id\":3,\"address\":\"test\",\"item\":1,\"user\":1,\"driver\":2,\"orderstatus\":\"[{\\\"id\\\":14,\\\"statusdatetime\\\":\\\"2018-06-24 04:10:27\\\",\\\"order\\\":3,\\\"status\\\":13}]\"},{\"id\":1,\"address\":\"jkarta\",\"item\":1,\"user\":1,\"driver\":1,\"orderstatus\":\"[{\\\"id\\\":18,\\\"statusdatetime\\\":\\\"2018-06-24 04:11:20\\\",\\\"order\\\":1,\\\"status\\\":17}]\"}]'),
(2, 'SKU002', 'SAMSUNG', 'NOTE 3', 4500000, '[{\"id\":6,\"address\":\"makasar\",\"item\":2,\"user\":1,\"driver\":0,\"orderstatus\":\"[{\\\"id\\\":23,\\\"statusdatetime\\\":\\\"2018-06-24 04:13:05\\\",\\\"order\\\":6,\\\"status\\\":22}]\"},{\"id\":5,\"address\":\"bali\",\"item\":2,\"user\":1,\"driver\":2,\"orderstatus\":\"[{\\\"id\\\":22,\\\"statusdatetime\\\":\\\"2018-06-24 04:12:38\\\",\\\"order\\\":5,\\\"status\\\":21}]\"},{\"id\":2,\"address\":\"bandung\",\"item\":2,\"user\":1,\"driver\":1,\"orderstatus\":\"[{\\\"id\\\":10,\\\"statusdatetime\\\":\\\"2018-06-24 04:05:07\\\",\\\"order\\\":2,\\\"status\\\":9}]\"}]'),
(3, 'SKU003', 'IPHONE', '7S', 6500000, '[{\"id\":7,\"address\":\"lombok\",\"item\":3,\"user\":1,\"driver\":0,\"orderstatus\":\"[{\\\"id\\\":27,\\\"statusdatetime\\\":\\\"2018-06-24 07:12:12\\\",\\\"order\\\":7,\\\"status\\\":26}]\"},{\"id\":4,\"address\":\"bandung\",\"item\":3,\"user\":1,\"driver\":1,\"orderstatus\":\"[{\\\"id\\\":16,\\\"statusdatetime\\\":\\\"2018-06-24 04:11:13\\\",\\\"order\\\":4,\\\"status\\\":15}]\"}]');

-- --------------------------------------------------------

--
-- Table structure for table `ordernya`
--

CREATE TABLE `ordernya` (
  `id` int(11) NOT NULL,
  `address` text NOT NULL,
  `item` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `driver` int(11) NOT NULL,
  `orderstatus` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ordernya`
--

INSERT INTO `ordernya` (`id`, `address`, `item`, `user`, `driver`, `orderstatus`) VALUES
(1, 'jkarta', 1, 1, 1, '[{\"id\":18,\"statusdatetime\":\"2018-06-24 04:11:20\",\"order\":1,\"status\":17}]'),
(2, 'bandung', 2, 1, 1, '[{\"id\":10,\"statusdatetime\":\"2018-06-24 04:05:07\",\"order\":2,\"status\":9}]'),
(3, 'test', 1, 1, 2, '[{\"id\":14,\"statusdatetime\":\"2018-06-24 04:10:27\",\"order\":3,\"status\":13}]'),
(4, 'bandung', 3, 1, 1, '[{\"id\":16,\"statusdatetime\":\"2018-06-24 04:11:13\",\"order\":4,\"status\":15}]'),
(5, 'bali', 2, 1, 2, '[{\"id\":22,\"statusdatetime\":\"2018-06-24 04:12:38\",\"order\":5,\"status\":21}]'),
(6, 'makasar', 2, 1, 2, '[{\"id\":26,\"statusdatetime\":\"2018-06-24 04:13:32\",\"order\":6,\"status\":25}]'),
(7, 'lombok', 3, 1, 2, '[{\"id\":30,\"statusdatetime\":\"2018-06-24 07:13:27\",\"order\":7,\"status\":29}]');

-- --------------------------------------------------------

--
-- Table structure for table `orderstatus`
--

CREATE TABLE `orderstatus` (
  `id` int(11) NOT NULL,
  `statusdatetime` datetime NOT NULL,
  `order` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orderstatus`
--

INSERT INTO `orderstatus` (`id`, `statusdatetime`, `order`, `status`) VALUES
(1, '2018-06-23 19:29:07', 1, 1),
(2, '2018-06-23 21:22:06', 2, 2),
(3, '2018-06-24 00:21:42', 3, 3),
(6, '2018-06-24 01:54:46', 1, 4),
(7, '2018-06-24 02:03:26', 4, 6),
(8, '2018-06-24 02:18:05', 2, 7),
(9, '2018-06-24 03:09:05', 2, 8),
(10, '2018-06-24 04:05:07', 2, 9),
(11, '2018-06-24 04:08:48', 3, 10),
(12, '2018-06-24 04:09:44', 4, 11),
(13, '2018-06-24 04:10:00', 3, 12),
(14, '2018-06-24 04:10:27', 3, 13),
(15, '2018-06-24 04:11:10', 4, 14),
(16, '2018-06-24 04:11:13', 4, 15),
(17, '2018-06-24 04:11:17', 1, 16),
(18, '2018-06-24 04:11:20', 1, 17),
(19, '2018-06-24 04:11:35', 5, 18),
(20, '2018-06-24 04:11:50', 5, 19),
(21, '2018-06-24 04:12:34', 5, 20),
(22, '2018-06-24 04:12:38', 5, 21),
(23, '2018-06-24 04:13:05', 6, 22),
(24, '2018-06-24 04:13:16', 6, 23),
(25, '2018-06-24 04:13:28', 6, 24),
(26, '2018-06-24 04:13:32', 6, 25),
(27, '2018-06-24 07:12:12', 7, 26),
(28, '2018-06-24 07:12:42', 7, 27),
(29, '2018-06-24 07:13:22', 7, 28),
(30, '2018-06-24 07:13:27', 7, 29);

-- --------------------------------------------------------

--
-- Table structure for table `statusnya`
--

CREATE TABLE `statusnya` (
  `id` int(11) NOT NULL,
  `code` bigint(20) NOT NULL,
  `description` text NOT NULL,
  `orderstatuses` text NOT NULL,
  `orderdrivers` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `statusnya`
--

INSERT INTO `statusnya` (`id`, `code`, `description`, `orderstatuses`, `orderdrivers`) VALUES
(1, 20180623192907, 'Order Created', '[]', ''),
(2, 20180623212206, 'Order Created', '[]', ''),
(3, 20180624002142, 'Order Created', '[{\"id\":3,\"address\":\"test\",\"item\":1,\"user\":1,\"driver\":0,\"orderstatus\":\"[{\\\"id\\\":3,\\\"statusdatetime\\\":\\\"2018-06-24 00:21:42\\\",\\\"order\\\":3,\\\"status\\\":3}]\"}]', ''),
(4, 20180624015446, 'Order Taken By Driver', '[{\"id\":1,\"address\":\"jkarta\",\"item\":1,\"user\":1,\"driver\":1,\"orderstatus\":\"[{\\\"id\\\":6,\\\"statusdatetime\\\":\\\"2018-06-24 01:54:46\\\",\\\"order\\\":1,\\\"status\\\":4}]\"}]', '{\"id\":1,\"username\":\"driver-1\",\"orders\":\"[{\\\"id\\\":1,\\\"address\\\":\\\"jkarta\\\",\\\"item\\\":1,\\\"user\\\":1,\\\"driver\\\":1,\\\"orderstatus\\\":\\\"[{\\\\\\\"id\\\\\\\":6,\\\\\\\"statusdatetime\\\\\\\":\\\\\\\"2018-06-24 01:54:46\\\\\\\",\\\\\\\"order\\\\\\\":1,\\\\\\\"status\\\\\\\":4}]\\\"}]\"}'),
(6, 20180624020326, 'Order Created', '[{\"id\":4,\"address\":\"bandung\",\"item\":3,\"user\":1,\"driver\":0,\"orderstatus\":\"[{\\\"id\\\":7,\\\"statusdatetime\\\":\\\"2018-06-24 02:03:26\\\",\\\"order\\\":4,\\\"status\\\":5}]\"}]', ''),
(7, 20180624021805, 'Order Taken By Driver', '[{\"id\":2,\"address\":\"bandung\",\"item\":2,\"user\":1,\"driver\":1,\"orderstatus\":\"[{\\\"id\\\":8,\\\"statusdatetime\\\":\\\"2018-06-24 02:18:05\\\",\\\"order\\\":2,\\\"status\\\":7}]\"}]', '{\"id\":1,\"username\":\"driver-1\",\"orders\":\"[{\\\"id\\\":2,\\\"address\\\":\\\"bandung\\\",\\\"item\\\":2,\\\"user\\\":1,\\\"driver\\\":1,\\\"orderstatus\\\":\\\"[{\\\\\\\"id\\\\\\\":8,\\\\\\\"statusdatetime\\\\\\\":\\\\\\\"2018-06-24 02:18:05\\\\\\\",\\\\\\\"order\\\\\\\":2,\\\\\\\"status\\\\\\\":7}]\\\"}]\"}'),
(8, 20180624030905, 'Order On Delivery', '[{\"id\":2,\"address\":\"bandung\",\"item\":2,\"user\":1,\"driver\":1,\"orderstatus\":\"[{\\\"id\\\":9,\\\"statusdatetime\\\":\\\"2018-06-24 03:09:05\\\",\\\"order\\\":2,\\\"status\\\":8}]\"}]', '{\"id\":1,\"username\":\"driver-1\",\"orders\":\"[{\\\"id\\\":2,\\\"address\\\":\\\"bandung\\\",\\\"item\\\":2,\\\"user\\\":1,\\\"driver\\\":1,\\\"orderstatus\\\":\\\"[{\\\\\\\"id\\\\\\\":9,\\\\\\\"statusdatetime\\\\\\\":\\\\\\\"2018-06-24 03:09:05\\\\\\\",\\\\\\\"order\\\\\\\":2,\\\\\\\"status\\\\\\\":8}]\\\"}]\"}'),
(9, 20180624040507, 'Order Delivered', '[{\"id\":2,\"address\":\"bandung\",\"item\":2,\"user\":1,\"driver\":1,\"orderstatus\":\"[{\\\"id\\\":10,\\\"statusdatetime\\\":\\\"2018-06-24 04:05:07\\\",\\\"order\\\":2,\\\"status\\\":9}]\"}]', '{\"id\":1,\"username\":\"driver-1\",\"orders\":\"[{\\\"id\\\":2,\\\"address\\\":\\\"bandung\\\",\\\"item\\\":2,\\\"user\\\":1,\\\"driver\\\":1,\\\"orderstatus\\\":\\\"[{\\\\\\\"id\\\\\\\":10,\\\\\\\"statusdatetime\\\\\\\":\\\\\\\"2018-06-24 04:05:07\\\\\\\",\\\\\\\"order\\\\\\\":2,\\\\\\\"status\\\\\\\":9}]\\\"}]\"}'),
(10, 20180624040848, 'Order Taken By Driver', '[{\"id\":3,\"address\":\"test\",\"item\":1,\"user\":1,\"driver\":2,\"orderstatus\":\"[{\\\"id\\\":11,\\\"statusdatetime\\\":\\\"2018-06-24 04:08:48\\\",\\\"order\\\":3,\\\"status\\\":10}]\"}]', '{\"id\":2,\"username\":\"driver-2\",\"orders\":\"[{\\\"id\\\":3,\\\"address\\\":\\\"test\\\",\\\"item\\\":1,\\\"user\\\":1,\\\"driver\\\":2,\\\"orderstatus\\\":\\\"[{\\\\\\\"id\\\\\\\":11,\\\\\\\"statusdatetime\\\\\\\":\\\\\\\"2018-06-24 04:08:48\\\\\\\",\\\\\\\"order\\\\\\\":3,\\\\\\\"status\\\\\\\":10}]\\\"}]\"}'),
(11, 20180624040944, 'Order Taken By Driver', '[{\"id\":4,\"address\":\"bandung\",\"item\":3,\"user\":1,\"driver\":1,\"orderstatus\":\"[{\\\"id\\\":12,\\\"statusdatetime\\\":\\\"2018-06-24 04:09:44\\\",\\\"order\\\":4,\\\"status\\\":11}]\"}]', '{\"id\":1,\"username\":\"driver-1\",\"orders\":\"[{\\\"id\\\":4,\\\"address\\\":\\\"bandung\\\",\\\"item\\\":3,\\\"user\\\":1,\\\"driver\\\":1,\\\"orderstatus\\\":\\\"[{\\\\\\\"id\\\\\\\":12,\\\\\\\"statusdatetime\\\\\\\":\\\\\\\"2018-06-24 04:09:44\\\\\\\",\\\\\\\"order\\\\\\\":4,\\\\\\\"status\\\\\\\":11}]\\\"}]\"}'),
(12, 20180624041000, 'Order On Delivery', '[{\"id\":3,\"address\":\"test\",\"item\":1,\"user\":1,\"driver\":2,\"orderstatus\":\"[{\\\"id\\\":13,\\\"statusdatetime\\\":\\\"2018-06-24 04:10:00\\\",\\\"order\\\":3,\\\"status\\\":12}]\"}]', '{\"id\":2,\"username\":\"driver-2\",\"orders\":\"[{\\\"id\\\":3,\\\"address\\\":\\\"test\\\",\\\"item\\\":1,\\\"user\\\":1,\\\"driver\\\":2,\\\"orderstatus\\\":\\\"[{\\\\\\\"id\\\\\\\":13,\\\\\\\"statusdatetime\\\\\\\":\\\\\\\"2018-06-24 04:10:00\\\\\\\",\\\\\\\"order\\\\\\\":3,\\\\\\\"status\\\\\\\":12}]\\\"}]\"}'),
(13, 20180624041027, 'Order Delivered', '[{\"id\":3,\"address\":\"test\",\"item\":1,\"user\":1,\"driver\":2,\"orderstatus\":\"[{\\\"id\\\":14,\\\"statusdatetime\\\":\\\"2018-06-24 04:10:27\\\",\\\"order\\\":3,\\\"status\\\":13}]\"}]', '{\"id\":2,\"username\":\"driver-2\",\"orders\":\"[{\\\"id\\\":3,\\\"address\\\":\\\"test\\\",\\\"item\\\":1,\\\"user\\\":1,\\\"driver\\\":2,\\\"orderstatus\\\":\\\"[{\\\\\\\"id\\\\\\\":14,\\\\\\\"statusdatetime\\\\\\\":\\\\\\\"2018-06-24 04:10:27\\\\\\\",\\\\\\\"order\\\\\\\":3,\\\\\\\"status\\\\\\\":13}]\\\"}]\"}'),
(14, 20180624041110, 'Order On Delivery', '[{\"id\":4,\"address\":\"bandung\",\"item\":3,\"user\":1,\"driver\":1,\"orderstatus\":\"[{\\\"id\\\":15,\\\"statusdatetime\\\":\\\"2018-06-24 04:11:10\\\",\\\"order\\\":4,\\\"status\\\":14}]\"}]', '{\"id\":1,\"username\":\"driver-1\",\"orders\":\"[{\\\"id\\\":4,\\\"address\\\":\\\"bandung\\\",\\\"item\\\":3,\\\"user\\\":1,\\\"driver\\\":1,\\\"orderstatus\\\":\\\"[{\\\\\\\"id\\\\\\\":15,\\\\\\\"statusdatetime\\\\\\\":\\\\\\\"2018-06-24 04:11:10\\\\\\\",\\\\\\\"order\\\\\\\":4,\\\\\\\"status\\\\\\\":14}]\\\"}]\"}'),
(15, 20180624041113, 'Order Delivered', '[{\"id\":4,\"address\":\"bandung\",\"item\":3,\"user\":1,\"driver\":1,\"orderstatus\":\"[{\\\"id\\\":16,\\\"statusdatetime\\\":\\\"2018-06-24 04:11:13\\\",\\\"order\\\":4,\\\"status\\\":15}]\"}]', '{\"id\":1,\"username\":\"driver-1\",\"orders\":\"[{\\\"id\\\":4,\\\"address\\\":\\\"bandung\\\",\\\"item\\\":3,\\\"user\\\":1,\\\"driver\\\":1,\\\"orderstatus\\\":\\\"[{\\\\\\\"id\\\\\\\":16,\\\\\\\"statusdatetime\\\\\\\":\\\\\\\"2018-06-24 04:11:13\\\\\\\",\\\\\\\"order\\\\\\\":4,\\\\\\\"status\\\\\\\":15}]\\\"}]\"}'),
(16, 20180624041117, 'Order On Delivery', '[{\"id\":1,\"address\":\"jkarta\",\"item\":1,\"user\":1,\"driver\":1,\"orderstatus\":\"[{\\\"id\\\":17,\\\"statusdatetime\\\":\\\"2018-06-24 04:11:17\\\",\\\"order\\\":1,\\\"status\\\":16}]\"}]', '{\"id\":1,\"username\":\"driver-1\",\"orders\":\"[{\\\"id\\\":1,\\\"address\\\":\\\"jkarta\\\",\\\"item\\\":1,\\\"user\\\":1,\\\"driver\\\":1,\\\"orderstatus\\\":\\\"[{\\\\\\\"id\\\\\\\":17,\\\\\\\"statusdatetime\\\\\\\":\\\\\\\"2018-06-24 04:11:17\\\\\\\",\\\\\\\"order\\\\\\\":1,\\\\\\\"status\\\\\\\":16}]\\\"}]\"}'),
(17, 20180624041120, 'Order Delivered', '[{\"id\":1,\"address\":\"jkarta\",\"item\":1,\"user\":1,\"driver\":1,\"orderstatus\":\"[{\\\"id\\\":18,\\\"statusdatetime\\\":\\\"2018-06-24 04:11:20\\\",\\\"order\\\":1,\\\"status\\\":17}]\"}]', '{\"id\":1,\"username\":\"driver-1\",\"orders\":\"[{\\\"id\\\":1,\\\"address\\\":\\\"jkarta\\\",\\\"item\\\":1,\\\"user\\\":1,\\\"driver\\\":1,\\\"orderstatus\\\":\\\"[{\\\\\\\"id\\\\\\\":18,\\\\\\\"statusdatetime\\\\\\\":\\\\\\\"2018-06-24 04:11:20\\\\\\\",\\\\\\\"order\\\\\\\":1,\\\\\\\"status\\\\\\\":17}]\\\"}]\"}'),
(18, 20180624041135, 'Order Created', '[{\"id\":5,\"address\":\"bali\",\"item\":2,\"user\":1,\"driver\":0,\"orderstatus\":\"[{\\\"id\\\":19,\\\"statusdatetime\\\":\\\"2018-06-24 04:11:35\\\",\\\"order\\\":5,\\\"status\\\":18}]\"}]', ''),
(19, 20180624041150, 'Order Taken By Driver', '[{\"id\":5,\"address\":\"bali\",\"item\":2,\"user\":1,\"driver\":2,\"orderstatus\":\"[{\\\"id\\\":20,\\\"statusdatetime\\\":\\\"2018-06-24 04:11:50\\\",\\\"order\\\":5,\\\"status\\\":19}]\"}]', '{\"id\":2,\"username\":\"driver-2\",\"orders\":\"[{\\\"id\\\":5,\\\"address\\\":\\\"bali\\\",\\\"item\\\":2,\\\"user\\\":1,\\\"driver\\\":2,\\\"orderstatus\\\":\\\"[{\\\\\\\"id\\\\\\\":20,\\\\\\\"statusdatetime\\\\\\\":\\\\\\\"2018-06-24 04:11:50\\\\\\\",\\\\\\\"order\\\\\\\":5,\\\\\\\"status\\\\\\\":19}]\\\"}]\"}'),
(20, 20180624041234, 'Order On Delivery', '[{\"id\":5,\"address\":\"bali\",\"item\":2,\"user\":1,\"driver\":2,\"orderstatus\":\"[{\\\"id\\\":21,\\\"statusdatetime\\\":\\\"2018-06-24 04:12:34\\\",\\\"order\\\":5,\\\"status\\\":20}]\"}]', '{\"id\":2,\"username\":\"driver-2\",\"orders\":\"[{\\\"id\\\":5,\\\"address\\\":\\\"bali\\\",\\\"item\\\":2,\\\"user\\\":1,\\\"driver\\\":2,\\\"orderstatus\\\":\\\"[{\\\\\\\"id\\\\\\\":21,\\\\\\\"statusdatetime\\\\\\\":\\\\\\\"2018-06-24 04:12:34\\\\\\\",\\\\\\\"order\\\\\\\":5,\\\\\\\"status\\\\\\\":20}]\\\"}]\"}'),
(21, 20180624041238, 'Order Delivered', '[{\"id\":5,\"address\":\"bali\",\"item\":2,\"user\":1,\"driver\":2,\"orderstatus\":\"[{\\\"id\\\":22,\\\"statusdatetime\\\":\\\"2018-06-24 04:12:38\\\",\\\"order\\\":5,\\\"status\\\":21}]\"}]', '{\"id\":2,\"username\":\"driver-2\",\"orders\":\"[{\\\"id\\\":5,\\\"address\\\":\\\"bali\\\",\\\"item\\\":2,\\\"user\\\":1,\\\"driver\\\":2,\\\"orderstatus\\\":\\\"[{\\\\\\\"id\\\\\\\":22,\\\\\\\"statusdatetime\\\\\\\":\\\\\\\"2018-06-24 04:12:38\\\\\\\",\\\\\\\"order\\\\\\\":5,\\\\\\\"status\\\\\\\":21}]\\\"}]\"}'),
(22, 20180624041305, 'Order Created', '[{\"id\":6,\"address\":\"makasar\",\"item\":2,\"user\":1,\"driver\":0,\"orderstatus\":\"[{\\\"id\\\":23,\\\"statusdatetime\\\":\\\"2018-06-24 04:13:05\\\",\\\"order\\\":6,\\\"status\\\":22}]\"}]', ''),
(23, 20180624041316, 'Order Taken By Driver', '[{\"id\":6,\"address\":\"makasar\",\"item\":2,\"user\":1,\"driver\":2,\"orderstatus\":\"[{\\\"id\\\":24,\\\"statusdatetime\\\":\\\"2018-06-24 04:13:16\\\",\\\"order\\\":6,\\\"status\\\":23}]\"}]', '{\"id\":2,\"username\":\"driver-2\",\"orders\":\"[{\\\"id\\\":6,\\\"address\\\":\\\"makasar\\\",\\\"item\\\":2,\\\"user\\\":1,\\\"driver\\\":2,\\\"orderstatus\\\":\\\"[{\\\\\\\"id\\\\\\\":24,\\\\\\\"statusdatetime\\\\\\\":\\\\\\\"2018-06-24 04:13:16\\\\\\\",\\\\\\\"order\\\\\\\":6,\\\\\\\"status\\\\\\\":23}]\\\"}]\"}'),
(24, 20180624041328, 'Order On Delivery', '[{\"id\":6,\"address\":\"makasar\",\"item\":2,\"user\":1,\"driver\":2,\"orderstatus\":\"[{\\\"id\\\":25,\\\"statusdatetime\\\":\\\"2018-06-24 04:13:28\\\",\\\"order\\\":6,\\\"status\\\":24}]\"}]', '{\"id\":2,\"username\":\"driver-2\",\"orders\":\"[{\\\"id\\\":6,\\\"address\\\":\\\"makasar\\\",\\\"item\\\":2,\\\"user\\\":1,\\\"driver\\\":2,\\\"orderstatus\\\":\\\"[{\\\\\\\"id\\\\\\\":25,\\\\\\\"statusdatetime\\\\\\\":\\\\\\\"2018-06-24 04:13:28\\\\\\\",\\\\\\\"order\\\\\\\":6,\\\\\\\"status\\\\\\\":24}]\\\"}]\"}'),
(25, 20180624041332, 'Order Delivered', '[{\"id\":6,\"address\":\"makasar\",\"item\":2,\"user\":1,\"driver\":2,\"orderstatus\":\"[{\\\"id\\\":26,\\\"statusdatetime\\\":\\\"2018-06-24 04:13:32\\\",\\\"order\\\":6,\\\"status\\\":25}]\"}]', '{\"id\":2,\"username\":\"driver-2\",\"orders\":\"[{\\\"id\\\":6,\\\"address\\\":\\\"makasar\\\",\\\"item\\\":2,\\\"user\\\":1,\\\"driver\\\":2,\\\"orderstatus\\\":\\\"[{\\\\\\\"id\\\\\\\":26,\\\\\\\"statusdatetime\\\\\\\":\\\\\\\"2018-06-24 04:13:32\\\\\\\",\\\\\\\"order\\\\\\\":6,\\\\\\\"status\\\\\\\":25}]\\\"}]\"}'),
(26, 20180624071212, 'Order Created', '[{\"id\":7,\"address\":\"lombok\",\"item\":3,\"user\":1,\"driver\":0,\"orderstatus\":\"[{\\\"id\\\":27,\\\"statusdatetime\\\":\\\"2018-06-24 07:12:12\\\",\\\"order\\\":7,\\\"status\\\":26}]\"}]', ''),
(27, 20180624071242, 'Order Taken By Driver', '[{\"id\":7,\"address\":\"lombok\",\"item\":3,\"user\":1,\"driver\":2,\"orderstatus\":\"[{\\\"id\\\":28,\\\"statusdatetime\\\":\\\"2018-06-24 07:12:42\\\",\\\"order\\\":7,\\\"status\\\":27}]\"}]', '{\"id\":2,\"username\":\"driver-2\",\"orders\":\"[{\\\"id\\\":7,\\\"address\\\":\\\"lombok\\\",\\\"item\\\":3,\\\"user\\\":1,\\\"driver\\\":2,\\\"orderstatus\\\":\\\"[{\\\\\\\"id\\\\\\\":28,\\\\\\\"statusdatetime\\\\\\\":\\\\\\\"2018-06-24 07:12:42\\\\\\\",\\\\\\\"order\\\\\\\":7,\\\\\\\"status\\\\\\\":27}]\\\"}]\"}'),
(28, 20180624071322, 'Order On Delivery', '[{\"id\":7,\"address\":\"lombok\",\"item\":3,\"user\":1,\"driver\":2,\"orderstatus\":\"[{\\\"id\\\":29,\\\"statusdatetime\\\":\\\"2018-06-24 07:13:22\\\",\\\"order\\\":7,\\\"status\\\":28}]\"}]', '{\"id\":2,\"username\":\"driver-2\",\"orders\":\"[{\\\"id\\\":7,\\\"address\\\":\\\"lombok\\\",\\\"item\\\":3,\\\"user\\\":1,\\\"driver\\\":2,\\\"orderstatus\\\":\\\"[{\\\\\\\"id\\\\\\\":29,\\\\\\\"statusdatetime\\\\\\\":\\\\\\\"2018-06-24 07:13:22\\\\\\\",\\\\\\\"order\\\\\\\":7,\\\\\\\"status\\\\\\\":28}]\\\"}]\"}'),
(29, 20180624071327, 'Order Delivered', '[{\"id\":7,\"address\":\"lombok\",\"item\":3,\"user\":1,\"driver\":2,\"orderstatus\":\"[{\\\"id\\\":30,\\\"statusdatetime\\\":\\\"2018-06-24 07:13:27\\\",\\\"order\\\":7,\\\"status\\\":29}]\"}]', '{\"id\":2,\"username\":\"driver-2\",\"orders\":\"[{\\\"id\\\":7,\\\"address\\\":\\\"lombok\\\",\\\"item\\\":3,\\\"user\\\":1,\\\"driver\\\":2,\\\"orderstatus\\\":\\\"[{\\\\\\\"id\\\\\\\":30,\\\\\\\"statusdatetime\\\\\\\":\\\\\\\"2018-06-24 07:13:27\\\\\\\",\\\\\\\"order\\\\\\\":7,\\\\\\\"status\\\\\\\":29}]\\\"}]\"}');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `orders` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `remember_token`, `orders`) VALUES
(1, 'user-1', '$2y$10$FEuP8gLU8hUftf3HOVFf7.z9jTbJufqMgOFoRK5diC2srxLTapiIG', 'btokMPjEOp1Kq2Lt8TQFf8r8ESk8BrD9iQEut4js3U4tIrSW8pfOzAi0urck', '[{\"id\":7,\"address\":\"lombok\",\"item\":3,\"user\":1,\"driver\":2,\"orderstatus\":\"[{\\\"id\\\":30,\\\"statusdatetime\\\":\\\"2018-06-24 07:13:27\\\",\\\"order\\\":7,\\\"status\\\":29}]\"},{\"id\":6,\"address\":\"makasar\",\"item\":2,\"user\":1,\"driver\":2,\"orderstatus\":\"[{\\\"id\\\":26,\\\"statusdatetime\\\":\\\"2018-06-24 04:13:32\\\",\\\"order\\\":6,\\\"status\\\":25}]\"},{\"id\":5,\"address\":\"bali\",\"item\":2,\"user\":1,\"driver\":2,\"orderstatus\":\"[{\\\"id\\\":22,\\\"statusdatetime\\\":\\\"2018-06-24 04:12:38\\\",\\\"order\\\":5,\\\"status\\\":21}]\"},{\"id\":4,\"address\":\"bandung\",\"item\":3,\"user\":1,\"driver\":1,\"orderstatus\":\"[{\\\"id\\\":16,\\\"statusdatetime\\\":\\\"2018-06-24 04:11:13\\\",\\\"order\\\":4,\\\"status\\\":15}]\"},{\"id\":3,\"address\":\"test\",\"item\":1,\"user\":1,\"driver\":2,\"orderstatus\":\"[{\\\"id\\\":14,\\\"statusdatetime\\\":\\\"2018-06-24 04:10:27\\\",\\\"order\\\":3,\\\"status\\\":13}]\"},{\"id\":2,\"address\":\"bandung\",\"item\":2,\"user\":1,\"driver\":1,\"orderstatus\":\"[{\\\"id\\\":10,\\\"statusdatetime\\\":\\\"2018-06-24 04:05:07\\\",\\\"order\\\":2,\\\"status\\\":9}]\"},{\"id\":1,\"address\":\"jkarta\",\"item\":1,\"user\":1,\"driver\":1,\"orderstatus\":\"[{\\\"id\\\":18,\\\"statusdatetime\\\":\\\"2018-06-24 04:11:20\\\",\\\"order\\\":1,\\\"status\\\":17}]\"}]'),
(2, 'user-2', '$2y$10$z7k3CF0a60j.XwMLr4KoBeWYKO3AL8Kgh0Zo0Nav7FLRqVBZFK5PW', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `driver`
--
ALTER TABLE `driver`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `itemnya`
--
ALTER TABLE `itemnya`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ordernya`
--
ALTER TABLE `ordernya`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orderstatus`
--
ALTER TABLE `orderstatus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `statusnya`
--
ALTER TABLE `statusnya`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `driver`
--
ALTER TABLE `driver`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `itemnya`
--
ALTER TABLE `itemnya`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `ordernya`
--
ALTER TABLE `ordernya`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `orderstatus`
--
ALTER TABLE `orderstatus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `statusnya`
--
ALTER TABLE `statusnya`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
