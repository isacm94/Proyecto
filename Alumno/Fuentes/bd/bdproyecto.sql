-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-04-2016 a las 17:41:20
-- Versión del servidor: 5.6.26
-- Versión de PHP: 5.5.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bdproyecto`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `albaran`
--

CREATE TABLE IF NOT EXISTS `albaran` (
  `idAlbaran` int(11) NOT NULL,
  `idCliente` int(11) NOT NULL,
  `idFactura` int(11) NOT NULL,
  `numalbaran` int(11) DEFAULT NULL,
  `importe_total` decimal(50,2) DEFAULT NULL,
  `cantidad_total` int(11) DEFAULT NULL,
  `fecha_albaran` date DEFAULT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `localidad` varchar(100) DEFAULT NULL,
  `cp` int(11) DEFAULT NULL,
  `cod_provincia` varchar(45) DEFAULT NULL,
  `nif` varchar(10) DEFAULT NULL,
  `nombre_cliente` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Disparadores `albaran`
--
DELIMITER $$
CREATE TRIGGER `insertNumeroAlbaran` BEFORE INSERT ON `albaran`
 FOR EACH ROW set new.numalbaran = (SELECT COUNT(*)+1 from albaran)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE IF NOT EXISTS `categoria` (
  `idCategoria` int(11) NOT NULL,
  `referencia` varchar(20) DEFAULT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `descripcion` text,
  `estado` varchar(10) DEFAULT 'Alta'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`idCategoria`, `referencia`, `nombre`, `descripcion`, `estado`) VALUES
(2, '1', 'Smartphones', 'Móviles inteligentes', 'Alta'),
(3, '2', 'Tablets', 'Tablets inteligentes', 'Alta');

--
-- Disparadores `categoria`
--
DELIMITER $$
CREATE TRIGGER `insertRefCategoria` BEFORE INSERT ON `categoria`
 FOR EACH ROW set new.referencia = (SELECT COUNT(*)+1 from categoria)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE IF NOT EXISTS `cliente` (
  `idCliente` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `nif` varchar(10) DEFAULT NULL,
  `correo` varchar(180) DEFAULT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `localidad` varchar(100) DEFAULT NULL,
  `cp` int(11) DEFAULT NULL,
  `idProvincia` char(2) NOT NULL,
  `telefono` int(11) DEFAULT NULL,
  `cuenta_corriente` varchar(24) DEFAULT NULL,
  `tipo` varchar(15) DEFAULT 'Minorista',
  `anotaciones` text,
  `estado` varchar(10) DEFAULT 'Alta'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE IF NOT EXISTS `factura` (
  `idFactura` int(11) NOT NULL,
  `numfactura` int(11) DEFAULT NULL,
  `fecha_factura` date DEFAULT NULL,
  `cantidad_total` int(11) DEFAULT NULL,
  `importe_bruto` decimal(50,2) DEFAULT NULL,
  `base_imponible` decimal(50,2) DEFAULT NULL,
  `importe_total` decimal(50,2) DEFAULT NULL,
  `pendiente_pago` char(2) DEFAULT NULL,
  `descuento` decimal(5,2) DEFAULT NULL,
  `fecha_cobro` date DEFAULT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `localidad` varchar(100) DEFAULT NULL,
  `cp` int(11) DEFAULT NULL,
  `cod_provincia` varchar(45) DEFAULT NULL,
  `nif` varchar(10) DEFAULT NULL,
  `nombre_cliente` varchar(100) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Disparadores `factura`
--
DELIMITER $$
CREATE TRIGGER `insertNumeroFactura` BEFORE INSERT ON `factura`
 FOR EACH ROW SET NEW.numfactura = (SELECT IFNULL(max(numfactura), 0) + 1
                     	FROM factura	
                     		WHERE year(fecha_factura) = YEAR(NEW.Fecha_factura))
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `linea_albaran`
--

CREATE TABLE IF NOT EXISTS `linea_albaran` (
  `idLineaAlbaran` int(11) NOT NULL,
  `idAlbaran` int(11) NOT NULL,
  `idProducto` int(11) NOT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `precio` decimal(15,2) unsigned DEFAULT NULL,
  `importe` decimal(30,2) DEFAULT NULL,
  `iva` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Disparadores `linea_albaran`
--
DELIMITER $$
CREATE TRIGGER `insertImporte` BEFORE INSERT ON `linea_albaran`
 FOR EACH ROW set new.importe = new.cantidad*new.precio
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE IF NOT EXISTS `producto` (
  `idProducto` int(11) NOT NULL,
  `idCategoria` int(11) NOT NULL,
  `idProveedor` int(11) NOT NULL,
  `referencia` varchar(20) DEFAULT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `imagen` varchar(100) DEFAULT NULL,
  `marca` varchar(45) DEFAULT NULL,
  `precio` decimal(15,2) DEFAULT NULL,
  `precio_venta` decimal(15,2) DEFAULT NULL,
  `iva` decimal(5,2) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `descripcion` text,
  `estado` varchar(10) DEFAULT 'Alta'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE IF NOT EXISTS `proveedor` (
  `idProveedor` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `nif` varchar(10) DEFAULT NULL,
  `correo` varchar(100) DEFAULT NULL,
  `direccion` varchar(45) DEFAULT NULL,
  `localidad` varchar(45) DEFAULT NULL,
  `cp` int(11) DEFAULT NULL,
  `idProvincia` char(2) NOT NULL,
  `anotaciones` text,
  `estado` varchar(10) DEFAULT 'Alta'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`idProveedor`, `nombre`, `nif`, `correo`, `direccion`, `localidad`, `cp`, `idProvincia`, `anotaciones`, `estado`) VALUES
(1, 'Sony', 'P2871145E', 'sony@gmail.com', 'C/ Gran Vía, nº 8', 'Madrid', 45236, '28', 'asdfasdfadsa', 'Alta');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provincia`
--

