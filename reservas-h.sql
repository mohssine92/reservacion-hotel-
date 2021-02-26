-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-02-2021 a las 10:11:38
-- Versión del servidor: 10.1.38-MariaDB
-- Versión de PHP: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `reservas-h`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administradores`
--

CREATE TABLE `administradores` (
  `id` int(11) NOT NULL,
  `perfil` text NOT NULL,
  `nombre` text NOT NULL,
  `usuario` text NOT NULL,
  `password` text NOT NULL,
  `estado` int(11) NOT NULL,
  `fecha_admin` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `administradores`
--

INSERT INTO `administradores` (`id`, `perfil`, `nombre`, `usuario`, `password`, `estado`, `fecha_admin`) VALUES
(5, 'Administrador', 'Hotel Portobel', 'Hamza', '$2a$07$asxx54ahjppf45sd87a5auFL5K1.Cmt9ZheoVVuudOi5BCi10qWly', 1, '2021-02-25 21:36:28'),
(6, 'Administrador', 'casa', 'aziz', '$2a$07$asxx54ahjppf45sd87a5auFL5K1.Cmt9ZheoVVuudOi5BCi10qWly', 1, '2021-02-25 21:37:27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `agenda`
--

CREATE TABLE `agenda` (
  `id` int(11) NOT NULL,
  `id_habitacion` int(11) NOT NULL,
  `fecha_ingreso` datetime NOT NULL,
  `fecha_salida` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `agenda`
--

INSERT INTO `agenda` (`id`, `id_habitacion`, `fecha_ingreso`, `fecha_salida`) VALUES
(1, 1, '2021-02-26 18:00:00', '2021-02-26 19:00:00'),
(2, 2, '2021-02-26 18:00:00', '2021-02-26 19:00:00'),
(3, 3, '2021-02-26 18:00:00', '2021-02-26 19:00:00'),
(4, 4, '2021-02-27 18:00:00', '2021-02-26 19:00:00'),
(5, 5, '2021-02-26 18:00:00', '2021-02-26 19:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `banner`
--

CREATE TABLE `banner` (
  `id` int(11) NOT NULL,
  `img` text NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `banner`
--

INSERT INTO `banner` (`id`, `img`, `fecha`) VALUES
(1, 'vistas/img/banner/159.jpg', '2021-02-25 17:41:38'),
(2, 'vistas/img/banner/563.jpg', '2021-02-25 18:52:57'),
(3, 'vistas/img/banner/573.jpg', '2021-02-25 17:42:05'),
(4, 'vistas/img/banner/955.jpg', '2021-02-25 18:12:16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id_cat` int(11) NOT NULL,
  `ruta` text NOT NULL,
  `color` text NOT NULL,
  `tipo` text NOT NULL,
  `img` text NOT NULL,
  `descripcion_cat` text NOT NULL,
  `incluye` text NOT NULL,
  `continental_alta` float NOT NULL,
  `continental_baja` float NOT NULL,
  `americano_alta` float NOT NULL,
  `americano_baja` float NOT NULL,
  `fecha_cat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id_cat`, `ruta`, `color`, `tipo`, `img`, `descripcion_cat`, `incluye`, `continental_alta`, `continental_baja`, `americano_alta`, `americano_baja`, `fecha_cat`) VALUES
(1, 'habitacion-tipo-suite', '#847059', 'Suite', 'vistas/img/suite/portada.png', 'Lorem ipsum dolor sit amet', '[{ \"item\": \"cama 2 x 2\", \"icono\": \"fas fa-bed\"},\r\n{ \"item\": \"TV de 42 Pulg\", \"icono\": \"fas fa-tv\"},\r\n{ \"item\": \"Agua Caliente\", \"icono\": \"fas fa-tint\"},\r\n{ \"item\": \"Jacuzzi\", \"icono\": \"fas fa-water\"},\r\n{ \"item\": \"Baño privado\", \"icono\": \"fas fa-toilet\"},\r\n{ \"item\": \"Sofá\", \"icono\": \"fas fa-couch\"},\r\n{ \"item\": \"Balcón\", \"icono\": \"far fa-image\"},\r\n{ \"item\": \"Servicio Wifi\", \"icono\": \"fas fa-wifi\"}]', 350, 300, 420, 380, '2019-04-09 16:20:30'),
(2, 'habitacion-tipo-especial', '#197DB1', 'Especial', 'vistas/img/especial/portada.png', 'Lorem ipsum dolor sit amet', '[{ \"item\": \"cama 2 x 2\", \"icono\": \"fas fa-bed\"},\r\n{ \"item\": \"TV de 42 Pulg\", \"icono\": \"fas fa-tv\"},\r\n{ \"item\": \"Agua Caliente\", \"icono\": \"fas fa-tint\"},\r\n{ \"item\": \"Baño privado\", \"icono\": \"fas fa-toilet\"},\r\n{ \"item\": \"Sofá\", \"icono\": \"fas fa-couch\"},\r\n{ \"item\": \"Balcón\", \"icono\": \"far fa-image\"},\r\n{ \"item\": \"Servicio Wifi\", \"icono\": \"fas fa-wifi\"}]', 300, 250, 380, 350, '2019-04-09 16:20:35'),
(3, 'habitacion-tipo-standar', '#2F7D84', 'Standar', 'vistas/img/standar/portada.png', 'Lorem ipsum dolor sit amet', '[{ \"item\": \"cama 2 x 2\", \"icono\": \"fas fa-bed\"},\r\n{ \"item\": \"TV de 42 Pulg\", \"icono\": \"fas fa-tv\"},\r\n{ \"item\": \"Agua Caliente\", \"icono\": \"fas fa-tint\"},\r\n{ \"item\": \"Baño privado\", \"icono\": \"fas fa-toilet\"},\r\n{ \"item\": \"Sofá\", \"icono\": \"fas fa-couch\"},\r\n{ \"item\": \"Servicio Wifi\", \"icono\": \"fas fa-wifi\"}]', 250, 200, 350, 300, '2019-04-09 16:20:41');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `habitaciones`
--

