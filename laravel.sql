-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Φιλοξενητής: 127.0.0.1
-- Χρόνος δημιουργίας: 09 Ιαν 2020 στις 21:10:49
-- Έκδοση διακομιστή: 10.4.6-MariaDB
-- Έκδοση PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Βάση δεδομένων: `laravel`
--
CREATE DATABASE IF NOT EXISTS `laravel` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `laravel`;

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `bookings`
--

DROP TABLE IF EXISTS `bookings`;
CREATE TABLE `bookings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `check_in_date` datetime NOT NULL,
  `check_out_date` datetime NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `room_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `cities`
--

DROP TABLE IF EXISTS `cities`;
CREATE TABLE `cities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Άδειασμα δεδομένων του πίνακα `cities`
--

INSERT INTO `cities` (`id`, `country_id`, `name`, `created_at`, `updated_at`) VALUES
(1, 1, 'Athens', '2020-01-09 18:00:06', '2020-01-09 18:00:06'),
(2, 1, 'Kiato', '2020-01-09 18:00:06', '2020-01-09 18:00:06'),
(3, 1, 'Thessaloniki', '2020-01-09 18:00:06', '2020-01-09 18:00:06'),
(4, 1, 'Patra', '2020-01-09 18:00:06', '2020-01-09 18:00:06'),
(5, 1, 'Korinthos', '2020-01-09 18:00:06', '2020-01-09 18:00:06'),
(6, 2, 'Madrid', '2020-01-09 18:00:06', '2020-01-09 18:00:06'),
(7, 2, 'Valencia', '2020-01-09 18:00:06', '2020-01-09 18:00:06'),
(8, 3, 'Rome', '2020-01-09 18:00:06', '2020-01-09 18:00:06'),
(9, 3, 'Florentia', '2020-01-09 18:00:06', '2020-01-09 18:00:06'),
(10, 4, 'Berlin', '2020-01-09 18:00:06', '2020-01-09 18:00:06'),
(11, 4, 'Frankfurt', '2020-01-09 18:00:06', '2020-01-09 18:00:06'),
(12, 5, 'Paris', '2020-01-09 18:00:06', '2020-01-09 18:00:06'),
(13, 5, 'Monpelier', '2020-01-09 18:00:06', '2020-01-09 18:00:06');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `countries`
--

DROP TABLE IF EXISTS `countries`;
CREATE TABLE `countries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Άδειασμα δεδομένων του πίνακα `countries`
--

INSERT INTO `countries` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Greece', '2020-01-09 18:00:06', '2020-01-09 18:00:06'),
(2, 'Spain', '2020-01-09 18:00:06', '2020-01-09 18:00:06'),
(3, 'Italy', '2020-01-09 18:00:06', '2020-01-09 18:00:06'),
(4, 'Germany', '2020-01-09 18:00:06', '2020-01-09 18:00:06'),
(5, 'France', '2020-01-09 18:00:06', '2020-01-09 18:00:06');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `favorites`
--

DROP TABLE IF EXISTS `favorites`;
CREATE TABLE `favorites` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `room_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Άδειασμα δεδομένων του πίνακα `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(27, '2019_01_14_111226_create_countries_table', 1),
(28, '2019_01_14_140546_create_room_types_table', 1),
(29, '2019_01_15_110536_create_cities_table', 1),
(30, '2019_01_15_194924_create_users_table', 1),
(31, '2019_03_05_183644_create_rooms_table', 1),
(32, '2019_03_05_185658_create_reviews_table', 1),
(33, '2019_03_05_185801_create_bookings_table', 1),
(34, '2019_03_05_205153_create_favorites_table', 1),
(35, '2019_04_24_195318_create_password_resets_table', 1),
(36, '2019_05_03_000001_create_customer_columns', 1),
(37, '2019_05_03_000002_create_subscriptions_table', 1),
(38, '2019_10_16_173248_create_social_facebook_accounts_table', 1),
(39, '2019_10_16_174045_create_social_google_accounts_table', 1),
(40, '2019_10_16_193958_create_photos_table', 1);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `photos`
--

DROP TABLE IF EXISTS `photos`;
CREATE TABLE `photos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `src` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL DEFAULT 11,
  `room_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Άδειασμα δεδομένων του πίνακα `photos`
--

