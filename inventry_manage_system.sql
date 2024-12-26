-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 23, 2024 at 02:14 PM
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
-- Database: `inventry_manage_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `cat_name` varchar(255) NOT NULL,
  `cat_slug` text DEFAULT NULL,
  `cat_image` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `cat_name`, `cat_slug`, `cat_image`, `status`, `created_at`, `updated_at`) VALUES
(12, 'testing', 'testing-toei8m4smm', 'products/1733509318-673ee2a4d90995ea253e973c_672efa67c1da3387d85c51c1_luxury retreats.webp', '1', '2024-12-06 13:21:58', '2024-12-06 13:21:58'),
(13, 'kitchen', 'kitchen-vkmhphag6j', 'products/1733762218-Graham-Roedean-LR-0017-2000x1200.webp', '1', '2024-12-09 16:36:58', '2024-12-09 16:36:58'),
(14, 'Bedroom', 'bedroom-yjvgyzgplu', 'products/1733762266-download.jpg', '1', '2024-12-09 16:37:46', '2024-12-09 16:37:46'),
(15, 'Bathroom furniture & storage', 'bathroom-furniture-storage-14w5xfuicq', 'products/1733762397-download (1).jpg', '1', '2024-12-09 16:39:57', '2024-12-09 16:39:57'),
(16, 'Smart home', 'smart-home-w1z6ah6pqq', 'products/1733762458-download (2).jpg', '1', '2024-12-09 16:40:58', '2024-12-09 16:40:58'),
(17, 'outdoor living', 'outdoor-living-mb8wexfd9i', 'products/1733762510-download (3).jpg', '1', '2024-12-09 16:41:50', '2024-12-09 16:41:50');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_11_21_173830_create_user_registers_table', 2),
(6, '2024_11_27_184844_create_products_table', 3),
(7, '2024_12_05_185959_create_categories_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `order_number` varchar(100) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_number`, `total_amount`, `created_at`) VALUES
(36, 'ORD-675720b899f54', 1000.00, '2024-12-09 16:54:16'),
(37, 'ORD-6758865ce3788', 2000.00, '2024-12-10 18:20:12'),
(38, 'ORD-67589f8e21a24', 4000.00, '2024-12-10 20:07:42'),
(39, 'ORD-675962fd0cf1c', 720.00, '2024-12-11 10:01:33');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `total_price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `product_name`, `quantity`, `price`, `total_price`) VALUES
(59, 36, 21, 'fridge & freezers', 2, 500.00, 1000.00),
(60, 37, 21, 'fridge & freezers', 4, 500.00, 2000.00),
(61, 38, 24, 'Bedroom 3 set', 2, 2000.00, 4000.00),
(62, 39, 20, 'Ring-door bell', 2, 35.00, 70.00),
(63, 39, 22, 'Outdoor sofa', 1, 650.00, 650.00);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` text DEFAULT NULL,
  `product_cat` varchar(55) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `old_price` varchar(55) NOT NULL,
  `stock` int(11) NOT NULL,
  `stack_comments` varchar(255) NOT NULL DEFAULT 'None',
  `image` text DEFAULT NULL,
  `gallery` text DEFAULT NULL,
  `excerpt` text DEFAULT NULL,
  `descriptions` longtext DEFAULT NULL,
  `hot` varchar(11) DEFAULT NULL,
  `popular` varchar(11) DEFAULT NULL,
  `bestselling` varchar(55) DEFAULT NULL,
  `justarrived` varchar(55) DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `slug`, `product_cat`, `price`, `old_price`, `stock`, `stack_comments`, `image`, `gallery`, `excerpt`, `descriptions`, `hot`, `popular`, `bestselling`, `justarrived`, `status`, `created_at`, `updated_at`) VALUES
