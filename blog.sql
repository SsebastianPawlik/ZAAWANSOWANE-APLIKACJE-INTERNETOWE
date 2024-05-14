-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Maj 14, 2024 at 02:41 PM
-- Wersja serwera: 10.4.28-MariaDB
-- Wersja PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `galerie`
--

CREATE TABLE `galerie` (
  `id` int(11) NOT NULL,
  `nazwa` varchar(255) NOT NULL,
  `opis` text NOT NULL,
  `link` varchar(2083) DEFAULT NULL,
  `data_dodania` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `galerie`
--

INSERT INTO `galerie` (`id`, `nazwa`, `opis`, `link`, `data_dodania`) VALUES
(1, 'tert', 'ertertert', '', '2024-04-21 20:19:49'),
(2, 'ffff', 'test', 'https://www.facebook.com/', '2024-04-21 20:19:49'),
(26, 'dfg', 'sdf', 'https://www.facebook.com/', '2024-04-21 20:19:49'),
(49, 'dfgnn', 'sdf', 'https://www.facebook.com/', '2024-04-21 20:19:49'),
(70, 'sdfsefse', 'sdfesdfs', 'https://www.youtube.com/watch?v=JOfuHgSFZ2k', '2024-04-21 20:19:49'),
(71, 'gfdgdfg', 'dfgdrgdf', 'https://www.facebook.com/', '2024-04-21 20:19:49'),
(72, 'hhhhh', 'hhhhh', '', '2024-04-21 20:19:49'),
(73, 'cghfghf', 'gfghtf', '', '2024-04-21 20:19:49'),
(74, 'testuje', 'asdasdasda', '', '2024-04-21 20:19:49'),
(75, 'xyz', 'xxx', '', '2024-05-03 18:41:33'),
(76, 'kkk', 'kkk', '', '2024-05-07 13:17:36'),
(77, 'asdasd', 'asdasd', '', '2024-05-07 13:34:29'),
(78, 'asdasd', 'asdasd', '', '2024-05-07 13:36:40'),
(79, 'asdasd', 'asdasd', '', '2024-05-07 13:38:23'),
(80, 'qqq', 'qqqq', '', '2024-05-07 13:38:46'),
(81, 'qqq', 'qqqq', '', '2024-05-07 13:38:59'),
(82, 'qwe', 'qwe', '', '2024-05-07 13:39:35'),
(83, 'qwe', 'qwe', '', '2024-05-07 13:39:40'),
(84, 'kkkkkk', 'kkkkkk', '', '2024-05-07 14:00:04'),
(85, 'kkkkkk', 'kkkkkk', '', '2024-05-07 14:00:23'),
(86, 'asdasd', 'asdasd', '', '2024-05-07 14:05:51'),
(87, 'zip', 'zip', '', '2024-05-07 14:06:33'),
(88, 'aaaaaaaaaaaa', 'aaaaaaaaaaaaaaaaaa', '', '2024-05-14 13:08:46'),
(89, 'bbbbbbbbbbbb', 'bbbbbbbbbbbbbbb', '', '2024-05-14 13:10:34');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `title`, `content`) VALUES
(1, 'qqqq', 'wqweqwe'),
(2, 'qwqwqwq', 'asasasa'),
(3, 'asadsasdasdasd', '<p>asdasd</p><p>&nbsp;</p><p>asdasdasd</p>'),
(4, 'test', '<p>test</p><p>&nbsp;</p><p>test</p>');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `posts`
--

CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `header_image` varchar(255) DEFAULT NULL,
  `gallery_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `images` text DEFAULT NULL,
  `view_count` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `title`, `content`, `header_image`, `gallery_id`, `created_at`, `images`, `view_count`) VALUES
(6, 'test', 'test testt test', 'assets/images/kaszuby.jpg', NULL, '2024-02-26 19:30:53', NULL, 1),
(7, 'test', 'test', 'assets/images/batalion.jpg', NULL, '2024-02-26 19:33:05', NULL, 3),
(8, 'test', 'test', 'assets/images/batalion.jpg', 0, '2024-02-26 19:37:12', NULL, 0),
(9, 'yrdy', 'jghjg', 'm_an-outbreak-of-2848213_1920.jpg', NULL, '2024-02-26 19:46:54', NULL, 0),
(10, 'testtsts', 'fghfghfgh', '20190413_121544.jpg', NULL, '2024-02-26 19:52:44', NULL, 3),
(11, 'ttttt', 'test', '3.jpg', NULL, '2024-02-26 19:56:49', NULL, 11),
(18, 'fghf', 'fghfgh', NULL, NULL, '2024-05-04 20:50:35', '', 3),
(19, 'aaa', 'aaa', NULL, NULL, '2024-05-04 21:57:46', '', 7);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'test', '$2y$10$u7LFscv7QQyAyu/3eJQwqeTH8PDBMn5pwFAgIXlzYiCgTBEvvo3Yy'),
(2, 'asd', 'asd');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zdjecia`
--