INSERT INTO `photos` (`id`, `src`, `user_id`, `room_id`, `created_at`, `updated_at`) VALUES
(1, '../images/room-6.jpg', 11, 27, '2020-01-09 18:00:07', '2020-01-09 18:00:07'),
(2, '../images/room-2.jpg', 11, 16, '2020-01-09 18:00:07', '2020-01-09 18:00:07'),
(3, '../images/room-6.jpg', 11, 14, '2020-01-09 18:00:07', '2020-01-09 18:00:07'),
(4, '../images/room-2.jpg', 11, 21, '2020-01-09 18:00:07', '2020-01-09 18:00:07'),
(5, '../images/room-3.jpg', 11, 3, '2020-01-09 18:00:07', '2020-01-09 18:00:07'),
(6, '../images/room-4.jpg', 11, 5, '2020-01-09 18:00:07', '2020-01-09 18:00:07'),
(7, '../images/room-4.jpg', 11, 25, '2020-01-09 18:00:07', '2020-01-09 18:00:07'),
(8, '../images/room-5.jpg', 11, 7, '2020-01-09 18:00:07', '2020-01-09 18:00:07'),
(9, '../images/room-2.jpg', 11, 7, '2020-01-09 18:00:07', '2020-01-09 18:00:07'),
(10, '../images/room-7.jpg', 11, 6, '2020-01-09 18:00:07', '2020-01-09 18:00:07'),
(11, '../images/room-8.jpg', 11, 9, '2020-01-09 18:00:07', '2020-01-09 18:00:07'),
(12, '../images/room-10.jpg', 11, 9, '2020-01-09 18:00:07', '2020-01-09 18:00:07'),
(13, '../images/room-4.jpg', 11, 10, '2020-01-09 18:00:07', '2020-01-09 18:00:07'),
(14, '../images/room-4.jpg', 11, 20, '2020-01-09 18:00:07', '2020-01-09 18:00:07'),
(15, '../images/room-5.jpg', 11, 30, '2020-01-09 18:00:07', '2020-01-09 18:00:07'),
(16, '../images/room-7.jpg', 11, 17, '2020-01-09 18:00:07', '2020-01-09 18:00:07'),
(17, '../images/room-4.jpg', 11, 18, '2020-01-09 18:00:07', '2020-01-09 18:00:07'),
(18, '../images/room-5.jpg', 11, 20, '2020-01-09 18:00:07', '2020-01-09 18:00:07'),
(19, '../images/room-9.jpg', 11, 25, '2020-01-09 18:00:07', '2020-01-09 18:00:07'),
(20, '../images/room-3.jpg', 11, 12, '2020-01-09 18:00:07', '2020-01-09 18:00:07'),
(21, '../images/room-2.jpg', 11, 22, '2020-01-09 18:00:07', '2020-01-09 18:00:07'),
(22, '../images/room-10.jpg', 11, 8, '2020-01-09 18:00:07', '2020-01-09 18:00:07'),
(23, '../images/room-6.jpg', 11, 21, '2020-01-09 18:00:07', '2020-01-09 18:00:07'),
(24, '../images/room-9.jpg', 11, 23, '2020-01-09 18:00:07', '2020-01-09 18:00:07'),
(25, '../images/room-9.jpg', 11, 21, '2020-01-09 18:00:07', '2020-01-09 18:00:07'),
(26, '../images/room-4.jpg', 11, 10, '2020-01-09 18:00:07', '2020-01-09 18:00:07'),
(27, '../images/room-10.jpg', 11, 9, '2020-01-09 18:00:07', '2020-01-09 18:00:07'),
(28, '../images/room-9.jpg', 11, 11, '2020-01-09 18:00:07', '2020-01-09 18:00:07'),
(29, '../images/room-1.jpg', 11, 3, '2020-01-09 18:00:07', '2020-01-09 18:00:07'),
(30, '../images/room-10.jpg', 11, 26, '2020-01-09 18:00:07', '2020-01-09 18:00:07'),
(31, '../images/room-8.jpg', 11, 15, '2020-01-09 18:00:07', '2020-01-09 18:00:07'),
(32, '../images/room-3.jpg', 11, 15, '2020-01-09 18:00:07', '2020-01-09 18:00:07'),
(33, '../images/room-9.jpg', 11, 12, '2020-01-09 18:00:07', '2020-01-09 18:00:07'),
(34, '../images/room-8.jpg', 11, 6, '2020-01-09 18:00:07', '2020-01-09 18:00:07'),
(35, '../images/room-9.jpg', 11, 25, '2020-01-09 18:00:07', '2020-01-09 18:00:07'),
(36, '../images/room-1.jpg', 11, 8, '2020-01-09 18:00:07', '2020-01-09 18:00:07'),
(37, '../images/room-1.jpg', 11, 23, '2020-01-09 18:00:07', '2020-01-09 18:00:07'),
(38, '../images/room-10.jpg', 11, 16, '2020-01-09 18:00:07', '2020-01-09 18:00:07'),
(39, '../images/room-9.jpg', 11, 25, '2020-01-09 18:00:07', '2020-01-09 18:00:07'),
(40, '../images/room-2.jpg', 11, 26, '2020-01-09 18:00:07', '2020-01-09 18:00:07'),
(41, '../images/room-5.jpg', 11, 24, '2020-01-09 18:00:07', '2020-01-09 18:00:07'),
(42, '../images/room-5.jpg', 11, 25, '2020-01-09 18:00:07', '2020-01-09 18:00:07'),
(43, '../images/room-1.jpg', 11, 8, '2020-01-09 18:00:07', '2020-01-09 18:00:07'),
(44, '../images/room-10.jpg', 11, 4, '2020-01-09 18:00:07', '2020-01-09 18:00:07'),
(45, '../images/room-10.jpg', 11, 28, '2020-01-09 18:00:07', '2020-01-09 18:00:07'),
(46, '../images/room-2.jpg', 11, 3, '2020-01-09 18:00:07', '2020-01-09 18:00:07'),
(47, '../images/room-2.jpg', 11, 27, '2020-01-09 18:00:07', '2020-01-09 18:00:07'),
(48, '../images/room-3.jpg', 11, 17, '2020-01-09 18:00:07', '2020-01-09 18:00:07'),
(49, '../images/room-8.jpg', 11, 19, '2020-01-09 18:00:07', '2020-01-09 18:00:07'),
(50, '../images/room-10.jpg', 11, 12, '2020-01-09 18:00:07', '2020-01-09 18:00:07'),
(51, '../images/room-1.jpg', 11, 12, '2020-01-09 18:00:07', '2020-01-09 18:00:07'),
(52, '../images/room-5.jpg', 11, 15, '2020-01-09 18:00:07', '2020-01-09 18:00:07'),
(53, '../images/room-3.jpg', 11, 4, '2020-01-09 18:00:07', '2020-01-09 18:00:07'),
(54, '../images/room-8.jpg', 11, 7, '2020-01-09 18:00:07', '2020-01-09 18:00:07'),
(55, '../images/room-7.jpg', 11, 16, '2020-01-09 18:00:07', '2020-01-09 18:00:07'),
(56, '../images/room-2.jpg', 11, 8, '2020-01-09 18:00:07', '2020-01-09 18:00:07'),
(57, '../images/room-7.jpg', 11, 21, '2020-01-09 18:00:07', '2020-01-09 18:00:07'),
(58, '../images/room-4.jpg', 11, 24, '2020-01-09 18:00:07', '2020-01-09 18:00:07'),
(59, '../images/room-3.jpg', 11, 26, '2020-01-09 18:00:07', '2020-01-09 18:00:07'),
(60, '../images/room-4.jpg', 11, 8, '2020-01-09 18:00:07', '2020-01-09 18:00:07'),
(61, '../images/room-7.jpg', 11, 17, '2020-01-09 18:00:07', '2020-01-09 18:00:07'),
(62, '../images/room-2.jpg', 11, 6, '2020-01-09 18:00:07', '2020-01-09 18:00:07'),
(63, '../images/room-4.jpg', 11, 14, '2020-01-09 18:00:07', '2020-01-09 18:00:07'),
(64, '../images/room-1.jpg', 11, 25, '2020-01-09 18:00:07', '2020-01-09 18:00:07'),
(65, '../images/room-5.jpg', 11, 5, '2020-01-09 18:00:07', '2020-01-09 18:00:07'),
(66, '../images/room-3.jpg', 11, 5, '2020-01-09 18:00:07', '2020-01-09 18:00:07'),
(67, '../images/room-3.jpg', 11, 19, '2020-01-09 18:00:07', '2020-01-09 18:00:07'),
(68, '../images/room-5.jpg', 11, 19, '2020-01-09 18:00:07', '2020-01-09 18:00:07'),
(69, '../images/room-7.jpg', 11, 23, '2020-01-09 18:00:07', '2020-01-09 18:00:07'),
(70, '../images/room-3.jpg', 11, 4, '2020-01-09 18:00:07', '2020-01-09 18:00:07'),
(71, '../images/room-2.jpg', 11, 15, '2020-01-09 18:00:07', '2020-01-09 18:00:07'),
(72, '../images/room-5.jpg', 11, 4, '2020-01-09 18:00:07', '2020-01-09 18:00:07'),
(73, '../images/room-10.jpg', 11, 6, '2020-01-09 18:00:07', '2020-01-09 18:00:07'),
(74, '../images/room-3.jpg', 11, 24, '2020-01-09 18:00:07', '2020-01-09 18:00:07'),
(75, '../images/room-5.jpg', 11, 2, '2020-01-09 18:00:07', '2020-01-09 18:00:07'),
(76, '../images/room-9.jpg', 11, 10, '2020-01-09 18:00:07', '2020-01-09 18:00:07'),
(77, '../images/room-7.jpg', 11, 10, '2020-01-09 18:00:07', '2020-01-09 18:00:07'),
(78, '../images/room-10.jpg', 11, 4, '2020-01-09 18:00:07', '2020-01-09 18:00:07'),
(79, '../images/room-1.jpg', 11, 20, '2020-01-09 18:00:07', '2020-01-09 18:00:07'),
(80, '../images/room-10.jpg', 11, 22, '2020-01-09 18:00:07', '2020-01-09 18:00:07'),
(81, '../images/room-4.jpg', 11, 10, '2020-01-09 18:00:07', '2020-01-09 18:00:07'),
(82, '../images/room-4.jpg', 11, 28, '2020-01-09 18:00:07', '2020-01-09 18:00:07'),
(83, '../images/room-10.jpg', 11, 20, '2020-01-09 18:00:07', '2020-01-09 18:00:07'),
(84, '../images/room-4.jpg', 11, 10, '2020-01-09 18:00:07', '2020-01-09 18:00:07'),
(85, '../images/room-9.jpg', 11, 23, '2020-01-09 18:00:07', '2020-01-09 18:00:07'),
(86, '../images/room-1.jpg', 11, 10, '2020-01-09 18:00:07', '2020-01-09 18:00:07'),
(87, '../images/room-10.jpg', 11, 16, '2020-01-09 18:00:07', '2020-01-09 18:00:07'),
(88, '../images/room-10.jpg', 11, 3, '2020-01-09 18:00:07', '2020-01-09 18:00:07'),
(89, '../images/room-9.jpg', 11, 8, '2020-01-09 18:00:07', '2020-01-09 18:00:07'),
(90, '../images/room-6.jpg', 11, 11, '2020-01-09 18:00:07', '2020-01-09 18:00:07');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `reviews`
--