CREATE TABLE IF NOT EXISTS `provincia` (
  `idProvincia` char(2) NOT NULL DEFAULT '00' COMMENT 'Código de la provincia de dos digitos',
  `nombre` varchar(50) DEFAULT '' COMMENT 'Nombre de la provincia'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Provincias de españa; 99 para seleccionar a Nacional';

--
-- Volcado de datos para la tabla `provincia`
--

INSERT INTO `provincia` (`idProvincia`, `nombre`) VALUES
('15', 'A Coruña'),
('01', 'Alava'),
('02', 'Albacete'),
('03', 'Alicante'),
('04', 'Almería'),
('33', 'Asturias'),
('05', 'Avila'),
('06', 'Badajoz'),
('08', 'Barcelona'),
('09', 'Burgos'),
('10', 'Cáceres'),
('11', 'Cádiz'),
('39', 'Cantabria'),
('12', 'Castellón'),
('51', 'Ceuta'),
('13', 'Ciudad Real'),
('14', 'Córdoba'),
('16', 'Cuenca'),
('17', 'Girona'),
('18', 'Granada'),
('19', 'Guadalajara'),
('20', 'Guipuzcoa'),
('21', 'Huelva'),
('22', 'Huesca'),
('07', 'Islas Baleares'),
('23', 'Jaén'),
('26', 'La Rioja'),
('35', 'Las Palmas'),
('24', 'León'),
('25', 'Lleida'),
('27', 'Lugo'),
('28', 'Madrid'),
('29', 'Málaga'),
('52', 'Melilla'),
('30', 'Murcia'),
('31', 'Navarra'),
('32', 'Ourense'),
('34', 'Palencia'),
('36', 'Pontevedra'),
('37', 'Salamanca'),
('38', 'Santa Cruz de Tenerife'),
('40', 'Segovia'),
('41', 'Sevilla'),
('42', 'Soria'),
('43', 'Tarragona'),
('44', 'Teruel'),
('45', 'Toledo'),
('46', 'Valencia'),
('47', 'Valladolid'),
('48', 'Vizcaya'),
('49', 'Zamora'),
('50', 'Zaragoza');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `idUsuario` int(11) NOT NULL,
  `username` varchar(45) DEFAULT NULL,
  `clave` varchar(200) DEFAULT NULL,
  `tipo` varchar(15) DEFAULT 'Empleado',
  `nombre` varchar(100) DEFAULT NULL,
  `correo` varchar(45) DEFAULT NULL,
  `estado` varchar(15) DEFAULT 'Alta'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `username`, `clave`, `tipo`, `nombre`, `correo`, `estado`) VALUES