CREATE TABLE `zdjecia` (
  `id_zdjecia` int(11) NOT NULL,
  `id_galerii` int(11) NOT NULL,
  `sciezka` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `zdjecia`
--

INSERT INTO `zdjecia` (`id_zdjecia`, `id_galerii`, `sciezka`) VALUES
(1, 73, 'uploads/gallery/tarta-cytrynowa-galka.png'),
(2, 73, 'uploads/gallery/truskawka-z-truskawkami-galka.png'),
(3, 73, 'uploads/gallery/wata-cukrowa-galka.png'),
(4, 73, 'uploads/gallery/wisnia-galka.png'),
(5, 74, 'C:\\xampp\\htdocs\\blog2\\content/uploads/gallery/testuje/smiet-czeko-z-wisnia-galka.png'),
(6, 74, 'C:\\xampp\\htdocs\\blog2\\content/uploads/gallery/testuje/tarta-cytrynowa-galka.png'),
(7, 74, 'C:\\xampp\\htdocs\\blog2\\content/uploads/gallery/testuje/truskawka-z-truskawkami-galka.png'),
(8, 74, 'C:\\xampp\\htdocs\\blog2\\content/uploads/gallery/testuje/wata-cukrowa-galka.png'),
(9, 74, 'C:\\xampp\\htdocs\\blog2\\content/uploads/gallery/testuje/wisnia-galka.png'),
(10, 75, 'C:\\xampp\\htdocs\\blog2\\content/uploads/gallery/xyz/58.png'),
(11, 75, 'C:\\xampp\\htdocs\\blog2\\content/uploads/gallery/xyz/59.png'),
(12, 76, 'C:\\xampp\\htdocs\\blog2\\content/uploads/gallery/kkk/Zrzut ekranu 2024-03-18 104213.png'),
(13, 76, 'C:\\xampp\\htdocs\\blog2\\content/uploads/gallery/kkk/Zrzut ekranu 2024-03-19 120726.png'),
(14, 76, 'C:\\xampp\\htdocs\\blog2\\content/uploads/gallery/kkk/Zrzut ekranu 2024-03-19 120838.png'),
(15, 76, 'C:\\xampp\\htdocs\\blog2\\content/uploads/gallery/kkk/Zrzut ekranu 2024-03-19 120926.png'),
(16, 77, 'C:\\xampp\\htdocs\\blog2\\content/uploads/gallery/asdasd/Zrzut ekranu 2024-03-18 104213.png'),
(17, 77, 'C:\\xampp\\htdocs\\blog2\\content/uploads/gallery/asdasd/Zrzut ekranu 2024-03-19 120726.png'),
(18, 77, 'C:\\xampp\\htdocs\\blog2\\content/uploads/gallery/asdasd/Zrzut ekranu 2024-03-19 120838.png'),
(19, 77, 'C:\\xampp\\htdocs\\blog2\\content/uploads/gallery/asdasd/Zrzut ekranu 2024-03-19 120926.png'),
(20, 81, 'C:xampphtdocslog2content/uploads/gallery/qqq/Zrzut ekranu 2024-03-18 104213.png'),
(21, 81, 'C:xampphtdocslog2content/uploads/gallery/qqq/Zrzut ekranu 2024-03-19 120726.png'),
(22, 81, 'C:xampphtdocslog2content/uploads/gallery/qqq/Zrzut ekranu 2024-03-19 120838.png'),
(23, 83, 'C:xampphtdocslog2content/uploads/gallery/qwe/Zrzut ekranu 2024-03-18 104213.png'),
(24, 83, 'C:xampphtdocslog2content/uploads/gallery/qwe/Zrzut ekranu 2024-03-19 120726.png'),
(25, 83, 'C:xampphtdocslog2content/uploads/gallery/qwe/Zrzut ekranu 2024-03-19 120838.png'),
(26, 85, 'C:\\xampp\\htdocs\\blog2\\content/uploads/gallery/kkkkkk/Zrzut ekranu 2024-03-18 104213.png'),
(27, 85, 'C:\\xampp\\htdocs\\blog2\\content/uploads/gallery/kkkkkk/Zrzut ekranu 2024-03-19 120726.png'),
(28, 85, 'C:\\xampp\\htdocs\\blog2\\content/uploads/gallery/kkkkkk/Zrzut ekranu 2024-03-19 120838.png'),
(29, 89, 'C:\\xampp\\htdocs\\blog2\\content/uploads/gallery/bbbbbbbbbbbb/Zrzut ekranu 2024-03-18 104213.png'),
(30, 89, 'C:\\xampp\\htdocs\\blog2\\content/uploads/gallery/bbbbbbbbbbbb/Zrzut ekranu 2024-03-19 120726.png'),
(31, 89, 'C:\\xampp\\htdocs\\blog2\\content/uploads/gallery/bbbbbbbbbbbb/Zrzut ekranu 2024-03-19 120838.png');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `galerie`
--
ALTER TABLE `galerie`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `zdjecia`
--
ALTER TABLE `zdjecia`
  ADD PRIMARY KEY (`id_zdjecia`),
  ADD KEY `id_galerii` (`id_galerii`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `galerie`
--
ALTER TABLE `galerie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `zdjecia`
--
ALTER TABLE `zdjecia`
  MODIFY `id_zdjecia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `zdjecia`
--
ALTER TABLE `zdjecia`
  ADD CONSTRAINT `zdjecia_ibfk_1` FOREIGN KEY (`id_galerii`) REFERENCES `galerie` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