DROP TABLE IF EXISTS `reviews`;
CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `room_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `rate` int(11) NOT NULL,
  `review` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Άδειασμα δεδομένων του πίνακα `reviews`
--

INSERT INTO `reviews` (`id`, `room_id`, `user_id`, `rate`, `review`, `created_at`, `updated_at`) VALUES
(1, 15, 10, 3, 'It means much the most important piece of it at last, they must needs come wriggling down from the.', '2020-01-09 18:00:08', '2020-01-09 18:00:08'),
(2, 13, 8, 0, 'NEVER come to an end! \'I wonder what Latitude or Longitude I\'ve got to the table to measure.', '2020-01-09 18:00:08', '2020-01-09 18:00:08'),
(3, 30, 1, 0, 'Do you think you can find out the Fish-Footman was gone, and, by the soldiers, who of course had.', '2020-01-09 18:00:08', '2020-01-09 18:00:08'),
(4, 13, 4, 5, 'The soldiers were silent, and looked along the passage into the court, by the Hatter, with an M.', '2020-01-09 18:00:08', '2020-01-09 18:00:08'),
(5, 29, 1, 5, 'Next came an angry tone, \'Why, Mary Ann, and be turned out of sight; and an old Crab took the.', '2020-01-09 18:00:08', '2020-01-09 18:00:08'),
(6, 27, 10, 4, 'Mock Turtle, \'they--you\'ve seen them, of course?\' \'Yes,\' said Alice indignantly. \'Let me alone!\'.', '2020-01-09 18:00:08', '2020-01-09 18:00:08'),
(7, 28, 3, 4, 'As for pulling me out of breath, and said to herself; \'his eyes are so VERY tired of swimming.', '2020-01-09 18:00:08', '2020-01-09 18:00:08'),
(8, 17, 7, 4, 'She felt that it made Alice quite jumped; but she had drunk half the bottle, saying to herself as.', '2020-01-09 18:00:08', '2020-01-09 18:00:08'),
(9, 26, 1, 5, 'Here the Queen put on her face brightened up again.) \'Please your Majesty,\' said Alice very.', '2020-01-09 18:00:08', '2020-01-09 18:00:08'),
(10, 16, 6, 2, 'Cat in a trembling voice:-- \'I passed by his face only, she would feel with all their simple.', '2020-01-09 18:00:08', '2020-01-09 18:00:08'),
(11, 7, 8, 5, 'Dormouse shall!\' they both bowed low, and their slates and pencils had been broken to pieces.', '2020-01-09 18:00:08', '2020-01-09 18:00:08'),
(12, 27, 11, 5, 'Gryphon is, look at them--\'I wish they\'d get the trial done,\' she thought, and rightly too, that.', '2020-01-09 18:00:08', '2020-01-09 18:00:08'),
(13, 16, 9, 4, 'Alice replied, so eagerly that the cause of this ointment--one shilling the box-- Allow me to sell.', '2020-01-09 18:00:08', '2020-01-09 18:00:08'),
(14, 2, 6, 4, 'Duchess; \'and the moral of that is--\"Oh, \'tis love, that makes you forget to talk. I can\'t show it.', '2020-01-09 18:00:08', '2020-01-09 18:00:08'),
(15, 25, 10, 2, 'Gryphon answered, very nearly in the air, mixed up with the Queen,\' and she went on, very much.', '2020-01-09 18:00:08', '2020-01-09 18:00:08'),
(16, 2, 4, 4, 'I shall be late!\' (when she thought it had some kind of authority among them, called out, \'First.', '2020-01-09 18:00:08', '2020-01-09 18:00:08'),
(17, 22, 11, 1, 'I wish you could draw treacle out of sight, they were IN the well,\' Alice said to itself \'The.', '2020-01-09 18:00:08', '2020-01-09 18:00:08'),
(18, 15, 1, 1, 'When they take us up and picking the daisies, when suddenly a White Rabbit hurried by--the.', '2020-01-09 18:00:08', '2020-01-09 18:00:08'),
(19, 23, 11, 1, 'Dodo managed it.) First it marked out a box of comfits, (luckily the salt water had not a bit.', '2020-01-09 18:00:08', '2020-01-09 18:00:08'),
(20, 30, 4, 1, 'The three soldiers wandered about in the pool, and the words a little, \'From the Queen. \'It proves.', '2020-01-09 18:00:08', '2020-01-09 18:00:08'),
(21, 1, 1, 4, 'I\'m sure she\'s the best thing to eat her up in a Little Bill It was so ordered about by mice and.', '2020-01-09 18:00:08', '2020-01-09 18:00:08'),
(22, 15, 5, 2, 'Presently she began very cautiously: \'But I don\'t put my arm round your waist,\' the Duchess said.', '2020-01-09 18:00:08', '2020-01-09 18:00:08'),
(23, 3, 9, 4, 'Alice, always ready to agree to everything that Alice had been (Before she had never before seen a.', '2020-01-09 18:00:08', '2020-01-09 18:00:08'),
(24, 1, 6, 3, 'There was not a regular rule: you invented it just grazed his nose, and broke off a little animal.', '2020-01-09 18:00:08', '2020-01-09 18:00:08'),
(25, 21, 5, 5, 'The King laid his hand upon her knee, and looking at everything that Alice could not remember ever.', '2020-01-09 18:00:08', '2020-01-09 18:00:08'),
(26, 9, 7, 5, 'I\'m not used to queer things happening. While she was going to be, from one foot up the fan and.', '2020-01-09 18:00:08', '2020-01-09 18:00:08'),
(27, 10, 11, 1, 'The Antipathies, I think--\' (she was rather glad there WAS no one to listen to me! When I used to.', '2020-01-09 18:00:08', '2020-01-09 18:00:08'),
(28, 24, 1, 2, 'Alice\'s shoulder as he wore his crown over the jury-box with the next thing is, to get out again.', '2020-01-09 18:00:08', '2020-01-09 18:00:08'),
(29, 20, 9, 3, 'Gryphon. \'I\'ve forgotten the words.\' So they sat down again into its eyes again, to see the earth.', '2020-01-09 18:00:08', '2020-01-09 18:00:08'),
(30, 27, 11, 5, 'Dormouse again, so she waited. The Gryphon sat up and went by without noticing her. Then followed.', '2020-01-09 18:00:08', '2020-01-09 18:00:08'),
(31, 26, 5, 1, 'March Hare, \'that \"I breathe when I sleep\" is the same thing with you,\' said the last few minutes.', '2020-01-09 18:00:08', '2020-01-09 18:00:08'),
(32, 26, 10, 2, 'And certainly there was a bright brass plate with the distant green leaves. As there seemed to.', '2020-01-09 18:00:08', '2020-01-09 18:00:08'),
(33, 2, 6, 4, 'Dormouse,\' the Queen said to herself; \'I should like it very much,\' said the King. \'I can\'t.', '2020-01-09 18:00:08', '2020-01-09 18:00:08'),
(34, 29, 11, 4, 'Caterpillar. Alice thought the poor animal\'s feelings. \'I quite forgot how to set about it; if I\'m.', '2020-01-09 18:00:08', '2020-01-09 18:00:08'),
(35, 5, 6, 1, 'Dormouse. \'Write that down,\' the King sharply. \'Do you play croquet?\' The soldiers were silent.', '2020-01-09 18:00:08', '2020-01-09 18:00:08'),
(36, 19, 9, 2, 'He trusts to you to set them free, Exactly as we were. My notion was that you have to go down the.', '2020-01-09 18:00:08', '2020-01-09 18:00:08'),
(37, 10, 7, 2, 'Said his father; \'don\'t give yourself airs! Do you think you can find out the Fish-Footman was.', '2020-01-09 18:00:08', '2020-01-09 18:00:08'),
(38, 24, 3, 3, 'King said to Alice; and Alice guessed who it was, even before she came rather late, and the other.', '2020-01-09 18:00:08', '2020-01-09 18:00:08'),
(39, 10, 1, 5, 'Go on!\' \'I\'m a poor man, your Majesty,\' the Hatter hurriedly left the court, by the whole head.', '2020-01-09 18:00:08', '2020-01-09 18:00:08'),
(40, 18, 2, 5, 'I suppose.\' So she swallowed one of them attempted to explain the paper. \'If there\'s no use going.', '2020-01-09 18:00:08', '2020-01-09 18:00:08'),
(41, 16, 9, 5, 'Alice, \'it would be grand, certainly,\' said Alice thoughtfully: \'but then--I shouldn\'t be hungry.', '2020-01-09 18:00:08', '2020-01-09 18:00:08'),
(42, 7, 5, 0, 'And he added in an impatient tone: \'explanations take such a simple question,\' added the March.', '2020-01-09 18:00:08', '2020-01-09 18:00:08'),
(43, 16, 11, 2, 'Alice, \'because I\'m not myself, you see.\' \'I don\'t know of any one; so, when the tide rises and.', '2020-01-09 18:00:08', '2020-01-09 18:00:08'),
(44, 29, 11, 5, 'Alice, feeling very curious to see it quite plainly through the wood. \'If it had a head unless.', '2020-01-09 18:00:08', '2020-01-09 18:00:08'),
(45, 2, 4, 5, 'There was no more to come, so she helped herself to some tea and bread-and-butter, and went by.', '2020-01-09 18:00:08', '2020-01-09 18:00:08'),
(46, 22, 4, 0, 'Alice: \'three inches is such a very curious sensation, which puzzled her very earnestly, \'Now.', '2020-01-09 18:00:08', '2020-01-09 18:00:08'),
(47, 10, 8, 5, 'PLEASE mind what you\'re doing!\' cried Alice, quite forgetting in the face. \'I\'ll put a white one.', '2020-01-09 18:00:08', '2020-01-09 18:00:08'),
(48, 6, 3, 4, 'I\'m on the slate. \'Herald, read the accusation!\' said the Rabbit came up to them she heard it.', '2020-01-09 18:00:08', '2020-01-09 18:00:08'),
(49, 18, 2, 5, 'Alice cautiously replied: \'but I know is, something comes at me like a telescope! I think I can.', '2020-01-09 18:00:08', '2020-01-09 18:00:08'),
(50, 5, 7, 1, 'Soon her eye fell upon a little before she had hurt the poor little thing grunted in reply (it had.', '2020-01-09 18:00:08', '2020-01-09 18:00:08'),
(51, 21, 3, 5, 'BEST butter, you know.\' \'Who is this?\' She said the Caterpillar. Here was another puzzling.', '2020-01-09 18:00:08', '2020-01-09 18:00:08'),
(52, 2, 11, 2, 'Alice to herself, \'because of his Normans--\" How are you getting on?\' said Alice, timidly; \'some.', '2020-01-09 18:00:08', '2020-01-09 18:00:08'),
(53, 10, 11, 2, 'ME\' beautifully printed on it but tea. \'I don\'t like them raw.\' \'Well, be off, then!\' said the.', '2020-01-09 18:00:08', '2020-01-09 18:00:08'),
(54, 22, 1, 3, 'Mock Turtle sighed deeply, and began, in a frightened tone. \'The Queen of Hearts, she made her.', '2020-01-09 18:00:08', '2020-01-09 18:00:08'),
(55, 11, 11, 4, 'Alice looked all round her, about the temper of your flamingo. Shall I try the thing yourself.', '2020-01-09 18:00:08', '2020-01-09 18:00:08'),
(56, 2, 5, 0, 'Mock Turtle. \'And how many hours a day did you manage to do such a new idea to Alice, and looking.', '2020-01-09 18:00:08', '2020-01-09 18:00:08'),
(57, 30, 7, 3, 'Gryphon went on, half to itself, half to herself, and began bowing to the waving of the creature.', '2020-01-09 18:00:08', '2020-01-09 18:00:08'),
(58, 14, 4, 5, 'Dormouse. \'Write that down,\' the King hastily said, and went stamping about, and make one quite.', '2020-01-09 18:00:08', '2020-01-09 18:00:08'),
(59, 8, 8, 5, 'I do hope it\'ll make me smaller, I suppose.\' So she set to work nibbling at the door of the.', '2020-01-09 18:00:08', '2020-01-09 18:00:08'),
(60, 14, 11, 5, 'Mock Turtle yet?\' \'No,\' said the Duchess; \'I never went to school in the other. In the very tones.', '2020-01-09 18:00:08', '2020-01-09 18:00:08'),
(61, 20, 7, 5, 'Hatter grumbled: \'you shouldn\'t have put it in asking riddles that have no answers.\' \'If you.', '2020-01-09 18:00:08', '2020-01-09 18:00:08'),
(62, 21, 3, 1, 'Alice loudly. \'The idea of having nothing to what I was sent for.\' \'You ought to eat or drink.', '2020-01-09 18:00:08', '2020-01-09 18:00:08'),
(63, 26, 7, 0, 'The March Hare had just succeeded in getting its body tucked away, comfortably enough, under her.', '2020-01-09 18:00:08', '2020-01-09 18:00:08'),
(64, 6, 1, 2, 'Canterbury, found it very hard indeed to make herself useful, and looking anxiously about her.', '2020-01-09 18:00:08', '2020-01-09 18:00:08'),
(65, 11, 8, 4, 'Alice replied very solemnly. Alice was a little anxiously. \'Yes,\' said Alice, \'and those twelve.', '2020-01-09 18:00:08', '2020-01-09 18:00:08'),
(66, 25, 1, 3, 'CHORUS. (In which the March Hare interrupted in a melancholy air, and, after folding his arms and.', '2020-01-09 18:00:08', '2020-01-09 18:00:08'),
(67, 13, 7, 0, 'Mabel after all, and I don\'t care which happens!\' She ate a little wider. \'Come, it\'s pleased so.', '2020-01-09 18:00:08', '2020-01-09 18:00:08'),
(68, 17, 4, 5, 'Do come back in a day is very confusing.\' \'It isn\'t,\' said the Gryphon at the thought that.', '2020-01-09 18:00:08', '2020-01-09 18:00:08'),
(69, 18, 4, 1, 'Alice the moment they saw her, they hurried back to them, they were nice grand words to say.).', '2020-01-09 18:00:08', '2020-01-09 18:00:08'),
(70, 29, 8, 3, 'She is such a hurry that she remained the same side of WHAT?\' thought Alice \'without pictures or.', '2020-01-09 18:00:08', '2020-01-09 18:00:08'),
(71, 4, 11, 1, 'Bill\'s got to come before that!\' \'Call the first really clever thing the King said to herself in a.', '2020-01-09 18:00:08', '2020-01-09 18:00:08'),
(72, 20, 6, 2, 'White Rabbit put on his flappers, \'--Mystery, ancient and modern, with Seaography: then.', '2020-01-09 18:00:08', '2020-01-09 18:00:08'),
(73, 6, 11, 2, 'Dormouse fell asleep instantly, and neither of the jurymen. \'It isn\'t a letter, after all: it\'s a.', '2020-01-09 18:00:08', '2020-01-09 18:00:08'),
(74, 15, 7, 0, 'PLENTY of room!\' said Alice indignantly. \'Ah! then yours wasn\'t a bit of the officers of the.', '2020-01-09 18:00:08', '2020-01-09 18:00:08'),
(75, 28, 10, 0, 'Seaography: then Drawling--the Drawling-master was an immense length of neck, which seemed to have.', '2020-01-09 18:00:08', '2020-01-09 18:00:08'),
(76, 19, 3, 3, 'There\'s no pleasing them!\' Alice was not a moment that it might appear to others that what you.', '2020-01-09 18:00:08', '2020-01-09 18:00:08'),
(77, 18, 5, 1, 'AT ALL. Soup does very well without--Maybe it\'s always pepper that had fluttered down from the.', '2020-01-09 18:00:08', '2020-01-09 18:00:08'),
(78, 30, 9, 2, 'Alice looked down at her feet, for it now, I suppose, by being drowned in my kitchen AT ALL. Soup.', '2020-01-09 18:00:08', '2020-01-09 18:00:08'),
(79, 4, 6, 5, 'English); \'now I\'m opening out like the Queen?\' said the Dodo. Then they both bowed low, and their.', '2020-01-09 18:00:08', '2020-01-09 18:00:08'),
(80, 3, 4, 5, 'When the Mouse was speaking, so that it might appear to others that what you mean,\' said Alice. \'I.', '2020-01-09 18:00:08', '2020-01-09 18:00:08'),
(81, 6, 3, 3, 'Mock Turtle. \'She can\'t explain it,\' said the White Rabbit; \'in fact, there\'s nothing written on.', '2020-01-09 18:00:08', '2020-01-09 18:00:08'),
(82, 27, 6, 1, 'King was the only difficulty was, that she was walking by the way of speaking to it,\' she thought.', '2020-01-09 18:00:08', '2020-01-09 18:00:08'),
(83, 21, 1, 2, 'Alice had begun to dream that she knew she had peeped into the court, without even waiting to put.', '2020-01-09 18:00:08', '2020-01-09 18:00:08'),
(84, 30, 7, 0, 'Let me see--how IS it to half-past one as long as it didn\'t much matter which way you go,\' said.', '2020-01-09 18:00:08', '2020-01-09 18:00:08'),
(85, 26, 11, 0, 'Gryphon. \'Do you mean that you have of putting things!\' \'It\'s a mineral, I THINK,\' said Alice. \'It.', '2020-01-09 18:00:08', '2020-01-09 18:00:08'),
(86, 16, 6, 4, 'You see, she came in with the lobsters, out to sea. So they got their tails in their proper.', '2020-01-09 18:00:08', '2020-01-09 18:00:08'),
(87, 18, 5, 3, 'Alice dear!\' said her sister; \'Why, what are they doing?\' Alice whispered to the executioner.', '2020-01-09 18:00:08', '2020-01-09 18:00:08'),
(88, 7, 8, 1, 'Then the Queen said to herself. \'Of the mushroom,\' said the Hatter, \'or you\'ll be telling me next.', '2020-01-09 18:00:08', '2020-01-09 18:00:08'),
(89, 13, 8, 5, 'Soup! \'Beautiful Soup! Who cares for fish, Game, or any other dish? Who would not allow without.', '2020-01-09 18:00:08', '2020-01-09 18:00:08'),
(90, 3, 7, 5, 'I was, I shouldn\'t like THAT!\' \'Oh, you foolish Alice!\' she answered herself. \'How can you learn.', '2020-01-09 18:00:08', '2020-01-09 18:00:08'),
(91, 7, 7, 2, 'See how eagerly the lobsters to the puppy; whereupon the puppy began a series of short charges at.', '2020-01-09 18:00:08', '2020-01-09 18:00:08'),
(92, 19, 1, 0, 'Indeed, she had looked under it, and on both sides at once. The Dormouse again took a minute or.', '2020-01-09 18:00:08', '2020-01-09 18:00:08'),
(93, 10, 8, 3, 'The King and Queen of Hearts, carrying the King\'s crown on a little animal (she couldn\'t guess of.', '2020-01-09 18:00:08', '2020-01-09 18:00:08'),
(94, 4, 2, 5, 'Alice)--\'and perhaps you haven\'t found it very nice, (it had, in fact, I didn\'t know that cats.', '2020-01-09 18:00:08', '2020-01-09 18:00:08'),
(95, 17, 1, 4, 'March Hare went on. \'I do,\' Alice said to the fifth bend, I think?\' \'I had NOT!\' cried the Mouse.', '2020-01-09 18:00:08', '2020-01-09 18:00:08'),
(96, 16, 1, 3, 'I hadn\'t mentioned Dinah!\' she said this she looked up, and there they are!\' said the Mock Turtle.', '2020-01-09 18:00:08', '2020-01-09 18:00:08'),
(97, 2, 6, 2, 'Hatter. Alice felt dreadfully puzzled. The Hatter\'s remark seemed to be ashamed of yourself,\' said.', '2020-01-09 18:00:08', '2020-01-09 18:00:08'),
(98, 27, 3, 3, 'Caterpillar, and the other ladder?--Why, I hadn\'t quite finished my tea when I got up in a very.', '2020-01-09 18:00:08', '2020-01-09 18:00:08'),
(99, 10, 5, 0, 'WHAT things?\' said the Dodo could not help bursting out laughing: and when Alice had no idea how.', '2020-01-09 18:00:08', '2020-01-09 18:00:08'),
(100, 22, 6, 3, 'English!\' said the Gryphon, and all sorts of things, and she, oh! she knows such a hurry that she.', '2020-01-09 18:00:08', '2020-01-09 18:00:08');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `rooms`
--

DROP TABLE IF EXISTS `rooms`;
CREATE TABLE `rooms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `city_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `area` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `room_type` bigint(20) UNSIGNED NOT NULL,
  `price` double(8,2) NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lat_location` double(8,2) NOT NULL,
  `lng_location` double(8,2) NOT NULL,
  `short_description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `long_description` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `parking` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'No',
  `wifi` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'No',
  `pet_friendly` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'No',
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Άδειασμα δεδομένων του πίνακα `rooms`
--

INSERT INTO `rooms` (`id`, `user_id`, `country_id`, `city_id`, `name`, `area`, `room_type`, `price`, `address`, `lat_location`, `lng_location`, `short_description`, `long_description`, `parking`, `wifi`, `pet_friendly`, `slug`, `created_at`, `updated_at`) VALUES
(1, 7, 5, 12, 'Lindsey Bogisich', 'Jermain Camp', 1, 31.00, '9922 Kassulke Freeway Apt. 014\nHahnland, NC 14687', 69.51, 25.21, 'Derision.\' \'I never thought about it,\' added the March Hare said to.', 'Stigand, the patriotic archbishop of Canterbury, found it so quickly that the Mouse in the same as they came nearer, Alice could see, as she left her, leaning her head on her lap as if nothing had happened. \'How am I to get out at the bottom of the sort,\' said the voice. \'Fetch me my gloves this moment!\' Then came a little shriek, and went in.', 'No', 'No', 'No', 'lindsey-bogisich', '2020-01-09 18:00:07', '2020-01-09 18:00:07'),
(2, 10, 1, 7, 'Annamae Rowe', 'Anabelle Via', 1, 72.00, '4152 Helene Fork Apt. 119\nStrosinland, GA 48867', 118.74, 108.35, 'The King\'s argument was, that if you could only hear whispers now.', 'There was a different person then.\' \'Explain all that,\' said the Hatter: \'but you could manage it?) \'And what are YOUR shoes done with?\' said the King. \'When did you manage on the breeze that followed them, the melancholy words:-- \'Soo--oop of the party went back to yesterday, because I was going to shrink any further: she felt very curious.', 'No', 'Yes', 'No', 'annamae-rowe', '2020-01-09 18:00:07', '2020-01-09 18:00:07'),
(3, 9, 3, 1, 'Kaelyn Cummings I', 'Ocie Plaza', 1, 26.00, '1110 Hills Lodge\nMetzton, MO 50205-7316', 20.44, 149.30, 'I can creep under the window, she suddenly spread out her hand on.', 'I\'d been the whiting,\' said the Queen, turning purple. \'I won\'t!\' said Alice. \'Call it what you were never even spoke to Time!\' \'Perhaps not,\' Alice cautiously replied: \'but I must have imitated somebody else\'s hand,\' said the Caterpillar, just as well. The twelve jurors were writing down \'stupid things!\' on their backs was the fan and the other.', 'Yes', 'Yes', 'No', 'kaelyn-cummings-i', '2020-01-09 18:00:07', '2020-01-09 18:00:07'),
(4, 2, 3, 13, 'Prof. Zachery Kshlerin DDS', 'Walker Creek', 4, 84.00, '2597 Hahn Mission Apt. 652\nFarrellborough, SC 68339', 76.34, 80.43, 'King, and the beak-- Pray how did you do either!\' And the Gryphon.', 'WOULD not remember ever having heard of one,\' said Alice, looking down with one eye, How the Owl had the dish as its share of the wood to listen. The Fish-Footman began by taking the little thing was snorting like a writing-desk?\' \'Come, we shall get on better.\' \'I\'d rather finish my tea,\' said the Gryphon. \'It all came different!\' Alice replied.', 'No', 'Yes', 'Yes', 'prof-zachery-kshlerin-dds', '2020-01-09 18:00:07', '2020-01-09 18:00:07'),
(5, 4, 5, 1, 'Bryon Walter', 'Orn Valley', 1, 62.00, '62488 Maia Fords\nLake Gabe, OR 66930-5472', 73.34, 76.49, 'March Hare said to the Knave. The Knave of Hearts, carrying the.', 'I needn\'t be afraid of interrupting him,) \'I\'ll give him sixpence. _I_ don\'t believe there\'s an atom of meaning in it.\' The jury all wrote down on one side, to look through into the wood. \'It\'s the oldest rule in the newspapers, at the bottom of a good thing!\' she said to herself. At this moment Five, who had been looking at the bottom of a.', 'No', 'Yes', 'Yes', 'bryon-walter', '2020-01-09 18:00:07', '2020-01-09 18:00:07'),
(6, 10, 2, 1, 'Toni Ratke', 'Kayli Light', 4, 50.00, '127 Kunze Points Suite 288\nWillisland, CA 88391-1218', 57.40, 64.84, 'And yet I don\'t like them!\' When the sands are all dry, he is gay as.', 'MINE.\' The Queen had ordered. They very soon finished it off. \'If everybody minded their own business!\' \'Ah, well! It means much the same age as herself, to see if he doesn\'t begin.\' But she went on in these words: \'Yes, we went to the table to measure herself by it, and on both sides at once. \'Give your evidence,\' said the Caterpillar. \'Well.', 'No', 'Yes', 'No', 'toni-ratke', '2020-01-09 18:00:07', '2020-01-09 18:00:07'),
(7, 3, 4, 11, 'Jena Kutch', 'Cydney Causeway', 4, 73.00, '9205 Thiel Stream\nMyrlmouth, MI 99960-4282', 40.47, 123.43, 'This sounded promising, certainly: Alice turned and came flying down.', 'Presently the Rabbit say, \'A barrowful will do, to begin again, it was quite impossible to say \'creatures,\' you see, because some of them didn\'t know it to half-past one as long as I get it home?\' when it grunted again, so she took courage, and went on muttering over the list, feeling very glad to find that the cause of this ointment--one.', 'Yes', 'Yes', 'Yes', 'jena-kutch', '2020-01-09 18:00:07', '2020-01-09 18:00:07'),
(8, 8, 4, 4, 'Demario Hartmann', 'Adam Shores', 1, 57.00, '96467 Jaden Groves Apt. 442\nOberbrunnerfurt, TX 97794', 31.16, 6.42, 'The Queen turned crimson with fury, and, after glaring at her with.', 'Alice. \'That\'s very important,\' the King repeated angrily, \'or I\'ll have you executed.\' The miserable Hatter dropped his teacup and bread-and-butter, and then she walked up towards it rather timidly, saying to herself, \'if one only knew the name \'Alice!\' CHAPTER XII. Alice\'s Evidence \'Here!\' cried Alice, jumping up in a shrill, passionate voice.', 'No', 'No', 'Yes', 'demario-hartmann', '2020-01-09 18:00:07', '2020-01-09 18:00:07'),
(9, 1, 2, 3, 'Antonietta Bernhard', 'Adan Manors', 1, 55.00, '81710 Bergnaum Way\nBahringerhaven, KS 93335-1696', 130.15, 98.48, 'Queen\'s absence, and were resting in the night? Let me think: was I.', 'For some minutes it puffed away without being invited,\' said the Duchess: \'and the moral of THAT is--\"Take care of the bill, \"French, music, AND WASHING--extra.\"\' \'You couldn\'t have done that?\' she thought. \'I must be really offended. \'We won\'t talk about cats or dogs either, if you don\'t know what a Gryphon is, look at a reasonable pace,\' said.', 'Yes', 'Yes', 'No', 'antonietta-bernhard', '2020-01-09 18:00:07', '2020-01-09 18:00:07'),
(10, 8, 3, 5, 'Therese Wiza', 'Metz Haven', 1, 47.00, '13393 Jaron Stravenue\nRylanchester, DC 82134-8329', 71.37, 119.12, 'Queen say only yesterday you deserved to be lost: away went Alice.', 'For the Mouse replied rather crossly: \'of course you don\'t!\' the Hatter said, turning to Alice an excellent opportunity for showing off her knowledge, as there was no \'One, two, three, and away,\' but they were getting so thin--and the twinkling of the gloves, and was gone across to the end of the e--e--evening, Beautiful, beauti--FUL SOUP!\'.', 'Yes', 'Yes', 'No', 'therese-wiza', '2020-01-09 18:00:07', '2020-01-09 18:00:07'),
(11, 2, 2, 10, 'Prof. Myrtie Nikolaus DVM', 'Yoshiko Manors', 2, 75.00, '9296 Nicola Stream\nRemingtonland, AZ 62513-8235', 96.41, 119.20, 'Gryphon. \'Then, you know,\' said the Mock Turtle. \'She can\'t explain.', 'I was going to leave off this minute!\' She generally gave herself very good height indeed!\' said the Queen. \'You make me giddy.\' And then, turning to Alice for protection. \'You shan\'t be able! I shall think nothing of tumbling down stairs! How brave they\'ll all think me at home! Why, I wouldn\'t say anything about it, even if my head would go.', 'Yes', 'No', 'Yes', 'prof-myrtie-nikolaus-dvm', '2020-01-09 18:00:07', '2020-01-09 18:00:07'),
(12, 10, 3, 5, 'Axel Barton', 'Nikolaus Mall', 1, 41.00, '3567 Jedidiah Landing\nOkunevafort, DC 42015', 49.37, 65.36, 'However, she soon found out a history of the pack, she could not.', 'You know the meaning of half an hour or so, and were resting in the pool rippling to the jury, and the poor little thing sobbed again (or grunted, it was just in time to begin with,\' said the Mock Turtle had just succeeded in bringing herself down to them, and all dripping wet, cross, and uncomfortable. The moment Alice felt a very decided tone.', 'No', 'Yes', 'Yes', 'axel-barton', '2020-01-09 18:00:07', '2020-01-09 18:00:07'),
(13, 6, 5, 4, 'Rusty Carter', 'Littel Forge', 4, 71.00, '525 Waelchi Plains Apt. 619\nDickiview, MO 18734', 74.26, 69.96, 'Pigeon the opportunity of showing off her knowledge, as there was.', 'There was no one listening, this time, sat down at her rather inquisitively, and seemed to be talking in his confusion he bit a large fan in the morning, just time to see if there are, nobody attends to them--and you\'ve no idea what to do with this creature when I was going to dive in among the people near the right words,\' said poor Alice, \'when.', 'No', 'No', 'No', 'rusty-carter', '2020-01-09 18:00:07', '2020-01-09 18:00:07'),
(14, 6, 3, 13, 'Greyson Bergnaum', 'Bashirian Ramp', 3, 65.00, '197 Oleta Corner Apt. 478\nSouth Tomfurt, MS 69800', 30.27, 23.18, 'It was the fan and gloves, and, as there was generally a frog or a.', 'Mock Turtle, capering wildly about. \'Change lobsters again!\' yelled the Gryphon went on to the Mock Turtle\'s Story \'You can\'t think how glad I am in the direction in which case it would be offended again. \'Mine is a long time with the name of nearly everything there. \'That\'s the reason of that?\' \'In my youth,\' Father William replied to his son.', 'No', 'No', 'Yes', 'greyson-bergnaum', '2020-01-09 18:00:07', '2020-01-09 18:00:07'),
(15, 10, 5, 2, 'Dr. Schuyler Rolfson IV', 'Hirthe Loaf', 2, 76.00, '178 Edward Crescent\nVitastad, DC 35035-9753', 89.35, 140.46, 'Hardly knowing what she was about a foot high: then she remembered.', 'Alice looked at the Mouse\'s tail; \'but why do you mean that you have of putting things!\' \'It\'s a pun!\' the King eagerly, and he went on \'And how did you do lessons?\' said Alice, \'we learned French and music.\' \'And washing?\' said the King. Here one of the mushroom, and raised herself to about two feet high: even then she remembered having seen in.', 'Yes', 'No', 'Yes', 'dr-schuyler-rolfson-iv', '2020-01-09 18:00:07', '2020-01-09 18:00:07'),
(16, 6, 2, 3, 'Mr. Nels Kovacek V', 'Rosalia Forks', 2, 56.00, '25724 Gerhold Stravenue Suite 010\nDerickfort, UT 67954-4945', 127.10, 17.54, 'Run home this moment, I tell you!\' But she went on in a VERY turn-up.', 'Lobster Quadrille The Mock Turtle said with a teacup in one hand and a long time with great emphasis, looking hard at Alice the moment she appeared; but she remembered having seen such a wretched height to be.\' \'It is a raven like a frog; and both the hedgehogs were out of breath, and said to herself; \'his eyes are so VERY wide, but she knew she.', 'No', 'No', 'No', 'mr-nels-kovacek-v', '2020-01-09 18:00:07', '2020-01-09 18:00:07'),
(17, 9, 4, 9, 'Mellie Rau', 'Ransom Viaduct', 4, 30.00, '5420 Blanda Dale Apt. 804\nHenriville, PA 09430', 64.53, 37.26, 'Alice! Come here directly, and get in at the beginning,\' the King.', 'Alice knew it was too late to wish that! She went in without knocking, and hurried off to the tarts on the trumpet, and then dipped suddenly down, so suddenly that Alice said; \'there\'s a large rabbit-hole under the table: she opened it, and then raised himself upon tiptoe, put his shoes on. \'--and just take his head mournfully. \'Not I!\' he.', 'Yes', 'Yes', 'No', 'mellie-rau', '2020-01-09 18:00:07', '2020-01-09 18:00:07'),
(18, 2, 3, 11, 'Walter Boehm', 'Clarabelle Villages', 3, 70.00, '1843 Schoen Summit Suite 206\nLake Jaeden, KS 05456-2428', 8.25, 146.31, 'Dormouse followed him: the March Hare said to the Knave of Hearts.', 'Alice asked in a large cat which was immediately suppressed by the end of trials, \"There was some attempts at applause, which was full of soup. \'There\'s certainly too much frightened that she did not like to see what the moral of that is--\"Oh, \'tis love, that makes them so shiny?\' Alice looked at the White Rabbit cried out, \'Silence in the.', 'Yes', 'Yes', 'Yes', 'walter-boehm', '2020-01-09 18:00:07', '2020-01-09 18:00:07'),
(19, 4, 3, 2, 'Reyes Marquardt', 'Monahan Crescent', 4, 12.00, '9347 Alverta Dam Apt. 973\nPort Lora, LA 12789-6131', 36.45, 124.78, 'In another moment that it might tell her something about the temper.', 'PRECIOUS nose\'; as an unusually large saucepan flew close by her. There was a sound of many footsteps, and Alice was beginning to get an opportunity of showing off a little timidly, \'why you are very dull!\' \'You ought to be otherwise.\"\' \'I think you might like to drop the jar for fear of their wits!\' So she set to work very carefully, with one of.', 'No', 'No', 'No', 'reyes-marquardt', '2020-01-09 18:00:07', '2020-01-09 18:00:07'),
(20, 2, 5, 8, 'Bridgette Kling', 'Selina Fords', 3, 75.00, '43525 Graham Islands Apt. 275\nSouth Korytown, OH 93748', 61.18, 32.25, 'I\'ll tell you what year it is?\' \'Of course it was,\' he said. (Which.', 'But they HAVE their tails fast in their mouths; and the roof bear?--Mind that loose slate--Oh, it\'s coming down! Heads below!\' (a loud crash)--\'Now, who did that?--It was Bill, I fancy--Who\'s to go nearer till she too began dreaming after a few minutes she heard was a different person then.\' \'Explain all that,\' said the Mock Turtle\'s Story \'You.', 'No', 'Yes', 'No', 'bridgette-kling', '2020-01-09 18:00:07', '2020-01-09 18:00:07'),
(21, 5, 2, 7, 'Prof. Lennie Schoen', 'Romaguera Turnpike', 2, 23.00, '4162 Gordon Union\nWest Royland, CT 13639-9215', 145.34, 111.24, 'When the pie was all very well without--Maybe it\'s always pepper.', 'I said \"What for?\"\' \'She boxed the Queen\'s hedgehog just now, only it ran away when it saw mine coming!\' \'How do you know that you\'re mad?\' \'To begin with,\' the Mock Turtle replied, counting off the top of it. She stretched herself up closer to Alice\'s great surprise, the Duchess\'s knee, while plates and dishes crashed around it--once more the.', 'No', 'No', 'Yes', 'prof-lennie-schoen', '2020-01-09 18:00:07', '2020-01-09 18:00:07'),
(22, 5, 2, 6, 'Dr. Linnie McCullough I', 'Jolie Crossing', 3, 69.00, '2354 Murray Street Apt. 597\nWinonaton, PA 10548', 75.52, 24.16, 'Alice was rather glad there WAS no one could possibly hear you.\' And.', 'Alice said very humbly; \'I won\'t interrupt again. I dare say there may be ONE.\' \'One, indeed!\' said the Cat; and this Alice thought she might as well as she wandered about in the beautiful garden, among the leaves, which she concluded that it was impossible to say whether the blows hurt it or not. \'Oh, PLEASE mind what you\'re at!\" You know the.', 'No', 'No', 'Yes', 'dr-linnie-mccullough-i', '2020-01-09 18:00:07', '2020-01-09 18:00:07'),
(23, 9, 3, 11, 'Kory Glover', 'Harris Parkway', 3, 32.00, '82077 Bettye Valleys Suite 581\nWest Travon, NC 91608-3719', 39.36, 16.14, 'CHAPTER V. Advice from a bottle marked \'poison,\' it is right?\' \'In.', 'I\'ll stay down here with me! There are no mice in the world! Oh, my dear paws! Oh my dear paws! Oh my dear paws! Oh my dear Dinah! I wonder what was the matter worse. You MUST have meant some mischief, or else you\'d have signed your name like an honest man.\' There was exactly one a-piece all round. (It was this last remark that had fluttered down.', 'Yes', 'Yes', 'No', 'kory-glover', '2020-01-09 18:00:07', '2020-01-09 18:00:07'),
(24, 6, 5, 9, 'Alessia Ortiz', 'Monahan Islands', 1, 35.00, '118 Shannon Rapids\nStammside, KS 50999', 129.46, 133.95, 'King. \'When did you call him Tortoise, if he would deny it too: but.', 'Queen, and Alice, were in custody and under sentence of execution. Then the Queen was to get through was more hopeless than ever: she sat on, with closed eyes, and half believed herself in the face. \'I\'ll put a white one in by mistake; and if I must, I must,\' the King eagerly, and he says it\'s so useful, it\'s worth a hundred pounds! He says it.', 'No', 'Yes', 'Yes', 'alessia-ortiz', '2020-01-09 18:00:07', '2020-01-09 18:00:07'),
(25, 10, 5, 9, 'Dr. Alford Hilpert', 'Friesen Courts', 3, 71.00, '30183 Rau Lodge\nNew Benedictview, GA 52224', 131.27, 115.47, 'English); \'now I\'m opening out like the Mock Turtle persisted. \'How.', 'Alice. The poor little thing grunted in reply (it had left off writing on his flappers, \'--Mystery, ancient and modern, with Seaography: then Drawling--the Drawling-master was an old woman--but then--always to have wondered at this, she came rather late, and the cool fountains. CHAPTER VIII. The Queen\'s argument was, that her shoulders were.', 'No', 'Yes', 'No', 'dr-alford-hilpert', '2020-01-09 18:00:07', '2020-01-09 18:00:07'),
(26, 10, 3, 10, 'Ressie Walter', 'Susan Ville', 4, 97.00, '67199 Hester Ridge Apt. 677\nSipesstad, OR 05653', 74.49, 49.47, 'The Dormouse slowly opened his eyes. \'I wasn\'t asleep,\' he said do.', 'King. (The jury all brightened up at the Queen, \'and he shall tell you just now what the next verse.\' \'But about his toes?\' the Mock Turtle, suddenly dropping his voice; and Alice was soon submitted to by all three to settle the question, and they lived at the thought that SOMEBODY ought to speak, and no room to grow up again! Let me see: four.', 'No', 'No', 'No', 'ressie-walter', '2020-01-09 18:00:07', '2020-01-09 18:00:07'),
(27, 4, 1, 9, 'Emie Schmidt', 'Federico Road', 2, 46.00, '5539 Fletcher Pines\nGreenfeldermouth, NY 54335', 32.44, 126.44, 'Alice; not that she was shrinking rapidly; so she set to work, and.', 'She pitied him deeply. \'What is his sorrow?\' she asked the Mock Turtle sang this, very slowly and sadly:-- \'\"Will you walk a little different. But if I\'m Mabel, I\'ll stay down here till I\'m somebody else\"--but, oh dear!\' cried Alice, jumping up in great disgust, and walked off; the Dormouse shook its head to hide a smile: some of the well, and.', 'No', 'Yes', 'Yes', 'emie-schmidt', '2020-01-09 18:00:07', '2020-01-09 18:00:07'),
(28, 4, 4, 1, 'Clifford Oberbrunner', 'Cormier Square', 2, 76.00, '5411 Kennedi Stream\nBotsfordburgh, NH 82658', 150.45, 8.54, 'March Hare interrupted, yawning. \'I\'m getting tired of being all.', 'Alice thought to herself \'This is Bill,\' she gave her one, they gave him two, You gave us three or more; They all made a dreadfully ugly child: but it was quite tired of sitting by her sister on the top of it. Presently the Rabbit came up to them to be listening, so she set the little thing sobbed again (or grunted, it was only the pepper that.', 'No', 'Yes', 'Yes', 'clifford-oberbrunner', '2020-01-09 18:00:07', '2020-01-09 18:00:07'),
(29, 8, 3, 7, 'Ms. Mertie Kirlin PhD', 'Joana Park', 2, 61.00, '36206 Ratke Via\nStreichborough, ME 53145', 25.32, 96.44, 'So she began again: \'Ou est ma chatte?\' which was a sound of a.', 'I used to call him Tortoise--\' \'Why did you ever saw. How she longed to get out again. That\'s all.\' \'Thank you,\' said the Knave, \'I didn\'t know it to make out that one of the Lobster Quadrille, that she had read about them in books, and she thought at first was in a pleased tone. \'Pray don\'t trouble yourself to say when I got up and leave the.', 'No', 'Yes', 'No', 'ms-mertie-kirlin-phd', '2020-01-09 18:00:07', '2020-01-09 18:00:07'),
(30, 4, 4, 3, 'Flo McDermott', 'Luz Tunnel', 3, 61.00, '84821 O\'Conner Mountain Apt. 346\nSventon, OH 67848-2792', 29.54, 35.54, 'Conqueror, whose cause was favoured by the little golden key and.', 'Alice could speak again. In a minute or two, and the pair of boots every Christmas.\' And she began fancying the sort of meaning in it,\' but none of them were animals, and some of YOUR business, Two!\' said Seven. \'Yes, it IS his business!\' said Five, in a confused way, \'Prizes! Prizes!\' Alice had no idea what Latitude was, or Longitude either, but.', 'No', 'No', 'Yes', 'flo-mcdermott', '2020-01-09 18:00:07', '2020-01-09 18:00:07');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `room_types`
--

DROP TABLE IF EXISTS `room_types`;
CREATE TABLE `room_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Άδειασμα δεδομένων του πίνακα `room_types`
--

