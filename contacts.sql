-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Дек 26 2021 г., 19:27
-- Версия сервера: 5.7.21-20-beget-5.7.21-20-1-log
-- Версия PHP: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `alexey8z_resr`
--

-- --------------------------------------------------------

--
-- Структура таблицы `contacts`
--
-- Создание: Дек 25 2021 г., 17:59
-- Последнее обновление: Дек 25 2021 г., 17:58
--

DROP TABLE IF EXISTS `contacts`;
CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `source_id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `code` smallint(6) NOT NULL,
  `phone` mediumint(10) UNSIGNED NOT NULL,
  `email` varchar(128) NOT NULL,
  `timeset` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `contacts`
--

INSERT INTO `contacts` (`id`, `source_id`, `name`, `code`, `phone`, `email`, `timeset`) VALUES
(1, 1, 'Анна', 967, 440333, 'mail1@gmail.com', 1640388843),
(2, 1, 'Иван', 495, 7452344, 'mail2@gmail.com', 1640390210),
(4, 1, 'Анна', 900, 1234453, 'mail1@gmail.com', 1640455095),
(5, 1, 'Иван', 900, 1234123, 'mail2@gmail.com', 1640455095);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `phone` (`phone`) USING BTREE,
  ADD KEY `code` (`code`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
