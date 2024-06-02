-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Июн 02 2024 г., 17:16
-- Версия сервера: 10.4.32-MariaDB
-- Версия PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `notequest_db`
--

-- --------------------------------------------------------

--
-- Структура таблицы `lessons`
--

CREATE TABLE `lessons` (
  `LessonID` int(11) NOT NULL,
  `Title` varchar(100) DEFAULT NULL,
  `Description` text DEFAULT NULL,
  `Content` text DEFAULT NULL,
  `Date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `lessons`
--

INSERT INTO `lessons` (`LessonID`, `Title`, `Description`, `Content`, `Date`) VALUES
(1, 'Звук и его высота', 'Понятие звуковых колебаний и их частоты, объясняя, как частота колебаний определяет высоту звука и как это используется в музыке для создания мелодий и гармоний.', '<p>\r\n                    Звук, как физическое явление, это колебания какого-либо объекта — например, струны, трубки в духовых инструментах, пластинки или мембраны. Эти колебания создают в воздухе волны, которые называют звуковыми. Когда эти звуковые волны достигают наших ушей, мы начинаем слышать звук.\r\n                </p>\r\n                <p>\r\n                    Источник звука и звуковые волны существуют независимо от нас. Однако наше восприятие звука зависит от работы ушей, слухового нерва и мозга. Ощущение звука — это преобразование энергии звуковой волны в сигнал, который наш мозг распознает как звук.\r\n                </p>\r\n                <p>\r\n                    Процесс выглядит так: колебания источника звука создают звуковые волны, которые достигают ушей. Затем уши передают этот сигнал в мозг через слуховой нерв.\r\n                </p>\r\n                <p>\r\n                    В природе существует множество звуков, которые мы можем слышать, но не все они пригодны для музыки. Музыкальные звуки отличаются от шума своими особенными свойствами. Они выбраны и организованы в определенную систему, которая развивалась на протяжении долгого времени.\r\n                </p>\r\n                <h2>Свойства звука</h2>\r\n                <p>\r\n                    Свойства звука определяются физическими причинами. Есть четыре основных свойства звука: высота, длительность, громкость и тембр.\r\n                </p>\r\n                <div class=\"learn-list\">\r\n                    <ul>\r\n                        <li>\r\n                            <p>\r\n                                <b>Высота звука</b> определяется частотой колебаний: чем чаще колебания, тем выше звук; чем реже — тем ниже. В музыке используются звуки с четко выраженной высотой, обычно в диапазоне от 16 до 4000 колебаний в секунду.\r\n                            </p>\r\n                        </li>\r\n                        <li>\r\n                            <p>\r\n                                <b>Длительность звука</b> — это то, как долго продолжается звук.\r\n                            </p>\r\n                        </li>\r\n                        <li>\r\n                            <p>\r\n                                <b>Громкость звука</b> зависит от силы колебаний. Чем сильнее колебания, тем громче звук.\r\n                            </p>\r\n                        </li>\r\n                        <li>\r\n                            <p>\r\n                                <b>Тембр</b> или окраска звука — это его уникальное звучание. Благодаря тембру мы можем отличить один инструмент от другого или голос одного человека от другого. Каждый звук состоит из множества частичных тонов, или обертонов. Например, струна колеблется не только как целое, но и по частям (половинам, третьям и так далее). Эти частичные колебания придают звуку его особый характер.</p>\r\n                        </li>\r\n                    </ul>\r\n                </div>\r\n<p>Таким образом, звук — это сложное сочетание множества частот, каждая из которых добавляет свой вклад в то, как мы воспринимаем звук.</p>\r\n<h2>Музыкальная система. Звукоряд. Камертон.</h2>\r\n<p>Музыкальная система — это отобранный практикой ряд звуков, которые находятся в определённых соотношениях по высоте. Она является результатом многовековой музыкальной практики и развития человеческого общества. В данном курсе рассматривается система, принятая в европейской, русской классической и советской музыке.</p>\r\n<p>Звукоряд — это совокупность звуков музыкальной системы, расположенных в порядке высоты (в восходящем или нисходящем направлении).</p>\r\n<p>Музыкальная система и её звукоряд сформировались прежде всего из-за певческой практики, поэтому большинство звуковых высот в системе соответствуют тем, на которых человек может петь. С развитием музыкального искусства появились инструменты, и система была дополнена звуками в диапазоне от 16 до 4000 колебаний в секунду. Однако наиболее выразительные звуки инструментов и человеческих голосов находятся примерно в диапазоне от 60 до 1000 колебаний в секунду.</p>', NULL),
(2, 'Ноты и интервалы', 'Изучение нот и интервалов для понимания музыки.', NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(50) NOT NULL,
  `role` enum('user','moderator') NOT NULL DEFAULT 'user',
  `password_hash` varchar(128) NOT NULL,
  `email` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `session_status` tinyint(1) DEFAULT 0,
  `avatar` varchar(255) NOT NULL DEFAULT 'default_avatar.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `username`, `role`, `password_hash`, `email`, `created_at`, `session_status`, `avatar`) VALUES
(1, 'Beeramon', 'user', '$2y$10$2bHayUl0.G11zK4vjSNcSO4a3gv3VIo6YvFB90vQYXxERjKtxjydC', 'to.hi.shi342@gmail.com', '2024-06-01 03:47:25', 0, ''),
(2, 'Beeramonq', 'user', '$2y$10$Tk6GsBplinWPelYo9bOIDup8Zl.8p8lASmPHodd2zBpKVYB3mGq92', 'test123@gmail.com', '2024-06-01 03:50:29', 0, ''),
(3, 'Beeramonqwe', 'user', '$2y$10$NzGFozcSh2nSGZ3qRmhHEO/RfwtsKHEDW44kQA9oD6.peDQx8QSTC', 'test1231@gmail.com', '2024-06-01 03:52:17', 0, ''),
(4, 'user', 'user', '$2y$10$WQFqbUPFWD0V5HWOOdk6XufLo8WR2Ef5OurLsbB5wcfkCKMQMaoiu', 'user@mail.ru', '2024-06-01 03:56:54', 0, ''),
(5, 'userq', 'user', '$2y$10$TmjeuTImvyLt9LfWN7gKjuy0NSzQQeeslsJIAcSG9N.6yUb8wpkI6', 'user2@mail.ru', '2024-06-01 03:57:30', 0, ''),
(6, 'Beeramonchik', 'user', '$2y$10$BskPIjgSxUysV2yWaWMTaeKm7ktEbtRvNT63CvsvLN/XKy/psxuWW', 'beeramon@mail.ru', '2024-06-01 04:02:45', 0, ''),
(7, 'userqwe', 'user', '$2y$10$Cl3uVkiEXTUnmaKq7vLAI.h87x5K.NzyVoKBLF.S9kq/ViZGjIRi6', 'userqwe@gmail.com', '2024-06-01 04:40:36', 0, ''),
(8, 'essense', 'user', '$2y$10$3wv0sX5J50mGX8Pr0KnH.OkDBbr3gRFUNCxAq0beL91JC3l/jAmZG', 'essense@mail.ru', '2024-06-01 06:09:06', 0, '');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `lessons`
--
ALTER TABLE `lessons`
  ADD PRIMARY KEY (`LessonID`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `lessons`
--
ALTER TABLE `lessons`
  MODIFY `LessonID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
