-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 22, 2025 at 12:37 PM
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
-- Database: `predictor_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `leagues`
--

CREATE TABLE `leagues` (
  `league_id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `join_code` varchar(8) NOT NULL,
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `leagues`
--

INSERT INTO `leagues` (`league_id`, `name`, `join_code`, `created_by`) VALUES
(1, 'test league', 'ed0c4855', 1),
(3, 'This is the maximumLength', '7dade756', 1),
(4, 'Martin Mayhem', '2da31f4d', 1);

-- --------------------------------------------------------

--
-- Table structure for table `matches`
--

CREATE TABLE `matches` (
  `match_id` int(11) NOT NULL,
  `gameweek` int(11) NOT NULL,
  `home_team` varchar(100) NOT NULL,
  `away_team` varchar(100) NOT NULL,
  `home_score` int(11) DEFAULT NULL,
  `away_score` int(11) DEFAULT NULL,
  `home_league_position` int(11) DEFAULT NULL,
  `away_league_position` int(11) DEFAULT NULL,
  `home_league_form` varchar(10) DEFAULT NULL,
  `away_league_form` varchar(10) DEFAULT NULL,
  `match_date` datetime DEFAULT NULL,
  `league_code` varchar(10) DEFAULT NULL,
  `completed` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `matches`
--

INSERT INTO `matches` (`match_id`, `gameweek`, `home_team`, `away_team`, `home_score`, `away_score`, `home_league_position`, `away_league_position`, `home_league_form`, `away_league_form`, `match_date`, `league_code`, `completed`) VALUES
(2, 35, 'Manchester City FC', 'Wolverhampton Wanderers FC', 1, 0, 3, 13, NULL, NULL, '2025-05-02 20:00:00', 'PL', 1),
(3, 35, 'Aston Villa FC', 'Fulham FC', 1, 0, 7, 11, NULL, NULL, '2025-05-03 12:30:00', 'PL', 1),
(4, 35, 'Everton FC', 'Ipswich Town FC', 2, 2, 14, 18, NULL, NULL, '2025-05-03 15:00:00', 'PL', 1),
(5, 35, 'Leicester City FC', 'Southampton FC', 2, 0, 19, 20, NULL, NULL, '2025-05-03 15:00:00', 'PL', 1),
(6, 35, 'Arsenal FC', 'AFC Bournemouth', 1, 2, 2, 8, NULL, NULL, '2025-05-03 17:30:00', 'PL', 1),
(7, 35, 'Brentford FC', 'Manchester United FC', 4, 3, 9, 15, NULL, NULL, '2025-05-04 14:00:00', 'PL', 1),
(8, 35, 'Brighton & Hove Albion FC', 'Newcastle United FC', 1, 1, 10, 4, NULL, NULL, '2025-05-04 14:00:00', 'PL', 1),
(9, 35, 'West Ham United FC', 'Tottenham Hotspur FC', 1, 1, 17, 16, NULL, NULL, '2025-05-04 14:00:00', 'PL', 1),
(10, 35, 'Chelsea FC', 'Liverpool FC', 3, 1, 5, 1, NULL, NULL, '2025-05-04 16:30:00', 'PL', 1),
(11, 35, 'Crystal Palace FC', 'Nottingham Forest FC', 1, 1, 12, 6, NULL, NULL, '2025-05-05 20:00:00', 'PL', 1),
(22, 34, 'Manchester City FC', 'Aston Villa FC', 2, 1, 3, 7, NULL, NULL, '2025-04-22 20:00:00', 'PL', 1),
(23, 34, 'Arsenal FC', 'Crystal Palace FC', 2, 2, 2, 12, NULL, NULL, '2025-04-23 20:00:00', 'PL', 1),
(24, 34, 'Chelsea FC', 'Everton FC', 1, 0, 5, 14, NULL, NULL, '2025-04-26 12:30:00', 'PL', 1),
(25, 34, 'Brighton & Hove Albion FC', 'West Ham United FC', 3, 2, 10, 17, NULL, NULL, '2025-04-26 15:00:00', 'PL', 1),
(26, 34, 'Newcastle United FC', 'Ipswich Town FC', 3, 0, 4, 18, NULL, NULL, '2025-04-26 15:00:00', 'PL', 1),
(27, 34, 'Southampton FC', 'Fulham FC', 1, 2, 20, 11, NULL, NULL, '2025-04-26 15:00:00', 'PL', 1),
(28, 34, 'Wolverhampton Wanderers FC', 'Leicester City FC', 3, 0, 13, 19, NULL, NULL, '2025-04-26 15:00:00', 'PL', 1),
(29, 34, 'AFC Bournemouth', 'Manchester United FC', 1, 1, 8, 15, NULL, NULL, '2025-04-27 14:00:00', 'PL', 1),
(30, 34, 'Liverpool FC', 'Tottenham Hotspur FC', 5, 1, 1, 16, NULL, NULL, '2025-04-27 16:30:00', 'PL', 1),
(31, 34, 'Nottingham Forest FC', 'Brentford FC', 0, 2, 6, 9, NULL, NULL, '2025-05-01 19:30:00', 'PL', 1),
(62, 3, 'Arsenal FC', 'Brighton & Hove Albion FC', NULL, NULL, 2, 10, NULL, NULL, '2024-08-31 12:30:00', 'PL', 0),
(63, 3, 'Brentford FC', 'Southampton FC', NULL, NULL, 9, 20, NULL, NULL, '2024-08-31 15:00:00', 'PL', 0),
(64, 3, 'Everton FC', 'AFC Bournemouth', NULL, NULL, 14, 8, NULL, NULL, '2024-08-31 15:00:00', 'PL', 0),
(65, 3, 'Ipswich Town FC', 'Fulham FC', NULL, NULL, 18, 11, NULL, NULL, '2024-08-31 15:00:00', 'PL', 0),
(66, 3, 'Leicester City FC', 'Aston Villa FC', NULL, NULL, 19, 7, NULL, NULL, '2024-08-31 15:00:00', 'PL', 0),
(67, 3, 'Nottingham Forest FC', 'Wolverhampton Wanderers FC', NULL, NULL, 6, 13, NULL, NULL, '2024-08-31 15:00:00', 'PL', 0),
(68, 3, 'West Ham United FC', 'Manchester City FC', NULL, NULL, 17, 3, NULL, NULL, '2024-08-31 17:30:00', 'PL', 0),
(69, 3, 'Chelsea FC', 'Crystal Palace FC', NULL, NULL, 5, 12, NULL, NULL, '2024-09-01 13:30:00', 'PL', 0),
(70, 3, 'Newcastle United FC', 'Tottenham Hotspur FC', NULL, NULL, 4, 16, NULL, NULL, '2024-09-01 13:30:00', 'PL', 0),
(71, 3, 'Manchester United FC', 'Liverpool FC', NULL, NULL, 15, 1, NULL, NULL, '2024-09-01 16:00:00', 'PL', 0),
(72, 37, 'Aston Villa FC', 'Tottenham Hotspur FC', 2, 0, 6, 17, NULL, NULL, '2025-05-16 19:30:00', 'PL', 1),
(73, 37, 'Chelsea FC', 'Manchester United FC', 1, 0, 5, 16, NULL, NULL, '2025-05-16 20:15:00', 'PL', 1),
(74, 37, 'Everton FC', 'Southampton FC', 2, 0, 13, 20, NULL, NULL, '2025-05-18 12:00:00', 'PL', 1),
(75, 37, 'West Ham United FC', 'Nottingham Forest FC', 1, 2, 15, 7, NULL, NULL, '2025-05-18 14:15:00', 'PL', 1),
(76, 37, 'Brentford FC', 'Fulham FC', 2, 3, 8, 11, NULL, NULL, '2025-05-18 15:00:00', 'PL', 1),
(77, 37, 'Leicester City FC', 'Ipswich Town FC', 2, 0, 19, 18, NULL, NULL, '2025-05-18 15:00:00', 'PL', 1),
(78, 37, 'Arsenal FC', 'Newcastle United FC', 1, 0, 2, 3, NULL, NULL, '2025-05-18 16:30:00', 'PL', 1),
(79, 37, 'Brighton & Hove Albion FC', 'Liverpool FC', 3, 2, 9, 1, NULL, NULL, '2025-05-19 20:00:00', 'PL', 1),
(80, 37, 'Crystal Palace FC', 'Wolverhampton Wanderers FC', 4, 2, 12, 14, NULL, NULL, '2025-05-20 20:00:00', 'PL', 1),
(81, 37, 'Manchester City FC', 'AFC Bournemouth', 3, 1, 4, 10, NULL, NULL, '2025-05-20 20:00:00', 'PL', 1),
(82, 36, 'Fulham FC', 'Everton FC', 1, 3, 11, 13, NULL, NULL, '2025-05-10 15:00:00', 'PL', 1),
(83, 36, 'Ipswich Town FC', 'Brentford FC', 0, 1, 18, 8, NULL, NULL, '2025-05-10 15:00:00', 'PL', 1),
(84, 36, 'Southampton FC', 'Manchester City FC', 0, 0, 20, 4, NULL, NULL, '2025-05-10 15:00:00', 'PL', 1),
(85, 36, 'Wolverhampton Wanderers FC', 'Brighton & Hove Albion FC', 0, 2, 14, 9, NULL, NULL, '2025-05-10 15:00:00', 'PL', 1),
(86, 36, 'AFC Bournemouth', 'Aston Villa FC', 0, 1, 10, 6, NULL, NULL, '2025-05-10 17:30:00', 'PL', 1),
(87, 36, 'Newcastle United FC', 'Chelsea FC', 2, 0, 3, 5, NULL, NULL, '2025-05-11 12:00:00', 'PL', 1),
(88, 36, 'Manchester United FC', 'West Ham United FC', 0, 2, 16, 15, NULL, NULL, '2025-05-11 14:15:00', 'PL', 1),
(89, 36, 'Nottingham Forest FC', 'Leicester City FC', 2, 2, 7, 19, NULL, NULL, '2025-05-11 14:15:00', 'PL', 1),
(90, 36, 'Tottenham Hotspur FC', 'Crystal Palace FC', 0, 2, 17, 12, NULL, NULL, '2025-05-11 14:15:00', 'PL', 1),
(91, 36, 'Liverpool FC', 'Arsenal FC', 2, 2, 1, 2, NULL, NULL, '2025-05-11 16:30:00', 'PL', 1),
(92, 38, 'AFC Bournemouth', 'Leicester City FC', NULL, NULL, 11, 18, NULL, NULL, '2025-05-25 16:00:00', 'PL', 0),
(93, 38, 'Fulham FC', 'Manchester City FC', NULL, NULL, 10, 3, NULL, NULL, '2025-05-25 16:00:00', 'PL', 0),
(94, 38, 'Ipswich Town FC', 'West Ham United FC', NULL, NULL, 19, 15, NULL, NULL, '2025-05-25 16:00:00', 'PL', 0),
(95, 38, 'Liverpool FC', 'Crystal Palace FC', NULL, NULL, 1, 12, NULL, NULL, '2025-05-25 16:00:00', 'PL', 0),
(96, 38, 'Manchester United FC', 'Aston Villa FC', NULL, NULL, 16, 6, NULL, NULL, '2025-05-25 16:00:00', 'PL', 0),
(97, 38, 'Newcastle United FC', 'Everton FC', NULL, NULL, 4, 13, NULL, NULL, '2025-05-25 16:00:00', 'PL', 0),
(98, 38, 'Nottingham Forest FC', 'Chelsea FC', NULL, NULL, 7, 5, NULL, NULL, '2025-05-25 16:00:00', 'PL', 0),
(99, 38, 'Southampton FC', 'Arsenal FC', NULL, NULL, 20, 2, NULL, NULL, '2025-05-25 16:00:00', 'PL', 0),
(100, 38, 'Tottenham Hotspur FC', 'Brighton & Hove Albion FC', NULL, NULL, 17, 8, NULL, NULL, '2025-05-25 16:00:00', 'PL', 0),
(101, 38, 'Wolverhampton Wanderers FC', 'Brentford FC', NULL, NULL, 14, 9, NULL, NULL, '2025-05-25 16:00:00', 'PL', 0);

-- --------------------------------------------------------

--
-- Table structure for table `predictions`
--

CREATE TABLE `predictions` (
  `prediction_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `match_id` int(11) NOT NULL,
  `predicted_home_score` int(11) DEFAULT NULL,
  `predicted_away_score` int(11) DEFAULT NULL,
  `points_earned` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `predictions`
--

INSERT INTO `predictions` (`prediction_id`, `user_id`, `match_id`, `predicted_home_score`, `predicted_away_score`, `points_earned`) VALUES
(1, 1, 0, NULL, NULL, 0),
(2, 1, 2, 1, 0, 10),
(3, 1, 3, 1, 0, 10),
(4, 1, 4, 3, 3, 6),
(5, 1, 5, 2, 1, 3),
(6, 1, 6, 1, 1, 0),
(7, 1, 7, 0, 1, 0),
(8, 1, 8, 1, 1, 10),
(9, 1, 9, 0, 0, 6),
(10, 1, 10, 2, 1, 3),
(11, 1, 11, 0, 2, 0),
(12, 2, 2, 1, 0, 10),
(13, 2, 3, 1, 0, 10),
(14, 2, 4, 2, 2, 10),
(15, 2, 5, 2, 0, 10),
(16, 2, 6, 1, 2, 10),
(17, 2, 7, 4, 3, 10),
(18, 2, 8, 1, 1, 10),
(19, 2, 9, 1, 1, 10),
(20, 2, 10, 1, 1, 0),
(21, 2, 11, 1, 1, 10),
(27, 3, 2, 0, 0, 0),
(28, 3, 3, 0, 0, 0),
(29, 3, 4, 0, 0, 6),
(30, 3, 5, 0, 0, 0),
(31, 3, 6, 0, 0, 0),
(32, 3, 7, 0, 0, 0),
(33, 3, 8, 0, 0, 6),
(34, 3, 9, 0, 0, 6),
(35, 3, 10, 0, 0, 0),
(36, 3, 11, 0, 0, 6),
(42, 4, 2, 1, 0, 10),
(43, 4, 3, 1, 2, 0),
(44, 4, 4, 2, 2, 10),
(45, 4, 5, 0, 0, 0),
(46, 4, 6, 0, 0, 0),
(47, 4, 7, 0, 0, 0),
(48, 4, 8, 0, 0, 6),
(49, 4, 9, 0, 0, 6),
(50, 4, 10, 0, 0, 0),
(51, 4, 11, 0, 0, 6),
(97, 1, 22, 1, 1, 0),
(98, 2, 22, 1, 0, 6),
(99, 3, 22, 1, 1, 0),
(100, 4, 22, 2, 1, 10),
(101, 1, 23, 2, 0, 0),
(102, 2, 23, 1, 0, 0),
(103, 3, 23, 1, 1, 6),
(104, 4, 23, 0, 0, 6),
(105, 1, 24, 1, 0, 10),
(106, 2, 24, 1, 0, 10),
(107, 3, 24, 1, 1, 0),
(108, 4, 24, 0, 0, 0),
(109, 1, 25, 1, 0, 6),
(110, 2, 25, 3, 2, 10),
(111, 3, 25, 1, 1, 0),
(112, 4, 25, 0, 0, 0),
(113, 1, 26, 4, 0, 3),
(114, 2, 26, 3, 0, 10),
(115, 3, 26, 1, 1, 0),
(116, 4, 26, 0, 0, 0),
(117, 1, 27, 1, 2, 10),
(118, 2, 27, 1, 2, 10),
(119, 3, 27, 1, 1, 0),
(120, 4, 27, 0, 0, 0),
(121, 1, 28, 1, 1, 0),
(122, 2, 28, 3, 0, 10),
(123, 3, 28, 1, 1, 0),
(124, 4, 28, 0, 0, 0),
(125, 1, 29, 1, 0, 0),
(126, 2, 29, 1, 1, 10),
(127, 3, 29, 1, 1, 10),
(128, 4, 29, 0, 0, 6),
(129, 1, 30, 4, 0, 6),
(130, 2, 30, 5, 1, 10),
(131, 3, 30, 1, 1, 0),
(132, 4, 30, 0, 0, 0),
(133, 1, 31, 0, 2, 10),
(134, 2, 31, 0, 2, 10),
(135, 3, 31, 1, 1, 0),
(136, 4, 31, 0, 0, 0),
(297, 1, 62, NULL, NULL, 0),
(298, 2, 62, NULL, NULL, 0),
(299, 3, 62, NULL, NULL, 0),
(300, 4, 62, NULL, NULL, 0),
(301, 1, 63, NULL, NULL, 0),
(302, 2, 63, NULL, NULL, 0),
(303, 3, 63, NULL, NULL, 0),
(304, 4, 63, NULL, NULL, 0),
(305, 1, 64, NULL, NULL, 0),
(306, 2, 64, NULL, NULL, 0),
(307, 3, 64, NULL, NULL, 0),
(308, 4, 64, NULL, NULL, 0),
(309, 1, 65, NULL, NULL, 0),
(310, 2, 65, NULL, NULL, 0),
(311, 3, 65, NULL, NULL, 0),
(312, 4, 65, NULL, NULL, 0),
(313, 1, 66, NULL, NULL, 0),
(314, 2, 66, NULL, NULL, 0),
(315, 3, 66, NULL, NULL, 0),
(316, 4, 66, NULL, NULL, 0),
(317, 1, 67, NULL, NULL, 0),
(318, 2, 67, NULL, NULL, 0),
(319, 3, 67, NULL, NULL, 0),
(320, 4, 67, NULL, NULL, 0),
(321, 1, 68, NULL, NULL, 0),
(322, 2, 68, NULL, NULL, 0),
(323, 3, 68, NULL, NULL, 0),
(324, 4, 68, NULL, NULL, 0),
(325, 1, 69, NULL, NULL, 0),
(326, 2, 69, NULL, NULL, 0),
(327, 3, 69, NULL, NULL, 0),
(328, 4, 69, NULL, NULL, 0),
(329, 1, 70, NULL, NULL, 0),
(330, 2, 70, NULL, NULL, 0),
(331, 3, 70, NULL, NULL, 0),
(332, 4, 70, NULL, NULL, 0),
(333, 1, 71, NULL, NULL, 0),
(334, 2, 71, NULL, NULL, 0),
(335, 3, 71, NULL, NULL, 0),
(336, 4, 71, NULL, NULL, 0),
(337, 1, 72, 2, 0, 10),
(338, 2, 72, 2, 0, 10),
(339, 3, 72, 1, 1, 0),
(340, 4, 72, 0, 0, 0),
(341, 1, 73, 1, 1, 0),
(342, 2, 73, 1, 0, 10),
(343, 3, 73, 1, 1, 0),
(344, 4, 73, 0, 0, 0),
(345, 1, 74, 0, 0, 0),
(346, 2, 74, 2, 0, 10),
(347, 3, 74, 0, 1, 0),
(348, 4, 74, 0, 0, 0),
(349, 1, 75, 1, 2, 10),
(350, 2, 75, 1, 2, 10),
(351, 3, 75, 2, 0, 0),
(352, 4, 75, 0, 0, 0),
(353, 1, 76, 1, 1, 0),
(354, 2, 76, 2, 3, 10),
(355, 3, 76, 1, 5, 3),
(356, 4, 76, 0, 0, 0),
(357, 1, 77, 0, 0, 0),
(358, 2, 77, 2, 0, 10),
(359, 3, 77, 1, 2, 0),
(360, 4, 77, 0, 0, 0),
(361, 1, 78, 1, 0, 10),
(362, 2, 78, 1, 0, 10),
(363, 3, 78, 0, 1, 0),
(364, 4, 78, 0, 0, 0),
(365, 1, 79, 3, 2, 10),
(366, 2, 79, 2, 3, 0),
(367, 3, 79, 1, 0, 6),
(368, 4, 79, 0, 0, 0),
(369, 1, 80, 1, 1, 0),
(370, 2, 80, 4, 2, 10),
(371, 3, 80, 1, 1, 0),
(372, 4, 80, 0, 0, 0),
(373, 1, 81, 1, 0, 3),
(374, 2, 81, 2, 0, 6),
(375, 3, 81, 1, 1, 0),
(376, 4, 81, 0, 0, 0),
(377, 1, 82, 1, 1, 0),
(378, 2, 82, 1, 2, 3),
(379, 3, 82, NULL, NULL, 0),
(380, 4, 82, NULL, NULL, 0),
(381, 1, 83, 1, 1, 0),
(382, 2, 83, 0, 2, 3),
(383, 3, 83, NULL, NULL, 0),
(384, 4, 83, NULL, NULL, 0),
(385, 1, 84, 1, 1, 6),
(386, 2, 84, 0, 0, 10),
(387, 3, 84, NULL, NULL, 0),
(388, 4, 84, NULL, NULL, 0),
(389, 1, 85, 1, 1, 0),
(390, 2, 85, 0, 2, 10),
(391, 3, 85, NULL, NULL, 0),
(392, 4, 85, NULL, NULL, 0),
(393, 1, 86, 1, 1, 0),
(394, 2, 86, 0, 1, 10),
(395, 3, 86, NULL, NULL, 0),
(396, 4, 86, NULL, NULL, 0),
(397, 1, 87, 1, 1, 0),
(398, 2, 87, 2, 0, 10),
(399, 3, 87, NULL, NULL, 0),
(400, 4, 87, NULL, NULL, 0),
(401, 1, 88, 1, 1, 0),
(402, 2, 88, 0, 2, 10),
(403, 3, 88, NULL, NULL, 0),
(404, 4, 88, NULL, NULL, 0),
(405, 1, 89, 1, 1, 6),
(406, 2, 89, 2, 2, 10),
(407, 3, 89, NULL, NULL, 0),
(408, 4, 89, NULL, NULL, 0),
(409, 1, 90, 1, 1, 0),
(410, 2, 90, 0, 2, 10),
(411, 3, 90, NULL, NULL, 0),
(412, 4, 90, NULL, NULL, 0),
(413, 1, 91, 1, 1, 6),
(414, 2, 91, 2, 2, 10),
(415, 3, 91, NULL, NULL, 0),
(416, 4, 91, NULL, NULL, 0),
(417, 1, 92, NULL, NULL, 0),
(418, 2, 92, NULL, NULL, 0),
(419, 3, 92, NULL, NULL, 0),
(420, 4, 92, NULL, NULL, 0),
(421, 1, 93, NULL, NULL, 0),
(422, 2, 93, NULL, NULL, 0),
(423, 3, 93, NULL, NULL, 0),
(424, 4, 93, NULL, NULL, 0),
(425, 1, 94, NULL, NULL, 0),
(426, 2, 94, NULL, NULL, 0),
(427, 3, 94, NULL, NULL, 0),
(428, 4, 94, NULL, NULL, 0),
(429, 1, 95, NULL, NULL, 0),
(430, 2, 95, NULL, NULL, 0),
(431, 3, 95, NULL, NULL, 0),
(432, 4, 95, NULL, NULL, 0),
(433, 1, 96, NULL, NULL, 0),
(434, 2, 96, NULL, NULL, 0),
(435, 3, 96, NULL, NULL, 0),
(436, 4, 96, NULL, NULL, 0),
(437, 1, 97, NULL, NULL, 0),
(438, 2, 97, NULL, NULL, 0),
(439, 3, 97, NULL, NULL, 0),
(440, 4, 97, NULL, NULL, 0),
(441, 1, 98, NULL, NULL, 0),
(442, 2, 98, NULL, NULL, 0),
(443, 3, 98, NULL, NULL, 0),
(444, 4, 98, NULL, NULL, 0),
(445, 1, 99, NULL, NULL, 0),
(446, 2, 99, NULL, NULL, 0),
(447, 3, 99, NULL, NULL, 0),
(448, 4, 99, NULL, NULL, 0),
(449, 1, 100, NULL, NULL, 0),
(450, 2, 100, NULL, NULL, 0),
(451, 3, 100, NULL, NULL, 0),
(452, 4, 100, NULL, NULL, 0),
(453, 1, 101, NULL, NULL, 0),
(454, 2, 101, NULL, NULL, 0),
(455, 3, 101, NULL, NULL, 0),
(456, 4, 101, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `account_type` enum('admin','user') DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`, `created_at`, `account_type`) VALUES
(1, 'admin', 'admin@admin.com', '$2y$10$G85wc89ZGZsIeYjSNh0FMemL72oeC.oWvhXVtUM0K3Uz5SDpU6xmW', '2025-05-07 18:24:39', 'admin'),
(2, 'user a', 'a@a.com', '$2y$10$sLowTGew2s/fFHfKgxmVE.gJQMSGi0f3AiswmzLLsXXJPWI8O4b1q', '2025-05-07 18:30:10', 'user'),
(3, 'user b', 'b@b.com', '$2y$10$eYRukW08edkxBDSDeXK9W.iwpRI3oHWdAiYIVleZpE57myoS86uW.', '2025-05-07 18:31:25', 'user'),
(4, 'user c', 'c@c.com', '$2y$10$4axOY6/GsNPRcurxHn5Wn.N0plHNTg3Y/dvcIMVbQHfEWjKy.C6ci', '2025-05-07 18:32:18', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `user_leagues`
--

CREATE TABLE `user_leagues` (
  `user_id` int(11) NOT NULL,
  `league_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_leagues`
--

INSERT INTO `user_leagues` (`user_id`, `league_id`) VALUES
(1, 1),
(1, 3),
(2, 1),
(3, 1),
(4, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `leagues`
--
ALTER TABLE `leagues`
  ADD PRIMARY KEY (`league_id`),
  ADD UNIQUE KEY `join_code` (`join_code`);

--
-- Indexes for table `matches`
--
ALTER TABLE `matches`
  ADD PRIMARY KEY (`match_id`);

--
-- Indexes for table `predictions`
--
ALTER TABLE `predictions`
  ADD PRIMARY KEY (`prediction_id`),
  ADD UNIQUE KEY `unique_user_match` (`user_id`,`match_id`),
  ADD KEY `match_id` (`match_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_leagues`
--
ALTER TABLE `user_leagues`
  ADD PRIMARY KEY (`user_id`,`league_id`),
  ADD KEY `league_id` (`league_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `leagues`
--
ALTER TABLE `leagues`
  MODIFY `league_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `matches`
--
ALTER TABLE `matches`
  MODIFY `match_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `predictions`
--
ALTER TABLE `predictions`
  MODIFY `prediction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=457;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `predictions`
--
ALTER TABLE `predictions`
  ADD CONSTRAINT `predictions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `predictions_ibfk_2` FOREIGN KEY (`match_id`) REFERENCES `matches` (`match_id`) ON DELETE CASCADE;

--
-- Constraints for table `user_leagues`
--
ALTER TABLE `user_leagues`
  ADD CONSTRAINT `user_leagues_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_leagues_ibfk_2` FOREIGN KEY (`league_id`) REFERENCES `leagues` (`league_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