INSERT INTO `room_types` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Single Room', '2020-01-09 18:00:06', '2020-01-09 18:00:06'),
(2, 'Double Room', '2020-01-09 18:00:06', '2020-01-09 18:00:06'),
(3, 'Triple Room', '2020-01-09 18:00:06', '2020-01-09 18:00:06'),
(4, 'Fourfold Room', '2020-01-09 18:00:06', '2020-01-09 18:00:06');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `social_facebook_accounts`
--

DROP TABLE IF EXISTS `social_facebook_accounts`;
CREATE TABLE `social_facebook_accounts` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `provider_user_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `provider` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `social_google_accounts`
--

DROP TABLE IF EXISTS `social_google_accounts`;
CREATE TABLE `social_google_accounts` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `provider_user_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `provider` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `subscriptions`
--

DROP TABLE IF EXISTS `subscriptions`;
CREATE TABLE `subscriptions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stripe_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stripe_status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stripe_plan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `trial_ends_at` timestamp NULL DEFAULT NULL,
  `ends_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `firstName` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastName` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` datetime NOT NULL DEFAULT '2020-01-09 19:59:55',
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `age` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` tinyint(4) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `stripe_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_brand` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_last_four` varchar(4) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trial_ends_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Άδειασμα δεδομένων του πίνακα `users`
--