(19, 'testing Product', 'testing-product-llkodmqqq1', '12', 12.00, '15', 13, 'we are about to run out. let us add more please', 'products/1733509392-65ee6eb68b7e9b7aa4eef548_Captains Quarters.webp', '[\"products\\/1733573011-65ee6eb68b7e9b7aa4eef548_Captains Quarters.webp\",\"products\\/1733573011-673ee2a4d90995ea253e973c_672efa67c1da3387d85c51c1_luxury retreats.webp\",\"products\\/1733573011-6488c7392a59e7ce0e40870e_justin-p-500.png\",\"products\\/1733573011-64923be59a3d5acd11f05412_Eduardo.png\",\"products\\/1733573011-66537d610f6012b35253f3fc_649e76d2416e89583235e274_CRE016.webp\",\"products\\/1733573011-66537deffcc0961c6b3c2af9_64eefac395e54b9029362ee1_BUD007.webp\",\"products\\/1733573011-67480da4255a22116add516a_66ab10a5280f24a129e80880_MUD051.webp\",\"products\\/1733573011-647931a66099bf54cd64bd48_Lina-p-500.png\"]', 'It is a long established fact that a reader will be distracted by the readable content of a page', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 'Yes', 'No', 'No', 'Yes', '1', '2024-12-06 13:23:12', '2024-12-10 18:39:00'),
(20, 'Ring-door bell', 'ring-door-bell-7iup8mc2t8', '16', 35.00, '35', 1232, 'None', 'products/1733762796-download (4).jpg', '[\"products\\/1733762796-download (4).jpg\"]', 'ring door bell, answer the door even when you\'re not home', 'ring door bell, answer the door even when you\'re not home as you can view and talk through your phone to the bell', 'Yes', 'Yes', 'No', 'No', '1', '2024-12-09 16:46:36', '2024-12-09 16:46:36'),
(21, 'fridge & freezers', 'fridge-freezers-idzbkqeg9n', '13', 500.00, '650', 334, 'None', 'products/1733763168-20000184385.avif', '[\"products\\/1733763168-20000184385.avif\"]', 'the fridge and the best price you can get.', 'the fridge and the best price you can get. make sure your store your food in there with not complications', 'Yes', 'Yes', 'Yes', 'No', '1', '2024-12-09 16:52:48', '2024-12-09 16:52:48'),
(22, 'Outdoor sofa', 'outdoor-sofa-a0l7ydxqqt', '17', 650.00, '700', 429, 'None', 'products/1733855397-download.jpg', '[\"products\\/1733855397-download.jpg\"]', 'An outdoor sofa is a piece of furniture designed for outdoor use.', 'An outdoor sofa is a piece of furniture designed for outdoor use, typically placed in gardens, patios, balconies, or poolside areas. It is built to withstand weather conditions, such as rain, sun, and humidity.', 'No', 'No', 'No', 'No', '1', '2024-12-10 18:29:57', '2024-12-10 18:29:57'),
(23, 'Bathroom sink', 'bathroom-sink-jrtpurv9ah', '15', 350.00, '350', 45, 'None', 'products/1733855623-download (1).jpg', '[\"products\\/1733855623-download (1).jpg\"]', 'A bathroom sink is a plumbing fixture designed for hand washing and grooming tasks', 'A bathroom sink is a plumbing fixture designed for handwashing and grooming tasks. It typically includes a basin that connects to a water supply and drainage system. Bathroom sinks come in various styles, including pedestal, wall-mounted, countertop, under-mount, and vessel. Common materials include ceramic, porcelain, glass, stone, and stainless steel, often paired with a faucet and sometimes a vanity for added storage.', 'Yes', 'Yes', 'No', 'No', '1', '2024-12-10 18:33:43', '2024-12-10 18:33:43'),
(24, 'Bedroom 3 set', 'bedroom-3-set-piyfvcsacw', '14', 2000.00, '2250', 198, 'None', 'products/1733856463-download (2).jpg', '[\"products\\/1733856463-download (3).jpg\"]', 'A 3-piece bedroom set includes:\r\n\r\nBed Frame: Stylish and sturdy, available in various sizes.', 'Transform your bedroom into a stylish retreat with this 3-Piece Bedroom Set. This set includes a beautifully crafted bed frame, available in multiple sizes to suit your space, and two matching nightstands designed with convenient storage options. With its cohesive design and high-quality materials, this set effortlessly combines functionality and elegance, making it the perfect choice for a modern, coordinated bedroom upgrade.', 'Yes', 'Yes', 'Yes', 'No', '1', '2024-12-10 18:47:43', '2024-12-10 18:47:43');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_registers`
--

CREATE TABLE `user_registers` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `useremail` varchar(255) DEFAULT NULL,
  `userpassword` text DEFAULT NULL,
  `userrole` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_registers`
--

INSERT INTO `user_registers` (`id`, `username`, `useremail`, `userpassword`, `userrole`, `created_at`, `updated_at`) VALUES
(8, 'fatah7382', 'fatah7382@gmail.com', '$2y$10$erNQvMyoq11QYJOoQcXj2uMHJk.XPMwumogmAdpPTFrVXoL/hXo1m', 3, '2024-12-09 16:23:13', '2024-12-09 16:26:45'),
(9, 'laylum1', 'lalylum564@gmail.com', '$2y$10$Iy5ZUepm7xHpn.2PrNSCXeyBiKgD0T0cWDi.QcDUpeiYjeq3W51Iy', 1, '2024-12-09 16:25:24', '2024-12-09 16:26:40'),
(10, 'mukhtar1212', 'mukhtar001@gmail.com', '$2y$10$ZdoLndYfQs7PREtMouj/EurrDe6.OYwZxqWL/Q72BJ0Q7KaXZ6bOm', 2, '2024-12-09 16:25:54', '2024-12-09 16:26:32'),
(11, 'jacob1', 'jacob1@gmail.com', '$2y$10$NJt34oY9NkJyi5fjcpLGvOmLMmU11M9hkXQALPvHVbnaWJjAuFvrK', 2, '2024-12-11 09:59:04', '2024-12-11 09:59:53');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_registers`
--
ALTER TABLE `user_registers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_registers`
--
ALTER TABLE `user_registers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