(1, 'admin', '$2y$10$TESEDQqg8m2TyUzPLLAh3.DOO/ULF6551GyEHYcR.huJrQepWaFL2', 'Administrador', 'Isa Calvo', 'isacm94@gmail.com', 'Alta'),
(2, 'admin2', '$2y$10$HjRo2gjJehOJPdtXwJ7/2.WOP5lpOcCKzQKyQnzbKJn8rqSyPb7DO', 'Administrador', 'Isabel Calvo', 'isacm94@gmail.com', 'Alta');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `albaran`
--
ALTER TABLE `albaran`
  ADD PRIMARY KEY (`idAlbaran`),
  ADD KEY `cliente` (`idCliente`),
  ADD KEY `factura` (`idFactura`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`idCategoria`),
  ADD UNIQUE KEY `nombre_UNIQUE` (`nombre`),
  ADD UNIQUE KEY `referencia` (`referencia`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`idCliente`),
  ADD UNIQUE KEY `cif_UNIQUE` (`nif`),
  ADD KEY `fk_Usuario_tbl_provincias1_idx` (`idProvincia`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`idFactura`);

--
-- Indices de la tabla `linea_albaran`
--
ALTER TABLE `linea_albaran`
  ADD PRIMARY KEY (`idLineaAlbaran`),
  ADD KEY `producto` (`idProducto`),
  ADD KEY `albaran` (`idAlbaran`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`idProducto`),
  ADD UNIQUE KEY `referencia` (`referencia`),
  ADD KEY `categoria` (`idCategoria`),
  ADD KEY `proveedor` (`idProveedor`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`idProveedor`),
  ADD UNIQUE KEY `cif_UNIQUE` (`nif`),
  ADD KEY `provincia` (`idProvincia`);

--
-- Indices de la tabla `provincia`
--
ALTER TABLE `provincia`
  ADD PRIMARY KEY (`idProvincia`),
  ADD KEY `nombre` (`nombre`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `albaran`
--
ALTER TABLE `albaran`
  MODIFY `idAlbaran` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `idCategoria` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `idCliente` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `idFactura` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `linea_albaran`
--
ALTER TABLE `linea_albaran`
  MODIFY `idLineaAlbaran` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `idProducto` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `idProveedor` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `albaran`
--
ALTER TABLE `albaran`
  ADD CONSTRAINT `fk_Albaran_Factura1` FOREIGN KEY (`idFactura`) REFERENCES `factura` (`idFactura`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Pedido_Usuario1` FOREIGN KEY (`idCliente`) REFERENCES `cliente` (`idCliente`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `fk_Usuario_tbl_provincias1` FOREIGN KEY (`idProvincia`) REFERENCES `provincia` (`idProvincia`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `linea_albaran`
--
ALTER TABLE `linea_albaran`
  ADD CONSTRAINT `fk_Linea_Pedido_Pedido1` FOREIGN KEY (`idAlbaran`) REFERENCES `albaran` (`idAlbaran`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Venta_has_Camiseta_Camiseta1` FOREIGN KEY (`idProducto`) REFERENCES `producto` (`idProducto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `fk_Camiseta_Categoria` FOREIGN KEY (`idCategoria`) REFERENCES `categoria` (`idCategoria`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Producto_Proveedor1` FOREIGN KEY (`idProveedor`) REFERENCES `proveedor` (`idProveedor`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD CONSTRAINT `fk_Proveedor_Provincia1` FOREIGN KEY (`idProvincia`) REFERENCES `provincia` (`idProvincia`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
