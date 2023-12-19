CREATE DATABASE SENATIDB;
USE SENATIDB;
CREATE TABLE marcas
(
	idmarca			INT AUTO_INCREMENT PRIMARY KEY,
    marca			VARCHAR(100) NOT NULL,
    create_at       DATETIME     NOT NULL DEFAULT NOW(),
    update_at		DATETIME     NULL,
    inactive_at     DATETIME     NULL,
    CONSTRAINT uk_marca_mar UNIQUE (marca)
)
ENGINE=INNODB;


INSERT INTO marcas(marca)
	VALUES
		('Toyota'),
        ('Nissan'),
        ('Volvo'),
        ('Hyundai'),
        ('Kia');
	
SELECT * FROM marcas;

CREATE TABLE vehiculos
(
	idvehiculo 			INT AUTO_INCREMENT PRIMARY KEY,
    idmarca				INT NOT NULL,
    modelo				VARCHAR(70) NOT NULL,
    color 				VARCHAR(39) NOT NULL,
    tipocombustible		VARCHAR(3)  NOT NULL,
    peso				SMALLINT    NOT NULL,
    afabricacion		CHAR(4)     NOT NULL,
    placa               CHAR(7)     NOT NULL,
    create_at       DATETIME     NOT NULL DEFAULT NOW(),
    update_at		DATETIME     NULL,
    inactive_at     DATETIME     NULL,
    CONSTRAINT fk_marcas FOREIGN KEY (idmarca)REFERENCES marcas(idmarca),
    CONSTRAINT ck_combustible CHECK(tipocombustible	IN('GLP','GNV','GSL','DSL')),
    CONSTRAINT  ck_peso CHECK(peso>0),
    CONSTRAINT uk_placa UNIQUE (placa)

)
ENGINE=INNODB;

INSERT INTO vehiculos (idmarca,modelo,color,tipocombustible,peso,afabricacion,placa)
	VALUES 
		(1,'HILUX','blanco','DSL','1800','2020','ABC-111'),
        (2,'Sentra','gris','GSL','1200','2021','ABC-112'),
        (3,'EX30','negro','GNV','1350','2023','ABC-113'),
        (4,'Tucson','rojo','GLP','1800','2022','ABC-114'),
        (5,'Sportage','blanco','DSL','1500','2010','ABC-115');

DELIMITER $$
CREATE PROCEDURE spu_vehiculos_listar(IN _placa CHAR(7))
BEGIN
	SELECT 
    VEH.idvehiculo,
    MAR.marca,
    VEH.modelo,
    VEH.color,
    VEH.tipocombustible,
    VEH.peso,
    VEH.afabricacion,
    VEH.placa
    FROM vehiculos VEH
    INNER JOIN marcas MAR ON MAR.idmarca= VEH.idmarca
    WHERE (VEH.inactive_at IS NULL) AND
          (VEH.placa=_placa);
    
END $$

CALL spu_vehiculos_listar('ABC-111');

DELIMITER $$
CREATE PROCEDURE spu_vehiculos_registrar(
 _idmarca		INT,
 _modelo		VARCHAR(70),
 _color 		VARCHAR(39),
 _tipocombustible       VARCHAR(3),
 _peso			SMALLINT,
 _afabricacion		CHAR(4),
 _placa                 CHAR(7)    
 )
BEGIN
	INSERT INTO vehiculos (idmarca,modelo,color,tipocombustible,peso,afabricacion,placa)
	VALUES	(_idmarca,_modelo,_color,_tipocombustible,_peso,_afabricacion,_placa);
SELECT @@last_insert_id 'idvehiculo';
END$$

CALL spu_vehiculos_registrar (1,'Supra','Negro','GLP','1800','1998','ABC-116');
CALL spu_vehiculos_registrar (1,'Ranger','Negro','GLP','2600','1998','ABC-118');


CALL spu_vehiculos_listar('ABC-116');


DELIMITER $$
CREATE PROCEDURE spu_marcas_listar()
BEGIN
  SELECT idmarca,marca FROM marcas
  WHERE inactive_at IS NULL
  ORDER BY marca;
END$$





CREATE  TABLE sedes
(
	idsede 	    INT AUTO_INCREMENT PRIMARY KEY,
    sede		    VARCHAR(70)   NOT NULL,
    create_at       DATETIME     NOT NULL DEFAULT NOW(),
    update_at		DATETIME     NULL,
    inactive_at     DATETIME     NULL
)
ENGINE=INNODB;

INSERT INTO sedes(sede)
	VALUES 
    ('CHINCHA'),
    ('ICA'),
    ('VILLA EL SALVADOR'),
    ('LIMA');
    


DELIMITER $$
CREATE PROCEDURE spu_sedes_listar()
BEGIN
	SELECT  idsede,sede FROM sedes
	WHERE inactive_at IS NULL
	ORDER BY sede
	;
END$$

CALL spu_sedes_listar;

CREATE TABLE empleados 
(
	idempleado 		INT AUTO_INCREMENT PRIMARY KEY,
    idsede			INT NOT NULL,
    apellidos		VARCHAR(50)  NOT NULL,
    nombres 		VARCHAR(50)  NOT NULL,
    ndocumento		CHAR(12)     NOT NULL,
    fechanac		DATE         NOT NULL,
    telefono		CHAR(9)      NOT NULL,
    create_at       DATETIME     NOT NULL DEFAULT NOW(),
    update_at		DATETIME     NULL,
    inactive_at     DATETIME     NULL,
    CONSTRAINT uk_telefono UNIQUE (telefono),
    CONSTRAINT uk_ndocumento UNIQUE (ndocumento),
    CONSTRAINT fk_sedeS FOREIGN KEY (idsede) REFERENCES sedes(idsede)
)
ENGINE=INNODB;

INSERT INTO empleados(idsede,apellidos,nombres,ndocumento,fechanac,telefono)
	VALUES (1,'Soto Saravia','ALexsis Leonel','63030049','2005/08/01','123456789');

SELECT * FROM empleados;
DELIMITER $$
CREATE PROCEDURE spu_empleados_listar(IN _ndocumento CHAR(12))
BEGIN
	SELECT EMP.idempleado,SD.sede, SD.idsede, EMP.apellidos,EMP.nombres,EMP.ndocumento,EMP.fechanac,EMP.telefono FROM empleados EMP
	INNER JOIN sedes SD ON EMP.idsede=SD.idsede
        WHERE (EMP.inactive_at IS NULL) AND
        (EMP.ndocumento=_ndocumento);
END$$

CALL spu_empleados_listar('');


DELIMITER $$
CREATE PROCEDURE spu_empleados_registrar(
    _idsede			INT ,
    _apellidos		VARCHAR(50)  ,
    _nombres 		VARCHAR(50),
    _ndocumento		CHAR(12),
    _fechanac		DATE,
    _telefono		CHAR(9)
)
BEGIN
	INSERT INTO empleados (idsede,apellidos,nombres,ndocumento,fechanac,telefono)
	VALUES 
        (_idsede,_apellidos,_nombres,_ndocumento,_fechanac,_telefono);
END$$

CALL spu_empleados_registrar(4,'SAENS CUEVA','JAVIER PEPE','63030048','2004/11/02','11223344');
SELECT * FROM empleados;

DELIMITER $$
CREATE PROCEDURE spu_resumen_tipocombustible()
BEGIN
	SELECT
		tipocombustible, count(tipocombustible) 'total'
		 FROM vehiculos
         GROUP BY tipocombustible
         ORDER BY total;
END$$
CALL spu_resumen_tipocombustible;