CREATE TABLE `habitaciones` (
  `id_h` int(11) NOT NULL,
  `categoria_id` int(11) NOT NULL,
  `estilo` text NOT NULL,
  `galeria` text NOT NULL,
  `video` text NOT NULL,
  `recorrido_virtual` text NOT NULL,
  `descripcion_h` text NOT NULL,
  `fecha_h` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `habitaciones`
--

INSERT INTO `habitaciones` (`id_h`, `categoria_id`, `estilo`, `galeria`, `video`, `recorrido_virtual`, `descripcion_h`, `fecha_h`) VALUES
(1, 1, 'Oriental', '[\"vistas/img/suite/oriental01.jpg\", \"vistas/img/suite/oriental02.jpg\", \"vistas/img/suite/oriental03.jpg\",\"vistas/img/suite/oriental04.jpg\"]\r\n', 'JTu790_yyRc', 'vistas/img/suite/oriental-360.jpg', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum sit, quia blanditiis fugiat nam libero possimus totam modi sint autem repellat fugit dicta est pariatur? Ut aut vel ad sapiente. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae, reprehenderit! Deserunt laborum dolorum deleniti molestiae quae vitae animi ratione nihil, minus ut quibusdam incidunt voluptate eos sed id repudiandae ex.\r\n					</p>	\r\n\r\n					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum sit, quia blanditiis fugiat nam libero possimus totam modi sint autem repellat fugit dicta est pariatur? Ut aut vel ad sapiente. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae, reprehenderit! Deserunt laborum dolorum deleniti molestiae quae vitae animi ratione nihil, minus ut quibusdam incidunt voluptate eos sed id repudiandae ex.\r\n					</p>\r\n\r\n					<br>\r\n\r\n					<h3>PLAN CONTINENTAL</h3>\r\n\r\n					<p>(Precio x pareja 1 día 1 noche, incluye: desayuno)<br>\r\n					Temporada Baja: $300.000 COP<br>\r\n					Temporada Alta: $350.000 COP</p>	\r\n\r\n					<br>\r\n\r\n					<h3>PLAN AMERICANO</h3>\r\n\r\n					<p>(Precio x pareja 1 día 1 noche, incluye: cena, desayuno, almuerzo)<br>\r\n					Temporada Baja: $380.000 COP<br>\r\n					Temporada Alta: $420.000 COP</p>\r\n					\r\n					<br>\r\n\r\n					<p class=\"text-danger\">Hora de entrada (Check in) 3:00 pm | Hora de salida (Check out) 1:00 pm</p>', '2019-04-09 00:08:48'),
(2, 1, 'Moderna', '[\"vistas/img/suite/moderna01.jpg\", \"vistas/img/suite/moderna02.jpg\", \"vistas/img/suite/moderna03.jpg\",\"vistas/img/suite/moderna04.jpg\"]\r\n\r\n', 'JTu790_yyRc', 'vistas/img/suite/moderna-360.jpg', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum sit, quia blanditiis fugiat nam libero possimus totam modi sint autem repellat fugit dicta est pariatur? Ut aut vel ad sapiente. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae, reprehenderit! Deserunt laborum dolorum deleniti molestiae quae vitae animi ratione nihil, minus ut quibusdam incidunt voluptate eos sed id repudiandae ex.\r\n					</p>	\r\n\r\n					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum sit, quia blanditiis fugiat nam libero possimus totam modi sint autem repellat fugit dicta est pariatur? Ut aut vel ad sapiente. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae, reprehenderit! Deserunt laborum dolorum deleniti molestiae quae vitae animi ratione nihil, minus ut quibusdam incidunt voluptate eos sed id repudiandae ex.\r\n					</p>\r\n\r\n					<br>\r\n\r\n					<h3>PLAN CONTINENTAL</h3>\r\n\r\n					<p>(Precio x pareja 1 día 1 noche, incluye: desayuno)<br>\r\n					Temporada Baja: $300.000 COP<br>\r\n					Temporada Alta: $350.000 COP</p>	\r\n\r\n					<br>\r\n\r\n					<h3>PLAN AMERICANO</h3>\r\n\r\n					<p>(Precio x pareja 1 día 1 noche, incluye: cena, desayuno, almuerzo)<br>\r\n					Temporada Baja: $380.000 COP<br>\r\n					Temporada Alta: $420.000 COP</p>\r\n					\r\n					<br>\r\n\r\n					<p>Hora de entrada (Check in) 3:00 pm | Hora de salida (Check out) 1:00 pm</p>', '2019-04-09 00:08:52'),
(3, 1, 'Africana', '[\"vistas/img/suite/africana01.jpg\", \"vistas/img/suite/africana02.jpg\", \"vistas/img/suite/africana03.jpg\",\"vistas/img/suite/africana04.jpg\"]\r\n', 'JTu790_yyRc', 'vistas/img/suite/africana-360.jpg', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum sit, quia blanditiis fugiat nam libero possimus totam modi sint autem repellat fugit dicta est pariatur? Ut aut vel ad sapiente. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae, reprehenderit! Deserunt laborum dolorum deleniti molestiae quae vitae animi ratione nihil, minus ut quibusdam incidunt voluptate eos sed id repudiandae ex.\r\n					</p>	\r\n\r\n					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum sit, quia blanditiis fugiat nam libero possimus totam modi sint autem repellat fugit dicta est pariatur? Ut aut vel ad sapiente. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae, reprehenderit! Deserunt laborum dolorum deleniti molestiae quae vitae animi ratione nihil, minus ut quibusdam incidunt voluptate eos sed id repudiandae ex.\r\n					</p>\r\n\r\n					<br>\r\n\r\n					<h3>PLAN CONTINENTAL</h3>\r\n\r\n					<p>(Precio x pareja 1 día 1 noche, incluye: desayuno)<br>\r\n					Temporada Baja: $300.000 COP<br>\r\n					Temporada Alta: $350.000 COP</p>	\r\n\r\n					<br>\r\n\r\n					<h3>PLAN AMERICANO</h3>\r\n\r\n					<p>(Precio x pareja 1 día 1 noche, incluye: cena, desayuno, almuerzo)<br>\r\n					Temporada Baja: $380.000 COP<br>\r\n					Temporada Alta: $420.000 COP</p>\r\n					\r\n					<br>\r\n\r\n					<p>Hora de entrada (Check in) 3:00 pm | Hora de salida (Check out) 1:00 pm</p>', '2019-04-09 00:08:56'),
(4, 1, 'Clásica', '[\"vistas/img/suite/clasica01.jpg\", \"vistas/img/suite/clasica02.jpg\", \"vistas/img/suite/clasica03.jpg\",\"vistas/img/suite/clasica04.jpg\"]\r\n', 'JTu790_yyRc', 'vistas/img/suite/clasica-360.jpg', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum sit, quia blanditiis fugiat nam libero possimus totam modi sint autem repellat fugit dicta est pariatur? Ut aut vel ad sapiente. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae, reprehenderit! Deserunt laborum dolorum deleniti molestiae quae vitae animi ratione nihil, minus ut quibusdam incidunt voluptate eos sed id repudiandae ex.\r\n					</p>	\r\n\r\n					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum sit, quia blanditiis fugiat nam libero possimus totam modi sint autem repellat fugit dicta est pariatur? Ut aut vel ad sapiente. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae, reprehenderit! Deserunt laborum dolorum deleniti molestiae quae vitae animi ratione nihil, minus ut quibusdam incidunt voluptate eos sed id repudiandae ex.\r\n					</p>\r\n\r\n					<br>\r\n\r\n					<h3>PLAN CONTINENTAL</h3>\r\n\r\n					<p>(Precio x pareja 1 día 1 noche, incluye: desayuno)<br>\r\n					Temporada Baja: $300.000 COP<br>\r\n					Temporada Alta: $350.000 COP</p>	\r\n\r\n					<br>\r\n\r\n					<h3>PLAN AMERICANO</h3>\r\n\r\n					<p>(Precio x pareja 1 día 1 noche, incluye: cena, desayuno, almuerzo)<br>\r\n					Temporada Baja: $380.000 COP<br>\r\n					Temporada Alta: $420.000 COP</p>\r\n					\r\n					<br>\r\n\r\n					<p>Hora de entrada (Check in) 3:00 pm | Hora de salida (Check out) 1:00 pm</p>', '2019-04-09 00:08:59'),
(5, 1, 'Retro', '[\"vistas/img/suite/retro01.jpg\", \"vistas/img/suite/retro02.jpg\", \"vistas/img/suite/retro03.jpg\",\"vistas/img/suite/retro04.jpg\"]\r\n', 'JTu790_yyRc', 'vistas/img/suite/retro-360.jpg', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum sit, quia blanditiis fugiat nam libero possimus totam modi sint autem repellat fugit dicta est pariatur? Ut aut vel ad sapiente. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae, reprehenderit! Deserunt laborum dolorum deleniti molestiae quae vitae animi ratione nihil, minus ut quibusdam incidunt voluptate eos sed id repudiandae ex.\r\n					</p>	\r\n\r\n					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum sit, quia blanditiis fugiat nam libero possimus totam modi sint autem repellat fugit dicta est pariatur? Ut aut vel ad sapiente. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae, reprehenderit! Deserunt laborum dolorum deleniti molestiae quae vitae animi ratione nihil, minus ut quibusdam incidunt voluptate eos sed id repudiandae ex.\r\n					</p>\r\n\r\n					<br>\r\n\r\n					<h3>PLAN CONTINENTAL</h3>\r\n\r\n					<p>(Precio x pareja 1 día 1 noche, incluye: desayuno)<br>\r\n					Temporada Baja: $300.000 COP<br>\r\n					Temporada Alta: $350.000 COP</p>	\r\n\r\n					<br>\r\n\r\n					<h3>PLAN AMERICANO</h3>\r\n\r\n					<p>(Precio x pareja 1 día 1 noche, incluye: cena, desayuno, almuerzo)<br>\r\n					Temporada Baja: $380.000 COP<br>\r\n					Temporada Alta: $420.000 COP</p>\r\n					\r\n					<br>\r\n\r\n					<p>Hora de entrada (Check in) 3:00 pm | Hora de salida (Check out) 1:00 pm</p>', '2019-04-09 00:09:03'),
(6, 2, 'Oriental', '[\"vistas/img/especial/oriental01.jpg\", \"vistas/img/especial/oriental02.jpg\", \"vistas/img/especial/oriental03.jpg\",\"vistas/img/especial/oriental04.jpg\"]\r\n', 'JTu790_yyRc', 'vistas/img/especial/oriental-360.jpg', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum sit, quia blanditiis fugiat nam libero possimus totam modi sint autem repellat fugit dicta est pariatur? Ut aut vel ad sapiente. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae, reprehenderit! Deserunt laborum dolorum deleniti molestiae quae vitae animi ratione nihil, minus ut quibusdam incidunt voluptate eos sed id repudiandae ex.\r\n					</p>	\r\n\r\n					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum sit, quia blanditiis fugiat nam libero possimus totam modi sint autem repellat fugit dicta est pariatur? Ut aut vel ad sapiente. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae, reprehenderit! Deserunt laborum dolorum deleniti molestiae quae vitae animi ratione nihil, minus ut quibusdam incidunt voluptate eos sed id repudiandae ex.\r\n					</p>\r\n\r\n					<br>\r\n\r\n					<h3>PLAN CONTINENTAL</h3>\r\n\r\n					<p>(Precio x pareja 1 día 1 noche, incluye: desayuno)<br>\r\n					Temporada Baja: $300.000 COP<br>\r\n					Temporada Alta: $350.000 COP</p>	\r\n\r\n					<br>\r\n\r\n					<h3>PLAN AMERICANO</h3>\r\n\r\n					<p>(Precio x pareja 1 día 1 noche, incluye: cena, desayuno, almuerzo)<br>\r\n					Temporada Baja: $380.000 COP<br>\r\n					Temporada Alta: $420.000 COP</p>\r\n					\r\n					<br>\r\n\r\n					<p>Hora de entrada (Check in) 3:00 pm | Hora de salida (Check out) 1:00 pm</p>', '2019-04-09 00:09:05'),
(7, 2, 'Moderna', '[\"vistas/img/especial/moderna01.jpg\", \"vistas/img/especial/moderna02.jpg\", \"vistas/img/especial/moderna03.jpg\",\"vistas/img/especial/moderna04.jpg\"]', 'JTu790_yyRc', 'vistas/img/especial/moderna-360.jpg', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum sit, quia blanditiis fugiat nam libero possimus totam modi sint autem repellat fugit dicta est pariatur? Ut aut vel ad sapiente. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae, reprehenderit! Deserunt laborum dolorum deleniti molestiae quae vitae animi ratione nihil, minus ut quibusdam incidunt voluptate eos sed id repudiandae ex.\r\n					</p>	\r\n\r\n					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum sit, quia blanditiis fugiat nam libero possimus totam modi sint autem repellat fugit dicta est pariatur? Ut aut vel ad sapiente. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae, reprehenderit! Deserunt laborum dolorum deleniti molestiae quae vitae animi ratione nihil, minus ut quibusdam incidunt voluptate eos sed id repudiandae ex.\r\n					</p>\r\n\r\n					<br>\r\n\r\n					<h3>PLAN CONTINENTAL</h3>\r\n\r\n					<p>(Precio x pareja 1 día 1 noche, incluye: desayuno)<br>\r\n					Temporada Baja: $300.000 COP<br>\r\n					Temporada Alta: $350.000 COP</p>	\r\n\r\n					<br>\r\n\r\n					<h3>PLAN AMERICANO</h3>\r\n\r\n					<p>(Precio x pareja 1 día 1 noche, incluye: cena, desayuno, almuerzo)<br>\r\n					Temporada Baja: $380.000 COP<br>\r\n					Temporada Alta: $420.000 COP</p>\r\n					\r\n					<br>\r\n\r\n					<p>Hora de entrada (Check in) 3:00 pm | Hora de salida (Check out) 1:00 pm</p>', '2019-04-09 00:09:08'),
(8, 2, 'Africana', '[\"vistas/img/especial/africana01.jpg\", \"vistas/img/especial/africana02.jpg\", \"vistas/img/especial/africana03.jpg\",\"vistas/img/especial/africana04.jpg\"]\r\n', 'JTu790_yyRc', 'vistas/img/especial/africana-360.jpg', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum sit, quia blanditiis fugiat nam libero possimus totam modi sint autem repellat fugit dicta est pariatur? Ut aut vel ad sapiente. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae, reprehenderit! Deserunt laborum dolorum deleniti molestiae quae vitae animi ratione nihil, minus ut quibusdam incidunt voluptate eos sed id repudiandae ex.\r\n					</p>	\r\n\r\n					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum sit, quia blanditiis fugiat nam libero possimus totam modi sint autem repellat fugit dicta est pariatur? Ut aut vel ad sapiente. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae, reprehenderit! Deserunt laborum dolorum deleniti molestiae quae vitae animi ratione nihil, minus ut quibusdam incidunt voluptate eos sed id repudiandae ex.\r\n					</p>\r\n\r\n					<br>\r\n\r\n					<h3>PLAN CONTINENTAL</h3>\r\n\r\n					<p>(Precio x pareja 1 día 1 noche, incluye: desayuno)<br>\r\n					Temporada Baja: $300.000 COP<br>\r\n					Temporada Alta: $350.000 COP</p>	\r\n\r\n					<br>\r\n\r\n					<h3>PLAN AMERICANO</h3>\r\n\r\n					<p>(Precio x pareja 1 día 1 noche, incluye: cena, desayuno, almuerzo)<br>\r\n					Temporada Baja: $380.000 COP<br>\r\n					Temporada Alta: $420.000 COP</p>\r\n					\r\n					<br>\r\n\r\n					<p>Hora de entrada (Check in) 3:00 pm | Hora de salida (Check out) 1:00 pm</p>', '2019-04-09 00:09:11'),
(9, 2, 'Árabe', '[\"vistas/img/especial/arabe01.jpg\", \"vistas/img/especial/arabe02.jpg\", \"vistas/img/especial/arabe03.jpg\",\"vistas/img/especial/arabe04.jpg\"]', 'JTu790_yyRc', 'vistas/img/especial/arabe-360.jpg', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum sit, quia blanditiis fugiat nam libero possimus totam modi sint autem repellat fugit dicta est pariatur? Ut aut vel ad sapiente. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae, reprehenderit! Deserunt laborum dolorum deleniti molestiae quae vitae animi ratione nihil, minus ut quibusdam incidunt voluptate eos sed id repudiandae ex.\r\n					</p>	\r\n\r\n					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum sit, quia blanditiis fugiat nam libero possimus totam modi sint autem repellat fugit dicta est pariatur? Ut aut vel ad sapiente. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae, reprehenderit! Deserunt laborum dolorum deleniti molestiae quae vitae animi ratione nihil, minus ut quibusdam incidunt voluptate eos sed id repudiandae ex.\r\n					</p>\r\n\r\n					<br>\r\n\r\n					<h3>PLAN CONTINENTAL</h3>\r\n\r\n					<p>(Precio x pareja 1 día 1 noche, incluye: desayuno)<br>\r\n					Temporada Baja: $300.000 COP<br>\r\n					Temporada Alta: $350.000 COP</p>	\r\n\r\n					<br>\r\n\r\n					<h3>PLAN AMERICANO</h3>\r\n\r\n					<p>(Precio x pareja 1 día 1 noche, incluye: cena, desayuno, almuerzo)<br>\r\n					Temporada Baja: $380.000 COP<br>\r\n					Temporada Alta: $420.000 COP</p>\r\n					\r\n					<br>\r\n\r\n					<p>Hora de entrada (Check in) 3:00 pm | Hora de salida (Check out) 1:00 pm</p>', '2019-04-09 00:09:14'),
(10, 2, 'Romana', '[\"vistas/img/especial/romana01.jpg\", \"vistas/img/especial/romana02.jpg\", \"vistas/img/especial/romana03.jpg\",\"vistas/img/especial/romana04.jpg\"]', 'JTu790_yyRc', 'vistas/img/especial/romana-360.jpg', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum sit, quia blanditiis fugiat nam libero possimus totam modi sint autem repellat fugit dicta est pariatur? Ut aut vel ad sapiente. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae, reprehenderit! Deserunt laborum dolorum deleniti molestiae quae vitae animi ratione nihil, minus ut quibusdam incidunt voluptate eos sed id repudiandae ex.\r\n					</p>	\r\n\r\n					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum sit, quia blanditiis fugiat nam libero possimus totam modi sint autem repellat fugit dicta est pariatur? Ut aut vel ad sapiente. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae, reprehenderit! Deserunt laborum dolorum deleniti molestiae quae vitae animi ratione nihil, minus ut quibusdam incidunt voluptate eos sed id repudiandae ex.\r\n					</p>\r\n\r\n					<br>\r\n\r\n					<h3>PLAN CONTINENTAL</h3>\r\n\r\n					<p>(Precio x pareja 1 día 1 noche, incluye: desayuno)<br>\r\n					Temporada Baja: $300.000 COP<br>\r\n					Temporada Alta: $350.000 COP</p>	\r\n\r\n					<br>\r\n\r\n					<h3>PLAN AMERICANO</h3>\r\n\r\n					<p>(Precio x pareja 1 día 1 noche, incluye: cena, desayuno, almuerzo)<br>\r\n					Temporada Baja: $380.000 COP<br>\r\n					Temporada Alta: $420.000 COP</p>\r\n					\r\n					<br>\r\n\r\n					<p>Hora de entrada (Check in) 3:00 pm | Hora de salida (Check out) 1:00 pm</p>', '2019-04-09 00:09:16'),
(11, 3, 'Caribeña', '[\"vistas/img/standar/caribena01.jpg\", \"vistas/img/standar/caribena02.jpg\", \"vistas/img/standar/caribena03.jpg\",\"vistas/img/standar/caribena04.jpg\"]', 'JTu790_yyRc', 'vistas/img/standar/caribena-360.jpg', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum sit, quia blanditiis fugiat nam libero possimus totam modi sint autem repellat fugit dicta est pariatur? Ut aut vel ad sapiente. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae, reprehenderit! Deserunt laborum dolorum deleniti molestiae quae vitae animi ratione nihil, minus ut quibusdam incidunt voluptate eos sed id repudiandae ex.\r\n					</p>	\r\n\r\n					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum sit, quia blanditiis fugiat nam libero possimus totam modi sint autem repellat fugit dicta est pariatur? Ut aut vel ad sapiente. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae, reprehenderit! Deserunt laborum dolorum deleniti molestiae quae vitae animi ratione nihil, minus ut quibusdam incidunt voluptate eos sed id repudiandae ex.\r\n					</p>\r\n\r\n					<br>\r\n\r\n					<h3>PLAN CONTINENTAL</h3>\r\n\r\n					<p>(Precio x pareja 1 día 1 noche, incluye: desayuno)<br>\r\n					Temporada Baja: $300.000 COP<br>\r\n					Temporada Alta: $350.000 COP</p>	\r\n\r\n					<br>\r\n\r\n					<h3>PLAN AMERICANO</h3>\r\n\r\n					<p>(Precio x pareja 1 día 1 noche, incluye: cena, desayuno, almuerzo)<br>\r\n					Temporada Baja: $380.000 COP<br>\r\n					Temporada Alta: $420.000 COP</p>\r\n					\r\n					<br>\r\n\r\n					<p>Hora de entrada (Check in) 3:00 pm | Hora de salida (Check out) 1:00 pm</p>', '2019-04-09 00:09:20'),
(12, 3, 'Colonial', '[\"vistas/img/standar/colonial01.jpg\", \"vistas/img/standar/colonial02.jpg\", \"vistas/img/standar/colonial03.jpg\",\"vistas/img/standar/colonial04.jpg\"]\r\n', 'JTu790_yyRc', 'vistas/img/standar/colonial-360.jpg', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum sit, quia blanditiis fugiat nam libero possimus totam modi sint autem repellat fugit dicta est pariatur? Ut aut vel ad sapiente. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae, reprehenderit! Deserunt laborum dolorum deleniti molestiae quae vitae animi ratione nihil, minus ut quibusdam incidunt voluptate eos sed id repudiandae ex.\r\n					</p>	\r\n\r\n					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum sit, quia blanditiis fugiat nam libero possimus totam modi sint autem repellat fugit dicta est pariatur? Ut aut vel ad sapiente. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae, reprehenderit! Deserunt laborum dolorum deleniti molestiae quae vitae animi ratione nihil, minus ut quibusdam incidunt voluptate eos sed id repudiandae ex.\r\n					</p>\r\n\r\n					<br>\r\n\r\n					<h3>PLAN CONTINENTAL</h3>\r\n\r\n					<p>(Precio x pareja 1 día 1 noche, incluye: desayuno)<br>\r\n					Temporada Baja: $300.000 COP<br>\r\n					Temporada Alta: $350.000 COP</p>	\r\n\r\n					<br>\r\n\r\n					<h3>PLAN AMERICANO</h3>\r\n\r\n					<p>(Precio x pareja 1 día 1 noche, incluye: cena, desayuno, almuerzo)<br>\r\n					Temporada Baja: $380.000 COP<br>\r\n					Temporada Alta: $420.000 COP</p>\r\n					\r\n					<br>\r\n\r\n					<p>Hora de entrada (Check in) 3:00 pm | Hora de salida (Check out) 1:00 pm</p>', '2019-04-09 00:09:26'),
(13, 3, 'Hindú', '[\"vistas/img/standar/hindu01.jpg\", \"vistas/img/standar/hindu02.jpg\", \"vistas/img/standar/hindu03.jpg\",\"vistas/img/standar/hindu04.jpg\"]', 'JTu790_yyRc', 'vistas/img/standar/hindu-360.jpg', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum sit, quia blanditiis fugiat nam libero possimus totam modi sint autem repellat fugit dicta est pariatur? Ut aut vel ad sapiente. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae, reprehenderit! Deserunt laborum dolorum deleniti molestiae quae vitae animi ratione nihil, minus ut quibusdam incidunt voluptate eos sed id repudiandae ex.\r\n					</p>	\r\n\r\n					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum sit, quia blanditiis fugiat nam libero possimus totam modi sint autem repellat fugit dicta est pariatur? Ut aut vel ad sapiente. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae, reprehenderit! Deserunt laborum dolorum deleniti molestiae quae vitae animi ratione nihil, minus ut quibusdam incidunt voluptate eos sed id repudiandae ex.\r\n					</p>\r\n\r\n					<br>\r\n\r\n					<h3>PLAN CONTINENTAL</h3>\r\n\r\n					<p>(Precio x pareja 1 día 1 noche, incluye: desayuno)<br>\r\n					Temporada Baja: $300.000 COP<br>\r\n					Temporada Alta: $350.000 COP</p>	\r\n\r\n					<br>\r\n\r\n					<h3>PLAN AMERICANO</h3>\r\n\r\n					<p>(Precio x pareja 1 día 1 noche, incluye: cena, desayuno, almuerzo)<br>\r\n					Temporada Baja: $380.000 COP<br>\r\n					Temporada Alta: $420.000 COP</p>\r\n					\r\n					<br>\r\n\r\n					<p>Hora de entrada (Check in) 3:00 pm | Hora de salida (Check out) 1:00 pm</p>', '2019-04-09 00:09:31'),
(14, 3, 'Marroquí', '[\"vistas/img/standar/marroqui01.jpg\", \"vistas/img/standar/marroqui02.jpg\", \"vistas/img/standar/marroqui03.jpg\",\"vistas/img/standar/marroqui04.jpg\"]', 'JTu790_yyRc', 'vistas/img/standar/marroqui-360.jpg', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum sit, quia blanditiis fugiat nam libero possimus totam modi sint autem repellat fugit dicta est pariatur? Ut aut vel ad sapiente. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae, reprehenderit! Deserunt laborum dolorum deleniti molestiae quae vitae animi ratione nihil, minus ut quibusdam incidunt voluptate eos sed id repudiandae ex.\r\n					</p>	\r\n\r\n					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum sit, quia blanditiis fugiat nam libero possimus totam modi sint autem repellat fugit dicta est pariatur? Ut aut vel ad sapiente. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae, reprehenderit! Deserunt laborum dolorum deleniti molestiae quae vitae animi ratione nihil, minus ut quibusdam incidunt voluptate eos sed id repudiandae ex.\r\n					</p>\r\n\r\n					<br>\r\n\r\n					<h3>PLAN CONTINENTAL</h3>\r\n\r\n					<p>(Precio x pareja 1 día 1 noche, incluye: desayuno)<br>\r\n					Temporada Baja: $300.000 COP<br>\r\n					Temporada Alta: $350.000 COP</p>	\r\n\r\n					<br>\r\n\r\n					<h3>PLAN AMERICANO</h3>\r\n\r\n					<p>(Precio x pareja 1 día 1 noche, incluye: cena, desayuno, almuerzo)<br>\r\n					Temporada Baja: $380.000 COP<br>\r\n					Temporada Alta: $420.000 COP</p>\r\n					\r\n					<br>\r\n\r\n					<p>Hora de entrada (Check in) 3:00 pm | Hora de salida (Check out) 1:00 pm</p>', '2019-04-09 00:09:34'),
(15, 3, 'Retro', '[\"vistas/img/standar/retro01.jpg\", \"vistas/img/standar/retro02.jpg\", \"vistas/img/standar/retro03.jpg\",\"vistas/img/standar/retro04.jpg\"]\r\n', 'JTu790_yyRc', 'vistas/img/standar/retro-360.jpg', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum sit, quia blanditiis fugiat nam libero possimus totam modi sint autem repellat fugit dicta est pariatur? Ut aut vel ad sapiente. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae, reprehenderit! Deserunt laborum dolorum deleniti molestiae quae vitae animi ratione nihil, minus ut quibusdam incidunt voluptate eos sed id repudiandae ex.\r\n					</p>	\r\n\r\n					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum sit, quia blanditiis fugiat nam libero possimus totam modi sint autem repellat fugit dicta est pariatur? Ut aut vel ad sapiente. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae, reprehenderit! Deserunt laborum dolorum deleniti molestiae quae vitae animi ratione nihil, minus ut quibusdam incidunt voluptate eos sed id repudiandae ex.\r\n					</p>\r\n\r\n					<br>\r\n\r\n					<h3>PLAN CONTINENTAL</h3>\r\n\r\n					<p>(Precio x pareja 1 día 1 noche, incluye: desayuno)<br>\r\n					Temporada Baja: $300.000 COP<br>\r\n					Temporada Alta: $350.000 COP</p>	\r\n\r\n					<br>\r\n\r\n					<h3>PLAN AMERICANO</h3>\r\n\r\n					<p>(Precio x pareja 1 día 1 noche, incluye: cena, desayuno, almuerzo)<br>\r\n					Temporada Baja: $380.000 COP<br>\r\n					Temporada Alta: $420.000 COP</p>\r\n					\r\n					<br>\r\n\r\n					<p>Hora de entrada (Check in) 3:00 pm | Hora de salida (Check out) 1:00 pm</p>', '2019-04-09 00:09:37');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `planes`
--

CREATE TABLE `planes` (
  `id` int(11) NOT NULL,
  `tipo` text NOT NULL,
  `img` text NOT NULL,
  `descripcion` text NOT NULL,
  `precio_alta` float NOT NULL,
  `precio_baja` float NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `planes`
--

INSERT INTO `planes` (`id`, `tipo`, `img`, `descripcion`, `precio_alta`, `precio_baja`, `fecha`) VALUES
(1, 'Romántico', 'vistas/img/planes/plan-romantico.png', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas suscipit quis eligendi voluptatibus dolore libero quasi delectus odit impedit optio eius corporis cumque numquam aliquid repudiandae quisquam dolor explicabo, totam.', 500, 400, '2021-02-25 17:34:54'),
(2, 'Luna de Miel', 'vistas/img/planes/luna-de-miel.png', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Placeat dicta fugiat nihil amet officiis, atque molestiae velit, quod repudiandae asperiores illum accusantium ullam, necessitatibus excepturi inventore, mollitia est vitae impedit.', 600, 500, '2021-02-25 17:34:54'),
(3, 'Aventura', 'vistas/img/planes/plan-aventura.png', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deserunt blanditiis nulla expedita nostrum vero. Laborum repudiandae numquam mollitia earum natus ut delectus quas, iste unde doloribus suscipit qui, voluptate perspiciatis.', 400, 300, '2021-02-25 17:34:54'),
(4, 'SPA', 'vistas/img/planes/plan-spa.png', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nam quibusdam magni atque provident, quaerat libero harum possimus. Illum iure magni voluptate, quos amet! Ipsam, sit, sapiente. Cumque est officiis in!', 550, 450, '2021-02-25 17:34:54');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recorrido`
--

CREATE TABLE `recorrido` (
  `id` int(11) NOT NULL,
  `foto_peq` text NOT NULL,
  `foto_grande` text NOT NULL,
  `titulo` text NOT NULL,
  `descripcion` text NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `recorrido`
--

INSERT INTO `recorrido` (`id`, `foto_peq`, `foto_grande`, `titulo`, `descripcion`, `fecha`) VALUES
(1, 'vistas/img/recorrido/pueblo01a.png', 'vistas/img/recorrido/pueblo01b.png', 'LOREM IPSUM', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Explicabo velit quis iusto magnam cupiditate dolorum repudiandae tempore cum minus eos a iure, officiis, eius, consequuntur unde nulla, enim quibusdam beatae.', '2021-02-25 17:34:54'),
(2, 'vistas/img/recorrido/pueblo02a.png', 'vistas/img/recorrido/pueblo02b.png', 'LOREM IPSUM', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Explicabo velit quis iusto magnam cupiditate dolorum repudiandae tempore cum minus eos a iure, officiis, eius, consequuntur unde nulla, enim quibusdam beatae.', '2021-02-25 17:34:54'),
(3, 'vistas/img/recorrido/pueblo03a.png', 'vistas/img/recorrido/pueblo03b.png', 'LOREM IPSUM', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Explicabo velit quis iusto magnam cupiditate dolorum repudiandae tempore cum minus eos a iure, officiis, eius, consequuntur unde nulla, enim quibusdam beatae.', '2021-02-25 17:34:54');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--

CREATE TABLE `reservas` (
  `id_reserva` int(11) NOT NULL,
  `id_habitacion` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `pago_reserva` float NOT NULL,
  `numero_transaccion` text NOT NULL,
  `codigo_reserva` text NOT NULL,
  `descripcion_reserva` text NOT NULL,
  `fecha_ingreso` date NOT NULL,
  `fecha_salida` date NOT NULL,
  `fecha_reserva` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `reservas`
--

INSERT INTO `reservas` (`id_reserva`, `id_habitacion`, `id_usuario`, `pago_reserva`, `numero_transaccion`, `codigo_reserva`, `descripcion_reserva`, `fecha_ingreso`, `fecha_salida`, `fecha_reserva`) VALUES
(1, 1, 132, 300, '7LP61819S7226811Y', '05DCFLW97', 'Habitación Suite Oriental - Plan Continental - 2 Personas', '2021-02-26', '2021-02-27', '2021-02-25 20:44:16'),
(2, 1, 132, 900, '4KG62302SC069083R', '2XPR5X7GD', 'Habitación Suite Oriental - Plan Continental - 2 Personas', '2021-03-09', '2021-03-12', '2021-02-25 20:53:49'),
(3, 1, 131, 2700, '2EE46160BA0640057', 'MFUZS9V7E', 'Habitación Suite Oriental - Plan Continental - 2 Personas', '2021-03-17', '2021-03-26', '2021-02-25 20:58:48'),
(4, 1, 131, 300, '3HW15541X3383520V', 'LH8Y5WQSD', 'Habitación Suite Oriental - Plan Continental - 2 Personas', '2021-03-26', '2021-03-27', '2021-02-25 20:59:50');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas2`
--

CREATE TABLE `reservas2` (
  `id` int(11) NOT NULL,
  `id_habitacion` int(11) NOT NULL,
  `fecha_ingreso` date NOT NULL,
  `fecha_salida` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `reservas2`
--

INSERT INTO `reservas2` (`id`, `id_habitacion`, `fecha_ingreso`, `fecha_salida`) VALUES
(1, 1, '2021-02-03', '2021-02-05'),
(2, 2, '2021-02-02', '2021-02-05'),
(3, 3, '2021-02-03', '2021-02-05'),
(4, 4, '2021-02-05', '2021-02-07'),
(5, 5, '2021-02-03', '2021-02-05'),
(6, 1, '2021-02-06', '2021-02-07'),
(7, 2, '2021-02-06', '2021-02-08'),
(8, 3, '2021-02-05', '2021-02-05'),
(9, 4, '2021-02-08', '2021-02-10'),
(10, 5, '2021-02-06', '2021-02-07'),
(11, 1, '2021-02-09', '2021-02-12'),
(12, 2, '2021-02-09', '2021-02-13'),
(13, 3, '2021-02-05', '2021-02-10'),
(14, 4, '2021-02-10', '2021-02-11'),
(15, 5, '2021-02-07', '2021-02-09'),
(16, 1, '2021-02-16', '2021-02-17'),
(17, 2, '2021-02-15', '2021-02-16'),
(18, 3, '2021-02-19', '2021-02-21'),
(19, 4, '2021-02-18', '2021-02-19'),
(20, 5, '2021-02-11', '2021-02-15'),
(21, 1, '2021-02-26', '2021-02-28'),
(22, 2, '2021-02-26', '2021-02-28'),
(23, 3, '2021-02-26', '2021-02-28'),
(24, 4, '2021-02-26', '2021-03-28'),
(25, 5, '2021-02-26', '2021-02-28'),
(26, 5, '2021-03-03', '2021-03-08');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `restaurante`
--

CREATE TABLE `restaurante` (
  `id` int(11) NOT NULL,
  `img` text NOT NULL,
  `descripcion` text NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `restaurante`
--

INSERT INTO `restaurante` (`id`, `img`, `descripcion`, `fecha`) VALUES
(1, 'vistas/img/restaurante/plato01.png', 'Lorem ipsum dolor sit amet consectetur', '2021-02-25 17:34:54'),
(2, 'vistas/img/restaurante/plato02.png', 'Lorem ipsum dolor sit amet consectetur', '2021-02-25 17:34:54'),
(3, 'vistas/img/restaurante/plato03.png', 'Lorem ipsum dolor sit amet consectetur', '2021-02-25 17:34:54'),
(4, 'vistas/img/restaurante/plato04.png', 'Lorem ipsum dolor sit amet consectetur', '2021-02-25 17:34:54'),
(5, 'vistas/img/restaurante/plato05.png', 'Lorem ipsum dolor sit amet consectetur', '2021-02-25 17:34:54'),
(6, 'vistas/img/restaurante/plato06.png', 'Lorem ipsum dolor sit amet consectetur', '2021-02-25 17:34:54');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `testimonios`
--

CREATE TABLE `testimonios` (
  `id_test` int(11) NOT NULL,
  `reserva_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `habitacion_id` int(11) NOT NULL,
  `testimonio` text NOT NULL,
  `aprobado` int(11) NOT NULL,
  `fecha_test` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `testimonios`
--

INSERT INTO `testimonios` (`id_test`, `reserva_id`, `usuario_id`, `habitacion_id`, `testimonio`, `aprobado`, `fecha_test`) VALUES
(1, 1, 132, 1, 'gyhtr hty  kuj', 1, '2021-02-25 21:02:48'),
(2, 2, 132, 1, 'yhtuy khujkl luiol ik ', 1, '2021-02-25 21:02:51'),
(3, 3, 131, 1, 'lorem impsiu nndxs', 1, '2021-02-25 21:02:54'),
(4, 4, 131, 1, 'lorem impsiu nndxs', 1, '2021-02-25 21:02:56');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_u` int(11) NOT NULL,
  `nombre` text NOT NULL,
  `password` text NOT NULL,
  `email` text NOT NULL,
  `foto` text NOT NULL,
  `modo` text NOT NULL,
  `verificacion` int(11) NOT NULL,
  `email_encriptado` text NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_u`, `nombre`, `password`, `email`, `foto`, `modo`, `verificacion`, `email_encriptado`, `fecha`) VALUES
(131, 'Mohcine Ikkou', 'null', 'mohssinelmariouh@gmail.com', 'https://platform-lookaside.fbsbx.com/platform/profilepic/?asid=10218789489389588&height=150&width=150&ext=1616867207&hash=AeS5NTnB_R3bY004yco', 'facebook', 1, 'null', '2021-02-25 17:46:46'),
(132, 'hamza', '$2a$07$asxx54ahjppf45sd87a5auFL5K1.Cmt9ZheoVVuudOi5BCi10qWly', 'hamza@gmail.com', 'vistas/img/usuarios/132/879.jpg', 'directo', 1, 'a10e20f944496f58550187c2461a0699', '2021-02-25 20:51:57');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administradores`
--
ALTER TABLE `administradores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `agenda`
--
ALTER TABLE `agenda`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_cat`);

--
-- Indices de la tabla `habitaciones`
--
ALTER TABLE `habitaciones`
  ADD PRIMARY KEY (`id_h`);

--
-- Indices de la tabla `planes`
--
ALTER TABLE `planes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `recorrido`
--
ALTER TABLE `recorrido`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`id_reserva`);

--
-- Indices de la tabla `reservas2`
--
ALTER TABLE `reservas2`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `restaurante`
--
ALTER TABLE `restaurante`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `testimonios`
--
ALTER TABLE `testimonios`
  ADD PRIMARY KEY (`id_test`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_u`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administradores`
--
ALTER TABLE `administradores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `agenda`
--
ALTER TABLE `agenda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `banner`
--
ALTER TABLE `banner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_cat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `habitaciones`
--
ALTER TABLE `habitaciones`
  MODIFY `id_h` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `planes`
--
ALTER TABLE `planes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `recorrido`
--
ALTER TABLE `recorrido`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `reservas`
--
ALTER TABLE `reservas`
  MODIFY `id_reserva` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `reservas2`
--
ALTER TABLE `reservas2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `restaurante`
--
ALTER TABLE `restaurante`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `testimonios`
--
ALTER TABLE `testimonios`
  MODIFY `id_test` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_u` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
