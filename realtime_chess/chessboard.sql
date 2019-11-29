-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- 생성 시간: 19-11-29 05:50
-- 서버 버전: 10.4.8-MariaDB
-- PHP 버전: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 데이터베이스: `chess`
--

-- --------------------------------------------------------

--
-- 테이블 구조 `chessboard`
--

CREATE TABLE `chessboard` (
  `whiterook` text NOT NULL,
  `whitebishop` text NOT NULL,
  `whiteknight` text NOT NULL,
  `whiteking` text NOT NULL,
  `whitequeen` text NOT NULL,
  `whitepawn` text NOT NULL,
  `blackrook` text NOT NULL,
  `blackbishop` text NOT NULL,
  `blackknight` text NOT NULL,
  `blackking` text NOT NULL,
  `blackqueen` text NOT NULL,
  `blackpawn` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 테이블의 덤프 데이터 `chessboard`
--

INSERT INTO `chessboard` (`whiterook`, `whitebishop`, `whiteknight`, `whiteking`, `whitequeen`, `whitepawn`, `blackrook`, `blackbishop`, `blackknight`, `blackking`, `blackqueen`, `blackpawn`) VALUES
('0,7', '2,5', '1,6', '4', '3', '8,9,10,11,12,13,14,15', '56,63', '58,61', '57,62', '60', '59', '37,48,49,50,51,52,54,55');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
