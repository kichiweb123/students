-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Ноя 17 2017 г., 16:11
-- Версия сервера: 5.5.25
-- Версия PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `table`
--

-- --------------------------------------------------------

--
-- Структура таблицы `data`
--

CREATE TABLE IF NOT EXISTS `data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` text,
  `pass` text,
  `name` text,
  `second_name` text,
  `grup` text NOT NULL,
  `email` text,
  `score` text,
  `age` text,
  `localy` text,
  `sex` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=56 ;

--
-- Дамп данных таблицы `data`
--

INSERT INTO `data` (`id`, `login`, `pass`, `name`, `second_name`, `grup`, `email`, `score`, `age`, `localy`, `sex`) VALUES
(6, 'Pasha', '1234', 'Павел', 'Песков', '100', 'pasha@mail.ru', '200', '1993', 'local1', 'male'),
(7, 'Vasya', 'qwert', 'Вася', 'Сумкин', '192', 'vasya@yandex.ru', '250', '1996', 'local2', 'male'),
(8, 'fedor1234', '1234', 'Федя', 'Пупкин', '322', 'fedor@mail.ru', '200', '1993', 'local1', 'male'),
(9, 'Grigory', '1234', 'Григорий', 'Адвокатов', '7м', 'grigory@mail.ru', '150', '2000', 'local1', 'male'),
(33, 'Андрей', '1234', 'Андрей', 'Песков', '100', 'andrew@mail.ru', '300', '1999', 'local1', 'male'),
(46, 'Pavel', '12345', 'Павел', 'Горохов', '987', 'pavel@mail.ru', '200', '1997', 'local1', 'male'),
(47, 'anton', '1234', 'Антон', 'Коржнев', '66', 'anton@mail.ru', '100', '1987', 'local2', 'male'),
(48, 'janna', '1234', 'Жанна', 'Агузарова', '322', 'janna@mail.ru', '300', '1995', 'local2', 'female'),
(49, 'margarita', '1234', 'Маргарита', 'Пышкина', '322', 'margarita@mail.ru', '100', '2000', 'local1', 'female'),
(50, 'garaz98', '1239', 'Иннокентий', 'Арбузов', '7м', 'garaz1998@mail.ru', '278', '1998', 'local2', 'male'),
(53, 'Николай', '9876', 'Николай', 'Романов', '400', 'romanov@yandex.ru', '200', '1998', 'local2', 'male'),
(55, 'Azamat322', '1234', 'Азамат', 'Абдурахманов', '158в', 'azamat@gmail.com', '289', '1995', 'local2', 'male');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
