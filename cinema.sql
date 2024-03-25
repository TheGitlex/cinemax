-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 25, 2024 at 04:07 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cinema`
--

-- --------------------------------------------------------

--
-- Table structure for table `discounts`
--

CREATE TABLE `discounts` (
  `id_discount` int(3) NOT NULL,
  `code` varchar(10) NOT NULL,
  `amount` int(3) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `uses` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `discounts`
--

INSERT INTO `discounts` (`id_discount`, `code`, `amount`, `active`, `uses`) VALUES
(1, 'ABVC', 20, 0, 0),
(2, 'AAAA', 76, 0, 3),
(3, 'GVDS', 10, 1, 0),
(4, 'ABCD', 10, 1, 0),
(5, 'EFGH', 10, 0, 0),
(6, 'IJKL', 20, 1, 0),
(7, 'MNOP', 25, 1, 0),
(8, 'QRST', 35, 0, 0),
(9, 'UVWX', 40, 1, 0),
(10, 'YZAB', 50, 1, 0),
(11, 'ALEX', 100, 0, 0),
(12, 'SECRET', 99, 0, 1),
(15, 'FDSG', 30, 1, 0),
(16, 'SUMMER', 5, 1, 0),
(18, 'XHGA', 5, 1, 0),
(19, 'BGER', 5, 1, 0),
(20, 'HGFJ', 5, 1, 0),
(21, 'LRCF', 5, 1, 0),
(22, 'MWTG', 5, 1, 0),
(23, 'RIYC', 34, 1, 0),
(24, 'AQOF', 10, 1, 0),
(25, 'OIQG', 57, 1, 0),
(26, 'YREK', 5, 1, 0),
(27, 'QKCN', 5, 1, 0),
(28, 'ZFZL', 5, 1, 0),
(29, 'YCOO', 5, 1, 0),
(30, 'MOHC', 5, 1, 0),
(31, 'RHDT', 5, 1, 0),
(32, 'AAAAA', 0, 0, 0),
(33, 'NWZJ', 5, 1, 0),
(34, 'NFZE', 5, 1, 0),
(35, 'SJOE', 5, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `halls`
--

CREATE TABLE `halls` (
  `id_hall` int(3) NOT NULL,
  `seats` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `halls`
--

INSERT INTO `halls` (`id_hall`, `seats`) VALUES
(1, 160),
(2, 112),
(3, 128),
(4, 144),
(5, 128),
(6, 112),
(7, 128),
(8, 144),
(9, 128),
(10, 112),
(11, 128),
(12, 144);

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `id_movie` int(5) NOT NULL,
  `title` varchar(50) NOT NULL,
  `release_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `genre` varchar(100) NOT NULL,
  `duration` int(3) DEFAULT NULL,
  `description` text NOT NULL,
  `director` varchar(40) NOT NULL,
  `trailer` varchar(30) NOT NULL,
  `icon` varchar(30) NOT NULL,
  `age_rating` int(2) NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`id_movie`, `title`, `release_date`, `genre`, `duration`, `description`, `director`, `trailer`, `icon`, `age_rating`, `active`) VALUES