INSERT INTO `users` (`id`, `firstName`, `lastName`, `password`, `email`, `email_verified_at`, `phone`, `age`, `city`, `slug`, `role`, `remember_token`, `created_at`, `updated_at`, `stripe_id`, `card_brand`, `card_last_four`, `trial_ends_at`) VALUES
(1, 'Maude', 'Strosin', '$2y$10$MnaqqAtKTT4o7Zf6jnuekOeQGjjEl2WjmsZ701ciMwFAW2Xrg4lVq', 'mireya10@example.com', '2020-01-09 20:00:06', NULL, '67', 'North Hester', NULL, 0, 'oP9PZaYjTQ', '2020-01-09 18:00:06', '2020-01-09 18:00:06', NULL, NULL, NULL, NULL),
(2, 'Ignatius', 'Fritsch', '$2y$10$R6f6SDn/MFDPafk7srGGqOoey/ApgwvZ2jq6LP8f8RBjIYmooRjoS', 'stacey.hermiston@example.org', '2020-01-09 20:00:06', NULL, '24', 'East Pansyville', NULL, 0, 'PqrHmUlc9c', '2020-01-09 18:00:06', '2020-01-09 18:00:06', NULL, NULL, NULL, NULL),
(3, 'Deontae', 'Zemlak', '$2y$10$wIsJwKxPMX7hfpGyzwKXc.nAKgjC2fyWrrM9AULmrQ7REsIa5Qlaq', 'orin.hamill@example.net', '2020-01-09 20:00:06', NULL, '30', 'Port Maggieshire', NULL, 0, 'QhVxSSA1av', '2020-01-09 18:00:06', '2020-01-09 18:00:06', NULL, NULL, NULL, NULL),
(4, 'Abbey', 'Von', '$2y$10$DJxwtio/6T.ba7AlnmTNseWQdTGrH7AGu.E1SUCZ/XpDhTELgH9Uy', 'richard93@example.org', '2020-01-09 20:00:06', NULL, '48', 'Emeraldton', NULL, 0, '5sqzPqjJql', '2020-01-09 18:00:06', '2020-01-09 18:00:06', NULL, NULL, NULL, NULL),
(5, 'Damian', 'Herman', '$2y$10$iISVoIWL.50uaktLmWJCieQYleT727Fk1R4AIwWW2757PpjkbhK3q', 'deanna.hill@example.com', '2020-01-09 20:00:06', NULL, '37', 'West Trystan', NULL, 0, 'ejb0nPUomy', '2020-01-09 18:00:06', '2020-01-09 18:00:06', NULL, NULL, NULL, NULL),
(6, 'Jazmyn', 'Parker', '$2y$10$CircAKT9hZSrnUqgLySDLeNaLq/VYQJgvAkdcbZrF1g1rGGp/FP9m', 'ebert.jaqueline@example.com', '2020-01-09 20:00:06', NULL, '38', 'New Thelma', NULL, 0, '43jOIlxlUA', '2020-01-09 18:00:06', '2020-01-09 18:00:06', NULL, NULL, NULL, NULL),
(7, 'Vilma', 'Koch', '$2y$10$axfifozTEk/Yhh/l4FGKLuhqdkjGMuSx0VPZmTTC5yT3to2LYW5bW', 'cwiegand@example.com', '2020-01-09 20:00:06', NULL, '44', 'New Joanie', NULL, 0, 'LEor8eUdef', '2020-01-09 18:00:06', '2020-01-09 18:00:06', NULL, NULL, NULL, NULL),
(8, 'Francisca', 'Rippin', '$2y$10$bykIXOHbfcc2EAEVfT99A.XiCx5NT8U.oJS2M/iOsOAdv1PgHyhAu', 'wolff.abraham@example.org', '2020-01-09 20:00:06', NULL, '33', 'Lake Alexandrine', NULL, 0, 't95AErmxSh', '2020-01-09 18:00:06', '2020-01-09 18:00:06', NULL, NULL, NULL, NULL),
(9, 'Aniya', 'Klocko', '$2y$10$p1xcgRj3TfF9xEWj/03MY.jY4wUPkT1NLQUH2Ty3EFFJBTvciH3/O', 'orrin65@example.org', '2020-01-09 20:00:06', NULL, '58', 'Port Princesschester', NULL, 0, 'TTsmvuOrSq', '2020-01-09 18:00:06', '2020-01-09 18:00:06', NULL, NULL, NULL, NULL),
(10, 'Sarah', 'Brakus', '$2y$10$l8vJElNSA8garAsd0qFmd.RDMA1d3ZQSdscQEsS2S/ymU0xnggcii', 'ima09@example.com', '2020-01-09 20:00:06', NULL, '25', 'East Donavon', NULL, 0, 'skplws7EVD', '2020-01-09 18:00:06', '2020-01-09 18:00:06', NULL, NULL, NULL, NULL),
(11, 'Anastasis', 'Mastoris', '$2y$10$HIcqgjlt44ltHVwKwNKAauT9ICldH2fhRZBObQcNQWnYW/.ItivMm', 'mclaren730@gmail.com', '2020-01-09 20:00:06', NULL, '26', 'West Deltamouth', NULL, 1, 'xfsGqTz5qv', '2020-01-09 18:00:06', '2020-01-09 18:00:06', NULL, NULL, NULL, NULL);

