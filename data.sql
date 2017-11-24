-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Ноя 24 2017 г., 00:32
-- Версия сервера: 5.6.37
-- Версия PHP: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `table`
--

-- --------------------------------------------------------

--
-- Структура таблицы `data`
--

CREATE TABLE `data` (
  `id` int(11) NOT NULL,
  `login` varchar(50) NOT NULL,
  `password_hash` varchar(150) NOT NULL,
  `name` varchar(15) NOT NULL,
  `second_name` varchar(15) NOT NULL,
  `class` varchar(20) NOT NULL,
  `email` varchar(40) NOT NULL,
  `score` smallint(6) NOT NULL,
  `birth_year` year(4) NOT NULL,
  `localy` enum('resident','foreign') NOT NULL,
  `sex` enum('male','female') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
COMMENT 'password_hash это хеш с солью полученный с помощью встроенной функции password_hash()';

--
-- Дамп данных таблицы `data`
--

INSERT INTO `data` (`id`, `login`, `password_hash`, `name`, `second_name`, `class`, `email`, `score`, `birth_year`, `localy`, `sex`) VALUES
(59, 'kirill', '$2y$10$QaJM7hZAY74wucDInA9nJOuygFQ04h1t.xbbECvpSVm8CtY81yKaS', 'Кирилл', 'Воробьев', '200', 'kirill@mail.ru', 300, 1998, 'resident', 'male'),
(60, 'antony', '$2y$10$oIYq4NmVmoiYQQl6zxA5uuvON6n/Krj2eH60H.oG0t/8JHIGFZw7y', 'Антон', 'Никитин', '100ргб', 'anton@yandex.ru', 250, 1993, 'foreign', 'male');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `data`
--
ALTER TABLE `data`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `data`
--
ALTER TABLE `data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
