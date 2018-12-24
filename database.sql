CREATE TABLE `following` (
  `id` int(255) NOT NULL,
  `user` int(255) DEFAULT NULL,
  `followed` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `following`
--

INSERT INTO `following` (`id`, `user`, `followed`) VALUES
(2, 12, 3),
(8, 12, 11),
(9, 13, 12),
(10, 12, 10),
(11, 12, 8),
(12, 12, 13),
(15, 12, 2),
(16, 13, 2),
(17, 13, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `likes`
--

CREATE TABLE `likes` (
  `id` int(255) NOT NULL,
  `user` int(255) DEFAULT NULL,
  `publication` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `likes`
--

INSERT INTO `likes` (`id`, `user`, `publication`) VALUES
(6, 12, 6),
(8, 12, 4),
(9, 12, NULL),
(10, 12, NULL),
(11, 12, NULL),
(12, 12, NULL),
(23, 13, 6),
(24, 13, 6),
(25, 13, 7),
(26, 12, 7),
(27, 13, 8),
(28, 13, 9),
(30, 12, 10),
(31, 12, 9),
(32, 12, 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notifications`
--

CREATE TABLE `notifications` (
  `id` int(255) NOT NULL,
  `user_id` int(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `type_id` int(255) DEFAULT NULL,
  `readed` varchar(3) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `extra` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `type`, `type_id`, `readed`, `created_at`, `extra`) VALUES
(1, 12, 'like', 13, '1', '2018-10-03 10:26:33', '6'),
(2, 12, 'like', 13, '1', '2018-10-04 09:01:43', '6'),
(3, 12, 'like', 13, '1', '2018-10-04 09:02:26', '7'),
(4, 12, 'like', 12, '1', '2018-10-04 09:03:29', '7'),
(5, 12, 'like', 13, '1', '2018-10-04 09:13:45', '8'),
(6, 12, 'like', 13, '1', '2018-10-04 09:25:47', '9'),
(7, 12, 'like', 13, '1', '2018-10-04 09:26:24', '10'),
(8, 10, 'follow', 12, '0', '2018-10-06 15:51:59', NULL),
(9, 12, 'like', 12, '1', '2018-10-06 20:54:33', '10'),
(10, 12, 'like', 12, '1', '2018-10-06 20:54:34', '9'),
(11, 12, 'like', 12, '1', '2018-10-06 20:54:35', '8'),
(12, 8, 'follow', 12, '0', '2018-10-06 20:54:49', NULL),
(13, 13, 'follow', 12, '1', '2018-10-06 20:54:51', NULL),
(14, 2, 'follow', 12, '0', '2018-10-07 14:41:38', NULL),
(15, 2, 'follow', 12, '0', '2018-10-07 14:41:40', NULL),
(16, 2, 'follow', 12, '0', '2018-10-07 14:43:00', NULL),
(17, 2, 'follow', 13, '0', '2018-10-09 18:03:45', NULL),
(18, 10, 'follow', 13, '0', '2018-10-09 18:04:10', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `private_messages`
--

CREATE TABLE `private_messages` (
  `id` int(255) NOT NULL,
  `message` longtext,
  `emitter` int(255) DEFAULT NULL,
  `receiver` int(255) DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `readed` varchar(3) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `private_messages`
--

INSERT INTO `private_messages` (`id`, `message`, `emitter`, `receiver`, `file`, `image`, `readed`, `created_at`) VALUES
(1, 'Holis, como estas?', 12, 11, NULL, NULL, '0', '2018-10-06 16:47:31'),
(2, 'Holis, como estas?\r\nTomamos una ...', 13, 12, NULL, NULL, '1', '2018-10-07 11:54:46'),
(3, 'kasdjalsdasdad', 13, 12, NULL, NULL, '1', '2018-10-07 11:56:33'),
(4, 'ausnmnf,amn,snfa,msnfaf', 13, 12, NULL, NULL, '1', '2018-10-07 12:18:21'),
(5, 'Hoy pude subir una aplicacion a la web.', 13, 12, NULL, NULL, '1', '2018-10-07 12:19:18'),
(6, 'Te estoy mando un nuevo mensaje. Hermosa', 13, 12, NULL, NULL, '1', '2018-10-07 12:34:30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `publications`
--

CREATE TABLE `publications` (
  `id` int(255) NOT NULL,
  `user_id` int(255) DEFAULT NULL,
  `text` mediumtext,
  `document` varchar(100) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` varchar(30) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `publications`
--

INSERT INTO `publications` (`id`, `user_id`, `text`, `document`, `image`, `status`, `created_at`) VALUES
(1, 11, 'Batman es gay', NULL, '153238747611.jpeg', NULL, '2018-07-23 20:11:16'),
(2, 11, 'I m your Father!!!', NULL, '153238754011.jpeg', NULL, '2018-07-23 20:12:20'),
(3, 11, 'Diseño Grafico - Teoria', '153238781411.pdf', '153238781411.png', NULL, '2018-07-23 20:16:54'),
(4, 10, 'Soy el mas lindo ...', NULL, '153238826910.png', NULL, '2018-07-23 20:24:29'),
(6, 12, 'Hoooooolisssss', NULL, '153835734412.jpeg', NULL, '2018-09-30 22:29:05'),
(7, 12, 'Hola Bombon', NULL, NULL, NULL, '2018-10-04 09:02:13'),
(8, 12, 'Chiche Bombob Americando', NULL, '153865520412.png', NULL, '2018-10-04 09:13:24'),
(9, 12, 'akjsjdalsdaklsdjalksdlkadslad', NULL, NULL, NULL, '2018-10-04 09:25:38'),
(10, 12, 'asjdnasmdkajsdhajhksdhaksdaiushda', NULL, '153865597312.jpeg', NULL, '2018-10-04 09:26:13');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `role` varchar(20) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `surname` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `nick` varchar(50) DEFAULT NULL,
  `bio` varchar(255) DEFAULT NULL,
  `active` varchar(2) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `role`, `email`, `name`, `surname`, `password`, `nick`, `bio`, `active`, `image`) VALUES
(2, 'Role User', 'geramargonzalez@gmail.com', 'Gerardo', 'Gonzalez', '$2y$04$OY6uEJWz7nZtXBaA9W115.vFEz8OqhUl1ACSzyZvDfgtx34B0Vx9C', 'Pepe', NULL, NULL, NULL),
(3, 'Role User', 'martinmartinez1891@gmail.com', 'Martin', 'Martinez', '$2y$04$ur89BrwozYDO/kGyFdfD/.aeIbgkbUlz/677DcYro6xWOcCiXs/em', 'Martincho', NULL, NULL, NULL),
(8, 'Role User', 'Rolon1234@gmail.com', 'Gabriel', 'Rolon', '$2y$04$YGUwMc8mewFKGQ/gl.Ix1u9IYRknN6fplRCEMJ99Cw8G0mz1kafpe', 'Gabriel', NULL, NULL, NULL),
(10, 'Role User', 'pablo2@gmail.com', 'Pablo2', 'Martinez2', '$2y$04$YrQrGvZWmC9LdLnVvZ0JeeI4BMnuzAYa5KJg21fT2rQab88HPrQmK', 'Lolo1', NULL, NULL, '153203735510.jpeg'),
(11, 'Role User', 'vader@gmail.com', 'Anakin', 'Skywalker', '$2y$04$RtmADPobms2NsvVjTXzIIufM3NztnMnuuIhaKNogwZPgwP7p/FrVW', 'LordVader', NULL, NULL, '153204861111.jpeg'),
(12, 'Role User', 'mari@gmail.com', 'Mariana', 'Sosa', '$2y$04$6kHi0QhNV85YPZ4uGSJXh..oFJcrNHSR5LK0gI1l3ceM37xtXE62m', 'Mari', NULL, NULL, NULL),
(13, 'Role User', 'pepe@gmail.com', 'Pepe', 'Gonzalez', '$2y$04$eP7OeitGvYaFkqnoTS7uH.m8fAFQfxq3cngjyyMfyS1Nej2TZVnty', 'pp', NULL, NULL, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `following`
--
ALTER TABLE `following`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_following_users` (`user`),
  ADD KEY `fk_followed` (`followed`);

--
-- Indices de la tabla `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_likes_users` (`user`),
  ADD KEY `fk_likes_publication` (`publication`);

--
-- Indices de la tabla `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_notifications_users` (`user_id`);

--
-- Indices de la tabla `private_messages`
--
ALTER TABLE `private_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_emmiter_privates` (`emitter`),
  ADD KEY `fk_receiver_privates` (`receiver`);

--
-- Indices de la tabla `publications`
--
ALTER TABLE `publications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_publications_users` (`user_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_uniques_fields` (`email`,`nick`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `following`
--
ALTER TABLE `following`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT de la tabla `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT de la tabla `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT de la tabla `private_messages`
--
ALTER TABLE `private_messages`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `publications`
--
ALTER TABLE `publications`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `following`
--
ALTER TABLE `following`
  ADD CONSTRAINT `fk_followed` FOREIGN KEY (`followed`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `fk_following_users` FOREIGN KEY (`user`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `fk_likes_publication` FOREIGN KEY (`publication`) REFERENCES `publications` (`id`),
  ADD CONSTRAINT `fk_likes_users` FOREIGN KEY (`user`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `fk_notifications_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `private_messages`
--
ALTER TABLE `private_messages`
  ADD CONSTRAINT `fk_emmiter_privates` FOREIGN KEY (`emitter`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `fk_receiver_privates` FOREIGN KEY (`receiver`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `publications`
--
ALTER TABLE `publications`
  ADD CONSTRAINT `fk_publications_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);