(1, 'The Hunger Games: The Ballad of Songbirds & Snakes', '2023-11-17 21:06:41', 'Драма, Екшън, Научна фантастика', 167, '64 години преди да стане тираничния президент на Панем, Кориолан Сноу вижда шанс за промяна в съдбата, когато наставлява Луси Грей Бейрд, женската почит от Окръг 12.', 'Франсис Лорънс', 'NxW_X4kzeus', 'hungergames.png', 13, 1),
(2, 'Five Nights at Freddy\'s', '2023-10-26 21:00:00', 'Ужас, Мистерия', 150, 'Наскоро уволнен и отчаян за работа, проблемен млад мъж на име Майк се съгласява да заеме позиция като нощен охранител в изоставен тематичен ресторант: пицарията на Фреди Фазбер. Но скоро открива, че нищо във Фреди не е такова, каквото изглежда.', 'Ема Тами', 'X4d_v-HyR4o', 'fnaf.png', 13, 1),
(3, 'Spider-Man: Across the Spider-Verse', '2023-06-02 20:03:20', 'Анимация, Екшън, Приключение', 140, 'След като се събира отново с Гуен Стейси, Спайдърмен се катапултира из Мултивселената, където среща Обществото на паяците. Но когато героите се сблъскват с нова заплаха, Майлс се оказва изправен срещу другите Паяци и трябва да тръгне сам, за да спаси тези, които обича най-много.', 'Кемп Пауърс', 'yFrxzaBLDQM', 'spiderman.jpg', 6, 1),
(4, 'The Lorax', '2012-03-29 21:00:00', 'Анимация, Семеен', 86, '12-годишно момче търси единственото нещо, което ще му помогне да спечели обичта на момичето на мечтите си. За да го намери, той трябва да открие историята на Лоракс, мрънкащото, но очарователно създание, което се бори, за да защити своя свят.', 'Крис Рено', '1bHdzTUNw-4', 'lorax.jpg', 3, 1),
(7, 'Spider-Man: Into The Spider-Verse', '2018-02-11 22:00:00', 'Анимация, Екшън, Приключенски', 117, 'Майлс Моралес става Спайдър-Мен в своя реалност и среща колегите си от други измерения, за да спре заплаха за всички измерения.', 'Родни Ротман', 'g4Hbz2jLxvQ', 'spiderman2.jpg', 5, 1),
(8, 'Spider-Man: No Way Home', '2021-12-17 16:30:00', 'Екшън, Приключенски, Фантастика', 148, 'Спайдър-Мен: Не по пътя у дома следва Питър Паркър, докато той се съюзява с други версии на Спайдър-Мен от различни измерения, за да спре мощна заплаха, която може да унищожи цялата реалност.', 'Джон Уотс', 'rt-2cxAiPJk', 'nowayhome.jpg', 12, 1),
(9, 'Wonka', '2023-12-08 18:15:00', 'Приключенски, Комедия, Фентъзи', 120, 'Базиран на необикновения герой от „Чарли и шоколадовата фабрика“, една от най-популярните и обичани детски книги на Роалд Дал, „Уонка“ разказва невероятната история на това как прочутия изобретател, магьосник и шоколатиер  се е превърнал в така добре познатия и обичан Уили Уонка. ', 'Пол Кинг', 'wYmtRhKvmVE', 'wonka.jpg', 5, 0),
(10, 'Avengers: Endgame', '2019-04-26 18:00:00', 'Екшън, Приключенски, Фентъзи', 181, 'В кулминацията на Infinity Saga, Осветниците трябва да направят последната си станция в опит да овладеят лудата и могъща Thanos, който причинява хаос и разруха на цялата вселена.', 'Антъни Русо, Джо Русо', 'TcMBFSGVi1c', 'endgame.jpg', 12, 1),
(11, 'The Batman', '2022-03-01 17:30:00', 'Екшън, Криминален, Драма', 176, 'След събитията от \"Джокър\", Брус Уейн се изправя срещу новата заплаха в Готъм, известна като Ридър. Докато разкрива тайните на семейството Уейн, той също така разбира какво означава да бъдеш Батман.', 'Мат Рийвс', 'vc7_mH2PWHs', 'batman.jpg', 15, 1),
(12, 'Kung Fu Panda 4', '2024-03-07 22:00:00', 'Анимация, Екшън, Комедия', 94, 'По и приятелите му се връщат в ново приключение, където трябва да защитят Китай и кунг-фу от нова зла заплаха.', 'Майк Митчел', '_inKs4eeHiI', 'kung-fu-panda-4.jpg', 7, 1),
(13, 'Scream VI', '2023-10-20 17:15:00', 'Хорър, Мистерия', 123, 'Нова серия от събитията в града започва, когато мистериозен убиец започва да тероризира група от хора, които се връщат за нов кръг от страх и загадъчни събития.', 'Мат Бетинели-Олпин', 'h74AXqw4Opc', 'scream-6.jpg', 18, 1),
(14, 'Inside Out 2', '2024-06-13 21:00:00', 'Анимация, Семеен, Драма, Комедия', NULL, 'Централата на съзнанието на тийнейджърката Райли е подложена на внезапно разрушаване, за да освободи място за нещо напълно неочаквано: нови Емоции! Радост, тъга, гняв, страх и отвращение, които отдавна провеждат успешна операция по всички сметки, не са сигурни как да се почувстват, когато се появи безпокойство. И изглежда, че не е сама.', 'Келси Ман', 'VWavstJydZU', 'insideout2.jpg', 3, 1),
(15, 'Godzilla vs. Kong', '2021-03-25 22:00:00', 'Екшън, Фантастика', 114, 'Битката между два от най-големите титани, Годзила и Конг, е на преден план, докато те се сблъскват в епичен бой, който ще определи кой е наистина кралят на чудовищата.', 'Адам Уингард', 'odM92ap8_c0', 'godzilla.jpg', 12, 1),
(16, 'Oppenheimer', '2023-07-20 21:00:00', 'Драма, История', 181, 'Историята за ролята на Дж. Робърт Опенхаймер в разработването на атомната бомба по време на Втората световна война.', 'Кристофър Нолън', 'uYPbbksJxIg', 'oppenheimer.jpg', 14, 1),
(19, 'IT', '2023-11-16 22:00:00', 'Example Genre', 120, 'Example Description', 'Example Director', 'Example Trailer', 'it.gif', 0, 0),
(20, 'Saw XI', '2024-09-26 21:00:00', 'Хорър', 0, ' ', 'Example Director', 'Example Trailer', 'sawxi.jpg', 0, 1),
(21, 'Thanksgiving', '2023-11-16 22:00:00', 'Хорър, Мистерия, Трилър', 106, 'След като бунтът в Черния петък завършва трагично, мистериозен убиец, вдъхновен от Деня на благодарността, тероризира Плимут, Масачузетс - родното място на празника. Избирайки жителите един по един, това, което започва като случайни убийства за отмъщение, скоро се разкрива, че е част от по-голям, зловещ празничен план.', 'Ели Рот', 'KbU50SdL8zA', 'thanksgiving.jpg', 18, 1),
(22, 'Elemental', '2023-06-15 21:00:00', 'Анимация, Комедия, Семеен, Фентъзи', 102, 'В град, където обитателите на огъня, водата, земята и въздуха живеят заедно, пламенна млада жена и движещ се по течението човек ще открият нещо елементарно: колко общо имат помежду си.', 'Питър Сон', 'hXzcyx9V0xw', 'elemental.jpg', 6, 1),
(23, 'The Cow', '2024-05-04 21:00:00', 'cow', 260, 'the cow is cowing', 'Cow', 'AVAqGLtzVxQ', 'cow.gif', 10, 0),
(24, 'Avengers: Infinity War', '2023-11-16 22:00:00', 'Example Genre', 120, 'Example Description', 'Example Director', 'Example Trailer', 'avengers.gif', 0, 0),
(25, 'Looper', '2023-11-16 22:00:00', 'Example Genre', 120, 'Example Description', 'Example Director', 'Example Trailer', 'looper.gif', 0, 0),
(26, 'Aquaman', '2018-12-20 22:00:00', ' Екшън, Приключение, Фентъзи', 143, 'Някога дом на най-напредналата цивилизация на Земята, Атлантида сега е подводно кралство, управлявано от жадния за власт крал Орм. С огромна армия на свое разположение, Орм планира да завладее останалите океански хора и след това повърхностния свят. На пътя му стои Артър Къри, получовек-полуатлантски брат на Орм и истински наследник на трона.', 'Джеймс Уан', '2wcj6SrX4zw', 'aquaman.gif', 13, 1),
(27, 'Madagascar 2', '2023-11-16 22:00:00', 'Анимация', 120, 'Example Description', 'Example Director', 'Example Trailer', 'madagascar.gif', 0, 0),
(28, 'Tidal Wave', '2024-03-04 22:00:00', 'Horror', 120, 'The wave got tidal', 'Example Director', 'mGJVt_weyLg', 'wave.jpg', 0, 0),
(29, 'Despicable Me 4', '2024-07-02 21:00:00', 'Анимация, Комедия', 0, 'Things just got a little more despicable.', 'Крис Ренауд', 'qQlr9-rF32A', 'dm4.jpg', 3, 1),
(30, 'The Garfield Movie', '2024-05-23 21:00:00', 'Анимация, Комедия', 0, 'garfield', ' ', 'S3XjsSvwSuU', 'garfield.jpg', 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id_notif` int(255) NOT NULL,
  `id_user` int(5) NOT NULL,
  `id_movie` int(5) NOT NULL,
  `notif_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id_notif`, `id_user`, `id_movie`, `notif_date`) VALUES
(9, 1, 14, '2024-06-14'),
(12, 1, 12, '2024-08-03'),
(19, 2, 26, '2025-05-05'),
(20, 2, 7, '2026-06-06'),
(21, 2, 2, '2025-06-06'),
(23, 2, 14, '2024-06-14'),
(30, 2, 23, '2024-05-05'),
(31, 25, 12, '2024-03-06'),
(37, 2, 12, '2024-03-08'),
(38, 26, 23, '2024-05-05'),
(41, 1, 29, '2024-07-03'),
(43, 29, 12, '2024-03-08'),
(50, 2, 29, '2024-07-03'),
(51, 8, 29, '2024-07-03'),
(53, 8, 30, '2024-05-24'),
(54, 2, 30, '2024-05-24');

-- --------------------------------------------------------

--
-- Table structure for table `projections`
--

CREATE TABLE `projections` (
  `id_projection` int(255) NOT NULL,
  `id_movie` int(5) NOT NULL,
  `id_hall` int(3) NOT NULL,
  `time` time NOT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `projections`
--

INSERT INTO `projections` (`id_projection`, `id_movie`, `id_hall`, `time`, `date`) VALUES
(1, 3, 1, '18:25:32', '2024-02-27'),
(2, 3, 1, '16:20:00', '2024-02-28'),
(3, 3, 1, '11:30:00', '2024-02-26'),
(4, 3, 1, '15:00:00', '2024-02-26'),
(5, 3, 1, '12:50:00', '2024-02-27'),
(6, 3, 1, '19:00:00', '2024-02-29'),
(7, 26, 1, '19:00:00', '2024-02-29'),
(8, 2, 2, '11:30:00', '2024-02-28'),
(9, 2, 5, '19:00:00', '2024-02-29'),
(10, 2, 2, '17:30:00', '2024-02-29'),
(11, 2, 2, '19:00:00', '2024-02-27'),
(12, 3, 1, '23:50:00', '2024-02-26'),
(13, 3, 2, '20:00:00', '2024-03-01'),
(14, 7, 5, '19:45:00', '2024-02-28'),
(15, 7, 3, '21:26:00', '2024-03-01'),
(16, 4, 1, '23:30:00', '2024-02-28'),
(17, 4, 10, '14:20:00', '2024-03-01'),
(18, 4, 1, '18:44:00', '2024-02-29'),
(19, 8, 9, '21:20:00', '2024-02-28'),
(20, 1, 5, '00:45:00', '2024-02-29'),
(21, 13, 6, '00:10:00', '2024-03-02'),
(22, 15, 7, '15:30:00', '2024-03-04'),
(23, 22, 5, '10:30:00', '2024-03-03'),
(24, 22, 3, '18:40:00', '2024-03-05'),
(25, 21, 3, '00:20:00', '2024-03-06'),
(26, 22, 5, '13:40:00', '2024-03-08'),
(27, 26, 10, '13:40:00', '2024-03-07'),
(28, 3, 5, '14:42:00', '2024-03-07'),
(29, 12, 8, '18:48:00', '2024-03-09'),
(30, 3, 5, '18:40:00', '2024-03-15'),
(31, 12, 5, '18:11:00', '2024-03-20'),
(32, 4, 10, '15:59:00', '2024-03-20'),
(33, 12, 3, '17:20:00', '2024-03-27'),
(34, 4, 2, '20:00:00', '2024-03-26');

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `id_rating` int(255) NOT NULL,
  `id_user` int(15) NOT NULL,
  `id_movie` int(5) NOT NULL,
  `rating_value` decimal(3,1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`id_rating`, `id_user`, `id_movie`, `rating_value`) VALUES
(1, 1, 1, 4.0),
(10, 1, 2, 5.0),
(19, 1, 10, 3.0),
(22, 1, 3, 4.0),
(30, 1, 15, 2.0),
(31, 1, 13, 4.0),
(32, 1, 11, 4.0),
(141, 1, 21, 5.0),
(150, 1, 9, 4.0),
(167, 2, 22, 4.0),
(178, 2, 9, 5.0),
(180, 1, 7, 5.0),
(181, 1, 4, 4.0),
(182, 1, 16, 4.0),
(191, 2, 7, 5.0),
(196, 2, 21, 4.0),
(198, 26, 4, 5.0),
(200, 2, 1, 5.0),
(205, 2, 28, 4.0),
(206, 29, 4, 5.0),
(207, 29, 28, 5.0),
(208, 29, 10, 1.0),
(209, 2, 10, 4.0),
(210, 2, 11, 5.0),
(211, 2, 26, 4.0),
(212, 2, 2, 5.0),
(215, 2, 4, 5.0),
(216, 2, 8, 5.0),
(224, 2, 12, 5.0),
(225, 8, 12, 4.0),
(226, 29, 3, 5.0),
(227, 29, 15, 5.0),
(228, 8, 3, 5.0),
(234, 8, 4, 5.0),
(237, 2, 3, 5.0);

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id_ticket` int(255) NOT NULL,
  `id_user` int(15) NOT NULL,
  `id_movie` int(5) NOT NULL,
  `id_projection` int(255) NOT NULL,
  `price` double(6,2) NOT NULL,
  `purchase_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `seat_number` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`id_ticket`, `id_user`, `id_movie`, `id_projection`, `price`, `purchase_date`, `seat_number`) VALUES
(186, 8, 3, 13, 37.50, '2024-02-27 20:31:35', '52,53,54'),
(187, 8, 3, 6, 62.50, '2024-02-27 20:33:22', '44,45,59,62,76'),
(188, 8, 2, 10, 125.00, '2024-02-27 20:34:38', '2,4,7,54,83,120,46,64,91,127'),
(189, 2, 2, 10, 25.00, '2024-02-27 20:39:21', '35,36'),
(190, 2, 4, 17, 37.50, '2024-02-27 20:42:38', '68,69,70'),
(191, 2, 1, 20, 12.50, '2024-02-27 20:44:28', '69'),
(193, 2, 26, 7, 25.00, '2024-02-27 20:45:35', '108,109'),
(210, 2, 4, 17, 12.50, '2024-02-29 18:43:40', '60'),
(214, 2, 13, 21, 23.75, '2024-02-29 18:59:53', '106,107'),
(274, 2, 7, 15, 25.00, '2024-02-29 20:57:30', '69,70'),
(279, 2, 15, 22, 23.75, '2024-02-29 21:25:41', '60,61'),
(280, 2, 22, 23, 35.63, '2024-03-01 06:30:29', '75,76,77'),
(281, 1, 22, 23, 23.75, '2024-03-01 19:39:29', '52,53'),
(282, 2, 21, 25, 12.50, '2024-03-01 22:04:17', '93'),
(283, 1, 21, 25, 12.50, '2024-03-01 22:06:10', '43'),
(284, 8, 22, 24, 12.50, '2024-03-01 22:09:15', '69'),
(285, 2, 10, 24, 12.50, '2024-03-02 22:46:42', '77'),
(286, 8, 22, 24, 25.00, '2024-03-03 00:09:53', '77,78'),
(291, 2, 3, 28, 25.00, '2024-03-06 11:52:54', '34,35,36,40'),
(292, 8, 3, 28, 12.50, '2024-03-06 13:40:20', '77'),
(295, 2, 22, 26, 12.50, '2024-03-08 09:28:16', '60'),
(296, 8, 12, 29, 59.38, '2024-03-08 16:53:03', '45,46,59,78,92'),
(297, 2, 3, 30, 6.25, '2024-03-13 17:28:25', '93'),
(298, 8, 3, 30, 6.25, '2024-03-13 17:33:27', '60'),
(299, 8, 3, 30, 6.25, '2024-03-13 17:37:32', '62'),
(300, 8, 3, 30, 6.25, '2024-03-13 17:38:51', '95'),
(301, 8, 3, 30, 6.25, '2024-03-13 17:42:00', '79'),
(302, 8, 3, 30, 6.25, '2024-03-13 17:42:42', '75'),
(303, 8, 3, 30, 6.25, '2024-03-13 17:44:36', '45'),
(304, 8, 3, 30, 6.25, '2024-03-13 17:45:20', '44'),
(305, 8, 3, 30, 6.25, '2024-03-13 17:46:11', '43'),
(306, 8, 3, 30, 6.25, '2024-03-13 17:47:40', '42'),
(307, 8, 3, 30, 11.88, '2024-03-13 17:47:58', '58'),
(308, 8, 3, 30, 25.00, '2024-03-13 17:48:29', '47,110'),
(309, 8, 3, 30, 12.50, '2024-03-13 17:48:42', '90'),
(310, 8, 3, 30, 12.50, '2024-03-13 17:50:54', '107'),
(311, 8, 3, 30, 12.50, '2024-03-13 17:51:01', '125'),
(312, 8, 3, 30, 5.00, '2024-03-13 17:51:11', '11'),
(313, 8, 3, 30, 3.00, '2024-03-13 18:08:30', '52'),
(314, 8, 3, 30, 112.50, '2024-03-13 18:43:46', '20,38,50,82,84,97,104,118,91'),
(315, 8, 3, 30, 3.00, '2024-03-13 19:20:15', '54'),
(316, 8, 3, 30, 6.75, '2024-03-13 19:20:34', '72'),
(317, 8, 3, 30, 12.50, '2024-03-13 19:29:48', '69'),
(318, 8, 3, 30, 12.50, '2024-03-15 07:33:23', '24'),
(319, 8, 3, 30, 12.50, '2024-03-15 07:33:55', '6'),
(323, 8, 3, 30, 12.50, '2024-03-15 07:36:56', '88'),
(324, 8, 3, 30, 12.50, '2024-03-15 07:37:32', '101'),
(349, 29, 3, 30, 12.50, '2024-03-15 08:39:36', '103'),
(350, 2, 3, 30, 12.50, '2024-03-15 13:04:51', '121'),
(351, 2, 3, 30, 12.50, '2024-03-15 13:08:13', '124'),
(352, 29, 4, 32, 12.50, '2024-03-17 13:59:34', '69'),
(353, 2, 12, 33, 12.50, '2024-03-25 14:53:00', '144');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(15) NOT NULL,
  `f_name` varchar(30) NOT NULL,
  `l_name` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(60) NOT NULL,
  `birth` date NOT NULL,
  `admin` tinyint(1) NOT NULL,
  `joined` date DEFAULT NULL,
  `pfp` varchar(255) NOT NULL DEFAULT 'https://static.vecteezy.com/system/resources/thumbnails/009/292/244/small/default-avatar-icon-of-social-media-user-vector.jpg',
  `access` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `f_name`, `l_name`, `email`, `password`, `birth`, `admin`, `joined`, `pfp`, `access`) VALUES
(1, 'admin', 'tf', 'admin@gmail.com', '$2y$10$YmC12eMwt8oAnmPhqb8g2umSodHkw2oJ5FJmC8G/aJxFETWOUGE..', '2023-12-01', 1, '2023-10-10', 'https://preview.redd.it/bcyq3rjk2w071.png?auto=webp&s=97c9b873f1b41a7b9ff31331fd92f2e3fafed92f', 1),
(2, 'Alex', 'alex', 'alexiliev111@gmail.com', '$2y$10$YmC12eMwt8oAnmPhqb8g2umSodHkw2oJ5FJmC8G/aJxFETWOUGE..', '2000-07-05', 1, '2024-01-16', 'https://pbs.twimg.com/media/E9sN5jzVUAUgYHn.png', 1),
(8, 'test', 'test', 'test@gmail.com', '$2y$10$QiaBlBnByqHWJZEpRVgQGOiHC58ygl.W71QYeVgWjpgRjyN4XzbKa', '2024-01-04', 1, '2024-01-16', 'https://i.imgur.com/iDv7xPz_d.png?maxwidth=520&shape=thumb&fidelity=high', 1),
(21, 'test', 'test', 'test2@gmail.com', '$2y$10$9oXYZZNwS8IRIjDj/UZHPe3p7IaO.Wggy3PUHMUJnntiX.FCK5uva', '2024-01-11', 0, '2024-01-15', 'https://static.vecteezy.com/system/resources/thumbnails/009/292/244/small/default-avatar-icon-of-social-media-user-vector.jpg', 1),
(25, 'stamat', 'stamat2', 'stamat@gmail.com', '$2y$10$qAybKPWzZvwSgoKIefZikOHTTqAdv9gq6j6lzJI2MdgCOjyE2/U8G', '2024-01-04', 0, '2024-01-17', 'https://i.etsystatic.com/34732889/r/il/b08942/3768265623/il_570xN.3768265623_sji1.jpg', 1),
(26, 'Milo', 'milo', 'milo@gmail.com', '$2y$10$f/qyyti5sPD9IcVKYlDNpuz/eMf6L6tS3WAgMG41wj0OcBFtNiP8G', '2024-01-03', 0, '2024-01-27', 'https://cdn.discordapp.com/attachments/911570909314310195/1200563222537838672/alexisevenmoregaythanbefore.gif?ex=65c6a2a1&is=65b42da1&hm=3b796f5d6271760c1f8445c093b2de17c0db5df64ad51f519fa109e638ac61a9&', 0),
(28, 'emailme', 'e', 'mrlogtod@gmail.com', '$2y$10$hBUzLvrlntfYout9ykNa7.bBVTdtcha/EwtV0YJTRZGXrZsTfCNCS', '2024-01-31', 1, '2024-02-22', 'https://bootdey.com/img/Content/avatar/avatar7.png', 1),
(29, 'tom', 'shimon', 'tomshimoni14@gmail.com', '$2y$10$toY7yDN9HRO7zlawiisOVumYdfruY53GRwH6WvGUKHxTk6PJYjpWC', '2024-02-08', 0, '2024-02-22', 'https://i.pinimg.com/736x/9c/3a/0e/9c3a0e399b447ee46f61a9a5f11d099d.jpg', 1),
(30, 'Fanner', 'agha', 'fanfan@gmail.com', '$2y$10$Lj1OrT//3ZgiueLDDwZSs.Qb26MKdHlYt7.jT5YHR3ZdedKCB3a9e', '2024-02-02', 0, '2024-02-26', 'https://bootdey.com/img/Content/avatar/avatar7.png', 1),
(46, 'delete', 'delete', 'deleteme@gmail.com', '$2y$10$c.6Ve49.nO54WcLTo1sBjOR02cyQQycz9QBBysB0skMNk2DbQBBca', '2434-03-31', 0, '2024-03-20', 'https://static.vecteezy.com/system/resources/thumbnails/009/292/244/small/default-avatar-icon-of-social-media-user-vector.jpg', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `discounts`
--
ALTER TABLE `discounts`
  ADD PRIMARY KEY (`id_discount`);

--
-- Indexes for table `halls`
--
ALTER TABLE `halls`
  ADD PRIMARY KEY (`id_hall`);

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`id_movie`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id_notif`),
  ADD KEY `fsafsd` (`id_movie`),
  ADD KEY `fdsgdsgsdg` (`id_user`);

