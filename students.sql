-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Ноя 30 2017 г., 00:49
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
-- Структура таблицы `students`
--

CREATE TABLE `students` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='password_hash это хеш с солью полученный с помощью встроенной функции password_hash()';

--
-- Дамп данных таблицы `students`
--

INSERT INTO `students` (`id`, `login`, `password_hash`, `name`, `second_name`, `class`, `email`, `score`, `birth_year`, `localy`, `sex`) VALUES
(59, 'kirill', '$2y$10$QaJM7hZAY74wucDInA9nJOuygFQ04h1t.xbbECvpSVm8CtY81yKaS', 'Кирилл', 'Воробьев', '200', 'kirill@mail.ru', 300, 1998, 'resident', 'male'),
(60, 'antony', '$2y$10$oIYq4NmVmoiYQQl6zxA5uuvON6n/Krj2eH60H.oG0t/8JHIGFZw7y', 'Антон', 'Никитин', '100ргб', 'anton@yandex.ru', 250, 1993, 'foreign', 'male'),
(61, 'mike', '$2y$10$TSP9iVUM9brdEKJSrN7cQOYehdnzV7m.W0aJa0tFBxExJ8J3sG4Hi', 'Василий', 'Карпов', '50', 'mike@mail.ru', 300, 1998, 'resident', 'male'),
(62, 'nick', '$2y$10$9TYfK29/oh/EQLwcMt6XGe2Taf8RAC57TSs3PEeyRFuYw2rhN6RgW', 'Василий', 'Горох', '776', 'nick123@mail.ru', 150, 1993, 'resident', 'male'),
(64, 'lol', '$2y$10$o4gLJhaOpukT5m5d3cWQbu/uC9HlGUwrlCfXoTUUP9lKXP0g2WWvS', 'Виктория', 'Павлова', '106и', 'vika@mail.ru', 249, 2001, 'resident', 'female'),
(68, 'nikita', '$2y$10$4ZVbHk1KQSzD9kJWKgMpO.7HpE0vwbldPJj0y8XV18GGOmn7BTiYW', 'Куку', 'Панфилов', '150', 'nikita@yandex.ru', 200, 1993, 'resident', 'male'),
(69, 'das', '$2y$10$2d6r9k6M9PiEbSvn63HjheL7siw1haKwhW9KLE1N1864puYtQfnlC', 'das', 'das', 'ads', 'dadds@mail.ru', 200, 1993, 'resident', 'male'),
(70, 'dasdasdasda', '$2y$10$j6v4VdLJB8uOuOMLi5yHPuu/PcGSX6DjOwiWQIUBHNfpaiQQrBOFu', 'das', '123', '111', '12das@mail.ru', 100, 1997, 'resident', 'male');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
