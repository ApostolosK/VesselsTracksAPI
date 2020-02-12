-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Φιλοξενητής: localhost:3306
-- Χρόνος δημιουργίας: 09 Φεβ 2020 στις 11:24:47
-- Έκδοση διακομιστή: 8.0.18
-- Έκδοση PHP: 7.3.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Βάση δεδομένων: `vesseltracks`
--

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `vesseltracks`
--

CREATE TABLE `vesseltracks` (
  `id_track` int(6) NOT NULL,
  `mmsi` bigint(20) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `station` tinyint(4) NOT NULL,
  `speed` tinyint(4) NOT NULL,
  `lon` varchar(50) NOT NULL,
  `lat` varchar(50) NOT NULL,
  `course` tinyint(4) NOT NULL,
  `heading` tinyint(4) NOT NULL,
  `rot` varchar(150) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Ευρετήρια για άχρηστους πίνακες
--

--
-- Ευρετήρια για πίνακα `vesseltracks`
--
ALTER TABLE `vesseltracks`
  ADD PRIMARY KEY (`id_track`),
  ADD UNIQUE KEY `mmsi` (`mmsi`);

--
-- AUTO_INCREMENT για άχρηστους πίνακες
--

--
-- AUTO_INCREMENT για πίνακα `vesseltracks`
--
ALTER TABLE `vesseltracks`
  MODIFY `id_track` int(6) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
