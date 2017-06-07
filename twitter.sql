-- phpMyAdmin SQL Dump
-- version 4.6.6deb1+deb.cihar.com~xenial.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Czas generowania: 07 Cze 2017, 11:30
-- Wersja serwera: 5.7.18-0ubuntu0.16.04.1
-- Wersja PHP: 7.0.15-0ubuntu0.16.04.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `twitter`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `tweetId` int(11) NOT NULL,
  `commentText` varchar(60) NOT NULL,
  `creationDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `comment`
--

INSERT INTO `comment` (`id`, `userId`, `tweetId`, `commentText`, `creationDate`) VALUES
(22, 33, 18, 'Dzięki stary, wzajemnie :)', '2017-05-22 22:44:26'),
(23, 43, 6, 'Ja bym tego jeszcze nie przesądzał!', '2017-05-23 00:15:54'),
(27, 33, 8, 'Przyjdzie prędzej czy później :)', '2017-05-23 10:57:50'),
(28, 33, 24, 'Pisz co chcesz i niczego nie żałuj!', '2017-05-23 10:58:18'),
(29, 33, 4, 'Święta, Święta i po Świętach.', '2017-05-23 10:58:56'),
(58, 33, 31, 'Wraca tam gdzie jego miejsce, Brawo!!!', '2017-06-04 17:58:10'),
(59, 33, 22, 'A żałujesz że nie urodziłeś się czarny?', '2017-06-07 11:02:02'),
(60, 33, 19, 'Dramat, już mnie to nie dziwi hehe', '2017-06-07 11:02:39'),
(61, 50, 6, 'Nie podniecałbym się za wczasu...', '2017-06-07 11:03:34'),
(62, 50, 2, 'I my witamy Ciebie Jaca25 :)', '2017-06-07 11:04:01'),
(63, 44, 23, 'Weź się w garść, powoli do celu :)', '2017-06-07 11:05:56'),
(64, 44, 7, 'Brawo, tak 3mać!', '2017-06-07 11:06:28'),
(65, 44, 31, 'Gratulacje dla klubu legendy!', '2017-06-07 11:07:05'),
(66, 50, 31, 'Opłaca się walczyć do końca, Brawoooo!!!!', '2017-06-07 11:09:18');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `senderId` int(11) NOT NULL,
  `receiverId` int(11) NOT NULL,
  `messageText` varchar(140) NOT NULL,
  `creationDate` datetime NOT NULL,
  `messageStatus` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `message`
--

INSERT INTO `message` (`id`, `senderId`, `receiverId`, `messageText`, `creationDate`, `messageStatus`) VALUES
(21, 33, 46, 'Kolejny cudowny poranek :) co u Ciebie?', '2017-06-04 11:24:19', 0),
(26, 33, 44, 'Prawie ukończyłem Twittera :)', '2017-06-04 11:33:47', 0),
(28, 33, 50, 'Co tam słychać Panie kolego?', '2017-06-04 11:41:20', 0),
(38, 50, 33, 'Górnik Zabrze wraca do Ekstraklasy!!!', '2017-06-04 17:57:32', 1),
(39, 61, 33, 'Siemano, co słychać?', '2017-06-04 19:23:17', 1),
(40, 38, 33, 'Siema :) jak humor w poniedziałek?', '2017-06-05 10:33:57', 1),
(41, 46, 33, 'Jako tako po japońsku ;)', '2017-06-07 10:55:12', 0),
(42, 46, 33, 'Wszystko gra i trombi :)', '2017-06-07 10:55:48', 1),
(43, 33, 50, 'Zajebiście, niemożliwe stało się możliwe :)', '2017-06-07 10:57:16', 1),
(44, 33, 44, 'Final message on twitter! ;)', '2017-06-07 10:58:42', 0),
(46, 50, 33, 'Dobra, ta już jest final hehe', '2017-06-07 11:10:25', 0),
(47, 33, 44, 'Very final message!', '2017-06-07 11:12:01', 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `tweet`
--

CREATE TABLE `tweet` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `tweetText` varchar(140) NOT NULL,
  `creationDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `tweet`
--