--
-- Ευρετήρια για άχρηστους πίνακες
--

--
-- Ευρετήρια για πίνακα `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bookings_room_id_foreign` (`room_id`),
  ADD KEY `bookings_user_id_foreign` (`user_id`);

--
-- Ευρετήρια για πίνακα `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Ευρετήρια για πίνακα `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Ευρετήρια για πίνακα `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`id`),
  ADD KEY `favorites_room_id_foreign` (`room_id`),
  ADD KEY `favorites_user_id_foreign` (`user_id`);

--
-- Ευρετήρια για πίνακα `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Ευρετήρια για πίνακα `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Ευρετήρια για πίνακα `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `photos_user_id_foreign` (`user_id`),
  ADD KEY `photos_room_id_foreign` (`room_id`);

--
-- Ευρετήρια για πίνακα `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviews_user_id_foreign` (`user_id`),
  ADD KEY `reviews_room_id_foreign` (`room_id`);

--
-- Ευρετήρια για πίνακα `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rooms_room_type_foreign` (`room_type`),
  ADD KEY `rooms_user_id_foreign` (`user_id`),
  ADD KEY `rooms_city_id_foreign` (`city_id`),
  ADD KEY `rooms_country_id_foreign` (`country_id`);

--
-- Ευρετήρια για πίνακα `room_types`
--
ALTER TABLE `room_types`
  ADD PRIMARY KEY (`id`);

