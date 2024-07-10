-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 08, 2024 at 07:49 PM
-- Server version: 8.0.30
-- PHP Version: 8.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `black_cinema`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `update_pending_payments` ()   BEGIN
    UPDATE payment
    SET status = 'canceled'
    WHERE status = 'pending' AND expiredPayment <= NOW();
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `advertisement`
--

CREATE TABLE `advertisement` (
  `id` int NOT NULL,
  `links` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `advertisement`
--

INSERT INTO `advertisement` (`id`, `links`) VALUES
(19, 'https://res.cloudinary.com/dv3z889zh/image/upload/v1720467226/vq9viqp5dl3rm6s5qrjv.png'),
(20, 'https://res.cloudinary.com/dv3z889zh/image/upload/v1720467251/hmap9tcmqgxnwxiqytul.png'),
(21, 'https://res.cloudinary.com/dv3z889zh/image/upload/v1720467266/kpoo66studz66tnbzjey.png');

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `chat_id` int NOT NULL,
  `user_id` int NOT NULL,
  `chat_with` int NOT NULL,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`chat_id`, `user_id`, `chat_with`, `message`, `timestamp`) VALUES
(1, 3, 1, 'hello', '2024-07-08 18:08:12'),
(2, 2, 5, 'p bang', '2024-07-08 18:14:03'),
(3, 1, 5, 'p bang party', '2024-07-08 18:15:34'),
(4, 1, 5, 'heyo', '2024-07-08 18:19:27'),
(5, 1, 5, 'mmmm', '2024-07-08 18:19:48'),
(6, 3, 1, 'p bang party', '2024-07-08 18:20:04'),
(7, 2, 5, 'party', '2024-07-08 18:20:44'),
(8, 3, 1, 'join', '2024-07-08 18:21:01'),
(9, 2, 3, 'mabok', '2024-07-08 18:22:27');

-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--

CREATE TABLE `favorites` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `movie_id` int NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `favorites`
--

INSERT INTO `favorites` (`id`, `user_id`, `movie_id`, `created_at`) VALUES
(18, 3, 702, '2024-07-09 02:36:57');

-- --------------------------------------------------------

--
-- Table structure for table `movie`
--