--
-- Indexes for table `projections`
--
ALTER TABLE `projections`
  ADD PRIMARY KEY (`id_projection`),
  ADD KEY `zzz` (`id_hall`),
  ADD KEY `eee` (`id_movie`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id_rating`),
  ADD KEY `movies` (`id_movie`),
  ADD KEY `users` (`id_user`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id_ticket`),
  ADD KEY `ggg` (`id_movie`),
  ADD KEY `aaa` (`id_projection`),
  ADD KEY `ccc` (`id_user`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `discounts`
--
ALTER TABLE `discounts`
  MODIFY `id_discount` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `halls`
--
ALTER TABLE `halls`
  MODIFY `id_hall` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `id_movie` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id_notif` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `projections`
--
ALTER TABLE `projections`
  MODIFY `id_projection` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id_rating` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=238;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id_ticket` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=354;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `fdsgdsgsdg` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE,
  ADD CONSTRAINT `fsafsd` FOREIGN KEY (`id_movie`) REFERENCES `movies` (`id_movie`);

--
-- Constraints for table `projections`
--
ALTER TABLE `projections`
  ADD CONSTRAINT `eee` FOREIGN KEY (`id_movie`) REFERENCES `movies` (`id_movie`),
  ADD CONSTRAINT `zzz` FOREIGN KEY (`id_hall`) REFERENCES `halls` (`id_hall`);

--
-- Constraints for table `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `movies` FOREIGN KEY (`id_movie`) REFERENCES `movies` (`id_movie`) ON DELETE CASCADE,
  ADD CONSTRAINT `users` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE;

--
-- Constraints for table `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `aaa` FOREIGN KEY (`id_projection`) REFERENCES `projections` (`id_projection`),
  ADD CONSTRAINT `ccc` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE,
  ADD CONSTRAINT `ggg` FOREIGN KEY (`id_movie`) REFERENCES `movies` (`id_movie`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
