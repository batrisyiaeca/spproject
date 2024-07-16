-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 15, 2024 at 09:10 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `users`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `telephone` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `flavor` varchar(100) NOT NULL,
  `size` varchar(10) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_price` decimal(8,2) NOT NULL,
  `pickup` varchar(25) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_name`, `telephone`, `email`, `flavor`, `size`, `quantity`, `total_price`, `pickup`, `order_date`) VALUES
(1, 'Batrisyia', '0123456789', 'batrisyiaazrul@graduate.utm.my', 'Vanilla', 'Small', 1, 6.00, '02:00 PM', '2024-07-15 18:28:58'),
(2, 'Shivaany', '0198765432', 'shivaany@gmail.com', 'Cheese', 'Large', 2, 36.00, '02:00 PM', '2024-07-15 18:28:58'),
(3, 'Jaudan', '0182936574', 'Jaudan@gmail.com', 'Red Velvet', 'Medium', 1, 12.00, '03:00 PM', '2024-07-15 18:32:04');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `card_number` varchar(16) NOT NULL,
  `expiry_date` varchar(5) NOT NULL,
  `cvv` varchar(3) NOT NULL,
  `transaction_id` varchar(10) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `card_number`, `expiry_date`, `cvv`, `transaction_id`, `timestamp`) VALUES
(1, 'sUcigjbaOFzBJkZH', 'qwTs7', 'ruq', 'OEZUB88UN6', '2024-07-15 14:27:12'),
(2, 'sUcigjbaOFzBJkZH', 'qwTs7', 'ruq', '9EBZH32BO3', '2024-07-15 14:44:03'),
(3, '1VM2zgEdr0tFD5kj', '/upbM', 'UDa', 'IOSQOLNT7D', '2024-07-15 18:13:01');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `code` mediumint(50) NOT NULL,
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `code`, `status`) VALUES
(1, 'ADMIN', 'batrisyia1019@gmail.com', '$2y$10$d7NFO1kgO/Nvk6ju3Ot7seU/EmIBCIim7c3FyXOuWV9KQD33RVKve', 0, 'verified'),
(2, 'Jaudan', 'jaudan@gmail.com', '$2y$10$JS7IX1fmPcu3yXXkFTwEhOB5RXDTlk1DW.J0/tKb26I/iNNSjM1Dy', 0, 'verified'),
(3, 'Shivaany', 'shivaany@gmail.com', '$2y$10$9DJ2OX1fmPcu3yXXkFTwEhOB5RXDTlk1DW.J0/tKb26I/iNNSjM1Dy', 0, 'verified');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
