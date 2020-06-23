-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Янв 29 2020 г., 14:57
-- Версия сервера: 5.5.62
-- Версия PHP: 5.6.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `mybase`
--

-- --------------------------------------------------------

--
-- Структура таблицы `admin`
--

CREATE TABLE `admin` (
  `bonus_reg` float NOT NULL,
  `group_vk` text NOT NULL,
  `referalka` text NOT NULL,
  `chat` int(11) NOT NULL,
  `bank` float NOT NULL,
  `zarabotok` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `admin`
--

INSERT INTO `admin` (`bonus_reg`, `group_vk`, `referalka`, `chat`, `bank`, `zarabotok`) VALUES
(15, 'https://vk.com/dragonmoney', '15', 0, 0, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `chat`
--

CREATE TABLE `chat` (
  `id` int(11) NOT NULL,
  `vk_id` int(11) NOT NULL,
  `login` text NOT NULL,
  `photo` text NOT NULL,
  `mess` text NOT NULL,
  `prava` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `chat`
--

INSERT INTO `chat` (`id`, `vk_id`, `login`, `photo`, `mess`, `prava`) VALUES
(1, 0, 'https://vk.com/debl0w', '', 'САЙТ НАПИСАН ИМ: https://vk.com/debl0w', '');

-- --------------------------------------------------------

--
-- Структура таблицы `deposit`
--

CREATE TABLE `deposit` (
  `id` int(11) NOT NULL,
  `AMOUNT` float NOT NULL,
  `intid` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `P_PHONE` text NOT NULL,
  `SIGN` text NOT NULL,
  `P_EMAIL` text NOT NULL,
  `data` text NOT NULL,
  `result` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `deposit`
--

INSERT INTO `deposit` (`id`, `AMOUNT`, `intid`, `user_id`, `P_PHONE`, `SIGN`, `P_EMAIL`, `data`, `result`) VALUES
(1, 1, '1', 111, '11', '1', '1', '', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `hilos-games`
--

CREATE TABLE `hilos-games` (
  `id` int(11) NOT NULL,
  `id_users` int(11) NOT NULL,
  `login` text NOT NULL,
  `hilo` int(11) NOT NULL,
  `diceRand` int(11) NOT NULL,
  `click` text NOT NULL,
  `bet` float NOT NULL,
  `coef` text NOT NULL,
  `result` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `mines-game`
--

CREATE TABLE `mines-game` (
  `id` int(11) NOT NULL,
  `id_users` int(11) NOT NULL,
  `login` text NOT NULL,
  `num_mines` int(11) NOT NULL,
  `bet` int(11) NOT NULL,
  `mines` text NOT NULL,
  `click` text NOT NULL,
  `onOff` text NOT NULL,
  `result` text NOT NULL,
  `step` int(11) NOT NULL,
  `win` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `login` text NOT NULL,
  `vk_id` int(11) NOT NULL,
  `number_wallet` text NOT NULL,
  `wallet` text NOT NULL,
  `sum` float NOT NULL,
  `data` text NOT NULL,
  `result` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `promocode`
--

CREATE TABLE `promocode` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `ost_activ` int(11) NOT NULL,
  `activ` int(11) NOT NULL,
  `users` text NOT NULL,
  `sum` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `sid` text NOT NULL,
  `vk_id` int(11) NOT NULL,
  `login` text NOT NULL,
  `prava` int(11) NOT NULL,
  `deposit` float NOT NULL,
  `referalov` int(11) NOT NULL,
  `vivod` float NOT NULL,
  `money` float NOT NULL,
  `ip` text NOT NULL,
  `ban` int(11) NOT NULL,
  `hilo` int(11) NOT NULL,
  `invited` int(11) NOT NULL,
  `photo_vk` text NOT NULL,
  `chat_ban` int(11) NOT NULL,
  `data` text NOT NULL,
  `ref_money` float NOT NULL,
  `bilet` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `wheel-games`
--

CREATE TABLE `wheel-games` (
  `id` int(11) NOT NULL,
  `id_users` int(11) NOT NULL,
  `login` text NOT NULL,
  `bet` float NOT NULL,
  `colorWheel` int(11) NOT NULL,
  `result` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `deposit`
--
ALTER TABLE `deposit`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `hilos-games`
--
ALTER TABLE `hilos-games`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `mines-game`
--
ALTER TABLE `mines-game`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `promocode`
--
ALTER TABLE `promocode`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `wheel-games`
--
ALTER TABLE `wheel-games`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `chat`
--
ALTER TABLE `chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `deposit`
--
ALTER TABLE `deposit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `hilos-games`
--
ALTER TABLE `hilos-games`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `mines-game`
--
ALTER TABLE `mines-game`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `promocode`
--
ALTER TABLE `promocode`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `wheel-games`
--
ALTER TABLE `wheel-games`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
