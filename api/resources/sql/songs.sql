-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 16 nov 2021 om 19:29
-- Serverversie: 10.4.19-MariaDB
-- PHP-versie: 8.0.7

SET
SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET
time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `artists`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `songs`
--
--
-- CREATE TABLE `songs` (
--   `id` bigint(20) UNSIGNED NOT NULL,
--   `songName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
--   `releaseDate` date NOT NULL,
--   `songTime` double NOT NULL,
--   `artistId` bigint(20) UNSIGNED NOT NULL,
--   `created_at` timestamp NULL DEFAULT NULL,
--   `updated_at` timestamp NULL DEFAULT NULL
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `songs`
--
INSERT INTO `artists` (`id`, `firstName`, `middleName`, `lastName`, `artistsName`, `totalSongs`, `favorite`, `birthDay`,`created_at`, `updated_at`)
VALUES (2, 'Calvin', NULL, 'Harris', 'Calvin Harris', 1, 0, '1984-01-17', NULL, '2021-11-16 17:08:35'),
       (4, 'Martijn Gerard Garritsen', NULL, 'Garritsen', 'Martin Garrix', 3, 1, '1996-05-14', NULL,
        '2021-11-16 17:08:39');
INSERT INTO `songs` (`id`, `songName`, `releaseDate`, `songTime`, `artistId`, `created_at`, `updated_at`)
VALUES (2, 'High on Life', '2018-07-29', 3.5, 4, NULL, NULL),
       (3, 'Summer Days', '2019-04-25', 2.43, 4, NULL, NULL),
       (4, 'Used to Love', '2019-10-31', 3.56, 4, '2021-11-16 17:05:52', '2021-11-16 17:05:52'),
       (5, 'Feels', '2017-06-17', 3.42, 2, '2021-11-16 17:08:18', '2021-11-16 17:09:40');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `songs`
--
ALTER TABLE `songs`
    ADD PRIMARY KEY (`id`),
  ADD KEY `songs_artistid_foreign` (`artistId`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `songs`
--
ALTER TABLE `songs`
    MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `songs`
--
ALTER TABLE `songs`
    ADD CONSTRAINT `songs_artistid_foreign` FOREIGN KEY (`artistId`) REFERENCES `artists` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
