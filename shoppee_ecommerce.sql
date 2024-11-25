-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 25, 2024 at 04:07 PM
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
-- Database: `shoppee_ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `status` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `total_price`, `status`, `created_at`) VALUES
(5, 1, 2099.98, 'Pending', '2024-11-13 18:00:51'),
(6, 1, 139.98, 'Completed', '2024-11-14 03:11:24'),
(7, 4, 69.99, 'Completed', '2024-11-14 03:13:45'),
(8, 1, 69.99, '', '2024-11-25 14:57:54');

-- --------------------------------------------------------

--
-- Table structure for table `order_item`
--

CREATE TABLE `order_item` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_item`
--

INSERT INTO `order_item` (`id`, `order_id`, `product_id`, `quantity`, `price`) VALUES
(1, 3, 1, 2, 123.00),
(2, 4, 1, 2, 123.00),
(3, 5, 3, 1, 599.99),
(4, 5, 5, 1, 1499.99),
(5, 6, 2, 2, 69.99),
(6, 7, 2, 1, 69.99),
(7, 8, 2, 1, 69.99);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `image`, `created_at`) VALUES
(2, 'ABIBAS T-Shirt', 'A comfortable and breathable cotton t-shirt perfect for casual wear.', 69.99, 'Abibas tshirt.jpg', '2024-11-13 17:36:36'),
(3, 'Relex Watch 2', 'A sleek smartwatch that tracks your fitness, heart rate, and more.', 599.99, 'relek watch.png', '2024-11-13 17:37:33'),
(4, 'SOMETHING Buds', 'High-quality wireless earbuds with noise-cancelling feature and long battery life.', 249.99, 'something bud.png', '2024-11-13 17:38:56'),
(5, 'IPear 15', 'The latest iPear with Great Perfomance, 5G support, and an amazing camera system.', 1499.99, 'Ipear.jpeg', '2024-11-13 17:40:14'),
(6, 'GreenLion Wireless Headphone', 'Noise-cancelling wireless headphones with high-quality sound.', 159.99, 'GreenLion Headfon.webp', '2024-11-13 17:41:07'),
(7, 'GameStation 5', 'Next-gen gaming console with 4K support, ultra-fast load times, and an immersive gaming experience.', 5999.99, 'gamestation.jpeg', '2024-11-13 17:46:48'),
(8, 'IMAG Slick Laptop', ' Lightweight, powerful, and ultra-portable laptop perfect for professionals and students.', 2499.99, 'imag.webp', '2024-11-13 17:47:57'),
(9, 'RGB Speaker + Microphone', 'Waterproof Bluetooth speaker with deep bass and up to 20 hours of playtime, perfect for outdoor adventures.', 899.99, 'RGB speaker with mic.png', '2024-11-13 17:49:02'),
(10, 'F.A.K.E Sneakers', 'Stylish and comfortable sneakers from Nike with Air Max cushioning for all-day support and a sleek, modern design.', 599.99, 'fake sneaker.avif', '2024-11-13 17:53:46'),
(11, 'a', 'beatiful', 123.45, 'Screenshot 2024-11-14 011232.png', '2024-11-14 03:10:28');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `is_admin`, `created_at`) VALUES
(1, 'Vishakan', '$2y$10$cIvbhZLzcSKloKTfaBRgP.U/ESdjzYtAhBSuFzxMCvXzwPdOaxM8e', 'Vishallan2708@gmail.com', 1, '2024-11-11 18:36:49'),
(4, 'Vislam', '$2y$10$8VY52eh4HUOXrPtdDHlgOu1aasUJEBA5Nk1suPKqdM/MfEiaJmdKe', 'Vish123@gmail.com', 0, '2024-11-11 19:45:30'),
(5, '[value-2]', '[value-3]', '[value-4]', 0, '0000-00-00 00:00:00'),
(7, 'bal', '$2y$10$acbT6M6QfEbX0eMson8fxeByEHgScdJjH/yIfOOK8RHHApcjMilm2', 'Vishallan2708@gmail.com', 0, '2024-11-13 16:36:22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_item`
--
ALTER TABLE `order_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `order_item`
--
ALTER TABLE `order_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
