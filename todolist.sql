-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Апр 29 2017 г., 11:26
-- Версия сервера: 5.7.14
-- Версия PHP: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `todolist`
--

-- --------------------------------------------------------

--
-- Структура таблицы `todolist`
--

CREATE TABLE `todolist` (
  `id` int(11) NOT NULL,
  `sessionID` varchar(255) NOT NULL,
  `text` text CHARACTER SET utf8 NOT NULL,
  `done` tinyint(1) NOT NULL DEFAULT '0',
  `time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `todolist`
--

INSERT INTO `todolist` (`id`, `sessionID`, `text`, `done`, `time`, `updated`) VALUES
(60, 'k79tmaepbi95uaaatc4a35ora5', '', 0, '2017-04-29 15:17:47', NULL),
(61, 'k79tmaepbi95uaaatc4a35ora5', 'Ð½ 5Ð½ Ñ‹5Ð½Ñ‹ 5Ð½Ñ‹', 0, '2017-04-29 15:17:49', NULL);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `todolist`
--
ALTER TABLE `todolist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `todolist`
--
ALTER TABLE `todolist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
