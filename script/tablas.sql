CREATE TABLE `pedidos` (
`nropedido` VARCHAR( 10 ) NOT NULL ,
`fecha_ped` DATE NOT NULL ,
`codcli` VARCHAR( 15 ) NOT NULL ,
`monped` DOUBLE( 20, 2 ) NOT NULL ,
`zona` VARCHAR( 4 ) NOT NULL ,
PRIMARY KEY ( `nropedido` )
) ENGINE = MYISAM ;

CREATE TABLE `detalle_ped` (
`nropedido` VARCHAR( 10 ) NOT NULL ,
`cod_art` VARCHAR( 20 ) NOT NULL ,
`cant_ord` DOUBLE( 20, 2 ) NOT NULL ,
`cant_ajust` DOUBLE( 20, 2 ) NOT NULL ,
`cant_desp` DOUBLE( 20, 2 ) NOT NULL ,
`cant_total` DOUBLE( 20, 2 ) NOT NULL ,
`precio` DOUBLE( 20, 2 ) NOT NULL,
`kilo` DOUBLE( 20,0 ) NOT NULL
) ENGINE = MYISAM ;

CREATE TABLE `clientes` (
`codcli` VARCHAR( 15 ) NOT NULL ,
`nombre` VARCHAR( 100 ) NOT NULL ,
PRIMARY KEY ( `codcli` )
) ENGINE = MYISAM ;

CREATE TABLE `usuarios` (
`usuario` VARCHAR( 15 ) NOT NULL ,
`passwd` VARCHAR( 15 ) NOT NULL ,
`nivel` VARCHAR( 1 ) NOT NULL ,
`nombre` VARCHAR( 100 ) NOT NULL ,
`zona` VARCHAR( 4 ) NOT NULL ,
`codven` VARCHAR( 16 ) NOT NULL ,
`status` VARCHAR( 1 ) NOT NULL,
`jefe` VARCHAR( 16 ) NOT NULL,
PRIMARY KEY ( `usuario` )
) ENGINE = MYISAM ;

CREATE TABLE `metaven` (
`codven` VARCHAR( 16 ) NOT NULL ,
`fechades` DATE NOT NULL ,
`fechahas` DATE NOT NULL ,
`codart` VARCHAR( 20 ) NOT NULL ,
`kgdes` DOUBLE( 20, 2 ) NOT NULL ,
`kghas` DOUBLE( 20, 2 ) NOT NULL ,
`mntcom` DOUBLE( 20, 2 ) NOT NULL ,
PRIMARY KEY ( `codven` )
) ENGINE = MYISAM ;

CREATE TABLE `factura` (
`nrofac` VARCHAR( 10 ) NOT NULL ,
`nropedido` VARCHAR( 10 ) NOT NULL ,
`codcli` VARCHAR( 10 ) NOT NULL ,
`fecfac` DATE NOT NULL ,
`status` VARCHAR( 1 ) NOT NULL ,
PRIMARY KEY ( `nrofac` )
) ENGINE = MYISAM ;

CREATE TABLE `detalle_fac` (
`nrofac` VARCHAR( 10 ) NOT NULL ,
`codart` VARCHAR( 20 ) NOT NULL ,
`cantot` DOUBLE( 20,2 ) NOT NULL ,
`precio` DOUBLE( 20,2 ) NOT NULL ,
`totart` DOUBLE( 20,2 ) NOT NULL,
`kilo` DOUBLE( 20,2 ) NOT NULL
) ENGINE = MYISAM ;

CREATE TABLE `pedidosql` (
`nropedido` VARCHAR( 6 ) NOT NULL ,
`fecha` date NOT NULL ,
`codcliente` varchar(10) NOT NULL ,
`plazo` varchar(2) NOT NULL ,
`descuento` varchar(2) NOT NULL ,
`observacion` varchar(100) NOT NULL ,

PRIMARY KEY ( `nropedido` )
) ENGINE = MYISAM ;


CREATE TABLE `detallesql` (
`nropedido` VARCHAR( 6 ) NOT NULL ,
`codarticulo` varchar(2) NOT NULL ,
`cantidad` varchar(2) NOT NULL ,
`promo` varchar(2) NOT NULL 

) ENGINE = MYISAM ;
