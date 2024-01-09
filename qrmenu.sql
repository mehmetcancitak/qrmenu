-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: localhost
-- Üretim Zamanı: 10 Oca 2024, 00:29:18
-- Sunucu sürümü: 10.4.28-MariaDB
-- PHP Sürümü: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `qrmenu`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `language`
--

CREATE TABLE `language` (
  `id` int(1) NOT NULL,
  `lang` varchar(3) NOT NULL,
  `lang_name` varchar(155) NOT NULL,
  `active` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `language`
--

INSERT INTO `language` (`id`, `lang`, `lang_name`, `active`) VALUES
(1, 'tr', 'Türkçe', 1),
(2, 'en', 'İngilizce', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `product_category`
--

CREATE TABLE `product_category` (
  `c_id` int(1) NOT NULL,
  `c_name` varchar(45) NOT NULL,
  `c_active` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `product_category`
--

INSERT INTO `product_category` (`c_id`, `c_name`, `c_active`) VALUES
(1, 'Ürün Kategori Deneme 11', '1'),
(2, 'Ürün Kategori Deneme 2 - no Active', '1'),
(3, 'Ürün Kategori Deneme 3- no Active', '1');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `product_en`
--

CREATE TABLE `product_en` (
  `p_id` int(1) NOT NULL,
  `p_name` varchar(100) DEFAULT NULL,
  `p_active` enum('0','1') NOT NULL DEFAULT '0',
  `p_category` int(1) DEFAULT NULL,
  `p_price` float DEFAULT 0,
  `p_discount` float DEFAULT NULL,
  `p_percentage` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `product_en`
--

INSERT INTO `product_en` (`p_id`, `p_name`, `p_active`, `p_category`, `p_price`, `p_discount`, `p_percentage`) VALUES
(1, '', '1', 0, 0, 0, NULL),
(2, '', '1', 0, 0, 0, NULL),
(3, '', '1', 0, 0, 0, NULL),
(4, '', '0', 0, 0, 0, NULL),
(5, '', '1', 0, 0, 0, NULL),
(6, '', '1', 0, 0, 0, NULL),
(7, '', '1', 0, 0, 0, NULL),
(8, '', '1', 0, 0, 0, NULL),
(9, '', '1', 0, 0, 0, NULL),
(10, '', '1', 0, 0, 0, NULL);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `product_image`
--

CREATE TABLE `product_image` (
  `i_id` int(1) NOT NULL,
  `p_id` int(1) NOT NULL,
  `i_path` varchar(255) NOT NULL,
  `content` varchar(255) DEFAULT NULL,
  `sequence` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `product_image`
--

INSERT INTO `product_image` (`i_id`, `p_id`, `i_path`, `content`, `sequence`) VALUES
(13, 1, 'download-1.jpg', NULL, 0),
(14, 1, 'download.jpg', NULL, 0),
(15, 1, 'download-2.jpg', NULL, 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `product_tr`
--

CREATE TABLE `product_tr` (
  `p_id` int(1) NOT NULL,
  `p_name` varchar(100) NOT NULL,
  `p_active` enum('0','1') NOT NULL,
  `p_category` int(1) NOT NULL,
  `p_price` float NOT NULL,
  `p_discount` float DEFAULT NULL,
  `p_percentage` float DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `product_tr`
--

INSERT INTO `product_tr` (`p_id`, `p_name`, `p_active`, `p_category`, `p_price`, `p_discount`, `p_percentage`) VALUES
(1, 'Deneme Ürünü 1', '1', 0, 0, 0, 0),
(2, 'Inactive - Deneme 11', '0', 1, 0, 155, 0),
(3, 'Deneme IN AC', '0', 3, 123123, 0, 0),
(4, 'Deneme IN AC', '0', 3, 123123, 0, 0),
(5, 'Deneme 11', '1', 1, 123, 0, 0),
(6, 'Deneme 12', '1', 0, 123, 12, 0),
(7, 'Deneme 13', '1', 0, 123, 12, 0),
(8, 'Deneme 14', '1', 0, 123, 12, 0),
(9, 'Deneme 15', '1', 0, 123, 12, 0),
(10, 'Deneme 16', '1', 0, 123, 12, 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `tables`
--

CREATE TABLE `tables` (
  `t_id` int(11) NOT NULL,
  `t_category` int(1) NOT NULL,
  `t_name` varchar(255) NOT NULL,
  `t_number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `tables`
--

INSERT INTO `tables` (`t_id`, `t_category`, `t_name`, `t_number`) VALUES
(1, 7, 'Mehmet', 1),
(4, 6, 'Deneme 1silincek', 2),
(5, 7, 'Deneme 1', 3),
(6, 7, 'Deneme 1', 3),
(7, 7, 'Deneme 1', 4),
(8, 8, 'Deneme 1', 5),
(9, 7, 'Deneme 1', 6),
(10, 7, 'Deneme12', 22),
(11, 7, 'Deneme12', 23);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `tables_category`
--

CREATE TABLE `tables_category` (
  `c_id` int(11) NOT NULL,
  `c_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `tables_category`
--

INSERT INTO `tables_category` (`c_id`, `c_name`) VALUES
(7, 'Kategori 6'),
(8, 'Kategori 7'),
(9, 'Kategori 8');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

CREATE TABLE `users` (
  `userid` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(80) NOT NULL,
  `f_name` varchar(50) NOT NULL,
  `f_tel` varchar(12) NOT NULL,
  `f_eposta` varchar(32) NOT NULL,
  `f_tc` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`userid`, `username`, `password`, `f_name`, `f_tel`, `f_eposta`, `f_tc`) VALUES
(1, 'mcan', '$2y$10$O28BdVYYUXc9XSiafdZO3eVtunaJ0EZIre0BktUYoZs6VuYggqTJK', '', '', '', '');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `language`
--
ALTER TABLE `language`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `product_category`
--
ALTER TABLE `product_category`
  ADD PRIMARY KEY (`c_id`);

--
-- Tablo için indeksler `product_en`
--
ALTER TABLE `product_en`
  ADD PRIMARY KEY (`p_id`);

--
-- Tablo için indeksler `product_image`
--
ALTER TABLE `product_image`
  ADD PRIMARY KEY (`i_id`);

--
-- Tablo için indeksler `product_tr`
--
ALTER TABLE `product_tr`
  ADD PRIMARY KEY (`p_id`);

--
-- Tablo için indeksler `tables`
--
ALTER TABLE `tables`
  ADD PRIMARY KEY (`t_id`);

--
-- Tablo için indeksler `tables_category`
--
ALTER TABLE `tables_category`
  ADD PRIMARY KEY (`c_id`);

--
-- Tablo için indeksler `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `language`
--
ALTER TABLE `language`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tablo için AUTO_INCREMENT değeri `product_category`
--
ALTER TABLE `product_category`
  MODIFY `c_id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tablo için AUTO_INCREMENT değeri `product_en`
--
ALTER TABLE `product_en`
  MODIFY `p_id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Tablo için AUTO_INCREMENT değeri `product_image`
--
ALTER TABLE `product_image`
  MODIFY `i_id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Tablo için AUTO_INCREMENT değeri `product_tr`
--
ALTER TABLE `product_tr`
  MODIFY `p_id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Tablo için AUTO_INCREMENT değeri `tables`
--
ALTER TABLE `tables`
  MODIFY `t_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Tablo için AUTO_INCREMENT değeri `tables_category`
--
ALTER TABLE `tables_category`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Tablo için AUTO_INCREMENT değeri `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