CREATE TABLE `movie` (
  `id` int NOT NULL,
  `userId` int NOT NULL,
  `createdAt` datetime DEFAULT CURRENT_TIMESTAMP,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `overview` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `poster_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `backdrop_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `genres` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `category` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `release_date` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `trailer` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `movieDuration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `vote_average` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `movie`
--

INSERT INTO `movie` (`id`, `userId`, `createdAt`, `title`, `overview`, `poster_path`, `backdrop_path`, `genres`, `category`, `release_date`, `trailer`, `movieDuration`, `vote_average`) VALUES
(700, 2, '2024-06-30 14:48:40', 'Sri Asih', 'Alana discover the truth about her origin: she’s not an ordinary human being. She may be the gift for humanity and become its protector as Sri Asih. Or a destruction, if she can’t control her anger.', 'https://image.tmdb.org/t/p/w500//wShcJSKMFg1Dy1yq7kEZuay6pLS.jpg', 'https://image.tmdb.org/t/p/w1280//oFAukXiMPrwLpbulGmB5suEZlrm.jpg', '[\"Action\",\" Adventure\",\" Science Fiction\",\" Fantasy\",\" Drama\"]', '[\"top movies\"]', '2022-11-17', 'https://www.youtube.com/watch?v=QeT6Ke2kQYo', '134', 6.236),
(701, 2, '2024-06-30 18:31:07', 'Kung Fu Hustle', 'It\\\'s the 1940s, and the notorious Axe Gang terrorizes Shanghai. Small-time criminals Sing and Bone hope to join, but they only manage to make lots of very dangerous enemies. Fortunately for them, kung fu masters and hidden strength can be found in unlikely places. Now they just have to take on the entire Axe Gang.', 'https://image.tmdb.org/t/p/w500//exbyTbrvRUDKN2mcNEuVor4VFQW.jpg', 'https://image.tmdb.org/t/p/w1280//zNOfW35hBXPIzM5BIl7gptuW0EA.jpg', '[\"Action\",\" Comedy\",\" Crime\",\" Fantasy\"]', '[\"popular movies\"]', '2004-02-10', 'https://www.youtube.com/watch?v=-m3IB7N_PRk', '99', 7.44),
(702, 2, '2024-07-09 01:24:34', 'Kung Fu Panda 4', 'Po is gearing up to become the spiritual leader of his Valley of Peace, but also needs someone to take his place as Dragon Warrior. As such, he will train a new kung fu practitioner for the spot and will encounter a villain called the Chameleon who conjures villains from the past.', 'https://image.tmdb.org/t/p/w500//kDp1vUBnMpe8ak4rjgl3cLELqjU.jpg', 'https://image.tmdb.org/t/p/w1280//3ffPx9jqg0yj9y1KWeagT7D20CB.jpg', '[\"Animation\",\" Action\",\" Family\",\" Comedy\",\" Fantasy\"]', '[\"top movies\"]', '2024-03-02', 'https://www.youtube.com/watch?v=d2OONzqh2jk', '94', 7.121),
(704, 2, '2024-07-09 02:10:34', 'Ip Man: Kung Fu Master', 'Ip Man’s promising career as a Policeman is ruined after he is framed for murder and targeted by a mob boss’s daughter.', 'https://image.tmdb.org/t/p/w500//kHZN7zZGsWik9Sg3APaHGeTK5Jm.jpg', 'https://image.tmdb.org/t/p/w1280//9LoM4ATbgEFh6zyx4UytRTFdSlD.jpg', '[\"Action\",\" Drama\"]', '[\"popular movies\"]', '2019-12-23', 'https://www.youtube.com/watch?v=JZpOZ2j1cnA', '82', 6.7),
(705, 2, '2024-07-09 02:10:45', 'Kung Fu Panda', 'When the Valley of Peace is threatened, lazy Po the panda discovers his destiny as the \\\"chosen one\\\" and trains to become a kung fu hero, but transforming the unsleek slacker into a brave warrior won\\\'t be easy. It\\\'s up to Master Shifu and the Furious Five -- Tigress, Crane, Mantis, Viper and Monkey -- to give it a try.', 'https://image.tmdb.org/t/p/w500//wWt4JYXTg5Wr3xBW2phBrMKgp3x.jpg', 'https://image.tmdb.org/t/p/w1280//d1RHScaZc7I8j0lDke1c4AxI435.jpg', '[\"Action\",\" Adventure\",\" Animation\",\" Family\",\" Comedy\"]', '[\"now playing\"]', '2008-06-04', 'https://www.youtube.com/watch?v=TD0YUZw_oHY', '90', 7.3),
(706, 2, '2024-07-09 02:10:55', 'Kung Fu Jungle', 'A martial arts instructor working at a police academy gets imprisoned after killing a man by accident. But when a vicious killer starts targeting martial arts masters, the instructor offers to help the police in return for his freedom.', 'https://image.tmdb.org/t/p/w500//myZQ4WocOQQCXNGVJkHeeJ1jTEj.jpg', 'https://image.tmdb.org/t/p/w1280//ihNANvV5i3wW700gWWQXjYUB7Hv.jpg', '[\"Action\",\" Thriller\",\" Crime\"]', '[\"upcoming\"]', '2014-10-31', 'https://www.youtube.com/watch?v=DlQYdIr7ZO0', '100', 6.723),
(707, 2, '2024-07-09 02:11:16', 'Kung Fu Dunk', 'Shi-Jie is a brilliant martial artist from the Kung Fu School. One day, he encounters a group of youths playing basketball and shows off how easy it is for him, with his martial arts training, to do a Slam Dunk. Watching him was Chen-Li, a shrewd businessman, who recruits him to play varsity basketball at the local university.', 'https://image.tmdb.org/t/p/w500//fKurohqZqv7flZPYnxK7gH9Ir2F.jpg', 'https://image.tmdb.org/t/p/w1280//2h6LQBRGuzMkqFvazRx4fZFiU7T.jpg', '[\"Action\",\" Adventure\",\" Comedy\"]', '[\"popular movies\"]', '2008-02-07', 'https://www.youtube.com/watch?v=nmnXFKJv8Z0', '98', 5.844),
(708, 2, '2024-07-09 02:11:29', 'Kung Fu Panda 3', 'While Po and his father are visiting a secret panda village, an evil spirit threatens all of China, forcing Po to form a ragtag army to fight back.', 'https://image.tmdb.org/t/p/w500//oajNi4Su39WAByHI6EONu8G8HYn.jpg', 'https://image.tmdb.org/t/p/w1280//uT5G4fA7jKxlJNfwYPMm353f5AI.jpg', '[\"Action\",\" Adventure\",\" Animation\",\" Comedy\",\" Family\"]', '[\"popular movies\"]', '2016-01-23', 'https://www.youtube.com/watch?v=yqN7nHM1YTA', '95', 6.914),
(709, 2, '2024-07-09 02:11:42', 'Jackie Chan Kung Fu Master', 'Jackie Chan is the undefeated Kung Fu Master who dishes out the action in traditional Jackie Chan style. When a young boy sets out to learn how to fight from the Master himself, he not only witnesses some spectacular fights, but learns some important life lessons along the way.', 'https://image.tmdb.org/t/p/w500//ds8xP7319zuPMa09kxzkIPBsHVL.jpg', 'https://image.tmdb.org/t/p/w1280//hGhUba7q5kqYA3TpgfCmzI9DNFk.jpg', '[\"Action\",\" Comedy\",\" Family\"]', '[\"now playing\"]', '2009-07-03', '', '85', 4.2),
(710, 2, '2024-07-09 02:11:59', 'Motu Patlu: Kung Fu Kings', 'Tiger Chang, a martial arts master from a village located in the Himalayas, visits Furfuri Nagar. After defeating the boxers in a boxing competition, he insults the people of Furfuri Nagar. To restore the prestige of Furfuri Nagar, Motu decides to learn martial arts and defeat Tiger Chang. Can Motu overcome Tiger Chang\\\'s challenge and restore the pride of Furfuri Nagar? Watch to find out!', 'https://image.tmdb.org/t/p/w500//bWUyHbjGhgxstnZ2dxZrR721TVe.jpg', 'https://image.tmdb.org/t/p/w1280//gfBprn7If9ns3ARZyvo7qcu6gQ.jpg', '[\"Adventure\",\" Animation\",\" Comedy\"]', '[\"popular movies\"]', '2014-10-23', '', '96', 5.667),
(711, 2, '2024-07-09 02:12:19', 'Half a Loaf of Kung Fu', 'A young daydreamer  assumes the identity of a dead martial arts hero and quickly finds himself caught up in a plot by several clans to steal famous martial arts artifacts being transported by an escort company.', 'https://image.tmdb.org/t/p/w500//h6UqBfxxCOeOUCryTLUO82qjnzu.jpg', 'https://image.tmdb.org/t/p/w1280//9LhDEiMxCsuJe2zGsd3l0yuUJwd.jpg', '[\"Comedy\",\" Action\"]', '[\"upcoming\"]', '1978-06-30', 'https://www.youtube.com/watch?v=vQgyu8JMsog', '97', 6.3),
(712, 2, '2024-07-09 02:12:41', 'Avatar: The Way of Water', 'Set more than a decade after the events of the first film, learn the story of the Sully family (Jake, Neytiri, and their kids), the trouble that follows them, the lengths they go to keep each other safe, the battles they fight to stay alive, and the tragedies they endure.', 'https://image.tmdb.org/t/p/w500//t6HIqrRAclMCA60NsSmeqe9RmNV.jpg', 'https://image.tmdb.org/t/p/w1280//8rpDcsfLJypbO6vREc0547VKqEv.jpg', '[\"Science Fiction\",\" Adventure\",\" Action\"]', '[\"popular movies\"]', '2022-12-14', 'https://www.youtube.com/watch?v=o5F8MOz_IDw', '192', 7.623),
(713, 2, '2024-07-09 02:12:58', 'Avatar: Creating the World of Pandora', 'The Making-of James Cameron\\\'s Avatar. It shows interesting parts of the work on the set.', 'https://image.tmdb.org/t/p/w500//d9oqcfeCyc3zmMal6eJbfj3gatc.jpg', 'https://image.tmdb.org/t/p/w1280//uEwGFGtao9YG2JolmdvtHLLVbA9.jpg', '[\"Documentary\"]', '[\"top movies\"]', '2010-02-07', '', '23', 6.6),
(714, 2, '2024-07-09 02:13:12', 'My Avatar and Me', 'is a creative documentary-fiction film and a film that might expand your sense of reality. It is the story about a man who enters the virtual world Second Life to pursue his personal dreams and ambitions. His journey into cyberspace becomes a magic learning experience, which gradually opens the gates to a much larger reality.', 'https://image.tmdb.org/t/p/w500//dZCj0jiOoDzAzbQM7ryYFEjkjs7.jpg', 'https://image.tmdb.org/t/p/w1280/null', '[\"Documentary\",\" Science Fiction\"]', '[\"top movies\"]', '2010-11-10', '', '', 6),
(715, 2, '2024-07-09 02:13:28', 'Avatar: The Deep Dive - A Special Edition of 20/20', 'An inside look at one of the most anticipated movie sequels ever with James Cameron and cast.', 'https://image.tmdb.org/t/p/w500//i367eMUXwj9LtNqrVlw1NXGRLx7.jpg', 'https://image.tmdb.org/t/p/w1280//eoAvHxfbaPOcfiQyjqypWIXWxDr.jpg', '[\"Documentary\"]', '[\"upcoming\"]', '2022-12-13', 'https://www.youtube.com/watch?v=P75e1iUawGY', '38', 7.103),
(716, 2, '2024-07-09 02:13:50', 'Avatara Purusha: Part 1', 'When a son of an Ayurveda scholar goes missing, he blames his sister and cuts all ties with her. When the latter\\\'s daughter decides to set things right with a devious plan, there seems to be more trouble waiting for the family.', 'https://image.tmdb.org/t/p/w500//gQ29E9Qy6z5ExsxnpgUTHfpZFO3.jpg', 'https://image.tmdb.org/t/p/w1280//wEjFjWu5yiHk6U5YV9kSnwdWwNO.jpg', '[\"Thriller\",\" Fantasy\",\" Horror\"]', '[\"now playing\"]', '2022-05-06', '', '131', 5.3);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int NOT NULL,
  `userId` int DEFAULT NULL,
  `movieId` int DEFAULT NULL,
  `createdAt` datetime DEFAULT CURRENT_TIMESTAMP,
  `userName` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `userEmail` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `startTime` datetime DEFAULT NULL,
  `endTime` datetime DEFAULT NULL,
  `feeAdmin` int DEFAULT NULL,
  `price` int DEFAULT NULL,
  `totalPrice` int DEFAULT NULL,
  `packageName` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `methodPayment` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `promoCode` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `expiredPayment` datetime DEFAULT NULL,
  `successPayment` datetime DEFAULT NULL,
  `room` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `userId`, `movieId`, `createdAt`, `userName`, `userEmail`, `startTime`, `endTime`, `feeAdmin`, `price`, `totalPrice`, `packageName`, `methodPayment`, `promoCode`, `status`, `expiredPayment`, `successPayment`, `room`) VALUES
(42, 3, 700, '2024-07-08 19:33:08', 'palkon', 'wildannoob354@gmail.com', '2024-07-23 19:33:00', '2024-07-23 21:47:00', 5000, 1200000, 1205000, 'reguler', '', '', 'success', '2024-07-08 20:03:08', '2024-07-08 19:39:01', 1),
(46, 3, 700, '2024-07-08 21:56:27', 'palkon', 'wildannoob354@gmail.com', '2024-07-08 21:56:00', '2024-07-09 00:10:00', 5000, 1200000, 1205000, 'reguler', '', '', 'success', '2024-07-08 22:26:27', '2024-07-08 21:58:38', 1),
(47, 3, 700, '2024-07-08 22:04:31', 'palkon', 'wildannoob354@gmail.com', '2024-07-09 22:04:00', '2024-07-10 00:18:00', 5000, 1200000, 1205000, 'reguler', 'BRI', 'aaaa', 'canceled', '2024-07-08 22:34:31', '2024-07-08 22:13:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `payment_card`
--

CREATE TABLE `payment_card` (
  `id` int NOT NULL,
  `numberCard` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nameCard` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `imageCard` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `categoryInstitue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `imageQR` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment_card`
--

INSERT INTO `payment_card` (`id`, `numberCard`, `nameCard`, `imageCard`, `categoryInstitue`, `imageQR`) VALUES
(1, '123434', 'BRI', 'https://cdn3.iconfinder.com/data/icons/banks-in-indonesia-logo-badge/100/BRI-512.png', 'ewallet', 'https://www.techopedia.com/wp-content/uploads/2023/03/aee977ce-f946-4451-8b9e-bba278ba5f13.png'),
(2, '453564574', 'Dana', 'https://cdn.antaranews.com/cache/1200x800/2022/04/25/dana.jpg', 'ewallet', 'https://www.techopedia.com/wp-content/uploads/2023/03/aee977ce-f946-4451-8b9e-bba278ba5f13.png'),
(3, '123', 'shopee pay', 'https://alfamart.co.id/storage/page/January2022/CNKpimFu30rDwGT22iJl.jpg', 'ewallet', 'https://alfamart.co.id/storage/page/January2022/CNKpimFu30rDwGT22iJl.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `payment_plan`
--

CREATE TABLE `payment_plan` (
  `id` int NOT NULL,
  `packageName` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `capacity` int DEFAULT NULL,
  `screenResolution` int DEFAULT NULL,
  `price` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment_plan`
--

INSERT INTO `payment_plan` (`id`, `packageName`, `capacity`, `screenResolution`, `price`) VALUES
(1, 'reguler', 23, 50, 1200000),
(3, 'VIP', 8, 70, 200000);

-- --------------------------------------------------------

--
-- Table structure for table `payment_promo`
--

CREATE TABLE `payment_promo` (
  `id` int NOT NULL,
  `createdAt` datetime DEFAULT CURRENT_TIMESTAMP,
  `promoCode` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `priceDisc` int DEFAULT NULL,
  `usable` datetime DEFAULT NULL,
  `expired` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment_promo`
--

INSERT INTO `payment_promo` (`id`, `createdAt`, `promoCode`, `priceDisc`, `usable`, `expired`) VALUES
(1, '2024-07-08 22:28:46', 'boyah', 10, '2024-07-07 23:01:00', '2024-07-14 00:00:00'),
(2, '2024-07-08 22:34:26', 'haha', 50000, '2024-07-07 00:01:00', '2024-07-14 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int NOT NULL,
  `user_username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `user_email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `user_password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `emailVerified` datetime DEFAULT NULL,
  `user_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `user_telepon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `user_role` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `createdAt` datetime DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_username`, `user_email`, `user_password`, `emailVerified`, `user_image`, `user_telepon`, `user_role`, `createdAt`, `updatedAt`) VALUES
(1, 'a', 'a@gmail.com', '$2y$10$JQ7tC/.vzN9ThUr8x1tpO.EdJ9VljEKQwSF4InQIvhE5cSiQ3fkXq', NULL, 'https://example.com/default_image.jpg', NULL, 'admin', '2024-06-29 19:49:52', '2024-06-29 19:50:08'),
(2, 'admin', 'as@gmail.com', '$2y$10$j1Mhkjh3QiRATUxYKonvtOdqKsr5reLUOhB/K.EhU0PGxhoiNb1WO', NULL, 'https://example.com/default_image.jpg', NULL, 'admin', '2024-06-30 14:47:15', '2024-07-09 01:36:32'),
(3, 'Raku', 'wildannoob354@gmail.com', '$2y$10$Kfku74OZb9fTSnc8C6dKfORaA50lna9flcwfB.jtiLjXJxgMFE.pi', NULL, 'https://res.cloudinary.com/dv3z889zh/image/upload/v1720467401/xdkdp60s2qbqup9pxytm.png', '08888888', 'user', '2024-06-30 14:55:23', '2024-07-09 02:36:44');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `advertisement`
--
ALTER TABLE `advertisement`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`chat_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_favorite` (`user_id`,`movie_id`),
  ADD KEY `fk_favorites_movie` (`movie_id`);

--
-- Indexes for table `movie`
--
ALTER TABLE `movie`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userId` (`userId`),
  ADD KEY `movieId` (`movieId`);

--
-- Indexes for table `payment_card`
--
ALTER TABLE `payment_card`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_plan`
--
ALTER TABLE `payment_plan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_promo`
--
ALTER TABLE `payment_promo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_promoCode` (`promoCode`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`user_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `advertisement`
--
ALTER TABLE `advertisement`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `chat_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `favorites`
--
ALTER TABLE `favorites`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `movie`
--
ALTER TABLE `movie`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=717;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `payment_card`
--
ALTER TABLE `payment_card`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `payment_plan`
--
ALTER TABLE `payment_plan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `payment_promo`
--
ALTER TABLE `payment_promo`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chat`
--
ALTER TABLE `chat`
  ADD CONSTRAINT `chat_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `favorites`
--
ALTER TABLE `favorites`
  ADD CONSTRAINT `fk_favorites_movie` FOREIGN KEY (`movie_id`) REFERENCES `movie` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_favorites_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `movie`
--
ALTER TABLE `movie`
  ADD CONSTRAINT `fk_movie_user` FOREIGN KEY (`userId`) REFERENCES `user` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `fk_payment_movie` FOREIGN KEY (`movieId`) REFERENCES `movie` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_payment_user` FOREIGN KEY (`userId`) REFERENCES `user` (`user_id`) ON DELETE CASCADE;

DELIMITER $$
--
-- Events
--
CREATE DEFINER=`root`@`localhost` EVENT `cancel_pending_payments` ON SCHEDULE EVERY 10 MINUTE STARTS '2024-07-04 16:58:29' ON COMPLETION NOT PRESERVE ENABLE DO CALL update_pending_payments()$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