INSERT INTO `tweet` (`id`, `userId`, `tweetText`, `creationDate`) VALUES
(2, 33, 'Witam wszystkich serdecznie!', '2017-04-17 14:28:16'),
(4, 33, 'Wesołych i Spokojnych Świąt Wielkanocnych :)', '2017-04-17 14:32:44'),
(6, 33, 'Polska jedzie na Mistrzostwa Świata!', '2017-04-17 14:34:06'),
(7, 33, 'Kolejny wspaniały występ Kamila Stocha!', '2017-04-17 14:34:26'),
(8, 34, 'Niestety wiosna zawitała tylko na chwilę :(', '2017-04-17 14:36:07'),
(18, 33, 'Witam serdecznie, pozdrawiam i życzę miłego popołudnia :)', '2017-04-17 17:40:17'),
(19, 33, 'Niewiarygodne! Kolejny wypadek rządowej limuzyny!', '2017-04-17 17:44:44'),
(22, 32, 'Coco Jambo i do przodu. To moje hasło. Dobre,nie?', '2017-04-17 18:26:25'),
(23, 33, 'Jak ogarnąć tego Twittera?', '2017-04-17 20:08:36'),
(24, 41, 'Co by tu jeszcze napisać?', '2017-04-17 20:09:46'),
(31, 33, 'Górnik Zabrze wraca do Ekstraklasy!!!', '2017-06-04 17:57:44');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `user`
--

INSERT INTO `user` (`id`, `email`, `username`, `password`) VALUES
(32, 'jaca82@wp.pl', 'Jaca82', '$2y$10$VY/hReHsT/Bn4u3vj4BZ/OAB1mtM/pbKkgs0U4vFwDnd7TM3y3pam'),
(33, 'jacek25@o2.pl', 'Jaca25', '$2y$10$6aTXcHgLKX32zWSpn0gHOeYa083PcUfpnpv4HauFs6yqjVbVEa8gC'),
(34, 'jaca30@wp.pl', 'Jaca30', '$2y$10$nX5Zzpl8gYdnIlSuNibKy.vnHpYLEEUiwHh1i7d9UOOP/dkzG4Kk.'),
(36, 'jaca25@o2.pl', 'Jaca35', '$2y$10$bVlOqCLvzbiYfcRsZuyytexaYVXzRN0rwmZ2zEXcL0FnhePf/GCH.'),
(38, 'jaca15@o2.pl', 'Jaca88', '$2y$10$25s6w.OLvy.CDRKTgTmKPesBYwZf5fCRvGH0INLuFYyIbxp3BKuNm'),
(41, 'jaca83@wp.pl', 'Jaca83', '$2y$10$2QmU1hCCQpbLjYx0WDAvcelPPqrQPGK2f5AGDbNDy9OVHqahfKGOW'),
(44, 'jaca44@o2.pl', 'Jaca44', '$2y$10$RAi1QgHadhwyW.O958U9weIdJkb7Syke2Apz9d/zsBT30vQXekYeq'),
(46, 'jaca33@o2.pl', 'Jaca33', '$2y$10$sw1rrpg3fZSA.XWmXy8XueaHqgLYzC53waEgXJHQ7lomznXYNoCEy'),
(50, 'jaca66@o2.pl', 'Jaca66', '$2y$10$oU6KRQlrX7yQD8eMi7X.y.eQgDZnIG4Xv79sM1Tp9KZAd7CvI0Gcm'),
(61, 'jaca21@wp.pl', 'Jaca23', '$2y$10$vEnW9N.59jzU2LExH7j1nusDH/TMgHL9K1YYf9fuhLzbDc0RdJ/Fa');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tweetId` (`tweetId`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`),
  ADD KEY `senderId` (`senderId`),
  ADD KEY `receiverId` (`receiverId`);

--
-- Indexes for table `tweet`
--
ALTER TABLE `tweet`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;
--
-- AUTO_INCREMENT dla tabeli `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
--
-- AUTO_INCREMENT dla tabeli `tweet`
--
ALTER TABLE `tweet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT dla tabeli `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;
--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`tweetId`) REFERENCES `tweet` (`id`) ON DELETE CASCADE;

--
-- Ograniczenia dla tabeli `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`senderId`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `message_ibfk_2` FOREIGN KEY (`receiverId`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Ograniczenia dla tabeli `tweet`
--
ALTER TABLE `tweet`
  ADD CONSTRAINT `tweet_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `user` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
