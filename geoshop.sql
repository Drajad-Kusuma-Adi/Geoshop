-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 07, 2024 at 10:41 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `geoshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `analytics`
--

CREATE TABLE `analytics` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `content` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `analytics`
--

INSERT INTO `analytics` (`id`, `name`, `content`) VALUES
(1, 'total_guest', '387');

-- --------------------------------------------------------

--
-- Table structure for table `chats`
--

CREATE TABLE `chats` (
  `chat_id` int NOT NULL,
  `sender_id` int NOT NULL,
  `target_id` int NOT NULL,
  `content` text COLLATE utf8mb4_general_ci NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chats`
--

INSERT INTO `chats` (`chat_id`, `sender_id`, `target_id`, `content`, `datetime`) VALUES
(10, 13, 14, 'testing frontend', '2023-11-11 17:16:51'),
(11, 1, 7, 'send messaeg', '2023-11-21 10:43:29'),
(12, 1, 7, 'lah gak bisa', '2023-11-21 10:43:48'),
(13, 1, 7, 'apcb', '2023-11-21 10:43:54'),
(14, 21, 7, 'test chat', '2023-11-21 11:38:59');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int NOT NULL,
  `product_name` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `shop_id` int NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `price` float NOT NULL,
  `stock` int NOT NULL DEFAULT '0',
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `shop_id`, `photo`, `price`, `stock`, `description`) VALUES
(11, 'Turtle', 1, '../productImage/655c22abbd2a0_turtle.jpg', 10000, 10, 'This is supposed to be the description of the product, but I really don\'t know what should I type. As a matter of fact, I\'m also pretty much confused about what product should I add. So yeah, here you go, a normal turtle which picture I got from the internet. Eh, it\'s for testing anyway, so who cares.'),
(12, 'test', 4, '', 10000, 5, 'asas');

-- --------------------------------------------------------

--
-- Table structure for table `product_comments`
--

CREATE TABLE `product_comments` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `product_id` int NOT NULL,
  `content` text COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_comments`
--

INSERT INTO `product_comments` (`id`, `user_id`, `product_id`, `content`) VALUES
(1, 1, 3, 'test'),
(2, 1, 3, 'test'),
(3, 1, 3, 'coba tes lagi'),
(4, 1, 3, 'overflow-y testing'),
(5, 1, 3, 'another overflow-y testing'),
(6, 1, 5, 'another product comment testing'),
(7, 1, 4, 'hiii'),
(8, 21, 11, 'test comment');

-- --------------------------------------------------------

--
-- Table structure for table `product_dislikes`
--

CREATE TABLE `product_dislikes` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `product_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_likes`
--

CREATE TABLE `product_likes` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `product_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `report_id` int NOT NULL,
  `reporter_id` int NOT NULL,
  `violator_id` int NOT NULL,
  `report_message` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `date` date NOT NULL,
  `admin_response` varchar(7) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`report_id`, `reporter_id`, `violator_id`, `report_message`, `date`, `admin_response`) VALUES
