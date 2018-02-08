-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Czas generowania: 02 Gru 2016, 20:42
-- Wersja serwera: 10.1.16-MariaDB
-- Wersja PHP: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `konferencjomat`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `admini`
--

CREATE TABLE `admini` (
  `id` int(11) NOT NULL,
  `login` text COLLATE utf8_polish_ci NOT NULL,
  `haslo` text CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `admini`
--

INSERT INTO `admini` (`id`, `login`, `haslo`) VALUES
(1, 'wojtaszek171', '2b9696366659aa58863b26d5533cff07'),
(2, 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `konkursy`
--

CREATE TABLE `konkursy` (
  `id` int(11) NOT NULL,
  `nazwa` text CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `konkursy`
--

INSERT INTO `konkursy` (`id`, `nazwa`) VALUES
(1, 'Microsoft');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uczestnicy`
--

CREATE TABLE `uczestnicy` (
  `id` int(11) NOT NULL,
  `Imie` text CHARACTER SET utf8 NOT NULL,
  `Nazwisko` text COLLATE utf8_polish_ci NOT NULL,
  `unikalnyidentyfikator` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `uczestnicy`
--

INSERT INTO `uczestnicy` (`id`, `Imie`, `Nazwisko`, `unikalnyidentyfikator`) VALUES
(1, 'Paweł', 'Wojtaszko', 0),
(2, 'Marek', 'Szmit', 0),
(3, 'Piotr', 'Szłapa', 0),
(4, 'Dawid', 'Suryś', 0),
(5, 'Hubert', 'Żukowski', 0),
(6, 'Jakub', 'Wójcik', 0),
(7, 'Michał', 'Bartkiewicz', 0),
(8, 'Krzysztof', 'Ferenc', 0),
(9, 'Paweł', 'Wojtaszko', 2);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uczestnicykonkursow`
--

CREATE TABLE `uczestnicykonkursow` (
  `id` int(11) NOT NULL,
  `id_uczestnika` int(11) NOT NULL,
  `id_konkursu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `uczestnicykonkursow`
--

INSERT INTO `uczestnicykonkursow` (`id`, `id_uczestnika`, `id_konkursu`) VALUES
(1, 2, 1),
(2, 3, 1),
(3, 4, 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `wygrane`
--

CREATE TABLE `wygrane` (
  `id` int(11) NOT NULL,
  `id_uczestnika` int(11) NOT NULL,
  `id_konkursu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `wygrane`
--

INSERT INTO `wygrane` (`id`, `id_uczestnika`, `id_konkursu`) VALUES
(1, 6, 0),
(2, 2, 1),
(3, 2, 1),
(5, 3, 1),
(6, 4, 1),
(10, 1, 0),
(11, 2, 0),
(12, 5, 0),
(13, 7, 0);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `admini`
--
ALTER TABLE `admini`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `konkursy`
--
ALTER TABLE `konkursy`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `uczestnicy`
--
ALTER TABLE `uczestnicy`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `uczestnicykonkursow`
--
ALTER TABLE `uczestnicykonkursow`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wygrane`
--
ALTER TABLE `wygrane`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `admini`
--
ALTER TABLE `admini`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT dla tabeli `konkursy`
--
ALTER TABLE `konkursy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT dla tabeli `uczestnicy`
--
ALTER TABLE `uczestnicy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT dla tabeli `uczestnicykonkursow`
--
ALTER TABLE `uczestnicykonkursow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT dla tabeli `wygrane`
--
ALTER TABLE `wygrane`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