--
-- Ευρετήρια για πίνακα `social_facebook_accounts`
--
ALTER TABLE `social_facebook_accounts`
  ADD KEY `social_facebook_accounts_user_id_foreign` (`user_id`);

--
-- Ευρετήρια για πίνακα `social_google_accounts`
--
ALTER TABLE `social_google_accounts`
  ADD KEY `social_google_accounts_user_id_foreign` (`user_id`);

--
-- Ευρετήρια για πίνακα `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subscriptions_user_id_stripe_status_index` (`user_id`,`stripe_status`);

--
-- Ευρετήρια για πίνακα `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_stripe_id_index` (`stripe_id`);

--
-- AUTO_INCREMENT για άχρηστους πίνακες
--

--
-- AUTO_INCREMENT για πίνακα `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT για πίνακα `cities`
--
ALTER TABLE `cities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT για πίνακα `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT για πίνακα `favorites`
--
ALTER TABLE `favorites`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT για πίνακα `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT για πίνακα `photos`
--
ALTER TABLE `photos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT για πίνακα `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT για πίνακα `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT για πίνακα `room_types`
--
ALTER TABLE `room_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT για πίνακα `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT για πίνακα `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Περιορισμοί για άχρηστους πίνακες
--

--
-- Περιορισμοί για πίνακα `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_room_id_foreign` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bookings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Περιορισμοί για πίνακα `favorites`
--
ALTER TABLE `favorites`
  ADD CONSTRAINT `favorites_room_id_foreign` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `favorites_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Περιορισμοί για πίνακα `photos`
--
ALTER TABLE `photos`
  ADD CONSTRAINT `photos_room_id_foreign` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `photos_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Περιορισμοί για πίνακα `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_room_id_foreign` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Περιορισμοί για πίνακα `rooms`
--
ALTER TABLE `rooms`
  ADD CONSTRAINT `rooms_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `rooms_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `rooms_room_type_foreign` FOREIGN KEY (`room_type`) REFERENCES `room_types` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `rooms_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Περιορισμοί για πίνακα `social_facebook_accounts`
--
ALTER TABLE `social_facebook_accounts`
  ADD CONSTRAINT `social_facebook_accounts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Περιορισμοί για πίνακα `social_google_accounts`
--
ALTER TABLE `social_google_accounts`
  ADD CONSTRAINT `social_google_accounts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
