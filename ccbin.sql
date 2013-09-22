SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ccbin`
--
CREATE DATABASE IF NOT EXISTS `ccbin` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `ccbin`;

-- --------------------------------------------------------

--
-- Table structure for table `pastes`
--

CREATE TABLE IF NOT EXISTS `pastes` (
  `id` char(6) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `name` char(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contents` text COLLATE utf8_unicode_ci,
  `owner` text COLLATE utf8_unicode_ci NOT NULL,
  `time` longtext COLLATE utf8_unicode_ci NOT NULL,
  `privacy` char(8) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `uid` text COLLATE utf8_unicode_ci NOT NULL,
  `username` text COLLATE utf8_unicode_ci NOT NULL,
  `email` text COLLATE utf8_unicode_ci NOT NULL,
  `password` text COLLATE utf8_unicode_ci NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;