(1, 1, 7, 'testing purpose', '2023-10-30', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `shops`
--

CREATE TABLE `shops` (
  `shop_id` int NOT NULL,
  `shop_name` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `owner_id` int NOT NULL,
  `photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shops`
--

INSERT INTO `shops` (`shop_id`, `shop_name`, `owner_id`, `photo`, `latitude`, `longitude`) VALUES
(1, 'Akmal Wagir', 7, '655994e3169c6_amorFati.jpg', -7.989104611543854, 112.62802803501796),
(2, 'Tahu Apa Intelligence', 13, '6559c843891fa_notAADC.jpg', -8.008643263541831, 112.56769593746014),
(3, 'C Sharp', 14, NULL, -8.008251895733665, 112.56773198024369),
(4, 'Abiyoga PC', 15, NULL, -7.9892102130684925, 112.62751758098604),
(5, 'Edukasi Bimbel', 16, NULL, -7.990110732144618, 112.62709647417071),
(6, 'adsduhfdfhu', 1, NULL, -7.98861036861906, 112.62728691101074);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `transaction_id` int NOT NULL,
  `payment_datetime` datetime DEFAULT NULL,
  `confirmation_datetime` datetime DEFAULT NULL,
  `price` int NOT NULL,
  `shop_id` json NOT NULL,
  `customer_id` int NOT NULL,
  `products` json NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `is_warn` tinyint(1) NOT NULL DEFAULT '0',
  `is_timeout` tinyint(1) NOT NULL DEFAULT '0',
  `timeout_end` date DEFAULT NULL,
  `is_ban` tinyint(1) NOT NULL DEFAULT '0',
  `is_shop` tinyint(1) NOT NULL DEFAULT '0',
  `is_admin` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `email`, `username`, `password`, `photo`, `is_warn`, `is_timeout`, `timeout_end`, `is_ban`, `is_shop`, `is_admin`) VALUES
(1, 'drajadkusumaadi@gmail.com', 'Drajad Kusuma Adi', '21c731cd04cf872ca186a1fe59535f88', '65559abd75e7b_signatureimage.jpg', 0, 0, NULL, 0, 1, 0),
(7, 'akmaleka457@gmail.com', 'Akmal Eka Firlana', 'e8d40e09ea42a21ef07979d34aca98cb', '6559ac3398d32_windowsxp.jpg', 0, 0, NULL, 0, 1, 0),
(13, 'tahuapa4939@gmail.com', 'Radit', 'b754afde57fa66a933481ae0a4981041', NULL, 0, 0, NULL, 0, 1, 0),
(14, 'foctothegmg@gmail.com', 'Fabio', '39fe6b1c5cdf8f4b460e1743b1f06c2c', NULL, 0, 0, NULL, 0, 1, 0),
(15, 'abiyogapc6969@gmail.com', 'Abiyoga PC', '4101d66ec3599ac0cecb99e2c329f96e', NULL, 0, 0, NULL, 0, 1, 0),
(16, 'edukasi420@gmail.com', 'Edu', 'bb4e8dccd8d1a3228981cefcdc4163d4', NULL, 0, 0, NULL, 0, 1, 0),
(18, 'testingUser', 'testing@gmail.com', 'd26135e39a897ea6e3a879bfe10ec76a', NULL, 0, 0, NULL, 0, 0, 0),
(19, 'testingUser@gmail.com', 'testingUser', 'd26135e39a897ea6e3a879bfe10ec76a', NULL, 0, 0, NULL, 0, 0, 0),
(20, 'test0@gmail.com', 'test0', 'd26135e39a897ea6e3a879bfe10ec76a', NULL, 0, 0, NULL, 0, 0, 0),
(21, 'test1@gmail.com', 'test', 'd26135e39a897ea6e3a879bfe10ec76a', NULL, 0, 0, NULL, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `voting`
--

CREATE TABLE `voting` (
  `voting_id` int NOT NULL,
  `reporter_id` int NOT NULL,
  `violator_id` int NOT NULL,
  `report_message` varchar(255) NOT NULL,
  `voting_count` int NOT NULL,
  `voting_status` varchar(7) NOT NULL DEFAULT 'pending',
  `deletion_time` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `analytics`
--
ALTER TABLE `analytics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chats`
--
ALTER TABLE `chats`
  ADD PRIMARY KEY (`chat_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `product_comments`
--
ALTER TABLE `product_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_dislikes`
--
ALTER TABLE `product_dislikes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_likes`
--
ALTER TABLE `product_likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`report_id`);

--
-- Indexes for table `shops`
--
ALTER TABLE `shops`
  ADD PRIMARY KEY (`shop_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`transaction_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`,`username`);

--
-- Indexes for table `voting`
--
ALTER TABLE `voting`
  ADD PRIMARY KEY (`voting_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `analytics`
--
ALTER TABLE `analytics`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `chats`
--
ALTER TABLE `chats`
  MODIFY `chat_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `product_comments`
--
ALTER TABLE `product_comments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `product_dislikes`
--
ALTER TABLE `product_dislikes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `product_likes`
--
ALTER TABLE `product_likes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `report_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `shops`
--
ALTER TABLE `shops`
  MODIFY `shop_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `transaction_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2144370523;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `voting`
--
ALTER TABLE `voting`
  MODIFY `voting_id` int NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
