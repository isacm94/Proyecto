-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-05-2016 a las 19:20:00
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
  `idProvincia` varchar(45) DEFAULT NULL,
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
  `referencia` varchar(15) DEFAULT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `descripcion` text,
  `estado` varchar(10) DEFAULT 'Alta'
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`idCategoria`, `referencia`, `nombre`, `descripcion`, `estado`) VALUES
(2, '0000000001', 'Smartphones', 'Móviles inteligentes', 'Alta'),
(3, '0000000002', 'Tablets', 'Tablets inteligentes', 'Alta'),
(4, '0000000003', 'Ordenadores Portátiles', '', 'Alta'),
(5, '0000000004', 'Ordenadores Sobremesa', '', 'Alta');

--
-- Disparadores `categoria`
--
DELIMITER $$
CREATE TRIGGER `insertRefCategoria` BEFORE INSERT ON `categoria`
 FOR EACH ROW set new.referencia = (SELECT LPAD(COUNT(*)+1,10,'0') from categoria)
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`idCliente`, `nombre`, `nif`, `correo`, `direccion`, `localidad`, `cp`, `idProvincia`, `telefono`, `cuenta_corriente`, `tipo`, `anotaciones`, `estado`) VALUES
(4, 'Pepe Suárez', '44248212f', 'isacm94@gmail.com', 'C/ Gran Vía, nº 8', 'Almonte', 45236, '21', 963258741, '12345678901234567890', 'Mayorista', '', 'Alta'),
(7, 'Fernando Calvo', '48925925a', 'isacm94@gmail.com', 'C/ Cabreros, nº 36', 'Rociana', 21720, '15', 699696968, '12345678901234567890', 'Minorista', '', 'Alta'),
(8, 'Antonio Calvo', '78119953q', 'isacm94@gmail.com', 'C/ Cabreros, nº 36', 'Rociana', 21720, '21', 699696968, '12345678901234567890', 'Mayorista', 'Buen cliente', 'Alta');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE IF NOT EXISTS `factura` (
  `idFactura` int(11) NOT NULL,
  `idCliente` int(11) NOT NULL,
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
  `idProvincia` varchar(2) DEFAULT NULL,
  `nif` varchar(10) DEFAULT NULL,
  `nombre_cliente` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `referencia` varchar(15) DEFAULT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `imagen` varchar(100) DEFAULT NULL,
  `marca` varchar(45) DEFAULT NULL,
  `precio` decimal(15,2) DEFAULT NULL,
  `precio_venta` decimal(15,2) DEFAULT NULL,
  `iva` decimal(5,2) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `descripcion` text,
  `estado` varchar(10) DEFAULT 'Alta'
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`idProducto`, `idCategoria`, `idProveedor`, `referencia`, `nombre`, `imagen`, `marca`, `precio`, `precio_venta`, `iva`, `stock`, `descripcion`, `estado`) VALUES
(5, 2, 2, '0000000001', 'HUAWEI P8 LITE', '1462651153_huaweip8lite.jpg', 'Huawei', '50.00', '219.62', '21.00', 4, '', 'Alta'),
(6, 2, 2, '0000000002', 'SAMSUNG GALAXY J5', 'samsunggalaxy.jpg', 'Samsung', '150.00', '297.68', '22.00', 48, '', 'Alta'),
(7, 2, 2, '0000000003', 'LG G4', 'lgg4.jpg', 'LG', '300.00', '605.16', '23.00', 85, '', 'Alta'),
(16, 4, 12, '0000000004', 'Lenovo G70-35', '1462982120_lenovog7035.jpg', 'Lenovo', '150.00', '270.00', '21.00', 41, 'Peso del producto	2,9 Kg\r\nDimensiones del producto	57,4 x 33,6 x 7,6 cm\r\nNúmero de modelo del producto	80Q50018GE\r\nDimensión de la pantalla	17.3 pulgadas\r\nFabricante del procesador	AMD®\r\nVelocidad del procesador	1800 MHz', 'Alta'),
(20, 5, 11, '0000000005', 'HP Hardaily', '1462473411_hp-pc-hardaily.jpg', 'HP', '400.00', '700.00', '21.00', 85, 'Windows 10\r\nProcesador Intel® Core™ i3-4170T\r\nGráficos Intel HD Graphics 4400\r\nMemoria 4 GB DDR3L (1 x 4 GB)\r\nDisco duro SATA de 1 TB 7200 rpm\r\nUn año ilimitado, piezas, mano de obra y servicio de entrega y devolución', 'Alta'),
(21, 2, 5, '0000000006', 'iPhone 6', '1462475191_iphone6s.png', 'Apple', '450.00', '699.00', '21.00', 53, 'Sistema operativo | iOS \r\nAlmacenamiento interno | 64GB \r\nTamaño | 4,7 pulgadas \r\nResolución cámara frontal | 1,2 megapíxeles (1.280 x 960) \r\nBluetooth | 4.0 \r\nDual SIM | No ', 'Alta'),
(22, 4, 8, '0000000007', 'Portátil Acer', '1462702668_acer.jpg', 'Acer', '200.00', '339.00', '21.00', 85, 'Portátil Acer 15,6'''' ES1-520-36WR AMD E1-2500\r\nModelo: NX.G2JEB.011', 'Alta'),
(23, 3, 14, '0000000008', 'Galaxy Tab A', '1462703034_galaxy2tablet.png', 'Samsung', '100.00', '199.00', '21.00', 35, 'Pantalla táctil de 9.7 pulgadas con una resolución de 768x1024 pixeles\r\nProcesador Quad-Core a 1.2 GHz, con 1.5 GB de RAM\r\nCámara trasera 5 megapíxeles con grabación de vídeo en 720p\r\nSistema operativo Android\r\nConectividad: WiFi, Bluetooth', 'Alta'),
(24, 4, 10, '0000000009', 'Asus Zenbook', '1463048856_asuszenbook.jpg', 'Asus', '500.00', '878.00', '21.00', 33, 'Adaptador gráfico, Open GL\r\nAltavoces de: Bang & Olufsen\r\nCombo headphone/microphone port\r\nEstados de inactividad\r\nExecute Disable Bit\r\nIntel AES Nuevas instrucciones\r\nIntel Clear Video HD Technology', 'Alta'),
(25, 4, 6, '0000000010', 'Apple MacBook Air', '1463050045_applemacbook.jpg', 'Apple', '800.00', '1085.99', '21.00', 85, 'Ordenador portátil MacBook Air 11" i5 8GB RAM 128GB Flash (MJVM2Y/A).', 'Alta'),
(26, 4, 8, '0000000011', 'Dell Vostro 15 3558', '1463050193_dell.jpg', 'Dell', '200.00', '365.00', '21.00', 98, 'Alcance de temperatura operativa: 0 - 40 °C\r\nCombo headphone/microphone port\r\nEstados de inactividad\r\nExecute Disable Bit\r\nIntel AES Nuevas instrucciones\r\nIntel Anti-Theft Technology\r\nIntel Clear Video HD Technology', 'Alta'),
(27, 3, 12, '0000000012', 'Sony Xperia Z2', '1463050396_sonyxperiatablet.jpg', 'Sony', '200.00', '374.00', '21.00', 45, 'Tablet de 10.1" (WiFi + Bluetooth, 16 GB, 3 GB RAM, Android 4.4 KitKat), negro + base de carga', 'Alta');

--
-- Disparadores `producto`
--
DELIMITER $$
CREATE TRIGGER `insertRefProducto` BEFORE INSERT ON `producto`
 FOR EACH ROW set new.referencia = (SELECT LPAD(COUNT(*)+1,10,'0') from producto)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE IF NOT EXISTS `proveedor` (
  `idProveedor` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `nif` varchar(10) DEFAULT NULL,
  `correo` varchar(100) DEFAULT NULL,
  `telefono` int(11) DEFAULT NULL,
  `direccion` varchar(45) DEFAULT NULL,
  `localidad` varchar(45) DEFAULT NULL,
  `cp` int(11) DEFAULT NULL,
  `idProvincia` char(2) NOT NULL,
  `anotaciones` text,
  `estado` varchar(10) DEFAULT 'Alta'
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`idProveedor`, `nombre`, `nif`, `correo`, `telefono`, `direccion`, `localidad`, `cp`, `idProvincia`, `anotaciones`, `estado`) VALUES
(2, 'InfoTelwi', '44248212f', 'infotelwi@gmail.com', 639852471, 'C/ Gran Vía, nº 8', 'Madrid', 45236, '28', '', 'Baja'),
(3, 'eBay', '85497079f', 'ebay@gmail.com', 654123789, 'C/ Gran Vía, nº 8', 'Madrid', 45236, '28', '', 'Baja'),
(4, 'Phone House', '71589120x', 'phonehouse@gmail.com', 963258951, 'C/ Gran Vía, nº 8', 'Madrid', 45236, '28', '', 'Alta'),
(5, 'Móviles SA', '11582305b', 'movilessa@gmail.com', 689456321, 'C/ Gran Vía, nº 8', 'Madrid', 45236, '28', 'Buena empresa de móviles', 'Alta'),
(6, 'Repuestos García', '60703993r', 'repuestosg@gmail.com', 925478963, 'C/ Gran Vía, nº 8', 'Almonte', 45236, '21', '', 'Alta'),
(7, 'Repuestos González', '30527671r', 'repuestosgon@gmail.com', 959416623, 'C/ Gran Vía, nº 8', 'Villarrasa', 45236, '21', '', 'Baja'),
(8, 'Repuestos López', '36887054e', 'repuestosl@gmail.com', 956874123, 'C/ Gran Vía, nº 8', 'Rociana', 45236, '21', '', 'Alta'),
(9, 'Phone Shop', '81915105f', 'phoneshop@gmail.com', 951263487, 'C/ Gran Vía, nº 8', 'Madrid', 45236, '28', '', 'Alta'),
(10, 'Tiger', '92869306k', 'tiger@gmail.com', 669321478, 'C/ Gran Vía, nº 8', 'Madrid', 45236, '28', '', 'Baja'),
(11, 'Movelia', '64932519t', 'movelia@gmail.com', 698752143, 'C/ Gran Vía, nº 8', 'Madrid', 45236, '28', '', 'Alta'),
(12, 'Repuestos Mateos', '97247361a', 'repuestosm@gmail.com', 655233147, 'C/ Gran Vía, nº 8', 'Madrid', 45236, '28', '', 'Alta'),
(14, 'Phone Home', '86327337b', 'phonehome@hotmail.com', 963258455, 'C/ Gran Vía, nº 8', 'Almonte', 45236, '21', '', 'Alta'),
(15, 'Telephone SA', '58311176n', 'telephone@hotmail.com', 963258741, 'C/ Cabreros, nº 36', 'Rociana', 21720, '21', '', 'Alta'),
(16, 'kakakak', '48925926g', 'isacm94@gmail.com', 699696968, 'C/ Cabreros, nº 36', 'Rociana', 21720, '21', '', 'Alta');

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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `username`, `clave`, `tipo`, `nombre`, `correo`, `estado`) VALUES
(1, 'admin', '$2y$10$FaG.docRjdA0pCKFOWDUCugJTQoa3mtlX4Of/KsmdiiqZmG4OEYOK', 'Administrador', 'Isa Calvo', 'isacm94@gmail.com', 'Alta'),
(12, 'emple', '$2y$10$5PDk1e9rXzRZLhClI6vBuOdnmxn7JnMD6Go7.Cgc1CTdh4xi269J2', 'Empleado', 'Juan García', 'isacm94@gmail.com', 'Alta');

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
  ADD UNIQUE KEY `referencia_UNIQUE` (`referencia`);

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
  ADD PRIMARY KEY (`idFactura`),
  ADD KEY `fk_Factura_Cliente1_idx` (`idCliente`);

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
  ADD UNIQUE KEY `nombre_UNIQUE` (`nombre`),
  ADD KEY `categoria` (`idCategoria`),
  ADD KEY `proveedor` (`idProveedor`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`idProveedor`),
  ADD UNIQUE KEY `nombre_UNIQUE` (`nombre`),
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
  ADD PRIMARY KEY (`idUsuario`),
  ADD UNIQUE KEY `username_UNIQUE` (`username`);

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
  MODIFY `idCategoria` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `idCliente` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `idFactura` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `linea_albaran`
--
ALTER TABLE `linea_albaran`
  MODIFY `idLineaAlbaran` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `idProducto` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `idProveedor` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
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
-- Filtros para la tabla `factura`
--
ALTER TABLE `factura`
  ADD CONSTRAINT `fk_Factura_Cliente1` FOREIGN KEY (`idCliente`) REFERENCES `cliente` (`idCliente`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
